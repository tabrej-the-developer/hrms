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

				$access_token = $json->access_token;
				$id_token = $json->id_token;
				$refresh_token = $json->refresh_token;
				$expires_in = $json->expires_in;

				$tenant = $this->getTenant($access_token);
				// var_dump($tenant);
				$tjson = json_decode($tenant);
				$tenant_id = $tjson[0]->tenantId;

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
							$this->leaveModel->insertIntoLeaveBalance($myUserid, $leaveDets->id, $NumberOfUnits);
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
					var_dump($xeroTokens);
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
						var_dump($val);

						if ($val->Status == "OK") {
							// NOTICE -- need to get the centerid
							$this->payrollModel->deleteAllPayrollShiftTypes($centerid);
							$earningRates = $val->PayItems->EarningsRates;
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
						if ($val->Status == "OK") {
							$leaveTypes = $val->PayItems->LeaveTypes;
							// var_dump($leaveTypes);
							// NOTICE -- need to get the centerid
							// $this->leaveModel->deleteAllLeaveTypes($centerid);
							for ($i = 0; $i < count($leaveTypes); $i++) {
								$LeaveTypeID = $leaveTypes[$i]->LeaveTypeID;
								$Name = addslashes($leaveTypes[$i]->Name);
								$IsPaidLeave = $leaveTypes[$i]->IsPaidLeave ? "Y" : "N";
								$ShowOnPayslip = $leaveTypes[$i]->ShowOnPayslip ? "Y" : "N";
								$CurrentRecord = $leaveTypes[$i]->CurrentRecord ? "Y" : "N";
								$slug = $Name[0];
								// NOTICE -- need to get the centerid
								$this->leaveModel->createLeaveType($LeaveTypeID, $Name, $IsPaidLeave, $slug, $ShowOnPayslip, $CurrentRecord, $userid, $centerid);
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
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$this->load->model('employeeModel');
			$this->load->model('xeroModel');
			$this->load->model('settingsModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));

			if (!isset($json->centerid)) {
				$employeeCenter = $this->settingsModel->getUserCenters($empId);
				$centers = $employeeCenter;
				foreach ($centers as $center) {
					$this->xeroToken($center->centerid, $empId);
				}
			}
			if (isset($json->centerid) && ($json->centerid != null && $json->centerid != "")) {
				$centerid = $json->centerid;
				$this->xeroToken($centerid);
			}
		}
	}
	function xeroToken($centerid, $empId = null)
	{
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
				//employees
				$employees = $this->getEmployees($access_token, $tenant_id, $empId);
				$employees = json_decode($employees)->Employees;
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
					if ($myUser == null) {
						$password = $FirstName . $LastName . "@123";
						$myUserid = $this->authModel->insertUser($Email, $password, $FirstName . " " . $LastName, 4, $JobTitle, null, null, $userid, 0, 0, 0);
					} else {
						$myUserid = $myUser->id;
					}
					$myEmployee = $this->employeeModel->getUserFromId($myUserid);
					if ($myEmployee == null) {
						//insert 
						$this->employeeModel->insertEmployee($myUserid, $employeeId, $Title, $FirstName, $MiddleNames, $LastName, $Status, $Email, $DateOfBirth, $JobTitle, $Gender, $AddressLine1, $AddressLine2, $City, $Region, $PostalCode, $Country, $Phone, $Mobile, $StartDate, $TerminationDate, $OrdinaryEarningsRateID, $PayrollCalendarID, $userid, $classification);
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
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
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
