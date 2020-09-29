<?php
$colors_array = ['#A4D9D6','#A4D9D6','#A4D9D6','#A4D9D6','#A4D9D6','#A4D9D6'];
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
<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header'); ?>
<script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>

<meta charset="UTF-8">	
  <meta name="keywords" content="HTML,CSS,XML,JavaScript">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
  *{
font-family: 'Open Sans', sans-serif;
  }
body {

  min-height: 100vh;
}

::-webkit-scrollbar {
  width: 5px;
  border: none;
}

::-webkit-scrollbar-track {
  width: 5px;
  background: #f5f5f5;
}

::-webkit-scrollbar-thumb {
  width: 1em;
  background-color: #ddd;
  
  border-radius: 1rem;
}

.text-small {
  font-size: 0.9rem;
}

.members-box{
  height: 165px;
  overflow-y: scroll;
    background-color:#fff;
}

.individual-box{
  min-height: 25vh;
  max-height: 25vh;
  overflow-y: scroll;
    background-color:#fff;
    padding-left: 1.5rem
}
.messages-box{
  height: 25vh;
  overflow-y: auto;
  background-color:#fff;
  padding-left: 1.5rem 
}
.chat-box {
  height: calc(100vh - 6rem);
  overflow-y: scroll;
  background-color:#fff;
}
.row.rounded-lg.overflow-hidden.shadow{
  max-height: 100vh
}
.rounded-lg {
  border-radius: 0 !important;
  margin-left: 0;
  margin-right: 0;
}

input::placeholder {
  font-size: 0.9rem;
  color: #999;
}
.headind_srchs{ 
padding:13px 29px 10px 20px;
 overflow:hidden; 
 }
 .headind_srch{ 
	padding:0.75rem 0.5rem 0.75rem 1rem;
	overflow:hidden;
	background-color:#9e9e9e33; 
	box-shadow: none;
 }
.has-search .form-control {
    padding-left: 2.375rem;
}

.has-search .feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 1.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
	margin: 0 0 0 10px;
	
}
.form-control:focus {
    box-shadow: none;
}
.search-bar{
	border-radius:15px;
	border:none;
	box-shadow: none;
}
.form-control-sm {
    height: calc(1.5em + 0.5rem + 2px);
    padding: 1.1rem 2rem;
    font-size: .875rem;
    
}
.list-group-item-light {
    color: #818182;
    background-color: transparent;
    padding: 5px;
	border:none;
}
.list-group-item-light.list-group-item-action.active_chat {
    color: #818182;
    background-color: #f9f9f9;
    border-color: #f9f9f9;
}
.msg_send_btn{
	border: none;
    color: #25C14A;
    font-weight: 500;
    background-color: transparent;
    margin: 10px;
}
.icon-container {
  width: 35px;
  height: 30px;
  position: relative;
}

.status-circle {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background-color: grey;
  border: 2px solid white;
  bottom: 0;
  right: 0;
  position: absolute;
}
.status-circle-online {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background-color: #3CE77E;
  border: 2px solid white;
  bottom: 0;
  right: 0;
  position: absolute;
}
.separator {
    display: flex;
    align-items: center;
    text-align: center;
	margin-bottom:20px;
}
.separator::before, .separator::after {
    content: '';
    flex: 1;
    border-bottom: 1px solid #ccc;
}
.separator::before {
    margin-right: .25em;
}
.separator::after {
    margin-left: .25em;
}
tbody {
    display:block;
    height:205px;
    overflow:auto;
}
thead, tbody tr {
    display:table;
    table-layout:fixed;
}
thead {
    width: calc( 100% - 1em )
}
table {
    width:400px;
}
.table td, .table th {
    padding: .75rem;
    vertical-align: top;
    border-top:0;
}
p.ovrflowtext {
  white-space: nowrap; 
  width: 100%; 
  overflow: hidden;
  text-overflow: ellipsis; 
  border: 1px solid #000000;
  border:none;
}
  .checkbox{background-color:#fff;display:inline-block;height:18px;margin:0.6em 0 0 0;width:18px;border-radius:0;border:1px solid #ccc;float:right}
  .checkbox span{display:block;height:20px;position:relative;width:20px;padding:0}
  .checkbox span:after{-moz-transform:scaleX(-1) rotate(135deg);-ms-transform:scaleX(-1) rotate(135deg);-webkit-transform:scaleX(-1) rotate(135deg);transform:scaleX(-1) rotate(135deg);-moz-transform-origin:left top;-ms-transform-origin:left top;-webkit-transform-origin:left top;transform-origin:left top;border-right:3px solid #fff;border-top:3px solid #fff;content:'';display:block;height:13px;left:0;position:absolute;top:8px;width:8px}
  
  .checkbox input{display:none}
.checkbox input:checked + .default:after{border-color:#242121ad}
.avatar {
    font-size: 1rem;
    display: inline-flex;
    width: 48px;
    height: 48px;
    color: #fff;
    border-radius: 50%;
    background-color: #adb5bd;
    align-items: center;
    justify-content: center;
}

.avatar img {
    width: 100%;
    border-radius: 50%;
}

.avatar-sm {
    font-size: .675rem;
    width: 26px;
    height: 26px;
}

.avatar-group .avatar {
    position: relative;
    z-index: 2;
    border: 2px solid #fff;
}

.avatar-group .avatar:hover {
    z-index: 3;
}

.avatar-group .avatar + .avatar {
    margin-left: -1rem;
}
.list-group-item-light.list-group-item-action:focus, .list-group-item-light.list-group-item-action:hover {
    color: #818182;
    background-color: #f9f9f9;
}


/*sidebar*/
.sidebar{
	position:fixed;
	top:58%;
	right:-100%;
	transform:translateY(-50%);
	width:350px;
	height:100vh;
	min-height:50%;
	padding:40px;
	background:#f9f9f9;
	overflow-y: scroll;
	box-sizing:border-box;
	transition:0.5s;
	z-index: 9999;
}
.sidebar.active{
	right:0;
}
.sidebar input{
	width:100%;
	height:100%;
	padding:5px;
	margin-bottom:10px;
	box-sizing:border-box;
	border:none;
	outline:none;
}
.sidebar h2{
	margin:0 0 20px;
	padding:0;
}

.sidebar input[type="submit"]{
	background:#00bcd4;
	color:#fff;
	cursor:pointer;
	border:none;
	font-size:18px;
}
.toggle {
    position: absolute;
    height: 15px;
    width: 15px;
    text-align: center;
    cursor: pointer;
    background: #111010;
    top: 1%;
    left: 2px;
    line-height: 15px;
}
.toggle:before{
	content:'\f003';
	font-family:fontAwesome;
	font-size:18px;
	color:#fff;
}
.toggle.active:before{
	content:'\f00d';
}

.left-bar{
  max-width: 250px;
  min-width: 250px;
}
.left-bar-heading{
  font-size:0.9rem;
  color: black;
  font-weight: 500
}
.text-small{
  font-size: 0.75rem
}
.text-small-chat{
  font-size: 0.9rem;
  color: #3D3C40;
}
.text-small-chat-message{
  font-size: 0.8rem;
  color: #3D3C40;
}
.left-bar-title{
  color: #084183 !important;
  font-size: 0.9rem;
  font-weight: 700;
}
.attach_file{
    display: flex;
    justify-content: center;
    align-items: center;
    padding-left: 1rem
}
.attach_file > img{
  height: 1.5rem;
}
.circle_plus{
  display: flex;
    justify-content: center;
    align-items: center;
    padding-left: 0.75rem
}
.circle_plus > img{
  height: 1.5rem
}
.name-chat-box{
  font-weight: 700;
  color: #3D3C40 !important;
}
.chat-message-time{
  color: #BABBBF;
  font-size: 0.6rem
}
.bg-light{
  background: #f2f2f2 !important;
}
.icon{
  font-size:0.75rem;
  display:flex;
  justify-content:center;
  align-self: center;
  border-radius: 50%;
  padding:0.25rem 0;
  color:#707070;
  font-weight: 700;
  height: 1.5rem;
  width: 1.5rem;
}
.icon-parent{
  display: flex;
  align-content: center;
  justify-content: center
  padding:0;
}


/*profile card*/
.card {
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
        width:310px;
        min-height:200px;
        background:#fff;
        transition:0.5s;
    }
    
    .card .box {
        position:absolute;
        top:50%;
        left:0;
        transform:translateY(-50%);
        text-align:center;
        padding:20px;
        box-sizing:border-box;
        width:100%;
    }
    .card .box .imgs {
        width:120px;
        height:120px;
        margin:0 auto;
        border-radius:50%;
        overflow:hidden;
    }
    .card .box .imgs img {
        width:100%;
        height:100%;
    }
    .card .box h2 {
        font-size:20px;
        color:#262626;
        margin:20px auto;
    }
    .card .box h2 span {
        font-size:14px;
        
        color:#212529;
        
    }
    .card .box p {
        color:#262626;
    }
    .card .box span {
	/*  display:inline-flex;*/    
	}
    .card .box ul {
        margin:0;
        padding:0;
    }
    .card .box ul li {
        list-style:none;
        float:left;
    }
    .card .box ul li a {
        display:block;
        color:#aaa;
        margin:0 10px;
        font-size:20px;
        transition:0.5s;
        text-align:center;
    }
    .card .box ul li:hover a {
        color:#e91e63;
        transform:rotateY(360deg);
    }
	.card2 {
        top:50%;
        left:50%;
        transform:translate(-9%,-2%);
        width:310px;
        min-height:60px;
        background:#fff;
        transition:0.5s;
    }
	.card2 {
    margin-bottom: 15px;
    border-radius: 0;
    box-shadow: 0 3px 5px rgba(0,0,0,.1);
}
    
    .card2 .box2 {
        position:absolute;
        top:50%;
        left:0;
        transform:translateY(-50%);
        text-align:center;
        padding:20px;
        box-sizing:border-box;
        width:100%;
    }
    .card2 .box2 .imgs {
        width:120px;
        height:120px;
        margin:0 auto;
        border-radius:50%;
        overflow:hidden;
    }
    .card2 .box2 .imgs img {
        width:100%;
        height:100%;
    }
    .card2 .box2 h2 {
        font-size:20px;
        color:#262626;
        margin:20px auto;
    }
    
    .card2 .box2 p {
        color:#262626;
		text-align: left;
    font-size: 17px;
    font-weight: 500;
    }
    
    .card2 .box2 ul {
        margin:0;
        padding:0;
    }
    .card2 .box2 ul li {
        list-style:none;
        float:left;
    }
    .card2 .box2 ul li a {
        display:block;
        color:#aaa;
        margin:0 10px;
        font-size:20px;
        transition:0.5s;
        text-align:center;
    }
    .card2 .box2 ul li:hover a {
        color:#e91e63;
        transform:rotateY(360deg);
    }
/*sidebar end*/

/* inline edit group NAME */
.editbox {
  position: relative;
  margin:0 auto;
  padding:0;
  width:250px;
  min-height: 15px;
  border: 0;
  border-radius: 0;
  background: #fff;
}

.editable {
  border-color: #bd0f18;
  background: #f9f9f9;
}

.text {
  outline: none;
  font-size:18px;
  font-weight: 500;
    padding: 7px;

}

.edit, .save {
  width: 35px;
  display: block;
  position: absolute;
  top: 0px;
  right: 0px;
  padding: 4px 10px;
  /*border-top-right-radius: 2px;
  border-bottom-left-radius: 10px; */
  text-align: center;
  cursor: pointer;
  /* box-shadow: -1px 1px 4px rgba(0,0,0,0.5); */
}

.edit { 
  color: green;
  transition: opacity .2s ease-in-out;
}

.save {
  display: none;
  color: green;
  font-size:18px;
  margin-top: 7px;

}

.editbox:hover .edit {
  opacity: 1;
}

/* inline edit group NAME END */

.chat_ib h5{ font-size:15px; color:#464646; margin:6px 0 0 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}
.pointer {cursor: pointer;}
.container{
  max-width:100%;
}
   .modal-logout {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        visibility: hidden;
        transform: scale(1.1);
        transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;
        text-align: center;
    }
    .modal-content-logout {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 1rem 1.5rem;
        width: 50%;
        border-radius: 0.5rem;
    }
    .show-modal {
        opacity: 1;
        visibility: visible;
        transform: scale(1.0);
        transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
    }
    .chat-box{
      min-height:0;
    }
    #chatForm{
          border-top: 1px solid rgba(0,0,0,.2);
    }

    /*-------------------*/
    /*Left bar heights and styles*/
    /*-------------------*/

.headind_srch{
  height:9vh;
}
#upload_image{
  display: none;
}
.attach_file:hover #upload_image{
  display: block !important;
  right:50%;
  top:0;
}
.general_heading{
  height:5.33vh;
}
.modal-header{
  background: #8D91AA;
  display: flex;
    justify-content: center;
}
.modal-header h5{
  font-size: 1rem;
  color: #F3F4F7 !important;
}
.button{
  /*position: absolute;*/
/*  right: 0;*/
    border: none !important;
    color: rgb(23, 29, 75) !important;
    text-align: center !important;
    text-decoration: none !important;
    display: inline-block;
    font-weight: 700 !important;
    margin: 2px !important;
    min-width:6rem !important;
      border-radius: 20px !important;
      padding: 4px 8px !important;
      background: rgb(164, 217, 214) !important;
      font-size: 1rem !important;
      margin-right:5px !important;
      justify-content: center !important;
}
    @media only screen and (max-width: 600px){
      .left-bar{
        max-width:auto;
        width: 100vw;
      }
      .message-back{
        padding:0 20px !important;

      }
      .container{
        max-width:100%;
        padding-right: 0 !important;
      }
      .lefbar-sm{
        width: 100vw;
      }
    }
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tokenize2.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tokenize2.js"></script>
  <script type="text/javascript">
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
      console.log("permission granted")
    if(isTokenSentToServer()) {
      console.log('Token already saved.');
    } else {
      getRegToken();
    }
    })
    .catch((err)=>{
      alert();
    })
  function setTokenSentToServer(sent) {
      window.localStorage.setItem('sentToServer', sent ? 1 : 0);
  }
    function isTokenSentToServer() {
      return window.localStorage.getItem('sentToServer') == 1;
  }
    function getRegToken(argument) {
    messaging.getToken()
      .then(function(currentToken) {
        if (currentToken) {
          saveToken(currentToken);
          console.log(currentToken);
          setTokenSentToServer(true);
        } else {
          console.log('No Instance ID token available. Request permission to generate one.');
          setTokenSentToServer(false);
        }
      })
      .catch(function(err) {
        console.log('An error occurred while retrieving token. ', err);
        setTokenSentToServer(false);
      });
  }
  </script>
</head>

<body>
<div class="container mr-0 pr-0">
 

  <div class="row rounded-lg overflow-hidden shadow">
    <!-- Users box-->
    <div class="col-4 col-sm-12 px-0 left-bar" style="background-color:#ccc;">
      <div class="bg-white lefbar-sm">

        <div class="headind_srch d-flex">
			<div class="has-search">
			<i class="feedback" style=""></i>
				<input type="text" class="search-bar form-control form-control-sm" placeholder="Search Employee" id="searchInput">
						<script>
                            $(document).ready(function () {
                                $("#searchInput").on("keyup", function () {
                                    var value = $(this).val().toLowerCase();
                                    $("#get_users .chat_people").filter(function () {
                                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                    });
                                });
                            });
                        </script>
			</div>
      <div class="circle_plus" ><img src="<?php echo site_url().'assets/images/circle_plus.png'?>"></div>
        </div>
		<div class="bg-gray px-4 py-2 general_heading" style="background-color:#fff;">
          <p class="h6 left-bar-title mb-0 py-1">General</p>
        </div>

        <div class="messages-box" id="get_users">
          <div class="list-group rounded-0 ">
            <?php
            if(isset($recentChats)){
              $recents = json_decode($recentChats);
              foreach($recents->chats as $rc){ 
            ?>
            <div onclick="loadNewChat('<?php echo $rc->id;?>','<?php echo $rc->isGroupYN;?>')" class="list-group-item list-group-item-action list-group-item-light rounded-0 chat_people pointer <?php echo $rc->id == $currentUserId ? 'active_chat' : '';?> ">
              <div class="media">
			 <div class="icon-container">
			 <!-- <?php
				if($rc->imgUrl == null || $rc->imgUrl == "") {
					$rc->imgUrl = base_url().'assets/images/defaultUser.png';
					}
				?>
			  <img src="<?php echo $rc->imgUrl;?>" alt="user" width="20" class="rounded-circle"> -->
          <span class="icon-parent">
            <span class=" icon" style="
              <?php echo "background:".$colors_array[rand(0,5)].";"?>">
              <?php if(isset($rc->name)){
                echo icon($rc->name);
              }?>
            </span>
          </span>
			  </div>
                <div class="media-body ml-0">
                  <div class="d-flex align-items-center justify-content-between mb-1">
                    <div class="rounded ">
					 <h6 class="mb-0 left-bar-heading"><?php echo $rc->name;?></h6>
                      <p class="text-small mb-0 text-muted ovrflowtext"><?php 
                      echo $rc->lastText;
//                             try{
//               if(is_string($rsa->decrypt(base64_decode($rc->lastText))) == 1){
// $expression = "/(http|ftp|https):\/\/([\w_-]+(?:(?:\.[\w_-]+)+))([\w.,@?^=%&:\/~+#-]*[\w@?^=%&\/~+#-])?/i";
// $string = $rsa->decrypt(base64_decode($rc->lastText));
//                 if(preg_match($expression,$string) == 1){
//                   // echo '<img src="'.$string.'">';
//                 }elseif(preg_match('/data:image/i',$string) == 1){
//                   echo 'Media';
//                 }else{
//                   echo $string;
//                 }
//               } 
//               else{
//                 throw new Exception('Invalid Type');
//               }
//                 }
//                 catch(Exception $e){
//                     echo 'Not Known';
//                 }
            ?></p>
					</div>
                  </div>
                
                </div>
              </div>
            </div>
			  <?php } }?>
          

          </div>
        </div>
		<div class="bg-gray px-4 py-2 general_heading" style="background-color:#fff; border-top: 1px solid #ccc;">
		  <a style="text-decoration: none; color:#212529;" href="<?php echo site_url('messenger_api_controller')?>"><p class="h6 left-bar-title mb-0 py-1">Individual</p></a>
        </div>
		 <div class="individual-box">
			<?php
			$users = json_decode($users);
			if(isset($users->users)){
        foreach ($users->users as $chat) { ?>
          <div onclick="loadNewChat('<?php echo $chat->userid;?>','N')" class="list-group-item list-group-item-action list-group-item-light rounded-0 chat_people pointer">
            <div class="media">
              <div class="icon-container">
              <!-- <?php
                if($chat->imageUrl == null || $chat->imageUrl == "") {
                $chat->imageUrl = base_url().'assets/images/defaultUser.png';
                }
              ?>
              <img src="<?php echo $chat->imageUrl;?>" alt="user" width="20" class="rounded-circle"> -->
              <span class="icon-parent">
                <span class=" icon" style="
                  <?php echo "background:".$colors_array[rand(0,5)].";"?>">
                  <?php if(isset($chat->username)){
                    echo icon($chat->username);
                  }?>
                </span>
              </span>
              </div>
                <div class="media-body ml-0">
                  <div class="d-flex align-items-center justify-content-between mb-1">
                    <h6 class="mb-0 left-bar-heading"><?php if(isset($chat->username)){
                    echo $chat->username;
                  }?></h6>
                  </div>
                </div>
              </div>
            </div>
            <?php }}?>
			
		 </div>
		 
		 <div class="row bg-gray px-4 py-2 general_heading" style="background-color:#fff; border-top: 1px solid #ccc;">
			<div class="col-md-6">
			<a style="text-decoration: none; color:#212529;" href="javascript:void(0);">
			<p class="h6 left-bar-title mb-0 py-1">Groups </p></a>
			</div>
			
			<div class="col-md-6 text-right">
			<a href="javascript:void(0);" style="text-decoration:none;" data-toggle="modal" data-target="#addtogroup"> 
			<i class="" style="font-size:15px; margin: 15px 0 0 0;" title="Add New Group">
        <img src="<?php echo site_url('/assets/images/add.png'); ?>" height="15px">   
      </i></a>
			</div>
        </div>
		
		<div class="individual-box">
		 <?php
			$groups = json_decode($groups);
			if(isset($groups->groups)){
        foreach ($groups->groups as $group) 
             { 
                ?>
             <div onclick="loadNewChat('<?php echo $group->groupid;?>','Y')" class="list-group-item list-group-item-action list-group-item-light rounded-0 chat_people pointer">
                     <div class="media">
                
                       <div class="media-body ml-0">
                         <div class="d-flex align-items-center justify-content-between mb-1">
                           <h6 class="mb-0 left-bar-heading"><?php echo $group->groupName;?></h6>
                         </div>
                       </div>
             <!--   <div class="col-md-6 avatar-group text-right">
                               <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Ryan Tompson">
                                 <img alt="Image placeholder" src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" class="rounded-circle" width="30">
                               </a>
                               <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Romina Hadid">
                                 <img alt="Image placeholder" src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" class="rounded-circle" width="30">
                               </a>
                               <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Alexander Smith">
                                 <img alt="Image placeholder" src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" class="rounded-circle" width="30">
                               </a>
                               <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Alexander Smith">
                                 <img alt="Image placeholder" src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" class="rounded-circle" width="30">
                               </a>
                 </div> -->
                     </div>
                   </div>
             <?php }} ?>
			
            
		 </div>
      </div>
    </div>
	 <div class="group-box"></div>
    <!-- Chat Box-->
	
    <div class="col px-0" style="min-height:100vh;word-break: break-word">
			
   <div class="media headind_srchs">
    <i class="message-back"></i>
   <a href="javascript:void(0);" id="contact_us">
		<?php
            $currentUserInfo = json_decode($currentUserInfo);
            if(isset($currentUserInfo->avatarUrl)){
              if($currentUserInfo->avatarUrl == null || $currentUserInfo->avatarUrl == ""){
                $currentUserInfo->avatarUrl = base_url().'assets/images/defaultUser.png';
              } ?>

            <img src="<?php if(isset($currentUserInfo->avatarUrl)){
              echo $currentUserInfo->avatarUrl;}?>" alt="user" width="35" class="rounded-circle">
             <?php }else{ ?>
                  <span class="icon-parent">
                    <span class=" icon" style="
                      <?php echo "background:".$colors_array[rand(0,5)]?>">
                      <?php echo isset($currentUserInfo->memberName) ? icon($currentUserInfo->memberName) : "";?>
                    </span>
                  </span>
          <?php   }
          if(isset($currentUserInfo->groupName) ? $currentUserInfo->groupName : null != null){
            print_r($currentUserInfo->groupName);
          }
          ?>

	</a>
	<p class="text-capitalize" style="margin:0; font-size:18px; font-weight:500; padding:3px 0 0 10px; color:#307bd3;">
		<?php 
          if($isGroupYN == "N")
            if(isset($currentUserInfo->memberName))
            {
              echo $currentUserInfo->memberName;
            }
          else
            if(isset($currentUserInfo->groupName)){
               echo $currentUserInfo->groupName;
            }
          ?>
	</p>
    </div>
          
      <div class="px-4 py-5 chat-box bg-light">
        <!-- Sender Message-->
		<?php
              $currentChat = json_decode($currentChat);
    if(isset($currentChat->chats)){
      foreach ($currentChat->chats as $chats) { ?>
          <div class="media w-50 mb-3">
        <!--     <img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="30" class="rounded-circle"> -->
          <div class="media-body ml-3">
           <?php $date=date_create($chats->sentDateTime);?>
             <p class="text-small-chat mb-0 text-muted text-muted font-weight-bold">
                <a class="name-chat-box">
                  <?php 
                  if( $this->session->userdata('LoginId') == $chats->senderId ){
                    echo $this->session->userdata('Name');
                  }else{
                    echo ucfirst($chats->senderId);
                  }
                  ?>
                </a> 
               <small class="text-muted chat-message-time"><?php echo date_format($date,"d M y | H:i A");?></small>
             </p>
          <div class="bg-light rounded py-2  pl-0 mb-2">
              <p class="text-small-chat-message mb-0 text-muted"><?php
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


                ?></p>
          </div>
        </div>
      </div>
      <?php }}?>	
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
      <form action="<?php echo base_url().'messenger/postNewMessage';?>" class="d-flex" method="post" id="chatForm" enctype="multipart/form-data">
        <!-- <span class="attach_file">
          <img src="<?php echo site_url().'assets/images/attach_file.png'; ?>" id="upload_attachment">
          <input type="file" name="upload_image" id="upload_image" onchange="validate()">
        </span> -->
        <div class="input-group">
          <input type="text" id="chatText" name="chatText" placeholder="Type message here.."  class="form-control rounded-0 border-0 py-4 bg-white">
		  <input type="hidden" name="receiverId" id="receiverId" value="<?php echo $currentUserId;?>">
              <input type="hidden" name="isGroupYN" id="isGroupYN" value="<?php echo $isGroupYN;?>">
          <div class="input-group-append">
            <!--<button id="button-addon2" type="submit" class="btn btn-link"> <i class="fa fa-paper-plane"></i></button>-->
			<button type="button" class="msg_send_btn" onclick="sendMessage()">SEND</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- side nav start-->
<?php 
    if($isGroupYN == "Y"){ ?>
			<div class="sidebar">
			<div class="toggle" id="contact_close"></div>			  
			<div class="row">
				<div class="col-md-12">
					<div class="card">
					
						<div class="box">
							<div class="imgs">
							   <?php 
                  if($currentUserInfo->avatarUrl == null || $currentUserInfo->avatarUrl == ""){
                    $currentUserInfo->avatarUrl = base_url().'assets/images/defaultUser.png';
                  }
                  ?>
							   <input type="image" src="<?php echo $currentUserInfo->avatarUrl;?>" class="rounded-circle" width="100"/>
								<input type="file" id="my_file" style="display: none;" />
							</div>
							<div class="editbox">
							  <span class="edit"><i class="fas fa-pencil-alt"></i></span>
							  <span class="save"><i class="fas fa-check-circle"></i></span>
							  <div class="text"><?php echo $currentUserInfo->groupName;?></div>
							</div>
						</div>
					</div>
				</div>
        <div class="col-md-12">
        	<div class="card">
        		<div class="card-header">
        			<p style="color:green; font-weight:500;"><?php echo count($currentUserInfo->members);?> Participants</p>
        		</div>
        			<div class="card-body members-box p-0">
        			<ul class="list-group list-group-flush">
                
				<?php foreach ($currentUserInfo->members as $mem) { ?>
        			<li class="list-group-item">   
					<div class="chat_list pointer" onclick="loadNewChat('<?php echo $mem->memberid;?>','N')">
                      <div class="chat_people">
                        <div class="chat_img">
        					<div class='icon-container'>
        					<!--<i class="fas fa-user-circle" style="font-size:25px"></i> -->
							  <?php 
								if($mem->avatarUrl == null || $mem->avatarUrl == "") { 
								  $mem->avatarUrl = base_url().'assets/images/defaultUser.png';
								}
							   ?>
        					<img class="rounded-circle" src="<?php echo $mem->avatarUrl;?>" alt="img_src" width="35">
        				</div>
        				</div>
                        <div class="chat_ib">
                          <h5><?php echo $mem->memberName;?></h5>
                        </div>
                      </div>
                    </div>
        			</li>
				<?php }?>
        			</ul>
        		</div>
        	</div>
        </div>
		<div class="col-md-12 col-sm-12 ml-1">
		 <div class="card2">
		  <div class="box2">
			<div class="group-name">
			<div class="row">
			<div class="col-md-6">
				<form method="post" action="<?php echo base_url().'messenger/exitGroup';?>" id="exitGroupForm">
				<input type="hidden" value="<?php echo $currentUserInfo->groupid;?>" name="groupId">
				<div onclick="exitGroup()">
				<a href="#" name="exit" style="text-decoration:none;"><i class="fas fa-sign-out-alt"></i> Exit Group</a></div>
				</form>
				</div>
				
				<?php if($currentUserInfo->adminId == $this->session->userdata('LoginId')){ ?>
				<div class="col-md-6">
				  <form method="post" action="<?php echo base_url().'messenger/deleteGroup';?>" id="deleteGroupForm">
				  <input type="hidden" value="<?php echo $currentUserInfo->groupid;?>" name="groupId">
				  <div onclick="deleteGroup()">
				  <a href="#" name="delete_group" style="text-decoration:none;"><i class="fas fa-trash-alt"></i> Delete Group</button></div></form>
				<?php }?>
			
			</div>
			</div>
		  </div>
		 </div>
		</div>
		</div>
	</div>
	</div>
<?php } else{ ?>
    <div class="sidebar">
      <div class="toggle" id="contact_close"></div>       
      <div class="row">
        <div class="col-md-12">
          <div class="card">
          
            <div class="box">
              <div class="imgs">
                <?php
                  if($currentUserInfo->avatarUrl == null || $currentUserInfo->avatarUrl == ""){
                    $currentUserInfo->avatarUrl = base_url().'assets/images/defaultUser.png';
                  }
                  ?>
                 <img class="rounded-circle" src="<?php echo $currentUserInfo->avatarUrl;?>" alt="img_src">
              </div>
              <h2><?php echo $currentUserInfo->memberName;?> <span><?php echo $currentUserInfo->designation;?></span></h2>
              
            </div>
          </div>
        </div>
			 <div class="col-md-12">
			 <div class="card">
				<div class="card-header">
				  <p style="color:green; font-weight:500;">Groups In Comon</p>
				</div>
				<div class="card-body members-box p-0">
				  <ul class="list-group list-group-flush">
					
					<?php foreach ($currentUserInfo->groups as $group) { ?>
						<li class="list-group-item">   
						<div class="chat_list pointer" onclick="loadNewChat('<?php echo $group->groupid;?>','Y')">
						  <div class="chat_people">
							<div class="chat_img">
							  <div class='icon-container'>
							  <div class="chat_img">
								<?php 
								  if($group->avatarUrl == null || $group->avatarUrl == "")
									$group->avatarUrl = base_url().'assets/images/defaultUser.png';
								  ?>
								<img class="" src="<?php echo $group->avatarUrl;?>" alt="profile_img" width="20">
							  </div>
							</div>
							</div>
							<div class="chat_ib">
							  <h6><?php echo $group->groupName;?></h6>
							</div>
						  </div>
						</div>
						</li>
						<?php }?>          
				  </ul>
				</div>
			  </div>
			  </div>
        </div>
      </div>
<?php } ?>
<!-- side nav end-->



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
							 <div class="col-md-8" style="float:left;"><input type="text" class="form-control" name="recipient-name" id="recipient-name" required style="border-radius:0;background-color:#fff;border:none;">
							  <div class="col-md-12" style="color: red;" id="groupNameErr"></div>
							 </div>
						  </div>
						  </div>
						  <hr>
						  <div class="search-table">

			<div class="search-list">
        <select class="tokenize_class" name="tokenize_class[]" multiple>
					<?php
                     foreach ($users->users as $chat) {
                      if($chat->imageUrl == null || $chat->imageUrl == ""){
                        $chat->imageUrl = base_url().'assets/images/defaultUser.png';
                      }
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


</body>

<script type="text/javascript">
  // height , width of the container
  $(document).ready(()=>{
    $('.container').css('paddingLeft',$('.side-nav').width());
    var containerHeight = "100vh" - $('.header-top').height();
   document.getElementsByClassName("container").style.maxHeight = "50vh"
  })
</script>
<script>
	
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
	
	</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.list-group-item',function(){
      $('.leftbar-sm').css('display','none');
    })
  })
</script>
  <script type="text/javascript">
    var base_url = "<?php echo base_url();?>";
    function loadNewChat(userid,isGroupYN){
      window.location.href = base_url + "messenger/chats/" + userid +"/" + isGroupYN;
    }

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
  </script>
  <script type="text/javascript">
    // messaging.onMessage(function(payload){
      // console.log('wow');
    // })
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
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.tokenize_class').tokenize2();
  })
</script>
    </html>


<?php
  function icon($str){
  if (strpos($str, '.') !== false) {
  $str = explode(".",$str);
  if(count($str) >1 ){
      return strtoupper($str[0][0].$str[1][0]);
  }else{
      return strtoupper($str[0]);
  }
}
  if (strpos($str, ' ') !== false) {
  $str = explode(" ",$str);
  if(count($str) >1 ){
      return strtoupper($str[0][0]);
  }else{
      return strtoupper($str[0][0]);
  }
}
  if (strpos($str, ' ') == false && strpos($str, '.') == false) {
    return $str[0];
  }
}
?>


