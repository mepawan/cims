<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blocks extends MX_Controller {

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
		$this->data['entity'] = 'blocks';
		$this->data['heading'] = 'Manage blocks';
		$this->data['icon'] = 'icmn-file-text';
		$this->data['datatable'] = true;
		$this->load->view('blocks/index',$this->data);
	}
	function pagesdt(){
		$filters = array_merge($_GET, $_POST);
		$filters['table'] = 'blocks';
		$filters['joins'][] = array('table' => 'users','alias' => 'u', 'on' => 'tbl.author=u.id');
		//$filters['joins'][] = array('table' => 'ads','alias' => 'ad', 'on' => 'ac.ad_id=ad.id');
		$filters['aSelectionColumns'] = array('concat(tbl.title,"___",tbl.id, "___", tbl.alias) as title','concat(u.first_name, " ", u.last_name) as author','tbl.alias');
		$filters['aColumns'] = array('title','author','alias');
		$filters['custom_search_filter'] = array(
					//'where' => array('tbl.uid' => $this->ciauth->get_user_id())
			);
		
		$output = $this->Util_model->get_data_for_dt($filters);
		echo json_encode($output);
		die;
		
		
	}
	public function add(){
        $this->data['entity'] = 'blocks';
        $this->data['heading'] = 'Add New Block';
        $this->data['icon'] = 'icmn-file-text';
		$this->data['foot_views'] = array('part/ckeditor');
		
		
        $this->load->view('blocks/add',$this->data);
    }
	public function save(){
		
		if(isset($_POST['title'])){
			$userid = $this->ciauth->get_user_id();
			$alias = title_alias('pages', $_POST['title']);
			
			$data = array(
						'title' => $_POST['title'],
						'alias' => $alias,
						'content' => $_POST['content'],
						'author' => $userid
						);
			
			$rs = $this->Util_model->create('blocks', $data);
			
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
		
        $this->data['entity'] = 'blocks';
        $this->data['heading'] = 'block edit';
        $this->data['icon'] = 'icmn-file-text';
        $this->data['foot_views'] = array('part/ckeditor');
		
		if(is_numeric($id)){
			$where = array( 'id' => $id);
			$this->data['page'] = $this->Util_model->read('blocks', array( 'where' => $where));
		}
		else{
			$where = array( 'alias' => $id);
			$this->data['page'] = $this->Util_model->read('blocks', array( 'where' => $where));
		
		}
				
        $this->load->view('blocks/edit',$this->data);
    }
    public function update(){
			$data = array(
						'id' => $_POST['id'],
						'title' => $_POST['title'],
						'content' => $_POST['content'],
						'updated_date_time' => date("Y-m-d h:i:s"),
						);
						
			$rs = $this->Util_model->update('blocks', $data);
			
		
	}
	
	
}
