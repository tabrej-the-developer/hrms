<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct() {

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-DEVICE-ID,X-TOKEN, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$method = $_SERVER['REQUEST_METHOD'];
		if($method == "OPTIONS") {
		die();
		}
		parent::__construct();
	}

	public function login()
	{
		$json = json_decode(file_get_contents('php://input'));
		if($json != null){
			$email = $json->email;
			$password = $json->password;
			$deviceid = $json->deviceid;
			if($email != "" && $email != null && $password != "" && $password != null && $deviceid != "" && $deviceid != null){
				$this->load->model('authModel');
				$user = $this->authModel->getUser($email,$password);
				if($user == null){
					$data['Status'] = "ERROR";
					$data['Message'] = "Invalid email id or password";
				}
				else{
					$authToken = uniqid();
					$this->authModel->insertLogin($user->id,$deviceid,$authToken);
					$data['Status'] = "SUCCESS";
					$data['AuthToken'] = $authToken;
					$data['userid'] = $user->id;
					$data['email'] = $user->email;
					$data['name'] = $user->name;
					$data['imageUrl'] = $user->imageUrl;
					$data['role'] = $user->role;
					$data['title'] = $user->title;
					$data['manager'] = $user->manager;
					$data['firebaseid'] = $user->firebaseid;
					$data['isVerified'] = $user->isVerified;
				}
			}
			else{
				$data['Status'] = "ERROR";
				$data['Message'] = "Invalid parameters";
			}
			http_response_code(200);
			echo json_encode($data);
		}
		else{
			http_response_code(401);
		}
	}

	public function register(){
		$json = json_decode(file_get_contents('php://input'));
		$this->load->model('authModel');
		if($json != null){
			$email = $json->email;
			$getUser = $this->authModel->getUserFromEmail($email);
			$data = [];
			if($getUser == null){
				$name = $json->name;
				$password = $json->password;
				$role = $json->role;
				$title = $json->title;
				$center = $json->center;
				$manager = $json->manager;
				$userid = $json->userid;
				$userDetails = $this->authModel->getUserDetails($userid);
				if($userDetails != null && $userDetails->role == SUPERADMIN){
					if($name != null && $name != "" &&
						$password != null && $password != "" &&
						$role != null && $role != "" && 
						$title != null && $title != "" && 
						$center != null && $center != "" && 
						$manager != null && $manager != ""){

						$firebaseData = array(
							'email'=>$email,
							'verified'=>'N',
							'password'=>$password,
							'name'=>$name
						);

						$firebaseUser = $this->firebase->createUser($firebaseData);
						$userid = $this->authModel->insertUser($email,$password,$name,$role,$title,$center,$manager,$firebaseUser->uid);
						
						//todo send mail
						$token = uniqid();
						$this->authModel->insertToken($userid,$token,'N');
						$mData['activationLink'] = base_url().'auth/verifyUser/'.$userid.'/'.$token;
						$mData['appName'] = APP_NAME;
						$this->load->library('email');
						$config = array(
						    'protocol'  => 'smtp',
						    'smtp_host' => 'ssl://smtp.zoho.com',
						    'smtp_port' => 465,
						    'smtp_user' => SMTP_EMAIL,
						    'smtp_pass' => SMTP_PASSWORD,
						    'mailtype'  => 'html',
						    'charset'   => 'utf-8'
						);
						$this->email->initialize($config);
						$this->email->set_mailtype("html");
						$this->email->set_newline("\r\n");
						$htmlContent = $this->load->view('template/signupEmail',$mData,true);
						$this->email->to($email);
						$this->email->from($config['smtp_user'],$mData['appName'].' Support');
						$this->email->subject('Hello from '.$mData['appName']);
						$this->email->message($htmlContent);
						$this->email->send();


						$data['Status'] = 'SUCCESS';
						$data['Message'] = 'Successfully registered. Please verify your email id to continue';
					}
					else{
						$data['Status'] = 'ERROR';
						$data['Message'] = "Invalid parameters";
					}
				}
				else{

					$data['Status'] = 'ERROR';
					$data['Message'] = "You are not allowed";
				}
			}
			else{
				$data['Status'] = "ERROR";
				$data['Message'] = "User already exists";
			}
			http_response_code(200);
			echo json_encode($data);
		}
		else{
			http_response_code(401);
		}
	}

	public function forgotPassword(){
		$json = json_decode(file_get_contents('php://input'));
		$this->load->model('authModel');
		if($json != null){
			$email = $json->email;
			$user = $this->authModel->getUserFromEmail($email);
			if($user == null){
				$data['Status'] = "ERROR";
				$data['Message'] = "User does not exist";
			}
			else{
				$token = uniqid();
				$this->authModel->insertToken($user->id,$token,'Y');
				$mData['activationLink'] = base_url().'auth/verifyUser/'.$user->id.'/'.$token;
				$mData['appName'] = APP_NAME;
				$this->load->library('email');
				$config = array(
				    'protocol'  => 'smtp',
				    'smtp_host' => 'ssl://smtp.zoho.com',
				    'smtp_port' => 465,
				    'smtp_user' => SMTP_EMAIL,
				    'smtp_pass' => SMTP_PASSWORD,
				    'mailtype'  => 'html',
				    'charset'   => 'utf-8'
				);
				$this->email->initialize($config);
				$this->email->set_mailtype("html");
				$this->email->set_newline("\r\n");
				$htmlContent = $this->load->view('template/forgotPasswordEmail',$mData,true);
				$this->email->to($email);
				$this->email->from($config['smtp_user'],$mData['appName'].' Support');
				$this->email->subject('Reset password from '.$mData['appName']);
				$this->email->message($htmlContent);
				$this->email->send();
				$data['Status'] = 'SUCCESS';
				$data['Message'] = 'Successfully sent link. Please continue on your email id';
			}
			http_response_code(200);
			echo json_encode($data);
		}
		else{
			http_response_code(401);
		}
	}

	public function verifyUser($userid=null,$token=null){
		if($userid != null && $token != null){
			$this->load->model('authModel');
			$authToken = $this->authModel->getToken($userid,$token);
			if($authToken == null){
				$this->load->view('invalidTokenView');
			}
			else{
				if($authToken->isForgotYN == "Y"){
					//todo
				}
				else{
					$this->authModel->verifyUser($userid);
					$this->authModel->deleteToken($userid,$token);
					$this->load->view('validTokenView');
				}
			}
		}
	}

	public function updatePassword(){
		$json = json_decode(file_get_contents('php://input'));
		$this->load->model('authModel');
		if($json != null){
			$userid = $json->userid;
			$token = $json->token;
			$password = $json->password;
			$authToken = $this->authModel->getToken($userid,$token);
			if($authToken != null){
				$this->authModel->updatePassword($userid,$password);
			}	
			else{
				$data['Status'] = "ERROR";
				$data['Message'] = "Invalid token";
			}
		}
		else{
			http_response_code(401);
		}
	}


}