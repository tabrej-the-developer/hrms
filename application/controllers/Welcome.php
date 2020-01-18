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
	public function index($currentUserId=null,$isGroupYN=null)
	{
		$this->load->view('login');
	}

	public function login(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
			$email = $form_data['email'];
			$password = $form_data['password'];
			if($email == "ab"){
				$this->session->set_userdata(array(
					'AuthToken'=>'5488S5DD8D2C8V58SF5SD5SDDS',
					'LoginId'=>'ab',
					'UserType'=>'Superadmin',
					'Name'=>'Arpita Saxena',
					'ImgUrl'=>'http://www.oetdlabs.com/images/arpita.jpg',
					'x-device-id'=>'123',
				));
				redirect('messenger');
			}
			else if($email == "abcd"){
				$this->session->set_userdata(array(
					'AuthToken'=>'5488S5DD8D2C8V58SF5SD5SDDM',
					'LoginId'=>'abcd',
					'UserType'=>'Admin',
					'Name'=>'Arpita Saxena',
					'ImgUrl'=>'http://www.oetdlabs.com/images/arpita.jpg',
					'x-device-id'=>'123',
				));
				redirect('messenger');

			}
			else if($email == "staff1"){
				$this->session->set_userdata(array(
					'AuthToken'=>'5488S5DD8D2C8V58SF5SD5SDDT',
					'LoginId'=>'staff1',
					'UserType'=>'Staff',
					'Name'=>'Arpita Saxena',
					'ImgUrl'=>'http://www.oetdlabs.com/images/arpita.jpg',
					'x-device-id'=>'123',
				));
				redirect('messenger');
			}
		}
	}
}
