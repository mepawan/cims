<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Messages extends MX_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('Form_validation');
		$this->load->helper('form');
		$this->load->library('CIAuth');
		if ( ! $this->ciauth->is_logged_in() || !($this->ciauth->is_role('provider'))){
			redirect('/', 'location');
		}
		$this->load->model('Util_model');
		$this->data = array();

	}
 	public function index(){
		$this->data['entity'] = 'messages';
		$this->data['heading'] = 'Conversations ';
		$this->data['icon'] = 'icmn-home2';
		$conv_sql = "SELECT c.*, u.first_name,u.last_name FROM conversation c LEFT JOIN users u ON(c.uid1=u.id) WHERE uid2=".$this->ciauth->get_user_id();
		$conversation = $this->Util_model->custom_query($conv_sql);
		$this->data['conversation'] = $conversation;
		$this->load->view('messages/index', $this->data);
	}
	public function accept($convid){
		$this->Util_model->update('conversation',array('id' => $convid, 'status' => 'active'));
		redirect('provider/messages');
		die;
	}
	public function deny($convid){
		$this->Util_model->update('conversation',array('id' => $convid, 'status' => 'rejected'));
		redirect('provider/messages');
		die;
	}
}