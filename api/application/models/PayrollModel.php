<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class PayrollModel extends CI_Model {

	public function getPayrollType($id){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM payrollshifttype_v1 WHERE earningRateId = '$id'");
		return $query->row();
	}

	public function getAllPayrollTypes(){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM payrollshifttype_v1");
		return $query->result();
	}
// Original
	public function getAllEntitlements($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM entitlements where superadmin IN (SELECT superadmin FROM centers WHERE centerid IN (SELECT centerid FROM usercenters where userid = '$userid' GROUP BY userid)GROUP BY superadmin)");
		return $query->result();
	}

// Version
public function getAllEntitlementsV1($centerid){
	$this->load->database();
	$query = $this->db->query("SELECT * FROM entitlements where centerid = $centerid");
	return $query->result();
}

	public function addEntitlement($name,$rate,$userid){
		$this->load->database();
		$superadmin = $this->db->query("SELECT DISTINCT(superadmin) FROM centers WHERE centerid IN (SELECT centerid FROM usercenters where userid = '$userid' GROUP BY userid)");
		$superadmin = $superadmin->row();
		$query = $this->db->query("INSERT INTO entitlements (name,hourlyRate,createdBy,superadmin) VALUES('$name',$rate,'$userid','$superadmin->superadmin')");
	}

	public function addEntitlementV1($name,$rate,$userid,$centerid){
		$this->load->database();
		$query = $this->db->query("INSERT INTO entitlements VALUES(0,'$name',$rate,'$userid',$centerid)");
	}

	public function getUniqueUsersForTimesheet($timehseetid){
		$this->load->database();
		$query = $this->db->query("SELECT DISTINCT(userid) FROM payrollshift WHERE timesheetId = '$timehseetid'");
		return $query->result();
	}

	public function getAllPayrollShifts($timehseetid,$userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM payrollshift WHERE timesheetId = '$timehseetid' and userid = '$userid'");
		return $query->result();
	}

	public function deleteEntitlement($entitlementId){
		$this->load->database();
		$query = $this->db->query("DELETE from entitlements where id='$entitlementId'");
	}

	public function updateEntitlement($entitlementId,$name,$hourlyRate){
		$this->load->database();
		$query = $this->db->query("UPDATE entitlements SET name='$name', hourlyRate = '$hourlyRate' where id ='$entitlementId' ");
	}

	public function getUserLevels($level){
		$this->load->database();
		$query = $this->db->query("SELECT users.*,org.roleid as rId,org.roleName from users LEFT JOIN orgchartroles org on org.roleid = users.roleid where level = $level");
		return $query->result();
	}

	public function insertPayrollShifts($earningRateId,$name,$isExemptFromTax,$isExemptFromSuper,$isReportableAsW1,$earningType,$rateType,$multiplier,$currentRecord,$userid,$centerid){
		$this->load->database();
		$this->db->query("INSERT INTO payrollshifttype_v1 VALUES(0,'$earningRateId','$name','$isExemptFromTax','$isExemptFromSuper','$isReportableAsW1','$earningType','$rateType',$multiplier,'$currentRecord','$userid',now(),$centerid)");
	}

	public function insertSuperfund($superfundId,$abn,$usi,$type,$name,$bsb,$accountNumber,$accountName,$eServiceAdd,$employeeNo,$userid,$centerid){
		$this->load->database();
		$query = $this->db->query("INSERT INTO superfund VALUES(0,'$superfundId','$abn','$usi','$type','$name','$bsb','$accountNumber','$accountName','$eServiceAdd','$employeeNo',now(),'$userid',$centerid)");
		// var_dump($query);
	}

	public function deleteAllPayrollShiftTypes($centerid){
		$this->load->database();
		$this->db->query("DELETE FROM payrollshifttype_v1 where centerid = $centerid");
	}
	
	public function deleteAllSuperFunds($centerid){
		$this->load->database();
		$this->db->query("DELETE FROM superfund where centerid = $centerid");
	}

	public function updateFlag($timesheetid,$memberid,$message){
		$this->load->database();
		$query = $this->db->query("SELECT status from payrollshift where timesheetId='$timesheetid' and userid = '$memberid' ");
		$result = $query->result();
		foreach($result as $status){
			if(strtolower($status->status) == "added")
				$this->db->query("UPDATE payrollshift SET status = 'FLAGGED' , message='$message' where timesheetId='$timesheetid' and userid = '$memberid'");
			if(strtolower($status->status) == "flagged")
				$this->db->query("UPDATE payrollshift SET status = 'ADDED' , message=null where timesheetId='$timesheetid' and userid = '$memberid'");
				}
	}

	public function updateShift($timesheetid,$memberid){
		$this->load->database();
		$query = $this->db->query("UPDATE payrollshift set status = 'PUBLISHED' where timesheetId='$timesheetid' and userid = '$memberid' ");
	}

	public function getAllPayrollCalendarId($timesheetId){
		$this->load->database();
		$query = $this->db->query("SELECT DISTINCT(payrollCalendarId) from employee where userid IN (SELECT DISTINCT(userid) from payrollshift where timesheetId = '$timesheetId')");
		//echo "SELECT DISTINCT(payrollCalendarId) from employee where userid IN (SELECT DISTINCT(userid) from payrollshift where timesheetId = '$timesheetId')";
		return $query->result();
	}

	public function getPayrun($timesheetid){
		$this->load->database();
		$query = $this->db->query("SELECT * from payruns where timesheetId = '$timesheetid'");
		return $query->row();
	}

	public function getCenteridFromTimesheet($timesheetid){
		$this->load->database();
		$query = $this->db->query("SELECT * from timesheet where id = '$timesheetid'");
		return $query->row();
	}

	public function getUserId($employeeId){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM employee where xeroEmployeeId = '$employeeId' ");
		return $query->row();
	}
	public function getAllEarningRates(){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM payrollshifttype_v1");
		return $query->result();
	}
	public function getAllLeaveTypes(){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM leaves");
		return $query->result();
	}
}
