<?php
ini_set('display_errors',0);
$colors_array = ['#ff7c10','#ff7c10','#ff7c10','#ff7c10','#ff7c10','#ff7c10'];
$this->load->library('Crypt_RSA');
   $rsa = new Crypt_RSA();
   // echo extract($rsa->createKey());
// $publickey = '-----BEGIN PUBLIC KEY-----
// MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDGCglgIcCG5a8xlZHEDRtQQTc4
// kfxENNBtVN8bE4errA06mJ10WavP2Hg+k11NQip71IQPfIF9jlk1CsqT5ZHXOrOq
// RmufHFLa3fiuPvFiMB1NjK4F28Gk4LwyZrfTWc2V6S0xpL5XkFeWRW6I69xckOXj
// GqkC5dsWv/IlvPeVbwIDAQAB
// -----END PUBLIC KEY-----';
$publickey = $this->config->item('publicKey');
$rsa->loadKey($publickey);


   // echo $ciphertext;



?>
<html>
<head>
    <script src="https://www.gstatic.com/firebasejs/7.22.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.22.1/firebase-messaging.js"></script>

<meta charset="UTF-8">	
  <meta name="keywords" content="HTML,CSS,XML,JavaScript">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.4.1.js"  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="  crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">

<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<style>
.navbar-nav .nav-item-header:nth-of-type(6) {
    background: var(--blue2) !important;
    position: relative;
}
.navbar-nav .nav-item-header:nth-of-type(6)::after {
    position: absolute;
    right: 0;
    top: 0;
    height: 100%;
    width: 3px;
    bottom: 0;
    content: "";
    background: var(--orange1);
}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tokenize2.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tokenize2.js"></script>
<!--   <script type="text/javascript">
      var firebaseConfig = {
    apiKey: "AIzaSyC_JyXX3uMpFiLXbkbGr4WhBsECY3sCFS4",
    authDomain: "personnal-8f7c9.firebaseapp.com",
    databaseURL: "https://personnal-8f7c9.firebaseio.com",
    projectId: "personnal-8f7c9",
    storageBucket: "personnal-8f7c9.appspot.com",
    messagingSenderId: "1060379292734",
    appId: "1:1060379292734:web:d7427124ff401d0d168d6f",
    measurementId: "G-EB151W6QQ8"
  };
  firebase.initializeApp(firebaseConfig);


  const messaging = firebase.messaging();
      messaging.requestPermission().then(()=>{
          console.log("Permission granted");
    })
    .catch((err)=>{

    })

function subscribeTokenToTopic(token, topic) {
  var server_key = "AAAA9uOH9D4:APA91bHlYcXEUwBnzORvoU2tLYKWRjmab4LRLXF57nmPrFuqx3am8OHLf9ynqEg1p4aVnEoi0fhwcmuNS_qDGOC9hMrkmXEzlIJQM4BnR9UHSlDz08cNgbz55xXjrZhCYd2jh8eYmQtw"
  fetch('https://iid.googleapis.com/iid/v1/'+token+'/rel/topics/'+topic, {
    method: 'POST',
    headers: new Headers({
      'Authorization': 'key='+server_key
    })
  }).then(response => {
    if (response.status < 200 || response.status >= 400) {
      throw 'Error subscribing to topic: '+response.status + ' - ' + response.text();
    }
    console.log('Subscribed to "'+topic+'"');
  }).catch(error => {
    console.error(error);
  })
}



messaging.usePublicVapidKey("BGJDAe2YiWVWOyIgcPxHLXAnijA00meTyXrkDiouQV7FkrmMrCyx1eqgzI52hpGnYrTDowe13-rDF1pDycgKTAY");

messaging.getToken().then((currentToken) => {
  console.log(currentToken)
  var idUser = "<?php echo $this->session->userdata('LoginId'); ?>";
  var registrationTokens = [currentToken];
  var topicPrefix = "stage_";
  subscribeTokenToTopic(registrationTokens, idUser)
})


  messaging.onMessage(function(payload) {
    console.log("Message received. ", payload);
  });
  </script> -->
</head>

<body>
<div class="wrapperContainer">
	<?php include 'headerNew.php'; ?>
    <div class="containers noScroll">
		  <div class="chatContainer ">
      <?php 
        // $recentChats = json_decode($recentChats);
        $allUsers = json_decode($allUsers);
        // $currentChat;
        // $currentUserInfo;
        // $groups                
        function sortChat($my_array)
                {
                $c = $my_array->chats;
              for($i=0;$i<count($c);$i++){
                $val = $c[$i];
                $j = $i-1;
                while($j >= 0 && ($c[$j]->createdAt > $val->createdAt)){
                  $c[$j+1] = $c[$j];
                  $j--;
                }
                $c[$j+1] = $val;
              }
              return $c;
            }
        ?>

        <div class="chatMain">
        <!-- Users box-->
          <div class="chatLeft" style="">
            <!--<div class="left_topbar">
              <span class="left_topbar_wrapper">
                <span class="left_topbar_lefticon">
                  <img src="<?php echo base_url('assets/images/icons/user.png') ?>" alt="user image" style="border-radius: 50%" height="32px" width="32px">
                </span>
                <span class="left_topbar_righticon_wrapper">
                  <span class="left_topbar_righticon">
                    <a href="javascript:void(0)" class="left_topbar_righticon_click">
                      <img src="<?php echo base_url('assets/images/icons/more.png') ?>" alt="raindrop icon">
                      <div class="left_topbar_righticon_dropdown">
                        <span id="myBtn" class="user__"> Users</span>
                        <span class="addgroup" >
                          New&nbsp;Group  
                        </span>
                      </div>
                    </a>
                  </span>
                </span>
              </span>
            </div> -->
            <div class="searchbar">
              <span class="searchbar_back">
                <i>
                  <span class="material-icons-outlined">arrow_back</span>
                </i>
              </span>
              <span class="searchbar_wrapper">
                <span class="searchinput_wrapper">
                  <input type="" name="" class="searchinput">
                </span>
              </span>
                <span class="left_topbar_righticon_wrapper">
                  <span class="left_topbar_righticon">
                    <a href="javascript:void(0)" class="left_topbar_righticon_click">
                      <img src="<?php echo base_url('assets/images/icons/more.png') ?>" alt="raindrop icon">
                      <div class="left_topbar_righticon_dropdown">
                        <span id="myBtn" class="user__"> Users</span>
                        <span class="addgroup" >
                          New&nbsp;Group  
                        </span>
                      </div>
                    </a>
                  </span>
                </span>
            </div>
            <!-- Recent Chat  -->
            <div class="recentchat">
              <?php 
              if(isset($recentConversations) && $recentConversations != null && $recentConversations != "" ){
                if(count($recentConversations) > 0){
              foreach($recentConversations as $chat){ ?>
              <span class="recentchat_wrapper"  chatid="<?php echo $chat->idConversation; ?>" memberid="<?php echo $chat->recentChat[0]->idMember ?>" style="cursor:pointer;">
                <span class="recentchat_icon">
                  <?php // if($isGroupYN == 'Y'){ ?>
                    <?php if($chat->convoProfilePic != null && $chat->convoProfilePic != "" ){ ?>
                      <img src="<?php echo base_url('api/uploads/images/conversation/').$chat->convoProfilePic; ?>" height="50px" width="50px" class="left_icon">
                  <?php } ?>
                  <?php if($chat->convoProfilePic == null || $chat->convoProfilePic == "" ){ ?>
                    <span class="icon" style="cursor:pointer;
                      <?php echo "background:".$colors_array[rand(0,5)]?>">
                      <?php echo isset($chat->convoName) ? icon($chat->convoName) : "";?>
                    </span>
                    <?php } ?>
                  <?php // } ?>

                </span>
                <span class="recentchat_tile">
                  <span class="recentchat_text">
                    <div class="recentchat_text_top">
                      <span class="recentchat_title"><?php 
                        if(strlen($chat->convoName) > 13){
                            echo  substr($chat->convoName,0,14)."...";
                        }else{
                          echo $chat->convoName;
                        }
                      ?></span>
                      <?php foreach($chat->recentChat as $rChat){ ?>
                      <span class="recentchat_date_time">
                        <?php
                        if(date('d-m-Y',strtotime($rChat->createdAt)) == date('d-m-Y',strtotime('today'))){
                          $myDateTime = new DateTime(date('Y-m-d h:i:s a',strtotime($rChat->createdAt)), new DateTimeZone('GMT'));
                          // print_r($myDateTime);
                          // $loc = $_SERVER['REMOTE_ADDR'];
                          // $ipInfo = file_get_contents('http://ip-api.com/json/' . $loc);
                          $myDateTime->setTimezone(new DateTimeZone('Asia/Kolkata'));                    
                          // uncomment this
                          // $myDateTime->setTimezone(new DateTimeZone($ipInfo->timezone));
                          echo $myDateTime->format('h:i a');
                          // echo $ipInfo;
                          // echo date('h:i a',strtotime($chat->time));
                        }
                        else
                          echo date('d/m/Y',strtotime($rChat->createdAt));
                      }
                        ?>
                      </span>
                    </div>
                    <div class="recentchat_text_bottom">
                      <?php   ?>
                      <?php  // if($chat->isGroupYN == 'N'){ ?>
                      <span class="recentchat_message"><?php echo ((strlen($rChat->chatText)) <= 25 ? $rChat->chatText : substr($rChat->chatText,0,25)."..."); ?></span>
                    <?php  // }
                    // if($chat->isGroupYN == 'Y'){  ?>
                      <!-- <span class="recentchat_message"><?php //echo array_slice(explode(" ",$chat->senderName),0,1)[0].": ".((strlen($chat->chatText)) <= 15 ? $chat->chatText : substr($chat->chatText,0,15)."..."); ?></span> -->
                    <?php // } ?>
                    </div>
                  </span>
                </span>
              </span>
              <?php } }else{ ?>
                <div class="no_messages_wrapper">
                  <span class="no_messages">No Recent Chats</span>
                </div>;
              <?php } } ?>
            </div>
            <!-- Recent Chat -->

            <!-- All Users List -->
            <div class="allUsersList"><!-- class="recentchat" -->
              <?php 
              foreach ($allUsers->users as $user) { ?>
                <!-- onclick="createNewChat('<?php echo $user->userid ?>','<?php echo $user->username ?>')" -->
              <span class="allUsersList_wrapper" repeat-check="<?php echo $user->userid ?>" group="N" onclick="getConversation('<?php echo $user->userid ?>','<?php echo $user->username ?>')">
                <span class="allUsersList_userIcon">
                  <span class="icon" style="
                    <?php echo "background:".$colors_array[rand(0,5)]?>">
                    <?php echo isset($user->username) ? icon($user->username) : "";?>
                  </span>
                </span>
                <span class="recentchat_tile">
                  <span class="recentchat_text">
                    <div class="recentchat_text_top">
                      <span class="recentchat_title allUsersList_title"><?php 
                        if(strlen($user->username) > 16){
                          echo substr($user->username,0,17)."..";
                        }
                        else{
                          echo $user->username;
                        }
                          ?></span>
                    </div>
                  </span>
                </span>
              </span>
              <?php } ?>
            </div>
            <!-- All Users List -->

            <!-- Create group user list -->
            <div class="groupNameClass">
              <span><input type="text" name="" placeholder="Enter Group Name" class="groupNameInput"></span>
            </div>
            <div class="createGroupUsersList"><!-- class="recentchat" -->
              <?php foreach ($allUsers->users as $user) { ?>
              <span class="createGroupUsersList_wrapper" userId="<?php echo $user->userid; ?>">
                <span class="allUsersList_userIcon">
                  <span class=" icon" style="
                    <?php echo "background:".$colors_array[rand(0,5)]?>">
                    <?php echo isset($user->username) ? icon($user->username) : "";?>
                  </span>
                </span>
                <span class="recentchat_tile">
                  <span class="recentchat_text">
                    <div class="recentchat_text_top">
                      <span class="recentchat_title createGroupUsersList_title"><?php echo $user->username; ?></span>
                    </div>
                  </span>
                </span>
              </span>
              <?php } ?>
            </div>
            <div class="createGroupClass">
              <span class="createGroupClass">
                <i class="createGroupClass_wrapper" style="border-radius: 50%;background:rgba(0,200,0,0.2);padding:0.35rem;">
                  <img src="<?php echo base_url('assets/images/icons/right-arrow.png'); ?>" width="32px" height="32px">
                </i>
              </span>
            </div>
            <!-- Create group user list -->

          </div>

      <!-- 
        <div class="group-box col-sm-12 col-md-7"></div> -->
          <!--  -------------------------
                      Chat Box
          ---------------------------   -->	
    <div class="px-0 col-sm-12 col-md-9 messenger_center_box" style="min-height:100vh;word-break: break-word">
    <div class="messageLeft">
      <?php   
            $getChat = isset($getChat) ? json_decode($getChat) : "";
            $getConversation = isset($getConversation) ? json_decode($getConversation) : ""; 
      ?>
  <div  class="media headind_srchs" 
        user_id="<?php echo isset($getConversation->conversation->idConversation) ? $getConversation->conversation->idConversation : "" ; ?>" 
        group="<?php echo isset($getConversation->conversation->isGroupYN) ? $getConversation->conversation->isGroupYN : "" ; ?>" idMember="<?php 
        if(isset($getConversation->members) && $getConversation->members != null){
          foreach($getConversation->members as $gC){
            if($gC->idUser == $this->session->userdata('LoginId')){
              echo $gC->idMember;
            }
          }
        } ?>">
    <!-- <i class="message-back"></i> -->
    <span>
    <a href="javascript:void(0);" id="contact_us">
  	<?php
      if(isset($getConversation->conversation->convoProfilePic)){
        if($getConversation->conversation->convoProfilePic == null || $getConversation->conversation->convoProfilePic == ""){ ?>
          <span class=" icon" style="
                <?php echo "background:".$colors_array[rand(0,5)]?>">
            <?php echo isset($getConversation->conversation->convoName) ? icon($getConversation->conversation->convoName) : "";?>
          </span>
          <?php  } 
          if($getConversation->conversation->convoProfilePic != "" && $getConversation->conversation->convoProfilePic != null){
              ?>
            <img src="<?php if(isset($getConversation->conversation->convoProfilePic)){ ?>
               <?php echo base_url('api/uploads/images/conversation/').$getConversation->conversation->convoProfilePic; } ?>" alt="user" width="25px" height="25px" class="rounded-circle">
               <?php } }else{ ?>
              <span class="icon-parent">
                <span class=" icon" style="
                  <?php echo "background:".$colors_array[rand(0,5)]?>">
                  <?php echo isset($getConversation->conversation->convoName) ? icon($getConversation->conversation->convoName) : "";?>
                </span>
              </span>
        <?php   }
            // if(isset($currentUserInfo->groupName) ? $currentUserInfo->groupName : null != null){
            //   print_r($currentUserInfo->groupName);
            // }
            ?>
    	</a>
  	  <p class="text-capitalize"
         style="margin:0; font-size:18px; font-weight:500; padding:0 0 0 10px; color: #000;"
         user_id="<?php echo isset($getConversation->conversation->idConversation) ? $getConversation->conversation->idConversation : "" ; ?>" 
         group="<?php echo isset($getConversation->conversation->isGroupYN) ? $getConversation->conversation->isGroupYN : "" ; ?>">
  		<?php 
        if(isset($getConversation->conversation->isGroupYN) ? $getConversation->conversation->isGroupYN : ""  == "N")
          {
          if(isset($getConversation->conversation->convoName)){

            echo $getConversation->conversation->convoName;
          }}
          else{
            if(isset($getConversation->conversation->convoName)){
              echo $getConversation->conversation->convoName;
            }
          } 
        ?>
    	</p>
        </span>
    <i style="padding-right:1rem;cursor: pointer;" class="info_icon"><span class="material-icons-outlined">info</span></i>
    </div>

    <div class="px-4 py-5 chat-box bg-light">
        <!-- Sender Message-->
		<?php
    
    $currentTextDate = "00-00-0000";
    if(isset($getChat->chats)){
        $getChat = sortChat($getChat);
      foreach ($getChat as $chats) { 
        $date=date_create($chats->createdAt);
        if($currentTextDate == date('Y-m-d',strtotime($chats->createdAt))){

          }else{
            $currentTextDate = date('Y-m-d',strtotime($chats->createdAt));
            $dateNeedeFormat = date('d M Y',strtotime($currentTextDate));
            echo "<div class='currentTextDate_center'><span class='currentTextDate_centerbox'><strong>$dateNeedeFormat</strong></span></div>";
          }
        if($chats->chatType == 'TRANSACTION'){
          echo "<div class='currentTextDate_center'><span class='currentTextDate_centerbox'>$chats->chatText</span></div>";
        }
        if($chats->chatType != 'TRANSACTION'){
           ?>
        <div class="media 
                    <?php if( $this->session->userdata('LoginId') == $chats->idUser ){
                       echo "sender-rightalign"; 
                     }else{
                      echo "sender-leftalign";
        } ?>">
        <!--     <img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="30" class="rounded-circle"> -->
          <div class="
                <?php if( ($this->session->userdata('LoginId') == $chats->idUser) ){
                       echo "sender-right"; 
                     }
                     else{
                        echo "sender-left";
                     } ?>">
            <p class="text-small-chat mb-0 font-weight-bold">
               <!--  <a class="name-chat-box">
                  <?php 
                  if( $this->session->userdata('LoginId') == $chats->senderId ){
                    echo $this->session->userdata('Name');
                  }else{
                    echo ucfirst($chats->senderId);
                  }
                  ?>
                </a>  -->
               
            </p>
          <div class=" rounded ">
            <?php if((isset($getConversation->conversation->isGroupYN) ? $getConversation->conversation->isGroupYN : "")  == 'Y'){ ?>
              <span><?php 
                if($chats->idUser != $this->session->userdata('LoginId')){
                  foreach($getConversation->members as $member){
                    if($member->deletedDate == null && ($member->idUser == $chats->idUser)){
                      echo $member->DisplayName; 
                    }
                  }
                } ?>
              </span>
            <?php } ?>
            <p class="text-small-chat-message mb-0 ">
              <?php
                   echo $chats->chatText;
//                 try{
//               if(is_string($rsa->decrypt(base64_decode($chats->chatText))) == 1){
// $expression = "/(http|ftp|https):\/\/([\w_-]+(?:(?:\.[\w_-]+)+))([\w.,@?^=%&:\/~+#-]*[\w@?^=%&\/~+#-])?/i";
// $string = $rsa->decrypt(base64_decode($chats->chatText));
//                 if(preg_match($expression,$string) == 1){
//                   echo '<img src="'.$string.'">';
//                 }elseif(preg_match('/data:image/i',$string) == 1){
//                   echo '<img src="'.$string.'">';
//                 }else{
//                   echo $string;
//                 }
//                 if($chats->mediaContent != null && $chats->mediaContent != ''){
//                   echo '<img src="data:image/png;base64,'.$chats->mediaContent.'">';
//                 }
//               } 
//               else{
//                 throw new Exception('Invalid Type');
//               }
//                 }
//                 catch(Exception $e){
//                     echo 'Not Known';
//                 }


                ?>
            </p>
            <small class=" chat-message-time"><?php 
            $myDateTime = new DateTime(date('Y-m-d h:i:s a',strtotime($chats->createdAt)), new DateTimeZone('GMT'));
                    // $loc = $_SERVER['REMOTE_ADDR'];
                    // $ipInfo = file_get_contents('http://ip-api.com/json/' . $loc);
                    $myDateTime->setTimezone(new DateTimeZone('Asia/Kolkata'));                    
                    // uncomment this
                    // $myDateTime->setTimezone(new DateTimeZone($ipInfo->timezone));
                    echo $myDateTime->format('h:i a');
              ?></small>
          </div>
        </div>
      </div>
      <?php }}}?>	


        <!-- Reciever Message-->
        <!--<div class="media w-50 ml-auto mb-3">
          <div class="media-body">
            <div class="bg-primary rounded py-2 px-3 mb-2">
              <p class="text-small mb-0 text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
            </div>
            <p class="small text-muted">12:00 PM | Jan 17</p>
          </div>
        </div>-->

       

    </div>

      <!-- Typing area -->
    <!-- <form class="d-flex" id="chatForm" onsubmit="stopSubmit()"> -->
      <span class="attach_file">
        <!-- <img src="<?php echo site_url().'assets/images/icons/clip.png'; ?>" id="upload_attachment"> -->
        <input type="file" name="upload_image" id="upload_image" onchange="validate()">
      </span>
      <div class="input-group">
        <input type="text"
               id="chatText" 
               name="chatText" 
               placeholder="Type message here.."  
               class="form-control  bg-white">
        <div class="receiver_details">
          <input type="hidden" name="receiverId" id="receiverId" value="<?php ?>">
          <input type="hidden" name="isGroupYN" id="isGroupYN" value="<?php ?>">
        </div>
        <div class="input-group-append">
            <!--<button id="button-addon2" type="submit" class="btn btn-link"> <i class="fa fa-paper-plane"></i></button>-->
      		<button type="button" class="msg_send_btn" idMember="<?php 
          if(isset($getConversation->members)){
          foreach($getConversation->members as $mem ){
            if($mem->idUser == $this->session->userdata('LoginId')){
              echo $mem->idMember;
                }
              } 
            }?>">
            <span class="material-icons-outlined">send</span>
          </button>
        </div>
      </div>
    <!-- </form> -->
    </div>

<!-- side nav start-->

  <div class="col-sm-12 col-md-3 right_box">
    <div class="right_top_tab">
      <span class="right_top_tab_close">
      <span class="material-icons-outlined">highlight_off</span>
      </span>
      <span class="right_top_tab_info"></span>
    </div>
    <div class="right_user_icon">
      <div class="user_icon_wrapper">
        <span class="user_icon_view">
        <?php if(isset($getConversation->conversation->isGroupYN) && ($getConversation->conversation->isGroupYN == 'Y')){ ?>
          <span class="wrapper_on_hover">
          <?php } ?>
            <i class="wrapper_image_wrapper">
            <span class="material-icons-outlined wrapper_image">photo_camera</span>
            </i>
            <?php if(isset($getConversation->conversation->isGroupYN) && ($getConversation->conversation->isGroupYN == 'Y')){ ?>
          </span>
          <?php }
          if(isset($getConversation->conversation)){
          if($getConversation->conversation->convoProfilePic != null && $getConversation->conversation->convoProfilePic != ""){ ?>
          <img src="<?php echo base_url('api/uploads/images/conversation/').$getConversation->conversation->convoProfilePic; ?>" id="imagePreview">
        <?php }if($getConversation->conversation->convoProfilePic == null || $getConversation->conversation->convoProfilePic == ""){ ?>
          <span class="alphabetIcon">
            <?php 
                  if($getConversation->conversation->isGroupYN == "N")
                    {
                      if(isset($getConversation->conversation->convoName)){
                         echo icon($getConversation->conversation->convoName);
                      }
                    }
                  else{
                    if(isset($getConversation->conversation->convoName)){
                       echo icon($getConversation->conversation->convoName);
                    }
                  } 
             ?>
          </span>
          <?php } }?>
        </span>
      </div>
      <div class="user_name_wrapper">
        <span class="user_name_view" id="user_name_view" conversationid="<?php echo isset($getConversation->conversation->idConversation) ? $getConversation->conversation->idConversation : '' ?>">
            <?php if((isset($getConversation->conversation->isGroupYN) ? $getConversation->conversation->isGroupYN : "") == "N")
                    {
                        echo $getConversation->conversation->convoName;
                    }
                  else{
                    if(isset($getConversation->conversation->convoName)){
                       echo ($getConversation->conversation->convoName."<i onclick='groupName(this)' id='groupIdI' groupId=".$getConversation->conversation->convoName.">&nbsp;<span class='material-icons-outlined'>edit</span></i>");
                    }
                  } ?>
        </span>
        <span class="user_title_view">
          <input type="file" name="editGroupImage" id="editGroupImage" style="display: none">
          <!-- <span class="editGroupImageSave">save</span> -->
             <?php //if((isset($getConversation->conversation->isGroupYN) ? $getConversation->conversation->isGroupYN : "") == "N")
            //         {
            //           if(isset($currentUserInfo->designation)){
            //              echo ($currentUserInfo->designation);
            //           }
            //         }
            //       else{
            //         if(isset($currentUserInfo->designation)){
            //            echo ($currentUserInfo->designation);
            //         }
            //       } ?>
        </span>
      </div>
    </div>
    <?php if((isset($currentUserInfo->groups) && count($currentUserInfo->groups) > 0) || (isset($getConversation->members)) && count($getConversation->members) > 0 ) { ?>
    <div class="boxcategory">
      <span class="boxcategoryTitle">
        <?php 

        if((isset($currentUserInfo->groups) && count($currentUserInfo->groups) > 0)){
              echo "Common Groups";
            }
            if(isset($getConversation->members) && (count($getConversation->members) > 0 ) && $getConversation->conversation->isGroupYN == 'Y'){
            echo "<span class='members_title'>Members"; 
        $AdminId = "";
        foreach($getConversation->members as $members){
          if($this->session->userdata('LoginId') == $members->idUser && $members->isAdminYN == 'Y'){
            $AdminId = $this->session->userdata('LoginId');
          }
        }
        if($AdminId == $this->session->userdata('LoginId')){
            ?>
            <span class="members_add"><span class="material-icons-outlined" style="cursor:pointer;">add_circle_outline</span></span>
        <?php }
            }
          }        
        ?>
      </span>
      <div class="boxcategory_wrapper">
        <?php 
      if((isset($currentUserInfo->groups) && count($currentUserInfo->groups) > 0)){
        foreach($currentUserInfo->groups as $commongroup){ ?>
        <span class="commonGroups_wrapper" >
          <span class="commonGroups_userIcon">
            <span class=" icon" style="
              <?php echo "background:".$colors_array[rand(0,5)]?>">
              <?php echo isset($commongroup->groupName) ? icon($commongroup->groupName) : "";?>
            </span>
          </span>
          <span class="commonGroups_tile">
            <span class="commonGroups_text">
              <div class="commonGroups_text_top">
                <span class="commonGroups_title"><?php 
                  if( strlen($commongroup->groupName) > 16){
                    echo substr($commongroup->groupName,0,17)."..";
                  }
                  else{
                   echo $commongroup->groupName;
                  }
                     ?></span>
              </div>
            </span>
          </span>
        </span>
          <!-- ---------- -->
<!--         <span class="elementOfCategory">
          <span class="elementIcon">
            <span class="elementIconView"><?php echo $commongroup->groupName ?></span>
          </span>
          <span class="elementDescription">
            <span class="elementText"></span>
          </span>
        </span> -->
      <?php } } ?>
        <?php 
      if((isset($getConversation->members) && count($getConversation->members) > 0) && $getConversation->conversation->isGroupYN == 'Y'){
        foreach($getConversation->members as $members){
          if($members->deletedDate == null){
         ?>
          <span class="groupMembers_wrapper" userid="<?php echo $members->idUser ?>">
            <span>
              <span class="groupMembers_userIcon">
                <span class=" icon" style="
                  <?php echo "background:".$colors_array[rand(0,5)]?>">
                  <?php 
                    if(isset($members->convoProfilePic)){
                      echo "<img src=".base_url()."api/uploads/images/conversation/".$members->convoProfilePic.">";
                    }{
                  echo isset($members->DisplayName) ? icon($members->DisplayName) : ""; }?>
                </span>
              </span>
              <span class="groupMembers_tile">
                <span class="groupMembers_text">
                  <div class="groupMembers_text_top">
                    <span class="groupMembers_title"><?php 
                      if( strlen($members->DisplayName) > 16){
                        echo substr($members->DisplayName,0,17)."..";
                      }
                      else{
                      echo $members->DisplayName;
                      }
                        ?></span>
                  </div>
                </span>
              </span>
            </span>
            <?php if($this->session->has_userdata('LoginId')){

           if($AdminId == $this->session->userdata('LoginId')){
              if($this->session->userdata('LoginId') == $AdminId && $this->session->userdata('LoginId') != $members->idUser && $members->isAdminYN == 'N'){ 
                ?>
                <span class="user_group_options_icons" >
                  <i class="deleteUserFromGroup" memberid="<?php echo $members->idUser ?>" idMember="<?php echo $members->idMember ?>" groupid="<?php echo $getConversation->conversation->idConversation ?>" style="cursor:pointer;">
                  <span class="material-icons-outlined">delete</span>
                  </i>
                </span>
            <?php  }
             } ?>
          </span>
<!--           <span class="angle_downward">
            <span>
              <i>
                <img src="<?php echo base_url('assets/images/icons/angle_downward.png');?>" width="15px" height="15px">
              </i>
            </span>
            <span style="" class="remove_user_block">
              Remove
            </span>
          </span> -->
      <?php } }  } ?>
      </div>
    </div>
    <?php } ?>
    <?php if(isset($getConversation->conversation->isGroupYN) && $getConversation->conversation->isGroupYN== "Y"){ ?>
    <div class="groupOptions">
        <?php 
        foreach($getConversation->members as $mems){
        if((($mems->idUser) == ($this->session->userdata('LoginId'))) && ($mems->isAdminYN == 'Y') ){ ?>
      <!-- <div>
        <span class="delete_group" groupId="<?php echo $getConversation->conversation->idConversation; ?>">Delete Group</span>
      </div> -->
    <?php }  ?>
      <?php if((($mems->idUser) == ($this->session->userdata('LoginId'))) && ($mems->isAdminYN == 'N') ){ ?>
    <div>
      <span class="leave_group" groupId="<?php echo $getConversation->conversation->idConversation; ?>" userId="<?php echo  $mems->idUser ?>" >Leave Group</span>
    </div>
  <?php } } ?>
    </div>
  <?php } ?>
  </div>

  </div>
<!-- side nav end-->
  </div>
</div>





		<!-- add to group model -->
			<div class="modal fade" id="addtogroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
						  <div class="modal-header" style="border-bottom:none;">
							<h5 class="modal-title" id="exampleModalLongTitle" style="color: #2196f3;">Add New Group</h5>
					  </div>
					<div class="modal-body">
					  <div class="container-fluid">
						<form id="groupForm" method="post" action="<?php echo base_url().'messenger/creategroup';?>">
						  <div class="form-group">
						  <div class="row">
						 
							 <div class="col-md-4"><label for="recipient-name" class="col-form-label"  style="float:right;">Group Name</label></div>
							 <div class="col-md-8" style="float:left;">
                <input type="text" class="form-control" name="recipient-name" id="recipient-name" required style="border-radius:0;background-color:#fff;border:none;">
							  <div class="col-md-12" style="color: red;" id="groupNameErr"></div>
							 </div>
						  </div>
						  </div>
						  <hr>
						  <div class="search-table">

			<div class="search-list">
        <select class="tokenize_class" name="tokenize_class[]" multiple>
					<?php
                     foreach ($allUsers->users as $chat) {
                      if($chat->imageUrl == null || $chat->imageUrl == ""){
                        $chat->imageUrl = base_url().'assets/images/defaultUser.png';
                      }else{}
                    ?>					
                      <option value="<?php echo $chat->userid; ?>"><?php echo $chat->username;?></option>
                  <?php } ?>
        </select>
                </div>
					<?php 	?>

            </div>
						  </div>
						  
					<div class="text-center mt-2 mb-4">
						<button class="btn btn-secondary rounded-0 button" type="button" onclick="saveGroup()">Save</button>
						<button class="btn btn-secondary rounded-0 button" type="button" data-dismiss="modal">Cancel</button> 
					</div> 
						  
						</form>
					  </div>
					  
					</div>
					
						  
						  
						</div>
					  </div>
				</div>
		<!-- add to group model end -->

  <div class="modal-logout">
    <div class="modal-content-logout">
      <h3>You have been logged out!!</h3>
      <h4><a href="<?php echo base_url(); ?>">Click here</a> to login</h4>      
    </div>
  </div>
<!-- User Modal -->
<div id="usersModal" class="usersModal modalNew">
  <div class="usersModalContent">
    <h1>Users</h1>
    <div>
      <?php foreach($allUsers->users as $user_){ ?>
        <span class="d-block" ><?php echo $user_->username; ?></span>
      <?php } ?>
    </div>
    <button id="accept" class="user__">
      Close
    </button>
  </div>
</div>
<!-- User Modal -->

<!-- Add User Modal -->
<div id="addUsersModal" class="addUsersModal modalNew">
  <div class="modal-dialog mw-40">
    <div class="addUsersModalContent modal-content NewFormDesign">
      <div class="addUsersModalContent_addMember modal-header ">
        <h3 class="modal-title ">Add Member</h3>
      </div>
      <div class="modal-body">
        <div class="addUsersModule_div form-floating">
          <select  class="addMember form-control" name="addMember[]" multiple>
          <?php foreach($allUsers->users as $user__){ ?>
            <option class="d-block" value="<?php echo $user__->userid ?>"><?php echo $user__->username; ?></option>
          <?php } ?>
          </select>
        </div>
        <div class="addUsersModal_buttons modal-footer">
          <button id="reject" class="addUser__close btn btn-default btn-small">Close</button>
          <button id="accept" class="addUser__save btn btn-default btn-small btnOrange">Save</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Add User Modal -->

<!-- Notification -->
<div class="notify_">
	<div class="note">
		<div class="notify_body">
			<span class="_notify_message"></span>
			<span class="_notify_close" onclick="closeNotification()">&times;</span>
    	</div>
	</div>
</div>
<!-- Notification -->
<!-- Loader -->
<div class="loading">
  <div class="loader"></div>
</div>

</div>

</div>
<!--  Loader -->
</body>

<script type="text/javascript">

var usersModal = document.getElementsByClassName('recentchat')[0];
var btn = document.getElementById("myBtn");
var accept = $('.searchbar_back')[0];
var newGroup = $('.addgroup')[0]
btn.onclick = function() {
  usersModal.style.display = "none";
  $('.searchbar_back').css('display','inline-block')
  $('.searchbar').css('justify-content','space-around')
  $('.groupNameClass').css('display','none')
  $('.createGroupUsersList').css('display','none')
  $('.createGroupClass').css('display','none')
  $('.allUsersList').css('display','flex')
}
accept.onclick = function() {
  usersModal.style.display = "block";
  $('.searchbar_back').css('display','none')
  $('.searchbar').css('justify-content','center');
  $('.groupNameClass').css('display','none')
  $('.createGroupUsersList').css('display','none')
  $('.createGroupClass').css('display','none')
}
newGroup.onclick = function(){
  usersModal.style.display = "none";
  $('.allUsersList').css('display','none')
  $('.groupNameClass').css('display','inline-block')
  $('.createGroupUsersList').css('display','inline-block')
  $('.createGroupClass').css('display','flex')
  $('.searchbar_back').css('display','inline-block')
  $('.searchbar').css('justify-content','space-around');
}
  // height , width of the container
  $(document).ready(()=>{
    $('.container').css('paddingLeft',$('.side-nav').width());
    var containerHeight = "100vh" - $('.header-top').height();
   // document.getElementsByClassName("container").style.maxHeight = "50vh"
  })

	
	// dropdowns
		
		$(document).ready(function(){
		$(".dropdown").hover(            
			function() {
				$('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideDown("fast");
				$(this).toggleClass('open');        
			},
			function() {
				$('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideUp("fast");
				$(this).toggleClass('open');       
			}
		);
	});

	//side bar open close
		$(document).ready(function(){
	  $('#contact_us').click(function(){
		$('.sidebar').toggleClass('active')
		$('.toggle').toggleClass('active')
	  })
	  
	  
		$('#contact_close').click(function(){
		$('.sidebar').toggleClass('active')
		$('.toggle').toggleClass('active')
	  })
	})

	//upload image
	$("input[type='image']").click(function() {
		$("input[id='my_file']").click();
	});
	
	//inline edit group name
$('.edit').click(function(){
  $(this).hide();
  $('.editbox').addClass('editable');
  $('.text').attr('contenteditable', 'true');  
  $('.save').show();
});

$('.save').click(function(){
  $(this).hide();
  $('.editbox').removeClass('editable');
  $('.text').removeAttr('contenteditable');
  $('.edit').show();
});
	

  $(document).ready(function(){
    $(document).on('click','.list-group-item',function(){
      $('.leftbar-sm').css('display','none');
    })
  })

  $(document).on('click','.angle_downward',function(){
    $('.remove_user_block').eq($(this).index()).css('display','block');
  })

    var base_url = "<?php echo base_url();?>";
    function loadNewChat(userid,isGroupYN){
        var url = '<?php echo base_url() ?>messenger/chat/'+userid+'/'+isGroupYN;
        $.ajax({
          url : url,
          type : 'GET',
          success : function(response){
            // $('.messenger_center_box').htm l($(response).find('.messenger_center_box').html())
            $('.right_box').html($(response).find('.right_box').html())
            // $('.chat-box').scrollTop($('.chat-box')[0].scrollHeight)
            console.log('changed')
            $('.media.headind_srchs').html($(response).find('.media.headind_srchs').html())
            $('.chat-box').html($(response).find('.chat-box').html())
            $('.recentchat').html($(response).find('.recentchat').html())
            $('.receiver_details').html($(response).find('.receiver_details').html())
          }
        })
    }

        $(document).on('change','#editGroupImage',function () {
          readURL(this);
          console.log($(this).val())
        });

      $(document).on('click','.editGroupImageSave',function(){
        var url = '<?php echo base_url() ?>messenger/postConversation';
        var allUserids = [];
          $('.groupMembers_wrapper').each(function(){
            if($(this).attr('userid') != null && $(this).attr('userid') != ""){
              allUserids.push($(this).attr('userid'))
            }
          })
        var isGroupYN = 'Y';
        var idConversation = $('#user_name_view').attr('conversationid');
        var fd = new FormData();
        var files = $('#editGroupImage').prop('files')[0];
        fd.append('convoProfilePic',files);
        fd.append('isGroupYN',isGroupYN);
        fd.append('idConversation',idConversation);
        $.ajax({
          url : url,
          type : 'POST',
          data : fd,
          contentType: false,
          processData: false,
          success :  function(response){
            alert(response);
            // console.log(response);
            // window.location.reload()
          }
        })
      })

      $(document).on('click','.wrapper_image',function(){
        var doc = document.getElementById('editGroupImage');
          doc.click()
        var wrapper_image = $('.wrapper_image_wrapper').html();
        var OkAndCancel = `<div class="dynamic_icons"><img src="<?php echo base_url('assets/images/icons/tick_white.png') ?>" height="32px" width="25px" class="dynamic_icons_save editGroupImageSave"><img src="<?php echo base_url('assets/images/icons/x_white.png'); ?>" height="26px" width="25px" class="dynamic_icons_cancel"></div>`;
        $(".user_icon_view").addClass("edit");
        $('.wrapper_image_wrapper').empty();
        $('.wrapper_image_wrapper').html(OkAndCancel);
        
        $(document).on('click','.dynamic_icons_cancel',function(){
            $('.wrapper_image_wrapper').empty();
            $(".user_icon_view").removeClass("edit");
            $('.wrapper_image_wrapper').html(wrapper_image);
          })
      })

    $(document).on('click','.right_top_tab_close',function(){
      $('.messenger_center_box')[0].classList.remove('col-md-6');
      $('.right_box').css('display','none');
      $('.messenger_center_box')[0].classList.add('col-md-9');
    })

    $(document).on('click','.text-capitalize, .contact_us, .info_icon',function(){
      $('.messenger_center_box')[0].classList.remove('col-md-9');
      $('.right_box').css('display','flex');
      $('.messenger_center_box')[0].classList.add('col-md-6');
    })


    function searchRecentChats(){
      var chats = $('.recentchat_title').length;
      var allUsers = $('.allUsersList_title').length;
      var allGroupUsers = $('.createGroupUsersList_title').length;
      var searchText = $('.searchinput').val();
      for(var i=0;i<chats;i++ ){
          if ( ($('.recentchat_title').eq(i).text().search(new RegExp(searchText, "i")) < 0)) {
              $('.recentchat_wrapper').eq(i).fadeOut();
           } else {
              $('.recentchat_wrapper').eq(i).show();
          }
      }
      for(var j=0;j<allUsers;j++ ){
          if ( ($('.allUsersList_title').eq(j).text().search(new RegExp(searchText, "i")) < 0)) {
              $('.allUsersList_wrapper').eq(j).fadeOut();
           } else {
              $('.allUsersList_wrapper').eq(j).show();
          }
      }
      for(var k=0;k<allGroupUsers;k++ ){
          if ( ($('.createGroupUsersList_title').eq(k).text().search(new RegExp(searchText, "i")) < 0)) {
              $('.createGroupUsersList_wrapper').eq(k).fadeOut();
           } else {
              $('.createGroupUsersList_wrapper').eq(k).show();
          }
      }
    }
    $(document).on('keyup','.searchinput',function(){
      searchRecentChats()
    })

    $(document).on('click','.msg_send_btn',function(e){
      e.preventDefault();
      var url = "<?php echo base_url('messenger/postMessage');?>";
      // var receiverId = $('#receiverId').val();
      var idMember = $('button[class="msg_send_btn"]').attr('idMember');
      // var isGroupYN = $('#isGroupYN').val();
      var chatText = $('#chatText').val();
      var senderName = "<?php echo $this->session->userdata('Name') ?>";
      var image = $('#upload_image')[0].files[0];
      var form_data = new FormData();
      var media = null;
      form_data.append('upload_image',image);
            var date = new Date();
            var code = `<div class="media sender-rightalign">
                          <div class="sender-right">
                            <div class=" rounded ">
                              <p class="text-small-chat-message mb-0 ">${chatText}</p>
                              <small class=" chat-message-time">${date.getHours()}:${date.getMinutes()}</small>
                            </div>
                          </div>
                        </div>`
                        $('.chat-box').append(code)
                   $('#chatText').val('')  
      // if(image != "" && image != null){
      //   $.ajax({
      //     url : url,
      //     contentType: false,
      //     processData: false,
      //     data : form_data,
      //     type : 'POST',
      //     success : function(response){
      //       console.log(response)
      //       var date = new Date();
      //       var code = `<div class="media sender-rightalign">
      //                     <div class="sender-right">
      //                       <div class=" rounded ">
      //                         <p class="text-small-chat-message mb-0 ">${image}</p>
      //                         <small class=" chat-message-time">${date.getHours()}:${date.getMinutes()}</small>
      //                       </div>
      //                     </div>
      //                   </div>`
      //                   $('.chat-box').append(code)
      //              $('#chatText').val('')   
      //     }
      //   })
      // }
      if(chatText != "" && chatText != null){
        $.ajax({
          method : 'POST',
          url : url,
          data : {
            idMember : idMember,
            media : media,
            chatText : chatText,
            senderName : senderName
          },
          success : function(response){
            console.log(response)
 
          }
        })
      }
    })
      /*
      ----------------LEAVE GROUP-------------------
      */
    function leaveGroup(groupId){
      var bool = confirm('Are you sure you want to leave this group?');
      if(bool == true){
        var groupId = groupId;
        var isGroupYN = 'Y';
        var url = '<?php echo base_url() ?>messenger/exitGroup';
        $.ajax({
          url : url,
          data : {
            groupId:groupId
          },
          type : 'POST',
          success : function(response){
            console.log(response)
            window.location.reload()
          }
        })
      }
    }

    function loadChatElements(){
      var userId = $('.text-capitalize').attr('user_id')
      var url = '<?php echo base_url() ?>messenger/chat/'+userId;
      $.ajax({
        url : url,
        type : 'GET',
        success : function(response){
          // $('.messenger_center_box').html($(response).find('.messenger_center_box').html())
          // $('.right_box').html($(response).find('.right_box').html())
          // $('.chat-box').scrollTop($('.chat-box')[0].scrollHeight)
          console.log('changed')
          $('.media.headind_srchs').html($(response).find('.media.headind_srchs').html())
          $('.chat-box').html($(response).find('.chat-box').html())
          $('.recentchat').html($(response).find('.recentchat').html())
          $('.receiver_details').html($(response).find('.receiver_details').html())
          searchRecentChats()
        }
      })
    }

// Notification //
function showNotification(){
      $('.notify_').css('visibility','visible');
    }
    function addMessageToNotification(message){
    	if($('.notify_').css('visibility') == 'hidden'){
     		$('._notify_message').append(`<li>${message}</li>`)
    	}
    }
    function closeNotification(){
      $('.notify_').css('visibility','hidden');
      $('._notify_message').empty();
    }
  // Notification //

    $(document).ready(function(){
      setInterval(loadChatElements,5000)
    })

    function saveGroup(){
      var groupName = document.getElementById("recipient-name").value;
      if(groupName == ""){
        document.getElementById("groupNameErr").innerHTML = "Group name required <i class='fas fa-exclamation-triangle' style='font-size:13px;'></i>";
      }
      else{
        document.getElementById("groupForm").submit();
      }
    }

    function exitGroup(){
      document.getElementById("exitGroupForm").submit();
    }

    function deleteGroup(){
      document.getElementById("deleteGroupForm").submit();
    }

    function sendMessage(){
      var text = document.getElementById("chatText").value;
      if(text != "" || $('#upload_image')[0].files[0].name != ""){
        document.getElementById("chatForm").submit();
      }
    }

    $(document).ready(function(){
      $(document).on('click','.delete_group',function(){
        var url = '<?php echo base_url('messenger/deleteGroup') ?>';
        var userid = '<?php echo $this->session->userdata('LoginId'); ?>';
        var groupId = $(this).attr('groupId');
        var bool = confirm(' Are you sure you want to delete this group ?')
        if(bool){
        $.ajax({
            url : url,
            data : {
              groupId : groupId,
              userid : userid
            },
            type : 'POST',
            success : function(response){
              loadChatElements()
            }
          })
        }
      })
    })
  </script>

<?php if( isset($error) != null){ ?>
 <script type="text/javascript">
    
   var modal = document.querySelector(".modal-logout");
   
    function toggleModal() {
        modal.classList.toggle("show-modal");
    }

$(document).ready(function(){
    toggleModal();  
  })
  </script>
<?php }
else{

};
?>
<script type="text/javascript">
  function validate(){
    var fileType = $('#upload_image').val();
    var allowedTypes = /(\.jpg)$|(\.jpeg)$|(\.png)$/i;
    if(!allowedTypes.exec(fileType)){
      $('#upload_image').val(''); 
      alert('Please choose from Jpeg | Jpg |PNG')
      return false;
    }
  }

  $(document).ready(function(){
    $('.tokenize_class').tokenize2();
    $('.addMember').tokenize2();
  })

  /* ---------------------------------------
              UPDATED MESSENGER JS
     --------------------------------------- */

    function loadNewChat(chatId){
      var url = '<?php echo base_url() ?>messenger/chat/'+chatId;
      $.ajax({
        url : url,
        type : 'GET',
        success : function(response){
          $('.messenger_center_box').html($(response).find('.messenger_center_box').html())
          $('.right_box').html($(response).find('.right_box').html())
          $('.chat-box').scrollTop($('.chat-box')[0].scrollHeight)
        }
      })
    }

    function lastSeen(isDeletedYN,idMember,idConversation,idOtherUser=null){
      var url = '<?php echo base_url() ?>messenger/updateMember';
      var isDeletedYN = isDeletedYN;
      var isAdminYN = null;
      var idMember = idMember;
      var idConversation = idConversation;
      $.ajax({
        url : url,
        type : 'POST',
        data : {
          isDeletedYN : isDeletedYN,
          isAdminYN : isAdminYN,
          idMember : idMember,
          idConversation : idConversation,
          idOtherUser : idOtherUser
        },
        success : function(response){
          // window.location.reload();
          console.log(response)
        }
      })
    }

    function postConversation(idUsers,convoName,convoProfilePic,idConversation,isGroupYN,reload=null){
      var url = '<?php echo base_url() ?>messenger/postConversation' 
      $.ajax({
        url : url,
        type : 'POST',
        data : {
          allUserids : idUsers,
          convoName : convoName,
          convoProfilePic : convoProfilePic,
          idConversation : idConversation,
          isGroupYN : isGroupYN
        },
        success : function(response){
          console.log(response)
          if(reload == 'NO'){
            response = JSON.parse(response);
            loadNewChat(response.idConversation)
            console.log(response)
          }
          else{
            window.location.reload();
          }
        }
      })
    }

    function getConversation(otherIdUser,name){
      var url = "<?php echo base_url() ?>messenger/getConv/"+otherIdUser;
      $.ajax({
        url : url,
        type : 'GET',
        success : function(response){
          response = JSON.parse(response);
          if(response.conversation == null){
            createNewChat(otherIdUser,name);
            console.log(response.conversation)
          }
          if(response.conversation != null){
            loadNewChat(response.conversation.idConversation)
            console.log(response.conversation)
          }
        }
      })
    }

    function createNewChat(idUser,convoName){
      var idUsers = [];
      idUsers.push(idUser,"<?php echo $this->session->userdata('LoginId') ?>");
      postConversation(idUsers,convoName,null,null,'N','NO');
      loadNewChat(idUser,'N');
    }

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
          reader.onload = function (e) {
            $('#imagePreview').attr('src', e.target.result);
          }
        reader.readAsDataURL(input.files[0]);
      }
    }

    function groupName(name){
      var groupName = name.parentElement.textContent;
          groupName = groupName.replace(/(\r\n|\n|\r)/gm,"");
          groupName = groupName.replace(/\s\s+/g, '');
      var wrapper = document.getElementById('user_name_view');
      var normal = wrapper.innerHTML;
      while(wrapper.firstChild){
        wrapper.removeChild(wrapper.firstChild);
      }
        $('#user_name_view').append(`<input type="text" class="editGroupName_input"><i class="editGroupName_tick"><span class="material-icons-outlined">check_circle</span></i><i class="editGroupName_close"><span class="material-icons-outlined">highlight_off</span></i>`)
          console.log(groupName);
        $('.editGroupName_input').val(groupName)
        $(document).on('click','.editGroupName_tick',function(){
            var idUsers = [];
            $('.groupMembers_wrapper').each(function(){
              if($(this).attr('userid') != null && $(this).attr('userid') != ""){
                // idUsers.push($(this).attr('userid'))
              }
            })
            var convoName = $('.editGroupName_input').val();
            var convoProfilePic = null
            var idConversation = $('#user_name_view').attr('conversationid');
            var isGroupYN = 'Y';
            postConversation(null,convoName,convoProfilePic,idConversation,isGroupYN);
              $('#user_name_view').empty();
              $('#user_name_view').append(convoName);
        })

      $(document).on('click','.editGroupName_close',function(){
        $('#user_name_view').empty();
        $('#user_name_view').append(normal);
      })
    }

    $(document).on('click','.recentchat_wrapper',function(){
      var userId = $(this).attr('chatid');
      try{
          var isDeletedYN = 'N';
          var idMember = $('.headind_srchs').attr('idMember');
          var idConversation = $('.headind_srchs').attr('user_id');
        }
        catch{}
      // var isGroupYN = $(this).attr('group');
      var url = '<?php echo base_url() ?>messenger/chat/'+userId;
      $.ajax({
        url : url,
        type : 'GET',
        success : function(response){
          // console.log(response)
          try{
            if(idMember != null && idMember != ""){
              lastSeen(isDeletedYN,idMember,idConversation);
              }
            } 
          catch{}
          $('.messenger_center_box').html($(response).find('.messenger_center_box').html())
          $('.right_box').html($(response).find('.right_box').html())
          $('.chat-box').scrollTop($('.chat-box')[0].scrollHeight)
        }
      })
    })

    $(document).on('click','.deleteUserFromGroup',function(){
      var url = "<?php echo base_url() ?>messenger/removeFromGroup";
      var memberId = $(this).attr('idMember');
      var groupId = $(this).attr('groupId');
      var bool = confirm('Are you sure you want to remove a user from the group?')
      if(bool == true){
          lastSeen('Y',memberId,groupId)
        // console.log(memberId)
        $(this).closest('.groupMembers_wrapper').remove();
      }
    })


    function loader_icon(){
            $('.loading').show();
          }; 
    remove_loader_icon();
    function remove_loader_icon(){
        $('.loading').hide();
      };

    $(document).ready(function(){

        var arr =[];
        var uiArr = [];
      $(document).on('click','.createGroupUsersList_wrapper',function(){
        uiArr.push($(this).index());
        console.log($('.createGroupUsersList_wrapper').eq($(this).index()).css('background'))
        if($('.createGroupUsersList_wrapper').eq($(this).index()).css('background') == 'rgb(247, 245, 245) none repeat scroll 0% 0% / auto padding-box border-box' || $('.createGroupUsersList_wrapper').eq($(this).index()).css('background') == 'rgb(255, 255, 255) none repeat scroll 0% 0% / auto padding-box border-box'){
          $('.createGroupUsersList_wrapper').eq($(this).index()).css('background','#e3e4e7');
                  
        }else{
          $('.createGroupUsersList_wrapper').eq($(this).index()).css('background','rgb(255, 255, 255) none repeat scroll 0% 0% / auto padding-box border-box')
        }
        if(arr.includes($(this).attr('userid')) ===  false){
          arr.push($(this).attr('userid'));
          console.log(arr)
          return 0;
        }
        if(arr.includes($(this).attr('userid')) ===  true){
          arr.splice(arr.indexOf($(this).attr('userid')),1);
          console.log(arr)
          return 0;
        }

      })
      $(document).on('click','.createGroupClass_wrapper',function(){
        var groupName = $('.groupNameInput').val();
        if(arr.length == 0){
		      addMessageToNotification('Add Members');
		      showNotification();
		      setTimeout(closeNotification,5000)
        }
        else if(groupName == null || groupName == ""){
          console.log(arr)
		      addMessageToNotification('Enter Group Name');
		      showNotification();
		      setTimeout(closeNotification,5000)
        }else{
          postConversation(arr,groupName,null,null,'Y');
          loader_icon();
        }
      })

      $(document).on('click','.addUser__save',function(){
        var arr = [];
        var idConversation = $(this).attr('idConversation')
        $('.addMember option:selected').each(function(){
          arr.push($(this).val());
        })
        postConversation(arr,null,null,idConversation,'Y',null)
      })

      $(document).on('click','.addUser__close',function(){
        $('.addUsersModal').css('display','none');
        $('.addMember option:selected').each(function(){
          $(this).attr('selected',false);
        })
      })
    })

    $(document).on('click','.members_add',function(){
      // var id = $(this).children('img').attr('idConvo')
      var id = $('body').find('.user_name_view').attr('conversationid');
      // alert(id);
      $('.addUser__save').attr('idConversation',id)
      $('.addUsersModal').css('display','block')
    })

    $(document).ready(function(){
      var usersArray = [];
      $('.allUsersList_wrapper').each(function(){
        var id = $(this).attr('repeat-check');
        if(usersArray.includes(id)){
          $(this).remove();
        }else{
          usersArray.push($(this).attr('repeat-check'));
        }
      })

      $(document).on('click','.leave_group',function(){
        var idOtherUser = "<?php echo $this->session->userdata('LoginId'); ?>";
        var idMember = $('.headind_srchs').attr('idMember');
        var idConversation = $('.headind_srchs').attr('user_id');
        var bool = confirm('Are you sure you want to leave the group?');
        if(bool == true){
          lastSeen('Y',idMember,idConversation,idOtherUser)
        }
      })
    })
  /* ---------------------------------------
              UPDATED MESSENGER JS
     --------------------------------------- */
</script>
</html>