<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messenger extends CI_Controller {

	public function GetUsers($userid,$searchText=null){

		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('X-DEVICE-ID', $headers) && array_key_exists('X-TOKEN', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['X-DEVICE-ID'],$headers['X-TOKEN']);
			if($res != null && $res->userid == $userid){
				$this->load->model('messengerModel');
				$users = $this->messengerModel->GetUsers($userid,$searchText);
				$data = array();
				foreach ($users as $u) {
					$var['userid'] = $u->id;
					$var['username'] = $u->name;
					$var['imageUrl'] = base_url().USER_IMAGE_PATH.$u->imageUrl;
					$var['designation'] = $u->title;
					array_push($data,$var);
				}
				$mdata['users'] = $data;
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

	public function GetGroups($userid,$searchText=null){

		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('X-DEVICE-ID', $headers) && array_key_exists('X-TOKEN', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['X-DEVICE-ID'],$headers['X-TOKEN']);
			if($res != null && $res->userid == $userid){
				$this->load->model('messengerModel');
				$groups = $this->messengerModel->GetGroups($userid,$searchText);
				$data = array();
				foreach ($groups as $u) {
					$var['groupid'] = $u->groupId;
					$var['groupName'] = $u->groupName;
					$var['avatarUrl'] = base_url().GROUP_IMAGE_PATH.$u->imageUrl;
					$var['memberCount'] = $u->title;
					$var['adminId'] = $this->messengerModel->GetMemberCount($u->groupId)->count;
					array_push($data,$var);
				}
				$mdata['groups'] = $data;
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

	public function CreateGroup(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('X-DEVICE-ID', $headers) && array_key_exists('X-TOKEN', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['X-DEVICE-ID'],$headers['X-TOKEN']);
			if($res != null && $res->userid == $userid){
				$json = json_decode(file_get_contents('php://input'));
				if($json != null){
					$groupName = $json->groupName;
					$avatarUrl = $json->avatarUrl;
					$imageUrl = uniqid().'.png';
					file_put_contents(base_url().GROUP_IMAGE_PATH.$imageUrl, $avatarUrl);
					$adminId = $json->admin;
					$this->load->model('messengerModel');
					$groupId = $this->messengerModel->CreateGroup($groupName,$adminId,$imageUrl);
					foreach ($json->members as $groupMember) {
						$this->messengerModel->AddMember($groupId,$groupMember->memberid);
					}
					$this->messengerModel->AddMember($groupId,$adminId);
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

	public function AddMember(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('X-DEVICE-ID', $headers) && array_key_exists('X-TOKEN', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['X-DEVICE-ID'],$headers['X-TOKEN']);
			if($res != null && $res->userid == $userid){
				$json = json_decode(file_get_contents('php://input'));
				if($json != null){
					$groupId = $json->groupId;
					$adminId = $json->admin;
					$this->load->model('messengerModel');
					$g = $this->messengerModel->GetGroupInfo($groupId);
					$data = [];
					if($g->adminId == $adminId){
						foreach ($json->members as $groupMember) {
							$this->messengerModel->AddMember($groupId,$groupMember->memberid);
						}
						$data['Status'] = 'SUCCESS';
					}
					else{
						$data['Status'] = 'ERROR';
						$data['Message'] = 'Incorrect admin Id';
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

	public function UpdateGroup(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('X-DEVICE-ID', $headers) && array_key_exists('X-TOKEN', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['X-DEVICE-ID'],$headers['X-TOKEN']);
			if($res != null && $res->userid == $userid){
				$json = json_decode(file_get_contents('php://input'));
				if($json != null){
					$groupId = $json->groupId;
					$groupName = $json->groupName;
					$avatarUrl = $json->avatarUrl;
					$imageUrl = uniqid().'.png';
					file_put_contents(base_url().GROUP_IMAGE_PATH.$imageUrl, $avatarUrl);
					$this->load->model('messengerModel');
					$this->messengerModel->UpdateGroup($groupName,$imageUrl,$groupId);
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

	public function LeaveGroup(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('X-DEVICE-ID', $headers) && array_key_exists('X-TOKEN', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['X-DEVICE-ID'],$headers['X-TOKEN']);
			if($res != null && $res->userid == $userid){
				$json = json_decode(file_get_contents('php://input'));
				if($json != null){
					$groupId = $json->groupId;
					$userid = $json->userid;
					$this->load->model('messengerModel');
					$this->messengerModel->LeaveGroup($groupId,$userid);
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

	public function DeleteGroup(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('X-DEVICE-ID', $headers) && array_key_exists('X-TOKEN', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['X-DEVICE-ID'],$headers['X-TOKEN']);
			if($res != null && $res->userid == $userid){
				$json = json_decode(file_get_contents('php://input'));
				if($json != null){
					$groupId = $json->groupId;
					$userid = $json->userid;
					$this->load->model('messengerModel');
					$g = $this->messengerModel->GetGroupInfo($groupId);
					if($g->adminId == $userid){
						$this->messengerModel->DeleteGroup($groupId);
						$data['Status'] = 'SUCCESS';
					}
					else{
						$data['Status'] = 'ERROR';
						$data['Message'] = 'Permission denied';
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

	public function GetGroupInfo($userid,$groupId){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('X-DEVICE-ID', $headers) && array_key_exists('X-TOKEN', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['X-DEVICE-ID'],$headers['X-TOKEN']);
			if($res != null && $res->userid == $userid){
				$this->load->model('messengerModel');
				$m = $this->messengerModel->GetMember($groupId,$userid);
				$data = [];
				if($m != null){
					$groupInfo = $this->messengerModel->GetGroupInfo($groupId);
					$members = $this->messengerModel->GetAllMemberDetails($groupId);
					$data['groupid'] = $groupInfo->groupId;
					$data['groupName'] = $groupInfo->groupName;
					$data['avatarUrl'] = $groupInfo->imageUrl;
					$data['adminId'] = $groupInfo->adminId;
					$data['memberCount'] = $this->messengerModel->GetMemberCount($groupId)->count;
					$data['members'] = array();
					foreach ($members as $groupMember) {
						$var['memberid'] = $groupMember->id;
						$var['memberName'] = $groupMember->name;
						$var['avatarUrl'] = $groupMember->imageUrl;
						$var['designation'] = $groupMember->title;
						array_push($data['members'],$var);
					}
				}
				else{
					$data['Status'] = 'ERROR';
					$data['Message'] = 'Permission denied';
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

	public function GetUserInfo($userid,$memberid){

		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('X-DEVICE-ID', $headers) && array_key_exists('X-TOKEN', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['X-DEVICE-ID'],$headers['X-TOKEN']);
			if($res != null && $res->userid == $userid){
				$this->load->model('messengerModel');
				$user = $this->messengerModel->GetMemberDetails($memberid);
				$commonGroups = $this->messengerModel->GetCommonGroups($userid,$memberid);
				$data['memberid'] = $user->id;
				$data['memberName'] = $user->name;
				$data['avatarUrl'] = $user->imageUrl;
				$data['designation'] = $user->title;
				$data['groups'] = array();
				foreach ($commonGroups as $group) {
					$gInfo = $this->messengerModel->GetGroupInfo($group->gId);
					$var['groupid'] = $gInfo->groupId;
					$var['groupName'] = $gInfo->groupName;
					$var['avatarUrl'] = $gInfo->imageUrl;
					$var['adminId'] = $gInfo->adminId;
					$var['memberCount'] = $this->messengerModel->GetMemberCount($gInfo->groupId)->count;
					array_push($data['groups'],$var);
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
}

?>