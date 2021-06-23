<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notice extends MY_Controller
{

	function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-DEVICE-ID,X-TOKEN,X-DEVICE-TYPE, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method == "OPTIONS") {
			die();
		}
		parent::__construct();
	}


	public function index()
	{
	}

	public function GetAllNotices($userid, $startDate = null, $endDate = null)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('noticeModel');
				$notices = $this->noticeModel->getAllNotices($userid, $startDate, $endDate);
				$noticeGroups = $this->noticeModel->getAllNoticeGroups($userid);
				foreach ($noticeGroups as $noticeGroup) {
					$groupNotices = $this->noticeModel->getAllNoticesForGroupId($noticeGroup->gid);
					$notices = array_merge($notices, $groupNotices);
				}
				$data = array();
				foreach ($notices as $notice) {
					$var['noticeId'] = $notice->id;
					$userDetails = $this->authModel->getUserDetails($notice->senderId);
					$var['senderId'] = $notice->senderId;
					$var['senderName'] = $userDetails->name;
					if (is_numeric($notice->receiverId) != 1) {
						$receiverDetails = $this->authModel->getUserDetails($notice->receiverId);
						$var['receiverId'] = isset($receiverDetails->name) ? $receiverDetails->name : "";
					} else {
						$receiverDetails = $this->noticeModel->getGroupDetails($notice->receiverId);
						$var['receiverId'] = $receiverDetails->groupName;
						$var['members'] = $this->noticeModel->getMembersOfGroup($notice->receiverId);
					}
					$var['subject'] = $notice->subject;
					$var['text'] = $notice->htmlText;
					$var['date'] = $notice->sentDate;
					$var['status'] = $notice->status;
					array_push($data, $var);
				}
				$mdata['notices'] = $data;
				http_response_code(200);
				echo json_encode($mdata);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function UpdateStatus()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($json != null && $res != null && $res->userid == $json->userid) {
				$noticeId = $json->noticeId;
				$userid = $json->userid;
				$status = $json->status;
				$this->load->model('noticeModel');
				$this->noticeModel->updateNotice($userid, $noticeId, $status);
				http_response_code(200);
				$data['Status'] = "SUCCESS";
				echo json_encode($data);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function AddNotice($userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($res != null && $res->userid == $userid) {
				if ($json != null) {
					$userid = $userid;
					$text = $json->text;
					$subject = $json->subject;
					$this->load->model('noticeModel');
					if ($text != null && $text != "" && $subject != null && $subject != "" && (count($json->members) > 0)) {
						foreach ($json->members as $memberid) {
							if (preg_match('/(isGROUP)/i', $memberid) == 0) {
								$config = array(
									'protocol'  => 'smtp',
									'smtp_host' => 'ssl://smtp.zoho.com',
									'smtp_port' => 465,
									'smtp_user' => 'demo@todquest.com',
									'smtp_pass' => 'K!ddz1ng',
									'mailtype'  => 'html',
									'charset'   => 'utf-8'
								);
								$this->load->library('email', $config); // Load email template
								$this->email->set_newline("\r\n");
								$this->email->from('demo@todquest.com', 'Todquest');
								$mailId = $this->noticeModel->getMailId($memberid);
								// $this->email->to("dheerajreddynannuri1709@gmail.com");
								// $this->email->to($mailId->email);
								$this->email->subject($subject);
								$this->email->message(html_entity_decode($text));
								$this->email->send();
								$this->noticeModel->addNotice($userid, $memberid, $subject, $text);
							}
							if (preg_match('/(isGROUP)/i', $memberid) == 1) {
								// $groupMembers = $this->noticeModel->getMembersOfGroup(substr($memberid,0,strlen($memberid)-6 ));
								// foreach($groupMembers as $member){
									$this->noticeModel->addNotice($userid, substr($memberid,0,strlen($memberid)-6 ), $subject, $text);
								// }
							}
						}
					}
					http_response_code(200);
				} else {
					http_response_code(401);
				}
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function createGroup($userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($res != null && $res->userid == $userid) {
				if ($json != null) {
					$this->load->model('noticeModel');
					$userid = $userid;
					$groupName = $json->groupName;
					$groupMembers = $json->groupMembers;
					if ($groupName != null && $groupName != "" && (count($groupMembers) > 0)) {
						$groupId = $this->noticeModel->createGroup($userid, $groupName);
						echo $groupId;
						foreach ($groupMembers as $memberid) {
							$this->noticeModel->addGroupMembers($memberid, $groupId);
						}
						$data['status'] = 'SUCCESS';
						http_response_code(200);
						echo json_encode($data);
					}
				} else {
					http_response_code(401);
				}
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function getGroupsForUser($userid)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('noticeModel');
				$userid = $userid;
				$groups = $this->noticeModel->getGroupsForUser($userid);

				http_response_code(200);
				echo json_encode($groups);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function getGroupUsers($userid, $groupId)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('noticeModel');
				$members = $this->noticeModel->getMembersOfGroup($groupId);
				http_response_code(200);
				echo json_encode($members);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function removeUserFromGroup($userid, $groupId, $memberId)
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			if ($res != null && $res->userid == $userid) {
				$this->load->model('noticeModel');
				$members = $this->noticeModel->removeUserFromGroup($groupId, $memberId);
				$data['Status'] = "SUCCESS";
				http_response_code(200);
				echo json_encode($members);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}

	public function addUsersToGroup()
	{
		$headers = $this->input->request_headers();
		$headers = array_change_key_case($headers);
		if ($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)) {
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'], $headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if ($res != null && $res->userid == $json->userid) {
				$this->load->model('noticeModel');
				$groupId = $json->groupId;
				$members = $json->members;
				foreach ($members as $memberId) {
					$userExist = $this->noticeModel->checkUser($memberId, $groupId);
					if ($userExist == null) {
						$members = $this->noticeModel->addGroupMembers($memberId, $groupId);
					}
				}
				$data['Status'] = "SUCCESS";
				http_response_code(200);
				echo json_encode($members);
			} else {
				http_response_code(401);
			}
		} else {
			http_response_code(401);
		}
	}
}
