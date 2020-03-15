<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 class Mom extends CI_CONTROLLER{
    
  function __construct() {
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-DEVICE-ID,X-TOKEN, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$method = $_SERVER['REQUEST_METHOD'];
		if($method == "OPTIONS") {
		die();
		}
		parent::__construct();
  }

  public function getMeeting(){

  }

  public function getMeetingInfo(){

  }

  public function createMeeting(){

  }

  public function updateParticipantStatus(){

  }

  public function recordMeeting(){

  }

  public function endMeeting(){
    
  }

 }

?>