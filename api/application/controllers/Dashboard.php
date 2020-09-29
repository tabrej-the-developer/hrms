<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{

	function __construct() {
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-DEVICE-ID,X-TOKEN, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$method = $_SERVER['REQUEST_METHOD'];
		if($method == "OPTIONS") {
			die();
			}
		parent::__construct();
	}

	public function index(){

	}

	public function moduleRowCounts($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
						$this->load->model('utilModel');
						$userDetails = $this->utilModel->getUserDetails($userid);
						$centers = explode("|",$userDetails[0]->center);
						$this->load->model('dashboardModel');
						$data = [];
						$data['rostersCount'] =  0;
						$data['timesheetsCount'] = 0;
						$data['payrollsCount'] =  0;
						$data['leavesCount'] = 0;
						foreach($centers as $centerid){
						if($centerid != null || $centerid != ""){
						$data['rostersCount'] = $data['rostersCount']+sizeof($this->dashboardModel->rosterCount($centerid,'Published',$userid)) + sizeof($this->dashboardModel->rosterCount($centerid,'Draft',$userid));
						$data['timesheetsCount'] = $data['timesheetsCount']+sizeof($this->dashboardModel->timesheetCount($centerid,'Published',$userid))+sizeof($this->dashboardModel->timesheetCount($centerid,'Draft',$userid));
						$data['payrollsCount'] = $data['payrollsCount']+sizeof($this->dashboardModel->payrollCount($centerid));
						$data['leavesCount'] = $data['leavesCount'] + sizeof($this->dashboardModel->leavesCount($centerid));
						}
					}
				http_response_code(200);
				echo json_encode($data);
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

		public function getFootprints($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
						$this->load->model('dashboardModel');
				$data['footprints'] = $this->dashboardModel->getFootprints($userid);
				http_response_code(200);
				echo json_encode($data);
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function calendarDetails($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('dashboardModel');
				$this->load->model('rostersModel');
				$this->load->model('leaveModel');
				$totalDays = cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
				$events = [];
				$event['event'] = [];
				$event['birthdays'] = [];
				$event['anniversary'] = [];
				$y = date('Y');
				$m = date('m');
				$startDate = "$y-$m-01";
				for($i=0;$i<$totalDays;$i++){
				$currentDate = date('Y-m-d', strtotime("+$i day", strtotime("$startDate")));
				$getShiftDetails = $this->dashboardModel->getShiftDetails($userid,$currentDate);
					if($getShiftDetails != null){
						if($getShiftDetails != ""){
							$mdata['title'] = 'Shift - '.$this->timex( $getShiftDetails->startTime) .' - '.$this->timex( $getShiftDetails->endTime);
							$mdata['start'] = $currentDate;
							$mdata['roster'] = $getShiftDetails->roasterId;
							array_push($events,$mdata);
					}
				}	
				$getLeaveDetails = $this->leaveModel->getLeaveApplicationForUser($userid,$currentDate);
				if($getLeaveDetails != null ){
						if( $getLeaveDetails != "" ){
						$mbdata['title'] = 'Leave Status - '.$getLeaveDetails->status;
						$mbdata['start'] = $currentDate;
						array_push($events,$mbdata);
							}
						}

				$getBirthdays = $this->dashboardModel->getBirthdays($currentDate);
				if($getBirthdays != null){
					if($getBirthdays != ""){
						$mxdata['date'] = $currentDate;
						$mxdata['birthday'] = $getBirthdays;
						array_push($event['birthdays'],$mxdata);
					}
				}
				$getAnniversaries = $this->dashboardModel->getAnniversaries($currentDate);
				if($getAnniversaries != null ){
					if($getAnniversaries != ""){
						$mydata['date'] = $currentDate;
					$mydata['anniversary'] =  $getAnniversaries;
					array_push($event['anniversary'],$mydata);
					}
				}
		 	}
			$getMeetings = $this->dashboardModel->getAllMeetingsForUser($userid);
				if($getMeetings != null ){
						if( $getMeetings != "" ){
							foreach($getMeetings as $meeting){
							$madata['title'] = $meeting->title.'- Meeting';
							$madata['start'] = $meeting->date;
							$madata['meetingId'] = $meeting->id;
							$madata['meetingStatus'] = $meeting->status;
							array_push($events,$madata);
								}
							}
						}
					array_push($event['event'],$events);
				http_response_code(200);
				echo json_encode($event);
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

	function timex( $x)
	{ 
	    $output;
	    if(($x/100) < 12){
	        if(($x%100)==0){
	         $output = intval($x/100) . ":00 AM";
	        }
	    	if(($x%100)!=0){
		    	if(($x%100) < 10){
		    		$output = intval($x/100) .":0". $x%100 . " AM";
		    	}
	    		if(($x%100) >= 10){
	    			$output = intval($x/100) .":". $x%100 . " AM";
	    		}
	        }
	    }
	else if(intval($x/100)>12){
	    if(($x%100)==0){
	    $output = intval($x/100)-12 . ":00 PM";
	    }
	    if(($x%100)!=0){
	    	if(($x%100) < 10){
	    		$output = intval($x/100)-12 .":0". $x%100 . " PM";
	    	}
    		if(($x%100) >= 10){
    			$output = intval($x/100)-12 .":". $x%100 . " PM";
    		}
	    }
	}
	else{
	if(($x%100)==0){
	     $output = intval($x/100) . ": 00 PM";
	    }
	    if(($x%100)!=0){
	    	if(($x%100) < 10){
	    		$output = intval($x/100) . ":0". $x%100 . " PM";
	    	}
	    	if(($x%100) >= 10){
	    		$output = intval($x/100) . ":". $x%100 . " PM";
	    	}
	    }
	}
	return $output;
}
}