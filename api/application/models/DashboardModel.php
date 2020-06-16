<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model {

	public function timesheetCount($centerid){
		$this->load->database();
			$query = $this->db->query("SELECT * FROM timesheet where centerid = '$centerid'");
		return $query->result(); 
	}
	public function payrollCount(){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM payrollshift");
		return $query->result(); 
	}
	public function rosterCount($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM rosters where centerid = '$centerid'");
		return $query->result(); 
	}

	public function getFootprints($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM footprints where userid = '$userid' order by id desc");
		return $query->result(); 
	}
}