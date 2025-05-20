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
		redirect(base_url().'welcome/landing');
	}

	public function landing(){
		if($this->session->userdata('LoginId') == null)
			$this->load->view('landing');
		else
			redirect(base_url().'welcome/login');
	}

	public function login(){
		try{
			$this->load->helper('form');
			unset($_SESSION['centerr']);
			$form_data = $this->input->post();
			$data['errorText'] = "";
			$data['email'] = "";
			$data['title'] = 'Login';
			if($form_data != null){
				$data['email'] = $form_data['email'];
				$data['password'] = md5($form_data['password']);
				$data['deviceid'] = $this->getIpAddress();
				$data['devicetype'] = 'WEB';
				$url = BASE_API_URL.'auth/login';
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

				$server_output = curl_exec($ch);
				// var_dump($server_output);die;
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
							'x-device-id' => $data['deviceid'],
							'companyImage' => $jsonOutput->companyImage
						));
						footprint(currentUrl(),' ',$this->session->userdata('LoginId'),'LogIn');
						$this->session->set_userdata('current_url', currentUrl());
						redirect('dashboard');
					}
					else{
						$data['errorText'] = $jsonOutput->Message;
					}
					curl_close ($ch);

				}
				else if($httpcode == 401){
					throw new Exception('Unauthorzied');
				}else{
					throw new Exception('ERROR '.$httpcode);
				}
			}else{
				throw new Exception('Only Form Data Allowed');
			}
		}catch (Exception $e){
			log_message('error',$e->getMessage().__CLASS__.__FUNCTION__.__FILE__);
		}
		$data['quotations'] = $this->getQuotes();
		$this->load->view('login',$data);
	}

	public function forgotPassword()
	{
		// if(){
		 $this->load->view("forgot_password_request");  
		// }else{
		// 		$data['message'] = json_decode($server_output)->message;
		// 		$this->load->view("forgot_password_request",$data);
		// }
	}

	function getQuotes(){
		$url = BASE_API_URL."/Util/getQuotes";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 200){
			return $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

		}
	}

	public function forgotPasswordRequest(){
		try{
			$this->load->helper('form');
			$form_data = $this->input->post();
			if($form_data != null){
				$data['email'] = $this->input->post('email');
				$url = BASE_API_URL.'auth/forgotPassword';
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

				$server_output = curl_exec($ch);
				$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

				if($httpcode == 200){
					$data['message'] = json_decode($server_output)->Message;
					$this->load->view("forgot_password_request",$data);
					curl_close ($ch);
				}
				else if($httpcode == 401){
					throw new Exception('Unauthorized');
					redirect('Welcome/forgotPassword');
				}else{
					throw new Exception('ERROR '.$httpcode);
				}
			}else{
				throw new Exception('Only Form Data Allowed');
				redirect('Welcome/forgotPassword');
			}
		}catch(Exception $e){
			log_message('error',$e->getMessage().__CLASS__.__FUNCTION__.__FILE__);
		}

	}

		public function resetPassword($userid = null,$token = null){
			try{
				if($this->input->post('confirm_password') != null){
						$data['password'] = $this->input->post('confirm_password');
						$password = md5($data['password']);
						$data['userid'] = $userid;
						$this->resetPasswordRequest($userid,$token,$password);
						redirect("/welcome/login");
				}else{
					throw new Exception('Confirm Password Is Empty');
				}

				$data['userid'] = $userid;
				$data['token'] = $token;
				$this->load->view("forgot_password",$data);
			}catch(Exception $e){
				log_message('error',$e->getMessage().__CLASS__.__FUNCTION__.__FILE__);
			}

		}

		function resetPasswordRequest($userid,$token,$password){
			try{
				$this->load->helper('form');
				$form_data = $this->input->post();
				if($form_data != null){
					$data['password'] = $password;
					$data['token'] = $token;
					$data['userid'] = $userid;
					$url = BASE_API_URL.'auth/updatePassword';
					$ch = curl_init($url);
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

					$server_output = curl_exec($ch);
					$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
					// print_r($data);
					if($httpcode == 200){
						return $server_output;
						curl_close ($ch);
					}
					else if($httpcode == 401){
						throw new Exception('Unauthorized');
					}else{
						throw new Exception('ERROR '.$httpcode);
					}
				}else{
						throw new Exception('Only Form Data Allowed');
					}
			}catch(Exception $e){
				log_message('error',$e->getMessage().__CLASS__.__FUNCTION__.__FILE__);
			}

		} 

	public function logout(){
		try{
			if($this->session->userdata('AuthToken') != null){
				$sessionId = $this->session->userdata('AuthToken');
			//footprint start
					footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LogOut');
				 $this->session->unset_userdata('current_url');
			// footprint end
				$this->logoutSession($sessionId);
			}else{
				throw new Exception('Authtoken Missed');
			}
			$this->session->sess_destroy();
			redirect(base_url().'welcome/login');
		}catch(Exception $e){
			log_message('error',$e->getMessage().__CLASS__.__FUNCTION__.__FILE__);
		}
	}

	function logoutSession($id){
		try{
			$url = BASE_API_URL."Auth/logoutSession";
			$data['id'] = $id;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				
			}
			else if($httpcode == 401){
				throw new Exception('Unauthorized');
			}else{
				throw new Exception('ERROR '.$httpcode);
			}
		}catch(Exception $e){
			log_message('error',$e->getMessage().__CLASS__.__FUNCTION__.__FILE__);
		}
	}

	function getIpAddress(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			$ip_address = $_SERVER['HTTP_CLIENT_IP'];
		}
		//whether ip is from proxy
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		//whether ip is from remote address
		else{
			$ip_address = $_SERVER['REMOTE_ADDR'];
		}
		return $ip_address;
	}

	public function sendEmail(){
		try{
			$this->load->helper('form');
			$form_data = $this->input->post();
			if($form_data != null){
				$data['userid'] = $this->session->userdata('LoginId');
				$data['message'] = $form_data['message'];
				$data['empId'] = $form_data['employeeId'];
				$data['category'] = $form_data['num'];
				$url = BASE_API_URL.'util/sendEmails';
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$server_output = curl_exec($ch);
				$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				if($httpcode == 200){
					return $server_output;
					curl_close ($ch);
				}
				else if($httpcode == 401){
					throw new Exception('Unauthorized');
				}else{
					throw new Exception('ERROR '.$httpcode);
				}
			}else{
				throw new Exception('Only Form Data Allowed');
			}
		}catch(Exception $e){
			log_message('error',$e->getMessage().__CLASS__.__FUNCTION__.__FILE__);
		}
	}
}
