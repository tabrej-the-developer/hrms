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
						$data['rostersCount'] = $data['rostersCount']+sizeof($this->dashboardModel->rosterCount($centerid));
						$data['timesheetsCount'] = $data['timesheetsCount']+sizeof($this->dashboardModel->timesheetCount($centerid));
						$data['payrollsCount'] = $data['payrollsCount']+sizeof($this->dashboardModel->payrollCount());
						$data['leavesCount'] = $data['leavesCount'] + sizeof($this->dashboardModel->leavesCount());
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
				$y = date('Y');
				$m = date('m');
				$startDate = "$y-$m-01";
				for($i=0;$i<$totalDays;$i++){
				$currentDate = date('Y-m-d', strtotime("+$i day", strtotime("$startDate")));
				$getShiftDetails = $this->rostersModel->getShiftDetails($userid,$currentDate);
					if($getShiftDetails != null || $getShiftDetails != ""){
					$mdata['title'] = 'Role - '.($this->rostersModel->getRole($getShiftDetails->roleid))->roleName;
					$mdata['start'] = $currentDate;
					$mdata['roster'] = $getShiftDetails->roasterId;
					array_push($events,$mdata);
				}
				$getLeaveDetails = $this->leaveModel->getLeaveApplicationForUser($userid,$currentDate);
				if($getLeaveDetails != null || $getLeaveDetails != ""){
						$mbdata['title'] = 'Leave Status - '.$getLeaveDetails->status;
						$mbdata['start'] = $currentDate;
						array_push($events,$mbdata);
							}
					 }
				http_response_code(200);
				echo json_encode($events);
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}
}