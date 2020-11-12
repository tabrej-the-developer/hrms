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
			if($this->getAllCenters() != 'error'){
				$var['centers'] = $this->getAllCenters();
			  	if(!isset($_GET['center'])){
			  		if(!isset($_SESSION['centerr'])){
							$id = json_decode($var['centers'])->centers[0]->centerid;
							$_SESSION['centerr'] = $id;
			  		}else{
			  			$id = $_SESSION['centerr'];
			  		}

						}else{
							$id = $_GET['center'];
							$_SESSION['centerr'] = $id;
						}
				$var['id'] = $id;
				$var['centerId'] = $id;
				$var['userId'] 	= $this->session->userdata('LoginId');
		$var['permissions'] = $this->fetchPermissions();
		$var['centers'] = $this->getAllCenters();
		$var['center__'] = $id;
		$var['timesheets'] = $this->getPasttimesheets($id);
			}
		else{
			$var['error'] = 'error';
		}
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
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
		$data['permissions'] = $this->fetchPermissions();
		$data['timesheetDetails'] = $this->gettimesheet($data['timesheetid'],$data['userid']);
		$data['payrollTypes'] = $this->getShiftType($data['userid']);
		// var_dump($data);
		if( $this->getAllCenters() != 'error'){
			$data['entitlements'] = $this->getAllEntitlements($data['userid']);
		}else{
			$data['error'] = 'error';
		}
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
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
			$data['date'] = $this->input->get('date');
			$data['userid'] = $this->session->userdata('LoginId');
			$data['aT'] = $this->input->get('aT');
			$data['empId'] = $this->input->get('empId');
			$data['entitlements'] = $this->getAllEntitlements($data['userid']);
			$data['timesheetDetails'] = $this->gettimesheet($data['timesheetid'],$data['userid']);
			$data['shift'] = $this->getShiftType($data['userid']);
			$data['centerid'] = $this->input->get('centerid');
			$data['rosterShift'] = $this->getRosterShifts($data['userid'],$data['empId'],$data['date']);
			// print_r($data['userid']." ".$data['empId']." ".$data['date']);
				$this->load->view('timesheetModal',$data);
				}
		else{
			$this->load->view('redirectToLogin');
		}
	}

	public function getEmployeeTimesheet(){
		$this->load->helper('form');
		$formData = $this->input->post();
		if($formData != null && $formData != ""){
			$date = $formData['startdate'];
			$empId = $formData['employeeId'];
			$url = BASE_API_URL."timesheet/getUserWeekTimesheet/".$this->session->userdata('LoginId')."/".$date."/".$empId;
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
			print_r($server_output);
			curl_close ($ch);
		}
		else if($httpcode == 401){

			}
		}else{
			print_r('{FAILED : Please enter valid input}');
			http_response_code(401);
		}
	}

	public function publishTimesheet($timesheetId){
		$url = BASE_API_URL."timesheet/publishTimesheet/".$timesheetId."/".$this->session->userdata('LoginId');
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

	 public function discardTimesheet($timesheetid){
	 	$userid = $this->session->userdata('LoginId');
		$url = BASE_API_URL."timesheet/discardTimesheet/".$timesheetid."/".$userid;
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

		function getRosterShifts($userid,$empId,$date){
			$url = BASE_API_URL."/timesheet/getRosterShifts/".$userid."/".$empId."/?date=".$date;
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
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
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
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
			$date = date_create($this->input->post('timesheet-date'));
			$data['startDate'] = date_format($date,"Y-m-d");
			$data['centerid'] = $this->input->post('centerId');
			$data['userid'] = $this->session->userdata('LoginId');
			$data['staff'] = $this->getUsers();

 		$url = BASE_API_URL."timesheet/createTimesheet";
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
				redirect(base_url()."roster/roster_dashboard");
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
			return 'error';
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

	public function createPayroll(){
		$form_data = $this->input->post();
		if($form_data != null){
			$data['userid'] = $this->session->userdata('LoginId');
			$data['empId'] = $this->input->post('empId');
			$data['shiftDate'] = $this->input->post('shiftDate');
			$data['timesheetid'] = $this->input->post('timesheetid');
			$data['visits'] = $this->input->post('visits');
			$url = BASE_API_URL."timesheet/createPayrollEntry";
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
			print_r($server_output);
			if($httpcode == 200){
			print_r($server_output);
				curl_close ($ch);
				}
			else if($httpcode == 401){
		
				}	
		}
	}

	public function createWeekPayroll(){
		$form_data = $this->input->post();
		if($form_data != null){
			$data['userid'] = $this->session->userdata('LoginId');
			$data['empId'] = $this->input->post('empId');
			$data['timesheetid'] = $this->input->post('timesheetid');
			$data['visits'] = $this->input->post('visits');
			$url = BASE_API_URL."timesheet/createWeekPayrollEntry";
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
			print_r($server_output);
			if($httpcode == 200){
			print_r($server_output);
				curl_close ($ch);
				}
			else if($httpcode == 401){
		
				}	
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
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
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
		function fetchPermissions(){
			$url = BASE_API_URL."auth/fetchMyPermissions/".$this->session->userdata('LoginId');
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