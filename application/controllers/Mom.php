<?php

class Mom extends CI_CONTROLLER{

    public function index(){
      if($this->session->has_userdata('LoginId')){
  //footprint start
  if($this->session->has_userdata('current_url')){
    footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
    $this->session->set_userdata('current_url',currentUrl());
  }
  // footprint end
        if($this->getUsers() != 'error'){
              $data['users'] = $this->getUsers();
              $data['meetings'] = $this->getMeetings();
        $this->load->view('mom1_dup',$data);
      }
          else{
            $data['error'] = 'error';
            $this->load->view('mom1_dup',$data);
          }
        }
    else{
      $this->load->view('redirectToLogin');
    }
  }

   public function attendence($mId){
    if($this->session->has_userdata('LoginId')){
  //footprint start
  if($this->session->has_userdata('current_url')){
    footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
    $this->session->set_userdata('current_url',currentUrl());
  }
  // footprint end
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
    //footprint start
  if($this->session->has_userdata('current_url')){
    footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
    $this->session->set_userdata('current_url',currentUrl());
  }
  // footprint end
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
  //footprint start
  if($this->session->has_userdata('current_url')){
    footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
    $this->session->set_userdata('current_url',currentUrl());
  }
  // footprint end
        $this->load->view('createMeeting');
                }
    else{
      $this->load->view('redirectToLogin');
    }
    }


    public function onBoard($mId){
      if($this->session->has_userdata('LoginId')){
  //footprint start
  if($this->session->has_userdata('current_url')){
    footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
    $this->session->set_userdata('current_url',currentUrl());
  }
  // footprint end
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
  //footprint start
  if($this->session->has_userdata('current_url')){
    footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
    $this->session->set_userdata('current_url',currentUrl());
  }
  // footprint end
        $this->load->view('meetingstarted_dup');
                }
    else{
      $this->load->view('redirectToLogin');
    }
    }

    public function getPresent($id){

  //footprint start
  if($this->session->has_userdata('current_url')){
    footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
    $this->session->set_userdata('current_url',currentUrl());
  }
  // footprint end
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
  //footprint start
  if($this->session->has_userdata('current_url')){
    footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
    $this->session->set_userdata('current_url',currentUrl());
  }
  // footprint end
        $data1['mId'] = $id;
        $data1['summary'] = $this->getSummary($id);
        $this->load->view('summary_dup',$data1);
                }
      else{
        $this->load->view('redirectToLogin');
      }
    }

    public function getSummary($id){
  //footprint start
  if($this->session->has_userdata('current_url')){
    footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
    $this->session->set_userdata('current_url',currentUrl());
  }
  // footprint end
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
      return 'error';
		}
	}


    public function addMeeting(){
       $form_data = $this->input->post();
       if($form_data != null ){
  //footprint start
  if($this->session->has_userdata('current_url')){
    footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
    $this->session->set_userdata('current_url',currentUrl());
  }
  // footprint end
           $data['userid']        =      $this->session->userdata('LoginId');
           $data['title']         =      $form_data['meetingTitle'];
           $data['location']      =      $form_data['meetingLocation'];
           $data['date']          =      $form_data['meetingDate'];
           $data['time']          =      $form_data['meetingTime'];
           $data['etime']         =      $form_data['meetingEndTime'];
           $data['agenda']        =      $form_data['meetingAgenda'];
           $data['period']        =      $form_data['meetingcollab'];
           $data['invites']       =      $form_data['invites'];
           $data['status']        =      'CREATED';//$form_data['status'];
           $data['agendaFile']    =       $form_data['agendaFile'];
           var_dump($data);
           $url = BASE_API_URL."mom/AddMeeting";
           $ch = curl_init($url);
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
           // json_encode($data);
           // print_r($server_output);
                           var_dump($server_output);
           print_r($httpcode);
            if($httpcode == 200){
                $jsonOutput = json_decode($server_output);

                curl_close($ch);       
                redirect(base_url().'dashboard');
            }
            else if($httpcode == 401){
                  json_encode(['error'=>'Error']);
                }
              }
            }

   public function meetingAttendence($mId){
       $form_data = $this->input->post(); 

          if($form_data != null){
            $data['absent'] = $form_data['absent'];
          }
          else{
             $data['absent'] = null;
              }
           $data['mId'] = $mId;
  //footprint start
  if($this->session->has_userdata('current_url')){
    footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
    $this->session->set_userdata('current_url',currentUrl());
  }
  // footprint end
       $url = BASE_API_URL."mom/meetingAttendence";
       $ch = curl_init($url);
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_POST, 1);
       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
       curl_setopt($ch, CURLOPT_HTTPHEADER,array(
        'x-device-id: '.$this->session->userdata('x-device-id'),
        'x-token: '.$this->session->userdata('AuthToken')
       ));
       curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
       $server_output = curl_exec($ch);
      $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        if($httpcode == 200){
           $jsonOutput = json_decode($server_output);
           curl_close($ch);
           redirect(base_url().'mom/onBoard/'.$mId);
         }
         else{
             redirect(base_url().'mom/startMeeting');
         }
   }


   public function meetingRecord($id){
       $form_data = $this->input->post();

       if($form_data != null){ 
  //footprint start
  if($this->session->has_userdata('current_url')){
    footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
    $this->session->set_userdata('current_url',currentUrl());
  }
  // footprint end   
           $data['invites']  = $form_data['invites'];
           $data['sentence'] = $form_data['sentence'];
           $data['remark']   = $form_data['remark'];
            
           $url = BASE_API_URL."mom/meetingRecord/".$id;
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

   public function addSummary($meetingId){
       $form_data = $this->input->post();
    
       // if($form_data != null){
  //footprint start
  if($this->session->has_userdata('current_url')){
    footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
    $this->session->set_userdata('current_url',currentUrl());
  }
  // footprint end
         $data['summary'] = $form_data['summary'];
         $data['id'] = $form_data['id'];
        //    echo json_encode($data);
        //    exit;
           $url = BASE_API_URL."mom/addSummary/".$meetingId;
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
       // }
   }


   public function meetingInfo($mId){
    if($this->session->has_userdata('LoginId')){
      $data['info'] = $this->getInfo($mId);
      // print_r($data);
  //footprint start
  if($this->session->has_userdata('current_url')){
    footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
    $this->session->set_userdata('current_url',currentUrl());
  }
  // footprint end
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