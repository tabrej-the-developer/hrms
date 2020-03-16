<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MeetingModel extends CI_MODEL{

 public function addMeeting($id,$meetingTitle,$date,$time,$location,$collab,$userId){
    $this->load->database();
    
     $query = $this->db->query("insert into meeting(id,title,date,time,location,loginid) values('$id','$meetingTitle','$date','$time','$location','$userId')");
    

   
 }
  public function addAgenda($id,$agenda){
         $this->load->database();
         $this->db->query("insert into agenda(m_id,text) values('$id','$agenda')");
  }

  public function addParticipant($id,$invites){
      $this->load->database();
      $this->db->query("insert into participants(m_id,user_id) values('$id','$invites')");
  }
  public function addAttendence($mId,$participantId){
        $this->load->database();
        $data = [
            'status' => 'A'
        ];
        $this->db->where('user_id',$participantId);
        $this->db->where('m_id',$mId);
        $this->db->update('participants',$data);
        //$this->db->query('update participants set status="A" where user_id=$participantId and m_id=$mId');
  }

}

?>