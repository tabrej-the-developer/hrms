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

	public function login(){
		$json = json_decode(file_get_contents('php://input'));
		
		if($json != null){
			$email = $json->email;
			$password = $json->password;
			$deviceid = $json->deviceid;
			if($email != "" && $email != null && $password != "" && $password != null && $deviceid != "" && $deviceid != null){
				
				$this->load->model('authModel');
				$user = $this->authModel->getUser($email,$password);
				$emailExist = $this->authModel->getUserFromEmail($email);
				$userExist = $this->authModel->getUserFromId($email);
				if($user == null){
					$data['Status'] = "ERROR";
					$data['Message'] = "Invalid email id or password";
					if($emailExist == null && $userExist == null){
						$data['Status'] = "ERROR";
						$data['Message'] = "User doesnot exist";
					}
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
					//$data['firebaseid'] = $user->firebaseid;
					$data['isVerified'] = $user->isVerified;
					$permissions = $this->authModel->getPermissions($user->id);
					$this->logs($data);
					// $var = [];
					// if($permissions != null){
					// 	$var['isQrReaderYN'] = $permissions->isQrReaderYN;
					// 	$var['updateTimesheetYN'] = $permissions->updateTimesheetYN;
					// }
					// $data['permissions'] = $var;
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


	public function forgotPassword(){
		$json = json_decode(file_get_contents('php://input'));
		$this->load->model('authModel');
		if($json != null){
			$email = $json->email;
			$user = $this->authModel->getUserFromEmail($email);
			$userExist = $this->authModel->getUserFromId($email);
				if($user == null && $userExist == null){
					$data['Status'] = "ERROR";
					$data['Message'] = "Invalid email id or password";
					if($emailExist == null && $userExist == null){
						$data['Status'] = "ERROR";
						$data['Message'] = "User doesnot exist";
					}
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
					redirect(site_url("../welcome/resetPassword/").$userid."/".$token);
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


	public function fetchMyPermissions($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('authModel');
				$mdata['permissions'] = $this->authModel->getPermissions($userid);
				http_response_code(200);
				echo json_encode($mdata);
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function logoutSession(){
		$json = json_decode(file_get_contents('php://input'));
		$id = $json->id;
		$this->load->model('authModel');
		$this->authModel->logoutTime($id);
		$data['status'] = 'SUCCESS';
			http_response_code(200);
			echo json_encode($data);
	}

	function logs($params){
		$ip = $this->get_client_ip();
		$data['usertype'] = $params['role'];
		$data['userid'] = $params['userid'];
		$data['login_at'] = date('Y-m-d H:i:s');
		$data['auth_token'] = $params['AuthToken'];
		$data['ip'] = $ip;
		$this->load->model('authModel');
		$this->authModel->logs($data);
	}

	function get_client_ip() {
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}

}