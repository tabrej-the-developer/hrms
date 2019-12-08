<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends CI_Controller {

	public function GetAllNotices($userid,$startDate = null,$endDate = null){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('X-DEVICE-ID', $headers) && array_key_exists('X-TOKEN', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['X-DEVICE-ID'],$headers['X-TOKEN']);
			if($res != null && $res->userid == $userid){
				$this->load->model('noticeModel');
				$notices = $this->noticeModel->getAllNotices($userid,$startDate,$endDate);
				$data = array();
				foreach($notices as $notice){
					$var['noticeId'] = $notice->id;
					$userDetails = $this->authModel->getUserDetails($notice->senderId);
					$var['senderId'] = $userDetails->senderId;
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
		if($headers != null && array_key_exists('X-DEVICE-ID', $headers) && array_key_exists('X-TOKEN', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['X-DEVICE-ID'],$headers['X-TOKEN']);
			if($res != null && $res->userid == $userid){
				$json = json_decode(file_get_contents('php://input'));
				if($json != null){
					$noticeId = $json->noticeId;
					$userid = $json->userid;
					$status = $json->status;
					$this->load->model('noticeModel');
					$this->noticeModel->updateNotice($userid,$noticeId,$status);
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
		else{
			http_response_code(401);
		}
	}

	public function AddNotice(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('X-DEVICE-ID', $headers) && array_key_exists('X-TOKEN', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['X-DEVICE-ID'],$headers['X-TOKEN']);
			if($res != null && $res->userid == $userid){
				$json = json_decode(file_get_contents('php://input'));
				if($json != null){
					$userid = $json->userid;
					$text = $json->text;
					$subject = $json->subject;
					$this->load->model('noticeModel');
					foreach ($json->members as $memberid) {
						$this->noticeModel->addNotice($userid,$memberid,$subject,$text);
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
		else{
			http_response_code(401);
		}
	} 
}