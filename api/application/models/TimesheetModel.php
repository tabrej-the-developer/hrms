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

	public function getPayrollShifts($startDate,$timesheetId,$userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM payrollshift WHERE timesheetId = '$timesheetId' AND shiftDate = '$startDate' AND userid = '$userid'");
		return $query->result();
	}

	// public function getVisitsNotOnDate($shiftDate,$centerid,$timesheetId){
	// 	$this->load->database();
	// 	$query = $this->db->query("SELECT DISTINCT(userid) as userid FROM visitis WHERE centerid = '$centerid' AND signInDate = '$shiftDate' AND userid NOT IN (SELECT userid from payrollshift WHERE timesheetId = '$timesheetId' AND shiftDate = '$shiftDate')");
	// 	return $query->result();
	// }

	public function getAllVisits($userid,$shiftDate,$centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM visitis WHERE userid = '$userid' AND centerid = '$centerid' AND signInDate = '$shiftDate'");
		return $query->result();
	}

	public function updateVisitStatus($visitId,$status,$startTime,$endTime){
		$this->load->database();
		$query = $this->db->query("UPDATE visitis SET status = '$status',signInTime = $startTime,signOutTime = $endTime WHERE id = $visitId");
	}

	public function createPayrollEntry($timesheetid,$empid,$shiftDate,$cStartTime,$cEndTime,$startTime,$endTime,$approvedBy,$payTypeId){
		$this->load->database();
		$query =$this->db->query("DELETE FROM payrollshift WHERE timesheetId = '$timesheetid' and userid = '$empid' and shiftDate = '$shiftDate' and clockedInTime = $cStartTime and clockedOutTime = $cEndTime");
		$query = $this->db->query("INSERT INTO payrollshift VALUES(0,'$timesheetid','$empid','$shiftDate',$cStartTime,$cEndTime,$startTime,$endTime,$payTypeId,'$approvedBy',now(),'Added')");
	}

	public function getUniqueVisitorsWithRoster($currentDate,$centerid){
		$this->load->database();
		$query = $this->db->query("SELECT DISTINCT(userid) as users FROM shift WHERE rosterDate = '$currentDate' AND roasterId = (SELECT ros.id FROM rosters as ros WHERE '$currentDate' BETWEEN ros.startDate and ros.endDate and ros.centerid = '$centerid')");
		return $query->result();
	}

	public function getUniqueVisitorsWithoutRoster($currentDate,$centerid){
		$this->load->database();
		$query = $this->db->query("SELECT DISTINCT(userid) as users from visitis WHERE userid not in (SELECT userid FROM shift WHERE shift.roasterId = (SELECT ros.id FROM rosters as ros WHERE '$currentDate' BETWEEN ros.startDate and ros.endDate and ros.centerid = '$centerid'))");
		return $query->result();
	}

	public function getUsersByTimesheetId($timesheetid){
		$this->load->database();
		$query = $this->db->query("SELECT userid from payrollshift where timesheetId = '$timesheetid' group by userid");
		return $query->result();
	}

	public function getPayrollShiftsById($timesheetid,$currentDate,$userid,$payrollType){
		$this->load->database();
		$query = $this->db->query("SELECT sum(clockedInTime) as clockedInTime,sum(clockedOutTime) as clockedOutTime,payrollType from payrollshift where timesheetId = '$timesheetid' and shiftDate = '$currentDate' and userid = '$userid' and payrollType = '$payrollType' group by payrollType");
		return $query->result();
	}

	public function getPayrollShiftTypesByUser($timesheetid,$userid){
		$this->load->database();
		$query = $this->db->query("SELECT  payrollType from payrollshift where timesheetId = '$timesheetid' and userid = '$userid' group by payrollType");
		return $query->result();
	}

	public function getEmployeeDetails($userid){
		$this->load->database();
		$query = $this->db->query("SELECT  * from employee where  userid = '$userid' ");
		return $query->result();
	}

	public function getRosterShift($date,$empId){
		$this->load->database();
		$query = $this->db->query("SELECT  * from shift where  userid = '$empId' and rosterDate = '$date' ");
		return $query->row();
	}


}