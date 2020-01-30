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
		redirect(base_url().'welcome/login');
	}

	public function login(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		$data['errorText'] = "";
		$data['email'] = "";
		if($form_data != null){
			$data['email'] = $form_data['email'];
			$data['password'] = md5($form_data['password']);
			$data['deviceid'] = $this->getIpAddress();
			$url = BASE_API_URL.'auth/login';
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				if($jsonOutput->Status == "SUCCESS"){
					$this->session->set_userdata(array(
						'AuthToken' => $jsonOutput->AuthToken,
						'LoginId' => $jsonOutput->userid,
						'UserType' => $jsonOutput->role,
						'Name' => $jsonOutput->name,
						'ImgUrl' => $jsonOutput->imageUrl,
						'x-device-id' => $data['deviceid']
					));
					redirect('messenger');
				}
				else{
					$data['errorText'] = $jsonOutput->Message;
				}
				curl_close ($ch);

			}
			else if($httpcode == 401){

			}
		}
		$this->load->view('login',$data);
	}

	public function forgotPassword()
	{
		$this->load->view("forgot_password_request");  
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'welcome/login');
	}

	function getIpAddress(){
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   
		{
			$ip_address = $_SERVER['HTTP_CLIENT_IP'];
		}
		//whether ip is from proxy
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
		{
			$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		//whether ip is from remote address
		else
		{
			$ip_address = $_SERVER['REMOTE_ADDR'];
		}
		return $ip_address;
	}
}
