<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ParentModel extends CI_Model{
	public function insertIntoParent($parentid,$childCount,$childid,$contact,$email,$addressStreet,$addressCity,$addressState,$addressZip){
		$q = $this->db->query("SELECT * FROM parent WHERE parentId='$parentid'");
		$r = $q->result_array();
		if($r == null){
			$this->db->query("INSERT INTO parent VALUES('$parentid',1,$childCount,'$childid','$contact','$email','$addressStreet','$addressCity','$addressState','$addressZip')");
			// $this->db->query("INSERT INTO parentcontact (parentid,contact) VALUES ('$parentid','$contact') ");
			// $this->db->query("INSERT INTO parentemail (parentid,email) VALUES ('$parentid','$email')");
		}
		else{
			$parentid = $r[0]['parentId'];
			$this->db->query("UPDATE parent SET childCount=$childCount,childId = CONCAT(childId,'$childid'),contact = '$contact',email ='$email',addressStreet='$addressStreet',addressCity='$addressCity',addressState='$addressState',addressZip='$addressZip' WHERE parentId='$parentid'");
		}
	}
	// BELOW CODE USED FOR CARER AND CHILD EDIT DETAILS
	public function updateParentDetails($childCount,$childId,$contact,$email,$addressStreet,$addressCity,$addressState,$addressZip,$spotid){
		$query = $this->db->query("UPDATE parent SET childCount=$childCount,childId='$childId',contact='$contact',email='$email',addressStreet='$addressStreet',addressCity='$addressCity',addressState='$addressState',addressZip='$addressZip' WHERE parentId='$spotid'");	
		$children = explode('|',$childId);
		$this->db->query("DELETE FROM parentchild where parentId = '$spotid'");
		foreach($children as $child){
			if($child != "" && $child != null){
				$this->db->query("INSERT INTO parentchild (parentId,childId) VALUES ('$spotid','$child')");
			}
		}
	}
	public function updateParentName($userName,$todId){
		$this->db->query("UPDATE users SET userName='$userName' WHERE todId='$todId'");
	}
	// ABOVE CODE IS USED FOR CARER AND CHILD EDIT DETAILS
}
?>