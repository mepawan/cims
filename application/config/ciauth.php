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
	'record_login_activity' => TRUE,
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
	//Registration
	'allow_user_registration' => TRUE,
	'min_password_length' => 6,
	'max_password_length' => 20,
	
	
	// admin 
	
	
	
	
	
);
$config['ciauth_email_template'] = array(
	'reset_password' => 'Dear {name},<br /><br />You have requested to reset your password. Please click on below link to reset your password.<br /><br /><a href="{reset_link}">{reset_link}</a></a><br /><br /> Thanks,<br />{site_name} Team<br />',
	'verify_email' => 'Dear {name},<br /><br />Thank you to join us on {site_name}. Please click on below link to verify your email.<br /><br /><a href="{verify_link}">{verify_link}</a></a><br /><br /> Thanks,<br />{site_name} Team<br />',
);


