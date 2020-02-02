<!DOCTYPE html>
<html lang="en">




<html>
<head>
<?php $this->load->view('header'); ?>
<style>
  body{
    overflow-y:hidden;
  }
.container{max-width:1150px; margin:auto;}
img{ max-width:75%;}

.icon-container {
  width: 35px;
  height: 30px;
  position: relative;
}

/* img {
  height: 100%;
  width: 100%;
  border-radius: 50%;
} */

.status-circle {
  width: 15px;
  height: 15px;
  border-radius: 50%;
  background-color: grey;
  border: 2px solid white;
  bottom: 0;
  right: 0;
  position: absolute;
}
.status-circle-online {
  width: 15px;
  height: 15px;
  border-radius: 50%;
  background-color: #3CE77E;
  border: 2px solid white;
  bottom: 0;
  right: 0;
  position: absolute;
}

.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  width: 25%; border-right:1px solid #c4c4c4;
  top:0;
  position:sticky;
}
.inbox_msg {
  border: none;
  clear: both;
  overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%; }
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd;  width:100%; padding:2px 0 4px 6px; background:#fff; border-radius:15px;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
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

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: none;
  margin: 0;
  padding: 10px 16px 5px;
}
.chat_list:hover{
  background:white;
  cursor:pointer;
}
.inbox_chat { 
  max-height: 70vh; overflow-y: scroll;overflow-x:hidden;word-wrap: wrap;  background: #cccccc73;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  
  font-size: 15px;
  font-weight:600;
  margin: 0;
  padding: 5px 5px 3px 5px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 23px 25px;
  width: 75%;
      background-color: #cccccc47;
	  overflow-y: scroll;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; 
  color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: #fff;
  border: 1px solid #ccc;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {

 border: none;
  background-color: inherit;
  padding: 14px 28px;
  
  
  color: #11d1d1;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;

}
button:focus {
    outline: 0px dotted;
    /* outline: 5px auto -webkit-focus-ring-color; */
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  overflow-y: auto;
}
hr {
    margin-top: 0.2rem;
    margin-bottom: 0;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
}
.altimg{
	max-width: 70%;
    margin: 0px 0px 0px 10px;
}
.altimg-m{
	max-width: 50%;
    margin: 0px 0px 0px 35px;
}
.altimg-main{
	    max-width: 24%;
    margin: 0px 0px 0px 10px;
    padding: 6px;
}


.search-bar{
	border-radius:15px;
	border:none;
	margin: 3px;
}
.btn.focus, .btn:focus {
    outline: 0;
    box-shadow: none;
}
/* .dropdown-menu {
    position: absolute;
    top: 100%;
    left: 118px;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 8rem;
    padding: 0.5rem 0.5rem;
    cursor:pointer;
    font-size: 1rem;
    color: #212529;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: .25rem;
	 margin-top: 10px;
}
.dropdown-menu a{
	color: #2125296e;
    text-decoration: none;
    padding: 0 0 0 9px;
    font-size: 15px;
	
}
.dropdown-menu a:hover{
	
	background-color:#ccc;
	color:#fff;
	
} */
::placeholder {
  color: #ccc;
  padding: 0 0 0 5px;
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
.sidebar input,
.sidebar textarea{
	width:100%;
	height:123px;
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
.sidebar textarea{
	height:60px;
	resize:none;
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
	content:'\f057';
	color: #212529;
    font-size: 16px;
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
        display:inline-flex;
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
.search-table{
    padding: 10%;
    margin-top: -6%;
}
.search-box{
    /* background: #c1c1c1;
    border: 1px solid #ababab; */
    padding:0 0 15px 0;
}

.search-list{
    background: #fff;
   /*  border: 1px solid #ababab; */
    border-top: none;
}
.search-list h3{
    background: #eee;
    padding: 3%;
    margin-bottom: 0%;
}
tbody {
    display:block;
    height:200px;
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
</style>
</head>
<body>
<div class="container " id="container">
<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
           
			<div class="input-group">
				<input type="text" class="search-bar input-sm" placeholder="Search">
				<span class="input-group-btn">
				<button class="btn btn-default" type="button"><i class="fas fa-plus-circle" style="font-size:20px"></i></button>
				</span>
			</div>

          </div>
		  <p  style="background: #8198A3;color:white; margin: 0; font-size: 18px; padding: 10px 10px 10px 20px;">General</p>
          <div class="inbox_chat">
            <?php
              $recents = json_decode($recentChats);
              foreach($recents->chats as $rc){ 
                ?>
            <div class="chat_list <?php echo $rc->id == $currentUserId ? "active_chat" : "";?>" onclick="loadNewChat('<?php echo $rc->id;?>','<?php echo $rc->isGroupYN;?>')">
              <div class="chat_people">
        
                <div class="chat_img">
        <div class='icon-container'>
          <!--<i class="fas fa-user-circle" style="font-size:25px"></i> -->
          <?php
            if($rc->imgUrl == null || $rc->imgUrl == "") {
              $rc->imgUrl = base_url().'assets/images/defaultUser.png';
            }
          ?>
          <img class="img" src="<?php echo $rc->imgUrl;?>" alt="img_src">
        </div>
        </div>
                <div class="chat_ib">
                  <h5><?php echo $rc->name;?></h5>
                  <p><?php echo substr($rc->lastText,0,50);?></p>
                </div>
              </div>
            </div>
          <?php 
        }?>
			
			<hr>
			
			<a style="text-decoration:none;" href="<?php echo site_url('messenger_api_controller/index')?>"><p style="margin: 0; font-size: 18px; padding: 10px 10px 10px 20px; color:#5a717c;">Individual</p></a>
            <?php
          $users = json_decode($users);
          foreach ($users->users as $chat) {?>
            <div class="chat_list" onclick="loadNewChat('<?php echo $chat->userid;?>','N')">
              <div class="chat_people">
                <div class="chat_img">
          <div class='icon-container'>
          <!--<i class="fas fa-user-circle" style="font-size:25px"></i> -->
          <?php
            if($chat->imageUrl == null || $chat->imageUrl == "") {
              $chat->imageUrl = base_url().'assets/images/defaultUser.png';
            }
          ?>
          <img class="img" src="<?php echo $chat->imageUrl;?>" alt="img_src">
        </div>
        </div>
        <div class="chat_ib">
          <h5><?php echo $chat->username;?></h5>
        </div>
              </div>
            </div><?php }?>
			<hr>
			<div class="row">
			<div class="col-md-6"><p class="text-muted" style="margin: 0; font-size: 18px; padding: 10px 10px 10px 20px;">Groups</p></div>
		
			<div class="col-md-6"><a href="#" title="Create group" style="text-decoration:none;" data-toggle="modal" data-target="#addtogroup"> <i class="fas fa-plus-circle" style="font-size:15px; margin: 17px 0 0 0;"></i> Add New</a></div>
			</div>
      <?php
          $groups = json_decode($groups);
          foreach ($groups->groups as $group) { 
            ?>
            <div class="chat_list"  onclick="loadNewChat('<?php echo $group->groupid;?>','Y')">
              <div class="chat_people">
                <div class="chat_img"> 
                  <div class='icon-container'>
                    <!--<i class="fas fa-user-circle" style="font-size:25px"></i> -->
                    <?php
                      if($group->avatarUrl == null || $group->avatarUrl == "") {
                        $group->avatarUrl = base_url().'assets/images/defaultUser.png';
                      }
                    ?>
                    <img class="img" src="<?php echo $group->avatarUrl;?>" alt="img_src">
                  </div>
                </div>
                <div class="chat_ib">
                  <h5><?php echo $group->groupName;?></h5>
                </div>
              </div>
            </div>
          <?php }?>

          </div>
        </div>
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
							 <div class="col-md-8" style="float:left;">
                <input type="text" class="form-control" id="recipient-name" required name="recipient-name" style="border-radius:0;background-color:#e5e5e5;border:none;"></div>
                <div class="col-md-12" style="color: red;" id="groupNameErr"></div>
						  </div>
						  </div>
						  <hr>
						  <div class="search-table">
							<div class="search-box">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="text" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Search Employee">
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
                        <td><input type="checkbox" name="<?php echo $chat->userid;?>" id="<?php echo $chat->userid;?>"></td>
                        <td>
							<div class="chat_people">
							<div class="chat_img">
							<div class='icon-container'>
								<img class="img" src="<?php echo $chat->imageUrl;?>" alt="img_src">
							</div>
							</div>
							<div class="chat_ib"><h5><?php echo $chat->username;?></h5></div>
							</div>
						</td>
                    </tr><?php }?>

                    
                    </tbody>
                </table>

            </div>
						  </div>
					  </div>
					  
					</div>
					<div class="modal-footer" style="border-top:none;">
						<button type="button" class="btn btn-secondary" onclick="saveGroup()">Save</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					</div>
						 
            </form> 
						  
						</div>
					  </div>
				</div>
		<!-- add to group model end -->
		<div class="container header">
		<div class="row" style="display:flex;justify-content:flex-end;margin:0">
			
			<div class="col-md-4 header-right">
			<div class="row" style="display:flex;justify-content:center;margin:0">
				<a href="javascript:void(0);" id="contact_us">
          <?php
            $currentUserInfo = json_decode($currentUserInfo);
            if($currentUserInfo->avatarUrl == null || $currentUserInfo->avatarUrl == ""){
              $currentUserInfo->avatarUrl = base_url().'assets/images/defaultUser.png';
            }
          ?>
				<div class="icon" style="display:flex;justify-content:center;margin:0">
          <img class="altimg-main" src="<?php echo $currentUserInfo->avatarUrl;?>" alt="img_src">
        </div></a>
				<p style="margin: 0; font-size: 20px; padding: 15px 10px 10px 20px;color: #1c73b8;"><?php 
          if($isGroupYN == "N")
            echo $currentUserInfo->memberName;
          else
            echo $currentUserInfo->groupName;
          ?></p>
			</div>
			</div>
			<!--<div class="col-md-4 header-right">
			<div class="dropdown">
              <a href="#"><i class="fas fa-ellipsis-v" style="float:right; margin-top: 20px; color: #607d8bc4; font-size: 19px;"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#"><i class="fas fa-eraser"></i> Clear Chat</a></li>
                <li><a href="#"><i class="fas fa-file-excel"></i> Export Chat</a></li>
              </ul>
            
			</div>
			</div>-->
			
		</div>		
	</div>
        <div class="mesgs" style="height:70vh;">
          <div class="msg_history" id="msg_history">
          <?php
              $currentChat = json_decode($currentChat);
              foreach ($currentChat->chats as $chats) { ?>
            <div class="incoming_msg">

              <div class="received_msg">
        <div class="received_withd_msg">
                  <div class="row">
          <div class="col-md-4"><p><?php echo 'name';?></p></div>
          <?php $date=date_create($chats->sentDateTime);?>
              <div class="col-md-4"><span class="time_date"><?php echo date_format($date,"d/m/Y H:i:s");?></span></div>
          </div>
        </div>
         <p><?php echo $chats->chatText;?></p>
              </div>
            </div>
          <?php }?>
        </div>
		  
		  
		  
          <div class="type_msg">
            <div class="input_msg_write">
              <form method="post" action="<?php echo base_url().'messenger/postNewMessage';?>" id="chatForm">
              <input type="text" class="write_msg" id="chatText" name="chatText" placeholder=" Type your message..." autofocus />
              <input type="hidden" name="receiverId" id="receiverId" value="<?php echo $currentUserId;?>">
              <input type="hidden" name="isGroupYN" id="isGroupYN" value="<?php echo $isGroupYN;?>">
              <button class="msg_send_btn" type="button" onclick="sendMessage()">SEND</button>
            </form>
            </div>
          </div>
		  
        </div>


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
							   <input type="image" src="<?php echo $currentUserInfo->avatarUrl;?>"/>
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
        			<p style="color:green;"><?php echo count($currentUserInfo->members);?> Participants</p>
        		</div>
        			<div class="card-body">
        			<ul class="list-group list-group-flush">
                <?php 
                foreach ($currentUserInfo->members as $mem) { ?>
        			<li class="list-group-item">   <div class="chat_list" onclick="loadNewChat('<?php echo $mem->memberid;?>','N')">
                      <div class="chat_people">
                        <div class="chat_img">
        					<div class='icon-container'>
        					<!--<i class="fas fa-user-circle" style="font-size:25px"></i> -->
                  <?php 
                    if($mem->avatarUrl == null || $mem->avatarUrl == "") { 
                      $mem->avatarUrl = base_url().'assets/images/defaultUser.png';
                    }
                   ?>
        					<img class="img" src="<?php echo $mem->avatarUrl;?>" alt="img_src">
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
				<div class="col-md-12">
					<div class="card2">
					<div class="box2">
					<div class="group-name">
					<div class="row">
            <form method="post" action="<?php echo base_url().'messenger/exitGroup';?>" id="exitGroupForm">
              <input type="hidden" value="<?php echo $currentUserInfo->groupid;?>" name="groupId">
						<div class="col-md-6" onclick="exitGroup()"><a href="#" name="exit" style="text-decoration:none;"><i class="fas fa-sign-out-alt"></i> Exit Group</a></div>
            </form>
            <?php 
              if($currentUserInfo->adminId == $this->session->userdata('LoginId')){ ?>
                <form method="post" action="<?php echo base_url().'messenger/deleteGroup';?>" id="deleteGroupForm">
              <input type="hidden" value="<?php echo $currentUserInfo->groupid;?>" name="groupId">
						<div class="col-md-6" onclick="deleteGroup()"><a href="#" name="delete_group" style="text-decoration:none;"><i class="fas fa-trash-alt"></i> Delete Group</button></div></form>
            <?php }?>
					</div>
					</div>
					</div>
					</div>
				</div>
<?php }
      else{ ?>
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
                 <img class="altimg-main" src="<?php echo $currentUserInfo->avatarUrl;?>" alt="img_src">
              </div>
              <h2><?php echo $currentUserInfo->memberName;?> <span><?php echo $currentUserInfo->designation;?></span></h2>
              
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card">
    <div class="card-header">
      <p style="color:green;">Groups in common</p>
    </div>
      <div class="card-body">
      <ul class="list-group list-group-flush">
        <?php
        foreach ($currentUserInfo->groups as $group) { ?>
      <li class="list-group-item">   <div class="chat_list" onclick="loadNewChat('<?php echo $group->groupid;?>','Y')">
              <div class="chat_people">
                <div class="chat_img">
          <div class='icon-container'>
          <div class="chat_img">
            <?php 
              if($group->avatarUrl == null || $group->avatarUrl == "")
                $group->avatarUrl = base_url().'assets/images/defaultUser.png';
              ?>
            <img class="altimg-main" src="<?php echo $group->avatarUrl;?>" alt="img_src">
          </div>
        </div>
        </div>
                <div class="chat_ib">
                  <h5><?php echo $group->groupName;?></h5>
                </div>
              </div>
            </div>
      </li><?php }?>          
      </ul>
    </div>
  </div>
        </div>
        </div>
      </div>
<?php } ?>



			</div>
			</div>
      </div>
    </div></div>
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
        $('#container').text('loading . . .');

      $.ajax({
        type:'POST',
        url : base_url + "messenger/chats/" + userid +"/" + isGroupYN,
        
        success: function(response) {
          $('#container').html(response)
        }
    });
    }

    function saveGroup(){
      var groupName = document.getElementById("recipient-name").value;
      if(groupName == ""){
        document.getElementById("groupNameErr").innerHTML = "Group name is required";
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
