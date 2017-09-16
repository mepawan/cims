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
		$this->load->model('Util_model');
		$this->resp = array();
		$this->data = array();
		$this->load->library('Pvngen');
		$this->data = $this->load_config();
	}
	public function index() {
		
		$this->data['datatable'] = true;
		$this->load->view('pvngen/index',$this->data);
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
							'entity' => 'settings',
							'table' => 'settings',
							'icon' => 'icmn-cogs',
							'label' => 'Settings',
							'heading' => 'Manage Settings', 
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
										'meta_key' => array(
												'label' => 'Meta Key',
												'required' => true, 
												'type' => 'text',
												'show_in_form' => true,
												'show_in_list' => true,
												'icon'	=> 'fa-key',
												'icon_position' => 'left',
												
										),
										'meta_value' => array(
												'label' => 'Meta Value',
												'required' => true, 
												'type' => 'text',
												'show_in_form' => true,
												'show_in_list' => true,
												'icon'	=> 'fa-pencil',
												'icon_position' => 'left',
										),
										'setting_order' => array(
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
