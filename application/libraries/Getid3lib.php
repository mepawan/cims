<?php

require_once(dirname(__FILE__) . '/getid3/getid3.php');

class Getid3lib{
	private $lib;
	function __construct(){
		$this->lib = new getID3;
	}
	public function analyze($file){
		return $this->lib->analyze($file);
	}
}

