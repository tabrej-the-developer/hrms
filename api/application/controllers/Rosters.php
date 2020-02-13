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
				$data['rosters'] = [];
				foreach ($rosters as $rost) {
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
						$endDate = date( "Y-m-d", strtotime( "$startDate +5 day" ));
						$currentRoster = $this->rostersModel->createNewRoster($userid,$startDate,$endDate,$centerid);
						$allAreas = $this->rostersModel->getAllAreas($centerid);
						$data['id'] = $currentRoster;
						$data['rosterStartDate'] = $startDate;
						$data['rosterEndDate'] = $endDate;
						$data['status'] = "Draft";
						$data['roster'] = [];
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
							$areaEmployeeCount = 0;
							foreach ($allRoles as $role) {
								$allEmployess = $this->rostersModel->getAllEmployees($role->roleid);
								foreach ($allEmployess as $employee) {
									$rav['empId'] = $employee->id;
									$empDetails = $this->authModel->getUserDetails($employee->id);
									$rav['empName'] = $empDetails->name;
									$rav['empTitle'] = $empDetails->title;
									$rav['hourlyRate'] = $employee->hourlyRate;
									$rav['maxHoursPerWeek'] = $employee->maxHoursPerWeek;
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
									array_push($var['roles'],$rav);
								}
							}
							array_push($data['roster'],$var);
						}
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
				$roster = $this->rostersModel->getRosterFromId($rosterid);
				$allAreas = $this->rostersModel->getAllAreas($roster->centerid);
				$userDetails = $this->authModel->getUserDetails($userid);
				$data['id'] = $roster->id;
				$data['rosterStartDate'] = $roster->startDate;
				$data['rosterEndDate'] = $roster->endDate;
				$data['status'] = $roster->status;
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
							if($userDetails->role == SUPERADMIN || $userDetails->role == ADMIN || $userid == $employeeid->userid){
								$rav['empId'] = $employeeid->userid;
								$empDetails = $this->authModel->getUserDetails($employeeid->userid);
								$rav['empName'] = $empDetails->name;
								$rav['empTitle'] = $empDetails->title;
								$rav['hourlyRate'] = $empDetails->hourlyRate;
								$rav['maxHoursPerWeek'] = $empDetails->maxHoursPerWeek;
								$rav['shifts'] = [];
								$allShifts = $this->rostersModel->getAllShiftsFromEmployee($rosterid,$employeeid->userid);
								foreach ($allShifts as $shiftOb) {
									$shiftObj['currentDate'] = $shiftOb->rosterDate;
									$shiftObj['roleid'] = $shiftOb->roleid;
									$roleObj = $this->rostersModel->getRole($shiftOb->roleid);
									$shiftObj['roleName'] = $roleObj->roleName;
									$shiftObj['startTime'] = $shiftOb->startTime;
									$shiftObj['endTime'] = $shiftOb->endTime;
									$shiftObj['shiftid'] = $shiftOb->id;
									$shiftObj['status'] = $shiftOb->status == 1 ? "Added" : ($shiftOb->status == 2 ? "Published" : "Accepted");
									array_push($rav['shifts'],$shiftObj);
								}
								array_push($var['roles'],$rav);
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
				if($startTime != null && $startTime != "" && $endTime != null && $endTime != "" &&
					$shiftid != null && $shiftid != "" && $roleid != null && $roleid != "" && $status != null && $status != ""){
					$this->load->model('rostersModel');
					$this->rostersModel->updateShift($shiftid,$startTime,$endTime,$roleid,$status);
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
}