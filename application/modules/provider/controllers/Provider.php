<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Provider extends MX_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('Form_validation');
		$this->load->helper('form');
		$this->load->library('CIAuth');
		if ( ! $this->ciauth->is_logged_in() || !($this->ciauth->is_role('provider'))){
			redirect('/', 'location');
		}
		$this->load->model('Util_model');
		$this->resp = array();
		$this->data = array();

	}
 	public function index(){
		$this->data['entity'] = 'dashboard';
		$this->data['heading'] = 'Provider Dashboard';
		$this->data['icon'] = 'icmn-home2';
		$this->load->view('provider/dashboard', $this->data);
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
		$this->data['entity'] = 'profile';
		$this->data['heading'] = 'Profile';
		$val = $this->form_validation;
		// Set form validation rules
		$val->set_rules('first_name', 'First Name', 'trim|required');
		$val->set_rules('last_name', 'Last Name', 'trim|required');
		
		if($this->input->post('email') && $this->input->post('email') != $this->dx_auth->get_user('email')){
			$val->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
		}
		if($this->input->post('username') && $this->input->post('username') != $this->dx_auth->get_user('username')){
			$val->set_rules('username', 'Username', 'trim|required|callback_username_check');
		}
		if ($val->run()){
			$user_data = array(
				'id' => $this->dx_auth->get_user_id(),
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
			);
			if($this->input->post('email') != $this->dx_auth->get_user('email')){ 
				$user_data['email'] = $this->input->post('email');
			}
			if($this->input->post('username') != $this->dx_auth->get_user('username')){
				$user_data['username'] = $this->input->post('username');
			}
			$this->Util_model->update('users',$user_data);
			$user = $this->Util_model->read('users',array('id'=>$user_data['id']));
			if($user){
				$user = $user[0];
				$user = (object) $user;
				$this->dx_auth->_set_session($user);
				$this->data['success'] = 'Profile updated successfully';
			} else {
				$this->data['error'] = 'There is some problem to process request';
			}
		}
		$this->load->view('customer/profile', $this->data);
	}
}
