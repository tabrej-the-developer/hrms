<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class AttendanceModel extends CI_Model {

	public function getUserLogs($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM visitis WHERE userid = '$userid' ORDER BY id DESC");
		return $query->result();
	}

	public function insertLog($memberid,$centerid,$startTime,$signInDate,$reason){
		$this->load->database();
		$query = $this->db->query("INSERT INTO visitis VALUES(0,'$memberid','$centerid','$signInDate',$startTime,null,'$reason','Added','N')");
	}

	public function getVisitEntry($userid,$centerid,$startDate){
		$this->load->database();
		//echo "SELECT * FROM visitis WHERE userid = '$userid' AND centerid = '$centerid' and signOutTime = null";
		$query = $this->db->query("SELECT * FROM visitis WHERE userid = '$userid' AND centerid = '$centerid' and signOutTime IS null");
		return $query->row();
	}

	public function updateLog($visitId,$signOutTime,$reason,$leftCampus){
		$this->load->database();
		$query = $this->db->query("UPDATE visitis SET signOutTime = $signOutTime,reason='$reason',leftCampusYN='$leftCampus' WHERE id = $visitId");
	}
}