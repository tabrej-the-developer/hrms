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

	public function getMeetingTime($currentDate,$empId){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM mom INNER JOIN meeting on mom.m_id = meeting.id WHERE mom.user_id = '$empId' AND meeting.date = '$currentDate'");
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

	public function getTimesheetForPayrun($startDate,$endDate,$empId){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM timesheet WHERE centerid IN (SELECT users.center from  employee  inner join users on employee.userid = users.id where xeroEmployeeId = '$empId' ) and startDate = '$startDate' group by timesheet.id");
		return $query->row();
	}

	public function insertPayslips($timesheetid,$employeeID,$payslipID,$payrunID,$startDate){
		$this->load->database();
		$query = $this->db->query("INSERT INTO payslips (timesheetId, employeeId, slipId, payrunId, startDate) values ($timesheetid,$employeeID,$payslipID,$payrunID,$startDate)");
	}

	public function updateVisitStatus($visitId,$status,$startTime,$endTime){
		$this->load->database();
		$query = $this->db->query("UPDATE visitis SET status = '$status',signInTime = $startTime,signOutTime = $endTime WHERE id = $visitId");
	}

	public function createPayrollEntry($timesheetid,$empid,$shiftDate,$cStartTime,$cEndTime,$startTime,$endTime,$approvedBy,$payTypeId){
		$this->load->database();
		$query =$this->db->query("DELETE FROM payrollshift WHERE timesheetId = '$timesheetid' and userid = '$empid' and shiftDate = '$shiftDate' and clockedInTime = $cStartTime and clockedOutTime = $cEndTime");
		$query = $this->db->query("INSERT INTO payrollshift (timesheetId , userid , shiftDate , clockedInTime , clockedOutTime , startTime , endTime , payrollType , createdBy , createdAt , status)VALUES('$timesheetid','$empid','$shiftDate',$cStartTime,$cEndTime,$startTime,$endTime,$payTypeId,'$approvedBy',now(),'Added')");
	}

	public function getUniqueVisitorsWithRoster($startDate,$centerid){
		$this->load->database();
		$queryText = "SELECT DISTINCT(userid) as users FROM shift WHERE roasterId = (SELECT ros.id FROM rosters as ros WHERE ros.startDate = '$startDate' and ros.centerid = '$centerid')";
		$query = $this->db->query($queryText);
		return $query->result();
	}

	public function getUniqueVisitorsWithoutRoster($startDate,$centerid){
		$this->load->database();
		$query = $this->db->query("SELECT DISTINCT(userid) as users from visitis WHERE userid not in (SELECT userid FROM shift WHERE shift.roasterId = (SELECT ros.id FROM rosters as ros WHERE '$startDate' BETWEEN ros.startDate and ros.endDate and ros.centerid = '$startDate'))");
		return $query->result();
	}

	public function getUsersByTimesheetId($timesheetid){
		$this->load->database();
		$query = $this->db->query("SELECT DISTINCT(userid) from payrollshift where timesheetId = '$timesheetid' group by userid");
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
		return $query->row();
	}

	public function getRosterShift($date,$empId){
		$this->load->database();
		$query = $this->db->query("SELECT  * from shift where  userid = '$empId' and rosterDate = '$date' ");
		return $query->row();
	}

	public function getEarningsRateFromId($id){
		$this->load->database();
		$query = $this->db->query("SELECT * from payrollshifttype_v1 where payrollshifttype_v1='$id'");
		return $query->row();
	}

	public function discardTimesheet($timesheetid){
		$this->load->database();
		$query = $this->db->query("DELETE from timesheet where id = '$timesheetid'");
	}

	public function publishTimesheet($timesheetid){
		$this->load->database();
		$query = $this->db->query("UPDATE timesheet SET status = 'Published' where id = '$timesheetid'");
	}
}