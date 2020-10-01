<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class UtilModel extends CI_Model {

	public function getAllCenters($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM `centers` WHERE INSTR((SELECT center FROM users WHERE id='$userid'),centerid)");
		return $query->result();
	}

	public function getCenterById($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM centers WHERE centerid = '$centerid'");
		return $query->row();
	}

	public function getEmployessByCenter($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT id,email,name,imageUrl,role,title,manager,level FROM users WHERE center LIKE '%$centerid|%'");
		return $query->result();
	}

	public function insertFootprint($page_tag,$prev_page_tag,$start_time,$end_time,$ip,$userid){
		$this->load->database();
		$query = $this->db->query("INSERT into footprints (page_tag, prev_page_tag, start_time, end_time, ip, userid) VALUES ('$page_tag','$prev_page_tag','$start_time','$end_time','$ip','$userid')");
		}

	public function getFootprint($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM footprints where userid = '$userid' ORDER BY id DESC LIMIT 1");
		return $query->result();
	}

		public function updateFootprint($end_time,$id){
		$this->load->database();
		$query = $this->db->query("UPDATE footprints SET end_time = '$end_time' WHERE id = $id");
	}

		public function getUserDetails($userid){
			$this->load->database();
			$query = $this->db->query("SELECT * FROM users where id = '$userid' ");
			return $query->row();
		}

		public function getSuperAdmins(){
			$this->load->database();
			$query = $this->db->query("SELECT * FROM users where role = 1 ");
			return $query->result();
		}

		public function insertNotification($userid,$intent,$title,$body,$data){
			$this->load->database();
			$query = $this->db->query("INSERT INTO notifications (userid,intent,title,body,data) VALUES ('$userid','$intent','$title','$body','$data')  ");
		}

		public function getAllUsers(){
			$this->load->database();
			$query = $this->db->query("SELECT * FROM users ");
			return $query->result();
		}
}