<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['paypal_business_email'] = '';
$config['paypal_sandbox_url'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
$config['paypal_url'] = 'https://www.paypal.com/cgi-bin/webscr';
$config['paypal_mode'] = 'sandbox';  // sandbox or live
$config['paypal_ipn_log_file'] = 'paypal_ipn_log.txt';
$config['paypal_ipn_log'] = false;

$config['paypal_ipn_url'] = '/paypalipn';
$config['paypal_success_url'] = '/paypal-success';
$config['paypal_cancel_url'] = '/paypal-cancel';