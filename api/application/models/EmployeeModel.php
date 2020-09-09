<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeModel extends CI_Model {

	public function getUserFromId($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM employee WHERE userid = '$userid'");
		return $query->row();
	}

	public function insertEmployee($userid,$xeroEmployeeId,$title,$fname,$mname,$lname,$status,$emails,$dateOfBirth,$jobTitle,$gender,$homeAddLine1,$homeAddLine2,$homeAddCity,$homeAddRegion,$homeAddPostal,$homeAddCountry,$phone,$mobile,$startDate,$terminationDate,$ordinaryEarningRateId,$payrollCalendarId,$created_by,$classification){

		$this->load->database();
		$query = $this->db->query("INSERT INTO employee (userid, xeroEmployeeId, title, fname, mname, lname, status, emails, dateOfBirth, jobTitle, gender, homeAddLine1, homeAddLine2, homeAddCity, homeAddRegion, homeAddPostal, homeAddCountry, phone, mobile, startDate, terminationDate, ordinaryEarningRateId, payrollCalendarId, created_at, created_by, classification) VALUES('$userid','$xeroEmployeeId','$title','$fname','$mname','$lname','$status','$emails','$dateOfBirth','$jobTitle','$gender','$homeAddLine1','$homeAddLine2','$homeAddCity','$homeAddRegion','$homeAddPostal','$homeAddCountry','$phone','$mobile','$startDate','$terminationDate','$ordinaryEarningRateId','$payrollCalendarId',now(),'$created_by','$classification')");
	}


	public function updateEmployee($employeeId,$Title,$FirstName,$MiddleNames,$LastName,$Status,$Email,$DateOfBirth,$JobTitle,$Gender,$AddressLine1,$AddressLine2,$City,$Region,$PostalCode,$Country,$Phone,$Mobile,$StartDate,$TerminationDate,$OrdinaryEarningsRateID,$PayrollCalendarID,$userid){
		
		$this->load->database();
		$query = $this->db->query("UPDATE employee SET xeroEmployeeId='$employeeId',title='$Title',fname='$FirstName',mname='$MiddleNames',lname='$LastName',status='$Status',emails='$Email',dateOfBirth='$DateOfBirth',jobTitle='$JobTitle',gender='$Gender',homeAddLine1='$AddressLine1',homeAddLine2='$AddressLine2',homeAddCity='$City',homeAddRegion='$Region',homeAddPostal='$PostalCode',homeAddCountry='$Country',phone='$Phone',mobile='$Mobile',startDate='$StartDate',terminationDate='$TerminationDate',ordinaryEarningRateId='$OrdinaryEarningsRateID',payrollCalendarId='$PayrollCalendarID' WHERE userid = '$userid'");

	}


	public function deleteAllDetailsForUser($employeeId){
		$this->load->database();
		$query = $this->db->query("DELETE FROM employeebankaccount WHERE employeeId='$employeeId'");
		$query = $this->db->query("DELETE FROM employeetaxdeclaration WHERE employeeId='$employeeId'");
		$query = $this->db->query("DELETE FROM employeesuperfund WHERE employeeId='$employeeId'");
	}


	public function insertIntoTaxDeclaration($employeeId,$employmentBasis,$tfnExemptionType,$taxFileNumber,$australiantResidentForTaxPurposeYN,$residencyStatue,$taxFreeThresholdClaimedYN,$taxOffsetEstimatedAmount,$hasHELPDebtYN,$hasSFSSDebtYN,$hasTradeSupportLoanDebtYN,$upwardVariationTaxWitholdingAmount,$eligibleToReceiveLeaveLoadingYN,$approvedWitholdingVariationPercentage){
		$this->load->database();
		$query = $this->db->query("INSERT INTO employeetaxdeclaration VALUES('$employeeId','$employmentBasis','$tfnExemptionType','$taxFileNumber','$australiantResidentForTaxPurposeYN','$residencyStatue','$taxFreeThresholdClaimedYN',$taxOffsetEstimatedAmount,'$hasHELPDebtYN','$hasSFSSDebtYN','$hasTradeSupportLoanDebtYN',$upwardVariationTaxWitholdingAmount,'$eligibleToReceiveLeaveLoadingYN',$approvedWitholdingVariationPercentage)");
	}

	public function insertIntoBankAccount($employeeId,$statementText,$accountName,$bsb,$accountNumber,$remainderYN,$amount){
		$this->load->database();
		$query = $this->db->query("INSERT INTO employeebankaccount VALUES(0,'$employeeId','$statementText','$accountName','$bsb','$accountNumber','$remainderYN',$amount)");
	}

	public function insertIntoSuperMembership($employeeId,$superFundId,$employeeNumber,$superMembershipId){
		$this->load->database();
		$query = $this->db->query("INSERT INTO employeesuperfund VALUES(0,'$employeeId','$superFundId','$employeeNumber','$superMembershipId')");
	}
}





