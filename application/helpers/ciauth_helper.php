<?php
global $ci_settings;



if(! function_exists('load_settings')){
	function load_settings($forcedb = false){
		global $ci_settings;
		$ci =& get_instance();
		if(!$forcedb && $ci->session->userdata('ci_settings')){
			$ci_settings = $ci->session->userdata('ci_settings');
		} else {
			$ci->load->model('Util_model');
			$settings = $ci->Util_model->read('settings');
			//print_r($settings);
			if($settings){
				$settings_indx = array();
				array_walk($settings, function($setting) use(&$settings_indx){
					$settings_indx[$setting['meta_key']] = $setting['meta_value'];
				});
				$ci_settings = $settings_indx;
				//$ci->session->set_userdata('ci_settings',$ci_settings);
			} else {
				$ci_settings = array();
			}
		}
		return $ci_settings;
	}
}
if(! function_exists('add_referal')){
	function add_referal(){
		$ci =& get_instance();
		if(!$ci->dx_auth->is_logged_in()){
			$ci->load->model('Util_model');
			$referral_data = array(
				'ref_code' => $_REQUEST['ref'],
				'ref_url' => isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:'',
				'hash' => md5(time().rand(1,9999999)),
				'ip' => $ci->input->ip_address(),
			);
			$referral_data['id'] = $ci->Util_model->create('ref_visits',$referral_data);
			$ci->session->set_userdata('referral',$referral_data);
		}
	}
}
if(! function_exists('update_referal')){
	function update_referal($referral){
		$ci =& get_instance();
		$ci->load->model('Util_model');
		$ref_data = array(
				'status' => 'joined',
				'id' => $referral['id'],
				'uid' => $referral['uid'],
			);
		$ci->Util_model->update('ref_visits',$ref_data);
	}
}
if(! function_exists('get_user_referals')){
	function get_user_referals($ref_code = '',$type = 'all'){ // $type = 'all', 'visited','joined'
		$ci =& get_instance();
		$ci->load->model('Util_model');
		if(!$ref_code){
			$ref_code = $ci->dx_auth->get_user('referral_code');
		}
		$whr = array('ref_code' => $ref_code);
		if($type != 'all'){
			$whr['status'] = $type;
		}
		$sql = 'SELECT ref.*,u.uid, u.email, u.username,u.first_ame, u.last_name FROM ref_visits ref JOIN users u ON(ref.ref_code=u.referred_by) WHERE ref.ref_code="'.$ref_code.'"';
		$referrals = $ci->Util_model->custom_query($sql);
		return $referrals;
	}
}

if(! function_exists('validate_recapcha')){
	function validate_recapcha($g_recaptcha_response = ''){
		global $ci_settings;
		if(!$g_recaptcha_response){
			$g_recaptcha_response = $_POST['g-recaptcha-response'];
		}
		//echo 'g_recaptcha_response:'.$g_recaptcha_response;die;
		$recaptcha_site_key = isset($ci_settings['google_recaptcha_site_key']) ? $ci_settings['google_recaptcha_site_key'] : '';
		$recaptcha_secret_key = isset($ci_settings['google_recaptcha_secret_key']) ? $ci_settings['google_recaptcha_secret_key'] : '';
		if($recaptcha_site_key && $recaptcha_secret_key ){
			$post_data = http_build_query(
				array(
					'secret' => $recaptcha_secret_key,
					'response' => $g_recaptcha_response,
					'remoteip' => $_SERVER['REMOTE_ADDR']
				)
			);
			$opts = array('http' =>
				array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $post_data
				)
			);
			$context  = stream_context_create($opts);
			$response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
			$result = json_decode($response);
			return $result->success;
		} else {
			return true;
		}
	}
}

if(! function_exists('recaptcha_form')){
	function recaptcha_form($return = true){
		global $ci_settings;
		$recaptcha_site_key = isset($ci_settings['google_recaptcha_site_key']) ? $ci_settings['google_recaptcha_site_key'] : '';
		if($recaptcha_site_key){
			$rc_html = '<div class="g-recaptcha" data-sitekey="'.$recaptcha_site_key.'"></div>';
		} else {
			$rc_html = '';
		}
		if($return){
			return $rc_html;
		} else {
			echo $rc_html;
		}
	}
}