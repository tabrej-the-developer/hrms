<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class MessengerModel extends CI_Model {

	public function GetUsers($userid,$searchText=null){
		$this->load->database();
		$qText = "SELECT * from users as u2 where id!='$userid' and instr((SELECT u.center from users as u WHERE u.role=1 and instr(u.center,(SELECT u1.center from users as u1 where u1.id = '$userid'))),u2.center)";
		if($searchText != null){
			$qText .= " and name LIKE '$searchText%'";
		}
		$query = $this->db->query($qText);
		return $query->result();
	}

	public function GetGroups($userid,$searchText = null){
		$this->load->database();
		$qText = "SELECT * from chatgroups where groupId in (SELECT groupId FROM groupmembers WHERE memberId = '$userid')";
		if($searchText != null){
			$qText .= " and groupName LIKE '$searchText%'";
		}
		$query = $this->db->query($qText);
		return $query->result();
	}

	public function CreateGroup($groupName,$adminId,$imageUrl){
		$groupId = uniqid();
		$this->load->database();
		$query = $this->db->query("INSERT INTO chatgroups VALUES('$groupId','$groupName','$adminId','CURDATE()','$imageUrl')");
		return $groupId;
	}

	public function UpdateGroup($groupName,$avatarUrl,$groupId){
		$this->load->database();
		$query = $this->db->query("UPDATE chatgroups SET groupName='$groupName', imageUrl='$avatarUrl' WHERE groupId='$groupId'");
	}

	public function AddMember($groupId,$userid){
		$this->load->database();
		$this->db->query("INSERT INTO groupmembers values(0,'$groupId','$userid','CURDATE()')");
	}

	public function LeaveGroup($groupId,$userid){
		$this->load->database();
		$this->db->query("DELETE FROM groupmembers WHERE groupId = '$groupId' and memberId='$userid'");
	}

	public function DeleteGroup($groupId){
		$this->load->database();
		$this->db->query("DELETE FROM chatgroups WHERE groupId = '$groupId'");
	}

	public function GetGroupInfo($groupId){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM chatgroups WHERE groupId='$groupId'");
		return $query->row();
	}

	public function GetAllMemberDetails($groupId){
		$this->load->database();
		$query = $this->db->query("SELECT id,name,imageUrl,title FROM users WHERE id in (SELECT memberId from groupmembers WHERE groupId='$groupId')");
		return $query->result();
	}

	public function GetMemberDetails($userid){
		$this->load->database();
		$query = $this->db->query("SELECT id,name,imageUrl,title FROM userid WHERE id = '$userid'");
		return $query->row();
	}

	public function GetCommonGroups($user1,$user2){
		$this->load->database();
		$query = $this->db->query("SELECT DISTINCT(g1.groupId) as gId from groupmembers as g1 JOIN groupmembers as g2 on (g1.memberId != g2.memberId) and (g1.groupId = g2.groupId) WHERE ( g1.memberId = '$user1' and g2.memberId = '$user2' )");
		return $query->result();
	}

	public function GetMember($groupId,$userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM groupmembers WHERE groupId='$groupId' and memberId='$userid'");
		return $query->row();
	}

	public function GetMemberCount($groupId){
		$this->load->database();
		$query = $this->db->query("SELECT COUNT(id) as count from groupmembers where groupId='$groupId'");
		return $query->row();
	}
}