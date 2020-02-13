<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roster extends CI_Controller {

	public function index(){
		
		$this->load->view(base_url().'roster/roster_dashboard');
	}

public function roster_dashboard(){

	if($this->session->userdata('UserType') == SUPERADMIN ){
		if(!isset($_GET['center'])){
							$id = 0;
						}else{
							$id = $_GET['center'];
						}
		$var['centerId'] = $id;
		$var['userId'] 	= $this->session->userdata('LoginId');
		$var['centers'] = $this->getAllCenters();
		$var['rosters'] = $this->getPastRosters(json_decode($var['centers'])->centers[$id]->centerid);
	}
	else if($this->session->userdata('UserType') == ADMIN ){
			if(!isset($_GET['center'])){
					$id = 0;
			}else{
					$id = $_GET['center'];
			}
		$var['centerId'] = $id;
		$var['userId'] 	= $this->session->userdata('LoginId');
		$var['centers'] = $this->getAllCenters();
		$var['rosters'] = $this->getPastRosters(json_decode($var['centers'])->centers[$id]->centerid);
			}
	else{
		$var['userId'] 	= $this->session->userdata('LoginId');
		$var['rosters'] = $this->getPastRosters(json_decode($var['centers']));

			}
			$this->load->view('rosterView',$var);

}



	function getPastRosters($centerId = 1){
		$url = BASE_API_URL."/rosters/getPastRosters/".$centerId."/".$this->session->userdata('LoginId');
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

	public function getRosterDetails(){
		$data['rosterid'] = $this->input->get('rosterId');
		$data['userid'] = $this->session->userdata('LoginId');
		$data['rosterDetails'] = $this->getRoster($data['rosterid'],$data['userid'])
		$this->load->view('rosterData',$data);
	}

	 function getRoster($rosterid,$userid){
		
		$url = BASE_API_URL."/rosters/getRoster/".$rosterid."/".$userid;
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
			// $this->load->view('rosterData');
		}
		
		}


	public function createRoster(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
			$data['startDate'] = $this->input->post('roster-date');;
			$data['centerid'] = $this->input->post('centerId');
			$data['userid'] = $this->session->userdata('LoginId');
			$data['staff'] = $this->getUsers();

 		$url = BASE_API_URL."/Rosters/createRoster";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
		$server_output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
		$jsonOutput = json_decode($server_output);
				curl_close ($ch);
				$this->load->view('createRosterView',$data);
			}
			else if($httpcode == 401){

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
			$this->load->view('welcome_message');

		}
	}

	function updateShift(){
			$data['startTime'] = $this->input->post('startTime');
			$data['endTime'] = $this->input->post('endTime');
			$data['status'] = $this->input->post('status');
			$data['roleid'] = $this->input->post('roleId');
			$data['userid'] = $this->session->userdata('LoginId');
			$url = BASE_API_URL."rosters/updateShift";
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
			 curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				$this->load->view('createRosterView');
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
