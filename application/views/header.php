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
    case strtolower("Leaves"):
      $nth_child = 5;
      break;
    case strtolower("Jobs"):
      $nth_child = 6;
      break;
    case strtolower("Messenger"):
      $nth_child = 7;
      break;
    case strtolower("Notice"):
      $nth_child = 8;
      break;
    case strtolower("Reports"):
      $nth_child = 9;
      break;
    case strtolower("Settings"):
      $nth_child = 10;
      break;
    case strtolower("MOM"):
      $nth_child = 11;
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

 body{/* background:#f9f9f9; */}
#wrapper{padding:32px 15px;}
.navbar-expand-lg .navbar-nav.side-nav{flex-direction: column;}
.card{margin-bottom: 15px; border-radius:0; box-shadow: 0 3px 5px rgba(0,0,0,.1); }
.header-top{box-shadow: 0 3px 5px rgba(0,0,0,.1)}
.leftmenutrigger, .navbar-nav li a .shortmenu{display: none}
.card-title{ font-size: 28px}
.bg-info{
  background:#307bd3 !important;
}
@media(min-width:992px) {
#wrapper{padding: 46px 15px 15px 75px; }
.navbar-nav.side-nav:hover {left:0;}
.side-nav li a {padding: 15px}
.navbar-nav li a .shortmenu {float: right;display: block;opacity: 1}

.navbar-nav.side-nav{background: #f5f5f5; box-shadow: 2px 1px 2px rgba(0,0,0,.1); position:fixed; top:56px; flex-direction: column!important;left:0px;width:200px;overflow-y:auto;bottom:0;overflow-x:hidden;padding-bottom:40px}
.bg-info{
  background:#307bd3 !important;
}
.nav-item-header a{
  font-weight: bolder;
  color:#a4a4a4 !important;
  font-size: 0.75rem;
}
.navbar-nav{
    background:white !important;
}
.nav-item-header{
    background:white !important;
  padding: 0 0 0 20px;
}
.nav-item-header:hover{
  background:#ecf5fd !important;
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
.nav-item-header a:hover{
  font-weight: bolder;
  color:#307bd3 !important;
  font-size: 0.75rem;
}



.nav-item-header:nth-child(<?php echo $nth_child ;?>){
  background:#ecf5fd !important;
  padding: 0 0 0 20px;
}
.nav-item-header:nth-child(<?php echo $nth_child ;?>)::before{
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
.nav-item-header a:nth-child(<?php echo $nth_child ;?>){
  font-weight: bolder;
  color:#307bd3 !important;
  font-size: 0.75rem;
}


.navbar-nav li a svg{font-size: 20px;float: left;margin: 0 12px 0 5px;}
.side-nav li {}
.navbar-dark .navbar-nav .nav-link {
    color: #607d8bc9;
}
.navbar-dark .navbar-nav .nav-link:hover {
    color: #607d8b;
}
</style>
</head>
<body>

<div id="wrapper" class="animate">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-info">
      <a class="navbar-brand" href="javascript:void(0);">PN101</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav animate side-nav">
          <li class="nav-item-header">
            <a class="nav-link d-flex justify-content-around" href="#" title="Dashboard">
              <span>Dashboard </span>
              <i class="ml-auto" ><img src="<?php echo base_url();?>assets/images/dashboard.png" style="max-height: 1.3rem"></i>
            </a>
          </li>
      <li class="nav-item-header">
            <a class="nav-link d-flex justify-content-around" href="<?php echo site_url('roster/roster_dashboard') ?>" title="roster">
              <span>Roster </span>
              <i class="ml-auto" >
                <img src="<?php echo base_url();?>assets/images/roster.png" style="max-height: 1.3rem">
              </i>
            </a>
          </li>
          <li class="nav-item-header">
            <a class="nav-link d-flex justify-content-around" href="<?php echo site_url('timesheet/timesheetDashboard'); ?>" title="Leaves">
             
             <span>Timesheet </span>
              <i class="ml-auto" >
                <img src="<?php echo base_url();?>assets/images/timesheet.png" style="max-height: 1.3rem">
              </i>
              </a>
          </li>
      <li class="nav-item-header">
            <a class="nav-link d-flex justify-content-around" href="<?php echo site_url('payroll/payrollList'); ?>" title="payroll"> 
              <span>Payroll </span>
              <i class="ml-auto" >
                <img src="<?php echo base_url();?>assets/images/payroll.png" style="max-height: 1.3rem">
              </i>
             </a>
          </li>
		      <li class="nav-item-header">
            <a class="nav-link d-flex justify-content-around" href="<?php echo site_url('leave') ?>" title="Leaves"> 
              <span>Leaves </span>
              <i class="ml-auto" >
                <img src="<?php echo base_url();?>assets/images/leaves.png" style="max-height: 1.3rem">
              </i>
             </a>
          </li>
		  
          <li class="nav-item-header ">
            <a class="nav-link d-flex justify-content-around" href="#" title="Cart">
              <span>Jobs </span>
              <i class="ml-auto" >
                <img src="<?php echo base_url();?>assets/images/jobs.png" style="max-height: 1.3rem">
              </i>
            </a>
          </li>

          <li class="nav-item-header">
            <a class="nav-link d-flex justify-content-around" href="<?php echo site_url('messenger') ?>" title="Cart"> 
              <span>Messenger </span>
              <i class="ml-auto" >
                <img src="<?php echo base_url();?>assets/images/messenger.png" style="max-height: 1.3rem">
              </i>
            </a>
          </li>
      <li class="nav-item-header">
            <a class="nav-link d-flex justify-content-around" href="<?php echo site_url('notice') ?>" title="Notices">
              <span>Notices </span>
              <i class="ml-auto" >
                <img src="<?php echo base_url();?>assets/images/notices.png" style="max-height: 1.3rem">
              </i>
            </a>
          </li>
		  
      <li class="nav-item-header">
            <a class="nav-link d-flex justify-content-around" href="#" title="Settings">
             
           <span>Reports </span>
              <i class="ml-auto" >
                <img src="<?php echo base_url();?>assets/images/reports.png" style="max-height: 1.3rem">
              </i>
            </a>
          </li>
		  
		  <li class="nav-item-header">
            <a class="nav-link d-flex justify-content-around" href="<?php echo site_url('settings') ?>" title="Settings">
             
             <span>Settings </span>
              <i class="ml-auto" >
                <img src="<?php echo base_url();?>assets/images/settings.png" style="max-height: 1.3rem">
              </i>
             </a>
          </li>

      <li class="nav-item-header">
            <a class="nav-link d-flex justify-content-around" href="<?php echo site_url('mom/') ?>" title="roster"> 
             
            <span>MOM </span>
              <i class="ml-auto" >
                <img src="<?php echo base_url();?>assets/images/mom.png" style="max-height: 1.3rem">
              </i>
          </a>
          </li>

        </ul>
        <ul class="navbar-nav ml-md-auto d-md-flex">
<!--           <li class="nav-item-header">
            <a class="nav-link" href="javascript:void(0);" style="color:#f5f5f5;"><i class="fas fa-user-circle" style="color:#f5f5f5;"></i> <?php echo strtoupper($this->session->userdata('email')) ?></a>
          </li> -->
          <li class="nav-item-header" style="background: #307bd3 !important">
            <a class="nav-link" href="<?php echo base_url();?>welcome/logout" style="color:white !important;">
              <i class="" style="color:#f5f5f5;">
                <img src="<?php echo base_url();?>assets/images/logout.png" class="pr-2" style="height:1.3rem"></i>Logout</a>
          </li>
        </ul>
      </div>
    </nav>
  
  </div>

</body>


<!-- Datatable start -->
    
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script>
    <!-- Datatable end -->

</html>
