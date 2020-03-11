<!doctype html>
<html>
<head>

<title>PN101</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>

  <!-- icons css-->
  <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>  
 
  
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
<style>

 body{/* background:#f9f9f9; */}
#wrapper{padding:32px 15px;}
.navbar-expand-lg .navbar-nav.side-nav{flex-direction: column;}
.card{margin-bottom: 15px; border-radius:0; box-shadow: 0 3px 5px rgba(0,0,0,.1); }
.header-top{box-shadow: 0 3px 5px rgba(0,0,0,.1)}
.leftmenutrigger, .navbar-nav li a .shortmenu{display: none}
.card-title{ font-size: 28px}
@media(min-width:992px) {
#wrapper{padding: 46px 15px 15px 75px; }
.navbar-nav.side-nav:hover {left:0;}
.side-nav li a {padding: 15px}
.navbar-nav li a .shortmenu {float: right;display: block;opacity: 1}
.navbar-nav.side-nav:hover li a .shortmenu{opacity: 0}
.navbar-nav.side-nav{background: #f5f5f5; box-shadow: 2px 1px 2px rgba(0,0,0,.1); position:fixed; top:56px; flex-direction: column!important;left:-140px;width:200px;overflow-y:auto;bottom:0;overflow-x:hidden;padding-bottom:40px}
}
.animate{-webkit-transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;-ms-transition:all .2s ease-in-out;transition:all .2s ease-in-out}
.navbar-nav li a svg{font-size: 20px;float: left;margin: 0 12px 0 5px;}
.side-nav li { border-bottom: 1px solid #607d8bc9;}
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
          <li class="nav-item">
            <a class="nav-link" href="#" title="Dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard <i class="fas fa-tachometer-alt shortmenu animate"></i></a>
          </li>
      <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('roster/roster_dashboard') ?>" title="roster"><i class="fas fa-calendar-alt"></i> Roster <i class="fas fa-calendar-alt shortmenu animate"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" title="Leaves"><i class="fas fa-suitcase"></i> Timesheet <i class="fas fa-suitcase shortmenu animate"></i></a>
          </li>
      <li class="nav-item">
            <a class="nav-link" href="#" title="payroll"><i class="fas fa-dollar-sign"></i> Payroll <i class="fas fa-dollar-sign shortmenu animate"></i></a>
          </li>
		      <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('leave') ?>" title="Leaves"><i class="fas fa-suitcase"></i> Leaves <i class="fas fa-suitcase shortmenu animate"></i></a>
          </li>
		  
          <li class="nav-item">
            <a class="nav-link" href="#" title="Cart"><i class="fas fa-lightbulb-o"></i> Jobs <i class="fas fa-lightbulb-o shortmenu animate"></i></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('messenger') ?>" title="Cart"><i class="fas fa-envelope"></i> Messenger <i class="fas fa-envelope shortmenu animate"></i></a>
          </li>
      <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('notice') ?>" title="Notices"><i class="fas fa-comment"></i> Notices <i class="fas fa-comment shortmenu animate"></i></a>
          </li>
		  
      <li class="nav-item">
            <a class="nav-link" href="#" title="Settings"><i class="fas fa-file"></i> Reports <i class="fas fa-file shortmenu animate"></i></a>
          </li>
		  
		  <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('settings') ?>" title="Settings"><i class="fas fa-cogs"></i> Settings <i class="fas fa-cogs shortmenu animate"></i></a>
          </li>

      <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('mom/') ?>" title="roster"><i class="fas fa-calendar-alt"></i> MOM <i class="fas fa-calendar-alt shortmenu animate"></i></a>
          </li>

        </ul>
        <ul class="navbar-nav ml-md-auto d-md-flex">
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0);" style="color:#f5f5f5;"><i class="fas fa-user-circle" style="color:#f5f5f5;"></i> <?php echo strtoupper($this->session->userdata('email')) ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>welcome/logout" style="color:#f5f5f5;"><i class="fas fa-sign-out-alt" style="color:#f5f5f5;"></i>Logout</a>
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