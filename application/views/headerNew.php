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
  switch(strtolower($url_page_array[array_search("HRMS101",$url_page_array) + 1])){
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
    case strtolower("Notifications"):
      $selected = "Notifications";
      $nth_child = 9;
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
<div id="wrapper" class="animate">
  <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark">
    <!-- <a class="navbar-brand" href="javascript:void(0);">PN101</a> -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <div class="PN101">
        <a class="" >
          <?php $cI = $this->session->userdata('companyImage'); ?>
          <i ><img src="<?php echo base_url("assets/images/icons/$cI");?>" class="todquest-logo"></i>         
        </a>
      </div> 
      <?php /* ?>
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
                if(isset($side_bar_name) && isset($userid) &&  !file_exists('api/application/assets/profileImages/'.$userid.'.png')){ 
                  echo isset($side_bar_name[0]) ? icon($side_bar_name[0]) : "";
                }
                if(isset($userid) &&  file_exists('api/application/assets/profileImages/'.$userid.'.png') ){
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
            if(isset($side_bar_name[0])){
                 echo $side_bar_name[0]; 
              }
           ?></span>
            <span>
<!--               <i>
                <img src="<?php echo base_url('assets/images/icons/user_more.png'); ?>" style="max-height:1rem;margin-right:10px">
              </i> -->
            </span>
          </div>  
          <?php */ ?> 
      <ul class="navbar-nav animate side-nav">
        <li class="nav-item-header" onmouseover="hover('dashboard','<?php echo $selected;?>')" onmouseout="hoverOff('dashboard','<?php echo $selected;?>')">
          <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('dashboard') ?>" title="Dashboard">
            <?php if($url_page_array[array_search("HRMS101",$url_page_array) + 1] == strtolower("Dashboard")){ ?>
              <span class="material-icons-outlined">dashboard_customize</span>
            <?php } else{ ?>
              <span class="material-icons-outlined">dashboard_customize</span>
            <?php } ?>
            <span>Dashboard </span>
          </a>
        </li>
        <?php // if((isset(json_decode($permissions)->permissions) ? json_decode($permissions)->permissions->viewRosterYN : "N") == "Y"){ ?> 
          <li class="nav-item-header" onmouseover="hover('roster','<?php echo $selected;?>')" onmouseout="hoverOff('roster','<?php echo $selected;?>')">
            <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('roster/roster_dashboard') ?>" title="Roster">
              <?php if($url_page_array[array_search("HRMS101",$url_page_array) + 1] == strtolower("Roster")){ ?>
                <span class="material-icons-outlined">list_alt</span>
              <?php } else{ ?>
                <span class="material-icons-outlined">list_alt</span>
              <?php } ?>
              <span>Roster </span>
            </a>
          </li>
          <?php // }  ?>
        <?php // if((isset(json_decode($permissions)->permissions) ? json_decode($permissions)->permissions->viewTimesheetYN : "N") == "Y"){ ?>
          <li class="nav-item-header" onmouseover="hover('timesheet','<?php echo $selected;?>')" onmouseout="hoverOff('timesheet','<?php echo $selected;?>')">
            <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('timesheet/timesheetDashboard'); ?>" title="Timesheet">
              <?php if($url_page_array[array_search("HRMS101",$url_page_array) + 1] == strtolower("Timesheet")){ ?>
                <span class="material-icons-outlined">event_note</span>
              <?php } else{ ?>
                <span class="material-icons-outlined">event_note</span>
              <?php } ?>
              <span>Timesheet </span>
            </a>
          </li>
        <?php // } ?>
        <?php // if((isset(json_decode($permissions)->permissions) ? json_decode($permissions)->permissions->viewPayrollYN : "N") == "Y"){ ?>
          <li class="nav-item-header" onmouseover="hover('payroll','<?php echo $selected;?>')" onmouseout="hoverOff('payroll','<?php echo $selected;?>')">
            <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('payroll/payrollList'); ?>" title="Payroll"> 
            <?php if($url_page_array[array_search("HRMS101",$url_page_array) + 1] == strtolower("Payroll")){ ?>
              <span class="material-icons-outlined">payments</span>
            <?php } else{ ?>
              <span class="material-icons-outlined">payments</span>
            <?php } ?>
            <span>Payroll </span>
            </a>
          </li>
        <?php // } ?>
        <?php // if((isset(json_decode($permissions)->permissions) ? json_decode($permissions)->permissions->viewLeaveTypeYN : "N") == "Y"){ ?>
		      <li class="nav-item-header" onmouseover="hover('leaves','<?php echo $selected;?>')" onmouseout="hoverOff('leaves','<?php echo $selected;?>')">
            <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('leave') ?>" title="Leave"> 
            <?php if($url_page_array[array_search("HRMS101",$url_page_array) + 1] == strtolower("Leave")){ ?>
              <span class="material-icons-outlined">task</span>
            <?php } else{ ?>
              <span class="material-icons-outlined">task</span>
            <?php } ?>
            <span>Leave</span>
            </a>
          </li>
		    <?php // } ?>
          <!--<li class="nav-item-header ">
                <a class="nav-link d-flex justify-content-start" href="#" title="Cart">
                  <i class="mr-4" >
                    <img src="<?php // echo base_url();?>assets/images/navbar-icons/jobs.png" style="max-height: 1rem">
                  </i>
                  <span>Jobs </span>
                </a>
              </li> -->

        <li class="nav-item-header" onmouseover="hover('messenger','<?php echo $selected;?>')" onmouseout="hoverOff('messenger','<?php echo $selected;?>')">
          <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('messenger') ?>" title="Chat101"> 
            <?php if($url_page_array[array_search("HRMS101",$url_page_array) + 1] == strtolower("Messenger")){ ?>
              <span class="material-icons-outlined">forum</span>
            <?php } else{ ?>
              <span class="material-icons-outlined">forum</span>
            <?php } ?>
            <span>Chat101 </span>
          </a>
        </li>

        <li class="nav-item-header" onmouseover="hover('reimbursement','<?php echo $selected;?>')" onmouseout="hoverOff('reimbursement','<?php echo $selected;?>')">
          <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('reimbursement') ?>" title="Reimbursement"> 
            <?php if($url_page_array[array_search("HRMS101",$url_page_array) + 1] == strtolower("reimbursement")){ ?>
              <span class="material-icons-outlined">monetization_on</span>
            <?php } else{ ?>
              <span class="material-icons-outlined">monetization_on</span>
            <?php } ?>
            <span>Reimbursement </span>
          </a>
        </li>

        <li class="nav-item-header" onmouseover="hover('notices','<?php echo $selected;?>')" onmouseout="hoverOff('notices','<?php echo $selected;?>')">
          <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('notice') ?>" title="Notice">
            <?php if($url_page_array[array_search("HRMS101",$url_page_array) + 1] == strtolower("Notice")){ ?>
              <span class="material-icons-outlined">receipt_long</span>
            <?php } else{ ?>
              <span class="material-icons-outlined">receipt_long</span>
            <?php } ?>
            <span>Notices </span>
          </a>
        </li>
        <!-- <li class="nav-item-header" onmouseover="hover('notices','<?php echo $selected;?>')" onmouseout="hoverOff('notices','<?php echo $selected;?>')">
              <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('notifications') ?>" title="Notice">
              <?php if($url_page_array[array_search("HRMS101",$url_page_array) + 1] == strtolower("Notice")){ ?>
                <i class="mr-4 " ><img id = "notices" src="<?php echo base_url();?>assets/images/navbar-icons/notices.png" style="max-height: 1rem"></i>
              <?php } else{ ?>
                <i class="mr-4 " ><img id = "notices" src="<?php echo base_url();?>assets/images/navbar-icons/notices_filled.png" style="max-height: 1rem"></i>
              <?php } ?>
                <span>Notifications </span>
              </a>
            </li> -->
            <!--<li class="nav-item-header">
                  <a class="nav-link d-flex justify-content-start" href="#" title="Settings">
                    <i class="mr-4" >
                      <img src="<?php echo base_url();?>assets/images/navbar-icons/reports.png" style="max-height: 1rem">
                    </i>
                    <span>Reports </span>
                  </a>
            </li> -->
		  
            <!-- <li class="nav-item-header">
                    <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('mom/') ?>" title="roster"> 
                      <?php if($url_page_array[array_search("HRMS101",$url_page_array) + 1] == strtolower("MOM")){ ?>
                        <i class="mr-4 " ><img src="<?php echo base_url();?>assets/images/navbar-icons/mom_filled.png" style="max-height: 1rem"></i>
                      <?php } else{ ?>
                        <i class="mr-4 " ><img src="<?php echo base_url();?>assets/images/navbar-icons/mom.png" style="max-height: 1rem"></i>
                      <?php } ?>
                      <span>MOM</span>
                    </a>
            </li> -->
            <li class="nav-item-header"  onmouseover="hover('settings','<?php echo $selected;?>')" onmouseout="hoverOff('settings','<?php echo $selected;?>')">
              <a class="nav-link d-flex justify-content-start" href="<?php echo site_url('settings') ?>" title="Settings">
                <?php if($url_page_array[array_search("HRMS101",$url_page_array) + 1] == strtolower("Settings")){ ?>
                  <span class="material-icons-outlined">settings_outline</span>
                <?php } else{ ?>
                  <span class="material-icons-outlined">settings</span>
                <?php } ?>
                  <span>Settings </span>
              </a>
            </li>
            <li class="nav-item-header" onmouseover="hover('logout','<?php echo $selected;?>')" onmouseout="hoverOff('logout','<?php echo $selected;?>')">
              <a class="nav-link d-flex justify-content-start" href="<?php echo base_url();?>welcome/logout" >
                <span class="material-icons-outlined">logout</span>
                Logout</a>
            </li>
        </ul>
        <div class="todq_logo">
            <span >
              <strong>Powered by </strong>
              <div>HRMS</div>
            </span>
            <!-- <img src="<?php echo base_url('assets/images/icons/Todquest_logo.png'); ?>" class="todquest_logo_bottom"> -->
          </div>
        <!-- <ul class="navbar-nav ml-md-auto d-md-flex"> -->
<!--           <li class="nav-item-header">
            <a class="nav-link" href="javascript:void(0);" style="color:#f5f5f5;"><i class="fas fa-user-circle" style="color:#f5f5f5;"></i> <?php echo strtoupper($this->session->userdata('email')) ?></a>
          </li> -->
  <!--       
        </ul> -->
  </nav>
</div>

  <a class="help" href="https://sso.todquest.com/help/" target="_blank"><span class="material-icons-outlined">help</span></a>

  
  <script>
    function hover(str,isCurrent){
      if(str!=isCurrent){
        // const base_url = "<?php echo site_url();?>"+"assets/images/navbar-icons/";
        // document.getElementById(str).src = base_url+str+".png";
        // // alert(base_url + str + "_filled.png")
      }
    }
    function hoverOff(str,isCurrent){
      if(str!=isCurrent){
        // const base_url = "<?php echo site_url();?>"+"assets/images/navbar-icons/";
        // document.getElementById(str).src = base_url+str+"_filled.png";
      }
    }    

    function dateFormatToDDMMYYYY(){
        var dates = document.querySelectorAll('input[type="date"]');
          var dates = document.querySelectorAll('input')
           dates.forEach(function(date){
             var x = date.setAttribute('placeholder','dd-mm-yyyy');
            })
    }
    dateFormatToDDMMYYYY();
    function goBack() {
      window.history.back();
    }
    
  $(document).on('change','input[type="FILE"],input[type="file"]',function(){
    if($(this)[0].files[0].size > 2097152 ){
        $(this).val("")
        alert("File size must be less than 2MB")
    }
  })

  </script>
