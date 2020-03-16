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
              $this->load->model('meetingModel');
              $json = json_decode(file_get_contents('php://input'));
              var_dump($json);
              $id = uniqid();
              $meetingTitle = $json->title;
              $date    = $json->date;
              $time    = $json->time;
              $agenda  = $json->agenda;
              $collab  = $json->collab;
              $invites = $json->invites;
              $location = $json->location;
              $userId  = $json->userId;
              $response  =   $this->meetingModel->addMeeting($id,$meetingTitle,$date,$time,$location,$collab,$userId);
              foreach($agenda as $a):
              $this->meetingModel->addAgenda($id,$a);
              endforeach;
              foreach($invites as $i):    
              $this->meetingModel->addParticipant($id,$i);
              endforeach;
              $data['Status'] = 'Success';
              http_response_code(200);
              echo json_encode($data);
         
             
     }
         else{
             $data['Status'] = 'ERROR';
             http_response_code(401);
             echo json_encode($data);
         }
    }
    
     public function meetingAttendence(){
         
         $headers = $this->input->request_headers();
         if($headers != null && array_key_exists('x-device-id',$headers) && array_key_exists('x-token',$headers) ){
             $this->load->model('meetingModel');
             $json = json_decode(file_get_contents('php://input'));
            
             $attendence = $json->absent;
             $meetingId = $json->mId;
           
             
             foreach($attendence as $a):
                
             $this->meetingModel->addAttendence($meetingId,$a);
             endforeach;
                $data['Status'] = 'Success';
                http_response_code(200);
                echo json_encode($data);

             
             
         }
         else{
             $data['Status'] = 'Error';
             http_response_code(401);
             echo json_encode($data);
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
    public function addSummary(){
        $headers = $this->input->request_headers();
        if($headers != null && array_key_exists('x-device-id',$headers) && array_key_exists('x-token',$headers)){
            $this->load->model('meetingModel');
            $json = json_decode(file_get_contents('php://input'));
            $summary = $json->summary;
            $id = uniqid();
            // foreach($summary as $s):
            // $result = $this->meetingModel->meetingSummary($id,$s);
            // endforeach;
            $data['Status'] = 'Success';
            http_response_code(200);
            echo json_encode($data);
            
        }
        else{
            $data['Status'] = 'Error';
          echo json_encode($data);
        }
    }

 }

?>