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

	public function create_contract($catid = '', $subcatid = ''){
		$this->data['entity'] = 'contract';
		$this->data['heading'] = 'Create Contract';
		$this->data['icon'] = 'icmn-home2';
		
		if($this->input->post()){
				$contract_data = array(
					'area_of_experience' => $this->input->post('area_of_experience'),
					'years_of_experience' => $this->input->post('years_of_experience'),
					'category' => $this->input->post('category'),
					'title' => $this->input->post('title'),
				);
				$contract = $this->Util_model->create('contract',$contract_data);
				redirect('customer/contracts');
				
		} else {
			$step = 1;
			if($catid){
				$this->data['categories'] = $this->Util_model->read('category', array('where' => array('parent'=>$catid)));
				$parent =  $this->Util_model->read('category', array('where' => array('id'=>$catid)));
				$this->data['parent'] = ($parent)?$parent[0]:'';
				if($this->data['categories']){
					$step = 2;
				}  else {
					$step = 3;
				}
			} else {
				$this->data['categories'] = $this->Util_model->read('category', array('where' => array('parent'=>0)));
			}
			if($subcatid){
				$category = $this->Util_model->read('category', array('where' => array('id'=>$subcatid)));
				$this->data['sub_category'] = ($category)?$category[0]:'';
				$step = 3;
			}
			$this->data['step'] = $step;
			$this->load->view('customer/create_contract', $this->data);
		}
	}

	public function contracts($id = ''){
		$this->data['entity'] = 'contracts';
		
		$this->data['icon'] = 'icmn-home2';
		if($id){
			$contract = $this->Util_model->read('contract', array('where' => array('id'=> $id)) );
			$this->data['contract']  = ($contract)?$contract[0]:'';
			
			$provider_sql = "select u.*, pf.* from users u left join provider_profile pf on (u.id=pf.uid) where area_of_experience like '*%".$this->data['contract']['area_of_experience']."%*'";
			$providers = $this->Util_model->custom_query($provider_sql);
			$this->data['providers']  = $providers;
			$this->data['heading'] = ($this->data['contract'])?$this->data['contract']['title'] : "Not Found";
			$this->load->view('customer/contract_detail', $this->data);
		}
		else{
			$this->data['heading'] = 'All Contracts';
			$this->data['contracts'] = $this->Util_model->read('contract');
			$this->load->view('customer/all_contracts', $this->data);
		}
		
	}
	public function preferences(){
			$this->data['entity'] = 'preferences';
			$this->data['heading'] = 'Preferences';
			$this->data['icon'] = 'icmn-home2';
			$prefs_raw = $this->Util_model->read('user_perferences',array('where' => array('uid' => $this->ciauth->get_user_id())));
			$prefs = array();
			array_walk($prefs_raw, function($prf) use(&$prefs){
				$prefs[$prf['preference_key']] = $prf['preference_value'];
			});
			 $this->data['preferences'] = $prefs;
			$this->load->view('customer/preferences', $this->data);
	}
	
	public function save_prefs(){
			$uid = $this->ciauth->get_user_id();
			$key = $this->input->post('key');
			$val = $this->input->post('val');
			$sql = 'INSERT INTO user_perferences (uid,preference_key,preference_value) VALUES ("'.$uid.'", "'.$key.'", "'.$val.'") ON DUPLICATE KEY  UPDATE preference_value="'.$val.'";';
			$this->Util_model->custom_query($sql,false);
			
			
			echo json_encode(array('status' => 'success'));
			die;
			
	}
	
	
}
