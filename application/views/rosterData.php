<?php
$colors_array = ['#8dba5e','#9ebdff','#dd91ee','#f7c779','#a9bfaf','#6b88ca'];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
		<?php $this->load->view('header'); ?>
<meta content="width=device-width, initial-scale=1" name="viewport" />
	<title>Roster</title>
<!--	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
	*{
font-family: 'Open Sans', sans-serif;
text-align:center;
	}
	body{
		background:#f3f4f7;
	}
.containers{/*
	width:95%;
	*/
	margin-left:20px;
}
			/* The Modal (background) */
.modal {
  display: none; 
  position: fixed;
    padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.4); 
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
/*.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}*/
	.close{
		float: none; 
	    font-size: inherit; 
	    font-weight: inherit; 
	    line-height: inherit; 
	    color: inherit; 
	    text-shadow: inherit; 
	    opacity: inherit; 
	}
	.close:hover{
		background:#9E9E9E;
	}
input[type="text"],input[type=time],select{
	background: #ebebeb;
	border-radius: 5px;
    padding: 5px;
    border: 2px solid #e9e9e9 !important;
}
table,tr,td{
	border:1px solid rgba(0,0,0,0.1)
}
.heading{
	text-align: left;
	font-weight:bold;
	font-size:2rem;
	padding-left:50px;
}
.roster-dates{
	text-align:left;
	/*background-color: #e3e9f5;*/
	background-color:white;
	/*color:#afb7cd;*/
	color:black;
	padding-left:50px;
	padding-bottom:10px;
	padding-top:10px;
	font-weight:bolder;
}
.table-div{
	background:white;
	margin-bottom: 200px
}
.area-name{
	background:#307bd3;
	color:white;
	padding:0.25rem 0;
}
.day{
	background:transparent;
}
.day-row{
	background: #ADD8E6;
}
.total-budget{
	padding-top:10px;
}
.hourly{
	font-size:12px;
	text-align: left;
}
.hourly::before{
	content:'$';
}
.hourly::after{
	content:'/hr';
}
.title{
	font-size:12px;
	padding-left: 1rem
	
}
.icon{
	font-size:1rem;
	display:flex;
	justify-content:center;
	align-self: center;
	border-radius: 50%;
	padding:0.25rem 0;
	color:white;
	height: 2rem;
	width: 2rem;
}
.empname{
	font-size:15px;
	display:flex;
	justify-content:left;
	padding: 0 1rem;
	font-weight: 600;
}
.modal-content{
max-width:30vw;
	}
	.modal-content .titl{
	width: 100%;
    position: relative;
    top: 0;
    left: 0;
    margin: 0;
    padding: 0;
    background:#307bd3;
	}
	.ui-timepicker-container{
		z-index:999;
	}
	.buttons{
		padding:10px 20px;
		margin:2px;
	}
	.button{
		background-color: #9E9E9E;
  border: none;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 2px
}
	.buttonn{
		background-color: #9E9E9E;
  border: none;
  color: white;
  padding: 10px 10px;
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
.buttonn:hover{
	background-color: #9E9E9E;
	color: white;
}
.shift-edit{
	padding:10px;
}
.cell-back-1{
	margin:0 10px 0 10px;
	font-size: 0.75rem;
	padding:0.2rem;
}
.cell-boxes{
	padding:0.5rem 0;
}
.name-role{
	padding:0;
	margin:0;
}
.left-most{
	border-top:1px solid rgba(0,0,0,0.3);
	border-bottom:1px solid rgba(0,0,0,0.3);
}
.day{
	padding:10px;
}
.icon-parent{
	display: flex;
	align-content: center;
	justify-content: center
	padding:0;
}
.box-name-space{
	width:100%;
}
.box-name{
	display: flex;
    justify-content: center;
    font-size:30px;
    color:white;
}
.box-space{
	display: flex;
    justify-content: center;
    color:white;
}
.total-name{
	display: flex;
    justify-content: center;
    font-size:30px;
}
.total-space{
	display: flex;
    justify-content: center;
}
#roster-form{
	position: relative;
}
.total-budget-row {
		background:#FFFCAD;
		margin:10px;
		color:#434040;
}
.total-budget .total-budget-row td{
	background:#FFF1AE;
	padding:10px;
	font-weight: bolder;
}
#shift-submit,#user-submit{
	background-color: #9E9E9E;
  border: none;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 2px
}
.Added{
	background: #e7e7e7;
	border-radius: 3px;
}

.Published{
	background:rgba(156,39,1760.5);
	border-radius: 3px;
}
.Accepted{
	background:rgba(76,175,80,0.8);
	border-radius: 3px;
}
.nav-link{
	text-align:left;
}
.leave{
	background: orange;
	content: 'On Leave';
	display: flex;
	align-items: center;
	justify-content: center;
}
.budget-table-parent{
	position: fixed;
	bottom: 0;
  background: #f3f4f7;
}


.mask {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255,255,255,0.1);
  z-index: 50;
  visibility: hidden;
  opacity: 0;
  transition: 0.7s;
}
.modal_priority {
  position: fixed;
  top: 50%;
  left: 50%;
  width: 400px;
  height: 400px;
  margin-left: -200px;
  margin-top: -150px;
  background: #fff;
  z-index: 100;
  visibility: hidden;
  opacity: 0;
  transition: 0.5s ease-out;
  transform: translateY(45px);
}
.active {
  visibility: visible;
  opacity: 1;
}
.active + .modal_priority {
  visibility: visible;
  opacity: 1;
  transform: translateY(0);
}
.priority_areas  tr td{
	width: 300px;
	cursor: move;
}
.prority_buttons{
	position:absolute;
	bottom: 10px;
	width:100%;
	justify-content: center;
	display: flex;
}
.priority_areas {
	display: flex;
    position: absolute;
    text-align: center;
    justify-content: center;
    width: 100%;
    flex-wrap: wrap;
}
.priority{
	font-size:1rem;
	width:100%;
}
.priority-btn{
	position: absolute;
	right: 0;
			background-color: #9E9E9E;
  border: none;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 2px
}
.close_priority{
				background-color: #9E9E9E;
  border: none;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 2px
}
.priority_save{
				background-color: #9E9E9E;
  border: none;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 2px
}
.edit_priority{
	font-weight: 700;
	font-size: 2rem
}
@media print{
	td:nth-child(6){
		display: none;
	}
	.budget-table-parent{
		display: none
	}
	.column_budget{
		display: none
	}
	.priority{
		display: none
	}
}
@media only screen and (max-width: 1050px) {
			.header-top{
			max-width: 100vw !important;
		}
		.table-div{
			padding: 0;
			position: relative;
			max-width: 100vw !important;
   			overflow-x: scroll !important;
		}
				.title{
			display: flex;
   			 justify-content: center;
		}
.modal-content{
	min-width:100vw;
}
.containers {
     width: 100%;
    margin: 0px;
}
.name-space{
	display: block
}
.icon-parent{
	max-width:100%;
	justify-content: center
}
}
</style>
</head>
<body>

	<?php 
		$rosterDetails = json_decode($rosterDetails); 
		$entitlement = json_decode($entitlements);
	?>
	<div class="containers" id="containers">
		<div class="heading" id="center-id" c_id="<?php echo $rosterDetails->centerid; ?>">Rosters
			<span class="priority ml-auto"><button class="priority-btn ">Priority</button></span>
		</div>
		<div class="roster-dates"><?php 

//PHP functions //

function timex( $x)
	{ 
	    $output;
	    if(($x/100) < 12){
	        if(($x%100)==0){
	         $output = $x/100 . ":00 AM";
	        }
	    if(($x%100)!=0){
	        $output = $x/100 .":". $x%100 . "AM";
	        }
	    }
	else if(($x/100)>12){
	    if(($x%100)==0){
	    $output = ($x/100)-12 . ":00 PM";
	    }
	    if(($x%100)!=0){
	    $output = ($x/100)-12 .":". $x%100 . "PM";
	    }
	}
	else{
	if(($x%100)==0){
	     $output = ($x/100) . ": 00 PM";
	    }
	    if(($x%100)!=0){
	    $output = ($x/100) . ":". $x%100 . "PM";
	    }
	}
	return $output;
}

function dateToDay($date){
	$date = explode("-",$date);
	return date(",M d",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
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

//PHP functions //
		if(isset($rosterDetails->startDate)){
			$str1 = $rosterDetails->startDate;
		if(isset($rosterDetails->endDate)){
		 $str2 = $rosterDetails->endDate; 
			 $v1 = explode("-",$str1);
			 $v2 = explode("-",$str2);
		 echo date("M d",mktime(0,0,0,$v1[1],intval($v1[2]),(intval($v1[0]))))." to ". 
		 date("M d , Y",mktime(0,0,0,$v2[1],intval($v2[2]),(intval($v2[0]))));
		}}
		 ?> </div>
		<div class="table-div" style="">
			<table>
				<tr class="day-row">
					<th id="table-id-1" class="day" style="width:16vw">Employees</th>	<?php $x=0;
					if(isset($rosterDetails->startDate)){
						$startDate = date('Y-m-d', strtotime($rosterDetails->startDate));
						?>
					<th id="table-id-2" class="day" style="width:12vw">Mon <?php echo dateToDay($rosterDetails->startDate) ?></th>
					<th id="table-id-3" class="day"  style="width:12vw">Tue <?php  
						$endDate = date( "Y-m-d", strtotime( "$startDate +1 day" ));
						echo dateToDay($endDate); ?></th>
					<th id="table-id-4" class="day"  style="width:12vw">Wed <?php 
						$endDate = date( "Y-m-d", strtotime( "$startDate +2 day" ));
						echo dateToDay($endDate); ?></th>
					<th id="table-id-5" class="day"  style="width:12vw">Thu <?php 
						$endDate = date( "Y-m-d", strtotime( "$startDate +3 day" ));
						echo dateToDay($endDate); ?></th>
					<th id="table-id-6" class="day" style="width:12vw">Fri <?php 
						$endDate = date( "Y-m-d", strtotime( "$startDate +4 day" ));
						echo dateToDay($endDate); }?></th>
					<th id="table-id-7" class="day"  style="width:12vw">
						<span class="column_budget">
							<span class="row d-flex justify-content-center m-0">Budget </span>
							<span class="row d-flex justify-content-center m-0" style="font-size:0.7rem">(Emp wise)</span>
						</span>
					</td>
				</tr>
			
				<?php 
				if(isset($rosterDetails->roster)){
						$count = count($rosterDetails->roster);
					}
					else $count = 0;
if($this->session->userdata('UserType')==SUPERADMIN || $this->session->userdata('UserType')==ADMIN){
				for($x=0;$x<$count;$x++){ 
					?>
					<tr>
				<tr class="area_name_class">
					<td colspan="7" class="area-name" area-value="<?php echo $rosterDetails->roster[$x]->areaId ?> "><?php echo $rosterDetails->roster[$x]->areaName ?></td>
				</tr>
				<?php $occupancy = 0; ?>
				<?php
					if($rosterDetails->roster[$x]->isRoomYN == "Y")
						{
				?>
				<tr>
					<td>Occupancy</td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[0]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[1]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[2]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[3]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[4]->occupancy?></td>
					<td> </td>
				</tr>
				<?php 
			}
				if($this->session->userdata('UserType')==ADMIN || $this->session->userdata('UserType')==SUPERADMIN){
				$value = count($rosterDetails->roster[$x]->roles);
		}
		else{
			$value=1;
		}
				for($counter=0;$counter<$value;$counter++){ ?>
				<tr  class="table-row">
					<td   style="width:16vw" class=" cell-boxes left-most">
						<?php if($this->session->userdata('UserType')==ADMIN || $this->session->userdata('UserType')==SUPERADMIN){ ?>

						<span class="row name-space" style="padding:0;margin:0;">
							<span class="col-4 icon-parent">
								<span class=" icon" style="
									<?php	echo "background:".$colors_array[rand(0,5)].";";?>"><?php echo icon($rosterDetails->roster[$x]->roles[$counter]->empName)?>
								</span>
							</span>
							<span class="col-8 name-role">
								<span class="empname row "><?php echo $rosterDetails->roster[$x]->roles[$counter]->empName?></span>
			<?php
						$variable = 0;
						$userLevel = $rosterDetails->roster[$x]->roles[$counter]->level;
						foreach($entitlement->entitlements as $e){
								if($e->id == $userLevel ){
									$variable = $e->hourlyRate;
								}
			?>
			<?php } ?>
								<span class="title hourly row"><?php echo  $variable; // echo $rosterDetails->roster[$x]->roles[$counter]->empTitle ?></span>
							</span>

							<span class=""><?php // echo  $variable?></span>
						</span>
					
					</td>
				
					<?php $weeklyTotal=0; ?>
					<?php for($p=0;$p<5;$p++){
						$variable = 0;
		$userLevel = $rosterDetails->roster[$x]->roles[$counter]->level;

		foreach($entitlement->entitlements as $e){
			if($e->id == $userLevel ){
				$variable = $e->hourlyRate;
			}
		}

		?>

					<td class="shift-edit cell-boxes count-<?php echo $p+1;?>"  style="width:12vw" 
					 name4="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->shiftid?>"  
					 name2="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->roleid ?>"
					 name3="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $variable * ($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)/100; ?>" 
					 stime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime?>" etime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime?>" 
					 name="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->empName?>"
					 status="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status?>" 
					 area-id="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->areaId;?>">

					 <div class="cell-back-1 <?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? 'leave' : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status;  ?>" >
					 	<?php if($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave != "Y"){ ?>
					 		<span class="row m-0 d-flex justify-content-center"><?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->roleName;?></span>
					 	<?php echo timex(intval($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)). "-" .timex( intval($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime));
					  $weeklyTotal = $weeklyTotal + $variable * ($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)/100; ?>

					<?php  }else{
						echo 'On Leave';
					} ?>

					   </div>
					</td>
					  <?php } ?>
					<td class=" " style="width:12vw;font-weight:bolder"><?php echo "$".$weeklyTotal;?></td>

				</tr>
			</tr>
			<?php } }  } }?>


	<?php 
	if(isset($rosterDetails->roster)){
		$count = count($rosterDetails->roster);
	}
if($this->session->userdata('UserType')==STAFF){
				for($x=0;$x<1;$x++){ 
					
					if($rosterDetails->roster[$x]->isRoomYN == "Y")
						{?>
				<tr >
					<td colspan="7" class="area-name"><?php echo $rosterDetails->roster[$x]->areaName ?></td>
				</tr>
				<?php $occupancy = 0; ?>
				<tr>
					<td></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[0]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[1]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[2]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[3]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[4]->occupancy?></td>
					<td> </td>
				</tr>
				<?php 
				if($this->session->userdata('UserType')==ADMIN || $this->session->userdata('UserType')==SUPERADMIN){
				$value = count($rosterDetails->roster[$x]->roles);
		}
		else{
			$value=1;
		}
				for($counter=0;$counter<$value;$counter++){ ?>
				<tr  class="table-row">
					<td   style="width:16vw" class=" cell-boxes left-most">
						
						<span class="row name-space" style="padding:0;margin:0;">
							<span class="col-4 icon-parent">
								<span class=" icon" style="
									<?php	echo "background:".$colors_array[rand(0,5)].";";?>"><?php echo icon($rosterDetails->roster[$x]->roles[$counter]->empName)?>
								</span>
							</span>
							<span class="col-8 name-role">
								<span class="empname row "><?php echo $rosterDetails->roster[$x]->roles[$counter]->empName?></span>
			<?php
						$variable = 0;
						$userLevel = $rosterDetails->roster[$x]->roles[$counter]->level;
						foreach($entitlement->entitlements as $e){
								if($e->id == $userLevel ){
									$variable = $e->hourlyRate;
								}
			?>
			<?php } ?>
								<span class="title hourly row"><?php echo  $variable; // echo $rosterDetails->roster[$x]->roles[$counter]->empTitle ?></span>
							</span>

							<span class=""><?php // echo  $variable?></span>
						</span>
					</td>
				
					<?php $weeklyTotal=0; ?>
					<?php for($p=0;$p<5;$p++){
						$variable = 0;
		$userLevel = $rosterDetails->roster[$x]->roles[$counter]->level;
		foreach($entitlement->entitlements as $e){
			if($e->id == $userLevel ){
				$variable = $e->hourlyRate;
			}
		}
		?>

					<td class="shift-edit cell-boxes count-<?php echo $p+1;?>"  style="width:12vw" 
					 name4="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->shiftid?>"  
					 name2="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->roleid ?>"
					 name3="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : intval($variable * ($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)/100); ?>" 
					 stime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime?>" etime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime?>" 
					 name="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->empName?>"
					 status="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status?>">

					 <div class="cell-back-1 <?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? 'leave' : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status;  ?>">
				<?php if($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave != "Y"){ ?>
					 	<span class="row m-0 d-flex justify-content-center"><?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->roleName;?></span>
					 	<?php echo timex(intval($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)). "-" .timex( intval($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime));
					  $weeklyTotal = $weeklyTotal + $variable * ($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)/100; ?> 
					<?php }else{
						echo 'On Leave';
					} ?>
					</div>
					</td>

					  <?php } ?>
					<td class=" " style="width:12vw;font-weight:bolder"><?php echo "$".$weeklyTotal;?></td>

				</tr>
			<?php } } } }?>





			</table>
		</div>
		<div class="budget-table-parent">
		<div class="total-budget" >
			<table>
				<tr class="total-budget-row">
					<td class="total-budget-box" style="width:16vw">Total Budget</td>
					<td class="total-budget-box" style="width:12vw" id="count-1" >$</td>
					<td class="total-budget-box" style="width:12vw" id="count-2">$</td>
					<td class="total-budget-box" style="width:12vw" id="count-3">$</td>
					<td class="total-budget-box" style="width:12vw" id="count-4">$</td>
					<td class="total-budget-box" style="width:12vw" id="count-5">$</td>
					<td class="total-budget-box" style="width:12vw">---</td>
				</tr>
			</table>
		</div>
<?php if($this->session->userdata('UserType')==SUPERADMIN || $this->session->userdata('UserType')==ADMIN){ ?>

					<?php 
				if(isset($rosterDetails->status)){
						if($rosterDetails->status === 'Draft'){ ?>
						<div class="buttons d-flex justify-content-end">
							<button id="discard-roster" class="button">Discard</button>
							<button id="draft-roster" class="button">Save Draft</button>
							<button id="publish-roster" class="button">Publish</button>
						</div>
					<?php } ?>
					<?php if($rosterDetails->status === 'Published') {?>
					<div class="buttons d-flex justify-content-end">
						<button id="discard-roster" class="button">Discard</button>
						<button id="publish-roster" class="button">Save</button>
					</div>
					<?php } }?>
			<?php } ?>
			<?php if($this->session->userdata('UserType') == STAFF){?>
			<div class="buttons d-flex justify-content-end">
					<button id="publish-roster" class="button">Save</button>
			</div>
				<?php } ?>
			</div>
</div>
<!--This is meant for admin-->
<?php if($this->session->userdata('UserType')==SUPERADMIN || $this->session->userdata('UserType')==ADMIN){ ?>
	<div id="myModal" class="modal">
	  <!-- Modal content -->
	  <div class="modal-content">
	  	<span class="row titl">
	  		<span style="" class="box-name-space col-12">
	  			<span class="box-name row"></span>
	  			<span class="box-space row"></span>
	  		</span>
	  		<!-- <span class="close col-2 d-flex align-items-center" >&times;</span> -->
	  	</span>
	    
	    <form  id="roster-form">
			<div class="row p-2">
				<label class="col-4">Start Time</label>
				<input class="col-7" type="time" name="startTime" id="startTime" >
			</div>
			<div class="row p-2">
				<label class="col-4">End Time</label>
				<input class="col-7" type="time" name="endTime" id="endTime" >
			</div>
			<div class="row p-2">
				<label class="col-4">Area</label>
				<select  class="col-7" name="areaId" id="areaId">
					<option>--modify--</option>
				</select>
			</div>
			<div class="row p-2">
				<label class="col-4">Role</label>
				<select  name="role" id="role" class="col-7">				</select>
			</div>
			<div class="row p-2">
				<label class="col-4">Message</label>
				<input name="message" id="message" class="col-7" type="text">
			</div>
	 		<input type="text" name="shiftId"  id="shiftId" style="display:none">
	 		<input type="text" name="roleId" id="roleId" style="display:none">
	 		<input type="text" name="status" value="2"  id="status" style="display:none">
	 		<input type="text" name="userId"   id="userId" style="display:none">
	 		<input type="button" name="modal-cancel"  value="Cancel"  class="close buttonn" style="width:5rem">
	 		<input type="button" name="shift-submit" id="shift-submit" value="Save" style="margin:30px;width:5rem" class="button">
	 	</form>
	  </div>
</div>
<?php } ?>
<!-- Till here -->>

<?php if($this->session->userdata('UserType') == STAFF){?>
<div id="mxModal" class="modal">
 
	  <div class="modal-content">
	  	<div class="row titl">
	  		<div class="col-12 box-name-space">
		  		<div style=""  class="row box-name">Title Here </div>
		  		<div  class="row box-space">Time Here</div>
		  	</div>
		</div>
		   <form  id="user-form">	
		   		<input type="text"  name="" id="starts" style="display: none">
		   		<input type="text"  name="" id="ends" style="display:none">
		 		<input type="text" name="shiftId"  id="shift-Id" style="display:none">
		 		<input type="text" name="roleId" id="role-Id" style="display:none">
		 		<input type="text" name="userId"   id="user-Id" style="display:none">
		 		<input type="button" name="user-submit" id="user-submit" value="Accept" style="width:5rem" class="button">
		 		<input type="button" name="user-deny" id="user-deny" style="width:5rem" value="Deny" class="button">
		 		<input type="button" name="cancel" class="button close" value="Close" style="width:5rem">
		 	</form>
	  </div>
</div>
<?php } ?>

<div class="mask" ></div>
<div class="modal_priority" >
	<a class="text-center m-2 edit_priority">Edit Priority</a>
	<div class="priority_areas"></div>
	<div class="prority_buttons">
  	<button class="close_priority" role="button">Cancel</button><button class="priority_save">Save</button>
  </div>
</div>

<?php if($this->session->userdata('UserType') == STAFF ){?>
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
					window.location.href = window.location.origin+"/PN101/roster/roster_dashboard"
				})

			</script>

<script type="text/javascript">
	$(document).on('click','.shift-edit',function(){
		var starts = $(this).attr('stime');
		var ends = $(this).attr('etime');
	var timings = $(this).text();
	var name = $(this).index();
	var role = 4;
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

<?php if($this->session->userdata('UserType')==STAFF){?>

<script type="text/javascript">
	$(document).ready(function(){
		
		$(document).on('click','.button',function(){
			var startTime = parseInt($('#starts').prop('value')) ;
			var endTime = parseInt($('#ends').prop('value'));
			

			var shiftid = $('#shift-Id').prop('value');
			var status = $(this).prop('value');
			var userid = "<?php echo $userid ?>";
			var roleid = $('#role-Id').prop('value');
			var message = $('#message').val();

			url = window.location.origin+"/PN101/roster/updateShift";
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
					message:message
				},
				success:function(response){
						console.log(response)

				}
			})
		})
		
	})
</script>
<?php } ?>

<!-- Till here -->


<?php if($this->session->userdata('UserType') == ADMIN || $this->session->userdata('UserType') == SUPERADMIN){?>
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
				var	total = 0;
				var count = $('.count-1').length
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
				 count = $('.count-3').length
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



<?php if($this->session->userdata('UserType') == SUPERADMIN || $this->session->userdata('UserType') == ADMIN){ ?>
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

			url = window.location.origin+"/PN101/roster/updateShift";
			console.log(startTime + " "+ endTime +" "+ shiftid+" "+roleid+" "+status +" "+userid)
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
					areaid:areaid
				},
				success:function(response){
											console.log(response)
											$('#roster-form').trigger('reset');

				}
			})
		})
		
	})
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.button',function(){
			var url = window.location.origin+"/PN101/roster/updateRoster";
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
						window.location.href= window.location.origin+"/PN101/roster/roster_dashboard";
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
						status: 2
					},
					success:function(response){
window.location.href= window.location.origin+"/PN101/roster/roster_dashboard";					}

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
						window.location.href= window.location.origin+"/PN101/roster/roster_dashboard";
					}

				})
			}
		})
	})
</script>
<?php }?>
<script type="text/javascript">
	$(document).ready(()=>{
    $('.containers').css('paddingLeft',$('.side-nav').width());
});
</script>
<script type="text/javascript">
	function timer( x)
	{ 
	    var output="";
	    if((x/100) < 12){
	        if((x%100)==0 ){
	        	if((x/100)<10){
	         output = "0"+String(x/100) + ":00" ;
	     }
	     if((x/100)>9){
	     	output = String(x/100) + ":00" ;
	     }
	        }
	    if((x%100)!=0){
	        if((x/100)<10){
	         output = "0"+String(x/100) + ":" + String(x%100) ;
	        }
	    }
	     if((x/100)>10){
	         output = String(x/100) + ":" + String(x%100) ;
	        }
	    }
	
	else if((x/100)>12){
	    if((x%100)==0){
	    output = x/100 + ":00";
	    }
	    if((x%100)!=0){
	    output = x/100 +":" + x%100 ;
	    }
	}
	else{
	if((x%100)==0){
	     output = parseInt(x/100) + ":00";
	    }
	    if((x%100)!=0){
	    output = parseInt(x/100) + ":" + x%100;
	    }
	}
	return output;
}

</script>
<script type="text/javascript">
	$(document).ready(function(){
		var centerid = $('#center-id').attr('c_id');
		// var userid = $('#user-id-select').text();
		var url = window.location.origin+"/PN101/settings/getOrgCharts/"+centerid;
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
		var url = window.location.origin+"/PN101/settings/getOrgCharts/"+centerid;
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
		  		url: window.location.origin+'/PN101/roster/changePriority',
		  		data: {
		  			areaid : areaid,
		  			priority : priority
		  		},
		  		type: 'POST',
		  		success: function(){
		  			// window.location.reload();
		  		}
		  	})
				}}
		  })

	  })
</script>
<script type="text/javascript">


function closeModal(){
  $(".mask").removeClass("active");
}

$(".close_priority").on("click", function(){
	$(".priority_areas").empty();
  closeModal();
});
</script>
</body>
</html>



<!-- 334 -->