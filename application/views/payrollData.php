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
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<style type="text/css">
	*{
		text-align: center;
		font-family: 'Roboto', sans-serif;

	}
	body{
		background:#EAE6FF;
	}
/*.containers{
	width:95%;
	
	margin-left:20px;
}*/
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
	font-size:30px;
	padding-left:50px;
}
.timesheet-dates{
	text-align:left;
	background-color: white;
	padding-left:50px;
	padding-bottom:10px;
	padding-top:10px;
	font-weight:bolder;
}
.table-div{
	background:white;
	display: flex;
	justify-content: center
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
		align-self: center;

}
.hourly::before{
	content:'$';
}
.hourly::after{
	content:'/hr';
}
.title{
	font-size:12px;
	display:flex;
	justify-content:center;
	
}
.icon{
	font-size:15px;
	display:flex;
	justify-content:center;
	align-self: center;
	background:rgba(200,200,150,0.8);
	border-radius: 50%;
	padding:0 10px 0 10px;
	color:white;
	display: flex;

}
.empname{
	font-size:15px;
	display:flex;
	justify-content:center;
	font-weight: 600;
}
.modal-content{
max-width:50vw;
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

.Published{
	background:#9C27B0;
}
.Accepted{
	background:#4CAF50;
}

@media only screen and (max-width: 600px) {
.modal-content{
	min-width:100vw;
}
.containers {
     width: 100%;
    margin: 0px;
}
}
</style>
</head>
<body>

	<?php 
		$payrollShifts = json_decode($payrollShifts); 
		$payrollTypes = json_decode($payrollTypes);
		$entitlements = json_decode($entitlements);
	?>
	<div class="containers" id="containers" style="overflow-x:scroll">
		<div class="heading">Payroll Shifts</div>
		<div class="timesheet-dates"><?php 

//PHP functions //

function timex( $x){ 
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

function toMinutes($number){
	$number = intval($number);
    if($number%100 == 0){
        $minutes = $number/100*60;
    }
    else{
      $variable =  intval($number/100);
        $minutes = $variable*60 + $number % 100;   
    }
     return $minutes;
}

function dateToDay($date){
	$date = explode("-",$date);
	return date(",M d",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
}

function icon($str){
	$str = explode(" ",$str);
	if(count($str) >1 ){
	    return strtoupper($str[0][0].$str[1][0]);
	}else{
	    return strtoupper($str[0][0]);
	}
}

//PHP functions //

		 $str1 = $payrollShifts->startDate;
		 $str2 = $payrollShifts->endDate; 
		 $v1 = explode("-",$str1);
		 $v2 = explode("-",$str2);
		 echo date("M d",mktime(0,0,0,$v1[1],intval($v1[2]),(intval($v1[0]))))." to ". 
		 date("M d , Y",mktime(0,0,0,$v2[1],intval($v2[2]),(intval($v2[0]))));
		 ?> </div>
		<div class="table-div" >
			<table style="">
				<tr>
					<?php $p =0; ?>
					<th id="table-id-1" class="day">Employees</th>	<?php $x=0;?>
					
					<th  class="details-column day">Details</th>
					

				</tr>
			
				<?php 
				$count = count($payrollShifts->employees);
if($this->session->userdata('UserType')==SUPERADMIN || $this->session->userdata('UserType')==ADMIN){
	// $x is the total number of employees loop value;
				for($x=0;$x<$count;$x++){ 
					?>
		<tr  class="table-row" cal-x="<?php echo $x;?>">
			<td   style="min-width:20vw" class=" cell-boxes left-most">
				<?php if($this->session->userdata('UserType')==ADMIN || $this->session->userdata('UserType')==SUPERADMIN){ ?>
				<span class="row" style="padding:0;margin:0;">
					<span class="col-5 icon-parent justify-content-center"><span class=" icon"><?php echo  icon($payrollShifts->employees[$x]->userDetails->name)?></span></span>
					<span class="col-7 name-role">
					<span class="empname row"><?php echo $payrollShifts->employees[$x]->userDetails->name ?></span>
					<span class="title row"><?php echo $payrollShifts->employees[$x]->userDetails->title ?></span>
					</span>
				</span>
					<?php } ?>
			</td>
				
					
			<td style="min-width:50vw;padding:7px" class="shift-edit" name="<?php  echo $payrollShifts->employees[$x]->userDetails->name ?>"  cal-x="<?php echo $x; ?>" cal-p="<?php echo $p; ?>" array-type=" " emp-id="<?php echo $payrollShifts->employees[$x]->userDetails->id ?>"  timesheet-id="<?php echo $payrollShifts->timesheetid;?>">
			<div style="background:pink;border-radius: 5px;padding:3px">
				<div style="background:#307bd3;color:white;border-radius: 5px" class="row m-0 d-flex">
					<div class="col-6">
						<span class="row m-0"><?php  echo $payrollShifts->employees[$x]->userDetails->name; ?></span>
						<?php  $v=0;?>
						<span class="row m-0"><?php 

				foreach($entitlements->entitlements as $ent){
				 	if($ent->id == $payrollShifts->employees[$x]->userDetails->level)
					 	{
						 echo $ent->name;
						}
					}
						  ?>	 	
						 </span>
						<span class="row m-0">
							<?php
							$rate = 0;

							 foreach($entitlements->entitlements as $ent){
							 	if($ent->id == $payrollShifts->employees[$x]->userDetails->level)
							 	{
							 		$rate = $ent->hourlyRate;
							 		echo "$".$ent->hourlyRate."/hr";
							 	}
							 }
							 ?>	
						 </span>
					</div>
					<div class="col-4 d-flex align-items-center">Flag Accept</div>
				</div>
				<div><?php
				$arr = [];
				$payValue= 0;
					$paytm = 0;
				 foreach($payrollShifts->employees[$x]->payrollShifts as $payroll){
				 	$pay = $payroll->payrollTypeId;
				 	$payTime = toMinutes($payroll->endTime) - toMinutes($payroll->startTime);
				 	$paytm = intval($paytm) + intval($payTime);
				 	  ?>
				 	
				 		<?php 
				 		$payKey = "";
				 			foreach($payrollTypes->payrollTypes as $payrollTy){
				 				if($pay == $payrollTy->id){
				 					$payValue = $payrollTy->factor * $payTime/60 * $rate; 
				 					$payKey = $payrollTy->type;
				 				}
				 			}
				 				if(!array_key_exists($payKey,$arr)){
				 					$arr[$payKey]  = $payValue; 
				 				}
				 				else{
				 					$arr[$payKey] = $arr[$payKey] + $payValue;
				 				}
				 		 ?>
				 
				 	 	<?php
				 }	
				 foreach($arr as $key => $a){
				 	?>
				 	<div class="row"><?php echo "<span class=\"col-6 d-flex justify-content-start\">".$key."</span>"."<span class=\"col-6\">". $paytm/60 ."</span>"; ?></div>
				 	<?php
				 }			 	
				?>  </div>
				<div>Total pay 
					<?php 
						$vr = 0;
						foreach($arr as $va){
						$vr = $vr + intval($va);
					}
					echo "$".$vr;
				?></div>
			</div>
			</td>
		</tr>
		<?php	 } }?>
		</table>
	</div>
		<div class="total-budget" >
			<table>
				<tr class="total-budget-row">
					
				</tr>
			</table>
		</div>


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
	  		<span class="close col-2 d-flex align-items-center" >&times;</span>
	  	</span>
	    
	<div class="modalSpace">
		
	</div>
	  </div>
</div>
<?php } ?>
<!-- Till here -->>



<?php if($this->session->userdata('UserType') == ADMIN || $this->session->userdata('UserType') == SUPERADMIN){?>
<script type="text/javascript">
				var modal = document.getElementById("myModal");
				var htmlVal = $('timesheet-form').html()
				$(document).on('click','.shift-edit',function(){
					 modal.style.display = "block";
					//var arrayType = $(this).attr('array-type');
					//var v = $(this).attr('name');
					//var w = $('.day').eq($(this).index()).html();
					var x = $('.table-row').attr('cal-x');
					//var y = $(this).attr('cal-p');
					//var eId = $('#employee-id').val($('this').attr('emp-id'))
					//var sDate = $('#start-date').val($(this).attr('curr-date'))
					//var tId = $('#timesheet-id').val($(this).attr('timesheet-id'))
					 $.ajax({
					 	url : "http://localhost/PN101/payroll/payrollShiftsModal?timesheetId="+"<?php echo $timesheetId; ?>&x="+x,
					 	type : 'GET',
					 	success : function(response){

					 		$('.modalSpace').html(response)
					 	}
					 })
				})

				$(document).on('click','.close',function(){
					 modal.style.display = "none";
					// $('timesheet-form').html(htmlVal);
					// $('#timesheet-form').trigger('reset');
				})
</script>

<?php }?>

<script type="text/javascript">
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

</body>
</html>
