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
		
		if($this->input->post()){
			
					
			$val = $this->form_validation;
			// Set form validation rules
			$val->set_rules('first_name', 'First Name', 'trim|required');
			$val->set_rules('last_name', 'Last Name', 'trim|required');
			$val->set_rules('bio', 'Bio', 'trim|required');
			$val->set_rules('status', 'status', 'trim|required');
			$val->set_rules('profile_pic', 'Profile Photo', 'trim|required');
			$val->set_rules('address', 'Address', 'trim|required');
			$val->set_rules('city', 'City', 'trim|required');
			$val->set_rules('state', 'State', 'trim|required');
			$val->set_rules('zipcode', 'Zipcode', 'trim|required');
			$val->set_rules('country', 'Country', 'trim|required');
			$val->set_rules('phone', 'Phone', 'trim|required');
			$val->set_rules('created_date_time', 'Date Registered', 'trim|required');
			
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
					'bio' => $this->input->post('bio'),
					'status' => $this->input->post('status'),
					'profile_pic' => $this->input->post('profile_pic'),
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'state' => $this->input->post('state'),
					'zipcode' => $this->input->post('zipcode'),
					'country' => $this->input->post('country'),
					'phone' => $this->input->post('phone'),
					'created_date_time' => $this->input->post('created_date_time'),
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
				$this->Util_model->update('provider_profile',$user_profile_data,'uid');
				
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
			$this->load->view('provider/profile', $this->data);
		}
	}
	
}
