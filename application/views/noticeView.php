<!DOCTYPE html>
<html lang="en">
<head>
  <title>Notices</title>
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.4.1.js"  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="  crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">

<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<style>
.navbar-nav .nav-item-header:nth-of-type(8) {
    background: var(--blue2) !important;
    position: relative;
}
.navbar-nav .nav-item-header:nth-of-type(8)::after {
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

</head>
<body>
<div class="wrapperContainer">
	<?php include 'headerNew.php'; ?>
	<div class="containers scrollY ">
    <div class="noticesContainer ">
      <?php $permissions = json_decode($permissions); ?>

        <div class="d-flex pageHead heading-bar">
          <span class="events_title" id="roster-heading">Notices</span>
          <span class=" sort-by rightHeader">
              <?php if(isset($permissions->permissions) ? $permissions->permissions->createNoticeYN : "N" == "Y"){ ?>
                <a class="btn btn-default btn-small btnOrange pull-right" href="<?php echo site_url('notice/createNotice')?>">
                <span class="material-icons-outlined">description</span> Create notice</a>
              <?php } ?>
          </span>
        </div>

        <div class="messaging ">
          <div class="inbox_msg d-flex">
            <div class="inbox_people">
              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <h6 style="font-size:18px;color:#171D4B;font-weight:700" id="noticeTitle">
                    <?php if(strtolower($noticeStatus) == strtolower('inbox')){ ?>
                      <span class="material-icons-outlined">inbox</span>
                      <span>Inbox</span>
                    <?php  }if(strtolower($noticeStatus) == strtolower('sent')){ ?>
                      <span class="material-icons-outlined">mark_email_read</span>
                    <span>Sent</span>
                    <?php }if(strtolower($noticeStatus) == strtolower('archived')){ ?>
                      <span class="material-icons-outlined">archive</span>
                    <span>Archive</span>
                    <?php  }  ?>
                  </h6>
                  <div class="dropdown">
                    <button class="btn-none dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="material-icons-outlined">arrow_drop_down</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                      <a class="dropdown-item" id="Inbox">
                      <span class="material-icons-outlined">inbox</span> Inbox
                      </a>
                      <a class="dropdown-item" id="Sent">
                      <span class="material-icons-outlined">mark_email_read</span> Sent
                      </a>
                      <a class="dropdown-item" id="Archived">
                      <span class="material-icons-outlined">archive</span> Archive
                      </a>
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
                      <div class="chat_img"> <img src="<?php echo base_url().'assets/images/defaultUser.png';?>" alt="user photo" class="userIcon"> </div>
                      <div class="chat_ib">
                        <h5><div class="text-muted h7 mb-2"><?php echo $notice->senderName;?></div></h5>
                        <h5 class="card-title"><?php echo $notice->subject;?><span class="chat_date"><?php echo dateToDay(date_format($date,"d/m/Y"));?></span></h5>
                      </div>
                    </div>
                  </div>
                  <?php } }else{ 
                  foreach ($allNotices as $notice) { 
                    $date=date_create($notice->date);
                  ?>
                  <div class="chat_list <?php if($notice->noticeId == $currentNotice->noticeId) echo 'active_chat';?>" onclick="loadNewNotice('<?php echo $notice->noticeId;?>')" id="<?php echo 'chat_list_'.$notice->noticeId;?>">
                    <div class="chat_people">
                      <div class="chat_img"> <img src="<?php echo base_url().'assets/images/defaultUser.png';?>" alt="user photo" class="userIcon"> </div>
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
              <?php if(isset($currentNotice)){ ?>
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
                    <div class="dropdowns">
                              
                      <?php 
                      if($noticeStatus == 'Inbox'){ ?>
                      <button class="btn btn-none dropdown-toggle" type="button" id="gedf-drop1" >
                      <span class="material-icons-outlined">arrow_drop_down</span>
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
          <div class="card-body">
           
            
                <h5 class="mailName"><?php echo $currentNotice->subject;?>  <div class="mailTime"> <i class="fas fa-clock"></i>
              <?php
              $date = date_create($currentNotice->date);
              echo dateToDay(date_format($date,'d/m/Y'));?>
            </div></h5>
                <?php echo html_entity_decode(stripslashes($currentNotice->text));?>
          </div>  
          <?php }
          else { ?>
            <span  class='no_notice'><img width="200px" src='<?php echo base_url("assets/images/no-notice.png");?>'> No notices</span>
          <?php } ?>
        </div>
                  <!-- Post-->
    </div>    
  </div>
</div>

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