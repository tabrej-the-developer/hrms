<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function temp(){
		$config = Array(    
			    'protocol'  => 'smtp',
			    'smtp_host' => 'ssl://smtp.zoho.com',
			    'smtp_port' => 465,
			    'smtp_user' => 'demo@todquest.com',
			    'smtp_pass' => 'K!ddz1ng',
			    'mailtype'  => 'html',
			    'charset'   => 'utf-8'
		);

		$this->load->library('email',$config);
		$this->email->set_newline("\r\n");
		$this->email->from('demo@todquest.com','Todquest');

		$this->load->database();
		$amvUsers = $this->db->query("SELECT *  FROM `users` WHERE `center` LIKE '6|' AND role != 1");
		foreach ($amvUsers as $user) {
			$var['name'] = $user->name;
			$var['empCode'] = $user->id;
			$exp = explode(' ', $var['name']);
			$var['password'] = $exp[0].$exp[1].'@123';


			$user_email = "arpitasaxena555@gmail.com";//$var['email'];
			$subject = " Welcome to HRMS101";
			$this->email->to($user_email); 
			$this->email->subject($subject); 
			$message = $this->load->view('onboardingMailView',$var,true);
			$this->email->message($message); 
			//$this->email->send();
		}
	}
}
