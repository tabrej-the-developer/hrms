<?php

class Mom extends CI_CONTROLLER{
    public function index(){
			$data['users'] = $this->getUsers();

        $this->load->view('mom1',$data);
    }
    public function startMeeting(){
        $this->load->view('startmeeting');
    }
    public function createMeeting(){
        $this->load->view('createMeeting');
    }
    public function markPresent(){
        $this->load->view('meetingStarted');
    }
    public function summary(){
        $this->load->view('summary');
    }

    function getUsers(){
		$url = BASE_API_URL."/messenger/getUsers/".$this->session->userdata('LoginId');
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


    public function addMeeting(){
       $form_data = $this->input->post();
       
       
       if($form_data != null ){
           $data['title']         =      $form_data['meetingTitle'];
           $data['location']      =      $form_data['meetingLocation'];
           $data['date']          =      $form_data['date'];
           $data['time']          =      $form_data['time'];
           $data['agenda']        =      $form_data['meetingAgenda'];
           $data['collab']        =      $form_data['meetingCollob'];
           $data['invites']       =      $form_data['invites'];
           $url = "http://todquest.com/PN101/api/mom/addMeeting";
           $ch = curl_init($url);

           curl_setopt($ch, CURLOPT_URL,$url);
           curl_setopt($ch,CURLOPT_POST,1);
           curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
           curl_setopt($ch, CURLOPT_HTTPHEADER, array(
               'x-device-id: '.$this->session->userdata('x-device-id'),
               'x-token: '.$this->session->userdata('AuthToken')
           ));
           curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

           $server_output = curl_exec($ch);
           $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
            if($httpcode == 200){
                $jsonOutput = json_decode($server_output);
                curl_close($ch);
                redirect(base_url().'mom/createMeeting');
            }

        }

    }
}


?>