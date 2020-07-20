<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends CI_Controller {

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

	public function GetAllNotices($userid,$startDate = null,$endDate = null){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('noticeModel');
				$notices = $this->noticeModel->getAllNotices($userid,$startDate,$endDate);
				$data = array();
				foreach($notices as $notice){
					$var['noticeId'] = $notice->id;
					$userDetails = $this->authModel->getUserDetails($notice->senderId);
					$var['senderId'] = $notice->senderId;
					$var['senderName'] = $userDetails->name;
					$var['subject'] = $notice->subject;
					$var['text'] = $notice->htmlText;
					$var['date'] = $notice->sentDate;
					$var['status'] = $notice->status;
					array_push($data,$var);
				}
				$mdata['notices'] = $data;
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

	public function UpdateStatus(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json != null && $res != null && $res->userid == $json->userid){
				$noticeId = $json->noticeId;
				$userid = $json->userid;
				$status = $json->status;
				$this->load->model('noticeModel');
				$this->noticeModel->updateNotice($userid,$noticeId,$status);
				http_response_code(200);
				$data['Status'] = "SUCCESS";
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

	public function AddNotice($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($res != null && $res->userid == $userid){
				if($json != null){
					$userid = $json->userid;
					$text = $json->text;
					$subject = $json->subject;
					$this->load->model('noticeModel');
					foreach ($json->members as $memberid) {
						$this->noticeModel->addNotice($userid,$memberid,$subject,$text);
					}
					http_response_code(200);				}
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