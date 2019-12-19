<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class NoticeModel extends CI_Model {

	public function getAllNotices($userid,$startDate=null,$endDate=null){
		$this->load->database();
		$queryText = "SELECT * FROM notices WHERE receiverId = '$userid' OR senderId = '$userid'";
		if($startDate != null){
			$queryText .= " AND sentDate >= $startDate";
		}

		if($endDate != null){
			$queryText .= " AND sentDate <= $endDate";
		}
		$query = $this->db->query($queryText);
		return $query->result();
	}

	public function updateNotice($userid,$noticeid,$status){
		$this->load->database();
		$query = $this->db->query("UPDATE notices SET status = $status WHERE receiverId='$userid' AND id=$noticeid");
	}

	public function addNotice($senderId,$receiverId,$subject,$text){
		$this->load->database();
		$query = $this->db->query("INSERT INTO notices VALUES(0,'$senderId','$receiverId','$text','$subject',0,CURDATE())");
	}

}