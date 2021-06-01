<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class RostersModel extends CI_Model {
	public function getAllRosters($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM rosters WHERE centerid = '$centerid' ORDER BY startDate DESC");
		return $query->result();
	}

	// Get hourly rate by level
	public function getHourlyRate($level){
		$this->load->database();
		$query = $this->db->query("SELECT hourlyRate from entitlements where id = $level");
		return ($query->row() != null) ? ($query->row())->hourlyRate : null;
	}

	public function getAllAreas($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartareas WHERE centerid = '$centerid'   order by rosterPriority ASC");
		return $query->result();
	}
	public function getAllRosterTemplates($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM rostertemplates WHERE centerid = '$centerid'");
		return $query->result();
	}

	public function getAreaFromRoleId($roleid){
		$this->load->database();
		$query = $this->db->query("SELECT areaid FROM orgchartroles  WHERE roleid = '$roleid' ");
		return $query->row();
	}

	public function getAreaFromAreaId($areaid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartareas  WHERE areaid = '$areaid' ");
		return $query->row();
	}

	public  function getEmployeeEmail($empid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM users WHERE id = '$empid' ");
		return $query->row();
	}

	public function getAllRoles($areaid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartroles WHERE areaid = '$areaid' ORDER BY priority ASC");
		return $query->result();
	}

	public function getRoles(){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartroles ");
		return $query->result();
	}

	public function getRole($roleid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartroles WHERE roleid = $roleid ");
		return $query->row();
	}

	public function getAllEmployees($roleid){
		$this->load->database();
		$query = $this->db->query("SELECT users.*,employee.*,employeerecord.employmentType FROM users LEFT JOIN employee on employee.userid = users.id LEFT JOIN employeerecord on employeerecord.employeeNo = users.id WHERE roleid=$roleid");
		return $query->result();
	}

	public function getRosterFromDate($startDate,$centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM rosters WHERE startDate = '$startDate' and centerid = '$centerid'");
		return $query->row();
	}

	public function getMaxHours($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM employee where userid = '$userid' ");
		return $query->row();
	}

	// public function getRosterTemplateFromDate($startDate,$centerid){
	// 	$this->load->database();
	// 	$query = $this->db->query("SELECT * FROM rostertemplates WHERE startDate = '$startDate' and centerid = '$centerid'");
	// 	return $query->row();
	// }

	public function getSuperAdminByCenter($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT uc.userid,users.email,uc.centerid FROM users  INNER JOIN usercenters uc on uc.userid = users.id where uc.centerid = $centerid and users.id = users.manager");
		return $query->row();
	}

	public function getAllEmployeesByCenters($superAdmin){
		$this->load->database();
		$check = true;
		$centersCondition = "";
		$centers = $this->db->query("SELECT * FROM usercenters where userid = '$superAdmin->userid' ");
		$centers = $centers->result();
		foreach($centers as $center){
			if($check){
				$centersCondition = " uc.centerid = $center->centerid ";
				$check = false;
			}else{
				$centersCondition .= " OR uc.centerid = $center->centerid";
			}
		}
		$query = $this->db->query("SELECT users.name,users.id,users.email,uc.centerid from users INNER JOIN usercenters uc on uc.userid=users.id where $centersCondition");
		return $query->result();
	}

	public function createNewRoster($userid,$startDate,$endDate,$centerid){
		$this->load->database();
		$rosterid = uniqid();
		$this->db->query("INSERT INTO rosters VALUES('$rosterid','$userid','$startDate','$endDate','$centerid','Draft')");
		return $rosterid;
	}

	public function createNewRosterTemplate($userid,$rosterid,$templateName,$centerid){
		$this->load->database();
		
		$this->db->query("INSERT INTO rostertemplates (id,name,centerid,status,createdBy
) VALUES('$rosterid','$templateName','$centerid','Draft','$userid')");
		return $rosterid;
	} // DB change

	public function createNewShift($rosterid,$date,$userid,$startTime,$endTime,$roleid,$message=null){
		$this->load->database();
		$shiftid = uniqid();
		if($message == null) $message = "";
		$this->db->query("INSERT INTO shift VALUES('$shiftid','$rosterid','$date','$userid',$startTime,$endTime,$roleid,1,'$message')");
		return $shiftid;
	}

	public function createNewTemplateShift($rosterid,$date,$userid,$startTime,$endTime,$roleid,$message=null){
		$this->load->database();
		$shiftid = uniqid();
		if($message == null) $message = "";
		$this->db->query("INSERT INTO templateshift VALUES('$shiftid','$rosterid','$date','$userid',$startTime,$endTime,$roleid,1,'$message')");
		return $shiftid;
	}

	public function addNewShift($startTime,$endTime,$rosterid,$roleid,$date,$empid,$status){
		$this->load->database();
		$uniqueid = uniqid();
		$query = $this->db->query("INSERT INTO shift (id,roasterId,rosterDate,userid,startTime,endTime,roleid,status) VALUES ('$uniqueid','$rosterid','$date','$empid','$startTime','$endTime',$roleid,$status) ");
	}

	public function addNewTemplateShift($startTime,$endTime,$rosterid,$roleid,$date,$empid,$status){
		$this->load->database();
		$uniqueid = uniqid();
		$query = $this->db->query("INSERT INTO templateshift (id,roasterId,day,userid,startTime,endTime,roleid,status) VALUES ('$uniqueid','$rosterid','$date','$empid','$startTime','$endTime',$roleid,$status) ");
	}

	public function getRosterFromId($rosterid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM rosters WHERE id = '$rosterid'");
		return $query->row();
	}

	public function getRosterTemplateFromId($rosterTemplateId){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM rostertemplates WHERE id = '$rosterTemplateId'");
		return $query->row();
	}

	public function getAllEmployeesFromRole($roleid,$rosterid){
		$this->load->database();
		$query = $this->db->query("SELECT DISTINCT(userid) FROM shift WHERE roleid	= $roleid AND roasterId = '$rosterid'");
		return $query->result();
	}
	public function getAllTemplateEmployeesFromRole($roleid,$rosterid){
		$this->load->database();
		$query = $this->db->query("SELECT DISTINCT(userid) FROM templateshift WHERE roleid	= $roleid AND roasterId = '$rosterid'");
		return $query->result();
	}


	public function getAllShiftsFromEmployee($rosterid,$userid,$areaid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM shift WHERE roasterId = '$rosterid' AND userid = '$userid' AND roleid IN (SELECT roleid FROM orgchartroles WHERE areaid = $areaid) ORDER BY rosterDate");
		return $query->result();
	}

	public function getAllTemplateShiftsFromEmployee($rosterid,$userid,$areaid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM templateshift WHERE roasterId = '$rosterid' AND userid = '$userid' AND roleid IN (SELECT roleid FROM orgchartroles WHERE areaid = $areaid) ORDER BY day");
		return $query->result();
	}

	public function updateShift($shiftid,$startTime,$endTime,$roleid,$status,$message){
		$this->load->database();
		$query = $this->db->query("UPDATE shift SET startTime = $startTime, endTime = $endTime,roleid = $roleid,status = $status,message='$message' WHERE id = '$shiftid'");
	}

	public function updateShiftByEmployee($shiftid,$status){
		$this->load->database();
		$query = $this->db->query("UPDATE shift SET status = $status WHERE id = '$shiftid'");
	}

	public function updateTemplateShift($shiftid,$startTime,$endTime,$roleid,$status,$message){
		$this->load->database();
		$query = $this->db->query("UPDATE templateshift SET startTime = $startTime, endTime = $endTime,roleid = $roleid,status = $status,message='$message' WHERE id = '$shiftid'");
	}

	public function updateShiftDetails($startTime,$endTime,$roleid,$status,$date,$empid){
		$this->load->database();
		$query = $this->db->query("UPDATE shift SET startTime = $startTime, endTime = $endTime,roleid = $roleid,status = $status WHERE rosterDate='$date' and userid='$empid'");
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
	public function deleteRosterTemplate($rosterid){
		$this->load->database();
		$this->db->query("DELETE FROM templateshift WHERE roasterId='$rosterid'");
		$this->db->query("DELETE FROM rostertemplates WHERE id='$rosterid'");
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

	public function getTemplateShift($empId,$rosterTemplateId,$day){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM templateshift WHERE userid = '$empId' AND day = '$day' AND roasterId = '$rosterTemplateId'");
		return $query->row();
	}

	public function getShiftDate($shiftid){
		$this->load->database();
		$query = $this->db->query("SELECT rosterDate FROM shift WHERE id = '$shiftid'");
		return $query->row();
	}

	public function getTemplateShiftDay($shiftid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM templateshift WHERE id = '$shiftid'");
		return $query->row();
	}

	public function getEmployeeId($shiftid){
		$this->load->database();
		$query = $this->db->query("SELECT userid FROM shift WHERE id = '$shiftid'");
		return $query->row();
	}

	public function getTemplateEmployeeId($shiftid){
		$this->load->database();
		$query = $this->db->query("SELECT userid FROM templateshift WHERE id = '$shiftid'");
		return $query->row();
	}

	public function getRosterId($shiftid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM shift WHERE id = '$shiftid'");
		return $query->row();
	}

	public function getTemplateRosterId($shiftid){
		$this->load->database();
		$query = $this->db->query("SELECT roasterId FROM templateshift WHERE id = '$shiftid'");
		return $query->row();
	}

	public function getShiftId($employeeId,$currentDate){
		$this->load->database();
		$query = $this->db->query("SELECT id FROM shift WHERE userid = '$employeeId' AND rosterDate = '$currentDate'");
		return $query->row();
	}

	public function getTemplateShiftId($employeeId,$currentDate,$rosterTemplateId){
		$this->load->database();
		$query = $this->db->query("SELECT id FROM templateshift WHERE userid = '$employeeId' AND day = '$currentDate'  AND roasterId = '$rosterTemplateId'");
		return $query->row();
	}

	public function changePriority($areaid,$newid){
		$this->load->database();
		$query = $this->db->query("UPDATE orgchartareas set rosterPriority = '$newid' WHERE areaid = '$areaid' ");
	}

	public function deleteShift($shiftId){
		$this->load->database();
		$query = $this->db->query("DELETE from shift WHERE id = '$shiftId' ");
	}

	public function deleteTemplateShift($shiftId){
		$this->load->database();
		$query = $this->db->query("DELETE from templateshift WHERE id = '$shiftId' ");
	}


	public function addCasualEmployees($startTime,$endTime,$rosterid,$roleid,$date,$empid,$status,$userid){
		$this->load->database();
		$uniqueid = uniqid();
		$time = date('Y-m-d H:i:s');
		$casEmp = $this->db->query("SELECT * FROM users where id IN (SELECT userid FROM usercenters WHERE centerid IN (SELECT centerid FROM rosters WHERE id = '$rosterid')) AND id = '$empid'");
		if($casEmp->row() == null){
			$this->db->query("INSERT INTO editpermissions (rosterid,userid,created_by,created_at,editRoster) VALUES ('$rosterid','$empid','$userid','$time','N')  ");
		}
		$query = $this->db->query("INSERT into shift (id,roasterId,rosterDate, userid, startTime, endTime, roleid,status) VALUES ('$uniqueid','$rosterid','$date','$empid','$startTime','$endTime',$roleid,$status)");
	}

	public function getCasualEmployees($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * from users");
		return $query->result();
	}

	public function getEmployeeDetails($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * from users where id = '$userid'");
		return $query->row();
	}

	public function getAllEmployeesFromRoster($rosterid){
		$this->load->database();
		$query = $this->db->query("SELECT * from shift where roasterId = '$rosterid' GROUP BY userid;");
		return $query->result();
	}

	public function getRostersByPermission($userid){
		$this->load->database();
		$query = $this->db->query("SELECT rosters.startDate,rosters.endDate,rosters.id,rosters.createdBy,rosters.status from editpermissions inner join rosters on rosters.id = editpermissions.rosterid where  editpermissions.userid = '$userid' and ( ( editpermissions.timesheetid = '') or  editpermissions.rosterid != '') ");
		return $query->result();
	}

	public function getCasualEmpPermission($userid,$rosterid){
		$this->load->database();
		$query = $this->db->query("SELECT editpermissions.editRoster from editpermissions inner join rosters on rosters.id = editpermissions.rosterid where  editpermissions.userid = '$userid' and editpermissions.rosterid = '$rosterid' ");
		if($query->row() == null){
			return null;
		}
		if($query->row() != null){
			return $query->row();
		}
	}

	public function getRosterPermissions($employeeId,$rosterId){
		$this->load->database();
		$query = $this->db->query("SELECT * from editpermissions where userid = '$employeeId' and rosterid = '$rosterId'");
		return $query->result();
	}

	public function updateRosterPermission($employeeId,$rosterId,$userid,$editRoster){
		$this->load->database();
		$query = $this->db->query("UPDATE editpermissions set editRoster = '$editRoster' where userid = '$employeeId' and rosterid = '$rosterId'");
		echo $query;	
	}
	public function addRosterPermission($employeeId,$rosterId,$userid,$editRoster){
		$this->load->database();
		$query = $this->db->query("INSERT into editpermissions (rosterid,userid,created_by,created_at, editRoster) VALUES ('$rosterId','$employeeId','$userid',NOW(),'$editRoster')");
	}
	public function getShiftAndRoleDetails($shiftId,$role){
		$this->load->database();
		$query = $this->db->query("SELECT * from shift INNER JOIN orgchartroles on orgchartroles.roleid = shift.roleid where id='$shiftId'");
		return $query->row();
	}
	public function getTemplateShiftAndRoleDetails($shiftId,$role){
		$this->load->database();
		$query = $this->db->query("SELECT * from templateshift INNER JOIN orgchartroles on orgchartroles.roleid = templateshift.roleid where templateshift.id='$shiftId'");
		return $query->row();
	}
	public function addToKidsoftCenterAreas($centerid,$areaName,$date,$totalBookings){
		$this->load->database();
		$query = $this->db->query("INSERT INTO kidsoftcenterareas (center,area,date,childcount) VALUES ($centerid,'$areaName','$date',$totalBookings) ");
	}
	public function getOccupancy($date,$areaName){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM kidsoftcenterareas where date = '$date' and area = '$areaName'");
		return $query->row();
	}
	public function getServiceKey($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM kidsoft where center = $centerid");
		return $query->row();
	}

	public function checkOccupancyForPeriod($date,$centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM kidsoftcenterareas where date = '$date' and center = $centerid");
		return $query->row();
	}

}








