<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class XeroModel extends CI_Model {

	public function insertNewToken($access_token,$refresh_token,$tenant_id,$expires_in){
		$this->load->database();
		$this->db->query("DELETE FROM xeroaccesstoken");
		$this->db->query("INSERT INTO xeroaccesstoken VALUES(0,'$access_token','$refresh_token','$tenant_id',$expires_in,now())");
	}

	public function getXeroToken(){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM xeroaccesstoken");
		return $query->row();
	}
}	