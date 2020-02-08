<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header'); ?>
<meta charset="UTF-8">	
  <meta name="keywords" content="HTML,CSS,XML,JavaScript">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>

body {

  min-height: 100vh;
}

::-webkit-scrollbar {
  width: 5px;
}

::-webkit-scrollbar-track {
  width: 5px;
  background: #f5f5f5;
}

::-webkit-scrollbar-thumb {
  width: 1em;
  background-color: #ddd;
  outline: 1px solid slategrey;
  border-radius: 1rem;
}

.text-small {
  font-size: 0.9rem;
}

.members-box{
  height: 165px;
  overflow-y: scroll;
    background-color:#9e9e9e33;
}

.individual-box{
  height: 129px;
  overflow-y: scroll;
    background-color:#9e9e9e33;
}
.messages-box{
  height: 206px;
  overflow-y: scroll;
    background-color:#9e9e9e33;
}
.chat-box {
  height: 550px;
  overflow-y: scroll;
  background-color:#9e9e9e33;
}

.rounded-lg {
  border-radius: 0.5rem;
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
	padding:13px 29px 10px 20px;
	overflow:hidden;
	background-color:#9e9e9e33; 
	box-shadow: 0px 1px 1px #ccc;
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
	box-shadow: 1px 1px 2px #666;
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
    color: #0ed9fa;
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
  width: 250px; 
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
</style>
</head>

<body>
<div class="container">
 

  <div class="row rounded-lg overflow-hidden shadow">
    <!-- Users box-->
    <div class="col-4 px-0" style="background-color:#ccc;">
      <div class="bg-white">

        <div class="headind_srch">
			<div class="has-search">
			<i class="fas fa-search feedback" style=""></i>
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
        </div>
		<div class="bg-gray px-4 py-2" style="background-color:#9e9e9e33;">
          <p class="h6 mb-0 py-1">General</p>
        </div>

        <div class="messages-box" id="get_users">
          <div class="list-group rounded-0 ">
            <?php
              $recents = json_decode($recentChats);
              foreach($recents->chats as $rc){ 
            ?>
            <div onclick="loadNewChat('<?php echo $rc->id;?>','<?php echo $rc->isGroupYN;?>')" class="list-group-item list-group-item-action list-group-item-light rounded-0 chat_people pointer <?php echo $rc->id == $currentUserId ? 'active_chat' : '';?> ">
              <div class="media">
			 <div class="icon-container">
			 <?php
				if($rc->imgUrl == null || $rc->imgUrl == "") {
					$rc->imgUrl = base_url().'assets/images/defaultUser.png';
					}
				?>
			  <img src="<?php echo $rc->imgUrl;?>" alt="user" width="30" class="rounded-circle">
			  </div>
                <div class="media-body ml-4">
                  <div class="d-flex align-items-center justify-content-between mb-1">
                    <div class="rounded ">
					 <h6 class="mb-0"><?php echo $rc->name;?></h6>
					  <p class="text-small mb-0 text-muted ovrflowtext"><?php echo $rc->lastText;?></p>
					</div>
                  </div>
                
                </div>
              </div>
            </div>
			  <?php } ?>
          

          </div>
        </div>
		<div class="bg-gray px-4 py-2" style="background-color:#9e9e9e33; border-top: 1px solid #ccc;">
		  <a style="text-decoration: none; color:#212529;" href="<?php echo site_url('messenger_api_controller')?>"><p class="h6 mb-0 py-1">Individual</p></a>
        </div>
		 <div class="individual-box">
			<?php
			$users = json_decode($users);
			foreach ($users->users as $chat) { ?>
			<div onclick="loadNewChat('<?php echo $chat->userid;?>','N')" class="list-group-item list-group-item-action list-group-item-light rounded-0 chat_people pointer">
              <div class="media">
			  <div class="icon-container">
			  <?php
					if($chat->imageUrl == null || $chat->imageUrl == "") {
					$chat->imageUrl = base_url().'assets/images/defaultUser.png';
					}
				?>
				<img src="<?php echo $chat->imageUrl;?>" alt="user" width="30" class="rounded-circle">
			  </div>
                <div class="media-body ml-4">
                  <div class="d-flex align-items-center justify-content-between mb-1">
                    <h6 class="mb-0"><?php echo $chat->username;?></h6>
                  </div>
                 
                </div>
              </div>
            </div>
			<?php }?>
			
		 </div>
		 
		 <div class="row bg-gray px-4 py-2" style="background-color:#9e9e9e33; border-top: 1px solid #ccc;">
			<div class="col-md-6">
			<a style="text-decoration: none; color:#212529;" href="javascript:void(0);">
			<p class="h6 mb-0 py-1">Groups </p></a>
			</div>
			
			<div class="col-md-6 text-right">
			<a href="javascript:void(0);" style="text-decoration:none;" data-toggle="modal" data-target="#addtogroup"> 
			<i class="fas fa-plus-circle" style="font-size:15px; margin: 15px 0 0 0;" title="Add New Group"></i></a>
			</div>
        </div>
		
		<div class="individual-box">
		 <?php
			$groups = json_decode($groups);
			foreach ($groups->groups as $group) 
			{ 
         ?>
			<div onclick="loadNewChat('<?php echo $group->groupid;?>','Y')" class="list-group-item list-group-item-action list-group-item-light rounded-0 chat_people pointer">
              <div class="media">
			   
                <div class="media-body ml-4">
                  <div class="d-flex align-items-center justify-content-between mb-1">
                    <h6 class="mb-0"><?php echo $group->groupName;?></h6>
                  </div>
                </div>
			<!-- 	<div class="col-md-6 avatar-group text-right">
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
			<?php } ?>
			
            
		 </div>
      </div>
    </div>
	 <div class="group-box"></div>
    <!-- Chat Box-->
	
    <div class="col-8 px-0">
			
   <div class="media headind_srchs">
   <a href="javascript:void(0);" id="contact_us">
		<?php
            $currentUserInfo = json_decode($currentUserInfo);
            if($currentUserInfo->avatarUrl == null || $currentUserInfo->avatarUrl == ""){
              $currentUserInfo->avatarUrl = base_url().'assets/images/defaultUser.png';
            }
          ?>
	<img src="<?php echo $currentUserInfo->avatarUrl;?>" alt="user" width="35" class="rounded-circle">
	</a>
	<p class="text-capitalize" style="margin:0; font-size:18px; font-weight:500; padding:3px 0 0 10px; color:#307bd3;">
		<?php 
          if($isGroupYN == "N")
            echo $currentUserInfo->memberName;
          else
            echo $currentUserInfo->groupName;
          ?>
	</p>
    </div>
          
      <div class="px-4 py-5 chat-box bg-light">
        <!-- Sender Message-->
		<?php
              $currentChat = json_decode($currentChat);
              foreach ($currentChat->chats as $chats) { ?>
        <div class="media w-50 mb-3">
<!-- 		<img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="30" class="rounded-circle"> -->
          <div class="media-body ml-3">
		  <?php $date=date_create($chats->sentDateTime);?>
		  <p class="text-small mb-0 text-muted text-muted font-weight-bold"><?php echo 'name';?> 
		  <small class="text-muted"><?php echo date_format($date,"d M y | H:i A");?></small></p>
            <div class="bg-light rounded py-2 px-3 mb-2">
              <p class="text-small mb-0 text-muted"><?php echo $chats->chatText;?></p>
            </div>
          </div>
        </div>
		<?php }?>	
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
      <form action="<?php echo base_url().'messenger/postNewMessage';?>" class="" method="post" id="chatForm">
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
								<img class="" src="<?php echo $group->avatarUrl;?>" alt="profile_img" width="30">
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
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
						  </div>
					<div class="modal-body">
					  <div class="container-fluid">
						<form id="groupForm" method="post" action="<?php echo base_url().'messenger/creategroup';?>">
						  <div class="form-group">
						  <div class="row">
						 
							 <div class="col-md-4"><label for="recipient-name" class="col-form-label"  style="float:right;">Group Name</label></div>
							 <div class="col-md-8" style="float:left;"><input type="text" class="form-control" name="recipient-name" id="recipient-name" required style="border-radius:0;background-color:#9e9e9e33;border:none;">
							  <div class="col-md-12" style="color: red;" id="groupNameErr"></div>
							 </div>
						  </div>
						  </div>
						  <hr>
						  <div class="search-table">
							<div class="search-box">
                <div class="row mb-2">
                    <div class="col-sm-12 has-search">
					<i class="fas fa-search feedback"></i>
                        <input type="text" id="myInput" class="form-control rounded-0" placeholder="Search Employee">
                        <script>
                            $(document).ready(function () {
                                $("#myInput").on("keyup", function () {
                                    var value = $(this).val().toLowerCase();
                                    $("#myTable tr").filter(function () {
                                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                    });
                                });
                            });
                        </script>
                    </div> 
                </div>
            </div>
			<div class="search-list">
                <table class="table" id="myTable" style="border:none;">
                    <thead>
                        <tr></tr>
                    </thead>
                    <tbody class="tbodyscroll">  
					<?php
                     foreach ($users->users as $chat) {
                      if($chat->imageUrl == null || $chat->imageUrl == ""){
                        $chat->imageUrl = base_url().'assets/images/defaultUser.png';
                      }
                    ?>					
                    <tr>
                        <td> 
						<label class="checkbox">
                            <input type="checkbox" name="<?php echo $chat->userid;?>" id="<?php echo $chat->userid;?>" />
                            <span class="default"></span>
                        </label>
						</td>
                        <td>
							<a href="javascript:void(0);" class="list-group-item list-group-item-action list-group-item-light rounded-0 chat_people">
							  <div class="media">
							  <div class="icon-container">
							  <img src="<?php echo $chat->imageUrl;?>" alt="user" width="30" class="rounded-circle">
							  <div class='status-circle-online'></div>
							  </div>
								<div class="media-body ml-4">
								  <div class="d-flex align-items-center justify-content-between ">
									<h6 class="mb-0"><?php echo $chat->username;?></h6>
								  </div>
								  
								</div>
							  </div>
							</a>
						</td>
                    </tr>
					<?php }	?>
                    
                    </tbody>
                </table>

            </div>
						  </div>
						  
					<div class="text-center mt-2 mb-4">
						<button class="btn btn-secondary rounded-0" type="button" onclick="saveGroup()">Save</button>
						<button class="btn btn-secondary rounded-0" type="button" data-dismiss="modal">Cancel</button> 
					</div> 
						  
						</form>
					  </div>
					  
					</div>
					
						  
						  
						</div>
					  </div>
				</div>
		<!-- add to group model end -->
</body>


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
      if(text != ""){
        document.getElementById("chatForm").submit();
      }
    }
  </script>
    </html>
