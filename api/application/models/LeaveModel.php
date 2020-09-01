<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class LeaveModel extends CI_Model {
	public function createLeaveType($leaveTypeId,$name,$isPaidYN,$slug,$showOnPaySlip,$currentRecord,$superadminId){
		$this->load->database();
		$query = $this->db->query("INSERT INTO leaves VALUES('$leaveTypeId','$name','$isPaidYN','$slug','$showOnPaySlip','$currentRecord'
			,now(),'$superadminId')");
	}

	public function editLeaveType($leaveId,$name,$isPaidYN,$slug,$showOnPaySlip){
		$this->load->database();
		$query = $this->db->query("UPDATE leaves SET name='$name',isPaidYN='$isPaidYN',slug='$slug',showOnPaySlipYN='$showOnPaySlip' WHERE id='$leaveId'");
	}

	public function deleteAllLeaveTypes(){
		$this->load->database();
		$query = $this->db->query("DELETE FROM leaves");
	}

	public function deleteLeaveType($leaveId){
		$this->load->database();
		$query = $this->db->query("DELETE FROM leaves WHERE id='$leaveId'");
	}

	public function getLeaveType($leaveId){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM leaves WHERE id='$leaveId'");
		return $query->row();
	}

	public function getLeaveTypeBySuperadmin($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM leaves WHERE created_by = '$userid'");
		return $query->result();
	}

	public function getAllLeavesByCenter($centerid,$startDate = null,$endDate = null){
		$this->load->database();
		$queryTxt = "SELECT * FROM leaveapplication WHERE userid IN (SELECT id FROM users WHERE center LIKE '%$centerid|%' AND role != 1)";
		if($startDate != null)
			$queryTxt .= " AND startDate <= $startDate";
		if($endDate != null)
			$queryTxt .= " ADN endDate >= $endDate";
		$query = $this->db->query($queryTxt);
		return $query->result();
	}

	public function getAllLeavesByUser($userid,$startDate = null,$endDate = null){
		$this->load->database();
		$queryTxt = "SELECT * FROM leaveapplication WHERE userid IN (SELECT id FROM users WHERE id = '$userid' OR manager = '$userid')";
		if($startDate != null)
			$queryTxt .= " AND startDate <= $startDate";
		if($endDate != null)
			$queryTxt .= " AND endDate >= $endDate";
		$query = $this->db->query($queryTxt);
		return $query->result();
	}

	public function applyLeave($userid,$leaveId,$noOfHours,$startDate,$endDate,$notes){
		$this->load->database();
		$query = $this->db->query("INSERT INTO leaveapplication (userid,appliedDate, leaveId, noOfHours, startDate,endDate,status,notes) VALUES('$userid',CURDATE(),'$leaveId',$noOfHours,'$startDate','$endDate',1,'$notes')");
	}

	public function getLeaveBalance($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM leavebalance WHERE userid = '$userid'");
		return $query->result();
	}

	public function insertIntoLeaveBalance($userid,$leaveTypeId,$leaveBalance){
		$this->load->database();
		$query = $this->db->query("INSERT INTO leavebalance VALUES(0,'$userid','$leaveTypeId',$leaveBalance)");
	}

	// public function getGetLeaveBalanceByLeaveId($userid,$leaveId){
	// 	$this->load->database();
	// 	$query = $this->db->query("SELECT * FROM leavebalance WHERE userid = '$userid' and leaveId = '$leaveId'");
	// 	return $query->row();
	// }

	public function deleteAllUserLeaveBalance($userid)
	{
		$this->load->database();
		$query = $this->db->query("DELETE FROM leavebalance WHERE userid = '$userid'");
	}

	// public function getAccruedLeaves($userid){
	// 	$this->load->database();
	// 	$query = $this->db->query("SELECT * FROM leaveaccrual WHERE userid='$userid'");
	// 	return $query->result();
	// }

	public function getTotalOrdinaryHorusWorked($userid,$startDate){
		$this->load->database();
		$query = $this->db->query("SELECT SUM(endTime - startTime)/60 as sum FROM payrollshift WHERE userid = '$userid' AND shiftDate >= '$startDate'");
		return $query->row();
	}

	public function getSumOfLeave($userid,$leaveid,$startDate){
		$this->load->database();
		$query = $this->db->query("SELECT SUM(noOfHours) as sum FROM leaveapplication WHERE userid = '$userid' AND startDate >= '$startDate' AND leaveId = $leaveid");
		return $query->row();
	}

	public function updateLeave($leaveApp,$status,$message){
		$this->load->database();
		$this->db->query("UPDATE leaveapplication SET status = $status, message = '$message' WHERE applicationId=$leaveApp");
	}

	public function updateLeaveBalance($userid,$leaveId,$toUpdate){
		$this->load->database();
		$this->db->query("UPDATE leaveBalance SET leaveBalance = leaveBalance + $toUpdate WHERE userid = '$userid' AND leaveId = '$leaveId'");
	}

	public function getLeaveApplicationForUser($userid,$currentDate){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM `leaveapplication` WHERE startDate<='$currentDate' and endDate >= '$currentDate' AND userid = '$userid'");
		return $query->row();
	}
	public function getUserFromLeaveApplication($leaveApplication){
		$this->load->database();
		$query = $this->db->query("SELECT email FROM `leaveapplication` INNER JOIN users on leaveApplication.userid = users.id WHERE applicationId='$leaveApplication'");
		return $query->row();
	}
}