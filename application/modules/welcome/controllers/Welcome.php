<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MX_Controller {


	function __construct() {
		parent::__construct();
		$this->load->library('CIAuth');
		
		$this->load->model('Util_model');
		$this->data = array();
		$menus = $this->Util_model->read('menus', array( 'where' => array( 'slug' => 'main_menu')));
		$this->data['menus'] = $this->Util_model->read('menus_items', array( 'where' => array( 'menu_id' => $menus[0]['id'])));
		$this->load->helper('form');
	}
	public function index()
	{
		
		$where = array( 'alias' => 'home');
		$this->data['page'] = $this->Util_model->read('pages', array( 'where' => $where));
		
		$this->load->view('home', $this->data);
	}
	public function preview($alias = "")
	{
		$url = strtolower(str_replace("_", "-", $alias));
		
		if(is_numeric($alias)){
			$where = array( 'id' => $url);
			$this->data['page'] = $this->Util_model->read('pages', array( 'where' => $where));
		}
		else{
			$where = array( 'alias' => $url);
			$this->data['page'] = $this->Util_model->read('pages', array( 'where' => $where));
		
		}
		
		
		
		if(!empty($this->data['page'])){
			$this->load->view('pages', $this->data);
		}
		else{
			echo "404 Page Not Found";
		}
	}
	function states_ajax($cid = ''){
		if(!$cid){
			$cid = $this->input->post('country_id');
		}
		$resp = array();
		if($cid){
			if(is_numeric($cid)){
				$states = $this->Util_model->read('province',array('where' => array('country_id' => $cid)));
			} else {
				$country = $this->Util_model->read('country',array('where' => array('iso_code_2' => $cid)));
				//print_r($country);
				$states = $this->Util_model->read('province',array('where' => array('country_id' => $country[0]['country_id'])));
			}
			
			$resp['status'] = 'success';
			$resp['states'] = $states;
		} else {
			$resp['status'] = 'fail';
			$resp['msg'] = 'Country id missing';
		}
		echo json_encode($resp);
		die;
		
	}
}
