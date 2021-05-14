<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mom extends CI_CONTROLLER
{

  function __construct()
  {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-DEVICE-ID,X-TOKEN,X-DEVICE-TYPE, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
      die();
    }
    parent::__construct();
  }

  public function getMeetings($id)
  {
    $headers = $this->input->request_headers();
    $headers = array_change_key_case($headers);
    if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
      $this->load->model('meetingModel');
      $this->load->model('authModel');
      $meetings = $this->meetingModel->getMeeting($id);
      $mdata['data'] = array();
      foreach ($meetings as $m) {
        if ($m->loginid == $id)
          $var['role'] = 'Creator';
        else $var['role'] = 'Participant';
        $var['mid'] = $m->id;
        $var['userid'] = $m->loginid;
        $var['title'] = $m->title;
        $var['date'] = $m->date;
        $var['time'] = $m->time;
        $var['location'] = $m->location;
        $var['summary'] = $m->summary;
        $var['status'] = $m->status; //s, MOM, Attendance, Summary
        $var['period'] = $m->period;
        // $var['created_at'] = $m->created_at;
        $var['m_previd'] = $m->m_previd;
        $var['participants'] = array();
        $boardMembers = $this->meetingModel->getMembers($m->id);
        foreach ($boardMembers as $b) {
          $userDetails = $this->authModel->getUserDetails($b->user_id);
          $var2['participateId'] = $b->id;
          $var2['participateUserId'] = $userDetails->id;
          $var2['participateEmail'] = $userDetails->email;
          $var2['participateName'] = $userDetails->name;
          $var2['participateImgUrl'] = $userDetails->imageUrl;
          $var2['participateStatus'] = $b->status;
          array_push($var['participants'], $var2);
        }
        $var['agendas'] = $this->meetingModel->getAgendaInfo($m->id);
        array_push($mdata['data'], $var);
      }
      http_response_code(200);
      echo json_encode($mdata);
    } else {
      http_response_code(401);
    }
  }


  public function getParticipant($mid)
  {

    $headers = $this->input->request_headers();
    $headers = array_change_key_case($headers);
    if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
      $this->load->model('meetingModel');
      $participants = $this->meetingModel->getPartcipant($mid);
      // var_dump($participants);
      // exit;
      $mdata = [];
      foreach ($participants as $p) {
        $var['uid'] = $p->user_id;
        $var['email'] = $p->email;

        array_push($mdata, $var);
      }

      http_response_code(200);
      echo json_encode($mdata);
    } else {
      $data['Error'] = 'Error';
      http_response_code(401);
      echo json_encode($data);
    }
  }

  public function Present($mid)
  {
    $headers = $this->input->request_headers();
    $headers = array_change_key_case($headers);
    if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
      $this->load->model('meetingModel');
      $participants = $this->meetingModel->getPresent($mid);
      // var_dump($participants);
      // exit;
      $mdata = [];
      foreach ($participants as $p) {
        $var['uid'] = $p->user_id;
        $var['email'] = $p->email;
        array_push($mdata, $var);
      }

      http_response_code(200);
      echo json_encode($mdata);
    } else {
      $data['Error'] = 'Error';
      http_response_code(401);
      echo json_encode($data);
    }
  }

  public function AddMeeting()
  {
    $headers = $this->input->request_headers();
    $headers = array_change_key_case($headers);
    if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
      $this->load->model('authModel');
      $res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
      $json = json_decode(file_get_contents('php://input'));
      if ($json != null && $res != null && $res->userid == $json->userid) {
        $this->load->model('meetingModel');
        $id = uniqid();
        $meetingTitle = $json->title;
        $date         = $json->date;
        if (isset($edate)) {
          $edate        = date('Y-m-d', strtotime($json->edate));
        }
        if (!isset($edate)) {
          $edate        = date('Y-m-d', strtotime($date));
        }
        $time         = sprintf('%02d', intval(str_replace(":", "", $json->time)));
        $endTime      = sprintf('%02d', intval(str_replace(":", "", $json->etime)));
        $agenda       = $json->agenda;
        $invites      = $json->invites;
        $location     = $json->location;
        $userid       = $json->userid;
        $period       = $json->period;
        $status       = $json->status;
        $agendaFile   = $json->agendaFile;
        $currentDate       = date("Y-m-d", strtotime($date));
        $dateDifference = strtotime($edate) - strtotime($date);
        //           if($json->agendaFile != null){
        //   $file = base64_decode($json->agendaFile);
        //   $agendaFile = uniqid()."-".uniqid()."pdf";
        // }
        // move_uploaded_file($file,'/assets/agendas/'.$agendaFile);
        // $collab = $json->collab;
        //$offset = $json->offset;
        // var_dump($meetingTitle,$date,$time,$agenda,$invites,$location,$userid,$period);
        if ($period == 'O') {
          $this->meetingModel->addMeeting($id, $meetingTitle, $date, $edate, $time, $endTime, $location, $period, null, $userid, $status, $agendaFile);
          $this->meetingModel->addParticipant($id, $userid);
          foreach ($agenda as $a) :
            $this->meetingModel->addAgenda($id, $a);
          endforeach;
          foreach ($invites as $i) :
            $this->meetingModel->addParticipant($id, $i);
          endforeach;
          // $currentDate = date_create($date);
          $currentMeetingId = $id;
        }
        if ($period == 'A') {
          //annual meeting
          $id = uniqid();
          //echo $currentDate;
          $dateOfMeeting = date('Y-m-d', strtotime($currentDate . '+1 year'));
          $this->meetingModel->addMeeting($id, $meetingTitle, $dateOfMeeting, date('Y-m-d', strtotime($dateOfMeeting . '+$dateDifference seconds')), $time, $endTime, $location, $period, null, $userid, $status, $agendaFile);
          $this->meetingModel->addParticipant($id, $userid);
          foreach ($agenda as $a) :
            $this->meetingModel->addAgenda($id, $a);
          endforeach;
          foreach ($invites as $i) :
            $this->meetingModel->addParticipant($id, $i);
          endforeach;
          //$afterOneYear = date("Y-m-d",$currentDate . " +1 year");
        } else if ($period == 'W') {
          //weekly meeting
          $index = 0;
          $dateOfMeeting = $currentDate;
          while ($index < 53) {
            $id = uniqid();
            $dateOfMeeting = date('Y-m-d', strtotime($currentDate . '+7days'));
            //$dateOfMeeting = date("Y-m-d",$dateOfMeeting . " +7 day");
            $this->meetingModel->addMeeting($id, $meetingTitle, date_format($dateOfMeeting, 'Y-m-d'), date('Y-m-d', strtotime($dateOfMeeting . '+$dateDifference')), $time, $endTime, $location, $period, $currentMeetingId, $userid, $status, $agendaFile);
            $this->meetingModel->addParticipant($id, $userid);
            foreach ($agenda as $a) :
              $this->meetingModel->addAgenda($id, $a);
            endforeach;
            foreach ($invites as $i) :
              $this->meetingModel->addParticipant($id, $i);
            endforeach;
            $currentMeetingId = $id;
            $index++;
          }
        } else if ($period == 'M') {
          //monthly meeting
          $index = 0;
          $dateOfMeeting = $date;
          while ($index < 12) {
            $id = uniqid();
            //$dateOfMeeting = date("Y-m-d",$dateOfMeeting . " +1 month");
            $endMeeting = date('Y-m-d', strtotime($dateOfMeeting . '+' . $dateDifference . 'seconds'));
            $this->meetingModel->addMeeting($id, $meetingTitle, $dateOfMeeting, $endMeeting, $time, $endTime, $location, $period, null, $userid, $status, $agendaFile, $status, $agendaFile);
            $dateOfMeeting = date('Y-m-d', strtotime($dateOfMeeting . '+1 month'));
            $this->meetingModel->addParticipant($id, $userid);
            foreach ($agenda as $a) :
              $this->meetingModel->addAgenda($id, $a);
            endforeach;
            foreach ($invites as $i) :
              $this->meetingModel->addParticipant($id, $i);
            endforeach;
            $currentMeetingId = $id;
            $index++;
          }
        }

        $data['Status'] = 'Success';
        http_response_code(200);
        echo json_encode($data);
      } else {
        http_response_code(401);
      }
    } else {
      http_response_code(401);
    }
  }

  public function meetingAttendence()
  {
    $headers = $this->input->request_headers();
    $headers = array_change_key_case($headers);
    if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
      $this->load->model('meetingModel');
      $json = json_decode(file_get_contents('php://input'));
      $attendence = $json->absent;
      $meetingId = $json->mId;
      if (isset($attendence)) {
        foreach ($attendence as $a) :
          $this->meetingModel->addAttendence($meetingId, $a);
        endforeach;
      }

      $this->meetingModel->updateMeetingStatus($meetingId, 'Attendance');

      $data['Status'] = 'SUCCESS';
      http_response_code(200);
      echo json_encode($data);
    } else {
      $data['Status'] = 'ERROR';
      http_response_code(401);
      echo json_encode($data);
    }
  }

  public function meetingRecord($mId)
  {
    $headers = $this->input->request_headers();
    $headers = array_change_key_case($headers);

    if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
      $this->load->model('meetingModel');
      $json = json_decode(file_get_contents('php://input'));
      $invites =  $json->invites;
      $sentence = $json->sentence;
      $remark = $json->remark;
      $len = count($invites);
      for ($it = 0; $it < $len; $it++) {
        $rem = isset($remark[$it]) ? $remark[$it] : "";
        $this->meetingModel->addMeetingRecord($mId, $invites[$it], $sentence[$it], $rem);
      }
      $this->meetingModel->updateMeetingStatus($mId, 'MOM');
      $data['Status'] = 'Success';
      http_response_code(200);
      echo json_encode($data);
    } else {
      $data['Status'] = 'Error';
      http_response_code(401);
      echo json_encode($data);
    }
  }

  public function addSummary($meetingId)
  {
    $headers = $this->input->request_headers();
    $headers = array_change_key_case($headers);
    if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
      $this->load->model('meetingModel');
      $json = json_decode(file_get_contents('php://input'));
      $summary = $json->summary;
      $t = $json->id;
      $mId = $meetingId;
      $len = count($summary);
      for ($k = 0; $k < $len; $k++) {
        $this->meetingModel->meetingSummary($t[$k], $summary[$k]);
      }
      $this->meetingModel->updateMeetingStatus($mId, 'Summary');
      $data['Status'] = 'Success';
      $data['respons_code'] = http_response_code(200);
      http_response_code(200);
      echo json_encode($data);
    } else {
      $data['Status'] = 'Error';
      http_response_code(401);
      echo json_encode($data);
    }
  }

  public function getSummary($mid)
  {
    $headers = $this->input->request_headers();
    $headers = array_change_key_case($headers);
    if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
      $this->load->model('meetingModel');
      $summary = $this->meetingModel->getSummary($mid);
      // var_dump($participants);
      // exit;
      $mdata = [];
      foreach ($summary as $p) {
        $var['id'] = $p->id;
        $var['text'] = $p->text;
        $var['summary'] = $p->summary;
        array_push($mdata, $var);
      }

      http_response_code(200);
      echo json_encode($mdata);
    } else {
      $data['Error'] = 'Error';
      http_response_code(401);
      echo json_encode($data);
    }
  }

  public function getMeetingInfo($mId)
  {
    $headers = $this->input->request_headers();
    $headers = array_change_key_case($headers);
    if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
      $this->load->model('meetingModel');
      $mdata['mom'] = $this->meetingModel->getMeetingInfo($mId);
      // var_dump($participants);
      // exit;
      $participants = $this->meetingModel->getPresent($mId);
      $title = $this->meetingModel->getTitle($mId);
      //    print_r($title);
      //    exit;
      // $mdata = [];
      // $mdata['title'] = $title->title;
      // $mdata['mom'] = null;
      $agenda = $this->meetingModel->getAgendaInfo($mId);
      $mdata['participant'] = [];
      //  foreach($data as $d){
      //     $var['text'] = $d->text;
      //     $var['remark'] = $d->remark;
      //    $var['userid'] = $d->user_id;
      //     array_push($mdata['mom'],$var);
      // }
      $mdata['agenda'] = [];
      foreach ($agenda as $a) {
        $var['text'] = $a->text;
        $var['summary'] = $a->summary;
        array_push($mdata['agenda'], $var);
      }
      foreach ($participants as $p) {
        $var1['userid'] = $p->user_id;
        $var1['status'] = $p->status;
        array_push($mdata['participant'], $var1);
      }
      // $mdata['Success'] = 'Success';
      http_response_code(200);
      echo json_encode($mdata);
    } else {
      $data['Error'] = 'Error';
      http_response_code(401);
      echo json_encode($data);
    }
  }

  public function updateMeeting()
  {
    $headers = $this->input->request_headers();
    $headers = array_change_key_case($headers);
    if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
      $this->load->model('meetingModel');
      $json = json_decode(file_get_contents('php://input'));

      $meetingTitle = $json->title;
      $date    = $json->date;
      $time    = $json->time;
      $agenda  = $json->agenda;
      $invites = $json->invites;
      $location = $json->location;
      $userId  = $json->userid;
      $period = $json->period;
      $id = $json->meetingId;

      $response  =   $this->meetingModel->updateMeeting($id, $meetingTitle, $date, $time, $location, $period);
      $deleteAgenda = $this->meetingModel->deleteAgenda($id);
      $deleteParticipnts = $this->meetingModel->deleteParticipant($id);

      foreach ($agenda as $a) :
        $this->meetingModel->addAgenda($id, $a);
      endforeach;
      foreach ($invites as $i) :
        $this->meetingModel->addParticipant($id, $i);
      endforeach;
      $data['Status'] = 'Success';
      http_response_code(200);
      echo json_encode($data);
    } else {
      $data['Status'] = 'ERROR';
      http_response_code(401);
      echo json_encode($data);
    }
  }
}
