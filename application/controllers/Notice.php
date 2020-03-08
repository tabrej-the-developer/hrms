<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends CI_Controller {

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
		redirect(base_url().'notice/notices/Inbox');
	}

	public function notices($noticeStatus = 'Inbox',$currentNoticeId=null)
	{
		$data['allNotices'] = array();
		$allNotices = json_decode($this->getAllNotices());
		if($noticeStatus == 'Inbox'){
			foreach ($allNotices->notices as $notice) {
				if($notice->status != "2" && $notice->senderId != $this->session->userdata('LoginId')){
					array_push($data['allNotices'],$notice);
				}
			}
		}
		else if($noticeStatus == 'Sent'){
			foreach ($allNotices->notices as $notice) {
				if($notice->senderId == $this->session->userdata('LoginId')){
					array_push($data['allNotices'], $notice);
				}
			}
		}
		else if($noticeStatus == 'Archived'){
			foreach ($allNotices->notices as $notice) {
				if($notice->status == "2"){
					array_push($data['allNotices'], $notice);
				}
			}
		}

		if($currentNoticeId == null && count($data['allNotices']) != 0){
			$data['currentNotice'] = $data['allNotices'][0];
		}
		else{
			foreach ($data['allNotices']as $notice) {
				if($notice->noticeId == $currentNoticeId){
					$data['currentNotice'] = $notice;
					break;
				}
			}
		}
		$data['noticeStatus'] = $noticeStatus;
		//var_dump($data);
		$this->load->view('noticeView',$data);
	}

	public function createNotice(){
		$data['users'] = $this->getUsers();
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
			$sendData['members'] = array();
			$allUsers = json_decode($data['users']);
			foreach ($allUsers->users as $user) {
				if(isset($form_data[$user->userid])){
					array_push($sendData['members'],$user->userid);
				}
			}
			$sendData['text'] = $this->dataReady($form_data['message']);
			$sendData['subject'] = $form_data['subject'];
			$sendData['userid'] = $this->session->userdata('LoginId');
			$url="http://todquest.com/PN101/api/notice/addNotice";
			$ch = curl_init($url);

			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($sendData));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				curl_close ($ch);
				redirect(base_url().'notice/notices/Sent');
			}
			else if($httpcode == 401){

			}
		}
		$this->load->view('createNoticeView',$data);
	}

	public function dataReady($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = html_escape($data);
		return $data;
	}


	public function updateStatus(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
			$data['noticeId'] = $form_data['currentNoticeId'];
			$data['status'] = "2";
			$data['userid'] = $this->session->userdata('LoginId');
			$url="http://todquest.com/PN101/api/notice/updateStatus";
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
				curl_close ($ch);
				redirect(base_url().'notice/notices/Archived');
			}
			else if($httpcode == 401){

			}
		}
	}

	function getAllNotices(){
		$url = BASE_API_URL."notice/getAllNotices/".$this->session->userdata('LoginId');
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
}
