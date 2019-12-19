<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class UtilModel extends CI_Model {

	public function getAllCenters($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM `centers` WHERE INSTR((SELECT center FROM users WHERE id='$userid'),centerid)");
		return $query->result();

	}

}