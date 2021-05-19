<?php // print_r(json_encode(json_decode($calendar)->event[0])); ?>
<html>
<head>
  <title>Dashboard</title>
<link  href="https://cdn.jsdelivr.net/npm/fullcalendar@5.1.0/main.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.1.0/main.js"></script>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css' rel='stylesheet' />
<link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>



<style type="text/css">
  body{
    background: #F2F2F2 !important;
  }
  .containers{

  }

  .btn{
    display:  inherit;
    font-weight:  inherit;
    color:  inherit;
    text-align:  inherit;
    vertical-align:  inherit;
    user-select: inherit; 
    background-color:  inherit;
    border:  inherit;
    padding:  inherit;
    font-size:  inherit;
    line-height: inherit; 
    border-radius:  inherit;
  }
  .cardContainer {
  display: flex;
  justify-content: space-between;
  margin-left: 0 !important;
  }
  .cardItem {
    height: 8rem;
    padding-left: 0 !important;
    padding-right: 0 !important;
    cursor: pointer;
    box-shadow: 0 0 1rem 1px rgba(0,0,0,0.1);
  }
  .cardItem > span:hover{
    box-shadow: 0 0 10px 3px rgba(0,0,0,0.3);
  }
  .cardItem > span{
    min-height: 100%;
    display: block;
    background: white;
  }
  .cardItemChild{

  }
  .module-name{
  width: 100%;
  display: block;
  padding-left: 45%
  }
  .module-balance{
    display: block;
    padding-left: 45%;
    font-size: 2rem;
  }
  .footprints{
    height: calc( 100vh - 11rem);
    overflow-y: scroll
  }
  .dashboard-icons{
    padding: 20px;
    border-radius: 5px;
    position: relative;
    top: 50;
    left: 30;
  }
  .dashboard-icons > img{
    height: 2rem;
  }
  .activity{
    line-height: 2rem;
  }
  .activity-row{
    line-height: 2.5rem;
    font-size:0.8rem;
    font-weight: 700;
  }
  .activity-heading{
    font-weight: 700;
    line-height: 2.5rem;
  }
  .activity-row:nth-of-type(odd){
    background:#F5F6FA;
  }
  #calendar{
    width: 70%;
  }
  .fc-view-harness{
    padding-bottom: 100% !important;
  }
  .fc-col-header{
    width: 100% !important;
  }
  .fc-scrollgrid-sync-table{
    width: 100% !important;
    max-height:50px;
    height: 50px;
      border-spacing: 10px !important;
      border-collapse: separate !important;
  }
  .fc-daygrid-body-unbalanced{
    width: 100% !important;
  }
  .calendar_text{
    color:white;
    font-size:0.7rem;
  }
  .fc-theme-standard th{
    border: none;
  }
  .fc-theme-standard td{
    border-radius: 20px;
    border: 1px solid #8D91AA;
  }
  .fc-daygrid-day-number{
    font-size: 1.5rem !important;
    color: #171D4B !important;
  }
  .fc-scrollgrid-section>td{
    border: none;
  }
  .fc-scrollgrid.fc-scrollgrid-liquid{
    border: none;
  }
  .fc-scroller.fc-scroller-liquid-absolute{
    overflow: visible !important;
  }
  .fc-daygrid-day.fc-day{
    background: #D2D0D0  ;
    border-radius: 20px;
    /*height: 100px !important;*/
  }
  .fc-day-other{
    background: #E7E7E7 !important;
  }

  .fc-day.fc-day-today{
    background: #8D91AA !important;
  }
  .calendar-parent-div{
    background: white !important;
    margin: 0 1.5rem 0 1.5rem;
  }
  .fc-daygrid-day-frame::before{
    content: none !important;
  }
  .fc-daygrid-day-events::before{
    content: none !important;
  }
  .fc-daygrid-event-harness::after{
    content: none !important;
  }
  .fc-today-button.fc-button.fc-button-primary{
    display: none;
  }
  .fc-toolbar-chunk:nth-of-type(1){
    width: 100%;
    text-align: center;
  }
  .fc-daygrid-day-frame:after{
    content: none !important;
  }
  .fc-daygrid-day-events:after,
  .fc-daygrid-day-events:before,
  .fc-daygrid-day-frame:after,
  .fc-daygrid-day-frame:before,
  .fc-daygrid-event-harness:after,
  .fc-daygrid-event-harness:before{
    content: none !important;
  }
  .fc-scrollgrid-sync-table>tbody>tr{
    height: 100px;
    display: table-row;
  }
  .upcoming_events{
    width: 100%;
    margin-top:3.25rem;
  }
  .upcoming_events_title{
    font-weight:  700;
    font-size: 1.5rem;
  }
  .event_date{
    background: #AFE19F;
    color: #171D4B;
    display: flex;
    justify-content: center;
    border-radius: 8px;
    padding: 0.5rem;
  }
  .event_title{
    background: #F3F4F7;
  }
  .event_details{
    background: #F3F4F7;
  }
  .event_box{
    background: #F3F4F7;
  }
  .button_class{
    width: 100%;
    display: flex;
  }
  .events_title{
    font-size: 2rem;
    color: #171D4B;
    font-weight: 700;
    margin-left: 0.5rem;
  }
  /*---------------------------------------------------------------------------------------*/


    div.dataTables_wrapper div.dataTables_paginate {
        margin-top: -25px;
        position: fixed;
        bottom: 0.2rem;
        right: 1rem
    }
    .dataTables_info{
      display: none;
    }
    .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #5D78FF;
        border-color: #5D78FF;
    }
    .btn.focus, .btn:focus {
      outline: 0;
      box-shadow: none;
    }
    .btn-group-sm>.btn, .btn-sm {
      padding: .25rem .5rem;
      font-size: .875rem;
      line-height: 1.5;
      border-radius: 1.2rem;
/*      border: 1px solid #ccc;*/
    }
    #example_filter input {
      border-radius: 1.2rem;
    }
    .border-shadow{
          /*box-shadow: 0 3px 10px rgba(0,0,0,.1);*/

    }
    .modal-header {
      border-bottom:none;
      background-color:#8D91AA;
      color: #E7E7E7;
          display: flex;
          justify-content: center; 
    }
    .modal-content {
      border-radius:0;  
    }
    

/* ----------------------
    Schedule meeting modal : key (321x)
   ---------------------- */

   .dashboard_input{
    padding-left: 2rem;
    padding-right:1rem;
   }
   .button_form{
        border: none !important;
      color: rgb(23, 29, 75) !important;
      text-align: center !important;
      text-decoration: none !important;
      display: inline-block !important;
      font-weight: 700 !important;
      margin: 2px !important;
      width:8rem !important;
      border-radius: 20px !important;
      padding: 4px 8px !important;
      background: rgb(164, 217, 214) !important;
      font-size: 1rem !important;
   }
   .clos{
    background: #BCBFCF !important;
   }
   .click-add{
    position: absolute;
    right:100px;
    width:4rem;
   }
   .click-remove{
    position: absolute;
    right:70px;
    margin-top: -3rem;
   }
   .modal_table{
    margin-bottom: 0;
   }
   .agenda-class{
    padding-bottom: 1rem;
   }
   .agenda_block{
      min-height: 14rem;
      border: 1px solid #707070;
      border-radius: 33px;
      margin: 2rem 1rem 0 0;
   }
   .label_text{
    font-weight: 700;
    color: #171D4B;
    display: inline-block;
   }
.fc_input{
  border-radius: 20px;
  background: rgba(231, 231, 231, 1);
  border: 1px solid rgba(231, 231, 231, 1);
  box-shadow: none;
  width: 8rem;
}
.add_member_label{
  width:14%;
  padding:0 0 1rem 1rem;
  margin-left: 1rem;
  font-weight: 700;
  color: #171D4B;
}
.fc_input_label span{
  background: none;

}
.blocks_modal{
  width:100%;
  display: flex;
}
.modal_title_div{
  width: 100%;
  display: flex;
}
  .title_span_label{
    width: 16%;
    padding: 1rem 0;
    display: flex;
    padding-left: 15px;
    align-items: center;
  }
  #add_meeting{
    width: 100%;
  }
  .title_span_input{
    width: 78%;
    padding: 1rem 0;
    display: inline-block;
    padding-left: 0 !important;
  }
  .tokens-container{
    width: 100%;
    background: rgba(231, 231, 231, 1);
  }
  .agendaFile{
    opacity: 0;
    height:100%;
  }
  .add_member_span{
    width: 78%;
  }
  .tokenize{
    width:100%;
    min-height: 2.5rem;
    max-height: auto !important;
  }
  .blocks_modal > span{
    padding-left : 0 !important;
  }
  .tokenize ul{
        border-radius: 20px;
        background: rgba(231, 231, 231, 1);
        border: 1px solid rgba(231, 231, 231, 1);
        box-shadow: none;
        min-height: 2.5rem !important;
        max-height: auto !important;
  }
  .title_span_input input{
    width: 79%
  }
.input-group>.form-control{
  flex:0 !important;
  width: 8rem !important;
}
.form-control{
  padding: 0 !important;
}
  .date_span_label{
    width:30%;
    display: inline-block;
  }
  .date_span_input{
    width:65%;
      display: inline-block;
  }
  .date_span_input .input_box__{
    width: 100%;
  }
.input-group{
  display: flex;
}
.input_box__{
      background: #E7E7E7;
      border: none !important;
      height: 2.5rem;
      border-radius: 20px;
      padding-left: 1rem;
  }
  form{
        padding: 0 1rem 0 3rem;
  }
  .calendar_text{
    color: white !important;
  }
.dashboard_table td{
  padding: 0 1rem 1rem 0;
}
.has-search .feedback{
  position:absolute;
  z-index: 2;
    display: block;
    width: 1.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
    margin: 0 0 0 10px;
}
table.main-table tr:nth-child(odd){
   background-color:#eee !important;
   color:black; 
}
thead tr td{
  background:white !important;
  font-weight:bolder;
}

table.main-table{
    /*box-shadow: 0px 2px 4px;*/
}
table.main-table tr:nth-child(odd){
    background-color:white;
    padding:25px;
    color:black;
    /* font-weight:bold; */
}
 .row {
  /* background-color: #607d8b; */
  display:block;
  margin-top:15px;
}
.row h3{
    color:black;
}
.left{
    float:left;
    margin-left:0.5rem 0 0.5rem 2.5rem;
   
}
.right{
    float:right;
    margin: 1rem 1rem 0.5rem 0;
}
.left h3{
  margin-left:2rem;
  font-weight: 700;
  color: #171D4B !important;
  margin-top: 0.5rem;
}
#mom_search{
    border-radius:25px;
}

#agenda{
  width:70%;
  margin-left: 4rem;
  border-radius: 20px;
  min-height: 3rem;
  color: #171D4B;
  margin-top:0.5rem;
  padding-left:1rem !important;
}

/* .container{
    background-color:#607d8bc9 !important;
} */
  
/*corousol end*/    

    .modal-header{
        text-align:left;
    }
    .modal{
 padding: 0 !important;
}
.modal-dialog {
  max-width: 60% !important;
   min-height: 85vh; 
  padding: 0;
  margin: 1.75rem auto;
}

.modal-content {
  border-radius: 0 !important;
  /* height: 100%; */
}
input#add_meeting{
    background-color:#eee;
    color:black;
}


.show {display: block;}
#main-table_filter{
    margin-top: -53px;
    margin-right: 212px;
}
#main-table_filter input{
border-radius:50px;
height:32px;
margin-top:-3px;

}
.dataTables_length{
  display:none;
}

#main-table_paginate{
  margin-top:2px;
}
.modal-body{
  padding:0;
}

.containers{
  max-width:100%;
}
.shift-bar-tab{
  text-align: center;
  color:white;
  max-width: 100%;
}
.dashboard_table{
  width: 100% !important;
}
.fc-col-header-cell-cushion {
  color: #707070 !important;
}
.prevv{
  background:#307bd3 ;
  padding:10px 0 10px 0;
  cursor:pointer;
}
.prevv:hover{
  background:rgba(48, 123, 211,0.7);
}
.futt{
  background:#307bd3 ;
  padding:10px 0 10px 0;
  cursor:pointer;
}
.futt:after{
  content:'';

}
.futt:hover{
    background:rgba(48, 123, 211,0.7);
}
.dashboard_table{
  border-radius:10px;
}
table.dataTable thead th, table.dataTable thead td{
  border:0 !important;
}
.prevv,.futt{
  margin-bottom: 40px
}
.arrow::after{
  content: " ";
    /* background: red; */
    margin-top: 32px;
    position: absolute;
    /* width: 100px; */
    border-right: 10px solid transparent;
    border-top: 15px solid rgba(137, 144, 151, 0.3);
    border-left: 10px solid transparent;
}

  #mom_button{
    padding:0.25rem
  }
  .icon_i{
    padding-left: 0.5rem;
    padding-right: 0.5rem;
  }
.show-modal {
    opacity: 1;
    visibility: visible;
    transform: scale(1.0);
    transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
}
  .mom-container{
    padding: 4rem 2rem 2rem 0rem;
    height: calc(100vh - 2rem);
  }
  .mom-container-child{
    background: white;
    height: 100%;
  }
  .button{
      border: none;
      color: rgb(23, 29, 75);
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-weight: 700;
      margin: 2px;
      display:inline-block;
      border-radius: 20px;
      padding: 4px 8px;
      background: rgb(164, 217, 214);
      font-size: 1rem;
    }
.input-group-append, .input-group-prepend{
  display: inline-block !important;
}
  #hide input[type=file] {
display:none;
margin:10px;
}
#hide input[type=file] + label {
display:inline-block;
margin:20px;
padding: 4px 32px;
background-color: #FFFFFF;
border:solid 1px #666F77;
border-radius: 6px;
color:#666F77;
}
#hide input[type=file]:active + label {
background-image: none;
background-color:#2D6C7A;
color:#FFFFFF;
}
  #agendaFile{
    background:#eee;
    width: 70%;
    border-radius: 20px;
    height: 3rem;
    margin-left: 4rem;
    margin-top:1rem;
    margin-bottom:3rem;
  }
  .input-group-parent{
    width:50% !important;
  }
.form-group{
  margin-bottom: 0 !important;
}
  .form-control{
    padding: 0.25rem 0 !important;
  }
  .click-add{
    cursor: pointer;
  }
  .click-remove{
    cursor: pointer;
  }
  .fc-header-toolbar{
    padding-top: 1rem;
  }
 .tokenize > .tokens-container > .token-search > input{
  border: none !important;
 }
  .tokenize > .tokens-container > .token-search{
    border: none !important;
  }
  ..tokenize > .tokens-container{
    height: auto !important;
  }
  .cardItem.col-3{
    max-width: 24% !important;
    flex: 0 0 24% !important;
  }
  .add_agenda_button{
        height: 2rem;
        margin-top: 1.5rem;
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
    .tokens-container.form-control{
      padding-left: 2rem !important;
    }
    #collab{
      padding-left: 1rem;
    }
@media only screen and (max-width: 780px ){
      #calendar{
        width: 100%;
        padding: 0;
      }
      .calendar-parent-div {
        background: white !important;
        margin: 0 ;
      }
    } 
</style>
</head>
<body>
  <?php include 'header.php'; ?>
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


  <div class="containers">
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
    <div class="row mr-0 mb-5 mb-md-0 mt-3 cardContainer pl-0 pl-md-4 pr-0 pr-md-4">
<?php if((isset($permissions->permissions) ? $permissions->permissions->viewTimesheetYN : "N") == "Y"){ ?>
      <span class="col-3 cardItem " >
        <span class="row p-0 m-0 timesheets">
          <span class="col-6 dashboard-icons" style="background:rgba(0, 84, 254,0.07)">
            <img src="<?php echo base_url('assets/images/dashboard-icons/timesheets.png'); ?>">
          </span>
          <span class="col-6" >
            <span>
              <span class="module-balance" style="color:rgba(0, 84, 254)"><?php echo $moduleRowCount->timesheetsCount; ?></span>
              <span class="module-name">Total Timesheets</span>
            </span>
          </span>
        </span>
      </span>
<?php } ?>
<?php if((isset($permissions->permissions) ? $permissions->permissions->viewRosterYN : "N") == "Y"){ ?>
      <span class="col-3 cardItem " >
        <span class="row p-0 m-0 roster">
          <span class="col-6 dashboard-icons" style="background:rgba(254, 237, 242)">
            <img src="<?php echo base_url('assets/images/dashboard-icons/roster.png'); ?>">
          </span>
          <span class="col-6" >
            <span>
              <span class="module-balance" style="color:#FD5181"><?php echo $moduleRowCount->rostersCount; ?></span>
              <span class="module-name">Total Rosters</span>
            </span>
          </span>
        </span>
      </span>
<?php } ?>
<?php if((isset($permissions->permissions) ? $permissions->permissions->viewPayrollYN : "N") == "Y"){ ?>
      <span class="col-3 cardItem " >
        <span class="row p-0 m-0 payrolls">
          <span class="col-6 dashboard-icons" style="background:rgba(233, 255, 208)">
            <img src="<?php echo base_url('assets/images/dashboard-icons/payrolls.png'); ?>">
          </span>
          <span class="col-6" >
            <span class="col-12">
              <span class="module-balance" style="color:rgba(102, 145, 54)"><?php echo $moduleRowCount->payrollsCount; ?></span>
              <span class="module-name">Total Payrolls</span>
            </span>
          </span>
        </span>
      </span>
<?php } ?>
<?php if((isset($permissions->permissions) ? $permissions->permissions->viewLeaveTypeYN : "N") == "Y"){ ?>
      <span class="col-3 cardItem " >
        <span class="row p-0 m-0 onLeave">
          <span class="col-6 dashboard-icons" style="background:rgba(253, 188, 0,0.18)">
            <img src="<?php echo base_url('assets/images/dashboard-icons/onLeave.png'); ?>">
          </span>
          <span class="col-6" >
            <span>
              <span class="module-balance" style="color:rgba(253, 188, 0)"><?php echo $moduleRowCount->leavesCount; ?></span>
              <span class="module-name">Total Leaves</span>
              </span>
          </span>
        </span>
      </span>   
<?php } ?>  
    </div>
    <div class="row mr-0 ml-3 mr-3 mt-3 ">
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
      <span class="button_class">
        <span class="events_title">Events</span>
        <span class="ml-auto">
          <button id="mom_button" type="button"  class="button" data-toggle="modal" data-target="#myModal">
            <i style="padding-right:0.5rem;padding-left:0.5rem">
              <img src="<?php echo base_url('assets/images/icons/addEvent_calendar.png'); ?>" style="max-height:1rem">
            </i>
            <span style="padding-right:0.5rem">Add Event</span>
          </button>
        </span>
      </span>
    </div>
    <div class="d-md-flex d-sm-block calendar-parent-div">
      <div id="calendar" class="col-md-9"></div>
      <div class="col-md-3 upcoming_events">
        <div class="upcoming_events_title text-center">Upcoming Events</div>
        <div class="upcomingEvents_birthday">
          <div>Birthdays</div>
          <?php 
          $calendarBirthdays = isset($calendar) ? 
                               ( isset(json_decode($calendar)->birthdays) ?
                                       json_decode($calendar)->birthdays : "") : "";
          if(isset($calendarBirthdays)){
              

                      ?>
                      <?php // if(count($array) > 0){ ?>
                <div style="height: 10%;overflow-y: auto;">
                <?php  foreach($calendarBirthdays as $ars){ 
                        foreach($ars->birthday as $ar){
                  ?>
                      <?php if(date('m') == date('m',strtotime($ar->dateOfBirth))){
                        $eventType = 'Birthday';
                        $eventDate = date('M,d',strtotime($ar->dateOfBirth));
                      }
                       ?>
                  <span class="col-12 event_date" style="font-size:1rem;padding-top:0.5rem;padding-bottom:0.5rem"><?php echo $eventDate; ?></span>
                  <div class="d-flex event_box" style="font-size:0.75rem;font-weight:700;padding-top:0.5rem;padding-bottom:0.5rem">
                    <span class="col-4 event_title"><?php echo $eventType; ?></span>
                    <span class="col-8 event_details">
                      <?php echo $ar->fname.'  '.$ar->lname ?>
                    </span>
                  </div>
                <?php } } ?>
                </div>        
          <?php // } 
              }
          ?>
        </div>
        <div class="upcomingEvents_anniversary">
          <div>Anniversaries</div>
          <?php 
          $calendarAnniversaries = isset($calendar) ?
                              (isset(json_decode($calendar)->anniversary) ? 
                                        json_decode($calendar)->anniversary : "") : "" ; 
          if(isset($calendarAnniversaries)){
              

                      ?>
                      <?php // if(count($array) > 0){ ?>
                <div style="height: 10%;overflow-y: auto;">
                <?php  foreach($calendarAnniversaries as $ars){ 
                        foreach($ars->anniversary as $ar){
                  ?>
                      <?php if(date('m') == date('m',strtotime($ar->startDate))){
                        $eventType = 'Anniversary';
                        $eventDate = date('M,d',strtotime($ar->startDate));
                      }
                       ?>
                  <span class="col-12 event_date" style="font-size:1rem;padding-top:0.5rem;padding-bottom:0.5rem"><?php echo $eventDate; ?></span>
                  <div class="d-flex event_box" style="font-size:0.75rem;font-weight:700;padding-top:0.5rem;padding-bottom:0.5rem">
                    <span class="col-4 event_title"><?php echo $eventType; ?></span>
                    <span class="col-8 event_details">
                      <?php echo $ar->fname.'  '.$ar->lname ?>
                    </span>
                  </div>
                <?php } } ?>
                </div>        
          <?php // } 
              }
          ?>
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
<!-- ---------------------------
        Modal Schedule Event
-------------------------------- -->

<div class="modal fade" id="myModal" role="dialog" style="z-index:1400px">
    <div class="modal-dialog mw-75">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header ">
    
          <h3 class="modal-title ">Schedule New Event</h3>
        </div>
        <div class="modal-body container">
             <form method="post" action="<?php echo base_url() ?>mom/addMeeting" class="dashboard_form" onsubmit="return onFormSubmit()">
              <div class="form-group modal_title_div">
                   <span class="title_span_label">
                      <label class="label_text">Title</label>
                    </span>
                    <span class="title_span_input">
                      <input type="text" name="meetingTitle" id="add_meeting" class="input_box__ dashboard_input" placeholder="Enter Title" required>
                    </span>  
              </div>
               <table class="table table-borderless modal_table dashboard_table">
               <tr>
                  <td class="col-md-4 input-group-parent">
                    <div class="d-flex blocks_modal">
                        <span class="col-md-6 ">
                          <span class="input-group-prepend date_span_label">
                            <label class="label_text">Start&nbsp;Date</label>
                          </span>
                          <span class=" date_span_input">
                            <input type="date" id="date" name="meetingDate" class="input_box__ dashboard_input" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required>
                          </span>
                        </span>
                        <span class="col-md-6 ">
                          <span class="input-group-prepend date_span_label">
                            <label class="label_text">End&nbsp;Date</label>
                          </span>
                          <span class=" date_span_input">
                            <input type="date" id="enddate" name="meetingEndDate" class="input_box__ dashboard_input" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                          </span>
                        </span>
                      </div>
                  </td>
               </tr>
              <tr>
                <td class="col-md-12 input-group-parent">
                  <div class="d-flex blocks_modal">
                    <span class="col-md-6 ">
                      <span class="input-group-prepend date_span_label">
                         <span class=" label_text" id="basic-addon1">Start&nbsp;Time</span>
                      </span>
                      <span class="date_span_input">
                        <input type="time" name="meetingTime" id="time" class="input_box__ dashboard_input" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required>
                      </span>
                    </span>
                    <span class="col-md-6 ">
                      <span class="input-group-prepend date_span_label">
                        <span class=" label_text" id="basic-addon1">End&nbsp;Time</span>
                      </span>
                      <span class="date_span_input">
                        <input type="time" name="meetingEndTime" id="time" class="input_box__ dashboard_input" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                      </span>
                    </span>
                  </div>
                
                </td>
               <tr>
                <td>
                  <div class="d-flex blocks_modal">
                    <span class="col-md-6">
                      <span class="date_span_label label_text">Where</span>
                      <span class="date_span_input">
                        <input id="location" type="text" class="input_box__ dashboard_input" id="autocomplete" placeholder="Type Address..." name="meetingLocation" required>
                      </span>
                      <div class="form-group">
                       <input type="hidden" class="dashboard_input">
                       <input type="hidden" class="dashboard_input">
                      </div>
                    </span>
                    <span class="col-md-6">
                    <span class="date_span_label label_text">Repeat&nbsp;Event</span>
                    <span class="date_span_input">
                      <span class="select_css">
                       <select name="meetingcollab" id="collab" class="input_box__">
                          <option value="O">Once</option>
                          <option value="A">Annual</option>
                          <option value="M">Monthly</option>
                          <option value="W">Weekly</option>
                       </select>
                     </span>
                    </span>
                   </span>
                  </div>
                </td>
               </tr>
               </table>
	
              <table class="table table-borderless dashboard_table">


               <tr>
                  <div class="blocks_modal d-flex">
                    <span class="add_member_label">Add&nbsp;Member</span>
                    <span class="add_member_span">
                      <select name="invites[]" class="demo" multiple  id="demo" required>
                      <?php 
                          foreach($users->users as $m):
                      ?>  
                         <option value="<?php echo $m->userid ?>"><?php echo $m->username;?></option>
                      <?php endforeach; ?>
                     </select>
                    </span>
                  </div>  
               </tr>
<!--                <tr>
                   <td class="text-center">Calender</td>
                   <td>
                    <div class="form-group">
                    <input type="text" id="add_meeting" class="">
                    </div>  
                   </td>
               </tr> -->

          <div class="agenda_block">
             <span style="position: absolute;margin-top: -15px;margin-left: 70px;background: white;padding:0 0.25rem">Agenda</span> 
            <div class="d-flex">
              <div id="agendaFile">
                <span style="color:#8D91AA;margin-left: 1rem;position: absolute;" class="add_file" >Add File</span>
             </div>
             <button class="add_agenda_button button" onclick="return false">
            <i style="padding-right:0.5rem;padding-left:0.5rem">
              <img src="<?php echo base_url('assets/images/icons/plus.png'); ?>" style="max-height:1rem">
            </i>Add File</button>
              <input type="FILE" name="agendaFile" id="hide" class="agendaFile d-none dashboard_input" onchange="validate()" >
            </div>
            <span class="click-add">
              <i class="icon_i">
                <img src="<?php echo base_url('assets/images/plus.png');?>" height="25px">
              </i>
          </span>
            <span>
              <div class="form-group agenda-class">
                  <textarea name="meetingAgenda[]" id="agenda" class="form-control agenda" style="background-color:#eee" placeholder="Add Agenda"></textarea>
                <span class="click-remove" style="display: none">
                  <i>
                    <img src="<?php echo base_url('assets/images/minus.png');?>" height="25px">
                  </i>
                </span>
              </div>  
            </span>
          </div>
 </table>
              
           
       
    <div class="modal-footer">
      <div class="m_footer" style="margin:auto">
        <button type="button" class="btn button_form clos" data-dismiss="modal">
          <i style="padding-right:0.5rem;padding-left:0.5rem">
            <img src="<?php echo base_url('assets/images/icons/close.png'); ?>" style="max-height:1rem">
          </i>Close</button>
        <button class="btn button_form">
          <i style="padding-right:0.5rem;padding-left:0.5rem">
            <img src="<?php echo base_url('assets/images/icons/send.png'); ?>" style="max-height:1rem">
          </i>Submit</button>
        </div>
      </div>
    </form>
  </div>


<!-- ---------------------------
        Modal Schedule Event
-------------------------------- -->
<script type="text/javascript">
  $(document).ready(()=>{
      $('.containers').css('paddingLeft',$('.side-nav').width());
  });
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
                $('.fc-event-title').eq(increment).html(`<a class="calendar_text" href="<?php echo base_url() ?>mom/attendence/${y}" title="${titleMeeting}">${titleMeeting}</a>`);
              }
              if(meetingStatus.toLowerCase() == 'mom'){
                $('.fc-event-title').eq(increment).html(`<a class="calendar_text" href="<?php echo base_url() ?>mom/onBoard/${y}" title="${titleMeeting}">${titleMeeting}</a>`);
              }
              if(meetingStatus.toLowerCase() == 'summary'){
                $('.fc-event-title').eq(increment).html(`<a class="calendar_text" href="<?php echo base_url() ?>mom/summary/${y}" title="${titleMeeting}">${titleMeeting}</a>`);
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
            // var status = $('.fc-event-title').eq(increment).text();
              console.log($('.fc-event-title').eq(increment).html(`<a class="calendar_text" href="<?php echo base_url() ?>Leave" title="${status}">${status}</a>`));
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
                $('.fc-event-title').eq(increment).html(`<a class="calendar_text" href="<?php echo base_url() ?>mom/attendence/${y}" title="${titleMeeting}">${titleMeeting}</a>`);
              }
              if(meetingStatus.toLowerCase() == 'mom'){
                $('.fc-event-title').eq(increment).html(`<a class="calendar_text" href="<?php echo base_url() ?>mom/onBoard/${y}" title="${titleMeeting}">${titleMeeting}</a>`);
              }
              if(meetingStatus.toLowerCase() == 'summary'){
                $('.fc-event-title').eq(increment).html(`<a class="calendar_text" href="<?php echo base_url() ?>mom/summary/${y}" title="${titleMeeting}">${titleMeeting}</a>`);
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
        $('.add_agenda_button').html(`<i style="padding-right:0.5rem;padding-left:0.5rem">
                <img src="<?php echo base_url('assets/images/icons/plus.png'); ?>" style="max-height:1rem">
              </i>Add File`)
          return false; 
    }
    if(allowedExtensions.exec(fileInput)){
      add_file();
    }
  }
  $(document).on('click','.add_agenda_button',function(){
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
        $(this).prev().remove();
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
        $('.add_agenda_button').html(`<i style="padding-right:0.5rem;padding-left:0.5rem">
                <img src="<?php echo base_url('assets/images/icons/del.png'); ?>" style="max-height:1rem">
              </i>Delete`)
        $('.add_file').text($('.agendaFile')[0].files[0].name)
        $('.agendaFile').attr('type','button')
      }
    }

    $(document).on('click','.add_agenda_button',function(){
      $('.add_file').text('Add File');
      $('.agendaFile').val('');
      $('.agendaFile').attr('type','FILE')
      $('.add_agenda_button').html(`<i style="padding-right:0.5rem;padding-left:0.5rem">
                <img src="<?php echo base_url('assets/images/icons/plus.png'); ?>" style="max-height:1rem">
              </i>Add File`)
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