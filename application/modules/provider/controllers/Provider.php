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
		//$uid = $this->ciauth->get_user();
		//echo "<pre>"; print_r($uid); die;
		if($this->input->post()){
							
				//~ $config1['upload_path'] = 'public/upload/';
				//~ $config1['allowed_types'] = 'pdf|xls|csv';
				//~ $new_name = "resume_".$this->ciauth->get_user_id();
				//~ $config1['file_name'] = $new_name;
				//~ $this->load->library('upload', $config1);
								
				//~ if ( ! $this->upload->do_upload('resume'))
                //~ {
                        //~ $error = array('error' => $this->upload->display_errors());
						//~ print_r($error); die;
                //~ }
                //~ else
                //~ {
                        //~ $data = array('upload_data' => $this->upload->data());
						//~ print_r($data); 
                //~ }
				
				//~ $this->upload->initialize($config1);
			
			
				//~ $config2['upload_path'] = 'public/upload/';
				//~ $config2['allowed_types'] = 'gif|jpg|png|jpeg';
				//~ $new_name = "pictureswork_".$this->ciauth->get_user_id();
				//~ $config2['file_name'] = $new_name;
				//~ $this->load->library('upload', $config2);
								
				//~ if ( ! $this->upload->do_upload('pictures_of_work'))
                //~ {
                        //~ $error = array('error' => $this->upload->display_errors());
						//~ print_r($error); die;
                //~ }
                //~ else
                //~ {
                        //~ $data = array('upload_data' => $this->upload->data());
						//~ print_r($data); die;
                //~ }
				
				//~ $this->upload->initialize($config2);
			
			
				
			$val = $this->form_validation;
			// Set form validation rules
			$val->set_rules('first_name', 'First Name', 'trim|required');
			$val->set_rules('last_name', 'Last Name', 'trim|required');
			$val->set_rules('bio', 'Bio', 'trim|required');
			$val->set_rules('address', 'Address', 'trim|required');
			$val->set_rules('city', 'City', 'trim|required');
			$val->set_rules('state', 'State', 'trim|required');
			$val->set_rules('zipcode', 'Zipcode', 'trim|required');
			$val->set_rules('country', 'Country', 'trim|required');
			$val->set_rules('phone', 'Phone', 'trim|required');
				
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
				
				$config['upload_path'] = 'public/upload/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$new_name = "profilepic_".$this->ciauth->get_user_id();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
								
				if ( ! $this->upload->do_upload('profile_pic'))
                {
                        $error = array('error' => $this->upload->display_errors());
						//print_r($error); die;
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        $user_data['profile_pic'] = $data['upload_data']['file_name'];
                }
				
				$this->upload->initialize($config);
				
				
				$this->Util_model->update('users',$user_data);
				
				//update customer_profile table
				$user_profile_data = $this->input->post('profile');
				$languages = implode(',', $user_profile_data['languages']);
				$area_of_experience = implode(',', $user_profile_data['area_of_experience']);
				$availabe_days_time = implode(',', $user_profile_data['availabe_days_time']);
				$video_calling_feature = implode(',', $user_profile_data['video_calling_feature']);
				$user_profile_data['languages']  = $languages;
				$user_profile_data['area_of_experience']  = $area_of_experience;
				$user_profile_data['availabe_days_time']  = $availabe_days_time;
				$user_profile_data['video_calling_feature']  = $video_calling_feature;
				
				
				if(!isset($user_profile_data['uid']) || $user_profile_data['uid']){
					$user_profile_data['uid']  = $this->ciauth->get_user_id();
				}
				
				$provider_profile = $this->Util_model->read('provider_profile',array('where' => array('uid'=>$user_data['id'])));
				
				
				if(!empty($provider_profile)){
					$this->Util_model->update('provider_profile',$user_profile_data,'uid');
				}
				else{
					$this->Util_model->create('provider_profile',$user_profile_data);
				}
				
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
			$provider_profile = $this->Util_model->read('provider_profile',array('where' => array('uid'=>$this->ciauth->get_user_id())));
			
				$this->data['profile'] = ($provider_profile)?$provider_profile[0]:'';
			
			$this->load->view('provider/profile', $this->data);
		}
	}
	
}
