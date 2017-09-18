<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus extends MX_Controller {

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
	public function index() {
		$this->load->view('menus/index',$this->data);
	}
	public function process_ajax(){
		$postdata = $_POST;
		$this->resp = $this->pvngen->db_action($postdata);
		load_settings(true);
		echo json_encode($this->resp);
		die;
		
	}

	public function listdt(){
		$filter = array_merge($_GET, $_POST);
		$resp = $this->pvngen->get_dt($filter);
		echo json_encode($resp);
		die;
	}
	private function load_config(){
		$entity_config = array(
							'entity' => 'menus',
							'table' => 'menus',
							'icon' => 'icmn-menu',
							'label' => 'Menus',
							'heading' => 'Manage Menus', 
							'fields' => array(
										'id' => array(
												'pk'=>1,
												'label' => 'Id',
												'type' => 'hidden',
												'show_in_form' => true,
												'show_in_list' => true,
												
												
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
										'slug' => array(
												'label' => 'Slug',
												'required' => true, 
												'type' => 'text',
												'show_in_form' => true,
												'show_in_list' => true,
												'icon'	=> 'fa-key',
												'icon_position' => 'left',
												
										),
										'item' => array(
												'label' => 'Item',
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
