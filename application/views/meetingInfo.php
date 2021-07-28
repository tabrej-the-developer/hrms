<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view('header'); ?>
  <title>Leaves</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
  <style>
    body{
      background: #f2f2f2;
    }
    .meetingInfo_card{
      background: white !important;
      height: calc(100vh - 4rem);
    }
    .containers{
      padding: 2rem;
    }
    .overflow_agenda,.overflow_mom{
      overflow-y: auto;
    }
    .infoHead{
      height: 20%;
    }
    .agenda_mom{
      height: 50%;
    }
    .attendance{
      height: 30%;
    }
    .meeting_title{
      font-size: 1.5rem;
      font-weight: bold;
    }
    .label{
      font-weight: bold;
    }
    .headerTitle{
      background-color: #8D91AA;
      color: #F3F4F7;
      padding: 0.5rem;
      display: flex;
      justify-content: center;
      cursor: pointer;
    }
    td:nth-of-type(1){
      width: 40%
    }
    td{
      text-align: center;
    }
    th{
      text-align: center
    }
    .attendace_table{
      overflow-y: auto;
    }
    .selected{
      color: #8D91AA  !important;
      background-color: #F3F4F7 !important;
    }
    .tabSelected{
      display: block !important;
    }
    .tabNameClass_0,.tabNameClass_1,.tabNameClass_2{
      display: none;
    }
  </style>
</head>
<!-- 
"title":"Dheeraj Meeting","date":"2021-05-25","time":"100","eTime":"200","location":"Dheeraj place","period":"O","loginid":"ab","agendaFile":"","name":"Arpita Saxena"
 -->
<body>
<?php $info = json_decode($info); ?>
  <div id="wrappers">
    <div class="containers">
      <div class="meetingInfo_card">
        <div class="d-block infoHead">
          <div class="d-flex justify-content-center">
            <span class="meeting_title"><?php echo $info->meeting->title; ?></span>
          </div>
          <div class="d-flex justify-content-center">
            <span>
              <?php echo "<span class='label'>Time : </span>".timex($info->meeting->time)." - ".timex($info->meeting->eTime); ?>
              <?php echo ", <span class='label'>Date :</span> ".date('d M Y',strtotime($info->meeting->date)); ?></span>
          </div>
          <div class="d-flex justify-content-center">
            <span>
              <span class='label'>Created By : </span>
                <?php echo $info->meeting->name; ?> , 
              <span class='label'>Location : </span>
                <?php echo $info->meeting->location; ?>
              </span>
          </div>
        </div>
        <div class="agenda_mom">
        <div class="d-flex col-12 ">
          <h5 class="headerTitle tabName_0 col-4 " intVal="0">Agenda and Summary</h5>
          <h5 class="headerTitle tabName_1 col-4 " intVal="1">Minutes of Meeting</h5>
          <h5 class="headerTitle  tabName_2 col-4 " intVal="2">Meeting Attendence</h5>
        </div>
          <div class="col-12 tabNameClass_0">
            <div class="overflow_agenda">
              <table style="width: 100%">
                <thead>
                  <th>Agenda</th>
                  <th>Summary</th>
                </thead>
                <tbody>
              <?php foreach ($info->agenda as $a) : ?>
                  <tr>
                    <td><?php echo $a->text; ?></td>
                    <td><?php echo $a->summary; ?></td>
                  </tr>
              <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-12 tabNameClass_1">
            <div class="overflow_mom">
              <table style="width: 100%">
                <thead>
                  <tr>
                    <th>User</th>
                    <th>Text</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($info->mom as $m){ ?>
                    <tr>
                      <td><?php print_r($m->name); ?></td>
                      <td><?php print_r($m->text); ?> </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="attendance col-12 tabNameClass_2">
            <table class="col-12">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($info->participant as $p) : ?>
                <tr>
                  <td><?php echo $p->name; ?></td>
                  <?php 
                    if($p->status == 'P'){
                      echo "<td style='color:#228659'>Present</td>";
                    }
                    if($p->status == 'A'){
                      echo "<td style='color:#cf6f57 '>Absent</td>";
                    }
                  ?> 
                </tr>
              <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


</body>

<script>
  function addAgenda() {
    alert('clicked');
    var div = document.getElementById('agendaMore');
    div.innerHTML = "<div class='form-group'><label>Agenda</label><input type='text' class='form-control' name='meetingLocation' id='agenda' placeholder='Agenda'  ><span id='time_error' class='text-danger'></span></div>";
  }

  function viewToggleElement(val){
    for(var i=0;i<3;i++){
      $(`.tabName_${i}`).removeClass('selected');
      $(`.tabNameClass_${i}`).removeClass('tabSelected');
    }
    $(`.tabName_${val}`).addClass('selected');
    $(`.tabNameClass_${val}`).addClass('tabSelected');
  }
  viewToggleElement(0);
 
  $(document).on('click','.headerTitle',function(){
    viewToggleElement($(this).attr('intVal'));
  })

  $(document).ready(function() {
    $(".dropdown").hover(
      function() {
        $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true, true).slideDown("fast");
        $(this).toggleClass('open');
      },
      function() {
        $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true, true).slideUp("fast");
        $(this).toggleClass('open');
      }
    );
  });

  function addLeaveType() {

    jQuery(function($) {
      $("#userModal").modal('show');
    });
  }

  $('#addmore').on('click', function(event) {
    var div = '<div class="row"><div class="col-md-2"></div><div class="col-md-3"><div class="form-group"><form action=""><select name="onboard" class="form-control" id=""><option value="">name1</option><option value="">name2</option><option value="">name3</option></select></form></div> </div><div class="col-md-5"><div class="form-group"><textarea name="summary[]" id="meetingText" cols="30" rows="1" class="form-control"></textarea></div></div></div>';
    //    if(event.keyCode == '13'){
    $('#addMore').after(div);
    //  }
  });

  $(document).ready(() => {
    $('#wrappers').css('paddingLeft', $('.side-nav').width());
  });
</script>
</html>
<?php 
function timex( $x)
{ 
    $output;
    if(($x/100) < 12 ){
        if(($x%100)==0){
          if($x/1200 == 0){
            $output = "12:00 AM";    
          }
          else{
         $output = intval($x/100) . ":00 AM";
          }
        }
      if(($x%100)!=0){
        if(($x%100) < 10){
          $output = intval($x/100) .":0". $x%100 . " AM";
        }
        if(($x%100) >= 10){
          $output = intval($x/100) .":". $x%100 . " AM";
        }
        }
    }
else if($x/100>12){
    if(($x%100)==0){
    $output = intval($x/100)-12 . ":00 PM";
    }
    if(($x%100)!=0 && intval($x/100)!=12){
      if(($x%100) < 10){
        $output = intval($x/100)-12 .":0". $x%100 . " PM";
      }
      if(($x%100) >= 10){
        $output = intval($x/100)-12 .":". $x%100 . " PM";
      }
    }
    if(($x%100)!=0 && intval($x/100)==12){
      if(($x%100) < 10){
        $output = intval($x/100) .":0". $x%100 . " PM";
      }
      if(($x%100) >= 10){
        $output = intval($x/100) .":". $x%100 . " PM";
      }
    }
}
else{
if(($x%100)==0){
     $output = intval($x/100) . ": 00 PM";
    }
    if(($x%100)!=0){
      if(($x%100) < 10){
        $output = intval($x/100) . ":0". $x%100 . " PM";
      }
      if(($x%100) >= 10){
        $output = intval($x/100) . ":". $x%100 . " PM";
      }
    }
}
return $output;
}
?>