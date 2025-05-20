<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Xero extends CI_Controller
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

	public function oauth()
	{
		$this->load->library('session');
		if ($this->session->has_userdata('centerid')) {
			$centerid = $this->session->userdata('centerid');
		}
		$code = $_GET['code'];
		$state = $_GET['state'];

		// $userid = $_GET['LoginId'];
		// 	if($userid == null) return;

		$userid = $this->session->userdata('LoginId');
		// $userid = ;
		$this->load->model('xeroModel');
		// $result = $this->xeroModel->getFromUserid($userid);

		if ($code != null && $state == $userid) {
			try {
				$postData = "code=" . $code;
				$postData .= "&grant_type=authorization_code";
				$postData .= "&redirect_uri=" . base_url() . "xero/oauth";

				$server_output = $this->postToken($postData);
				$json = json_decode($server_output);
				// var_dump($json);
				$access_token = $json->access_token;
				$id_token = $json->id_token;
				$refresh_token = $json->refresh_token;
				$expires_in = $json->expires_in;

				$tenant = $this->getTenant($access_token);
				// var_dump($tenant);die();
				$tjson = json_decode($tenant);
				// echo '<pre>'.print_r($tjson);
				// die();
				// So i need to search throught the database to find the tenants check generated tenat present in db or not. If present take the 0 index tenant id but If not present take new tenant id
				$dbxtenants = $this->xeroModel->getXTenants();
				// echo '<pre>'.print_r($dbxtenants);
				// die();
				$tenant_id = "";
				if(sizeof($tjson) == 1){
					$tenant_id = $tjson[0]->tenantId;
				}else{
					foreach($tjson as $key=>$val){
						$needle = $val->tenantId;
						if(!array_search($needle ,array_column($dbxtenants, 'tenant_id'))){
							$tenant_id = $needle;
						}
					}
				}
				// echo $tenant_id;
				// die();
				$this->xeroModel->insertNewToken($access_token, $refresh_token, $tenant_id, $expires_in, $centerid);

				$payItems = $this->getPayItems($access_token, $tenant_id);
				// var_dump($payItems);

				$this->load->model('payrollModel');
				//earning rates
				if (isset(json_decode($payItems)->PayItems->EarningsRates)) {
					$earningRates = json_decode($payItems)->PayItems->EarningsRates;
					$this->payrollModel->deleteAllPayrollShiftTypes($centerid);
					for ($i = 0; $i < count($earningRates); $i++) {
						$RateType = $earningRates[$i]->RateType;
						$EarningsRateID = $earningRates[$i]->EarningsRateID;
						$Name = addslashes($earningRates[$i]->Name);
						$EarningsType = $earningRates[$i]->EarningsType;
						$IsExemptFromTax = $earningRates[$i]->IsExemptFromTax ? "Y" : "N";
						$IsExemptFromSuper = $earningRates[$i]->IsExemptFromSuper ? "Y" : "N";
						$IsReportableAsW1 = $earningRates[$i]->IsReportableAsW1 ? "Y" : "N";
						$CurrentRecord = $earningRates[$i]->CurrentRecord ? "Y" : "N";
						if ($RateType == "FIXEDAMOUNT")
							$Multiplier_Amount = isset($earningRates[$i]->Amount) ? $earningRates[$i]->Amount : 0;
						else if ($RateType == "MULTIPLE")
							$Multiplier_Amount = $earningRates[$i]->Multiplier;
						else
							$Multiplier_Amount = 0;
						$this->payrollModel->insertPayrollShifts($EarningsRateID, $Name, $IsExemptFromTax, $IsExemptFromSuper, $IsReportableAsW1, $EarningsType, $RateType, $Multiplier_Amount, $CurrentRecord, $userid, $centerid);
					}
				}

				$this->load->model('leaveModel');
				//leave types
				if (isset(json_decode($payItems)->PayItems->LeaveTypes)) {
					$leaveTypes = json_decode($payItems)->PayItems->LeaveTypes;
					// $this->leaveModel->deleteAllLeaveTypes($centerid);
					for ($i = 0; $i < count($leaveTypes); $i++) {
						$LeaveTypeID = $leaveTypes[$i]->LeaveTypeID;
						$Name = addslashes($leaveTypes[$i]->Name);
						$IsPaidLeave = $leaveTypes[$i]->IsPaidLeave ? "Y" : "N";
						$ShowOnPayslip = $leaveTypes[$i]->ShowOnPayslip ? "Y" : "N";
						$CurrentRecord = $leaveTypes[$i]->CurrentRecord ? "Y" : "N";
						$slug = $Name[0];
						$this->leaveModel->createLeaveType($LeaveTypeID, $Name, $IsPaidLeave, $slug, $ShowOnPayslip, $CurrentRecord, $userid, $centerid);
					}
				}

				//superfunds
				$superFunds = $this->getSuperfunds($access_token, $tenant_id);
				if (isset(json_decode($superFunds)->SuperFunds)) {
					$superFunds = json_decode($superFunds)->SuperFunds;
					for ($i = 0; $i < count($superFunds); $i++) {
						$SuperFundID = $superFunds[$i]->SuperFundID;
						$Name = addslashes($superFunds[$i]->Name);
						$ABN = isset($superFunds[$i]->ABN) ? $superFunds[$i]->ABN : "";
						$BSB = isset($superFunds[$i]->BSB) ? $superFunds[$i]->BSB : "";
						$USI = isset($superFunds[$i]->USI) ? $superFunds[$i]->USI : "";
						$AccountNumber = isset($superFunds[$i]->AccountNumber) ? $superFunds[$i]->AccountNumber : "";
						$AccountName = isset($superFunds[$i]->AccountName) ? $superFunds[$i]->AccountName : "";
						$ElectronicServiceAddress = isset($superFunds[$i]->ElectronicServiceAddress) ? $superFunds[$i]->ElectronicServiceAddress : "";
						$EmployerNumber = $superFunds[$i]->EmployerNumber;
						$Type = $superFunds[$i]->Type;
						$this->payrollModel->insertSuperfund($SuperFundID, $ABN, $USI, $Type, $Name, $BSB, $AccountNumber, $AccountName, $ElectronicServiceAddress, $EmployerNumber, $userid, $centerid);
					}
				}
				//employees
				$employees = $this->getEmployees($access_token, $tenant_id);
				if (isset(json_decode($employees)->Employees)) {
					$employees = json_decode($employees)->Employees;

					$this->load->model('authModel');
					$this->load->model('employeeModel');

					for ($i = 0; $i < count($employees); $i++) {
						$employeeId = $employees[$i]->EmployeeID;
						$empDetails = $this->getCompleteEmployeeInfo($access_token, $tenant_id, $employeeId);
						$empDetails = json_decode($empDetails)->Employees[0];
						$Title = isset($empDetails->Title) ? $empDetails->Title : "";
						$FirstName = $empDetails->FirstName;
						$MiddleNames = isset($empDetails->MiddleNames) ? $empDetails->MiddleNames : "";
						$LastName = $empDetails->LastName;
						$Status = $empDetails->Status;
						$JobTitle = isset($empDetails->JobTitle) ? $empDetails->JobTitle : "";
						$Email = $empDetails->Email;
						preg_match('/([\d]{9})/', $empDetails->DateOfBirth, $matches);
						$DateOfBirth = date('Y-m-d', $matches[0]);
						$Gender = isset($empDetails->Gender) ? $empDetails->Gender : "F";
						$classification = isset($empDetails->Classification) ? $empDetails->Classification : "";
						$AddressLine1 = $empDetails->HomeAddress->AddressLine1;
						$AddressLine2 = isset($empDetails->HomeAddress->AddressLine2) ?  $empDetails->HomeAddress->AddressLine2 : "";
						$City = $empDetails->HomeAddress->City;
						$Region = $empDetails->HomeAddress->Region;
						$PostalCode = $empDetails->HomeAddress->PostalCode;
						$Country = $empDetails->HomeAddress->Country;
						$Phone = isset($empDetails->Phone) ? $empDetails->Phone : "";
						$Mobile = isset($empDetails->Mobile) ? $empDetails->Mobile : "";


						if (isset($empDetails->TerminationDate)) {
							preg_match('/([\d]{9})/', $empDetails->TerminationDate, $matches);
							$TerminationDate = date('Y-m-d', $matches[0]);
						} else {
							$TerminationDate = null;
						}
						if (isset($empDetails->StartDate)) {
							preg_match('/([\d]{9})/', $empDetails->StartDate, $matches);
							$StartDate = date('Y-m-d', $matches[0]);
						} else {
							$StartDate = null;
						}
						$OrdinaryEarningsRateID = isset($empDetails->OrdinaryEarningsRateID) ? $empDetails->OrdinaryEarningsRateID : "";
						$PayrollCalendarID = isset($empDetails->PayrollCalendarID) ? $empDetails->PayrollCalendarID : "";

						$myUser = $this->authModel->getUserFromEmail($Email);
						if ($myUser == null) {
							$password = $FirstName . $LastName . "@123";
							$myUserid = $this->authModel->insertUser($Email, $password, $FirstName . " " . $LastName, 4, $JobTitle, null, null, $userid, 0, 0, 0);
						} else {
							$myUserid = $myUser->id;
						}

						$myEmployee = $this->employeeModel->getUserFromId($myUserid);
						// echo "MyEmployeeId: ".$myUserid;
						// var_dump($myEmployee);
						// echo "\n\n";
						if ($myEmployee == null) {
							//insert 
							$this->employeeModel->insertEmployee($myUserid, $employeeId, $Title, $FirstName, $MiddleNames, $LastName, $Status, $Email, $DateOfBirth, $JobTitle, $Gender, $AddressLine1, $AddressLine2, $City, $Region, $PostalCode, $Country, $Phone, $Mobile, $StartDate, $TerminationDate, $OrdinaryEarningsRateID, $PayrollCalendarID, $userid, $classification);
						} else {
							//update
							$this->employeeModel->updateEmployee($employeeId, $Title, $FirstName, $MiddleNames, $LastName, $Status, $Email, $DateOfBirth, $JobTitle, $Gender, $AddressLine1, $AddressLine2, $City, $Region, $PostalCode, $Country, $Phone, $Mobile, $StartDate, $TerminationDate, $OrdinaryEarningsRateID, $PayrollCalendarID, $myUserid);
						}

						$this->employeeModel->deleteAllDetailsForUser($employeeId);

						//taxes

						$TaxFileNumber = isset($empDetails->TaxDeclaration->TaxFileNumber) ? $empDetails->TaxDeclaration->TaxFileNumber : "";
						$EmploymentBasis = isset($empDetails->TaxDeclaration->EmploymentBasis) ? $empDetails->TaxDeclaration->EmploymentBasis : "FULLTIME";
						$TFNExemptionType = isset($empDetails->TaxDeclaration->TFNExemptionType) ? $empDetails->TaxDeclaration->TFNExemptionType : "";
						$AustralianResidentForTaxPurposes = $empDetails->TaxDeclaration->AustralianResidentForTaxPurposes;
						$TaxFreeThresholdClaimed = $empDetails->TaxDeclaration->TaxFreeThresholdClaimed ? "Y" : "N";
						$HasHELPDebt = $empDetails->TaxDeclaration->HasHELPDebt ? "Y" : "N";
						$HasSFSSDebt = $empDetails->TaxDeclaration->HasSFSSDebt ? "Y" : "N";
						$EligibleToReceiveLeaveLoading = $empDetails->TaxDeclaration->EligibleToReceiveLeaveLoading ? "Y" : "N";
						$HasStudentStartupLoan = $empDetails->TaxDeclaration->HasStudentStartupLoan ? "Y" : "N";
						$ResidencyStatus = $empDetails->TaxDeclaration->ResidencyStatus;
						$TaxOffsetEstimatedAmount = isset($empDetails->TaxDeclaration->TaxOffsetEstimatedAmount) ? $empDetails->TaxDeclaration->TaxOffsetEstimatedAmount : 0;
						$UpwardVariationTaxWithholdingAmount = isset($empDetails->TaxDeclaration->UpwardVariationTaxWithholdingAmount) ? $empDetails->TaxDeclaration->UpwardVariationTaxWithholdingAmount : 0;
						$ApprovedWithholdingVariationPercentage = isset($empDetails->TaxDeclaration->ApprovedWithholdingVariationPercentage) ? $empDetails->TaxDeclaration->ApprovedWithholdingVariationPercentage : 0;

						$this->employeeModel->insertIntoTaxDeclaration($employeeId, $EmploymentBasis, $TFNExemptionType, $TaxFileNumber, $AustralianResidentForTaxPurposes, $ResidencyStatus, $TaxFreeThresholdClaimed, $TaxOffsetEstimatedAmount, $HasHELPDebt, $HasSFSSDebt, $HasStudentStartupLoan, $UpwardVariationTaxWithholdingAmount, $EligibleToReceiveLeaveLoading, $ApprovedWithholdingVariationPercentage);

						//bank accounts
						foreach ($empDetails->BankAccounts as $bankAccount) {
							$StatementText = addslashes($bankAccount->StatementText);
							$AccountName = addslashes($bankAccount->AccountName);
							$BSB = $bankAccount->BSB;
							$AccountNumber = $bankAccount->AccountNumber;
							$Remainder = $bankAccount->Remainder ? "Y" : "N";
							$Amount = isset($bankAccount->Amount) ? $bankAccount->Amount : 0;
							$this->employeeModel->insertIntoBankAccount($employeeId, $StatementText, $AccountName, $BSB, $AccountNumber, $Remainder, $Amount);
						}

						//super fund memberships
						foreach ($empDetails->SuperMemberships as $superMembership) {
							$SuperMembershipID = $superMembership->SuperMembershipID;
							$SuperFundID = $superMembership->SuperFundID;
							$EmployeeNumber = $superMembership->EmployeeNumber;
							$this->employeeModel->insertIntoSuperMembership($employeeId, $SuperFundID, $EmployeeNumber, $SuperMembershipID);
						}

						//leave balance
						$this->leaveModel->deleteAllUserLeaveBalance($myUserid);
						foreach ($empDetails->LeaveBalances	 as $leaveBalance) {
							$LeaveTypeID = $leaveBalance->LeaveTypeID;
							$leaveDets = $this->leaveModel->getLeaveTypeById($LeaveTypeID);
							$NumberOfUnits = $leaveBalance->NumberOfUnits;
							$this->leaveModel->insertIntoLeaveBalance($myUserid, $leaveDets->leaveid, $NumberOfUnits);
						}
					}
				}
				$data['Status'] = "SUCCESS";
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				$data['Status'] = "ERROR";
			}
			$this->load->view('afterIntegrationView', $data);
		}
	}


	public function syncXeroAwards($centerid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		//var_dump($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			//var_dump($json);
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$userid = $json->userid;
				$userDetails = $this->authModel->getUserDetails($userid);
				//var_dump($userDetails);
				if ($userDetails != null) {
					$this->load->model('xeroModel');
					$this->load->model('payrollModel');
					//xero 
					$xeroTokens = $this->xeroModel->getXeroToken($centerid);
					// var_dump($xeroTokens);
					// die();
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
							// NOTICE -- need to get the centerid
							$this->payrollModel->deleteAllPayrollShiftTypes($centerid);
							$earningRates = $val->PayItems->EarningsRates;
							// var_dump($earningRates);
							// die();
							for ($i = 0; $i < count($earningRates); $i++) {
								$RateType = $earningRates[$i]->RateType;
								$EarningsRateID = $earningRates[$i]->EarningsRateID;
								$Name = addslashes($earningRates[$i]->Name);
								$EarningsType = $earningRates[$i]->EarningsType;
								$IsExemptFromTax = $earningRates[$i]->IsExemptFromTax ? "Y" : "N";
								$IsExemptFromSuper = $earningRates[$i]->IsExemptFromSuper ? "Y" : "N";
								$IsReportableAsW1 = $earningRates[$i]->IsReportableAsW1 ? "Y" : "N";
								$CurrentRecord = $earningRates[$i]->CurrentRecord ? "Y" : "N";
								if ($RateType == "FIXEDAMOUNT")
									$Multiplier_Amount = isset($earningRates[$i]->Amount) ? $earningRates[$i]->Amount : 0;
								else if ($RateType == "MULTIPLE")
									$Multiplier_Amount = $earningRates[$i]->Multiplier;
								else
									$Multiplier_Amount = 0;
								// NOTICE -- need to get the centerid
								$this->payrollModel->insertPayrollShifts($EarningsRateID, $Name, $IsExemptFromTax, $IsExemptFromSuper, $IsReportableAsW1, $EarningsType, $RateType, $Multiplier_Amount, $CurrentRecord, $userid, $centerid);
							}
							$data['Status'] = 'SUCCESS';
						} else {
							$data['Status'] = "ERROR";
							$data['Message'] = "An unknown error occured";
						}
					}
				} else {

					$data['Status'] = 'ERROR';
					$data['Message'] = "You are not allowed";
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

	public function addXeroAwards(){
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		// print_r($headers);
		// die();
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			// var_dump($json);
			// die();
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$userid = $json->userid;
				$userDetails = $this->authModel->getUserDetails($userid);
				if($userDetails != null){
					$this->load->model('xeroModel');
					$this->load->model('payrollModel');
					//xero 
					$xeroTokens = $this->xeroModel->getXeroToken($json->centerid);
					// echo sizeof($xeroTokens);
					// die();
					if ($xeroTokens != null) {
						$access_token = $xeroTokens->access_token;
						$tenant_id = $xeroTokens->tenant_id;
						$refresh_token = $xeroTokens->refresh_token;

						$val = $this->getPayItems($access_token, $tenant_id);
						$val = json_decode($val);

						// print_r($val);
						// die();
						if ($val->Status == 401) {
							$refresh = $this->refreshXeroToken($refresh_token);
							$refresh = json_decode($refresh);
							$access_token = $refresh->access_token;
							$expires_in = $refresh->expires_in;
							$refresh_token = $refresh->refresh_token;
							$this->xeroModel->insertNewToken($access_token, $refresh_token, $tenant_id, $expires_in, $json->centerid);
							$val = $this->getPayItems($access_token, $tenant_id);
							$val = json_decode($val);
						}
						if ($val->Status == "OK") {
							//attach past earning rates to the newly added earning rates
							if($json->type == "ADD"){
								// NOTICE -- need to get the centerid
								$this->payrollModel->deleteAllPayrollShiftTypes($json->centerid);
								$earningRates = $val->PayItems->EarningsRates;
								// print_r($earningRates);
								// die();
								//attach this array and newly added array and push to new array
								$fer = json_encode($earningRates);
								$rfer = str_replace(array( '[', ']' ), '', $fer);
								// echo $rfer;
								
								
								if ($json->RateType == "FIXEDAMOUNT"){
									$Multiplier_Amount = $json->Amount;
									$newEarningRates = array(
										"Name"=>$json->Name,
										"AccountCode"=>"477",
										"RateType"=>$json->RateType,
										"Amount"=>$Multiplier_Amount,	
										"TypeOfUnits"=>$json->TypeOfUnits,
										"IsExemptFromTax"=>$json->IsExemptFromTax,
										"IsExemptFromSuper"=>$json->IsExemptFromSuper,
										"EarningsType"=>$json->EarningsType,
										"IsReportableAsW1"=>$json->IsReportableAsW1,
										"CurrentRecord"=>$json->CurrentRecord
									);
								}else if ($json->RateType == "MULTIPLE"){
									$Multiplier_Amount = $json->Multiplier;
									$newEarningRates = array(
										"Name"=>$json->Name,
										"AccountCode"=>"477",
										"RateType"=>$json->RateType,
										"Multiplier"=>$Multiplier_Amount,
										"AccrueLeave"=>false,	
										"TypeOfUnits"=>$json->TypeOfUnits,
										"IsExemptFromTax"=>$json->IsExemptFromTax,
										"IsExemptFromSuper"=>$json->IsExemptFromSuper,
										"EarningsType"=>$json->EarningsType,
										"IsReportableAsW1"=>$json->IsReportableAsW1,
										"CurrentRecord"=>$json->CurrentRecord
									);
								}else if($json->RateType == "RATEPERUNIT"){
									$Multiplier_Amount = $json->RatePerUnit;
									$newEarningRates = array(
										"Name"=>$json->Name,
										"AccountCode"=>"477",
										"RateType"=>$json->RateType,
										"RatePerUnit"=>$Multiplier_Amount,
										"TypeOfUnits"=>$json->TypeOfUnits,
										"IsExemptFromTax"=>$json->IsExemptFromTax,
										"IsExemptFromSuper"=>$json->IsExemptFromSuper,
										"EarningsType"=>$json->EarningsType,
										"IsReportableAsW1"=>$json->IsReportableAsW1,
										"CurrentRecord"=>$json->CurrentRecord
									);
								}

								if($json->EarningsType == "ALLOWANCE"){
									$newEarningRates['AllowanceType'] = $json->AllowanceType;
								}
								

								$encodedne = json_encode($newEarningRates);

								$fstring = '{ "EarningsRates" : ['.$rfer.','.$encodedne.']}';
								$fr = json_decode($fstring,true);
								// print_r($fr);
								// die();

							}else if($json->type == "DEL"){

								$deletedAwardDataArray = array();
								for ($i = 0; $i < count($json->fidaafdel); $i++) {
									$RateType = $json->fidaafdel[$i]->rateType;
									$EarningsRateID = $json->fidaafdel[$i]->earningRateId;
									$Name = $json->fidaafdel[$i]->name;
									$EarningsType = $json->fidaafdel[$i]->earningType;
									$IsExemptFromTax = $json->fidaafdel[$i]->isExemptFromTaxYN == "Y" ? true : false;
									$IsExemptFromSuper = $json->fidaafdel[$i]->isExemptFromSuperYN == "Y" ? true : false;
									$IsReportableAsW1 = $json->fidaafdel[$i]->isReportableAsW1 == "Y" ? true : false;
									$CurrentRecord = isset($json->fidaafdel[$i]->currentRecordYN) ? true : false;
									$Multiplier_Amount = $json->fidaafdel[$i]->multiplier_amount;

									$deletedAwardDataArray[] = array(
										"EarningsRateID"=>$EarningsRateID,
										"Name"=>$Name,
										"EarningsType"=>$EarningsType,
										"IsExemptFromTax"=>$IsExemptFromTax,
										"IsExemptFromSuper"=>$IsExemptFromSuper,
										"IsReportableAsW1"=>$IsReportableAsW1,
										"RateType"=>$RateType,
										"CurrentRecord"=>$CurrentRecord,
										"Multiplier"=>$Multiplier_Amount
									);

								}
								$encodedne = json_encode($deletedAwardDataArray);

								$fstring = '{ "EarningsRates" : '.$encodedne.' }';
								$fr = json_decode($fstring,true);
								// echo $fr;
								// die();

							}else if($json->type == "EDI"){

								$updatedAwardDataArray = array();
								for ($i = 0; $i < count($json->existeddata); $i++) {
									$RateType = $json->existeddata[$i]->rateType;
									$EarningsRateID = $json->existeddata[$i]->earningRateId;
									$Name = $json->existeddata[$i]->name;
									$EarningsType = $json->existeddata[$i]->earningType;
									$IsExemptFromTax = $json->existeddata[$i]->isExemptFromTaxYN == "Y" ? "true" : "false";
									$IsExemptFromSuper = $json->existeddata[$i]->isExemptFromSuperYN == "Y" ?  "true" : "false";
									$IsReportableAsW1 = $json->existeddata[$i]->isReportableAsW1 == "Y" ?  "true" : "false";
									$CurrentRecord = $json->existeddata[$i]->currentRecordYN == "Y" ?  "true" : "false";
									$TypeofUnits = $json->existeddata[$i]->TypeOfUnits == "" ? "Hours" : $json->existeddata[$i]->TypeOfUnits;

									if ($RateType == "FIXEDAMOUNT"){
										$Multiplier_Amount = isset($json->existeddata[$i]->Amount) ? $json->existeddata[$i]->Amount : 0;
									}else if ($RateType == "MULTIPLE"){
										$Multiplier_Amount = isset($json->existeddata[$i]->Multiplier) ? $json->existeddata[$i]->Multiplier : 0;
									}else if($RateType == "RATEPERUNIT"){
										$Multiplier_Amount = isset($json->existeddata[$i]->RatePerUnit) ? $json->existeddata[$i]->RatePerUnit : 0;
									}

									$updatedAwardDataArray[] = array(
										"EarningsRateID"=>$EarningsRateID,
										"Name"=>$Name,
										"AccountCode"=>"477",
										"RateType"=>$RateType,

										"Amount"=>$Multiplier_Amount,
										"Multiplier"=>$Multiplier_Amount,
										"RatePerUnit"=>$Multiplier_Amount,

										"TypeOfUnits"=>$TypeofUnits,
										"EarningsType"=>$EarningsType,
										"IsExemptFromTax"=>$IsExemptFromTax,
										"IsExemptFromSuper"=>$IsExemptFromSuper,
										"IsReportableAsW1"=>$IsReportableAsW1,
										"CurrentRecord"=>$CurrentRecord

									);

								}
								// $encodedne = json_encode($updatedAwardDataArray);
								$fer = json_encode($updatedAwardDataArray);
								$rfer = str_replace(array( '[', ']' ), '', $fer);

								// echo gettype($existeddata);
								// exit();
								// print_r($existeddata);
								

								if ($json->RateType == "FIXEDAMOUNT"){
									$Multiplier_Amount = isset($json->Amount) ? $json->Amount : 0;
								}else if ($json->RateType == "MULTIPLE"){
									$Multiplier_Amount = $json->Multiplier;
								}else if($json->RateType == "RATEPERUNIT"){
									$Multiplier_Amount = $json->RatePerUnit;
								}
								
								$updatedNewAwardDataArray = array(
									"EarningsRateID"=>$json->EarningsRateID,
									"Name"=>$json->Name,
									"AccountCode"=>"477",
									"RateType"=>$json->RateType,

									"Amount"=>$Multiplier_Amount,
									"Multiplier"=>$Multiplier_Amount,
									"RatePerUnit"=>$Multiplier_Amount,

									"TypeOfUnits"=>$json->TypeOfUnits,
									"IsExemptFromTax"=>$json->IsExemptFromTax,
									"IsExemptFromSuper"=>$json->IsExemptFromSuper,
									"EarningsType"=>$json->EarningsType,
									"IsReportableAsW1"=>$json->IsReportableAsW1,
									"CurrentRecord"=>$json->CurrentRecord
								);

								$newencodedne = json_encode($updatedNewAwardDataArray);
								// echo $newencodedne;
								// exit();

								$fstring = '{ "EarningsRates" : ['.$rfer.','.$newencodedne.']}';
								// echo $fstring;
								$fr = json_decode($fstring,true);
								

								// print_r($fr);
								// die();

								// echo $rfer;


							}

							$finalval = $this->postAwardsToXero($access_token,$tenant_id,$fr);
							echo json_decode($finalval);

							// echo '<pre>';
							// echo $fstring;
							// echo '</pre>';

						} else {
							$data['Status'] = "ERROR";
							$data['Message'] = "An unknown error occured";
							http_response_code(403);
							echo json_encode($data);
						}


					}else{
						$data['Status'] = 'ERROR';
						$data['Message'] = "You are not allowed. No Xero Token Available";
						http_response_code(403);
						echo json_encode($data);
					}
				}else{
					$data['Status'] = 'ERROR';
					$data['Message'] = "You are not allowed3";
					http_response_code(403);
					echo json_encode($data);
				}
			}else{
				$data['Status'] = 'ERROR';
				$data['Message'] = "You are not allowed2";
				http_response_code(401);
				echo json_encode($data);
			}
		}else{
			$data['Status'] = 'ERROR';
			$data['Message'] = "You are not allowed1";
			http_response_code(401);
			echo json_encode($data);
		}

	}
	function postAwardsToXero($access_token, $tenant_id, $data)
	{
		// echo json_encode($data);
		// die();
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
		// print_r($server_output);
		// die();
		// header('Content-Type: application/json');
		// echo json_encode($server_output);
		$xml = simplexml_load_string($server_output);
		$json = json_encode($xml);
		// $array = json_decode($json,TRUE);
		// echo $arra
		echo $json;
		exit();

	}

	public function syncXeroLeaves($centerid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$userid = $json->userid;
				$userDetails = $this->authModel->getUserDetails($userid);
				if ($userDetails != null) {
					$this->load->model('xeroModel');
					$this->load->model('leaveModel');
					//xero 
					$xeroTokens = $this->xeroModel->getXeroToken($centerid);
					// var_dump($xeroTokens);
					// die();
					if ($xeroTokens != null) {
						$access_token = $xeroTokens->access_token;
						$tenant_id = $xeroTokens->tenant_id;
						$refresh_token = $xeroTokens->refresh_token;
						$val = $this->getPayItems($access_token, $tenant_id);
						$val = json_decode($val);
						if ($val->Status == 401) {
							$refresh = $this->refreshXeroToken($refresh_token);
							// var_dump($refresh);
							$refresh = json_decode($refresh);
							$access_token = $refresh->access_token;
							$expires_in = $refresh->expires_in;
							$refresh_token = $refresh->refresh_token;
							$this->xeroModel->insertNewToken($access_token, $refresh_token, $tenant_id, $expires_in, $centerid);
							$val = $this->getPayItems($access_token, $tenant_id);
							$val = json_decode($val);
						}
						// var_dump($val);
						// die();
						if ($val->Status == "OK") {
							$leaveTypes = $val->PayItems->LeaveTypes;
							// var_dump($leaveTypes);
							// die();
							// NOTICE -- need to get the centerid
							$this->leaveModel->deleteAllLeaveTypes($centerid);
							for ($i = 0; $i < count($leaveTypes); $i++) {
								$LeaveTypeID = $leaveTypes[$i]->LeaveTypeID;
								$Name = addslashes($leaveTypes[$i]->Name);
								$IsPaidLeave = $leaveTypes[$i]->IsPaidLeave == true ? "Y" : "N";
								$ShowOnPayslip = $leaveTypes[$i]->ShowOnPayslip == true ? "Y" : "N";
								$CurrentRecord = $leaveTypes[$i]->CurrentRecord == true ? "Y" : "N";
								$slug = $Name[0];
								// NOTICE -- need to get the centerid
								$this->leaveModel->createLeaveType($LeaveTypeID, $Name, $IsPaidLeave, $slug, $ShowOnPayslip, $CurrentRecord, $userid, $centerid);
							}
							$data['Status'] = 'SUCCESS';
							http_response_code(200);
							echo json_encode($data);
						} else {
							$data['Status'] = "ERROR";
							$data['Message'] = "An unknown error occured";
							http_response_code(401);
							echo json_encode($data);
						}
					}
				} else {

					$data['Status'] = 'ERROR';
					$data['Message'] = "You are not allowed";
					http_response_code(401);
					echo json_encode($data);
				}
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function syncXeroSuperfunds($centerid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$userid = $json->userid;
				$userDetails = $this->authModel->getUserDetails($userid);
				if ($userDetails != null) {
					$this->load->model('xeroModel');
					$this->load->model('payrollModel');
					//xero 
					$xeroTokens = $this->xeroModel->getXeroToken($centerid);
					if ($xeroTokens != null) {
						$access_token = $xeroTokens->access_token;
						$tenant_id = $xeroTokens->tenant_id;
						$refresh_token = $xeroTokens->refresh_token;
						$val = $this->getSuperfunds($access_token, $tenant_id);
						$val = json_decode($val);
						if ($val->Status == 401) {
							$refresh = $this->refreshXeroToken($refresh_token);
							$refresh = json_decode($refresh);
							$access_token = $refresh->access_token;
							$expires_in = $refresh->expires_in;
							$refresh_token = $refresh->refresh_token;
							$this->xeroModel->insertNewToken($access_token, $refresh_token, $tenant_id, $expires_in, $centerid);
							$val = $this->getSuperfunds($access_token, $tenant_id);
							$val = json_decode($val);
						}


						if ($val->Status == "OK") {
							$superFunds = $val->SuperFunds;
							$this->payrollModel->deleteAllSuperFunds($centerid);
							for ($i = 0; $i < count($superFunds); $i++) {
								$SuperFundID = $superFunds[$i]->SuperFundID;
								$Name = addslashes($superFunds[$i]->Name);
								$ABN = isset($superFunds[$i]->ABN) ? $superFunds[$i]->ABN : "";
								$BSB = isset($superFunds[$i]->BSB) ? $superFunds[$i]->BSB : "";
								$USI = isset($superFunds[$i]->USI) ? $superFunds[$i]->USI : "";
								$AccountNumber = isset($superFunds[$i]->AccountNumber) ? $superFunds[$i]->AccountNumber : "";
								$AccountName = isset($superFunds[$i]->AccountName) ? $superFunds[$i]->AccountName : "";
								$ElectronicServiceAddress = isset($superFunds[$i]->ElectronicServiceAddress) ? $superFunds[$i]->ElectronicServiceAddress : "";
								$EmployerNumber = isset($superFunds[$i]->EmployerNumber) ? $superFunds[$i]->EmployerNumber : "";
								$Type = $superFunds[$i]->Type;
								// NOTICE -- need to get the centerid
								$this->payrollModel->insertSuperfund($SuperFundID, $ABN, $USI, $Type, addslashes($Name), $BSB, $AccountNumber, $AccountName, $ElectronicServiceAddress, $EmployerNumber, $userid, $centerid);
							}
							$data['Status'] = 'SUCCESS';
						} else {
							$data['Status'] = "ERROR";
							$data['Message'] = "An unknown error occured";
						}
					}
				} else {

					$data['Status'] = 'ERROR';
					$data['Message'] = "You are not allowed";
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

	// I need a employeeId , centerid , 
	// If I pass a centerid I need its access tokens

	public function syncXeroEmployees($empId = null)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		// var_dump($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('employeeModel');
			$this->load->model('xeroModel');
			$this->load->model('settingsModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			// var_dump($res);
			$json = json_decode(file_get_contents('php://input'));
			
			if (!isset($json->centerid)) {
				$employeeCenter = $this->settingsModel->getUserCenters($empId);
				$centers = $employeeCenter;
				$employeeId = $this->settingsModel->getXeroEmployeeId($empId);
				if($employeeId != null){
					foreach ($centers as $center) {
						$this->xeroToken($res->userid,$center->centerid, $employeeId);
					}
				}
			}
			if (isset($json->centerid) && ($json->centerid != null && $json->centerid != "")) {
				$centerid = $json->centerid;
				$this->xeroToken($res->userid,$centerid);
			}
		}
	}


	function xeroToken($userid,$centerid, $empId = null)
	{
		$xeroTokens = $this->xeroModel->getXeroToken($centerid);
		// var_dump($xeroTokens);
		// die();
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
			// var_dump($val);
			// die();
			if ($val->Status == "OK") {
				//employees
				$employees = $this->getEmployees($access_token, $tenant_id, $empId);
				// print_r($employees);
				// die();
				$employees = json_decode($employees)->Employees;
				// print_r($employees);
				// die();
				for ($i = 0; $i < count($employees); $i++) {
					$employeeId = $employees[$i]->EmployeeID;
					$empDetails = $this->getCompleteEmployeeInfo($access_token, $tenant_id, $employeeId);

					$empDetails = json_decode($empDetails)->Employees[0];

					$Title = isset($empDetails->Title) ? $empDetails->Title : "";
					$FirstName = $empDetails->FirstName;
					$MiddleNames = isset($empDetails->MiddleNames) ? $empDetails->MiddleNames : "";
					$LastName = $empDetails->LastName;
					$Status = $empDetails->Status;
					$JobTitle = isset($empDetails->JobTitle) ? $empDetails->JobTitle : "";
					$Email = $empDetails->Email;
					preg_match('/([\d]{9})/', $empDetails->DateOfBirth, $matches);
					$DateOfBirth = date('Y-m-d', $matches[0]);
					$Gender = $empDetails->Gender;
					// $classification = $empDetails->Classification;
					$AddressLine1 = $empDetails->HomeAddress->AddressLine1;
					$AddressLine2 = isset($empDetails->HomeAddress->AddressLine2) ? $empDetails->HomeAddress->AddressLine2 : "";
					$City = $empDetails->HomeAddress->City;
					$Region = $empDetails->HomeAddress->Region;
					$PostalCode = $empDetails->HomeAddress->PostalCode;
					$Country = $empDetails->HomeAddress->Country;
					$Phone = isset($empDetails->Phone) ? $empDetails->Phone : "";
					$Mobile = isset($empDetails->Mobile) ? $empDetails->Mobile : "";
					if (isset($empDetails->TerminationDate)) {
						preg_match('/([\d]{9})/', $empDetails->TerminationDate, $matches);
						$TerminationDate = date('Y-m-d', $matches[0]);
					} else {
						$TerminationDate = null;
					}
					if (isset($empDetails->StartDate)) {
						preg_match('/([\d]{9})/', $empDetails->StartDate, $matches);
						$StartDate = date('Y-m-d', $matches[0]);
					} else {
						$StartDate = null;
					}
					$OrdinaryEarningsRateID = isset($empDetails->OrdinaryEarningsRateID) ? $empDetails->OrdinaryEarningsRateID : "";
					$PayrollCalendarID = isset($empDetails->PayrollCalendarID) ? $empDetails->PayrollCalendarID : "";
					$myUser = $this->authModel->getUserFromEmail($Email);
					// echo $myUser."RohitU";
					// die();
					if ($myUser == null) {
						$password = $FirstName . $LastName . "@123";
						$myUserid = $this->authModel->insertUser($Email, $password, $FirstName . " " . $LastName, 4, $JobTitle, null, null, $userid, 0, 0, 0);
						// Add to user center table
						$this->authModel->addToUserCenters($myUserid,$centerid);
					} else {
						$myUserid = $myUser->id;
					}
					$myEmployee = $this->employeeModel->getUserFromId($myUserid);
					// echo $myEmployee."RohitE";
					// die();
					if ($myEmployee == null) {
						//insert 
						$this->employeeModel->insertEmployee($myUserid, $employeeId, $Title, $FirstName, $MiddleNames, $LastName, $Status, $Email, $DateOfBirth, $JobTitle, $Gender, $AddressLine1, $AddressLine2, $City, $Region, $PostalCode, $Country, $Phone, $Mobile, $StartDate, $TerminationDate, $OrdinaryEarningsRateID, $PayrollCalendarID, $userid, '');
					} else {
						//update
						$this->employeeModel->updateEmployee($employeeId, $Title, $FirstName, $MiddleNames, $LastName, $Status, $Email, $DateOfBirth, $JobTitle, $Gender, $AddressLine1, $AddressLine2, $City, $Region, $PostalCode, $Country, $Phone, $Mobile, $StartDate, $TerminationDate, $OrdinaryEarningsRateID, $PayrollCalendarID, $myUserid);
						$this->employeeModel->deleteAllDetailsForUser($employeeId);
					}


					//taxes

					$TaxFileNumber = isset($empDetails->TaxDeclaration->TaxFileNumber) ? $empDetails->TaxDeclaration->TaxFileNumber : "";
					$EmploymentBasis = $empDetails->TaxDeclaration->EmploymentBasis;
					$TFNExemptionType = isset($empDetails->TaxDeclaration->TFNExemptionType) ? $empDetails->TaxDeclaration->TFNExemptionType : "";
					$AustralianResidentForTaxPurposes = $empDetails->TaxDeclaration->AustralianResidentForTaxPurposes;
					$TaxFreeThresholdClaimed = $empDetails->TaxDeclaration->TaxFreeThresholdClaimed ? "Y" : "N";
					$HasHELPDebt = $empDetails->TaxDeclaration->HasHELPDebt ? "Y" : "N";
					$HasSFSSDebt = $empDetails->TaxDeclaration->HasSFSSDebt ? "Y" : "N";
					$EligibleToReceiveLeaveLoading = $empDetails->TaxDeclaration->EligibleToReceiveLeaveLoading ? "Y" : "N";
					$HasStudentStartupLoan = $empDetails->TaxDeclaration->HasStudentStartupLoan ? "Y" : "N";
					$ResidencyStatus = $empDetails->TaxDeclaration->ResidencyStatus;
					$TaxOffsetEstimatedAmount = isset($empDetails->TaxDeclaration->TaxOffsetEstimatedAmount) ? $empDetails->TaxDeclaration->TaxOffsetEstimatedAmount : 0;
					$UpwardVariationTaxWithholdingAmount = isset($empDetails->TaxDeclaration->UpwardVariationTaxWithholdingAmount) ? $empDetails->TaxDeclaration->UpwardVariationTaxWithholdingAmount : 0;
					$ApprovedWithholdingVariationPercentage = isset($empDetails->TaxDeclaration->ApprovedWithholdingVariationPercentage) ? $empDetails->TaxDeclaration->ApprovedWithholdingVariationPercentage : 0;

					$this->employeeModel->insertIntoTaxDeclaration($employeeId, $EmploymentBasis, $TFNExemptionType, $TaxFileNumber, $AustralianResidentForTaxPurposes, $ResidencyStatus, $TaxFreeThresholdClaimed, $TaxOffsetEstimatedAmount, $HasHELPDebt, $HasSFSSDebt, $HasStudentStartupLoan, $UpwardVariationTaxWithholdingAmount, $EligibleToReceiveLeaveLoading, $ApprovedWithholdingVariationPercentage);

					//bank accounts
					foreach ($empDetails->BankAccounts as $bankAccount) {
						$StatementText = addslashes($bankAccount->StatementText);
						$AccountName = addslashes($bankAccount->AccountName);
						$BSB = $bankAccount->BSB;
						$AccountNumber = $bankAccount->AccountNumber;
						$Remainder = $bankAccount->Remainder ? "Y" : "N";
						$Amount = isset($bankAccount->Amount) ? $bankAccount->Amount : 0;
						$this->employeeModel->insertIntoBankAccount($employeeId, $StatementText, $AccountName, $BSB, $AccountNumber, $Remainder, $Amount);
					}

					//super fund memberships
					foreach ($empDetails->SuperMemberships as $superMembership) {
						$SuperMembershipID = $superMembership->SuperMembershipID;
						$SuperFundID = $superMembership->SuperFundID;
						$EmployeeNumber = $superMembership->EmployeeNumber;
						$this->employeeModel->insertIntoSuperMembership($employeeId, $SuperFundID, $EmployeeNumber, $SuperMembershipID);
					}

					//leave balance
					$this->load->model('leaveModel');
					$this->leaveModel->deleteAllUserLeaveBalance($myUserid);
					foreach ($empDetails->LeaveBalances	 as $leaveBalance) {
						$LeaveTypeID = $leaveBalance->LeaveTypeID;
						$NumberOfUnits = $leaveBalance->NumberOfUnits;
						$this->leaveModel->insertIntoLeaveBalance($myUserid, $LeaveTypeID, $NumberOfUnits);
					}
				}
			}
		}
	}

	public function fetchXeroToken($userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('settingsModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('xeroModel');
				$userDetails = $this->authModel->getUserDetails($userid);
				// $userDetails = $userDetails->center;
				// $userCenters = explode("|", $userDetails);
				$userDetails = $this->xeroModel->getUserCenters($userid);
				$data['center'] = [];
				$i = 0;
				foreach ($userDetails as $center) {
					if ($center != "") {
						$data['center'][$i] = [];
						array_push($data['center'][$i], $this->xeroModel->fetchXeroToken($center->centerid));
						array_push($data['center'][$i], $center);
						$i++;
					}
				}
			}
			http_response_code(200);
			echo json_encode($data);
		} else {
			http_response_code(401);
		}
	}


	function postToken($postData)
	{
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


	function getTenant($access_token)
	{
		$url = "https://api.xero.com/connections";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type:application/json',
			'Authorization:Bearer ' . $access_token
		));
		$server_output = curl_exec($ch);
		return $server_output;
	}

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

	function getSuperfunds($access_token, $tenant_id)
	{
		$url = "https://api.xero.com/payroll.xro/1.0/SuperFunds";
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

	function getCompleteEmployeeInfo($access_token, $tenant_id, $employeeId)
	{
		$url = "https://api.xero.com/payroll.xro/1.0/Employees/" . $employeeId;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Accept:application/json',
			'Authorization:Bearer ' . $access_token,
			'Xero-tenant-id:' . $tenant_id
		));
		set_time_limit(60);
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

	public function startOauth($userid, $centerid)
	{
		$client_id = XERO_CLIENT_ID;
		$redirect_uri = base_url() . "xero/oauth";
		$this->load->library('session');
		$this->session->set_userdata('centerid', $centerid);
		$this->session->set_userdata('LoginId', $userid);
		//$userid = $this->session->userdata('LoginId');
		// $userid = "123";

		$url = "https://login.xero.com/identity/connect/authorize?response_type=code&client_id=" . $client_id . "&redirect_uri=" . $redirect_uri . "&scope=openid offline_access profile email payroll.employees payroll.payruns payroll.payslip payroll.timesheets payroll.settings&state=" . $userid;
		header('Location: ' . $url);
	}
}
