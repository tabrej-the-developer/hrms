<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends CI_Controller {

	public function index(){
		
		redirect(base_url().'payroll/payrollList');
	}

	public function payrollList(){
	if($this->session->has_userdata('LoginId')){
		if( $this->getAllCenters() != 'error'){
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
				$var['payrolls'] = $this->getPastPayrolls($id);
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
			$this->load->view('payrollList',$var);
					}
		else{
			$this->load->view('redirectToLogin');
			}
	}

		function getPastPayrolls($centerid){
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

		public function getPayrollDetails(){
			$form_data = $this->input->post();
			if($form_data != null){
				$data['timesheetid'] = $form_data['timesheetid'];
				$data['empId'] = $form_data['userid'];
				$data['userid'] = $this->session->userdata('LoginId');
				$url = BASE_API_URL."Payroll/GetPayrollDetails";
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
					print_r($server_output);
					curl_close($ch);
				}
				else if($httpcode == 401){}
			}else{
				echo "{'status':'ERROR'}";
			}
		}

	public function payrollShifts(){
		if($this->session->has_userdata('LoginId')){
			$postData = $this->input->get();
			if($postData != null ){
				$data['userId'] = $this->session->userdata('LoginId');
				$data['timesheetId'] = $this->input->get('timesheetId');
				$data['payrollShifts'] = $this->getAllPayrollShifts($data['timesheetId'] , $data['userId']);
				$data['permissions'] = $this->fetchPermissions();
				$data['payrollTypes'] = $this->getAllPayrollTypes($data['userId']);
				// $data['entitlements'] = $this->getAllEntitlements($data['userId']);
			}
			//footprint start
			if($this->session->has_userdata('current_url')){
				footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
				$this->session->set_userdata('current_url',currentUrl());
			}
			// footprint end
			$this->load->view('payrollData',$data);
			// echo "<pre>";
			// print_r($data);
			// echo "</pre>";
				}
		else{
			$this->load->view('redirectToLogin');
			}
		}

		public function updateShiftStatus($timesheetid,$memberid){
		if($this->session->has_userdata('LoginId')){
			$form_data = $this->input->post();
					//footprint start
				if($this->session->has_userdata('current_url')){
					footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
					$this->session->set_userdata('current_url',currentUrl());
				}
				// footprint end
				$url = BASE_API_URL."payroll/updateShiftStatus/".$timesheetid."/".$memberid."/".$this->session->userdata('LoginId');
				if($form_data != null){
					$data['message'] = addslashes($this->input->post('message'));
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
							print_r($server_output);
						}
						else if($httpcode == 401){

						}
					}
				}
			}

		public function updateToPublished(){
		if($this->session->has_userdata('LoginId')){
			$form_data = $this->input->post();
					//footprint start
				if($this->session->has_userdata('current_url')){
					footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
					$this->session->set_userdata('current_url',currentUrl());
				}
				// footprint end
				$url = BASE_API_URL."payroll/updateToPublished/".$this->session->userdata('LoginId');
				if($form_data != null){
						$data['array'] = $this->input->post('array');
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
							print_r($server_output);
						}
						else if($httpcode == 401){

						}
					}
				}
			}

		public function payrollShiftsModal(){
			if($this->session->has_userdata('LoginId')){
				$postData = $this->input->get();
				if($postData != null ){
					$data['x'] = $this->input->get('x');
					$data['userId'] = $this->session->userdata('LoginId');
					$data['timesheetId'] = $this->input->get('timesheetId');
					$data['payrollShifts'] = $this->getAllPayrollShifts($data['timesheetId'] , $data['userId']);
					$data['payrollTypes'] = $this->getAllPayrollTypes($data['userId']);
					$data['entitlements'] = $this->getAllEntitlements($data['userId']);
				}
			//footprint start
			if($this->session->has_userdata('current_url')){
				footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
				$this->session->set_userdata('current_url',currentUrl());
			}
			// footprint end
			$this->load->view('payrollModal',$data);
			// echo '<pre>';
			// print_r($data);
			// echo '</pre>';
				}
		else{
			$this->load->view('redirectToLogin');
			}
		}

		public function getAllPayruns($timesheetid){
			$userid = $this->session->userdata('LoginId');
			$url = BASE_API_URL."timesheet/getPayruns/".$timesheetid."/".$userid;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
			$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			// echo $httpcode;
			// print_r($server_output);
			// die();
			if($httpcode == 200){
				echo json_encode($server_output);
				curl_close ($ch);
			}
			else if($httpcode == 401){

			}
		}

		public function getPayslip($payslipId,$timesheetId){
			$userid = $this->session->userdata('LoginId');
			$url = BASE_API_URL."payroll/getPayslipData/$payslipId/$timesheetId/$userid";
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
			$server_output = curl_exec($ch);
			$data['PaySlip'] = $server_output;
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				$this->load->view('printPayslip',$data);
				curl_close ($ch);
			}
			else if($httpcode == 401){

			}
		}

		public function printPayslipPDF($payslipId,$timesheetId){
			$url = BASE_API_URL."Payroll/getPayslipDetails/$payslipId/$timesheetId/".$this->session->userdata('LoginId');
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
				$output = json_decode($server_output);
				if($output->Status == 'SUCCESS'){
					redirect($output->path.$output->file);
				}else{
					print_r("<h1>ERROR please go back</h1>");
				}
				curl_close ($ch);
			}
			else if($httpcode == 401){
	
			}
		}

		 function getAllPayrollShifts($timesheetid,$userid){
			$url = BASE_API_URL."payroll/getAllPayrollShifts/".$timesheetid."/".$userid;
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
			$url = BASE_API_URL."Payroll/getAllEntitlements/".$userid;
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

		function getAllPayrollTypes($userid){
			$url = BASE_API_URL."Payroll/getAllPayrollTypes/".$userid;
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


