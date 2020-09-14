<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
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


	public function addArea(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$centerid = $json->centerid;
				$areaName = $json->areaName;
				$isRoomYN = $json->isRoomYN;
				$this->load->model('settingsModel');
				if($areaName != null & $areaName != ""){
					$area = $this->settingsModel->getAreaByName($centerid,$areaName);
					if($area == null){
						$area = $this->settingsModel->createArea($centerid,$areaName,$isRoomYN);
						$data['Status'] = "SUCCESS";
					}
					else{
						$data['Status'] = "ERROR";
						$data['Message'] = "Area with the same name already exists";
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

	public function updateArea(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$areaid = $json->areaid;
				$areaName = $json->areaName;
				$isRoomYN = $json->isRoomYN;
				$this->load->model('settingsModel');
				$area = $this->settingsModel->getAreaExists($areaName,$areaid);
				if($area == null || (strtolower($areaName) == strtolower($area->areaName))){
					$area = $this->settingsModel->updateArea($areaid,$areaName,$isRoomYN);
					$data['Status'] = "SUCCESS";
				}
				else{
					$data['Status'] = "ERROR";
					$data['Message'] = "Area with the same name already exists";
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



	public function addRole(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$areaid = $json->areaid;
				$roleName = $json->roleName;
				$this->load->model('settingsModel');
				$role = $this->settingsModel->getRoleByName($areaid,$roleName);
				if($role == null){
					$role = $this->settingsModel->createRole($areaid,$roleName);
					$data['Status'] = "SUCCESS";
				}
				else{
					$data['Status'] = "ERROR";
					$data['Message'] = "Role with the same name already exists";
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

	public function updateRole(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$roleid = $json->roleid;
				$roleName = $json->roleName;
				$this->load->model('settingsModel');
				$role = $this->settingsModel->getRoleExists($roleName,$roleid);
				if($role == null){
					$role = $this->settingsModel->updateRole($roleid,$roleName);
					$data['Status'] = "SUCCESS";
				}
				else{
					$data['Status'] = "ERROR";
					$data['Message'] = "Role with the same name already exists";
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



	public function addRoom(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){

				$centerid = $json->centerid;
				$name = $json->name;
				$careAgeFrom = $json->careAgeFrom;
				$careAgeTo = $json->careAgeTo;
				$capacity = $json->capacity;
				$studentRatio = $json->studentRatio;
				$this->load->model('settingsModel');
				$roomid = $this->settingsModel->addRoom($centerid,$name,$careAgeFrom,$careAgeTo,$capacity,$studentRatio);
				$this->settingsModel->createArea($centerid,$name,'Y');
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

	public function editRoom(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
		
		if($json!= null && $res != null && $res->userid == $json->userid){
			if($json->response == 'edit'){
				$roomId =$json->roomId;
				$centerid = $json->centerid;
				$name = $json->name;
				$careAgeFrom = $json->careAgeFrom;
				$careAgeTo = $json->careAgeTo;
				$capacity = $json->capacity;
				$studentRatio = $json->studentRatio;
				$this->load->model('settingsModel');
		$roomid = $this->settingsModel->editRoom($centerid,$name,$careAgeFrom,$careAgeTo,$capacity,$studentRatio,$roomId);
				$data['Status'] = 'SUCCESS';
				}
		if($json->response == 'delete'){
					$roomId =$json->roomId;
				$this->load->model('settingsModel');
				$roomid = $this->settingsModel->deleteRoom($roomId);
				$data['Status'] = 'DELETED _ SUCCESS';
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

	public function getStates($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('settingsModel');
				$data['states'] = $this->settingsModel->getStates($userid);
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

	public function getRooms($centerid,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('settingsModel');
				$allRooms = $this->settingsModel->getRooms($centerid);
				$data['rooms'] = [];
				foreach ($allRooms as $room) {
					$var['roomId'] = $room->roomId;
					$var['name'] = $room->name;
					$var['careAgeFrom'] = $room->careAgeFrom;
					$var['careAgeTo'] = $room->careAgeTo;
					$var['capacity'] = $room->capacity;
					$var['studentRatio'] = $room->studentRatio;
					array_push($data['rooms'],$var);
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

	public function getSuperfunds($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('settingsModel');
				$superfunds = $this->settingsModel->getSuperfunds();
				$data['superfunds'] = [];
				foreach ($superfunds as $superfund) {
					$var['id']= $superfund->id;
					$var['abn']= $superfund->abn;
					$var['usi']= $superfund->usi;
					$var['type']= $superfund->type;
					$var['name']= $superfund->name;
					$var['bsb']= $superfund->bsb;
					$var['accountNumber']= $superfund->accountNumber;
					$var['accountName']= $superfund->accountName;
					$var['eServiceAddress']= $superfund->eServiceAddress;
					$var['employeeNo']= $superfund->employeeNo;
					$var['created_at']= $superfund->created_at;
					$var['created_by']= $superfund->created_by;
					array_push($data['superfunds'],$var);
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


	public function getAwardSettings($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('settingsModel');
					$awards = $this->settingsModel->getAwards();
					$data['awards'] = [];
					foreach ($awards as $award) {
						$var['id'] = $award->id;
						$var['earningRateId'] = $award->earningRateId;
						$var['name'] = $award->name;
						$var['isExemptFromTaxYN'] = $award->isExemptFromTaxYN;
						$var['isExemptFromSuperYN'] = $award->isExemptFromSuperYN;
						$var['isReportableAsW1'] = $award->isReportableAsW1;
						$var['earningType'] = $award->earningType;
						$var['rateType'] = $award->rateType;
						$var['multiplier_amount'] = $award->multiplier_amount;
						$var['currentRecordYN'] = $award->currentRecordYN;
						$var['created_by'] = $award->created_by;
						$var['created_at'] = $award->created_at;
					array_push($data['awards'],$var);
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


	public function changePassword(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$userid = $json->userid;
				$password = $json->password;
				$passcode = $json->passcode;
				$this->load->model('settingsModel');
				$user = $this->authModel->getUserDetails($userid);
				if($user != null){
				$user = $this->settingsModel->changePassword($userid,$password,$passcode);
					$data['Status'] = "SUCCESS";
				}
				else{
					$data['Status'] = "ERROR";
					$data['Message'] = "Error password change";
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

		
	public function addCenter(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
					$center_name = $json->center_name;
					$center_city = $json->center_city;
					$center_street = $json->center_street;
					$center_state = $json->center_state;
					$center_zip = $json->center_zip;
					$center_phone = $json->center_phone;
					$center_mobile = $json->center_mobile;
					$center_email = $json->center_email;
					$center_abn = $json->center_abn;
					$center_acn = $json->center_acn;
					$center_se_no = $json->center_se_no;
					$center_date_opened = $json->center_date_opened;
					$center_capacity = $json->center_capacity;
					$center_approval_doc = $json->center_approval_doc;
					print_r($center_approval_doc);
								$this->load->model('settingsModel');
					if($center_approval_doc != ""){
						$destination = "application/assets/files/";
						$file_name = "center_approval_doc_".uniqid().".pdf";
						file_put_contents("$destination".$file_name,base64_decode($center_approval_doc));

						$center_approval_doc = $file_name;
						// move_uploaded_file("/".$file_name, $destination);
					}
					else{
						$center_approval_doc = ""; 
					}
					$center_ccs_doc = $json->center_ccs_doc;
					if($center_ccs_doc != ""){
						$destination = "application/assets/files/";
						$file_name = "center_ccs_doc_".uniqid().".pdf";
						file_put_contents("$destination".$file_name,base64_decode($center_ccs_doc));
						$center_ccs_doc = $file_name;
						// move_uploaded_file("/".$file_name, $destination);
					}
					else{
						$center_ccs_doc = ""; 
					}
					$center_admin_name = $json->center_admin_name;
					$centre_nominated_supervisor = $json->centre_nominated_supervisor;
					$room_name = $json->room_name;
					$capacity_ = $json->capacity_;
					$minimum_age = $json->minimum_age;
					$maximum_age = $json->maximum_age;
					if($center_name != null && $center_name != ""){
					$centerid = $this->settingsModel->addCenter($center_city,$center_street,$center_state,$center_zip,$center_name,$center_phone,$center_mobile,$center_email,$json->userid);
					$centerRecordUniqueId = uniqid();
					$this->settingsModel->addCenterRecord($centerid,$centerRecordUniqueId,$center_abn,$center_acn,$center_se_no,$center_date_opened,$center_capacity,$center_approval_doc,$center_ccs_doc,$center_admin_name,$centre_nominated_supervisor);
					for($i=0;$i<count($room_name);$i++){
						$roo = $room_name[$i];
						$cap = $capacity_[$i];
						$minim = $minimum_age[$i];
						$maxim = $maximum_age[$i];
						$this->settingsModel->addRoom($centerid,$roo,$cap,$minim,$maxim);
					}
					}
					$data['Status'] = "SUCCESS";
				http_response_code(200);
				echo json_encode($room_name);
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}
	
	public function editCenter($centerid,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('settingsModel');
				$data['centerDetails'] = $this->settingsModel->centerDetails($centerid);
				$data['centerRecord'] = $this->settingsModel->centerRecord($centerid);
				$data['rooms'] = $this->settingsModel->getRooms($centerid);
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

	public function updateCenter(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			//$newR = $this->UtilModel->getCenterById($json->centerid);
			if($json!= null && $res != null && $res->userid == $json->userid){
				$addStreet = $json->addStreet;
				$addCity = $json->addCity;
				$addState = $json->addState;
				$addZip = $json->addZip;
				$name = $json->name;
				$logo = $json->logo;
				$centerid = $json->centerid;
				if($logo == null){
					$logo = "http://vizytor.todquest.com/images/logo/amiga.png";
				}else{
				$destFile = "assets/images/".$_FILES['file']['name'];
				move_uploaded_file( $_FILES['file']['tmp_name'], $destFile );
				}
				$this->load->model('UtilModel');
				$center = $this->UtilModel->getCenterById($centerid);
				if($center != null){
				$this->load->model('settingsModel');
				$center = $this->settingsModel->updateCenterProfile($centerid,$logo,$name,$addStreet,$addCity,$addState,$addZip);
					$data['Status'] = "SUCCESS";
				}
				else{
					$data['Status'] = "ERROR";
					$data['Message'] = "Center doesnot exist";
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

	public function getAreas($centerid,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('settingsModel');
				$allAreas = $this->settingsModel->getAllAreas($centerid);
				$data['areas'] = [];
				foreach ($allAreas as $area) {
					$var['areaId'] = $area->areaid;
					$var['areaName'] = $area->areaName;
					$var['roles'] = $this->settingsModel->getRolesFromArea($area->areaid);
					array_push($data['areas'],$var);
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


	public function getOrgChart($centerid,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('settingsModel');
				$allAreas = $this->settingsModel->getAllAreas($centerid);
				$data['orgchart'] = [];
				foreach ($allAreas as $area) {
					$var['areaId'] = $area->areaid;
					$var['centerid'] = $area->centerid;
					$var['areaName'] = $area->areaName;
					$var['isARoomYN'] = $area->isARoomYN;
					$var['roles'] = $this->settingsModel->getRolesFromArea($area->areaid);
					array_push($data['orgchart'],$var);
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

	public function getEmployeesForRoles($roleid,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('settingsModel');
				$this->load->model('rostersModel');
				$data['employees'] = $this->rostersModel->getAllEmployees($roleid);
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

	public function deleteRoom($roomid,$userid){
		$headers = $this->input->request_headers();
	   if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
		$this->load->model('authModel');
		$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
		if($res != null && $res->userid == $userid){
			$this->load->model('settingsModel');
				$this->settingsModel->deleteRoom($roomid);
				$data['status'] = 'SUCCESS';
			}
			http_response_code(200);
			echo json_encode($data);
		}
		else{
			http_response_code(401);
		}
	}

	public function deleteArea($areaid,$userid){
		$headers = $this->input->request_headers();
	   if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
		$this->load->model('authModel');
		$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
		if($res != null && $res->userid == $userid){
			$this->load->model('settingsModel');
				$this->settingsModel->deleteArea($areaid);
				$data['status'] = 'SUCCESS';
			}
			http_response_code(200);
			echo json_encode($data);
		}
		else{
			http_response_code(401);
		}
	}

	public function deleteRole($roleid,$userid){
		$headers = $this->input->request_headers();
	   if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
		$this->load->model('authModel');
		$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
		if($res != null && $res->userid == $userid){
			$this->load->model('settingsModel');
				$this->settingsModel->deleteRole($roleid);
				$data['status'] = 'SUCCESS';
			}
			http_response_code(200);
			echo json_encode($data);
		}
		else{
			http_response_code(401);
		}
	}

	public function changeEmployeeRole(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
					if($json->employeeId != null && $json->roleId != null){
						$employeeId = $json->employeeId;
						$roleId = $json->roleId;
						$this->load->model('settingsModel');
						$this->settingsModel->updateEmployeeRole($employeeId,$roleId);
						$data['Status'] = "SUCCESS";
						$data['Message'] = "Role Updated";
					}
				else{
					$data['Status'] = "ERROR";
					$data['Message'] = "Role Not Updated";
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
	public function addMultipleEmployees($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $userid){
					$array = $json->details;
					for($i=1;$i<count($array);$i++){
						$index = 0;
						$data['emails']	 = $array[$i][$index];

						$index = 1;
						$data['name']	 = $array[$i][$index];

						$index = 2;
						$data['alias']	 = $array[$i][$index];

						$index = 3;
						$data['role']	 = $array[$i][$index];

						$index = 4;
						$data['area']	 = $array[$i][$index];

						$index = 5;
						$data['level']	 = $array[$i][$index];


						$index = 6;
						$data['startDate'] = $array[$i][$index];

						// $index = array_search("xeroEmployeeId", array_keys($array[0]));
						// $xeroEmployeeId = $array[$i][$index];

						$index = 7;
						$data['employee_no'] = $array[$i][$index];


						$data['center'] = $json->center;

						// $index = array_search("ordinaryEarningRateId", array_keys($array[0]));
						// $ordinaryEarningRateId = $array[$i][$index];

						// $index = array_search("payroll_calendar", array_keys($array[0]));
						// $payroll_calendar = $array[$i][$index];
						$data['uniqueId'] = uniqid();
						
						$data['password'] = md5((explode(" ",$data['name']))[0]."@123");
						// $this->settingsModel->addToEmployeeCourses( $xeroEmployeeId,$course_nme=null,$course_desc=null,$date_obt=null,$exp_date=null);
						// var_dump($data);
								$areaId = ($this->settingsModel->getAreaId($data['center'],$data['area']));
								if($areaId == null){
										$areaId = $this->settingsModel->addArea($data['center'],$data['area'])->areaid;
								}
								else{
									$areaId = $areaId->areaid;
								}
								$roleId = ($this->settingsModel->getRoledId($areaId,$data['role']));
								if($roleId == null){
									$roleId = ($this->settingsModel->addRole($areaId,$data['role']))->roleid;
								}
								else{
									$roleId = $roleId->roleid;
								}


						if(($data['employee_no'] != null && $data['employee_no'] != "") && ($data['emails'] != null && $data['emails'] != "") && ($data['center'] != null && $data['center'] != "") && ($data['area'] != null && $data['area'] != "") && ($data['role'] != null && $data['role'] != "") ){
								$this->settingsModel->addToUsers($data['employee_no'],$data['password'],$data['emails'],$data['name'],$data['center'],$userid,intval($roleId),$data['level'],$data['alias']);
									//var_dump($this->settingsModel->getPermissionForEmployee($data['employee_no']));
									if($this->settingsModel->getPermissionForEmployee($data['employee_no']) == null ){
										$this->settingsModel->addPermissions($data['employee_no'], $isQrReaderYN = 'N', $viewRosterYN = 'Y', $editRosterYN = 'N', $viewTimesheetYN = 'Y', $editTimesheetYN = 'N', $viewPayrollYN = 'Y', $editPayrollYN = 'N', $editLeaveTypeYN = 'N', $viewLeaveTypeYN = 'Y', $createNoticeYN = 'Y', $viewOrgChartYN = 'Y', $editOrgChartYN = 'N', $viewCenterProfileYN = 'Y', $editCenterProfileYN = 'Y', $viewRoomSettingsYN = 'Y', $editRoomSettingsYN = 'N', $viewEntitlementsYN = 'Y', $editEntitlementsYN = 'N', $editEmployeeYN = 'N', $xeroYN = 'N', $viewAwardsYN = 'Y', $editAwardsYN = 'N', $viewSuperfundsYN = 'Y', $editSuperfundsYN = 'N', $createMomYN = 'Y', $editPermissionYN = 'Y', $viewPermissionYN = 'Y');
										}

								$ouput['Status'] = "Records Added Successfully";
						}
						else{
							$ouput['Status'] = "Some of the mandatory fields seems to be missing";
						}

					}
					
				}
				else{
					$ouput['Status'] = "ERROR";
				}
				http_response_code(200);
				echo json_encode($ouput);
			}
			else{
				http_response_code(401);
			}
		}

	public function createEmployeeProfile(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
					$userid = $json->userid;
					$title = $json->title;
					$fname = $json->fname;
					$mname = $json->mname;
					$lname = $json->lname;
					$emails = $json->emails;
					$alias = $json->alias;
					$dateOfBirth = $json->dateOfBirth;
					$gender = $json->gender;
					$jobTitle = $json->jobTitle;
					$homeAddLine1 = $json->homeAddLine1;
					$homeAddLine2 = $json->homeAddLine2;
					$homeAddCity = $json->homeAddCity;
					$homeAddRegion = $json->homeAddRegion;
					$homeAddPostal = $json->homeAddPostal;
					$homeAddCountry = $json->homeAddCountry;
					$phone = $json->phone;
					$mobile = $json->mobile;
					$startDate = $json->startDate;
					$terminationDate = $json->terminationDate;
					$emergency_contact = $json->emergency_contact;
					$relationship = $json->relationship;
					$emergency_contact_email = $json->emergency_contact_email;
					$accountName = $json->accountName;
					$bsb = $json->bsb;
					$accountNumber = $json->accountNumber;
					$remainderYN = $json->remainderYN;
					$amount = $json->amount;
					$superFundId = $json->superFundId;
					$superMembershipId = $json->superMembershipId;
					$employmentBasis = $json->employmentBasis;
					$tfnExemptionType = $json->tfnExemptionType;
					$taxFileNumber = $json->taxFileNumber;
					$australiantResidentForTaxPurposeYN = $json->australiantResidentForTaxPurposeYN;
					$residencyStatue = $json->residencyStatue;
					$taxFreeThresholdClaimedYN = $json->taxFreeThresholdClaimedYN;
					$taxOffsetEstimatedAmount = $json->taxOffsetEstimatedAmount;
					$hasHELPDebtYN = $json->hasHELPDebtYN;
					$hasSFSSDebtYN = $json->hasSFSSDebtYN;
					$hasTradeSupportLoanDebtYN_ = $json->hasTradeSupportLoanDebtYN_;
					$upwardVariationTaxWitholdingAmount = $json->upwardVariationTaxWitholdingAmount;
					$eligibleToReceiveLeaveLoadingYN = $json->eligibleToReceiveLeaveLoadingYN;
					$approvedWitholdingVariationPercentage = $json->approvedWitholdingVariationPercentage;
					$employee_no = $json->employee_no;
					$center = $json->center;
					$area = $json->area;
					$role = $json->role;
					$manager = $json->manager;
					$level = $json->level;
					$bonusRates = $json->bonusRates;
					$resume_doc = $json->resume_doc;
					$classification = $json->classification;
					$ordinaryEarningRateId = $json->ordinaryEarningRateId;
					$payroll_calendar = $json->payroll_calendar;
					$employee_group = $json->employee_group;
					$holiday_group = $json->holiday_group;
					$medicareNo = $json->medicareNo;
					$medicareRefNo = $json->medicareRefNo;
					$healthInsuranceFund = $json->healthInsuranceFund;
					$healthInsuranceNo = $json->healthInsuranceNo;
					$ambulanceSubscriptionNo = $json->ambulanceSubscriptionNo;
					$xeroEmployeeId = $json->xeroEmployeeId;

// Employee Courses	
						$course_name = $json->course_name;
						$course_description = $json->course_description;
						$date_obtained = $json->date_obtained;
						$expiry_date = $json->expiry_date;
						$certificate = $json->certificate;
					for($i=0;$i<count($course_name);$i++){
						$course_nme = $course_name[$i];
						$course_desc = $course_description[$i];
						$date_obt = $date_obtained[$i];
						$exp_date = $expiry_date[$i];
						// $cert = $certificate[$i];
						// get employee Id
						if($xeroEmployeeId != null && $xeroEmployeeId != "" ){
							if($course_nme != "" && $course_nme != null){
$this->settingsModel->addToEmployeeCourses( $xeroEmployeeId,$course_nme,$course_desc,$date_obt,$exp_date);
						}
					}
				}
// Users	
					$name = $fname." ".$mname." ".$lname;
					$password = $fname."@123";
			if($employee_no != null && $employee_no != "" ){
				if($emails != "" && $emails != null){
$this->settingsModel->addToUsers($employee_no,$password,$emails,$name,$jobTitle,$center,$manager,$userid,$role,$level,$alias);
						}
					}
// Employee bank account	
						if($xeroEmployeeId != null && $xeroEmployeeId != "" ){
							if($accountName != "" && $accountName != null){
$this->settingsModel->addToEmployeeBankAccount( $xeroEmployeeId,$accountName,$bsb,$accountNumber,$remainderYN,$amount);
						}
					}
// Employee medical info	
						if($xeroEmployeeId != null && $xeroEmployeeId != "" ){
							if($medicareNo != "" && $medicareNo != null){
$this->settingsModel->addToEmployeeMedicalInfo($xeroEmployeeId,$medicareNo, $medicareRefNo,$healthInsuranceFund,$healthInsuranceNo, $ambulanceSubscriptionNo);
						}
					}
// Employee medicals	
						$medicalConditions = $json->medicalConditions;
						$medicalAllergies = $json->medicalAllergies;
						$medication = $json->medication;
						$dietaryPreferences = $json->dietaryPreferences;
				for($i=0;$i<count($medicalConditions);$i++){
						$medC = $medicalConditions[$i];
						$medA = $medicalAllergies[$i];
						$medic = $medication[$i];
						$dietary = $dietaryPreferences[$i];
						if($xeroEmployeeId != null && $xeroEmployeeId != "" ){
							if($medC != "" && $medC != null){
$this->settingsModel->addToEmployeeMedicals( $xeroEmployeeId,$medC,$medA,$medic,$dietary);
									}
								}
				}
// Employee record	
					$employement_type = $json->employement_type;
					$highest_qual_held = $json->highest_qual_held;
					$highest_qual_date_obtained = $json->highest_qual_date_obtained;
					$highest_qual_cert = $json->highest_qual_cert;
					$qual_towards_desc = $json->qual_towards_desc;
					$qual_towards_percent_comp = $json->qual_towards_percent_comp;
					$visa_holder = $json->visa_holder;
					$visa_type = $json->visa_type;
					$visa_grant_date = $json->visa_grant_date;
					$visa_end_date = $json->visa_end_date;
					$visa_conditions = $json->visa_conditions;
					$contract_doc = $json->contract_doc;

				// Employee No from Users 
				$uniqueId = uniqid();
						if(($xeroEmployeeId != null && $xeroEmployeeId != "" ) || ($employee_no != null && $employee_no != "" )){
							if($medC != "" && $medC != null){
$this->settingsModel->addToEmployeeRecord($employee_no, $xeroEmployeeId, $uniqueId,$resume_doc, 
	$employement_type, $qual_towards_desc, $highest_qual_held, $qual_towards_percent_comp, $visa_type, $visa_grant_date, $visa_end_date, $visa_conditions, $contract_doc, $highest_qual_date_obtained, $highest_qual_cert, $visa_holder);
// Employee superfunds	
						if($xeroEmployeeId != null && $xeroEmployeeId != "" ){
							if($superFundId != "" && $superFundId != null){
$this->settingsModel->addToEmployeeSuperfunds( $xeroEmployeeId, $superFundId,
$superMembershipId);
										}
									}
// Employee Tax Declaration
						if($xeroEmployeeId != null && $xeroEmployeeId != "" ){
							if($employmentBasis != "" && $employmentBasis != null){
$this->settingsModel->addToEmployeeTaxDeclaration($xeroEmployeeId,$employmentBasis,$tfnExemptionType,$taxFileNumber,$australiantResidentForTaxPurposeYN,$residencyStatue,$taxFreeThresholdClaimedYN,$taxOffsetEstimatedAmount,$hasHELPDebtYN,$hasSFSSDebtYN,$hasTradeSupportLoanDebtYN_,$upwardVariationTaxWitholdingAmount,$eligibleToReceiveLeaveLoadingYN,$approvedWitholdingVariationPercentage);
										}
									}
// Employee Table
						if($xeroEmployeeId != null && $xeroEmployeeId != "" ){
							if($employee_no != "" && $employee_no != null){
$this->settingsModel->addToEmployeeTable($employee_no, $xeroEmployeeId,$title,$fname,$mname,$lname,$emails,$dateOfBirth,$jobTitle,$gender,$homeAddLine1,$homeAddLine2,$homeAddCity,$homeAddRegion,$homeAddPostal,$homeAddCountry,$phone,$mobile,$startDate,$terminationDate,$ordinaryEarningRateId,$payroll_calendar,$userid,$classification,$holiday_group,$employee_group,$emergency_contact,$relationship,$emergency_contact_email);
											}
										}
					$data['status'] = 'SUCCESS';
					http_response_code(200);
					echo json_encode($data);
									}
					else{
						http_response_code(401);
							}
						}
					}
				}
			}
 	function postToXero($access_token,$tenant_id,$data){
 		$url = "https://api.xero.com/payroll.xro/1.0/Employees/";
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

// View Employee

	public function getEmployeeProfile($userid,$employeeId){
		$headers = $this->input->request_headers();
	   if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
		$this->load->model('authModel');
		$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
		if($res != null && $res->userid == $userid){
			$this->load->model('settingsModel');
				$data['users'] = $this->settingsModel->getUserData($employeeId);
				$data['employee']	= $this->settingsModel->getEmployeeData($employeeId);
				$data['employeeBankAccount']	= $this->settingsModel->getEmployeeBankAccount($employeeId);
				$data['employeeCourses']	= $this->settingsModel->getEmployeeCourses($employeeId);
				$data['employeeMedicalInfo']	= $this->settingsModel->getEmployeeMedicalInfo($employeeId);
				$data['employeeMedicals']	= $this->settingsModel->getEmployeeMedicals($employeeId);
				$data['employeeRecord']	= $this->settingsModel->getEmployeeRecord($employeeId);
				$data['employeeSuperfunds']	= $this->settingsModel->getEmployeeSuperfunds($employeeId);
				$data['employeeTaxDeclaration'] = $this->settingsModel->getEmployeeTaxDec($employeeId);
				$data['status'] = 'SUCCESS';
			}
			http_response_code(200);
			echo json_encode($data);
		}
		else{
			http_response_code(401);
		}
	}

// Edit Employee 

	public function getEmployeeData($userid){
		$headers = $this->input->request_headers();
	   if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
		$this->load->model('authModel');
		$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
		if($res != null && $res->userid == $userid){
			$this->load->model('settingsModel');
				$data['users'] = $this->settingsModel->getUserData($userid);
				$data['employee']	= $this->settingsModel->getEmployeeData($userid);
				$data['employeeBankAccount']	= $this->settingsModel->getEmployeeBankAccount($userid);
				$data['employeeCourses']	= $this->settingsModel->getEmployeeCourses($userid);
				$data['employeeMedicalInfo']	= $this->settingsModel->getEmployeeMedicalInfo($userid);
				$data['employeeMedicals']	= $this->settingsModel->getEmployeeMedicals($userid);
				$data['employeeRecord']	= $this->settingsModel->getEmployeeRecord($userid);
				$data['employeeSuperfunds']	= $this->settingsModel->getEmployeeSuperfunds($userid);
				$data['employeeTaxDeclaration'] = $this->settingsModel->getEmployeeTaxDec($userid);
				$data['status'] = 'SUCCESS';
			}
			http_response_code(200);
			echo json_encode($data);
		}
		else{
			http_response_code(401);
		}
	}

	public function updateEmployeeProfile(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
					$userid = $json->userid;
					$title = $json->title;
					$fname = $json->fname;
					$mname = $json->mname;
					$lname = $json->lname;
					$emails = $json->emails;
					$alias = $json->alias;
					$dateOfBirth = $json->dateOfBirth;
					$gender = $json->gender;
					// $jobTitle = $json->jobTitle;
					$homeAddLine1 = $json->homeAddLine1;
					$homeAddLine2 = $json->homeAddLine2;
					$homeAddCity = $json->homeAddCity;
					$homeAddRegion = $json->homeAddRegion;
					$homeAddPostal = $json->homeAddPostal;
					$homeAddCountry = $json->homeAddCountry;
					$phone = $json->phone;
					$mobile = $json->mobile;
					$terminationDate = $json->terminationDate;
					$emergency_contact = $json->emergency_contact;
					$relationship = $json->relationship;
					$emergency_contact_email = $json->emergency_contact_email;
					$accountName = $json->accountName;
					$bsb = $json->bsb;
					$accountNumber = $json->accountNumber;
					$remainderYN = $json->remainderYN;
					$amount = $json->amount;
					$superFundId = $json->superFundId;
					$superMembershipId = $json->superMembershipId;
					$tfnExemptionType = $json->tfnExemptionType;
					$taxFileNumber = $json->taxFileNumber;
					$australiantResidentForTaxPurposeYN = $json->australiantResidentForTaxPurposeYN;
					$residencyStatue = $json->residencyStatue;
					$taxFreeThresholdClaimedYN = $json->taxFreeThresholdClaimedYN;
					$taxOffsetEstimatedAmount = $json->taxOffsetEstimatedAmount;
					$hasHELPDebtYN = $json->hasHELPDebtYN;
					$hasSFSSDebtYN = $json->hasSFSSDebtYN;
					$hasTradeSupportLoanDebtYN_ = $json->hasTradeSupportLoanDebtYN_;
					$upwardVariationTaxWitholdingAmount = $json->upwardVariationTaxWitholdingAmount;
					$eligibleToReceiveLeaveLoadingYN = $json->eligibleToReceiveLeaveLoadingYN;
					$approvedWitholdingVariationPercentage = $json->approvedWitholdingVariationPercentage;
					$employee_no = $json->employee_no;
					$resume_doc = $json->resume_doc;
					$classification = $json->classification;
					$ordinaryEarningRateId = $json->ordinaryEarningRateId;
					// $payroll_calendar = $json->payroll_calendar;
					$employee_group = $json->employee_group;
					$holiday_group = $json->holiday_group;
					$medicareNo = $json->medicareNo;
					$medicareRefNo = $json->medicareRefNo;
					$healthInsuranceFund = $json->healthInsuranceFund;
					$healthInsuranceNo = $json->healthInsuranceNo;
					$ambulanceSubscriptionNo = $json->ambulanceSubscriptionNo;
					$xeroEmployeeId = $json->xeroEmployeeId;

// Employee Courses	
						$course_name = $json->course_name;
						$course_description = $json->course_description;
						$date_obtained = $json->date_obtained;
						$expiry_date = $json->expiry_date;
						$certificate = $json->certificate;
						$course_id = $json->course_id;
					for($i=0;$i<count($course_name);$i++){
						$course_nme = $course_name[$i];
						$course_desc = $course_description[$i];
						$date_obt = $date_obtained[$i];
						$exp_date = $expiry_date[$i];
						$id = $course_id[$i];
						// $cert = $certificate[$i];
						// get employee Id
$this->settingsModel->updateEmployeeCourses( $id,$xeroEmployeeId,$course_nme,$course_desc,$date_obt,$exp_date);
					}
// Users	
					$name = $fname." ".$mname." ".$lname;
$this->settingsModel->updateUsers($employee_no,$emails,$name,$title,$userid,$alias);
// Employee bank account	
$this->settingsModel->updateEmployeeBankAccount( $xeroEmployeeId,$accountName,$bsb,$accountNumber,$remainderYN,$amount);
// Employee medical info	
$this->settingsModel->updateEmployeeMedicalInfo($xeroEmployeeId,$medicareNo, $medicareRefNo,$healthInsuranceFund,$healthInsuranceNo, $ambulanceSubscriptionNo);
// Employee medicals	
						$medicalConditions = $json->medicalConditions;
						$medicalAllergies = $json->medicalAllergies;
						$medication = $json->medication;
						$dietaryPreferences = $json->dietaryPreferences;
						$medicals_id = $json->medicals_id;
				for($i=0;$i<count($medicalConditions);$i++){
						$medC = $medicalConditions[$i];
						$medA = $medicalAllergies[$i];
						$medic = $medication[$i];
						$dietary = $dietaryPreferences[$i];
						$id = $medicals_id[$i];
$this->settingsModel->updateEmployeeMedicals( $id,$xeroEmployeeId,$medC,$medA,$medic,$dietary);
				}
// Employee record	
					// $employement_type = $json->employement_type;
					$highest_qual_held = $json->highest_qual_held;
					$highest_qual_date_obtained = $json->highest_qual_date_obtained;
					// $highest_qual_cert = $json->highest_qual_cert;
					$qual_towards_desc = $json->qual_towards_desc;
					$qual_towards_percent_comp = $json->qual_towards_percent_comp;
					$visa_holder = $json->visa_holder;
					$visa_type = $json->visa_type;
					$visa_grant_date = $json->visa_grant_date;
					$visa_end_date = $json->visa_end_date;
					$visa_conditions = $json->visa_conditions;
					$contract_doc = $json->contract_doc;

				// Employee No from Users 
				$uniqueId = uniqid();
$this->settingsModel->updateEmployeeRecord($employee_no, $xeroEmployeeId, $qual_towards_desc, $highest_qual_held, $qual_towards_percent_comp, $visa_type, $visa_grant_date, $visa_end_date, $visa_conditions, $highest_qual_date_obtained,  $visa_holder);
// Employee superfunds	

$this->settingsModel->updateEmployeeSuperfunds( $xeroEmployeeId, $superFundId,
$superMembershipId);
// Employee Tax Declaration

$this->settingsModel->updateEmployeeTaxDeclaration($xeroEmployeeId,$tfnExemptionType,$taxFileNumber,$australiantResidentForTaxPurposeYN,$residencyStatue,$taxFreeThresholdClaimedYN,$taxOffsetEstimatedAmount,$hasHELPDebtYN,$hasSFSSDebtYN,$hasTradeSupportLoanDebtYN_,$upwardVariationTaxWitholdingAmount,$eligibleToReceiveLeaveLoadingYN,$approvedWitholdingVariationPercentage);
// Employee Table

$this->settingsModel->updateEmployeeTable($employee_no, $xeroEmployeeId,$title,$fname,$mname,$lname,$emails,$dateOfBirth,$gender,$homeAddLine1,$homeAddLine2,$homeAddCity,$homeAddRegion,$homeAddPostal,$homeAddCountry,$phone,$mobile,$terminationDate,$ordinaryEarningRateId,$userid,$classification,$holiday_group,$employee_group,$emergency_contact,$relationship,$emergency_contact_email);

			$data['status'] = 'SUCCESS';
			http_response_code(200);
			echo json_encode($data);
				}
		else{
			http_response_code(401);
		}
	}
}



	public function addEmployee(){
		$json = json_decode(file_get_contents('php://input'));
		$this->load->model('authModel');
		if($json != null){
			$email = $json->email;
			$getUser = $this->authModel->getUserFromEmail($email);
			$data = [];
			if($getUser == null){
				$name = $json->name;
				$password = $json->password;
				$role = $json->role;
				$center = $json->center;
				$manager = $json->manager;
				$userid = $json->userid;
				$roleid = $json->roleid;
				$levelId = $json->levelId;
				$userDetails = $this->authModel->getUserDetails($userid);
				if($userDetails != null && $userDetails->role == SUPERADMIN){
					if($name != null && $name != "" &&
						$password != null && $password != "" &&
						$role != null && $role != "" && 
						$center != null && $center != "" && 
						$manager != null && $manager != "" &&
						$roleid != null && $roleid != ""){

						$this->load->model('rostersModel');
						$roleModel = $this->rostersModel->getRole($roleid);

						if($roleModel != null){ 
							$userid = $this->authModel->insertUser($email,$password,$name,$role,$roleModel->roleName,$center,$manager,$userid,$roleid,$levelId);
							
							//todo send mail
							$token = uniqid();
							$this->authModel->insertToken($userid,$token,'N');
							$mData['activationLink'] = base_url().'auth/verifyUser/'.$userid.'/'.$token;
							$mData['appName'] = APP_NAME;
							$this->load->library('email');
							$config = array(
							    'protocol'  => 'smtp',
							    'smtp_host' => 'ssl://smtp.zoho.com',
							    'smtp_port' => 465,
							    'smtp_user' => SMTP_EMAIL,
							    'smtp_pass' => SMTP_PASSWORD,
							    'mailtype'  => 'html',
							    'charset'   => 'utf-8'
							);
							$this->email->initialize($config);
							$this->email->set_mailtype("html");
							$this->email->set_newline("\r\n");
							$htmlContent = $this->load->view('template/signupEmail',$mData,true);
							$this->email->to($email);
							$this->email->from($config['smtp_user'],$mData['appName'].' Support');
							$this->email->subject('Hello from '.$mData['appName']);
							$this->email->message($htmlContent);
							//$this->email->send();


							$data['Status'] = 'SUCCESS';
							$data['Message'] = 'Successfully registered. Please verify your email id to continue';
						}	
					}
					else{
						$data['Status'] = 'ERROR';
						$data['Message'] = "Invalid parameters";
					}
				}
				else{

					$data['Status'] = 'ERROR';
					$data['Message'] = "You are not allowed";
				}
			}
			else{
				$data['Status'] = "ERROR";
				$data['Message'] = "User already exists";
			}
			http_response_code(200);
			echo json_encode($data);
		}
		else{
			http_response_code(401);
		}
	
	}


	public function GetPermissionForEmployee($empId,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('settingsModel');
				$mdata['permissions'] = $this->settingsModel->getPermissionForEmployee($empId);
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

	public function PostEmployeePermission(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$userid = $json->userid;
				$empId = $json->empId;
				$isQrReaderYN = $json->isQrReaderYN;
				$viewRosterYN = $json->viewRosterYN;
				$editRosterYN = $json->editRosterYN;
				$viewTimesheetYN = $json->viewTimesheetYN;
				$editTimesheetYN = $json->editTimesheetYN;
				$viewPayrollYN = $json->viewPayrollYN;
				$editPayrollYN = $json->editPayrollYN;
				$editLeaveTypeYN = $json->editLeaveTypeYN;
				$viewLeaveTypeYN = $json->viewLeaveTypeYN;
				$createNoticeYN = $json->createNoticeYN;
				$viewOrgChartYN = $json->viewOrgChartYN;
				$editOrgChartYN = $json->editOrgChartYN;
				$viewCenterProfileYN = $json->viewCenterProfileYN;
				$editCenterProfileYN = $json->editCenterProfileYN;
				$viewRoomSettingsYN = $json->viewRoomSettingsYN;
				$editRoomSettingsYN = $json->editRoomSettingsYN;
				$viewEntitlementsYN = $json->viewEntitlementsYN;
				$editEntitlementsYN = $json->editEntitlementsYN;
				$editEmployeeYN = $json->editEmployeeYN;
				$xeroYN = $json->xeroYN;
				$viewAwardsYN = $json->viewAwardsYN;
				$editAwardsYN = $json->editAwardsYN;
				$viewSuperfundsYN = $json->viewSuperfundsYN;
				$editSuperfundsYN = $json->editSuperfundsYN;
				$createMomYN = $json->createMomYN;
				$editPermissionYN = $json->editPermissionYN;
				$viewPermissionYN = $json->viewPermissionYN;
				$this->load->model('settingsModel');
				$this->settingsModel->insertPermission($empId,$isQrReaderYN,$viewRosterYN,$editRosterYN,$viewTimesheetYN,$editTimesheetYN,$viewPayrollYN,$editPayrollYN,$editLeaveTypeYN,$viewLeaveTypeYN,$createNoticeYN,$viewOrgChartYN,$editOrgChartYN,$viewCenterProfileYN,$editCenterProfileYN,$viewRoomSettingsYN,$editRoomSettingsYN,$viewEntitlementsYN,$editEntitlementsYN,$editEmployeeYN,$xeroYN,$viewAwardsYN,$editAwardsYN,$viewSuperfundsYN,$editSuperfundsYN,$createMomYN,$editPermissionYN,$viewPermissionYN);
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

