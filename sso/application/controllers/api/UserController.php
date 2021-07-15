<?php

date_default_timezone_set('Asia/Kolkata');

//Load composer's autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';

class UserController extends RestController{

    public function __construct()
    {
        parent::__construct();
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

    public function postUser_post(){
        $user = new UserModel;
        $company = new CompanyModel;
        $app = new AppModel;
        $email_activation_code = bin2hex(random_bytes(20));
        $jsonData = json_decode(file_get_contents("php://input"));
        if($jsonData !== NULL){
            $data = [
                'email'=>$jsonData->email,
                'password'=>$jsonData->password,
                'userName'=>ucwords($jsonData->userName),
                'userType'=>$jsonData->userType,
            ];
            $todId = $user->insertUser($data);
            if($todId > 0){
                //For VIZYTOR - appId(1) - we are adding users to usercompany,userapps,users
                if($jsonData->appId == 1){
                    //1::Segment::Insert TodId and CompanyId in usercompany table
                    $user->insertUserCompany(array('todId'=>$todId,'companyId'=>$jsonData->companyId));
                    //2::Segment::Insert Choosed Apps in userapps
                    $appdata = [
                        'todId'=>$todId,
                        'appId'=>$jsonData->appId,
                        'loginAccess'=>"Y"
                    ];
                    $user->insertUserApp($appdata);
                }elseif($jsonData->appId == 2 || $jsonData->appId == 3){
                    //1::Segment::Insert TodId and CompanyId in usercompany table
                    $user->insertUserCompany(array('todId'=>$todId,'companyId'=>$jsonData->companyId));
                    //2::Segment::Insert Choosed Apps in userapps
                    $appdata = [
                        'todId'=>$todId,
                        'appId'=>$jsonData->appId,
                        'loginAccess'=>"Y"
                    ];
                    $user->insertUserApp($appdata);
                    if($jsonData->userType !== 'relative'){
                        //3::Segment::Insert TodId,CenterId and CompanyId in usercenter table
                        $user->insertUserCenter(array('todId'=>$todId,'centerId'=>$jsonData->centerId,'companyId'=>$jsonData->companyId));
                    }

                }
                //$this->sendEmail($jsonData->email,$jsonData->firstName,$email_activation_code);
                $response = ['status'=>true,'message'=>'NEW USER CREATED'];
            }else{
                $response = ['status'=>false,'message'=>'FAILED TO CREATE USER'];
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
    //Profile Picture
    public function profilePicture_post(){
        
        $user = new UserModel;

        //For profile picture
        $fileName  =  $_FILES['profilePic']['name'];
        $tempPath  =  $_FILES['profilePic']['tmp_name'];
        $fileSize  =  $_FILES['profilePic']['size'];

        if(!empty($fileName)){
            $upload_path = 'assets/file_uploads/user_profile_pictures/'; // set upload folder path 
            $fileExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION)); // get image extension
            // valid image extensions
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
            // allow valid image file formats
            if(in_array($fileExt, $valid_extensions))
            {				
                //check file not exist our upload folder path
                if(!file_exists($upload_path . $fileName))
                {
                    // check file size '5MB'
                    if($fileSize < 5000000){
                        move_uploaded_file($tempPath, $upload_path . $fileName); // move file from system temporary path to our upload folder path 
                    }
                    else{		
                        $errorMSG = json_encode(array("message" => "Sorry, your file is too large, please upload 5 MB size", "status" => false));	
                        echo $errorMSG;
                    }
                }
                else
                {		
                    $errorMSG = json_encode(array("message" => "Sorry, file already exists check upload folder", "status" => false));	
                    echo $errorMSG;
                }
            }
            else
            {		
                $errorMSG = json_encode(array("message" => "Sorry, only JPG, JPEG, PNG &amp; GIF files are allowed", "status" => false));	
                echo $errorMSG;		
            }
        }
        // if no error caused, continue ....
        if(!isset($errorMSG))
        {
            $todId = $this->input->post('todId');
            $data = [
                'profilePic'=>$fileName
            ];
            $fp = $user->uploadProfilePicture($todId,$data);
            if($fp){
                $response = ['status'=>true,'message'=>'PROFILE PICTURE UPLOADED'];
                $this->output->set_content_type('application/json')
                ->set_output(json_encode($response));
            }else{
                $response = ['status'=>false,'message'=>'SERVER ERROR. TRY AGAIN LATER'];
                $this->output->set_content_type('application/json')
                ->set_output(json_encode($response));
            }
        }
    }
    public function removeUser_delete($email){
        $user = new UserModel;
        $result = $user->deleteUser($email);
        if($result){
            $response = ['status'=>true,'message'=>'USER DELETED'];
        }else{
            $response = ['status'=>false,'message'=>'FAILED TO DELETE USER. TRY AGAIN LATER'];
        }
        $this->output->set_content_type('application/json')
        ->set_output(json_encode($response));
    }
    public function updateUser_post(){
        $user = new UserModel;
        $jsonData = json_decode(file_get_contents("php://input"));
        $email = $jsonData->email;
        $data = [
            'userName'=>$jsonData->userName
        ];
        $user->editUser($email,$data);
    }
    public function getUserDetailedInfo_get($email){
        $user = new UserModel;
        $res = $user->getUserDetails($email);
        if($res == null){
            $rdata['present'] = false;
        }
        else{
            $rdata['present'] = true;
        }
        echo json_encode($rdata);
    }
    public function storeChild_post(){
        $child = new ChildModel;
        $jsonData = json_decode(file_get_contents("php://input"));
        if($jsonData !== NULL){
            $data =[
                "childId"=>$jsonData->childId,
                "fName"=>$jsonData->fName,
                "lName"=>$jsonData->lName,
                "careDate"=>$jsonData->careDate,
                "birthDate"=>$jsonData->birthDate,
                "gender"=>$jsonData->gender,
                "parentId"=>$jsonData->parentId
             ];
            $child->insertChild($data['childId'],$data['fName'],$data['lName'],$data['careDate'],$data['birthDate'],$data['gender'],$data['parentId']);
        }else{
            // not proper JSON received - set response headers properly
            header("HTTP/1.1 400 Bad Request"); 
            // respond with error
            $response = ['status'=>false,'message'=>'ONLY SEND REQUEST AS RAW'];
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($response));
        }
    }
    public function storeParent_post(){
        $parent = new ParentModel;
        $jsonData = json_decode(file_get_contents("php://input"));
        if($jsonData !== NULL){
            $data = [
                "parentId"=>$jsonData->parentId,
                "childCount"=>$jsonData->childCount,
                "childId"=>$jsonData->childId,
                "contact"=>$jsonData->contact,
                "email"=>$jsonData->email,
                "addressStreet"=>$jsonData->addressStreet,
                "addressCity"=>$jsonData->addressCity,
                "addressState"=>$jsonData->addressState,
                "addressZip"=>$jsonData->addressZip
            ];
			$parent->insertIntoParent($data['parentId'],$data['childCount'],$data['childId'],$data['contact'],$data['email'],$data['addressStreet'],$data['addressCity'],$data['addressState'],$data['addressZip']);
        }else{
            // not proper JSON received - set response headers properly
            header("HTTP/1.1 400 Bad Request"); 
            // respond with error
            $response = ['status'=>false,'message'=>'ONLY SEND REQUEST AS RAW'];
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($response));
        }
    }
    public function addChild_post(){
        $child = new ChildModel;
        $jsonData = json_decode(file_get_contents("php://input"));
        if($jsonData !== NULL){
            $data =[
                "childId"=>$jsonData->childId,
                "fName"=>$jsonData->fName,
                "lName"=>$jsonData->lName,
                "careDate"=>$jsonData->careDate,
                "birthDate"=>$jsonData->birthDate,
                "gender"=>$jsonData->gender,
                "parentId"=>$jsonData->parentId
             ];
            $child->addChild($data['childId'],$data['fName'],$data['lName'],$data['careDate'],$data['birthDate'],$data['gender'],$data['parentId']);
        }else{
            // not proper JSON received - set response headers properly
            header("HTTP/1.1 400 Bad Request"); 
            // respond with error
            $response = ['status'=>false,'message'=>'ONLY SEND REQUEST AS RAW'];
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($response));
        }
    }
    public function editChild_post(){
        $child = new ChildModel;
        $jsonData = json_decode(file_get_contents("php://input"));
        if($jsonData !== NULL){
            $data =[
                "childId"=>$jsonData->childId,
                "fName"=>$jsonData->fName,
                "lName"=>$jsonData->lName,
                "careDate"=>$jsonData->careDate,
                "birthDate"=>$jsonData->birthDate,
                "gender"=>$jsonData->gender
             ];
            $child->updateChildDetails($data['childId'],$data['fName'],$data['lName'],$data['birthDate'],$data['careDate'],$data['gender']);
        }else{
            // not proper JSON received - set response headers properly
            header("HTTP/1.1 400 Bad Request"); 
            // respond with error
            $response = ['status'=>false,'message'=>'ONLY SEND REQUEST AS RAW'];
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($response));
        }
    }
    public function addParentChild_post(){
        $child = new ChildModel;
        $jsonData = json_decode(file_get_contents("php://input"));
        if($jsonData !== NULL){
            $data =[
                "childId"=>$jsonData->childId,
                "parentId"=>$jsonData->parentId
             ];
            $child->insertParentChild($data['parentId'],$data['childId']);
        }else{
            // not proper JSON received - set response headers properly
            header("HTTP/1.1 400 Bad Request"); 
            // respond with error
            $response = ['status'=>false,'message'=>'ONLY SEND REQUEST AS RAW'];
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($response));
        }
    }
    public function editParentDetails_post(){
        $parent = new ParentModel;
        $jsonData = json_decode(file_get_contents("php://input"));
        if($jsonData !== NULL){
            $data =[
                "childCount"=>$jsonData->childCount,
                "childId"=>$jsonData->childId,
                "contact"=>$jsonData->contact,
                "email"=>$jsonData->email,
                "addressStreet"=>$jsonData->addressStreet,
                "addressCity"=>$jsonData->addressCity,
                "addressState"=>$jsonData->addressState,
                "addressZip"=>$jsonData->addressZip,
                "parentId"=>$jsonData->parentId
             ];
            $parent->updateParentDetails($data['childCount'],$data['childId'],$data['contact'],$data['email'],$data['addressStreet'],$data['addressCity'],$data['addressState'],$data['addressZip'],$data['parentId']);
        }else{
            // not proper JSON received - set response headers properly
            header("HTTP/1.1 400 Bad Request"); 
            // respond with error
            $response = ['status'=>false,'message'=>'ONLY SEND REQUEST AS RAW'];
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($response));
        }
    }
    public function editParentName_post(){
        $parent = new ParentModel;
        $jsonData = json_decode(file_get_contents("php://input"));
        if($jsonData !== NULL){
            $data =[
                "todId"=>$jsonData->todId,
                "userName"=>$jsonData->userName
             ];
             $parent->updateParentName($data['userName'],$data['todId']);
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