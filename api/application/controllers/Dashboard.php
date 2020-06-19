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
}