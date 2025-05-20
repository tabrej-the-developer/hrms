<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('header'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Superannuation Settings</title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
	
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
.navbar-nav .nav-item-header:nth-of-type(9) {
    background: var(--blue2) !important;
    position: relative;
}
.navbar-nav .nav-item-header:nth-of-type(9)::after {
    position: absolute;
    right: 0;
    top: 0;
    height: 100%;
    width: 3px;
    bottom: 0;
    content: "";
    background: var(--orange1);
}
	*{
		font-family: 'Open Sans', sans-serif;
	}
	body{
		background: #f2f2f2;
	}
		.containers{
		padding-left: 200px;
				height: 100vh;
    overflow-y: hidden;
	}
		thead tr{
			background-color: #8D91AA !important;
	    color: #F3F4F7;
		}
		thead tr th{
	    vertical-align: middle !important;
		}
		tbody{
			overflow-y: auto
		}
		tr:nth-child(even){
			background:#fff;
		}
		tr:nth-child(odd){

			background:#fff;
		}
		tr{
			line-height: 1rem
	    border-top: 1px solid #d2d0d0;
	    border-bottom: 1px solid #d2d0d0;
		}
		td{
			font-size: 0.85rem;
			line-height: 1rem;

		}

		.table-div{
			height:100%;
			overflow-y: auto;
		}	
		.table  td,.table th{
			padding: 1rem;
			border: none;
		}
		.sort-by{

		}

		.center-list{
			display:none;
			box-shadow:0 0 1px 1px rgb(242, 242, 242) ;
		}
		.center-list a{
			display:block;
			position: relative;
			text-decoration: none;
			color:black;			
		}
		.sort-by:hover .center-list{
			display:block;
			background:white;
			position:absolute;
			margin-top:5px;
			margin-left:-15px;
			padding:10px;
		}
		.sort-by:hover::after{
			position:absolute;
						
		}

		.filter-icon{
			border:1px solid rgba(0,0,0,0.7);
			padding:8px;
			border-radius: 20px
		}
		.create{
			border:3px solid rgb(242, 242, 242);
			border-radius: 20px;
			padding:8px;
		}
		.data-buttons{
			padding:10px;
		}
		#centerValue{
			background: rgb(164, 217, 214);
		}

#down-arrow::after{
		position:relative;
        content: " \2193";
        top: 0px;
        right: 20px;
        height: 10px;
        width: 20px;
}
.notifications-body{
    background: white;
    height: 100%;
}
.notifications_unread{
    max-height: 50%;
    overflow-y: auto;
}
.notifications_read{
    height: 50%;
    overflow-y: auto;
}
	.button{
		background-color: #9E9E9E;
  border: none;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 2px
}
.dataTables_info{
	font-size:0.85rem;
}
.dataTables_paginate{
	font-size:0.85rem;
}
.paginate_button{
	background:transparent;
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
        z-index:150;
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
    .notifications-container{
    	padding: 1rem 1rem 1rem 2rem;
    	height: 100%;
    overflow: hidden;
    }
    .notifications-container-child{
    	background: white;
    	height: 100%;
	    height: calc(100vh - 6rem);
    }
.buttonn,
.button,
#notifications{
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
      background: rgb(164, 217, 214);
      font-size: 1rem !important;
      margin-right:5px !important;
      justify-content: center !important;
      display: flex;
      align-items: center;
}
.back-button span{
    font-size: 1.75rem;
    color: #171D4B;
    font-weight: 700;
}
		.notification-container-child{
    	/*padding: 4rem 3rem 2rem 2rem;*/
    	height: 100%;
	    overflow: hidden;
	    font-weight: 700;
	    /*padding: 1rem 0 1rem 2rem;*/
	    margin: 0 !important;
	    color: rgba(11, 36, 107);
	    width: 100%;
	    font-size: 1.75rem;
		}
		.notifications_header_container{
	    padding: 1rem 1rem 0rem 2rem;
			display: flex;
		}
		#notifications{
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
      background: rgb(164, 217, 214);
      font-size: 1rem !important;
      margin-right:5px !important;
      justify-content: center !important;
      display: flex;
      align-items: center;
}input[type="text"],input[type=time],select,#casualEmp_date{
  background: #ebebeb;
  border-radius: 5px;
    padding: 5px;
    border: 1px solid #D2D0D0 !important;
    border-radius: 20px;
}
.notigivation_body{
    position: absolute;
width: 1177px;
height: 76px;
left: 229px;
top: 168px;

background: #E5E5E5;
border-radius: 10px;
}
.disabled{
  background: rgb(235, 235, 228) !important;
}
.viewMore{
    text-align: center;
    color: #0000FF;
}
.viewMore:hover{
    text-decoration : underline;
    cursor: pointer;
}
@media only screen and (max-width:1024px) {
.modal-content{
	min-width:100vw;
}
.containers {
     width: 100%;
    margin: 0px;
    padding:0;
}
}
</style>
</head>
<body>

<div class="containers">
    <?php $notifications = json_decode($notifications); ?>
	<span class="notifications_header_container">
        <a href="<?php echo base_url();?>/settings">
            <button class="btn back-button">
                <img src="<?php echo base_url('assets/images/back.svg');?>">
            </button>
        </a>
      <span  class="notification-container-child">Notifications</span>
    </span>
	<div class="notifications-container">
        <div class="notifications-body">
            <div>Pending</div>
            <div class="notifications_unread">
            <?php 
                $check = false;
                $point = 0;
                if (isset($notifications->Notifications)) {
                    $notfs = $notifications->Notifications;
                   for($i=0;$i<count($notfs);$i++) {
                       if($notfs[$i]->isReadYN == 'N' || $notfs[$i]->isReadYN == null){
                       ?>
                    <div class="notification_body" style="background:#E5E5E5;display:flex;border-radius:0.5rem;margin-bottom:1rem">
                        <div style="width:10%;display:flex;align-items:center;justify-content:center">
                            <img src="<?php echo base_url('assets/images/defaultUser.png') ?>" height="25px">
                        </div>
                        <div style="width:90%;">
                            <div><?php echo $notfs[$i]->title ?></div>
                            <div><?php echo $notfs[$i]->body ?></div>
                        </div>
                    </div>
                       <?php
                       }else{
                           $point = $i;
                           break;
                       }
                   }
                }
            ?>
            </div>
            <div>All</div>
            <div class="notifications_read">
            <?php 
                if (isset($notifications->Notifications)) {
                    $notfs = $notifications->Notifications;
                    for($i=$point;$i<count($notfs);$i++) {
                        if($notfs[$i]->isReadYN == 'Y'){
                       ?>
                    <div class="notification_body" style="background:#E5E5E5;display:flex;border-radius:0.5rem;margin-bottom:1rem">
                        <div style="width:10%;display:flex;align-items:center;justify-content:center">
                            <img src="<?php echo base_url('assets/images/defaultUser.png') ?>" height="25px">
                        </div>
                        <div style="width:90%;">
                            <div><?php echo $notfs[$i]->title ?></div>
                            <div><?php echo $notfs[$i]->body ?></div>
                        </div>
                    </div>
                       <?php
                        }
                   }
                }
            ?>
                <div class="viewMore">
                    View More
                </div>
            </div>
        </div>
	</div>
</div>


<div class="modal-logout">
    <div class="modal-content-logout">
        <h3>You have been logged out!!</h3>
        <h4><a href="<?php echo base_url(); ?>">Click here</a> to login</h4>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(()=>{
		if($(document).width() > 1024){
		    $('.containers').css('paddingLeft',$('.side-nav').width());
		}
});

window.history.replaceState(null, 'WONDERFUL', `Notifications?count=0`);

$(document).on('click','.viewMore',function() {
    let searchParams = new URLSearchParams(window.location.search);
    let start = searchParams.get('count');
    var url = "<?php echo base_url(); ?>Notifications/getNotifications/"+start;
    $('.viewMore').remove();
    $.ajax({
        url : url,
        type : 'GET',
        success : function(response){
            var parsed = JSON.parse(response);
            console.log(parsed.Notifications)
            if(parsed.Notifications.length != 0){
                parsed.Notifications.forEach(function(notf){
                    var code = `<div class="notification_body" style="background:#E5E5E5;display:flex;border-radius:0.5rem;margin-bottom:1rem"><div style="width:10%;display:flex;align-items:center;justify-content:center"><img src="<?php echo base_url('assets/images/defaultUser.png') ?>" height="25px"></div><div style="width:90%;"><div>${notf.title} </div><div>${notf.body} </div></div></div>`;
                        if(notf.isReadYN == 'Y')
                            $('.notifications_read').append(code);
                })
                $('.notifications_read').append('<div class="viewMore">View More</div>')
            }
            window.history.replaceState(null, 'WONDERFUL', `Notifications?count=${parseInt(start)+25}`);
        } 
    })
});

</script>

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
	<?php }
?>

</body>
</html>
