<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function index(){
			$data['moduleEntryCount'] = $this->moduleEntryCounts();
			$data['footprints'] = $this->getFootprints($this->session->userdata('LoginId'));
		$this->load->view('dashboard',$data);
	}

	function moduleEntryCounts(){
		$url = BASE_API_URL."Dashboard/moduleRowCounts/".$this->session->userdata('LoginId');
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

		function getFootprints($userid){
		$url = BASE_API_URL."Dashboard/getFootprints/".$userid;
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

			// To find center
		// function getUserDetails($userid){
		// 	$url = BASE_API_URL."Util/getUserDetails/".$userid;
		// 	$ch = curl_init($url);
		// 	curl_setopt($ch, CURLOPT_URL,$url);
		// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// 	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		// 		'x-device-id: '.$this->session->userdata('x-device-id'),
		// 		'x-token: '.$this->session->userdata('AuthToken')
		// 	));
		// 	$server_output = curl_exec($ch);
		// 	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		// 	if($httpcode == 200){
		// 		return $server_output;
		// 		curl_close ($ch);
		// 	}
		// 	else if($httpcode == 401){

		// 	}
		// }

}