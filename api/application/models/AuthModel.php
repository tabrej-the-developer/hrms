<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

	public function getAuthUserId($deviceId,$authToken){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM logins WHERE deviceId='$deviceId' and authToken='$authToken' and isLoggedOutYN='N' ORDER BY id DESC");
		return $query->row();
	}
}