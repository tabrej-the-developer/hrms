<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rosters extends MY_Controller {

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

	public function getPastRosters($centerid,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('rostersModel');
				$rosters = $this->rostersModel->getAllRosters($centerid);
				$permittedRosters = $this->rostersModel->getRostersByPermission($userid);
				$rostersArray = array_merge($rosters,$permittedRosters);
				$data['rosters'] = [];
				$count = count($rostersArray);
				for($i=0;$i<$count-1;$i++){
					for($j=$i+1;$j<$count;$j++){
						if($rostersArray[$i]->id == $rostersArray[$j]->id){
							unset($rostersArray[$j]);
							$i = $i--;
							$j = $j--;
							$count = count($rostersArray);
							break;
						}
					}
				}
				foreach ($rostersArray as $rost) {
					if($rost->createdBy == $res->userid || $rost->status == 'Published'){
						$var['startDate'] = $rost->startDate;
						$var['endDate'] = $rost->endDate;
						$var['id'] = $rost->id;
						$var['isEditYN'] = $rost->createdBy == $userid ? "Y" : "N";
						$var['status'] = $rost->status;
						array_push($data['rosters'],$var);
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

	public function changePriority($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res->userid == $userid){
			$json = json_decode(file_get_contents('php://input'));
				$areaid = $json->areaid;
				$newid = $json->newid;
				$userid = $userid;
			$this->load->model('rostersModel');
			if($areaid != null && $areaid != "" && $newid != "" && $newid != null){
				$this->rostersModel->changePriority($areaid,$newid);
				}
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function deleteShift($shiftId,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$this->load->model('rostersModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res->userid == $userid){
					$json = json_decode(file_get_contents('php://input'));

					$shiftDate = $this->rostersModel->getShiftDate($shiftId)->rosterDate;
					$employeeId = $this->rostersModel->getEmployeeId($shiftId)->userid;
					$rosterid = $this->rostersModel->getRosterId($shiftId)->roasterId;
					$number = date('w',strtotime($shiftDate)) - 1;
					$currentDate = date('Y-m-d',strtotime($shiftDate. '-' . $number  .' days')) ;
					$days = $json->days;
					foreach ($days as $day) {
						echo $day;
						$getShiftId = $this->rostersModel->getShiftId($employeeId,$currentDate)->id;
						echo "||".$getShiftId;
							if($day->YN == "true"){
								echo "||".$day->YN;
								if($getShiftId != null){
									$this->rostersModel->deleteShift($getShiftId);
									}
							}
						$currentDate = date('Y-m-d',strtotime($currentDate.'+1 days'));
					}
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function deleteTemplateShift($shiftId,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$this->load->model('rostersModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res->userid == $userid){
					$json = json_decode(file_get_contents('php://input'));

					if($this->rostersModel->getTemplateShiftDay($shiftId) != null){
						$shiftDay = 0;
						$rosterTemplateId = $this->rostersModel->getTemplateShiftDay($shiftId)->roasterId;
						$employeeId = $this->rostersModel->getTemplateEmployeeId($shiftId)->userid;
						$rosterid = $this->rostersModel->getTemplateRosterId($shiftId)->roasterId;
					}else{
						$shiftDay = null;
						$rosterTemplateId = null;
						$employeeId = null;
					}
					$days = $json->days;
					foreach ($days as $day) {
						if($this->rostersModel->getTemplateShiftId($employeeId,$shiftDay,$rosterTemplateId) != null){
						$getShiftId = $this->rostersModel->getTemplateShiftId($employeeId,$shiftDay,$rosterTemplateId)->id;
						} else{
							$getShiftId = null;
						}
						echo "||".$getShiftId;
							if($day->YN == "true"){
								echo "||".$day->YN;
								if($getShiftId != null){
									$this->rostersModel->deleteTemplateShift($getShiftId);
									}
							}
						$shiftDay++;
					}
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function createRoster($rosterTemplateId = null){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				if($rosterTemplateId == null){

				$startDate = $json->startDate;
				$userid = $json->userid;
				$centerid = $json->centerid;
				$userDetails = $this->authModel->getUserDetails($userid);
				if(date('D',strtotime($startDate)) != 'Mon'){
						$data['Status'] = 'ERROR';
						$data['Message'] = "Rosters start from Monday";
				}
				else if($userDetails != null && ($userDetails->role == ADMIN || $userDetails->role == SUPERADMIN)){
					$this->load->model('rostersModel');
					$existingRoster = $this->rostersModel->getRosterFromDate($startDate,$centerid);
					if($existingRoster == null){
						$startDate = date('Y-m-d', strtotime($startDate));
						$endDate = date( "Y-m-d", strtotime( "$startDate +4 day" ));
						$currentRoster = $this->rostersModel->createNewRoster($userid,$startDate,$endDate,$centerid);
						$allAreas = $this->rostersModel->getAllAreas($centerid);
						$data['id'] = $currentRoster;
						$data['startDate'] = $startDate;
						$data['endDate'] = $endDate;
						$data['centerid'] = $centerid;
						$data['status'] = "Draft";
						$data['roster'] = [];
						// var_dump($allAreas);
						foreach ($allAreas as $area) {
							$var['areaId'] = $area->areaid;
							$var['areaName'] = $area->areaName;
							$var['isRoomYN'] = $area->isARoomYN;
							$var['occupancy'] = [];
							if($var['isRoomYN'] == 'Y'){
								$currentDateNow = $startDate;
								$currentDayNow = 0;
								while($currentDayNow < 5){
									$currentDateNow = date( "Y-m-d", strtotime( "$startDate +$currentDayNow day" ));
									$occupancyObj['date'] = $currentDateNow;
									$occupancyObj['occupancy'] = 11;
									array_push($var['occupancy'], $occupancyObj);
									$currentDayNow++;
								}
							}
							$var['roles'] = [];
							$allRoles = $this->rostersModel->getAllRoles($area->areaid);
							// var_dump($allRoles);
							$areaEmployeeCount = 0;
							foreach ($allRoles as $role) {
								$allEmployess = $this->rostersModel->getAllEmployees($role->roleid);
								// var_dump($allEmployess);
								foreach ($allEmployess as $employee) {
									$rav['empId'] = $employee->id;
									$empDetails = $this->authModel->getUserDetails($employee->id);
									$rav['empName'] = $empDetails->name;
									$rav['empTitle'] = $empDetails->title;
									$rav['level'] = $employee->level;
									//$rav['maxHoursPerWeek'] = $employee->maxHoursPerWeek;
									$rav['shifts'] = [];
									$day = 0;
									while($day < 5){
										$shiftObj['currentDate'] = date( "Y-m-d", strtotime( "$startDate +$day day" ));
										$shiftObj['roleid'] = $role->roleid;
										$shiftObj['roleName'] = $role->roleName;
										$shiftObj['startTime'] = "0900";
										$shiftObj['endTime'] = "1700";
										$shiftObj['status'] = "Added";
										$shiftObj['shiftid'] = $this->rostersModel->createNewShift($currentRoster,$shiftObj['currentDate'],$employee->id,$shiftObj['startTime'],$shiftObj['endTime'],$role->roleid);
										array_push($rav['shifts'],$shiftObj);
										$day++;
									}
									// var_dump($rav);
									array_push($var['roles'],$rav);
								}
								// var_dump($var);
							}
							array_push($data['roster'],$var);
						}
						// var_dump($data);
					}
					else{
						$data['Status'] = "ERROR";
						$data['Message'] = "A roster already exists for the date passed";
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
						//-------------------------------------//
						//  create roster with roster template //
						//-------------------------------------//
					$startDate = $json->startDate;
					$userid = $json->userid;
					$centerid = $json->centerid;
					$userDetails = $this->authModel->getUserDetails($userid);
					if(date('D',strtotime($startDate)) != 'Mon'){
							$data['Status'] = 'ERROR';
							$data['Message'] = "Rosters start from Monday";
					}
					else if($userDetails != null && ($userDetails->role == ADMIN || $userDetails->role == SUPERADMIN)){
						$this->load->model('rostersModel');
						$existingRoster = $this->rostersModel->getRosterFromDate($startDate,$centerid);
						if($existingRoster == null){
							$startDate = date('Y-m-d', strtotime($startDate));
							$endDate = date( "Y-m-d", strtotime( "$startDate +4 day" ));
							$currentRoster = $this->rostersModel->createNewRoster($userid,$startDate,$endDate,$centerid);
							$allAreas = $this->rostersModel->getAllAreas($centerid);
							$data['id'] = $currentRoster;
							$data['startDate'] = $startDate;
							$data['endDate'] = $endDate;
							$data['centerid'] = $centerid;
							$data['status'] = "Draft";
							$data['roster'] = [];
							// var_dump($allAreas);
							foreach ($allAreas as $area) {
								$var['areaId'] = $area->areaid;
								$var['areaName'] = $area->areaName;
								$var['isRoomYN'] = $area->isARoomYN;
								$var['occupancy'] = [];
								if($var['isRoomYN'] == 'Y'){
									$currentDateNow = $startDate;
									$currentDayNow = 0;
									while($currentDayNow < 5){
										$currentDateNow = date( "Y-m-d", strtotime( "$startDate +$currentDayNow day" ));
										$occupancyObj['date'] = $currentDateNow;
										$occupancyObj['occupancy'] = 11;
										array_push($var['occupancy'], $occupancyObj);
										$currentDayNow ++;
									}
								}
								$var['roles'] = [];
								$allRoles = $this->rostersModel->getAllRoles($area->areaid);
								// var_dump($allRoles);
								$areaEmployeeCount = 0;
								foreach ($allRoles as $role) {
									$allEmployess = $this->rostersModel->getAllEmployees($role->roleid);
									// var_dump($allEmployess);
									foreach ($allEmployess as $employee) {
										$rav['empId'] = $employee->id;
										$empDetails = $this->authModel->getUserDetails($employee->id);
										$rav['empName'] = $empDetails->name;
										$rav['empTitle'] = $empDetails->title;
										$rav['level'] = $employee->level;
										//$rav['maxHoursPerWeek'] = $employee->maxHoursPerWeek;
										$rav['shifts'] = [];
										$day = 0;
										while($day < 5){
											$templateShift = $this->rostersModel->getTemplateShift($rav['empId'],$rosterTemplateId,$day);
											if($templateShift != null){
											$shiftObj['currentDate'] = date( "Y-m-d", strtotime( "$startDate +$day day" ));
											$shiftObj['roleid'] = $role->roleid;
											$shiftObj['roleName'] = $role->roleName;
											$shiftObj['startTime'] = $templateShift->startTime;
											$shiftObj['endTime'] = $templateShift->endTime;
											$shiftObj['status'] = "Added";
											$shiftObj['shiftid'] = $this->rostersModel->createNewShift($currentRoster,$shiftObj['currentDate'],$employee->id,$shiftObj['startTime'],$shiftObj['endTime'],$role->roleid);
											array_push($rav['shifts'],$shiftObj);
											}else{

											}
											$day++;
										}
										// var_dump($rav);
										array_push($var['roles'],$rav);
									}
									// var_dump($var);
								}
								array_push($data['roster'],$var);
							}
							// var_dump($data);
						}
						else{
							$data['Status'] = "ERROR";
							$data['Message'] = "A roster already exists for the date passed";
						}
					}
					else{

						$data['Status'] = 'ERROR';
						$data['Message'] = "You are not allowed";
					}
					http_response_code(200);
					echo json_encode($data);
				
					}
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function createRosterTemplate(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$templateName = $json->name;
				$current = 0; //----------------remove
				$userid = $json->userid;
				$centerid = $json->centerid;
				$rosterid = uniqid();
				$userDetails = $this->authModel->getUserDetails($userid);
				// if(date('D',strtotime($startDate)) != 'Mon'){
				// 		$data['Status'] = 'ERROR';
				// 		$data['Message'] = "Rosters start from Monday";
				// }
				if($userDetails != null && ($userDetails->role == ADMIN || $userDetails->role == SUPERADMIN)){
					$this->load->model('rostersModel');
					// $existingRoster = $this->rostersModel->getRosterTemplateFromDate($current,$centerid);

					//	$startDate = date('Y-m-d', strtotime($startDate));//----------------remove
					//	$endDate = date( "Y-m-d", strtotime( "$startDate +4 day" ));//----------------remove
						$currentRoster = $this->rostersModel->createNewRosterTemplate($userid,$rosterid,$templateName,$centerid);//----------------remove
						$allAreas = $this->rostersModel->getAllAreas($centerid);
						$data['id'] = $currentRoster;
																					 //----------------remove
						//$data['endDate'] = $endDate; //----------------remove
						$data['centerid'] = $centerid;
						$data['status'] = "Draft";
						$data['roster'] = [];
						// var_dump($allAreas);
						foreach ($allAreas as $area) {
							$var['areaId'] = $area->areaid;
							$var['areaName'] = $area->areaName;
							$var['isRoomYN'] = $area->isARoomYN;
							$var['occupancy'] = [];
							if($var['isRoomYN'] == 'Y'){
								$currentDateNow = $current;//----------------remove
								$currentDayNow = 0;
								while($currentDayNow < 5){
									$currentDateNow = $currentDayNow;//----------------remove
									$occupancyObj['date'] = $currentDateNow;//----------------remove
									$occupancyObj['occupancy'] = 11;
									array_push($var['occupancy'], $occupancyObj);
									$currentDayNow ++;
								}
							}
							$var['roles'] = [];
							$allRoles = $this->rostersModel->getAllRoles($area->areaid);
							// var_dump($allRoles);
							$areaEmployeeCount = 0;
							foreach ($allRoles as $role) {
								$allEmployess = $this->rostersModel->getAllEmployees($role->roleid);
								// var_dump($allEmployess);
								foreach ($allEmployess as $employee) {
									$rav['empId'] = $employee->id;
									$empDetails = $this->authModel->getUserDetails($employee->id);
									$rav['empName'] = $empDetails->name;
									$rav['empTitle'] = $empDetails->title;
									$rav['level'] = $employee->level;
									//$rav['maxHoursPerWeek'] = $employee->maxHoursPerWeek;
									$rav['shifts'] = [];
									$day = 0;
									while($day < 5){
										$shiftObj['currentDay'] = $day;//----------------remove
										$shiftObj['roleid'] = $role->roleid;
										$shiftObj['roleName'] = $role->roleName;
										$shiftObj['startTime'] = "0900";
										$shiftObj['endTime'] = "1700";
										$shiftObj['status'] = "Added";
										$shiftObj['shiftid'] = $this->rostersModel->createNewTemplateShift($currentRoster,$shiftObj['currentDay'],$employee->id,$shiftObj['startTime'],$shiftObj['endTime'],$role->roleid);
										array_push($rav['shifts'],$shiftObj);//----------------remove
										$day++;
									}
									// var_dump($rav);
									array_push($var['roles'],$rav);
								}
								// var_dump($var);
							}
							array_push($data['roster'],$var);
						}
						// var_dump($data);
					$data['rosterid'] = $rosterid;
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

	public function getRoster($rosterid,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('rostersModel');
				$this->load->model('leaveModel');
				$roster = $this->rostersModel->getRosterFromId($rosterid);
				$allAreas = $this->rostersModel->getAllAreas($roster->centerid);
				$userDetails = $this->authModel->getUserDetails($userid);
				$data['id'] = $roster->id;
				$data['startDate'] = $roster->startDate;
				$data['endDate'] = $roster->endDate;
				$data['status'] = $roster->status;
				$data['centerid'] = $roster->centerid;
				$data['roster'] = [];
				foreach ($allAreas as $area) {
					$var['areaId'] = $area->areaid;
					$var['colorcodes'] = $area->colorcodes;
					$var['areaName'] = $area->areaName;
					$var['isRoomYN'] = $area->isARoomYN;
					$var['occupancy'] = [];
					if($var['isRoomYN'] == 'Y'){
						$currentDateNow = $roster->startDate;
						$currentDayNow = 0;
						while($currentDayNow < 5){
							$currentDateNow = date( "Y-m-d", strtotime( "$roster->startDate +$currentDayNow day" ));
							$occupancyObj['date'] = $currentDateNow;
							$occupancyObj['occupancy'] = 11;
							array_push($var['occupancy'], $occupancyObj);
							$currentDayNow ++;
						}
					}
					$var['roles'] = [];
					$allRoles = $this->rostersModel->getAllRoles($area->areaid);
					$emps = [];
					foreach ($allRoles as $role) {
						$allEmployess = $this->rostersModel->getAllEmployeesFromRole($role->roleid,$rosterid);
						foreach ($allEmployess as $employeeid) {
							if( !in_array($employeeid->userid,$emps)){
							array_push($emps, $employeeid->userid);
							// if($userDetails->role == SUPERADMIN || $userDetails->role == ADMIN || $userid == $employeeid->userid){
								$rav['empId'] = $employeeid->userid;
								$empDetails = $this->authModel->getUserDetails($employeeid->userid);
								$rav['empName'] = $empDetails->name;
								$rav['empTitle'] = $empDetails->title;
								$rav['empRole'] = $empDetails->roleid;
								$rav['level'] = $empDetails->level;
								//$rav['maxHoursPerWeek'] = $empDetails->maxHoursPerWeek;
									$rav['shifts'] = [];
								$allShifts = $this->rostersModel->getAllShiftsFromEmployee($rosterid,$employeeid->userid,$area->areaid);
								foreach ($allShifts as $shiftOb) {
									$shiftObj['currentDate'] = $shiftOb->rosterDate;
									$leaveApp = $this->leaveModel->getLeaveApplicationForUser($employeeid->userid,$shiftOb->rosterDate);
									if($leaveApp == null){
										$shiftObj['isOnLeave'] = 'N';
										$shiftObj['roleid'] = $shiftOb->roleid;
										$roleObj = $this->rostersModel->getRole($shiftOb->roleid);
										$shiftObj['roleName'] = $roleObj->roleName;
										$shiftObj['startTime'] = $shiftOb->startTime;
										$shiftObj['endTime'] = $shiftOb->endTime;
										$shiftObj['shiftid'] = $shiftOb->id;
										$shiftObj['message'] = $shiftOb->message;
										$shiftObj['status'] = $shiftOb->status == 1 ? "Added" : ($shiftOb->status == 2 ? "Published" : ($shiftOb->status == 3 ? "Accepted":"Rejected"));
									}
									else{
										$shiftObj['isOnLeave'] = 'Y';
										$shiftObj['leaveId'] = $leaveApp->leaveId;
										$shiftObj['leaveStartDate'] = $leaveApp->startDate;
										$shiftObj['leaveEndDate'] = $leaveApp->endDate;
										$shiftObj['leaveNotes'] = $leaveApp->notes;
										$shiftObj['leaveNoOfHours'] = $leaveApp->noOfHours;
										$shiftObj['leaveStatus'] = $leaveApp->status;
									}
									array_push($rav['shifts'],$shiftObj);
								}
								array_push($var['roles'],$rav);
							// }
							}
						}
					}
					array_push($data['roster'],$var);
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

	public function getRosterTemplate($rosterTemplateId,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('rostersModel');
				$this->load->model('leaveModel');
				$rosterTemplate = $this->rostersModel->getRosterTemplateFromId($rosterTemplateId);
				$allAreas = $this->rostersModel->getAllAreas($rosterTemplate->centerid);
				$userDetails = $this->authModel->getUserDetails($userid);
				$data['id'] = $rosterTemplate->id;
				$data['day'] = 0;
				$data['status'] = $rosterTemplate->status;
				$data['centerid'] = $rosterTemplate->centerid;
				$data['roster'] = [];
				foreach ($allAreas as $area) {
					$var['areaId'] = $area->areaid;
					$var['areaName'] = $area->areaName;
					$var['isRoomYN'] = $area->isARoomYN;
					$var['occupancy'] = [];
					if($var['isRoomYN'] == 'Y'){
						$currentDateNow = 0;
						$currentDayNow = 0;
						while($currentDayNow < 5){
							$currentDateNow = $currentDayNow;
							$occupancyObj['date'] = $currentDateNow;
							$occupancyObj['occupancy'] = 11;
							array_push($var['occupancy'], $occupancyObj);
							$currentDayNow ++;
						}
					}
					$var['roles'] = [];
					$allRoles = $this->rostersModel->getAllRoles($area->areaid);
					foreach ($allRoles as $role) {

						$allEmployess = $this->rostersModel->getAllTemplateEmployeesFromRole($role->roleid,$rosterTemplateId);
												// print_r($allEmployess);
						foreach ($allEmployess as $employeeid) {
							// print_r($employeeid);
							// if($userDetails->role == SUPERADMIN || $userDetails->role == ADMIN || $userid == $employeeid->userid){
								$rav['empId'] = $employeeid->userid;
								$empDetails = $this->authModel->getUserDetails($employeeid->userid);
								$rav['empName'] = $empDetails->name;
								$rav['empTitle'] = $empDetails->title;
								$rav['level'] = $empDetails->level;
								//$rav['maxHoursPerWeek'] = $empDetails->maxHoursPerWeek;
									$rav['shifts'] = [];
								$allShifts = $this->rostersModel->getAllTemplateShiftsFromEmployee($rosterTemplateId,$employeeid->userid,$area->areaid);
								$current = 0;
								foreach ($allShifts as $shiftOb) {
									$shiftObj['currentDate'] = $shiftOb->day;
									// $leaveApp = $this->leaveModel->getLeaveApplicationForUser($employeeid->userid,$shiftOb->rosterDate);
									// if($leaveApp == null){
										$shiftObj['isOnLeave'] = 'N';
										$shiftObj['roleid'] = $shiftOb->roleid;
										$roleObj = $this->rostersModel->getRole($shiftOb->roleid);
										// print_r($roleObj);
										$shiftObj['roleName'] = $roleObj->roleName;
										$shiftObj['startTime'] = $shiftOb->startTime;
										$shiftObj['endTime'] = $shiftOb->endTime;
										$shiftObj['shiftid'] = $shiftOb->id;
										$shiftObj['message'] = $shiftOb->message;
										$shiftObj['status'] = $shiftOb->status == 1 ? "Added" : ($shiftOb->status == 2 ? "Published" : ($shiftOb->status == 3 ? "Accepted":"Rejected"));
										$current++;
									// }
									// else{
									// 	$shiftObj['isOnLeave'] = 'Y';
									// 	$shiftObj['leaveId'] = $leaveApp->leaveId;
									// 	$shiftObj['leaveStartDate'] = $leaveApp->startDate;
									// 	$shiftObj['leaveEndDate'] = $leaveApp->endDate;
									// 	$shiftObj['leaveNotes'] = $leaveApp->notes;
									// 	$shiftObj['leaveNoOfHours'] = $leaveApp->noOfHours;
									// 	$shiftObj['leaveStatus'] = $leaveApp->status;
									// }
									array_push($rav['shifts'],$shiftObj);
								}
								array_push($var['roles'],$rav);
							// }
						}
					}
					array_push($data['roster'],$var);
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

	public function updateShift(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$this->load->model('utilModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$startTime = $json->startTime;
				$endTime = $json->endTime;
				$shiftid = $json->shiftid;
				$roleid = $json->roleid;
				$status = $json->status;
				$message = $json->message;
				$days = $json->days;
				set_time_limit ( 60 );

				if($startTime != null && $startTime != "" && $endTime != null && $endTime != "" &&
					$shiftid != null && $shiftid != "" && $roleid != null && $roleid != "" && $status != null && $status != ""){
					$this->load->model('rostersModel');
					$shiftDate = $this->rostersModel->getShiftDate($shiftid)->rosterDate;
					$employeeId = $this->rostersModel->getEmployeeId($shiftid)->userid;
					$rosterid = $this->rostersModel->getRosterId($shiftid)->roasterId;
					$rosterStatus = $this->rostersModel->getRosterFromId($rosterid)->status;
					$number = date('w',strtotime($shiftDate)) - 1;
					$currentDate = date('Y-m-d',strtotime($shiftDate. '-' . $number  .' days')) ;
					$employeeEmail = $this->rostersModel->getEmployeeEmail($employeeId)->email;
					$publisherEmail = $this->rostersModel->getEmployeeDetails($json->userid)->email;

					if(!isset($days->day)){
						$arr = [];
						$arr['arr'] = [];
						$obj = [];
						foreach ($days as $day) {
							$getShiftId = $this->rostersModel->getShiftId($employeeId,$currentDate)->id;
								if($day->YN == "true"){
									if($getShiftId != null){
									$this->rostersModel->updateShift($getShiftId,$startTime,$endTime,$roleid,$status,$message);
											$obj['message'] = "Shift  updated";
										}
										else{
									$this->rostersModel->createNewShift($rosterid,$currentDate,$employeeId,$startTime,$endTime,$roleid,$message);
										$obj['message'] = "Shift  added";
										}

										if($rosterStatus == 'Published'){
											$title =  "Shift updated";
											$intent = "Roster";
											$body = "Click here to view the roster";
											$payload['shiftId'] = $getShiftId;
											$payload['rosterId'] = $rosterid;
											$this->utilModel->insertNotification($json->userid,$intent,$title,$body,json_encode($payload));
											// $this->firebase->sendMessage($title,$body,$payload,$employee->userid);
											$obj['startTime'] = $this->timex($startTime);
											$obj['endTime'] = $this->timex($endTime);
											$obj['date'] = $currentDate;
										}
								array_push($arr['arr'],$obj);
								}
							$currentDate = date('Y-m-d',strtotime($currentDate.'+1 days'));
							//echo $startTime;
						}
						// print_r($arr);
											// $to = 'dheerajreddynannuri1709@gmail.com';$employeeEmail;
											// $template = 'addShiftTemplate';
											// $subject = 'Shift Updated';
											// $this->Emails($to,$template,$subject,$arr);
					}


					if(isset($days->day)){
						$arr = [];
						$arr['arr'] = [];
						$arr['message'] = $this->rostersModel->getEmployeeEmail($employeeId)->name;
						$obj = [];
						foreach ($days->day as $day) {
														$obj = [];
							$getShiftId = $this->rostersModel->getShiftId($employeeId,$currentDate)->id;
								if($day->YN == "true"){
									$this->rostersModel->updateShiftByEmployee($getShiftId,$status);
									if($status == 3){
										$st = 'Accepted';
									}
									if($status == 4){
										$st == 'Rejected';
									}
									$obj['startTime'] = $this->timex($startTime);
									$obj['endTime'] = $this->timex($endTime);
									$obj['date'] = $currentDate;
									array_push($arr['arr'],$obj);
								}else{
									$obj['startTime'] = "";
									$obj['endTime'] = "";
									$obj['date'] = $currentDate;
									array_push($arr['arr'],$obj);
								}
									$subject = "Shift ". $st;
							$currentDate = date('Y-m-d',strtotime($currentDate.'+1 days'));
							}
							$to = 'dheerajreddynannuri1709@gmail.com';
							$template = 'updateShiftTemplate';
							$this->Emails($to,$template,$subject,$arr);
							// print_r(json_encode($arr));
					}
					$data['Status'] = 'SUCCESS';
					http_response_code(200);
					echo json_encode($data);
				}
				else{
					$data['Status'] = 'ERROR';
					$data['Message'] = "Invalid Parameters";
					http_response_code(200);
					echo json_encode($data);
				}
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function updateTemplateShift(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid ){
					$startTime = $json->startTime;
					$endTime = $json->endTime;
					$shiftid = $json->shiftid;
					$roleid = $json->roleid;
					$status = 1;
					$message = $json->message;
					$days = $json->days;
					if($startTime != null && $startTime != "" && $endTime != null && $endTime != "" &&
						$shiftid != null && $shiftid != "" && $roleid != null && $roleid != "" && $status != null && $status != ""){
						$this->load->model('rostersModel');
						$shiftDay = 0;
						$currentDay= $shiftDay;
						$employeeId = $this->rostersModel->getTemplateEmployeeId($shiftid)->userid;
						$rosterTemplateId = $this->rostersModel->getTemplateRosterId($shiftid)->roasterId;

						foreach ($days as $day) {
								if($day->YN == "true"){
									if($this->rostersModel->getTemplateShiftId($employeeId,$currentDay,$rosterTemplateId) != null){
										$getShiftId = $this->rostersModel->getTemplateShiftId($employeeId,$currentDay,$rosterTemplateId)->id;
									$this->rostersModel->updateTemplateShift($getShiftId,$startTime,$endTime,$roleid,$status,$message);
										}
										else{
									$this->rostersModel->createNewTemplateShift($rosterTemplateId,$currentDay,$employeeId,$startTime,$endTime,$roleid,$message);
										}
								}
							$currentDay++;
						}

						$data['Status'] = 'SUCCESS';
						http_response_code(200);
						echo json_encode($data);
					}
					else{
						$data['Status'] = 'ERROR';
						$data['Message'] = "Invalid Parameters";
						http_response_code(200);
						echo json_encode($data);
				}
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function saveRosterPermissions($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $userid){
				$employeeId = $json->employeeId;
				$editRoster = $json->editRoster;
				$rosterId = $json->rosterId;
					$this->load->model('rostersModel');
					if($employeeId != null && $employeeId != "" && $editRoster != null && $rosterId != null && $editRoster != "" && $rosterId != ""){
						$rosterPermission = $this->rostersModel->getRosterPermissions($employeeId,$rosterId,$userid);
					if(count($rosterPermission)  > 0 ){
							$this->rostersModel->updateRosterPermission($employeeId,$rosterId,$userid,$editRoster);
							$data['Status'] = 'SUCCESS';
							http_response_code(200);
							echo json_encode($data);
						}
					if(count($rosterPermission) == 0){
							$this->rostersModel->addRosterPermission($employeeId,$rosterId,$userid,$editRoster);
							$data['Status'] = 'SUCCESS';
							http_response_code(200);
							echo json_encode($data);
							}
						}
					}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function getRosterPermissions($employeeId,$rosterId,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('rostersModel');
					$data['getPermissions'] = $this->rostersModel->getRosterPermissions($employeeId,$rosterId);
					if($data['getPermissions'] != null ){
							$data['Status'] = 'SUCCESS';
							http_response_code(200);
							echo json_encode($data);
						}
						else{
						 	$data['Status'] = 'ERROR';
							http_response_code(200);
							echo json_encode($data);
						 } 
					}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function addNewShift(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$startTime = $json->add_start_time;
				$endTime = $json->add_end_time;
				$rosterid = $json->roster_id;//$json->roster_id;
				$roleid = $json->add_role_id;
				$date = $json->date;
				$empid = $json->emp_id;
				$status = "1";
				if($startTime != null && $endTime != null && $rosterid != null && $roleid != null && $date != null && $empid != null){
					$this->load->model('rostersModel');
					$arr['startTime'] = $this->timex($startTime);
					$arr['endTime'] = $this->timex($endTime);
					$arr['date'] = $date;

					$this->rostersModel->addNewShift($startTime,$endTime,$rosterid,$roleid,$date,$empid,$status);
						$employeeEmail = $this->rostersModel->getEmployeeEmail($empid)->email;
					if(($this->rostersModel->getRosterFromId($rosterid)->status) == 'Published'){
						$subject = "Shift  added";
						$template = 'addShiftTemplate';
						$this->Emails($employeeEmail,$template,$subject,$arr);
					}
					$data['Status'] = 'SUCCESS';
					http_response_code(200);
					echo json_encode($data);
				}
				else{
					$data['Status'] = 'ERROR';
					$data['Message'] = "Invalid Parameters";
					http_response_code(200);
					echo json_encode($data);
				}
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function addNewTemplateShift(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$startTime = $json->add_start_time;
				$endTime = $json->add_end_time;
				$rosterid = $json->roster_id;//$json->roster_id;
				$roleid = $json->add_role_id;
				$date = $json->date;
				$empid = $json->emp_id;
				$status = "1";
				if($startTime != null && $endTime != null && $rosterid != null && $roleid != null && $date != null && $empid != null){
					$this->load->model('rostersModel');
					$this->rostersModel->addNewTemplateShift($startTime,$endTime,$rosterid,$roleid,$date,$empid,$status);
					$data['Status'] = 'SUCCESS';
					http_response_code(200);
					echo json_encode($json);
				}
				else{
					$data['Status'] = 'ERROR';
					$data['Message'] = "Invalid Parameters";
					http_response_code(200);
					echo json_encode($data);
				}
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function updateRoster(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$rosterid = $json->rosterid;
				$status = $json->status;
				$userid = $json->userid;
				if($rosterid != null && $rosterid != "" && $status != null && $status != "" &&
					$userid != null && $userid != ""){
					$this->load->model('rostersModel');
					if($status == "Discarded")
						$this->rostersModel->deleteRoster($rosterid);
					else if($status == "Published"){
						$this->rostersModel->publishRoster($rosterid);
						$this->notificationOnRosterPublish($rosterid,$userid);
					}
					else
						$this->rostersModel->updateRoster($rosterid,$status);
					$data['Status'] = 'SUCCESS';
					http_response_code(200);
					echo json_encode($data);
				}
				else{
					$data['Status'] = 'ERROR';
					$data['Message'] = "Invalid Parameters";
					http_response_code(200);
					echo json_encode($data);
				}
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function updateRosterTemplate(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$rosterid = $json->rosterid;
				$status = $json->status;
				$userid = $json->userid;
				if($rosterid != null && $rosterid != "" && $status != null && $status != "" &&
					$userid != null && $userid != ""){
					$this->load->model('rostersModel');
					if($status == "Discarded")
						$this->rostersModel->deleteRosterTemplate($rosterid);
					else if($status == "Published"){
						$this->rostersModel->publishRoster($rosterid);
						$this->notificationOnRosterPublish($rosterid,$userid);
					}
					else
						$this->rostersModel->updateRoster($rosterid,$status);
					$data['Status'] = 'SUCCESS';
					http_response_code(200);
					echo json_encode($data);
				}
				else{
					$data['Status'] = 'ERROR';
					$data['Message'] = "Invalid Parameters";
					http_response_code(200);
					echo json_encode($data);
				}
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function notificationOnRosterPublish($rosterid,$userid){
		$this->load->model('rostersModel');
		$this->load->model('leaveModel');
		$this->load->model('authModel');
		$this->load->model('utilModel');

		$employees = $this->rostersModel->getAllEmployeesFromRoster($rosterid);
		$roster = $this->rostersModel->getRosterFromId($rosterid);
		$currentDate = $roster->startDate;
		$arr['rosterid'] = $rosterid;
		foreach($employees as $employee){
	    set_time_limit ( 0 ); //0 == unlimited
			$currentDate = $roster->startDate;
			$employeeEmail = $this->rostersModel->getEmployeeDetails($employee->userid)->email;
			$arr['data'] = [];
			$data = [];
			$payload['rosterid'] = $rosterid;
			$payload['startDate'] = ($this->rostersModel->getRosterFromId($rosterid))->startDate;
			$title = 'Roster published';
			$body = 'Click to view the roster';
			$intent = 'Roster';
			$this->utilModel->insertNotification($userid,$intent,$title,$body,json_encode($payload));
			// $this->firebase->sendMessage($title,$body,$payload,$employee->userid);
			for($i=0;$i<5;$i++){
				$leaveApplication = $this->leaveModel->getLeaveApplicationForUser($employee->userid,$currentDate);
				$shift = $this->rostersModel->getShiftDetails($employee->userid,$currentDate);
				if($shift != null){
					$role = $shift->roleid;
					$area = $this->rostersModel->getAreaFromRoleId($role)->areaid;
					$startTime = $this->timex($shift->startTime);
					$endTime = $this->timex($shift->endTime);
					$areaName = $this->rostersModel->getAreaFromAreaId($area)->areaName;
					$roleName = $this->rostersModel->getRole($role)->roleName;
				}
				else{
					$startTime = "";
					$endTime = "";
					$areaName = "";
					$roleName = "";
				}
					$data['date'] = $this->dateToDay($currentDate);
					$data['startTime'] = $startTime;
					$data['endTime'] = $endTime;
					$data['areaName'] = $areaName;
					$data['roleName'] = $roleName;
					$data['leave'] = $leaveApplication;
				$currentDate = date('Y-m-d',strtotime($currentDate.'+1 days'));
					array_push($arr['data'],$data);
			}
				$subject = "Roster  published"; 
				$template = 'rosterPublishEmailTemplate';
				//$employeeEmail = "arpitasaxena555@gmail.com";
					$this->Emails($employeeEmail,$template,$subject,$arr);
				// $this->load->view('rosterPublishEmailTemplate',$arr);
					echo 'SUCCESS';
		}
	}

function timex( $x)
  { 
      $output;
      if(($x/100) < 12 ){
          if(($x%100)==0){
            if($x/1200 == 0){
              $output = "12:00 AM";    
            }
            else{
           $output = intval($x/100) . ":00 AM";
            }
          }
        if(($x%100)!=0){
          if(($x%100) < 10){
            $output = intval($x/100) .":0". $x%100 . " AM";
          }
          if(($x%100) >= 10){
            $output = intval($x/100) .":". $x%100 . " AM";
          }
          }
      }
  else if($x/100>12){
      if(($x%100)==0){
      $output = intval($x/100)-12 . ":00 PM";
      }
      if(($x%100)!=0){
        if(($x%100) < 10){
          $output = intval($x/100)-12 .":0". $x%100 . " PM";
        }
        if(($x%100) >= 10){
          $output = intval($x/100)-12 .":". $x%100 . " PM";
        }
      }
  }
  else{
  if(($x%100)==0){
       $output = intval($x/100) . ": 00 PM";
      }
      if(($x%100)!=0){
        if(($x%100) < 10){
          $output = intval($x/100) . ":0". $x%100 . " PM";
        }
        if(($x%100) >= 10){
          $output = intval($x/100) . ":". $x%100 . " PM";
        }
      }
  }
  return $output;
}


function dateToDay($date){
	$date = explode("-",$date);
	return date("M d, Y",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
}

	public function addCasualEmployee($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			$this->load->model('rostersModel');
			if($json!= null && $res != null && $res->userid == $userid){
					$employees  = $json->emp_id;
				foreach($employees as $emp){
				$checkUserShift = $this->rostersModel->getShiftDetails($emp,$json->date);
					if($checkUserShift == null){
					$startTime = $json->casualEmp_start_time;
					$endTime = $json->casualEmp_end_time;
					$rosterid = $json->roster_id ;//$json->roster_id;
					$roleid = $json->casualEmp_role_id;
					$date = $json->date;
					$status = "1";
					if($startTime != null && $endTime != null && $rosterid != null && $roleid != null && $date != null && $emp != null){
							$this->rostersModel->addCasualEmployees($startTime,$endTime,$rosterid,$roleid,$date,$emp,$status);
						$data['Status'] = 'SUCCESS';
						http_response_code(200);
						echo json_encode($data);
					}
					else{
						$data['Status'] = 'ERROR';
						$data['Message'] = "Invalid Parameters";
						http_response_code(200);
						echo json_encode($data);
					}
				}
				else{
						$data['status'] = "REDUNDANT";
						http_response_code(200);
						echo json_encode($data);
				}
			}
		}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function getCasualEmployees($rosterid,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$this->load->model('utilModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('rostersModel');

				$data['casualEmployees'] = [];
				$rosterEmployees = $this->rostersModel->getAllEmployeesFromRoster($rosterid);

				$userDetails = ($this->utilModel->getUserDetails($userid));
				$getSuperAdmins = $this->utilModel->getSuperAdmins();
				$casualEmployees= [];
				// if($userDetails->role != 1){
					foreach($getSuperAdmins as $superadmin){
						$centers = explode('|',$superadmin->center);
						foreach($centers as $cent){
							$cs = explode('|',$userDetails->center);
							foreach($cs as $c){
								if($c == $cent && $c != "" && $c != null){
									$admin = $superadmin->center;
									$allusers = $this->utilModel->getAllUsers();
									foreach($allusers as $u){
										if($u->role != 1){
											$cntrs = explode('|',$u->center);
											foreach($cntrs as $cntr){
												if($cntr == $cent){
													array_push($casualEmployees,$u);
												}
											}
										}
									}
								}
							}
						}
					}
				// }
				foreach ($casualEmployees as $emp) {
					$emp_exists = false;
					foreach($rosterEmployees as $roster_emp){
						if($roster_emp->userid == $emp->id){
							$emp_exists = true;
						}
					}
					if($emp_exists == false){
						$var['empName'] = $emp->name;
						$var['empCenter'] = $emp->center;
						$var['empId'] = $emp->id;
						array_push($data['casualEmployees'],$var);
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

	public function getRoles($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
					$this->load->model('rostersModel');
					$data['roles'] = $this->rostersModel->getRoles();
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

	public function getShiftDetails($shiftId,$role,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
					$this->load->model('rostersModel');
					$data['shiftDetails'] = $this->rostersModel->getShiftAndRoleDetails($shiftId,$role);
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

	public function getTemplateShiftDetails($shiftId,$role,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
					$this->load->model('rostersModel');
					$data['shiftDetails'] = $this->rostersModel->getTemplateShiftAndRoleDetails($shiftId,$role);
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

	public function getRosterTemplates($centerid,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
					$this->load->model('rostersModel');
					$data['templates'] = $this->rostersModel->getAllRosterTemplates($centerid);
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