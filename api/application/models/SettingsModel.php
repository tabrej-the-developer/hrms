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
			$this->db->query("INSERT INTO kidsoft (center,kidsoftkey,createdate) VALUES ($centerid,'$key','$date')");
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
		$check = $this->db->query("SELECT * FROM centerrecord where centerId = $centerid");
		$centerRecordUniqueId = uniqid();
		if($check->row() != null)
			$this->db->query("UPDATE centerrecord SET centerId = '$centerid',centreABN = '$center_abn',centreACN = '$center_acn',centreSE_no = '$center_se_no',centreDateOpened = '$center_date_opened',centreCapacity = '$center_capacity',managerId = '$manager_name',centreAdminId = '$center_admin_name',centreNominatedSupervisorId = '$centre_nominated_supervisor' WHERE centerId = $centerid");
		else
			$this->db->query("INSERT INTO centerrecord (centerId,centerRecordUniqueId,centreABN,centreACN,centreSE_no,centreDateOpened,centreCapacity,centreAdminId,centreNominatedSupervisorId) VALUES ($centerid,'$centerRecordUniqueId','$center_abn','$center_acn','$center_se_no','$center_date_opened','$center_capacity','$center_admin_name','$centre_nominated_supervisor')");
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

	public function insertPermission($userid,$isQrReaderYN,$viewRosterYN,$editRosterYN,$viewTimesheetYN,$editTimesheetYN,$viewPayrollYN,$editPayrollYN,$editLeaveTypeYN,$viewLeaveTypeYN,$createNoticeYN,$viewOrgChartYN,$editOrgChartYN,$viewCenterProfileYN,$editCenterProfileYN,$viewRoomSettingsYN,$editRoomSettingsYN,$viewEntitlementsYN,$editEntitlementsYN,$editEmployeeYN,$xeroYN,$viewAwardsYN,$editAwardsYN,$viewSuperfundsYN,$editSuperfundsYN,$createMomYN,$editPermissionYN,$viewPermissionYN,$kidsoftYN){

		$this->load->database();
		$this->db->query("DELETE FROM permissions WHERE userid = '$userid'");
		$this->db->query("INSERT INTO permissions VALUES('$userid','$isQrReaderYN','$viewRosterYN','$editRosterYN','$viewTimesheetYN','$editTimesheetYN','$viewPayrollYN','$editPayrollYN','$editLeaveTypeYN','$viewLeaveTypeYN','$createNoticeYN','$viewOrgChartYN','$editOrgChartYN','$viewCenterProfileYN','$editCenterProfileYN','$viewRoomSettingsYN','$editRoomSettingsYN','$viewEntitlementsYN','$editEntitlementsYN','$editEmployeeYN','$xeroYN','$viewAwardsYN','$editAwardsYN','$viewSuperfundsYN','$editSuperfundsYN','$createMomYN','$editPermissionYN','$viewPermissionYN','$kidsoftYN')");
	}
	
		public function addToEmployeeCourses( $xeroEmployeeId,$course_nme,$course_desc,$date_obt,$exp_date,$certName=null){
			$this->load->database();
			$opt = "";
			if($certName != null && $certName != ""){
				$certName = " , '$certName'";
				$opt = ' , courseCertificate';
			}
			$query = $this->db->query("INSERT INTO employeecourses (employeeId, courseName, courseDescription, dateObtained, courseExpiryDate  $opt) VALUES ( '$xeroEmployeeId','$course_nme','$course_desc','$date_obt','$exp_date' $certName)");
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

		public function addToUsers($employee_no,$password, $emails,$name,$center,$userid,$role,$level,$alias,$fileNameLoc=null,$bonusRate=null){
			$this->load->database();
			if($center == ""){
				$query = $this->db->query("INSERT INTO users (id,password, email, name,created_at, created_by,roleid,level,alias,isVerified,imageUrl,bonusRate) VALUES ('$employee_no','$password','$emails','$name',NOW(),'$userid',$role,'$level','$alias','N','$fileNameLoc','$bonusRate')");
			}else{
				$query = $this->db->query("INSERT INTO users (id,password, email, name,created_at, created_by,roleid,level,alias,isVerified,imageUrl,center,bonusRate) VALUES ('$employee_no','$password','$emails','$name',NOW(),'$userid',$role,'$level','$alias','N','$fileNameLoc','$center','$bonusRate')");

			}
		}

		public function addToUsersME($employee_no,$password, $emails,$name,$center,$userid,$role,$level,$alias){
			$this->load->database();
			$query = $this->db->query("INSERT INTO users (id,password, email, name,created_at, created_by,roleid,level,alias,isVerified) VALUES ('$employee_no','$password','$emails','$name',NOW(),'$userid',$role,'$level','$alias','N')");
			$this->db->query("INSERT INTO usercenters (userid,centerid) VALUES ('$userid',$center)");
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
		public function addToEmployeeSuperfunds( $employee_no, $superFundId, $superMembershipId,$superfundEmployeeNumber,$centerid=null){
			$this->load->database();
			if($centerid != null){
			$query = $this->db->query("INSERT INTO employeesuperfund (employeeId, superFundId, superMembershipId,employeeNumber,centerid) VALUES ('$employee_no', '$superFundId', '$superMembershipId','$superfundEmployeeNumber',$centerid)");
			}
			else{
				$query = $this->db->query("INSERT INTO employeesuperfund (employeeId, superFundId, superMembershipId,employeeNumber) VALUES ('$employee_no', '$superFundId', '$superMembershipId','$superfundEmployeeNumber')");
			}
		}
		public function deleteEmployeeSuperfunds($employee_no,$centerid){
			$this->load->database();
			$this->db->query("DELETE from employeesuperfund where employeeId = '$employee_no' and centerid = $centerid");
		}

		public function addToEmployeeTaxDeclaration($xeroEmployeeId,$employmentBasis,$tfnExemptionType,$taxFileNumber,$australiantResidentForTaxPurposeYN,$residencyStatue,$taxFreeThresholdClaimedYN,$taxOffsetEstimatedAmount,$hasHELPDebtYN,$hasSFSSDebtYN,$hasTradeSupportLoanDebtYN_,$upwardVariationTaxWitholdingAmount,$eligibleToReceiveLeaveLoadingYN,$approvedWitholdingVariationPercentage){
			$this->load->database();
			$query = $this->db->query("INSERT INTO employeetaxdeclaration (employeeId, employmentBasis, tfnExemptionType, taxFileNumber, australiantResidentForTaxPurposeYN, residencyStatue, taxFreeThresholdClaimedYN, taxOffsetEstimatedAmount, hasHELPDebtYN, hasSFSSDebtYN, hasTradeSupportLoanDebtYN, upwardVariationTaxWitholdingAmount, eligibleToReceiveLeaveLoadingYN, approvedWitholdingVariationPercentage) VALUES ('$xeroEmployeeId','$employmentBasis','$tfnExemptionType','$taxFileNumber','$australiantResidentForTaxPurposeYN','$residencyStatue','$taxFreeThresholdClaimedYN','$taxOffsetEstimatedAmount','$hasHELPDebtYN','$hasSFSSDebtYN','$hasTradeSupportLoanDebtYN_','$upwardVariationTaxWitholdingAmount','$eligibleToReceiveLeaveLoadingYN','$approvedWitholdingVariationPercentage')");
		}
		public function addToEmployeeTable($employee_no, $xeroEmployeeId,$title,$fname,$mname,$lname,$emails,$dateOfBirth,$gender,$homeAddLine1,$homeAddLine2,$homeAddCity,$homeAddRegion,$homeAddPostal,$homeAddCountry,$phone,$mobile,$startDate,$terminationDate,$ordinaryEarningRateId,$payrollCalendarId,$userid,$classification,$emergency_contact,$relationship,$emergency_contact_email,$maxhours,$days){
			$this->load->database();
			$query = $this->db->query("INSERT INTO employee (userid, xeroEmployeeId, title, fname, mname, lname, emails, dateOfBirth, gender, homeAddLine1, homeAddLine2, homeAddCity, homeAddRegion, homeAddPostal, homeAddCountry, phone, mobile, startDate, terminationDate, ordinaryEarningRateId, payrollCalendarId, created_at, created_by, classification,  emergency_contact, relationship, emergency_contact_email,maxhours,days) VALUES ('$employee_no', '$xeroEmployeeId','$title','$fname','$mname','$lname','$emails','$dateOfBirth','$gender','$homeAddLine1','$homeAddLine2','$homeAddCity','$homeAddRegion','$homeAddPostal','$homeAddCountry','$phone','$mobile','$startDate','$terminationDate','$ordinaryEarningRateId','$payrollCalendarId',NOW(),'$userid','$classification','$emergency_contact','$relationship','$emergency_contact_email',$maxhours,'$days')");
		}

		public function getUserData($userid){
			$this->load->database();
			$query = $this->db->query("SELECT * FROM users where id = '$userid'");
			return $query->row();
		}
		
		public function getUserAwardsData($userid){
			$this->load->database();
			$query = $this->db->query("SELECT ea.*,ps.name FROM employee_awards ea JOIN payrollshifttype_v1 ps ON ea.earningRateId = ps.earningRateId where ea.userid = '$userid' GROUP BY id;");
			return $query->result();
		}

		public function getEmployeeData($userid){
			$this->load->database();
			// $query = $this->db->query("SELECT * FROM employee as e LEFT JOIN payrollshifttype_v1 as ps on e.ordinaryEarningRateId = ps.earningRateId  where e.userid = '$userid'");
			$query = $this->db->query("SELECT e.*,ps.*,u.level,u.roleid,u.bonusRate,en.name as enName,en.hourlyRate,ocr.roleName FROM employee as e LEFT JOIN payrollshifttype_v1 as ps on e.ordinaryEarningRateId = ps.earningRateId LEFT JOIN users as u on u.id=e.userid LEFT JOIN entitlements as en ON en.id=u.level LEFT JOIN orgchartroles as ocr on ocr.roleid=u.roleid where e.userid = '$userid'; ");
			return $query->row();
		}
		public function getEmployeeBankAccount($userid){
			$this->load->database();
			$query = $this->db->query("SELECT * FROM employeebankaccount where employeeId = '$userid'");
			return $query->result();
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
			$query = $this->db->query("SELECT * FROM employeerecord where employeeNo = '$userid'");
			return $query->row();
		}
		public function getEmployeeSuperfunds($userid,$centerid){
			$this->load->database();
			$query = $this->db->query("SELECT es.*,s.name FROM employeesuperfund as es INNER JOIN superfund as s on s.superfundid = es.superfundid AND es.centerid = s.centerid where es.employeeId = '$userid' AND es.centerid = $centerid ");
			return $query->result();
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

		public function updateEmployeeCourses($id, $xeroEmployeeId,$course_nme,$course_desc,$date_obt,$exp_date,$certName){
			$this->load->database();
			if($certName != null){
				$certName = " , courseCertificate = '$certName'";
			}
			$query = $this->db->query("UPDATE  employeecourses SET employeeId = '$xeroEmployeeId', courseName = '$course_nme' , courseDescription = '$course_desc' , dateObtained = '$date_obt' , courseExpiryDate = '$exp_date' $certName  where id = '$id'");
		}
		public function updateUsers($employee_no,$emails,$name,$title,$userid,$alias){
			$this->load->database();
			$query = $this->db->query("UPDATE  users SET email = '$emails', name = '$name', created_at = NOW(), created_by = '$userid', alias = '$alias' where id = '$employee_no'");
		}
		public function updateEmployeeBankAccount( $employeeNo,$accountName,$bsb,$accountNumber,$remainderYN,$amount){
			$this->load->database();
			$query = $this->db->query("INSERT INTO employeebankaccount (employeeId, accountName, bsb, accountNumber, remainderYN, amount) VALUES ( '$employeeNo','$accountName','$bsb','$accountNumber','$remainderYN','$amount')");
		}

		public function deleteFromBankAccount($employee_no){
			$this->load->database();
			$this->db->query("DELETE FROM employeebankaccount where employeeId = '$employee_no'");
		}

		public function updateEmployeeMedicalInfo($employee_no,$medicareNo, $medicareRefNo,$healthInsuranceFund,$healthInsuranceNo, $ambulanceSubscriptionNo){
			$this->load->database();
			$check = $this->db->query("SELECT * FROM employeemedicalinfo where employeeNo = '$employee_no'");
			if($check->row() != null){
			$query = $this->db->query("UPDATE employeemedicalinfo  SET medicareNo = '$medicareNo', medicareRefNo = '$medicareRefNo', healthInsuranceFund = '$healthInsuranceFund', healthInsuranceNo = '$healthInsuranceNo' , ambulanceSubscriptionNo = '$ambulanceSubscriptionNo'
 					where employeeNo = '$employee_no'");
			}else{
				$query = $this->db->query("INSERT INTO employeemedicalinfo  SET medicareNo = '$medicareNo', medicareRefNo = '$medicareRefNo', healthInsuranceFund = '$healthInsuranceFund', healthInsuranceNo = '$healthInsuranceNo' , ambulanceSubscriptionNo = '$ambulanceSubscriptionNo'
			, employeeNo = '$employee_no'");
			}
		}
		public function updateEmployeeMedicals( $id,$employee_no,$medC,$medA,$medic,$dietary){
			$this->load->database();
			$query = $this->db->query("UPDATE employeemedicals SET 
			employeeId = '$employee_no',medicalConditions = '$medC',medicalAllergies = '$medA', medication = '$medic', dietaryPreferences = '$dietary' where id = '$id'");
		}
		public function updateEmployeeRecord($employee_no, $xeroEmployeeId,  $qual_towards_desc, $highest_qual_held, $qual_towards_percent_comp, $visa_type, $visa_grant_date, $visa_end_date, $visa_conditions, $highest_qual_date_obtained,  $visa_holder,$resume_doc,$contract_doc){
			$this->load->database();
			$check = $this->db->query("SELECT * FROM employeerecord where employeeNo = '$employee_no'");
			if($check->row() != null){
				if($resume_doc == null && $contract_doc == null){
					$doc = "";
				}
				if($resume_doc == null && $contract_doc != null){
					$doc = " , contractDocument = '$contract_doc'";
				}
				if($resume_doc != null && $contract_doc == null){
					$doc = "  ,resumeDoc = '$resume_doc' ";
				}
				if($resume_doc != null && $contract_doc != null){
					$doc = " ,resumeDoc = '$resume_doc' , contractDocument = '$contract_doc'";
				}
				$query = $this->db->query("UPDATE employeerecord SET   EmployeeId = '$xeroEmployeeId',  otherQualDesc = '$qual_towards_desc', highestQualHeld = '$highest_qual_held', qualTowardsPercentcomp = '$qual_towards_percent_comp', visaType = '$visa_type', visaGrantDate = '$visa_grant_date', visaEndDate = '$visa_end_date', visaConditions = '$visa_conditions', highestQualDateObtained = '$highest_qual_date_obtained',  visaHolderYN = '$visa_holder'  $doc where employeeNo = '$employee_no'");
			}else{
				$query = $this->db->query("INSERT INTO employeerecord SET   EmployeeId = '$xeroEmployeeId',  otherQualDesc = '$qual_towards_desc', highestQualHeld = '$highest_qual_held', qualTowardsPercentcomp = '$qual_towards_percent_comp', visaType = '$visa_type', visaGrantDate = '$visa_grant_date', visaEndDate = '$visa_end_date', visaConditions = '$visa_conditions', highestQualDateObtained = '$highest_qual_date_obtained',  visaHolderYN = '$visa_holder' , resumeDoc = '$resume_doc' , contractDocument = '$contract_doc' , employeeNo = '$employee_no'");
			}
		}

		public function getStates(){
			$this->load->database();
			$query = $this->db->query("SELECT * FROM states");
			return $query->result();
		}
		public function updateEmployeeSuperfunds( $employee_no, $superFundId,$superMembershipId){
			$this->load->database();
			$check = $this->db->query("SELECT * FROM employeesuperfund where employeeId = '$employee_no'");
			if($check->row() != null){
				$query = $this->db->query("UPDATE employeesuperfund SET superFundId = '$superFundId', 
				superMembershipId = '$superMembershipId' where employeeId = '$employee_no'");
			}else{
				$this->db->query("INSERT into employeesuperfund SET superFundId = '$superFundId', 
				superMembershipId = '$superMembershipId' , employeeId = '$employee_no'");
			}
		}
		public function updateEmployeeTaxDeclaration($employee_no,$tfnExemptionType,$taxFileNumber,$australiantResidentForTaxPurposeYN,$residencyStatue,$taxFreeThresholdClaimedYN,$taxOffsetEstimatedAmount,$hasHELPDebtYN,$hasSFSSDebtYN,$hasTradeSupportLoanDebtYN_,$upwardVariationTaxWitholdingAmount,$eligibleToReceiveLeaveLoadingYN,$approvedWitholdingVariationPercentage){
			$this->load->database();
			$check = $this->db->query("SELECT * FROM employeetaxdeclaration where employeeId = '$employee_no' ");
			if($check->row() == null){
				$query = $this->db->query("INSERT INTO employeetaxdeclaration SET 
				tfnExemptionType = '$tfnExemptionType', taxFileNumber = '$taxFileNumber', australiantResidentForTaxPurposeYN = '$australiantResidentForTaxPurposeYN', residencyStatue = '$residencyStatue', taxFreeThresholdClaimedYN = '$taxFreeThresholdClaimedYN', taxOffsetEstimatedAmount = '$taxOffsetEstimatedAmount', hasHELPDebtYN = '$hasHELPDebtYN', hasSFSSDebtYN = '$hasSFSSDebtYN', hasTradeSupportLoanDebtYN = '$hasTradeSupportLoanDebtYN_', upwardVariationTaxWitholdingAmount = '$upwardVariationTaxWitholdingAmount', eligibleToReceiveLeaveLoadingYN = '$eligibleToReceiveLeaveLoadingYN', approvedWitholdingVariationPercentage = '$approvedWitholdingVariationPercentage', employeeId  = '$employee_no'");
			}else{
			$query = $this->db->query("UPDATE employeetaxdeclaration SET 
				tfnExemptionType = '$tfnExemptionType', taxFileNumber = '$taxFileNumber', australiantResidentForTaxPurposeYN = '$australiantResidentForTaxPurposeYN', residencyStatue = '$residencyStatue', taxFreeThresholdClaimedYN = '$taxFreeThresholdClaimedYN', taxOffsetEstimatedAmount = '$taxOffsetEstimatedAmount', hasHELPDebtYN = '$hasHELPDebtYN', hasSFSSDebtYN = '$hasSFSSDebtYN', hasTradeSupportLoanDebtYN = '$hasTradeSupportLoanDebtYN_', upwardVariationTaxWitholdingAmount = '$upwardVariationTaxWitholdingAmount', eligibleToReceiveLeaveLoadingYN = '$eligibleToReceiveLeaveLoadingYN', approvedWitholdingVariationPercentage = '$approvedWitholdingVariationPercentage' where employeeId  = '$employee_no'");
			}
		}
		public function updateEmployeeTable($employee_no, $title,$fname,$mname,$lname,$emails,$dateOfBirth,$gender,$homeAddLine1,$homeAddLine2,$homeAddCity,$homeAddRegion,$homeAddPostal,$homeAddCountry,$phone,$mobile,$terminationDate,$ordinaryEarningRateId,$userid,$classification,$emergency_contact,$relationship,$emergency_contact_email,$maxhours){
			$this->load->database();
			$check = $this->db->query("SELECT * from employee where userid = '$employee_no'");
			$check = $check->row();
			if($check != null && $check != ""){
				$ordinaryEarningRate = "";
				if($userid == $employee_no){
					$ordinaryEarningRate = ", ordinaryEarningRateId = '\"$ordinaryEarningRateId\"'";
				}
			$query = $this->db->query("UPDATE employee SET 	title = '$title', fname = '$fname', mname = '$mname', lname = '$lname', emails = '$emails', dateOfBirth = '$dateOfBirth', gender = '$gender', homeAddLine1 = '$homeAddLine1', homeAddLine2 = '$homeAddLine2', homeAddCity = '$homeAddCity', homeAddRegion = '$homeAddRegion', homeAddPostal = '$homeAddPostal', homeAddCountry = '$homeAddCountry' $ordinaryEarningRate, phone = '$phone', mobile = '$mobile', terminationDate = '$terminationDate', classification = '$classification',  emergency_contact = '$emergency_contact', relationship = '$relationship', emergency_contact_email = '$emergency_contact_email', maxhours = '$maxhours', days='00000' where userid = '$employee_no'");
				}
				else{
			$query = $this->db->query("INSERT INTO employee (userid,  title, fname, mname, lname, emails, dateOfBirth,  gender, homeAddLine1, homeAddLine2, homeAddCity, homeAddRegion, homeAddPostal, homeAddCountry, phone, mobile,  terminationDate, ordinaryEarningRateId,  created_at, created_by, classification,  emergency_contact, relationship, emergency_contact_email, maxhours, days) VALUES ('$employee_no', '$title','$fname','$mname','$lname','$emails','$dateOfBirth','$gender','$homeAddLine1','$homeAddLine2','$homeAddCity','$homeAddRegion','$homeAddPostal','$homeAddCountry','$phone','$mobile','$terminationDate','$ordinaryEarningRateId',NOW(),'$userid','$classification','$emergency_contact','$relationship','$emergency_contact_email', '$maxhours', '00000')");
				}
			}
// 		// add center 

	public function addCenter($addStreet,$addCity,$addState,$addZip,$name,$centre_phone_number,$centre_mobile_number,$Centre_email,$userid,$uniqid){
		$this->load->database();
		$query = $this->db->query("INSERT INTO centers (addStreet, addCity, addState, addZip, name, centre_phone_number, centre_mobile_number, centre_email,superadmin) VALUES ('$addStreet','$addCity','$addState','$addZip','$name','$centre_phone_number','$centre_mobile_number','$Centre_email','$uniqid')");
		$id = $this->db->query("SELECT centerid FROM centers ORDER BY centerid DESC LIMIT 1");
		$centers = $this->db->query("SELECT center FROM users where id = '$userid'");
		$centerId = strval(($id->row())->centerid);
					$this->db->query("UPDATE users set center = CONCAT(center,'|$centerId') where id='$userid'");
		return strval(($id->row())->centerid);
	}

	// Get Superadmin 

	public function getSuperadmin($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM centers where centerid = '$centerid'");
		return $query->row();
	}

	public function getNotificationsForUser($userid,$start,$count){
		$this->load->database();
		$query = $this->db->query("SELECT title,intent,body,data,isReadYN,datetime FROM notifications where userid = '$userid' ORDER BY id DESC LIMIT $start , $count ");
		return $query->result();
	}

	public function updateNotifications($userid){
		$this->load->database();
		$query = $this->db->query("UPDATE notifications SET isReadYN = 'Y' WHERE userid = '$userid'");
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


		public function deleteEmployeeAwards($empId){
			$this->load->database();
			$query = $this->db->query("DELETE from employee_awards where userid = '$empId'");
			// echo "DELETE from employee_awards where userid = '$empId'";
		}

		public function editEmployeeAwards($earningRateId,$empId){
			$this->load->database();
			$query = $this->db->query("INSERT INTO employee_awards (userid,earningRateId) VALUES ('$empId','$earningRateId')");
			// echo "INSERT INTO employee_awards (userid,earningRateId) VALUES ('$empId','$earningRateId')";
		}

		public function updateEmployeeAward($earningRateId,$empId){
			$this->load->database();
			$query =  $this->db->query("UPDATE users SET awards = '$earningRateId' where id='$empId'");
			// echo "UPDATE users SET awards = '$earningRateId' where userid='$empId'";
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

	public function updateEmployeeProfileApp($userid, $firstName, $middleName, $lastName, $imageUrl){
		$this->load->database();
		$query = $this->db->query("UPDATE employee SET fname = '$firstName', mname = '$middleName', lname = '$lastName' where userid = '$userid'");
		$name = "$firstName $middleName $lastName";
		$this->db->query("UPDATE users SET name = '$name' where id = '$userid'");
		if($imageUrl != null && $imageUrl != ""){
			$this->db->query("UPDATE users SET imageUrl = '$imageUrl' where id = '$userid'");
		}
	}

	public function getXeroEmployeeId($empId){
		$this->load->database();
		$query = $this->db->query("SELECT xeroEmployeeId FROM employee where userid = '$empId'");
		return $query->row() != null ? ($query->row())->xeroEmployeeId : null ;
	}

	public function fetchNotificationPermissions($userid){
		$this->load->database();
		$query = $this->db->query("SELECT np.typeid,np.appYN,np.emailYN,nt.notificationtype FROM notificationpermissions np INNER JOIN notificationtypes nt on np.typeid = nt.id  where np.userid ='$userid' ");
		return $query->result();
	}

	public function postNotificationPermissions($userid,$notifications){
		$this->load->database();
		$query = $this->db->query("DELETE FROM notificationpermissions where userid = '$userid'");
		foreach($notifications as $key=>$notification){
			$values = array_values($notification);
			$query = $this->db->query("SELECT id from notificationtypes where notificationtype ='$key' ");
			$id = ($query->row() != null) ? ($query->row())->id : null;
			if($id != null){
				$this->db->query("INSERT INTO notificationpermissions (userid,typeid,appYN,emailYN) VALUES ('$userid','$id','$values[0]','$values[1]') ");
			}
		}
	}


	public function postCompanySettings($companyId,$companyImage,$emp_id_prefix){
		$this->load->database();
		$uquery = $this->db->query("UPDATE superadmin SET emp_id_prefix='$emp_id_prefix',companyLogo='$companyImage' WHERE companyid='$companyId';");
		if($uquery){
			return true;
		}else{
			return false;
		}
		// echo "UPDATE superadmin SET emp_id_prefix='$emp_id_prefix',companyLogo='$companyImage' WHERE companyid='$companyId';";
	}

	public function getFullEmployeeId($userid,$role){
		$this->load->database();
		if($role == 1){
			//get company id based on the userid
			$query = $this->db->query("SELECT * FROM superadmin WHERE companyid IN (SELECT superadmin FROM centers WHERE centerid IN (SELECT centerid from usercenters where userid = '$userid'))");
			$result = $query->row();
			$getlastEmp = $this->db->query("SELECT MAX(userid) as lastuserid FROM employee WHERE userid LIKE '%$result->emp_id_prefix%';")->row();
			$getlastEmp->companyIdPrefix = $result->emp_id_prefix;
			return $getlastEmp;
		}else{
			//get created by so based on that created by get company id
			$query = $this->db->query("SELECT companyid FROM superadmin WHERE companyid IN (SELECT superadmin FROM centers WHERE centerid IN (SELECT centerid from usercenters where userid = (SELECT created_by FROM users WHERE id='$userid') ));");
			return $query->row();
		}
	}

	public function getempVisits($centerid){
		$this->load->database();
		$query = $this->db->query('SELECT userid,name,imageUrl,signInDate,signInTime,signOutTime,message,status FROM `visitis` JOIN users ON visitis.userid=users.id WHERE centerid='.$centerid.' and leftCampusYN = "N" and signInDate='.date('Y-m-d').';');
		// $query = $this->db->query('SELECT userid,name,imageUrl,signInDate,signInTime,signOutTime,message,status FROM `visitis` JOIN users ON visitis.userid=users.id WHERE centerid='.$centerid.' and leftCampusYN = "N" and signInDate="2021-08-04";');
		return $query->result_array();
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

	public function companyNameUnique($cn){
		$this->load->database();
		$query = $this->db->query("SELECT companyName FROM superadmin WHERE companyName='$cn';");
		$result = $query->result_array();
		if(empty($result)){
			return true;
		}else{
			return false;
		}
	}

	public function empidprefixUnique($eip){
		$this->load->database();
		$query = $this->db->query("SELECT emp_id_prefix FROM superadmin WHERE emp_id_prefix='$eip'");
		$result = $query->result_array();
		if(empty($result)){
			return true;
		}else{
			return false;
		}
	}

	public function usernameUnique($un){
		$this->load->database();
		$query = $this->db->query("SELECT name FROM users WHERE name='$un'");
		$result = $query->result_array();
		if(empty($result)){
			return true;
		}else{
			return false;
		}
	}

	public function useremailUnique($ue){
		$this->load->database();
		$query = $this->db->query("SELECT email FROM users WHERE email='$ue'");
		$result = $query->result_array();
		if(empty($result)){
			return true;
		}else{
			return false;
		}
	}

	public function useraliasUnique($ua){
		$this->load->database();
		$query = $this->db->query("SELECT alias FROM users WHERE alias='$ua'");
		$result = $query->result_array();
		if(empty($result)){
			return true;
		}else{
			return false;
		}
	}

	public function insertCompany($data){
		$this->load->database();
		$query = $this->db->insert('superadmin',$data);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	public function insertSuperadmin($data){
		$this->load->database();
		$query = $this->db->insert('users',$data);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	public function insertSuperAdminFirstCenter($addStreet,$addCity,$addState,$addZip,$name,$centre_phone_number,$centre_mobile_number,$Centre_email,$userid,$uniqid){
		$this->load->database();
		$query = $this->db->query("INSERT INTO centers (addStreet, addCity, addState, addZip, name, centre_phone_number, centre_mobile_number, centre_email,superadmin) VALUES ('$addStreet','$addCity','$addState','$addZip','$name','$centre_phone_number','$centre_mobile_number','$Centre_email','$uniqid')");
		$id = $this->db->query("SELECT centerid FROM centers ORDER BY centerid DESC LIMIT 1");
		$centers = $this->db->query("SELECT center FROM users where id = '$userid'");
		$centerId = strval(($id->row())->centerid);
		$this->db->query("INSERT INTO usercenters (userid,centerid) VALUES ('$userid',$centerId)");
		$this->db->query("UPDATE users set center = $centerId where id='$userid'");
		return strval(($id->row())->centerid);
	}

	public function insertSuperAdminEntitlements($name,$rate,$userid,$superadmin){
		$this->load->database();
		$this->db->query("INSERT INTO entitlements (name,hourlyRate,createdBy,superadmin) VALUES('$name',$rate,'$userid','$superadmin')");
	}
	
	public function getUsersDetailedData($employeeId,$created_by){
		$this->load->database();
		$query = $this->db->query("SELECT awards FROM users WHERE created_by='$created_by' and id='$employeeId' and title != 'Superadmin';");
		return $query->row();
	}
	
	public function editEmployeeLBDetails($level,$bonusRate,$userid){
		$this->load->database();
		$this->db->query("UPDATE users SET level='$level',bonusRate='$bonusRate' where id='$userid'");
	}

}
