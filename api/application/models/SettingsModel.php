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

	public function updateKidsoft($key,$centerid,$updateVal){
		$this->load->database();
		$date = date('Y-m-d');
		if($updateVal == 'add')
			$this->db->query("INSERT INTO kidsoft (center,kidsoftkey,createdate) VALUES ($centerid,$key,'$date')");
		if($updateVal == 'del')
			$this->db->query("DELETE FROM kidsoft where center=$centerid");
		if($updateVal == 'upd')
			$this->db->query("UPDATE kidsoft SET kidsoftkey = '$key',updatedate = '$date' where center = $centerid");
	}

	public function updateArea($areaid,$areaName,$isRoomYN){
		$this->load->database();
		$query = $this->db->query("UPDATE orgchartareas SET areaName = '$areaName', isARoomYN = '$isRoomYN' WHERE areaid = $areaid");
	}

	public function createArea($centerid,$areaName,$isRoomYN){
		$this->load->database();
		$query = $this->db->query("INSERT INTO orgchartareas (areaid,centerid, areaName,isARoomYN, rosterPriority) VALUES(0,'$centerid','$areaName','$isRoomYN',0)");
	}
	public function addArea($centerid,$areaName){
		$this->load->database();
		$query = $this->db->query("INSERT INTO orgchartareas (centerid,areaName,isARoomYN,rosterPriority) VALUES('$centerid','$areaName','Y',0)");
		$query = $this->db->query("SELECT areaid from orgchartareas ORDER BY areaid DESC");
		return $query->row();
	}
	public function addRole($areaId,$roleName){
		$this->load->database();
		$query = $this->db->query("INSERT INTO orgchartroles (areaid ,roleName) VALUES ($areaId,'$roleName')");
		$query = $this->db->query("SELECT roleid from orgchartroles ORDER BY roleid DESC ");
		return $query->row();
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

	public function updateEmployeeRole($employeeId,$roleId){
		$this->load->database();
		$this->db->query("UPDATE users SET roleid = '$roleId' WHERE id = '$employeeId'");
	}	

	public function updateRolePriority($roleid,$priority){
		$this->load->database();
		$this->db->query("UPDATE orgchartroles SET priority = $priority WHERE roleid = '$roleid'");
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

	public function centerDetails($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM centers where centerid = $centerid");
		return $query->row();
	}
	public function centerRecord($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM centerrecord where centerId = $centerid");
		return $query->row();
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

	public function updateCenterProfile($centerid,$center_name,$center_street,$center_city,$center_state,$center_zip,$center_phone,$center_mobile,$center_email){
		$this->load->database();
		$this->db->query("UPDATE centers SET name='$center_name',addStreet='$center_street',addCity='$center_city',addState='$center_state',addZip='$center_zip',centre_phone_number='$center_phone',centre_mobile_number='$center_mobile',centre_email = '$center_email' WHERE centerid='$centerid'");
	}


	public function updateCenterRecord($centerid,$center_abn,$center_acn,$center_se_no,$center_date_opened,$center_capacity,$manager_name,$center_admin_name,$centre_nominated_supervisor){
		$this->db->query("UPDATE centerrecord SET centerId = '$centerid',centreABN = '$center_abn',centreACN = '$center_acn',centreSE_no = '$center_se_no',centreDateOpened = '$center_date_opened',centreCapacity = '$center_capacity',managerId = '$manager_name',centreAdminId = '$center_admin_name',centreNominatedSupervisorId = '$centre_nominated_supervisor' WHERE centerId = $centerid");
	}

	public function deleteRoom($roomid){
		$this->load->database();
		$this->db->query("DELETE from orgchartareas where roomId = '$roomid'");
	}

	public function deleteArea($areaid){
		$this->load->database();
		$this->db->query("DELETE from orgchartareas where areaid = '$areaid'");
	}

	public function deleteRole($roleid){
		$this->load->database();
		$this->db->query("DELETE from orgchartroles where roleid = '$roleid'");
	}

	public function getSuperfunds($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * from superfund where centerid = $centerid");
		return $query->result();
	}

	public function getAwards($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * from payrollshifttype_v1 where centerid = $centerid");
		return $query->result();
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
	
		public function addToEmployeeCourses( $xeroEmployeeId,$course_nme,$course_desc,$date_obt,$exp_date){
			$this->load->database();
			$query = $this->db->query("INSERT INTO employeecourses (employeeId, courseName, courseDescription, dateObtained, courseExpiryDate) VALUES ( '$xeroEmployeeId','$course_nme','$course_desc','$date_obt','$exp_date')");
		}
		public function getAreaId($centerid,$areaName){
			$this->load->database();
			$query = $this->db->query("SELECT areaid FROM orgchartareas WHERE centerid = '$centerid' and areaName = '$areaName'");
			return $query->row();
		}
		public function getRoledId($areaId,$roleName){
			$this->load->database();
			$query = $this->db->query("SELECT roleid FROM orgchartroles WHERE areaid = '$areaId' and roleName = '$roleName'");
			return $query->row();
		}

		public function addToUsers($employee_no,$password, $emails,$name,$center,$userid,$role,$level,$alias,$fileNameLoc=null){
			$this->load->database();
			$query = $this->db->query("INSERT INTO users (id,password, email, name,created_at, created_by,roleid,level,alias,isVerified,imageUrl) VALUES ('$employee_no','$password','$emails','$name',NOW(),'$userid',$role,'$level','$alias','N','$fileNameLoc')");
		}

		public function addToUsersME($employee_no,$password, $emails,$name,$center,$userid,$role,$level,$alias){
			$this->load->database();
			$query = $this->db->query("INSERT INTO users (id,password, email, name,created_at, created_by,roleid,level,alias,isVerified) VALUES ('$employee_no','$password','$emails','$name',NOW(),'$userid',$role,'$level','$alias','N')");
			$this->db->query("INSERT INTO usercenters (userid,centerid) VALUES ('$userid',$centerid)");
		}

		public function addToUserCenters($userid,$centerid){
			$this->load->database();
			$this->db->query("INSERT INTO usercenters (userid,centerid) VALUES ('$userid',$centerid)");
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
			$query = $this->db->query("INSERT INTO employeesuperfund (employeeId, superFundId, superMembershipId,employeeNumber) VALUES ('$xeroEmployeeId', '$superFundId', '$superMembershipId','$superfundEmployeeNumber')");
		}
		public function addToEmployeeTaxDeclaration($xeroEmployeeId,$employmentBasis,$tfnExemptionType,$taxFileNumber,$australiantResidentForTaxPurposeYN,$residencyStatue,$taxFreeThresholdClaimedYN,$taxOffsetEstimatedAmount,$hasHELPDebtYN,$hasSFSSDebtYN,$hasTradeSupportLoanDebtYN_,$upwardVariationTaxWitholdingAmount,$eligibleToReceiveLeaveLoadingYN,$approvedWitholdingVariationPercentage){
			$this->load->database();
			$query = $this->db->query("INSERT INTO employeetaxdeclaration (employeeId, employmentBasis, tfnExemptionType, taxFileNumber, australiantResidentForTaxPurposeYN, residencyStatue, taxFreeThresholdClaimedYN, taxOffsetEstimatedAmount, hasHELPDebtYN, hasSFSSDebtYN, hasTradeSupportLoanDebtYN, upwardVariationTaxWitholdingAmount, eligibleToReceiveLeaveLoadingYN, approvedWitholdingVariationPercentage) VALUES ('$xeroEmployeeId','$employmentBasis','$tfnExemptionType','$taxFileNumber','$australiantResidentForTaxPurposeYN','$residencyStatue','$taxFreeThresholdClaimedYN','$taxOffsetEstimatedAmount','$hasHELPDebtYN','$hasSFSSDebtYN','$hasTradeSupportLoanDebtYN_','$upwardVariationTaxWitholdingAmount','$eligibleToReceiveLeaveLoadingYN','$approvedWitholdingVariationPercentage')");
		}
		public function addToEmployeeTable($employee_no, $xeroEmployeeId,$title,$fname,$mname,$lname,$emails,$dateOfBirth,$gender,$homeAddLine1,$homeAddLine2,$homeAddCity,$homeAddRegion,$homeAddPostal,$homeAddCountry,$phone,$mobile,$startDate,$terminationDate,$ordinaryEarningRateId,$payrollCalendarId,$userid,$classification,$emergency_contact,$relationship,$emergency_contact_email,$maxhours,$days){
			$this->load->database();
			$query = $this->db->query("INSERT INTO employee (userid, xeroEmployeeId, title, fname, mname, lname, emails, dateOfBirth, gender, homeAddLine1, homeAddLine2, homeAddCity, homeAddRegion, homeAddPostal, homeAddCountry, phone, mobile, startDate, terminationDate, ordinaryEarningRateId, payrollCalendarId, created_at, created_by, classification,  emergency_contact, relationship, emergency_contact_email,maxhours,days) VALUES ('$employee_no', '$xeroEmployeeId','$title','$fname','$mname','$lname','emails','$dateOfBirth','$gender','$homeAddLine1','$homeAddLine2','$homeAddCity','$homeAddRegion','$homeAddPostal','$homeAddCountry','$phone','$mobile','$startDate','$terminationDate','$ordinaryEarningRateId','$payrollCalendarId',NOW(),'$userid','$classification','$emergency_contact','$relationship','$emergency_contact_email',$maxhours,'$days')");
		}

		public function getUserData($userid){
			$this->load->database();
			$query = $this->db->query("SELECT * FROM users where id = '$userid'");
			return $query->row();
		} 

		public function getEmployeeData($userid){
			$this->load->database();
			$query = $this->db->query("SELECT * FROM employee as e LEFT JOIN payrollshifttype_v1 as ps on e.ordinaryEarningRateId = ps.earningRateId  where e.userid = '$userid'");
			return $query->row();
		}
		public function getEmployeeBankAccount($userid){
			$this->load->database();
			$query = $this->db->query("SELECT * FROM employeebankaccount where employeeId = '$userid'");
			return $query->row();
		}
		public function getEmployeeCourses($userid){
			$this->load->database();
			$query = $this->db->query("SELECT * FROM employeecourses where employeeId  = '$userid'");
			return $query->result();
		}
		public function getEmployeeMedicalInfo($userid){
			$this->load->database();
			$query = $this->db->query("SELECT * FROM employeemedicalinfo where employeeNo  = '$userid'");
			return $query->row();
		}
		public function getEmployeeMedicals($userid){
			$this->load->database();
			$query = $this->db->query("SELECT * FROM employeemedicals where employeeId  = '$userid'");
			return $query->result();
		}
		public function getEmployeeRecord($userid){
			$this->load->database();
			$query = $this->db->query("SELECT * FROM employeerecord where employeeId = '$userid'");
			return $query->row();
		}
		public function getEmployeeSuperfunds($userid){
			$this->load->database();
			$query = $this->db->query("SELECT * FROM employeesuperfund as es INNER JOIN superfund as s on s.superfundid = es.superfundid  where employeeId IN (SELECT userid FROM employee where userid = '$userid')");
			return $query->row();
		}
		public function getEmployeeTaxDec($userid){
			$this->load->database();
			$query = $this->db->query("SELECT * FROM employeetaxdeclaration where employeeId  = '$userid'");
			return $query->row();
		}

		public function getEmployeeDocuments($userid){
			$this->load->database();
			$query = $this->db->query("SELECT * from employeedocuments where userid = '$userid'");
			return $query->result();
		}

		public function editEmployeeEntitlement($level,$empId){
			$this->load->database();
			$query = $this->db->query("UPDATE users SET level = $level where id='$empId'");
		}

		public function updateEmployeeCourses($id, $xeroEmployeeId,$course_nme,$course_desc,$date_obt,$exp_date){
			$this->load->database();
			$query = $this->db->query("UPDATE  employeecourses SET employeeId = '$xeroEmployeeId', courseName = '$course_nme' , courseDescription = '$course_desc' , dateObtained = '$date_obt' , courseExpiryDate = '$exp_date' where id = '$id'");
		}
		public function updateUsers($employee_no,$emails,$name,$title,$userid,$alias){
			$this->load->database();
			$query = $this->db->query("UPDATE  users SET 	email = '$emails', name = '$name', created_at = NOW(), created_by = '$userid', alias = '$alias' where id = '$employee_no'");
		}
		public function updateEmployeeBankAccount( $employeeNo,$accountName,$bsb,$accountNumber,$remainderYN,$amount){
			$this->load->database();
			$check = $this->db->query("SELECT * from employeebankaccount where employeeId = '$employeeNo'");
			$check = $check->row();
			if($check != null && $check != ""){
				$query = $this->db->query("UPDATE  employeebankaccount SET  accountName = '$accountName', bsb = '$bsb', accountNumber = '$accountNumber', remainderYN = '$remainderYN', amount = '$amount' where employeeId  = '$employeeNo'");
			}
			else{
				$query = $this->db->query("INSERT INTO employeebankaccount (employeeId, accountName, bsb, accountNumber, remainderYN, amount) VALUES ( '$employeeNo','$accountName','$bsb','$accountNumber','$remainderYN','$amount')");
			}
		}
		public function updateEmployeeMedicalInfo($employee_no,$medicareNo, $medicareRefNo,$healthInsuranceFund,$healthInsuranceNo, $ambulanceSubscriptionNo){
			$this->load->database();
			$query = $this->db->query("UPDATE employeemedicalinfo  SET medicareNo = '$medicareNo', medicareRefNo = '$medicareRefNo', healthInsuranceFund = '$healthInsuranceFund', healthInsuranceNo = '$healthInsuranceNo' , ambulanceSubscriptionNo = '$ambulanceSubscriptionNo'
 					where employeeNo = '$employee_no'");
		}
		public function updateEmployeeMedicals( $id,$employee_no,$medC,$medA,$medic,$dietary){
			$this->load->database();
			$query = $this->db->query("UPDATE employeemedicals SET 
			employeeId = '$employee_no',medicalConditions = '$medC',medicalAllergies = '$medA', medication = '$medic', dietaryPreferences = '$dietary' where id = '$id'");
		}
		public function updateEmployeeRecord($employee_no, $xeroEmployeeId,  $qual_towards_desc, $highest_qual_held, $qual_towards_percent_comp, $visa_type, $visa_grant_date, $visa_end_date, $visa_conditions, $highest_qual_date_obtained,  $visa_holder,$resume_doc,$contract_doc){
			$this->load->database();
			$query = $this->db->query("UPDATE employeerecord SET   EmployeeId = '$xeroEmployeeId',  otherQualDesc = '$qual_towards_desc', highestQualHeld = '$highest_qual_held', qualTowardsPercentcomp = '$qual_towards_percent_comp', visaType = '$visa_type', visaGrantDate = '$visa_grant_date', visaEndDate = '$visa_end_date', visaConditions = '$visa_conditions', highestQualDateObtained = '$highest_qual_date_obtained',  visaHolderYN = '$visa_holder' , resumeDoc = '$resume_doc' , contractDocument = '$contract_doc' where employeeNo = '$employee_no'");
		}

		public function getStates(){
			$this->load->database();
			$query = $this->db->query("SELECT * FROM states");
			return $query->result();
		}
		public function updateEmployeeSuperfunds( $employee_no, $superFundId,$superMembershipId){
			$this->load->database();
			$query = $this->db->query("UPDATE employeesuperfund SET superFundId = '$superFundId', 
				superMembershipId = '$superMembershipId' where employeeId = '$employee_no'");
		}
		public function updateEmployeeTaxDeclaration($employee_no,$tfnExemptionType,$taxFileNumber,$australiantResidentForTaxPurposeYN,$residencyStatue,$taxFreeThresholdClaimedYN,$taxOffsetEstimatedAmount,$hasHELPDebtYN,$hasSFSSDebtYN,$hasTradeSupportLoanDebtYN_,$upwardVariationTaxWitholdingAmount,$eligibleToReceiveLeaveLoadingYN,$approvedWitholdingVariationPercentage){
			$this->load->database();
			$query = $this->db->query("UPDATE employeetaxdeclaration SET 
				tfnExemptionType = '$tfnExemptionType', taxFileNumber = '$taxFileNumber', australiantResidentForTaxPurposeYN = '$australiantResidentForTaxPurposeYN', residencyStatue = '$residencyStatue', taxFreeThresholdClaimedYN = '$taxFreeThresholdClaimedYN', taxOffsetEstimatedAmount = '$taxOffsetEstimatedAmount', hasHELPDebtYN = '$hasHELPDebtYN', hasSFSSDebtYN = '$hasSFSSDebtYN', hasTradeSupportLoanDebtYN = '$hasTradeSupportLoanDebtYN_', upwardVariationTaxWitholdingAmount = '$upwardVariationTaxWitholdingAmount', eligibleToReceiveLeaveLoadingYN = '$eligibleToReceiveLeaveLoadingYN', approvedWitholdingVariationPercentage = '$approvedWitholdingVariationPercentage' where employeeId  = '$employee_no'");
		}
		public function updateEmployeeTable($employee_no, $title,$fname,$mname,$lname,$emails,$dateOfBirth,$gender,$homeAddLine1,$homeAddLine2,$homeAddCity,$homeAddRegion,$homeAddPostal,$homeAddCountry,$phone,$mobile,$terminationDate,$ordinaryEarningRateId,$userid,$classification,$emergency_contact,$relationship,$emergency_contact_email){
			$this->load->database();
			$check = $this->db->query("SELECT * from employee where userid = '$employee_no'");
			$check = $check->row();
			if($check != null && $check != ""){
			$query = $this->db->query("UPDATE employee SET 	title = '$title', fname = '$fname', mname = '$mname', lname = '$lname', emails = '$emails', dateOfBirth = '$dateOfBirth', gender = '$gender', homeAddLine1 = '$homeAddLine1', homeAddLine2 = '$homeAddLine2', homeAddCity = '$homeAddCity', homeAddRegion = '$homeAddRegion', homeAddPostal = '$homeAddPostal', homeAddCountry = '$homeAddCountry', phone = '$phone', mobile = '$mobile', terminationDate = '$terminationDate', ordinaryEarningRateId = '$ordinaryEarningRateId', classification = '$classification',  emergency_contact = '$emergency_contact', relationship = '$relationship', emergency_contact_email = '$emergency_contact_email' where userid = '$employee_no'");
				}
				else{
			$query = $this->db->query("INSERT INTO employee (userid,  title, fname, mname, lname, emails, dateOfBirth,  gender, homeAddLine1, homeAddLine2, homeAddCity, homeAddRegion, homeAddPostal, homeAddCountry, phone, mobile,  terminationDate, ordinaryEarningRateId,  created_at, created_by, classification,  emergency_contact, relationship, emergency_contact_email) VALUES ('$employee_no', '$title','$fname','$mname','$lname','emails','$dateOfBirth','$gender','$homeAddLine1','$homeAddLine2','$homeAddCity','$homeAddRegion','$homeAddPostal','$homeAddCountry','$phone','$mobile','$terminationDate','$ordinaryEarningRateId',NOW(),'$userid','$classification','$emergency_contact','$relationship','$emergency_contact_email')");
				}
			}
// 		// add center 

	public function addCenter($addStreet,$addCity,$addState,$addZip,$name,$centre_phone_number,$centre_mobile_number,$Centre_email,$userid){
		$this->load->database();
		$query = $this->db->query("INSERT INTO centers (addStreet, addCity, addState, addZip, name, centre_phone_number, centre_mobile_number, centre_email) VALUES ('$addStreet','$addCity','$addState','$addZip','$name','$centre_phone_number','$centre_mobile_number','$Centre_email')");
		$id = $this->db->query("SELECT centerid FROM centers ORDER BY centerid DESC LIMIT 1");
		$centers = $this->db->query("SELECT center FROM users where id = '$userid'");
		$centerId = strval(($id->row())->centerid);
					$this->db->query("UPDATE users set center = CONCAT(center,'|$centerId') where id='$userid'");
		return strval(($id->row())->centerid);
	}

	public function addRoom($centerid,$room_name,$capacity_,$minimum_age,$maximum_age){
		$this->load->database();
		$uniqueId = uniqid();
		$query = $this->db->query("INSERT INTO room (roomId,centerid,name,capacity,careAgeFrom,careAgeTo) VALUES ('$uniqueId',$centerid,'$room_name','$capacity_','$minimum_age','$maximum_age')");
	}

		public function addCenterRecord($centerid,$centerRecordUniqueId,$centre_abn,$centre_acn,$centre_se_no,$centre_date_opened,$centre_capacity,$centre_approval_doc,$centre_ccs_doc,$centre_admin_name,$centre_nominated_supervisor){
			$this->load->database();
			$query = $this->db->query("INSERT INTO centerrecord (centerId,centerRecordUniqueId,centreABN,centreACN,centreSE_no,centreDateOpened,centreCapacity,centreApprovalDoc,centreCCSDoc,centreAdminId,centreNominatedSupervisorId) VALUES ($centerid,'$centerRecordUniqueId','$centre_abn','$centre_acn','$centre_se_no','$centre_date_opened','$centre_capacity','$centre_approval_doc','$centre_ccs_doc','$centre_admin_name','$centre_nominated_supervisor')");
		}

		public function getCenterDetails($centerid){
			$this->load->database();
			$query = $this->db->query("SELECT * FROM centers LEFT join centerrecord on centerrecord.centerid = centers.centerid where centers.centerid='$centerid'");
			return $query->row();
		}
		public function roomsForCenter($centerid){
			$this->load->database();
			$query = $this->db->query("SELECT * FROM room where centerid='$centerid' ");
			return $query->result();
		}

		public function addPermissions($userid, $isQrReaderYN , $viewRosterYN , $editRosterYN , $viewTimesheetYN , $editTimesheetYN , $viewPayrollYN , $editPayrollYN , $editLeaveTypeYN , $viewLeaveTypeYN , $createNoticeYN , $viewOrgChartYN , $editOrgChartYN , $viewCenterProfileYN , $editCenterProfileYN , $viewRoomSettingsYN , $editRoomSettingsYN , $viewEntitlementsYN , $editEntitlementsYN , $editEmployeeYN , $xeroYN , $viewAwardsYN , $editAwardsYN , $viewSuperfundsYN , $editSuperfundsYN , $createMomYN , $editPermissionYN , $viewPermissionYN ){
				$this->load->database();
				$query = $this->db->query("INSERT INTO permissions (userid, isQrReaderYN, viewRosterYN, editRosterYN, viewTimesheetYN, editTimesheetYN, viewPayrollYN, editPayrollYN, editLeaveTypeYN, viewLeaveTypeYN, createNoticeYN, viewOrgChartYN, editOrgChartYN, viewCenterProfileYN, editCenterProfileYN, viewRoomSettingsYN, editRoomSettingsYN, viewEntitlementsYN, editEntitlementsYN, editEmployeeYN, xeroYN, viewAwardsYN, editAwardsYN, viewSuperfundsYN, editSuperfundsYN, createMomYN, editPermissionYN, viewPermissionYN	) VALUES ('$userid', '$isQrReaderYN', '$viewRosterYN', '$editRosterYN', '$viewTimesheetYN', '$editTimesheetYN', '$viewPayrollYN', '$editPayrollYN', '$editLeaveTypeYN', '$viewLeaveTypeYN', '$createNoticeYN', '$viewOrgChartYN', '$editOrgChartYN', '$viewCenterProfileYN', '$editCenterProfileYN', '$viewRoomSettingsYN', '$editRoomSettingsYN', '$viewEntitlementsYN', '$editEntitlementsYN', '$editEmployeeYN', '$xeroYN', '$viewAwardsYN', '$editAwardsYN', '$viewSuperfundsYN',' $editSuperfundsYN', '$createMomYN', '$editPermissionYN', '$viewPermissionYN'	)");
		}

		public function getUserCenters($employeeId){
			$this->load->database();
			$query = $this->db->query("SELECT * FROM usercenters where userid = '$employeeId'");
			return $query->result();
		}
		public function syncedWithXero($centerid){
			$this->load->database();
			$query = $this->db->query("SELECT * from xeroaccesstoken where centerid = $centerid");
			return $query->row();
		}

		public function insertToDocuments($fileName,$documentName,$userid){
			$this->load->database();
			$query = $this->db->query("INSERT INTO employeedocuments (name,userid,document) VALUES ('$fileName','$userid','$documentName')");
		}

		public function deleteEmployeeCenters($empId){
			$this->load->database();
			$query = $this->db->query("DELETE from usercenters where userid = '$empId'");
		}

		public function editEmployeeCenter($center,$empId){
			$this->load->database();
			$query = $this->db->query("INSERT INTO usercenters (userid,centerid) VALUES ('$empId',$center)");
		}

		public function updateEmployeeCenter($center,$empId){
			$this->load->database();
			$query =  $this->db->query("UPDATE users SET center = '$center' where id='$empId'");
		}

	public function deleteDocument($documentId){
		$this->load->database();
		$query = $this->db->query("DELETE from employeedocuments where id = '$documentId'");
	}

	public function deletecourse($courseId){
		$this->load->database();
		$query = $this->db->query("DELETE from employeecourses where id = '$courseId'");
	}


	// Migrations
	public function employeeSuperfundsMigration(){
		$this->load->database();
		$query = $this->db->query("SELECT * from employeesuperfund");
		return $query->result();
	}
	public function employeeSuperfundsMigrations($xeroEmpId,$id){
		$this->load->database();
		$query = $this->db->query("SELECT * from employee where xeroEmployeeId = '$xeroEmpId'");
		$uid = ($query->row());
		if($uid != null && $uid != ""){
			$uid = $uid->userid;
			$this->db->query("UPDATE employeesuperfund SET employeeId = '$uid' where id=$id");
		}
	}

	public function employeeTaxDeclarationMigration(){
		$this->load->database();
		$query = $this->db->query("SELECT * from employeetaxdeclaration");
		return $query->result();
	}

	public function employeeTaxDeclarationMigrations($xeroEmpId){
		$this->load->database();
		$query = $this->db->query("SELECT * from employee where xeroEmployeeId = '$xeroEmpId'");
		$uid = ($query->row());
		if($uid != null && $uid != ""){
			$uid = $uid->userid;
			$this->db->query("UPDATE employeetaxdeclaration SET employeeId = '$uid' where employeeId = '$xeroEmpId'");
		}
	}

	public function getAllUsers(){
		$this->load->database();
		$query = $this->db->query('SELECT * from users');
		return $query->result();
	}

	// public function employeeRecordMigration(){
	// 	$this->load->database();
	// 	$query = $this->db->query("SELECT * from employeetaxdeclaration");
	// 	return $query->result();
	// }

	// public function employeeRecordMigrations($xeroEmpId){
	// 	$this->load->database();
	// 	$query = $this->db->query("SELECT * from employee where xeroEmployeeId = '$xeroEmpId'");
	// 	$uid = ($query->row());
	// 	if($uid != null && $uid != ""){
	// 		$uid = $uid->userid;
	// 		$this->db->query("UPDATE employeetaxdeclaration SET employeeId = '$uid' where employeeId = '$xeroEmpId'");
	// 	}
	// }
}
