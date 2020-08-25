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
			if($json!= null && $res != null && $res->userid == $json->userid){
					$addStreet = $json->addStreet;
					$addCity = $json->addCity;
					$addState = $json->addState;
					$addZip = $json->addZip;
					$name = $json->name;
					$centre_phone_number = $json->centre_phone_number;
					$centre_mobile_number = $json->centre_mobile_number;
					$Centre_email = $json->Centre_email;
					$centre_abn = $json->centre_abn;
					$centre_acn = $json->centre_acn;
					$centre_se_no = $json->centre_se_no;
					$centre_date_opened = $json->centre_date_opened;
					$centre_capacity = $json->centre_capacity;
					$approval_doc = $json->centre_approval_doc;
					$centre_approval_doc = uniqid().'-CenterApprovalDoc-'.uniqid().'pdf';
					file_put_contents(json_decode($approval_doc),$centre_approval_doc);
					$ccs_doc = $json->centre_ccs_doc;
					$centre_ccs_doc = uniqid().'-CCS_Doc-'.uniqid().'pdf';
					file_put_contents(json_decode($ccs_doc),$centre_ccs_doc);
					$manager_name = $json->manager_name;
					$centre_admin_name = $json->centre_admin_name;
					$centre_nominated_supervisor = $json->centre_nominated_supervisor;
					$rooms = $json->rooms;
					$suppliers = $json->suppliers;
					$compliances = $json->compliances;
				//$this->load->model('UtilModel');
				$this->load->model('settingsModel');
				$centerid = $this->settingsModel->addCenter($addStreet,$addCity,$addState,$addZip,$name,$centre_phone_number,$centre_mobile_number,$Centre_email);
						$this->settingsModel->addCenterRecord($centerid,$centre_abn,$centre_acn,$centre_se_no,$centre_date_opened,$centre_capacity,$approval_doc,$centre_approval_doc,$ccs_doc,$centre_ccs_doc,$manager_name,$centre_admin_name,$centre_nominated_supervisor);
				foreach ($rooms as $r) {
					if($r->name != null ){
						$room_name = $r->room_name;
						$capacity_ = $r->capacity_;
						$minimum_age = $r->minimum_age;
						$maximum_age = $r->maximum_age;
			$room = $this->settingsModel->addRoom($centerid,
																						$room_name,
																						$capacity_,
																						$minimum_age,
																						$maximum_age);
					}
				}
				foreach($compliances as $c){
					if($c->compliance_name != null){
						$compliance_name = $c->compliance_name;
						$compliance_desc = $c->compliance_desc;
						$compliance_contact_details = $c->compliance_contact_details;
						$compliance_contact_name = $c->compliance_contact_name;
						$compliance_contact_number = $c->compliance_contact_number;
						$compliance_contact_email = $c->compliance_contact_email;
						$compliance_expiry_renewal_date = $c->compliance_expiry_renewal_date;
						$compliance_document = $c->compliance_document;
						$supplierInfo = $this->settingsModel->addCompliance(
																													$centerid,
																													$compliance_name,
																													$compliance_desc,
																													$compliance_contact_details,
																													$compliance_contact_name,
																													$compliance_contact_number,
																													$compliance_contact_email,
																													$compliance_expiry_renewal_date,
																													$compliance_document);
					}
				}
				foreach ($suppliers as $supplier) {
					if($supplier->name != null ){
							$supplier_desc = $supplier->supplier_desc;
							$supplier_account_no = $supplier->supplier_account_no;
							$supplier_contact_name = $supplier->supplier_contact_name;
							$supplier_contact_number = $supplier->supplier_contact_number;
							$supplier_contact_email = $supplier->supplier_contact_email;
			$room = $this->settingsModel->addSupplier($centerid,
																								$supplier_desc,
																								$supplier_account_no,
																								$supplier_contact_name,
																								$supplier_contact_number,
																								$supplier_contact_email);
					}
				}
				$center = 
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
$this->settingsModel->addToEmployeeCourses( $xeroEmployeeId,$course_nme,$course_desc,$date_obt,$exp_date);
					}
// Users	
					$name = $fname." ".$mname." ".$lname;
$this->settingsModel->addToUsers($employee_no,$emails,$name,$title,$center,$manager,$userid,$role,$level,$alias);
// Employee bank account	
$this->settingsModel->addToEmployeeBankAccount( $xeroEmployeeId,$accountName,$bsb,$accountNumber,$remainderYN,$amount);
// Employee medical info	
$this->settingsModel->addToEmployeeMedicalInfo($xeroEmployeeId,$medicareNo, $medicareRefNo,$healthInsuranceFund,$healthInsuranceNo, $ambulanceSubscriptionNo);
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
$this->settingsModel->addToEmployeeMedicals( $xeroEmployeeId,$medC,$medA,$medic,$dietary);
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
$this->settingsModel->addToEmployeeRecord($employee_no, $xeroEmployeeId, $uniqueId,$resume_doc, 
	$employement_type, $qual_towards_desc, $highest_qual_held, $qual_towards_percent_comp, $visa_type, $visa_grant_date, $visa_end_date, $visa_conditions, $contract_doc, $highest_qual_date_obtained, $highest_qual_cert, $visa_holder);
// Employee superfunds	

$this->settingsModel->addToEmployeeSuperfunds( $xeroEmployeeId, $superFundId,
$superMembershipId);
// Employee Tax Declaration

$this->settingsModel->addToEmployeeTaxDeclaration($xeroEmployeeId,$employmentBasis,$tfnExemptionType,$taxFileNumber,$australiantResidentForTaxPurposeYN,$residencyStatue,$taxFreeThresholdClaimedYN,$taxOffsetEstimatedAmount,$hasHELPDebtYN,$hasSFSSDebtYN,$hasTradeSupportLoanDebtYN_,$upwardVariationTaxWitholdingAmount,$eligibleToReceiveLeaveLoadingYN,$approvedWitholdingVariationPercentage);
// Employee Table

$this->settingsModel->addToEmployeeTable($employee_no, $xeroEmployeeId,$title,$fname,$mname,$lname,$emails,$dateOfBirth,$jobTitle,$gender,$homeAddLine1,$homeAddLine2,$homeAddCity,$homeAddRegion,$homeAddPostal,$homeAddCountry,$phone,$mobile,$startDate,$terminationDate,$ordinaryEarningRateId,$payroll_calendar,$userid,$classification,$holiday_group,$employee_group,$emergency_contact,$relationship,$emergency_contact_email);

			$data['status'] = 'SUCCESS';
			http_response_code(200);
			echo json_encode($data);
				}
		else{
			http_response_code(401);
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

