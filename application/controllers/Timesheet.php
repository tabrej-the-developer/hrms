<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timesheet extends CI_Controller {

	public function index(){
		if($this->session->has_userdata('LoginId')){
		redirect(base_url().'timesheet/timesheetDashboard');
			}
		else{
			$this->load->view('redirectToLogin');
		}
	}

	public function timesheetDashboard(){
		if($this->session->has_userdata('LoginId')){
			if(!isset($_GET['center'])){
							$id = 0;
							$oldid=1;
						}else{
							$id = $_GET['center'];
							$id = intval($id)-1;
							$oldid = $id;
						}
		$var['id'] = $id;
		$var['centerId'] = $oldid;
		$var['userId'] 	= $this->session->userdata('LoginId');
		$var['centers'] = $this->getAllCenters();
		$var['timesheets'] = $this->getPasttimesheets(json_decode($var['centers'])->centers[$id]->centerid);
			$this->load->view('getPastTimesheetsView',$var);
				}
		else{
			$this->load->view('redirectToLogin');
		}
	}

	public function getTimesheetDetails(){
	if($this->session->has_userdata('LoginId')){
		$data['timesheetid'] = $this->input->get('timesheetId');
		$data['userid'] = $this->session->userdata('LoginId');
		$data['timesheetDetails'] = $this->gettimesheet($data['timesheetid'],$data['userid']);
		$data['entitlements'] = $this->getAllEntitlements($data['userid']);
			$this->load->view('timesheetView',$data);
			}
		else{
			$this->load->view('redirectToLogin');
		}
	}

		public function getTimesheetDetailsModal(){
		if($this->session->has_userdata('LoginId')){
			$data['timesheetid'] = $this->input->get('timesheetId');
			$data['xa'] = $this->input->get('x');
			$data['ya'] = $this->input->get('y');
			$data['userid'] = $this->session->userdata('LoginId');
			$data['aT'] = $this->input->get('aT');
			$data['entitlements'] = $this->getAllEntitlements($data['userid']);
			$data['timesheetDetails'] = $this->gettimesheet($data['timesheetid'],$data['userid']);
			$data['shift'] = $this->getShiftType($data['userid']);
				$this->load->view('timesheetModal',$data);
				}
		else{
			$this->load->view('redirectToLogin');
		}
	}



	 function gettimesheet($timesheetid,$userid){
		
		$url = BASE_API_URL."/timesheet/getTimesheet/".$timesheetid."/".$userid;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'x-device-id: '.$this->session->userdata('x-device-id'),
			'x-token: '.$this->session->userdata('AuthToken')
		));
			$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 200){
			return $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

			}
		}

	public function getPastTimeSheets($centerid = 1){
		$url = BASE_API_URL."/timesheet/getPastTimesheet/".$centerid."/".$this->session->userdata('LoginId');
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'x-device-id: '.$this->session->userdata('x-device-id'),
			'x-token: '.$this->session->userdata('AuthToken')
		));
		$server_output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 200){
			return $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

		}
	}

		public function createTimesheet(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
			$data['startDate'] = $this->input->post('timesheet-date');;
			$data['centerid'] = $this->input->post('centerId');
			$data['userid'] = $this->session->userdata('LoginId');
			$data['staff'] = $this->getUsers();

 		$url = BASE_API_URL."/timesheet/createTimesheet";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				curl_close ($ch);
				redirect(base_url()."timesheet/TimesheetDashboard");
			}
			else if($httpcode == 401){
			//	redirect(base_url()."roster/roster_dashboard");
			}

	}
}
	
		
		function getAllCenters(){
		$url = BASE_API_URL."util/getAllCenters/".$this->session->userdata('LoginId');
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'x-device-id: '.$this->session->userdata('x-device-id'),
			'x-token: '.$this->session->userdata('AuthToken')
		));
		$server_output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 200){
			return $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

		}
	}



	function getUsers(){
		$url = BASE_API_URL."messenger/getUsers/".$this->session->userdata('LoginId');
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'x-device-id: '.$this->session->userdata('x-device-id'),
			'x-token: '.$this->session->userdata('AuthToken')
		));
		$server_output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 200){
			return $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

		}
	}

	function getAllEntitlements($userid){
		$url = BASE_API_URL."payroll/getAllEntitlements/".$this->session->userdata('LoginId');
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'x-device-id: '.$this->session->userdata('x-device-id'),
			'x-token: '.$this->session->userdata('AuthToken')
		));
		$server_output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 200){
			return $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

		}
	}

		public function getShiftType($userid){
		$url = BASE_API_URL."/payroll/getAllPayrollTypes/".$userid;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'x-device-id: '.$this->session->userdata('x-device-id'),
			'x-token: '.$this->session->userdata('AuthToken')
		));
		$server_output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 200){
			return $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

			}		
		}
}
