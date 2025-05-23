<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class XeroModel extends CI_Model {

	public function insertNewToken($access_token,$refresh_token,$tenant_id,$expires_in,$centerid){
		$this->load->database();
		$this->db->query("DELETE FROM xeroaccesstoken where centerid = $centerid;");
		$this->db->query("INSERT INTO xeroaccesstoken VALUES(0,'$access_token','$refresh_token','$tenant_id',$expires_in,now(), $centerid)");
	}
						// ||\/|| CODE CHANGED ||\/|| //
	public function getXeroToken($center){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM xeroaccesstoken where centerid = $center");
		return $query->row();
	}

	public function fetchXeroToken($center){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM xeroaccesstoken where centerid = $center");
		return $query->row();
	}
	public function getUserCenters($employeeId){
		$this->load->database();
		$query = $this->db->query("SELECT *,centers.name as centerName FROM usercenters left join centers on  usercenters.centerid = centers.centerid  where userid = '$employeeId'");
		return $query->result();
	}
	public function getXTenants(){
		$this->load->database();
		$query = $this->db->query("SELECT distinct(tenant_id) FROM xeroaccesstoken;");
		return $query->result();
	}

}	