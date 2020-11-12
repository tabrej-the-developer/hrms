<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends CI_Controller{

	function __construct() {
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-DEVICE-ID,X-TOKEN,X-DEVICE-TYPE, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$method = $_SERVER['REQUEST_METHOD'];
		if($method == "OPTIONS") {
		die();
		}
		parent::__construct();
	}

	public function index(){

	}

	public function getAllPayrollTypes($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('payrollModel');
				$types = $this->payrollModel->getAllPayrollTypes();
				$mdata['payrollTypes'] = $types;
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

	public function getAllEntitlements($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('payrollModel');
				$mdata['entitlements'] = $this->payrollModel->getAllEntitlements();
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

	public function updateEntitlement($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$id  = $json->id;
				$name = $json->name;
				$rate = $json->rate;
				$userid = $json->userid;
				$userDetails = $this->authModel->getUserDetails($userid);
				if($userDetails != null && $userDetails->role == SUPERADMIN){
					$this->load->model('payrollModel');
					if($name != null && $name != "" && $rate != null && $rate != ""){
						$this->payrollModel->updateEntitlement($id,$name,$rate);
						$data['Status'] = 'SUCCESS';
						http_response_code(200);
						echo json_encode($data);
					}else{
						$data['Status'] = 'ERROR - Some fields are empty';
						http_response_code(200);
						echo json_encode($data);
					}
				}
				else{

					$data['Status'] = 'ERROR';
					$data['Message'] = "You are not allowed";
				}
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function addEntitlement(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$name = $json->name;
				$rate = $json->rate;
				$userid = $json->userid;
				$userDetails = $this->authModel->getUserDetails($userid);
				if($userDetails != null && $userDetails->role == SUPERADMIN){
					$this->load->model('payrollModel');
				if($name != null && $name != "" && $rate != null && $rate != ""){
						$this->payrollModel->addEntitlement($name,$rate,$userid);
					}
					$data['Status'] = 'SUCCESS';
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

	public function getAllPayrollShifts($timesheetid,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('payrollModel');	
				$this->load->model('timesheetModel');			
				$timesheet = $this->timesheetModel->getTimesheet($timesheetid);
				$users = $this->payrollModel->getUniqueUsersForTimesheet($timesheetid);
				$data['timesheetid'] = $timesheetid;
				$data['startDate'] = $timesheet->startDate;
				$data['endDate'] = $timesheet->endDate;
				$data['centerid'] = $timesheet->centerid;
				$data['employees'] = array();
				foreach ($users as $u) {
					$var['payrollShifts'] = $this->payrollModel->getAllPayrollShifts($timesheetid,$u->userid);
					$var['userDetails'] = $this->authModel->getUserDetails($u->userid);
					array_push($data['employees'],$var);
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

	public function updateShiftStatus($timesheetid,$memberid,$userid){
		$headers = $this->input->request_headers();
		   if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
		   	$json = json_decode(file_get_contents('php://input'));
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('payrollModel');
					if($timesheetid != null && $memberid != null ){
						if($json->message != "")
							$this->payrollModel->updateFlag($timesheetid,$memberid,$json->message);
						else
							$this->payrollModel->updateFlag($timesheetid,$memberid,"");
					}
					$data['status'] = 'SUCCESS';
				}
				http_response_code(200);
				echo json_encode($data);
			}
			else{
				http_response_code(401);
				echo 'ERROR';
			}
		}

	public function updateToPublished($userid){
		$headers = $this->input->request_headers();
		   if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
		   	$json = json_decode(file_get_contents('php://input'));
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('payrollModel');
						if(count($json->array) > 0){
							foreach($json->array as $payroll){
								$this->payrollModel->updateShift($payroll->timesheetid,$payroll->userid);
							}
						}
					$data['status'] = 'SUCCESS';
				http_response_code(200);
				echo json_encode($data);
			}
			else{
				http_response_code(401);
				echo 'ERROR';
			}
		}
	}

	public function deleteEntitlement($entitlementId,$userid){
		$headers = $this->input->request_headers();
		   if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('payrollModel');
					if($entitlementId != null){
						$this->payrollModel->deleteEntitlement($entitlementId);
					}
					$data['status'] = 'SUCCESS';
				}
				http_response_code(200);
				echo json_encode($data);
			}
			else{
				http_response_code(401);
				echo 'ERROR';
			}
	}

	public function getUserLevels($x,$userid ){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('payrollModel');
				$mdata['users'] = $this->payrollModel->getUserLevels($x);
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


	// public function CreateAwardType(){
	// 	$headers = $this->input->request_headers();
	// 	if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
	// 		$this->load->model('authModel');
	// 		$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
	// 		$json = json_decode(file_get_contents('php://input'));
	// 		if($json!= null && $res != null && $res->userid == $json->userid){
	// 			$name = $json->name;
	// 			$isExemptFromTaxYN = $json->isExemptFromTaxYN;
	// 			$isExemptFromSuperYN = $json->isExemptFromSuperYN;
	// 			$isReportableAsW1 = $json->isReportableAsW1;
	// 			$earningType = $json->earningType;
	// 			$rateType = $json->rateType;
	// 			$multiplier_amount = $json->multiplier_amount;
	// 			$userid = $json->userid;
	// 			$userDetails = $this->authModel->getUserDetails($userid);
	// 			if($userDetails != null && $userDetails->role == SUPERADMIN){
	// 				$this->load->model('xeroModel');
	// 				$this->load->model('payrollModel');
	// 				//xero 
	// 				$xeroTokens = $this->xeroModel->getXeroToken();
	// 				if($xeroTokens != null){
	// 					$access_token = $xeroTokens->access_token;
	// 					$tenant_id = $xeroTokens->tenant_id;
	// 					$refresh_token = $xeroTokens->refresh_token;
	// 					$data['Name'] = $name;
	// 					$data['AccountCode'] = XERO_ACCOUNT_CODE;
	// 					$data['IsExemptFromTax'] = $isExemptFromTaxYN == "Y";
	// 					$data['IsExemptFromSuper'] = $isExemptFromSuperYN == "Y";
	// 					$data['IsReportableAsW1'] = $isReportableAsW1 == "Y";
	// 					$data['RateType'] = $rateType;
	// 					if($rateType == "MULTIPLE") {
	// 						$data['Multiplier'] = $multiplier_amount;
	// 					}
	// 					else {
	// 						$data['Amount'] = $multiplier_amount;
	// 					}
	// 					$data['CurrentRecord'] = true;
	// 					$mdata['EarningsRates'] = array();
	// 					array_push($mdata['EarningsRates'], $data);
	// 					$url = XERO_PAY_ITEMS_URL;
	// 					$val = $this->postXero($url,$access_token,$tenant_id,json_encode($mdata));
	// 					$val = json_decode($val);
	// 					var_dump($val);
	// 					if($val != NULL){
	// 						if($val->Status == 401){
	// 							$refresh = $this->refreshXeroToken($refresh_token);
	// 							$refresh = json_decode($refresh);
	// 							$access_token = $refresh->access_token;
	// 							$expires_in = $refresh->expires_in;
	// 							$refresh_token = $refresh->refresh_token;
	// 							$this->xeroModel->insertNewToken($access_token,$refresh_token,$tenant_id,$expires_in);
	// 							$val = $this->postXero($url,$access_token,$tenant_id,json_encode($mdata));
	// 							$val = json_decode($val);
	// 						}
	// 					}
	// 					if($val == NULL){
	// 						$payItems = $this->getXero($url,$access_token,$tenant_id);
	// 						$earningType = json_decode($payItems)->PayItems->EarningsRates;
	// 						for($i=0;$i<count($earningType);$i++){
	// 							print_r($earningType[$i]);
	// 							if($earningType[$i]->Name == $name){
	// 								$EarningsRateID = $earningType[$i]->EarningsRateID;
	// 								$this->payrollModel->insertPayrollShifts($EarningsRateID,$name,$isExemptFromTaxYN,$isExemptFromSuperYN,$isReportableAsW1,$earningType,$rateType,$multiplier_amount,"Y",$userid);
	// 								//$this->leaveModel->createLeaveType($LeaveTypeID,$data['Name'],$isPaidYN,$slug,$showOnPaySlipYN,"Y",$userid);
	// 								break;
	// 							}
	// 						}
	// 						$data = [];
	// 						$data['Status'] = 'SUCCESS';
	// 					}
	// 					else{
	// 						$data['Status'] = "ERROR";
	// 						$data['Message'] = "An unknown error occured";
	// 					}
	// 				}
	// 			}
	// 			else{

	// 				$data['Status'] = 'ERROR';
	// 				$data['Message'] = "You are not allowed";
	// 			}
	// 			http_response_code(200);
	// 			echo json_encode($data);
	// 		}
	// 		else{
	// 			echo "Hello";
	// 			http_response_code(401);
	// 		}
	// 	}
	// 	else{
	// 		echo "What";
	// 		http_response_code(401);
	// 	}
	// }

	// public function updateEntitlement($entitlementId){
	// 	$headers = $this->input->request_headers();
	// 	   if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
	// 		$this->load->model('authModel');
	// 		$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
	// 		$json = json_decode(file_get_contents('php://input'));
	// 		if($res != null && $res->userid == $json->suserid){
	// 			$name = $json->name;
	// 			$id
	// 			$hourlyRate = $json->hourlyRate;
	// 			$this->load->model('payrollModel');
	// 				$this->payrollModel->updateEntitlement($entitlementId,$name,$hourlyRate);
	// 				$data['status'] = 'SUCCESS';
	// 			}
	// 			http_response_code(200);
	// 			echo json_encode($data);
	// 		}
	// 		else{
	// 			http_response_code(401);
	// 			echo 'ERROR';
	// 		}
	// 	}


	function postXero($url,$access_token,$tenant_id,$postData){
		$ch =  curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$postData);
		curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
			'Content-Type:application/json',
			'Authorization:Bearer '.$access_token,
			'Xero-tenant-id:'.$tenant_id
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		$server_output = curl_exec($ch);
		return $server_output;
	}

	function getXero($url,$access_token,$tenant_id){
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
           'Accept:application/json',
           'Authorization:Bearer '.$access_token,
           'Xero-tenant-id:'.$tenant_id
		));
		$server_output = curl_exec($ch);
		return $server_output;
	}

	function refreshXeroToken($access_token){

		$postData = "grant_type=refresh_token";
		$postData .= "&refresh_token=".$access_token;

		$url = "https://identity.xero.com/connect/token";
		$ch =  curl_init($url);
       	curl_setopt($ch, CURLOPT_URL,$url);
       	curl_setopt($ch, CURLOPT_POST,1);
       	curl_setopt($ch, CURLOPT_POSTFIELDS,$postData);
       	curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
           'Content-Type:application/x-www-form-urlencoded',
           'Authorization:Basic '.base64_encode(XERO_CLIENT_ID.":".XERO_CLIENT_SECRET)
       	));
       	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		$server_output = curl_exec($ch);
		return $server_output;
	}

	function postPayrunToXero($postData,$access_token,$tenant_id){
		$url = "https://api.xero.com/payroll.xro/1.0/PayRuns";
		$ch =  curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($postData));
		curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
			'Content-Type:application/json',
			'Authorization:Bearer '.$access_token,
			'Xero-tenant-id:'.$tenant_id
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		$server_output = curl_exec($ch);
		return $server_output;
	}

}
