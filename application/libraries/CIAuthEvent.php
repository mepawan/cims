<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CI Auth Class
 *
 * Authentication library for Code Igniter.
 *
 * @author		pawan.developers
 * @version		1.0.0
 * @license		MIT License Copyright (c) 2008 Erick Hartanto
 */

class CIAuthEvent {

	public function __construct() {
		$this->ci =& get_instance();
		log_message('debug', 'CIAuth Initialized');
		$this->ci->load->library('Session');
		$this->ci->load->database();
		$this->ci->load->model('Util_model','util');
		$this->ci->load->model('ciauth/users');
		$this->ci->load->config('ciauth');
		$this->ci->load->helper('ciauth');
		$this->ci->lang->load('ciauth');
		$this->config = $this->ci->config->item('ciauth');
		
		// Initialize
		$this->_init();
	}

	/* Private function */

	function _init() {
		global $ci_settings;
		$this->_auth_error = '';
		$this->ci->load->model('ciauth/users', 'users');
		if(!$ci_settings) {
			$ci_settings = load_settings();
		}
		$ci_settings = array_merge($this->config, $ci_settings);
		$tz = isset($this->settings['timezone']) && $this->settings['timezone']?:'America/Chicago';
		date_default_timezone_set($tz);
		update_mysql_timezone();

		$this->max_signup_with_1_ip = isset($this->settings['max_signup_with_1_ip']) && $this->settings['max_signup_with_1_ip'] ? $this->settings['max_signup_with_1_ip']:5;
		
		// When we load this library, auto Login any returning users
		$this->autologin();
		
		
		
	}
	
	
	// Set last ip and last login function when user login
	function _set_last_ip_and_last_login($user_id) {
		$data = array();
		
		if ($this->ci->config->item('email_account_details')) {	
			$data['last_ip'] = $this->ci->input->ip_address();
		}
		
		if ($this->ci->config->item('DX_login_record_time'))
		{
			$data['last_login'] = date('Y-m-d H:i:s', time());
		}
		
		if ( ! empty($data))
		{
			// Load model
			$this->ci->load->model('dx_auth/users', 'users');
			// Update record
			$this->ci->users->set_user($user_id, $data);
		}
	}
	
	// Increase login attempt
	function _increase_login_attempt()
	{		
		if ($this->ci->config->item('DX_count_login_attempts') AND ! $this->is_max_login_attempts_exceeded())
		{
			// Load model
			$this->ci->load->model('dx_auth/login_attempts', 'login_attempts');		
			// Increase login attempts for current IP
			$this->ci->login_attempts->increase_attempt($this->ci->input->ip_address());
		}
	}

	// Clear login attempts
	function _clear_login_attempts()
	{
		if ($this->ci->config->item('DX_count_login_attempts'))
		{
			// Load model
			$this->ci->load->model('dx_auth/login_attempts', 'login_attempts');		
			// Clear login attempts for current IP
			$this->ci->login_attempts->clear_attempts($this->ci->input->ip_address());
		}
	}
		
	// Get role data from database by id, used in _set_session() function
	// $parent_roles_id, $parent_roles_name is an array.
	function _get_role_data($role_id)
	{
		// Load models
		$this->ci->load->model('dx_auth/roles', 'roles');
		$this->ci->load->model('dx_auth/permissions', 'permissions');
	
		// Clear return value
		$role_name = '';
		$parent_roles_id = array();
		$parent_roles_name = array();
		$permission = array();
		$parent_permissions = array();
		
		/* Get role_name, parent_roles_id and parent_roles_name */
		
		// Get role query from role id
		$query = $this->ci->roles->get_role_by_id($role_id);
		
		// Check if role exist
		if ($query->num_rows() > 0)
		{
			// Get row
			$role = $query->row();		
	
			// Get role name
			$role_name = $role->name;
			
			/* 
				Code below will search if user role_id have parent_id > 0 (which mean role_id have parent role_id)
				and do it recursively until parent_id reach 0 (no parent) or parent_id not found.
				
				If anyone have better approach than this code, please let me know.
			*/
			
			// Check if role has parent id
			if ($role->parent_id > 0)
			{							
				// Add to result array
				$parent_roles_id[] = $role->parent_id;
				
				// Set variable used in looping
				$finished = FALSE;
				$parent_id = $role->parent_id;				

				// Get all parent id
				while ($finished == FALSE)
				{
					$i_query = $this->ci->roles->get_role_by_id($parent_id);
					
					// If role exist
					if ($i_query->num_rows() > 0)
					{
						// Get row
						$i_role = $i_query->row();
						
						// Check if role doesn't have parent
						if ($i_role->parent_id == 0)
						{
							// Get latest parent name
							$parent_roles_name[] = $i_role->name;
							// Stop looping
							$finished = TRUE;
						}
						else
						{
							// Change parent id for next looping
							$parent_id = $i_role->parent_id;
							
							// Add to result array
							$parent_roles_id[] = $parent_id;
							$parent_roles_name[] = $i_role->name;
						}
					}
					else
					{	
						// Remove latest parent_roles_id since parent_id not found
						array_pop($parent_roles_id);
						// Stop looping
						$finished = TRUE;
					}
				}			
			}
		}
		
		/* End of Get role_name, parent_roles_id and parent_roles_name */
		
		/* Get user and parents permission */
		
		// Get user role permission
		$permission = $this->ci->permissions->get_permission_data($role_id);
		
		// Get user role parent permissions
		if ( ! empty($parent_roles_id))
		{
			$parent_permissions = $this->ci->permissions->get_permissions_data($parent_roles_id);
		}
		
		/* End of Get user and parents permission */
		
		// Set return value
		$data['role_name'] = $role_name;
		$data['parent_roles_id'] = $parent_roles_id;
		$data['parent_roles_name'] = $parent_roles_name;
		$data['permission'] = $permission;
		$data['parent_permissions'] = $parent_permissions;
		
		return $data;
	}

	/* Autologin related function */

	function _create_autologin($user_id)
	{
		$result = FALSE;
		
		// User wants to be remembered
		$user = array(
			'key_id' => substr(md5(uniqid(rand().$this->ci->input->cookie($this->ci->config->item('sess_cookie_name')))), 0, 16),
			'user_id' => $user_id
		);
		
		// Load Models
		$this->ci->load->model('dx_auth/user_autologin', 'user_autologin');

		// Prune keys
		$this->ci->user_autologin->prune_keys($user['user_id']);

		if ($this->ci->user_autologin->store_key($user['key_id'], $user['user_id']))
		{
			// Set Users AutoLogin cookie
			$this->_auto_cookie($user);

			$result = TRUE;
		}

		return $result;
	}

	function autologin() {
		$result = FALSE;
		
		if ($auto = $this->ci->input->cookie($this->config['autologin_cookie_name']) AND ! $this->ci->session->userdata('ciauth_logged_in')){
			// Extract data
			print_r($auto);
			$auto = unserialize($auto);
			
			if (isset($auto['key_id']) AND $auto['key_id'] AND $auto['user_id']) {
				// Load Models				
				$this->ci->load->model('ciauth/user_autologin', 'user_autologin');

				// Get key
				$query = $this->ci->user_autologin->get_key($auto['key_id'], $auto['user_id']);								

				if ($result = $query->row()) {
					// User verified, log them in
					$this->_set_session($result);
					// Renew users cookie to prevent it from expiring
					$this->_auto_cookie($auto);
					
					// Set last ip and last login
					$this->_set_last_ip_and_last_login($auto['user_id']);
					
					$result = TRUE;
				}
			}
		}
		
		return $result;
	}

	function _delete_autologin()
	{
		if ($auto = $this->ci->input->cookie($this->ci->config->item('DX_autologin_cookie_name')))
		{
			// Load Cookie Helper
			$this->ci->load->helper('cookie');

			// Load Models
			$this->ci->load->model('dx_auth/user_autologin', 'user_autologin');

			// Extract data
			$auto = unserialize($auto);			

			// Delete db entry
			$this->ci->user_autologin->delete_key($auto['key_id'], $auto['user_id']);

			// Make cookie expired
			set_cookie($this->ci->config->item('DX_autologin_cookie_name'),	'',	-1);
		}
	}

	function _set_session($data) {
		// Get role data
		$role_data = $this->_get_role_data($data->role_id);
	
		// Set session data array
		$user = array(						
			'DX_user_id'						=> $data->id,	
			'DX_role_name'						=> $role_data['role_name'],
			'DX_parent_roles_id'				=> $role_data['parent_roles_id'],	// Array of parent role_id
			'DX_parent_roles_name'				=> $role_data['parent_roles_name'], // Array of parent role_name
			'DX_permission'						=> $role_data['permission'],
			'DX_parent_permissions'				=> $role_data['parent_permissions'],			
			'DX_logged_in'						=> TRUE,
		);
		
		array_walk($data, function($d,$index) use(&$user){
			$user['DX_'.$index] = $d;
		});
		
		$this->ci->session->set_userdata($user);
	}

	function _auto_cookie($data)
	{
		// Load Cookie Helper
		$this->ci->load->helper('cookie');

		$cookie = array(
			'name' 		=> $this->ci->config->item('DX_autologin_cookie_name'),
			'value'		=> serialize($data),
			'expire'	=> $this->ci->config->item('DX_autologin_cookie_life')
		);

		set_cookie($cookie);
	}

	/* End of Auto login related function */
	
	/* Helper function */
	
	function check_uri_permissions($allow = TRUE)
	{
		// First check if user already logged in or not
		if ($this->is_logged_in())
		{
			// If user is not admin
			if ( ! $this->is_admin())
			{
				// Get variable from current URI
				$controller = '/'.$this->ci->uri->rsegment(1).'/';
				if ($this->ci->uri->rsegment(2) != '')
				{
					$action = $controller.$this->ci->uri->rsegment(2).'/';
				}
				else
				{
					$action = $controller.'index/';
				}
				
				// Get URI permissions from role and all parents
				// Note: URI permissions is saved in 'uri' key
				$roles_allowed_uris = $this->get_permissions_value('uri');
				
				// Variable to determine if URI found
				$have_access = ! $allow;
				// Loop each roles URI permissions
				foreach ($roles_allowed_uris as $allowed_uris)
				{										
					if ($allowed_uris != NULL)
					{
						// Check if user allowed to access URI
						if ($this->_array_in_array(array('/', $controller, $action), $allowed_uris))
						{
								$have_access = $allow;
								// Stop loop
								break;
						}
					}
				}
				
				// Trigger event
				$this->checked_uri_permissions($this->get_user_id(), $have_access);
				
				if ( ! $have_access)
				{
					// User didn't have previlege to access current URI, so we show user 403 forbidden access
					$this->deny_access();
				}				
			}
		}
		else
		{
			// User haven't logged in, so just redirect user to login page
			$this->deny_access('login');
		}
	}
	
	/*
		Get permission value from specified key.
		Call this function only when user is logged in already.
		$key is permission array key (Note: permissions is saved as array in table).
		If $check_parent is TRUE means if permission value not found in user role, it will try to get permission value from parent role.
		Returning value if permission found, otherwise returning NULL
	*/
	function get_permission_value($key, $check_parent = TRUE)
	{
		// Default return value
		$result = NULL;
	
		// Get current user permission
		$permission = $this->ci->session->userdata('DX_permission');
		
		// Check if key is in user permission array
		if (array_key_exists($key, $permission))
		{
			$result = $permission[$key];
		}
		// Key not found
		else
		{
			if ($check_parent)
			{
				// Get current user parent permissions
				$parent_permissions = $this->ci->session->userdata('DX_parent_permissions');
				
				// Check parent permissions array				
				foreach ($parent_permissions as $permission)
				{
					if (array_key_exists($key, $permission))
					{
						$result = $permission[$key];
						break;
					}
				}
			}
		}
		
		// Trigger event
		$this->got_permission_value($this->get_user_id(), $key);
		
		return $result;
	}
	
	/*
		Get permissions value from specified key.
		Call this function only when user is logged in already.
		This will get user permission, and it's parents permissions.
				
		$array_key = 'default'. Array ordered using 0, 1, 2 as array key.
		$array_key = 'role_id'. Array ordered using role_id as array key.
		$array_key = 'role_name'. Array ordered using role_name as array key.
		
		Returning array of value if permission found, otherwise returning NULL.
	*/
	function get_permissions_value($key, $array_key = 'default')
	{
		$result = array();
		
		$role_id = $this->ci->session->userdata('DX_role_id');
		$role_name = $this->ci->session->userdata('DX_role_name');
		
		$parent_roles_id = $this->ci->session->userdata('DX_parent_roles_id');
		$parent_roles_name = $this->ci->session->userdata('DX_parent_roles_name');
		
		// Get current user permission
		$value = $this->get_permission_value($key, FALSE);
		
		if ($array_key == 'role_id')
		{
			$result[$role_id] = $value;
		}
		elseif ($array_key == 'role_name')
		{
			$result[$role_name] = $value;
		}
		else
		{
			array_push($result, $value);
		}
		
		// Get current user parent permissions
		$parent_permissions = $this->ci->session->userdata('DX_parent_permissions');
		
		$i = 0;
		foreach ($parent_permissions as $permission)
		{
			if (array_key_exists($key, $permission))
			{
				$value = $permission[$key];
			}
			
			if ($array_key == 'role_id')
			{
				// It's safe to use $parents_roles_id[$i] because array order is same with permission array
				$result[$parent_roles_id[$i]] = $value;
			}
			elseif ($array_key == 'role_name')
			{
				// It's safe to use $parents_roles_name[$i] because array order is same with permission array
				$result[$parent_roles_name[$i]] = $value;
			}			
			else
			{
				array_push($result, $value);
			}
			
			$i++;
		}
		
		// Trigger event
		$this->got_permissions_value($this->get_user_id(), $key);
		
		return $result;
	}

	function deny_access($uri = 'deny')
	{
		$this->ci->load->helper('url');
	
		if ($uri == 'login')
		{
			redirect($this->ci->config->item('DX_login_uri'), 'location');
		}
		else if ($uri == 'banned')
		{
			redirect($this->ci->config->item('DX_banned_uri'), 'location');
		}
		else
		{
			redirect($this->ci->config->item('DX_deny_uri'), 'location');			
		}
		exit;
	}
	
	// Get user id
	function get_user_id()
	{
		return $this->ci->session->userdata('DX_user_id');
	}

	// Get username string
	function get_username()
	{
		return $this->ci->session->userdata('DX_username');
	}
	
	// Get username string
	function get_user_phone()
	{
		return $this->ci->session->userdata('DX_phone');
	}
	
	// Get user info
	function get_user($field = '')
	{
		
		if($field){
			$field = str_replace('DX_','', $field);
			$field = 'DX_'.$field;
			return $this->ci->session->userdata($field);
		} else {
			return array(
						'id' => $this->ci->session->userdata('DX_user_id'),
						'username' => $this->ci->session->userdata('DX_username'),
						'email' => $this->ci->session->userdata('DX_email'),
						'phone' => $this->ci->session->userdata('DX_phone'),
						'first_name' => $this->ci->session->userdata('DX_first_name'),
						'last_name' => $this->ci->session->userdata('DX_last_name'),
						'role_id' => $this->ci->session->userdata('DX_role_id'),
						'role_name' => $this->ci->session->userdata('DX_role_name')
					);
		}
	}
	
	// Get user role id
	function get_role_id()
	{
		return $this->ci->session->userdata('DX_role_id');
	}
	
	// Get user role name
	function get_role_name()
	{
		return $this->ci->session->userdata('DX_role_name');
	}
	
	// Check is user is has admin privilege
	function is_admin()
	{
		return strtolower($this->ci->session->userdata('DX_role_name')) == 'admin';
	}
	
	// Check if user has $roles privilege
	// If $use_role_name TRUE then $roles is name such as 'admin', 'editor', 'etc'
	// else $roles is role_id such as 0, 1, 2
	// If $check_parent is TRUE means if roles not found in user role, it will check if user role parent has that roles
	function is_role($roles = array(), $use_role_name = TRUE, $check_parent = TRUE)
	{
		// Default return value
		$result = FALSE;
	
		// Build checking array
		$check_array = array();
		
		if ($check_parent)
		{
			// Add parent roles into check array
			if ($use_role_name)
			{
				$check_array = $this->ci->session->userdata('DX_parent_roles_name');
			}
			else
			{
				$check_array = $this->ci->session->userdata('DX_parent_roles_id');
			}
		}
		
		// Add current role into check array
		if ($use_role_name)
		{
			array_push($check_array, $this->ci->session->userdata('DX_role_name'));
		}
		else
		{
			array_push($check_array, $this->ci->session->userdata('DX_role_id'));
		}
		
		// If $roles not array then we add it into an array
		if ( ! is_array($roles))
		{
			$roles = array($roles);
		}
		
		if ($use_role_name)
		{
			// Convert check array into lowercase since we want case insensitive checking
			for ($i = 0; $i < count($check_array); $i++)
			{
				$check_array[$i] = strtolower($check_array[$i]);
			}
		
			// Convert roles into lowercase since we want insensitive checking
			for ($i = 0; $i < count($roles); $i++)
			{
				$roles[$i] = strtolower($roles[$i]);
			}
		}
		
		// Check if roles exist in check_array
		if ($this->_array_in_array($roles, $check_array))
		{
			$result = TRUE;
		}
		
		return $result;
	}

	// Check if user is logged in
	function is_logged_in()
	{
		//echo "hello"; $this->ci->session->userdata('DX_logged_in'); die;
		return $this->ci->session->userdata('ciauth_logged_in');
	}

	// Check if user is a banned user, call this only after calling login() and returning FALSE
	function is_banned()
	{
		return $this->_banned;
	}
	
	// Get ban reason, call this only after calling login() and returning FALSE
	function get_ban_reason()
	{
		return $this->_ban_reason;
	}
	
	// Check if username is available to use, by making sure there is no same username in the database
	function is_username_available($username) {
		// Load Models
		$this->ci->load->model('dx_auth/users', 'users');
		$this->ci->load->model('dx_auth/user_temp', 'user_temp');

		$users = $this->ci->users->check_username($username);
		//$temp = $this->ci->user_temp->check_username($username);
		
		//return $users->num_rows() + $temp->num_rows() == 0;
		return $users->num_rows() == 0;
	}
	
	// Check if email is available to use, by making sure there is no same email in the database
	function is_email_available($email)
	{
		// Load Models
		$this->ci->load->model('dx_auth/users', 'users');
		//$this->ci->load->model('dx_auth/user_temp', 'user_temp');

		$users = $this->ci->users->check_email($email);
		//$temp = $this->ci->user_temp->check_email($email);
		//$available = $users->num_rows() + $temp->num_rows() == 0;
		$available = $users->num_rows() == 0;
		
		return $available;
	}

	// Check if phone is available to use, by making sure there is no same username in the database
	function is_phone_available($phone) {
		// Load Models
		$this->ci->load->model('dx_auth/users', 'users');
		//$this->ci->load->model('dx_auth/user_temp', 'user_temp');

		$users = $this->ci->users->check_phone($phone);
		//$temp = $this->ci->user_temp->check_phone($phone);
		
		//return $users->num_rows() + $temp->num_rows() == 0;
		return $users->num_rows() == 0;
	}	
	
	// Check if login attempts bigger than max login attempts specified in config
	function is_max_login_attempts_exceeded()
	{
		$this->ci->load->model('dx_auth/login_attempts', 'login_attempts');
		
		return ($this->ci->login_attempts->check_attempts($this->ci->input->ip_address())->num_rows() >= $this->ci->config->item('DX_max_login_attempts'));
	}
	
	function get_auth_error()
	{
		return $this->_auth_error;
	}
	
	/* End of Helper function */
	
	/* Main function */
	
	function resend_activation($login){
		$this->ci->load->model('dx_auth/users', 'users');
		//$this->ci->load->model('dx_auth/user_temp', 'user_temp');
		
		$activation_key = md5(rand().microtime());
		//if ($query = $this->ci->user_temp->get_login($login) AND $query->num_rows() == 1) {
		if ($query = $this->ci->users->get_login($login) AND $query->num_rows() == 1) {
			$row = $query->row();
			//$this->ci->user_temp->update_temp(array('email' => $row->email),array('activation_key' =>$activation_key ));
			$this->ci->users->update(array('email' => $row->email),array('activation_key' =>$activation_key ));
			$from = isset($this->settings['site_email']) && $this->settings['site_email'] ? $this->settings['site_email']:$this->ci->config->item('DX_webmaster_email');
			
			
			$subject = sprintf($this->ci->lang->line('auth_activate_subject'), $this->ci->config->item('DX_website_name'));
			$new_user = (array)$row;
			$hash = base64_encode($new_user['email'].'_'.$activation_key);
			$new_user['activate_url'] = site_url($this->ci->config->item('DX_activate_uri').$hash);
				
			// Trigger event and get email content
			$this->sending_activation_email($new_user, $message);

			// Send email with activation link
			$mailrs = $this->_email($row->email, $from, $subject, $message);
			if($mailrs){
				return 'Activation link sent to your account email';
			} else {
				return 'There is some issue to send email. Please contact to site admin';
			}
		} else {
			return 'User with login  <strong>'.$login.'</strong> does not exist';
		}
	}
	
	/**
	* 
	*/
	function login($params) {
		global $ci_settings;
		$resp = false;
				
		if ( isset($params['loginkey']) && $params['loginkey']) {
			
			$login_methods = 0;
			$get_user_function = '';
			if(isset($ci_settings['login_by_username']) && $ci_settings['login_by_username']){
				$login_methods++;
				$get_user_function = 'get_user_by_username';
			}
			if(isset($ci_settings['login_by_email']) && $ci_settings['login_by_email']){
				$login_methods++;
				$get_user_function = 'get_user_by_email';
			}
			if(isset($ci_settings['login_by_phone']) && $ci_settings['login_by_phone']){
				$login_methods++;
				$get_user_function = 'get_user_by_phone';
			}
			if ($login_methods > 1 ) {
				$get_user_function = 'get_login';
			} 
			$user = $this->ci->util->get_login($params['loginkey']);
			if ($user) {
				if($user['password'] == md5($params['password'])){
					if($user['status'] == 'pending'){
						$resend_activation_link = '<a href="'.ci_base_url().'admin/auth/resend-activation-email">'.$this->ci->lang->line("txt_resend_activation_email").'</a>';
						$this->_auth_error = sprintf($this->ci->lang->line('ciauth_account_pending'),$ci_settings['site_name'],$resend_activation_link);
					} else if($user['status'] == 'suspended'){
						$account_resume_req = ' <a href="'.ci_base_url().'admin/auth/request/resume-account">'.$this->ci->lang->line("txt_resume_account").'</a>';
						$this->_auth_error = sprintf($this->ci->lang->line('ciauth_account_suspended'),$account_resume_req);
					} else {
						$this->_set_session($user);
						$this->send_activation_email($user);
					}
				} else {
					$this->_auth_error = $this->ci->lang->line('ciauth_wrong_password');
				}
			} else {
				$this->_auth_error = $this->ci->lang->line('ciauth_login_not_exist');
				
			}
			
		}

		return $result;
	}

	function logout()
	{
		// Trigger event
		$this->user_logging_out($this->ci->session->userdata('DX_user_id'));
	
		// Delete auto login
		if ($this->ci->input->cookie($this->ci->config->item('DX_autologin_cookie_name'))) {
			$this->_delete_autologin();
		}
		
		// Destroy session
		$this->ci->session->sess_destroy();		
	}

	function register($data) {		
		// Load Models
		$this->ci->load->model('dx_auth/users', 'users');
		//$this->ci->load->model('dx_auth/user_temp', 'user_temp');

		$this->ci->load->helper('url');
		
		// Default return value
		$result = FALSE;
		$activation_key = md5(rand().microtime());
		// New user array
		$new_user = array(		
			'username'					=> isset($data['username'])?$data['username']:'',
			'first_name'				=> isset($data['first_name'])?$data['first_name']:'',		
			'last_name'					=> isset($data['last_name'])?$data['last_name']:'',					
			'password'					=> md5($data['password']),
			'email'						=> $data['email'],
			'phone'						=> isset($data['phone'])?$data['phone']:'',
			'last_ip'					=> $this->ci->input->ip_address(),
			'signup_ip'					=> $this->ci->input->ip_address(),
			'referral_code' 			=> random_num(),
		);
		if($referral = $this->ci->session->userdata('referral')){
			$new_user['referred_by'] = $referral['ref_code'];
			$this->ci->session->unset_userdata('referral');
		}
		// Do we need to send email to activate user
		if ($this->ci->config->item('DX_email_activation')) {
			// Add activation key to user array
			$new_user['activation_key'] = $activation_key;
			$new_user['status'] = 'pending';
			// Create temporary user in database which means the user still unactivated.
			//$insert = $this->ci->user_temp->create_temp($new_user);
			$insert = $this->ci->users->create_user($new_user);
		} else {	
			$new_user['status'] = 'active';
			// Create user 
			$insert = $this->ci->users->create_user($new_user);
			// Trigger event
			$uid = $this->ci->db->insert_id();
			$this->user_activated($uid);	
			if($referral){
				$referral['uid'] = $uid;
				update_referal($referral);
			}			
		}
		
		if ($insert) {
			
			// Replace password with blank text for email.
			$new_user['password'] = '**********(you should know it)';
			
			$result = $new_user;
			
			// Send email based on config
			$from = isset($this->settings['site_email']) && $this->settings['site_email'] ? $this->settings['site_email']:$this->ci->config->item('DX_webmaster_email');
			// Check if user need to activate it's account using email
			if ($this->ci->config->item('DX_email_activation')) {
				// Create email
				
				$subject = sprintf($this->ci->lang->line('auth_activate_subject'), $this->ci->config->item('DX_website_name'));
				
				$hash = base64_encode($new_user['email'].'_'.$activation_key);
				$new_user['activate_url'] = site_url($this->ci->config->item('DX_activate_uri').$hash);
				
				// Trigger event and get email content
				$this->sending_activation_email($new_user, $message);

				// Send email with activation link
				$mailrs = $this->_email($data['email'], $from, $subject, $message);
				//echo "mailrs:";print_r($mailrs);
			} else {
				// Check if need to email account details						
				//if ($this->ci->config->item('DX_email_account_details'))  {
					// Create email
					$subject = sprintf($this->ci->lang->line('auth_account_subject'), $this->ci->config->item('DX_website_name')); 
					
					// Trigger event and get email content
					$this->sending_account_email($new_user, $message);

					// Send email with account details
					$mailrs2 = $this->_email($data['email'], $from, $subject, $message);	
					//echo "mailrs2:";print_r($mailrs2);					
				//}
			}
		}
		
		return $result;
	}

	function forgot_password($login) {
		// Default return value
		$result = FALSE;
	
		if ($login) {
			// Load Model
			$this->ci->load->model('dx_auth/users', 'users');
			// Load Helper
			$this->ci->load->helper('url');

			// Get login and check if it's exist 
			if ($query = $this->ci->users->get_login($login) AND $query->num_rows() == 1) {	// Get User data
				$row = $query->row();
				$resend = ($this->ci->input->post('resend_pwd') == 1)?true:false;
				// Check if there is already new password created but waiting to be activated for this login
				if ( ! $row->newpass_key || $resend) {
					// Appearantly there is no password created yet for this login, so we create new password
					$data['password'] = $this->_gen_pass();
					
					// Encode & Crypt password
					$encode = md5($data['password']); 

					// Create key
					$data['key'] = md5(rand().microtime());

					// Create new password (but it haven't activated yet)
					$this->ci->users->newpass($row->id, $encode, $data['key']);

					// Create reset password link to be included in email
					$hash = base64_encode($row->email.'_'.$data['key']);
					$data['reset_password_uri'] = site_url($this->ci->config->item('DX_reset_password_uri').$hash);
					
					// Create email
					$from = isset($this->settings['site_email']) && $this->settings['site_email'] ? $this->settings['site_email']:$this->ci->config->item('DX_webmaster_email');
					$subject = $this->ci->lang->line('auth_forgot_password_subject'); 
					
					// Trigger event and get email content
					$this->sending_forgot_password_email($data, $message);

					// Send instruction email
					$mailrs = $this->_email($row->email, $from, $subject, $message);
					//echo "mailrs:".$mailrs;
					$result = TRUE;
				} else {
					// There is already new password waiting to be activated
					$this->_auth_error = $this->ci->lang->line('auth_request_sent'). '<div class="resend_pwd_wrap"><label><strong>OR</strong></label><br /><input type="checkbox" id="resend_pwd" name="resend_pwd" value="1" /> <label for="resend_pwd">Resend email</label></div>';
				}
			} else {
				$this->_auth_error = $this->ci->lang->line('auth_username_or_email_not_exist');
			}
		}
		
		return $result;
	}

	function reset_password($username, $key = '')
	{
		// Load Models
		$this->ci->load->model('dx_auth/users', 'users');
		$this->ci->load->model('dx_auth/user_autologin', 'user_autologin');
		
		// Default return value
		$result = FALSE;
		
		// Default user_id set to none
		$user_id = 0;
		
		// Get user id
		//if ($query = $this->ci->users->get_user_by_username($username) AND $query->num_rows() == 1)
		$query = $this->ci->users->get_login($username);
		if ( $query AND $query->num_rows() == 1) {
			$user_id = $query->row()->id;
			
			// Try to activate new password
			if ( ! empty($username) AND ! empty($key) AND $this->ci->users->activate_newpass($user_id, $key) AND $this->ci->db->affected_rows() > 0 ) {
				// Clear previously setup new password and keys
				$this->ci->user_autologin->clear_keys($user_id);
				
				$result = TRUE;
			}
		}
		return $result;
	}

	function activate($username, $key = ''){
		// Load Models
		$this->ci->load->model('dx_auth/users', 'users');
		//$this->ci->load->model('dx_auth/user_temp', 'user_temp');
		
		// Default return value
		$result = FALSE;
			$query = $this->ci->users->activate_user($username, $key );
			if ($query  AND $query->num_rows() > 0) {
				$row = $query->row_array();
				$uid = $row['id'];
				$u_update = array(
					'activation_key' => '',
					'status' => 'active'
				);
				if ($this->ci->users->update(array('id' => $uid),$u_update)){
					// Trigger event
					$this->user_activated($uid);
					$referral = read_db('ref_visits', array('uid' => $uid));
					if($referral){
						$ref_data = array(
								'uid' => $uid,
								'status' => 'joined',
								'id' => $referral['id']
							);
						update_referal($ref_data);
					}

					$result = TRUE;
				}
			}
		
		return $result;
	}

	function change_password($old_pass, $new_pass)
	{
		// Load Models
		$this->ci->load->model('dx_auth/users', 'users');
		
		// Default return value
		$result = FAlSE;

		// Search current logged in user in database
		if ($query = $this->ci->users->get_user_by_id($this->ci->session->userdata('DX_user_id')) AND $query->num_rows() > 0)
		{
			// Get current logged in user
			$row = $query->row();

			$pass = $this->_encode($old_pass);

			// Check if old password correct
			if (md5($old_pass) === $row->password)
			{
				// Crypt and encode new password
				$new_pass = md5($new_pass);
				
				// Replace old password with new password
				$this->ci->users->change_password($this->ci->session->userdata('DX_user_id'), $new_pass);
				
				// Trigger event
				$this->user_changed_password($this->ci->session->userdata('DX_user_id'), $new_pass);
				
				$result = TRUE;
			}
			else 
			{
				$this->_auth_error = $this->ci->lang->line('auth_incorrect_old_password');
			}
		}
		
		return $result;
	}
	
	function cancel_account($password)
	{
		// Load Models
		$this->ci->load->model('dx_auth/users', 'users');
		
		// Default return value
		$result = FAlSE;
		
		// Search current logged in user in database
		if ($query = $this->ci->users->get_user_by_id($this->ci->session->userdata('DX_user_id')) AND $query->num_rows() > 0)
		{
			// Get current logged in user
			$row = $query->row();

			$pass = $this->_encode($password);

			// Check if password correct
			if (crypt($pass, $row->password) === $row->password)
			{
				// Trigger event
				$this->user_canceling_account($this->ci->session->userdata('DX_user_id'));

				// Delete user
				$result = $this->ci->users->delete_user($this->ci->session->userdata('DX_user_id'));
				
				// Force logout
				$this->logout();
			}
			else
			{
				$this->_auth_error = $this->ci->lang->line('auth_incorrect_password');
			}
		}
		
		return $result;
	}
	
	/* End of main function */

	








	// If DX_email_activation in config is TRUE, 
	// this event occurs after user succesfully activated using specified key in their email.
	// If DX_email_activation in config is FALSE, 
	// this event occurs right after user succesfully registered.	
	function user_activated($user_id)
	{
		// Load models
		//$this->ci->load->model('dx_auth/user_profile', 'user_profile');
		
		// Create user profile
		//$this->ci->user_profile->create_profile($user_id);
	}
	
	// This event occurs right after user login
	function user_logged_in($user_id)
	{
	}
	
	// This event occurs right before user logout
	function user_logging_out($user_id)
	{
	}
	
	// This event occurs right after user change password
	function user_changed_password($user_id, $new_password)
	{
	}
	
	// This event occurs right before user account is canceled
	function user_canceling_account($user_id)
	{
		// Load models
		$this->ci->load->model('dx_auth/user_profile', 'user_profile');
		
		// Delete user profile
		$this->ci->user_profile->delete_profile($user_id);
	}
	
	// This event occurs when check_uri_permissions() function in DX_Auth is called
	// after checking if user role is allowed or not to access URI, this event will be triggered
	// $allowed is result of the check before, it's possible to alter the value since it's passed by reference
	function checked_uri_permissions($user_id, &$allowed)
	{	
	}
	
	// This event occurs when get_permission_value() function in DX_Auth is called	
	function got_permission_value($user_id, $key)
	{	
	}
	
	// This event occurs when get_permissions_value() function in DX_Auth is called	
	function got_permissions_value($user_id, $key)
	{	
	}
	
	// This event occurs right before dx auth send email with account details
	// $data is an array, containing username, password, email and last ip
	// $content is email content, passed by reference	
	// You can customize email content here
	function sending_account_email($data, &$content)
	{
		// Load helper
		$this->ci->load->helper('url');
		
		// Create content	
		$content = sprintf($this->ci->lang->line('auth_account_content'), 
			$this->ci->config->item('DX_website_name'), 
			$data['username'], 
			$data['email'], 
			$data['password'], 
			site_url($this->ci->config->item('DX_login_uri')),
			$this->ci->config->item('DX_website_name'));
	}
	
	// This event occurs right before dx auth send activation email
	// $data is an array, containing username, password, email, last ip, activation_key, activate_url
	// $content is email content, passed by reference	
	// You can customize email content here
	function sending_activation_email($data, &$content) {
		// Create content
		$site_name = isset($this->settings['site_name'])?$this->settings['site_name']:$this->ci->config->item('DX_website_name');
		$content = sprintf(
				$this->ci->lang->line('auth_activate_content'), 
				$site_name, 
				$data['activate_url'],
				$this->ci->config->item('DX_email_activation_expire') / 60 / 60,
				$data['username'], 
				$data['email'],
				$data['password'],
				$site_name
			);
	}
	
	// This event occurs right before dx auth send forgot password request email
	// $data is an array, containing password, key, and reset_password_uri
	// $content is email content, passed by reference	
	// You can customize email content here
	function sending_forgot_password_email($data, &$content) {
		// Create content
		$content = sprintf($this->ci->lang->line('auth_forgot_password_content'), 
			$this->ci->config->item('DX_website_name'), 
			$data['reset_password_uri'],
			$data['password'],
			$data['key'],
			$this->ci->config->item('DX_webmaster_email'),
			$this->ci->config->item('DX_website_name'));
	}
	
}
