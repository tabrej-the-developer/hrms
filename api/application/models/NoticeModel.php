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

	public function createGroup($userid,$groupName){
		$this->load->database();
		$query = $this->db->query("INSERT INTO noticegroups (groupName,userid) VALUES('$groupName','$userid')");
		return $this->db->insert_id();
	}

	public function addGroupMembers($memberid,$groupId){
		$this->load->database();
		$query = $this->db->query("INSERT INTO noticegroupmembers (gid,memberid) VALUES('$groupId','$memberid')");
	}

	public function getGroupsForUser($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * from noticegroups WHERE userid = '$userid'");
		return $query->result();
	}


	public function getMembersOfGroup($groupId){
		$this->load->database();
		$query = $this->db->query("SELECT * from noticegroupmembers WHERE gid = '$groupId'");
		return $query->result();
	}
}