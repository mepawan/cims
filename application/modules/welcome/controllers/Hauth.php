<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Hauth Controller Class
 */
class Hauth extends CI_Controller {

  /**
   * {@inheritdoc}
   */
  public function __construct()
  {
    parent::__construct();

    $this->load->helper('url');
    $this->load->library('hybridauth');
    $this->load->library('CIAuth');
    
  }

  /**
   * {@inheritdoc}
   */
  public function index() {
    // Build a list of enabled providers.
    /*
    $providers = array();
    foreach ($this->hybridauth->HA->getProviders() as $provider_id => $params)
    {
      $providers[] = anchor("hauth/window/{$provider_id}", $provider_id);
    }

    $this->load->view('hauth/login_widget', array(
      'providers' => $providers,
    ));*/
    
  }

  /**
   * Try to authenticate the user with a given provider
   *
   * @param string $provider_id Define provider to login
   */
  public function process($provider_id){
	global $ci_settings;
	$params = array(
      'hauth_return_to' => ci_base_url("hauth/process/{$provider_id}"),
    );
    if (isset($_REQUEST['openid_identifier'])){
      $params['openid_identifier'] = $_REQUEST['openid_identifier'];
    }
    try{
		$adapter = $this->hybridauth->HA->authenticate($provider_id, $params);
		$profile = $adapter->getUserProfile();
		
		$email = $profile->email;
		$emailset = $this->ciauth->is_email_available($email);
		
		if($emailset != ""){
			$param = array(
			  'loginkey' => $profile->email,
			  'forcelogin' => 'true',
			);
			
			$login = $this->ciauth->login($param);
			if($login['status'] = 'success'){
				redirect('/auth/redirect_login');
			}
		}
		else{
			$role = $this->session->userdata('social_login_role');
			$this->session->unset_userdata('social_login_role');
			$rol_data = isset($ci_settings['roles_by_name'][$role])?$ci_settings['roles_by_name'][$role]:'';
			$data = array(		
					'first_name'	=> isset($profile->firstName)?$profile->firstName:'',		
					'last_name'		=> isset($profile->lastName)?$profile->lastName:'',	
					'email'			=> $profile->email,
					'phone'			=> isset($profile->phone)?$profile->phone:'',
					'status'  		=> 'active',
					'role_id' 		=> $rol_data['id']
				);
				$result = $this->ciauth->register($data);
				$param = array(
				  'loginkey' => $profile->email,
				  'forcelogin' => 'true',
				);
					
				$login = $this->ciauth->login($param);
				
				if($login['status'] = 'success'){
					redirect('/auth/redirect_login');
				}
		}
		
		
		
		
      
	} catch (Exception $e){
      show_error($e->getMessage());
    }
  }

  /**
   * Handle the OpenID and OAuth endpoint
   */
  public function endpoint()
  {
    $this->hybridauth->process();
  }

}
