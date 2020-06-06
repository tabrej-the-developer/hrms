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

	public function GetAllEmployeesByCenter($centerid,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('utilModel');
				$mdata['employees'] = $this->utilModel->getEmployessByCenter($centerid);
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

	public function footprint(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$json = json_decode(file_get_contents('php://input'));
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($json!= null && $res != null && $res->userid == $json->userid){
				$this->load->model('utilModel');
				$currentUrl = $json->currentUrl;
				$previousUrl = $json->previousUrl;
				$userid = $json->userid;
				$ip = $json->ip;
				$type = $json->type;
				if($type == "LoggedIn"){
					$query = $this->utilModel->getFootprint($userid);
					if($query[0]->end_time == "0000-00-00 00:00:00"){
						$q = $this->utilModel->updateFootprint(date("Y-m-d H:i:s"),$query[0]->id);
					}
					$this->utilModel->insertFootprint($currentUrl,$previousUrl,date("Y-m-d H:i:s"),' ',$ip,$userid);
				}
				if($type == "LogIn"){
				$this->utilModel->insertFootprint($currentUrl,$previousUrl,date("Y-m-d H:i:s"),date("Y-m-d H:i:s"),$ip,$userid);
				}
				if($type == "LogOut"){
					$query = $this->utilModel->getFootprint($userid);
					if($query[0]->end_time == "0000-00-00 00:00:00"){
						$q = $this->utilModel->updateFootprint(date("Y-m-d H:i:s"),$query[0]->id);
					}
				$this->utilModel->insertFootprint($currentUrl,$previousUrl,' ',date("Y-m-d H:i:s"),$ip,$userid);
				}
				$data['status'] = 'success';
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
}



	// 	if($type == "LoggedIn"){
	// $query1 = $this->db->query("UPDATE footprints SET end_time = now() WHERE userid = '$userid' ORDER BY id DESC LIMIT 1 AND end_time = '0000-00-00 00:00:00'");
	// $query2 = $this->db->query("INSERT into footprints (page_tag,prev_page_tag,start_time,ip,userid) VALUES ('$currentUrl','$previousUrl',now(),'$ip','$userid')");
	// 		}
	// 	if($type == "LogIn"){
	// 	$query = $this->db->query("INSERT into footprints (page_tag,prev_page_tag,start_time,end_time,ip,userid) VALUES ('$currentUrl',' ',now(),now(),'$ip','$userid')");
	// 		}
	// 	if($type == "LogOut"){
	// 	$query = $this->db->query("INSERT into footprints (page_tag,prev_page_tag,start_time,end_time,ip,userid) VALUES ('$currentUrl','$previousUrl',now(),now(),'$ip','$userid')");
	// 		}