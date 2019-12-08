<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends CI_Controller {

	public function CreateLeaveType (){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('X-DEVICE-ID', $headers) && array_key_exists('X-TOKEN', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['X-DEVICE-ID'],$headers['X-TOKEN']);
			if($res != null && $res->userid == $userid){
				$json = json_decode(file_get_contents('php://input'));
				if($json != null){
					$name = $json->name;
					$slug = $json->slug;
					$isPaidYN = $json->isPaidYN;
					$userid = $json->userid;
					$userDetails = $this->authModel->getUserDetails($userid);
					if($userDetails != null && $userDetails->role == SUPERADMIN){
						$this->load->model('leaveModel');
						$this->leaveModel->createLeaveType($name,$isPaidYN,$slug,$userid);
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
		else{
			http_response_code(401);
		}
	}


	public function EditLeaveType(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('X-DEVICE-ID', $headers) && array_key_exists('X-TOKEN', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['X-DEVICE-ID'],$headers['X-TOKEN']);
			if($res != null && $res->userid == $userid){
				$json = json_decode(file_get_contents('php://input'));
				if($json != null){
					$leaveId = $json->leaveId;
					$name = $json->name;
					$slug = $json->slug;
					$isPaidYN = $json->isPaidYN;
					$userid = $json->userid;
					$userDetails = $this->authModel->getUserDetails($userid);
					if($userDetails != null && $userDetails->role == SUPERADMIN){
						$this->load->model('leaveModel');
						$this->leaveModel->editLeaveType($leaveId,$name,$isPaidYN,$slug);
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
		else{
			http_response_code(401);
		}
	}


	public function DeleteLeaveType(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('X-DEVICE-ID', $headers) && array_key_exists('X-TOKEN', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['X-DEVICE-ID'],$headers['X-TOKEN']);
			if($res != null && $res->userid == $userid){
				$json = json_decode(file_get_contents('php://input'));
				if($json != null){
					$leaveId = $json->leaveId;
					$userid = $json->userid;
					$userDetails = $this->authModel->getUserDetails($userid);
					if($userDetails != null && $userDetails->role == SUPERADMIN){
						$this->load->model('leaveModel');
						$this->leaveModel->deleteLeaveType($leaveId);
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
		else{
			http_response_code(401);
		}
	}

	public function GetAllLeavesByCenter($userid,$centerid,$startDate=null,$endDate=null){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('X-DEVICE-ID', $headers) && array_key_exists('X-TOKEN', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['X-DEVICE-ID'],$headers['X-TOKEN']);
			if($res != null && $res->userid == $userid){
				$this->load->model('leaveModel');
				$allLeaves = $this->leaveModel->getAllLeavesByCenter($centerid,$startDate,$endDate);
				$data = array();
				foreach ($allLeaves as $leaveApp) {
					$var['userid'] = $leaveApp->userid;
					$userDetails = $this->authModel->getUserDetails($var['userid']);
					$var['name'] = $userDetails->name;
					$var['title'] = $userDetails->title;
					$var['appliedDate'] = $leaveApp->appliedDate;
					$leaveDetails = $this->leaveModel->getLeaveType($leaveApp->id);
					$var['leaveTypeName'] = $leaveDetails->name;
					$var['leaveTypeSlug'] = $leaveDetails->slug;
					$var['startDate'] = $leaveApp->startDate;
					$var['endDate'] = $leaveApp->endDate;
					$var['status'] = $leaveApp->status == 1 ? "Applied" : ($leaveApp->status == 2 ? "Approved" : "Rejected");
					$var['notes'] = $leaveApp->notes;
					array_push($data,$var);
				}
				$mdata['centerId'] = $centerid;
				$mdata['leaves'] = $data;
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

	public function GetAllLeavesByUser($userid,$memeberid,$startDate=null,$endDate=null){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('X-DEVICE-ID', $headers) && array_key_exists('X-TOKEN', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['X-DEVICE-ID'],$headers['X-TOKEN']);
			if($res != null && $res->userid == $userid){
				$this->load->model('leaveModel');
				$allLeaves = $this->leaveModel->getAllLeavesByUser($centerid,$startDate,$endDate);
				$userDetails = $this->authModel->getUserDetails($memeberid);
				$data = array();
				foreach ($allLeaves as $leaveApp) {
					$var['appliedDate'] = $leaveApp->appliedDate;
					$leaveDetails = $this->leaveModel->getLeaveType($leaveApp->id);
					$var['leaveTypeName'] = $leaveDetails->name;
					$var['leaveTypeSlug'] = $leaveDetails->slug;
					$var['startDate'] = $leaveApp->startDate;
					$var['endDate'] = $leaveApp->endDate;
					$var['status'] = $leaveApp->status == 1 ? "Applied" : ($leaveApp->status == 2 ? "Approved" : "Rejected");
					$var['notes'] = $leaveApp->notes;
					array_push($data,$var);
				}
				$mdata['userid'] = $memeberid;
				$mdata['name'] = $userDetails->name;
				$mdata['leaves'] = $data;
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

	public function ApplyLeave(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('X-DEVICE-ID', $headers) && array_key_exists('X-TOKEN', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['X-DEVICE-ID'],$headers['X-TOKEN']);
			if($res != null && $res->userid == $userid){
				$json = json_decode(file_get_contents('php://input'));
				if($json != null){
					$userid = $json->userid;
					$leaveTypeId = $json->leaveTypeId;
					$startDate = $json->startDate;
					$endDate = $json->endDate;
					$notes = $json->notes;
					$this->load->model('leaveModel');
					$this->leaveModel->applyLeave($userid,$leaveTypeId,$startDate,$endDate,$notes);
					$data['Status'] = 'SUCCESS';
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

	public function GetLeaveBalance($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('X-DEVICE-ID', $headers) && array_key_exists('X-TOKEN', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['X-DEVICE-ID'],$headers['X-TOKEN']);
			if($res != null && $res->userid == $userid){
				$this->load->model('leaveModel');
				$allLeaves = $this->leaveModel->getLeaveBalance($userid);
				$data = array();
				foreach ($allLeaves as $lb) {
					$leaveDetails = $this->leaveModel->getLeaveType($lb->leaveId);
					$var['leaveTypeId'] = $lb->leaveId;
					$var['leaveName'] = $leaveDetails->name;
					$var['leaveSlug'] = $leaveDetails->slug;
					$var['isPaidYN'] = $leaveDetails->isPaidYN;
					$var['openingBalance'] = $lb->leavesAllocated;
					$var['closingBalance'] = $lb->leavesRemaining;
					$var['period'] = $lb->leavePeriod;
					$var['startDate'] = $lb->startDate;
					array_push($data,$var);
				}
				$mdata['balance'] = $data;
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

}