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
}