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
              $meetingTitle = $json->title;
              $location = $json->location;
              $collab = $json->collab;
              $invites =  $json->invites;
              $date = $json->date;
              $time = $json->time;
              $agenda = $json->agenda;
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
    
     public function meetingAttendence(){
         $headers = $this->input->request_headers();
         if($headers != null && array_key_exists('x-device-id',$headers) && array_key_exists('x-token',$headers) ){
             $this->load->model('MeetingModel');
             $json = json_decode(file_get_contents('php://input'));
             $attendence = $json->absent;
             $id = uniqid();
             $result = $this->meetingmModel->addAttendence($id,$attendence);
             if($result){
                 redirect(base_url().'mom/onBoard');
             }
             else{
                 return false;
             }
         }
     }

     public function meetingRecord(){
         $headers = $this->input->request_headers();
         if($headers != null && array_key_exists('x-device-id',$headers) && array_key_exists('x-token',$headers) ){
             $this->load->model('MeetingModel');
             $json = json_decode(file_get_contents('php://input'));
             $invites = $json->invites;
             $sentence = $json->sentence;
             $id = uniqid();
             $result = $this->meetingModel->addMeetingRecord($id,$invites,$sentence,);
             if($result){
                 redirect(base_url().'mom/summary');
             }
             else{
                 return false;
             }
                  
         }
     }
    public function meetingSummary(){
        $headers = $this->input->request_headers();
        if($headers != null && array_key_exists('x-device-id',$headers) && array_key_exists('x-token',$headers)){
            $this->load->model('MeetingModel');
            $json = json_decode(file_get_contents('php://input'));
            $summary = $json->summary;
            $id = uniqid();
            $result = $this->meetingModel->meetingSummary($id,$summary);
            if($result){
                redirect(base_url().'mom/');
            }
            else{
                return false;
            }
        }
    }
 }

?>