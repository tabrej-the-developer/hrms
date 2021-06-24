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
   <table style="width: 100%;">
      <thead>
        <tr class="">
          <th style="padding: 0.5rem">Date</th>
          <th style="padding: 0.5rem">Clocked&nbsp;In</th>
          <th style="padding: 0.5rem">Clocked&nbsp;Out</th>
          <th style="padding: 0.5rem">Timed&nbsp;In</th>
          <th style="padding: 0.5rem">Timed&nbsp;Out</th>
        </tr>
      </thead>
    <?php  ?>
    <tbody>
    <?php for($r=0;$r<count($payrollShifts->employees[$x]->payrollShifts);$r++){ ?>
      
        <tr >
          <td style="padding: 0.5rem"><?php echo dateToDay($payrollShifts->employees[$x]->payrollShifts[$r]->shiftDate);?></td>
          <td style="padding: 0.5rem"><?php echo timex($payrollShifts->employees[$x]->payrollShifts[$r]->clockedInTime); ?></td>
          <td style="padding: 0.5rem"><?php echo timex($payrollShifts->employees[$x]->payrollShifts[$r]->clockedOutTime); ?></td>
          <td style="padding: 0.5rem"><?php echo timex($payrollShifts->employees[$x]->payrollShifts[$r]->startTime); ?></td>
          <td style="padding: 0.5rem"><?php echo timex($payrollShifts->employees[$x]->payrollShifts[$r]->endTime); ?></td>
        </tr>
	<?php } ?>
  </tbody>
   </table>
</div>


<!--
<input type="time" name="stime" id="stime">
<input type="time" name="etime" id="etime">
-->