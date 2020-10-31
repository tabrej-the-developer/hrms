<?php
$colors_array = ['#A4D9D6','#A4D9D6','#A4D9D6','#A4D9D6','#A4D9D6','#A4D9D6'];
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
    $url_page = "https"; 
else
    $url_page = "http"; 
$url_page .= "://"; 
$url_page .= $_SERVER['HTTP_HOST']; 
$url_page .= $_SERVER['REQUEST_URI'];
$url_page_array = explode("/",$url_page);
$selected = "";
$nth_child = 0;
  switch(strtolower($url_page_array[array_search("PN101",$url_page_array) + 1])){
    case strtolower("Dashboard"):
      $selected = "dashboard";
      $nth_child = 1;
      break;
    case strtolower("Roster"):
      $selected = "roster";
      $nth_child = 2;
      break;
    case strtolower("Timesheet"):
      $selected = "timesheet";
      $nth_child = 3;
      break;
    case strtolower("Payroll"):
      $selected = "payroll";
      $nth_child = 4;
      break;
    case strtolower("Leave"):
      $selected = "leaves";
      $nth_child = 5;
      break;
    // case strtolower("Jobs"):
    //   $nth_child = ;
    //   break;
    case strtolower("Messenger"):
      $selected = "messenger";
      $nth_child = 6;
      break;
    // case strtolower("Notice"):
    //   $nth_child = 8;
    //   break;
    case strtolower("Notice"):
      $selected = "notices";
      $nth_child = 7;
      break;
    // case strtolower("Settings"):
    //   $nth_child = 10;
    //   break;
    case strtolower("MOM"):
      $selected = "MOM";
      $nth_child = 8;
      break;
    // case strtolower("settings"):
    //     $selected = "settings";
    //     $nth_child = 8;
    //     break;
    case strtolower("settings"):
      $selected = "settings";
      $nth_child_div = 1;
      break;
    default:
      $nth_child = null;
  }
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
<html>
<head>

<title>PN101</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <!-- icons css-->
 
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--datepicker css -->


  <!--datepicker css end -->
  
  <!--datatable css -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />  
  <!--datatable css end -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/circle.css');?>">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

<style type="text/css">
  *{
font-family: 'Open Sans', sans-serif;
outline: none !important;
  }
  input:focus{
    outline: none !important;
  }
  .button,.buttonn{
    margin-right:5px;
  }
  button:focus{
    outline: none !important;
  }
  select:focus{
    outline: none !important;
  }
  select::-ms-expand {  display: none; }
select{
    -webkit-appearance: none;
    appearance: none;
}
select::after{
  content: ' ';
  
}

 body{/* background:#f9f9f9; */}
/*#wrapper{padding:32px 15px;}*/
.navbar-expand-lg .navbar-nav.side-nav{flex-direction: column;}
.card{margin-bottom: 15px; border-radius:0; box-shadow: 0 3px 5px rgba(0,0,0,.1); }
.header-top{
  /*box-shadow: 0 3px 5px rgba(0,0,0,.1)*/
}
.leftmenutrigger, .navbar-nav li a .shortmenu{display: none}
.card-title{ font-size: 28px}
.bg-info{
  background:#307bd3 !important;
}
@media(min-width:992px) {
#wrapper{
  /*padding: 46px 15px 15px 75px;*/
  max-width:200px;
  position: absolute;
   }
.navbar-nav.side-nav:hover {left:0;}
.side-nav li a {padding: 0.6rem 8px}
.navbar-nav li a .shortmenu {float: right;display: block;opacity: 1}

.navbar-nav.side-nav{box-shadow: 2px 1px 2px rgba(0,0,0,.1); position:fixed; top:0px; flex-direction: column!important;left:0px;width:200px;overflow-y:auto;bottom:0;overflow-x:hidden;padding-bottom:40px}
.bg-info{
  background:#307bd3 !important;
}

.navbar-nav{
    background:#171d4b; !important;
}
.nav-item-header:hover{
  background:white !important;
  padding: 0 0 0 20px;
}
.nav-item-header:hover::before{
  display: flex;
  margin-left:-15px;
  align-items: center;
  content: "";
  position: absolute;
  height: 30px;
  padding:5px;
  border-left:3px solid #307bd3;
  margin-top:5px;
}
.nav-item-header{
    background:#171d4b; !important;
  padding: 0 0 0 20px;
}
.nav-item-header-div:hover{
  background:white !important;
  padding: 0 0 0 20px;
}
.nav-item-header-div:hover::before{
  display: flex;
  margin-left:-15px;
  align-items: center;
  content: "";
  position: absolute;
  height: 30px;
  padding:5px;
  border-left:3px solid #307bd3;
  margin-top:5px;
}
.nav-item-header-div{
    background:#171d4b; !important;
  padding: 0 0 0 20px;
}
<?php if($nth_child != 0 || $nth_child != null){ ?>
.nav-item-header:nth-of-type(<?php echo $nth_child ;?>){
  background:white !important;
  padding: 0 0 0 20px;
}
.nav-item-header:nth-of-type(<?php echo $nth_child ;?>) a{
 font-weight: 500;
  color: #307bd3 !important;
  font-size: 1rem;
}
.nav-item-header:nth-of-type(<?php echo $nth_child ;?>)::before{
  display: flex;
  margin-left:-15px;
  align-items: center;
  content: "";
  position: absolute;
  height: 30px;
  padding:5px;
  border-left:3px solid #307bd3;
  margin-top:5px;
}
<?php }else{  ?>
.nav-item-header-div:nth-of-type(<?php echo $nth_child_div; ?>){
  background:white !important;
  padding: 0 0 0 20px;
}
.nav-item-header-div:nth-of-type(<?php echo $nth_child_div ;?>) a{
 font-weight: 500;
  color: #307bd3 !important;
  font-size: 1rem;
}

.nav-item-header-div:nth-of-type(<?php echo $nth_child_div; ?>)::before{
  display: flex;
  margin-left:-15px;
  align-items: center;
  content: "";
  position: absolute;
  height: 30px;
  padding:5px;
  border-left:3px solid #307bd3;
  margin-top:5px;
}
<?php } ?>
.nav-item-header a{
  font-weight: 500;
  color: #F3F4F7 !important; ;
  font-size: 1rem;
}
.nav-item-header-div a{
  font-weight: 500;
  color: #F3F4F7 !important; ;
  font-size: 1rem;
}
.nav-item-header a:hover{
  font-weight: 500;
  color: #307bd3 !important;
  font-size: 1rem;
}
.nav-item-header-div a:hover{
  font-weight: bolder;
  color: #307bd3 !important;
  text-decoration: none;
  font-size: 1rem;
}
i.mr-4{
  display: flex;
  justify-content: center;
  align-items: center;
}

.fixed-top{
  z-index: 0 !important;
}

.navbar-nav li a svg{font-size: 20px;float: left;margin: 0 12px 0 5px;}
.side-nav li {}
}
.PN101{
    height: 4rem;
    color: black;
    font-size: 1.5rem;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    border-bottom: 2px solid #171d4b;;
}
.todquest-logo{
  max-width: 100%
}
.navbar-fixed-elements{
  border-top:1px solid white !important;
  position: absolute;
  bottom: 0;width: 100%
}
.todquest_logo_bottom{
  width: 100%;
  height: 4rem;
    position: relative;
    display: flex;
    background: white;
}
.todq_logo{
  height: 5rem;
    position: relative;
    display: flex;
    background: white;
    display: flex;
    flex-direction: column;
}
.todq_logo span{
  font-size: 0.7rem;
    text-align: center;
    font-weight: 700;
    color: #4E4E4E
}
.todq_logo img{
    height: calc(3rem - 5px) !important;
    padding: 0 calc(4rem + 5px);
    width: 100%;
    padding-top: 5px;
}
.select_css{
  position: relative;
}
.select_css::after{
  content: ' ';
  position: absolute;
  background: url(<?php echo base_url('assets/images/icons/down.png') ?>);
  background-repeat: no-repeat;
  padding: 15px;
      margin-left: -28px;
    margin-top: 15px;
    background-size: 0.6rem 0.6rem;
    pointer-events: none !important
}
.no_drop_icon.select_css::after{
  background: none !important;
}
#user_data_id{
  height: 4rem;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
}
.user_data_class{
    width: 60%;
    text-align: left;
    padding-left: 1rem;
}
select{
  position: relative;
  padding-right: 2rem !important;
  padding-left: 7px !important;
  min-width: 5rem !important;
}
.tokenize{
  position: relative !important;
}
.tokenize:before{
      content: ' ';
    position: absolute;
    background: url(<?php echo base_url('assets/images/icons/search.png')?>);
    background-repeat: no-repeat;
    padding: 15px;
    margin-top: 15px;
    left: 0;
    margin-left: 10px;
    z-index:1;
    background-size: 0.8rem 0.8rem;
}
/*Notification css*/
      .notify_{
        /*display: none;*/
        visibility: hidden;
        position: fixed;
        min-height: 3rem;
        width: 15rem;
        background: #003153;
        right: 0;
        top: 30%;
        border-radius: 0.25rem;
        color: white
      }
      .notify_body{
        display: flex;
        justify-content: center;
        height: 100%;
      }
      ._notify_message{
        width:90%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }
      ._notify_close{
        width: 10%;
        background: rgba(255,255,255,1);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        position: absolute;
        right: 0;
        height: 100%;
        color: black;
      }
      ._notify_close:hover{
        background: rgba(255,255,255,0.8);
      }
      li{
        list-style: none;
      }
  .icon{
    font-size:0.75rem;
    display:flex;
    justify-content:center;
    align-self: center;
    border-radius: 50%;
    padding:0.25rem 0;
    color:#707070 !important;
    font-weight: 700;
    height: 1.5rem;
    width: 1.5rem;
    overflow: hidden;
  }
  .icon img{
    margin: -0.25rem 0;;
    width: inherit;
    height: inherit;
  }
  .icon-parent{
    display: flex;
    align-content: center;
    justify-content: center;
    padding:0;
  }
/*Notification css*/
@media only screen and (max-width:600px){
  .navbar{
    position: relative;
    background: #171d4b;;
  }
  .navbar-fixed-elements{
    position: relative;
  }
  .containers{
    height: calc(100vh - 56px );
  }
}

</style>
</head>
<body>
<div id="wrapper" class="animate">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark">
      <!-- <a class="navbar-brand" href="javascript:void(0);">PN101</a> -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav animate side-nav">
          <div class="PN101">
            <a class="" >
              <i ><img src="<?php echo base_url('assets/images/icons/amigo.jpeg');?>" class="todquest-logo"></i>         
            </a>
          </div>  
          <div userid="<?php echo $this->session->userdata('LoginId') ?>" id="user_data_id">
            <?php 
            $side_bar_name = "";
            if($this->session->has_userdata('Name')){
              $side_bar_name =  $this->session->userdata('Name');
              $side_bar_name = explode(' ',$side_bar_name);
              $userid = $this->session->userdata('LoginId');
            }
             ?>
            <span>
              <?php if(false){ ?>
              <img src="<?php echo base_url('') ?>" height="32px" width="32px">
            <?php }else{ ?>
            <span class="icon-parent">
              <span class=" icon" style="
                <?php echo "background:".$colors_array[rand(0,5)]?>">
                <?php
                if(isset($side_bar_name) && !file_exists('api/application/assets/profileImages/'.$userid.'.png')){ 
                  echo isset($side_bar_name[0]) ? icon($side_bar_name[0]) : "";
                }
                if(file_exists('api/application/assets/profileImages/'.$userid.'.png')){
                  ?>
                  <img src="<?php echo BASE_API_URL.'/application/assets/profileImages/'.$userid.'.png' ?>">
                  <?php
                }
                ?>
              </span>
            </span>
            <?php } ?>
            </span>
            <span class="user_data_class"><?php
            if(isset($side_bar_name)){
                 echo $side_bar_name[0]; 
              }
           ?></span>
            <span>
<!--               <i>
                <img src="<?php echo base_url('assets/images/icons/user_more.png'); ?>" style="max-height:1rem;margin-right:10px">
              </i> -->
            </span>
          </div>        
          <li class="nav-item-header" onmouseover="hover('dashboard','<?php echo $selected;?>')" onmouseout="hoverOff('dashboard','<?php echo $selected;?>')">
            <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('dashboard') ?>" title="Dashboard">
              <?php
              if($url_page_array[array_search("PN101",$url_page_array) + 1] == strtolower("Dashboard")){ ?>
              <i class="mr-4 " ><img id="dashboard" src="<?php echo base_url();?>assets/images/navbar-icons/dashboard.png" style="max-height: 1rem"></i>
              <?php }
              else{ ?>
              <i class="mr-4 " ><img id="dashboard" src="<?php echo base_url();?>assets/images/navbar-icons/dashboard_filled.png" style="max-height: 1rem"></i>
              <?php } ?>
              <span>Dashboard </span>
            </a>
          </li>
<?php // if((isset(json_decode($permissions)->permissions) ? json_decode($permissions)->permissions->viewRosterYN : "N") == "Y"){ ?> 
      <li class="nav-item-header" onmouseover="hover('roster','<?php echo $selected;?>')" onmouseout="hoverOff('roster','<?php echo $selected;?>')">
            <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('roster/roster_dashboard') ?>" title="roster">
              <?php
              if($url_page_array[array_search("PN101",$url_page_array) + 1] == strtolower("Roster")){ ?>
              <i class="mr-4 " ><img id="roster" src="<?php echo base_url();?>assets/images/navbar-icons/roster.png" style="max-height: 1rem"></i>
              <?php }
              else{ ?>
                 <i class="mr-4 " ><img id="roster" src="<?php echo base_url();?>assets/images/navbar-icons/roster_filled.png" style="max-height: 1rem"></i>
              <?php } ?>
              <span>Roster </span>
            </a>
          </li>
          <?php // }  ?>
          <?php // if((isset(json_decode($permissions)->permissions) ? json_decode($permissions)->permissions->viewTimesheetYN : "N") == "Y"){ ?>
          <li class="nav-item-header" onmouseover="hover('timesheet','<?php echo $selected;?>')" onmouseout="hoverOff('timesheet','<?php echo $selected;?>')">
            <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('timesheet/timesheetDashboard'); ?>" title="Leaves">
            <?php
              if($url_page_array[array_search("PN101",$url_page_array) + 1] == strtolower("Timesheet")){ ?>
              <i class="mr-4 " ><img id="timesheet" src="<?php echo base_url();?>assets/images/navbar-icons/timesheet.png" style="max-height: 1rem"></i>
              <?php }
              else{ ?>
                <i class="mr-4 " ><img id="timesheet" src="<?php echo base_url();?>assets/images/navbar-icons/timesheet_filled.png" style="max-height: 1rem"></i>
              <?php } ?>
              <span>Timesheet </span>
              </a>
          </li>
        <?php // } ?>
          <?php // if((isset(json_decode($permissions)->permissions) ? json_decode($permissions)->permissions->viewPayrollYN : "N") == "Y"){ ?>
      <li class="nav-item-header" onmouseover="hover('payroll','<?php echo $selected;?>')" onmouseout="hoverOff('payroll','<?php echo $selected;?>')">
            <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('payroll/payrollList'); ?>" title="payroll"> 
            <?php
              if($url_page_array[array_search("PN101",$url_page_array) + 1] == strtolower("Payroll")){ ?>
              <i class="mr-4 " ><img id="payroll" src="<?php echo base_url();?>assets/images/navbar-icons/payroll.png" style="max-height: 1rem"></i>
              <?php }
              else{ ?>
                <i class="mr-4 " ><img id="payroll" src="<?php echo base_url();?>assets/images/navbar-icons/payroll_filled.png" style="max-height: 1rem"></i>
              <?php } ?>
              <span>Payroll </span>
             </a>
          </li>
        <?php // } ?>
      <?php // if((isset(json_decode($permissions)->permissions) ? json_decode($permissions)->permissions->viewLeaveTypeYN : "N") == "Y"){ ?>
		      <li class="nav-item-header" onmouseover="hover('leaves','<?php echo $selected;?>')" onmouseout="hoverOff('leaves','<?php echo $selected;?>')">
            <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('leave') ?>" title="Leaves"> 
            <?php
              if($url_page_array[array_search("PN101",$url_page_array) + 1] == strtolower("Leave")){ ?>
              <i class="mr-4 " ><img id = "leaves" src="<?php echo base_url();?>assets/images/navbar-icons/leaves.png" style="max-height: 1rem"></i>
              <?php }
              else{ ?>
                <i class="mr-4 " ><img id = "leaves" src="<?php echo base_url();?>assets/images/navbar-icons/leaves_filled.png" style="max-height: 1rem"></i>
              <?php } ?>
              <span>Leaves </span>
             </a>
          </li>
		  <?php // } ?>
<!--           <li class="nav-item-header ">
            <a class="nav-link d-flex justify-content-start" href="#" title="Cart">
              
              <i class="mr-4" >
                <img src="<?php // echo base_url();?>assets/images/navbar-icons/jobs.png" style="max-height: 1rem">
              </i>
              <span>Jobs </span>
            </a>
          </li> -->

      <li class="nav-item-header" onmouseover="hover('messenger','<?php echo $selected;?>')" onmouseout="hoverOff('messenger','<?php echo $selected;?>')">
        <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('messenger') ?>" title="Cart"> 
          <?php
              if($url_page_array[array_search("PN101",$url_page_array) + 1] == strtolower("Messenger")){ ?>
              <i class="mr-4 " ><img id = "messenger" src="<?php echo base_url();?>assets/images/navbar-icons/messenger.png" style="max-height: 1rem"></i>
              <?php }
              else{ ?>
                <i class="mr-4 " ><img id = "messenger" src="<?php echo base_url();?>assets/images/navbar-icons/messenger_filled.png" style="max-height: 1rem"></i>
              <?php } 
          ?>
          <span>Messenger </span>
        </a>
      </li>
      <li class="nav-item-header" onmouseover="hover('notices','<?php echo $selected;?>')" onmouseout="hoverOff('notices','<?php echo $selected;?>')">
        <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('notice') ?>" title="Notices">
        <?php
              if($url_page_array[array_search("PN101",$url_page_array) + 1] == strtolower("Notice")){ ?>
              <i class="mr-4 " ><img id = "notices" src="<?php echo base_url();?>assets/images/navbar-icons/notices.png" style="max-height: 1rem"></i>
              <?php }
              else{ ?>
                <i class="mr-4 " ><img id = "notices" src="<?php echo base_url();?>assets/images/navbar-icons/notices_filled.png" style="max-height: 1rem"></i>
              <?php } 
          ?>
          <span>Notices </span>
        </a>
      </li>
              
		  
<!--       <li class="nav-item-header">
            <a class="nav-link d-flex justify-content-start" href="#" title="Settings">
             
           
              <i class="mr-4" >
                <img src="<?php echo base_url();?>assets/images/navbar-icons/reports.png" style="max-height: 1rem">
              </i>
              <span>Reports </span>
            </a>
          </li> -->
		  
      <!-- <li class="nav-item-header">
            <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('mom/') ?>" title="roster"> 
            <?php
              if($url_page_array[array_search("PN101",$url_page_array) + 1] == strtolower("MOM")){ ?>
              <i class="mr-4 " ><img src="<?php echo base_url();?>assets/images/navbar-icons/mom_filled.png" style="max-height: 1rem"></i>
              <?php }
              else{ ?>
                <i class="mr-4 " ><img src="<?php echo base_url();?>assets/images/navbar-icons/mom.png" style="max-height: 1rem"></i>
              <?php } 
          ?>
            
              <span>MOM </span>
          </a>
          </li> -->
          <div  class="navbar-fixed-elements">
            <li class="nav-item-header-div"  onmouseover="hover('settings','<?php echo $selected;?>')" onmouseout="hoverOff('settings','<?php echo $selected;?>')">
              <a class="nav-link-div d-flex justify-content-start" href="<?php echo site_url('settings') ?>" title="Settings">
              <?php
              if($url_page_array[array_search("PN101",$url_page_array) + 1] == strtolower("Settings")){ ?>
              <i class="mr-4 " ><img id = "settings" src="<?php echo base_url();?>assets/images/navbar-icons/settings.png" style="max-height: 1rem"></i>
              <?php }
              else{ ?>
                <i class="mr-4 " ><img id = "settings" src="<?php echo base_url();?>assets/images/navbar-icons/settings_filled.png" style="max-height: 1rem"></i>
              <?php } ?>
                <span>Settings </span>
              </a>
            </li>
            <li class="nav-item-header-div" onmouseover="hover('logout','<?php echo $selected;?>')" onmouseout="hoverOff('logout','<?php echo $selected;?>')">
            <a class="nav-link-div d-flex justify-content-start" href="<?php echo base_url();?>welcome/logout" >
                <i class="mr-4 " >
                  <img id="logout" src="<?php echo site_url();?>assets/images/navbar-icons/logout_filled.png"  style="height:1rem">
                </i>Logout</a>
          </li>
          <div class="todq_logo">
            <img src="<?php echo base_url('assets/images/icons/Todquest_logo.png'); ?>" class="todquest_logo_bottom">
            <span >
              <div>Powered by </div>
              <div>TODQUEST Edtech101 Pty Ltd</div>
            </span>
          </div>
        </div>
        <div></div>
        </ul>
        <!-- <ul class="navbar-nav ml-md-auto d-md-flex"> -->
<!--           <li class="nav-item-header">
            <a class="nav-link" href="javascript:void(0);" style="color:#f5f5f5;"><i class="fas fa-user-circle" style="color:#f5f5f5;"></i> <?php echo strtoupper($this->session->userdata('email')) ?></a>
          </li> -->
  <!--       
        </ul> -->
      </div>
    </nav>
  
  </div>
  <script>
    function hover(str,isCurrent){
      if(str!=isCurrent){
        const base_url = "<?php echo site_url();?>"+"assets/images/navbar-icons/";
        document.getElementById(str).src = base_url+str+".png";
        // alert(base_url + str + "_filled.png")
      }
    }
    function hoverOff(str,isCurrent){
      if(str!=isCurrent){
        const base_url = "<?php echo site_url();?>"+"assets/images/navbar-icons/";
        document.getElementById(str).src = base_url+str+"_filled.png";
      }
    }
  </script>

</body>




</html>
