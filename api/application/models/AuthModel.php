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
		$query = $this->db->query("SELECT id, email, name, imageUrl, role, title, center,manager, firebaseid, isVerified, created_at, created_by, roleid, maxHoursPerWeek, hourlyRate FROM users WHERE id='$userid'");
		return $query->row();
	}

	public function getSuperAdminId($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM `users` where role = 1 and instr(center,(SELECT u.center FROM users as u WHERE u.id='$userid'))");
		return $query->row();
	}

	public function getUserFromEmail($email){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM users where email = '$email'");
		return $query->row();
	}

	public function insertUser($email,$password,$name,$role,$title,$center,$manager,$firbaseuid,$createdBy,$roleid,$maxHoursPerWeek,$hourlyRate){
		$this->load->database();
		$uid = uniqid();
		$query = $this->db->query("INSERT INTO users VALUES('$uid','$email','$password','$name',null,$role,'$title','$center|','$manager','$firbaseuid','N',now(),'$createdBy',$roleid,$maxHoursPerWeek,$hourlyRate)");
		return $uid;
	}

	public function verifyUser($userid){
		$this->load->database();
		$query = $this->db->query("UPDATE users SET isVerified = 'Y' WHERE id='$userid'");
	}

	public function insertToken($userid,$token,$isForgotYN){
		$this->load->database();
		$query = $this->db->query("INSERT INTO authtokens VALUES(0,'$userid','$token','$isForgotYN')");
	}

	public function getToken($userid,$token){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM authtokens WHERE userid = '$userid' AND token = '$token'");
		return $query->row();
	}

	public function deleteToken($userid,$token){
		$this->load->database();
		$this->db->query("DELETE FROM authtokens WHERE userid='$userid' AND token = '$token'");
	}

	public function updatePassword($userid,$password){
		$this->load->database();
		$this->db->query("UPDATE users SET password = '$password' WHERE id='$userid'");
	}

	public function getUser($email,$password){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM users WHERE email='$email' and password='$password'");
		return $query->row();
	}

	public function insertLogin($userid,$deviceid,$token){
		$this->load->database();
		$query = $this->db->query("DELETE FROM logins WHERE userid = '$userid'");
		$query = $this->db->query("INSERT INTO logins VALUES(0,'$userid','now()','$deviceid','$token','N')");
	}

	public function getPermissions($userid){
		$his->load->database();
		$query = $this->db->query("SELECT * FROM permissions WHERE userid = '$userid'");
		return $query->row();
	}
}