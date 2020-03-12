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
     public function addMeeting(){
          $headers = $this->input->request_headers();
          if($headers != null && array_key_exists('x-device-id',$headers) && array_key_exists('x-token',$headers) ){
              $this->load->model('MeetingModel');
              $json = json_decode(file_get_contents('php://input'));
              $meetingTitle = $json->name;
              $invites =  $json->invite;
              $date = $json->time;
              $id = uniqid();
            $response =   $this->meetingModel->addMeeting($id,$meetingTitle,$invites,$date);
                 if($response){
                     redirect(base_url().'mom');
                 }
                 else{
                     redirect(base_url().'error');
                 }

          }

     }
 }

?>