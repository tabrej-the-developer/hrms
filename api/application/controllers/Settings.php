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
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
			$title = $json->title; 
			$fname = $json->fname; 
			$mname = $json->mname; 
			$lname = $json->lname; 
			$status = $json->status; 
			$emails = $json->emails; 
			$dateOfBirth = $json->dateOfBirth; 
			$jobTitle = $json->jobTitle; 
			$gender = $json->gender; 
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
			$ordinaryEarningRateId = $json->ordinaryEarningRateId; 
			$payrollCalendarId = //$json->payrollCalendarId; 
			$employeeId = $json->employeeId; 
			$bankAccount = $json->bankAccount; 
			$superfunds = $json->superfund;  
			$employmentBasis = $json->employmentBasis; 
			$tfnExemptionType = $json->tfnExemptionType; 
			$taxFileNumber = $json->taxFileNumber; 
			$australiantResidentForTaxPurposeYN = $json->australiantResidentForTaxPurposeYN; 
			$residencyStatue = $json->residencyStatue; 
			$taxFreeThresholdClaimedYN = $json->taxFreeThresholdClaimedYN; 
			$taxOffsetEstimatedAmount = $json->taxOffsetEstimatedAmount; 
			$hasHELPDebtYN = $json->hasHELPDebtYN; 
			$hasSFSSDebtYN = $json->hasSFSSDebtYN; 
			$hasTradeSupportLoanDebtYN = $json->hasTradeSupportLoanDebtYN; 
			$upwardVariationTaxWitholdingAmount = $json->upwardVariationTaxWitholdingAmount; 
			$eligibleToReceiveLeaveLoadingYN = $json->eligibleToReceiveLeaveLoadingYN; 
			$approvedWitholdingVariationPercentage = $json->approvedWitholdingVariationPercentage; 
			$center = $json->center;
			$area = $json->area;
			$role = $json->role;
			$manager = $json->manager;
			$level = $json->level;
			$bonusRates = $json->bonusRates;
			$medicareNo = $json->medicareNo;
			$medicareRefNo = $json->medicareRefNo;
			$healthInsuranceFund = $json->healthInsuranceFund;
			$healthInsuranceNo = $json->healthInsuranceNo;
			$ambulanceSubscriptionNo = $json->ambulanceSubscriptionNo;
			$medicalConditions = $json->medicalConditions;
			$medicalAllergies = $json->medicalAllergies;
			$medication = $json->medication;
			$dietaryPreferences = $json->dietaryPreferences;
			$anaphylaxis = $json->anaphylaxis;
			$asthma = $json->asthma;
			$maternityStartDate = $json->maternityStartDate;
			$maternityEndDate = $json->maternityEndDate;
			$employee_no = $json->employee_no;
			$currently_employed = $json->currently_employed;
			$commencement_date = $json->commencement_date;
			$resume_supplied = $json->resume_supplied;
			$resume_doc = $json->resume_doc;
			$employement_type = $json->employement_type;
			$current_contract_notes = $json->current_contract_notes;
			$current_contract_signature = $json->current_contract_signature;
			$current_contract_commencement = $json->current_contract_commencement;
			$current_contract_end_date = $json->current_contract_end_date;
			$current_contract_paid_start_date = $json->current_contract_paid_start_date;
			$probation_end_date = $json->probation_end_date;
			$industry_years_exp_as_nov19 = $json->industry_years_exp_as_nov19;
			$highest_qual_held = $json->highest_qual_held;
			$highest_qual_type = $json->highest_qual_type;
			$qual_towards_desc = $json->qual_towards_desc;
			$qual_towards_percent_comp = $json->qual_towards_percent_comp;
			$workcover = $json->workcover;
			$piawe = $json->piawe;
			$annual_leave_in_contract = $json->annual_leave_in_contract;
			$visa_type = $json->visa_type;
			$visa_grant_date = $json->visa_grant_date;
			$visa_end_date = $json->visa_end_date;
			$visa_conditions = $json->visa_conditions;
			$first_aid_expiry = $json->first_aid_expiry;
			$cpr_expiry = $json->cpr_expiry;
			$prohibition_notice_declaration = $json->prohibition_notice_declaration;
			$vit_card_no = $json->vit_card_no;
			$vit_expiry = $json->vit_expiry;
			$wwcc_card_no = $json->wwcc_card_no;
			$wwcc_expiry = $json->wwcc_expiry;
			$food_handling_safety = $json->food_handling_safety;
			$last_police_check = $json->last_police_check;
			$child_protection_check = $json->child_protection_check;
			$nominated_supervisor = $json->nominated_supervisor;
			$employee = $json->Employees;
			$this->postToXero($employees);
			$this->load->model('settingsModel');
			$bankAccount = json_decode($bankAccount);
			foreach($bankAccount as $account){
				$statementText = $account->statementText;
				$accountName = $account->accountName;
				$bsb = $account->bsb;
				$accountNumber = $account->accountNumber;
				$remainderYN = $account->remainderYN;
				$amount = $account->amount;
				$this->load->addEmployeeToEmployeeBankAccount($statementText,$accountName,$bsb,$accountNumber,$remainderYN,$amount);
			} 
			$superfunds = json_decode($superfunds);
			foreach($superfunds as $superfund){
				$SuperMembershipID = $superfund->SuperMembershipID;
				$SuperFundID = $superfund->SuperFundID;
				$EmployeeNumber = $superfund->EmployeeNumber;
				$this->load->addEmployeeToEmployeeSuperfund($SuperMembershipID,$SuperFundID,$EmployeeNumber);
			} 
		$this->load->addEmployeeToEmployee($xeroEmployeeId,$title,$fname,$mname,$lname,$status,$emails,$dateOfBirth,$jobTitle,$gender,$homeAddLine1,$homeAddLine2,$homeAddCity,$homeAddRegion,$homeAddPostal,$homeAddCountry,$phone,$mobile,$startDate,$terminationDate,$ordinaryEarningRateId,$payrollCalendarId);
		$this->load->addEmployeeToEmployeeTaxDeclaration($employeeId,$employmentBasis,$tfnExemptionType,$taxFileNumber,$australiantResidentForTaxPurposeYN,$residencyStatue,$taxFreeThresholdClaimedYN,$taxOffsetEstimatedAmount,$hasHELPDebtYN,$hasSFSSDebtYN,$hasTradeSupportLoanDebtYN,$upwardVariationTaxWitholdingAmount,$eligibleToReceiveLeaveLoadingYN,$approvedWitholdingVariationPercentage);
		$this->insertMedicalInfo($employeeNo,$medicareNo,$medicareRefNo,$healthInsuranceFund,$healthInsuranceNo,$ambulanceSubscriptionNo,$medicalConditions,$medicalAllergies,$medication,$dietaryPreferences,$anaphylaxis,$asthma,$maternityStartDate,$maternityEndDate);
		$this->insertIntoHRrecord($employeeNo,$currentlyEmployed,$commencementDate,$contractPosition,$resumeSupplied,$resumeDoc,$employmentType,$currentContractNotes,$currentContractSignatureDate,$currentContractCommencementDate,$currentContractEndDate,$currentContractPaidStartDate,$probationEndDate,$industryYearsExpAsNov19,$prohibitionNoticeDeclaration,$VITcardNo,$VITexpiry,$WWCCcardNo,$WWCCexpiry,$foodHandlingSafety,$lastPoliceCheck,$childProtectionCheck,$nominatedSupervisor,$workcover,$PIAWE,$annualLeaveInContract,$otherQualifications,$otherQualDesc,$highestQualHeld,$highestQualType,$qualTowardsDesc,$qualTowardsPercentcomp,$contractAwardId,$paidAwardId,$visaType,$visaGrantDate,$visaEndDate,$visaConditions);
		$this->load->addEmployeeToUsers($emails,$center,$area,$role,$manager,$level,$bonusRates);
			$data = 'SUCCESS';
					}

			http_response_code(200);
			echo json_encode($data);
				}
		else{
			http_response_code(401);
		}
	}

 	function postToXero($data,$access_token,$tenant_id){
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

