<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class SettingsModel extends CI_Model {

	public function getAreaByName($centerid,$areaName){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartareas WHERE LOWER(areaName) = LOWER('$areaName') AND centerid = '$centerid'");
		return $query->row();
	}

	public function getAreaExists($areaName,$areaid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartareas WHERE LOWER(areaName) = LOWER('$areaName') AND centerid = (SELECT centerid FROM orgchartareas WHERE areaid = $areaid)");
		return $query->row();
	}

	public function updateArea($areaid,$areaName,$isRoomYN){
		$this->load->database();
		$query = $this->db->query("UPDATE orgchartareas SET areaName = '$areaName', isARoomYN = '$isRoomYN' WHERE areaid = $areaid");
	}

	public function createArea($centerid,$areaName,$isRoomYN){
		$this->load->database();
		$query = $this->db->query("INSERT INTO orgchartareas VALUES(0,'$centerid','$areaName','$isRoomYN',0)");
	}

	public function getAllAreas($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartareas WHERE centerid = '$centerid'");
		return $query->result();
	}

	public function getRoleByName($areaid,$roleName){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartroles WHERE LOWER(roleName) = LOWER('$roleName') AND areaid = $areaid");
		return $query->row();
	}

	public function getRoleExists($roleName,$roleid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartroles WHERE LOWER(roleName) = LOWER('$roleName') AND areaid = (SELECT areaid FROM orgchartroles WHERE roleid = $roleid)");
		return $query->row();
	}

	public function createRole($areaid,$roleName){
		$this->load->database();
		$this->db->query("INSERT INTO orgchartroles VALUES(0,$areaid,'$roleName')");
	}

	public function updateRole($roleid,$roleName){
		$this->load->database();
		$this->db->query("UPDATE orgchartroles SET roleName = '$roleName' WHERE roleid = $roleid");
	}

	public function getRolesFromArea($areaid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartroles where areaid = $areaid");
		return $query->result();
	}

	public function changePassword($userid,$password,$passcode){
		$this->load->database();
		$this->db->query("UPDATE users SET password = '$password' WHERE id = '$userid' and password = '$passcode'");
	}

	public function updateCenterProfile($centerid,$logo,$name,$addStreet,$addCity,$addState,$addZip){
		$this->load->database();
		$this->db->query("UPDATE centers SET logo = '$logo',name = '$name', addStreet = '$addStreet', addCity = '$addCity',addState = '$addState' , addZip = '$addZip' where centerid = '$centerid'");
	}

	public function addCenter($centerid,$logo,$name,$addStreet,$addCity,$addState,$addZip){
		$this->load->database();
		$this->db->query("INSERT INTO centers (centerid,logo,name,addStreet,addCity,addState,addZip) values('$centerid','$logo','$name', '$addStreet', '$addCity', '$addState' , '$addZip')");
	}

	public function getRooms($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM room where centerid = $centerid");
		return $query->result();
	}

	public function editRoom($centerid,$name,$careAgeFrom,$careAgeTo,$capacity,$studentRatio,$roomId){
		$this->load->database();
		$this->db->query("UPDATE room SET name='$name', careAgeFrom='$careAgeFrom', careAgeTo='$careAgeTo', capacity='$capacity', studentRatio='$studentRatio' where centerid='$centerid' and roomId = '$roomId'");
	}

	public function deleteRoom($roomid){
		$this->load->database();
		$this->db->query("DELETE from room where roomId = '$roomid'");
	}

	public function deleteArea($areaid){
		$this->load->database();
		$this->db->query("DELETE from orgchartareas where areaid = '$areaid'");
	}

	public function deleteRole($roleid){
		$this->load->database();
		$this->db->query("DELETE from orgchartroles where roleid = '$roleid'");
	}

	public function getSuperfunds(){
		$this->load->database();
		$query = $this->db->query("SELECT * from superfund ");
		return $query->result();
	}

	public function getAwards(){
		$this->load->database();
		$query = $this->db->query("SELECT * from payrollshifttype_v1 ");
		return $query->result();
	}

	public function addEmployeeToEmployee($xeroEmployeeId,$userid,$title,$fname,$mname,$lname,$status,$emails,$dateOfBirth,$jobTitle,$gender,$homeAddLine1,$homeAddLine2,$homeAddCity,$homeAddRegion ,$homeAddPostal,$homeAddCountry,$phone,$mobile,$startDate,$terminationDate,$ordinaryEarningRateId,$payrollCalendarId,$created_by){
		$this->load->database();
		$query = $this->db->query("INSERT INTO employee (xeroEmployeeId, userid, title ,fname ,mname ,lname ,status ,emails ,dateOfBirth ,jobTitle ,gender ,homeAddLine1 ,homeAddLine2 ,homeAddCity ,homeAddRegion ,homeAddPostal ,homeAddCountry ,phone ,mobile ,startDate ,terminationDate ,ordinaryEarningRateId ,payrollCalendarId ,created_at ,created_by) VALUES   ('$xeroEmployeeId','$userid','$title','$fname','$mname','$lname','$status','$emails','$dateOfBirth','$jobTitle','$gender','$homeAddLine1','$homeAddLine2','$homeAddCity','$homeAddRegion' ,'$homeAddPostal','$homeAddCountry','$phone','$mobile','$startDate','$terminationDate','$ordinaryEarningRateId','$payrollCalendarId',now(),'$created_by') ");
	}
	public function addEmployeeToEmployeeBankAccount($employeeId,$statementText,$accountName,$bsb,$accountNumber,$remainderYN,$amount){
		$this->load->database();
		$query = $this->db->query("INSERT INTO employeebankaccount (employeeId,statementText,accountName,bsb,accountNumber,remainderYN,amount) VALUES ('$employeeId','$statementText','$accountName','$bsb','$accountNumber','$remainderYN','$amount')");
	}
	public function addEmployeeToEmployeeSuperfund($employeeId,$superFundId,$employeeNumber,$superMembershipId){
		$this->load->database();
		$query = $this->db->query("INSERT INTO employeesuperfund (employeeId, superFundId, employeeNumber, superMembershipId) VALUES ('$employeeId','$superFundId','$employeeNumber','$superMembershipId')");
	}
	public function addEmployeeToEmployeeTaxDeclaration($employeeId,$employmentBasis,$tfnExemptionType,$taxFileNumber,$australiantResidentForTaxPurposeYN,$residencyStatue,$taxFreeThresholdClaimedYN,$taxOffsetEstimatedAmount,$hasHELPDebtYN,$hasSFSSDebtYN,$hasTradeSupportLoanDebtYN,$upwardVariationTaxWitholdingAmount,$eligibleToReceiveLeaveLoadingYN,$approvedWitholdingVariationPercentage){
		$this->load->database();
		$query = $this->db->query("INSERT INTO employeetaxdeclaration (employeeId, employmentBasis, tfnExemptionType, taxFileNumber, australiantResidentForTaxPurposeYN, residencyStatue, taxFreeThresholdClaimedYN, taxOffsetEstimatedAmount, hasHELPDebtYN, hasSFSSDebtYN, hasTradeSupportLoanDebtYN, upwardVariationTaxWitholdingAmount, eligibleToReceiveLeaveLoadingYN, approvedWitholdingVariationPercentage) VALUES ('$employeeId','$employmentBasis','$tfnExemptionType','$taxFileNumber','$australiantResidentForTaxPurposeYN','$residencyStatue','$taxFreeThresholdClaimedYN','$taxOffsetEstimatedAmount','$hasHELPDebtYN','$hasSFSSDebtYN','$hasTradeSupportLoanDebtYN','$upwardVariationTaxWitholdingAmount','$eligibleToReceiveLeaveLoadingYN','$approvedWitholdingVariationPercentage')");
	}

	public function addEmployeeToUsers($emaild,$center,$area,$role,$manager,$level,$bonusRates){
	 	$this->load->database();
	 	$query = $this->db->query("INSERT INTO users (center,area,role,manager,level,bonusRates) VALUES ('$center','$area','$role','$manager','$level','$bonusRates') WHERE email ='$emailid'");
	}


	public function getPermissionForEmployee($empId){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM permissions WHERE userid = '$empId'");
		return $query->row();
	}

	public function insertPermission($userid,$isQrReaderYN,$viewRosterYN,$editRosterYN,$viewTimesheetYN,$editTimesheetYN,$viewPayrollYN,$editPayrollYN,$editLeaveTypeYN,$viewLeaveTypeYN,$createNoticeYN,$viewOrgChartYN,$editOrgChartYN,$viewCenterProfileYN,$editCenterProfileYN,$viewRoomSettingsYN,$editRoomSettingsYN,$viewEntitlementsYN,$editEntitlementsYN,$editEmployeeYN,$xeroYN,$viewAwardsYN,$editAwardsYN,$viewSuperfundsYN,$editSuperfundsYN,$createMomYN,$editPermissionYN,$viewPermissionYN){

		$this->load->database();
		$this->db->query("DELETE FROM permissions WHERE userid = '$userid'");
		$this->db->query("INSERT INTO permissions VALUES('$userid','$isQrReaderYN','$viewRosterYN','$editRosterYN','$viewTimesheetYN','$editTimesheetYN','$viewPayrollYN','$editPayrollYN','$editLeaveTypeYN','$viewLeaveTypeYN','$createNoticeYN','$viewOrgChartYN','$editOrgChartYN','$viewCenterProfileYN','$editCenterProfileYN','$viewRoomSettingsYN','$editRoomSettingsYN','$viewEntitlementsYN','$editEntitlementsYN','$editEmployeeYN','$xeroYN','$viewAwardsYN','$editAwardsYN','$viewSuperfundsYN','$editSuperfundsYN','$createMomYN','$editPermissionYN','$viewPermissionYN')");
	}

	public function getEmployeeDetails($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * from employee where userid = '$userid'");
		return $query->row();
	}

	public function insertMedicalInfo($employeeNo,$medicareNo,$medicareRefNo,$healthInsuranceFund,$healthInsuranceNo,$ambulanceSubscriptionNo,$medicalConditions,$medicalAllergies,$medication,$dietaryPreferences,$anaphylaxis,$asthma,$maternityStartDate,$maternityEndDate){
		$this->load->database();
		$query = $this->db->query("INSERT into medicalinfo (employeeNo,medicareNo,medicareRefNo,healthInsuranceFund,healthInsuranceNo,ambulanceSubscriptionNo,medicalConditions,medicalAllergies,medication,dietaryPreferences,anaphylaxis,asthma,maternityStartDate,maternityEndDate) values ($employeeNo,$medicareNo,$medicareRefNo,$healthInsuranceFund,$healthInsuranceNo,$ambulanceSubscriptionNo,$medicalConditions,$medicalAllergies,$medication,$dietaryPreferences,$anaphylaxis,$asthma,$maternityStartDate,$maternityEndDate)");
	}

	public function insertIntoHRrecord($employeeNo,$currentlyEmployed,$commencementDate,$contractPosition,$resumeSupplied,$resumeDoc,$employmentType,$currentContractNotes,$currentContractSignatureDate,$currentContractCommencementDate,$currentContractEndDate,$currentContractPaidStartDate,$probationEndDate,$industryYearsExpAsNov19,$prohibitionNoticeDeclaration,$VITcardNo,$VITexpiry,$WWCCcardNo,$WWCCexpiry,$foodHandlingSafety,$lastPoliceCheck,$childProtectionCheck,$nominatedSupervisor,$workcover,$PIAWE,$annualLeaveInContract,$otherQualifications,$otherQualDesc,$highestQualHeld,$highestQualType,$qualTowardsDesc,$qualTowardsPercentcomp,$contractAwardId,$paidAwardId,$visaType,$visaGrantDate,$visaEndDate,$visaConditions){
		$this->load->database();
		$uniqueId = uniqid();
		$query = $this->db->query("INSERT into hr_record (employeeNo,uniqueId,currentlyEmployed,commencementDate,contractPosition,resumeSupplied,resumeDoc,employmentType,currentContractNotes,currentContractSignatureDate,currentContractCommencementDate,currentContractEndDate,currentContractPaidStartDate,probationEndDate,industryYearsExpAsNov19,prohibitionNoticeDeclaration,VITcardNo,VITexpiry,WWCCcardNo,WWCCexpiry,foodHandlingSafety,lastPoliceCheck,childProtectionCheck,nominatedSupervisor,workcover,PIAWE,annualLeaveInContract,otherQualifications,otherQualDesc,highestQualHeld,highestQualType,qualTowardsDesc,qualTowardsPercentcomp,contractAwardId,paidAwardId,visaType,visaGrantDate,visaEndDate,visaConditions) values ($employeeNo,$uniqueId,$currentlyEmployed,$commencementDate,$contractPosition,$resumeSupplied,$resumeDoc,$employmentType,$currentContractNotes,$currentContractSignatureDate,$currentContractCommencementDate,$currentContractEndDate,$currentContractPaidStartDate,$probationEndDate,$industryYearsExpAsNov19,$prohibitionNoticeDeclaration,$VITcardNo,$VITexpiry,$WWCCcardNo,$WWCCexpiry,$foodHandlingSafety,$lastPoliceCheck,$childProtectionCheck,$nominatedSupervisor,$workcover,$PIAWE,$annualLeaveInContract,$otherQualifications,$otherQualDesc,$highestQualHeld,$highestQualType,$qualTowardsDesc,$qualTowardsPercentcomp,$contractAwardId,$paidAwardId,$visaType,$visaGrantDate,$visaEndDate,$visaConditions)");
	}

}




	



