<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messenger extends CI_Controller {

	function __construct() {
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-DEVICE-ID,X-TOKEN,X-DEVICE-TYPE, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$method = $_SERVER['REQUEST_METHOD'];
		if($method == "OPTIONS") {
		die();
		}
		parent::__construct();
	}

	public function GetUsers($userid,$searchText=null){

		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$this->load->model('utilModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('messengerModel');
				$userDetails = ($this->utilModel->getUserDetails($userid));
				$getSuperAdmins = $this->utilModel->getSuperAdmins();
				$employees= [];
				// if($userDetails->role != 1){
					foreach($getSuperAdmins as $superadmin){
						// $centers = explode('|',$superadmin->center);
						$centers = $this->utilModel->getAllCenters($superadmin->id);
						foreach($centers as $cent){
							// $cs = explode('|',$userDetails->center);
							$cs = $this->utilModel->getAllCenters($userid);
							foreach($cs as $c){
								if($c->centerid == $cent->centerid && $c->centerid != "" && $c->centerid != null){
									$admin = $superadmin;
									break;
								}
							}
						}
					}

					// $adminCenters = explode('|',$admin->center);
					$adminCenters = $this->utilModel->getAllCenters($admin->id);
					foreach($adminCenters as $adminCents){
						if($adminCents != null && $adminCents != ""){
							$allUsersFromCenter = $this->utilModel->getAllUsersFromCenter($adminCents->centerid);
								if($allUsersFromCenter != null && $allUsersFromCenter != "" && count($allUsersFromCenter) > 0){
									array_push($employees,$allUsersFromCenter);
									}
							}
					}

					// $adminCenters = explode('|',$admin->center);
					// 	foreach($allUsersFromCenter as $u){
					// 		if($u->role != 1 ){
					// 			// $cntrs = explode('|',$u->center);
					// 			// foreach($cntrs as $cntr){
					// 				foreach($adminCenters as $adminCents){
					// 					if($u->centerid == $adminCents){
					// 						array_push($employees,$u);
					// 					}
					// 				}
					// 			// }
					// 		}
					// 	}
					// print_r(json_encode($employees));
				$centers = $employees;
				$data = array();
				// print_r(json_encode($users[0]));
				foreach ($centers as $center) {
					foreach($center as $u){
						$var['userid'] = $u->id;
						$var['username'] = $u->name;
						$var['imageUrl'] = $u->imageUrl;
						$var['designation'] = $u->title;
						$var['email'] = $u->email;
						array_push($data,$var);
					}
				}
                function sortUsers($my_array)
					{
						for($i=0;$i<count($my_array);$i++){
							$val = $my_array[$i];
							$j = $i-1;
							while($j >= 0 && strtolower($my_array[$j]['username']) > strtolower($val['username'])){
								$my_array[$j+1] = $my_array[$j];
								$j--;
							}
							$my_array[$j+1] = $val;
						}
					return $my_array;
					}
				$mdata['users'] = sortUsers($data);
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
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('messengerModel');
				$groups = $this->messengerModel->GetGroups($userid,$searchText);
				$data = array();
				foreach ($groups as $u) {
					$var['groupid'] = $u->groupId;
					$var['groupName'] = $u->groupName;
					$var['avatarUrl'] = $u->imageUrl;
					$var['memberCount'] = $this->messengerModel->GetMemberCount($u->groupId)->count;
					$var['adminId'] = $u->adminId;
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
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json != null && $res != null && $res->userid == $json->admin){
				$groupName = $json->groupName;
				$avatarUrl = $json->avatarUrl;
				$adminId = $json->admin;
				$this->load->model('messengerModel');
				$groupId = $this->messengerModel->CreateGroup($groupName,$adminId,$avatarUrl);
				foreach ($json->members as $groupMember) {
					$this->messengerModel->AddMember($groupId,$groupMember);
					$this->messengerModel->addTransaction($json->admin,$groupId,'Y',$groupMember.' is added to the group','TRANSACTION');
				}
				$this->messengerModel->AddMember($groupId,$adminId);
				$data['groupId'] = $groupId;
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

	public function AddMember(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json != null && $res != null && $res->userid == $json->userid){
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

	public function UpdateGroup(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json != null && $res != null && $res->userid == $json->userid){
				$groupId = $json->groupId;
				$groupName = $json->groupName;
				$avatarUrl = $json->avatarUrl;
				$this->load->model('messengerModel');
				if($avatarUrl == null){
					$this->messengerModel->UpdateGroupName($groupName,$groupId);
				}else{
				file_put_contents('application/assets/uploads/groupprofiles/'.$groupId.".png", base64_decode($avatarUrl));
				$this->messengerModel->UpdateGroup($groupName,$groupId.".png",$groupId);
			}
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

	public function LeaveGroup(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json != null && $res != null && $res->userid == $json->userid){
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

	public function DeleteGroup(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($res != null && $res->userid == $json->userid){
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

	public function GetGroupInfo($userid,$groupId){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
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
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
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

	public function RecentChats($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$this->load->model('utilModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('messengerModel');
				$chats = $this->messengerModel->GetRecentChat($userid);
				$data = array();
				foreach ($chats as $ch) {
					$recentChatDetails = $this->messengerModel->getRecentChatDetails($ch,$userid);
					foreach($recentChatDetails as $recentChatDetail){
						$var['id'] = $ch;
						$var['isGroupYN'] = $recentChatDetail->isGroupYN;
						if($var['isGroupYN'] == "Y"){
							$groupInfo = $this->messengerModel->GetGroupInfo($var['id']);
							if($groupInfo != null){
								$var['name'] = $groupInfo->groupName;
								$var['imgUrl'] = $groupInfo->imageUrl;
								$var['time'] = $recentChatDetail->sentDateTime;
								$var['senderName'] = $this->utilModel->getUserDetails($recentChatDetail->senderId)->name;
								$var['isGroupYN'] = 'Y';
							}
						}
						else{
							$userInfo = $this->authModel->getUserDetails($var['id']);
							$var['name'] = $userInfo->name;
							$var['imgUrl'] = $userInfo->imageUrl;
							$var['time'] = $recentChatDetail->sentDateTime;
							$var['isGroupYN'] = 'N';
						}
						$var['lastText'] = $recentChatDetail->chatText;
						array_push($data,$var);
					}
				}

				 function insertion_Sort($my_array)
					{
						for($i=0;$i<count($my_array);$i++){
							$val = $my_array[$i];
							$j = $i-1;
							while($j >= 0 && $my_array[$j]['time'] < $val['time']){
								$my_array[$j+1] = $my_array[$j];
								$j--;
							}
							$my_array[$j+1] = $val;
						}
					return $my_array;
					}
				$mdata['chats'] = insertion_Sort($data);
				$mdata['Status'] = "SUCCESS";
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


	public function GetUserChats($userid,$memberid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('messengerModel');
				$chats = $this->messengerModel->GetAllUserChats($userid,$memberid);
				$data = array();
				foreach ($chats as $ch) {
					$var['id'] = $ch->chatId;
					$var['senderId'] = $ch->senderId;
					$var['receiverId'] = $ch->receiverId;
					$var['chatText'] = $ch->chatText;
					$var['sentDateTime'] = $ch->sentDateTime;
					$var['mediaContent'] = $ch->mediaContent;
					$var['isGroupYN'] = 'N';
					$var['transactiontype'] = $ch->transactiontype;
					array_push($data,$var);
				}
				$mdata['chats'] = $data;
				$mdata['Status'] = "SUCCESS";
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

	public function GetGroupChats($userid,$groupId){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('messengerModel');
				$groupMem = $this->messengerModel->GetGroupMember($groupId,$userid);
				if($groupMem != null){
					$chats = $this->messengerModel->GetAllGroupChats($groupId);
					$data = array();
					foreach ($chats as $ch) {
						$var['id'] = $ch->chatId;
						$var['senderId'] = $ch->senderId;
						$var['receiverId'] = $ch->receiverId;
						$var['chatText'] = $ch->chatText;
						$var['sentDateTime'] = $ch->sentDateTime;
						$var['mediaContent'] = $ch->mediaContent;
						$var['isGroupYN'] = 'N';
						$var['transactiontype'] = $ch->transactiontype;
						array_push($data,$var);
					}
					$mdata['chats'] = $data;
					$mdata['Status'] = "SUCCESS";
					http_response_code(200);
					echo json_encode($mdata);
				}
				else{
					$mdata['Status'] = "ERROR";
					$mdata['Message'] = "You are not allowed to view chats in this group.";
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

	public function PostChat(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json != null && $res != null && $res->userid == $json->userid){
				$senderId = $json->userid;
				$receiverId = $json->receiverId;
				$isGroupYN = $json->isGroupYN;
				$chatText = $json->chatText;
				$mediaContent = $json->mediaContent;

				$this->load->model('messengerModel');
				$this->messengerModel->PostChat($senderId,$receiverId,$isGroupYN,$chatText,$mediaContent);
				$senderDetails = $this->authModel->getUserDetails($senderId);

				$mdata['senderName'] = $senderDetails->name;
				$mdata['senderId'] = $senderId;
				$mdata['isGroupYN'] = $isGroupYN;
				$mdata['type'] = "chat";
				$mdata['message'] = $chatText;
				   

				// if($isGroupYN == "Y"){
				// $gDetails = $this->messengerModel->GetGroupInfo($receiverId);
				// 	$allMembers = $this->messengerModel->GetAllMemberDetails($receiverId);
				// 	$mdata['groupId'] = $receiverId;	
				// 	$mdata['groupName'] = $gDetails->groupName;
				// 	foreach ($allMembers as $mem) {
				// 		$this->firebase->sendMessage('New message from '.$senderDetails->name.' in '.$gDetails->groupName,'Click to view message',$mdata,$mem->id);
				// 	}
				// }
				// else{
				// 	$this->firebase->sendMessage('New message from '.$senderDetails->name,'Click to view message',$mdata,$receiverId);
				// }

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

	public function removeUserFromGroup(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json != null && $res != null && $res->userid == $json->userid){
				$senderId = $json->userid;
				$receiverId = $json->receiverId;
				$isGroupYN = $json->isGroupYN;
				$chatText = $json->chatText;
				$mediaContent = null;
				$groupId = $json->groupId;
				$this->load->model('messengerModel');
				$this->messengerModel->addTransaction($senderId,$groupId,$isGroupYN,$chatText,$mediaContent,'TRANSACTION');
				$senderDetails = $this->authModel->getUserDetails($senderId);
				$this->messengerModel->LeaveGroup($groupId,$receiverId);

				$mdata['senderName'] = $senderDetails->name;
				$mdata['senderId'] = $senderId;
				$mdata['isGroupYN'] = $isGroupYN;
				$mdata['type'] = "chat";
				$mdata['message'] = $chatText;
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

}

?>