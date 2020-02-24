<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class AttendanceModel extends CI_Model {

	public function getUserLogs($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM visitis WHERE userid = '$userid' ORDER BY id DESC");
		return $query->result();
	}

	public function insertLog($userid,$centerid,$signInTime,$signInDate,$reason){
		$this->load->database();
		$query = $this->db->query("INSERT INTO visitis VALUES(0,'$userid','$centerid','$signInDate',$signInTime,null,'$reason')");
	}
}