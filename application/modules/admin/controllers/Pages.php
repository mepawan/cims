<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('Form_validation');
		$this->load->helper('form');
		$this->load->helper('general_helper');
		$this->load->library('CIAuth');
		if ( ! $this->ciauth->is_logged_in() || !($this->ciauth->is_admin() || $this->ciauth->is_superadmin())){
			redirect('admin/auth', 'location');
		}
		$this->load->model('Util_model');
		$this->resp = array();
		$this->data = array();
	}
	public function index() {
		$this->data['entity'] = 'pages';
		$this->data['heading'] = 'Manage Pages';
		$this->data['icon'] = 'icmn-file-text';
		$this->data['datatable'] = true;
		$this->load->view('pages/index',$this->data);
	}
	function pagesdt(){
		$filters = array_merge($_GET, $_POST);
		$filters['table'] = 'pages';
		$filters['joins'][] = array('table' => 'users','alias' => 'u', 'on' => 'tbl.author=u.id');
		//$filters['joins'][] = array('table' => 'ads','alias' => 'ad', 'on' => 'ac.ad_id=ad.id');
		$filters['aSelectionColumns'] = array('concat(tbl.title,"___",tbl.id, "___", tbl.alias) as title','concat(u.first_name, " ", u.last_name) as author','tbl.status','concat(tbl.created_date_time, "___", tbl.publish_date_time, "___",tbl.updated_date_time) as dates');
		$filters['aColumns'] = array('title','author','status','dates');
		$filters['custom_search_filter'] = array(
					//'where' => array('tbl.uid' => $this->ciauth->get_user_id())
			);
		
		$output = $this->Util_model->get_data_for_dt($filters);
		echo json_encode($output);
		die;
		
		
	}
	public function add(){
        $this->data['entity'] = 'pages';
        $this->data['heading'] = 'Add New Page';
        $this->data['icon'] = 'icmn-file-text';
		$this->data['head_views'] = array('part/grapescss');
		$this->data['foot_views'] = array('part/grapesjs');
		
		
        $this->load->view('pages/add',$this->data);
    }
	public function save(){
		
		if(isset($_POST['title'])){
			$userid = $this->ciauth->get_user_id();
			
			$alias = title_alias('pages', $_POST['title']);
			
			$data = array(
						'title' => $_POST['title'],
						'alias' => $alias,
						'content' => $_POST['html'],
						'content_css' => $_POST['css'],
						'author' => $userid
						);
			
			$rs = $this->Util_model->create('pages', $data);
			
			redirect('admin/pages');
		}
		
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
		
		
		if(isset($postdata['id']) && $postdata['id']){
			$rs = $this->Util_model->update('settings',$postdata);
		} else {
			$rs = $this->Util_model->create('settings',$postdata);
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
			//redirect('admin/settings');
		}
	}
	public function edit($id = "null"){
		
        $this->data['entity'] = 'pages';
        $this->data['heading'] = 'Edit';
        $this->data['icon'] = 'icmn-file-text';
        $this->data['head_views'] = array('part/grapescss');
		$this->data['foot_views'] = array('part/grapesjs');
		
		if(is_numeric($id)){
			$where = array( 'id' => $id);
			$this->data['page'] = $this->Util_model->read('pages', array( 'where' => $where));
		}
		else{
			$where = array( 'alias' => $id);
			$this->data['page'] = $this->Util_model->read('pages', array( 'where' => $where));
		
		}
				
        $this->load->view('pages/edit',$this->data);
    }
    public function update(){
		
		//if(isset($_POST['title'])){
			$userid = $this->ciauth->get_user_id();
			
			$alias = title_alias('pages', $_POST['title']);
			
			$data = array(
						'id' => $_POST['id'],
						'title' => $_POST['title'],
						'content' => $_POST['html'],
						'content_css' => $_POST['css'],
						'updated_date_time' => date("Y-m-d H:i:s"),
				);

			$rs = $this->Util_model->update('pages', $data);
			
			//redirect('admin/pages');
			echo json_encode(array('rs' => $rs));
			die;
		//}
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
