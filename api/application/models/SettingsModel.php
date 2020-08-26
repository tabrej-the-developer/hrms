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

		public function addToEmployeeCourses( $xeroEmployeeId,$course_nme,$course_desc,$date_obt,$exp_date){
			$this->load->database();
			$query = $this->db->query("INSERT INTO employeecourses (employeeId, courseName, courseDescription, dateObtained, courseExpiryDate) VALUES ( '$xeroEmployeeId','$course_nme','$course_desc','$date_obt','$exp_date')");
		}
		public function addToUsers($employee_no,$emails,$name,$title,$center,$manager,$userid,$role,$level,$alias){
			$this->load->database();
			$query = $this->db->query("INSERT INTO users (id,email, name,title,center, manager,created_at, created_by,roleid,level,alias) VALUES ('$employee_no','$emails','$name','$title','$center','$manager',NOW(),'$userid','$role','$level','$alias')");
		}
		public function addToEmployeeBankAccount( $xeroEmployeeId,$accountName,$bsb,$accountNumber,$remainderYN,$amount){
			$this->load->database();
			$query = $this->db->query("INSERT INTO employeebankaccount (employeeId, accountName, bsb, accountNumber, remainderYN, amount) VALUES ( '$xeroEmployeeId','$accountName','$bsb','$accountNumber','$remainderYN','$amount')");
		}
		public function addToEmployeeMedicalInfo($xeroEmployeeId,$medicareNo, $medicareRefNo,$healthInsuranceFund,$healthInsuranceNo, $ambulanceSubscriptionNo){
			$this->load->database();
			$query = $this->db->query("INSERT INTO employeemedicalinfo (employeeNo, medicareNo, medicareRefNo, healthInsuranceFund, healthInsuranceNo, ambulanceSubscriptionNo) VALUES ('$xeroEmployeeId','$medicareNo', '$medicareRefNo','$healthInsuranceFund','$healthInsuranceNo', '$ambulanceSubscriptionNo')");
		}
		public function addToEmployeeMedicals( $xeroEmployeeId,$medC,$medA,$medic,$dietary){
			$this->load->database();
			$query = $this->db->query("INSERT INTO employeemedicals (employeeId, medicalConditions, medicalAllergies, medication, dietaryPreferences) VALUES ('$xeroEmployeeId','$medC','$medA','$medic','$dietary')");
		}
		public function addToEmployeeRecord($employee_no, $xeroEmployeeId, $uniqueId,$resume_doc, $employement_type, $qual_towards_desc, $highest_qual_held, $qual_towards_percent_comp, $visa_type, $visa_grant_date, $visa_end_date, $visa_conditions, $contract_doc, $highest_qual_date_obtained, $highest_qual_cert, $visa_holder){
			$this->load->database();
			$query = $this->db->query("INSERT INTO employeerecord (employeeNo, EmployeeId, uniqueId, resumeDoc, employmentType,  otherQualDesc, highestQualHeld, qualTowardsPercentcomp, visaType, visaGrantDate, visaEndDate, visaConditions, contractDocument, highestQualDateObtained, highestQualCertificate,  visaHolderYN) VALUES ('$employee_no', '$xeroEmployeeId', '$uniqueId','$resume_doc', '$employement_type', '$qual_towards_desc', '$highest_qual_held', '$qual_towards_percent_comp', '$visa_type', '$visa_grant_date', '$visa_end_date', '$visa_conditions', '$contract_doc', '$highest_qual_date_obtained', '$highest_qual_cert', '$visa_holder')" );
		}
		public function addToEmployeeSuperfunds( $xeroEmployeeId, $superFundId, $superMembershipId){
			$this->load->database();
			$query = $this->db->query("INSERT INTO employeesuperfund (employeeId, superFundId, superMembershipId) VALUES ('$xeroEmployeeId', '$superFundId', '$superMembershipId')");
		}
		public function addToEmployeeTaxDeclaration($xeroEmployeeId,$employmentBasis,$tfnExemptionType,$taxFileNumber,$australiantResidentForTaxPurposeYN,$residencyStatue,$taxFreeThresholdClaimedYN,$taxOffsetEstimatedAmount,$hasHELPDebtYN,$hasSFSSDebtYN,$hasTradeSupportLoanDebtYN_,$upwardVariationTaxWitholdingAmount,$eligibleToReceiveLeaveLoadingYN,$approvedWitholdingVariationPercentage){
			$this->load->database();
			$query = $this->db->query("INSERT INTO employeetaxdeclaration (employeeId, employmentBasis, tfnExemptionType, taxFileNumber, australiantResidentForTaxPurposeYN, residencyStatue, taxFreeThresholdClaimedYN, taxOffsetEstimatedAmount, hasHELPDebtYN, hasSFSSDebtYN, hasTradeSupportLoanDebtYN, upwardVariationTaxWitholdingAmount, eligibleToReceiveLeaveLoadingYN, approvedWitholdingVariationPercentage) VALUES ('$xeroEmployeeId','$employmentBasis','$tfnExemptionType','$taxFileNumber','$australiantResidentForTaxPurposeYN','$residencyStatue','$taxFreeThresholdClaimedYN','$taxOffsetEstimatedAmount','$hasHELPDebtYN','$hasSFSSDebtYN','$hasTradeSupportLoanDebtYN_','$upwardVariationTaxWitholdingAmount','$eligibleToReceiveLeaveLoadingYN','$approvedWitholdingVariationPercentage')");
		}
		public function addToEmployeeTable($employee_no, $xeroEmployeeId,$title,$fname,$mname,$lname,$emails,$dateOfBirth,$jobTitle,$gender,$homeAddLine1,$homeAddLine2,$homeAddCity,$homeAddRegion,$homeAddPostal,$homeAddCountry,$phone,$mobile,$startDate,$terminationDate,$ordinaryEarningRateId,$payrollCalendarId,$userid,$classification,$holiday_group,$employee_group,$emergency_contact,$relationship,$emergency_contact_email){
			$this->load->database();
			$query = $this->db->query("INSERT INTO employee (userid, xeroEmployeeId, title, fname, mname, lname, emails, dateOfBirth, jobTitle, gender, homeAddLine1, homeAddLine2, homeAddCity, homeAddRegion, homeAddPostal, homeAddCountry, phone, mobile, startDate, terminationDate, ordinaryEarningRateId, payrollCalendarId, created_at, created_by, classification, holiday_group, employee_group, emergency_contact, relationship, emergency_contact_email) VALUES ('$employee_no', '$xeroEmployeeId','$title','$fname','$mname','$lname','emails','$dateOfBirth','$jobTitle','$gender','$homeAddLine1','$homeAddLine2','$homeAddCity','$homeAddRegion','$homeAddPostal','$homeAddCountry','$phone','$mobile','$startDate','$terminationDate','$ordinaryEarningRateId','$payrollCalendarId',NOW(),'$userid','$classification','$holiday_group','$employee_group','$emergency_contact','$relationship','$emergency_contact_email')");
		}

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


	
	
	
	
	
	
	
	
	
	
	


	



