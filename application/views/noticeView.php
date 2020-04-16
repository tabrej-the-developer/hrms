<!DOCTYPE html>
<html lang="en">




<html>
<head>
<?php $this->load->view('header'); ?>
<style>
.container{
  max-width:100%;
   margin:auto;}

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
  overflow: hidden;
  width: 25%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
  border: none;
  clear: both;
  overflow: hidden;
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
.inbox_chat { height: 570px; overflow-y: auto;  background: #cccccc73;}

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
        }

        @media (min-width: 992px) {
            .gedf-main {
                padding-left: 4rem;
                padding-right: 4rem;
            }
            .gedf-card {
                margin-bottom: 2.77rem;
                border-bottom-left-radius: 10px;
                border-bottom-right-radius: 10px
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

.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
    height: 570px;
    overflow-y: scroll;
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
</style>
</head>
<body>
<div class="container">
<nav>
  <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color:#cccccc74;border-top-left-radius:10px;border-top-right-radius:10px;border:none;font-size:20px;font-weight:500;">
    Notices
    <span class="badge badge-default badge-pill"><a href="<?php echo site_url('notice/createNotice')?>" style="font-size:15px;text-decoration:none;"><i class="fas fa-plus-circle"></i> Create notice</a></span>
  </li>
</ul>
</nav>
<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          
           <ul class="list-group">
				<li class="list-group-item d-flex justify-content-between align-items-center"><h6 style="font-size:18px;color:#007bff" id="noticeTitle">
          <?php echo $noticeStatus;?>
        </h6>
				 <div class="dropdown">
                     <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-filter"></i></button>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                            <a class="dropdown-item" id="Inbox">Inbox</a>
                            <a class="dropdown-item" id="Sent">Sent</a>
                            <a class="dropdown-item" id="Archived">Archive</a>
                          </div>
                  </div>
			  </li>
			</ul>
			
          <div class="inbox_chat">

          <?php
            foreach ($allNotices as $notice) { 
              $date=date_create($notice->date);
              ?>
            <div class="chat_list <?php if($notice->noticeId == $currentNotice->noticeId) echo 'active_chat';?>" onclick="loadNewNotice('<?php echo $notice->noticeId;?>')" id="<?php echo 'chat_list_'.$notice->noticeId;?>">
              <div class="chat_people">
                <div class="chat_img"> <img src="<?php echo base_url().'assets/images/defaultUser.png';?>" alt="user photo"> </div>
                <div class="chat_ib">
                  <h5><div class="text-muted h7 mb-2"><?php echo $notice->senderName;?></div><span class="chat_date"><?php echo date_format($date,"d/m/Y");?></span></h5>
				   <h5 class="card-title"><?php echo $notice->subject;?></h5>
                </div>
              </div>
            </div>
          <?php }?>
            
			
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
                                    <div class="h6 m-0"><?php echo $currentNotice->senderName;?></div>
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
                          echo date_format($date,'d/m/Y');?>
                        </div>
                        
                            <h5 class="card-title"><?php echo $currentNotice->subject;?></h5>
                            <?php echo html_entity_decode(stripslashes($currentNotice->text));?>
                    </div>  
                  <?php }
                  else echo "<span style=\"font-size:30px;align-self:center\">No notices</span>";?>
                </div>
                <!-- Post-->
			
      </div>
    </div></div>
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

  (document).ready(function(){
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
