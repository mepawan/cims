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
		$this->data['user_cards'] = $this->Util_model->read('payment_cards',array('where'=>array('uid' => $this->ciauth->get_user_id())));
		$this->load->view('customer/setting', $this->data);
		
	}
	function save_setting(){
		global $ci_settings;
		$post_data = $this->input->post();
		
		$update_data = $post_data;
		$update_data['id'] = $this->ciauth->get_user_id();
		$val = $this->form_validation;
		if(isset($post_data['first_name'])){
			$val->set_rules('first_name', 'First Name', 'trim|required');
		}
		if(isset($post_data['last_name'])){
			$val->set_rules('last_name', 'Last Name', 'trim|required');
		}
		if(isset($post_data['email']) && $post_data['email'] != $this->ciauth->get_user('email') ){
			$val->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
		} else {
			unset($update_data['email']);
		}
		if(isset($post_data['username']) && $post_data['username'] != $this->ciauth->get_user('username') ){
			$val->set_rules('username', 'Username', 'trim|required|callback_username_check');
		} else {
			unset($update_data['username']);
		}
		
		if(isset($post_data['password'])){
			$val->set_rules('password', 'Password', 'trim|required|min_length['.$ci_settings['min_password_length'].']|max_length['.$ci_settings['max_password_length'].']|matches[confirm_password]');
			$val->set_rules('confirm_password', 'Confirm Password', 'trim|required');
			
		}
		
		if(isset($post_data['address'])){
			$val->set_rules('address', 'Address', 'trim|required');
		}
		
		
		if ($val->run()){
			$this->Util_model->update('users',$update_data);
			$user = $this->Util_model->read('users',array('where' => array('id'=>$update_data['id'])));
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
		if(is_ajax()){
			echo json_encode($this->data);
			die;
		}
		
		die;
	}
	public function save_card(){
		
		$val = $this->form_validation;
		$val->set_rules('number', 'Number', 'trim|required|numeric');
		$val->set_rules('exp_month', 'Expiry Month', 'trim|required|numeric');
		$val->set_rules('exp_year', 'Expiry Year', 'trim|required|numeric');
		$val->set_rules('name', "Card Holder's Name", 'trim|required');
		
		if ($val->run()){
			$post_data = $this->input->post();
			$update_data = array(
				'uid' => $this->ciauth->get_user_id(),
				'number' => $post_data['number'],
				'type' => $post_data['type'],
				'exp' => $post_data['exp_month'].'/'.$post_data['exp_year'],
				'name' => $post_data['name'],
			);
			
			if(isset($post_data['id']) && $post_data['id']){
				$update_data['id'] = $post_data['id'];
				$this->Util_model->update('payment_cards',$update_data);
				$this->data['msg']= 'Card info updated successfully';
			} else {
				$this->Util_model->create('payment_cards',$update_data);
				$this->data['msg']= 'Card added successfully';
			}
			$this->data['status'] = 'success';
			$this->data['card'] = $update_data;
		} else {
			$this->data['status'] = 'fail';
			$this->data['form_errors'] = $this->form_validation->error_array();
		}
		if(is_ajax()){
			echo json_encode($this->data);
			die;
		}
		
	}
	public function delete_card(){
		$id = $this->input->post('id');
		if($id){
			$this->Util_model->delete('payment_cards',array('id' => $id));
			$this->data['status'] = 'success';
			$this->data['msg'] = 'Card removed successfully';
		} else {
			$this->data['status'] = 'fail';
			$this->data['msg'] = 'Card id not found';
		}
		if(is_ajax()){
			echo json_encode($this->data);
			die;
		}
	}

	public function create_contract(){
		$this->data['entity'] = 'contract';
		$this->data['heading'] = 'Create Contract';
		$this->data['icon'] = 'icmn-home2';
		$this->data['category'] = $this->Util_model->read('category', array('where' => array('parent'=>'0')));
		$this->load->view('customer/create_contract', $this->data);
	}
	public function subcategory(){
		$parent = array('where' => array('parent'=>$_GET['id']));
		
		$this->data['entity'] = 'contract';
		$this->data['heading'] = 'Create Contract';
		$this->data['icon'] = 'icmn-home2';
		$this->data['category'] = $this->Util_model->read('category',$parent);
		$this->data['parent'] = $this->Util_model->read('category',array('where' => array('id'=>$_GET['id'])));
		
		if(empty($this->data['category'])){
			redirect('/customer/contract?id='.$_GET['id'].'');
		}
		
		$this->load->view('customer/subcategory', $this->data);
	}
	public function contract(){
		if($this->input->post()){
				
				$category = $this->Util_model->read('category', array('where' => array('id'=> $_GET['id'])));
				if(isset($_GET['parent'])){
					$parent = $this->Util_model->read('category', array('where' => array('id'=> $_GET['parent'])));
				}
				//echo "<pre>"; print_r($parent); die;
				
				$contract_data = array(
					'area_of_experience' => $this->input->post('area_of_experience'),
					'years_of_experience' => $this->input->post('years_of_experience'),
					'category' => $category[0]['title'],
					'sub-categeory' => $parent[0]['title']?$parent[0]['title']:'',
				);
				
				
				$contract = $this->Util_model->create('contract',$contract_data);
				

				if($contract){
					$this->data['status'] = 'success';
					$this->data['msg'] = 'Contract Added successfully';
				} else {
					$this->data['status'] = 'fail';
					$this->data['msg'] = 'There is some problem to process request';
				}
			
			
		}
		
		$this->data['entity'] = 'contract';
		$this->data['heading'] = 'Contract';
		$this->data['submit_text'] = 'Save';
		$this->data['icon'] = 'icmn-home2';
		$this->load->view('customer/contract', $this->data);
	}
	public function contracts(){
		if(isset($_GET['area_exp'])){
			$this->data['entity'] = 'contracts';
			$provider = $this->Util_model->read('provider_profile', array('like' => array('area_of_experience'=> $_GET['area_exp']), 'limit' => '5') );
			$this->data['provider']  = $provider;
			$users = array();
			foreach($provider as $provider){
				$users[]  = $this->Util_model->read('users', array('where' => array('id'=> $provider['uid'])) );
			}
			$this->data['users']  = $users;
			$this->data['contracts'] = $this->Util_model->read('contract',  array('where' => array('id'=> $_GET['id'])));
			$this->load->view('customer/all_contracts', $this->data);
		}
		else{
			$this->data['entity'] = 'contracts';
			$this->data['heading'] = 'All Contracts';
			$this->data['icon'] = 'icmn-home2';
			$this->data['contracts'] = $this->Util_model->read('contract');
			$this->load->view('customer/all_contracts', $this->data);
		}
	}
	public function email_pref(){
			$this->data['entity'] = 'email_pref';
			$this->data['heading'] = 'Email Preferences';
			$this->data['icon'] = 'icmn-home2';
			$this->data['contracts'] = $this->Util_model->read('contract');
			$this->load->view('customer/email_pref', $this->data);
	}
	
	
}
