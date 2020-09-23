<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require("system\libraries\Email.php");
class Emails  {
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

         $to = $user_email;
         $subject = "This is subject";
         
         $header = "From:demo@todquest.com \r\n";
         // $header .= "Cc:afgh@somedomain.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         $mess = $this->requireToVar($arr,$template);
	        // mail ($to,$subject,$mess,$header);
         $this->from("dheerajreddynannuri170(@gmail.com");
			}
	function requireToVar($arr,$file){
	  ob_start();
	  require("application/views/".$file.".php");
	  return ob_get_clean();
	}
}

