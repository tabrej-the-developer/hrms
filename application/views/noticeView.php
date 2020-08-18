<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('header'); ?>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
  *{
  font-family: 'Open Sans', sans-serif;
    }
  .container{
   max-width:100%;
   margin:auto;
   }
   body{
    background: #F3F4F7
   }
  img{
   max-width:75%;
 }

  .icon-container {
    width: 35px;
    height: 30px;
    position: relative;
  }

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
    overflow: hidden;
    width: 25%; border-right:1px solid #c4c4c4;
  }
  .inbox_msg {
    border: none;
    clear: both;
    overflow: hidden;
    padding-left: 1rem;
  }
  .top_spac{ margin: 20px 0 0;}

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
  .inbox_chat {
    height: calc(100vh - 9rem);
    overflow-y: auto;
    background: #FFFFFF;
    overflow-y: auto;
  }

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
  .h7 {
        font-size: 0.8rem;
    }

    .gedf-wrapper {
        margin-top: 0.97rem;
        margin-bottom: 0;
    }

    @media (min-width: 992px) {
        .gedf-main {
            padding-left: 4rem;
            padding-right: 4rem;
        }

    }

    /**Reset Bootstrap*/
    .dropdown-toggle::after {
        content: none;
        display: none;
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
    height: 516px;
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
.altimg-main{
	    max-width: 24%;
    margin: 0px 0px 0px 10px;
    padding: 6px;
}
.separator {
    display: flex;
    align-items: center;
    text-align: center;
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

input.rounded {
	border: none;
	/* -moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 2px 2px 3px #666;
	-webkit-box-shadow: 2px 2px 3px #666; */
	box-shadow: 1px 1px 2px #666;
	font-size: 14px;
	padding: 4px 12px;
	outline: 0;
	-webkit-appearance: none;
}
input.rounded:focus {
	border-color: #339933;
}
.rounded {
    border-radius: 1.25rem!important;
}
.card {
     margin-bottom: 0; 
    border-radius: 0;
    box-shadow: 0 3px 5px rgba(0,0,0,.1);
}
.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
    height: calc(100vh - 4vh);
    overflow-y: auto;
}
.card-header {
    padding: .75rem 1.25rem;
    margin-bottom: 0;
    background-color: #fff;
    border-bottom:0; 
}
.dropdown-menus{
  display:none;
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
.notices_heading{
  background-color:#F3F4F7;
  border:none;
  color: #171D4B;
  font-size: 1.75rem;
  font-weight:700;
  border-bottom-right-radius: 0rem;
  border-bottom-left-radius: 0rem;
}
.notice_nav_header{
  height:calc(100% - 5%);
}
.no_notice{
    font-size: 2rem;
    display: flex;
    align-items: center;
    color: #171D4B;
    font-weight: 700;
    height: calc(100vh - 5rem);
    justify-content: center;
}
.badge{
    border: none !important;
    color: rgb(23, 29, 75) !important;
    text-align: center !important;
    text-decoration: none !important;
    display: inline-block !important;
    font-weight: 700 !important;
    margin: 2px !important;
    min-width:6rem !important;
    border-radius: 20px !important;
    padding: 8px !important;
    background: rgb(164, 217, 214) !important;
    display: flex !important;
}

.badge a{
  color: #171D4B;
}
.gedf-card{
  height: calc(100vh - 5rem);
}
.chat_ib > h5 > div{
  color: #171D4B !important;
  font-weight: 700;
}
.heading_name{
  color: #171D4B;
  font-weight: 700;
}
</style>
</head>
<body>
<div class="container">
  <?php $permissions = json_decode($permissions); ?>
<nav class="notice_nav_header">
  <ul class="list-group">

  <li class="list-group-item d-flex justify-content-between align-items-center notices_heading" style="">
    Notices
    <?php if(isset($permissions->permissions) ? $permissions->permissions->createNoticeYN : "N" == "Y"){ ?>
    <span class="badge badge-default badge-pill"><a href="<?php echo site_url('notice/createNotice')?>" style="font-size:15px;text-decoration:none;">
            <i>
              <img src="<?php echo base_url('assets/images/icons/notice.png'); ?>" style="max-height:1rem;margin-right:10px">
            </i>Create notice</a></span>
    <?php } ?>
  </li>

</ul>
</nav>
<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          
           <ul class="list-group">
				<li class="list-group-item d-flex justify-content-between align-items-center">
          <h6 style="font-size:18px;color:#171D4B;font-weight:700" id="noticeTitle">
  <?php if(strtolower($noticeStatus) == strtolower('inbox')){ ?>
            <i>
              <img src="<?php echo base_url('assets/images/icons/inbox.png'); ?>" style="max-height:1rem;margin-right:10px">
            </i>
            <span>Inbox</span>
   <?php  }if(strtolower($noticeStatus) == strtolower('sent')){ ?>
            <i>
              <img src="<?php echo base_url('assets/images/icons/sent.png'); ?>" style="max-height:1rem;margin-right:10px">
            </i>
            <span>Sent</span>
    <?php }if(strtolower($noticeStatus) == strtolower('archived')){ ?>
            <i>
              <img src="<?php echo base_url('assets/images/icons/archive.png'); ?>" style="max-height:1rem;margin-right:10px">
            </i>
            <span>Archive</span>
     <?php  }  ?>
        </h6>
				 <div class="dropdown">
                     <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i>
        <img src="<?php echo base_url('assets/images/icons/down.png'); ?>" style="max-height:1rem;margin-right:10px">

      </i>
                     </button>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                            <a class="dropdown-item" id="Inbox">
            <i>
              <img src="<?php echo base_url('assets/images/icons/inbox.png'); ?>" style="max-height:0.8rem;margin-right:10px">
            </i>Inbox</a>
                            <a class="dropdown-item" id="Sent">
            <i>
              <img src="<?php echo base_url('assets/images/icons/sent.png'); ?>" style="max-height:0.8rem;margin-right:10px">
            </i>Sent</a>
                            <a class="dropdown-item" id="Archived">
            <i>
              <img src="<?php echo base_url('assets/images/icons/archive.png'); ?>" style="max-height:0.8rem;margin-right:10px">
            </i>Archive</a>
                          </div>
                  </div>
			  </li>
			</ul>
			
          <div class="inbox_chat">

          <?php
          if(preg_match('/Sent/',$_SERVER['REQUEST_URI']) == 0){
            foreach ($allNotices as $notice) { 
              
              $date=date_create($notice->date);
              ?>
            <div class="chat_list <?php if($notice->noticeId == $currentNotice->noticeId) echo 'active_chat';?>" onclick="loadNewNotice('<?php echo $notice->noticeId;?>')" id="<?php echo 'chat_list_'.$notice->noticeId;?>">
              <div class="chat_people">
                <div class="chat_img"> <img src="<?php echo base_url().'assets/images/defaultUser.png';?>" alt="user photo"> </div>
                <div class="chat_ib">
                  <h5><div class="text-muted h7 mb-2"><?php echo $notice->senderName;?></div><span class="chat_date"><?php echo dateToDay(date_format($date,"d/m/Y"));?></span></h5>
				   <h5 class="card-title"><?php echo $notice->subject;?></h5>
                </div>
              </div>
            </div>
          <?php } }else{ 
            foreach ($allNotices as $notice) { 

              $date=date_create($notice->date);
              ?>
            <div class="chat_list <?php if($notice->noticeId == $currentNotice->noticeId) echo 'active_chat';?>" onclick="loadNewNotice('<?php echo $notice->noticeId;?>')" id="<?php echo 'chat_list_'.$notice->noticeId;?>">
              <div class="chat_people">
                <div class="chat_img"> <img src="<?php echo base_url().'assets/images/defaultUser.png';?>" alt="user photo"> </div>
                <div class="chat_ib">
                  <h5><div class="text-muted h7 mb-2"><?php echo $notice->receiverId;?></div><span class="chat_date"><?php echo dateToDay(date_format($date,"d/m/Y"));?></span></h5>
           <h5 class="card-title"><?php echo $notice->subject;?></h5>
                </div>
              </div>
            </div>
          <?php } } ?>
            
			
          </div>

        </div>
		
         <!--Post-->
                <div class="card gedf-card">
                  <?php 
                  if(isset($currentNotice)){ ?>
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" src="<?php echo base_url().'assets/images/defaultUser.png';?>" alt="">
                                </div>
                                <div class="ml-2">
                                  <?php if(preg_match('/Sent/',$_SERVER['REQUEST_URI']) == 0){ ?>
                                    <div class="h6 m-0 heading_name"><?php echo $currentNotice->senderName;?></div>
                                  <?php }else{ ?>
                                    <div class="h6 m-0 heading_name"><?php echo $currentNotice->receiverId;?></div>
                                 <?php } ?>
                                </div>
                            </div>
                            <div>
                                <div class="dropdowns">
                                  
                                    <?php 
                                    if($noticeStatus == 'Inbox'){ ?>
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" >
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menus " aria-labelledby="gedf-drop1">
                                      <form id="statusForm" method="post" action="<?php echo base_url().'notice/updateStatus';?>">
                                      <input type="hidden" name="currentNoticeId" id="currentNoticeId" value="<?php echo $currentNotice->noticeId;?>">
                                        <div class="h6 dropdown-header" onclick="updateStatus()">Archive</div>
                                      </form>
                                    </div>
                                  <?php }?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="text-muted h7 mb-2"> <i class="fas fa-clock"></i>
                          <?php
                          $date = date_create($currentNotice->date);
                          echo dateToDay(date_format($date,'d/m/Y'));?>
                        </div>
                        
                            <h5 class="card-title"><?php echo $currentNotice->subject;?></h5>
                            <?php echo html_entity_decode(stripslashes($currentNotice->text));?>
                    </div>  
                  <?php }
                  else echo "<span  class='no_notice'>No notices</span>";?>
                </div>
                <!-- Post-->
			
      </div>
    </div></div>

<div class="modal-logout">
  <div class="modal-content-logout">
    <h3>You have been logged out!!</h3>
    <h4><a href="<?php echo base_url(); ?>">Click here</a> to login</h4>
  </div>
</div>
    </body>
	 
	<script>
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

  $(document).ready(function(){
    $(document).on("mouseover",".dropdowns", function() {
            $( ".dropdown-menus").css("display","block")
        });         
       $(document).on("mouseleave",".dropdowns", function() {
            $( ".dropdown-menus").css("display","none")
        });   
        
});

  $('.dropdown-item').click(function(e){
    var id = $(this).attr('id');
    var base_url ="<?php echo base_url().'notice/notices/';?>"+id;
    $.ajax({
      type:'POST',
      url:base_url,
      success:function(response){
       $('.inbox_chat').html($(response).find(".inbox_chat").html());
       $('.card').html($(response).find(".card").html());
       $('#noticeTitle').html($(response).find("#noticeTitle").html());

       var new_url=base_url;
       window.history.pushState("data","Title",new_url);
      },
    })
  })

 

   

	</script>

  <script type="text/javascript">
    var base_url = "<?php echo base_url();?>";
    var noticeStatus = "<?php echo $noticeStatus;?>";
    function loadNewNotice(noticeid){
      trim = window.location.href.split("/");
      if(trim[trim.indexOf('notices')+1] === ""){
        chatId= base_url + '/notice/notices/Inbox/' + noticeid;
      }else{
              chatId= window.location.href+ '/' + noticeid;
      }
      //alert(chatId)
    $(document).ready(function(){
      $.ajax({
      url:chatId,
      type:'POST',
      success: function(response){
       $('.card').html($(response).find(".card").html());
      
      }
    })
    })
  }
    function updateStatus(){
      document.getElementById('statusForm').submit();
    }
  </script>
  <script type="text/javascript">
    $(document).ready(()=>{
      $('.container').css('paddingLeft',$('.side-nav').width());
  });
  </script>
    </html>

<?php
  function dateToDay($date){
  if($date == date("d/m/Y",strtotime('Today'))){
    return "Today";
  }
  else if($date == date("d/m/Y",strtotime('Yesterday'))){
    return "Yesterday";
  }
  else{
    $date = explode("/",$date);
    return date("M d,Y",mktime(0,0,0,intval($date[1]),intval($date[0]),intval($date[2])));
  }
}
?>

<?php if( isset($error) ){ ?>
<script type="text/javascript">
  var modal = document.querySelector(".modal-logout");
    function toggleModal() {
        modal.classList.toggle("show-modal");
    }
  $(document).ready(function(){
      toggleModal();  
    })
    </script>
  <?php } ?>