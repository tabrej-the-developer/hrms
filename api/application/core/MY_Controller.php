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
		$this->load->library('email',$config); // Load email template
		$this->email->set_newline("\r\n");
		$this->email->from('demo@todquest.com','Todquest');
		$this->email->to($to); 
		$this->email->subject($subject); 
		$mess = $this->load->view($template,$arr,true);
		$this->email->message($mess); 
		$this->email->send();
	} 
}