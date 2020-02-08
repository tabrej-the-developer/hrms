<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class RostersModel extends CI_Model {
	public function getAllRosters($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM rosters WHERE centerid = '$centerid'");
		return $query->result();
	}

	public function getAllAreas($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartareas WHERE centerid = '$centerid'");
		return $query->result();
	}

	public function getAllRoles($areaid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartroles WHERE areaid = '$areaid'");
		return $query->result();
	}

	public function getAllEmployees($roleid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM employee WHERE roleid='$roleid'");
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
	}


}