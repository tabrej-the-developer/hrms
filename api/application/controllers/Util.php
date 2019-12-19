<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Util extends CI_Controller {


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
						$var['addState'] = $var->addState;
						$var['addZip'] = $var->addZip;
						$var['name'] = $var->name;
						$var['logo'] = $var->logo;
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