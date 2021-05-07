<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {
 
   public function index(){
       $data['jobs'] =  $this->getJobs();
       $this->load->view('job_add',$data);
   }

   public function getJobs(){
    $url = BASE_API_URL."job/getjobs";
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
        $data['error'] = 'failed';
        $data['response'] = 401;
        return json_encode($data);
         
    }
    else{
        $data['httpcode'] = $httpcode;
        $data['output'] = $server_output;
        $data['error'] = 'Totally failed';
        return json_encode($data);
    }
}

   public function addJob(){
       $form_data = $this->input->post();
    //    echo "<pre>";
    //    var_dump($data);
     
    if($form_data != null){
         
         $data['userid']        =    $this->session->userdata('LoginId');
         $data['title']         =    $form_data['jobTitle'];
         $data['department']    =    $form_data['jobDepartment'];
         $data['jobcode']       =    $form_data['jobCode'];
         $data['type']          =    $form_data['jobType'];
         $data['experience']    =    $form_data['jobExperience'];
         $data['description']   =    $form_data['jobDescription'];
         $data['minsalary']     =    $form_data['jobMinSalary'];
         $data['maxsalary']     =    $form_data['jobMaxSalary'];
         $data['currency']      =    $form_data['countryCurrency'];
         $data['flatform']      =    $form_data['portals'];
         $data['expirydate']    =    $form_data['expiryDate'];
         $data['requirement']   =    $form_data['requirements'];
        //  echo json_encode($data);
        //  exit;  
 
        $url = "http://localhost/PN101/api/job/createJob";
        $ch =  curl_init($url);
       curl_setopt($ch, CURLOPT_URL,$url);
       curl_setopt($ch, CURLOPT_POST,1);
       curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
       curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
           'x-device-id:127.0.0.1',
           'x-token:ab'
       ));
       curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      $server_output = curl_exec($ch);
      $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
       //$this->session->userdata('x-device-id');
    //  echo $httpcode;
    //  exit;
      if($httpcode = 200){
          $jsonOutput = json_decode($server_output);
          curl_close($ch);
          redirect(base_url().'job');
      }
      else if($httpcode == 401){
          json_encode(['error'=>'Error']);
      }
    }

   }

   public function updateJob($id){
       $form_data = $this->input->post();
       echo json_encode($form_data);
       exit;
   }

}

?>