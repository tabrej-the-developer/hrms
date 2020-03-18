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
    
    public function getMeetings($id){
       $headers = $this->input->request_headers();
       if($headers != null && array_key_exists('x-device-id',$headers) && array_key_exists('x-token',$headers)){
           $this->load->model('meetingModel');
            $meetings = $this->meetingModel->getMeeting($id);
            $mdata= [];
            foreach($meetings as $m){
                $var['mid'] = $m->id;
                $var['userid'] = $m->loginid;
                $var['title'] = $m->title;
                $var['date'] = $m->date;
                $var['time'] = $m->time;
                $var['location'] = $m->location;
                array_push($mdata,$var);

            }
            http_response_code(200);
            echo json_encode($mdata);
            
       }
       else{
           $data['Message'] = "Something Went Wrong";
           http_response_code(401);
           echo json_encode($data);
       }
    }
    public function getParticipant($mid){
       
        $headers = $this->input->request_headers();
        if($headers != null && array_key_exists('x-device-id',$headers) && array_key_exists('x-token',$headers)){
            $this->load->model('meetingModel');
            $participants = $this->meetingModel->getPartcipant($mid);
            // var_dump($participants);
            // exit;
            $mdata = [];
            foreach($participants as $p){
                $var['uid'] = $p->user_id;
                array_push($mdata,$var);
            }
           
            http_response_code(200);
            echo json_encode($mdata);
        }
        else{
            $data['Error'] = 'Error';
            http_response_code(401);
            echo json_encode($data);
        }
    }

    public function Present($mid){
        $headers = $this->input->request_headers();
        if($headers != null && array_key_exists('x-device-id',$headers) && array_key_exists('x-token',$headers)){
            $this->load->model('meetingModel');
            $participants = $this->meetingModel->getPresent($mid);
            // var_dump($participants);
            // exit;
            $mdata = [];
            foreach($participants as $p){
                $var['uid'] = $p->user_id;
                array_push($mdata,$var);
            }
           
            http_response_code(200);
            echo json_encode($mdata);
        }
        else{
            $data['Error'] = 'Error';
            http_response_code(401);
            echo json_encode($data);
        }

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
         //var_dump($headers);
         if($headers != null && array_key_exists('x-device-id',$headers) && array_key_exists('x-token',$headers) ){
           // echo "h"; 
            $this->load->model('meetingModel');
           // var_dump(file_get_contents('php://input'));
             $json = json_decode(file_get_contents('php://input'));
            var_dump($json);
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
             $this->load->model('meetingModel');
             $json = json_decode(file_get_contents('php://input'));
            
             $invites =  $json->invites;
             $sentence = $json->sentence;
           
             $mId = '5e6f7b2d5b';
             $len = count($invites);
             for($it = 0; $it < $len;$it++){
                
             $this->meetingModel->addMeetingRecord($mId,$invites[$it],$sentence[$it]);
         }
            
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
    public function addSummary(){
        $headers = $this->input->request_headers();
        if($headers != null && array_key_exists('x-device-id',$headers) && array_key_exists('x-token',$headers)){
            $this->load->model('meetingModel');
            $json = json_decode(file_get_contents('php://input'));
            // var_dump($json);
            // exit;
            $summary = $json->summary;
            $t = $json->id;
            $len = count($summary);
            for($k = 0; $k < $len; $k++){
            
            $this->meetingModel->meetingSummary($t[$k],$summary[$k]);
            }
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

    public function getSummary($mid){
        $headers = $this->input->request_headers();
        if($headers != null && array_key_exists('x-device-id',$headers) && array_key_exists('x-token',$headers)){
            $this->load->model('meetingModel');
            $summary = $this->meetingModel->getSummary($mid);
            // var_dump($participants);
            // exit;
            $mdata = [];
            foreach($summary as $p){
                $var['id'] = $p->id;
                $var['text'] = $p->text;
                array_push($mdata,$var);
            }
           
            http_response_code(200);
            echo json_encode($mdata);
        }
        else{
            $data['Error'] = 'Error';
            http_response_code(401);
            echo json_encode($data);
        }
    }
 }

?>