<?php

class Mom extends CI_CONTROLLER{

    public function index(){
      if($this->session->has_userdata('LoginId')){
			$data['users'] = $this->getUsers();
      $data['meetings'] = $this->getMeetings();
        $this->load->view('mom1_dup',$data);
                }
    else{
      $this->load->view('redirectToLogin');
    }
    }
   public function attendence($mId){
    if($this->session->has_userdata('LoginId')){
    $data['partcipants'] = $this->getParticipant($mId); 
    $data['mId'] = $mId;
       $this->load->view('attendence',$data);
              }
    else{
      $this->load->view('redirectToLogin');
    }
   }
    public function getMeetings(){
        $url =  BASE_API_URL."mom/getMeetings/".$this->session->userdata('LoginId');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array(
            'x-device-id: '.$this->session->userdata('x-device-id'),
            'x-token: '.$this->session->userdata('AuthToken')
        ));
        $server_output = curl_exec($ch);
        $httpcode = curl_getinfo($ch , CURLINFO_HTTP_CODE);
        if($httpcode == 200){
            return $server_output;
            curl_close($ch);
        }
        else if($httpcode == 401){
                }
    }

    public function startMeeting($mId){
      if($this->session->has_userdata('LoginId')){
        $data['partcipants'] = $this->getParticipant($mId); 
        $data['mId'] = $mId;
        $this->load->view('startmeeting',$data);
                }
    else{
      $this->load->view('redirectToLogin');
    }
    }

    public function getParticipant($id){
        $url = BASE_API_URL."mom/getParticipant/".$id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($ch,CURLOPT_HTTPHEADER,array(
            'x-device-id: '.$this->session->userdata('x-device-id'),
            'x-token: '.$this->session->userdata('AuthToken')
        ));
        
        $server_output = curl_exec($ch);
        // echo "<pre>"; 
       // var_dump($server_output);
        // exit;
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //var_dump($httpcode);
        
        
        if($httpcode == 200){
            return $server_output;
            curl_close($ch);
        }
        else if($httpcode == 401){

        }
    }

    public function createMeeting(){
      if($this->session->has_userdata('LoginId')){
        $this->load->view('createMeeting');
                }
    else{
      $this->load->view('redirectToLogin');
    }
    }


    public function onBoard($mId){
      if($this->session->has_userdata('LoginId')){
        $data['mId'] = $mId;
        $data['present'] = $this->getPresent($mId);
        $this->load->view('meetingstarted_dup',$data);
                }
    else{
      $this->load->view('redirectToLogin');
    }
    }

    public function onBoardDup(){
      if($this->session->has_userdata('LoginId')){
        $this->load->view('meetingstarted_dup');
                }
    else{
      $this->load->view('redirectToLogin');
    }
    }

    public function getPresent($id){
        $url = BASE_API_URL."/mom/Present/".$id;
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


    
    public function summary($id){
      if($this->session->has_userdata('LoginId')){
        $data1['mId'] = $id;
        $data1['summary'] = $this->getSummary($id);
        $this->load->view('summary_dup',$data1);
                }
    else{
      $this->load->view('redirectToLogin');
    }
    }

    public function getSummary($id){
        $url =  BASE_API_URL."mom/getSummary/".$id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array(
            'x-device-id: '.$this->session->userdata('x-device-id'),
            'x-token: '.$this->session->userdata('AuthToken')
        ));
        $server_output = curl_exec($ch);
        $httpcode = curl_getinfo($ch , CURLINFO_HTTP_CODE);
        if($httpcode == 200){
            return $server_output;
            curl_close($ch);
        }
        else if($httpcode == 401){
                }
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
           $data['collab']        =      $form_data['meetingcollab'];
           $data['invites']       =      $form_data['invites'];
        //    echo "<pre>";
        //    var_dump($data);
        //    exit;
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

   public function meetingAttendence($mId){
    //       echo "<pre>";
    //    print_r($this->input->post());
    //    exit;
       $form_data = $this->input->post(); 
  //$form_data['mId'] = '5e6f74a8f1';
       
    
       if($form_data != null){
           $data['mId'] = $mId;
           $data['absent'] = $form_data['absent'];
    //    echo json_encode($data);
    //    exit;
    //var_dump(json_encode($data));

           $url = "http://localhost/PN101/api/mom/meetingAttendence";
           $ch = curl_init($url);
           curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_POST, 1);
           curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
           curl_setopt($ch, CURLOPT_HTTPHEADER,array(
            'x-device-id: '.$this->session->userdata('x-device-id'),
            'x-token: '.$this->session->userdata('AuthToken')
               //'x-device-id :'.$this->session->userdata('x-device-id'),
               //'x-token: '.$this->session->userdata('AuthToken')
           ));
           curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
           $server_output = curl_exec($ch);
          // var_dump($server_output);
        //    json_decode($server_output);
        //    exit;
        $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        // echo $httpcode ;
        // exit;
           
          if($httpcode == 200){
             $jsonOutput = json_decode($server_output);
             curl_close($ch);
             redirect(base_url().'mom/onBoard/'.$mId);
           }
           else{
               redirect(base_url().'mom/startMeeting');
           }
        }



   }
   public function meetingRecord($id){
       $form_data = $this->input->post();
       
    //    echo json_encode($form_data);
    //    exit;
       if($form_data != null){
           
           $data['invites']  = $form_data['invites'];
           $data['sentence'] = $form_data['sentence'];
           $data['remark']   = $form_data['remark'];
            
           $url = "http://localhost/PN101/api/mom/meetingRecord/".$id;
           $ch = curl_init($url);
           curl_setopt($ch, CURLOPT_URL,$url);
           curl_setopt($ch, CURLOPT_POST,1);
           curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
           curl_setopt($ch, CURLOPT_HTTPHEADER,array(
            'x-device-id: '.$this->session->userdata('x-device-id'),
            'x-token: '.$this->session->userdata('AuthToken')
            
           ));
           curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
          $server_output = curl_exec($ch);
        //   var_dump($server_output);
        //   exit;
           $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        //    echo $httpcode;
        //    exit;
           if($httpcode == 200){
               $jsonOutput = json_decode($server_output);
               curl_close($ch);
               redirect(base_url().'mom/summary/'.$id);
           }
       }
   }

   public function addSummary(){
       $form_data = $this->input->post();
    
       if($form_data != null){
         $data['summary'] = $form_data['summary'];
         $data['id'] = $form_data['id'];
        //    echo json_encode($data);
        //    exit;
           $url = "http://localhost/PN101/api/mom/addSummary";
           $ch = curl_init($url);
           curl_setopt($ch, CURLOPT_URL,$url);
           curl_setopt($ch, CURLOPT_POST,1);
           curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
           curl_setopt($ch, CURLOPT_HTTPHEADER,array(
             'x-device-id:'.$this->session->userdata('x-device-id'),
              'x-token:'.$this->session->userdata('AuthToken')
           ));
           curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
           $server_output = curl_exec($ch);
         //var_dump($server_output);
             
           $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
           
           if($httpcode == 200){
               $jsonOutput = json_decode($server_output);
               curl_close($ch);
               redirect(base_url().'mom');
           }
       }
   }
   public function meetingInfo($mId){
    if($this->session->has_userdata('LoginId')){
       $data['info'] = $this->getInfo($mId); 
       $this->load->view('meetingInfo',$data);
              }
    else{
      $this->load->view('redirectToLogin');
    }
   }
  public function getInfo($id){
    $url =  BASE_API_URL."mom/getMeetingInfo/".$id;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,array(
        'x-device-id: '.$this->session->userdata('x-device-id'),
        'x-token: '.$this->session->userdata('AuthToken')
    ));
    $server_output = curl_exec($ch);
    $httpcode = curl_getinfo($ch , CURLINFO_HTTP_CODE);
    if($httpcode == 200){
        return $server_output;
        curl_close($ch);
    }
    else if($httpcode == 401)
    {
            }
    }
  }
?>                   
