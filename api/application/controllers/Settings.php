<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
					$centerid = $this->settingsModel->addCenter($center_street, $center_city, $center_state, $center_zip, $center_name, $center_phone, $center_mobile, $center_email, $json->userid,$uniqid);
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

	public function createEmployeeProfile()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$employee_no = isset($json->employee_no) ? $json->employee_no : null;
				$employeeEnrolled = $this->settingsModel->getUserData($employee_no);
				if ($employee_no != null && $employeeEnrolled == null) {
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

							$this->settingsModel->addToUsers($employee_no, md5($password), $emails, $name, $center, $userid, $role, $level, $alias, $profileImageName);
							// Add user to usercenters
							$this->settingsModel->addToUserCenters($employee_no, $center);
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
						$data['Status'] = 'SUCCESS';
						http_response_code(200);
						echo json_encode($data);
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

	function postToXero($access_token, $tenant_id, $data)
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
		return $server_output;
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
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
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
					$cert = isset($certificate[$i]) ? $certificate[$i] : "";
					$certName = "";
					if($cert != null && $cert != ""){
						$certName = uniqid().".pdf";
						file_put_contents("application/assets/uploads/documents/$certName",base64_decode($cert));
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

				$this->settingsModel->updateEmployeeTable($employee_no, $title, $fname, $mname, $lname, $emails, $dateOfBirth, $gender, $homeAddLine1, $homeAddLine2, $homeAddCity, $homeAddRegion, $homeAddPostal, $homeAddCountry, $phone, $mobile, $terminationDate, $ordinaryEarningRateId, $userid, $classification, $emergency_contact, $relationship, $emergency_contact_email);

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
}
