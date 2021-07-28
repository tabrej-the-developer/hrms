<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends CI_Controller {

	public function index(){
		if($this->session->has_userdata('LoginId')){
			  if($this->getLeaveType() == 'failed'){
				  $data['error'] = 'failed';
			  }
			  $data['centers'] = $this->getAllCenters();
			  if(!isset($_GET['center'])){
				  if(!isset($_SESSION['centerr'])){
						$id = json_decode($data['centers'])->centers[0]->centerid;
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
			  $data['leaveType'] = $this->getLeaveType();
			  if($data['centers'] != null){
				  $data['leaves'] = $this->getLeaveByCenter($id);
				  $data['leaveRequests'] = $this->getAllLeavesByUser();
			  }
			  $data['balance'] = $this->getLeaveBalance();
			  $data['permissions'] = $this->fetchPermissions();
			  //footprint start
			  if($this->session->has_userdata('current_url')){
				  footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
				  $this->session->set_userdata('current_url',currentUrl());
			  }
			  // footprint end
			  $this->load->view('leaveView',$data);
		  }
		  else{
			  $this->load->view('redirectToLogin');
		  }
	  }
  
	function getLeaveType(){
		$url = BASE_API_URL."leave/getAllLeaveTypes/".$this->session->userdata('LoginId');
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
			return 'failed';
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

	function getLeaveBalance(){
		$url = BASE_API_URL."leave/getLeaveBalance/".$this->session->userdata('LoginId');
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

	function getLeaveByCenter($centerid){
		$url = BASE_API_URL."leave/getAllLeavesByCenter/".$this->session->userdata('LoginId')."/".$centerid;
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

	function getAllLeavesByUser(){
		$url = BASE_API_URL."leave/getAllLeavesByUser/".$this->session->userdata('LoginId');
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

	public function addLeaveType(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
			//var_dump($form_data);
			$data['leaveId'] = $form_data['leaveId'];
			$data['name'] = $form_data['leaveName'];
			$data['slug'] = $form_data['leaveSlug'];
			$data['isPaidYN'] = isset($form_data['leaveIsPaid']) ? "Y" : "N";
			$data['userid'] = $this->session->userdata('LoginId');

			if($data['leaveId'] == "")
				$url = BASE_API_URL."leave/createLeaveType";
			else
				$url = BASE_API_URL."leave/editLeaveType";
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
			//var_dump($server_output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				curl_close ($ch);
				redirect(base_url().'leave');
			}
			else if($httpcode == 401){

			}
		}
	}

	public function deleteLeaveType(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
			//var_dump($form_data);
			$data['leaveId'] = $form_data['leaveId'];
			$data['userid'] = $this->session->userdata('LoginId');

			$url = BASE_API_URL."leave/deleteLeaveType";

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
			//var_dump($server_output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				curl_close ($ch);
				redirect(base_url().'leave');
			}
			else if($httpcode == 401){

			}
		}
	}

	public function updateLeaveApp(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
			//var_dump($form_data);
			$data['leaveApplication'] = $form_data['leaveId'];
			$data['status'] = $form_data['status'];
			$data['userid'] = $this->session->userdata('LoginId');
			if(isset($form_data['status'])){
					$data['message'] = $form_data['message'];
					}
					else{
						$form_data['message'] = ''; 
						}

			$url = BASE_API_URL."leave/UpdateLeaveApplication";

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
			//var_dump($server_output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				curl_close ($ch);
			}
			else if($httpcode == 401){

			}
		}
	}

	public function applyLeave(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
			$data['leaveTypeId'] = $form_data['applyLeaveId'];
			$data['startDate'] = $form_data['applyLeaveFromDate'];
			$data['endDate'] = $form_data['applyLeaveToDate'];
			$data['notes'] = $form_data['applyLeaveNotes'];
			$data['userid'] = $this->session->userdata('LoginId');
			$data['hours'] = $form_data['total_leave_hours'];

			$url = BASE_API_URL."leave/ApplyLeave";

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
			//var_dump($server_output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			print_r($httpcode);
			print_r($server_output);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				curl_close ($ch);
				redirect(base_url().'leave');
			}
			else if($httpcode == 401){

			}
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
