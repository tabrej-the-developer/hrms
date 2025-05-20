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
		redirect(base_url().'messenger/chat');
	}
	// new messenger chat function 
	public function chat($idConversation=null){
		if($this->getRecentConversations() != null && $this->getRecentConversations() != "" ){
			$data['recentConversations'] = json_decode($this->getRecentConversations())->conversation;
			$data['allUsers'] = $this->getUsers();
			$userid = $this->session->userdata('LoginId');
			if(isset($idConversation) && $idConversation != null){
				$data['getChat'] = $this->getChat($idConversation);
				$data['getConversation'] = $this->getConversation($idConversation);
			}
			// print_r($data['recentConversations']);die();
			$this->load->view('mView_temp',$data);
		}
	}

	function getRecentConversations(){
		$userid = $this->session->userdata('LoginId');
		$url = BASE_API_URL.'chat/getRecentConversations/'.$userid;
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

	function getConversation($idConversation){
		$userid = $this->session->userdata('LoginId');
		$url = BASE_API_URL.'chat/getConversation/'.$userid.'?idConversation='.$idConversation;
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

		public	function getConv($idUserOther){
			$userid = $this->session->userdata('LoginId');
			$url = BASE_API_URL.'chat/getConversation/'.$userid.'?idUserOther='.$idUserOther;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
			$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			// print_r($server_output);
			if($httpcode == 200){
				print_r($server_output);
				// return $server_output;
				curl_close ($ch);
			}
			else if($httpcode == 401){

			}
		}

	function getChat($idConversation){
		$userid = $this->session->userdata('LoginId');
		$url = BASE_API_URL.'chat/getChat/'.$userid.'?idConversation='.$idConversation;
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

	// old messenger chats function
	public function chats($currentUserId=null,$isGroupYN=null){
		if($currentUserId != null && $isGroupYN == null) return;
		// if($this->session->has_userdata('LoginId')){
			if($this->getRecentChats() != 'error'){
					$data['recentChats'] = $this->getRecentChats();
				}
				else{
					$data['error'] = 'error';
				}
			if($currentUserId == null){
				if(isset($data['recentChats']) && isset(json_decode($data['recentChats'])->chats)){
					if(count(json_decode($data['recentChats'])->chats) > 0){
						$currentUserId = (json_decode($data['recentChats'])->chats)[0];
					}
				}
				if(isset( $currentUserId->isGroupYN )){
					$isGroupYN = $currentUserId->isGroupYN;
				}
				if(isset($currentUserId->id)){
					$currentUserId = $currentUserId->id;
				}
			}
			if($isGroupYN == "N"){
				$data['currentChat'] = $this->getUserChat($currentUserId);
				$data['currentUserInfo'] = $this->getUserInfo($currentUserId);
			}
			else{
				$data['currentChat'] = $this->getGroupChat($currentUserId);
				$data['currentUserInfo'] = $this->getGroupInfo($currentUserId);
			}
			$data['currentUserId'] = $currentUserId;
			$data['isGroupYN'] = $isGroupYN;
			$data['allUsers'] = $this->getUsers();
			$data['groups'] = $this->getGroups();
			//footprint start
			if($this->session->has_userdata('current_url')){
				footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),"LoggedIn");
				$this->session->set_userdata('current_url',currentUrl());
			}
			// footprint end
			$this->load->view('mView_temp',$data);
		// }
		// else{
		// 	$this->load->view('redirectToLogin');
		// }
	}

	public function updateMember(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
			$data['userid'] = $this->session->userdata('LoginId');
			$data['lastSeen'] = date('Y-m-d H:i:s');
			$data['isDeletedYN'] = $form_data['isDeletedYN'];
			$data['isAdminYN'] = $form_data['isAdminYN'];
			$data['idMember'] = $form_data['idMember'];
			$data['idConversation'] = $form_data['idConversation'];
			$data['idOtherUser'] = isset($form_data['idOtherUser']) ? $form_data['idOtherUser'] : null;
			$url=BASE_API_URL."Chat/updateMember";
			$ch = curl_init($url);
			var_dump($data);
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
			var_dump($server_output);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				curl_close ($ch);
				// redirect(base_url().'messenger/chats/'.$data['receiverId'].'/'.$data['isGroupYN']);
			}
			else if($httpcode == 401){
			}
		}
	}

	public function postConversation(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
			$data['userid'] = $this->session->userdata('LoginId');
			$data['idUsers'] = isset($form_data['allUserids']) ? $form_data['allUserids'] : [];
			$data['convoName'] = isset($form_data['convoName']) ? $form_data['convoName'] : null;
			if(isset($_FILES['convoProfilePic']['tmp_name'])){
				$data['convoProfilePic'] = isset($_FILES['convoProfilePic']['tmp_name']) ? base64_encode(file_get_contents($_FILES['convoProfilePic']['tmp_name'])) : null;
			}else{
							$data['convoProfilePic'] = null;
			}
			$data['idConversation'] = $form_data['idConversation'];
			$data['isGroupYN'] = $form_data['isGroupYN'];
			$url=BASE_API_URL."Chat/postConversation";
			$ch = curl_init($url);
			// var_dump($data);
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
			// var_dump($server_output);
			if($httpcode == 200){
				print_r($server_output);
				$jsonOutput = json_decode($server_output);
				curl_close ($ch);
				// redirect(base_url().'messenger/chats/'.$data['receiverId'].'/'.$data['isGroupYN']);
			}
			else if($httpcode == 401){
			}
		}
	}

	public function postNewMessage(){
		$this->load->helper('form');
		$this->load->library('Crypt_RSA');

		$rsa = new Crypt_RSA();
		// extract($rsa->createKey());


		$form_data = $this->input->post();
		if($form_data != null){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
			$data['receiverId'] = $form_data['receiverId'];
			$data['isGroupYN'] = $form_data['isGroupYN'];
			$data['chatText'] = $form_data['chatText'];
			$plaintext = $data['chatText'];
			// $privatekey = $this->config->item('privateKey');
			// $rsa->loadKey($privatekey);
			$data['chatText'] = $plaintext;
			// $data['chatText'] = base64_encode($rsa->encrypt($plaintext));
			$data['mediaContent'] = isset($_FILES['upload_image']['tmp_name']) ? base64_encode(file_get_contents(addslashes($_FILES['upload_image']['tmp_name']))) : null;
			$data['userid'] = $this->session->userdata('LoginId');
			$url=BASE_API_URL."messenger/postChat";
			$ch = curl_init($url);
			var_dump($data);
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
			var_dump($server_output);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				curl_close ($ch);
				// redirect(base_url().'messenger/chats/'.$data['receiverId'].'/'.$data['isGroupYN']);
			}
			else if($httpcode == 401){
			}
		}
	}

	public function postMessage(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
			$data['idMember'] = $form_data['idMember'];
			$data['senderName'] = $form_data['senderName'];
			$data['chatText'] = $form_data['chatText'];
			$plaintext = $data['chatText'];
			$data['media'] = isset($_FILES['media']['tmp_name']) ? base64_encode(file_get_contents(addslashes($_FILES['upload_image']['tmp_name']))) : null;
			$data['userid'] = $this->session->userdata('LoginId');
			$url=BASE_API_URL."Chat/postChat";
			$ch = curl_init($url);
			var_dump($data);
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
			var_dump($server_output);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				curl_close ($ch);
				// redirect(base_url().'messenger/chats/'.$data['receiverId'].'/'.$data['isGroupYN']);
			}
			else if($httpcode == 401){
			}
		}
	}

	public function exitGroup(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
			$data['groupId'] = $form_data['groupId'];
			$data['userid'] = $this->session->userdata('LoginId');
			$url=BASE_API_URL."messenger/leaveGroup";
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
			print_r($httpcode);
			print_r($server_output);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				curl_close ($ch);
				print_r($jsonOutput);
			}
			else if($httpcode == 401){

			}
		}
	}

	public function deleteGroup(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
			$data['groupId'] = $form_data['groupId'];
			$data['userid'] = $this->session->userdata('LoginId');
			$url=BASE_API_URL."messenger/deleteGroup";
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

	public function creategroup(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
			$data['groupName'] = addslashes($form_data['recipient_name']);
			if($data['groupName'] != ""){
				$users = json_decode($this->getUsers());
				$members = array();
				foreach ($form_data['tokenize_class'] as $chatUser) {
					array_push($members,$chatUser);
				}
				if(count($members) > 0){
					$data['members'] = $members;
					$data['admin'] = $this->session->userdata('LoginId');
					$data['avatarUrl'] = "";
					$url=BASE_API_URL."messenger/createGroup";
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
					print_r($httpcode);
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

	public function updateGroup(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		$data = [];
		//footprint start
		if($this->session->has_userdata('current_url')){
			footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
			$this->session->set_userdata('current_url',currentUrl());
		}
		// footprint end
		if(isset($form_data['groupName']) && $form_data['groupName'] != null){
			$data['groupName'] = $form_data['groupName'];
			$data['avatarUrl'] = null;
		}
		if(!isset($form_data['groupName'])){
			var_dump($_FILES);
			$data['groupName'] = null;
			$data['avatarUrl'] = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
		}
			$data['groupId'] = $form_data['groupId'];
			$data['userid'] = $this->session->userdata('LoginId');
			$url=BASE_API_URL."messenger/UpdateGroup";
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
			print_r($httpcode);
			print_r($server_output);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				print_r($jsonOutput);
			}
			else if($httpcode == 401){

			}
	}

	public function removeFromGroup(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		// if($form_data != null){
			//footprint start
			if($this->session->has_userdata('current_url')){
				footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
				$this->session->set_userdata('current_url',currentUrl());
			}
			// footprint end
				$data['receiverId'] = $this->input->post('memberId');
				$data['groupId'] = $this->input->post('groupId');
				$data['isGroupYN'] = 'Y';
				$data['chatText'] = $this->session->userdata('Name').' removed '.$data['receiverId'];
				$data['userid'] = $this->session->userdata('LoginId');
				$data['mediaContent'] = null;
				$url=BASE_API_URL."messenger/removeUserFromGroup";
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
				print_r($httpcode);
				print_r($server_output);
				if($httpcode == 200){
					$jsonOutput = json_decode($server_output);
				}
				else if($httpcode == 401){

				}
			// }
	}


	function getRecentChats(){
		$url = BASE_API_URL."messenger/recentChats/".$this->session->userdata('LoginId');
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
			return 'error';
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
		// $url=BASE_API_URL."leave/createLeaveType";
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
	// 	$url=BASE_API_URL."leave/GetAllLeaveTypes/".$userid;
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
