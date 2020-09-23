<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	function sendEmail($user_email,$from_email,$subject,$template,$arr){
		$config = Array(    
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.zoho.com',
			'smtp_port' => 465,
			'smtp_user' => 'demo@todquest.com',
			'smtp_pass' => 'K!ddz1ng',
			'mailtype'  => 'html',
			'charset'   => 'utf-8'
			);
			$this->load->library('email',$config); // Load email template
			$this->email->set_newline("\r\n");
			$user_email = "dheerajreddynannuri1709@gmail.com";//$user_email;
			$this->email->from('demo@todquest.com','Todquest');

					$this->email->to($user_email); 

			$this->email->subject($subject); 
			$mess = $this->load->view($template,$arr,true);
			$this->email->message($mess); 
			echo $this->email->print_debugger();
			$this->email->send();
	}




