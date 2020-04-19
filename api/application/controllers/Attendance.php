<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {

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

	public function getLogs($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('attendanceModel');
				$data['result'] = $this->attendanceModel->getUserLogs($userid);
				http_response_code(200);
				echo json_encode($data);
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	
	}

	public function sendNotification(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$clockedTime = $json->clockedTime;
				$signInDate = $json->signInDate;
				$memberId = $json->memberId;
				$centerId = $json->centerId;
				$sendNotificationYN = $json->sendNotificationYN;
				$this->load->model('attendanceModel');
				$this->load->model('utilModel');
				$visit = $this->attendanceModel->getVisitEntry($memberId,$centerId,$signInDate);
				$center = $this->utilModel->getCenterById($centerId);
				$user = $this->authModel->getUserDetails($memberId);
				$data['centerName'] = $center->name;
				$data['centerId'] = $centerId;
				$data['userId'] = $memberId;
				$data['userName'] = $user->name;
				$data['signInTime'] = $clockedTime;
				if($visit != null){
					$data['visitId'] = $visit->id;
					$data['signInTime'] = $visit->signInTime;
					$data['signOutTime'] = $clockedTime;
					$data['reason'] = $visit->reason;
				}
				$data['type'] = "attendance";
				if($sendNotificationYN == "Y")
					$this->firebase->sendMessage('New Login','You were logged in',$data,$memberId);
				http_response_code(200);
				echo json_encode($data);
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function signIn(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$startTime = $json->startTime;
				$signInDate = $json->signInDate;
				$reason = $json->reason;
				$memberid = $json->memberid;
				$centerid = $json->centerid;
				$this->load->model('attendanceModel');
				$this->attendanceModel->insertLog($memberid,$centerid,$startTime,$signInDate,$reason);
				$data['Status'] = "SUCCESS";
				http_response_code(200);
				echo json_encode($data);
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}


	public function signOut(){

		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$visitId = $json->visitId;
				$signOutTime = $json->signOutTime;
				$leftCampus = $json->leftCampus;
				$reason = $json->reason;
				$this->load->model('attendanceModel');
				$this->attendanceModel->updateLog($visitId,$signOutTime,$reason,$leftCampus);
				$data['Status'] = "SUCCESS";
				http_response_code(200);
				echo json_encode($data);
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

}