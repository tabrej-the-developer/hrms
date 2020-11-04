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

	public function GetRecentChat($userid){
		$this->load->database();
		$groups = $this->GetGroups($userid);
		$var = [];
		foreach($groups as $group){
		$query = $this->db->query("SELECT DISTINCT(u1.id) FROM users as u1 JOIN chat on u1.id = chat.senderId WHERE chat.receiverId = '$userid' UNION SELECT DISTINCT(u2.id) FROM users as u2 JOIN chat on u2.id = chat.receiverId WHERE chat.senderId = '$userid' UNION Select DISTINCT(chat.receiverId) from chat where chat.receiverId = '$group->groupId' ");
		$var = array_merge($var,$query->result());
		}
		if(count($groups) ==0 ){
		$query = $this->db->query("SELECT DISTINCT(u1.id) FROM users as u1 JOIN chat on u1.id = chat.senderId WHERE chat.receiverId = '$userid' UNION SELECT DISTINCT(u2.id) FROM users as u2 JOIN chat on u2.id = chat.receiverId WHERE chat.senderId = '$userid' ");
		$var = array_merge($var,$query->result());
				}
			$a = [];
				foreach($var as $v){
					array_push($a,$v->id);
				}
				return array_values(array_unique($a));
	}

	public function getRecentChatDetails($otherId,$userid){
		$this->load->database();
		$arr = [];
		// case : 1
		$query = $this->db->query("SELECT * from chat where (senderId = '$userid' or receiverId = '$userid') and (senderId = '$otherId' or receiverId = '$otherId') and isGroupYN = 'N' ORDER BY chatId DESC");
		if($query->row() != null)
			array_push($arr,$query->row());
		// case : 2
		$query = $this->db->query("SELECT * from chat where ( receiverId = '$otherId') and isGroupYN = 'Y' ORDER BY chatId DESC ");
		if($query->row() != null)
			array_push($arr,$query->row());
		return $arr;
	}

	public function GetAllUserChats($userid,$memberid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM chat WHERE (senderId = '$userid' AND receiverId = '$memberid') OR (senderId = '$memberid' AND receiverId = '$userid')");
		return  $query->result(); 
	}
	public function addTransaction($adminId,$groupId,$isGroupYN,$text,$transaction){
		$this->load->database();
		$query = $this->db->query("INSERT into chat (senderId,receiverId, isGroupYN,chatText,sentDateTime, transactiontype) VALUES ('$adminId','$groupId','$isGroupYN','$text',now(),'$transaction')");
	}

	public function GetAllGroupChats($groupId){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM chat WHERE receiverId = '$groupId'");
		return $query->result();
	}

	public function CreateGroup($groupName,$adminId,$imageUrl){
		$groupId = uniqid();
		$this->load->database();
		$query = $this->db->query("INSERT INTO chatgroups VALUES('$groupId','$groupName','$adminId',CURDATE(),'$imageUrl')");
		return $groupId;
	}

	public function UpdateGroup($groupName=null,$avatarUrl=null,$groupId){
		$this->load->database();
		if($groupName == null){
			$query = $this->db->query("UPDATE chatgroups SET imageUrl='$avatarUrl' WHERE groupId='$groupId'");
		}
		if($groupName != null){
			$query = $this->db->query("UPDATE chatgroups SET groupName='$groupName' WHERE groupId='$groupId'");
		}
	}

	public function UpdateGroupName($groupName,$groupId){
		$this->load->database();
		$query = $this->db->query("UPDATE chatgroups SET groupName='$groupName' WHERE groupId='$groupId'");
	}

	public function AddMember($groupId,$userid){
		$this->load->database();
		$this->db->query("INSERT INTO groupmembers values(0,'$groupId','$userid',CURDATE())");
	}

	public function LeaveGroup($groupId,$userid){
		$this->load->database();
		$this->db->query("DELETE FROM groupmembers WHERE groupId = '$groupId' and memberId='$userid'");
	}

	public function GetGroupMember($groupId,$userid){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM groupmembers WHERE groupId='$groupId' AND memberId='$userid'");
		return $query->row();
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
		$query = $this->db->query("SELECT id,name,imageUrl,title FROM users WHERE id = '$userid'");
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

	public function PostChat($senderId,$receiverId,$isGroupYN,$chatText,$mediaContent){
		$this->load->database();
		$dateTime = gmdate("Y-m-d h:i:s");
		$query = $this->db->query("INSERT INTO chat (senderId,receiverId, isGroupYN,chatText,sentDateTime, mediaContent,transactiontype) VALUES('$senderId','$receiverId','$isGroupYN','$chatText','$dateTime','$mediaContent','CHAT')");
	}
}


