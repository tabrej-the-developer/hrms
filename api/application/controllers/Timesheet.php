<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timesheet extends CI_Controller{

	function __construct() {
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-DEVICE-ID,X-TOKEN,X-DEVICE-TYPE, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
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
		$headers = array_change_key_case($headers);
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
						$var['payrollStatus'] = $this->timesheetModel->getPayrollStatus($timesh->id);
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
$headers = array_change_key_case($headers);
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

	public function  getPayruns($timesheetId,$userid){
		$this->load->model('xeroModel');
		$this->load->model('timesheetModel');
		$centerid = ($this->timesheetModel->getTimesheet($timesheetId))->centerid;
		$xeroTokens = $this->xeroModel->getXeroToken($centerid);
		// print_r($xeroTokens);
		if($xeroTokens != null){
			$access_token = $xeroTokens->access_token;
			$tenant_id = $xeroTokens->tenant_id;
			$refresh_token = $xeroTokens->refresh_token;
			$val = $this->getAllPayruns($access_token,$tenant_id);
			if($val != NULL){
				$val = json_decode($val);
				if($val->Status == 401){
					$refresh = $this->refreshXeroToken($refresh_token);
					$refresh = json_decode($refresh);
					// var_dump($refresh);
					$access_token = $refresh->access_token;
					$expires_in = $refresh->expires_in;
					$refresh_token = $refresh->refresh_token;
					$this->xeroModel->insertNewToken($access_token,$refresh_token,$tenant_id,$expires_in,$centerid);
					$val = $this->getAllPayruns($access_token,$tenant_id);
					$val = json_decode($val);
				}
				if($val->Status == "OK"){
					// print_r();
					if(count($val->PayRuns) > 0){
						$startDate = $val->PayRuns[0]->PaymentDate;
					$this->postTimesheetToXero($timesheetId,$userid,$centerid,$startDate);
					http_response_code(200);
					}
				}else{
					http_response_code(401);
				}
			}
		}
	}

	function getAllPayruns($access_token,$tenant_id){
		$url = "https://api.xero.com/payroll.xro/1.0/PayRuns";
		$ch =  curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
			'Content-Type:application/json',
			'Accept:application/json',
			'Authorization:Bearer '.$access_token,
			'Xero-tenant-id:'.$tenant_id
		));
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$server_output = curl_exec($ch);
		// var_dump($server_output);
		return $server_output;
	}

	function postTimesheetToXero($timesheetId,$userid,$centerid,$stDate){
		// $headers = $this->input->request_headers();
// $headers = array_change_key_case($headers);
		// if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			// $res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			// if( $res != null && $res->userid == $userid){
				$this->load->model('timesheetModel');
				$this->load->model('settingsModel');
				$this->load->model('rostersModel');
				$this->load->model('utilModel');
				$timesheet = $this->timesheetModel->getTimesheet($timesheetId);
				// var_dump($timesheet);
				$userDetails = $this->utilModel->getUserDetails($userid);
				// var_dump($userDetails);
				$usersList = $this->timesheetModel->getUsersByTimesheetId($timesheetId);
				// var_dump($usersList);
				// $startDate = new DateTime($timesheet->startDate);
				// $endDate = new DateTime($timesheet->endDate);
				// $startDate = "/Date(1606521600000+0000)/";
				// $endDate = "/Date(1605398400000+0000)/";

				// $startDate = "/Date(".$startDate->format('Uv')."+0000)/";
				// $endDate = "/Date(".$endDate->format('Uv')."+0000)/";

				preg_match( '/([\d]{13})/', $stDate, $matches );
				// echo $matches[0];
				// echo intval($matches[0])+1123200000;
				$startDate = $stDate;
				$endDate = "/Date(".(intval($matches[0])+1123200000)."+0000)/";
				$status = 'APPROVED';
				$Timesheets['Timesheets'] = [];
				// var_dump($usersList);
				foreach ($usersList as $user) {
					// var_dump($user);
					$payrollTypes = $this->timesheetModel->getPayrollShiftTypesByUser($timesheetId,$user->userid);
					$employeeDetails = $this->timesheetModel->getEmployeeDetails($user->userid);
					// var_dump($employeeDetails);
					$sheet = [];
					$sheet['StartDate'] = $startDate;
					$sheet['EndDate'] = $endDate;
					$sheet['Status'] = $status;
					$sheet['EmployeeID'] = isset($employeeDetails->xeroEmployeeId) ? $employeeDetails->xeroEmployeeId : '';
					$sheet['TimesheetLines'] = [];
					// var_dump($sheet);
					foreach ($payrollTypes as $payrollType){
						$currentDay = 0;
						$lines = [];
						// var_dump($payrollType);
					// $lines['EarningsRateID'] = isset($employeeDetails->ordinaryEarningEarningRateId) ? $employeeDetails->ordinaryEarningEarningRateId : null;
						$_payroll = $this->timesheetModel->getEarningsRateFromId($payrollType->payrollType);
						$lines['EarningsRateID'] = $_payroll->earningRateId;
					$lines['NumberOfUnits'] = [];
						while ($currentDay < 14) {
							$unit = 0;
							$currentDate = date( "Y-m-d", strtotime( "$timesheet->startDate +$currentDay day" ));
							$payrollShifts = $this->timesheetModel->getPayrollShiftsById($timesheetId,$currentDate,$user->userid,$payrollType->payrollType);
							if($payrollShifts != null && $payrollShifts != ''){
								// var_dump($payrollShifts);
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
						// var_dump($lines);
							array_push($sheet['TimesheetLines'],$lines);
						}
						// var_dump($sheet);
						array_push($Timesheets['Timesheets'],$sheet);
					}
					// print_r($Timesheets['Timesheets']);
				$this->load->model('payrollModel');
				$this->load->model('xeroModel');
				$xeroTokens = $this->xeroModel->getXeroToken($centerid);
				// var_dump($xeroTokens);
					if($xeroTokens != null){
						$access_token = $xeroTokens->access_token;
						$tenant_id = $xeroTokens->tenant_id;
						$refresh_token = $xeroTokens->refresh_token;
					$val = $this->postTimesheetDataToXero($Timesheets,$access_token,$tenant_id);
					$val = json_decode($val);
	 					if($val != NULL){
	 						 var_dump($val);
	 						if($val->Status == 401){
	 							$refresh = $this->refreshXeroToken($refresh_token);
	 							$refresh = json_decode($refresh);
	 							$access_token = $refresh->access_token;
	 							$expires_in = $refresh->expires_in;
	 							$refresh_token = $refresh->refresh_token;
	 							$this->xeroModel->insertNewToken($access_token,$refresh_token,$tenant_id,$expires_in);
	 							$val = $this->postTimesheetDataToXero($Timesheets,$access_token,$tenant_id);
								$val = json_decode($val);
	 						}
	 						 				// var_dump($val);
	 						if($val->Status == "OK"){
								// print_r();
								$this->postPayRun($timesheetId,$userid,$centerid);
							}
	 					}
	 				}
				// print_r($Timesheets);
				// $data['Status'] = "SUCCESS";
				// http_response_code(200);
				// echo json_encode($data);
		// 	}
		// 	else{
		// 		http_response_code(401);
		// 	}
		// }
		// else{
		// 	http_response_code(401);
		// }
	}

	public function postPayRun($timesheetId,$userid,$centerid){
		// $headers = $this->input->request_headers();
// $headers = array_change_key_case($headers);
		// if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
		// 	$this->load->model('authModel');
		// 	$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
		// 	// var_dump($res);
		// 	if($res != null && $res->userid == $userid){
		// echo "Post pay run";
		$this->load->model('payrollModel');
		$this->load->model('timesheetModel');
		$payrollCalendarId = $this->payrollModel->getAllPayrollCalendarId($timesheetId);
		// var_dump($payrollCalendarId);
		$payrollCalendar = array();
		$payrollCal = array();
		foreach($payrollCalendarId as $calendarId){
			$payrollCal['PayrollCalendarID'] = $calendarId->payrollCalendarId;
			$payrollCal['PayRunStatus'] = 'POSTED';
			array_push($payrollCalendar,$payrollCal);
		}

		$this->load->model('xeroModel');
		$xeroTokens = $this->xeroModel->getXeroToken($centerid);
		// var_dump($xeroTokens);
		if($xeroTokens != null){
			$access_token = $xeroTokens->access_token;
			$tenant_id = $xeroTokens->tenant_id;
			$refresh_token = $xeroTokens->refresh_token;
			// var_dump($payrollCalendar);
			$createPayrun = $this->createPayrun($payrollCalendar,$access_token,$tenant_id);
		  var_dump($createPayrun);
			$createPayrun = json_decode($createPayrun);
			if($createPayrun != NULL){
				if($createPayrun->Status == 401){
					$refresh = $this->refreshXeroToken($refresh_token);
					$refresh = json_decode($refresh);
					$access_token = $refresh->access_token;
					$expires_in = $refresh->expires_in;
					$refresh_token = $refresh->refresh_token;
					$this->xeroModel->insertNewToken($access_token,$refresh_token,$tenant_id,$expires_in);
					$createPayrun = $this->createPayrun($payrollCalendar,$access_token,$tenant_id);
					$createPayrun = json_decode($createPayrun);
				}
			}
	 						// var_dump($createPayrun);

	 		if($createPayrun->Status == 'OK'){
	 			foreach($createPayrun->PayRuns  as $payrun){
					if($payrun->PayRunID != null && $payrun->PayRunID != ""){
						$this->timesheetModel->storePayrunDetails($payrun->PayRunID,$timesheetId,$userid);
					}
	 				// var_dump($payrun);
					$xeroTokens = $this->xeroModel->getXeroToken($centerid);
						// var_dump($xeroTokens);
							if($xeroTokens != null){
								$access_token = $xeroTokens->access_token;
								$tenant_id = $xeroTokens->tenant_id;
								$refresh_token = $xeroTokens->refresh_token;
								$getPayruns = $this->getPayRun($payrun->PayRunID,$access_token,$tenant_id);
								$getPayruns = json_decode($getPayruns);
			 					if($getPayruns != NULL){
			 						if($getPayruns->Status == 401){
			 							$refresh = $this->refreshXeroToken($refresh_token);
			 							$refresh = json_decode($refresh);
			 							$access_token = $refresh->access_token;
			 							$expires_in = $refresh->expires_in;
			 							$refresh_token = $refresh->refresh_token;
			 							$this->xeroModel->insertNewToken($access_token,$refresh_token,$tenant_id,$expires_in);
			 							// TODO : store payrun ID, timesheetid
			 							$getPayruns = $this->getPayRun($payrun->PayRunID,$access_token,$tenant_id);
										$getPayruns = json_decode($getPayruns);
			 						}
					 					// var_dump($getPayruns);
			 						if($getPayruns->Status == "OK"){

										$pay['Wages'] = $getPayruns->PayRuns[0]->Wages;
										$pay['Deductions'] = $getPayruns->PayRuns[0]->Deductions;
										$pay['Tax'] = $getPayruns->PayRuns[0]->Tax;
										$pay['Super'] = $getPayruns->PayRuns[0]->Super;
										$pay['Reimbursement'] = $getPayruns->PayRuns[0]->Reimbursement;
										$pay['NetPay'] = $getPayruns->PayRuns[0]->NetPay;
										preg_match( '/([\d]{10})/', $getPayruns->PayRuns[0]->PayRunPeriodStartDate, $matches );
										$pay['StartDate']  = date( 'Y-m-d', $matches[0] );
										echo $pay['StartDate'];
										// $pay['StartDate'] = $getPayruns->PayRuns->PayRunPeriodStartDate;

					 					foreach($getPayruns->PayRuns[0]->Payslips as $payslip){
					 						$this->timesheetModel->insertPayslips($timesheetId,$payslip->EmployeeID,$payslip->PayslipID,$payrun->PayRunID,$pay['StartDate']);
					 					}
			 						}
			 					}
			 				}	
				}
			}
		}
				http_response_code(200);
				// echo json_encode($);
		// 	}
		// 	else{
		// 		http_response_code(401);
		// 	}
		// }
		// else{
		// 	http_response_code(401);
		// }
	} 

function createPayrun($payrollCalendarId,$access_token,$tenant_id){
	$url = "https://api.xero.com/payroll.xro/1.0/PayRuns";
		$ch =  curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($payrollCalendarId));
		curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
			'Content-Type:application/json',
			'Authorization:Bearer '.$access_token,
			'Xero-tenant-id:'.$tenant_id,
			'Accept:application/json'
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		$server_output = curl_exec($ch);
		return $server_output;
	}

	function getPayRun($payrunID,$access_token,$tenant_id){
		$url = "https://api.xero.com/payroll.xro/1.0/PayRuns/".$payrunID;
		echo $url;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
			'Content-Type:application/json',
			'Authorization:Bearer '.$access_token,
			'Xero-tenant-id:'.$tenant_id,
			'Accept:application/json'
		));
		$server_output = curl_exec($ch);
		// var_dump($server_output);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		// var_dump($httpcode);
		// if($httpcode == 200){
			return $server_output;
			curl_close ($ch);
		// }
		// else if($httpcode == 401){

		// }
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

	function postTimesheetDataToXero($data,$access_token,$tenant_id){
		// print_r(json_encode($data['Timesheets']));
	$url = "https://api.xero.com/payroll.xro/1.0/Timesheets";
		$ch =  curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data['Timesheets']));
		curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
			'Content-Type:application/json',
			'Authorization:Bearer '.$access_token,
			'Xero-tenant-id:'.$tenant_id,
			'Accept:application/json'
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			// var_dump($httpcode);
			// var_dump($url);
		$server_output = curl_exec($ch);
		// print_r($server_output);
		return $server_output;
	}

	// public function getTimesheet($timesheetid,$userid){
	// 	$headers = $this->input->request_headers();
// $headers = array_change_key_case($headers);
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
$headers = array_change_key_case($headers);
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
					$data['centerid'] = $timesheet->centerid;
					$data['timesheet'] = array();
					$rosteredEmployees = $this->timesheetModel->getUniqueVisitorsWithRoster($data['startDate'],$timesheet->centerid);
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
							$var['hourlyRate'] = $this->rostersModel->getHourlyRate($var['level']);
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
								$var['leaveDetails']['leaveName'] = isset($leaveDetails->name) ? $leaveDetails->name : "" ;
								$var['leaveDetails']['leavePaidYN'] = isset($leaveDetails->isPaidYN) ? $leaveDetails->isPaidYN : "" ;
								$var['leaveDetails']['leaveShowOnPaySlip'] = isset($leaveDetails->showOnPaySlipYN) ? $leaveDetails->showOnPaySlipYN : "" ;
							}
							else{
								$var['isOnLeave'] = 'N';
								$rosterDetails = $this->rostersModel->getShiftDetails($empId->users,$currentDate);
								if($rosterDetails != null){
									$var['rosterShift']['startTime'] = $rosterDetails->startTime;
									$var['rosterShift']['endTime'] = $rosterDetails->endTime;
									$var['rosterShift']['roleName'] = $this->rostersModel->getRole($rosterDetails->roleid);
								}
								$clockedTimes = $this->timesheetModel->getAllVisits($empId->users,$currentDate,$timesheet->centerid);
								$meetingTimes = $this->timesheetModel->getMeetingTime($currentDate,$empId->users);
								$var['clockedTimes'] = array();
								foreach ($clockedTimes as $clocks) {
									$mar['startTime'] = $clocks->signInTime;
									$mar['endTime'] = $clocks->signOutTime;
									$mar['message'] = $clocks->message;
									$mar['status'] = $clocks->status;
									array_push($var['clockedTimes'],$mar);
								}
								foreach ($meetingTimes as $mee) {
									$meet['startTime'] = intval($mee->time)*100;
									$meet['endTime'] = intval($mee->eTime)*100;
									$meet['message'] = "Meeting";
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
							// $userDetails = $this->authModel->getUserDetails($empId->users);
							// $var['empId'] = $userDetails->id;
							// $var['empName'] = $userDetails->name;
							// $var['level'] = $userDetails->level;
							// $var['rosterShift'] = [];
							// $clockedTimes = $this->timesheetModel->getAllVisits($empId->users,$currentDate,$timesheet->centerid);
							// $var['clockedTimes'] = array();
							// foreach ($clockedTimes as $clocks) {
							// 	$mar['startTime'] = $clocks->signInTime;
							// 	$mar['endTime'] = $clocks->signOutTime;
							// 	$mar['message'] = $clocks->message;
							// 	array_push($var['clockedTimes'],$mar);
							// }
							// $payedShifts = $this->timesheetModel->getPayrollShifts($currentDate,$timesheetid,$empId->users);
							// $var['payrollShifts'] = array();
							// foreach ($payedShifts as $paySh) {
							// 	$mar['startTime'] = $paySh->startTime;
							// 	$mar['endTime'] = $paySh->endTime;
							// 	$mar['status'] = $paySh->status;
							// 	$mar['payrollTypeId'] = $paySh->payrollType;
							// 	$mar['payrollType'] = $this->payrollModel->getPayrollType($paySh->payrollType);
							// 	array_push($var['payrollShifts'],$mar);
							// }
							// $var['isOnLeave'] = "N";
							// if($clockedTimes != null || $payedShifts != null)
							// 	array_push($mData['unrosteredEmployees'],$var);
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

	public function getUserWeekTimesheet($userid,$date,$empId,$tid=null){
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$this->load->model('timesheetModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$currentDate = $date;
				$currentD = $date;
				$weekData = [];
				$weekData['visitis'] = [];
				$weekData['payrollShifts'] = [];
				$weekData['shift'] = [];
				$date = date("Y-m-d",strtotime('+5 days',strtotime($date)));
				while($currentDate < $date){
					$data = $this->timesheetModel->getUserVisits($currentDate,$empId);
					$shiftData = $this->timesheetModel->getUserShift($currentDate,$empId);
					$currentDate = date('Y-m-d',strtotime('+1 days',strtotime($currentDate)));
					array_push($weekData['shift'],$shiftData);
					array_push($weekData['visitis'],$data);
				}
				while($currentD < $date){
					$data = $this->timesheetModel->getPayrollShifts($currentD,$tid,$empId);
					$shiftData = $this->timesheetModel->getUserShift($currentDate,$empId);
					$currentD = date('Y-m-d',strtotime($currentD.'+1 days'));
					array_push($weekData['shift'],$shiftData);
					array_push($weekData['payrollShifts'],$data);
				}
				http_response_code(200);
				echo json_encode($weekData);
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
$headers = array_change_key_case($headers);
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

	public function publishTimesheet($timesheetid,$userid){
		$headers = $this->input->request_headers();
$headers = array_change_key_case($headers);
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('timesheetModel');
				$data = $this->timesheetModel->publishTimesheet($timesheetid);
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

	public function discardTimesheet($timesheetid,$userid){
		$headers = $this->input->request_headers();
$headers = array_change_key_case($headers);
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$date = $this->input->get('date');
				$this->load->model('timesheetModel');
				$data = $this->timesheetModel->discardTimesheet($timesheetid);
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
$headers = array_change_key_case($headers);
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

	public function createWeekPayrollEntry(){
		$headers = $this->input->request_headers();
$headers = array_change_key_case($headers);
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$empId = $json->empId;
				$userid = $json->userid;
				$timesheetid = $json->timesheetid;
				$visits = $json->visits;
				$startDate = $json->startDate;
				$this->load->model('timesheetModel');
				$this->timesheetModel->deletePayrollEntry($timesheetid,$empId,$startDate);
				foreach ($visits as $v) {
					$this->timesheetModel->createPayrollShiftEntry($timesheetid,$empId,$v->shiftdate,$v->clockedInTime,$v->clockedOutTime,$v->startTime,$v->endTime,$userid,$v->payType);
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