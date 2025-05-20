<?php // print_r(json_encode(json_decode($calendar)->event[0]));die(); ?>
<html>
<head>
<title>Dashboard</title>

<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
<link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">

<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


<link  href="https://cdn.jsdelivr.net/npm/fullcalendar@5.1.0/main.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.1.0/main.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- <script src="<?php // echo base_url('assets/js/bootstrap.min.js');?>"></script> -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <!-- icons css-->
 
  <!--datepicker css -->


  <!--datepicker css end -->
  
  <!--datatable css -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />  
  <!--datatable css end -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/circle.css');?>">

  

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">

<style>
.navbar-nav .nav-item-header:nth-of-type(1) {
    background: var(--blue2) !important;
    position: relative;
}
.navbar-nav .nav-item-header:nth-of-type(1)::after {
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
  <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</head>
<body>
<div class="wrapperContainer">
  <?php include 'headerNew.php'; ?>
<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tokenize2.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tokenize2.js"></script>
  <?php 
  if(isset($users)){
    $users =   json_decode($users);
  }
   ?>


  <div class="containers scrollY">
    <?php 
    if(isset($permissions)){
      $permissions = json_decode($permissions); 
    }
    ?>
    <?php   
    if(isset($moduleEntryCount)){
      $moduleRowCount = json_decode($moduleEntryCount);
    }
     ?>
     <!-- Top Tiles Start -->
    <div class="row cardContainer">
<?php // if((isset($permissions->permissions) ? $permissions->permissions->viewTimesheetYN : "N") == "Y"){ ?>
      <span class="col-3 cardItem " >
        <span class=" timesheets">
          <span class="col-6 dashboard-icons" style="background:rgba(0, 84, 254,0.07)">
            <img src="<?php echo base_url('assets/images/timesheet-icon.png'); ?>">
          </span>
          <span class="col-6" >
            <span>
              <span class="module-balance" style="color:rgba(0, 84, 254)"><?php echo $moduleRowCount->timesheetsCount; ?></span>
              <span class="module-name">Total Timesheets</span>
            </span>
          </span>
        </span>
      </span>
<?php // } ?>
<?php //if((isset($permissions->permissions) ? $permissions->permissions->viewRosterYN : "N") == "Y"){ ?>
      <span class="col-3 cardItem " >
        <span class=" roster">
          <span class="col-6 dashboard-icons" style="background:rgba(254, 237, 242)">
            <img src="<?php echo base_url('assets/images/roster-icon.png'); ?>">
          </span>
          <span class="col-6" >
            <span>
              <span class="module-balance" style="color:#FD5181"><?php echo $moduleRowCount->rostersCount; ?></span>
              <span class="module-name">Total Rosters</span>
            </span>
          </span>
        </span>
      </span>
<?php //} ?>
<?php  // if((isset($permissions->permissions) ? $permissions->permissions->viewPayrollYN : "N") == "Y"){ ?>
      <span class="col-3 cardItem " >
        <span class=" payrolls">
          <span class="col-6 dashboard-icons" style="background:rgba(233, 255, 208)">
            <img src="<?php echo base_url('assets/images/payroll-icon.png'); ?>">
          </span>
          <span class="col-6" >
            <span class="col-12">
              <span class="module-balance" style="color:rgba(102, 145, 54)"><?php echo $moduleRowCount->payrollsCount; ?></span>
              <span class="module-name">Total Payrolls</span>
            </span>
          </span>
        </span>
      </span>
<?php // } ?>
<?php // if((isset($permissions->permissions) ? $permissions->permissions->viewLeaveTypeYN : "N") == "Y"){ ?>
      <span class="col-3 cardItem " >
        <span class=" onLeave">
          <span class="col-6 dashboard-icons" style="background:rgba(253, 188, 0,0.18)">
            <img src="<?php echo base_url('assets/images/leave-icon.png'); ?>">
          </span>
          <span class="col-6" >
            <span>
              <span class="module-balance" style="color:rgba(253, 188, 0)"><?php echo $moduleRowCount->leavesCount; ?></span>
              <span class="module-name">Total Leaves</span>
              </span>
          </span>
        </span>
      </span>   
<?php // } ?>  
    </div>
     <!-- Top Tiles End -->
    <div class="dashboradContainer ">
      <?php
      if(isset($footprints)){
         $footprints = json_decode($footprints); 
        }
      // print_r($footprints);
      ?>
      <!-- <span class="col-12 footprints" style="background: white">
        <span class="row activity" style="border-bottom:1px solid #979797;opacity:0.28">
          <span class="mr-auto pl-3">Activity</span>
          <span class="pr-3">Refresh</span>
        </span>
        <span class="row m-0 p-0 activity-heading">
          <span class="col-2">S.No</span>
          <span class="col-2">IP Address</span>
          <span class="col-2">Date</span>
          <span class="col-2">Last Activity Time</span>
          <span class="col-3">Activity Description</span>
        </span>
        <?php 
        //  $count = 1;
        //foreach($footprints->footprints as $footprint){?>
          <span class="row activity-row" >
            <span class="col-2"><?php // echo  $count++ ;?></span>
            <span class="col-2"><?php  // echo $footprint->ip ?></span>
            <span class="col-2"><?php  // echo explode(" ",$footprint->start_time)[0] ?></span>
            <span class="col-2"><?php  // echo explode(" ",$footprint->start_time)[1] ?></span>
            <span style="background:transparent;" class="col-4 "> <?php  // echo $footprint->prev_page_tag != " " ? str_replace(base_url(),"",$footprint->prev_page_tag):"Login"; ?></span>
          </span>
      <?php // } ?>
      </span> -->
      <div class="button_class pageHead">
        <span class="events_title">Events</span>
        <div class="rightHeader">
        <span class="select_css select_css__">
              <select class="center-list " id="center-list" onchange="changeDashboardCenter()">
                  <?php $centers = json_decode($centers);
                  for($i=0;$i<count($centers->centers);$i++){
                    if($_SESSION['centerr'] == $centers->centers[$i]->centerid){
                ?>
                <option href="javascript:void(0)" class="center-class" id="<?php echo $centers->centers[$i]->centerid ?>" value="<?php echo $centers->centers[$i]->centerid; ?>" selected><?php echo $centers->centers[$i]->name?></option>
              <?php }else{ ?>
                <option href="javascript:void(0)" class="center-class" id="<?php echo $centers->centers[$i]->centerid ?>" value="<?php echo $centers->centers[$i]->centerid; ?>"><?php echo $centers->centers[$i]->name?></option>
              <?php }}  ?>
              </select>
            </span>	
        <?php  if((isset($permissions->permissions) ? $permissions->permissions->createMomYN : "N") == "Y"){ ?>
          <button id="mom_button" type="button"  class="button btn btn-default btn-small btnBlue pull-right" data-toggle="modal" data-target="#myModal">
            <span class="material-icons-outlined">add</span>
            Add Event
          </button>
          <?php } ?>
        </div>
      </div>
    <div class="d-md-flex d-sm-block calendar-parent-div">
      <div id="calendar" class="col-md-9"></div>
      <div class="col-md-3 upcoming_events">
        <div class="upcoming_events_title">Upcoming Events</div>
        <div class="upcomingEvents_birthday">
          <img src="<?php echo base_url();?>assets/images/birthday.png">
          <div class="ribbonText">Birthdays</div>
          <?php 
          $calendarBirthdays = isset($calendar) ? 
                               ( isset(json_decode($calendar)->birthdays) ?
                                       json_decode($calendar)->birthdays : "") : "";
                      ?>
                      <?php $aCount = 0; $bCount = 0; ?>
                <div class="eventTotalist">
                <?php  
          if(isset($calendarBirthdays) && $calendarBirthdays != null){
                foreach($calendarBirthdays as $ars){ 
                        foreach($ars->birthday as $ar){
                          $bCount++;
                  ?>
                      <?php if(date('m') == date('m',strtotime($ar->dateOfBirth))){
                        $eventType = 'Birthday';
                        $eventDate = date('M,d',strtotime($ar->dateOfBirth));
                      }
                       ?>
                       
                  <div class="eventList">
                  <span class="event_date"><?php echo $eventDate; ?></span>
                  <div class="d-flex event_box event_details" >
                    <!-- <span class="col-4 event_title"><?php echo $eventType; ?></span> -->
                      <?php echo $ar->fname.'  '.$ar->lname ?>
                  </div>
                    </div>
                <?php  } } }
                  if($bCount == 0 ){
                    echo "<h5 class='nodata'>No Birthdays</h5>";
                  }
                ?>
                </div>        
        </div>
        <div class="upcomingEvents_anniversary">
          <img src="<?php echo base_url();?>assets/images/anniversery.png">
          <div class="ribbonText">Anniversaries</div>
          <?php 
          $calendarAnniversaries = isset($calendar) ?
                              (isset(json_decode($calendar)->anniversary) ? 
                                        json_decode($calendar)->anniversary : "") : "" ; 
                      ?>
                      <?php // if(count($array) > 0){ ?>
                <div class="eventTotalist">
                <?php  
              if(isset($calendarAnniversaries) && $calendarAnniversaries != null){
                foreach($calendarAnniversaries as $ars){ 
                        foreach($ars->anniversary as $ar){
                          $aCount++;
                  ?>
                      <?php if(date('m') == date('m',strtotime($ar->startDate))){
                        $eventType = 'Anniversary';
                        $eventDate = date('M,d',strtotime($ar->startDate));
                      }
                       ?>
                  <div class="eventList">
                  <span class="event_date" ><?php echo $eventDate; ?></span>
                  <div class="d-flex event_box event_details" >
                    <!-- <span class="col-4 event_title"><?php echo $eventType; ?></span> -->
                      <?php echo $ar->fname.'  '.$ar->lname ?>
                  </div>
                  </div>
                <?php } } }
                  if($aCount == 0 ){
                    echo "<h5 class='nodata'>No Anniversaries</h5>";
                  } ?>
                </div>        
        </div>
      </div>

    </div>
    
    </div>
  </div>

<div class="modal-logout">
    <div class="modal-content-logout">
        <h3>You have been logged out!!</h3>
        <h4><a class="btn btn-default btnOrange" href="<?php echo base_url(); ?>">Click here</a> to login</h4>
        
    </div>
</div>
<!-- ---------------------------
        Modal Schedule Event
-------------------------------- -->

<div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog mw-75">
    
      <!-- Modal content-->
      <div class="modal-content headerModel NewFormDesign">
        <div class="modal-header ">
    
          <h3 class="modal-title ">Schedule New Event</h3>
        </div>
        <div class="modal-body container">
             <form method="post" action="<?php echo base_url() ?>mom/addMeeting" class="dashboard_form" onsubmit="return onFormSubmit()" enctype="multipart/form-data">

              <div class="form-group modal_title_div col-md-12 ">
                <div class="form-floating">
                <input type="text" name="meetingTitle" id="add_meeting" class="input_box__ dashboard_input form-control" placeholder="Enter Title" required>
                <label for="add_meeting" class="label_text">Title</label>
                </div>
              </div>
               
                    <div class="d-flex blocks_modal">
                        <span class="col-md-6">
                          <div class="form-floating">
                            <input type="date" id="date" name="meetingDate" class="input_box__ dashboard_input form-control" placeholder="Start Date" aria-label="Start Date" aria-describedby="basic-addon1" required>
                            <label for="date" class="label_text">Start&nbsp;Date</label>
                          </div>
                        </span>
                        <span class="col-md-6">
                          <div class="form-floating">
                          <input type="date" id="enddate" name="meetingEndDate" class="input_box__ dashboard_input form-control" placeholder="End Date" aria-label="End Date" aria-describedby="basic-addon1">
                          <label for="enddate" class="label_text">End&nbsp;Date</label>
                          </div>
                        </span>
                      </div>
                  <div class="d-flex blocks_modal">
                    <span class="col-md-6">
                      <div class="form-floating">
                      <input type="time" name="meetingTime" id="startTime" class="input_box__ dashboard_input form-control" placeholder="Start Time" aria-label="Start Time" aria-describedby="basic-addon1" required>
                      <label class=" label_text" for="startTime" id="basic-addon1">Start&nbsp;Time</label>
                      </div>
                    </span>
                    <span class="col-md-6 ">
                      <div class="form-floating">
                        <input type="time" name="meetingEndTime" id="endTime" class="input_box__ dashboard_input form-control" placeholder="End Time" aria-label="End Time" aria-describedby="basic-addon1">
                        <label class=" label_text" for="endTime" id="basic-addon1">End&nbsp;Time</label>
                      </div>
                    </span>
                  </div>
                
                  <div class="d-flex blocks_modal">
                    <span class="col-md-6">
                      <div class="form-floating">
                        <input id="location" type="text" class="input_box__ dashboard_input form-control" id="autocomplete" placeholder="Type Address..." name="meetingLocation" required>
                        <label class="date_span_label label_text" for="autocomplete">Where</label>
                        <div class="form-group">
                        <input type="hidden" class="dashboard_input">
                        <input type="hidden" class="dashboard_input">
                        </div>
                        </div>
                    </span>
                    
                    <span class="col-md-6">
                      <div class="form-floating">
                        <select name="meetingcollab" id="collab" class="input_box__ form-control">
                            <option value="O">Once</option>
                            <option value="A">Annual</option>
                            <option value="M">Monthly</option>
                            <option value="W">Weekly</option>
                        </select>
                        <label for="collab" class="date_span_label label_text">Repeat&nbsp;Event</label>
                      </div>
                   </span>
                  </div>
	
                  <div class="col-md-12">
                  <div class="form-floating tokenizeSelect">
                      <select name="invites[]" class="demo form-control" multiple id="demo">
                      <?php 
                          foreach($users->users as $m):
                      ?>  
                         <option value="<?php echo $m->userid ?>"><?php echo $m->username;?></option>
                      <?php endforeach; ?>
                     </select>
                      <label for="demo" class="add_member_label">Add&nbsp;Member</label>
                  </div>
                  </div>  

                  <div class="blocks_modal addAgenda">                    
                     
                    <!-- <div class="form-group">
                    <input type="text" id="add_meeting" class="">
                    </div>   -->

          <div class="agenda_block">
             <span class="agendaHead">Agenda</span> 
            <div class="d-flex">
              <div id="agendaFile">
                <span style="color:#8D91AA;margin-left: 1rem;position: absolute;" class="add_file" >Add File</span>
             </div>
             <button class="add_agenda_button button" onclick="return false">
              <span class="material-icons">add</span>
              Add File
            </button>
              <input type="FILE" name="agendaFile" id="hide" class="agendaFile d-none dashboard_input" onchange="validate()" >
            </div>
            <span class="click-add">
            <span class="material-icons">add_circle_outline</span>
            </span>
            <span>
              <div class="form-group agenda-class">
                  <div class="d-flex"><textarea name="meetingAgenda[]" id="agenda" class="form-control agenda" style="background-color:#eee" placeholder="Add Agenda"></textarea>
                <span class="click-remove" style="display: none">
                <span class="material-icons">remove_circle_outline</span>
                </span>
                </div>
              </div>  
            </span>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-small btnBlue button_form clos" data-dismiss="modal">
        <span class="material-icons">close</span> Close</button>
        <button class="btn btn-default btn-small btnOrange button_form submitForm">
        <span class="material-icons">send</span> Submit</button>
      </div>
    </form>
  </div>
</div>
</div>
</div>
</div>

<!-- Notification -->
<div class="notify_">
	<div class="note">
		<div class="notify_body">
			<span class="_notify_message"></span>
			<span class="_notify_close" onclick="closeNotification()">&times;</span>
    	</div>
	</div>
</div>
<!-- Notification -->


<!-- ---------------------------------
            Events Modal
---------------------------------- -->

<div id="eventModal" class="eventModal">
    <div class="eventModalContent headerModel">
      <div class="eventModalHeader">
        <div>Events</div>
        <div class="eventModalDate"></div>
      </div>
      <div class="eventModalBody">
      </div>
      <div class="eventModalFooter">
        <button class="eventModalClose button btn btn-default btnOrange">Close</button>
      </div>
    </div>
</div>

<!-- ---------------------------------
            Events Modal
---------------------------------- -->
</div>



  <script type="text/javascript">

  // Fetch events for a date

  $(document).on('click','.modalOpen',function(){
    var modal = document.getElementById("eventModal");
    var date = $(this).closest('.fc-daygrid-day').attr('data-date');
    var centerid = $('#center-list').val();
    var url = '<?php echo base_url(); ?>dashboard/getEventsByDate/'+date+'/'+centerid;
    $.ajax({
      url : url,
      success : function(response){
        $('.eventModalDate').text(date)
        try{
          var json = JSON.parse(response);
          console.log(json)
          json.event[0].forEach(function(eve){
            if((eve.title).includes('Shift')){
              $('.eventModalBody').append(`<div class="shift"><span><a href="<?php echo base_url() ?>roster/getRosterDetails?rosterId=${eve.roster}&showBudgetYN=N">${eve.title}</a></span></div>`);
            }
            if((eve.title).includes('Leave')){
              $('.eventModalBody').append('<div class="leave"><span><a href="<?php echo base_url() ?>Leave">${eve.title}</a></span></div>');
            }
            if((eve.title).includes('- Meeting')){
              if((eve.meetingStatus).toLowerCase() == 'created'){
                $('.eventModalBody').append(`<div class="created"><span><a href="<?php echo base_url() ?>mom/attendence/${eve.meetingId}" title="${eve.title}">${eve.title}</a></span></div>`);
                }
                if((eve.meetingStatus).toLowerCase() == 'attendence'){
                  $('.eventModalBody').append(`<div class="attendance"><span><a href="<?php echo base_url() ?>mom/onBoard/${eve.meetingId}" title="${eve.title}">${eve.title}</a></span></div>`);
                }
                if((eve.meetingStatus).toLowerCase() == 'mom'){
                  $('.eventModalBody').append(`<div class="mom"><span><a href="<?php echo base_url() ?>mom/summary/${eve.meetingId}" title="${eve.title}">${eve.title}</a></span></div>`);
                }
                if((eve.meetingStatus).toLowerCase() == 'summary'){
                  $('.eventModalBody').append(`<div class="summary"><span><a href="<?php echo base_url() ?>mom/meetingInfo/${eve.meetingId}" title="${eve.title}">${eve.title}</a></span></div>`);
                  }
                }
              })
          modal.style.display = "flex";
        }catch(e){
          addMessageToNotification('Error fetching events');
          showNotification();
          setTimeout(closeNotification,5000)
        }
      }
    })
  })

  //  Events Modal
    var modal = document.getElementById("eventModal");
    document.getElementsByClassName("eventModalClose")[0].addEventListener("click", function(){
        modal.style.display = "none";
        $('.eventModalBody').empty();
    })
    //  Events Modal

  // Notification //
	function showNotification(){
      $('.notify_').css('visibility','visible');
    }
    function addMessageToNotification(message){
    	if($('.notify_').css('visibility') == 'hidden'){
     		$('._notify_message').append(`<li>${message}</li>`)
      }
    }
    function closeNotification(){
      $('.notify_').css('visibility','hidden');
      $('._notify_message').empty();
    }
  // Notification //
  </script>

<!-- ---------------------------
        Modal Schedule Event
-------------------------------- -->
<script type="text/javascript">
      function changeDashboardCenter(){
        var centerid = $('#center-list').val();
        window.location.href = `<?php echo base_url('dashboard?centerid=') ?>${centerid}`
      }

  // $(document).ready(()=>{
  //     $('.containers').css('paddingLeft',$('.side-nav').width());
  // });
</script>
<?php if(isset($calendar)){ ?>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {   events: <?php print_r(json_encode(json_decode($calendar)->event[0])); ?>
          } );
                calendar.render();
              });
// fc-event-title
// fc-daygrid-day 
// data-date
// fc-button
    </script>
     <script type="text/javascript">
       $(document).ready(function(){
          $('.demo').tokenize2({
                //placeholder: "Add Member",
                dataSource: 'select'
          });
         });

    </script>
    <script type="text/javascript">
      $(document).ready(function(){
        var events = <?php print_r(json_encode(json_decode($calendar)->event[0])); ?>;
        console.log(events)
        var count = $('.fc-event-title').length; 
        var counter = 0;
        var increment = 0;
        var element = [];
        var meetingCount = 0;
        var meetingElement = [];
        
        while(increment < count){
          // rosters dates array
          if(($('.fc-event-title').eq(increment).text()).includes('Shift')){
          element[counter] = $('.fc-event-title').eq(increment).closest('td').attr('data-date');
          var date = element[counter];
          var role = $('.fc-event-title').eq(increment).text();
          events.forEach((item,index)=>{
            x = fun(item,index,date)
            if(x !== undefined){
            console.log($('.fc-event-title').eq(increment).html(`<a class="calendar_text" href="<?php echo base_url() ?>roster/getRosterDetails?rosterId=${x}&showBudgetYN=N" title="${role}">${role}</a>`));
              }
          });
          counter++;
          }
          if(($('.fc-event-title').eq(increment).text()).includes('Leave')){
            var status = $('.fc-event-title').eq(increment).text();
              console.log($('.fc-event-title').eq(increment).html(`<a class="calendar_text" href="<?php echo base_url() ?>Leave" title="${status}">${status}</a>`));
            }
            
            if(($('.fc-event-title').eq(increment).text()).includes('+')){
            var status = $('.fc-event-title').eq(increment).text();
              console.log($('.fc-event-title').eq(increment).html(`<a class="calendar_text modalOpen">${status}</a>`));
            }

          if(($('.fc-event-title').eq(increment).text()).includes('Meeting')){
          meetingElement[meetingCount] = $('.fc-event-title').eq(increment).closest('td').attr('data-date');
          var dateMeeting = meetingElement[meetingCount];
          var titleMeeting = $('.fc-event-title').eq(increment).text();
          events.forEach((item,index)=>{
            y = meetingIdFromArray(item,index,dateMeeting)
            meetingStatus = meetStatus(item,index,dateMeeting)
            if(y !== undefined ){
              if(meetingStatus.toLowerCase() == 'created'){
                $('.fc-event-title').eq(increment).html(`<a class="calendar_text" href="<?php echo base_url() ?>mom/attendence/${y}" title="${titleMeeting}">${titleMeeting}</a>`);
              }
              if(meetingStatus.toLowerCase() == 'attendence'){
                $('.fc-event-title').eq(increment).html(`<a class="calendar_text" href="<?php echo base_url() ?>mom/onBoard/${y}" title="${titleMeeting}">${titleMeeting}</a>`);
              }
              if(meetingStatus.toLowerCase() == 'mom'){
                $('.fc-event-title').eq(increment).html(`<a class="calendar_text" href="<?php echo base_url() ?>mom/summary/${y}" title="${titleMeeting}">${titleMeeting}</a>`);
              }
              if(meetingStatus.toLowerCase() == 'summary'){
                $('.fc-event-title').eq(increment).html(`<a class="calendar_text" href="<?php echo base_url() ?>mom/meetingInfo/${y}" title="${titleMeeting}">${titleMeeting}</a>`);
                }
              }
            });
            meetingCount++;
          }
          increment++; 
        }

        function fun(item,index,date){
          if(item['roster'] !== undefined && item['start'] == date){
          return item['roster'];
              }
            }
        function meetingIdFromArray(item,index,date){
          if(item['meetingId'] !== undefined && item['start'] == date){
            return item['meetingId'];
            }
        }
        function meetStatus(item,index,date){
          if(item['meetingId'] !== undefined 
              && item['start'] == date 
              && item['start'] != '0000-00-00'
              && item['meetingStatus'] != ''
              && item['meetingStatus'] != null ){
                  return item['meetingStatus'];
            }
        }
        console.log(events)

    $(document).on('click','.events_text',function(){
      date = $(this).closest('.fc-daygrid-day').attr('data-date');
    })

  $(document).on('click','.fc-button',function(){
    var d = new Date();
    var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    if($('.fc-header-toolbar .fc-toolbar-chunk .fc-toolbar-title').text() == `${months[d.getMonth()]} ${d.getFullYear()}`){
        var events = <?php print_r(json_encode(json_decode($calendar)->event[0])); ?>;
        var count = $('.fc-event-title').length; 
        var counter = 0;
        var increment = 0;
        var element = [];
        var meetingCount = 0;
        var meetingElement = [];
        
        while(increment < count){
          // rosters dates array
          if(($('.fc-event-title').eq(increment).text()).includes('Shift')){
          element[counter] = $('.fc-event-title').eq(increment).closest('td').attr('data-date');
          var date = element[counter];
          // var role = $('.fc-event-title').eq(increment).text();
          events.forEach((item,index)=>{
            x = fun(item,index,date)
            if(x !== undefined){
            console.log($('.fc-event-title').eq(increment).html(`<a class="calendar_text" href="<?php echo base_url() ?>roster/getRosterDetails?rosterId=${x}" title="${role}">${role}</a>`));
              }
          });
          counter++;
          }
          if(($('.fc-event-title').eq(increment).text()).includes('Leave')){
            var status = $('.fc-event-title').eq(increment).text();
              console.log($('.fc-event-title').eq(increment).html(`<a class="calendar_text" href="<?php echo base_url() ?>Leave" title="${status}">${status}</a>`));
            }

            if(($('.fc-event-title').eq(increment).text()).includes('+')){
              var status = $('.fc-event-title').eq(increment).text();
              $('.fc-event-title').eq(increment).html(`<a style="cursor:pointer" class="events_text" title="${status}">${status}</a>`);
            }

          if(($('.fc-event-title').eq(increment).text()).includes('Meeting')){
          meetingElement[meetingCount] = $('.fc-event-title').eq(increment).closest('td').attr('data-date');
          var dateMeeting = meetingElement[meetingCount];
          var titleMeeting = $('.fc-event-title').eq(increment).text();
          events.forEach((item,index)=>{
            y = meetingIdFromArray(item,index,dateMeeting)
            meetingStatus = meetStatus(item,index,dateMeeting)
            if(y !== undefined ){
              if(meetingStatus.toLowerCase() == 'created'){
                $('.fc-event-title').eq(increment).html(`<a class="calendar_text" href="<?php echo base_url() ?>mom/attendence/${y}" title="${titleMeeting}">${titleMeeting}</a>`);
              }
              if(meetingStatus.toLowerCase() == 'attendence'){
                $('.fc-event-title').eq(increment).html(`<a class="calendar_text" href="<?php echo base_url() ?>mom/onBoard/${y}" title="${titleMeeting}">${titleMeeting}</a>`);
              }
              if(meetingStatus.toLowerCase() == 'mom'){
                $('.fc-event-title').eq(increment).html(`<a class="calendar_text" href="<?php echo base_url() ?>mom/summary/${y}" title="${titleMeeting}">${titleMeeting}</a>`);
              }
              if(meetingStatus.toLowerCase() == 'summary'){
                $('.fc-event-title').eq(increment).html(`<a class="calendar_text" href="<?php echo base_url() ?>mom/meetingInfo/${y}" title="${titleMeeting}">${titleMeeting}</a>`);
                }
              }
            });
            meetingCount++;
          }
          increment++; 
        }
        function fun(item,index,date){
          if(item['roster'] !== undefined && item['start'] == date){
          return item['roster'];
              }
            }
        console.log(events)
        }
      })
      })
    </script>

  <script type="text/javascript">
    function validate(){

      var fileInput =  $('.agendaFile').val();
      var allowedExtensions =  /(\.pdf)$/i; 
      if (!allowedExtensions.exec(fileInput)) { 
          alert('Invalid file type'); 
          $('.agendaFile').val(''); 
          $('.add_file').text('Add File');
        $('.add_agenda_button').html(`<span class="material-icons">add</span> Add File`)
          return false; 
    }
    if(allowedExtensions.exec(fileInput)){
      add_file();
    }
  }
  $(document).on('click','.add_agenda_button',function(){
    if($('.agendaFile').val() == "")
      $('.agendaFile').trigger('click')
  })
  </script>
<script type="text/javascript" language="javascript" >
$('#toggle').remove();
     $('#colab').on('change',function(){
      $('.remove').remove();   
        if(this.value === "m"){  
          $('#colab').after("<input type='date' class='remove dashboard_input' id='month'>");
        }
      if(this.value === "y"){
        $('#colab').after("<input type='date' class='remove dashboard_input'  id='year'>");
        }
      if(this.value === "w"){
        $('#colab').after("<input type='date' class='remove dashboard_input' id='weekly'>");
        }


   });
  $('#apply_button').click(function(){
        
        $('#applyModal').modal('show');
    });

    var newElement = $('.agenda-class ').html();
      $('.click-add').click(function(){
        $('.agenda-class').append(newElement);
        if($('.click-remove').length > 0){
          $('.click-remove').css('display','inline-block')
        }
      })
    $(document).on('click','.click-remove',function(){
      if(($('.agenda').length) > 1){
        $(this).parent(".d-flex").remove();
        $(this).remove();
        if($('.click-remove').length == 1){
          $('.click-remove').css('display','none')
        }
      }
    })

    $(document).ready(function(){
<?php if((isset($permissions->permissions) ? $permissions->permissions->viewTimesheetYN : "N") == "Y"){ ?>
      $(document).on('click','.timesheets',function(){
        window.location.href = "<?php echo base_url() ?>Timesheet";
      })
<?php } ?>
<?php if((isset($permissions->permissions) ? $permissions->permissions->viewRosterYN : "N") == "Y"){ ?>
      $(document).on('click','.roster',function(){
        window.location.href = "<?php echo base_url() ?>Roster";
      })
<?php } ?>
<?php if((isset($permissions->permissions) ? $permissions->permissions->viewPayrollYN : "N") == "Y"){ ?>
      $(document).on('click','.payrolls',function(){
        window.location.href = "<?php echo base_url() ?>Payroll";
      })
<?php } ?>
<?php if((isset($permissions->permissions) ? $permissions->permissions->viewLeaveTypeYN : "N") == "Y"){ ?>
      $(document).on('click','.onLeave',function(){
        window.location.href = "<?php echo base_url() ?>Leave";
      })
<?php } ?>
    })

    function add_file(){
      if($('.agendaFile').val() == "" || $('.agendaFile').val() ==  null){
        $('.add_file').text('Add File')
      }else{
        $('.add_agenda_button').html(`<span class="material-icons">delete_outline</span> Delete`)
        $('.add_file').text($('.agendaFile')[0].files[0].name)
        // $('.agendaFile').attr('type','button')
      }
    }

    $(document).on('click','.add_agenda_button',function(){
      $('.add_file').text('Add File');
      $('.agendaFile').val('');
      $('.agendaFile').attr('type','FILE')
      $('.add_agenda_button').html(`<span class="material-icons">add</span> Add File`)
    })

    $(document).on('click','.clos,#mom_button',function(){
      if($('.agendaFile').val() != "" && $('.agendaFile').val() !=  null){
        $('.add_agenda_button').click();
      }
      $('.dashboard_form')[0].reset();
      $('.token').remove();
    })

    $(document).on('submit','form',function(e){
      // e.preventDefault();
      if($('#enddate').val() < $('#date').val()){
        e.preventDefault();
        addMessageToNotification('Invalid dates entered');
        showNotification();
        setTimeout(closeNotification,5000)
      }
      if($('.agenda').val() == null || $('.agenda').val() == ""){
        e.preventDefault();
        addMessageToNotification('Add Agenda');
        showNotification();
        setTimeout(closeNotification,5000)
      }
      if($('.token').length == 0){
        e.preventDefault();
        addMessageToNotification('Add Members');
        showNotification();
        setTimeout(closeNotification,5000)
      }
    })

    <?php if($this->session->flashdata('MemberData') != null){ ?>
      var url = "<?php echo base_url(); ?>api/Util/sendEmails";
      var data = (<?php echo $this->session->flashdata('MemberData') ?>);
      var ud = "<?php echo $this->session->userdata('LoginId'); ?>";
      var period = "<?php echo $this->session->flashdata('period') ?>";
      var loc = "<?php echo $this->session->flashdata('loc') ?>";
      var title = "<?php echo $this->session->flashdata('title') ?>";
      var category = "<?php echo $this->session->flashdata('category') ?>";
      var x = [];
      x.push({"userid" : ud,"data" : data,"title":title,"loc":loc,"period":period,"category":category});
      x = JSON.stringify(x);
      console.log(x)
      $.ajax({
        url : url,
        type : 'POST',
        contentType: 'application/json',
        dataType: 'json',
        data : x,
        success : function(response){
          console.log(response);
        }
      }).fail(function(response){
        console.log(response)
      })
    <?php } ?>

    $(document).ready(function(){
      <?php for($i=0;$i<3;$i++){ ?>
      // var url = "<?php echo base_url(); ?>"+"email.php";
      // $.ajax({
      //   url : url,
      //   success : function(response){
      //   }
      // })
      <?php } ?>
    })

  </script>

<?php } ?>
<?php 
if( isset($error) != null){ ?>
  <script type="text/javascript">
   var modal = document.querySelector(".modal-logout");
       function toggleModal() {
         modal.classList.toggle("show-modal");
      }
  $(document).ready(function(){
      toggleModal();  
      });
  </script>
<?php } ?>
</body>
</html>