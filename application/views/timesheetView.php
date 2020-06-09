<?php
$colors_array = ['#8dba5e','#9ebdff','#dd91ee','#f7c779','#a9bfaf','#6b88ca'];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
		<?php $this->load->view('header'); ?>
<meta content="width=device-width, initial-scale=1" name="viewport" />
	<title>Timesheet</title>
<!--	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
<style type="text/css">
	*{
font-family: 'Open Sans', sans-serif;
	}
	body{
		background:#f3f4f7;
	}

.containers{
	margin-left:2%;
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
.close {
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
}
table,tr,td{
	border:1px solid rgba(0,0,0,0.1)
}
.heading{
	text-align: left;
	font-size:2rem;
	font-weight: bold;
	padding-left:50px;
}
.timesheet-dates{
	text-align:left;
	background-color: white;
	padding-left:50px;
	padding-bottom:10px;
	padding-top:10px;
	font-weight:bolder;
	color: black;
	/*margin-left:2%;*/
}
.table-div > table{
	background:white;
	/*margin-left:2%;*/
}
.area-name{
	background:#307bd3;
	color:white;
}
.day{
	background:#C2E7F0;
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
		padding:20px;
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

.cell-back-1{
	margin:0 10px 0 10px;
}
.cell-back-2{
	margin:0 10px 0 10px;
}
.cell-back-3{
	margin:0 10px 0 10px;
}
.cell-back-4{
	margin:0 10px 0 10px;
}
.cell-back-5{
	margin:0 10px 0 10px;
}
.cell-boxes{
	padding:0;
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
#timesheet-form{
	position: relative;
	overflow-y: hidden;
}
.total-budget-row {
		background:#FFFCAD;
	margin:10px;
}
.total-budget .total-budget-row td{
	background:#FFFCAD;
	padding:10px;
	font-weight: bolder
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
	background: #9E9E9E
}
.nav-link{
	text-align:left;
}
.Published{
	background:#9C27B0;
}
.Accepted{
	background:#4CAF50;
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
    .leave{
    	background:orange;
    	padding:3px;
    	display:flex;
    	flex-direction: column;
    	color:white;
    	border-radius: 5px;
    	display:flex;
    	justify-content: center;
    	align-items:center;
    }
    .div-box{
    	padding:3px;
    	display:flex;
    	flex-direction: column;
    	background:#e7e7e7;
    	color:black;
    	border-radius: 5px
    }
    .shift-edit{
    	min-width:8vw;
    	padding:2px;
    	font-size:0.75rem
    }
@media only screen and (max-width: 600px) {
.modal-content{
	min-width:100vw;
}
.containers {
     width: 100%;
    margin: 0px;
}
.name-space{
	display: block;
	width: 100%;
	justify-content: center;
}
.day{
	padding:0;
	font-size: 0.8rem
}
.div-box{
	padding:0;
}
.shift-edit > div{
	padding: 0;
	border-radius: 0 !important;
}
td.shift-edit{
	padding:0;
}
.table-div > table{
	background:white;
	margin-left:0;
}
}
</style>
</head>
<body>

	<?php 
			$timesheetDetails = json_decode($timesheetDetails); 
			$entitlements = json_decode($entitlements);
	?>
	<div class="containers" id="containers" style="overflow-x:scroll">
		<div class="heading ">Timesheets</div>
		<div class="timesheet-dates"><?php 


		if(isset($timesheetDetails->timesheet[0]->currentDate)){
		 $str1 = $timesheetDetails->timesheet[0]->currentDate;
		 $str2 = $timesheetDetails->timesheet[13]->currentDate; 
		 $v1 = explode("-",$str1);
		 $v2 = explode("-",$str2);
		 echo date("M d",mktime(0,0,0,$v1[1],intval($v1[2]),(intval($v1[0]))))." to ". 
		 date("M d , Y",mktime(0,0,0,$v2[1],intval($v2[2]),(intval($v2[0]))));
		}else{
			echo "No Dates Available";
		}

		 ?> 
			<span>
			 	<a href="#week1">
			 		<button>week 1</button>
			 	</a>
			 	<a href="#week2">
			 		<button>week 2</button>
			 	</a>
			</span>
		</div>
	<div class="owl-carousel">
		<div class="table-div item" data-hash="week1">
			<table style="" >
				<tr>
					<?php if(isset($timesheetDetails->timesheet)){ ?>
					<th id="table-id-1" class="day">Employees</th>
					<?php 
						$x=0;
						$incrementer =0;
						
					 foreach($timesheetDetails->timesheet as $timesheet) {
						if($incrementer < 5){
						//$p++;
						$original = explode('-',$timesheet->currentDate);
						$datts = $original[2].".".$original[1].".".$original[0]; 
					 	 ?>
					<th  class="day"><?php  echo date("D",strtotime($datts)); echo " ".dateToDay($timesheet->currentDate) ?></th>
					<?php }
					$incrementer++;
					 } } ?>

				</tr>
			
				<?php 
				if(isset($timesheetDetails->timesheet[0])){
				$count = count($timesheetDetails->timesheet[0]->rosteredEmployees);
if($this->session->userdata('UserType')==SUPERADMIN || $this->session->userdata('UserType')==ADMIN){
	// $x is the total number of employees loop value;
	$rosteredEmployees = $timesheetDetails->timesheet[0]->rosteredEmployees;
	$x=0;
				foreach($rosteredEmployees as $rosteredEmployee){
				
					?>
				<?php 
				if($this->session->userdata('UserType')==ADMIN || $this->session->userdata('UserType')==SUPERADMIN){
				$value = count($timesheetDetails->timesheet);
		}
		else{
			$value=1;
		}
		// This value should be changed to $value;
		// Counter is the total number of days;
				//for($counter=0;$counter<1;$counter++){ ?>
		<tr  class="table-row">
			<td   style="min-width:18vw" class=" cell-boxes left-most">
				<?php if($this->session->userdata('UserType')==ADMIN || $this->session->userdata('UserType')==SUPERADMIN){ ?>
				<span class="row name-space m-0 p-0" style="padding:0;margin:0;margin-left: 0;margin-right: 0">
					<span class="col-12 col-md-4 icon-parent">
						<span class=" icon" style="<?php	echo "background:".$colors_array[rand(0,5)].";";?>"><?php echo icon($timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empName)?></span>
					</span>
					<span class=" col-12 col-md-8 name-role">
					<span class="empname row"><?php echo $timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empName?></span>
					<?php
					$variable = 0; 
						$userLevel = $timesheetDetails->timesheet[0]->rosteredEmployees[$x]->level;
						foreach ($entitlements as $e) {
							if($e[0]->id == $userLevel){
								$variable = $e[0]->hourlyRate;
							}

						}

					?>
						<span class="hourly title row "><?php echo  $variable; ?></span>
					</span>
				</span>
					<?php } ?>
					</td>
				
					<?php $weeklyTotal=0; 
					// to be changed to $value
					?>

					<?php 
		for($p=0;$p<5;$p++){
		    if($timesheetDetails->timesheet[$p]->rosteredEmployees != null){?>
		<td style="" class="shift-edit " name="<?php  echo $timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empName ?>"  cal-x="<?php echo $x; ?>" cal-p="<?php echo $p; ?>" array-type="rosteredEmployees" emp-id="<?php echo $timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empId?>" curr-date="<?php echo $timesheetDetails->timesheet[$p]->currentDate?>" timesheet-id="<?php echo $timesheetDetails->id;?>">

			
		<div style="border-radius: 5px;padding:3px">
		<div  class="<?php if($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->isOnLeave =="Y"){ echo "leave";}else{ echo 'div-box';}?>">
					<?php 
					 if($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->isOnLeave =="N"){ 
						// $timesheetDetails->timesheet[$p]->employees[$x];
			$times = $timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->clockedTimes;
			$totalTime = 0;
			foreach($times as $time){
				$totalTime = $totalTime + $time->endTime - $time->startTime;
			}
					$number = 0;
	foreach($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->clockedTimes as $visits){$number++;}
				$totalVisits = $number;
			?>
						<span><?php echo $timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->rosterShift->roleName->roleName;?></span>
							<span>Total Hours : <?php echo  intVal($totalTime/100) .".". $totalTime%100; ?></span>
							<span>Total visits : <?php echo $totalVisits; ?></span>
						</div>
					</div>
				<?php }else{
					echo "On Leave";
				} ?>
				</td>
			 <?php }
			 else{ ?>
			 	<td style="min-width:8vw;padding:7px" class="shift-edit ">
			 		<div style="border-radius: 5px;padding:3px">
						<div  class="div-box">
							<span>Role : - </span>
							<span>Total Hours : 0</span>
							<span>Total visits : 0</span>
						</div>
					</div>
			 	</td>
		<?php	 }} ?>
<!-- 			<td class=" " style="min-width:18vw;font-weight:bolder"><?php echo "$".$weeklyTotal;?></td>
 -->		</tr>

			<?php $x = $x+1;
		} 
			$count = count($timesheetDetails->timesheet[0]->unrosteredEmployees);
			for($x=0;$x<$count;$x++){ 
				$userLevel = $timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->level;
						foreach ($entitlements as $e) {
							if($e[0]->id == $userLevel){
								$variable = $e[0]->hourlyRate;
							}
						}
					?>
				<?php 
				if($this->session->userdata('UserType')==ADMIN || $this->session->userdata('UserType')==SUPERADMIN){
				$value = count($timesheetDetails->timesheet);
		}
		else{
			$value=1;
		}
		// This value should be changed to $value;
		// Counter is the total number of days;
				//for($counter=0;$counter<1;$counter++){ ?>
				<tr  class="table-row">
					<td   style="min-width:18vw" class=" cell-boxes left-most">
						<?php if($this->session->userdata('UserType')==ADMIN || $this->session->userdata('UserType')==SUPERADMIN){ ?>

						<span class="row" style="padding:0;margin:0;">
							<span class="col-3 icon-parent"><span class=" icon" style="<?php	echo "background:".$colors_array[rand(0,5)].";";?>"><?php echo icon($timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->empName)?></span></span>
							<span class="col-9 name-role">
								<span class="empname row"><?php echo $timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->empName?></span>
								<span class="hourly title row"><?php echo  $variable ?></span>
							</span>
							<span class=" "></span>
						</span>
					<?php } ?>
					</td>
				
					<?php $weeklyTotal=0; 
					// to be changed to $value
					?>

				<?php for($p=0;$p<1;$p++){?>
	<td style="min-width:8vw;padding:7px" class="shift-edit" name="<?php  echo $timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->empName ?>"  cal-x="<?php echo $x; ?>"cal-p="<?php echo $p; ?>" array-type="unrosteredEmployees" emp-id="<?php echo $timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->empId?>"  timesheet-id="<?php echo $timesheetDetails->id;?>">
		<?php if($timesheetDetails->timesheet[0]->unrosteredEmployees[$p]->isOnLeave =="N"){ ?>
					<div style="border-radius: 5px;padding:3px">
						<div  class=" <?php if($timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->isOnLeave =="Y"){ echo "leave";}else{echo 'div-box';}?>">
				<?php 
				if($timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->isOnLeave != 'Y'){ 
					// $timesheetDetails->timesheet[$p]->employees[$x];
			$times = $timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->clockedTimes;
			$totalTime = 0;
			foreach($times as $time){
				$totalTime = $totalTime + $time->endTime - $time->startTime;
			}
					$number = 0;
					foreach($timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->clockedTimes as $visits){$number++;}

			$totalVisits = $number;
			
				?>
							<span><?php echo $timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->rosterShift->roleName->roleName;?></span>
							<span>Total Hours : <?php echo  $totalTime/100 .".". $totalTime%100; ?></span>
							<span>Total visits : <?php echo $totalVisits; ?></span>
				<?php		}else{
						echo " On Leave";
					}?>
						</div>
						
					</div>
				<?php } else{
					echo "On leave";
				}?>
				</td>

				  <?php } ?>

				</tr>
			<?php 
			//$x++; 
		} 


			 } }?>
			</table>
		</div>
	

	<div class="table-div item" data-hash="week2">
			<table style="" >
				<tr>
					<?php if(isset($timesheetDetails->timesheet)){ ?>
					<th id="table-id-1" class="day">Employees</th>
					<?php 
						$x=0; 
						$incrementer=0;
					?>
					<?php foreach($timesheetDetails->timesheet as $timesheet) {
						if($incrementer >= 7 && $incrementer < 12){
						//$p++;
						$original = explode('-',$timesheet->currentDate);
						$datts = $original[2].".".$original[1].".".$original[0]; 
					 	 ?>
					<th  class="day"><?php  echo date("D",strtotime($datts)); echo " ".dateToDay($timesheet->currentDate) ?></th>
					<?php } 
					$incrementer++;
				} }?>

				</tr>
			
				<?php 
				if(isset($timesheetDetails->timesheet[0])){
				$count = count($timesheetDetails->timesheet[0]->rosteredEmployees);
if($this->session->userdata('UserType')==SUPERADMIN || $this->session->userdata('UserType')==ADMIN){
	// $x is the total number of employees loop value;
	$rosteredEmployees = $timesheetDetails->timesheet[0]->rosteredEmployees;
	$x=0;
				foreach($rosteredEmployees as $rosteredEmployee){
				
					?>
				<?php 
				if($this->session->userdata('UserType')==ADMIN || $this->session->userdata('UserType')==SUPERADMIN){
				$value = count($timesheetDetails->timesheet);
		}
		else{
			$value=1;
		}
		// This value should be changed to $value;
		// Counter is the total number of days;
				//for($counter=0;$counter<1;$counter++){ ?>
		<tr  class="table-row">
			<td   style="min-width:18vw" class=" cell-boxes left-most">
				<?php if($this->session->userdata('UserType')==ADMIN || $this->session->userdata('UserType')==SUPERADMIN){ ?>
				<span class="row name-space" style="padding:0;margin:0;">
					<span class="col-3 icon-parent"><span class=" icon" style="<?php	echo "background:".$colors_array[rand(0,5)].";";?>"><?php echo icon($timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empName)?></span></span>
					<span class="col-9 name-role">
					<span class="empname row"><?php echo $timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empName?></span>
										<?php
					$variable = 0; 
						$userLevel = $timesheetDetails->timesheet[0]->rosteredEmployees[$x]->level;
						foreach ($entitlements as $e) {
							if($e[0]->id == $userLevel){
								$variable = $e[0]->hourlyRate;
							}

						}

					?>
					<span class="hourly title row "><?php echo  $variable; ?></span>
					</span>
						</span>
					<?php } ?>
					</td>
				
					<?php $weeklyTotal=0; 
					// to be changed to $value
					?>

					<?php 
		for($p=7;$p<12;$p++){
		    if($timesheetDetails->timesheet[$p]->rosteredEmployees != null){?>
		<td style="min-width:8vw;padding:7px" class="shift-edit " name="<?php  echo $timesheetDetails->timesheet[0]->rosteredEmployees[$p]->empName ?>"  cal-x="<?php echo $x; ?>" cal-p="<?php echo $p; ?>" array-type="rosteredEmployees" emp-id="<?php echo $timesheetDetails->timesheet[0]->rosteredEmployees[$p]->empId?>" curr-date="<?php echo $timesheetDetails->timesheet[$p]->currentDate?>" timesheet-id="<?php echo $timesheetDetails->id;?>">

			
		<div style="border-radius: 5px;padding:3px">
		<div  class="<?php if($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->isOnLeave =="Y"){ echo "leave";}else{ echo 'div-box';}?>">
					<?php 
					 if($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->isOnLeave =="N"){ 
						// $timesheetDetails->timesheet[$p]->employees[$x];
			$times = $timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->clockedTimes;
			$totalTime = 0;
			foreach($times as $time){
				$totalTime = $totalTime + $time->endTime - $time->startTime;
			}
					$number = 0;
	foreach($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->clockedTimes as $visits){$number++;}
				$totalVisits = $number;
			?>
			<span><?php echo $timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->rosterShift->roleName->roleName;?></span>
							<span>Total Hours : <?php echo  intVal($totalTime/100) .".". $totalTime%100; ?></span>
							<span>Total visits : <?php echo $totalVisits; ?></span>
						</div>
					</div>
				<?php }else{
					echo "On Leave";
				} ?>
				</td>
			 <?php }
			 else{ ?>
			 	<td style="min-width:8vw;padding:7px" class="shift-edit ">
			 		<div style="border-radius: 5px;padding:3px">
						<div  class="div-box">
							<span>Role : - </span>
							<span>Total Hours : 0</span>
							<span>Total visits : 0</span>
						</div>
					</div>
			 	</td>
		<?php	 }} ?>
<!-- 			<td class=" " style="min-width:18vw;font-weight:bolder"><?php echo "$".$weeklyTotal;?></td>
 -->		</tr>

			<?php $x = $x+1;
		} 
			$count = count($timesheetDetails->timesheet[0]->unrosteredEmployees);
			for($x=0;$x<$count;$x++){ 
				$userLevel = $timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->level;
						foreach ($entitlements as $e) {
							if($e[0]->id == $userLevel){
								$variable = $e[0]->hourlyRate;
							}
						}
					?>
				<?php 
				if($this->session->userdata('UserType')==ADMIN || $this->session->userdata('UserType')==SUPERADMIN){
				$value = count($timesheetDetails->timesheet);
		}
		else{
			$value=1;
		}
		// This value should be changed to $value;
		// Counter is the total number of days;
				//for($counter=0;$counter<1;$counter++){ ?>
				<tr  class="table-row">
					<td   style="min-width:18vw" class=" cell-boxes left-most">
						<?php if($this->session->userdata('UserType')==ADMIN || $this->session->userdata('UserType')==SUPERADMIN){ ?>

						<span class="row" style="padding:0;margin:0;">
							<span class="col-3 icon-parent"><span class=" icon" style="<?php	echo "background:".$colors_array[rand(0,5)].";";?>"><?php echo icon($timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->empName)?></span></span>
							<span class="col-6 name-role">
								<span class="empname row"><?php echo $timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->empName?></span>
								<span class="hourly title row "><?php echo  $variable; ?></span>
							</span>
							<span class="hourly col-3"><?php echo  $variable ?></span>
						</span>
					<?php } ?>
					</td>
				
					<?php $weeklyTotal=0; 
					// to be changed to $value
					?>

				<?php for($p=0;$p<1;$p++){?>
	<td style="min-width:8vw;padding:7px" class="shift-edit" name="<?php  echo $timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->empName ?>"  cal-x="<?php echo $x; ?>"cal-p="<?php echo $p; ?>" array-type="unrosteredEmployees" emp-id="<?php echo $timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->empId?>"  timesheet-id="<?php echo $timesheetDetails->id;?>">
		<?php if($timesheetDetails->timesheet[0]->unrosteredEmployees[$p]->isOnLeave =="N"){ ?>
					<div style="border-radius: 5px;padding:3px">
						<div  class=" <?php if($timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->isOnLeave =="Y"){ echo "leave";}else{echo 'div-box';}?>">
				<?php 
				if($timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->isOnLeave != 'Y'){ 
					// $timesheetDetails->timesheet[$p]->employees[$x];
			$times = $timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->clockedTimes;
			$totalTime = 0;
			foreach($times as $time){
				$totalTime = $totalTime + $time->endTime - $time->startTime;
			}
					$number = 0;
					foreach($timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->clockedTimes as $visits){$number++;}

			$totalVisits = $number;
			
				?>
				<span><?php echo $timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->rosterShift->roleName->roleName;?></span>
							<span>Total Hours : <?php echo  $totalTime/100 .".". $totalTime%100; ?></span>
							<span>Total visits : <?php echo $totalVisits; ?></span>
				<?php		}else{
						echo " On Leave";
					}?>
						</div>
						
					</div>
				<?php } else{
					echo "On leave";
				}?>
				</td>

				  <?php } ?>

				</tr>
			<?php 
			//$x++; 
		} 


			 } }?>
		</table>
	</div>
</div>

		<div class="total-budget" >
			<table >
				<tr class="total-budget-row">
					
				</tr>
			</table>
		</div>
<?php if($this->session->userdata('UserType')==SUPERADMIN || $this->session->userdata('UserType')==ADMIN){ ?>


	<div class="buttons d-flex justify-content-end">
		<button id="discard-timesheet" class="button">Discard</button>
		<button id="publish-timesheet" class="button">Save</button>
	</div>

<?php } ?>
<?php if($this->session->userdata('UserType') == STAFF){?>
<div class="buttons d-flex justify-content-end">
		<button id="publish-timesheet" class="button">Save</button>
</div>
	<?php } ?>
	</div>
<!--This is meant for admin-->
<?php if($this->session->userdata('UserType')==SUPERADMIN || $this->session->userdata('UserType')==ADMIN){ ?>
	<div id="myModal" class="modal">
	  <!-- Modal content -->
	  <div class="modal-content">
	  	<span class="row titl">
	  		<span style="" class="box-name-space col-10">
	  			<span class="box-name row"></span>
	  			<span class="box-space row"></span>
	  		</span>
	  		
	  	</span>
	    
	    <div  id="timesheet-form">
			
	 	</div>
	  </div>
</div>
<?php } ?>
<!-- Till here -->>

<!-- Logout Modal -->
   <div class="modal-logout">
        <div class="modal-content-logout">
            <h3>You have been logged out!!</h3>
            <h4><a href="">Click here</a> to login</h4>
            
        </div>
    </div>
<!-- Logout Modal -->

<?php if($this->session->userdata('UserType') == ADMIN || $this->session->userdata('UserType') == SUPERADMIN){?>
<script type="text/javascript">
				var modal = document.getElementById("myModal");
				var htmlVal = $('timesheet-form').html()
				$(document).on('click','.shift-edit',function(){
					 modal.style.display = "block";
					var arrayType = $(this).attr('array-type');
					// console.log(arrayType)
					var v = $(this).attr('name');
					// console.log(v)
					var w = $('.day').eq($(this).index()).html();
					// console.log(w)
					var x = $(this).attr('cal-x');
					// console.log((x))
					var y = $(this).attr('cal-p');
					// console.log(y)
					var eId = $('#employee-id').val($(this).attr('emp-id'))
					// console.log(eId)
					var sDate = $('#start-date').val($(this).attr('curr-date'))
					// console.log(sDate)
					var tId = $('#timesheet-id').val($(this).attr('timesheet-id'))
					// console.log(tId)
	var url = "<?php echo base_url();?>timesheet/getTimesheetDetailsModal?timesheetId="+"<?php echo $timesheetid;?>&x="+x+"&y="+y+"&aT="+arrayType ;
					 $.ajax({
					 	url : url,
					 	type : 'GET',
					 	success : function(response){
					 		console.log('success')
					 		$('.box-name').html(v)
					 		$('.box-space').html(w)
					 		$('#timesheet-form').html(response)
					 	}
					 })
				})

				$(document).on('click','.close',function(){
					 modal.style.display = "none";
					 $('timesheet-form').html(htmlVal);
					 $('#timesheet-form').trigger('reset');
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
</script> -->
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
	        	if(x%100 <10){
	        		 output = "0"+String(x/100) + ":0" + String(x%100) ;
	        	}
	        	else{
	        		 output = "0"+String(x/100) + ":" + String(x%100) ;
	        	}
	        }
	    }
	     if((x/100)>10){
	         if(x%100 <10){
	        		 output = String(x/100) + ":0" + String(x%100) ;
	        	}
	        	else{
	        		 output = String(x/100) + ":" + String(x%100) ;
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
	$(document).on('click','.time-box',function(){
		var thisValue = $(this).children('.time-box').html();
		var parentHTML = $('timesheet-form').html();
		var stime = $(this).attr('start-time');
		var code = "<input type=\"time\" class=\"sclass\"> - <input type=\"time\" class=\"eclass\"> <input type=\"text\" id=\"employee-id\" style=\"display:none\"> <input type=\"text\" id=\"start-date\" style=\"display:none\"> <input type=\"text\" id=\"timesheet-id\" style=\"display:none\">"
		$(this).empty();
		$(this).next().html(code)
		$(this).next().children('.sclass').val(timer($(this).attr('svalue')))
		$(this).next().children('.eclass').val(timer($(this).attr('evalue')))

		//$(this).html(code)
		//$(this).children().val(timer(500))
		//$(this).children('.time-box').html($(this).attr('start-time'))
	})
</script>
<script type="text/javascript">
	$(document).on('click','.buttonn',function(){
		alert('gone')
		var i = $(".box-time").length;
		var values = [];
		var object = {};
		var url = window.location.origin+"/PN101/timesheet/createPayroll";
		for(var a=0;a<i;a++){
		if($('.box-time').eq(a).children().children().children().prop('checked') == true){
			if($('.time-box').eq(a).text() != ""){
				object.startTime = $('.time-box').eq(a).attr('svalue');
				object.endTime = $('.time-box').eq(a).attr('evalue');
				object.payType = $('.new-time-box').next().children().val();
			}
			else{
				object.startTime = $('.new-time-box').eq(a).children('.sclass').val();
				object.endTime = $('.new-time-box').eq(a).children('.eclass').val();
				object.payType = $('.new-time-box').next().children().val();
			}
		}
			values.push(object)
	}
		$.ajax({
			url : url,
			type : 'POST',
			data : {
				empId : $('#employee-id').val(),
				userid : <?php echo $this->session->userdata($userid); ?>,
				shiftDate : $('#start-date').val(),
				timesheetid : $('#timesheet-id').val(), 
				visits : values
			},
			success : function(response){
				alert('done')
			}
		}).fail(function(){alert('failed')})
		})
</script>

	<script type="text/javascript">
		$('#stime').val(timer($('.box-time').attr('start-time')))
	</script>

<script type="text/javascript">
	var count = $('.box-time').length;
	var thisValue = 0;
	
	for(var i=0;i<count;i++){
		var children = $('.box-time').eq(i).children().children().next();
		if($('.box-time').eq(i).children().children().children().prop('checked') == true){
			if(children.next().html() == ""){
				thisValue = thisValue + ( parseInt(children.attr('evalue')) - parseInt(children.attr('svalue')) ) * $('select option:selected').eq(i).attr('factor') * parseInt($('.box-time').eq(i).attr('hourly'))
			}
			else{
				thisValue = thisValue + parseInt(String(children.next().children('eclass').val()).replace(":","")) - parseInt(String(children.next().children('sclass').val()).replace(":",""))
			}
		}
	}
	$('.budget').html('Budget '+'$' + thisValue);
</script>
<script type="text/javascript">
	$(document).ready(()=>{
    $('.containers').css('paddingLeft',$('.side-nav').width());
   			 margin_auto();
});

</script>
<?php if( isset($error) ){ ?>
<script type="text/javascript">
  var modal = document.querySelector(".modal-logout");
    function toggleModal() {
        modal.classList.toggle("show-modal");
    }
	$(document).ready(function(){
	  	toggleModal();	
	  })
		</script>
	<?php }
?>

<script type="text/javascript">
	  $('.owl-carousel').owlCarousel({
        items:1,
        loop:false,
        center:true,
        margin:10,
        autoplay:false,
        URLhashListener:true,
        startPosition: 'URLHash'
    });

</script>
<script type="text/javascript">
	$(document).ready(function(){
		let height = $('.div-box').eq(3).height();
		let count =	 $('.leave').length;
		for(let i=0;i<count;i++){
		$('.leave').eq(i).height(height);
			}
			console.log(height)
	})
</script>

</body>
</html>


<?php
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
	return date(", M d",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
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
?>