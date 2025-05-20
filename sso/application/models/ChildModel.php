<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ChildModel extends CI_Model{

    public function insertChild($childid,$fname,$lname,$caredate,$birthdate,$gender,$parentid){
		$query = $this->db->query("SELECT * FROM child WHERE fName = '$fname' and lName = '$lname'  and gender = '$gender' and parentId = '$parentid'");
		if($query->row() == null){
			$this->db->query("INSERT INTO child VALUES('$childid','$fname','$lname',DATE_FORMAT(STR_TO_DATE('$caredate', '%d/%m/%Y'), '%Y-%m-%d'),DATE_FORMAT(STR_TO_DATE('$birthdate', '%d/%m/%Y'), '%Y-%m-%d'),'$gender','$parentid','p')");
			$this->db->query("INSERT INTO parentchild (parentId,childId) VALUES ('$parentid','$childid')");
			return $childid;
		}
	}
	// BELOW CODE USED FOR CARER AND CHILD EDIT DETAILS
	public function addChild($childId,$fname,$lname,$bdate,$cdate,$gender,$parentid){
		$query = $this->db->query("INSERT INTO child VALUES('$childId','$fname','$lname','$cdate','$bdate','$gender','$parentid','p')");
		return $childId;
	}
	public function updateChildDetails($childid,$fname,$lname,$bdate,$cdate,$gender){
		$query = $this->db->query("UPDATE child SET fName='$fname',lName='$lname',careDate='$cdate',birthDate='$bdate',gender='$gender' WHERE childId='$childid'");
	}
	public function insertParentChild($spotid,$c){
		$query = $this->db->query("INSERT INTO parentchild (parentId,childId) VALUES ('$spotid','$c')");
	}
	// ABOVE CODE IS USED FOR CARER AND CHILD EDIT DETAILS

}
?>