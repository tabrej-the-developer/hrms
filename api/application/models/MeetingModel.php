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
  public function addMeetingRecord($mId,$user,$text,$remark){
      $this->load->database();
      $this->db->query("insert into mom(m_id,user_id,text,remark) values('$mId','$user','$text','$remark')");
  }
  public function meetingSummary($mid,$text){
      $this->load->database();
      $data = [
          'summary' => $text
      ];
      $this->db->where('id',$mid);
      $this->db->update('agenda',$data);
  }
  public function getMeeting($id){
     $this->load->database();
      $sql = "select * from meeting where loginid = '$id'";
      $q = $this->db->query($sql);
      return $q->result();
  }
  public function getPartcipant($id){
      $this->load->database();
      $query = "select * from participants where m_id='$id'";
      $q1 = $this->db->query($query);
      return $q1->result();
  }
  public function getPresent($id){
      $this->load->database();
      $query = "select * from participants where status IS NULL and m_id='$id' ";
      $result = $this->db->query($query);
      return $result->result();
  }
  public function getSummary($mid){
      $this->load->database();
      $query = "select * from agenda where m_id = '$mid'";
      $result = $this->db->query($query);
      return $result->result();
  }

   public function getMeetingInfo($mId){
       $this->load->database();
       $query = "select * from mom where m_id = '$mId'";
       $result = $this->db->query($query);
       return $result->result();
   }
  public function getAgendaInfo($mId){
      $this->load->database();
      $query = "select * from agenda where m_id = '$mId'";
      $result = $this->db->query($query);
      return $result->result();
  }
  public function getTitle($id){
      $this->load->database();
      $query = "select title from meeting where id = '$id'";
      $result = $this->db->query($query);
      return $result->result();

  }
   
  public function getParticipate($id){
      $this->load->database();
      $query = "select * from participants where user_id='$id'";
      $result = $this->db->query($query);
      return $result->result();
  }

}

?>