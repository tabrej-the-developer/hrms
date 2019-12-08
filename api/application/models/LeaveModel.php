<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class LeaveModel extends CI_Model {
	public function createLeaveType($name,$isPaidYN,$slug,$superadminId){
		$this->load->database();
		$query = $this->db->query("INSERT INTO leaves VALUES(0,'$name','$isPaidYN','$slug','$superadminId')");
	}

	public function editLeaveType($leaveId,$name,$isPaidYN,$slug){
		$this->load->database();
		$query = $this->db->query("UPDATE leaves SET name='$name',isPaidYN='$isPaidYN',slug='$slug' WHERE id=$leaveId");
	}

	public function deleteLeaveType($leaveId){
		$this->load->database();
		$query = $this->db->query("DELETE FROM leaves WHERE id=$leaveId");
	}

	public function getLeaveType($leaveId){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM leaves WHERE id=$leaveId");
		return $query->row();
	}

	public function getAllLeavesByCenter($centerid,$startDate = null,$endDate = null){
		$this->load->database();
		$queryTxt = "SELECT * FROM leaveapplication WHERE userid IN (SELECT id FROM users WHERE center LIKE '%$centerid|%' AND role != 1)";
		if($startDate != null)
			$queryText .= " AND startDate <= $startDate";
		if($endDate != null)
			$queryText .= " ADN endDate >= $endDate";
		$query = $this->db->query($queryText);
		return $query->result();
	}

	public function getAllLeavesByUser($userid,$startDate = null,$endDate = null){
		$this->load->database();
		$queryTxt = "SELECT * FROM leaveapplication WHERE userid = '$userid'";
		if($startDate != null)
			$queryText .= " AND startDate <= $startDate";
		if($endDate != null)
			$queryText .= " ADN endDate >= $endDate";
		$query = $this->db->query($queryText);
		return $query->result();
	}

	public function applyLeave($userid,$leaveId,$startDate,$endDate,$notes){
		$this->load->database();
		$query = $this->db->query("INSERT INTO leaveapplication VALUES(0,'$userid',CURDATE(),$leaveId,'$startDate','$endDate',1,'$notes')");
	}

	public function getLeaveBalance($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM leavebalance WHERE userid = '$userid'");
		return $query->result();
	}
}