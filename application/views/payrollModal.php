	<style type="text/css">
		.group-span{
			display:flex;
			justify-content: space-around;
			min-width:100%;
		}
		.box-time{
			
		}
		.shift-type-select{
			width:100px;
		}
		.buttonn{
		background-color: #9E9E9E;
		border: none;
		color: white;
		padding: 10px 10px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		margin: 2px
		}
		.time-box{
			cursor:pointer;
		}
		.head-th{
			font-size:1.1rem;
			font-weight:bolder;
		}
	</style>

	<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<div>
	<?php 
		$payrollShifts = json_decode($payrollShifts);
function timex( $x)
  { 
      $output;
      if(($x/100) < 12 ){
          if(($x%100)==0){
            if($x/1200 == 0){
              $output = "12:00 AM";    
            }
            else{
           $output = sprintf("%02d",intval($x/100)) . ":00 AM";
            }
          }
        if(($x%100)!=0){
          if(($x%100) < 10){
            $output = sprintf("%02d",intval($x/100)) .":0". $x%100 . " AM";
          }
          if(($x%100) >= 10){
            $output = sprintf("%02d",intval($x/100)) .":". $x%100 . " AM";
          }
          }
      }
  else if($x/100>12){
      if(($x%100)==0){
      $output = sprintf("%02d",intval($x/100)-12) . ":00 PM";
      }
      if(($x%100)!=0 && intval($x/100)!=12){
        if(($x%100) < 10){
          $output = sprintf("%02d",intval($x/100)-12) .":0". $x%100 . " PM";
        }
        if(($x%100) >= 10){
          $output = sprintf("%02d",intval($x/100)-12) .":". $x%100 . " PM";
        }
      }
      if(($x%100)!=0 && intval($x/100)==12){
        if(($x%100) < 10){
          $output = sprintf("%02d",intval($x/100)) .":0". $x%100 . " PM";
        }
        if(($x%100) >= 10){
          $output = sprintf("%02d",intval($x/100)) .":". $x%100 . " PM";
        }
      }
  }
  else{
  if(($x%100)==0){
       $output = intval($x/100) . ": 00 PM";
      }
      if(($x%100)!=0){
        if(($x%100) < 10){
          $output = sprintf("%02d",intval($x/100)) . ":0". $x%100 . " PM";
        }
        if(($x%100) >= 10){
          $output = sprintf("%02d",intval($x/100)) . ":". $x%100 . " PM";
        }
      }
  }
  return $output;
}
	?>
<div>
	<?php 
		function dateToDay($date){
			$date = explode("-",$date);
			return date("d M, Y ",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
		}
	 ?>
	<div class="d-flex row m-0">
		<span class="head head-th col-3">Date</span>
		<span class="head head-th col-2">Clocked&nbsp;In</span>
		<span class="head head-th col-3">Clocked&nbsp;Out</span>
		<span class="head head-th col-2">Timed&nbsp;In</span>
		<span class="head head-th col-2">Timed&nbsp;Out</span>
	</div>
	<?php  ?>
	<?php for($r=0;$r<count($payrollShifts->employees[$x]->payrollShifts);$r++){ ?>
	<div class="d-flex row m-0">
		<span class="head col-3"><?php echo dateToDay($payrollShifts->employees[$x]->payrollShifts[$r]->shiftDate);?></span>
		<span class="head col-2"><?php echo timex($payrollShifts->employees[$x]->payrollShifts[$r]->clockedInTime); ?></span>
		<span class="head col-3"><?php echo timex($payrollShifts->employees[$x]->payrollShifts[$r]->clockedOutTime); ?></span>
		<span class="head col-2"><?php echo timex($payrollShifts->employees[$x]->payrollShifts[$r]->startTime); ?></span>
		<span class="head col-2"><?php echo timex($payrollShifts->employees[$x]->payrollShifts[$r]->endTime); ?></span>
	</div>
	<?php } ?>
</div>


<!--
<input type="time" name="stime" id="stime">
<input type="time" name="etime" id="etime">
-->