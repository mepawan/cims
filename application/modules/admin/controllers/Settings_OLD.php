<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('Form_validation');
		$this->load->helper('form');
		$this->load->library('CIAuth');
		if ( ! $this->ciauth->is_logged_in() || !($this->ciauth->is_admin() || $this->ciauth->is_superadmin())){
			redirect('admin/auth', 'location');
		}
		$this->load->model('Util_model' ,'util');
		$this->resp = array();
		$this->data = array();
	}
	public function index() {
		$this->data['entity'] = 'settings';
		$this->data['heading'] = 'Manage Settings';
		$this->data['icon'] = 'icmn-cogs';
		$this->data['settings'] = $this->Util_model->read('settings');
		
		$this->load->view('settings/index',$this->data);
	}
	public function process_ajax(){
		$postdata = $_POST;
		//$this->resp = $this->pvngen->db_action($postdata);
		echo json_encode($this->resp);
		die;
		
	}
	public function save(){
		$postdata = $_POST;

		if(isset($_FILES['logo']) && $_FILES['logo']['name'] && $_FILES['logo']['error'] == UPLOAD_ERR_OK){
			if(file_exists(FCPATH.'public/upload/images/logo.png')){
				unlink(FCPATH.'public/upload/images/logo.png');
			}
			move_uploaded_file($_FILES['logo']['tmp_name'],FCPATH.'public/upload/images/logo.png');
		}
		if(isset($_FILES['logo2']) && $_FILES['logo2']['name'] && $_FILES['logo2']['error'] == UPLOAD_ERR_OK){
			if(file_exists(FCPATH.'public/upload/images/logo2.png')){
				unlink(FCPATH.'public/upload/images/logo2.png');
			}
			move_uploaded_file($_FILES['logo2']['tmp_name'],FCPATH.'public/upload/images/logo2.png');
		}
		if(isset($_FILES['favicon']) && $_FILES['favicon']['name'] && $_FILES['favicon']['error'] == UPLOAD_ERR_OK){
			if(file_exists(FCPATH.'public/upload/images/favicon.png')){
				unlink(FCPATH.'public/upload/images/favicon.png');
			}
			move_uploaded_file($_FILES['favicon']['tmp_name'],FCPATH.'public/upload/images/favicon.png');
		}

		foreach($postdata as $field => $value){
			$this->util->update('settings',array('meta_key'));
		}
		if($rs){
			$this->resp['status'] = 'success';
			$this->resp['msg'] = 'Data saved successfully';
		} else {
			$this->resp['status'] = 'fail';
			$this->resp['msg'] = 'Unable to process request. Please contact to admin';
		}
		if($this->input->is_ajax_request()){
			echo json_encode($this->resp);
			die;
		} else {
			redirect('admin/settings');
		}
		
	}
	public function listdt(){
		$filter = array_merge($_GET, $_POST);
		$resp = $this->pvngen->get_dt($filter);
		echo json_encode($resp);
		die;
	}
	private function load_config(){
		$entity_config = array(
							'entity' => 'settings',
							'table' => 'settings',
							'icon' => 'fa-geer',
							'label' => 'Settings',
							'heading' => 'Settings', 
							'fields' => array(
										
									),
						);
		//$this->pvngen->init($entity_config);
		return $entity_config;
	}
}
