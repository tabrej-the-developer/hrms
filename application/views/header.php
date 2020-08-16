<?php
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
    $url_page = "https"; 
else
    $url_page = "http"; 
$url_page .= "://"; 
$url_page .= $_SERVER['HTTP_HOST']; 
$url_page .= $_SERVER['REQUEST_URI'];
$url_page_array = explode("/",$url_page);
$nth_child = 0;
  switch($url_page_array[array_search("PN101",$url_page_array) + 1]){
    case strtolower("Dashboard"):
      $nth_child = 1;
      break;
    case strtolower("Roster"):
      $nth_child = 2;
      break;
    case strtolower("Timesheet"):
      $nth_child = 3;
      break;
    case strtolower("Payroll"):
      $nth_child = 4;
      break;
    case strtolower("Leave"):
      $nth_child = 5;
      break;
    // case strtolower("Jobs"):
    //   $nth_child = ;
    //   break;
    case strtolower("Messenger"):
      $nth_child = 6;
      break;
    // case strtolower("Notice"):
    //   $nth_child = 8;
    //   break;
    case strtolower("Notice"):
      $nth_child = 7;
      break;
    // case strtolower("Settings"):
    //   $nth_child = 10;
    //   break;
    case strtolower("MOM"):
      $nth_child = 8;
      break;
      default:
      $nth_child = null;
  }
  switch($url_page_array[array_search("PN101",$url_page_array) + 1]){
    case strtolower("settings"):
      $nth_child_div = 1;
      break;
}

?>
<!DOCTYPE html>
<html>
<head>

<title>PN101</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>

  <!-- icons css-->
 
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--datepicker css -->
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>

  <!--datepicker css end -->
  
  <!--datatable css -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />  
  <!--datatable css end -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/circle.css');?>">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

<style type="text/css">
  *{
font-family: 'Open Sans', sans-serif;

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
.side-nav li a {padding: 15px 8px}
.navbar-nav li a .shortmenu {float: right;display: block;opacity: 1}

.navbar-nav.side-nav{background: #f5f5f5; box-shadow: 2px 1px 2px rgba(0,0,0,.1); position:fixed; top:0px; flex-direction: column!important;left:0px;width:200px;overflow-y:auto;bottom:0;overflow-x:hidden;padding-bottom:40px}
.bg-info{
  background:#307bd3 !important;
}

.navbar-nav{
    background:#142059 !important;
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
  height: 40px;
  padding:5px;
  border-left:3px solid #307bd3;
  margin-top:5px;
}
.nav-item-header{
    background:#142059 !important;
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
  height: 40px;
  padding:5px;
  border-left:3px solid #307bd3;
  margin-top:5px;
}
.nav-item-header-div{
    background:#142059 !important;
  padding: 0 0 0 20px;
}
<?php if($nth_child != null){ ?>
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
  height: 40px;
  padding:5px;
  border-left:3px solid #307bd3;
  margin-top:5px;
}
<?php }else{ ?>
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
  height: 40px;
  padding:5px;
  border-left:3px solid #307bd3;
  margin-top:5px;
}
<?php } ?>
.nav-item-header a{
  font-weight: 500;
  color: rgba(255,255,255,.5) !important; ;
  font-size: 1rem;
}
.nav-item-header-div a{
  font-weight: 500;
  color: rgba(255,255,255,.5) !important; ;
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
  font-size: 1rem;
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
    border-bottom: 2px solid #142059;
}
.todquest-logo{
  width: 3rem
}
.navbar-fixed-elements{
  border-top:1px solid white !important;
  position: absolute;
  bottom: 0;width: 100%
}
@media only screen and (max-width:600px){
  .navbar{
    position: relative;
    background: #142059;
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
            <a class="mr-4" >
              <i ><img src="<?php echo base_url('assets/images/Todquest_logo.png');?>" class="todquest-logo"></i>
              <span>PN101 </span>
              
            </a>
          </div>          
          <li class="nav-item-header">
            <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('dashboard') ?>" title="Dashboard">
              
              <i class="mr-4 " ><img src="<?php echo base_url();?>assets/images/navbar-icons/dashboard.png" style="max-height: 1rem"></i>
              <span>Dashboard </span>
            </a>
          </li>
<?php // if((isset(json_decode($permissions)->permissions) ? json_decode($permissions)->permissions->viewRosterYN : "N") == "Y"){ ?> 
      <li class="nav-item-header">
            <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('roster/roster_dashboard') ?>" title="roster">
              <i class="mr-4" >
                <img src="<?php echo base_url();?>assets/images/navbar-icons/roster.png" style="max-height: 1rem">
              </i>
              <span>Roster </span>
            </a>
          </li>
          <?php // }  ?>
          <?php // if((isset(json_decode($permissions)->permissions) ? json_decode($permissions)->permissions->viewTimesheetYN : "N") == "Y"){ ?>
          <li class="nav-item-header">
            <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('timesheet/timesheetDashboard'); ?>" title="Leaves">
            
              <i class="mr-4" >
                <img src="<?php echo base_url();?>assets/images/navbar-icons/timesheet.png" style="max-height: 1rem">
              </i>
              <span>Timesheet </span>
              </a>
          </li>
        <?php // } ?>
          <?php // if((isset(json_decode($permissions)->permissions) ? json_decode($permissions)->permissions->viewPayrollYN : "N") == "Y"){ ?>
      <li class="nav-item-header">
            <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('payroll/payrollList'); ?>" title="payroll"> 
              <i class="mr-4" >
                <img src="<?php echo base_url();?>assets/images/navbar-icons/payroll.png" style="max-height: 1rem">
              </i>
              <span>Payroll </span>
              
             </a>
          </li>
        <?php // } ?>
      <?php // if((isset(json_decode($permissions)->permissions) ? json_decode($permissions)->permissions->viewLeaveTypeYN : "N") == "Y"){ ?>
		      <li class="nav-item-header">
            <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('leave') ?>" title="Leaves"> 
              
              <i class="mr-4" >
                <img src="<?php echo base_url();?>assets/images/navbar-icons/leaves.png" style="max-height: 1rem">
              </i>
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

      <li class="nav-item-header">
        <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('messenger') ?>" title="Cart"> 
          <i class="mr-4" >
            <img src="<?php echo base_url();?>assets/images/navbar-icons/messenger.png" style="max-height: 1rem">
          </i>
          <span>Messenger </span>
        </a>
      </li>
      <li class="nav-item-header">
        <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('notice') ?>" title="Notices">
          <i class="mr-4" >
            <img src="<?php echo base_url();?>assets/images/navbar-icons/notices.png" style="max-height: 1rem">
          </i>
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
		  
      <li class="nav-item-header">
            <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('mom/') ?>" title="roster"> 
             
            
              <i class="mr-4" >
                <img src="<?php echo base_url();?>assets/images/navbar-icons/mom.png" style="max-height: 1rem">
              </i>
              <span>MOM </span>
          </a>
          </li>
          <div  class="navbar-fixed-elements">
            <li class="nav-item-header-div">
              <a class="nav-link-div d-flex justify-content-start" href="<?php echo site_url('settings') ?>" title="Settings">
                <i class="mr-4" >
                  <img src="<?php echo base_url();?>assets/images/navbar-icons/settings.png" style="max-height: 1rem">
                </i>
                <span>Settings </span>
              </a>
            </li>
            <li class="nav-item-header-div" >
            <a class="nav-link-div d-flex justify-content-start" href="<?php echo base_url();?>welcome/logout" >
              <i class="mr-4" style="color:#f5f5f5;">
                <img src="<?php echo site_url();?>assets/images/navbar-icons/power.png" class="pr-2" style="height:1rem"></i>Logout</a>
          </li>
        </div>
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

</body>




</html>
