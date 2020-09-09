<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class XeroModel extends CI_Model {

	public function insertNewToken($access_token,$refresh_token,$tenant_id,$expires_in,$centerid){
		$this->load->database();
		$this->db->query("DELETE FROM xeroaccesstoken where centerid = $centerid ");
		$this->db->query("INSERT INTO xeroaccesstoken VALUES(0,'$access_token','$refresh_token','$tenant_id',$expires_in,now(), $centerid)");
	}

	public function getXeroToken(){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM xeroaccesstoken");
		return $query->row();
	}

	public function fetchXeroToken($center){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM xeroaccesstoken where centerid = '$center'");
		return $query->row();
	}
}	