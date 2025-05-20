<!DOCTYPE html>
<html>
<style type="text/css" media="print">
  @page { size: landscape; }
</style>
<head>
<title>Roster</title>
<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
<link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<!--	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tokenize2.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tokenize2.js"></script>


<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">

  <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<style>
.navbar-nav .nav-item-header:nth-of-type(2) {
    background: var(--blue2) !important;
    position: relative;
}
.navbar-nav .nav-item-header:nth-of-type(2)::after {
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
</head>
<body>


<div class="wrapperContainer">
	<?php include 'headerNew.php'; ?>
	<?php 
		$rosterDetails = json_decode($rosterDetails); 
		// $entitlement = json_decode($entitlements);
		$permissions = json_decode($permissions);
	?>
	<div class="containers scrollY" id="containers">
			<div class="rosterContainer ">
				<div class="d-flex pageHead heading-bar" id="center-id" c_id="<?php echo isset($rosterDetails->centerid) ? $rosterDetails->centerid : null; ?>">
					<div class="withBackLink">
						<a href="<?php echo base_url('Roster');?>">
						<span class="material-icons-outlined">arrow_back</span>
						</a>				
						<span class="events_title"><?php echo $rosterDetails->templateName ?></span>
					</div>
					<span class="rightHeader">
						<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?>
						<!-- <span class="editPermission-span">
							<button class="editPermission-btn">Permission</button>
						</span> -->

						<button class="priority-btn btn btn-default btn-small">
							<span class="material-icons-outlined">sort</span> Priority
						</button>
						<!-- <span class="showBudget d-flex ">
							<span class="d-flex justify-content-center align-items-center hide_budget">Hide&nbsp;Budget</span> -->
							<!-- Hide budget -->
							<!-- <input type="checkbox" class="showBudget-btn"
							show-budget="<?php 
							if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') == 'Y'){
								echo 'N';
							}
							if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') == 'N'){
								echo 'Y';
							} ?>" <?php 
							if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') == 'Y'){
								echo '';
							}
							if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') == 'N'){
								echo 'checked';
							}
							?>>
							</span> -->
						<?php } ?>  
						<!-- <span class="print-button">
							<button class="print-btn">
								<i>
									<img src="<?php echo base_url('assets/images/icons/print.png'); ?>" style="max-height:1rem;margin-right:10px">
								</i>Print</button>
							<span class="print-hidden-btn">
								<button class="print-landscape" onclick="landscape()">Landscape</button>
								<button class="print-portrait" onclick="portrait()">Portrait</button>
							</span>
						</span> -->
					</span>
				</div>
		<?php 

//PHP functions //

function timex( $x)
	{ 
	    $output;
	    if(($x/100) < 12){
	        if(($x%100)==0){
	         $output = intval($x/100) . ":00 AM";
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
	else if(intval($x/100)>12){
	    if(($x%100)==0){
	    $output = intval($x/100)-12 . ":00 PM";
	    }
	    if(($x%100)!=0){
	    	if(($x%100) < 10){
	    		$output = intval($x/100)-12 .":0". $x%100 . " PM";
	    	}
    		if(($x%100) >= 10){
    			$output = intval($x/100)-12 .":". $x%100 . " PM";
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

function dateToDay($date){
	$date = explode("-",$date);
	return date(", M d",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
}



//PHP functions //
		if(isset($rosterDetails->day)){
			$str1 = 0;
  		 $str2 = 4; 
			 $v1 = explode("-",$str1);
			 $v2 = explode("-",$str2);
    }
		 ?> 
		<div class="table-div pageTableDiv" style="">
			<table>
				<tr class="day-row">
					<th id="table-id-1" class="day" style="width:18vw">Employees</th>	<?php $x=0;
					if(isset($rosterDetails->day)){
						$startDate = date('Y-m-d', strtotime($rosterDetails->day));
						?>
					<th id="table-id-2" class="day" style="width:13vw">Mon</th>
					<th id="table-id-3" class="day"  style="width:13vw">Tue</th>
					<th id="table-id-4" class="day"  style="width:13vw">Wed</th>
					<th id="table-id-5" class="day"  style="width:13vw">Thu</th>
					<th id="table-id-6" class="day" style="width:13vw">Fri</th>
        <?php } ?>

				</tr>
			
				<?php 
				if(isset($rosterDetails->roster)){
						$count = count($rosterDetails->roster);
					}
					else $count = 0;


if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){
					$CI = 0; // CI == Current Index
				for($x=0;$x<$count;$x++){ 
					?>
					<tr>
				<tr class="area_name_class">
					<td colspan="6" class="area-name" area-value="<?php echo $rosterDetails->roster[$x]->areaId ?> " ><?php echo $rosterDetails->roster[$x]->areaName ?>
						<span class="changeRoleOrder" area_id="<?php echo $rosterDetails->roster[$x]->areaId; ?>" >
							<span class="material-icons-outlined">sort</span>
						</span>
					</td>
				</tr>
				<?php $occupancy = 0; ?>
				<?php
					if($rosterDetails->roster[$x]->isRoomYN == "Y")
						{
				?>
				<!-- <tr>
					<td>Occupancy</td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[0]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[1]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[2]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[3]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[4]->occupancy?></td>
					<td> </td>
				</tr> -->
				<?php 
			}
	if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){
				$value = count($rosterDetails->roster[$x]->roles);
		}
		else{
			$value=1;
		}
				for($counter=0;$counter<$value;$counter++){ ?>
				<tr  class="table-row">
					<td   style="width:18vw" class=" cell-boxes left-most">
						<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?>

						<span class="row name-space" style="padding:0;margin:0;">
							<span class="col-4 icon-parent">
								<span class=" icon" style="
									<?php	echo "background:#A4D9D6; color:#707070";?>"><?php echo icon($rosterDetails->roster[$x]->roles[$counter]->empName)?>
								</span>
							</span>
							<span class="col-8 name-role">
								<span class="empname row "><?php echo $rosterDetails->roster[$x]->roles[$counter]->empName?></span>
			<?php
						$variable = 0;
						$userLevel = $rosterDetails->roster[$x]->roles[$counter]->level;
						$variable = $rosterDetails->roster[$x]->roles[$counter]->hourlyRate;
						// foreach($entitlement->entitlements as $e){
						// 		if($e->id == $userLevel ){
						// 			$variable = $e->hourlyRate;
						// 		}
			?>
			<?php } ?>
			<?php if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') =='Y'){ ?>
<?php } ?>
							</span>

							<span class=""><?php // echo  $variable?></span>
						</span>
					
					</td>
				
					<?php $weeklyTotal=0; $p=0; $index=0;$currentSequenceDay=0;?>

					<?php for($fiveIterations=0;$fiveIterations<5;$fiveIterations++){
						$variable = 0;
		$userLevel = $rosterDetails->roster[$x]->roles[$counter]->level;
		$variable = $rosterDetails->roster[$x]->roles[$counter]->hourlyRate;
		// foreach($entitlement->entitlements as $e){
		// 	if($e->id == $userLevel ){
		// 		$variable = $e->hourlyRate;
		// 	}
		// }

		?>
		<?php 
				$date = 0; 
				// print_r($date);

			// print_r($currentSequenceDate);
        if(count($rosterDetails->roster[$x]->roles[$counter]->shifts) > $p){
     $currentDay = $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->currentDate; 

			// if(isset($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave) == true){

			if($currentSequenceDay  == $currentDay){

		 ?>

					<td class="shift-edit cell-boxes count-<?php echo $index+1;?> <?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status?>"  style="width:13vw" 
					 name4="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->shiftid ?>"  

					 name2="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->roleid ?>"
						<?php if($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status != "Rejected"){ 
						if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') =='Y'){
							?>
					 name3="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $variable * ($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)/100; ?>" 
					<?php } } ?>
					 stime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime?>" etime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime?>" 
					 name="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->empName?>"
					 status="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status?>" 
					 area-id="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->areaId;?>"
					 emp-id="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->empId;?>"
					 >
					 <div class="cell-back-1" >
					 	<?php if($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave != "Y"){ 	?>
					 		<span class="row m-0 d-flex justify-content-center"><?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->roleName;?></span>
					 	<?php echo timex(intval($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)). "-" .timex( intval($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime));
					 	?>
				<span class="row m-0 d-flex justify-content-center roster_shift_message">
					<?php echo isset($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->message) ? $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->message : "";?></span>
					 	<?php
		 if($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status != "Rejected"){ 
					  $weeklyTotal = $weeklyTotal + $variable * ($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)/100; ?>
					  				
					<?php  } } ?>

					   </div>
					</td>
					  <?php $p++; $index++;}else{
					  	$p = $p;
					  	$index = $index+1;
					  	 ?>
					  	<td area-id="<?php echo $rosterDetails->roster[$x]->areaId;?>" date="<?php echo $currentSequenceDay; ?>" roster-id="<?php echo $rosterDetails->id; ?>" emp-id="<?php echo  $rosterDetails->roster[$x]->roles[$counter]->empId;?>" level="<?php  $rosterDetails->roster[$x]->roles[$counter]->level;?>" class="__addshift count-<?php echo $index;?>" name3="<?php echo intval(0)/100; ?>"></td>
					  	<?php
					  } }        $currentSequenceDay++;} ?>


				</tr>
			</tr>
			<?php } }  } ?>


	<?php 
	if(isset($rosterDetails->roster)){
		$count = count($rosterDetails->roster);
	}
?>




			</table>
		</div>
	</div>
	</div>
</div>
<!--This is meant for admin-->
<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?> 
	<div id="myModal" class="modal templateModal modalNew">
	  <!-- Modal content -->
		<div class="modal-dialog mw-75">
			<div class="modal-content NewFormDesign">
				<div class="modal-header">
					<h3 class="d-flex box-name-space modal-title col-12">
						<span class="box-name row"> </span>	<span class="box-space row"></span>					
					</h3>
				</div>
			<!-- <span class="close col-2 d-flex align-items-center" >&times;</span> -->
			</span>

			<div class="modal-body container">
				<!-- <form  id="roster-form"> -->
				<div class="col-md-12">
					<div class="form-floating">
						<input class="form-control" type="time" name="startTime" id="startTime" >
						<label for="startTime" >Start Time</label>
					</div> 
				</div>
				<div class="col-md-12">
					<div class="form-floating">
						<input class="form-control" type="time" name="endTime" id="endTime" >
						<label for="endTime" >End Time</label>
					</div> 
				</div>
				<div class="col-md-12">
					<div class="form-floating">
						<select  class="roster_dropdown form-control" name="areaId" id="areaId" >
							<option >Change Area</option>
						</select>
						<label for="areaId" >Area</label>
					</div> 
				</div>
				<div class="col-md-12">
					<div class="form-floating">
						<select class="form-control" name="role" id="role"></select>
						<label for="role" >Role</label>
					</div> 
				</div>
				<div class="col-md-12">
					<div class="form-floating">
						<textarea name="message" id="message" class="form-control" type="text"></textarea>
						<label for="message" >Message</label>
					</div> 
				</div>
				<input type="text" name="shiftId"  id="shiftId" style="display:none">
				<input type="text" name="roleId" id="roleId" style="display:none">
				<input type="text" name="status" value="2"  id="status" style="display:none">
				<input type="text" name="userId"   id="userId" style="display:none">
				<div class="col-md-12 mb30">
					<label class="modal_label">Days</label>
					<span class="col-md-12 edit_shift_modal">
						<span class="d-inline-block">
							<span>Mon</span>
							<input type="checkbox" name="days" value="1" class="d-block edit_shift_checkbox_space" checked>
						</span>
						<span class="d-inline-block">
							<span>Tue</span>
							<input type="checkbox" name="days" value="2" class="d-block edit_shift_checkbox_space" checked>
						</span>
						<span class="d-inline-block">
							<span>Wed</span>
							<input type="checkbox" name="days" value="3" class="d-block edit_shift_checkbox_space" checked>
						</span>
						<span class="d-inline-block">
							<span>Thu</span>
							<input type="checkbox" name="days" value="4" class="d-block edit_shift_checkbox_space" checked>
						</span>
						<span class="d-inline-block">
							<span>Fri</span>
							<input type="checkbox" name="days" value="5" class="d-block edit_shift_checkbox_space" checked>
						</span>
					</span>
				</div>
				<div class="modal-footer">
						<button type="button" name="modal-cancel"  value="Cancel"  class="close buttonn btn btn-default btn-small" >
						<span class="material-icons-outlined">close</span> Close</button>
						<button type="button" name="shift-submit" id="shift-submit" value="Save" class="button btn btn-default btn-small btnBlue">
						<span class="material-icons-outlined">save</span> Save</button>
						<button type="button" name="delete_shift" id="delete_shift" value="Delete" class="buttonn btn btn-default btn-small btnOrange">
						<span class="material-icons-outlined">delete</span> Delete</button>
				</div>
				<div class="infoMessage">* Please select area to get roles</div>
			</div>
		</div>
	 	<!-- </form> -->
	  </div>
</div>
<?php } ?>
<!-- Till here -->>



<div class="modal-logout">
    <div class="modal-content-logout">
        <h3>You have been logged out!!</h3>
        <h4><a class="btn btn-default btn-small btnOrange" href="<?php echo base_url(); ?>">Click here</a> to login</h4>
        
    </div>
</div>

<!-- 	-----------------
		Priority Modal
 		-----------------	-->
<div class="mask" ></div>
<div class="modal_priority" >
	<span class="priority_heading" >
		<a class="text-center  edit_priority" style="padding:1rem 0">Edit Priority</a>
		</span>
		<div class="priority_areas"></div>
		<div class="priority_buttons">
	  	<button class="close_priority" role="button">
				<i>
					<img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:0.8rem;margin-right:10px">
				</i>Cancel</button>
	  	<button class="priority_save">
				<i>
					<img src="<?php echo base_url('assets/images/icons/save.png'); ?>" style="max-height:0.8rem;margin-right:10px">
				</i>Save</button>
	  </div>
</div>
<!-- 	-----------------
		Priority Modal
 		-----------------	-->


 <!-- 	-----------------
		Add Shift Modal
 		-----------------	-->
<!-- <div class="masked" ></div>
<div class="modal_priorityed" >
	<span class="priority_headinged" >
		<a class="text-center  edit_priorityed" style="padding:1rem 0">Add Employee</a>
	</span>
	<?php 
 //   print_r($casualEmployees);
  $casualEmployees = json_decode($casualEmployees); ?>
		<div class="priority_areased">
			<span class="casualEmployee_label">
			<label >Employee</label>
			<span class="select_css no_drop_icon">
				<select id="casualEmp_id" multiple>
				<?php foreach($casualEmployees->casualEmployees as $employee){ ?>
						<option value="<?php echo $employee->empId; ?>" ><?php echo $employee->empName;?></option>
			<?php	} ?>
				</select>
			</span>
			</span>
			<span class="casualEmployee_label">
				<label>Date</label>
				<input type="date" name="" id="casualEmp_date">
			</span>
			<span class="casualEmployee_label">
				<label>Start Time</label>
				<input type="time"  id="casualEmp_start_time" value="09:00">
			</span>
			<span class="casualEmployee_label">
				<label>End Time</label>
				<input type="time"  id="casualEmp_end_time" value="17:00">
			</span>
			<span class="casualEmployee_label">
				<label>Area</label>
				<span class="select_css proper_width_select">
					<select class="casualEmploye-area-select">
						<option>Change Area</option>
					</select>
				</span>
			</span>
			<span class="casualEmployee_label ">
				<label>Role</label>
				<span class="select_css proper_width_select">
					<select class="casualEmploye-role-select" id="casualEmp_role_id">
					
					</select>
				</span>
			</span>
			<span></span>
		</div>
		<div class="priority_buttonsed">
	  		<button class="close_priorityed" role="button">
					<i>
						<img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:0.8rem;margin-right:10px">
					</i>Cancel</button>
	  		<button class="priority_saveed">
					<i>
						<img src="<?php echo base_url('assets/images/icons/save.png'); ?>" style="max-height:0.8rem;margin-right:10px">
					</i>Save</button>
	  </div>
</div> -->
<!-- 	-----------------
		Add Shift Modal
 		-----------------	-->
<!-- ---------------------
		Edit Roster Permissions
		------------------- -->
<div class="modal_outer" ></div>
<div class="modal_body" >
<!-- 	<span class="modal_heading" >
		<a class="text-center  modal_title " style="padding:1rem 0">Edit Permission</a>
	</span> -->
		<div class="modal_main">
			<div class="d-flex justify-content-around">
				<span class="span-class center-class">
					<span class="select_css">
						<select placeholder="Select Center" id="centerValue" onchange="getEmployees()" id="employeeId">
							<?php
								$centers = json_decode($centers);
								foreach($centers->centers as $center){
							?>
							<option value="<?php echo $center->centerid?>"><?php echo $center->name; ?></option>
								<?php }?>
						</select>
					</span>
			</span>
			<span class="span-class employee-id-class">
				<span class="select_css no_drop_icon">
					<select placeholder="Select Center" id="employeeValue" onchange="getPermissions()" multiple>

					</select>
				</span>
			</span>
			</div>
			<div id="permissions_id">
				<span>
					<span><input type="checkbox" name="edit_roster" id="edit_roster"></span>
					<span><label>Edit Roster</label></span>
				</span>
			</div>
		</div>
		<div class="modal_buttons">
	  		<button class="modal_close" role="button">
					<i>
						<img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:0.8rem;margin-right:10px">
					</i>Cancel</button>
	  		<button id="modal_permission">
					<i>
						<img src="<?php echo base_url('assets/images/icons/save.png'); ?>" style="max-height:0.8rem;margin-right:10px">
					</i>Save</button>
	  </div>
</div>
<!-- ---------------------
		Edit Roster Permissions
		------------------- -->
<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?>
<div class="masks" ></div>
<div class="modal_prioritys" >
	<div>
	<span class="priority_heading" >
	<a class="text-center  edit_priority" style="padding:1rem 0">Add Shift</a>
	</span>
	<div class="priority_areass">
		<!-- rosterid --> 				<!-- <input type="" name="" id="" class=""> -->
		<!-- roster date  -->		<!-- <input type="" name="" id="" class=""> -->
		<!-- userid  -->					<!-- <input type="" name="" id="" class=""> -->
		<span class="add_shift_span d-flex">
			<label class="col-5">Start Time</label>
			<input type="time" name="" id="add_start_time" class="add_start_time col-7">
		</span>
		<span class="add_shift_span d-flex">
			<label class="col-5">End Time</label>
			<input type="time" name="" id="add_end_time" class="add_end_time col-7">
		</span>
		<span class="add_shift_span d-flex">
			<label class="col-5">Area</label>
			<span class="select_css roster_dropdown_parent col-7">
				<select type="" name="" id="add_area_id" class=" roster_dropdown" style="">
					<option>Change Area</option>
				</select>
			</span>
		</span>
		<span class="add_shift_span d-flex">
			<label class="col-5">Role</label>
			<span class="select_css proper_width_select">
				<select type="" name="" id="add_role_id" class="add_role_id col-12">
					
				</select>
			</span>
		</span>
    <input type="text" name="" id="store_day" class="d-none">
    <input type="text" name="" id="store_empId" class="d-none">
	</div>
	<div class="priority_buttonss">
  	<button class="close_priority" role="button">
			<i>
				<img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:0.8rem;margin-right:10px">
			</i>Cancel</button>
  	<button class="add_shift">
			<i>
				<img src="<?php echo base_url('assets/images/icons/save.png'); ?>" style="max-height:0.8rem;margin-right:10px">
			</i>Save</button>
  </div>
	</div>
</div>


<!-- /*  ------------------------------
			CHANGE ROLE PRIORITY	MODAL
		------------------------------ */ -->

<div class="changeRolePriority_mask" ></div>
<div class="changeRolePriority_modal" >
	<span class="changeRolePriority_head" >
		<a class="text-center  changeRolePriority_heading" style="padding:1rem 0">Edit Priority</a>
	</span>
		<div class="changeRolePriority_body"></div>
		<div class="changeRolePriority_buttons">
	  	<button class="changeRolePriority_close" role="button">
				<i>
					<img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:0.8rem;margin-right:10px">
				</i>Cancel</button>
	  	<button class="changeRolePriority_save" style="padding-left: 1rem">
				<i>
					<img src="<?php echo base_url('assets/images/icons/save.png'); ?>" style="max-height:0.8rem;margin-right:10px">
				</i>Save</button>
	  </div>
</div>

<!-- /*  ------------------------------
			CHANGE ROLE PRIORITY	MODAL
		------------------------------ */ -->

<?php } ?>
<?php 		 if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "N"){ ?>
<script type="text/javascript">
				var model = document.getElementById("mxModal");

				$(document).on('click','.shift-edit',function(){
					 model.style.display = "block";
				})

				$(document).on('click','.close',function(){
					 model.style.display = "none";
					 ('#user-form').trigger('reset');
				})
				
				$(document).on('click','.buttons',function(){
					window.location.href = "<?php echo base_url() ?>roster/roster_dashboard"
				})

			</script>

<script type="text/javascript">
	$(document).on('click','.shift-edit',function(){
		var starts = $(this).attr('stime');
		var ends = $(this).attr('etime');
		var timings = $(this).text();
		var name = $(this).index();
		var role = $(this).attr('name2');
		var userid = "<?php echo $userid ?>";
		var shiftid = $(this).attr('name4');
			document.getElementsByClassName('box-name')[0].innerHTML = $('th').eq(name).html();
			document.getElementsByClassName('box-space')[0].innerHTML = timings;
			document.getElementById('starts').value = starts; 
			document.getElementById('ends').value = ends;
			document.getElementById('role-Id').value = role;
			document.getElementById('shift-Id').value = shiftid;
	})
</script>


<?php  } ?>
<!-- Till here -->




<!-- This is meant for staff -->



<!-- Till here -->


<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?> 
<script type="text/javascript">
				var modal = document.getElementById("myModal");

				$(document).on('click','.shift-edit',function(){
					if($(this).attr('status')=='Published' || $(this).attr('status')=='Added'){
					 modal.style.display = "block";
					}
				})

				$(document).on('click','.close',function(){
					 modal.style.display = "none";
					 $('#roster-form').trigger('reset');
				})
</script>

<?php }?>
<!-- <script type="text/javascript">
	function uiFunction(){
  if(screen.width > 768){
	    var sideNav = document.getElementsByClassName('side-nav')[0].offsetWidth
	    document.getElementById('containers').style.paddingLeft = 60+"px"
	    document.getElementsByClassName("side-nav")[0].addEventListener("mouseover", mouseOver);
	    document.getElementsByClassName("side-nav")[0].addEventListener("mouseleave", mouseLeave);
	  }
			}
			function mouseOver(){
			      document.getElementById('containers').style.paddingLeft = 200+"px"
			}
			function mouseLeave(){
			      document.getElementById('containers').style.paddingLeft = 60+"px"
			}
			// calling the function
			  uiFunction();
</script>

 -->
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','#delete_shift',function(){
			var shiftId = $("#shiftId").val();
      var days = [];
      var obj = {};
      for(var i=0;i< ($('.edit_shift_checkbox_space').length);i++){
        obj = {};
        obj.YN = ($('.edit_shift_checkbox_space').eq(i).is(':checked'));
        days.push(obj);
      }
			let bool = confirm("confirm delete shift?");
      if(bool == true){
              var url = "<?php echo base_url() ?>roster/deleteTemplateShift/"+shiftId;
              $.ajax({
              url : url,
              data : {
                days : days
              },
              method : 'POST',
              success: function(response){
                window.location.reload();
                // console.log(response)
              }
            })
      } 
    })
  })
</script>
<?php if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') =='Y'){ ?>
<script type="text/javascript">
				$(document).ready(function(){
				var	total = 0;
				var count = $('.count-1').length
				console.log(count)
				for(var i=0;i<count;i++){
					if(isNaN(parseInt($('.count-1').eq(i).attr('name3')))){
						total = total;
					}
					else{
				total = total + parseInt($('.count-1').eq(i).attr('name3'))
				}
			}
				$('#count-1').html('$'+total)
				//
				total = 0;
				 count = $('.count-2').length
				 console.log(count)
				for( i=0;i<count;i++){
					if(isNaN(parseInt($('.count-2').eq(i).attr('name3')))){
						total = total;
					}
					else{
				total = total + parseInt($('.count-2').eq(i).attr('name3'));
				}
			}
				$('#count-2').html('$'+total)
				//
				total = 0;
				 count = $('.count-3').length;
				 console.log(count)
				for( i=0;i<count;i++){
					if(isNaN(parseInt($('.count-3').eq(i).attr('name3')))){
						total = total;
					}
					else{
				total = total + parseInt($('.count-3').eq(i).attr('name3'))
					}
			}
				$('#count-3').html('$'+total)
				//
				total = 0;
				 count = $('.count-4').length
				 console.log(count)
				for( i=0;i<count;i++){
					if(isNaN(parseInt($('.count-4').eq(i).attr('name3')))){
						total = total;
					}
					else{
				total = total + parseInt($('.count-4').eq(i).attr('name3'))
					}
			}
				$('#count-4').html('$'+total)
				//
				total = 0;
				 count = $('.count-5').length
				 console.log(count)
				for( i=0;i<count;i++){
					if(isNaN(parseInt($('.count-5').eq(i).attr('name3')))){
						total = total;
					}
					else{
				total = total + parseInt($('.count-5').eq(i).attr('name3'))
				}
			}
				$('#count-5').html('$'+total)
				})
</script>

<?php } ?>

<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?> 
<script type="text/javascript">
	$(document).ready(function(){


		$(document).on('click','.cell-boxes',function(){
			document.getElementsByClassName('box-name')[0].innerHTML = $(this).attr('name');
			var indexVal = $(this).index();
			document.getElementsByClassName('box-space')[0].innerHTML = $('th').eq(indexVal).html()
			var xvalue = $(this).attr('stime');
			var yvalue = $(this).attr('etime');
			document.getElementById('startTime').value = timer(parseInt(xvalue));
			document.getElementById('endTime').value = timer(parseInt(yvalue));
			document.getElementById('userId').value = "<?php echo $userid ?>";
			document.getElementById('roleId').value = $(this).attr('name2');
			document.getElementById('shiftId').value = $(this).attr('name4');	
			let shiftid = $(this).attr('name4');
			let role = $(this).attr('name2');
			var areaId = $(this).attr('area-id');
			$('#areaId').val(areaId);
			var url = '<?php echo base_url() ?>roster/getTemplateShiftDetails/'+shiftid+'/'+role
				$.ajax({
					url: url,
					type: 'GET',
					success : function(response){
						var centerid = $('#center-id').attr('c_id');
		// var userid = $('#user-id-select').text();
		var response = JSON.parse(response);
		var data = "";
		var url = "<?php echo base_url() ?>settings/getOrgCharts/"+centerid;
		$.ajax({
			method:'GET',
			url:url,
			dataType: 'JSON',
			success:function(response){
					$('#role').empty()
				response['orgchart'].forEach(function(index){
					index['roles'].forEach(function(values){
						if(areaId == values.areaid){
							if(role != values.roleid ){
								 data = "<option value="+values.roleid+">"+values.roleName+"</option>";
							}
							if(role == values.roleid){
								data = "<option value="+values.roleid+" selected>"+values.roleName+"</option>";
							}

								$('#role').append(data)
										}
									})
					})
				}
			})
						$('#message').val(response.shiftDetails.message);
					}
				})
			})


		$(document).on('click','#shift-submit',function(){
			var startingTime = document.getElementById('startTime').value ;
			var endingTime = document.getElementById('endTime').value;
			var alpha = startingTime;
			var beta = alpha.split(':')
			var gamma = parseInt(beta[0]+beta[1]);
			var alphas = endingTime;
			var betas = alphas.split(':')
			var gammas = parseInt(betas[0]+betas[1]);
			var startTime = gamma;
			var endTime = gammas;
			var shiftid = $('#shiftId').val();
			var status = document.getElementById('status').value;
			var userid = "<?php echo $userid ?>";
			var message = $('#message').val();
      var days = [];
      var obj = {};
      for(var i=0;i<$('.edit_shift_checkbox_space').length;i++){
        obj = {};
        obj.YN = $('.edit_shift_checkbox_space').eq(i).is(':checked');
        days.push(obj);
      }
			if($('#role').val() != null || $('#role').val() !=""){
				var roleid = $('#role').val()
			}else{			
						var roleid = $('#roleId').val();
					}
			if($('#role').val() != null || $('#role').val() !=""){
				var areaid = $('#areaId').val()
			}else{			
						var areaid = $(this).attr('area-id');
					}

			url = "<?php echo base_url() ?>roster/updateTemplateShift";
			console.log(startTime + " "+ endTime +" "+ shiftid+" "+roleid+" "+status +" "+userid+" "+areaid+ "" + message)
			$.ajax({
				url:url,
				type:'POST',
				data:{
					startTime:startTime,
					endTime:endTime,
					shiftid:shiftid,
					roleid:roleid,
					status:status,
					userid:userid,
					areaid:areaid,
					message:message,
          days: days
				},
				success:function(response){
											console.log(response)
											$('#roster-form').trigger('reset');
											window.location.reload();
				}
			})
		})
		
	})
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.roster__',function(){
			var url = "<?php echo base_url() ?>roster/updateRosterTemplate";
			var rosterid = "<?php echo $rosterid; ?>";
			var userid = "<?php echo $userid; ?>";
			if($(this).prop('id') == "discard-roster"){
				$.ajax({
					url:url,
					type:'POST',
					data:{
						userid: userid,
						rosterid: rosterid,
						status: 'Discarded'
					},
					success:function(response){
						window.location.href= "<?php echo base_url() ?>roster/roster_dashboard";
					}

				})
			}
			if($(this).prop('id') == "draft-roster"){
				$.ajax({
					url:url,
					type:'POST',
					data:{
						userid: userid,
						rosterid: rosterid,
						status: 'Draft'
					},
					success:function(response){
window.location.href= "<?php echo base_url() ?>roster/roster_dashboard";					}

				})
			}
			if($(this).prop('id') == "publish-roster"){
				$.ajax({
					url:url,
					type:'POST',
					data:{
						userid: userid,
						rosterid: rosterid,
						status: 'Published'
					},
					success:function(response){
						console.log(response);
						window.location.href= "<?php echo base_url() ?>roster/roster_dashboard";
					}

				})
			}
		})
	})
</script>
<?php }?>
<script type="text/javascript">

    $('.containers').css('paddingLeft',$('.side-nav').width());

</script>
	<script type="text/javascript">
	function timer( x)
	{ 
	    var output="";
	    if((x/100) < 12){
	        if((x%100)==0 ){
	        	if((x/100)<10){
	         output = "0"+Math.floor(x/100) + ":00" ;
	   		 }
		    if((x/100)>9){
		    	output = Math.floor(x/100) + ":00" ;
		    }
	    }
	    if((x%100)!=0){
	        if((x/100)<10){
	        	if(x%100 <10){
	        		 output = "0"+Math.floor(x/100) + ":0" + String(x%100) ;
	        	}
	        	else{
	        		 output = "0"+Math.floor(x/100) + ":" + String(x%100) ;
	        	}
	        }
	    }
	     if((x/100)>10){
	         if(x%100 <10){
	        		 output = Math.floor(x/100) + ":0" + String(x%100) ;
	        	}
	        	else{
	        		 output = Math.floor(x/100) + ":" + String(x%100) ;
	        	}
	        }
	    }
	
	else if((x/100)>12){
	    if((x%100)==0){
	    output = x/100 + ":00";
	    }
	    if((x%100)!=0){
	    	if(x%100 <10){
	        		 output = Math.floor(x/100) +":0" + x%100 ;
	        	}
	        	else{
	        		 output = Math.floor(x/100) +":" + x%100 ;
	        	}
	    
	    }
	}
	else{
	if((x%100)==0){
	     output = Math.floor(parseInt(x/100)) + ":00";
	    }
	    if((x%100)!=0){
	    	if(x%100 <10){
	        		 output = Math.floor(x/100) +":0" + x%100 ;
	        	}
	        	else{
	        		 output = Math.floor(x/100) +":" + x%100 ;
	        	}
	    }
	}
	return output;
}

</script>


<script type="text/javascript">
	$(document).ready(function(){
		var centerid = $('#center-id').attr('c_id');
		// var userid = $('#user-id-select').text();
		var url = "<?php echo base_url() ?>settings/getOrgCharts/"+centerid;
		$.ajax({
			method:'GET',
			url:url,
			dataType: 'JSON',
			success:function(response){
				response['orgchart'].forEach(function(index){
					var data = "<option value="+index.areaId+">"+index.areaName+"</option>";
					$('#areaId').append(data)
				})
			}
		})
	})
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('change','#areaId',function(){
		 var centerid = $('#center-id').attr('c_id');
		// var userid = $('#user-id-select').text();
		var areaId = $(this).val();
		var url = "<?php echo base_url() ?>settings/getOrgCharts/"+centerid;
		$.ajax({
			method:'GET',
			url:url,
			dataType: 'JSON',
			success:function(response){
					$('#role').empty()
				response['orgchart'].forEach(function(index){
					index['roles'].forEach(function(values){
						if(areaId == values.areaid){
							var data = "<option value="+values.roleid+">"+values.roleName+"</option>";
								$('#role').append(data)
										}
									})
					})
				}
			})
		})
	})
</script>
<script type="text/javascript">
	$(document).ready(function(){
		let height = $('td[name2 != ""] div').eq(0).height();
		let count =	 $('td[name2 = ""]').length;
		for(let i=0;i<count;i++){
		$('td[name2 = ""] .leave').eq(i).height(height);
			}
			console.log(height)
	})
</script>
<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?> 
<script type="text/javascript">
	$(document).ready(function(){
	  $(document).on('click','.priority-btn',function(){
		let count = $('tr').length ;
		let array = [];
		console.log(count)
		var i =0;
		for(i=1;i<count;i++){
			if($('tr').eq(i).hasClass('area_name_class') == false) {
				// $('tr').eq(i).hide()
				console.log(i)
				}
			 else{
				console.log($('tr').eq(i).text())
				array[i] = $('tr')[i].outerHTML
				// console.log(i)
			 }
		   }
		     $(".priority_areas").sortable();
			$(".priority_areas").disableSelection();
			// console.log(array)
			$(".mask").addClass("active");
			$(".priority_areas").append(array)
	   })
	})
</script>
<script type="text/javascript">
	$(document).ready(function(){
	  $(document).on('click','.priority_save',function(){
	  	console.log($('.priority_areas tr').length);
	  	let count = $('.priority_areas tr').length ;
		console.log(count)
		var i = 0;
		let j = 0;

		for(i=0;i<count;i++){
			if($('.priority_areas tr').eq(i).hasClass('area_name_class') == true) {

				j++;
				areaid = $('.priority_areas tr td').eq(i).attr('area-value')
				priority = j;
				console.log( areaid);
		  $.ajax({
		  		url: '<?php echo base_url() ?>roster/changePriority',
		  		data: {
		  			areaid : areaid,
		  			priority : priority
		  		},
		  		type: 'POST',
		  		success: function(){
		  			closeModal()
		  			window.location.reload();
		  		}
		  	})
				}}
		  })

	  })
</script>
<?php } ?>
<script type="text/javascript">
	function closeModal(){
	  $(".mask").removeClass("active");
	}

	$(".close_priority").on("click", function(){
		  closeModal();
		$(".priority_areas").empty();
	});
</script>

<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?>
<script type="text/javascript">
/* ----------------------------------------
						add shift modal 							
	----------------------------------------*/

	$(document).on('click','.__addshift',function(){
		$(".masks").addClass("actives");
    let date = $(this).attr('date');
      $('#store_day').val(date);
		let dates = [];
		let obj = {};
		let emp_id = $(this).attr('emp-id');
      $('#store_empId').val(emp_id);

	})

      $(document).on('click','.add_shift',function(){
        // FOR MULTIPLE DAYS
    // for(var i=0;i<5;i++){
    //  obj = {};
    //  if(date.getMonth() < 10){
    //  obj.date = `${date.getFullYear()}-0${date.getMonth()+1}-${date.getDate()}`;
    //    }
    //    if(date.getMonth >=10 ){
    //  obj.date = `${date.getFullYear()}-${date.getMonth()+1}-${date.getDate()}`;
    //    }
    //    if($('.checkbox_space').eq(i).is(':checked') == true){
    //      obj.status = true;
    //      dates.push(obj)
    //    }
    //  date.setDate(date.getDate() + 1);
    // }
        let date = $('#store_day').val();
        let roster_id = "<?php echo $rosterDetails->id; ?>";
        let emp_id = $('#store_empId').val();
        let add_start_time = $('#add_start_time').val();
        let add_end_time = $('#add_end_time').val();
        add_start_time = parseInt(add_start_time.replace(":",""));
        add_end_time = parseInt(add_end_time.replace(":",""));
        let add_role_id = $('#add_role_id').val();
        console.log(date+ "---"+roster_id+ "---"+emp_id+ "---"+add_start_time+ "---"+add_end_time+ "---"+add_role_id)
        let url = "<?php echo base_url() ?>roster/addNewTemplateShift";
        $.ajax({
          url:url,
          method:'POST',
          data:{
            date : date,
            roster_id : roster_id,
            emp_id : emp_id,
            add_start_time : add_start_time,
            add_end_time : add_end_time,
            add_role_id : add_role_id
          },
          success:function(response){
            window.location.reload();
            // console.log(response)
          }
        })
      })

	$(document).on('click','.add_shift',function(){
		// $(this).closest();
	})

	function closeAddShitModal(){
		  $(".masks").removeClass("actives");
		}

	$(".close_priority").on("click", function(){
		  closeAddShitModal();
		});
</script>
<?php } ?>

<?php if( isset($error) != null){ ?>
	<script type="text/javascript">
		
   var modal = document.querySelector(".modal-logout");
       function toggleModal() {
   	     modal.classList.toggle("show-modal");
    	}
	$(document).ready(function(){
  		toggleModal();	
  		});
	</script>
<?php }	?>

<script type="text/javascript">
	$(document).ready(function(){
		var centerid = $('#center-id').attr('c_id');
		// var userid = $('#user-id-select').text();
		var url = "<?php echo base_url() ?>settings/getOrgCharts/"+centerid;
		$.ajax({
			method:'GET',
			url:url,
			dataType: 'JSON',
			success:function(response){
				response['orgchart'].forEach(function(index){
					var data = "<option value="+index.areaId+">"+index.areaName+"</option>";
					$('#add_area_id').append(data)
				})
			}
		})
	})
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('change','#add_area_id',function(){
		 var centerid = $('#center-id').attr('c_id');
		// var userid = $('#user-id-select').text();
		var areaId = $(this).val();
		var url = "<?php echo base_url() ?>settings/getOrgCharts/"+centerid;
		$.ajax({
			method:'GET',
			url:url,
			dataType: 'JSON',
			success:function(response){
					$('#add_role_id').empty()
				response['orgchart'].forEach(function(index){
					index['roles'].forEach(function(values){
						if(areaId == values.areaid){
							var data = "<option value="+values.roleid+">"+values.roleName+"</option>";
								$('#add_role_id').append(data)
										}
									})
					})
				}
			})
		})
	})
</script>
<script>
$( ".modal_prioritys" ).draggable();
$( ".modal-content" ).draggable();
$( ".modal_priority" ).draggable();
$('.modal_priorityed').draggable();
$('.modal_body').draggable();


</script>
<script type="text/javascript">
	$(document).on('click','.casualEmploye-btn',function(){
			$(".masked").addClass("actived");
		});

	function closeModalEmp(){
	  $(".masked").removeClass("actived");
	}

	$(".close_priorityed").on("click", function(){
	 		 closeModalEmp();
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		var centerid = $('#center-id').attr('c_id');
		// var userid = $('#user-id-select').text();
		var url = "<?php echo base_url() ?>settings/getOrgCharts/"+centerid;
		$.ajax({
			method:'GET',
			url:url,
			dataType: 'JSON',
			success:function(response){
				response['orgchart'].forEach(function(index){
					var data = "<option value="+index.areaId+">"+index.areaName+"</option>";
					$('.casualEmploye-area-select').append(data)
				})
			}
		})
	})
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('change','.casualEmploye-area-select',function(){
		 var centerid = $('#center-id').attr('c_id');
		// var userid = $('#user-id-select').text();
		var areaId = $(this).val();
		var url = "<?php echo base_url() ?>settings/getOrgCharts/"+centerid;
		$.ajax({
			method:'GET',
			url:url,
			dataType: 'JSON',
			success:function(response){
					$('.casualEmploye-role-select').empty()
				response['orgchart'].forEach(function(index){
					index['roles'].forEach(function(values){
						if(areaId == values.areaid){
							var data = "<option value="+values.roleid+">"+values.roleName+"</option>";
								$('.casualEmploye-role-select').append(data)
										}
									})
					})
				}
			})
		})
	})
</script>
<script type="text/javascript">
	$(document).on('click','.priority_saveed',function(){
		var date = $('#casualEmp_date').val();
		var roster_id = "<?php echo $rosterDetails->id; ?>";
		var emp_id = $('#casualEmp_id').val();
		var casualEmp_start_time = $('#casualEmp_start_time').val();
		var casualEmp_end_time = $('#casualEmp_end_time').val();
		casualEmp_start_time = parseInt(casualEmp_start_time.replace(":",""));
		casualEmp_end_time = parseInt(casualEmp_end_time.replace(":",""));
		var casualEmp_role_id = $('#casualEmp_role_id').val();
		console.log(date+ "---"+roster_id+ "---"+emp_id+ "---"+casualEmp_start_time+ "---"+casualEmp_end_time+ "---"+casualEmp_role_id)
		if(date != null && date != "" && roster_id != null && roster_id != "" && emp_id != null && emp_id != "" && casualEmp_start_time != null && casualEmp_start_time != "" && casualEmp_end_time != null && casualEmp_end_time != "" && casualEmp_role_id != null && casualEmp_role_id != ""){
		var url = "<?php echo base_url() ?>roster/addCasualEmployee";
		$.ajax({
			url:url,
			method:'POST',
			data:{
				date : date,
				roster_id : roster_id,
				emp_id : emp_id,
				casualEmp_start_time : casualEmp_start_time,
				casualEmp_end_time : casualEmp_end_time,
				casualEmp_role_id : casualEmp_role_id
			},
			success:function(response){ 
				// if(JSON.parse(response).status == "REDUNDANT"){
				// 	alert('Shift for this user, for the particular date already exists in another center. Please delete the shift to add a new one');
				// }else{
          console.log(response)
				// window.location.reload();
				// }
			}
		})
		}else{
			
		}

	})
</script>
<script type="text/javascript">
	$(document).ready(function(){
		// url modifiers
		$(document).on('click','.showBudget-btn',function(){
			let url = new URL(window.location.href);
				parameters = url.searchParams
			if($(this).attr('show-budget') == 'N'){
				parameters.set("showBudgetYN","N");
			}
			if($(this).attr('show-budget') == 'Y'){
				parameters.delete("showBudgetYN");
			}
				url.search = parameters.toString();
				window.location.href= url.href
		})
	})
</script>
<script type="text/javascript">
		//	Printing
	function landscape(){
			var css = '@page { size: landscape; }',
			    head = document.head || document.getElementsByTagName('head')[0],
			    style = document.createElement('style');

			style.type = 'text/css';
			style.media = 'print';

			if (style.styleSheet){
			  style.styleSheet.cssText = css;
			} else {
			  style.appendChild(document.createTextNode(css));
			}

			head.appendChild(style);

			window.print();
	}
	function portrait(){
		var css = '@page { size: portrait; }',
		    head = document.head || document.getElementsByTagName('head')[0],
		    style = document.createElement('style');

		style.type = 'text/css';
		style.media = 'print';

		if (style.styleSheet){
		  style.styleSheet.cssText = css;
		} else {
		  style.appendChild(document.createTextNode(css));
		}

		head.appendChild(style);

		window.print();
	}
</script>
<script type="text/javascript">
	// Edit Roster Permissions start (e-r-p):key

	$(document).on('click','.editPermission-btn',function(){
			$(".modal_outer").addClass("modal_active");
				getEmployees();
		});

	function close_modal(){
	  $(".modal_outer").removeClass("modal_active");
	}

	$(".modal_close").on("click", function(){
	 		 close_modal();
	});

</script>
<script type="text/javascript">
	var base_url = "<?php echo base_url();?>";
	function getEmployees(){
		var xhttp = new XMLHttpRequest();
		var centerId = document.getElementById("centerValue").value;
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var employees = JSON.parse(xhttp.responseText);
				var finalStr = "";
				for(var i=0;i<employees.employees.length;i++){
					finalStr += '<option value = "' + employees.employees[i].id +  '">' + employees.employees[i].name + '</option>';
				}
				document.getElementById("employeeValue").innerHTML = finalStr;
				getPermissions();
			}
		};
		xhttp.open("GET", base_url+"settings/getEmployeesByCenter/"+centerId, true);
		xhttp.send();
	}

</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','#modal_permission',function(){
			let employeeId = $('#employeeValue').val();
			let editRoster = ($('#edit_roster').is(':checked') == true) ? 'Y' : 'N' ;
			let rosterId = "<?php echo $rosterid; ?>";
			alert(employeeId)
			let url = '<?php echo base_url() ?>roster/saveRosterPermissions';
			$.ajax({
				url : url,
				method : 'POST',
				data : {
					employeeId : employeeId,
					editRoster : editRoster,
					rosterId : rosterId
				},
				success : function(response){

				}
			})
		})
	})
</script>
<script type="text/javascript">
	function getPermissions(){
		let rosterId = "<?php echo $rosterid; ?>";
		let employeeId = $('#employeeValue').val();
		console.log(employeeId)
		let url = '<?php echo base_url() ?>Roster/getRosterPermissions/'+employeeId+'/'+rosterId;
	 	$.ajax({
	 		url : url,
	 		method : 'GET',
	 		success : function(response){
	 			if(JSON.parse(response).getPermissions[0] != null){
	 			document.getElementById('edit_roster').checked = (((JSON.parse(response).getPermissions[0].editRoster) == 'Y') ? true : false ) ;
	 			console.log(JSON.parse(response).getPermissions[0].editRoster)
	 		}
	 		else{
						document.getElementById('edit_roster').checked = false
						}
	 			
	 		}

	 	})
	 }
</script>
<script type="text/javascript">
	    $(document).ready(function(){
        $('#casualEmp_id').tokenize2();
        $('#employeeValue').tokenize2();
    });
</script>
<script type="text/javascript">
/*  -----------------------------
			CHANGE ROLE PRIORITY	MODAL
		------------------------------ */


	function closeChangeRolePriority(){
	  $(".changeRolePriority_mask").removeClass("active");
	}

	$(".changeRolePriority_close").on("click", function(){
		  closeChangeRolePriority();
		$(".changeRolePriority_body").empty();
	});
/*  -----------------------------
			CHANGE ROLE PRIORITY	MODAL
		------------------------------ */
	$(document).ready(function(){
		$(document).on('click','.changeRoleOrder',function(){
			$('.changeRolePriority_body').empty();
			$('.changeRolePriority_mask').addClass("active");
			var areaId = $(this).attr('area_id');
			var centerid = $('#center-id').attr('c_id');
			let url = "<?php echo base_url() ?>settings/getOrgCharts/"+centerid;
			$.ajax({
				url : url,
				method : 'GET',
				success : function(response){
					response = JSON.parse(response)
					response.orgchart.forEach(function(item){
						if(item.areaId == areaId){
							item.roles.forEach(function(role){
								var code = `
								<tr class="d-block">
									<td class="change_role_priority area-name" roleId="${role.roleid}">${role.roleName}</td>
								</tr>`;
								$('.changeRolePriority_body').append(code);
							})
						}
					})
					// console.log(response)
				}
			})
		})
	})
			$('.changeRolePriority_body').sortable()
			$(".changeRolePriority_body").disableSelection();

		$(document).on('click','.changeRolePriority_save',function(){
			var url = "<?php echo base_url() ?>settings/changeRolePriority"
			var order = [];
			var obj = {};
			for(let i=0;i<($('.change_role_priority').length);i++){
				obj = {};
				obj.roleid = $('.change_role_priority').eq(i).attr('roleid');
				obj.priority = i;
				order.push(obj);
			}
			$.ajax({
				url : url,
				method : 'POST',
				data : {
					order : order
				},
				success : function(response){
					console.log(response)
					window.location.reload();
				}
			})
		})
</script>
</body>
</html>


<!-- 334 -->