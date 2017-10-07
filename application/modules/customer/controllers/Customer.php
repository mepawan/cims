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
		$this->data['heading'] = 'Welcome, ' . $this->ciauth->get_user('first_name');
		$this->data['icon'] = 'icmn-home2';
		$this->data['user'] = $this->ciauth->get_user();
		$customer_profile = $this->Util_model->read('customer_profile',array('where' => array('uid'=>$this->ciauth->get_user_id())));
		$this->data['profile'] = ($customer_profile)?$customer_profile[0]:'';
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
	function setting(){
		$this->data['entity'] = 'setting';
		$this->data['heading'] = 'Setting';
		$user = $this->Util_model->read('users',array('where' => array('id' => $this->ciauth->get_user_id())));
		$user = $user[0];
		$this->data['user'] = $user;
		$this->data['countries'] = $this->Util_model->read('country');
		$this->load->view('customer/setting', $this->data);
		
	}
	function save_setting(){
		
		$post_data = $this->input->post();
		
		print_r($post_data);
		die;
	}
	public function profile(){
		//$uid = $this->ciauth->get_user();
		//echo "<pre>"; print_r($uid); die;
		if($this->input->post()){
				
				
			$val = $this->form_validation;
			// Set form validation rules
			$val->set_rules('first_name', 'First Name', 'trim|required');
			$val->set_rules('last_name', 'Last Name', 'trim|required');
			//$val->set_rules('bio', 'Bio', 'trim|required');
			//$val->set_rules('address', 'Address', 'trim|required');
			//$val->set_rules('city', 'City', 'trim|required');
			//$val->set_rules('state', 'State', 'trim|required');
			//$val->set_rules('zipcode', 'Zipcode', 'trim|required');
			//$val->set_rules('country', 'Country', 'trim|required');
			//$val->set_rules('phone', 'Phone', 'trim|required');
				
			if($this->input->post('email') && $this->input->post('email') != $this->ciauth->get_user('email')){
				$val->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
			}
			if($this->input->post('username') && $this->input->post('username') != $this->ciauth->get_user('username')){
				$val->set_rules('username', 'Username', 'trim|required|callback_username_check');
			}
			
			if ($val->run()){
				//update users table
				$user_data = array(
					'id' => $this->ciauth->get_user_id(),
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'bio' => $this->input->post('bio'),
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'state' => $this->input->post('state'),
					'zipcode' => $this->input->post('zipcode'),
					'country' => $this->input->post('country'),
					'phone' => $this->input->post('phone'),
				);
				if($this->input->post('email') != $this->ciauth->get_user('email')){ 
					$user_data['email'] = $this->input->post('email');
				}
				if($this->input->post('username') != $this->ciauth->get_user('username')){
					$user_data['username'] = $this->input->post('username');
				}

				$this->Util_model->update('users',$user_data);
				
				//update customer_profile table
				/*
				$user_profile_data = $this->input->post('profile');
				if(!isset($user_profile_data['uid']) || $user_profile_data['uid']){
					$user_profile_data['uid']  = $this->ciauth->get_user_id();
				}
				$customer_profile = $this->Util_model->read('customer_profile',array('where' => array('uid'=>$user_data['id'])));
				if(!empty($customer_profile)){
					$this->Util_model->update('customer_profile',$user_profile_data,'uid');
				}
				else{
					$this->Util_model->create('customer_profile',$user_profile_data);
				}
				*/
				$user = $this->Util_model->read('users',array('where' => array('id'=>$user_data['id'])));

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
			$this->data['user'] = $this->ciauth->get_user();
			$this->data['add_recaptcha_js'] = true;
			$provider_profile = $this->Util_model->read('customer_profile',array('where' => array('uid'=>$this->ciauth->get_user_id())));
			
			$this->data['profile'] = ($provider_profile)?$provider_profile[0]:'';
			$this->data['countries'] = $this->Util_model->read('country');
			$this->load->view('customer/profile', $this->data);
		}
	}
	public function payment(){
		if($this->input->post()){
			$val = $this->form_validation;
			// Set form validation rules
			$val->set_rules('card_number', 'Card Number', 'trim|required');
			$val->set_rules('exp_date', 'Expiry Date', 'trim|required');
			$val->set_rules('name_on_card', 'Name on card', 'trim|required');
			$val->set_rules('card_type', 'Card Type', 'trim|required');
			
			if ($val->run()){
				//update users table
				
				$card_data = array(
					'uid' => $this->ciauth->get_user_id(),
					'card_number' => $this->input->post('card_number'),
					'exp_date' => $this->input->post('exp_date'),
					'name_on_card' => $this->input->post('name_on_card'),
					'card_type' => $this->input->post('card_type'),
				);
				

				$card = $this->Util_model->create('payment_cards',$card_data);
				

				if($card){
					$this->data['status'] = 'success';
					$this->data['msg']= 'Card Added successfully';
				} else {
					$this->data['status'] = 'fail';
					$this->data['msg'] = 'There is some problem to process request';
				}
			}
			
		}
		
		$this->data['cards'] = $this->Util_model->read('payment_cards',array('where' => array('uid'=>$this->ciauth->get_user_id())));
		$this->data['entity'] = 'Payment';
		$this->data['heading'] = 'Customer Payment';
		$this->data['submit_text'] = 'Add';
		$this->data['icon'] = 'icmn-home2';
		$this->load->view('customer/card', $this->data);
	}
	
	public function card_edit(){
		$id = $_GET['id'];
		if($this->input->post()){
			$val = $this->form_validation;
			// Set form validation rules
			$val->set_rules('card_number', 'Card Number', 'trim|required');
			$val->set_rules('exp_date', 'Expiry Date', 'trim|required');
			$val->set_rules('name_on_card', 'Name on card', 'trim|required');
			$val->set_rules('card_type', 'Card Type', 'trim|required');
			
			if ($val->run()){
				$card_data = array(
					'uid' => $this->ciauth->get_user_id(),
					'card_number' => $this->input->post('card_number'),
					'exp_date' => $this->input->post('exp_date'),
					'name_on_card' => $this->input->post('name_on_card'),
					'card_type' => $this->input->post('card_type'),
				);
				
				$card_data['id']  = $id;
				$card = $this->Util_model->update('payment_cards',$card_data);
				if($card){
					redirect('customer/payment');
				} else {
					$this->data['status'] = 'fail';
					$this->data['msg'] = 'There is some problem to process request';
				}
			}
		}
		
		
		$id = $_GET['id'];
		$card_details = $this->Util_model->read('payment_cards',array('where' => array('id'=>$id)));
		$this->data['card'] = $card_details[0];
		$this->data['entity'] = 'Card Edit';
		$this->data['heading'] = 'Card Edit';
		$this->data['submit_text'] = 'Edit';
		$this->data['icon'] = 'icmn-home2';
		$this->load->view('customer/card', $this->data);
	}

	public function card_remove(){
		if($this->input->post()){
			
			$this->Util_model->delete('payment_cards',$this->input->post('id'));
			redirect('customer/payment');
			
		}
		$this->data['entity'] = 'remove';
		$this->data['id'] = $_GET['id'];
		$this->data['heading'] = 'Card Remove';
		$this->data['icon'] = 'icmn-home2';
		$this->load->view('customer/card_remove', $this->data);
	}
	public function create_contract(){
		$this->data['entity'] = 'contract';
		$this->data['heading'] = 'Create Contract';
		$this->data['icon'] = 'icmn-home2';
		$this->load->view('customer/create_contract', $this->data);
	}
	
	
}
