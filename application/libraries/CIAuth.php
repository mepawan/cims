<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CI Auth Class
 *
 * Authentication library for Code Igniter.
 *
 * @author		pawan.developers
 * @version		1.0.0
 * @license		MIT License Copyright (c) 2008 Erick Hartanto
 */
include_once(dirname(__FILE__).'/CIAuthEvent.php');
class CIAuth {

	public function __construct() {
		global $ci_settings;
		
		$this->ci =& get_instance();
		log_message('debug', 'CIAuth Initialized');
		$this->ci->load->library('Session');
		$this->ci->load->database();
		$this->ci->load->model('Util_model','util');
		$this->ci->load->model('ciauth/users');
		$this->ci->load->config('ciauth');
		$this->ci->load->helper('ciauth');
		$this->ci->lang->load('ciauth');
		$this->config = $this->ci->config->item('ciauth');
		//$this->event = new CIAuthEvent();
		// Initialize
		
		$this->_init();
	}

	/* Private function */

	private function _init() {
		global $ci_settings;
		$this->_auth_error = '';
		$this->ci->load->model('ciauth/users', 'users');
		if(!$ci_settings) {
			$ci_settings = load_settings();
			$user_roles = $this->ci->users->get_roles();
			$roles = array();
			$roles_by_name = array();
			array_walk($user_roles, function($role) use(&$roles,&$roles_by_name){
				$roles[$role['id']] = $role;
				$roles_by_name[$role['alias']] = $role;
			});
			$ci_settings['roles'] = $roles;
			$ci_settings['roles_by_name'] = $roles_by_name;
		}
		$ci_settings = array_merge($this->config, $ci_settings);
		
		$tz = isset($this->settings['timezone']) && $this->settings['timezone']?:'America/Chicago';
		date_default_timezone_set($tz);
		update_mysql_timezone();

		$this->max_signup_with_1_ip = isset($this->settings['max_signup_with_1_ip']) && $this->settings['max_signup_with_1_ip'] ? $this->settings['max_signup_with_1_ip']:5;
		
		// When we load this library, auto Login any returning users
		$this->autologin();
	}
	
	function login($params = '') {
		global $ci_settings;
		$resp = array();
		if(!$params){
			$params = $this->ci->input->post();
		}
		if ( isset($params['loginkey']) && $params['loginkey']) {
			
			$login_methods = 0;
			$get_user_function = '';
			if(isset($ci_settings['login_by_username']) && $ci_settings['login_by_username']){
				$login_methods++;
				$get_user_function = 'get_user_by_username';
			}
			if(isset($ci_settings['login_by_email']) && $ci_settings['login_by_email']){
				$login_methods++;
				$get_user_function = 'get_user_by_email';
			}
			if(isset($ci_settings['login_by_phone']) && $ci_settings['login_by_phone']){
				$login_methods++;
				$get_user_function = 'get_user_by_phone';
			}
			if ($login_methods > 1 ) {
				$get_user_function = 'get_login';
			} 
			$user = $this->ci->users->get_login($params['loginkey']);
			
			
			if ($user) {
				if($user['password'] == md5($params['password']) || (isset($params['forcelogin']) && $params['forcelogin'])){
					
					if($user['status'] == 'pending'){
						$resend_activation_link = '<a href="'.ci_base_url().'admin/auth/resend-activation-email">'.$this->ci->lang->line("txt_resend_activation_email").'</a>';
						$resp['status'] = 'fail';
						$resp['msg'] = sprintf($this->ci->lang->line('ciauth_account_pending'),$ci_settings['site_name'],$resend_activation_link);
					} else if($user['status'] == 'suspended'){
						$account_resume_req = ' <a href="'.ci_base_url().'admin/auth/request/resume-account">'.$this->ci->lang->line("txt_resume_account").'</a>';
						$resp['status'] = 'fail';
						$resp['msg'] == sprintf($this->ci->lang->line('ciauth_account_suspended'),$account_resume_req);
					} else {
						
						//$this->send_activation_email($user);
						$update_user = array();
						if ($user['password_reset_code']) {
							$update_user['password_reset_code'] = '';
							$user['password_reset_code'] = '';
						}
						$update_user['login_attempt'] = 0;
						$user['login_attempt'] = '';
						$user['password'] = '';
						$this->_set_session($user);
						if ($params['remember'] == 1 || $params['remember'] == 'on' ) {
							$this->_create_autologin($user['id']);
						}
						$update_user['id'] = $user['id'];
						$this->ci->users->update_user_data($update_user);
						$resp['status'] = 'success';
						$resp['msg'] = 'Logged in success. Redirecting';
					}
				} else {
					$resp['status'] = 'fail';
					$resp['msg'] = $this->ci->lang->line('ciauth_wrong_password');
					if ($ci_settings['record_login_attempts']) {
						$update_user['login_attempt'] = ($user['login_attempt'])? $user['login_attempt'] + 1:1;
						$update_user['id'] = $user['id'];
						$this->ci->users->update_user_data($update_user);
					}
				}
			} else {
				$resp['status'] = 'fail';
				$resp['msg'] = sprintf($this->ci->lang->line('ciauth_login_not_exist'), $params['loginkey']);
			}
		}
		return $resp;
	}

	function logout() {
		global $ci_settings;
		//$this->user_logging_out($this->ci->session->userdata('DX_user_id'));
		if ($this->ci->input->cookie($ci_settings['autologin_cookie_name'])) {
			$this->_delete_autologin();
		}
		$this->ci->session->sess_destroy();		
	}
	
	function get_auth_error(){
		return $this->_auth_error;
	}
	
	function _set_session($data) {
		global $ci_settings;
		$data = (array)$data;
		if(isset($data['password'])){
			unset($data['password']);
		}
		
		
		$role_data = isset($ci_settings['roles'][$data['role_id']])?$ci_settings['roles'][$data['role_id']]:false;
		$user = array(						
			'user_id'		=> $data['id'],	
			'role'			=> ($role_data)?$role_data['alias']:'',
			'role_name'			=> ($role_data)?$role_data['title']:'',
			'logged_in'		=> TRUE,
		);
		$user_data = array();
		array_walk($data, function($d,$index) use(&$user_data){
			$user_data[$index] = $d;
		});
		$user['user_data'] = $user_data;
		$this->ci->session->set_userdata($user);
	}
	function is_logged_in() {
		return $this->ci->session->userdata('logged_in');
	}
	function is_admin() {
		return strtolower($this->ci->session->userdata('role')) == 'admin';
	}
	function is_superadmin() {
		return strtolower($this->ci->session->userdata('role')) == 'superadmin';
	}
	function is_role($role) { //$role = role alias
		return strtolower($this->ci->session->userdata('role')) == $role;
	}
	function get_user_id() {
		return $this->ci->session->userdata('user_id');
	}

	function get_user_fullname(){
		return $this->get_user('first_name') . ' ' . $this->get_user('last_name');
	}
	

	function get_user($field = '') {
		$user_data = $this->ci->session->userdata('user_data');
		if($field){
			switch($field){
				case 'user_id':
				case 'role_name':
				case 'role':
				case 'logged_in' :
					return $this->ci->session->userdata($field);
					break;

				default:
					return isset($user_data[$field])?$user_data[$field]:false;
					break;
			}
		} else {
			$user_data['role'] = $this->ci->session->userdata('role');
			$user_data['role_name'] = $this->ci->session->userdata('role_name');
			$user_data['user_id'] = $this->ci->session->userdata('user_id');
			$user_data['logged_in'] = $this->ci->session->userdata('logged_in');
			return $user_data;
		}
	}
	function _get_role_data($role_id) {
		global $ci_settings;
		$roles = $ci_settings['roles'];
		return isset($roles[$role_id])?$roles[$role_id]:false;
	}

	function _create_autologin($user_id) {
		$result = FALSE;
		global $ci_settings;
		$user = array(
			'key_id' => substr(md5(uniqid(rand().$this->ci->input->cookie($this->ci->config->item('sess_cookie_name')))), 0, 16),
			'user_id' => $user_id
		);
		$this->ci->load->model('ciauth/user_autologin', 'user_autologin');
		$this->ci->user_autologin->prune_keys($user['user_id']);

		if ($this->ci->user_autologin->store_key($user['key_id'], $user['user_id'])) {
			$this->_auto_cookie($user);
			$result = TRUE;
		}
		return $result;
	}

	function autologin() {
		$result = FALSE;
		global $ci_settings;
		if ($auto = $this->ci->input->cookie($ci_settings['autologin_cookie_name']) AND ! $this->ci->session->userdata('ciauth_logged_in')){
			$auto = unserialize($auto);
			if (isset($auto['key_id']) AND $auto['key_id'] AND $auto['user_id']) {
			$this->ci->load->model('ciauth/user_autologin', 'user_autologin');
				$query = $this->ci->user_autologin->get_key($auto['key_id'], $auto['user_id']);								
				if ($result = $query->row_array()) {
					$this->_set_session($result);
					$this->_auto_cookie($auto);
					//$this->_set_last_ip_and_last_login($auto['user_id']);
					$result = TRUE;
				}
			}
		}
		
		return $result;
	}

	function _delete_autologin() {
		global $ci_settings;
		if ($auto = $this->ci->input->cookie($ci_settings['autologin_cookie_name'])) {
			$this->ci->load->helper('cookie');
			$this->ci->load->model('ciauth/user_autologin', 'user_autologin');
			$auto = unserialize($auto);			
			$this->ci->user_autologin->delete_key($auto['key_id'], $auto['user_id']);
			set_cookie($ci_settings['autologin_cookie_name'],	'',	-1);
		}
	}

	function _auto_cookie($data) {
		global $ci_settings;
		$this->ci->load->helper('cookie');
		$cookie = array(
			'name' 		=> $ci_settings['autologin_cookie_name'],
			'value'		=> serialize($data),
			'expire'	=> $ci_settings['autologin_cookie_life'] 
		);
		set_cookie($cookie);
	}
	function forget_password($loginkey = '') {
		global $ci_settings;
		$resp = false;
		if(!$loginkey){
			$loginkey = $this->ci->input->post('loginkey');
		}
		if ( isset($loginkey) && $loginkey) {
			
			$login_methods = 0;
			$get_user_function = '';
			if(isset($ci_settings['login_by_username']) && $ci_settings['login_by_username']){
				$login_methods++;
				$get_user_function = 'get_user_by_username';
			}
			if(isset($ci_settings['login_by_email']) && $ci_settings['login_by_email']){
				$login_methods++;
				$get_user_function = 'get_user_by_email';
			}
			if(isset($ci_settings['login_by_phone']) && $ci_settings['login_by_phone']){
				$login_methods++;
				$get_user_function = 'get_user_by_phone';
			}
			if ($login_methods > 1 ) {
				$get_user_function = 'get_login';
			} 
			$user = $this->ci->users->get_login($loginkey);
			
			
			if ($user) {
				$prcode = ci_random_code(5);
				$hash = base64_encode($user['id'].'_'.$prcode);
				$user_data = array(
					'id' => $this->get_user_id(),
					'password_reset_code' => $prcode,
				);
				$reset_link = ci_base_url().'auth/resetpwd/'.$hash;
				$email_templates = $this->ci->config->item('ciauth_email_template');
				$name = ($user['first_name'])?$user['first_name']. ' ' . $user['last_name']:$user['username'];
				$msg = $email_templates['reset_password'];
				$msg = str_replace(
						array('{name}','{reset_link}','{site_name}'),
						array($name,$reset_link, $ci_settings['site_name']),
						$msg
					);
				$this->ci->users->update_user_data($user_data);
				$mail = ci_email($user['email'], 'Reset Password - '.$ci_settings['site_name'],$msg);
				if($mail['status'] == 'success'){
					$this->ci->session->set_flashdata('success', sprintf($this->ci->lang->line('ciauth_reset_password_mail_sent')));
				} else {
					$this->ci->session->set_flashdata('error', $mail['msg']);
				}
				
			} else {
				$this->ci->session->set_flashdata('error', sprintf($this->ci->lang->line('ciauth_login_not_exist'), $loginkey));
			}
		} else {
			$this->ci->session->set_flashdata('error', sprintf($this->ci->lang->line('ciauth_login_not_exist'), $loginkey));
		}
		return $resp;
		
	}
	function is_username_available($username) {
		return $this->ci->users->get_user_by_username($username);
	}

	function is_email_available($email) {
		return $this->ci->users->get_user_by_email($email);
	}

	function is_phone_available($phone) {
		return $this->ci->users->get_user_by_phone($phone);
	}
		
	function register($data) {	
		global $ci_settings;	
		$resp = array();
		$evcode = substr(md5($data['email']),rand(0,10),5);
		$hash = base64_encode($data['email'].'_'.$evcode);
		$role = isset($data['role'])?$data['role']:'customer';
		//print_r($ci_settings['roles_by_name']);
		
		//die;
		$rol_data = isset($ci_settings['roles_by_name'][$role])?$ci_settings['roles_by_name'][$role]:'';
		
		$new_user = array(		
			'username'					=> isset($data['username'])?$data['username']:NULL,
			'first_name'				=> isset($data['first_name'])?$data['first_name']:'',		
			'last_name'					=> isset($data['last_name'])?$data['last_name']:'',					
			'password'					=> md5($data['password']),
			'email'						=> $data['email'],
			'phone'						=> isset($data['phone'])?$data['phone']:'',
			'status' 					=> isset($data['status'])?$data['status']:'pending',
			'signup_ip'					=> $this->ci->input->ip_address(),
			'referral_code' 			=> ci_random_code().substr(md5($data['email']),rand(0,10),5),
			'email_veriication_code' 	=> $evcode,
			'role_id' 					=> $rol_data['id']
			
		);
		if($referral = $this->ci->session->userdata('referral')){
			$new_user['referred_by'] = $referral['ref_code'];
			$this->ci->session->unset_userdata('referral');
		}
		
		$insert = $this->ci->users->create_user($new_user);

		if ($insert) {
			$resp['status'] =  'success';
			if($referral){
				$referral['uid'] = $uid;
				update_referal($referral);
			}	
			
			$verify_link = ci_base_url().'auth/verify-email/'.$hash;
			$email_templates = $this->ci->config->item('ciauth_email_template');
			$name = ($new_user['first_name'])?$new_user['first_name'] . ' ' . $new_user['last_name']:$new_user['username'];
			$msg = $email_templates['verify_email'];
			$msg = str_replace(
					array('{name}','{verify_link}','{site_name}'),
					array($name,$verify_link, $ci_settings['site_name']),
					$msg
				);
			$mail = ci_email($new_user['email'], 'Verify Email - '.$ci_settings['site_name'],$msg);
			if($mail['status'] == 'success'){
				$resp['msg'] = sprintf($this->ci->lang->line('ciauth_register_success'),$ci_settings['site_name']);
			} else {
				$resp['status'] =  'success';
				$resp['msg'] = sprintf($this->ci->lang->line('ciauth_register_success'),$ci_settings['site_name']) . '<br />'.$mail['msg'];
			}
		} else {
			$resp['status'] =  'fail';
			$resp['msg'] = "We are unable to process request. Please contact to site admin";
		}
		return $resp;
	}
	function verify_email($hash = ''){
		$resp = array();
		if($hash){
			$unhash = base64_decode($hash);
			$unhash_arr = array_unique(array_filter(explode("_",$unhash)));
			//print_r($unhash_arr);
			if(count($unhash_arr) == 2){
				$user = $this->ci->users->get_user_by_email($unhash_arr[0]);
				if($user){
					//print_r($user);
					if($unhash_arr[1] == $user['email_veriication_code']){
						$user_data = array(
							'id' => $user['id'],
							'email_veriication_code' => '',
							'status' => 'active',
							'email_verified' => 'yes'
						);
						$this->ci->users->update_user_data($user_data);
						$resp['status'] = 'success';
						$resp['msg'] = "Your email address verified successfully.";
					} else {
						$resp['status'] = 'fail';
						$resp['msg'] = "Verification code doesn't match";
					}
				} else {
					$resp['status'] = 'fail';
					$resp['msg'] = 'Account associated with this verification code is not exists';
				}
			} else {
				$resp['status'] = 'fail';
				$resp['msg'] = 'Invalid verification code';
			}
		} else {
			$resp['status'] = 'fail';
			$resp['msg'] = 'Verification code not found';
		}
		return $resp;
		
	}


	function reset_password($username, $key = '') {
		
	}

	
	function change_password($old_pass, $new_pass) {
		
	}
	
	







	
}
