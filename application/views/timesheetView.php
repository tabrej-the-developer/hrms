<?php
$colors_array = ['#A4D9D6','#A4D9D6','#A4D9D6','#A4D9D6','#A4D9D6','#A4D9D6'];
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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

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

}
table,tr,td{
	border:1px solid rgba(0,0,0,0.1)
}
.heading{
	text-align: left;
	font-size:2rem;
	font-weight: bold;
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
	background:#8D91AA;
	color: #F3F4F7;
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
	padding-left: 1rem;
	color: #707070;
}
@media only screen and (min-width:1024px){
	table td:nth-child(1),table th:nth-child(1){
		min-width:18vw !important;
		max-width:18vw !important;
	}
	table th:nth-child(7),
	table td:nth-child(7){
		min-width: 10vw;
		max-width: 10vw;
	}
	table td:nth-child(2),
	table td:nth-child(3),
	table td:nth-child(4),
	table td:nth-child(5),
	table td:nth-child(6),
	table th:nth-child(2),
	table th:nth-child(3),
	table th:nth-child(4),
	table th:nth-child(5),
	table th:nth-child(6){
		min-width:10vw !important;
		max-width:10vw !important;
	}
}
@media only screen and (min-width:1200px){
	table td:nth-child(1){
		min-width:18vw !important;
		max-width:18vw !important;
	}
	
	table th:nth-child(7),
	table td:nth-child(7){
		min-width: 10vw;
		max-width: 10vw;
	}
	table td:nth-child(2),
	table td:nth-child(3),
	table td:nth-child(4),
	table td:nth-child(5),
	table td:nth-child(6),
	table th:nth-child(2),
	table th:nth-child(3),
	table th:nth-child(4),
	table th:nth-child(5),
	table th:nth-child(6){
		min-width:11vw !important;
		max-width:11vw !important;
	}
}
table{
	
}
a[href="#week1"] button,a[href="#week2"] button{
	        border: none;
    color: rgb(23, 29, 75);
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-weight: 700;
    margin: 2px;
    width:8rem;
      border-radius: 20px;
      padding: 4px 8px;
      background: rgb(164, 217, 214) !important;
      font-size: 1rem;
}
.icon{
	font-size:1rem;
	display:flex;
	justify-content:center;
	align-self: center;
	border-radius: 50%;
	padding:0.25rem 0;
	color:#707070;
	height: 2rem;
	width: 2rem;
}
.empname{
	font-size:15px;
	display:flex;
	color: #707070;
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
    background:#8D91AA;
    color: #E7E7E7;
	}
	.ui-timepicker-container{
		z-index:999;
	}
	.buttons{
		padding:20px;
		margin:2px;
	}
	.button{
	  border: none !important;
	  color: rgb(23, 29, 75) !important;
	  text-align: center !important;
	  text-decoration: none !important;
	  display: inline-block;
	  font-weight: 700 !important;
	  margin: 2px !important;
	  width:8rem !important;
    border-radius: 20px !important;
    padding: 4px 8px !important;
    background: rgb(164, 217, 214) !important;
    font-size: 1rem !important;
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
    font-size:1.5rem;
    color:#E7E7E7;
}
.box-space{
	display: flex;
    justify-content: center;
    color:#E7E7E7;
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
.owl-item{
	width: 100!important;
}

.owl-carousel.owl-loaded {
    display: flex !important;
}
/* --------------------------
			On Logout
	 ------------------------- */
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
/* --------------------------
			On Logout
	 ------------------------- */
    .leave{
    	background:orange;
    	padding:3px;
    	display:flex;
    	flex-direction: column;
    	color:white;
    	display:flex;
    	justify-content: center;
    	align-items:center;
    }
    .div-box{
    	padding:3px;
    	display:flex;
    	flex-direction: column;

    	color:black;
    }
    .shift-edit{
    	min-width:8vw;
    	font-size:0.75rem
    }
    .full_box{
    	background: #e7e7e7;
    }
    .PUBLISHED{
    	background: rgba(175, 225, 159,0.8);
    }
   /*		------------------------
					Weekly Timesheet Modal
   			------------------------ 	*/
  .weekTimesheetModalHeader{
  	height: 4rem;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #8D91AA;
    color: #F3F4F7;
    font-size:1.5rem;
  }
  .weekTimesheetModalSubmit{
  	position: absolute;
    bottom: 0;
    right: 0;
    height: 4rem;
    display: flex;
    align-items: center;
    padding-right: 2rem;
  }
    .weekTimesheetBody{
    	position: absolute;
    	left: 20%;
    	width:60%;
    	top:10%;
    	height:80%;
    	background: white;
    }
    .weekTimesheetModal{
    	display: none;
    	top: 0;
    	left: 0;
    	position: fixed;
    	z-index: 3;
    	height: 100%;
    	width: 100%;
    	background: rgba(0,0,0,0.5);
    }
    .weekTimesheetModalVisits{
    	display: flex;
	    align-items: center;
	    justify-content: center;
    	height: calc(100% - 2.5rem);

    }
  .weekTimesheetModalData{
  	height: calc(100% - 8rem);
  }
  .weekTimesheetModalTabs{
  	height: 2.5rem;
  	display: flex;
  	width: 100%;
  }
  .weekTimesheetModalTabs span{
  	flex: 1 1 0px;
		background: #8D91AA;
    color: #F3F4F7;
    border-bottom-left-radius: 1rem;
    border-bottom-right-radius: 1rem;
    text-align: center;
    cursor: pointer;
  }
  .week_div_0{
  	display: block;
  }
  .weekTimesheetModalTabsMon,.weekTimesheetModalTabs span:nth-child(1){
    background: rgb(227, 228, 231);
    color: rgba(0, 0, 0, 0.8);
  }
  .week_div_1{display: none;}
  .week_div_2{display: none;}
  .week_div_3{display: none;}
  .week_div_4{display: none;}
  .visit__{
  	display: flex;
  }
  .display_flex_visits{
  	display: flex;
	width: 100%;
    justify-content: space-evenly;
    padding: 0.5rem;
  }
  div[class^="week_div_"]{
  	width: 100%;
  }
  	    select{
      background: #E7E7E7;
      border: none !important;
      height: 2.5rem;
      border-radius: 20px;
      border: 1px solid #D2D0D0;
      padding-left:0.5rem;
    }
    span[class^="sameAsRosterBlock_"]{
    	width: 100%;
    display: flex;
    justify-content: center;
    margin-bottom: 1rem;
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
	$permission = json_encode($permissions);
	$timesheetDetails = json_decode($timesheetDetails); 
		if(isset($entitlements)){
			$entitlements = json_decode($entitlements);
		}
?>
<div class="containers" id="containers" style="overflow-x:scroll">
	<div class="heading ">Timesheets</div>
	<div class="timesheet-dates">
		<?php 
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

						$original = explode('-',$timesheet->currentDate);
						$datts = $original[2].".".$original[1].".".$original[0]; 
					 	 ?>
					<th  class="day" date="<?php echo $timesheet->currentDate; ?>">
						<?php  echo date("D",strtotime($datts)); echo " ".dateToDay($timesheet->currentDate) ?>
					</th>
			<?php
										 } //end of if block
								$incrementer++;
						} //end of foreach
					} // end of isset(timesheet) if block
		 ?>
		 <th>----</th>
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
			<td   style="min-width:14vw" class=" cell-boxes left-most">
				<?php if($this->session->userdata('UserType')==ADMIN || $this->session->userdata('UserType')==SUPERADMIN){ ?>
				<span class="row name-space m-0 p-0" style="padding:0;margin:0;margin-left: 0;margin-right: 0">
					<span class="col-12 col-md-4 icon-parent">
						<span class=" icon" style="<?php	echo "background:".$colors_array[rand(0,5)].";";?>">
							<?php echo icon($timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empName)?>
						</span>
					</span>
					<span class=" col-12 col-md-8 name-role">
						<span class="empname row">
							<?php 
								echo $timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empName;
							?>
						</span>
					<?php
							$variable = 0; 
							$userLevel = $timesheetDetails->timesheet[0]->rosteredEmployees[$x]->level;
						foreach ($entitlements as $e) {
							if($e[0]->id == $userLevel){
								$variable = $e[0]->hourlyRate;
							}
						}
					?>
						<span class="hourly title row ">
							<?php 
								echo  $variable;
							?>
						</span>
					</span>
				</span>
					<?php } ?>
					</td>
				
					<?php $weeklyTotal=0; 
					// to be changed to $value
					?>

					<?php 
			$totalTimeForWeek = 0;
		for($p=0;$p<5;$p++){
		    if($timesheetDetails->timesheet[$p]->rosteredEmployees != null){?>
		<td style="" 
				class="<?php echo count($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->clockedTimes) > 0 ? 'shift-edit' : '' ?> " 
				name="<?php  echo $timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empName ?>"  
				cal-x="<?php echo $x; ?>" 
				cal-p="<?php echo $p; ?>" 
				array-type="rosteredEmployees" 
				emp-id="<?php echo $timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empId?>" 
				curr-date="<?php echo $timesheetDetails->timesheet[$p]->currentDate?>" 
				timesheet-id="<?php echo $timesheetDetails->id;?>"  
				payrollShifts="<?php echo count($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->clockedTimes) > 0 ? 'shift-edit' : '' ?>" >
<?php 

		 if($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->isOnLeave =="N"){ 
			 if(count($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->clockedTimes) > 0){ 
						// $timesheetDetails->timesheet[$p]->employees[$x];
			$times = $timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->clockedTimes;
			$totalTime = 0;

 ?>
		<div style="padding:3px;" class="full_box <?php echo isset($times[0]->status) ? $times[0]->status : "" ?>">
		<div  class="<?php if($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->isOnLeave =="Y"){ echo "leave";}else{ echo 'div-box';} ?>">
					<?php 
			foreach($times as $time){
				$end = intval(($time->endTime)/100)*60 + (intval($time->endTime))%100 ;
				$start = intval(($time->startTime)/100)*60 + ($time->startTime)%100;
				// echo $end ."......".$start;
				$totalTime = $totalTime + $end - $start;
			}
					$number = 0;
	foreach($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->clockedTimes as $visits){$number++;}
				$totalVisits = $number;
			?>
						<span><?php echo isset($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->rosterShift->roleName->roleName) ? $timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->rosterShift->roleName->roleName : "";?></span>
						<span><?php echo isset($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->rosterShift->startTime) ? timex($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->rosterShift->startTime) : "";?> - <?php echo isset($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->rosterShift->endTime) ? timex($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->rosterShift->endTime) : "";?></span>
							<span>Total Hours : <?php 
								$totalTimeForWeek = $totalTimeForWeek+ $totalTime ;
							echo  intVal($totalTime/60) .".". sprintf("%02d",$totalTime%60); 
							?></span>
							<span>Total visits : <?php echo $totalVisits; ?></span>
						</div>
					</div>
				<?php } }else{
					echo "On Leave";
				} ?>
				</td>
			 <?php }
			 else{ ?>
			 	<td style="min-width:8vw;" class="shift-edit ">
			 		<div style="padding:3px">
						<div  class="div-box">
							<span>Role : - </span>
							<span>Total Hours : 0</span>
							<span>Total visits : 0</span>
						</div>
					</div>
			 	</td>
		<?php	 }} ?>
		<td><?php echo isset($totalTimeForWeek) ? intval(($totalTimeForWeek)/60).".".sprintf("%02d",intval(($totalTimeForWeek)%60)) : ""; ?>
			<img src="<?php echo base_url('assets/images/icons/pencil.png'); ?>" pay="<?php echo $variable; ?>" onclick="getEmployeeTimesheet(this)" height="25px" width="25px" style="height:20px;width:20px;cursor: pointer;" class="weekModal"  userid="<?php echo $timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empId ; ?>" date="<?php echo $timesheetDetails->startDate; ?>">
		</td>
		</td>
<!-- 			<td class=" " style="min-width:14vw;font-weight:bolder"><?php //echo "$".$weeklyTotal;?></td>
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
<!-- 				 <tr  class="table-row">
					<td   style="min-width:14vw" class=" cell-boxes left-most">
						<?php if($this->session->userdata('UserType')==ADMIN || $this->session->userdata('UserType')==SUPERADMIN){ ?>

						<span class="row" style="padding:0;margin:0;">
							<span class="col-md-3 col-12 icon-parent"><span class=" icon" style="<?php	echo "background:".$colors_array[rand(0,5)].";";?>"><?php echo icon($timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->empName)?></span></span>
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
	<td 
		style="min-width:8vw;padding:7px" 
		class="<?php echo count($timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->clockedTimes) > 0 ? 'shift-edit' : '' ?>" 
		name="<?php  echo $timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->empName ?>"  
		cal-x="<?php echo $x; ?>"
		cal-p="<?php echo $p; ?>" 
		array-type="unrosteredEmployees" 
		emp-id="<?php echo $timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->empId?>"  
		timesheet-id="<?php echo $timesheetDetails->id;?>">
		<?php if($timesheetDetails->timesheet[0]->unrosteredEmployees[$p]->isOnLeave =="N"){
				
				if($timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->isOnLeave != 'Y'){ 
					if(count($timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->clockedTimes) > 0){
					// $timesheetDetails->timesheet[$p]->employees[$x];
			$times = $timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->clockedTimes;
			$totalTime = 0;
		 ?>
					<div style="padding:3px">
						<div  class=" <?php if($timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->isOnLeave =="Y"){ echo "leave";}else{echo 'div-box';} ?>">
				<?php 

			foreach($times as $time){
				$totalTime = $totalTime + $time->endTime - $time->startTime;
			}
					$number = 0;
					foreach($timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->clockedTimes as $visits){$number++;}

			$totalVisits = $number;
			
				?>
							<span><?php echo isset($timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->rosterShift->roleName->roleName) ? $timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->rosterShift->roleName->roleName : ""; ?></span>
							<span>Total Hours : <?php echo  $totalTime/100 .".". $totalTime%100; ?></span>
							<span>Total visits : <?php echo $totalVisits; ?></span>

						</div>
				<?php	
							}	}else{
						echo " On Leave";
								}
					?>
					</div>
				<?php } else{
					echo "On leave";
				}?>
				</td>

				  <?php } ?>

				</tr> -->
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
					<th>----</th>
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
			<td   style="min-width:14vw" class=" cell-boxes left-most">
				<?php if($this->session->userdata('UserType')==ADMIN || $this->session->userdata('UserType')==SUPERADMIN){ ?>
				<span class="row name-space" style="padding:0;margin:0;">
					<span class="col-md-3 col-12 icon-parent"><span class=" icon" style="<?php	echo "background:".$colors_array[rand(0,5)].";";?>"><?php echo icon($timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empName)?></span></span>
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
			
			$totalTimeForWeek = 0;
		for($p=7;$p<12;$p++){
			$totalTime = 0;
		    if($timesheetDetails->timesheet[$p]->rosteredEmployees != null){?>
		<td style="min-width:8vw;" 
				class="<?php echo count($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->clockedTimes) > 0 ?  'shift-edit' : '' ?> " 
				name="<?php  echo $timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empName ?>"  
				cal-x="<?php echo $x; ?>" 
				cal-p="<?php echo $p; ?>" 
				array-type="rosteredEmployees" 
				emp-id="<?php echo $timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empId?>" 
				curr-date="<?php echo $timesheetDetails->timesheet[$p]->currentDate?>" 
				timesheet-id="<?php echo $timesheetDetails->id;?>">
			<?php
					 if($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->isOnLeave =="N"){ 
						// $timesheetDetails->timesheet[$p]->employees[$x];
					 	if(count($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->clockedTimes) > 0){
			$times = $timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->clockedTimes;

			?>
		<div style="padding:3px" class="full_box <?php echo isset($times[0]->status) ? $times[0]->status : "" ?>">
		<div  class="<?php if($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->isOnLeave =="Y"){ echo "leave";}else{ echo 'div-box';} ?>">
					<?php 
			foreach($times as $time){
				$end = intval(($time->endTime)/100)*60 + (intval($time->endTime))%100 ;
				$start = intval(($time->startTime)/100)*60 + ($time->startTime)%100;
				// echo $end ."......".$start;
				$totalTime = $totalTime + $end - $start;
			}
					$number = 0;
	foreach($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->clockedTimes as $visits){$number++;}
				$totalVisits = $number;
			?>
			<span><?php echo isset($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->rosterShift->roleName->roleName) ? $timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->rosterShift->roleName->roleName : "";?></span>
			<span><?php echo isset($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->rosterShift->startTime) ? timex($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->rosterShift->startTime) : "";?> - <?php echo isset($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->rosterShift->endTime) ? timex($timesheetDetails->timesheet[$p]->rosteredEmployees[$x]->rosterShift->endTime) : "";?></span>
			<span></span>
							<span>Total Hours : <?php  $totalTimeForWeek = $totalTimeForWeek+ $totalTime ;
							echo  intVal($totalTime/60) .".". sprintf("%02d",$totalTime%60);  ?></span>
							<span>Total visits : <?php echo $totalVisits; ?></span>
						</div>
					</div>
				<?php } } else{
					echo "On Leave";
				} ?>
				</td>

			 <?php }
			 else{ ?>
			 	<td style="min-width:8vw" class="shift-edit ">
			 		<div style="border-radius: 5px;padding:3px">
						<div  class="div-box">
							<span>Role : - </span>
							<span>Total Hours : 0</span>
							<span>Total visits : 0</span>
						</div>
					</div>
			 	</td>
		<?php	 }} ?>
		<td><?php echo isset($totalTimeForWeek) ? intval(($totalTimeForWeek)/60).".".sprintf("%02d",intval(($totalTimeForWeek)%60)) : ""; ?>
						<img src="<?php echo base_url('assets/images/icons/pencil.png'); ?>" pay="<?php echo $variable; ?>" onclick="getEmployeeTimesheet(this)" height="25px" width="25px" style="height:20px;width:20px;cursor: pointer;" class="weekModal" userid="<?php echo $timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empId ; ?>" date="<?php echo date("Y-m-d",strtotime("+7 day",strtotime($timesheetDetails->startDate))); ?>">
		</td>
<!-- 			<td class=" " style="min-width:14vw;font-weight:bolder"><?php echo "$".$weeklyTotal;?></td>
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
<!-- 				<tr  class="table-row">
					<td   style="min-width:14vw" class=" cell-boxes left-most">
						<?php if($this->session->userdata('UserType')==ADMIN || $this->session->userdata('UserType')==SUPERADMIN){ ?>

						<span class="row" style="padding:0;margin:0;">
							<span class="col-md-3 col-12 icon-parent"><span class=" icon" style="<?php	echo "background:".$colors_array[rand(0,5)].";";?>"><?php echo icon($timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->empName)?></span></span>
							<span class="col-9 name-role">
								<span class="empname row"><?php echo $timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->empName?></span>
								<span class="hourly title row "><?php echo  $variable; ?></span>
							</span>
						</span>
					<?php } ?>
					</td>
				
					<?php $weeklyTotal=0; 
					// to be changed to $value
					?>

				<?php for($p=0;$p<1;$p++){?>
	<td style="min-width:8vw;padding:7px" 
			class="<?php count($timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->clockedTimes) > 0 ? 									'shift-edit' : '' ?>" 
			name="<?php  echo $timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->empName ?>"  
			cal-x="<?php echo $x; ?>"
			cal-p="<?php echo $p; ?>" 
			array-type="unrosteredEmployees" 
			emp-id="<?php echo $timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->empId?>"  
			timesheet-id="<?php echo $timesheetDetails->id;?>">
		<?php if($timesheetDetails->timesheet[0]->unrosteredEmployees[$p]->isOnLeave =="N"){
						if($timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->isOnLeave != 'Y'){ 
							if(count($timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->clockedTimes) > 0){
					// $timesheetDetails->timesheet[$p]->employees[$x];
			$times = $timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->clockedTimes;
			$totalTime = 0;

		 ?>
					<div style="padding:3px">
						<div  class=" <?php if($timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->isOnLeave =="Y"){ echo "leave";}else{echo 'div-box';}?>">
				<?php 
			foreach($times as $time){
				$totalTime = $totalTime + $time->endTime - $time->startTime;
			}
					$number = 0;
					foreach($timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->clockedTimes as $visits){$number++;}

			$totalVisits = $number;
			
				?>
				<span><?php echo isset($timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->rosterShift->roleName->roleName) ? $timesheetDetails->timesheet[$p]->unrosteredEmployees[$x]->rosterShift->roleName->roleName : "" ;?></span>
							<span>Total Hours : <?php echo  $totalTime/100 .".". $totalTime%100; ?></span>
							<span>Total visits : <?php echo $totalVisits; ?></span>
				<?php	 }	}else{
						echo " On Leave";
					}?>
						</div>
						
					</div>
				<?php } else{
					echo "On leave";
				}?>
				</td>

				  <?php } ?>

				</tr> -->
			<?php 
			//$x++; 
		} 


			 } } ?>
		</table>
	</div>
</div>

		<div class="total-budget" >
			<table >
				<tr class="total-budget-row">
					
				</tr>
			</table>
		</div>

<div class="modal-logout">
    <div class="modal-content-logout">
        <h3>You have been logged out!!</h3>
        <h4><a href="<?php echo base_url(); ?>">Click here</a> to login</h4>
        
    </div>
</div>

<div class="weekTimesheetModal">
	<div class="weekTimesheetBody">
		<div class="weekTimesheetModalHeader" >NAME</div>
		<div class="weekTimesheetModalData">
			<div class="weekTimesheetModalTabs">
				<span class="weekTimesheetModalTabsMon">MON</span>
				<span class="weekTimesheetModalTabsTue">TUE</span>
				<span class="weekTimesheetModalTabsWed">WED</span>
				<span class="weekTimesheetModalTabsThu">THU</span>
				<span class="weekTimesheetModalTabsFri">FRI</span>
			</div>
			<div class="weekTimesheetModalVisits">SELECT</div>
		</div>
		<div class="weekTimesheetModalSubmit">
			<span>
				<button class="button cancelWeekModel">Cancel</button>
			</span>
			<span>
				<button class="button submit_weekModal">Submit</button>
			</span>
		</div>
	</div>
</div>

<?php if($this->session->userdata('UserType')==SUPERADMIN || $this->session->userdata('UserType')==ADMIN){ ?>

<?php 
	if(isset($timesheetDetails->status)){
if($timesheetDetails->status == 'Draft'){ ?>
	<div class="buttons d-flex justify-content-end">
		<button id="discard-timesheet" class="button">
			<i>
				<img src="<?php echo base_url('assets/images/icons/delete.png'); ?>" style="max-height:0.8rem;margin-right:10px">
			</i>Discard</button>
		<button id="publish-timesheet" class="button publish_timesheet">
			<i>
				<img src="<?php echo base_url('assets/images/icons/save.png'); ?>" style="max-height:0.8rem;margin-right:10px">
			</i>Save</button>
	</div>

	<?php
}else{ ?>
	<div class="buttons d-flex justify-content-end">
		<button id="discard-timesheet" class="button">
			<i>
				<img src="<?php echo base_url('assets/images/icons/delete.png'); ?>" style="max-height:0.8rem;margin-right:10px">
			</i>Discard</button>
		<button id="publish-timesheet" class="button">
			<i>
				<img src="<?php echo base_url('assets/images/icons/save.png'); ?>" style="max-height:0.8rem;margin-right:10px">
			</i>Save</button>
	</div>
<?php } } ?>

<?php } ?>
<?php if($this->session->userdata('UserType') == STAFF){?>
<div class="buttons d-flex justify-content-end">
		<button id="publish-timesheet" class="button">
								<i>
									<img src="<?php echo base_url('assets/images/icons/save.png'); ?>" style="max-height:0.8rem;margin-right:10px">
								</i>Save</button>
</div>
	<?php } ?>
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
	<script>
$( ".modal-content" ).draggable();


</script>
<script type="text/javascript">

				var modal = document.getElementById("myModal");
				var htmlVal = $('#timesheet-form').html()
				$(document).on('click','.shift-edit',function(){
					 modal.style.display = "block";
					var arrayType = $(this).attr('array-type');
					var v = $(this).attr('name');
					var w = $('.day').eq($(this).index()).html();
					let date = $('.day').eq($(this).index()).attr('date');
					var x = $(this).attr('cal-x');
					var y = $(this).attr('cal-p');
					var eId = $('#employee-id').val($(this).attr('emp-id'))
					var empId  = $(this).attr('emp-id');
					var sDate = $('#start-date').val($(this).attr('curr-date'))
					var tId = $('#timesheet-id').val($(this).attr('timesheet-id'))
					var url = "<?php echo base_url();?>timesheet/getTimesheetDetailsModal?timesheetId="+"<?php echo $timesheetid;?>&x="+x+"&y="+y+"&aT="+arrayType+"&date="+date+"&empId="+empId+"&centerid="+<?php echo $timesheetDetails->centerid; ?>;
					 $.ajax({
					 	url : url,
					 	type : 'GET',
					 	success : function(response){
					 		$('.box-name').html(v)
					 		$('.box-space').html(w)
					 		$('#timesheet-form').html(response);
					 		employeeBudget();
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
function jstimex( x)
  { 
      var output;
      if((x/100) < 12 ){
          if((x%100)==0){
            if(x/1200 == 0){
              output = "12:00 AM";    
            }
            else{
           output = parseInt(x/100) + ":00 AM";
            }
          }
        if((x%100)!=0){
          if((x%100) < 10){
            output = parseInt(x/100) +":0"+ x%100 + " AM";
          }
          if((x%100) >= 10){
            output = parseInt(x/100) +":"+ x%100 + " AM";
          }
          }
      }
  else if(x/100>12){
      if((x%100)==0){
      output = parseInt(x/100)-12 + ":00 PM";
      }
      if((x%100)!=0 && parseInt(x/100)!=12){
        if((x%100) < 10){
          output = parseInt(x/100)-12 +":0"+ x%100 + " PM";
        }
        if((x%100) >= 10){
          output = parseInt(x/100)-12 +":"+ x%100 + " PM";
        }
      }
      if((x%100)!=0 && parseInt(x/100)==12){
        if((x%100) < 10){
          output = parseInt(x/100) +":0"+ x%100 + " PM";
        }
        if((x%100) >= 10){
          output = parseInt(x/100) +":"+ x%100 + " PM";
        }
      }
  }
  else{
  if((x%100)==0){
       output = parseInt(x/100) + ": 00 PM";
      }
      if((x%100)!=0){
        if((x%100) < 10){
          output = parseInt(x/100) + ":0"+ x%100 + " PM";
        }
        if((x%100) >= 10){
          output = parseInt(x/100) + ":"+ x%100 + " PM";
        }
      }
  }
  return output;
}


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

// <?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?>
// 	$(document).on('click','.',function(){
// 		var url = ;
// 		var 
// 	})
// <?php } ?>
	
	// $(document).on('click','.time-box',function(){
	// 	var thisValue = $(this).children('.time-box').html();
	// 	var parentHTML = $('.time-box').html();
	// 	var stime = $(this).attr('start-time');
	// 	var etime = $(this).attr('end-time')
	// 	var code = "<input type=\"time\" class=\"sclass\"> - <input type=\"time\" class=\"eclass\"> <input type=\"text\" id=\"employee-id\" style=\"display:none\"> <input type=\"text\" id=\"start-date\" style=\"display:none\"> <input type=\"text\" id=\"timesheet-id\" style=\"display:none\">"
	// 	$(this).empty();
	// 	$(this).next().html(code)
	// 	$(this).next().children('.sclass').val(timer($(this).attr('svalue')))
	// 	$(this).next().children('.eclass').val(timer($(this).attr('evalue')))

		//$(this).html(code)
		//$(this).children().val(timer(500))
		//$(this).children('.time-box').html($(this).attr('start-time'))
	// })
</script>
<script type="text/javascript">
	$(document).on('click','.publish_timesheet',function(){
		var timesheetId = "<?php echo $timesheetid; ?>";
		var url = window.location.origin+'/PN101/timesheet/publishTimesheet/'+timesheetId;
		$.ajax({
			url : url,
			type: 'GET',
			success : function(response){
				window.location.reload()
			}
		})
	})
$(document).on('click','.buttonn',function(){
		var i = $(".box-time").length;
		var values = [];
		var object = {};
		var url = window.location.origin+"/PN101/timesheet/createPayroll";
			if($('.same_as_roster').is(':checked')){
				if($('.group-span').length > 1){
					for(var i=0;i<$('.group-span').length;i++){
						if(i==0){
							object = {};
							object.startTime = $('.as_roster').children('.time_1').attr('time')
							object.endTime = $('.time-box').eq(i).attr('evalue');
							object.payType = $('.as_roster').children('.same_as_roster').attr('factor')
							object.clockedInTime = object.startTime;
							object.clockedOutTime = object.endTime;
							values.push(object)
						}
						if(i==1){
							object = {};
							object.startTime = $('.time-box').eq(i).attr('svalue');
							object.endTime = $('.as_roster').children('.time_2').attr('time')
							object.payType = $('.as_roster').children('.same_as_roster').attr('factor')
							object.clockedInTime = object.startTime;
							object.clockedOutTime = object.endTime;
							values.push(object)
						}
					}
				}
				if($('.group-span').length == 1){
					object = {};
					object.startTime = $('.as_roster').children('.time_1').attr('time')
					object.endTime = $('.as_roster').children('.time_2').attr('time')
					object.payType = $('.as_roster').children('.same_as_roster').attr('factor')
					object.clockedInTime = object.startTime;
					object.clockedOutTime = object.endTime;
					values.push(object)
				}
			}
			else{
		for(var a=0;a<i;a++){
				object = {};
			if($('.box-time').eq(a).children().children().children().prop('checked') == true){
				if($('.time-box').eq(a).text() != ""){
					object.startTime = $('.time-box').eq(a).children('.startTime_modal').val();
					object.endTime = $('.time-box').eq(a).children('.endTime_modal').val();
					object.payType = $('.new-time-box').eq(a).next().children('.select_css').children('.shift-type-select').val();
					object.clockedInTime = $('.box-time').eq(a).attr('start-time');
					object.clockedOutTime = $('.box-time').eq(a).attr('end-time');
					values.push(object)
				}
				// else{
				// 	object.startTime = AmPmTo24($('.new-time-box').eq(a).children('.sclass').val());
				// 	object.endTime = AmPmTo24($('.new-time-box').eq(a).children('.eclass').val());
				// 	object.payType = $('.new-time-box').eq(a).next().children('.select_css').children('.shift-type-select').val();
				// 	object.clockedInTime = $('.box-time').eq(a).attr('start-time');
				// 	object.clockedOutTime = $('.box-time').eq(a).attr('end-time');
				// 	values.push(object)
				// 	}
				}
			}
		}
		let userid = "<?php echo $this->session->userdata('LoginId'); ?>;"
		let empId = $('#emply-id').attr('employee');
		let shiftDate = $('#emply-id').attr('date');
		let timesheetId = "<?php echo $timesheetid; ?>";
		console.log(values)
		$.ajax({
			url : url,
			type : 'POST',
			data : {
				empId : empId,
				userid : userid,
				shiftDate : shiftDate,
				timesheetid : timesheetId, 
				visits : values
			},
			success : function(response){
			}
		})
	})

	function AmPmTo24(time){
		var sTime = time.toString();
		time = parseInt(sTime.replace(':',''));
		return time;
	}
</script>

	<script type="text/javascript">
		$('#stime').val(timer($('.box-time').attr('start-time')))
	</script>

<script type="text/javascript">
	
	let employeeBudget = function(){
		var count = $('.box-time').length;
		var thisValue = 0;
		for(var i=0;i<count;i++){
		var children = $('.time-box').eq(i);
				if($('.clocked_time').eq(i).prop('checked') == true){
					if(children.next().html() == ""){
						var factor = $('.shift-type-select option:selected').eq(i).attr('factor');
						var hourly = parseInt($('.box-time').eq(i).attr('hourly'));
						var startTime = parseInt((children.children('.startTime_modal').val()).replace(":",""));
							startTime = parseInt(startTime/100)*60 + parseInt(startTime%100)
						var endTime = parseInt((children.children('.endTime_modal').val()).replace(":",""));
							endTime = parseInt(endTime/100)*60 + parseInt(endTime%100)
						var perMinute = hourly/60;
						thisValue = thisValue + ( endTime - startTime ) * factor * perMinute
						console.log(thisValue)
						}
					}
		}

		$(document).on('change','.shift-type-select',function(){
			var count = $('.box-time').length;
			var thisValue = 0;
				for(var i=0;i<count;i++){
				var children = $('.time-box').eq(i);
				if($('.clocked_time').eq(i).prop('checked') == true){
					if(children.next().html() == ""){
						var factor = $('.shift-type-select option:selected').eq(i).attr('factor');
						var hourly = parseInt($('.box-time').eq(i).attr('hourly'));
						var startTime = parseInt((children.children('.startTime_modal').val()).replace(":",""));
							startTime = parseInt(startTime/100)*60 + parseInt(startTime%100)
						var endTime = parseInt((children.children('.endTime_modal').val()).replace(":",""));
							endTime = parseInt(endTime/100)*60 + parseInt(endTime%100)
						var perMinute = hourly/60;
						thisValue = thisValue + ( endTime - startTime ) * factor * perMinute
						console.log(thisValue)
						}
					}
				}
					$('.budget').html('Budget : $'+parseFloat(thisValue).toFixed(2));
		})

		$(document).on('click','input[type=checkbox]',function(){
			var count = $('.box-time').length;
			var thisValue = 0;
			for(var i=0;i<count;i++){
			var children = $('.time-box').eq(i);
				if($('.clocked_time').eq(i).prop('checked') == true){
					if(children.next().html() == ""){
						var factor = $('.shift-type-select option:selected').eq(i).attr('factor');
						var hourly = parseInt($('.box-time').eq(i).attr('hourly'));
						var startTime = parseInt((children.children('.startTime_modal').val()).replace(":",""));
							startTime = parseInt(startTime/100)*60 + parseInt(startTime%100)
						var endTime = parseInt((children.children('.endTime_modal').val()).replace(":",""));
							endTime = parseInt(endTime/100)*60 + parseInt(endTime%100)
						var perMinute = hourly/60;
						thisValue = thisValue + ( endTime - startTime ) * factor * perMinute
						console.log(thisValue)
						}
					}
			}
					$('.budget').html('Budget : $'+parseFloat(thisValue).toFixed(2));
		})

		$(document).on('change','.startTime_modal',function(){
			var count = $('.box-time').length;
			var thisValue = 0;
			for(var i=0;i<count;i++){
			var children = $('.time-box').eq(i);
				if($('.clocked_time').eq(i).prop('checked') == true){
					if(children.next().html() == ""){
						var factor = $('.shift-type-select option:selected').eq(i).attr('factor');
						var hourly = parseInt($('.box-time').eq(i).attr('hourly'));
						var startTime = parseInt((children.children('.startTime_modal').val()).replace(":",""));
							startTime = parseInt(startTime/100)*60 + parseInt(startTime%100)
						var endTime = parseInt((children.children('.endTime_modal').val()).replace(":",""));
							endTime = parseInt(endTime/100)*60 + parseInt(endTime%100)
						var perMinute = hourly/60;
						thisValue = thisValue + ( endTime - startTime ) * factor * perMinute
						console.log(thisValue)
						}
					}
			}
					$('.budget').html('Budget : $'+parseFloat(thisValue).toFixed(2));
		})
		$(document).on('change','.endTime_modal',function(){
			var count = $('.box-time').length;
			var thisValue = 0;
			for(var i=0;i<count;i++){
			var children = $('.time-box').eq(i);
				if($('.clocked_time').eq(i).prop('checked') == true){
					if(children.next().html() == ""){
						var factor = $('.shift-type-select option:selected').eq(i).attr('factor');
						var hourly = parseInt($('.box-time').eq(i).attr('hourly'));
						var startTime = parseInt((children.children('.startTime_modal').val()).replace(":",""));
							startTime = parseInt(startTime/100)*60 + parseInt(startTime%100)
						var endTime = parseInt((children.children('.endTime_modal').val()).replace(":",""));
							endTime = parseInt(endTime/100)*60 + parseInt(endTime%100)
						var perMinute = hourly/60;
						thisValue = thisValue + ( endTime - startTime ) * factor * perMinute
						console.log(thisValue)
						}
					}
			}
					$('.budget').html('Budget : $'+parseFloat(thisValue).toFixed(2));
		})
				$('.budget').html('Budget : $'+parseFloat(thisValue).toFixed(2));
	};


	$(document).ready(()=>{
    $('.containers').css('paddingLeft',$('.side-nav').width());
   			 // margin_auto();
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


	$(document).ready(function(){
		let height = $('.div-box').eq(3).height();
		let count =	 $('.leave').length;
		for(let i=0;i<count;i++){
		$('.leave').eq(i).height(height);
			}
			console.log(height)
	})

	/*----------------------
		same as roster checkbox
	-----------------------*/
	$(document).ready(function(){
	function pad(n, width, z) {
	  z = z || '0';
	  n = n + '';
	  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
	}
	function addColonJS(string){
		let toInsert = ":";
		let str = pad(string,4);
		let pos = str.length-2;
		let strn = [str.slice(0, pos), toInsert, str.slice(pos)].join('');;
		return strn;
	}
		$(document).on('change','.same_as_roster',function(){
			let count = $('.clocked_time').length;
			var startTime = $(this).next().attr('time');
			var endTime = $(this).next().next().attr('time');
	if(count == 1){
		$('.group-span').eq(0).children('.time-box').children('.startTime_modal').val(addColonJS(startTime));
		$('.group-span').eq(0).children('.time-box').children('.endTime_modal').val(addColonJS(endTime));
	}
	if(count > 1){
		$('.group-span').eq(0).children('.time-box').children('.startTime_modal').val(addColonJS(startTime));
		$('.group-span').eq(count-1).children('.time-box').children('.endTime_modal').val(addColonJS(endTime));

	}
			count = $('.box-time').length;
			var thisValue = 0;
			for(var i=0;i<count;i++){
			var children = $('.time-box').eq(i);
				if($('.clocked_time').eq(i).prop('checked') == true){
					if(children.next().html() == ""){
						var factor = $('.shift-type-select option:selected').eq(i).attr('factor');
						var hourly = parseInt($('.box-time').eq(i).attr('hourly'));
						startTime = parseInt((children.children('.startTime_modal').val()).replace(":",""));
							startTime = parseInt(startTime/100)*60 + parseInt(startTime%100)
						endTime = parseInt((children.children('.endTime_modal').val()).replace(":",""));
							endTime = parseInt(endTime/100)*60 + parseInt(endTime%100)
						var perMinute = hourly/60;
						thisValue = thisValue + ( endTime - startTime ) * factor * perMinute
						console.log(thisValue)
						}
					}
			}
					$('.budget').html('Budget : $'+parseFloat(thisValue).toFixed(2));
			if($(this).is(":checked")) {
				for(var i=0;i<count;i++){
	    		$('.clocked_time').eq(i).prop('disabled',true);
	  		}
	    }
	    else{
	    	for(var i=0;i<count;i++){
	    		$('.clocked_time').eq(i).prop('disabled',false);
	    		// $('.clocked_time').eq(i).prop('disabled',true);
	    	}
	    } 	
		})
	})

			$(document).ready(function(){
				$(document).on('click','#discard-timesheet',function(){
					var url = window.location.origin+"/PN101/timesheet/discardTimesheet/<?php echo $_GET['timesheetId']; ?>";
					$.ajax({
						url : url,
						type : 'GET',
						success : function(){
							window.location.href = window.location.origin+'/PN101/timesheet/timesheetDashboard'
						}
					})
				})
			})

			$(document).on('click','.weekModal',function(){
				$('.weekTimesheetModal').css('display','block');
				$('.weekTimesheetModalTabs span').each(function(){
					if($(this).index() != 0){
						$(this).css('background','#8D91AA');
						$(this).css('color','#F3F4F7');
					}else{
						$(this).css('background','#e3e4e7');
						$(this).css('color','rgba(0,0,0,0.8)');
					}
				})
			})

			$(document).on('click','.cancelWeekModel',function(){
				$('.weekTimesheetModal').css('display','none');
			})

			$(document).on('click','.weekTimesheetModalTabs span',function(){
				var that = this;
				$('.weekTimesheetModalTabs span').each(function(){
					if($(that).index() != $(this).index()){
						$(this).css('background','#8D91AA');
						$(this).css('color','#F3F4F7');
					}else{
						$(this).css('background','#e3e4e7');
						$(this).css('color','rgba(0,0,0,0.8)');
					}
				})
				for(i=0;i<5;i++){
					if($(this).index() == i){
						$(`.week_div_${i}`).css('display','block')
					}
					else{
						$(`.week_div_${i}`).css('display','none')
					}
				}
			})

			$(document).ready(function(){
				var getPayrollShiftType_v1 = function(){
					localStorage.setItem('payrollTypes',`<?php echo $payrollTypes ?>`);
				}
				getPayrollShiftType_v1();
			})

			var getEmployeeTimesheet = function(e){
				var name = $(e).parent().prev().attr('name');
					$('.weekTimesheetModalHeader').html(name)
				var employeeId = $(e).attr('userid');
					$('.weekTimesheetModalHeader').attr('userid',employeeId);
				var pay = $(e).attr('pay');
					$('.weekTimesheetModalHeader').attr('pay',pay);
				var startDate = $(e).attr('date');
					$('.weekTimesheetModalHeader').attr('date',startDate);
				var url = "<?php echo base_url('timesheet/getEmployeeTimesheet'); ?>";
				var select = JSON.parse(localStorage.getItem('payrollTypes'));
				$.ajax({
					url : url,
					type : 'POST',
					data : {
						employeeId : employeeId,
						startdate : startDate
					},
					success : function(response){
						var x = 0;
						var Time = 0;
						$('.weekTimesheetModalVisits').empty()
						var view = JSON.parse(response);
						view.visitis.forEach(day => {
							var sameAsRoster = "";
							var inTime = view.shift[Time].startTime;
							var outTime = view.shift[Time].endTime;
							try{
								if(view.shift[Time].rosterDate == day[0].signInDate){
									sameAsRoster =  jstimex(view.shift[Time].startTime)+" to "+ jstimex(view.shift[Time].endTime);
									Time++;
								}
							}
							catch(err){}
							var i =0;
							var wrapper = `<div class="week_div_${x}">
								<span class="sameAsRosterBlock_${x}">
									<span><input type="checkbox" class="sameAsRoster_${x}_input"> </span>
									<span startTime="${inTime}" endTime="${outTime}" class="sameAsRoster_${x}_time">&nbsp;&nbsp;&nbsp;Same as Roster ( ${sameAsRoster} )</span>
								</span>
							</div>`;
							$('.weekTimesheetModalVisits').append(wrapper);
							day.forEach(visit => {
							var code = `<span class="display_flex_visits">
														<span visitid='${visit.id}' startTime='${visit.signInTime}' endTime='${visit.signOutTime}' class="visit__">
															<span class="time_visits"><input type="checkbox" checked></span>
															<span class="time_visits_child oldtime">
																<input type="time" value="${timer(visit.signInTime)}"> -- <input type="time" value="${timer(visit.signOutTime)}""	
															</span>
														</span>
														<span class="select__">
															<span class="select_css">
																<select>
																</select>
															</span>
														</span>
													</span>`
							$('.week_div_'+x).append(code);
							select.payrollTypes.forEach(type => {
								if(type.earningType == "ORDINARYTIMEEARNINGS" && type.centerid == 6){
									var option = `<option value="${type.earningRateId}" factor="${type.multiplier_amount}" earningType="${type.earningType}" selected>${type.name}</option>`
								}
								if(type.earningType != "ORDINARYTIMEEARNINGS" && type.centerid == 6){
									var option = `<option value="${type.earningRateId}" factor="${type.multiplier_amount}" earningType="${type.earningType}">${type.name}</option>`
								}
								$(`.week_div_${x} select`).eq(i).append(option)
									})
							i++;
								} 
							)
							x++;
							getBudget();
						})
					}
				})
			}

			function getBudget(){
				var hourly = $('.weekTimesheetModalHeader').attr('pay');
				for(var i=0;i<5;i++){
					var count = $(`.week_div_${i} .display_flex_visits`).length;
					var isChecked = $(`.week_div_${i}`).children('.display_flex_visits').children('.visit__');
					var weeklyPay = 0;
					for(var j=0;j<count;j++){
					var parent = $(`.week_div_${i}`).children('.display_flex_visits').eq(j).children('.visit__').children('.time_visits_child');
						if(isChecked.eq(j).children('.time_visits').children('input').prop('checked') == true){
							var startT = parent.children('input').eq(0).val();
									startT = parseInt(startT.replace(":",""));
									startT = parseInt(startT/100)*60 + parseInt(startT%100);
							var endT = parent.children('input').eq(1).val();
									endT = parseInt(endT.replace(":",""))
									endT = parseInt(endT/100)*60 + parseInt(endT%100);
							var type = parent.next().children('.select_css').children('select').children('option:selected').attr('factor');
							weeklyPay = weeklyPay + (endT - startT)*(hourly/60)*type;
						}
						// console.log(endT+'\t'+startT+'\t'+weeklyPay);
					}
						console.log(weeklyPay)
				}
			}

			$(document).on('click','.time_visits input[type="checkbox"]',function(){
				getBudget();
			})
			$(document).on('change','.select__ select',function(){
				getBudget();
			})
			$(document).on('change','.time_visits_child input',function(){
				getBudget();
			})
			// $(document).on('click','.time_visits_child.oldtime',function(){
			// 	$(this).removeClass('oldtime')
			// 	$(this).html(`<input type="time" value="${timer($(this).parent().attr('starttime'))}" class="sttime">--<input value="${timer($(this).parent().attr('endtime'))}" type="time" class="edtime">`)
			// })

			$(document).on('click','.submit_weekModal',function(){
				var values = [];
				var timesheetId = "<?php echo $timesheetid; ?>";
				var userid = "<?php echo $this->session->userdata('LoginId'); ?>";
				var startDate = new Date($('.weekTimesheetModalHeader').attr('date'));
				var empId = $('.weekTimesheetModalHeader').attr('userid')
				console.log(empId)
				var url = window.location.origin+"/PN101/timesheet/createWeekPayroll";
				for(var i=0;i<5;i++){
					$(`.week_div_${i} .display_flex_visits`).each(function(){
						var obj = {};
						var d = new Date();
						if($(this).children('.visit__').children('.time_visits_child').hasClass('oldtime'))
						{
							if($(this).children('.visit__').children().children('input').prop('checked') == true){
							obj.startTime = ($(this).children('.visit__').children('.time_visits_child').children('input').eq(0).val()).replace(":","").toString();
							obj.endTime = ($(this).children('.visit__').children('.time_visits_child').children('input').eq(1).val()).replace(":","").toString();
							obj.payType = $(this).children('.visit__').children('.select__').children('.select_css').children('select').val();
							obj.clockedInTime = $(this).children('.visit__').attr('starttime');
							obj.clockedOutTime = $(this).children('.visit__').attr('endtime');
							d.setDate(startDate.getDate()+(i));
							obj.shiftdate = d.getFullYear()+'-'+d.getMonth()+'-'+d.getDate();
								}
						}
						// if($(this).children('.visit__').children('.time_visits_child').hasClass('oldtime'))
						// {
						// 	if($(this).children('.visit__').children().children('input').prop('checked') == true){
						// 	obj.startTime = $(this).children('.visit__').attr('starttime');
						// 	obj.endTime = $(this).children('.visit__').attr('endtime');
						// 	obj.payType = $(this).children('.select__').children('.select_css').children('select').val();
						// 	obj.clockedInTime = $(this).children('.visit__').attr('starttime');
						// 	obj.clockedOutTime = $(this).children('.visit__').attr('endtime');
						// 	d.setDate(startDate.getDate()+(i));
						// 	obj.shiftdate = d.getFullYear()+'-'+d.getMonth()+'-'+d.getDate();
						// 	}
						// }
						values.push(obj)
					})
				}
				console.log(values)
				$.ajax({
					url : url,
					type: 'POST',
					data : {
						empId : empId,
						userid : userid,
						timesheetid : timesheetId, 
						visits : values
					},
					success : function(response){
						console.log(response)
							// send data to api, from there, call api five times !!
					}
				})
			})

	$(document).on('click','input[class^="sameAsRoster_"]',function(){
		var startTime = $(this).parent().next().attr('starttime');
		var endTime = $(this).parent().next().attr('endtime');

		if($(this).prop('checked') == true) {
			$(this).parent().parent().parent().children('.display_flex_visits').children('.visit__').children('.time_visits').children('input').prop('disabled',true)
			$(this).parent().parent().parent().children('.display_flex_visits').eq(1).children('.visit__').children('.time_visits').children('input').prop('disabled',true)
			if($(this).parent().parent().parent().children('.display_flex_visits').length > 1){
				var len = $(this).parent().parent().parent().children('.display_flex_visits').length; 
				$(this).parent().parent().parent().children('.display_flex_visits').eq(0).children('.visit__').children('.time_visits_child').children('input').eq(0).val(timer(startTime));
				$(this).parent().parent().parent().children('.display_flex_visits').eq(len-1).children('.visit__').children('.time_visits_child').children('input').eq(1).val(timer(endTime));
			}
			if($(this).parent().parent().parent().children('.display_flex_visits').length == 1){
				$(this).parent().parent().parent().children('.display_flex_visits').eq(0).children('.visit__').children('.time_visits_child').children('input').eq(0).val(times(startTime));
				$(this).parent().parent().parent().children('.display_flex_visits').eq(0).children('.visit__').children('.time_visits_child').children('input').eq(1).val(times(endTime));
			}
		}
		if($(this).prop('checked') == false) {
			$(this).parent().parent().parent().children('.display_flex_visits').children('.visit__').children('.time_visits').children('input').prop('disabled',false)
			$(this).parent().parent().parent().children('.display_flex_visits').eq(1).children('.visit__').children('.time_visits').children('input').prop('disabled',false)
			if($(this).parent().parent().parent().children('.display_flex_visits').length == 1){

			}
				if($(this).parent().parent().parent().children('.display_flex_visits').length > 1){

				}
		}
	})
		</script>

	</body>
</html>


<?php
	//PHP functions //

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

function dateToDay($date){
	$date = explode("-",$date);
	return date(", M d",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
}


//PHP functions //
?>