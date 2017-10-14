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
		$this->data['heading'] = 'Welcome, ' . $this->ciauth->get_user('first_name');
		$this->data['icon'] = 'icmn-home2';
		$this->data['user'] = $this->ciauth->get_user();
		$customer_profile = $this->Util_model->read('provider_profile',array('where' => array('uid'=>$this->ciauth->get_user_id())));
		$this->data['profile'] = ($customer_profile)?$customer_profile[0]:'';
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
	function setting(){
		$this->data['entity'] = 'setting';
		$this->data['heading'] = 'Setting';
		$user = $this->Util_model->read('users',array('where' => array('id' => $this->ciauth->get_user_id())));
		$user = $user[0];
		$this->data['user'] = $user;
		$this->data['countries'] = $this->Util_model->read('country');
		$user_profile = $this->Util_model->read('provider_profile',array('where'=>array('uid' => $this->ciauth->get_user_id())));
		$this->data['user_profile'] = ($user_profile)?$user_profile[0]:array();
		$this->load->view('provider/setting', $this->data);
		
	}
	function save_setting(){
		global $ci_settings;
		$post_data = $this->input->post();
		$update_data = $post_data;
		$update_data['id'] = $this->ciauth->get_user_id();
		$val = $this->form_validation;
		$validate = false;
		if(isset($post_data['first_name'])){
			$val->set_rules('first_name', 'First Name', 'trim|required');
		}
		if(isset($post_data['last_name'])){
			$val->set_rules('last_name', 'Last Name', 'trim|required');
			$validate = true;
		}
		if(isset($post_data['email']) && $post_data['email'] != $this->ciauth->get_user('email') ){
			$val->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
			$validate = true;
		} else {
			unset($update_data['email']);
		}
		if(isset($post_data['username']) && $post_data['username'] != $this->ciauth->get_user('username') ){
			$val->set_rules('username', 'Username', 'trim|required|callback_username_check');
			$validate = true;
		} else {
			unset($update_data['username']);
		}
		
		if(isset($post_data['password'])){
			$val->set_rules('password', 'Password', 'trim|required|min_length['.$ci_settings['min_password_length'].']|max_length['.$ci_settings['max_password_length'].']|matches[confirm_password]');
			$val->set_rules('confirm_password', 'Confirm Password', 'trim|required');
			$validate = true;
			
		}
		
		$profile_post = $this->input->post('profile');
		if($profile_post){
			$profile_post['languages'] = ($profile_post['languages'])?implode(",",$profile_post['languages']):'';
			$profile_post['area_of_experience'] = ($profile_post['area_of_experience'])?implode(",",$profile_post['area_of_experience']):'';
			$profile_post['availabe_days_time'] = ($profile_post['availabe_days_time'])?implode(",",$profile_post['availabe_days_time']):'';
			//$profile_post['video_calling_feature'] = ($profile_post['video_calling_feature'])?implode(",",$profile_post['video_calling_feature']):'';
			unset($update_data);
		}
		
		if (!$validate || $val->run()){
			if($update_data && count($update_data) > 0){
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
			} else if($profile_post && count($profile_post) > 0){
				
				$user_profile = $this->Util_model->read('provider_profile',array('where'=>array('uid' => $this->ciauth->get_user_id())));
				if($user_profile){
					$profile_post['uid'] = $this->ciauth->get_user_id();
					$this->Util_model->update('provider_profile',$profile_post,'uid');
				} else {
					$this->Util_model->create('provider_profile',$profile_post);
				}
				$this->data['status'] = 'success';
				$this->data['msg']= 'Profile updated successfully';
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
			$this->load->view('provider/preferences', $this->data);
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