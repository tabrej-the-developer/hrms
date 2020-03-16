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

}