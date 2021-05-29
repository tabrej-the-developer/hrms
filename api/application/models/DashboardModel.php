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
		$query = $this->db->query("SELECT * FROM payruns where timesheetid IN (SELECT id from timesheet where centerid = '$centerid' and status='Published')");
		return $query->result(); 
	}
	public function leavesCount($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM leaveapplication where userid IN (SELECT id from usercenters where centerid = '$centerid' )");
		return $query->result(); 
	}
	public function rosterCount($centerid,$status,$userid){
		$this->load->database();
		if($status == 'Published'){
			$query = $this->db->query("SELECT * FROM rosters where centerid = '$centerid' and status = '$status' ");
			return $query->result(); 
		}
		if($status == 'Draft'){
			$query = $this->db->query("SELECT * FROM rosters where centerid = '$centerid' and status = '$status' and createdBy = '$userid' ");
			return $query->result(); 
		}
	}

	public function getFootprints($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM footprints where userid = '$userid' order by id desc LIMIT 50");
		return $query->result(); 
	}

	public function getBirthdays($currentDate,$centerid){
		$this->load->database();
		$date = date('-m-d',strtotime($currentDate));
		// $check = true;
		// $centersCondition = "";
		// foreach($centers as $center){
		// 	if($check){
				$centersCondition = "centerid = $centerid ";
		// 		$check = false;
		// 	}else{
		// 		$centersCondition .= " OR centerid = $center->centerid";
		// 	}
		// }
		$query = $this->db->query("SELECT employee.userid,employee.xeroEmployeeId,employee.title,employee.fname,employee.lname,employee.emails,employee.dateOfBirth,employee.jobTitle,employee.gender,employee.phone,employee.startDate,employee.terminationDate,employee.ordinaryEarningRateId,employee.maxhours,employee.days FROM employee where  userid IN (SELECT userid from usercenters where  $centersCondition) and LOCATE('$date',dateOfBirth) ");
		return $query->result(); 
	}

	public function getAnniversaries($currentDate,$centerid){
		$this->load->database();
		$date = date('-m-d',strtotime($currentDate));
		// $check = true;
		// $centersCondition = "";
		// foreach($centers as $center){
		// 	if($check){
				$centersCondition = "centerid = $centerid ";
			// 	$check = false;
			// }else{
			// 	$centersCondition .= " OR centerid = $center->centerid";
			// }
		// }
		$query = $this->db->query("SELECT employee.userid,employee.xeroEmployeeId,employee.title,employee.fname,employee.lname,employee.emails,employee.dateOfBirth,employee.jobTitle,employee.gender,employee.phone,employee.startDate,employee.terminationDate,employee.ordinaryEarningRateId,employee.maxhours,employee.days FROM employee where userid IN (SELECT userid from usercenters where $centersCondition) and LOCATE('$date',startDate) ");
		return $query->result(); 
	}

	public function getShiftDetails($userid,$currentDate,$centerid){
		$this->load->database();
		$day = date('w',strtotime($currentDate));
		$startDate = date('w',strtotime($currentDate."-$day days"));
		$query = $this->db->query("SELECT * FROM shift WHERE userid = '$userid' AND roasterId IN (SELECT id from rosters where rosterDate = '$startDate' AND centerid = $centerid)");
		return $query-> row();
	}

	public function getAllMeetingsForUser($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * from meeting where id IN (SELECT m_id FROM participants where user_id = '$userid')");
		return $query->result(); 
	}
}