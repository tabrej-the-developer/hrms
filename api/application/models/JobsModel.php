<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class JobsModel extends CI_Model {
	public function createAdvertisement($title,$userid,$platform,$uniqueId){
	$this->load->database();
	$query = $this->db->query("INSERT INTO jobs (jobTitle,userId,platform,UniqueId) VALUES 
		('$title','$userid','$platform','$uniqueId');");
	}

	public function addResponseData($adId,$endDate){
	$this->load->database();
	$query = $this->db->query("INSERT INTO jobs (advertisementId,expiryDate) VALUES ('$adId','$endDate');");
	}

}