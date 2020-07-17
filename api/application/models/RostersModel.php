<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class RostersModel extends CI_Model {
	public function getAllRosters($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM rosters WHERE centerid = '$centerid' ORDER BY startDate DESC");
		return $query->result();
	}

	public function getAllAreas($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartareas WHERE centerid = '$centerid'   order by rosterPriority ASC");
		return $query->result();
	}

	public function getAllRoles($areaid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartroles WHERE areaid = '$areaid'");
		return $query->result();
	}

	public function getRole($roleid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartroles WHERE roleid = $roleid");
		return $query->row();
	}

	public function getAllEmployees($roleid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM users WHERE roleid='$roleid'");
		return $query->result();
	}

	public function getRosterFromDate($startDate,$centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM rosters WHERE startDate = '$startDate' and centerid = '$centerid'");
		return $query->row();
	}

	public function createNewRoster($userid,$startDate,$endDate,$centerid){
		$this->load->database();
		$rosterid = uniqid();
		$this->db->query("INSERT INTO rosters VALUES('$rosterid','$userid','$startDate','$endDate','$centerid','Draft')");
		return $rosterid;
	}

	public function createNewShift($rosterid,$date,$userid,$startTime,$endTime,$roleid,$message=null){
		$this->load->database();
		$shiftid = uniqid();
		if($message == null) $message = "";
		$this->db->query("INSERT INTO shift VALUES('$shiftid','$rosterid','$date','$userid',$startTime,$endTime,$roleid,1,'$message')");
		return $shiftid;
	}

	public function getRosterFromId($rosterid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM rosters WHERE id = '$rosterid'");
		return $query->row();
	}

	public function getAllEmployeesFromRole($roleid,$rosterid){
		$this->load->database();
		$query = $this->db->query("SELECT DISTINCT(userid) FROM shift WHERE roleid	= $roleid AND roasterId = '$rosterid'");
		return $query->result();
	}

	public function getAllShiftsFromEmployee($rosterid,$userid,$areaid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM shift WHERE roasterId = '$rosterid' AND userid = '$userid' AND roleid IN (SELECT roleid FROM orgchartroles WHERE areaid = $areaid) ORDER BY rosterDate");
		return $query->result();
	}

	public function updateShift($shiftid,$startTime,$endTime,$roleid,$status){
		$this->load->database();
		$query = $this->db->query("UPDATE shift SET startTime = $startTime, endTime = $endTime,roleid = $roleid,status = $status WHERE id = '$shiftid'");
	}

	public function updateRoster($rosterid,$status){
		$this->load->database();
		$this->db->query("UPDATE rosters SET status = '$status' WHERE id = '$rosterid'");
	}

	public function deleteRoster($rosterid){
		$this->load->database();
		$this->db->query("DELETE FROM shift WHERE roasterId='$rosterid'");
		$this->db->query("DELETE FROM rosters WHERE id='$rosterid'");
	}

	public function publishRoster($rosterid){
		$this->load->database();
		$this->db->query("UPDATE rosters SET status = 'Published' WHERE id = '$rosterid'");
		$this->db->query("UPDATE shift SET status = 2 WHERE roasterId = '$rosterid'");
	}

	public function getShiftDetails($userid,$currentDate){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM shift WHERE userid = '$userid' AND rosterDate = '$currentDate'");
		return $query->row();
	}

	public function changePriority($areaid,$newid){
		$this->load->database();
		$query = $this->db->query("UPDATE orgchartareas set rosterPriority = '$newid' WHERE areaid = '$areaid' ");
	}

	public function deleteShift($shiftId){
		$this->load->database();
		$query = $this->db->query("UPDATE shift set startTime= 0 , endTime= 0, status =1  WHERE id = '$shiftId' ");
	}

	public function addNewShift($startTime,$endTime,$rosterid,$roleid,$date,$empid,$status){
		$this->load->database();
		$uniqueid = uniqid();
		$query = $this->db->query("INSERT INTO shift (id,roasterId,rosterDate,userid,startTime,endTime,roleid,status) VALUES ('$uniqueid','$rosterid','$date','$empid','$startTime','$endTime',$roleid,$status) ");
	}

}








