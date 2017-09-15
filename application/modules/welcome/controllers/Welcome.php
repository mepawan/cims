<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
		parent::__construct();
		$this->load->model('Util_model');
		$this->data = array();
	}
	public function index()
	{
		$this->load->view('home');
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
}
