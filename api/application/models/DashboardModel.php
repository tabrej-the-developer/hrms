<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model {

	public function timesheetCount($centerid,$status,$userid){
		$this->load->database();
			if($status == 'Published')
				$query = $this->db->query("SELECT * FROM timesheet where centerid = '$centerid' and status = 'Published' ");
			if($status == 'Draft')
				$query = $this->db->query("SELECT * FROM timesheet where centerid = '$centerid' and status = 'Draft' and  createdBy = '$userid' ");
		return $query->result(); 
	}
	public function payrollCount($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM payrollshift where timesheetid IN (SELECT id from timesheet where centerid = '$centerid')");
		return $query->result(); 
	}
	public function leavesCount($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM leaveapplication where userid IN (SELECT id from usercenters where centerid = '$centerid' )");
		return $query->result(); 
	}
	public function rosterCount($centerid,$status,$userid){
		$this->load->database();
		if($status == 'Published')
			$query = $this->db->query("SELECT * FROM rosters where centerid = '$centerid' and status = '$status' ");
		if($status == 'Draft')
			$query = $this->db->query("SELECT * FROM rosters where centerid = '$centerid' and status = '$status' and createdBy = '$userid' ");
		return $query->result(); 
	}

	public function getFootprints($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM footprints where userid = '$userid' order by id desc LIMIT 50");
		return $query->result(); 
	}

	public function getBirthdays($currentDate,$centerid){
		$this->load->database();
		$date = date('-m-d',strtotime($currentDate));
		$query = $this->db->query("SELECT * FROM employee where  userid IN (SELECT userid from usercenters where centerid = $centerid->centerid) and LOCATE('$date',dateOfBirth) ");
		return $query->result(); 
	}

	public function getAnniversaries($currentDate,$centerid){
		$this->load->database();
		$date = date('-m-d',strtotime($currentDate));
		$query = $this->db->query("SELECT * FROM employee where userid IN (SELECT userid from usercenters where centerid = $centerid->centerid) and LOCATE('$date',startDate) ");
		return $query->result(); 
	}

	public function getShiftDetails($userid,$currentDate){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM shift WHERE userid = '$userid' AND rosterDate = '$currentDate'");
		return $query->row();
	}

	public function getAllMeetingsForUser($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * from meeting where id IN (SELECT m_id FROM participants where user_id = '$userid')");
		return $query->result(); 
	}
}