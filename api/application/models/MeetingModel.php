<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MeetingModel extends CI_MODEL{

 public function addMeeting($id,$meetingTitle,$date,$edate,$time,$endTime,$location,$period,$mPrevid,$userId,$status,$agendaFile){
    $this->load->database();
    
     $query = $this->db->query("INSERT into meeting(id,title,date,edate, time,eTime,location,period, loginid,m_previd,status,agendaFile) values('$id','$meetingTitle','$date','$edate','$time','$endTime','$location','$period','$userId','$mPrevid','$status','$agendaFile')");
 }

  public function addAgenda($id,$agenda){
         $this->load->database();
         $this->db->query("insert into agenda(m_id,text) values('$id','$agenda')");
  }

  public function addParticipant($id,$invites){
      $this->load->database();
      $this->db->query("insert into participants(m_id,user_id,status) values('$id','$invites','P')");
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
      //$sql = "select * from meeting where loginid = '$id'";
      $sql = "SELECT * FROM meeting WHERE id IN (SELECT m_id FROM participants WHERE user_id = '$id') ORDER BY date DESC";
      $q = $this->db->query($sql);
            // print_r($q->result());
      return $q->result();
  }
  public function getPartcipant($id){
      $this->load->database();
      $q1 = $this->db->query("SELECT name,users.id as id,email,participants.status from users INNER JOIN participants on participants.user_id=users.id  where participants.m_id='$id' ");
      return $q1->result();
  }
  public function getPresent($id){
      $this->load->database();
      $result = $this->db->query("SELECT users.id,users.email,users.name from participants inner join users on users.id = participants.user_id where status = 'P' and m_id='$id' ");
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
       $query = "select mom.*,users.name as name from mom  inner join users on users.id = mom.user_id  where m_id = '$mId'";
       $result = $this->db->query($query);
       return $result->result();
   }
   public function getMeetingData($mId){
       $this->load->database();
       $query = $this->db->query("SELECT meeting.title,meeting.date,meeting.time,meeting.eTime,meeting.location,meeting.period,meeting.loginid,meeting.agendaFile,users.name FROM meeting LEFT JOIN users on users.id=meeting.loginid WHERE meeting.id='$mId'");
       return $query->row();
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
  public function getMembers($id){
      $this->load->database();
      $query = "select * from participants where m_id='$id'";
      $result = $this->db->query($query);
      return $result->result();
  }

  public function updateMeeting($id,$mTitle,$mdate,$mtime,$location,$period){
    $this->load->database();
    $data = [
        'title' => $mTitle,
        'date' => $mdate,
        'time' => $mtime,
        'location' => $location,
        'period' => $period
    ];
    $this->db->where('id',$id);
    $this->db->update('meeting',$data);
  }

  public function deleteAgenda($id){
      $this->load->database();
      $this->db->where('m_id',$id);
      $this->db->delete('agenda');
  }
  public function deleteParticipant($id){
    $this->load->database();
    $this->db->where('m_id',$id);
    $this->db->delete('participants');
  }

  public function updateMeetingStatus($mid,$status){
    $this->load->database();
    $query = $this->db->query("UPDATE meeting SET status = '$status' WHERE id = '$mid'");
  }


}

?>