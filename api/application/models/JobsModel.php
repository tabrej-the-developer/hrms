<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class JobsModel extends CI_Model {
	public function createAdvertisement($title,$userid,$platform,$uniqueId,$enddate){
	$this->load->database();
	$query = $this->db->query("INSERT INTO jobs (jobTitle,userId,platform,UniqueId,expiryDate) VALUES 
		('$title','$userid','$platform','$uniqueId','$enddate');");
	}

	public function addResponseData($adId,$endDate){
	$this->load->database();
	$query = $this->db->query("INSERT INTO jobs (advertisementId,expiryDate) VALUES ('$adId','$endDate');");
	}
	
	public function getAuthUserId($dId,$uId){
		$this->load->database();
		$sql = "SELECT * FROM `users` WHERE id = '$uId'";
		$query =  $this->db->query($sql);
		return $query->result();
	}

	public function getUserDetails($id){
		$this->load->database();
		$sql = "SELECT * FROM `users` WHERE id = '$id'";
		$query =  $this->db->query($sql);
		return $query->result();
	}
	public function getJobs(){
		$this->load->database();
		$sql = "select * from jobs";
		$query = $this->db->query($sql);
		return $query->result();
	}

}