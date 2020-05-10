<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xero extends CI_Controller{

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

	public function oauth(){

		$code = $_GET['code'];
		$state = $_GET['state'];

		//$userid = $this->session->userdata('LoginId');
		$userid = "123";
		$this->load->model('xeroModel');
		// $result = $this->xeroModel->getFromUserid($userid);

		if($code != null && $state == $userid){
			$postData = "code=".$code;
			$postData .= "&grant_type=authorization_code";
			$postData .= "&redirect_uri=".base_url()."xero/oauth";

	        $server_output = $this->postToken($postData);
			$json = json_decode($server_output);
			
			$access_token = $json->access_token;
			$id_token = $json->id_token;
			$expires_in = $json->expires_in;

			$tenant = $this->getTenant($access_token);
			$tjson = json_decode($tenant);
			$tenant_id = $tjson[0]->tenantId;

			$this->xeroModel->insertNewToken($access_token,$tenant_id,$expires_in);

			// $access_token = "eyJhbGciOiJSUzI1NiIsImtpZCI6IjFDQUY4RTY2NzcyRDZEQzAyOEQ2NzI2RkQwMjYxNTgxNTcwRUZDMTkiLCJ0eXAiOiJKV1QiLCJ4NXQiOiJISy1PWm5jdGJjQW8xbkp2MENZVmdWY09fQmsifQ.eyJuYmYiOjE1ODkwNzg4MjUsImV4cCI6MTU4OTA4MDYyNSwiaXNzIjoiaHR0cHM6Ly9pZGVudGl0eS54ZXJvLmNvbSIsImF1ZCI6Imh0dHBzOi8vaWRlbnRpdHkueGVyby5jb20vcmVzb3VyY2VzIiwiY2xpZW50X2lkIjoiRTJGRTBENEUwMzM1NDFFOTlFNkRBOTRBMjVFRjk1RjEiLCJzdWIiOiJhMmJjZTkyZGM4NjI1OTM3OWU0MzVmOGFlOGJhMjgxZSIsImF1dGhfdGltZSI6MTU4OTA3ODgxMCwieGVyb191c2VyaWQiOiJhODBiYmJlMS0yODIxLTQ0ODgtODNjMC0xZmUyYTQxNjdjZjciLCJnbG9iYWxfc2Vzc2lvbl9pZCI6ImVkMjFiNDdiMjIyYzQzNGJiMGE2YjJiYTZhN2EwYmJkIiwianRpIjoiY2Q4YTdiMDU4YWY5MTM0NmZjZWEwNTBmNjYzY2I4ZWQiLCJzY29wZSI6WyJlbWFpbCIsInByb2ZpbGUiLCJvcGVuaWQiLCJwYXlyb2xsLmVtcGxveWVlcyIsInBheXJvbGwucGF5cnVucyIsInBheXJvbGwucGF5c2xpcCIsInBheXJvbGwudGltZXNoZWV0cyIsInBheXJvbGwuc2V0dGluZ3MiXX0.v2ta1eohju3Z1p1W0LjtSHcWyY0rWJnzJW3bFC25F2sb_ifuL-UMlj9VMwBD4ciHISnVP32mdstVyab1q1ZTqn27SggEYqY51F9QxIo_F719aWr-ZvJXWGWjD59NFbv4v3794U1d8YjhghP0qW_yvDtXMvKMav9_Gp7UUhRNbH6hkDmdzWR4MpWwXDVyylgztLIezwhxX84uRwmHtjMO763I2vhO8Nuuuplrzc0Zj7x_o7AkMOgn9YMqaSSSJnhgGokIUumhAI7nfT-fQjkhAlT3PVp2PznQGr5HU_A41qgPscFMd30c9JTPmLZp2kjskwbi3ftUucIrKTXdQ-B_cg";

			// $tenant_id = "672f5e44-4e79-4a2f-9a5e-94fadb2bbbbd";

			$payItems = $this->getPayItems($access_token,$tenant_id);

			$this->load->model('payrollModel');
			//earning rates
			$earningRates = json_decode($payItems)->PayItems->EarningsRates;
			for($i = 0; $i < count($earningRates); $i++){
				$RateType = $earningRates[$i]->RateType;
				if($RateType != "RATEPERUNIT"){
					$EarningsRateID = $earningRates[$i]->EarningsRateID;
					$Name = addslashes($earningRates[$i]->Name);
					$EarningsType = $earningRates[$i]->EarningsType;
					$IsExemptFromTax = $earningRates[$i]->IsExemptFromTax ? "Y" : "N";
					$IsExemptFromSuper = $earningRates[$i]->IsExemptFromSuper ? "Y" : "N";
					$IsReportableAsW1 = $earningRates[$i]->IsReportableAsW1 ? "Y" : "N";
					$CurrentRecord = $earningRates[$i]->CurrentRecord ? "Y" : "N";
					if($RateType == "FIXEDAMOUNT")
						$Multiplier_Amount = isset($earningRates[$i]->Amount) ? $earningRates[$i]->Amount : 0;
					else
						$Multiplier_Amount = $earningRates[$i]->Multiplier;
					$this->payrollModel->insertPayrollShifts($EarningsRateID,$Name,$IsExemptFromTax,$IsExemptFromSuper,$IsReportableAsW1,$EarningsType,$RateType,$Multiplier_Amount,$CurrentRecord,$userid);
				}
			}

			$this->load->model('leaveModel');
			//leave types
			$leaveTypes = json_decode($payItems)->PayItems->LeaveTypes;
			$this->leaveModel->deleteAllLeaveTypes();
			for($i=0;$i<count($leaveTypes);$i++){
				$LeaveTypeID = $leaveTypes[$i]->LeaveTypeID;
				$Name = addslashes($leaveTypes[$i]->Name);
				$IsPaidLeave = $leaveTypes[$i]->IsPaidLeave ? "Y" : "N";
				$ShowOnPayslip = $leaveTypes[$i]->ShowOnPayslip ? "Y" : "N";
				$CurrentRecord = $leaveTypes[$i]->CurrentRecord ? "Y" : "N";
				$slug = $Name[0];
 				$this->leaveModel->createLeaveType($LeaveTypeID,$Name,$IsPaidLeave,$slug,$ShowOnPayslip,$CurrentRecord,$userid);
			}


			$superFunds = $this->getSuperfunds($access_token,$tenant_id);
			$superFunds = json_decode($superFunds)->SuperFunds;
			for($i=0;$i<count($superFunds);$i++){
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
				$this->payrollModel->insertSuperfund($ABN,$USI,$Type,$Name,$BSB,$AccountNumber,$AccountName,$ElectronicServiceAddress,$EmployerNumber,$userid);
			}

			$employees = $this->getEmployees($access_token,$tenant_id);
			$employees = json_decode($employees)->Employees;
			
			$this->load->model('authModel');
			$this->load->model('employeeModel');

			for($i=0;$i<count($employees);$i++){
				$employeeId = $employees[$i]->EmployeeID;
				$empDetails = $this->getCompleteEmployeeInfo($access_token,$tenant_id,$employeeId);
				$empDetails = json_decode($empDetails)->Employees[0];
				$Title = isset($empDetails->Title) ? $empDetails->Title : "";
				$FirstName = $empDetails->FirstName;
				$MiddleNames = isset($empDetails->MiddleNames) ? $empDetails->MiddleNames : "";
				$LastName = $empDetails->LastName;
				$Status = $empDetails->Status;
				$JobTitle = isset($empDetails->JobTitle) ? $empDetails->JobTitle : "";
				$Email = $empDetails->Email;
				preg_match( '/([\d]{9})/', $empDetails->DateOfBirth, $matches );
				$DateOfBirth = date( 'Y-m-d', $matches[0] );
				$Gender = $empDetails->Gender;
				$AddressLine1 = $empDetails->HomeAddress->AddressLine1;
				$AddressLine2 = isset($empDetails->HomeAddress->AddressLine2) ?  $empDetails->HomeAddress->AddressLine2: "";
				$City = $empDetails->HomeAddress->City;
				$Region = $empDetails->HomeAddress->Region;
				$PostalCode = $empDetails->HomeAddress->PostalCode;
				$Country = $empDetails->HomeAddress->Country;
				$Phone = isset($empDetails->Phone) ? $empDetails->Phone : "";
				$Mobile = isset($empDetails->Mobile) ? $empDetails->Mobile : "";
				if(isset($empDetails->TerminationDate)){
					preg_match( '/([\d]{9})/', $empDetails->TerminationDate, $matches );
					$TerminationDate = date( 'Y-m-d', $matches[0] );
				}
				else{
					$TerminationDate = null;
				}
				if(isset($empDetails->StartDate)){
					preg_match( '/([\d]{9})/', $empDetails->StartDate, $matches );
					$StartDate = date( 'Y-m-d', $matches[0] );
				}
				else{
					$StartDate = null;
				}
				$OrdinaryEarningsRateID = $empDetails->OrdinaryEarningsRateID;
				$PayrollCalendarID = $empDetails->PayrollCalendarID;

				$myUser = $this->authModel->getUserFromEmail($Email);
				if($myUser == null){
					$password = $FirstName.$LastName."@123";
					$myUserid = $this->authModel->insertUser($Email,$password,$FirstName." ".$LastName,4,$JobTitle,null,null,$userid,0,0,0);
				}
				else{
					$myUserid = $myUser->id;
				}

				$myEmployee = $this->employeeModel->getUserFromId($userid);
				if($myEmployee == null){
					//insert 
					$this->employeeModel->insertEmployee($myUserid,$employeeId,$Title,$FirstName,$MiddleNames,$LastName,$Status,$Email,$DateOfBirth,$JobTitle,$Gender,$AddressLine1,$AddressLine2,$City,$Region,$PostalCode,$Country,$Phone,$Mobile,$StartDate,$TerminationDate,$OrdinaryEarningsRateID,$PayrollCalendarID,$userid);
				}
				else{
					//update
					$this->employeeModel->updateEmployee($employeeId,$Title,$FirstName,$MiddleNames,$LastName,$Status,$Email,$DateOfBirth,$JobTitle,$Gender,$AddressLine1,$AddressLine2,$City,$Region,$PostalCode,$Country,$Phone,$Mobile,$StartDate,$TerminationDate,$OrdinaryEarningsRateID,$PayrollCalendarID,$myUserid);
					$this->employeeModel->deleteAllDetailsForUser($employeeId);
				}


				//taxes

				$TaxFileNumber = $empDetails->TaxDeclaration->TaxFileNumber;
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

				$this->employeeModel->insertIntoTaxDeclaration($employeeId,$EmploymentBasis,$TFNExemptionType,$TaxFileNumber,$AustralianResidentForTaxPurposes,$ResidencyStatus,$TaxFreeThresholdClaimed,$TaxOffsetEstimatedAmount,$HasHELPDebt,$HasSFSSDebt,$HasStudentStartupLoan,$UpwardVariationTaxWithholdingAmount,$EligibleToReceiveLeaveLoading,$ApprovedWithholdingVariationPercentage);

				//bank accounts
				foreach ($empDetails->BankAccounts as $bankAccount) {
					$StatementText = addslashes($bankAccount->StatementText);
					$AccountName = addslashes($bankAccount->AccountName);
					$BSB = $bankAccount->BSB;
					$AccountNumber = $bankAccount->AccountNumber;
					$Remainder = $bankAccount->Remainder ? "Y" : "N";
					$Amount = isset($bankAccount->Amount) ? $bankAccount->Amount : 0;
					$this->employeeModel->insertIntoBankAccount($employeeId,$StatementText,$AccountName,$BSB,$AccountNumber,$Remainder,$Amount);
				}

				//super funds
				foreach ($empDetails->SuperMemberships as $superMembership) {
					$SuperMembershipID = $superMembership->SuperMembershipID;
					$SuperFundID = $superMembership->SuperFundID;
					$EmployeeNumber = $superMembership->EmployeeNumber;
					$this->employeeModel->insertIntoSuperMembership($employeeId,$SuperFundID,$EmployeeNumber,$SuperMembershipID);
				}

				//leave balance
				$this->leaveModel->deleteAllUserLeaveBalance($myUserid);
				foreach ($empDetails->LeaveBalances	 as $leaveBalance) {
					$LeaveTypeID = $leaveBalance->LeaveTypeID;
					$NumberOfUnits = $leaveBalance->NumberOfUnits;
					$this->leaveModel->insertIntoLeaveBalance($myUserid,$LeaveTypeID,$NumberOfUnits);
				}

				//leave Application
				//todo

			}
		}
	}


	function postToken($postData){
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


	function getTenant($access_token){
		$url = "https://api.xero.com/connections";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
           'Content-Type:application/json',
           'Authorization:Bearer '.$access_token
		));
		$server_output = curl_exec($ch);
		return $server_output;
	}

	function getPayItems($access_token,$tenant_id){
		$url = "https://api.xero.com/payroll.xro/1.0/PayItems";
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

	function getSuperfunds($access_token,$tenant_id){
		$url = "https://api.xero.com/payroll.xro/1.0/SuperFunds";
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

	function getEmployees($access_token,$tenant_id){		
		$url = "https://api.xero.com/payroll.xro/1.0/Employees";
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

	function getCompleteEmployeeInfo($access_token,$tenant_id,$employeeId){
		$url = "https://api.xero.com/payroll.xro/1.0/Employees/".$employeeId;
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

	public function startOauth(){
		$client_id = XERO_CLIENT_ID;
		$redirect_uri = base_url()."xero/oauth";
		//$userid = $this->session->userdata('LoginId');
		$userid = "123";

		$url = "https://login.xero.com/identity/connect/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirect_uri."&scope=openid offline_access profile email payroll.employees payroll.payruns payroll.payslip payroll.timesheets payroll.settings&state=".$userid;
		header('Location: '.$url);
	}

}