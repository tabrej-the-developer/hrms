<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JobAdder extends CI_Controller {

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

	public function CreateJob(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$userid = $json->userid;
				$title = $json->title;
				$platform = $json->platform;
				$uniqueId = uniqid();
				$toAPI = $this->postJob($json);
				$userDetails = $this->authModel->getUserDetails($userid);
				if($userDetails != null && $userDetails->role == SUPERADMIN){
					$this->load->model('jobsModel');
					$this->jobsModel->createAdvertisement($title,$userid,$platform,$uniqueId);
					$data['Status'] = 'SUCCESS';
					http_response_code(200);
					echo json_encode($data);
				}
				else{

					$data['Status'] = 'ERROR';
					$data['Message'] = "You are not allowed";
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

	//public function getCenters(){}

	 function postJob($data){
		if($data != null){
			//var_dump($form_data);
			$url = "https://private-anon-bfcbbc34bd-adposting.apiary-mock.com/advertisement";
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type:application/vnd.seek.advertisement+json; version=1; charset=utf-8
				 Authorization:Bearer b635a7ea-1361-4cd8-9a07-bc3c12b2cf9e
				 Accept:application/vnd.seek.advertisement+json; version=1; charset=utf-8, application/vnd.seek.advertisement-error+json; version=1; charset=utf-8' )
			);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$server_output = curl_exec($ch);
			//var_dump($server_output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				$this->load->model('jobsModel');
				$this->jobsModel->addResponseData($jsonOutput->id,$jsonOutput->expiryDate);
			}
			else if($httpcode == 401){

			}
		}
	}
	//https://private-anon-bfcbbc34bd-adposting.apiary-mock.com/advertisement/
	public function getAdvertisement($advertisementId){
		if($data != null){
			//var_dump($form_data);
			$url = "https://private-anon-bfcbbc34bd-adposting.apiary-mock.com/advertisement/".$advertisementId;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type:application/vnd.seek.advertisement+json; version=1; charset=utf-8
				 Authorization:Bearer b635a7ea-1361-4cd8-9a07-bc3c12b2cf9e
				 Accept:application/vnd.seek.advertisement+json; version=1; charset=utf-8, application/vnd.seek.advertisement-error+json; version=1; charset=utf-8' )
			);
			$server_output = curl_exec($ch);
			//var_dump($server_output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				return $server_output;
				curl_close ($ch);
			}
			else if($httpcode == 401){

			}
		}
	}

		public function getAdvertisementByUser($advertiserId){
		if($data != null){
			//var_dump($form_data);
			$url = "https://adposting-integration.cloud.seek.com.au/advertisement?advertiserId=".$advertisementId;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type:application/vnd.seek.advertisement+json; version=1; charset=utf-8
				 Authorization:Bearer b635a7ea-1361-4cd8-9a07-bc3c12b2cf9e
				 Accept:application/vnd.seek.advertisement+json; version=1; charset=utf-8, application/vnd.seek.advertisement-error+json; version=1; charset=utf-8' )
			);
			$server_output = curl_exec($ch);
			//var_dump($server_output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				return $server_output;
				curl_close ($ch);
			}
			else if($httpcode == 401){

			}
		}
	}
		
}
