<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller {

	public function Emails($to,$template,$subject,$arr){
		$config = Array(    
			    'protocol'  => 'smtp',
			    'smtp_host' => 'ssl://smtp.zoho.com',
			    'smtp_port' => 465,
			    'smtp_user' => 'demo@todquest.com',
			    'smtp_pass' => 'K!ddz1ng',
			    'mailtype'  => 'html',
			    'charset'   => 'utf-8'
		);
		// $to = 'dheerajreddynannuri1709@gmail.com';
		// $subject = 'roster published';
		// $template = 'rosterPublishEmailTemplate';
		if(!is_array($to)){
			$this->load->library('email',$config); // Load email template
			$this->email->set_newline("\r\n");
			$this->email->from('demo@todquest.com','Todquest');
			$this->email->to($to); 
			$this->email->subject($subject); 
			$mess = $this->load->view($template,$arr,true);
			$this->email->message($mess); 
			$this->email->send();
		}else{
			$this->load->library('email',$config); // Load email template
			$this->email->set_newline("\r\n");
			$this->email->from('demo@todquest.com','Todquest');
			$this->email->to(implode(',',$to)); 
			$this->email->subject($subject); 
			$mess = $this->load->view($template,$arr,true);
			$this->email->message($mess); 
			$this->email->send();
		}
	} 

	public function getNotificationPermissions($userid,$notificationType){
		$this->load->model('utilModel');
		$output = [];
		if(is_array($userid)){
			foreach($userid as $user){
				$userData = (Object)[];
				$permission = $this->utilModel->getNotificationPermissions($user,$notificationType);
				$userData->appYN = isset($permission->appYN) ? $permission->appYN : "N";
				$userData->emailYN = isset($permission->emailYN) ? $permission->emailYN : "N";
				$userData->userid = $user;
				$userData->email = isset($permission->email) ? $permission->email : null;
				if($userData != null)
					array_push($output,$userData);
			}
		}else{
			$userData = (Object)[];
			$permission = $this->utilModel->getNotificationPermissions($userid,$notificationType);
			$userData->appYN = isset($permission->appYN) ? $permission->appYN : "N";
			$userData->emailYN = isset($permission->emailYN) ? $permission->emailYN : "N";
			$userData->email = isset($permission->email) ? $permission->email : null;
			$userData->userid = $userid;
			if($userData != null)
				array_push($output,$userData);
		}
		return $output;
	}
}