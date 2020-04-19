<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends CI_Controller{

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

	public function index(){

	}

	public function getAllPayrollTypes($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('payrollModel');
				$types = $this->payrollModel->getAllPayrollTypes();
				$mdata['payrollTypes'] = $types;
				http_response_code(200);
				echo json_encode($mdata);
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function getAllEntitlements($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('payrollModel');
				$mdata['entitlements'] = $this->payrollModel->getAllEntitlements();
				http_response_code(200);
				echo json_encode($mdata);
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

		public function updateEntitlement($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$id  = $json->id;
				$name = $json->name;
				$rate = $json->rate;
				$userid = $json->userid;
				$userDetails = $this->authModel->getUserDetails($userid);
				if($userDetails != null && $userDetails->role == SUPERADMIN){
					$this->load->model('payrollModel');
					$this->payrollModel->updateEntitlement($id,$name,$rate);
					$data['Status'] = 'SUCCESS';
					http_response_code(200);
					echo json_encode($data);
				}
				else{

					$data['Status'] = 'ERROR';
					$data['Message'] = "You are not allowed";
				}
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function addEntitlement(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$name = $json->name;
				$rate = $json->rate;
				$userid = $json->userid;
				$userDetails = $this->authModel->getUserDetails($userid);
				if($userDetails != null && $userDetails->role == SUPERADMIN){
					$this->load->model('payrollModel');
					$this->payrollModel->addEntitlement($name,$rate,$userid);
					$data['Status'] = 'SUCCESS';
					http_response_code(200);
					echo json_encode($data);
				}
				else{

					$data['Status'] = 'ERROR';
					$data['Message'] = "You are not allowed";
				}
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

	public function getAllPayrollShifts($timesheetid,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('payrollModel');	
				$this->load->model('timesheetModel');			
				$timesheet = $this->timesheetModel->getTimesheet($timesheetid);
				$users = $this->payrollModel->getUniqueUsersForTimesheet($timesheetid);
				$data['timesheetid'] = $timesheetid;
				$data['startDate'] = $timesheet->startDate;
				$data['endDate'] = $timesheet->endDate;
				$data['employees'] = array();
				foreach ($users as $u) {
					$var['payrollShifts'] = $this->payrollModel->getAllPayrollShifts($timesheetid,$u->userid);
					$var['userDetails'] = $this->authModel->getUserDetails($u->userid);
					array_push($data['employees'],$var);
				}
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

	public function deleteEntitlement($entitlementId,$userid){
		$headers = $this->input->request_headers();
		   if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('payrollModel');
					$this->payrollModel->deleteEntitlement($entitlementId);
					$data['status'] = 'SUCCESS';
				}
				http_response_code(200);
				echo json_encode($data);
			}
			else{
				http_response_code(401);
				echo 'ERROR';
			}
	}

	public function getUserLevels($x,$userid ){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('payrollModel');
				$mdata['users'] = $this->payrollModel->getUserLevels($x);
				http_response_code(200);
				echo json_encode($mdata);
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

	// public function updateEntitlement($entitlementId){
	// 	$headers = $this->input->request_headers();
	// 	   if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
	// 		$this->load->model('authModel');
	// 		$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
	// 		$json = json_decode(file_get_contents('php://input'));
	// 		if($res != null && $res->userid == $json->suserid){
	// 			$name = $json->name;
	// 			$id
	// 			$hourlyRate = $json->hourlyRate;
	// 			$this->load->model('payrollModel');
	// 				$this->payrollModel->updateEntitlement($entitlementId,$name,$hourlyRate);
	// 				$data['status'] = 'SUCCESS';
	// 			}
	// 			http_response_code(200);
	// 			echo json_encode($data);
	// 		}
	// 		else{
	// 			http_response_code(401);
	// 			echo 'ERROR';
	// 		}
	// 	}
}
