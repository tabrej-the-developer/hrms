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
					if($timesh->createdBy == $res->userid || $timesh->status != 'Draft'){
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

	public function postTimesheetToXero($timesheetId){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$this->load->model('timesheetModel');
				$this->load->model('settingsModel');
				$this->load->model('rostersModel');
				$this->load->model('utilModel');
				$currentDay = 0;
				$timesheet = $this->timesheetModel->getTimesheet($timesheetId);
				$userDetails = $this->utilModel->getUserDetails($json->userid);
				$usersList = $this->timesheetModel->getUsersByTimesheetId($timesheetId);
				$startDate = new DateTime($timesheet->startDate);
				$endDate = new DateTime($timesheet->endDate);
				$startDate = "/Date(".$startDate->format('Uu')."+0000)/";
				$endDate = "/Date(".$endDate->format('Uu')."+0000)/";
				$Timesheets['Timesheets'] = [];
				foreach ($usersList as $user) {
					$payrollTypes = $this->timesheetModel->getPayrollShiftTypesByUser($timesheetId,$user->userid);
					$employeeDetails = $this->timesheetModel->getEmployeeDetails($user->userid);
					$sheet = [];
					$sheet['StartDate'] = $startDate;
					$sheet['EndDate'] = $endDate;
					$sheet['EmployeeID'] = isset($employeeDetails->xeroEmployeeId) ? $employeeDetails->xeroEmployeeId : 'ab';
					$sheet['TimesheetLines'] = [];
					
					foreach ($payrollTypes as $payrollType){
						$lines = [];
						// print_r($payrollType);
					$lines['earningRateId'] = $payrollType->payrollType;
					$lines['NumberOfUnits'] = [];
						while ($currentDay < 14) {
							$unit = 0;
							$currentDate = date( "Y-m-d", strtotime( "$timesheet->startDate +$currentDay day" ));
							$payrollShifts = $this->timesheetModel->getPayrollShiftsById($timesheetId,$currentDate,$user->userid,$payrollType->payrollType);
							if($payrollShifts == null or $payrollShifts == ''){
								foreach ($payrollShifts as $payrollShift) {
									$unit = (intval($payrollShift->clockedOutTime) - intval($payrollShift->clockedInTime))/100;
								array_push($lines['NumberOfUnits'],$unit);
								}
							}
								else{
									array_push($lines['NumberOfUnits'],0);
								}
							$currentDay++;
						}
							array_push($sheet['TimesheetLines'],$lines);
						}
						array_push($Timesheets['Timesheets'],$sheet);
					}
				$this->load->model('payrollModel');
				$xeroTokens = $this->xeroModel->getXeroToken();
					if($xeroTokens != null){
						$access_token = $xeroTokens->access_token;
						$tenant_id = $xeroTokens->tenant_id;
					}
					$val = $this->postTimesheetDataToXero($Timesheets,$access_token,$tenant_id);
	 					if($val != NULL){
	 						if($val->Status == 401){
	 							$refresh = $this->refreshXeroToken($refresh_token);
	 							$refresh = json_decode($refresh);
	 							$access_token = $refresh->access_token;
	 							$expires_in = $refresh->expires_in;
	 							$refresh_token = $refresh->refresh_token;
	 							$this->xeroModel->insertNewToken($access_token,$refresh_token,$tenant_id,$expires_in);
	 							$val = $this->postTimesheetDataToXero($Timesheets,$access_token,$tenant_id);
	 						}
	 					}
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

	function postTimesheetDataToXero($data,$access_token,$tenant_id){
	$url = "https://api.xero.com/payroll.xro/1.0/Timesheets";
		$ch =  curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
			'Content-Type:application/json',
			'Authorization:Bearer '.$access_token,
			'Xero-tenant-id:'.$tenant_id
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		$server_output = curl_exec($ch);
		return $server_output;
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
				$this->load->model('leaveModel');
				$timesheet = $this->timesheetModel->getTimesheet($timesheetid);
				if($timesheet != null){
					$currentDay = 0;
					$data['startDate'] = $timesheet->startDate;
					$data['endDate'] = $timesheet->endDate;
					$data['id'] = $timesheet->id;
					$data['isEditYN'] = $timesheet->createdBy == $userid ? "Y" : "N";
					$data['status'] = $timesheet->status;
					$data['timesheet'] = array();
					$rosteredEmployees = $this->timesheetModel->getUniqueVisitorsWithRoster($data['startDate'],$timesheet->centerid);

					print_r($rosteredEmployees);
					$unrosteredEmployees = $this->timesheetModel->getUniqueVisitorsWithoutRoster($data['startDate'],$timesheet->centerid);				
				while ($currentDay < 14) {
					$currentDate = date( "Y-m-d", strtotime( "$timesheet->startDate +$currentDay day" ));

						$mData['rosteredEmployees'] = array();
						$mData['unrosteredEmployees'] = array();
						foreach ($rosteredEmployees as $empId) {
							$userDetails = $this->authModel->getUserDetails($empId->users);
							$var['empId'] = $userDetails->id;
							$var['empName'] = $userDetails->name;
							$var['level'] = $userDetails->level;
							$var['rosterShift'] = [];
							$leaveApp = $this->leaveModel->getLeaveApplicationForUser($userDetails->id,$currentDate);
							if($leaveApp != null){
								$var['isOnLeave'] = 'Y';
								$var['leaveDetails'] = [];
								$leaveDetails = $this->leaveModel->getLeaveType($leaveApp->leaveId);
								$var['leaveDetails']['leaveId'] = $leaveApp->leaveId;
								$var['leaveDetails']['leaveStartDate'] = $leaveApp->startDate;
								$var['leaveDetails']['leaveEndDate'] = $leaveApp->endDate;
								$var['leaveDetails']['leaveNotes'] = $leaveApp->notes;
								$var['leaveDetails']['leaveNoOfHours'] = $leaveApp->noOfHours;
								$var['leaveDetails']['leaveStatus'] = $leaveApp->status;
								$var['leaveDetails']['leaveName'] = $leaveDetails->name;
								$var['leaveDetails']['leavePaidYN'] = $leaveDetails->isPaidYN;
								$var['leaveDetails']['leaveShowOnPaySlip'] = $leaveDetails->showOnPaySlipYN;
							}
							else{
								$var['isOnLeave'] = 'N';
								$rosterDetails = $this->rostersModel->getShiftDetails($empId->users,$currentDate);
								$var['rosterShift']['startTime'] = $rosterDetails->startTime;
								$var['rosterShift']['endTime'] = $rosterDetails->endTime;
								$var['rosterShift']['roleName'] = $this->rostersModel->getRole($rosterDetails->roleid);
								$clockedTimes = $this->timesheetModel->getAllVisits($empId->users,$currentDate,$timesheet->centerid);
								$meetingTimes = $this->timesheetModel->getMeetingTime($currentDate,$empId->users);
								$var['clockedTimes'] = array();
								foreach ($clockedTimes as $clocks) {
									$mar['startTime'] = $clocks->signInTime;
									$mar['endTime'] = $clocks->signOutTime;
									$mar['message'] = $clocks->message;
									$mar['reason'] = $clocks->reason;
									array_push($var['clockedTimes'],$mar);
								}
								foreach ($meetingTimes as $mee) {
									$meet['startTime'] = intval($mee->time)*100;
									$meet['endTime'] = intval($mee->eTime)*100;
									$meet['message'] = "Meeting";
									$meet['reason'] = "Meeting";
									array_push($var['clockedTimes'],$meet);
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
							}
							array_push($mData['rosteredEmployees'],$var);
						}

						foreach ($unrosteredEmployees as $empId) {
							$userDetails = $this->authModel->getUserDetails($empId->users);
							$var['empId'] = $userDetails->id;
							$var['empName'] = $userDetails->name;
							$var['level'] = $userDetails->level;
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
							$var['isOnLeave'] = "N";
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

	public function getRosterShifts($userid,$empId){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$date = $this->input->get('date');
				$this->load->model('timesheetModel');
				$data = $this->timesheetModel->getRosterShift($date,$empId);
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
					$this->timesheetModel->createPayrollEntry($timesheetid,$empId,$shiftDate,$v->clockedInTime,$v->clockedOutTime,$v->startTime,$v->endTime,$userid,$v->payType);
				}
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