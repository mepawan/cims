<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| CIAuth Config
| -------------------------------------------------------------------
*/





$config['ciauth'] = array(
	// Database Tables
	'tbl_prefix' => '',
	'tbl_users' => 'users',
	'tbl_roles' => 'roles',
	'tbl_permissions' => 'permissions',
	'tbl_autologin' => 'user_autologin',
	// Notification Setting
	'admin_verification' => FALSE,
	'email_verification' => TRUE,
	'email_activation_expire_time' => 60*60*24*2,
	'phone_verification' => TRUE,
	'phone_activation_expire_time' => 60*60*24*2,
	// Login Setting 
	'login_by_username' => TRUE,
	'login_by_email' => TRUE,
	'login_by_phone' => TRUE,
	'record_login_activiry' => TRUE,
	'two_factor_auth' => '', // '',email,phone,pin
	// Auto Login 
	'autologin_cookie_name' => 'ciauthal',
	'autologin_cookie_life' => 60*60*24*31*2,
	// Login Attempts 
	'record_login_attempts' => TRUE,
	'max_login_attempts' => 5,
	'login_attempts_over_action' => 'captcha', // captcha, suspend{n}m, suspend{n}h,suspend{n}d,adminapproval
	'forgot_password_expire_time' => 60*60*24*31*2,
	'google_recaptcha_site_key' => '',
	'google_recaptcha_secret_key' => '',
	'allow_user_registration' => TRUE,
	
	// admin 
	
	
	
	
	
);


