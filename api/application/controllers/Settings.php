<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(E_ALL); ini_set('display_errors', 1);
class Settings extends MY_Controller
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


	public function addArea()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$centerid = $json->centerid;
				$areaName = $json->areaName;
				$isRoomYN = $json->isRoomYN;
				$this->load->model('settingsModel');
				if ($areaName != null && $areaName != "") {
					$area = $this->settingsModel->getAreaByName($centerid, $areaName);
					if ($area == null) {
						$area = $this->settingsModel->createArea($centerid, $areaName, $isRoomYN);
						$data['Status'] = "SUCCESS";
					} else {
						$data['Status'] = "ERROR";
						$data['Message'] = "Area with the same name already exists";
					}
					http_response_code(200);
					echo json_encode($data);
				}
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function updateArea()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$areaid = $json->areaid;
				$areaName = $json->areaName;
				$isRoomYN = $json->isRoomYN;
				$this->load->model('settingsModel');
				$area = $this->settingsModel->getAreaExists($areaName, $areaid);
				if ($area == null || (strtolower($areaName) == strtolower($area->areaName))) {
					$area = $this->settingsModel->updateArea($areaid, $areaName, $isRoomYN);
					$data['Status'] = "SUCCESS";
				} else {
					$data['Status'] = "ERROR";
					$data['Message'] = "Area with the same name already exists";
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



	public function addRole()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$areaid = $json->areaid;
				$roleName = $json->roleName;
				$this->load->model('settingsModel');
				$role = $this->settingsModel->getRoleByName($areaid, $roleName);
				if ($role == null) {
					$role = $this->settingsModel->addRole($areaid, $roleName);
					$data['Status'] = "SUCCESS";
				} else {
					$data['Status'] = "ERROR";
					$data['Message'] = "Role with the same name already exists";
				}
				http_response_code(200);
				echo json_encode($json);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function updateRole()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$roleid = $json->roleid;
				$roleName = $json->roleName;
				$this->load->model('settingsModel');
				$role = $this->settingsModel->getRoleExists($roleName, $roleid);
				if ($role == null) {
					$role = $this->settingsModel->updateRole($roleid, $roleName);
					$data['Status'] = "SUCCESS";
				} else {
					$data['Status'] = "ERROR";
					$data['Message'] = "Role with the same name already exists";
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



	public function addRoom()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {

				$centerid = $json->centerid;
				$name = $json->name;
				$careAgeFrom = $json->careAgeFrom;
				$careAgeTo = $json->careAgeTo;
				$capacity = $json->capacity;
				$studentRatio = $json->studentRatio;
				$this->load->model('settingsModel');
				$roomid = $this->settingsModel->addRoom($centerid, $name, $careAgeFrom, $careAgeTo, $capacity, $studentRatio);
				$this->settingsModel->createArea($centerid, $name, 'Y');
				$data['Status'] = "SUCCESS";

				http_response_code(200);
				echo json_encode($data);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function editRoom()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));

			if ($json != null && $res != null && $res->userid == $json->userid) {
				if ($json->response == 'edit') {
					$roomId = $json->roomId;
					$centerid = $json->centerid;
					$name = $json->name;
					$careAgeFrom = $json->careAgeFrom;
					$careAgeTo = $json->careAgeTo;
					$capacity = $json->capacity;
					$studentRatio = $json->studentRatio;
					$this->load->model('settingsModel');
					$roomid = $this->settingsModel->editRoom($centerid, $name, $careAgeFrom, $careAgeTo, $capacity, $studentRatio, $roomId);
					$data['Status'] = 'SUCCESS';
				}
				if ($json->response == 'delete') {
					$roomId = $json->roomId;
					$this->load->model('settingsModel');
					$roomid = $this->settingsModel->deleteRoom($roomId);
					$data['Status'] = 'DELETED _ SUCCESS';
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

	public function getStates($userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('settingsModel');
				$data['states'] = $this->settingsModel->getStates($userid);
				http_response_code(200);
				echo json_encode($data);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function getRooms($centerid, $userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
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
					array_push($data['rooms'], $var);
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

	public function getSuperfunds($userid, $centerid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('settingsModel');
				$superfunds = $this->settingsModel->getSuperfunds($centerid);
				$data['superfunds'] = [];
				$checkSync = $this->settingsModel->syncedWithXero($centerid);
				$data['syncedYN'] = ($checkSync !== null) ? 'Y' : 'N';
				foreach ($superfunds as $superfund) {
					$var['id'] = $superfund->id;
					$var['abn'] = $superfund->abn;
					$var['usi'] = $superfund->usi;
					$var['type'] = $superfund->type;
					$var['name'] = $superfund->name;
					$var['bsb'] = $superfund->bsb;
					$var['superFundId'] = $superfund->superfundId;
					$var['accountNumber'] = $superfund->accountNumber;
					$var['accountName'] = $superfund->accountName;
					$var['eServiceAddress'] = $superfund->eServiceAddress;
					$var['employeeNo'] = $superfund->employeeNo;
					$var['created_at'] = $superfund->created_at;
					$var['created_by'] = $superfund->created_by;
					array_push($data['superfunds'], $var);
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


	public function getAwardSettings($userid, $centerid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('settingsModel');
				$awards = $this->settingsModel->getAwards($centerid);
				$data['awards'] = [];
				$checkSync = $this->settingsModel->syncedWithXero($centerid);
				$data['syncedYN'] = ($checkSync !== null) ? 'Y' : 'N';
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
					array_push($data['awards'], $var);
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


	public function changePassword()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$userid = $json->userid;
				$password = $json->password;
				$passcode = $json->passcode;
				$this->load->model('settingsModel');
				$user = $this->authModel->getUserDetails($userid);
				if ($user != null) {
					$user = $this->settingsModel->changePassword($userid, md5($password), md5($passcode));
        // Email & Notification
        $permissions = $this->getNotificationPermissions($userid,14);
        foreach($permissions as $permission){
          if($permission->appYN == 'Y'){
			  // $this->firebase->sendMessage($title,$body,$payload,$employee->userid);
		  }
          if($permission->emailYN == 'Y'){
            // $this->Emails($permission->email,$template,$subject,$arr);
          }
        }
        // Email & Notification
					$data['Status'] = "SUCCESS";
				} else {
					$data['Status'] = "ERROR";
					$data['Message'] = "Error password change";
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


	public function addCenter()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
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
				if ($center_approval_doc != "") {
					$destination = "application/assets/files/";
					$file_name = "center_approval_doc_" . uniqid() . ".pdf";
					file_put_contents("$destination" . $file_name, base64_decode($center_approval_doc));

					$center_approval_doc = $file_name;
					// move_uploaded_file("/".$file_name, $destination);
				} else {
					$center_approval_doc = "";
				}
				$center_ccs_doc = $json->center_ccs_doc;
				if ($center_ccs_doc != "") {
					$destination = "application/assets/files/";
					$file_name = "center_ccs_doc_" . uniqid() . ".pdf";
					file_put_contents("$destination" . $file_name, base64_decode($center_ccs_doc));
					$center_ccs_doc = $file_name;
					// move_uploaded_file("/".$file_name, $destination);
				} else {
					$center_ccs_doc = "";
				}
				$center_admin_name = $json->center_admin_name;
				$centre_nominated_supervisor = $json->centre_nominated_supervisor;
				$room_name = $json->room_name;
				$capacity_ = $json->capacity_;
				$minimum_age = $json->minimum_age;
				$maximum_age = $json->maximum_age;
				if ($center_name != null && $center_name != "") {
					$centers = $this->settingsModel->getUserCenters($json->userid);
					if($centers != null){
						$superadmin = $this->settingsModel->getSuperadmin($centers[0]->centerid);
						$uniqid = $superadmin->superadmin;
					}
					else{
						$uniqid = uniqid();
					}
					$centerid = $this->settingsModel->addCenter($center_street, $center_city, $center_state, $center_zip, $center_name, $center_phone, $center_mobile, $center_email, $json->userid, $uniqid);
					$centerRecordUniqueId = uniqid();
					$this->settingsModel->addCenterRecord($centerid, $centerRecordUniqueId, $center_abn, $center_acn, $center_se_no, $center_date_opened, $center_capacity, $center_approval_doc, $center_ccs_doc, $center_admin_name, $centre_nominated_supervisor);
					$this->settingsModel->addToUserCenters($json->userid,$centerid);
					for ($i = 0; $i < count($room_name); $i++) {
						$roo = $room_name[$i];
						$cap = $capacity_[$i];
						$minim = $minimum_age[$i];
						$maxim = $maximum_age[$i];
						$this->settingsModel->addRoom($centerid, $roo, $cap, $minim, $maxim);
					}
				}
				$data['Status'] = "SUCCESS";
				http_response_code(200);
				echo json_encode($data);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	//Add Awards
	public function addXeroAwards(){

		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);

		if($this->session->has_userdata('LoginId')){
			$this->load->helper('form');
			$json = json_decode(file_get_contents('php://input'));
			//footprint start
			if($this->session->has_userdata('current_url')){
				footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
				$this->session->set_userdata('current_url',currentUrl());
			}
			// footprint end
			if($json != null){
				//here comes the json data
				// $data['earningRateId'] = $this->input->post('earningRateId');
				$data['Name'] = $json->Name;
				$data['EarningsType'] = $json->EarningsType;
				$data['RateType'] = $json->RateType;
				$data['IsExemptFromTax'] = $json->IsExemptFromTax;
				$data['IsExemptFromSuper'] = $json->IsExemptFromSuper;
				$data['IsReportableAsW1'] = $json->IsReportableAsW1;
				$data['CurrentRecord'] = $json->CurrentRecord;
				$data['multiplier_amount'] = $json->multiplier_amount;
				$data['created_by'] = $json->created_by;
				$data['created_at'] = date('d-m-Y H:i:s');
				$data['centerid'] = $json->centerid;
				//access_token & tenant_id needed
				$this->postAwardsToXero($access_token,$tenant_id,$data);
				//In response we will get EarningsRateID, take that id and insert into the payrollshifts


			}else{
				$response = ['status'=>true,'message'=>'JSON data needs to be passed','data'=>[]];
			}
		}
	}

	function postAwardsToXero($access_token, $tenant_id, $data)
	{
		$url = "https://api.xero.com/payroll.xro/1.0/PayItems";
		$ch =  curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
			'Content-Type:application/json',
			'Authorization:Bearer ' . $access_token,
			'Xero-tenant-id:' . $tenant_id
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		return $server_output;
	}
	//Add Awards 












	public function editCenter($centerid, $userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('settingsModel');
				$data['centerDetails'] = $this->settingsModel->centerDetails($centerid);
				$data['centerRecord'] = $this->settingsModel->centerRecord($centerid);
				$data['rooms'] = $this->settingsModel->getRooms($centerid);
				http_response_code(200);
				echo json_encode($data);
				// var_dump($data);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function updateCenter()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('utilModel');
			$this->load->model('settingsModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			//$newR = $this->UtilModel->getCenterById($json->centerid);
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$center_name = $json->center_name;
				$centerid = $json->centerid;
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
				// $center_approval_doc = $json->center_approval_doc;
				// $center_ccs_doc = $json->center_ccs_doc;
				$manager_name = $json->manager_name;
				$center_admin_name = $json->center_admin_name;
				$centre_nominated_supervisor = $json->centre_nominated_supervisor;
				// if($logo == null){
				// 	$logo = "http://vizytor.todquest.com/images/logo/amiga.png";
				// }else{
				// $destFile = "assets/images/".$_FILES['file']['name'];
				// move_uploaded_file( $_FILES['file']['tmp_name'], $destFile );
				// }
				$center = $this->utilModel->getCenterById($centerid);
				if ($center != null) {

					$center = $this->settingsModel->updateCenterProfile($centerid, $center_name, $center_street, $center_city, $center_state, $center_zip, $center_phone, $center_mobile, $center_email);

					$centerrecord = $this->settingsModel->updateCenterRecord($centerid, $center_abn, $center_acn, $center_se_no, $center_date_opened, $center_capacity, $manager_name, $center_admin_name, $centre_nominated_supervisor);
					$data['Status'] = "SUCCESS";
				} else {
					$data['Status'] = "ERROR";
					$data['Message'] = "Center doesnot exist";
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

	public function getAreas($centerid, $userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('settingsModel');
				$allAreas = $this->settingsModel->getAllAreas($centerid);
				$data['areas'] = [];
				foreach ($allAreas as $area) {
					$var['areaId'] = $area->areaid;
					$var['areaName'] = $area->areaName;
					$var['roles'] = $this->settingsModel->getRolesFromArea($area->areaid);
					array_push($data['areas'], $var);
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


	public function getOrgChart($centerid, $userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('settingsModel');
				$allAreas = $this->settingsModel->getAllAreas($centerid);
				$data['orgchart'] = [];
				foreach ($allAreas as $area) {
					$var['areaId'] = $area->areaid;
					$var['centerid'] = $area->centerid;
					$var['areaName'] = $area->areaName;
					$var['isARoomYN'] = $area->isARoomYN;
					$var['roles'] = $this->settingsModel->getRolesFromArea($area->areaid);
					array_push($data['orgchart'], $var);
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

	public function updateKidsoftKey(){
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$json = json_decode(file_get_contents('php://input'));
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $json->userid) {
				$key = isset($json->key) ? $json->key : null;
				$centerid = isset($json->centerid) ? $json->centerid : null;
				$updateVal = isset($json->updateVal) ? $json->updateVal : null;
				$this->load->model('settingsModel');
				$this->settingsModel->updateKidsoft($key,$centerid,$updateVal);
				$data['Status'] = "SUCCESS";
				http_response_code(200);
				echo json_encode($data);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function getEmployeesForRoles($roleid, $userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('settingsModel');
				$this->load->model('rostersModel');
				$data['employees'] = $this->rostersModel->getAllEmployees($roleid);
				http_response_code(200);
				echo json_encode($data);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}


	public function deleteRoom($roomid, $userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('settingsModel');
				$this->settingsModel->deleteRoom($roomid);
				$data['Status'] = 'SUCCESS';
			}
			http_response_code(200);
			echo json_encode($data);
		} else {
			http_response_code(401);
		}
	}

	public function deleteArea($areaid, $userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('settingsModel');
				$this->settingsModel->deleteArea($areaid);
				$data['Status'] = 'SUCCESS';
			}
			http_response_code(200);
			echo json_encode($data);
		} else {
			http_response_code(401);
		}
	}

	public function deleteRole($roleid, $userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('settingsModel');
				$this->settingsModel->deleteRole($roleid);
				$data['Status'] = 'SUCCESS';
			}
			http_response_code(200);
			echo json_encode($data);
		} else {
			http_response_code(401);
		}
	}

	public function changeEmployeeRole($userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $userid) {
				if ($json->details != null) {
					$details = $json->details;
					$this->load->model('settingsModel');
					foreach ($details as $employee) {
						$this->settingsModel->updateEmployeeRole($employee->employeeId, $employee->roleId);
        // Email & Notification
        $permissions = $this->getNotificationPermissions($employee->employeeId,17);
        foreach($permissions as $permission){
          if($permission->appYN == 'Y'){
			//   $this->utilModel->insertNotification($employee->employeeId, $intent, $title, $body, json_encode($payload));
			  // $this->firebase->sendMessage($title,$body,$payload,$empId);
		  }
          if($permission->emailYN == 'Y'){
            // $this->Emails($permission->email,$template,$subject,$arr);
          }
        }
        // Email & Notification
					}
					$data['Status'] = "SUCCESS";
					$data['Message'] = "Role Updated";
				} else {
					$data['Status'] = "ERROR";
					$data['Message'] = "Role Not Updated";
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

	public function changeRolePriority()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				if ($json->order != null) {
					$order = $json->order;
					$this->load->model('settingsModel');
					foreach ($order as $o) {
						$this->settingsModel->updateRolePriority($o->roleid, $o->priority);
					}
					$data['Status'] = "SUCCESS";
					$data['Message'] = "Priority Updated";
				} else {
					$data['Status'] = "ERROR";
					$data['Message'] = "Priority Not Updated";
				}
				http_response_code(200);
				echo json_encode($order);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function addMultipleEmployees($userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $userid) {
				$array = $json->details;
				for ($i = 1; $i < count($array); $i++) {
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

					$data['password'] = md5((explode(" ", $data['name']))[0] . "@123");
					// $this->settingsModel->addToEmployeeCourses( $xeroEmployeeId,$course_nme=null,$course_desc=null,$date_obt=null,$exp_date=null);
					// var_dump($data);
					$areaId = ($this->settingsModel->getAreaId($data['center'], $data['area']));
					if ($areaId == null) {
						$areaId = $this->settingsModel->addArea($data['center'], $data['area'])->areaid;
					} else {
						$areaId = $areaId->areaid;
					}
					$roleId = ($this->settingsModel->getRoledId($areaId, $data['role']));
					if ($roleId == null) {
						$roleId = ($this->settingsModel->addRole($areaId, $data['role']))->roleid;
					} else {
						$roleId = $roleId->roleid;
					}


					if (($data['employee_no'] != null && $data['employee_no'] != "") && ($data['emails'] != null && $data['emails'] != "") && ($data['center'] != null && $data['center'] != "") && ($data['area'] != null && $data['area'] != "") && ($data['role'] != null && $data['role'] != "")) {
						$this->settingsModel->addToUsersME($data['employee_no'], $data['password'], $data['emails'], $data['name'], $data['center'], $userid, intval($roleId), $data['level'], $data['alias']);
						$config = array(
							'protocol'  => 'smtp',
							'smtp_host' => 'ssl://smtp.zoho.com',
							'smtp_port' => 465,
							'smtp_user' => 'demo@todquest.com',
							'smtp_pass' => 'K!ddz1ng',
							'mailtype'  => 'html',
							'charset'   => 'utf-8'
						);
						$to = $emails;
						$subject = 'Welcome to HRMS101';
						$template = 'onboardingMailView';
						$arr['name'] = $data['name'];
						$arr['empCode'] = $data['employee_no'];
						$arr['Password'] = $data['password'];
						if (!is_array($to)) {
							$this->load->library('email', $config); // Load email template
							$this->email->set_newline("\r\n");
							$this->email->from('demo@todquest.com', 'Todquest');
							$this->email->to($to);
							$this->email->subject($subject);
							$mess = $this->load->view($template, $arr, true);
							$this->email->message($mess);
							$this->email->send();
						}
						//var_dump($this->settingsModel->getPermissionForEmployee($data['employee_no']));
						if ($this->settingsModel->getPermissionForEmployee($data['employee_no']) == null) {
							$this->settingsModel->addPermissions($data['employee_no'], $isQrReaderYN = 'N', $viewRosterYN = 'Y', $editRosterYN = 'N', $viewTimesheetYN = 'Y', $editTimesheetYN = 'N', $viewPayrollYN = 'Y', $editPayrollYN = 'N', $editLeaveTypeYN = 'N', $viewLeaveTypeYN = 'Y', $createNoticeYN = 'Y', $viewOrgChartYN = 'Y', $editOrgChartYN = 'N', $viewCenterProfileYN = 'Y', $editCenterProfileYN = 'Y', $viewRoomSettingsYN = 'Y', $editRoomSettingsYN = 'N', $viewEntitlementsYN = 'Y', $editEntitlementsYN = 'N', $editEmployeeYN = 'N', $xeroYN = 'N', $viewAwardsYN = 'Y', $editAwardsYN = 'N', $viewSuperfundsYN = 'Y', $editSuperfundsYN = 'N', $createMomYN = 'Y', $editPermissionYN = 'Y', $viewPermissionYN = 'Y',$kidsoftYN = 'N');
						}

						$ouput['Status'] = "Records Added Successfully";
					} else {
						$ouput['Status'] = "Some of the mandatory fields seems to be missing";
					}
				}
			} else {
				$ouput['Status'] = "ERROR";
			}
			http_response_code(200);
			echo json_encode($ouput);
		} else {
			http_response_code(401);
		}
	}

	public function editEmployeeEntitlements()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$empid = $json->empid;
				$level = $json->level;
				$this->settingsModel->editEmployeeEntitlement($level, $empid);
        // Email & Notification
        $permissions = $this->getNotificationPermissions($empid,16);
        foreach($permissions as $permission){
          if($permission->appYN == 'Y'){
			//   $this->utilModel->insertNotification($empid, $intent, $title, $body, json_encode($payload));
			  // $this->firebase->sendMessage($title,$body,$payload,$empId);
		  }
          if($permission->emailYN == 'Y'){
            // $this->Emails($permission->email,$template,$subject,$arr);
          }
        }
        // Email & Notification
				$data['Status'] = 'SUCCESS';
				$data['Message'] = 'Entitlement updated';
			} else {
				$data['Status'] = 'FAILED';
				$data['Message'] = 'Invalid data';
			}
			echo json_encode($data);
			http_response_code(200);
		} else {
			http_response_code(401);
		}
	}


	//XERO THINGS ADDED FOR THE SAKE OF EMPLOYEE
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
	function getEmployees($access_token, $tenant_id, $employeeId = null)
	{
		if ($employeeId == null || $employeeId == "") {
			$url = "https://api.xero.com/payroll.xro/1.0/Employees";
		}
		if ($employeeId != null && $employeeId != "") {
			$url = "https://api.xero.com/payroll.xro/1.0/Employees/" . $employeeId;
		}
		// var_dump($url);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Accept:application/json',
			'Authorization:Bearer ' . $access_token,
			'Xero-tenant-id:' . $tenant_id
		));
		$server_output = curl_exec($ch);
		// var_dump($server_output);
		return $server_output;
	}
	public function postEmployeeToXero($access_token, $tenant_id, $data)
	{
		$url = "https://api.xero.com/payroll.xro/1.0/Employees/";
		$ch =  curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
			'Content-Type:application/json',
			'Authorization:Bearer ' . $access_token,
			'Xero-tenant-id:' . $tenant_id
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		// print_r($server_output);
		// die();
		// curl_close($ch);
		$xml = simplexml_load_string($server_output);
		$json = json_encode($xml);
		echo $json;
		// exit();
		// $json = json_encode(simplexml_load_string($server_output));
		// $array = json_decode($json,true);
		// return $array;

	}
	//XERO THINGS ADDED FOR THE SAKE OF EMPLOYEE
	public function createEmployeeProfile()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$this->load->model('xeroModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$employee_no = isset($json->employee_no) ? $json->employee_no : null;
				$employeeEnrolled = $this->settingsModel->getUserData($employee_no);
				if ($employee_no != null && $employeeEnrolled == null) {
					//BLOCK CODE
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
					$superfundEmployeeNumber = $json->superfundEmployeeNumber;
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
					$medicareNo = $json->medicareNo;
					$medicareRefNo = $json->medicareRefNo;
					$healthInsuranceFund = $json->healthInsuranceFund;
					$healthInsuranceNo = $json->healthInsuranceNo;
					$ambulanceSubscriptionNo = $json->ambulanceSubscriptionNo;
					$xeroEmployeeId = $json->xeroEmployeeId;
					$profileImage = $json->profileImage;
					$profileImageName = $employee_no . '.png';
					$target_dir = 'application/assets/profileImages/';
					$fileNameLoc = $target_dir . $profileImageName;
					$totalHours = $json->totalHours;
					$daysArr = $json->daysArr;
					$iopb = $json->iobp;
					$rateperunit = $json->RatePerUnit;

					// var_dump((base64_decode($profileImage)));
					if ($profileImage != null && $profileImage != "") {
						file_put_contents($target_dir . $profileImageName, (base64_decode($profileImage)));
					}
					// Employee Courses	
					if (isset($course_name)) {
						$course_name = $json->course_name;
						$course_description = $json->course_description;
						$date_obtained = $json->date_obtained;
						$expiry_date = $json->expiry_date;
						$certificate = $json->certificate;
						for ($i = 0; $i < count($course_name); $i++) {
							$course_nme = $course_name[$i];
							$course_desc = $course_description[$i];
							$date_obt = $date_obtained[$i];
							$exp_date = $expiry_date[$i];
							// $cert = $certificate[$i];
							// get employee Id
							if ($employee_no != null && $employee_no != "") {
								if ($course_nme != "" && $course_nme != null) {
									$this->settingsModel->addToEmployeeCourses($xeroEmployeeId, $course_nme, $course_desc, $date_obt, $exp_date);
								}
							}
						}
					}
					// Users	
					$name = $fname . " " . $mname . " " . $lname;
					$password = strtolower($fname) . "@123";
					if ($employee_no != null && $employee_no != "") {
						if ($emails != "" && $emails != null) {
							$this->settingsModel->addToUsers($employee_no, md5($password), $emails, $name, $center, $userid, $role, $level, $alias, $profileImageName, $iopb);
							// Add user to usercenters
							if (strpos($center, '|') == null || strpos($center, '|') == "") {
								$this->settingsModel->addToUserCenters($employee_no, $center);
							}else{
								$arrayElements = explode('|', $center);
								foreach ($arrayElements as $ce) {
									if ($ce != "" && $ce != null) {
										$this->settingsModel->addToUserCenters($employee_no, $ce);
									}
								}
							}

							$config = array(
								'protocol'  => 'smtp',
								'smtp_host' => 'ssl://smtp.zoho.com',
								'smtp_port' => 465,
								'smtp_user' => 'demo@todquest.com',
								'smtp_pass' => 'K!ddz1ng',
								'mailtype'  => 'html',
								'charset'   => 'utf-8'
							);
							$to = $emails;
							$subject = 'Welcome to HRMS101';
							$template = 'onboardingMailView';
							$arr['name'] = $fname;
							$arr['empCode'] = $employee_no;
							$arr['Password'] = $password;
							if (!is_array($to)) {
								$this->load->library('email', $config); // Load email template
								$this->email->set_newline("\r\n");
								$this->email->from('demo@todquest.com', 'Todquest');
								$this->email->to($to);
								$this->email->subject($subject);
								$mess = $this->load->view($template, $arr, true);
								$this->email->message($mess);
								$this->email->send();
							}
						}
					}
					// Employee bank account	
					if ($employee_no != null && $employee_no != "") {
						if ($accountName != "" && $accountName != null) {
							$this->settingsModel->addToEmployeeBankAccount($xeroEmployeeId, addslashes($accountName), $bsb, $accountNumber, $remainderYN, $amount);
						}
					}
					// Employee medical info	
					if ($employee_no != null && $employee_no != "") {
						if ($medicareNo != "" && $medicareNo != null) {
							$this->settingsModel->addToEmployeeMedicalInfo($xeroEmployeeId, $medicareNo, $medicareRefNo, $healthInsuranceFund, $healthInsuranceNo, $ambulanceSubscriptionNo);
						}
					}
					// Employee medicals	
					if (isset($json->medicalConditions) && $json->medicalConditions != null && $json->medicalConditions != "") {
						$medicalConditions = $json->medicalConditions;
						$medicalAllergies = $json->medicalAllergies;
						$medication = $json->medication;
						$dietaryPreferences = $json->dietaryPreferences;
						for ($i = 0; $i < count($medicalConditions); $i++) {
							$medC = $medicalConditions[$i];
							$medA = $medicalAllergies[$i];
							$medic = $medication[$i];
							$dietary = $dietaryPreferences[$i];
							if ($employee_no != null && $employee_no != "") {
								if ($medC != "" && $medC != null) {
									$this->settingsModel->addToEmployeeMedicals($xeroEmployeeId, $medC, $medA, $medic, $dietary);
								}
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
					if (($employee_no != null && $employee_no != "")) {
						$this->settingsModel->addToEmployeeRecord(
							$employee_no,
							$xeroEmployeeId,
							$uniqueId,
							$resume_doc,
							$employement_type,
							$qual_towards_desc,
							$highest_qual_held,
							$qual_towards_percent_comp,
							$visa_type,
							$visa_grant_date,
							$visa_end_date,
							$visa_conditions,
							$contract_doc,
							$highest_qual_date_obtained,
							$highest_qual_cert,
							$visa_holder
						);
						// Employee superfunds	
						if ($employee_no != null && $employee_no != "") {
							if ($superFundId != "" && $superFundId != null) {
								// $this->settingsModel->addToEmployeeSuperfunds(
								// 	$employee_no,
								// 	$superFundId,
								// 	$superMembershipId,
								// 	$superfundEmployeeNumber
								// );
							}
						}
						// Employee Tax Declaration
						if ($employee_no != null && $employee_no != "") {
							if ($employmentBasis != "" && $employmentBasis != null) {
								$this->settingsModel->addToEmployeeTaxDeclaration($xeroEmployeeId, $employmentBasis, $tfnExemptionType, $taxFileNumber, $australiantResidentForTaxPurposeYN, $residencyStatue, $taxFreeThresholdClaimedYN, $taxOffsetEstimatedAmount, $hasHELPDebtYN, $hasSFSSDebtYN, $hasTradeSupportLoanDebtYN_, $upwardVariationTaxWitholdingAmount, $eligibleToReceiveLeaveLoadingYN, $approvedWitholdingVariationPercentage);
							}
						}

						// Employee Table
						if ($employee_no != null && $employee_no != "") {
							$this->settingsModel->addToEmployeeTable($employee_no, $xeroEmployeeId, $title, $fname, $mname, $lname, $emails, $dateOfBirth, $gender, $homeAddLine1, $homeAddLine2, $homeAddCity, $homeAddRegion, $homeAddPostal, $homeAddCountry, $phone, $mobile, $startDate, $terminationDate, $ordinaryEarningRateId, $payroll_calendar, $userid, $classification, $emergency_contact, $relationship, $emergency_contact_email,$totalHours,$daysArr);
						}
						// Insert Awards(Ordinary & Overtime) to this employee
						//-// First of all get awards
						$awardsdetails = $this->settingsModel->getAwards($center);
						$earningRateId = "";
						foreach($awardsdetails as $ai=>$av){
							if($av->name == "Ordinary Hours"){
								$earningRateId .= $av->earningRateId."|";
								$this->settingsModel->editEmployeeAwards($av->earningRateId,$employee_no);
							}else if($av->name == "Overtime Hours (exempt from super)"){
								$earningRateId .= $av->earningRateId."|";
								$this->settingsModel->editEmployeeAwards($av->earningRateId,$employee_no);
							}
						}
						//-// First of all get awards
						$this->settingsModel->updateEmployeeAward($earningRateId,$employee_no);
						// Insert Awards(Ordinary & Overtime) to this employee
					// POST EMPLOYEE TO XERO WITH BASIC DETAILS
					//BLOCK CODE

					$centerid = $json->center;
					$xeroTokens = $this->xeroModel->getXeroToken($centerid);
					if ($xeroTokens != null) {
						$access_token = $xeroTokens->access_token;
						$tenant_id = $xeroTokens->tenant_id;
						$refresh_token = $xeroTokens->refresh_token;
						$val = $this->getPayItems($access_token, $tenant_id);
						$val = json_decode($val);
						if ($val->Status == 401) {
							$refresh = $this->refreshXeroToken($refresh_token);
							$refresh = json_decode($refresh);
							$access_token = $refresh->access_token;
							$expires_in = $refresh->expires_in;
							$refresh_token = $refresh->refresh_token;
							$this->xeroModel->insertNewToken($access_token, $refresh_token, $tenant_id, $expires_in, $centerid);
							$val = $this->getPayItems($access_token, $tenant_id);
							$val = json_decode($val);
						}
						if ($val->Status == "OK") {
							//BASIC INFORMATION
							//employees
							$employees = $this->getEmployees($access_token, $tenant_id, $empId=NULL);
							// print_r($employees);
							$employees = json_decode($employees)->Employees;
							$fer = json_encode($employees);
							$rfer = str_replace(array( '[', ']' ), '', $fer);

							$newEmployeeData = array(
								"FirstName"=>$json->fname,
								"LastName"=>$json->lname,
								"Email"=>$json->emails,
								"DateOfBirth"=>$json->dateOfBirth,
								"HomeAddress"=>array(
									"AddressLine1"=>$json->homeAddLine1,
									"City"=>$json->homeAddCity,
									"Region"=>$json->homeAddRegion,
									"PostalCode"=>$json->homeAddPostal,
									"Country"=>$json->homeAddCountry
								),
								"PayTemplate"=>array(
									"EarningsLines"=>array((object)[
										"EarningsRateID"=>$ordinaryEarningRateId,
										"CalculationType"=>'ENTEREARNINGSRATE',
										"NormalNumberOfUnits"=>1.0000,
										"RatePerUnit"=>$rateperunit
									])
								)															
							);

							$encodedne = json_encode($newEmployeeData);						
							if($rfer == ""){
								$fstring = '['.$encodedne.']';
								$fr = json_decode($fstring,true);
							}else{
								$fstring = '['.$rfer.','.$encodedne.']';
								$fr = json_decode($fstring,true);
							}
							$this->postEmployeeToXero($access_token,$tenant_id,$fr);
							// $data['Status'] = 'SUCCESS';
							// http_response_code(200);
							// echo json_encode($data);
							// $finalval = $this->postEmployeeToXero($access_token,$tenant_id,$fr);
							// echo json_decode($finalval);
							// echo gettype($finalval);
							// die();

						}
					}else{
						http_response_code(401);
					}
					} else {
						http_response_code(401);
					}
				} else {
					http_response_code(401);
				}
			} else {
				http_response_code(401);
			}
		}
	}
	
	// View Employee

	public function getEmployeeProfile($userid, $employeeId, $centerid=null)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('settingsModel');
				$data['users'] = $this->settingsModel->getUserData($employeeId);
				$data['userCenters'] = $this->settingsModel->getUserCenters($employeeId);
				$data['employee']	= $this->settingsModel->getEmployeeData($employeeId);
				$data['employeeBankAccount'] = $this->settingsModel->getEmployeeBankAccount($employeeId);
				$data['employeeDocuments'] = $this->settingsModel->getEmployeeDocuments($employeeId);
				$data['employeeCourses']	= $this->settingsModel->getEmployeeCourses($employeeId);
				$data['employeeMedicalInfo']	= $this->settingsModel->getEmployeeMedicalInfo($employeeId);
				$data['employeeMedicals']	= $this->settingsModel->getEmployeeMedicals($employeeId);
				$data['employeeRecord']	= $this->settingsModel->getEmployeeRecord($employeeId);
				$data['employeeSuperfunds']	= $this->settingsModel->getEmployeeSuperfunds($employeeId,$centerid);
				$data['employeeTaxDeclaration'] = $this->settingsModel->getEmployeeTaxDec($employeeId);
				$data['Status'] = 'SUCCESS';
			}
			http_response_code(200);
			echo json_encode($data);
		} else {
			http_response_code(401);
		}
	}

	public function getEmployeeAwardsData($userid, $employeeId, $centerid=null)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('settingsModel');
				$data['awards'] = $this->settingsModel->getUserAwardsData($employeeId);
				$data['Status'] = 'SUCCESS';
			}
			http_response_code(200);
			echo json_encode($data);
		} else {
			http_response_code(401);
		}
	}

	// Edit Employee 

	public function getEmployeeData($userid,$centerid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null) {
				$this->load->model('settingsModel');
				$data['users'] = $this->settingsModel->getUserData($userid);
				$data['employee']	= $this->settingsModel->getEmployeeData($userid);
				$data['employeeBankAccount']	= $this->settingsModel->getEmployeeBankAccount($userid);
				$data['employeeDocuments'] = $this->settingsModel->getEmployeeDocuments($userid);
				$data['employeeCourses']	= $this->settingsModel->getEmployeeCourses($userid);
				$data['employeeMedicalInfo']	= $this->settingsModel->getEmployeeMedicalInfo($userid);
				$data['employeeMedicals']	= $this->settingsModel->getEmployeeMedicals($userid);
				$data['employeeRecord']	= $this->settingsModel->getEmployeeRecord($userid);
				$data['employeeSuperfunds']	= $this->settingsModel->getEmployeeSuperfunds($userid,$centerid);
				$data['employeeTaxDeclaration'] = $this->settingsModel->getEmployeeTaxDec($userid);
				$data['Status'] = 'SUCCESS';
			}
			http_response_code(200);
			echo json_encode($data);
		} else {
			http_response_code(401);
		}
	}

	public function superfundsByCenter($centerid,$empId,$userid){
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ( $res != null && $res->userid == $userid) {
				$data['empSuperfunds'] = $this->settingsModel->getEmployeeSuperfunds($empId,$centerid);
				$data['superfunds'] = $this->settingsModel->getSuperfunds($centerid);
				echo json_encode($data);
			}
		}
	}

	public function saveSuperfundByCenter(){
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$json = json_decode(file_get_contents('php://input'));
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$values = $json->values;
				$empId = $json->empId;
				if($empId == null){
					$empId = $json->userid;
				}
				$centerid = $json->centerid;
				$this->settingsModel->deleteEmployeeSuperfunds($empId,$centerid);
				foreach($values as $value){
					$superfundId = $value->superfundId;
					$superMembershipId = $value->superMembershipId;
					$employeeNumber = $value->employeeNumber;
					$this->settingsModel->addToEmployeeSuperfunds($empId,$superfundId,
								$superMembershipId,$employeeNumber,$centerid);
				}
			}
		}
	}

	public function updateEmployeeProfileApp(){
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$firstName = $json->firstName;
				$middleName = $json->middleName;
				$lastName = $json->lastName;
				$imageUrl = $json->imageUrl;
				$userid  = $json->userid;
				if($imageUrl != null && $imageUrl != ""){
					$imageName = "$userid.png";
					file_put_contents("application/assets/profileImages/$imageName",base64_decode($imageUrl));
					$imageUrl = $imageName;
				}
				$this->settingsModel->updateEmployeeProfileApp($userid, $firstName, $middleName, $lastName, $imageUrl);
				$data['Fname'] = $firstName;
				$data['Lname'] = $lastName;
				$data['Mname'] =  $middleName;
				$data['FileName'] = "$json->userid.png";
				$data['Status'] = "SUCCESS";
			}else{
				$data['Message'] = "Invalid Request";
				$data['Status'] = "ERROR";
				http_response_code(401);
			}
		}else{
			$data['Message'] = "Invalid Request";
			$data['Status'] = "ERROR";
			http_response_code(401);
		}	
		echo json_encode($data);
	}

	public function updateEmployeeProfile()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$this->load->model('xeroModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$centerid = $json->center;
				// $xeroEmployeeId = $json->xeroemployeeid;
				$level = $json->level;
				$iopb = $json->iobp;
				$rateperunit = $json->RatePerUnit;
				$maxhours = $json->usual_hours;
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
				$accountName = $json->accountName;
				$bsb = $json->bsb;
				$accountNumber = $json->accountNumber;
				$remainderYN = $json->remainderYN;
				$amount = $json->amount;
				$terminationDate = $json->terminationDate;
				$emergency_contact = $json->emergency_contact;
				$relationship = $json->relationship;
				$emergency_contact_email = $json->emergency_contact_email;
				$superFunds = $json->superFunds;
				$taxFileNumber = $json->taxFileNumber;
				$australiantResidentForTaxPurposeYN = $json->australiantResidentForTaxPurposeYN;
				$residencyStatue = $json->residencyStatue;
				$taxFreeThresholdClaimedYN = $json->taxFreeThresholdClaimedYN;
				$taxOffsetEstimatedAmount = $json->taxOffsetEstimatedAmount;
				$tfnExemptionType = $json->tfnExemptionType;
				$hasHELPDebtYN = $json->hasHELPDebtYN;
				$hasSFSSDebtYN = $json->hasSFSSDebtYN;
				$hasTradeSupportLoanDebtYN_ = $json->hasTradeSupportLoanDebtYN_;
				$upwardVariationTaxWitholdingAmount = $json->upwardVariationTaxWitholdingAmount;
				$eligibleToReceiveLeaveLoadingYN = $json->eligibleToReceiveLeaveLoadingYN;
				$approvedWitholdingVariationPercentage = $json->approvedWitholdingVariationPercentage;
				$employee_no = $json->employee_no;
				$resume_doc = $json->resume_doc;
				$maxhours = $json->usual_hours;
				$resume_doc_ = "";
				if ($resume_doc != null) {
					file_put_contents('application/assets/uploads/documents/' . $employee_no . '_resume.pdf', base64_decode($resume_doc));
					$resume_doc_ = $employee_no . '_resume.pdf';
				}
				$profileImage = $json->profileImage;
				$profileImageName = $employee_no . '.png';
				if ($profileImage != null) {
					$target_dir = 'application/assets/profileImages/';
					file_put_contents($target_dir . $profileImageName, (base64_decode($profileImage)));
				}
				$classification = $json->classification;
				$ordinaryEarningRateId = $json->ordinaryEarningRateId;
				// $payroll_calendar = $json->payroll_calendar;
				$medicareNo = $json->medicareNo;
				$medicareRefNo = $json->medicareRefNo;
				$healthInsuranceFund = $json->healthInsuranceFund;
				$healthInsuranceNo = $json->healthInsuranceNo;
				$ambulanceSubscriptionNo = $json->ambulanceSubscriptionNo;
				$xeroEmployeeId = $json->xeroEmployeeId;
				$documentName = $json->documentNames;
				$documents = $json->documents;
				$docNames = $json->docNames;

				/*Employee Documents*/
				$docCount = 0;
				foreach ($documents as $doc) {
					if (isset($docNames[$docCount]) && $docNames[$docCount] != "" && $docNames[$docCount] != null) {
						file_put_contents(DOCUMENTS_PATH . $docNames[$docCount], base64_decode($documents[$docCount]));
						$this->settingsModel->insertToDocuments($documentName[$docCount], $docNames[$docCount], $employee_no);
						$docCount++;
					}
				}
				/*Employee Documents*/

				// Employee Courses	

				$course_name = $json->course_name;
				$course_description = $json->course_description;
				$date_obtained = $json->date_obtained;
				$expiry_date = $json->expiry_date;
				$certificate = $json->certificate;
				
				$course_id = $json->course_id;
				for ($i = 0; $i < count($course_name); $i++) {
					$course_nme = $course_name[$i];
					$course_desc = $course_description[$i];
					$date_obt = $date_obtained[$i];
					$exp_date = $expiry_date[$i];
					$id = $course_id[$i];
					// $cert = isset($certificate[$i]) ? $certificate[$i] : "";
					$cert = isset($certificate) ? $certificate : "";
					// echo '<pre>';
					// var_dump($certificate);
					// echo '</pre>';
					// exit();
					$certName = "";
					if($cert != null && $cert != ""){
						$certName = uniqid().".pdf";
						// var_dump(base64_decode($cert));

						file_put_contents("application/assets/uploads/documents/$certName",base64_decode($cert));
						// if (strpos($bin, '%PDF') !== 0){
						// 	throw new Exception('Missing the PDF file signature');
						// 	// exit();
						// }
						  
						  # Write the PDF contents to a local file
						//   file_put_contents(DOCUMENTS_PATH.$certName, $bin);
					}
					// get employee Id
					if ($id != "" && $id != null) {
						if ($course_nme != null && $course_nme != "")
							$this->settingsModel->updateEmployeeCourses($id, $employee_no, $course_nme, $course_desc, $date_obt, $exp_date,$certName);
					}
					if ($id == "" || $id == null) {
						if ($course_nme != null && $course_nme != "")
							$this->settingsModel->addToEmployeeCourses($employee_no, $course_nme, $course_desc, $date_obt, $exp_date,$certName);
					}
				}
				// Users	
				$name = $fname . " " . $mname . " " . $lname;
				$this->settingsModel->updateUsers($employee_no, $emails, $name, $title, $userid, $alias);
				// Employee bank account

				$this->settingsModel->deleteFromBankAccount($employee_no);
				for($i = 0;$i<count($accountName);$i++){	
					$this->settingsModel->updateEmployeeBankAccount($employee_no, $accountName[$i], $bsb[$i], 	$accountNumber[$i], count($accountName) > 1 ? ($i == 0 ? 'Y' : 'N') : 'Y', isset($amount[$i -1]) ? $amount[$i-1] : 0);
				}
				// Employee medical info	
				$this->settingsModel->updateEmployeeMedicalInfo($employee_no, $medicareNo, $medicareRefNo, $healthInsuranceFund, $healthInsuranceNo, $ambulanceSubscriptionNo);
				// Employee medicals	
				if (isset($json->medicals_id)) {
					$medicalConditions = $json->medicalConditions;
					$medicalAllergies = $json->medicalAllergies;
					$medication = $json->medication;
					$dietaryPreferences = $json->dietaryPreferences;
					$medicals_id = $json->medicals_id;
					for ($i = 0; $i < count($medicalConditions); $i++) {
						$medC = $medicalConditions[$i];
						$medA = $medicalAllergies[$i];
						$medic = $medication[$i];
						$dietary = $dietaryPreferences[$i];
						$id = $medicals_id[$i];
						$this->settingsModel->updateEmployeeMedicals($id, $employee_no, $medC, $medA, $medic, $dietary);
					}
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
				$contract_doc_ = "";
				if ($contract_doc != null) {
					file_put_contents('application/assets/uploads/documents/' . $employee_no . '_contract.pdf', base64_decode($contract_doc));
					$contract_doc_ = $employee_no . '_contract.pdf';
				}
				// Employee No from Users 
				$uniqueId = uniqid();
				$this->settingsModel->updateEmployeeRecord($employee_no, $xeroEmployeeId, $qual_towards_desc, $highest_qual_held, $qual_towards_percent_comp, $visa_type, $visa_grant_date, $visa_end_date, $visa_conditions, $highest_qual_date_obtained,  $visa_holder, $resume_doc_, $contract_doc_);
				// Employee superfunds	

				if ($employee_no != null && $employee_no != "") {
					if ($superFunds != "" && $superFunds != null && isset($superFunds->Id)) {
						// $this->settingsModel->deleteEmployeeSuperfunds($employee_no);
						for($x=0;$x<count($superFunds->Id);$x++){
							// $this->settingsModel->addToEmployeeSuperfunds(
							// 	$employee_no,
							// 	$superFunds->Id[$x],
							// 	$superFunds->MembershipId[$x],
							// 	$superFunds->EmployeeNumber[$x]
							// );
						}	
					}
				}
				// Employee Tax Declaration

				$this->settingsModel->updateEmployeeTaxDeclaration($employee_no, $tfnExemptionType, $taxFileNumber, $australiantResidentForTaxPurposeYN, $residencyStatue, $taxFreeThresholdClaimedYN, $taxOffsetEstimatedAmount, $hasHELPDebtYN, $hasSFSSDebtYN, $hasTradeSupportLoanDebtYN_, $upwardVariationTaxWitholdingAmount, $eligibleToReceiveLeaveLoadingYN, $approvedWitholdingVariationPercentage);
				// Employee Table

				$this->settingsModel->updateEmployeeTable($employee_no, $title, $fname, $mname, $lname, $emails, $dateOfBirth, $gender, $homeAddLine1, $homeAddLine2, $homeAddCity, $homeAddRegion, $homeAddPostal, $homeAddCountry, $phone, $mobile, $terminationDate, $ordinaryEarningRateId, $userid, $classification, $emergency_contact, $relationship, $emergency_contact_email,$maxhours);
				$this->settingsModel->editEmployeeLBDetails($level,$iopb,$employee_no);
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				// BLOCK CODE
				//FOR UPDATING EMPLOYEE DETAILS IN XERO
				// $centerid = $json->center;
				$xeroTokens = $this->xeroModel->getXeroToken($centerid);
				if ($xeroTokens != null) {
					$access_token = $xeroTokens->access_token;
					$tenant_id = $xeroTokens->tenant_id;
					$refresh_token = $xeroTokens->refresh_token;
					$val = $this->getPayItems($access_token, $tenant_id);
					$val = json_decode($val);
					if ($val->Status == 401) {
						$refresh = $this->refreshXeroToken($refresh_token);
						$refresh = json_decode($refresh);
						$access_token = $refresh->access_token;
						$expires_in = $refresh->expires_in;
						$refresh_token = $refresh->refresh_token;
						$this->xeroModel->insertNewToken($access_token, $refresh_token, $tenant_id, $expires_in, $centerid);
						$val = $this->getPayItems($access_token, $tenant_id);
						$val = json_decode($val);
					}
					if ($val->Status == "OK") {
						//BASIC INFORMATION
						//employees
						// $employees = $this->getEmployees($access_token, $tenant_id, $empId=NULL);
						// // print_r($employees);
						// $employees = json_decode($employees)->Employees;
						// $fer = json_encode($employees);
						// $rfer = str_replace(array( '[', ']' ), '', $fer);

						$updatingEmployeeData = array(
							"EmployeeID"=>$xeroEmployeeId,
							"Title"=>$title,
							"FirstName"=>$fname,
							"MiddleNames"=>empty($mname) ? NULL : $mname,
							"LastName"=>$lname,
							"DateOfBirth"=>$dateOfBirth,
							"HomeAddress"=>array(
								"AddressLine1"=>$homeAddLine1,
								"AddressLine2"=>empty($homeAddLine2) ? NULL : $homeAddLine2,
								"City"=>$homeAddCity,
								"Region"=>$homeAddRegion,
								"PostalCode"=>$homeAddPostal,
								"Country"=>$homeAddCountry
							),
							"PayTemplate"=>array(
								"EarningsLines"=>array((object)[
									"EarningsRateID"=>$ordinaryEarningRateId,
									"CalculationType"=>'ENTEREARNINGSRATE',
									"NormalNumberOfUnits"=>1.0000,
									"RatePerUnit"=>$rateperunit
								])
								),
							"Mobile"=>empty($mobile) ? NULL : $mobile,
							"Phone"=>$phone,
							"Email"=>$emails,
							"Gender"=>$gender,
							"Classification"=>empty($classification) ? NULL : $classification,
							"OrdinaryEarningsRateID"=>empty($ordinaryEarningRateId) ? NULL : $ordinaryEarningRateId,
							"TaxDeclaration"=>array(
								"TaxFileNumber"=>$taxFileNumber,
								"EmploymentBasis"=>"FULLTIME",
								"TFNExemptionType"=>$tfnExemptionType,
								"AustralianResidentForTaxPurposes"=>$australiantResidentForTaxPurposeYN == "Y" ? "true" : "false",
								"TaxFreeThresholdClaimed"=>$taxFreeThresholdClaimedYN == "Y" ? "true" : "false",
								"HasHELPDebt"=>$hasHELPDebtYN == "Y" ? "true" : "false",
								"HasSFSSDebt"=>$hasSFSSDebtYN == "Y" ? "true" : "false",
								"EligibleToReceiveLeaveLoading"=>$eligibleToReceiveLeaveLoadingYN == "Y" ? "true" : "false",
								"HasStudentStartupLoan"=>"",
								"ResidencyStatus"=>$residencyStatue,
								"TaxOffsetEstimatedAmount"=>$taxOffsetEstimatedAmount,
								"UpwardVariationTaxWithholdingAmount"=>$upwardVariationTaxWitholdingAmount,
								"ApprovedWithholdingVariationPercentage"=>$approvedWitholdingVariationPercentage
							)
						);
						/*
						$updatingEmployeeBankAccountData = array();
						for($i = 0;$i<count($accountName);$i++){	
							$bd = array(
								"StatementText"=>"Pay Cheque",
								"AccountName"=>$accountName[$i],
								"BSB"=>$bsb[$i],
								"AccountNumber"=>$accountNumber[$i],
								"Remainder"=>isset($remainderYN[$i]) ? ($remainderYN[$i] == "Y" ? "true" : "false") : "false"
								// "Remainder"=>empty($remainderYN[$i]) ? NULL : ($remainderYN[$i] == "Y" ? "true" : "false"),
								// "Amount"=>isset($amount[$i -1]) ? $amount[$i-1] : 0
							);
							array_push($updatingEmployeeBankAccountData,$bd);
							//$this->settingsModel->updateEmployeeBankAccount($employee_no, $accountName[$i], $bsb[$i], 	$accountNumber[$i], count($accountName) > 1 ? ($i == 0 ? 'Y' : 'N') : 'Y', isset($amount[$i -1]) ? $amount[$i-1] : 0);
						}
						
						$aa = array_merge($updatingEmployeeData,array("BankAccounts"=>$updatingEmployeeBankAccountData));
						$finalstring = '['.stripslashes(json_encode($aa)).']';

						*/

						$finalstring = '['.stripslashes(json_encode($updatingEmployeeData)).']';
						$fr = json_decode($finalstring);
						// print_r($fr);
						// die();
						$this->postEmployeeToXero($access_token,$tenant_id,$fr);
					}
				}else{
					http_response_code(401);
				}
				//FOR UPDATING EMPLOYEE DETAILS IN XERO
				// BLOCK CODE
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				$data['Status'] = 'SUCCESS';
				http_response_code(200);
				echo json_encode($data);
			} else {
				http_response_code(401);
			}
		}
	}


	/*
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
*/

	public function GetPermissionForEmployee($empId, $userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('settingsModel');
				$mdata['permissions'] = $this->settingsModel->getPermissionForEmployee($empId);
				http_response_code(200);
				echo json_encode($mdata);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function deleteDocument($documentId, $userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('settingsModel');
				$this->settingsModel->deleteDocument($documentId);
				$data['Status'] = 'SUCCESS';
			}
			http_response_code(200);
			echo json_encode($data);
		} else {
			http_response_code(401);
		}
	}

	//		get centers by super admin 

	public function centersBySuperAdmin()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$this->load->model('utilModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$type = $json->type;
				$id = $json->id;
				$admin = "";
				$centerDetails = [];
				if ($type == 'CENTER') {
					$getSuperAdmins = $this->utilModel->getSuperAdmins();
					foreach ($getSuperAdmins as $superadmin) {
						// $centers = explode('|',$superadmin->center);
						$centers = $this->utilModel->getAllCenters($superadmin->id);
						foreach ($centers as $cent) {
							if ($id == $cent->centerid && $id != "" && $id != null) {
								$admin = $superadmin;
								break;
							}
						}
					}
					// $adminCenters = explode('|',$admin->center);
					$adminCenters = $this->utilModel->getAllCenters($admin->id);
					$centerDetails = [];
					foreach ($adminCenters as $center) {
						if ($center != null && $center != "") {
							array_push($centerDetails, $this->settingsModel->getCenterDetails($center->centerid));
						}
					}
					$data['CenterDetails'] = $centerDetails;
				}
				if ($type == 'EMPLOYEEID') {
					$userDetails = ($this->utilModel->getUserDetails($id));
					$getSuperAdmins = $this->utilModel->getSuperAdmins();
					foreach ($getSuperAdmins as $superadmin) {
						// $centers = explode('|',$superadmin->center);
						$centers = $this->utilModel->getAllCenters($superadmin->id);
						foreach ($centers as $cent) {
							// $cs = explode('|',$userDetails->center);
							$cs = $this->utilModel->getAllCenters($userDetails->id);
							foreach ($cs as $c) {
								if ($c->centerid == $cent->centerid && $c != "" && $c != null) {
									$admin = $superadmin;
									break;
								}
							}
						}
					}
					// $adminCenters = explode('|',$admin->center);
					$adminCenters = $this->utilModel->getAllCenters($admin->id);
					foreach ($adminCenters as $center) {
						if ($center != null && $center != "") {
							array_push($centerDetails, $this->settingsModel->getCenterDetails($center->centerid));
						}
					}
					$data['CenterDetails'] = $centerDetails;
				}
				$data['Message'] = 'SUCCESS';
				http_response_code(200);
				echo json_encode($data);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function changeEmployeeCenter()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$this->load->model('utilModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$userid = $json->userid;
				$empId = $json->empId;
				$centers = $json->centers;
				if (count($centers) > 0) {
					$this->settingsModel->deleteEmployeeCenters($empId);
					$cent = "";
					foreach ($centers as $center) {
						// TODO
						$cent = $cent . $center . '|';
						$this->settingsModel->editEmployeeCenter($center, $empId);
					}
					$this->settingsModel->updateEmployeeCenter($cent, $empId);
        // Email & Notification
        $permissions = $this->getNotificationPermissions($empId,15);
        foreach($permissions as $permission){
          if($permission->appYN == 'Y'){
			//   $this->utilModel->insertNotification($empId, $intent, $title, $body, json_encode($payload));
			  // $this->firebase->sendMessage($title,$body,$payload,$empId);
		  }
          if($permission->emailYN == 'Y'){
            // $this->Emails($permission->email,$template,$subject,$arr);
          }
        }
        // Email & Notification
					$data['Status'] = 'SUCCESS';
					$data['Message'] = 'Employee centers updated';
				} else {
					$data['Status'] = 'FAILED';
					$data['Message'] = 'Employee centers not updated';
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


	public function changeEmployeeAward()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$this->load->model('utilModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$userid = $json->userid;
				$empId = $json->empId;
				$awards = $json->awards;
				// echo json_encode($awards);
				if (count($awards) > 0) {
					$this->settingsModel->deleteEmployeeAwards($empId);
					$awar = "";
					foreach ($awards as $award) {
						// TODO
						$awar = $awar . $award . '|';
						$this->settingsModel->editEmployeeAwards($award, $empId);
					}
					$this->settingsModel->updateEmployeeAward($awar, $empId);
					// // Email & Notification
					// $permissions = $this->getNotificationPermissions($empId,15);
					// foreach($permissions as $permission){
					// if($permission->appYN == 'Y'){
					// 	//   $this->utilModel->insertNotification($empId, $intent, $title, $body, json_encode($payload));
					// 	// $this->firebase->sendMessage($title,$body,$payload,$empId);
					// }
					// if($permission->emailYN == 'Y'){
					// 	// $this->Emails($permission->email,$template,$subject,$arr);
					// }
					// }
					// // Email & Notification
					$data['Status'] = 'SUCCESS';
					$data['Message'] = 'Employee awards updated';
				} else {
					$data['Status'] = 'FAILED';
					$data['Message'] = 'Employee awards not updated';
				}
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}


	public function SyncedWithXero($centerid, $userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('settingsModel');
				$checkSync = $this->settingsModel->syncedWithXero($centerid);
				if ($checkSync == null) {
					$mdata['syncedWithXero'] = "N";
				} else {
					$mdata['syncedWithXero'] = "Y";
				}
				http_response_code(200);
				echo json_encode($mdata);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function PostEmployeePermission()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
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
				$viewRoomSettingsYN = isset($json->viewRoomSettingsYN) ? $json->viewRoomSettingsYN : 'N';
				$editRoomSettingsYN = isset($json->editRoomSettingsYN) ? $json->editRoomSettingsYN : 'N';
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
				$kidsoftYN = isset($json->kidsoftYN) ? $json->kidsoftYN : 'N';
				$this->load->model('settingsModel');
				$this->settingsModel->insertPermission($empId, $isQrReaderYN, $viewRosterYN, $editRosterYN, $viewTimesheetYN, $editTimesheetYN, $viewPayrollYN, $editPayrollYN, $editLeaveTypeYN, $viewLeaveTypeYN, $createNoticeYN, $viewOrgChartYN, $editOrgChartYN, $viewCenterProfileYN, $editCenterProfileYN, $viewRoomSettingsYN, $editRoomSettingsYN, $viewEntitlementsYN, $editEntitlementsYN, $editEmployeeYN, $xeroYN, $viewAwardsYN, $editAwardsYN, $viewSuperfundsYN, $editSuperfundsYN, $createMomYN, $editPermissionYN, $viewPermissionYN, $kidsoftYN);
				$data['Status'] = "SUCCESS";
				http_response_code(200);
				echo json_encode($data);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function tablesMigration()
	{
		$this->load->model('settingsModel');
		$employeeSuperfunds = $this->settingsModel->employeeSuperfundsMigration();
		foreach ($employeeSuperfunds as $es) {
			$this->settingsModel->employeeSuperfundsMigrations($es->employeeId, $es->id);
		}
		$employeeTaxDeclarations = $this->settingsModel->employeeTaxDeclarationMigration();
		foreach ($employeeTaxDeclarations as $eT) {
			$this->settingsModel->employeeTaxDeclarationMigrations($eT->employeeId);
		}
		// employeesuperfund
		// employeetaxdeclaration
		// employeerecord
		// employeemedicals
		// employeemedicalinfo
		// employeedocuments
		// employeecourses
		// employeebankaccount
		// employee
	}

	public function checkUserid($userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$data = [];
			if ($res != null) {
				$employeeEnrolled = $this->settingsModel->getUserData($userid);
				if ($employeeEnrolled == null) {
					$data['Status'] = 'DOESNT';
				} else {
					$data['Status'] = 'EXISTS';
				}
			}
			http_response_code(200);
			echo json_encode($data);
		} else {
			http_response_code(401);
		}
	}

	public function deleteCourse($courseId, $userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('settingsModel');
				$this->settingsModel->deletecourse($courseId);
				$data['Status'] = 'SUCCESS';
			}
			http_response_code(200);
			echo json_encode($data);
		} else {
			http_response_code(401);
		}
	}

	public function NotificationPermissions($userid){
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($res != null && $res->userid == $userid) {
				$this->load->model('settingsModel');
				if($_SERVER['REQUEST_METHOD'] == "GET"){
					$notificationPermissions = $this->settingsModel->fetchNotificationPermissions($userid);
					$data = [];
					foreach($notificationPermissions as $np){
						$data["$np->notificationtype"]["typeid"] = isset($np->typeid) ? $np->typeid : "N";
						$data["$np->notificationtype"]["isAppYN"] = isset($np->appYN) ? $np->appYN : "N";
						$data["$np->notificationtype"]["isEmailYN"] = isset($np->emailYN) ? $np->emailYN : "N";
					}
				}
				if($_SERVER['REQUEST_METHOD'] == "POST"){
					$types = ["App","Email"];
					foreach($types as $type){
					$post['Meeting_Created']["Meeting_Created_$type"] = isset($json->{"Meeting_Created_$type"}) ? "Y" : "N";
					$post['Meeting_Ended']["Meeting_Ended_$type"] = isset($json->{"Meeting_Ended_$type"}) ? "Y" : "N";
					$post['Birthday_Anniversary']["Birthday_Anniversary_$type"] = isset($json->{"Birthday_Anniversary_$type"}) ? "Y" : "N";
					$post['Shift_Updated']["Shift_Updated_$type"] = isset($json->{"Shift_Updated_$type"}) ? "Y" : "N";
					$post['Roster_Published']["Roster_Published_$type"] = isset($json->{"Roster_Published_$type"}) ? "Y" : "N";
					$post['Shift_Status_Changed']["Shift_Status_Changed_$type"] = isset($json->{"Shift_Status_Changed_$type"}) ? "Y" : "N";
					$post['Roster_Permission']["Roster_Permission_$type"] = isset($json->{"Roster_Permission_$type"}) ? "Y" : "N";
					$post['Timesheet_Published']["Timesheet_Published_$type"] = isset($json->{"Timesheet_Published_$type"}) ? "Y" : "N";
					$post['Payroll_Flagged']["Payroll_Flagged_$type"] = isset($json->{"Payroll_Flagged_$type"}) ? "Y" : "N";
					$post['Payroll_Published']["Payroll_Published_$type"] = isset($json->{"Payroll_Published_$type"}) ? "Y" : "N";
					$post['Notice_Created']["Notice_Created_$type"] = isset($json->{"Notice_Created_$type"}) ? "Y" : "N";
					$post['Employee_Profile_Updated']["Employee_Profile_Updated_$type"] = isset($json->{"Employee_Profile_Updated_$type"}) ? "Y" : "N";
					$post['Employee_Synced_With_Xero']["Employee_Synced_With_Xero_$type"] = isset($json->{"Employee_Synced_With_Xero_$type"}) ? "Y" : "N";
					$post['Password_Updated']["Password_Updated_$type"] = isset($json->{"Password_Updated_$type"}) ? "Y" : "N";
					$post['Center_Added_Removed']["Center_Added_Removed_$type"] = isset($json->{"Center_Added_Removed_$type"}) ? "Y" : "N";
					$post['Level_Changed']["Level_Changed_$type"] = isset($json->{"Level_Changed_$type"}) ? "Y" : "N";
					$post['Employee_Role_Changed']["Employee_Role_Changed_$type"] = isset($json->{"Employee_Role_Changed_$type"}) ? "Y" : "N";
					$post['Employee_Area_Changed']["Employee_Area_Changed_$type"] = isset($json->{"Employee_Area_Changed_$type"}) ? "Y" : "N";
					$post['Leave_Applied']["Leave_Applied_$type"] = isset($json->{"Leave_Applied_$type"}) ? "Y" : "N";
					$post['Leave_Status_Changed']["Leave_Status_Changed_$type"] = isset($json->{"Leave_Status_Changed_$type"}) ? "Y" : "N";
					$post['Xero_Token_Created']["Xero_Token_Created_$type"] = isset($json->{"Xero_Token_Created_$type"}) ? "Y" : "N";
					$post['Kidsoft_Servicekey']["Kidsoft_Servicekey_$type"] = isset($json->{"Kidsoft_Servicekey_$type"}) ? "Y" : "N";
					}
					$this->settingsModel->postNotificationPermissions($userid,$post);
				}
				$data['Status'] = 'SUCCESS';
			}
			http_response_code(200);
			echo json_encode($data);
		} else {
			http_response_code(401);
		}
	}

	public function employeeMigrationFromUserTable()
	{
		$this->load->model('authModel');
		$this->load->model('settingsModel');

		$usersFromUsersTable = $this->settingsModel->getAllUsers();
		foreach ($usersFromUsersTable as $userFromUsersTable) {
			$userData = $this->settingsModel->getEmployeeData($userFromUsersTable->id);
			if ($userData == null) {
				print_r($userData);
				$name = preg_split('/[\s]+/', $userFromUsersTable->name);
				foreach ($name as $key => $n) {
					if ($n == null || $n == '') {
						unset($name[$key]);
					}
				}
				if (count($name) == 2) {
					$this->settingsModel->addToEmployeeTable($userFromUsersTable->id, null, null, $name[0], null, $name[1], 'ACTIVE', $userFromUsersTable->email, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
				}
				if (count($name) == 3) {
					$this->settingsModel->addToEmployeeTable($userFromUsersTable->id, null, null, $name[0], $name[1], $name[2], 'ACTIVE', $userFromUsersTable->email, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
				}
				if (count($name) == 1) {
					$this->settingsModel->addToEmployeeTable($userFromUsersTable->id, null, null, $name[0], null, null, 'ACTIVE', $userFromUsersTable->email, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
				}
			}
		}
	}

	public function getAllNotifications(){
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($res != null && $json != null && $res->userid == $json->userid) {
				$userid = $json->userid;
				$start = isset($json->start) ? $json->start : 0;
				$count = isset($json->count) ? $json->count : 25; 
				$notifications = $this->settingsModel->getNotificationsForUser($userid,$start,$count);
				$data['Notifications'] = $notifications;
				$data['Status'] = 'SUCCESS';
			}else{
				$data['Status'] = 'ERROR';
				$data['Message'] = 'Invalid !';
			}
			echo json_encode($data);
			http_response_code(200);
		}
	}

	public function updateNotifications($userid){
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->settingsModel->updateNotifications($userid);
				$data['Status'] = 'SUCCESS';
			}else{
				$data['Status'] = 'ERROR';
				$data['Message'] = 'Invalid !';
			}
			echo json_encode($data);
			http_response_code(200);
		}
	}

	public function getCompanySettingsData($userid){
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			// $json = json_decode(file_get_contents('php://input'));
			// if ($res != null && $json != null && $res->userid == $userid) {
			if ($res != null && $res->userid == $userid) {
				$companydata = $this->authModel->getCompanyDetails($userid);
				$data['companydata'] = $companydata;
				$data['Status'] = 'SUCCESS';
			}else{
				$data['Status'] = 'ERROR';
				$data['Message'] = 'Invalid !';
			}
			echo json_encode($data);
			http_response_code(200);
		}
	}

	public function postCompanySettings()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);

			if ($res != null && $res->userid == $_POST['userid']) {
				$userid = $_POST['userid'];
				$companyId = $_POST['companyId'];
				$emp_id_prefix = $_POST['emp_id_prefix'];
				// var_dump($_POST);
				// die();
				if(!empty($_FILES['companyImage']['name'])){
					$data['companyImage'] = uniqid();
					$config['upload_path'] = '../assets/images/icons/';
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['max_size'] = '2000';
					$config['file_name'] = $data['companyImage'];
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('companyImage'))
					{
						$data['upload_data'] = array('upload_data' => $this->upload->data());
						$data['companyImage'] = $data['companyImage'].$data['upload_data']['upload_data']['file_ext'];	
						$this->settingsModel->postCompanySettings($companyId,$data['companyImage'],$emp_id_prefix);
						$this->session->unset_userdata('companyImage');
						$this->session->set_userdata('companyImage',$data['companyImage']);
						$data['Status'] = "SUCCESS";
						$data['Message'] = "COMPANY SETTINGS UPDATED";
						echo json_encode($data);
					}
					else
					{
						// echo $this->upload->display_errors(); die();
						$data['Status'] = "ERROR";
						$data['Message'] = "File format of .jpg,.png,.jpeg supported. Max size 2mb";
						echo json_encode($data);
					}
				}
				else{
					$companydata = $this->authModel->getCompanyDetails($userid);
					// print_r($companydata);
					// die();
					$this->settingsModel->postCompanySettings($companyId,$companydata->companyLogo,$emp_id_prefix);
					$this->session->unset_userdata('companyImage');
					$this->session->set_userdata('companyImage',$companydata->companyLogo);
					$data['Status'] = "SUCCESS";
					$data['Message'] = "COMPANY SETTINGS UPDATED";
					echo json_encode($data);
				}

			} else {
				$data['Status'] = "ERROR";
				$data['Message'] = "UNAUTHORIZED2";
				http_response_code(401);
				echo json_encode($data);
			}
		} else {
			$data['Status'] = "ERROR";
			$data['Message'] = "UNAUTHORIZED1";
			http_response_code(401);
			echo json_encode($data);
		}
	}

	public function getEmployeeId(){
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($res != null && $res->userid == $json->userid && $json != null) {
				$userid = $json->userid;
				//From the db we can get the role
				$ud = $this->authModel->getUserDetails($userid);
				// $role = $json->role;
				$role = $ud->role;
				$res = $this->settingsModel->getFullEmployeeId($userid,$role);
				// print_r($res);
				// die();
				//OP:
				// 	stdClass Object
				// (
				//     [lastuserid] => 
				//     [companyIdPrefix] => CM
				// )
				$re=preg_replace('~\D~', '', $res->lastuserid);
				$prefix = preg_replace('/[0-9]+/', '', $res->lastuserid);
				if($re == ""){
					$finalempno = sprintf('%05d',1);
					$data['Data'] = $res->companyIdPrefix.$finalempno;
				}else{
					$finalempno = sprintf('%05d',$re+1);
					$data['Data'] = $prefix.$finalempno;
				}
				$data['Status'] = "SUCCESS";
				$data['Message'] = "EMPLOYEE NO GENERATED";
				http_response_code(200);
				echo json_encode($data);
			} else {
				$data['Status'] = "ERROR";
				$data['Message'] = "UNAUTHORIZED2";
				$data['Data'] = "";
				http_response_code(401);
				echo json_encode($data);
			}
		} else {
			$data['Status'] = "ERROR";
			$data['Message'] = "UNAUTHORIZED1";
			$data['Data'] = "";
			http_response_code(401);
			echo json_encode($data);
		}

	}


	// public function geid(){
	// 	$this->load->model('settingsModel');
	// 	$res = $this->settingsModel->getFullEmployeeId('andrew',1);
	// 	$re=preg_replace('~\D~', '', $res->lastuserid);
	// 	// echo $re."<br>";
	// 	$finalempno = sprintf('%05d',$re+1);
	// 	// echo $finalempno;
	// }

	// GET VISITS
	public function getEmployeeVisits($centerid,$userid){
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);

			if ($res != null && $res->userid == $userid) {
				$res = $this->settingsModel->getempVisits($centerid);
				$data['Status'] = "SUCCESS";
				$data['Message'] = "VISITS GENERATED";
				if(empty($res)){
					$data['Data'] = [];
				}else{
					$data['Data'] = $res;
				}
				http_response_code(200);
				echo json_encode($data);
			} else {
				$data['Status'] = "ERROR";
				$data['Message'] = "UNAUTHORIZED2";
				$data['Data'] = "";
				http_response_code(401);
				echo json_encode($data);
			}
		} else {
			$data['Status'] = "ERROR";
			$data['Message'] = "UNAUTHORIZED1";
			$data['Data'] = "";
			http_response_code(401);
			echo json_encode($data);
		}

	}
	// GET VISITS

	//CHECK UNIQUENESS FOR SUPERADMIN FORM
	public function uniqueChecks(){
		$this->load->model('settingsModel');
		if(!empty($_POST['companyName'])){
			//check company unique
			$r = $this->settingsModel->companyNameUnique($_POST['companyName']);
			if($r){
				$response = ['status'=>'SUCCESS','message'=>'NO COMPANY NAME EXISTS','data'=>$r];
			}else{
				$response = ['status'=>'FAILURE','message'=>'COMPANY NAME EXISTS','data'=>$r];
			}
			echo json_encode($response);
		}else if(!empty($_POST['empidprefix'])){
			//check emp id prefix
			$r = $this->settingsModel->empidprefixUnique($_POST['empidprefix']);
			if($r){
				$response = ['status'=>'SUCCESS','message'=>'NO EMP ID PREFIX EXISTS','data'=>$r];
			}else{
				$response = ['status'=>'FAILURE','message'=>'EMP ID PREFIX EXISTS','data'=>$r];
			}
			echo json_encode($response);
		}else if(!empty($_POST['name'])){
			//check name
			$r = $this->settingsModel->usernameUnique($_POST['name']);
			if($r){
				$response = ['status'=>'SUCCESS','message'=>'NO USER NAME EXISTS','data'=>$r];
			}else{
				$response = ['status'=>'FAILURE','message'=>'USER NAME EXISTS','data'=>$r];
			}
			echo json_encode($response);
		}else if(!empty($_POST['email'])){
			//check email
			$r = $this->settingsModel->useremailUnique($_POST['email']);
			if($r){
				$response = ['status'=>'SUCCESS','message'=>'NO USER EMAIL EXISTS','data'=>$r];
			}else{
				$response = ['status'=>'FAILURE','message'=>'USER EMAIL EXISTS','data'=>$r];
			}
			echo json_encode($response);
		}else if(!empty($_POST['alias'])){
			$r = $this->settingsModel->useraliasUnique($_POST['alias']);
			if($r){
				$response = ['status'=>'SUCCESS','message'=>'NO USER ALIAS EXISTS','data'=>$r];
			}else{
				$response = ['status'=>'FAILURE','message'=>'USER ALIAS EXISTS','data'=>$r];
			}
			echo json_encode($response);
		}
	}
	//CHECK UNIQUENESS FOR SUPERADMIN FORM

	// SUPER ADMIN FORM POST
	public function postSuperadmin(){

		$this->load->model('settingsModel');
		//$this->load->model('payrollModel');

		//Company Information - superadmin tbl
		$companyId = uniqid();
		$companyName = $_POST['companyName'];
		$empIdPrefix = $_POST['empIdPrefix'];
		if(!empty($_FILES['companyImage']['name'])){
			$details['companyImage'] = uniqid();
			$config['upload_path'] = '../assets/images/icons/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '2000';
			$config['file_name'] = $details['companyImage'];
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('companyImage'))
			{
				$details['upload_data'] = array('upload_data' => $this->upload->data());
				$details['companyImage'] = $details['companyImage'].$details['upload_data']['upload_data']['file_ext'];	
				$cores = $this->settingsModel->insertCompany(array('companyid'=>$companyId,'companyName'=>$companyName,'companyLogo'=>$details['companyImage'],'emp_id_prefix'=>$empIdPrefix));
				// print_r(array('companyid'=>$companyId,'companyName'=>$companyName,'companyLogo'=>$data['companyImage'],'emp_id_prefix'=>$empIdPrefix));
				// die();
				// $cores = true;
				if($cores){
					//Basic User Information - users tbl
					$userfirstName = $_POST['userfirstName'];
					$userlastName = $_POST['userlastName'];
					$userEmail = $_POST['userEmail'];
					$userPassword = $_POST['userPassword'];
					$userAlias = $_POST['userAlias'];
					$role = 1;
					$sres = $this->settingsModel->insertSuperadmin(array('id'=>strtolower($userfirstName),'email'=>$userEmail,'password'=>md5($userPassword),'name'=>$userfirstName." ".$userlastName,'role'=>$role,'title'=>'Superadmin','manager'=>$userfirstName,'isVerified'=>'Y','created_at'=>date('Y-m-d H:i:s'),'created_by'=>strtolower($userfirstName),'alias'=>$userAlias));
					// print_r(array('id'=>$userfirstName,'email'=>$userEmail,'password'=>md5($userPassword),'name'=>$userfirstName." ".$userlastName,'role'=>$role,'title'=>'Superadmin','manager'=>$userfirstName,'isVerified'=>'Y','created_at'=>date('Y-m-d H:i:s'),'alias'=>$userAlias));
					// die();
					// $sres = true;
					if($sres){
						//Center Information - center,usercenter tbl
						$centerName = $_POST['centerName'];
						$centerStreet  = $_POST['centerStreet'];
						$centerCity = $_POST['centerCity'];
						$centerState = $_POST['centerState'];
						$centerZip = $_POST['centerZip'];
						$centerTelephone = $_POST['centerTelephone'];
						$centerMobile = $_POST['centerMobile'];
						$centerEmail = $_POST['centerEmail'];
						$cres = $this->settingsModel->insertSuperAdminFirstCenter($centerStreet,$centerCity,$centerState,$centerZip,$centerName,$centerTelephone,$centerMobile,$centerEmail,$userfirstName,$companyId);
						// echo $centerStreet,$centerCity,$centerState,$centerZip,$centerName,$centerTelephone,$centerMobile,$centerEmail,$userfirstName,$companyId;
						// die();
						// $cres = true;
						if($cres){
							//Permission Information - permission tbl
							$permissions = $_POST['permissions'];
							// print_r($permissions);
							// die();
							foreach($permissions as $i=>$v){
								if(strpos($v,'QR READER') !== false || strpos($v,'XERO SETTINGS') !== false || strpos($v,'VIEW ROOM SETTINGS') !== false || strpos($v,'EDIT ROOM SETTINGS') !== false || strpos($v,'VIEW ROSTER') !== false || strpos($v,'EDIT ROSTER') !== false || strpos($v,'VIEW TIMESHEET') !== false || strpos($v, 'CREATE NOTICE') !== false || strpos($v,'VIEW ORG CHART') !== false || strpos($v,'EDIT EMPLOYEES') !== false || strpos($v,'EDIT ORG CHART') !== false || strpos($v,'EDIT TIMESHEET') !== false || strpos($v,'VIEW CENTER PROFILE') !== false || strpos($v,'EDIT CENTER PROFILE') !== false || strpos($v,'EDIT ENTITLEMENTS') !== false || strpos($v,'VIEW ENTITLEMENTS') !== false || strpos($v,'VIEW PAYROLL') !== false || strpos($v,'EDIT PAYROLL') !== false  || strpos($v,'EDIT LEAVE TYPES') !== false || strpos($v,'VIEW LEAVE TYPES') !== false || strpos($v,'KIDSOFT PERMISSIONS') !== false || strpos($v,'VIEW PERMISSIONS') !== false || strpos($v,'EDIT PERMISSIONS') !== false || strpos($v,'CREATE MOM') !== false || strpos($v,'EDIT SUPERFUNDS') !== false || strpos($v,'VIEW SUPERFUNDS') !== false || strpos($v,'EDIT AWARDS') !== false || strpos($v,'VIEW AWARDS') !== false){
									$viewRosterYN = "Y";
									$editRosterYN = "Y";
									$viewTimesheetYN = "Y";
									$editTimesheetYN = "Y";
									$viewPayrollYN = "Y";
									$editLeaveTypeYN = "Y";
									$isQrReaderYN = "Y";
									$viewLeaveTypeYN = "Y";
									$editPayrollYN = "Y";
									$viewOrgChartYN = "Y";
									$createNoticeYN = "Y";
									$editOrgChartYN = "Y";
									$viewCenterProfileYN = "Y";
									$editEmployeeYN = "Y";
									$kidsoftYN = "Y";
									$viewPermissionYN = "Y";
									$editPermissionYN = "Y";
									$createMomYN = "Y";
									$viewSuperfundsYN = "Y";
									$editSuperfundsYN = "Y";
									$viewAwardsYN = "Y";
									$editAwardsYN = "Y";
									$xeroYN = "Y";
									$viewEntitlementsYN = "Y";
									$editEntitlementsYN = "Y";
									$editCenterProfileYN = "Y";
									$viewRoomSettingsYN = "Y";
									$editRoomSettingsYN = "Y";
								}else{
									$viewRosterYN = "N";
									$editRosterYN = "N";
									$viewTimesheetYN = "N";
									$editTimesheetYN = "N";
									$viewPayrollYN = "N";
									$editLeaveTypeYN = "N";
									$isQrReaderYN = "N";
									$viewLeaveTypeYN = "N";
									$editPayrollYN = "N";
									$viewOrgChartYN = "N";
									$createNoticeYN = "N";
									$editOrgChartYN = "N";
									$viewCenterProfileYN = "N";
									$editEmployeeYN = "N";
									$kidsoftYN = "N";
									$viewPermissionYN = "N";
									$editPermissionYN = "N";
									$createMomYN = "N";
									$viewSuperfundsYN = "N";
									$editSuperfundsYN = "N";
									$viewAwardsYN = "N";
									$editAwardsYN = "N";
									$xeroYN = "N";
									$viewEntitlementsYN = "N";
									$editEntitlementsYN = "N";
									$editCenterProfileYN = "N";
									$viewRoomSettingsYN = "N";
									$editRoomSettingsYN = "N";
								}
							}
							$this->settingsModel->insertPermission($userfirstName,$isQrReaderYN,$viewRosterYN,$editRosterYN,$viewTimesheetYN,$editTimesheetYN,$viewPayrollYN,$editPayrollYN,$editLeaveTypeYN,$viewLeaveTypeYN,$createNoticeYN,$viewOrgChartYN,$editOrgChartYN,$viewCenterProfileYN,$editCenterProfileYN,$viewRoomSettingsYN,$editRoomSettingsYN,$viewEntitlementsYN,$editEntitlementsYN,$editEmployeeYN,$xeroYN,$viewAwardsYN,$editAwardsYN,$viewSuperfundsYN,$editSuperfundsYN,$createMomYN,$editPermissionYN,$viewPermissionYN,$kidsoftYN);
							// echo $userfirstName,$isQrReaderYN,$viewRosterYN,$editRosterYN,$viewTimesheetYN,$editTimesheetYN,$viewPayrollYN,$editPayrollYN,$editLeaveTypeYN,$viewLeaveTypeYN,$createNoticeYN,$viewOrgChartYN,$editOrgChartYN,$viewCenterProfileYN,$editCenterProfileYN,$viewRoomSettingsYN,$editRoomSettingsYN,$viewEntitlementsYN,$editEntitlementsYN,$editEmployeeYN,$xeroYN,$viewAwardsYN,$editAwardsYN,$viewSuperfundsYN,$editSuperfundsYN,$createMomYN,$editPermissionYN,$viewPermissionYN,$kidsoftYN;
							// die();
							// $rres = true;
							// if($rres){
								//Entitlements Information - entitlements tbl
								$entitlements = $_POST['entitlements'];
								foreach($entitlements as $index=>$value){
									$classificationdata = explode(',',$value);
								}
								foreach($classificationdata as $in=>$va){
									$classfidata = explode('||',$va);
									$this->settingsModel->insertSuperAdminEntitlements($classfidata[0], $classfidata[1], $userfirstName, $companyId);

								}
								$data['Status'] = "SUCCESS";
								$data['Message'] = "ALL OPERATIONS SUCCESS";
								echo json_encode($data);
							// }else{
							// 	$data['Status'] = "ERROR";
							// 	$data['Message'] = "FAILED TO INSERT PERMISSIONS";
							// 	echo json_encode($data);
							// }
						}else{
							$data['Status'] = "ERROR";
							$data['Message'] = "FAILED TO INSERT CENTER";
							echo json_encode($data);
						}
					}else{
						$data['Status'] = "ERROR";
						$data['Message'] = "FAILED TO INSERT SUPER ADMIN";
						echo json_encode($data);
					}

				}else{
					$data['Status'] = "ERROR";
					$data['Message'] = "FAILED TO INSERT COMPANY";
					echo json_encode($data);
				}
			}
			else
			{
				// echo $this->upload->display_errors(); die();
				$data['Status'] = "ERROR";
				$data['Message'] = "File format of .jpg,.png,.jpeg supported. Max size 2mb";
				echo json_encode($data);
			}
		}

		// var_dump($_POST);
		// die();



	}
	// SUPER ADMIN FORM POST

}
