<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends CI_Controller{

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

	public function GetAllLeaveTypes($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$userDetails = $this->authModel->getSuperAdminId($userid);
				$this->load->model('leaveModel');
				$leaveTypes = $this->leaveModel->getLeaveTypeBySuperadmin($userDetails->id);
				$data = array();
				foreach($leaveTypes as $lt){
					$var['id'] = $lt->id;
					$var['name'] = $lt->name;
					$var['slug'] = $lt->slug;
					$var['isPaidYN'] = $lt->isPaidYN;
					$var['showOnPaySlipYN'] = $lt->showOnPaySlipYN;
					$var['currentRecordYN'] = $lt->currentRecordYN;
					array_push($data,$var);
				}
				$mdata['leaveTypes'] = $data;
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

	public function CreateLeaveType(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$name = $json->name;
				$slug = $json->slug;
				$isPaidYN = $json->isPaidYN;
				$showOnPaySlipYN = $json->showOnPaySlipYN;
				$userid = $json->userid;
				$userDetails = $this->authModel->getUserDetails($userid);
				$this->load->model('xeroModel');
				if($userDetails != null && $userDetails->role == SUPERADMIN){

					//xero 
					$xeroTokens = $this->xeroModel->getXeroToken();
					if($xeroTokens != null){
						$access_token = $xeroTokens->access_token;
						$tenant_id = $xeroTokens->tenant_id;
						$data['Name'] = $name;
						$data['TypeOfUnits'] = "Hours";
						$data['IsPaidLeave'] = $isPaidYN == "Y";
						$data['ShowOnPayslip'] = $showOnPaySlipYN == "Y";
						$mdata['LeaveTypes'] = array();
						array_push($mdata['LeaveTypes'], $data);
						$val = $this->postCreateLeaveType($access_token,$tenant_id,json_encode($mdata));
						$val = json_decode($val);
						var_dump($val);
						if($val->Status == 401){
							$refresh = $this->refreshXeroToken($access_token);
							var_dump($refresh);
						}
					}


					// $this->load->model('leaveModel');
					// $this->leaveModel->createLeaveType($name,$isPaidYN,$slug,$userid);
					// $data['Status'] = 'SUCCESS';
					// http_response_code(200);
					// echo json_encode($data);
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


	public function EditLeaveType(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$leaveId = $json->leaveId;
				$name = $json->name;
				$slug = $json->slug;
				$isPaidYN = $json->isPaidYN;
				$userid = $json->userid;
				$userDetails = $this->authModel->getUserDetails($userid);
				if($userDetails != null && $userDetails->role == SUPERADMIN){
					$this->load->model('leaveModel');
					$this->leaveModel->editLeaveType($leaveId,$name,$isPaidYN,$slug);
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


	public function DeleteLeaveType(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json != null && $res != null && $res->userid == $json->userid){
				$leaveId = $json->leaveId;
				$userid = $json->userid;
				$userDetails = $this->authModel->getUserDetails($userid);
				if($userDetails != null && $userDetails->role == SUPERADMIN){
					$this->load->model('leaveModel');
					$this->leaveModel->deleteLeaveType($leaveId);
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

	public function GetAllLeavesByCenter($userid,$centerid,$startDate=null,$endDate=null){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('leaveModel');
				$allLeaves = $this->leaveModel->getAllLeavesByCenter($centerid,$startDate,$endDate);
				$data = array();
				foreach ($allLeaves as $leaveApp) {
					$var['id'] = $leaveApp->applicationId;
					$var['userid'] = $leaveApp->userid;
					$userDetails = $this->authModel->getUserDetails($var['userid']);
					$var['name'] = $userDetails->name;
					$var['title'] = $userDetails->title;
					$var['appliedDate'] = $leaveApp->appliedDate;
					$leaveDetails = $this->leaveModel->getLeaveType($leaveApp->leaveId);
					if($leaveDetails != null){
						$var['leaveTypeName'] = $leaveDetails->name;
						$var['leaveTypeSlug'] = $leaveDetails->slug;
					}
					$var['startDate'] = $leaveApp->startDate;
					$var['endDate'] = $leaveApp->endDate;
					$var['status'] = $leaveApp->status == 1 ? "Applied" : ($leaveApp->status == 2 ? "Approved" : "Rejected");
					$var['notes'] = $leaveApp->notes;
					array_push($data,$var);
				}
				$mdata['centerId'] = $centerid;
				$mdata['leaves'] = $data;
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

	public function GetAllLeavesByUser($userid,$memeberid,$startDate=null,$endDate=null){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('leaveModel');
				$allLeaves = $this->leaveModel->getAllLeavesByUser($userid,$startDate,$endDate);
				$userDetails = $this->authModel->getUserDetails($memeberid);
				$data = array();
				foreach ($allLeaves as $leaveApp) {
					$var['id'] = $leaveApp->applicationId;
					$var['appliedDate'] = $leaveApp->appliedDate;
					$leaveDetails = $this->leaveModel->getLeaveType($leaveApp->leaveId);
					$var['leaveTypeName'] = $leaveDetails->name;
					$var['leaveTypeSlug'] = $leaveDetails->slug;
					$var['startDate'] = $leaveApp->startDate;
					$var['noOfHours'] = $leaveApp->noOfHours;
					$var['endDate'] = $leaveApp->endDate;
					$var['status'] = $leaveApp->status == 1 ? "Applied" : ($leaveApp->status == 2 ? "Approved" : "Rejected");
					$var['notes'] = $leaveApp->notes;
					$var['userid'] = $leaveApp->userid;
					$userDetails = $this->authModel->getUserDetails($var['userid']);
					$var['name'] = $userDetails->name;
					$var['title'] = $userDetails->title;
					array_push($data,$var);
				}
				// $mdata['userid'] = $memeberid;
				// $mdata['name'] = $userDetails->name;
				// $mdata['title'] = $userDetails->title;
				$mdata['leaves'] = $data;
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

	public function ApplyLeave(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$userid = $json->userid;
				$leaveTypeId = $json->leaveTypeId;
				$startDate = $json->startDate;
				$endDate = $json->endDate;
				$notes = $json->notes;
				$noOfHours = $json->noOfHours;
				$this->load->model('leaveModel');
				$this->leaveModel->applyLeave($userid,$leaveTypeId,$noOfHours,$startDate,$endDate,$notes);
				$data['Status'] = 'SUCCESS';
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

	// public function GetLeaveBalance($userid){
	// 	$headers = $this->input->request_headers();
	// 	if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
	// 		$this->load->model('authModel');
	// 		$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
	// 		if($res != null && $res->userid == $userid){
	// 			$this->load->model('leaveModel');
	// 			$allLeaves = $this->leaveModel->getLeaveBalance($userid);
	// 			$data = array();
	// 			foreach ($allLeaves as $lb) {
	// 				$leaveDetails = $this->leaveModel->getLeaveType($lb->leaveId);
	// 				$var['leaveTypeId'] = $lb->leaveId;
	// 				$var['leaveName'] = $leaveDetails->name;
	// 				$var['leaveSlug'] = $leaveDetails->slug;
	// 				$var['isPaidYN'] = $leaveDetails->isPaidYN;
	// 				$var['openingBalance'] = $lb->leavesAllocated;
	// 				$var['closingBalance'] = $lb->leavesRemaining;
	// 				$var['period'] = $lb->leavePeriod;
	// 				$var['startDate'] = $lb->startDate;
	// 				array_push($data,$var);
	// 			}
	// 			$mdata['balance'] = $data;
	// 			http_response_code(200);
	// 			echo json_encode($mdata);
	// 		}
	// 		else{
	// 			http_response_code(401);
	// 		}
	// 	}
	// 	else{
	// 		http_response_code(401);
	// 	}
	// }

	public function GetLeaveBalance($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('leaveModel');
				$accuredLeaves = $this->leaveModel->getAccruedLeaves($userid);
				$data = array();
				foreach ($accuredLeaves as $aLeave) {
					$hoursWorked = $this->leaveModel->getTotalOrdinaryHorusWorked($userid,$aLeave->accrualStartDate);
					$leavesTaken = $this->leaveModel->getSumOfLeave($userid,$aLeave->leaveId,$aLeave->accrualStartDate);
					$leaveDets = $this->leaveModel->getLeaveType($aLeave->leaveId);
					$var['leaveId'] = $aLeave->leaveId;
					$var['leaveName'] = $leaveDets->name;
					$var['leaveSlug'] = $leaveDets->slug;
					$var['isPaidYN'] = $leaveDets->isPaidYN;
					$var['accrualRatio'] = $aLeave->accrualRatio;
					$var['leavesRemaining'] = $hoursWorked->sum * $aLeave->accrualRatio - $leavesTaken->sum;
					array_push($data,$var);
				}

				$mdata['balance'] = $data;
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


	public function UpdateLeaveApplication(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$leaveApplication = $json->leaveApplication;
				$status = $json->status;
				$this->load->model('leaveModel');
				$this->leaveModel->updateLeave($leaveApplication,$status);
				$data['Status'] = 'SUCCESS';
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



	function postCreateLeaveType($access_token,$tenant_id,$postData){
		$url = "https://api.xero.com/payroll.xro/1.0/PayItems";
		$ch =  curl_init($url);
       	curl_setopt($ch, CURLOPT_URL,$url);
       	curl_setopt($ch, CURLOPT_POST,1);
       	curl_setopt($ch, CURLOPT_POSTFIELDS,$postData);
       	curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
           'Content-Type:application/json',
           'Authorization:Bearer '.$access_token,
           'Xero-tenant-id:'.$tenant_id
       	));
       	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		$server_output = curl_exec($ch);
		return $server_output;
	}

	function refreshXeroToken($access_token){

		$postData = "grant_type=refresh_token";
		$postData .= "&refresh_token=".$access_token;

		$url = "https://identity.xero.com/connect/token";
		$ch =  curl_init($url);
       	curl_setopt($ch, CURLOPT_URL,$url);
       	curl_setopt($ch, CURLOPT_POST,1);
       	curl_setopt($ch, CURLOPT_POSTFIELDS,$postData);
       	curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
           'Content-Type:application/x-www-form-urlencoded',
           'Authorization:Basic '.base64_encode(XERO_CLIENT_ID.":".XERO_CLIENT_SECRET)
       	));
       	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		$server_output = curl_exec($ch);
		return $server_output;
	}
}