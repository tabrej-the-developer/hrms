<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class UtilModel extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }	

	public function getAllCenters($userid){
		$query = $this->db->query("SELECT * FROM `usercenters` WHERE userid='$userid'");
		return $query->result();
	}

	public function getCenterById($centerid){
		$query = $this->db->query("SELECT * FROM centers WHERE centerid = '$centerid'");
		return $query->row();
	}

	public function getEmployessByCenter($centerid){
		$query = $this->db->query("SELECT users.id,users.email,users.name,users.imageUrl,users.roleid,users.title,users.manager,users.level,orgchartroles.roleName,orgchartroles.areaid FROM usercenters 
			JOIN  users on users.id = usercenters.userid 
			LEFT JOIN orgchartroles on orgchartroles.roleid = users.roleid 
			LEFT JOIN employee on employee.userid = users.id 
			WHERE usercenters.centerid = $centerid  ");
		return $query->result();
	}

	public function insertFootprint($page_tag,$prev_page_tag,$start_time,$end_time,$ip,$userid){
		$query = $this->db->query("INSERT into footprints (page_tag, prev_page_tag, start_time, end_time, ip, userid) VALUES ('$page_tag','$prev_page_tag','$start_time','$end_time','$ip','$userid')");
		}

	public function getFootprint($userid){
		$query = $this->db->query("SELECT * FROM footprints where userid = '$userid' ORDER BY id DESC LIMIT 1");
		return $query->result();
	}

		public function updateFootprint($end_time,$id){
		$query = $this->db->query("UPDATE footprints SET end_time = '$end_time' WHERE id = $id");
	}

		public function getUserDetails($userid){
			$query = $this->db->query("SELECT * FROM users where id = '$userid' ");
			return $query->row();
		}

		public function getSuperAdmins(){
			$query = $this->db->query("SELECT * FROM users where role = 1 ");
			return $query->result();
		}

		public function insertNotification($userid,$intent,$title,$body,$data){
			$query = $this->db->query("INSERT INTO notifications (userid,intent,title,body,data) VALUES ('$userid','$intent','$title','$body','$data')  ");
		}

		public function getAllUsers(){
			$query = $this->db->query("SELECT * FROM users ");
			return $query->result();
		}

		public function getAllUsersFromCenter($centers){
			$check = true;
			$centersCondition = "";
			foreach($centers as $center){
				if($check){
					$centersCondition = " centerid = $center->centerid ";
					$check = false;
				}
				else{					
					$centersCondition .= " OR centerid = $center->centerid";
				}
			}
			$query = $this->db->query("SELECT users.id,users.name,users.imageUrl,users.title,users.email FROM users where id IN ( SELECT userid from usercenters where $centersCondition)    ");
			return $query->result();
		}

		public function centerTableMigration($centerid,$userid){
			$query = $this->db->query("INSERT into usercenters (centerid,userid) values ($centerid,'$userid')");

		}

		public function getQuotations(){
			$query = $this->db->query("SELECT * from quotes");
			return $query->result();
		}

		public function getKidsoftDetails($center){
			$query = $this->db->query("SELECT kidsoft.*,centers.name as centerName FROM centers LEFT JOIN kidsoft on centers.centerid = kidsoft.center where centers.centerid = $center ");
			return $query->row();
		}

		public function getKidsoftCenterAreas($center){
			$query = $this->db->query("SELECT * FROM kidsoftcenterareas where center = $center");
			return $query->result();
		}

		public function getNotificationPermissions($user,$typeId){
			$query = $this->db->query("SELECT np.*,u.email FROM users u INNER JOIN notificationpermissions np on u.id = np.userid  where np.userid = '$user' and np.typeid = '$typeId'");
			return $query->row();
		}
}