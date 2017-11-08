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
	public function paypalipn(){
		
		
		$ddd = $_POST;
		$custom = array();
		
		$item_name = $_POST['item_name'];
		$item_number = $_POST['item_number'];
		$payment_status = $_POST['payment_status'];
		$payment_amount = $_POST['payment_gross'];
		$payment_fee = $_POST['payment_fee'];
		$payment_currency = $_POST['mc_currency'];
		$txn_id = $_POST['txn_id'];
		$receiver_email = $_POST['receiver_email'];
		$payer_email = $_POST['payer_email'];
		
		$txn = $this->Util_model->read('transactions', array('where' => array('id'=> $item_number ),'single_row' => 'yes'));
		if($txn){
			$custom['uid'] = $txn['uid'];
			$user = $this->Util_model->read('users', array('where' => array('id' => $txn['uid'] ),'single_row' => 'yes'));
			$custom['user'] = $user ;
			$txn_data = array(
				'id' => $txn ['id'],
				'txn_id' => $txn_id,
				'payer_email' => $payer_email,
				'receiver_email' => $receiver_email,
				'payment_status' => $payment_status,
			);
			
			if($payment_status == 'Completed'){
				$txn_data['status'] = 'completed';
				$txn_data['payment_gross'] = $payment_amount;
				$txn_data['payment_fee'] = $payment_fee;
				$txn_data['balance'] = $user['balance'] + ($payment_amount - $payment_fee);
			}
			$custom['txn_data'] = $txn_data ;
			$rstxn = $this->Util_model->update('transactions', $txn_data);
			$custom['txn_udated'] = $rstxn ;
			if($payment_status == 'Completed' && $user){
				$user_data = array(
					'id' => $user['id'],
					'balance' => $user['balance'] + ($payment_amount - $payment_fee)
				);
				$custom['user_data'] = $user_data ;
				$rsub = $this->Util_model->update('users', $user_data);
				$custom['user_balance_update'] = $rsub ;
				$user2 = $this->Util_model->read('users', array('where' => array('id' => $txn['uid'] ),'single_row' => 'yes'));
				$custom['new_user'] = $user2 ;
			}
		}else {
			$custom['error'] = 'txn not found';
		}
		
		$test_id = $this->Util_model->create('paypal_ipn_history',array('data' => json_encode($ddd),'custom' => json_encode($custom)));
		echo 'test id:' . $test_id;
		
		echo 'done';
		die;
	}
	public function paypal_success(){
		
	}
	public function paypal_cancel(){
		
	}
}
