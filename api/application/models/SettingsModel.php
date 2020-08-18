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
	//add employee

	//need to get employee number
// 	public function addToMedicalInfo($medicareNo,$medicareRefNo,$healthInsuranceFund,$healthInsuranceNo,$ambulanceSubscriptionNo,$medicalConditions,$medicalAllergies,$medication,$dietaryPreferences){
// 		$this->load->database();
// 		$query = $this->db->query("INSERT INTO medicalinfo (employeeNo,medicareNo, medicareRefNo,
// healthInsuranceFund, healthInsuranceNo, ambulanceSubscriptionNo, medicalConditions, medicalAllergies,
// medication, dietaryPreferences,) values ('$medicareNo','$medicareRefNo','$healthInsuranceFund','$healthInsuranceNo','$ambulanceSubscriptionNo','$medicalConditions','$medicalAllergies','$medication','$dietaryPreferences')");
// 	}

// 	// need employee No
// 	public function addCourseToHR_record($course_name,$course_description,$date_obtained,$expiry_date,$certificate,$visa_holder,$visa_type,$visa_grant_date,$visa_end_date,$visa_conditions){
// 		$this->load->database();
// 		$query = $this->db->query("UPDATE HR_record SET courseName = '$course_name',courseDescription = '$course_description',dateObtained = '$date_obtained',courseExpiryDate = '$expiry_date',courseCertificate = '$certificate',visaHolderYN = '$visa_holder',visaType = '$visa_type',visaGrantDate = '$visa_grant_date',visaEndDate = '$visa_end_date',visaConditions='$visa_conditions' where employeeNo = '$employeeNo'");
// 	}
	
// 	//need employee id
// 	public function addEmployeeToEmployeeBankAccount($accountName,$bsb,$accountNumber,$remainderYN,$amount){
// 		$this->load->database();
// 		$query = $this->db->query("INSERT INTO employeebankaccount (employeeId, accountName, bsb, accountNumber, remainderYN, amount,) values ('$accountName','$bsb','$accountNumber','$remainderYN','$amount')");
// 	}


// //need super membership id , employee id
// 	public function addEmployeeToEmployeeSuperfund($SuperFundID,$EmployeeNumber){
// 		$this->load->database();
// 		$query = $this->db->query("INSERT INTO employeesuperfund (superFundId,employeeNumber) values ('$SuperFundID','$EmployeeNumber')");
// 	}


// // need xero employee id,
// 		public function addEmployeeToEmployee($userid,$title,$fname,$mname,$lname,$status,$emails,$dateOfBirth,$jobTitle,$gender,$homeAddLine1,$homeAddLine2,$homeAddCity,$homeAddRegion,$homeAddPostal,$homeAddCountry,$phone,$mobile,$startDate,$terminationDate,$ordinaryEarningRateId,$payroll_calendar,$employee_group,$classification,$employee_group){
// 			$this->load->database();
// 			$uniqueId = uniqid();
// 			$query = $this->db->query("INSERT INTO employee (userid, title, fname, mname, lname, status, emails, dateOfBirth, jobTitle, gender, homeAddLine1, homeAddLine2, homeAddCity, homeAddRegion, homeAddPostal, homeAddCountry, phone, mobile, startDate,terminationDate, ordinaryEarningRateId, payrollCalendarId,employee_group ,classification, employee_group,emergency_contact, 
// relationship, emergency_contact_email, created_at,created_by) values ('$uniqueId',$title','$fname','$mname','$lname','$status','$emails','$dateOfBirth','$jobTitle','$gender','$homeAddLine1','$homeAddLine2','$homeAddCity','$homeAddRegion','$homeAddPostal','$homeAddCountry','$phone','$mobile','$startDate','$terminationDate','$ordinaryEarningRateId','$payroll_calendar','$employee_group', '$classification', '$employee_group', '$emergency_contact', '$relationship', '$emergency_contact_email', now(),'$userid')");
// 		}

// // need employee id
// 		public function addEmployeeToEmployeeTaxDeclaration($employeeId,$employmentBasis,$tfnExemptionType,$taxFileNumber,$australiantResidentForTaxPurposeYN,$residencyStatue,$taxFreeThresholdClaimedYN,$taxOffsetEstimatedAmount,$hasHELPDebtYN,$hasSFSSDebtYN,$hasTradeSupportLoanDebtYN,$upwardVariationTaxWitholdingAmount,$eligibleToReceiveLeaveLoadingYN,$approvedWitholdingVariationPercentage){
// 			$this->load->database();
// 			$query = $this->db->query("INSERT INTO employeetaxdeclaration (employeeId, employmentBasis, tfnExemptionType, taxFileNumber, australiantResidentForTaxPurposeYN, residencyStatue, taxFreeThresholdClaimedYN, taxOffsetEstimatedAmount, hasHELPDebtYN, hasSFSSDebtYN, hasTradeSupportLoanDebtYN, upwardVariationTaxWitholdingAmount, eligibleToReceiveLeaveLoadingYN, approvedWitholdingVariationPercentage) values ('$employeeId','$employmentBasis','$tfnExemptionType','$taxFileNumber','$australiantResidentForTaxPurposeYN','$residencyStatue','$taxFreeThresholdClaimedYN','$taxOffsetEstimatedAmount','$hasHELPDebtYN','$hasSFSSDebtYN','$hasTradeSupportLoanDebtYN','$upwardVariationTaxWitholdingAmount','$eligibleToReceiveLeaveLoadingYN','$approvedWitholdingVariationPercentage')");
// 		}

// 		// public function addEmployeeToUsers($emails,$center,$area,$role,$manager,$level,$bonusRates){
// 		// 	$this->load->database();
// 		// 	$query = $this->db->query("INSERT INTO users () values ($emails,$center,$area,$role,$manager,$level,$bonusRates)");
// 		// }

// 		// add center 

// public function addCenter($addStreet,$addCity,$addState,$addZip,$name,$centre_phone_number,$centre_mobile_number,$Centre_email){
// 	$this->load->database();
// 	$query = $this->load->db("INSERT INTO centers (addStreet, addCity, addState, addZip, name, centre_phone_number, centre_mobile_number, centre_email) VALUES ('$addStreet','$addCity','$addState','$addZip','$name','$centre_phone_number','$centre_mobile_number','$Centre_email')");
// 	return $query->insert_id();
// }
// public function addRoom($centerid,$room_name,$capacity_,$minimum_age,$maximum_age){
// 	$this->load->database();
// 	$uniqueId = uniqid();
// 	$query = $this->load->db("INSERT INTO room (roomId,centerid,name,capacity,careAgeFrom,careAgeTo) VALUES ('$uniqueId',$centerid,'$room_name','$capacity_','$minimum_age','$maximum_age')");
// }

// public function addCompliance($centerid,$compliance_name,$compliance_desc,$compliance_contact_name,$compliance_contact_number,$compliance_contact_email,$compliance_expiry_renewal_date,$compliance_document){
// 	$this->load->database();
// 		$uniqueId  = uniqid();
// 	$query = $this->load->db("INSERT INTO centercomplianceinformation (centerId,uniqueId,complianceName,complianceDesc,complianceContactName,complianceContactNumber,complianceContactEmail,complianceExpiryRenewalDate,complianceDocument) VALUES ($centerid,'$uniqueId','$compliance_name','$compliance_desc','$compliance_contact_details','$compliance_contact_name','$compliance_contact_number','$compliance_contact_email','$compliance_expiry_renewal_date','$compliance_document')");
// }

// public function addSupplier($centerid,$supplier_desc,$supplier_account_no,$supplier_contact_name,$supplier_contact_number,$supplier_contact_email){
// 	$this->load->database();
// 	$query = $this->load->db("INSERT INTO centresupplierinfo (centerId,supplierDesc,supplierAccountNo,supplierContactName,supplierContactNumber,supplierContactEmail) VALUES ($centerid,'$supplier_desc','$supplier_account_no','$supplier_contact_name','$supplier_contact_number','$supplier_contact_email')");
// }

// public function addCenterRecord($centerid,$centre_abn,$centre_acn,$centre_se_no,$centre_date_opened,$centre_capacity,$approval_doc,$centre_approval_doc,$ccs_doc,$centre_ccs_doc,$manager_name,$centre_admin_name,$centre_nominated_supervisor){
// 	$this->load->database();
// 	$uniqueId  = uniqid();
// 	$query = $this->load->db("INSERT INTO centerrecord (centerId,centerRecordUniqueId,centreABN,centreACN,centreSE_no,centreDateOpened,centreCapacity,centreApprovalDoc,centreCCSDoc,managerId,centreAdminId,centreNominatedSupervisorId) VALUES ($centerid,'$uniqueId','$centre_abn','$centre_acn','$centre_se_no','$centre_date_opened','$centre_capacity','$approval_doc','$centre_approval_doc','$centre_ccs_doc','$manager_name','$centre_admin_name','$centre_nominated_supervisor')");
// }

}


	
	
	
	
	
	
	
	
	
	
	


	



