<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class PayrollModel extends CI_Model {

	public function getPayrollType($id){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM payrollshifttype WHERE id = $id");
		return $query->row();
	}

	public function getAllPayrollTypes(){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM payrollshifttype");
		return $query->result();
	}

	public function getAllEntitlements(){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM entitlements");
		return $query->result();
	}

	public function addEntitlement($name,$rate,$userid){
		$this->load->database();
		$query = $this->db->query("INSERT INTO entitlements VALUES(0,'$name',$rate,'$userid')");
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
		$query = $this->db->query("SELECT * from users where level = $level");
		return $query->result();
	}

	public function insertPayrollShifts($earningRateId,$name,$isExemptFromTax,$isExemptFromSuper,$isReportableAsW1,$earningType,$rateType,$multiplier,$currentRecord,$userid){
		$this->load->database();
		$this->db->query("INSERT INTO payrollshifttype_v1 VALUES(0,'$earningRateId','$name','$isExemptFromTax','$isExemptFromSuper','$isReportableAsW1','$earningType','$rateType',$multiplier,'$currentRecord','$userid',now())");
	}

	public function insertSuperfund($abn,$usi,$type,$name,$bsb,$accountNumber,$accountName,$eServiceAdd,$employeeNo,$userid){
		$this->load->database();
		$this->db->query("INSERT INTO superfund VALUES(0,'$abn','$usi','$type','$name','$bsb','$accountNumber','$accountName','$eServiceAdd','$employeeNo',now(),'$userid')");
	}

}
