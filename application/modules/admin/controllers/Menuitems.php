<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menuitems extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('Form_validation');
		$this->load->helper('form');
		$this->load->library('CIAuth');
		if ( ! $this->ciauth->is_logged_in() || !($this->ciauth->is_admin() || $this->ciauth->is_superadmin())){
			redirect('admin/auth', 'location');
		}
		$this->load->model('Util_model');
		$this->resp = array();
		$this->data = array();
		$this->load->library('Pvngen');
		$this->data = $this->load_config();
	}
	public function index($i = '') {
		
		$this->data = $this->load_config(array('menu_id' => $i));
		$this->data['datatable'] = true;
		$this->data['id'] = $i; 
		$this->load->view('menus/menu_item',$this->data);
		
			
	}
	public function process_ajax(){
		
		$postdata = $_POST;
		$this->resp = $this->pvngen->db_action($postdata);
		load_settings(true);
		echo json_encode($this->resp);
		die;
		
	}

	public function listdt($menu_id){
		
		$filter = array_merge($_GET, $_POST);
		$filter['columns'][1]['search']['value'] = $menu_id;
		
		$resp = $this->pvngen->get_dt($filter);
		echo json_encode($resp);
		die;
	}
	private function load_config($params = array()){
		
		$entity_config = array(
							'entity' => 'Menuitems',
							'table' => 'menus_items',
							'icon' => 'icmn-menu',
							'label' => 'Menus',
							'heading' => 'Manage Menus Items', 
							'fields' => array(
										'id' => array(
												'pk'=>1,
												'label' => 'Id',
												'type' => 'hidden',
												'show_in_form' => true,
												'show_in_list' => true,
												
										),
										'menu_id' => array(
												'label' => 'menu_id',
												'type' => 'hidden',
												'show_in_form' => true,
												'show_in_list' => true,
												'default' => isset($params['menu_id'])?$params['menu_id']:''
										),
										
										'title' => array(
												'label' => 'Title',
												'required' => true, 
												'type' => 'text',
												'show_in_form' => true,
												'show_in_list' => true,
												'icon'	=> 'fa-key',
												'icon_position' => 'left',
										),
										'alias' => array(
												'label' => 'Alias',
												'required' => true, 
												'type' => 'text',
												'show_in_form' => true,
												'show_in_list' => true,
												'icon'	=> 'fa-key',
												'icon_position' => 'left',
												
										),
										'menu_order' => array(
												'label' => 'Order',
												'required' => true, 
												'type' => 'number',
												'show_in_form' => true,
												'show_in_list' => true,
												'icon'	=> 'fa-pencil',
												'icon_position' => 'left',
                                                'attributes' => array('min' => '0', 'step' => '1')
										),
									),
						);
		$this->pvngen->init($entity_config);
		return $entity_config;
	}
	

	
}
