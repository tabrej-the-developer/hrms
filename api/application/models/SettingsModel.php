<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class SettingsModel extends CI_Model {

	public function getAreaByName($centerid,$areaName){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartareas WHERE LOWER(areaName) = LOWER('$areaName') AND centerid = '$centerid'");
		return $query->row();
	}

	public function getAreaExists($areaName,$areaid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartareas WHERE LOWER(areaName) = LOWER('$areaName') AND centerid = (SELECT centerid FROM orgchartareas WHERE areaid = $areaid)");
		return $query->row();
	}

	public function updateArea($areaid,$areaName,$isRoomYN){
		$this->load->database();
		$query = $this->db->query("UPDATE orgchartareas SET areaName = '$areaName', isARoomYN = '$isRoomYN' WHERE areaid = $areaid");
	}

	public function createArea($centerid,$areaName,$isRoomYN){
		$this->load->database();
		$query = $this->db->query("INSERT INTO orgchartareas VALUES(0,'$centerid','$areaName','$isRoomYN')");
	}

	public function getAllAreas($centerid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartareas WHERE centerid = '$centerid'");
		return $query->result();
	}

	public function getRoleByName($areaid,$roleName){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartroles WHERE LOWER(roleName) = LOWER('$roleName') AND areaid = $areaid");
		return $query->row();
	}

	public function getRoleExists($roleName,$roleid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartroles WHERE LOWER(roleName) = LOWER('$roleName') AND areaid = (SELECT areaid FROM orgchartroles WHERE roleid = $roleid)");
		return $query->row();
	}

	public function createRole($areaid,$roleName){
		$this->load->database();
		$this->db->query("INSERT INTO orgchartroles VALUES(0,$areaid,'$roleName')");
	}

	public function updateRole($areaid,$roleName){
		$this->load->database();
		$this->db->query("UPDATE orgchartroles SET roleName = '$roleName' WHERE roleid = $roleid");
	}

	public function getRolesFromArea($areaid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orgchartroles where areaid = $areaid");
		return $query->result();
	}
}