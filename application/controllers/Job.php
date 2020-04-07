<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {
 
   public function index(){
       $this->load->view('job_add');
   }

   public function addJob(){
       $form_data = $this->input->post();
    //    echo "<pre>";
    //    var_dump($data);
    //    exit;
    if($form_data != null){
         
         $data['userid'] = $this->session->userdata('LoginId');
         $data['title']         =    $form_data['jobTitle'];
         $data['department']    =    $form_data['jobDepartment'];
         $data['jobcode']       =    $form_data['jobCode'];
         $data['type']          =    $form_data['jobType'];
         $data['experience']    =    $form_data['jobExperience'];
         $data['description']   =    $form_data['jobDescription'];
         $data['minsalary']     =    $form_data['jobMinSalary'];
         $data['maxsalary']     =    $form_data['jobMaxSalary'];
         $data['currency']      =    $form_data['countryCurrency'];
         $data['flatform']      =    $form_data['flatform'];
         $data['expirydate']    =    $form_data['expiryDate'];
         $data['requirement']   =    $form_data['requirements'];

 
        $url = "http://localhost/PN101/api/jobadder/CreateJob";
        $ch =  curl_init($url);
       curl_setopt($ch, CURLOPT_URL,$url);
       curl_setopt($ch, CURLOPT_POST,1);
       curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
       curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
           'x-device-id: '.$this->session->userdata('x-device-id'),
           'x-token: '.$this->session->userdata('AuthToken')
       ));
       curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      $server_output = curl_exec($ch);
      $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
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

}

?>