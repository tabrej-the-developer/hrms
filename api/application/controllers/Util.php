<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Util extends CI_Controller {

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

	public function GetAllCenters($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$userDetails = $this->authModel->getUserDetails($userid);
				if($userDetails->role != 4){
					$this->load->model('utilModel');
					$centers = $this->utilModel->getAllCenters($userid);
					$data = array();
					foreach($centers as $cen){
						$var['centerid'] = $cen->centerid;
						$var['addStreet'] = $cen->addStreet;
						$var['addCity'] = $cen->addCity;
						$var['addState'] = $cen->addState;
						$var['addZip'] = $cen->addZip;
						$var['name'] = $cen->name;
						$var['logo'] = $cen->logo;
						array_push($data,$var);
					}
					$mdata['centers'] = $data;
					http_response_code(200);
					echo json_encode($mdata);
				}
				else{
					http_response_code(401);
				}
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