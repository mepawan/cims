<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
	public $CI; // Property set to fix callback error
  
	/**
	 * Extends CI Form Validation.
	 *
	 * Fix for (HMVC) Extension.
	 */
	 
	public function run($module = '', $group = '') {
		if ( is_object ( $module ) && $this->CI = &$module ) ;
			return parent::run($group);
	}
  
	function error_array() {
		if (count($this->_error_array) === 0)
			return FALSE;
		else
			return $this->_error_array;
	}
}
