<?php
defined('BASEPATH') or exit('No direct script access allowed');
class RoomModel extends CI_Model{
    //Insert Room Details Info
    public function insertRoom($data){
        $this->db->insert('room',$data);
        return $this->db->insert_id();
    }
    //Check CenterRoom already exist before inserting
    public function checkCenterRoom($centerId,$roomId){
        $query = $this->db->get_where('centerroom',array('centerId'=>$centerId,'roomId'=>$roomId));
        $count = $query->num_rows();
        if($count > 0){
            return true;
        }else{
            return false;
        }
    }
    //Insert Center Room Info
    public function insertCenterRoom($data){
        $this->db->insert('centerroom',$data);
        return $this->db->insert_id();
    }
    
    //Get all room details which are corresponded to center
    public function fetchRoom($centerId){
        $query = $this->db->query("SELECT cr.centerId, cr.roomId, r.name, r.careAgeFrom,r.careAgeTo,r.capacity,r.ratio,r.isDeletedYN FROM centerroom cr, room r WHERE cr.roomId = r.roomId and cr.centerId='$centerId' and r.isDeletedYN='N' GROUP BY cr.centerId;");
        $count = $query->num_rows();
        if($count > 0){
            return $query->result();
        }else{
            return false;
        }
    }
    //Edit Room Details Info
    public function updateRoom($roomId,$data){
        $this->db->where('roomId',$roomId);
        return $this->db->update('room',$data);
    }
    //Get all rooms
    public function fetchAllRooms(){
        $query = $this->db->get('room');
        return $query->result();
    }
    //Delete Room
    public function deleteRoom($roomId){
		$this->db->query("DELETE FROM room WHERE roomId='$roomId'");
		$this->db->query("DELETE from centerroom where roomId = '$roomId'");
	}
}
?>