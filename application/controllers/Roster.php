<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roster extends CI_Controller {

	public function index(){

		$this->load->view(base_url().'roster/roster_dashboard');
	}

	public function roster_dashboard($id=0){
		$var['userId'] 	= $this->session->userdata('LoginId');
		$var['centers'] = $this->getAllCenters();
		$var['rosters'] = $this->getPastRosters(json_decode($var['centers'])->centers[$id]->centerid);
	
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

}