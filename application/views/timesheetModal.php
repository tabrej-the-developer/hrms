<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
	*{
font-family: 'Open Sans', sans-serif;
	}
		.group-span{
			display:flex;
			justify-content: space-around;
			min-width:100%;
		}
		.box-time{
			
		}
		.as_roster{
			padding: 20px 20px 20px 4rem;
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
		.close{
		background-color: #9E9E9E !important;
	 	border: none;
	 	color: white !important;
	 	padding: 10px 10px !important;
	 	text-align: center;
	 	text-decoration: none;
	 	display: inline-block;
	 	margin: 2px;
	    float:none; 
	    font-size: 1rem; 
	    font-weight: bolder; 
	    line-height: inherit; 
	    text-shadow: none; 
	    opacity: 1;
		}
		.time-box{
			cursor:pointer;
		}
	</style>

	<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<div>
	<?php 
		$shift = json_decode($shift);
		$rosterShift = json_decode($rosterShift);
		$timesheetDetails = json_decode($timesheetDetails);
		$entitlements = json_decode($entitlements);
		// print_r($timesheetDetails);
		function timex( $x)
	{ 
	    $output;
	    if(($x/100) < 12){
	        if(($x%100)==0){
	         $output = $x/100 . ":00 AM";
	        }
	    if(($x%100)!=0){
	        $output = intval($x/100) .":". $x%100 . "AM";
	        }
	    }
	else if(($x/100)>12){
	    if(($x%100)==0){
	    $output = ($x/100)-12 . ":00 PM";
	    }
	    if(($x%100)!=0){
	    $output = intval($x/100)-12 .":". $x%100 . "PM";
	    }
	}
	else{
	if(($x%100)==0){
	     $output = ($x/100) . ": 00 PM";
	    }
	    if(($x%100)!=0){
	    $output = intval($x/100) . ":". $x%100 . "PM";
	    }
	}
	return $output;
}
?>
<?php 
if($aT == 'rosteredEmployees'){
	$variable = 0;
		if(count($timesheetDetails->timesheet[$ya]->rosteredEmployees[$xa]->clockedTimes) <=2){
			if(count($timesheetDetails->timesheet[$ya]->rosteredEmployees[$xa]->clockedTimes) <2){
				$break = false; 
			}else{
				$break = true;
			}
			?>
			<?php // print_r($rosterShift); ?>
			<div class="as_roster">
				<?php foreach($shift->payrollTypes as $shifts){
					if($shifts->id == "3"){?>
						<?php // print_r(isset($rosterShift->startTime) ? $rosterShift->startTime : ""); ?>
				<input type="checkbox" name="same_as_roster" class="same_as_roster" factor="<?php echo $shifts->factor; ?>">
			<?php } } ?> Same as Roster(
				<span time="<?php echo isset($rosterShift->startTime) ? $rosterShift->startTime : ""; ?>" class="time_1"><?php echo isset($rosterShift->startTime) ? timex($rosterShift->startTime) : ""; ?></span>-<span time="<?php echo isset($rosterShift->startTime) ? $rosterShift->endTime : ""; ?>" class="time_2"><?php echo isset($rosterShift->startTime) ? timex($rosterShift->endTime) : ""; ?></span> )
			</div>
	<?php	
}
	else{
		$break = false;
	}
foreach($timesheetDetails->timesheet[$ya]->rosteredEmployees[$xa]->clockedTimes as $visits){
	$userLevel = $timesheetDetails->timesheet[0]->rosteredEmployees[$xa]->level;
						foreach ($entitlements as $e) {
							if($e[0]->id == $userLevel){
								$variable = $e[0]->hourlyRate;
							}
						}

	?>
	  <div start-time="<?php echo $visits->startTime; ?>" end-time="<?php echo $visits->endTime; ?>" class="box-time" style="padding:20px 20px 20px 4rem" hourly="<?php echo $variable;?>">
	  	<span class="group-span">
		<span><input type="checkbox" name="" checked class="clocked_time"></span>
		<span svalue="<?php echo $visits->startTime; ?>" evalue="<?php echo $visits->endTime; ?>" class="time-box"><?php echo timex($visits->startTime) ."-". timex($visits->endTime) ?></span>
		<span class="new-time-box"></span>
		<span>
			<select class="shift-type-select" >
				<?php foreach($shift->payrollTypes as $shifts){
					if($shifts->id == "3"){?>
				<option value="<?php echo $shifts->factor; ?>" selected factor="<?php echo $shifts->factor; ?>" class="fact"><?php echo $shifts->type ?></option>
			<?php 
					}
					else{ ?>
				<option value="<?php echo $shifts->factor; ?>" factor="<?php echo $shifts->factor; ?>"><?php echo $shifts->type ?></option>	
					<?php 
					}
				} ?>
			</select>
		</span>

	</span>
		<div style="padding-left: 3rem;"><?php echo $visits->reason;?></div>

	</div>

	<?php
		} ?>
		<span style="padding-left: 4rem;">
			<?php  
		 if($break){ 
			echo "Break :".  timex($timesheetDetails->timesheet[$ya]->rosteredEmployees[$xa]->clockedTimes[1]->endTime) . " to " . timex($timesheetDetails->timesheet[$ya]->rosteredEmployees[$xa]->clockedTimes[0]->startTime); 
		} ?>
		</span>
		<?php 
	}

	?>
<?php 
if($aT == 'unrosteredEmployees'){
foreach($timesheetDetails->timesheet[$ya]->unrosteredEmployees[$xa]->clockedTimes as $visits){
		$variable = 0;
	if(isset($rosterDetails->roster[$xa])){
		$userLevel = $rosterDetails->roster[$xa]->roles[$counter]->level;
			foreach($entitlement as $e){
				if($e->id == $userLevel ){
					$variable = $e->hourlyRate;
				}}
		}
	?>
	  <div start-time="<?php echo $visits->startTime; ?>" end-time="<?php echo $visits->endTime; ?>" class="box-time" style="padding:20px" hourly="<?php echo $variable;?>">
	  	<span class="group-span">
		<span><input type="checkbox" name="" checked></span>
		<span svalue="<?php echo $visits->startTime; ?>" evalue="<?php echo $visits->endTime; ?>" class="time-box"><?php echo timex($visits->startTime) ."-". timex($visits->endTime) ?></span>
		<span class="new-time-box"></span>
		<span>
			<select class="shift-type-select" >
				<?php foreach($shift->payrollTypes as $shift){
					if($shift->id == "3"){?>
				<option value="<?php echo $shift->type; ?>" selected factor="<?php echo $shift->factor; ?>"><?php echo $shift->type ?></option>
			<?php 
					}
					else{ ?>
				<option value="<?php echo $shift->type; ?>" factor="<?php echo $shift->factor; ?>"><?php echo $shift->type ?></option>	
					<?php 
					}
				} ?>
			</select>
		</span>
	</span>
		<div><?php echo $visits->reason;?></div>

	</div>
	<?php
		}
	}
	?>
		<div class="budget" id="emply-id" employee="<?php echo $empId; ?>" timesheetid="<?php echo $timesheetid;?>" date="<?php echo $date;?>">Budget : </div>
		<div class="d-flex justify-content-center">
			<div class="">
				<button class="close">Close</button>
			</div>
			<div class="">
				<button class="buttonn ">Create Payroll</button>
			</div>
		</div>
</div>


<!--
<input type="time" name="stime" id="stime">
<input type="time" name="etime" id="etime">
-->
