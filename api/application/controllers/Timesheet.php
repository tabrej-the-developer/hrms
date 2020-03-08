<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timesheet extends CI_Controller{

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

	public function getPastTimesheet($centerid,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('timesheetModel');
				$timesheets = $this->timesheetModel->getAllTimesheets($centerid);
				$data['timesheets'] = [];
				foreach ($timesheets as $timesh) {
					if($timesh->createdBy == $res->userid || $timesh->status == 'Published'){
						$var['startDate'] = $timesh->startDate;
						$var['endDate'] = $timesh->endDate;
						$var['id'] = $timesh->id;
						$var['isEditYN'] = $timesh->createdBy == $userid ? "Y" : "N";
						$var['status'] = $timesh->status;
						array_push($data['timesheets'],$var);
					}
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

	public function createTimesheet(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$startDate = $json->startDate;
				$userid = $json->userid;
				$centerid = $json->centerid;
				$userDetails = $this->authModel->getUserDetails($userid);
				if(date('D',strtotime($startDate)) != 'Mon'){
						$data['Status'] = 'ERROR';
						$data['Message'] = "Timesheets start from Monday";
				}
				else if($userDetails != null && ($userDetails->role == ADMIN || $userDetails->role == SUPERADMIN)){
					$this->load->model('timesheetModel');
					$existingTimesheet = $this->timesheetModel->getTimesheetFromDate($startDate,$centerid);
					if($existingTimesheet == null){
						$startDate = date('Y-m-d', strtotime($startDate));
						$endDate = date( "Y-m-d", strtotime( "$startDate +13 day" ));
						$timesheetId = $this->timesheetModel->createTimesheet($centerid,$startDate,$endDate,$userid);
						$data['Status'] = "SUCCESS";
						$data['timeSheetId'] = $timesheetId;
					}
					else{
						$data['Status'] = "ERROR";
						$data['Message'] = "A timesheet already exists for the date passed";
					}
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

	// public function getTimesheet($timesheetid,$userid){
	// 	$headers = $this->input->request_headers();
	// 	if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
	// 		$this->load->model('authModel');
	// 		$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
	// 		if($res != null && $res->userid == $userid){
	// 			$this->load->model('timesheetModel');
	// 			$timesheet = $this->timesheetModel->getTimesheet($timesheetid);
	// 			if($timesheet != null){
	// 				$currentDay = 0;
	// 				$data['startDate'] = $timesheet->startDate;
	// 				$data['endDate'] = $timesheet->endDate;
	// 				$data['id'] = $timesheet->id;
	// 				$data['isEditYN'] = $timesheet->createdBy == $userid ? "Y" : "N";
	// 				$data['status'] = $timesheet->status;
	// 				$data['timesheet'] = array();
					
	// 				while ($currentDay < 14) {
	// 					$currentDate = date( "Y-m-d", strtotime( "$timesheet->startDate +$currentDay day" ));
	// 					$payrollEntities = $this->timesheetModel->getPayrollShifts($currentDate,$timesheet->id);
	// 					$mData['employees'] = array();
	// 					foreach ($payrollEntities as $payroll) {
	// 						if($payroll->userid == $userid || $userDetails->role == SUPERADMIN || $userDetails->role == ADMIN){
	// 							$var['empId'] = $payroll->userid;
	// 							$empDetails = $this->authModel->getUserDetails($payroll->userid);
	// 							$var['empName'] = $empDetails->name;
	// 							$var['empTitle'] = $empDetails->title;
	// 							$var['hourlyRate'] = $empDetails->hourlyRate;
	// 							$var['payrollShift'] = [];
	// 							$var['payrollShift']['regularHours'] = $payroll->regularHours;
	// 							$var['payrollShift']['overtimeHours'] = $payroll->overtimeHours;
	// 							$var['payrollShift']['status'] = $payroll->status;
	// 							$visits = $this->timesheetModel->getAllVisits($payroll->userid,$currentDate,$timesheet->centerid);
	// 							$var['visits'] = array();
	// 							foreach ($visits as $v) {
	// 								$rav['id'] = $v->id;
	// 								$rav['signInTime'] = $v->signInTime;
	// 								$rav['signOutTime'] = $v->signOutTime;
	// 								$rav['reason'] = $v->reason;
	// 								$rav['status'] = $v->status;
	// 								array_push($var['visits'],$rav);
	// 							}
	// 							array_push($mData['employees'], $var);
	// 						}
	// 					}
	// 					$visitors = $this->timesheetModel->getVisitsNotOnDate($currentDate,$timesheet->centerid,$timesheet->id);
	// 					foreach ($visitors as $viz) {
	// 						$var['empId'] = $viz->userid;
	// 						$empDetails = $this->authModel->getUserDetails($viz->userid);
	// 						$var['empName'] = $empDetails->name;
	// 						$var['empTitle'] = $empDetails->title;
	// 						$var['hourlyRate'] = $empDetails->hourlyRate;
	// 						$visits = $this->timesheetModel->getAllVisits($viz->userid,$currentDate,$timesheet->centerid);
	// 						$var['visits'] = array();
	// 						foreach ($visits as $v) {
	// 							$rav['id'] = $v->id;
	// 							$rav['signInTime'] = $v->signInTime;
	// 							$rav['signOutTime'] = $v->signOutTime;
	// 							$rav['reason'] = $v->reason;
	// 							$rav['status'] = $v->status;
	// 							array_push($var['visits'],$rav);
	// 						}
	// 						array_push($mData['employees'],$var);
	// 					}
	// 					$mData['currentDate'] = $currentDate;
	// 					array_push($data['timesheet'], $mData);
	// 					$currentDay++;
	// 				}
	// 			}
	// 			else{
	// 				$data['Status'] = "ERROR";
	// 				$data['Message'] = "Invalid timesheet id";
	// 			}
	// 			http_response_code(200);
	// 			echo json_encode($data);
	// 		}
	// 		else{
	// 			http_response_code(401);
	// 		}
	// 	}
	// 	else{
	// 		http_response_code(401);
	// 	}
	// }

	public function getTimesheet($timesheetid,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('timesheetModel');
				$this->load->model('rostersModel');
				$this->load->model('payrollModel');
				$timesheet = $this->timesheetModel->getTimesheet($timesheetid);
				if($timesheet != null){
					$currentDay = 0;
					$data['startDate'] = $timesheet->startDate;
					$data['endDate'] = $timesheet->endDate;
					$data['id'] = $timesheet->id;
					$data['isEditYN'] = $timesheet->createdBy == $userid ? "Y" : "N";
					$data['status'] = $timesheet->status;
					$data['timesheet'] = array();
					
					while ($currentDay < 14) {
						$currentDate = date( "Y-m-d", strtotime( "$timesheet->startDate +$currentDay day" ));
						$rosteredEmployees = $this->timesheetModel->getUniqueVisitorsWithRoster($currentDate,$timesheet->centerid);
						$unrosteredEmployees = $this->timesheetModel->getUniqueVisitorsWithoutRoster($currentDate,$timesheet->centerid);
						$mData['rosteredEmployees'] = array();
						$mData['unrosteredEmployees'] = array();
						foreach ($rosteredEmployees as $empId) {
							$userDetails = $this->authModel->getUserDetails($empId->users);
							$var['empId'] = $userDetails->id;
							$var['empName'] = $userDetails->name;
							$var['hourlyRate'] = $userDetails->hourlyRate;
							$var['rosterShift'] = [];
							$rosterDetails = $this->rostersModel->getShiftDetails($empId->users,$currentDate);
							$var['rosterShift']['startTime'] = $rosterDetails->startTime;
							$var['rosterShift']['endTime'] = $rosterDetails->endTime;
							$var['rosterShift']['roleName'] = $this->rostersModel->getRole($rosterDetails->roleid);
							$clockedTimes = $this->timesheetModel->getAllVisits($empId->users,$currentDate,$timesheet->centerid);
							$var['clockedTimes'] = array();
							foreach ($clockedTimes as $clocks) {
								$mar['startTime'] = $clocks->signInTime;
								$mar['endTime'] = $clocks->signOutTime;
								$mar['message'] = $clocks->message;
								$mar['reason'] = $clocks->reason;
								array_push($var['clockedTimes'],$mar);
							}
							$payedShifts = $this->timesheetModel->getPayrollShifts($currentDate,$timesheetid,$empId->users);
							$var['payrollShifts'] = array();
							foreach ($payedShifts as $paySh) {
								$mar['startTime'] = $paySh->startTime;
								$mar['endTime'] = $paySh->endTime;
								$mar['status'] = $paySh->status;
								$mar['payrollTypeId'] = $paySh->payrollType;
								$mar['payrollType'] = $this->payrollModel->getPayrollType($paySh->payrollType);
								array_push($var['payrollShifts'],$mar);
							}
							array_push($mData['rosteredEmployees'],$var);
						}

						foreach ($unrosteredEmployees as $empId) {
							$userDetails = $this->authModel->getUserDetails($empId->users);
							$var['empId'] = $userDetails->id;
							$var['empName'] = $userDetails->name;
							$var['hourlyRate'] = $userDetails->hourlyRate;
							$var['rosterShift'] = [];
							$clockedTimes = $this->timesheetModel->getAllVisits($empId->users,$currentDate,$timesheet->centerid);
							$var['clockedTimes'] = array();
							foreach ($clockedTimes as $clocks) {
								$mar['startTime'] = $clocks->signInTime;
								$mar['endTime'] = $clocks->signOutTime;
								$mar['message'] = $clocks->message;
								$mar['reason'] = $clocks->reason;
								array_push($var['clockedTimes'],$mar);
							}
							$payedShifts = $this->timesheetModel->getPayrollShifts($currentDate,$timesheetid,$empId->users);
							$var['payrollShifts'] = array();
							foreach ($payedShifts as $paySh) {
								$mar['startTime'] = $paySh->startTime;
								$mar['endTime'] = $paySh->endTime;
								$mar['status'] = $paySh->status;
								$mar['payrollTypeId'] = $paySh->payrollType;
								$mar['payrollType'] = $this->payrollModel->getPayrollType($paySh->payrollType);
								array_push($var['payrollShifts'],$mar);
							}
							if($clockedTimes != null || $payedShifts != null)
								array_push($mData['unrosteredEmployees'],$var);
						}

						$mData['currentDate'] = $currentDate;
						array_push($data['timesheet'], $mData);
						$currentDay++;
					}
				}
				else{
					$data['Status'] = "ERROR";
					$data['Message'] = "Invalid timesheet id";
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

	public function createPayrollEntry(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$empId = $json->empId;
				$userid = $json->userid;
				$shiftDate = $json->shiftDate;
				$timesheetid = $json->timesheetid;
				$visits = $json->visits;
				$this->load->model('timesheetModel');
				foreach ($visits as $v) {
					if($v->id != null && $v->status != null){
						$this->timesheetModel->createPayrollEntry($timesheetid,$empId,$shiftDate,$v->startTime,$v->endTime,$userid,$v->payType);
						//$this->timesheetModel->updateVisitStatus($v->id,$v->status,$v->startTime,$v->endTime);
						// if($v->status == "Accepted"){
						// 	$totalHours += ($v->endTime - $v->startTime);
						// }
					}
				}
				// if($totalHours == ($regularHours + $overtimeHours)){
				// 	$this->timesheetModel->createPayrollEntry($timesheetid,$empId,$shiftDate,$regularHours,$overtimeHours,$userid);
				// 	$data['Status'] = 'SUCCESS';
				// }
				// else{
				// 	$data['Status'] = "ERROR";
				// 	$data['Message'] = "Data do not match";
				// }
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