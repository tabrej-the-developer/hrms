<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends CI_Controller {

	public function index(){
		
		redirect(base_url().'payroll/payrollList');
	}

	public function payrollList(){
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
		$var['payrolls'] = $this->getPastPayrolls(json_decode($var['centers'])->centers[$id]->centerid);
			$this->load->view('payrollList',$var);
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

		public function payrollShifts(){
			$postData = $this->input->get();
			if($postData != null ){
				$data['userId'] = $this->session->userdata('LoginId');
				$data['timesheetId'] = $this->input->get('timesheetId');
				$data['payrollShifts'] = $this->getAllPayrollShifts($data['timesheetId'] , $data['userId']);
				$data['payrollTypes'] = $this->getAllPayrollTypes($data['userId']);
				$data['entitlements'] = $this->getAllEntitlements($data['userId']);
			}
			$this->load->view('payrollData',$data);
		}

		public function payrollShiftsModal(){
			$postData = $this->input->get();
			if($postData != null ){
				$data['x'] = $this->input->get('x');
				$data['userId'] = $this->session->userdata('LoginId');
				$data['timesheetId'] = $this->input->get('timesheetId');
				$data['payrollShifts'] = $this->getAllPayrollShifts($data['timesheetId'] , $data['userId']);
				$data['payrollTypes'] = $this->getAllPayrollTypes($data['userId']);
				$data['entitlements'] = $this->getAllEntitlements($data['userId']);
			}
			$this->load->view('payrollModal',$data);
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


}
