<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MeetingModel extends CI_MODEL{

 public function addMeeting($meetingTitle,$invites,$date){
    $this->load->database();
    $id = uniqid();
     $query = $this->db->query("insert into meeting values('$id','$meetingTitle','$invites','$date')");
     if($query){
         return true;
     }
     else{
         return false;
     }

   
 }

}

?>