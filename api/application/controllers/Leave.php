<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leave extends CI_Controller
{

	function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-DEVICE-ID,X-TOKEN,X-DEVICE-TYPE, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method == "OPTIONS") {
			die();
		}
		parent::__construct();
	}

	public function index()
	{
	}

	public function GetAllLeaveTypes($userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$userDetails = $this->authModel->getSuperAdminId($userid);
				$this->load->model('leaveModel');
				$leaveTypes = $this->leaveModel->getLeaveTypeBySuperadmin($userDetails->id);
				$data = array();
				foreach ($leaveTypes as $lt) {
					$var['id'] = $lt->id;
					$var['name'] = $lt->name;
					$var['slug'] = $lt->slug;
					$var['isPaidYN'] = $lt->isPaidYN;
					$var['showOnPaySlipYN'] = $lt->showOnPaySlipYN;
					$var['currentRecordYN'] = $lt->currentRecordYN;
					array_push($data, $var);
				}
				$mdata['leaveTypes'] = $data;
				http_response_code(200);
				echo json_encode($mdata);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function GetLeaveTypesByCenter($userid, $centerid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$userDetails = $this->authModel->getSuperAdminId($userid);
				$this->load->model('leaveModel');
				$this->load->model('settingsModel');
				$leaveTypes = $this->leaveModel->getLeaveTypeBySupadmin($userDetails->id, $centerid);
				$checkSync = $this->settingsModel->syncedWithXero($centerid);
				$mdata['syncedYN'] = ($checkSync !== null) ? 'Y' : 'N';
				$data = array();
				foreach ($leaveTypes as $lt) {
					$var['id'] = $lt->id;
					$var['name'] = $lt->name;
					$var['slug'] = $lt->slug;
					$var['isPaidYN'] = $lt->isPaidYN;
					$var['showOnPaySlipYN'] = $lt->showOnPaySlipYN;
					$var['currentRecordYN'] = $lt->currentRecordYN;
					$var['medicalFileYN'] = $lt->medicalFileYN;
					$var['hoursYN'] = $lt->hoursYN;
					$checkSync = $this->settingsModel->syncedWithXero($centerid);
					$var['syncedYN'] = ($checkSync !== null) ? 'Y' : 'N';
					array_push($data, $var);
				}
				$mdata['leaveTypes'] = $data;
				http_response_code(200);
				echo json_encode($mdata);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function CreateLeaveType()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$name = $json->name;
				$slug = $json->slug;
				$isPaidYN = $json->isPaidYN;
				$showOnPaySlipYN = $json->showOnPaySlipYN;
				$userid = $json->userid;
				$userDetails = $this->authModel->getUserDetails($userid);
				if ($userDetails != null && $userDetails->role == SUPERADMIN) {
					$this->load->model('xeroModel');
					$this->load->model('leaveModel');
					//xero 
					$xeroTokens = $this->xeroModel->getXeroToken();

					if ($xeroTokens != null) {
						$access_token = $xeroTokens->access_token;
						$tenant_id = $xeroTokens->tenant_id;
						$refresh_token = $xeroTokens->refresh_token;
						$data['Name'] = $name;
						$data['TypeOfUnits'] = "Hours";
						$data['IsPaidLeave'] = $isPaidYN == "Y";
						$data['ShowOnPayslip'] = $showOnPaySlipYN == "Y";
						$mdata['LeaveTypes'] = array();
						array_push($mdata['LeaveTypes'], $data);
						$val = $this->postCreateLeaveType($access_token, $tenant_id, json_encode($mdata));
						$val = json_decode($val);
						if ($val != NULL) {
							if ($val->Status == 401) {
								$refresh = $this->refreshXeroToken($refresh_token);
								$refresh = json_decode($refresh);
								$access_token = $refresh->access_token;
								$expires_in = $refresh->expires_in;
								$refresh_token = $refresh->refresh_token;
								$this->xeroModel->insertNewToken($access_token, $refresh_token, $tenant_id, $expires_in);
								$val = $this->postCreateLeaveType($access_token, $tenant_id, json_encode($mdata));
								$val = json_decode($val);
							}
						}
						if ($val == NULL) {
							$payItems = $this->getPayItems($access_token, $tenant_id);
							print_r($payItems);
							$leaveTypes = json_decode($payItems)->PayItems->LeaveTypes;
							for ($i = 0; $i < count($leaveTypes); $i++) {
								if ($leaveTypes[$i]->Name == $name) {
									$LeaveTypeID = $leaveTypes[$i]->LeaveTypeID;
									// NOTICE -- need to get the centerid
									$this->leaveModel->createLeaveType($LeaveTypeID, $data['Name'], $isPaidYN, $slug, $showOnPaySlipYN, "Y", $userid, $centerid);
									break;
								}
							}
							$data = [];
							$data['Status'] = 'SUCCESS';
						} else {
							$data['Status'] = "ERROR";
							$data['Message'] = "An unknown error occured";
						}
					}
				} else {

					$data['Status'] = 'ERROR';
					$data['Message'] = "You are not allowed";
				}
				http_response_code(200);
				echo json_encode($data);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}


	public function EditLeaveType()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$this->load->model('leaveModel');
				$leaveId = $json->leaveId;
				$name = $json->name;
				$slug = $json->slug;
				$isPaidYN = $json->isPaidYN;
				$showOnPaySlipYN = $json->showOnPaySlipYN;
				$userid = $json->userid;
				$medicalFile = $json->medicalFile;
				$hours = $json->hours;
				$userDetails = $this->authModel->getUserDetails($userid);
				$centerid = $this->leaveModel->getCenterByLeaveId($leaveId);
				$centerid = isset($centerid) ? $centerid->centerid : 0;
				if ($userDetails != null ) {
					$this->load->model('xeroModel');
					$xeroTokens = $this->xeroModel->getXeroToken($centerid);
					if ($xeroTokens != null) {
						$access_token = $xeroTokens->access_token;
						$tenant_id = $xeroTokens->tenant_id;
						$refresh_token = $xeroTokens->refresh_token;
						$mdata['LeaveTypes'] = array();

						$allLeaves = $this->leaveModel->getLeaveTypeBySuperadmin($userid);
						foreach ($allLeaves as $leave) {
							$var['LeaveTypeID'] = $leave->leaveid;
							if ($leave->id == $leaveId) {
								$var['Name'] = $name;
								$var['IsPaidLeave'] = $isPaidYN == "Y";
								$var['ShowOnPayslip'] = $showOnPaySlipYN == "Y";
							} else {
								$var['Name'] = $leave->name;
								$var['IsPaidLeave'] = $leave->isPaidYN == "Y";
								$var['ShowOnPayslip'] = $leave->showOnPaySlipYN == "Y";
							}
							array_push($mdata['LeaveTypes'], $var);
						}
						$val = $this->postCreateLeaveType($access_token, $tenant_id, json_encode($mdata));
						$val = json_decode($val);
						if ($val != NULL) {
							if ($val->Status == 401) {
								$refresh = $this->refreshXeroToken($refresh_token);
								$refresh = json_decode($refresh);
								$access_token = $refresh->access_token;
								$expires_in = $refresh->expires_in;
								$refresh_token = $refresh->refresh_token;
								$this->xeroModel->insertNewToken($access_token, $refresh_token, $tenant_id, $expires_in,$centerid);
								$val = $this->postCreateLeaveType($access_token, $tenant_id, json_encode($mdata));
								$val = json_decode($val);
							}
						}
						if ($val == NULL) {
							$this->leaveModel->editLeaveType($leaveId, $name, $isPaidYN, $slug, $showOnPaySlipYN, $medicalFile, $hours);
							$data['Status'] = 'SUCCESS';
						} else {
							$data['Status'] = "ERROR";
							$data['Message'] = "An unknown error occured";
						}
					}else {

						$data['Status'] = 'ERROR';
						$data['Message'] = "You are not allowed";
					}
				} else {

					$data['Status'] = 'ERROR';
					$data['Message'] = "You are not allowed";
				}
				http_response_code(200);
				echo json_encode($data);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}


	public function DeleteLeaveType()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$this->load->model('leaveModel');
				$leaveId = $json->leaveId;
				$userid = $json->userid;
				$centerid = $this->leaveModel->getCenterByLeaveId($leaveId);
				$centerid = isset($centerid) ? $centerid->centerid : 0;
				$userDetails = $this->authModel->getUserDetails($userid);
				if ($userDetails != null && $userDetails->role == SUPERADMIN) {
					$this->load->model('xeroModel');
					$xeroTokens = $this->xeroModel->getXeroToken($centerid);

					if ($xeroTokens != null) {

						$access_token = $xeroTokens->access_token;
						$tenant_id = $xeroTokens->tenant_id;
						$refresh_token = $xeroTokens->refresh_token;
						$mdata['LeaveTypes'] = array();

						$allLeaves = $this->leaveModel->getLeaveTypeBySuperadmin($userid);
						foreach ($allLeaves as $leave) {
							if ($leave->id != $leaveId) {
								$var['LeaveTypeID'] = $leave->leaveid;
								$var['Name'] = $leave->name;
								$var['IsPaidLeave'] = $leave->isPaidYN == "Y";
								$var['ShowOnPayslip'] = $leave->showOnPaySlipYN == "Y";
								array_push($mdata['LeaveTypes'], $var);
							}
						}
						$val = $this->postCreateLeaveType($access_token, $tenant_id, json_encode($mdata));
						$val = json_decode($val);
						if ($val != NULL) {
							if ($val->Status == 401) {
								$refresh = $this->refreshXeroToken($refresh_token);
								$refresh = json_decode($refresh);
								$access_token = $refresh->access_token;
								$expires_in = $refresh->expires_in;
								$refresh_token = $refresh->refresh_token;
								$this->xeroModel->insertNewToken($access_token, $refresh_token, $tenant_id, $expires_in);
								$val = $this->postCreateLeaveType($access_token, $tenant_id, json_encode($mdata));
								$val = json_decode($val);
							}
						}
						if ($val == NULL) {
							$this->leaveModel->deleteLeaveType($leaveId);
							$data['Status'] = 'SUCCESS';
						} else {
							$data['Status'] = "ERROR";
							$data['Message'] = "An unknown error occured";
						}
					}else {

						$data['Status'] = 'ERROR';
						$data['Message'] = "You are not allowed";
					}
				} else {

					$data['Status'] = 'ERROR';
					$data['Message'] = "You are not allowed";
				}
				http_response_code(200);
				echo json_encode($data);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function GetAllLeavesByCenter($userid, $centerid, $startDate = null, $endDate = null)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('leaveModel');
				$allLeaves = $this->leaveModel->getAllLeavesByCenter($centerid, $startDate, $endDate);
				$data = array();
				foreach ($allLeaves as $leaveApp) {
					$var['id'] = $leaveApp->applicationId;
					$var['userid'] = $leaveApp->userid;
					$userDetails = $this->authModel->getUserDetails($var['userid']);
					$var['name'] = $userDetails->name;
					$var['title'] = $userDetails->title;
					$var['appliedDate'] = $leaveApp->appliedDate;
					$leaveDetails = $this->leaveModel->getLeaveType($leaveApp->leaveId);
					if ($leaveDetails != null) {
						$var['leaveTypeName'] = $leaveDetails->name;
						$var['leaveTypeSlug'] = $leaveDetails->slug;
					}
					$var['startDate'] = $leaveApp->startDate;
					$var['endDate'] = $leaveApp->endDate;
					$var['status'] = $leaveApp->status == 1 ? "Applied" : ($leaveApp->status == 2 ? "Approved" : "Rejected");
					$var['notes'] = $leaveApp->notes;
					array_push($data, $var);
				}
				$mdata['centerId'] = $centerid;
				$mdata['leaves'] = $data;
				http_response_code(200);
				echo json_encode($mdata);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function GetAllLeavesByUser($userid, $startDate = null, $endDate = null)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('leaveModel');
				$allLeaves = $this->leaveModel->getAllLeavesByUser($userid, $startDate, $endDate);
				$userDetails = $this->authModel->getUserDetails($userid);
				$data = array();
				foreach ($allLeaves as $leaveApp) {
					$var['id'] = $leaveApp->applicationId;
					$var['appliedDate'] = $leaveApp->appliedDate;
					$leaveDetails = $this->leaveModel->getLeaveType($leaveApp->leaveId);
					$var['leaveTypeName'] = isset($leaveDetails->name) ? $leaveDetails->name : null;
					$var['leaveTypeSlug'] = isset($leaveDetails->slug) ? $leaveDetails->slug : null;
					$var['startDate'] = isset($leaveApp->startDate) ? $leaveApp->startDate : null;
					$var['noOfHours'] = isset($leaveApp->noOfHours) ? $leaveApp->noOfHours : null;
					$var['endDate'] = isset($leaveApp->endDate) ? $leaveApp->endDate : null;
					$var['status'] = $leaveApp->status == 1 ? "Applied" : ($leaveApp->status == 2 ? "Approved" : "Rejected");
					$var['notes'] = $leaveApp->notes;
					$var['userid'] = $leaveApp->userid;
					$userDetails = $this->authModel->getUserDetails($var['userid']);
					$var['name'] = isset($userDetails->name) ? $userDetails->name : null;
					$var['title'] = isset($userDetails->title) ? $userDetails->title : null;
					array_push($data, $var);
				}
				// $mdata['userid'] = $userid;
				// $mdata['name'] = $userDetails->name;
				// $mdata['title'] = $userDetails->title;
				$mdata['leaves'] = $data;
				http_response_code(200);
				echo json_encode($mdata);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function ApplyLeave()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$userid = $json->userid;
				$leaveTypeId = $json->leaveTypeId;
				$startDate = $json->startDate;
				$endDate = $json->endDate;
				$notes = $json->notes;
				$noOfHours = $json->hours;
				// $title = $json->leaveTitle;
				// print_r($json);
				$this->load->model('employeeModel');
				$this->load->model('xeroModel');
				$this->load->model('leaveModel');
				$leaveDets = $this->leaveModel->getLeaveType($leaveTypeId);
				$employeeDets = $this->employeeModel->getUserFromId($userid);
				$this->leaveModel->applyLeave($userid, $leaveTypeId, $noOfHours, $startDate, $endDate, $notes);
				$this->leaveModel->updateLeaveBalance($userid, $leaveTypeId, -1 * $noOfHours);
				if ($employeeDets != null) {
					$xeroTokens = $this->xeroModel->getXeroToken($leaveDets->centerid);
					$access_token = $xeroTokens->access_token;
					$tenant_id = $xeroTokens->tenant_id;
					$refresh_token = $xeroTokens->refresh_token;
					if ($employeeDets->payrollCalendarId != null) {
						$payRuns = $this->getPayRuns($access_token, $tenant_id);
						$payRuns = json_decode($payRuns);

						if (isset($payRuns->Status) && $payRuns->Status == 401) {
							$refresh = $this->refreshXeroToken($refresh_token);
							$refresh = json_decode($refresh);
							$access_token = $refresh->access_token;
							$expires_in = $refresh->expires_in;
							$refresh_token = $refresh->refresh_token;
							$this->xeroModel->insertNewToken($access_token, $refresh_token, $tenant_id, $expires_in, $leaveDets->centerid);
							$payRuns = $this->getPayRuns($access_token, $tenant_id);
							$payRuns = json_decode($payRuns);
						}
						// var_dump($payRuns);
						if (isset($payRuns->Status) && $payRuns->Status == "OK") {
							$found = false;

							for ($i = 0; $i < count($payRuns->PayRuns); $i++) {
								preg_match('/([\d]{10})/', $payRuns->PayRuns[$i]->PayRunPeriodEndDate, $matches);
								$payPeriodEndDate = date('Y-m-d', $matches[0]);
								preg_match('/([\d]{10})/', $payRuns->PayRuns[$i]->PayRunPeriodStartDate, $matches);
								$payPeriodStartDate = date('Y-m-d', $matches[0]);

								// echo $payPeriodStartDate." ".$payPeriodEndDate." ".$endDate;
								if ($payPeriodEndDate >= $endDate && $endDate >= $payPeriodStartDate) {
									$found = true;
									$startDateTime  = new DateTime($startDate);
									$endDateTime  = new DateTime($endDate);
									// $payPeriodStartDate = new DateTime($payPeriodStartDate);
									// $payPeriodEndDate = new DateTime($payPeriodEndDate);
									$postData =	array();
									$var['EmployeeID'] = $employeeDets->xeroEmployeeId;
									$var['LeaveTypeID'] = $leaveDets->leaveid;
									$var['StartDate'] = '/Date(' . $startDateTime->format('Uv') . '+0000)/';
									$var['EndDate'] = '/Date(' . $endDateTime->format('Uv') . '+0000)/';
									$var['Description'] = $notes;
									$var['Title'] = $leaveDets->name;
									// $var['LeavePeriods']['NumberOfUnits'] = $noOfHours;
									// $var['LeavePeriods']['PayPeriodStartDate'] = $payPeriodStartDate;
									// $var['LeavePeriods']['PayPeriodEndDate'] = $payPeriodEndDate;
									// $var['LeavePeriods']['PayPeriodStartDate'] = '/Date('.$payPeriodStartDate->format('Uv').'+0000)/';
									// $var['LeavePeriods']['PayPeriodEndDate'] = '/Date('.$payPeriodEndDate->format('Uv').'+0000)/';
									array_push($postData, $var);
									// {
									// 	"EmployeeID": "'.$employeeDets->xeroEmployeeId.'",
									// 	"LeaveTypeID": "'.$leaveDets->leaveid.'",
									// 	"StartDate": "/Date('.$startDateTime->format('Uv').'+0000)/",
									// 	"EndDate": "/Date('.$endDateTime->format('Uv').'+0000)/",
									// 	"Description": "'.$notes.'",
									// 	"Title": "'.$leaveDets->name.'",
									// 	"LeavePeriods": 
									// 		{
									// 			"NumberOfUnits" : "'.$noOfHours.'"
									// 		}

									// };

									$this->createLeaveApp($access_token, $tenant_id, $postData);
									$this->leaveModel->updateLeaveBalance($userid, $leaveTypeId, -1 * $noOfHours);
									break;
								}
							}

							if ($found) {
								$this->leaveModel->applyLeave($userid, $leaveTypeId, $noOfHours, $startDate, $endDate, $notes);
								$data['Status'] = 'SUCCESS';
							} else {
								$data['Status'] = "ERROR";
								$data['Message'] = "No payrun has been configured for these dates.";
							}
						} else {
							$data['Status'] = "EROR";
							$data['Message'] = "An unknown error has occured";
						}
					} else {
						$data['Status'] = "ERROR";
						$data['Message'] = "User's payroll calendar needs to be set up before applying for leave";
					}
				}

				http_response_code(200);
				echo json_encode($data);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function GetLeaveBalance($userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('leaveModel');
				$allLeaves = $this->leaveModel->getLeaveBalance($userid);
				// print_r($allLeaves);
				$data = array();
				foreach ($allLeaves as $lb) {
					$leaveDetails = $this->leaveModel->getLeaveType($lb->leaveId);
					// var_dump($leaveDetails);
					if ($leaveDetails != null) {
						$var['leaveTypeId'] = $lb->leaveId;
						$var['leaveName'] = $leaveDetails->name;
						$var['leaveSlug'] = $leaveDetails->slug;
						$var['isPaidYN'] = $leaveDetails->isPaidYN;
						$var['leavesRemaining'] = $lb->leaveBalance;
						// $var['closingBalance'] = $lb->leavesRemaining;
						// $var['period'] = $lb->leavePeriod;
						// $var['startDate'] = $lb->startDate;
						array_push($data, $var);
					}
				}
				$mdata['balance'] = $data;
				http_response_code(200);
				echo json_encode($mdata);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	// public function GetLeaveBalance($userid){
	// 	$headers = $this->input->request_headers();
	// $headers = array_change_key_case($headers);
	// 	if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
	// 		$this->load->model('authModel');
	// 		$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
	// 		if($res != null && $res->userid == $userid){
	// 			$this->load->model('leaveModel');
	// 			$accuredLeaves = $this->leaveModel->getAccruedLeaves($userid);
	// 			$data = array();
	// 			foreach ($accuredLeaves as $aLeave) {
	// 				$hoursWorked = $this->leaveModel->getTotalOrdinaryHorusWorked($userid,$aLeave->accrualStartDate);
	// 				$leavesTaken = $this->leaveModel->getSumOfLeave($userid,$aLeave->leaveId,$aLeave->accrualStartDate);
	// 				$leaveDets = $this->leaveModel->getLeaveType($aLeave->leaveId);
	// 				$var['leaveId'] = $aLeave->leaveId;
	// 				$var['leaveName'] = $leaveDets->name;
	// 				$var['leaveSlug'] = $leaveDets->slug;
	// 				$var['isPaidYN'] = $leaveDets->isPaidYN;
	// 				$var['accrualRatio'] = $aLeave->accrualRatio;
	// 				$var['leavesRemaining'] = $hoursWorked->sum * $aLeave->accrualRatio - $leavesTaken->sum;
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


	public function UpdateLeaveApplication()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$this->load->model('leaveModel');
				$leaveApplication = $json->leaveApplication;
				$status = $json->status;
				$message = $json->message;
				if ($status == 2) {
					$this->leaveModel->updateLeave($leaveApplication, $status, $message);
				} else {
					$this->leaveModel->updateLeave($leaveApplication, $status, $message);
					$this->leaveModel->addLeaveBalanceOnReject($leaveApplication);
					$to = $this->leaveModel->getUserFromLeaveApplication($leaveApplication);
					$config = array(
						'protocol'  => 'smtp',
						'smtp_host' => 'ssl://smtp.zoho.com',
						'smtp_port' => 465,
						'smtp_user' => 'demo@todquest.com',
						'smtp_pass' => 'K!ddz1ng',
						'mailtype'  => 'html',
						'charset'   => 'utf-8'
					);
					$from = $this->config->item('smtp_user');
					$this->email->initialize($config);
					$this->email->set_mailtype("html");
					$this->email->set_newline("\r\n");
					$this->email->from($from);
					$this->email->to($to->email);
					$this->email->subject('Leave Application status');
					$this->email->message($message);
					$this->email->send();
				}
				$data['Status'] = 'SUCCESS';
				http_response_code(200);
				echo json_encode($data);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}


	function postCreateLeaveType($access_token, $tenant_id, $postData)
	{
		$url = "https://api.xero.com/payroll.xro/1.0/PayItems";
		$ch =  curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
			'Content-Type:application/json',
			'Authorization:Bearer ' . $access_token,
			'Xero-tenant-id:' . $tenant_id
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		return $server_output;
	}

	function refreshXeroToken($access_token)
	{

		$postData = "grant_type=refresh_token";
		$postData .= "&refresh_token=" . $access_token;

		$url = "https://identity.xero.com/connect/token";
		$ch =  curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
			'Content-Type:application/x-www-form-urlencoded',
			'Authorization:Basic ' . base64_encode(XERO_CLIENT_ID . ":" . XERO_CLIENT_SECRET)
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		return $server_output;
	}

	function getPayItems($access_token, $tenant_id)
	{
		$url = "https://api.xero.com/payroll.xro/1.0/PayItems";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Accept:application/json',
			'Authorization:Bearer ' . $access_token,
			'Xero-tenant-id:' . $tenant_id
		));
		$server_output = curl_exec($ch);
		return $server_output;
	}

	function getPayrollCalendar($payrollCalendarId, $access_token, $tenant_id)
	{
		$url = "https://api.xero.com/payroll.xro/1.0/PayrollCalendars/" . $payrollCalendarId;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Accept:application/json',
			'Authorization:Bearer ' . $access_token,
			'Xero-tenant-id:' . $tenant_id
		));
		$server_output = curl_exec($ch);
		return $server_output;
	}

	function createLeaveApp($access_token, $tenant_id, $postData)
	{
		var_dump($postData);
		$url = "https://api.xero.com/payroll.xro/1.0/LeaveApplications";
		$ch =  curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
		curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
			'Content-Type:application/json',
			'Accept:application/json',
			'Authorization:Bearer ' . $access_token,
			'Xero-tenant-id:' . $tenant_id
		));
		echo $access_token;
		echo "\n\n";
		echo $tenant_id;
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		var_dump($server_output);
		return $server_output;
	}

	function getPayRuns($access_token, $tenant_id)
	{
		$url = "https://api.xero.com/payroll.xro/1.0/PayRuns";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Accept:application/json',
			'Authorization:Bearer ' . $access_token,
			'Xero-tenant-id:' . $tenant_id
		));
		$server_output = curl_exec($ch);
		return $server_output;
	}
}
