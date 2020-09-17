<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rosters extends CI_Controller {

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

	public function createRoster(){
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
					foreach ($allRoles as $role) {
						$allEmployess = $this->rostersModel->getAllEmployeesFromRole($role->roleid,$rosterid);
						foreach ($allEmployess as $employeeid) {
							// if($userDetails->role == SUPERADMIN || $userDetails->role == ADMIN || $userid == $employeeid->userid){
								$rav['empId'] = $employeeid->userid;
								$empDetails = $this->authModel->getUserDetails($employeeid->userid);
								$rav['empName'] = $empDetails->name;
								$rav['empTitle'] = $empDetails->title;
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
				if($startTime != null && $startTime != "" && $endTime != null && $endTime != "" &&
					$shiftid != null && $shiftid != "" && $roleid != null && $roleid != "" && $status != null && $status != ""){
					$this->load->model('rostersModel');
					$shiftDate = $this->rostersModel->getShiftDate($shiftid)->rosterDate;
					$employeeId = $this->rostersModel->getEmployeeId($shiftid)->userid;
					$rosterid = $this->rostersModel->getRosterId($shiftid)->roasterId;
					$number = date('w',strtotime($shiftDate)) - 1;
					$currentDate = date('Y-m-d',strtotime($shiftDate. '-' . $number  .' days')) ;

					foreach ($days as $day) {
						$getShiftId = $this->rostersModel->getShiftId($employeeId,$currentDate)->id;
							if($day->YN == "true"){
								if($getShiftId != null){
								$this->rostersModel->updateShift($getShiftId,$startTime,$endTime,$roleid,$status,$message);
									}
									else{
								$this->rostersModel->createNewShift($rosterid,$currentDate,$employeeId,$startTime,$endTime,$roleid,$message);
									}
							}
						$currentDate = date('Y-m-d',strtotime($currentDate.'+1 days'));
						echo $startTime;
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
					$this->rostersModel->addNewShift($startTime,$endTime,$rosterid,$roleid,$date,$empid,$status);
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

	public function notificationOnRosterPublish($rosterid,$userid){
		$this->load->model('rostersModel');
		$this->load->model('leaveModel');
		$this->load->model('authModel');
		$config = Array(    
			    'protocol'  => 'smtp',
			    'smtp_host' => 'ssl://smtp.zoho.com',
			    'smtp_port' => 465,
			    'smtp_user' => 'demo@todquest.com',
			    'smtp_pass' => 'K!ddz1ng',
			    'mailtype'  => 'html',
			    'charset'   => 'utf-8'
		);

		$this->load->library('email',$config); // Load email template
		$this->email->set_newline("\r\n");

		$employees = $this->rostersModel->getAllEmployeesFromRoster($rosterid);
		$roster = $this->rostersModel->getRosterFromId($rosterid);
		$currentDate = $roster->startDate;
		foreach($employees as $employee){
			$currentDate = $roster->startDate;
			$employeeEmail = $this->rostersModel->getEmployeeDetails($employee->userid)->email;
			$arr['data'] = [];
			$data = [];
			for($i=0;$i<5;$i++){
				$leaveApplication = $this->leaveModel->getLeaveApplicationForUser($employee->userid,$currentDate);
				$shift = $this->rostersModel->getShiftDetails($employee->userid,$currentDate);
				if($shift != null){
					$role = $shift->roleid;
					print_r($role);
					echo "||";
					$area = $this->rostersModel->getAreaFromRoleId($role)->areaid;
					$startTime = $shift->startTime;
					$endTime = $shift->endTime;
					$areaName = $this->rostersModel->getAreaFromAreaId($area)->areaName;
					$roleName = $this->rostersModel->getRole($role)->roleName;
				}
				else{
					$currentDate = "";
					$startTime = "";
					$endTime = "";
					$areaName = "";
					$roleName = "";
				}
					$data['date'] = $currentDate;
					$data['startTime'] = $startTime;
					$data['endTime'] = $endTime;
					$data['areaName'] = $areaName;
					$data['roleName'] = $roleName;
					$data['leave'] = $leaveApplication;
				$currentDate = date('Y-m-d',strtotime($currentDate.'+1 days'));
					array_push($arr['data'],$data);
			}
				$user_email = $employeeEmail;
				$subject = "Roster has been published";
				$this->email->to($user_email); 
				$this->email->subject($subject); 
				$message = $this->load->view('rosterPublishEmailTemplate',$arr,true);
				$this->email->message($message); 
				$this->email->send();
				// $this->load->view('rosterPublishEmailTemplate',$arr);
		}
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
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('rostersModel');
				$casualEmployees = $this->rostersModel->getCasualEmployees();
				$data['casualEmployees'] = [];

				$rosterEmployees = $this->rostersModel->getAllEmployeesFromRoster($rosterid);
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

}