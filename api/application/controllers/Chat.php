<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

    // private $BASE_URL = "https://teach.practically.com";
    private $BASE_URL = "https://stgteach.practically.com";
    // private $TOPIC_PREFIX = "stage_";
    private $TOPIC_PREFIX = "prod_";


    function __construct() {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-DEVICE-ID,X-TOKEN, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
        die();
        }
        parent::__construct();
        $this->load->model('chatModel');
    }
    
    public function index()
    {
        $this->load->view('welcome_message');
    }

    /*
        This function is used to get `count` number of chats in a conversation.
    */
    public function getChat($idUser){

        $headers = $this->input->request_headers();
        if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
            $this->load->model('authModel');
            $res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
            if($res != null && $res->userid == $idUser){
                if($_SERVER['REQUEST_METHOD'] == "GET") {
                    $idConversation = $_REQUEST['idConversation'] ? $_REQUEST['idConversation'] : 0;
                    $count = isset($_REQUEST['count']) ? $_REQUEST['count'] : 20;
                    $offset = isset($_REQUEST['offset'])  ? $_REQUEST['offset'] : 0;    
                    // $idUser = isset($_REQUEST['idUser']) ? $_REQUEST['idUser'] : 0;
                    if($idUser && $idConversation){
                        $data['Status'] = "SUCCESS";
                        $data['chats'] = $this->chatModel->getChat($idConversation,$idUser,$offset,$count);
                    }
                    else{
                        $data['Status'] = "ERROR";
                        $data['Message'] = "Invalid parameters";
                    }
                    http_response_code(200);
                    echo json_encode($data); 
                }
                else{
                    $data['Status'] = "ERROR";
                    $data['Message'] = "Invalid method";
                    http_response_code(200);
                    echo json_encode($data);
                }
            }
            else{
                http_response_code(401);
            }
        }
        else{
            http_response_code(401);
        }
    }

    /*
        This function is used to post a new chat. Notifications to all members of the conversation are also sent via this method
    */
    public function postChat(){


        $headers = $this->input->request_headers();
        if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
            $this->load->model('authModel');
            $res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
            $para = json_decode(file_get_contents('php://input'));
            if($para!= null && $res != null && $res->userid == $para->userid){

                if($_SERVER['REQUEST_METHOD'] == "POST") {

                    $idMember = $para->idMember ? $para->idMember : 0;
                    $chatText  = isset($para->chatText) ? $para->chatText : null;
                    $media = isset($para->media) ? $para->media : null;
                    $senderName = $para->senderName;
                    if($idMember){
                        if($media != null){
                            $_id = uniqid('chat_');
                            file_put_contents(UPLOAD_IMAGE_PATH.'chat/'.$_id.".png", base64_decode($media));
                            $media = $_id.'.png';
                        }
                        $chat = $this->chatModel->postChat($idMember,$chatText,$media);
                        $members = $this->chatModel->getAllMembersInConversationByMember($idMember);
                        $title = "New Message";
                        if($chatText != null){
                            $body = $senderName.": ".substr($chatText, 0,80);
                            if(strlen($chatText) > 80) $body.= "...";
                        }
                        else
                            $body = $senderName.": shared a picture";
                        $memberDetails = $this->chatModel->getMemberDetails($idMember);
                        $payload['idConversation'] = $members[0]->idConversation;
                        $payload['idChat'] = $chat->idChat;
                        $payload['idMember'] = $chat->idMember;
                        $payload['idUser'] = $memberDetails->idUser;
                        $payload['chatText'] = $chatText;
                        // $payload['media'] = $chat->media;
                        $payload['chatType'] = $chat->chatType;
                        $payload['createdAt'] = $chat->createdAt;
                        $payload['click_action'] = 'FLUTTER_NOTIFICATION_CLICK';
                        $convoDets = $this->chatModel->getConversationById($payload['idConversation']);
                        $payload['convoName'] = $convoDets->convoName;
                        $payload['isGroupYN'] = $convoDets->isGroupYN;
                        // $payload['convoProfilePic'] = $convoDets->convoProfilePic;
                        $payload['lastUpdated'] = $convoDets->lastUpdated;
                        $this->chatModel->updateLastUpdateconversation($members[0]->idConversation);
                        foreach($members as $mem){
                            if($mem->idUser != $para->userid && $mem->deletedDate == null){
                                $this->firebase->sendMessage($title,$body,$payload,$mem->idUser);
                            }
                        }
                        $Status = "SUCCESS";
                        $data['chat'] = $chat;
                        $message = "";
                    }
                    else {
                        $data['Status'] = "ERROR";
                        $data['Message'] = "Invalid parameters";
                    }
                    http_response_code(200);
                    echo json_encode($data);
                }
                else{
                    $data['Status'] = "ERROR";
                    $data['Message'] = "Invalid method";
                    http_response_code(200);
                    echo json_encode($data);
                }

            }
            else{
                http_response_code(401);
            }
        }
        else{
            http_response_code(401);
        }
    }

    /*
        This function is used to get all the details of a conversation.
    */
    public function getConversation($idUser){


        $headers = $this->input->request_headers();
        if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
            $this->load->model('authModel');
            $res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
            if($res != null && $res->userid == $idUser){
                if($_SERVER['REQUEST_METHOD'] == "GET") {

                    // $idUser = $_REQUEST['idUser'] ? $_REQUEST['idUser'] : 0;
                    
                    if($idUser){
                        if(isset($_REQUEST['idConversation'])){
                            $idConversation = $_REQUEST['idConversation'];
                            $data['conversation'] = $this->chatModel->getConversationById($idConversation);
                        }
                        else if(isset($_REQUEST['idUserOther'])){
                            $idUserOther = $_REQUEST['idUserOther'];
                            $otherUser = $this->authModel->getUserDetails($_REQUEST['idUserOther']);
                            $data['conversation'] = $this->chatModel->getConversationByUser($idUser,$idUserOther); 
                            if($data['conversation'] != null){
                                $data['conversation']->convoName = $otherUser->name;
                                $data['conversation']->convoProfilePic = $otherUser->imageUrl;
                            }
                        }
                        if($data['conversation'] != null){
                            $members = $this->chatModel->getMemeberDetailsInConversation($data['conversation']->idConversation);
                            $data['members'] = array();
                            $otherUserId = "";
                            foreach ($members as $member) {
                                $var['idMember'] = $member->idMember;
                                $var['idConversation'] = $member->idConversation;
                                $var['idUser'] = $member->idUser;
                                $otherUser = $this->authModel->getUserDetails($member->idUser);
                                if($otherUser != null){
                                    $var['DisplayName'] = $otherUser->name;
                                    $var['ProfilePic'] = $otherUser->imageUrl;
                                }
                                if($otherUser->id != $idUser && $otherUserId == "") $otherUserId = $otherUser->id;
                                $var['addedDate'] = $member->addedDate;
                                $var['deletedDate'] = $member->deletedDate;
                                $var['isAdminYN'] = $member->isAdminYN;
                                $var['lastSeen'] = $member->lastSeen;
                                array_push($data['members'],$var);
                            }

                            if($data['conversation']->isGroupYN == "N"){
                                //send common groups
                                $data['commonGroups'] = $this->chatModel->getCommonGroups($idUser,$otherUserId);
                            }

                            $data['Status'] = "SUCCESS";
                        }
                        else{
                            $data['Status'] = "ERROR";
                        }
                    }
                    else{
                        $data['Status'] = "ERROR";
                        $data['Message'] = "Invalid parameters.";
                    }
                    http_response_code(200);
                    echo json_encode($data);
                }
                else{
                    $data['Status'] = "ERROR";
                    $data['Message'] = "Invalid method";
                    http_response_code(200);
                    echo json_encode($data);
                }
            }
            else{
                http_response_code(401);
            }
        }
        else{
            http_response_code(401);
        }
    }

    /* 
        This function is used to get all the recent conversations along with unread count.
    */
    public function getRecentConversations($idUser){
        $headers = $this->input->request_headers();
	$headers = array_change_key_case($headers);
        if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
            $this->load->model('authModel');
            $res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
            if($res != null && $res->userid == $idUser){
                if($_SERVER['REQUEST_METHOD'] == "GET") {

                    // $idUser = $_REQUEST['idUser'] ? $_REQUEST['idUser'] : 0;
                    if($idUser){
                        $allConversation = $this->chatModel->getConversationOrdered($idUser);
                        $data['conversation'] = array();
                        foreach($allConversation as $convo){
                            $var['idConversation'] = $convo->idConversation;
                            if($convo->isGroupYN == "Y"){
                                $var['convoName'] = $convo->convoName;
                                $var['convoProfilePic'] = $convo->convoProfilePic;
                            }
                            else{
                                $other = $this->chatModel->getOtherMemberInConvo($idUser,$convo->idConversation);
                                $otherUser = $this->authModel->getUserDetails($other->idUser);
                                $var['convoName'] = $otherUser->name;
                                $var['convoProfilePic'] = $otherUser->imageUrl;
                            }
                            $var['recentChat'] = $this->chatModel->getChat($convo->idConversation,$idUser,0,1);
                            if($var['recentChat'] != null){
                                $var['unreadCount'] = $this->chatModel->getUnreadcount($idUser,$convo->idConversation);
                                array_push($data['conversation'],$var);
                            }
                        }
                        $data['Status'] = "SUCCESS";
                    }
                    else{
                        $data['Status'] = "ERROR";
                        $data['Message'] = "Invalid parameters.";
                    }
                    http_response_code(200);
                    echo json_encode($data);
                }
                else{
                    $data['Status'] = "ERROR";
                    $data['Message'] = "Invalid method";
                    http_response_code(200);
                    echo json_encode($data);
                }
            }
            else{
                http_response_code(401);
            }
        }
        else{
            http_response_code(401);
        }
    }


    /*
        This function is used to update member details
    */
    public function updateMember(){


        $headers = $this->input->request_headers();
        if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
            $this->load->model('authModel');
            $res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
            $para = json_decode(file_get_contents('php://input'));
            if($para!= null && $res != null && $res->userid == $para->userid){

                if($_SERVER['REQUEST_METHOD'] == "POST") {

                    $lastSeen = $para->lastSeen ;
                    $isDeletedYN  = $para->isDeletedYN;
                    $isAdminYN = isset($para->isAdminYN) ? $para->isAdminYN : null;
                    $idMember = isset($para->idMember) ? $para->idMember : 0;
                    $idUser = isset($para->userid) ? $para->userid : 0;
                    $idOtherUser = isset($para->idOtherUser) ? $para->idOtherUser : null; 
                    $memberDetails = $this->chatModel->getMemberDetails($idMember); 
                    $userDetails = $this->authModel->getUserDetails($memberDetails->idUser);
                    $idConversation = isset($para->idConversation) ? $para->idConversation : 0;
                    $deletedDate = null;
                    if($isDeletedYN == "Y"){
                        $deletedDate = date('Y-m-d H:i:s');
                        $txt = $userDetails->name." left the group";
                        if($idUser && $idOtherUser == null){
                            $mUserDets = $this->authModel->getUserDetails($idUser);
                            $txt = $mUserDets->name." removed ".$userDetails->name;
                        }
                        $this->chatModel->postChat($idMember,$txt,null,'TRANSACTION');
                        if($idConversation)
                        $this->chatModel->updateLastUpdateconversation($idConversation);
                        //todo if admin -> create a new admin
                    }
                    if($idMember){
                        $this->chatModel->updateMember($isAdminYN,$deletedDate,$lastSeen,$idMember);
                        $data['Status'] = "SUCCESS";
                    }
                    else{
                        $data['Status'] = "ERROR";
                        $data['Message'] = "Invalid parameters";
                    }
                    http_response_code(200);
                    echo json_encode($data);
                }
                else{
                    $data['Status'] = "ERROR";
                    $data['Message'] = "Invalid method";
                    http_response_code(200);
                    echo json_encode($data);
                }

            }
            else{
                http_response_code(401);
            }
        }
        else{
            http_response_code(401);
        }
    }

    /*
        This function is used to create a new conversation or update an existing one
    */
    public function postConversation(){


        $headers = $this->input->request_headers();
        if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
            $this->load->model('authModel');
            $res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
            $para = json_decode(file_get_contents('php://input'));
            if($para!= null && $res != null && $res->userid == $para->userid){

                if($_SERVER['REQUEST_METHOD'] == "POST") {

                    $allUserids = $para->idUsers;
                    $convoName = isset($para->convoName) ? $para->convoName : null;
                    $convoProfilePic = isset($para->convoProfilePic) ? $para->convoProfilePic : null;
                    $idConversation = isset($para->idConversation) ? $para->idConversation : null;
                    $idUser = isset($para->userid) ? $para->userid : 0;
                    $isGroupYN = isset($para->isGroupYN) ? $para->isGroupYN : "N";          
                    if($idUser){
                        $userDetails = $this->authModel->getUserDetails($idUser);
                        if($idConversation != null){
                            $idMember = $this->chatModel->getMemberFromIdUser($idConversation,$idUser)->idMember;
                            //update
                            if($convoName != null || $convoProfilePic != null){
                                if($convoProfilePic != null){
                                    file_put_contents(UPLOAD_IMAGE_PATH.'conversation/'.$idConversation.".png", base64_decode($convoProfilePic));
                                    $convoProfilePic = $idConversation.'.png';
                                }
                                $this->chatModel->updateConversation($idConversation,$convoName,$convoProfilePic);
                                    $chatText = $userDetails->name." changed profile pic.";
                                if($convoName != null)
                                    $chatText = $userDetails->name." changed conversation name to $convoName";
                                $this->chatModel->postChat($idMember,$chatText,null,'TRANSACTION'); 
                                // $this->chatModel->updateLastUpdateconversation($idConversation); 
                            }
                            $data['idConversation'] = $idConversation;
                        }
                        else if($convoName != null){
                            //create
                            $idConversation = $this->chatModel->createConversation($convoName,$isGroupYN,$idUser);
                            $idMember = $this->chatModel->createMember($idUser,$idConversation,'Y');
                            $txt = $userDetails->name." created the group";
                            if($isGroupYN == "Y"){
                                $this->chatModel->postChat($idMember,$txt,null,'TRANSACTION');  
                            }   
                            $data['idConversation'] = $idConversation;
                            // $this->chatModel->updateLastUpdateconversation($idConversation);
                        }
                        else{
                            $data['Status'] = "ERROR";
                            $data['Message'] = "Invalid params";
                            echo json_encode($data);
                            return;
                        }

                        $convoDetails = $this->chatModel->getConversationById($idConversation);
                        $title = $convoDetails->convoName;
                        $body = $userDetails->name." added you";
                        $payload['idConversation'] = $idConversation;
                        $payload['click_action'] = 'FLUTTER_NOTIFICATION_CLICK';

                        foreach($allUserids as $midUser){
                            if($midUser != $idUser){
                                $mIdMemeber = $this->chatModel->createMember($midUser,$idConversation,'N');
                                $mIdUserDets = $this->authModel->getUserDetails($midUser);
                                if($isGroupYN == "Y"){
                                    $txt = $userDetails->name." added ".$mIdUserDets->name;
                                    $chatVal = $this->chatModel->postChat($idMember,$txt,null,'TRANSACTION');   
                                    $memberDetails = $this->chatModel->getMemberDetails($idMember);
                                    $payload['idChat'] = $chatVal->idChat;
                                    $payload['idMember'] = $chatVal->idMember;
                                    $payload['chatText'] = $chatVal->chatText;
                                    $payload['media'] = $chatVal->media;
                                    $payload['chatType'] = $chatVal->chatType;
                                    $payload['createdAt'] = $chatVal->createdAt;
                                    $payload['click_action'] = 'FLUTTER_NOTIFICATION_CLICK';
                                    $payload['convoName'] = $convoDetails->convoName;
                                    $payload['isGroupYN'] = $convoDetails->isGroupYN;
                                    $payload['idUser'] = $memberDetails->idUser;
                                    $this->firebase->sendMessage($title,$body,$payload,$this->TOPIC_PREFIX.$midUser);
                                }
                            }
                        }
                        $this->chatModel->updateLastUpdateconversation($idConversation);
                        $data['Status'] = "SUCCESS";
                    }
                    else{
                        $data['Status'] = "ERROR";
                        $data['Message'] = "Invalid parameters";
                    }
                    http_response_code(200);
                    echo json_encode($data);
                }
                else{
                    $data['Status'] = "ERROR";
                    $data['Message'] = "Invalid method";
                    http_response_code(200);
                    echo json_encode($data);
                }

            }
            else{
                http_response_code(401);
            }
        }
        else{
            http_response_code(401);
        }
    }

}
