<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends MX_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('Form_validation');
		$this->load->helper('form');
		$this->load->library('CIAuth');
		if ( ! $this->ciauth->is_logged_in() || !($this->ciauth->is_role('customer'))){
			redirect('/', 'location');
		}
		$this->load->model('Util_model');
		$this->resp = array();
		$this->data = array();

	}
 	public function index(){
		$this->data['entity'] = 'dashboard';
		$this->data['heading'] = 'Customer Dashboard';
		$this->data['icon'] = 'icmn-home2';
		$this->load->view('customer/dashboard', $this->data);
	}
	function email_check($email) {
		$result = $this->ciauth->is_email_available($email);
		if ( ! $result) {
			$this->form_validation->set_message('email_check', 'Email is already used by another user. Please choose another email address.');
		}
				
		return $result;
	}
	function username_check($username) {
		$result = $this->ciauth->is_username_available($username);
		if ( ! $result)
		{
			$this->form_validation->set_message('username_check', 'Username already exist. Please choose another username.');
		}
				
		return $result;
	}
	public function profile(){
		
		if($this->input->post()){
			$val = $this->form_validation;
			// Set form validation rules
			$val->set_rules('first_name', 'First Name', 'trim|required');
			$val->set_rules('last_name', 'Last Name', 'trim|required');
			
			if($this->input->post('email') && $this->input->post('email') != $this->cauth->get_user('email')){
				$val->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
			}
			if($this->input->post('username') && $this->input->post('username') != $this->cauth->get_user('username')){
				$val->set_rules('username', 'Username', 'trim|required|callback_username_check');
			}
			
			if ($val->run()){
				//update users table
				$user_data = array(
					'id' => $this->cauth->get_user_id(),
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
				);
				if($this->input->post('email') != $this->cauth->get_user('email')){ 
					$user_data['email'] = $this->input->post('email');
				}
				if($this->input->post('username') != $this->cauth->get_user('username')){
					$user_data['username'] = $this->input->post('username');
				}
				$this->Util_model->update('users',$user_data);
				
				//update customer_profile table
				$user_profile_data = $this->input->post('profile');
				if(!isset($user_profile_data['uid']) || $user_profile_data['uid']){
					$user_profile_data['uid']  = $this->ciauth->get_user();
				}
				$this->Util_model->update('customer_profile',$user_profile_data,'uid');
				
				$user = $this->Util_model->read('users',array('id'=>$user_data['id']));
				if($user){
					$user = $user[0];
					$user = $user;
					$this->ciauth->_set_session($user);
					$this->data['status'] = 'success';
					$this->data['msg']= 'Profile updated successfully';
				} else {
					$this->data['status'] = 'fail';
					$this->data['msg'] = 'There is some problem to process request';
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
			$this->data['entity'] = 'profile';
			$this->data['heading'] = 'Profile';
			$this->load->view('customer/profile', $this->data);
		}
	}
	
	public function change_password(){
		
		if($this->input->post()){
			$val = $this->form_validation;
			// Set form validation rules
			$val->set_rules('old_password', 'Old Password', 'trim|required|callback_password_check');
			$val->set_rules('password', 'Password', 'trim|required|min_length['.$ci_settings['min_password_length'].']|max_length['.$ci_settings['max_password_length'].']|matches[confirm_password]');
			$val->set_rules('confirm_password', 'Confirm Password', 'trim|required');
			
			
			if ($val->run()){
				//update users table
				$user_data = array(
					'id' => $this->cauth->get_user_id(),
					'password' => md5($this->input->post('password'))
				);
				
				$rs = $this->Util_model->update('users',$user_data);
				
				if($rs){
					$this->data['status'] = 'success';
					$this->data['msg']= 'Password updated successfully';
				} else {
					$this->data['status'] = 'fail';
					$this->data['msg'] = 'There is some problem to process request';
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
			$this->data['entity'] = 'profile';
			$this->data['heading'] = 'Profile';
			$this->load->view('customer/chage_password', $this->data);
		}
	}
	
}
