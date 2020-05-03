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
	</style>

	<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<div>
	<?php 
	$shift = json_decode($shift);
		$timesheetDetails = json_decode($timesheetDetails);
		$entitlements = json_decode($entitlements);
		//print_r($timesheetDetails->timesheet[$ya]->employees[$xa]->empName);
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
foreach($timesheetDetails->timesheet[$ya]->rosteredEmployees[$xa]->clockedTimes as $visits){
	$userLevel = $timesheetDetails->timesheet[0]->rosteredEmployees[$xa]->level;
						foreach ($entitlements as $e) {
							if($e[0]->id == $userLevel){
								$variable = $e[0]->hourlyRate;
							}
						}

	?>
	  <div start-time="<?php echo $visits->startTime; ?>" end-time="<?php echo $visits->endTime; ?>" class="box-time" style="padding:20px" hourly="<?php echo $variable;?>">
	  	<span class="group-span">
		<span><input type="checkbox" name="" checked></span>
		<span svalue="<?php echo $visits->startTime; ?>" evalue="<?php echo $visits->endTime; ?>" class="time-box"><?php echo timex($visits->startTime) ."-". timex($visits->endTime) ?></span>
		<span class="new-time-box"></span>
		<span>
			<select class="shift-type-select" >
				<?php foreach($shift->payrollTypes as $shifts){
					if($shifts->id == "3"){?>
				<option value="<?php echo $shifts->type; ?>" selected factor="<?php echo $shifts->factor; ?>" class="fact"><?php echo $shifts->type ?></option>
			<?php 
					}
					else{ ?>
				<option value="<?php echo $shifts->type; ?>" ><?php echo $shifts->type ?></option>	
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
				<option value="<?php echo $shift->type; ?>" ><?php echo $shift->type ?></option>	
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
		<div class="budget">Budget : </div>
		<div>
		<button class="buttonn">Create Pay Roll</button>
	</div>
</div>


<!--
<input type="time" name="stime" id="stime">
<input type="time" name="etime" id="etime">
-->
