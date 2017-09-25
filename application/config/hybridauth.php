<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| HybridAuth settings
| -------------------------------------------------------------------------
| Your HybridAuth config can be specified below.
|
| See: https://github.com/hybridauth/hybridauth/blob/v2/hybridauth/config.php
*/
$config['hybridauth'] = array(
  "providers" => array(
    // openid providers
    "OpenID" => array(
      "enabled" => FALSE,
    ),
    "Yahoo" => array(
      "enabled" => FALSE,
      "keys" => array("id" => "", "secret" => ""),
    ),
    "AOL" => array(
      "enabled" => FALSE,
    ),
    "Google" => array(
      "enabled" => TRUE,
      "keys" => array("id" => "349060752209-1smlfqjsfncu2t73ecq51vl4ajegn7hh.apps.googleusercontent.com", "secret" => "0UQRSomqgfPDTrNy-CSwcbDT"),
    ),
    "Facebook" => array(
      "enabled" => TRUE,
      "keys" => array("id" => "1587623191497700", "secret" => "70bd1e30878dca927223251d0247fe5a"),
      "trustForwarded" => FALSE,
    ),
    "Twitter" => array(
      "enabled" => TRUE,
      "keys" => array("key" => "ckQFIqZgJAIurC1AlX7aIUOaB", "secret" => "Z9J62wTQ4WedKaH7Hr1IhhSumApNonPdhId1EhscoS8spEBnQk"),
      "includeEmail" => TRUE,
    ),
    "Live" => array(
      "enabled" => FALSE,
      "keys" => array("id" => "", "secret" => ""),
    ),
    "LinkedIn" => array(
      "enabled" => FALSE,
      "keys" => array("id" => "", "secret" => ""),
      "fields" => array(),
    ),
    "Foursquare" => array(
      "enabled" => FALSE,
      "keys" => array("id" => "", "secret" => ""),
    ),
  ),
  // If you want to enable logging, set 'debug_mode' to true.
  // You can also set it to
  // - "error" To log only error messages. Useful in production
  // - "info" To log info and error messages (ignore debug messages)
  "debug_mode" => ENVIRONMENT === 'development',
  // Path to file writable by the web server. Required if 'debug_mode' is not false
  "debug_file" => APPPATH . 'logs/hybridauth.log',
);
