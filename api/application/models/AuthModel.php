<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

	public function getAuthUserId($deviceId,$authToken){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM logins WHERE deviceId='$deviceId' and authToken='$authToken' and isLoggedOutYN='N' ORDER BY id DESC");
		return $query->row();
	}

	public function getUserDetails($userid){
		$this->load->database();
		$query = $this->db->query("SELECT id,email,name,imageUrl,role,title,center,manager FROM users WHERE id='$userid'");
		return $query->row();
	}

	public function getSuperAdminId($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM `users` where role = 1 and instr(center,(SELECT u.center FROM users as u WHERE u.id='$userid'))");
		return $query->row();
	}
}