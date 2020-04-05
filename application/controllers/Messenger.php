<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messenger extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		redirect(base_url().'messenger/chats');
	}

	public function chats($currentUserId=null,$isGroupYN=null){

		if($currentUserId != null && $isGroupYN == null) return;
		if($this->session->has_userdata('LoginId')){
			$data['recentChats'] = $this->getRecentChats();
			if($currentUserId == null){
				$currentUserId = (json_decode($data['recentChats'])->chats);
				if($currentUserId != null){
					$currentUserId = $currentUserId[0];
					$isGroupYN = $currentUserId->isGroupYN;
					$currentUserId = $currentUserId->id;
				}
			}
			if($isGroupYN == "N"){
				$data['currentChat'] = $this->getUserChat($currentUserId);
				$data['currentUserInfo'] = $this->getUserInfo($currentUserId);
			}
			else if($isGroupYN == "Y"){
				$data['currentChat'] = $this->getGroupChat($currentUserId);
				$data['currentUserInfo'] = $this->getGroupInfo($currentUserId);
			}
			$data['currentUserId'] = $currentUserId;
			$data['isGroupYN'] = $isGroupYN;
			$data['users'] = $this->getUsers();
			$data['groups'] = $this->getGroups();
			$this->load->view('mView',$data);
		}
		else{
			$this->load->view('notAllowedView');
		}
	}

	public function postNewMessage(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
			$data['receiverId'] = $form_data['receiverId'];
			$data['isGroupYN'] = $form_data['isGroupYN'];
			$data['chatText'] = $form_data['chatText'];
			$data['mediaContent'] = null;
			$data['userid'] = $this->session->userdata('LoginId');
			$url="http://todquest.com/PN101/api/messenger/postChat";
			$ch = curl_init($url);

			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				curl_close ($ch);
				redirect(base_url().'messenger/chats/'.$data['receiverId'].'/'.$data['isGroupYN']);
			}
			else if($httpcode == 401){

			}
		}
	}

	public function exitGroup(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
			$data['groupId'] = $form_data['groupId'];
			$data['userid'] = $this->session->userdata('LoginId');
			$url="http://todquest.com/PN101/api/messenger/leaveGroup";
			$ch = curl_init($url);

			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				curl_close ($ch);
				redirect(base_url().'messenger/chats/');
			}
			else if($httpcode == 401){

			}
		}
	}

	public function deleteGroup(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		var_dump($form_data);
		if($form_data != null){
			$data['groupId'] = $form_data['groupId'];
			$data['userid'] = $this->session->userdata('LoginId');
			$url="http://todquest.com/PN101/api/messenger/deleteGroup";
			$ch = curl_init($url);

			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				curl_close ($ch);
				redirect(base_url().'messenger/chats/');
			}
			else if($httpcode == 401){

			}
		}
	}

	public function creategroup()
	{
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
			$data['groupName'] = $form_data['recipient-name'];
			if($data['groupName'] != ""){
				$users = json_decode($this->getUsers());
				$members = array();
				foreach ($users->users as $chatUser) {
					if(isset($form_data[$chatUser->userid])){
						array_push($members,$chatUser->userid);
					}
				}
				if(count($members) > 0){
					$data['members'] = $members;
					$data['admin'] = $this->session->userdata('LoginId');
					$data['avatarUrl'] = "";
					$url="http://todquest.com/PN101/api/messenger/createGroup";
					$ch = curl_init($url);
					

					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
					curl_setopt($ch, CURLOPT_HTTPHEADER, array(
						'x-device-id: '.$this->session->userdata('x-device-id'),
						'x-token: '.$this->session->userdata('AuthToken')
					));
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

					$server_output = curl_exec($ch);
					$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
					if($httpcode == 200){
						$jsonOutput = json_decode($server_output);
						curl_close ($ch);
						redirect(base_url().'messenger/chats/'.$jsonOutput->groupId.'/Y');
					}
					else if($httpcode == 401){

					}
				}
			}
		}
	}


	function getRecentChats(){
		$url = BASE_API_URL."messenger/recentChats/".$this->session->userdata('LoginId');
		//echo($url);
		//var_dump($this->session);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'x-device-id: '.$this->session->userdata('x-device-id'),
			'x-token: '.$this->session->userdata('AuthToken')
		));
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

	function getUsers(){
		$url = BASE_API_URL."messenger/getUsers/".$this->session->userdata('LoginId');
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'x-device-id: '.$this->session->userdata('x-device-id'),
			'x-token: '.$this->session->userdata('AuthToken')
		));
		$server_output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 200){
			return $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

		}
	}

	function getGroups(){
		$url = BASE_API_URL."messenger/getGroups/".$this->session->userdata('LoginId');
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'x-device-id: '.$this->session->userdata('x-device-id'),
			'x-token: '.$this->session->userdata('AuthToken')
		));
		$server_output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 200){
			return $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

		}
	}

	function getUserChat($userid){
		$url = BASE_API_URL."messenger/getUserChats/".$this->session->userdata('LoginId')."/".$userid;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'x-device-id: '.$this->session->userdata('x-device-id'),
			'x-token: '.$this->session->userdata('AuthToken')
		));
		$server_output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 200){
			return $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

		}
	}

	function getGroupChat($groupid){
		var_dump($groupid);
		$url = BASE_API_URL."messenger/getGroupChats/".$this->session->userdata('LoginId')."/".$groupid;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'x-device-id: '.$this->session->userdata('x-device-id'),
			'x-token: '.$this->session->userdata('AuthToken')
		));
		$server_output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 200){
			return $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

		}
	}

	function getUserInfo($userid){
		$url = BASE_API_URL."messenger/getUserInfo/".$this->session->userdata('LoginId')."/".$userid;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'x-device-id: '.$this->session->userdata('x-device-id'),
			'x-token: '.$this->session->userdata('AuthToken')
		));
		$server_output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 200){
			return $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

		}
	}


	function getGroupInfo($groupid){
		$url = BASE_API_URL."messenger/getGroupInfo/".$this->session->userdata('LoginId')."/".$groupid;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'x-device-id: '.$this->session->userdata('x-device-id'),
			'x-token: '.$this->session->userdata('AuthToken')
		));
		$server_output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 200){
			return $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

		}
	}

	// public function dummyPost(){
		// $this->load->helper('form');
		// $form_data = $this->input->post();
		// //basic checking
		// //if data is valid
		// $data['name'] = "Annual leave";
		// $data['slug'] = "A/L"; //cl, sl, a/l max 5 characters
		// $data['isPaidYN'] = "Y";
		// $data['userid'] = "ab";
		// $url="http://todquest.com/PN101/api/leave/createLeaveType";
		// $ch = curl_init($url);
		

		// curl_setopt($ch, CURLOPT_URL,$url);
		// curl_setopt($ch, CURLOPT_POST, 1);
		// curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
		// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		// 	'x-device-id: 123',
		// 	'x-token: 5488S5DD8D2C8V58SF5SD5SDDS'
		// ));

		// // Receive server response ...
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// $server_output = curl_exec($ch);
		// $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		// echo $server_output;
		// curl_close ($ch);
	// }

	// public function dummyGet(){
	// 	$url="http://todquest.com/PN101/api/leave/GetAllLeaveTypes/".$userid;
	// 	$ch = curl_init($url);
		

	// 	curl_setopt($ch, CURLOPT_URL,$url);
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	// 		'x-device-id: 123',
	// 		'x-token: 5488S5DD8D2C8V58SF5SD5SDDS'
	// 	));
		
	// 	$server_output = curl_exec($ch);
	// 	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	// 	echo $server_output;
	// 	curl_close ($ch);
	// }


}
