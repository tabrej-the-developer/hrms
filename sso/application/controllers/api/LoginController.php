<?php
class LoginController extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
	{
		$data['title'] = 'LOGIN';
		$data['content'] = $this->load->view('login',$data,true);
		$this->load->view('template/default_layout',$data);
		
	}
    private function getSourceAddress()
	{
        $source='';
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $source=$_SERVER['HTTP_CLIENT_IP'];
          }
          elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $source=$_SERVER['HTTP_X_FORWARDED_FOR'];
          }
          else{
            $source=$_SERVER['REMOTE_ADDR'];
          }
		return $source;
	}
    public function login(){
        $user = new UserModel;
        $jsonData = json_decode(file_get_contents("php://input"));
        if($jsonData !== NULL){

            $email = isset($jsonData->email) ? $jsonData->email : '';
            $password = isset($jsonData->password) ? $jsonData->password : '';
            $details = $user->credentialsCheck($email,$password);
            if(empty($email) || empty($password)){ 
                $response = ['status'=>false,'message'=>'EMAIL OR PASSWORD EMPTY'];
            }elseif($details['result'] == 1){ 
                $response = ['status'=>false,'message'=>'NO EMAIL EXISTED'];
            }elseif($details['result'] == 2){ 
                $response = ['status'=>false,'message'=>'CREDENTIALS MISMATCHED'];
            }elseif($details['result'] == 3){
                //1:check::Before Inserting Delete previous Login Token(if any exists) for current user
                $user->deleteLoginToken($details['data']->todId);
                //2::check::Insert New Login Token for current user
                $data = [
                    'todId'=>$details['data']->todId,
                    'authToken'=>bin2hex(random_bytes(20)),
                    'sourceAddress'=>$this->getSourceAddress()
                ];
                $user->insertLoginToken($data);
                //3:check::Get New Login Token for current user
                $newAuthTokenDetails = $user->getLoginToken($details['data']->todId);
                $authToken = $newAuthTokenDetails->authToken;
                //4::check::Get Apps of the particular user
                $userAppDetails = $user->getUserApps($details['data']->todId);
                $user_data = [
                    'todId'=>(int)$details['data']->todId,
                    'companyId'=>(int)$details['data']->companyId,
                    'companyName'=>$details['data']->companyName,
                    'apps'=>$userAppDetails,
                    'email'=>$details['data']->email,
                    'userType'=>$details['data']->userType
                ]; 
                $response = ['status'=>true,'message'=>'USER AUTHENTICATION SUCCESS!','authToken'=>$authToken,'userdata'=>$user_data];
            }
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($response));
        }else{
            // not proper JSON received - set response headers properly
            header("HTTP/1.1 400 Bad Request"); 
            // respond with error
            $response = ['status'=>false,'message'=>'ONLY SEND REQUEST AS RAW'];
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($response));
        }
    }
	public function changePassword()
	{
        $user = new UserModel;
		$json = json_decode(file_get_contents('php://input'));
		if ($json != null) {
			$password = $json->password;
			$loginId = $json->loginId;
            $response = $user->updatePassword($loginId, $password);
            if($response){
                $data['Status'] = "SUCCESS";
                $data['Message'] = "Password Changed";
            }else{
                $data['Status'] = "FAIL";
                $data['Message'] = "Server Error. Try Again Later";
            }
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($data));
		}else{
            // not proper JSON received - set response headers properly
            header("HTTP/1.1 400 Bad Request"); 
            // respond with error
            $response = ['status'=>false,'message'=>'ONLY SEND REQUEST AS RAW'];
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($response));
        }
	}
    
}
?>