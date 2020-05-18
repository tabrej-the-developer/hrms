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
			//$newR = $this->UtilModel->getCenterById($json->centerid);
			if($json!= null && $res != null && $res->userid == $json->userid){
				$addStreet = $json->addStreet;
				$addCity = $json->addCity;
				$addState = $json->addState;
				$addZip = $json->addZip;
				$name = $json->name;
				$logo = $json->logo;
				$centerid = $json->centerid;
				$rooms = $json->rooms;
				if($logo == null){
					$logo = "http://vizytor.todquest.com/images/logo/amiga.png";
				}else{
				$destFile = "assets/images/".$_FILES['file']['name'];
				$logo = basename($_FILES['file']['name']);
				move_uploaded_file( $_FILES['file']['tmp_name'], $destFile );
				}
				//$this->load->model('UtilModel');
				$this->load->model('settingsModel');
				foreach ($rooms as $r) {
					
					if($r->name != null ){
						$name = $r->name;
						$careAgeFrom = $r->careAgeFrom;
						$careAgeTo = $r->careAgeTo;
						$capacity = $r->capacity;
						$studentRatio = $r->studentRatio;
						$room = $this->settingsModel->addRoom($centerid,$name,$careAgeFrom,$careAgeTo,$capacity,$studentRatio);
					}
				}
				$center = $this->settingsModel->addCenter($centerid,$logo,$name,$addStreet,$addCity,$addState,$addZip);
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

}
