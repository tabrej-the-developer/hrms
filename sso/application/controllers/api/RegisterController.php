<?php

date_default_timezone_set('Asia/Kolkata');

//Load composer's autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;


class RegisterController extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
	{
		$data['title'] = 'REGISTER';
		$data['content'] = $this->load->view('register',$data,true);
		$this->load->view('template/default_layout',$data);
		
	}
    function sendEmail($destinationEmail,$username,$email_activation_code){
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        // try {
        //Server settings
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'devslife2@gmail.com';                     // SMTP username
        $mail->Password   = 'uniquedeveloper';                               // SMTP password
        $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 465;                                    // TCP port to connect to
  
        //Recipients
        $mail->setFrom('admin@todquest.com', 'Todquest');
        //Clear Last Recipients
        // $mail->clearAddresses();
        // $mail->clearAttachments();
        $mail->addAddress($destinationEmail);
        // add pdf attachment in the email
        
        // $mail->addStringAttachment($pdf,"some-pdf.pdf");
  
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Registration Successful!';
        $data['username'] = $username;
        // $data['appname'] = $appName;
        $data['email_activation_code'] = $email_activation_code;
        $mail->Body = $this->load->view('emails/verify_email',$data,true);
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        if($mail->send()){
            $response = ['status'=>true,'message'=>'NEW USER CREATED'];
         }else{
            $response = ['status'=>false,'message'=>$mail->ErrorInfo];
         }
         // header('Content-Type: application/json');
         // echo json_encode($response);
         $this->output->set_content_type('application/json')
         ->set_output(json_encode($response));
    }
    public function storeUser(){
        $user = new UserModel;
        $company = new CompanyModel;
        $jsonData = json_decode(file_get_contents("php://input"));
        if($jsonData !== NULL){

            $data = [
                'email'=>$jsonData->email,
                'password'=>md5($jsonData->password),
                'userName'=>$jsonData->userName,
                'userType'=>$jsonData->userType,
            ];
            //Some Conditions Check
            if($user->checkEmail($jsonData->email) > 0){//If user already there
                if($jsonData->userType != 'superadmin'){
                    $response = ['status'=>false,'message'=>'EMAIL ALREADY EXISTS'];
                    $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response));
                }else{
                    $userdetails = $user->getUserDetails($jsonData->email);
                    $todId = $userdetails->todId;//get todId
                    if($company->checkCompany($jsonData->companyName) > 0){
                        if($user->checkUserApp($jsonData->appId,$todId) > 0){
                            $response = ['status'=>false,'message'=>'COMPANY SUPERADMIN USER ALREADY EXISTS WITH IN THIS APP'];
                            $this->output->set_content_type('application/json')
                            ->set_output(json_encode($response));
                        }else{
                            //Insert into userapp table
                            $appdata = [
                                'todId'=>$todId,
                                'appId'=>$jsonData->appId,
                                'loginAccess'=>"Y"
                            ];
                            $user->insertUserApp($appdata);
                            $response = ['status'=>true,'message'=>'USER CREATED'];
                            $this->output->set_content_type('application/json')
                            ->set_output(json_encode($response));
                        } 
                    }else{
                        $response = ['status'=>false,'message'=>'DEAR, THIS PERSON ALREADY ASSOCIATED WITHIN ONE COMPANY. TRY DIFFERENT EMAIL.'];
                        $this->output->set_content_type('application/json')
                        ->set_output(json_encode($response));
                    }
                }
            }else{//If user not there
                if($company->checkCompany($jsonData->companyName) > 0){
                    $response = ['status'=>false,'message'=>'COMPANY ALREADY EXISTS'];
                    $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response));
                }else{
                    $todId = $user->insertUser($data);
                    if($todId > 0){
                        //Insert Company Name In Company Table
                        $companyId = $company->insertCompany(array('name'=>strtoupper($jsonData->companyName)));
                        //Insert TodId and CompanyId in usercompany table
                        $user->insertUserCompany(array('todId'=>$todId,'companyId'=>$companyId));
                        //Insert Choosed Apps in userapps
                        $appdata = [
                            'todId'=>$todId,
                            'appId'=>$jsonData->appId,
                            'loginAccess'=>"Y"
                        ];
                        $user->insertUserApp($appdata);
                        //$this->sendEmail($jsonData->email,$jsonData->firstName,$email_activation_code);
                        $response = ['status'=>true,'message'=>'NEW USER CREATED'];
                    }else{
                        $response = ['status'=>false,'message'=>'FAILED TO CREATE USER'];
                    }
                    $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response));
                }
            }
        }else{
            // not proper JSON received - set response headers properly
            header("HTTP/1.1 400 Bad Request"); 
            // respond with error
            $response = ['status'=>false,'message'=>'ONLY SEND REQUEST AS RAW'];
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($response));
        }
    }
    public function verifyUser($activationcode){
        $user = new UserModel;
        $data = [
            'isEmailVerfiedYN'=>'Y',
            'verifiedAt'=>date('y-m-d H:i:s')
        ];
        $result = $user->verifyEmailAddress($data,$activationcode);

        if($result == 1){
            $this->load->view('emails/already_verified_email');
        }elseif($result == 2){
            $this->load->view('emails/verified_email');
        }elseif($result == 3){
            $this->load->view('emails/invalid_email_activation_code');
        }
    }
}
?>