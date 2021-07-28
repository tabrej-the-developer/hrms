<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller {

    public function index(){
        $data['notifications'] = $this->getNotifications();
        $this->load->view('notificationsView',$data);
    }

    public function getNotifications()
    {
        $data['userid'] = $this->session->userdata('LoginId');
		$url = BASE_API_URL."Settings/getAllNotifications";
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
				// print_r($server_output);
				curl_close ($ch);
                return $server_output;
			}
			else if($httpcode == 401){

			}
    }
}