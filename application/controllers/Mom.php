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


    public function onBoard(){
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
    //    echo "<pre>";
    //    var_dump($this->input->post());
    //    echo "<pre>";
    //    print_r($this->session->userdata('LoginId'));
    //    exit;
     
       
       if($form_data != null ){
           $data['userId']        =      $this->session->userdata('LoginId');
           $data['title']         =      $form_data['meetingTitle'];
           $data['location']      =      $form_data['meetingLocation'];
           $data['date']          =      $form_data['meetingDate'];
           $data['time']          =      $form_data['meetingTime'];
           $data['agenda']        =      $form_data['meetingAgenda'];
           $data['collab']        =      $form_data['meetingcollob'];
           $data['invites']       =      $form_data['invites'];
           $url = "http://localhost/PN101/api/mom/addMeeting";
           $ch = curl_init($url);
        //   echo json_encode($data);
        //   exit;
           curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_POST, 1);
           curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
           curl_setopt($ch, CURLOPT_HTTPHEADER, array(
               'x-device-id: '.$this->session->userdata('x-device-id'),
               'x-token: '.$this->session->userdata('AuthToken')
           ));
           
         curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
          
           $server_output = curl_exec($ch);
          $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        //   echo json_encode($httpcode);
        //   exit;

            if($httpcode == 200){
                $jsonOutput = json_decode($server_output);
                curl_close($ch);
               
                redirect(base_url().'mom');
            }
            else if($httpcode == 401){
                     json_encode(['error'=>'Error']);
                              }

        }

    }

   public function meetingAttendence(){
    //       echo "<pre>";
    //    print_r($this->input->post());
    //    exit;
       $form_data = $this->input->post(); 
       $form_data['mId'] = '5e6f74a8f1';
       
    
       if($form_data != null){
           $data['mId'] = '5e6f7b2d5b';
           $data['absent'] = $form_data['absent'];
   echo json_encode($data);
       exit;

           $url = "http://localhost/PN101/api/mom/meetingAttendence";
           $ch = curl_init($url);
           curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_POST, 1);
           curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
           curl_setopt($ch, CURLOPT_HTTPHEADER,array(
               'x-device-id :'.$this->session->userdata('x-device-id'),
               'x-token: '.$this->session->userdata('AuthToken')
           ));
           curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
           $server_output = curl_exec($ch);
        //    json_decode($server_output);
        //    exit;
        $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        
           
          if($httpcode == 200){
             $jsonOutput = json_decode($server_output);
             curl_close($ch);
             redirect(base_url().'mom/onBoard');
           }
           else{
               redirect(base_url().'mom/startMeeting');
           }
        }



   }
   public function meetingRecord(){
       $form_data = $this->input->post();
       if($form_data != null){
           $data['invites']  = $form_data['invites'];
           $data['sentence'] = $form_data['sentence'];
           $url = "http://todquest.com/PN101/api/mom/meetingRecord";
           $ch = curl_inti($url);
           curl_setopt($ch, CURLOPT_URL,$url);
           curl_setopt($ch, CURLOPT_POST,1);
           curl_setopt($ch, CURL_POSTFIELDS,json_encode($data));
           curl_setopt($ch, CURLOPT_HTTPHEADER,array(
               'x-device-id :'.$this->session->userdata('x-device-id'),
               'x-token :'.$this->session->userdata('AuthToken')
           ));
           curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
           $server_output = curl_exec($ch);
           $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
           if($httpcode == 200){
               $jsonOutput = json_decode($server_output);
               curl_close($ch);
               redirect(base_url().'mom/summary');
           }
       }
   }

   public function addSummary(){
       $form_data = $this->input->post();
       
       if($form_data != null){
         
        $data['summary'] = $form_data['summary'];
        
        // echo json_encode($data);
        // exit;
           $url = "http://localhost/PN101/api/mom/addSummary";
           $ch = curl_init($url);
           curl_setopt($ch, CURLOPT_URL,$url);
           curl_setopt($ch, CURLOPT_POST,1);
           curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
           curl_setopt($ch,CURLOPT_HTTPHEADER,array(
               'x-device-id :'.$this->session->userdata('x-device-id'),
               'x-token :'.$this->session->userdata('AuthToken')
           ));
           curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
           $server_output = curl_exec($ch);
           $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
           if($httpcode == 200){
               $jsonOutput = json_decode($server_output);
               curl_close($ch);
               redirect(base_url().'mom');
           }
       }
   }

}


?>