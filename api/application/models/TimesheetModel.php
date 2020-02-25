<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class TimesheetModel extends CI_Model {

	public function getAllTimesheets($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM timesheet WHERE centerid = '$centerid'");
		return $query->result();
	}

	public function getTimesheetFromDate($startDate,$centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM timesheet WHERE centerid = '$centerid' AND startDate = '$startDate'");
		return $query->row();
	}

	public function createTimesheet($centerid,$startDate,$endDate,$userid){
		$this->load->database();
		$timeId = uniqid();
		$query = $this->db->query("INSERT INTO timesheet VALUES('$timeId','$startDate','$endDate','$centerid','Draft','$userid',now())");
		return $timeId;
	}

	public function getTimesheet($timesheetId){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM timesheet WHERE id = '$timesheetId'");
		return $query->row();
	}

	public function getPayrollShifts($startDate,$timesheetId){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM payrollshift WHERE timesheetId = '$timesheetId' AND shiftDate = '$startDate'");
		return $query->result();
	}

	public function getVisitsNotOnDate($shiftDate,$centerid,$timesheetId){
		$this->load->database();
		$query = $this->db->query("SELECT DISTINCT(userid) as userid FROM visitis WHERE centerid = '$centerid' AND signInDate = '$shiftDate' AND userid NOT IN (SELECT userid from payrollshift WHERE timesheetId = '$timesheetId' AND shiftDate = '$shiftDate')");
		return $query->result();
	}

	public function getAllVisits($userid,$shiftDate,$centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM visitis WHERE userid = '$userid' AND centerid = '$centerid' AND signInDate = '$shiftDate'");
		return $query->result();
	}

	public function updateVisitStatus($visitId,$status,$startTime,$endTime){
		$this->load->database();
		$query = $this->db->query("UPDATE visitis SET status = '$status',signInTime = $startTime,signOutTime = $endTime WHERE id = $visitId");
	}

	public function createPayrollEntry($timesheetid,$empid,$shiftDate,$regularHours,$overtimeHours,$approvedBy){
		$this->load->database();
		$query = $this->db->query("INSERT INTO payrollshift VALUES(0,'$timesheetid','$empid','$shiftDate',$regularHours,$overtimeHours,'$approvedBy',now(),'Published')");
	}
}