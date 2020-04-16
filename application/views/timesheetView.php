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

	<?php $timesheetDetails = json_decode($timesheetDetails); 
			$entitlements = json_decode($entitlements);
	?>
	<div class="containers" id="containers" style="overflow-x:scroll">
		<div class="heading">Timesheets</div>
		<div class="timesheet-dates"><?php 

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
	$val = explode(" ",$str);
	if(count($val) >2 ){
	    return strtoupper($val[0][0].$val[1][0]);
	}else{
	    return strtoupper($val[0][0]);
	}
}

//PHP functions //

		 $str1 = $timesheetDetails->timesheet[0]->currentDate;
		 $str2 = $timesheetDetails->timesheet[13]->currentDate; 
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
					<?php foreach($timesheetDetails->timesheet as $timesheet) {
						$p++;
						$original = explode('-',$timesheet->currentDate);
						$datts = $original[2].".".$original[1].".".$original[0]; 
					 	 ?>
					<th  class="day"><?php  echo date("D",strtotime($datts)); echo " ".dateToDay($timesheet->currentDate) ?></th>
					<?php } ?>

				</tr>
			
				<?php 
				$count = count($timesheetDetails->timesheet[0]->rosteredEmployees);
if($this->session->userdata('UserType')==SUPERADMIN || $this->session->userdata('UserType')==ADMIN){
	// $x is the total number of employees loop value;
	$r = $timesheetDetails->timesheet[0]->rosteredEmployees;
	$x=0;
				foreach($r as $p){
				
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
					<span class="col-3 icon-parent"><span class=" icon"><?php echo icon($timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empName)?></span></span>
					<span class="col-6 name-role">
					<span class="empname row"><?php echo $timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empName?></span>
					<span class="title row"><?php //echo $timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empTitle ?></span>
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
					<span class="hourly col-3"><?php echo  $variable; ?></span>
						</span>
					<?php } ?>
					</td>
				
					<?php $weeklyTotal=0; 
					// to be changed to $value
					?>

					<?php 
					for($p=0;$p<14;$p++){ if($timesheetDetails->timesheet[$p]->rosteredEmployees != null){?>
		<td style="min-width:13vw;padding:7px" class="shift-edit" name="<?php  echo $timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empName ?>"  cal-x="<?php echo $x; ?>" cal-p="<?php echo $p; ?>" array-type="rosteredEmployees" emp-id="<?php echo $timesheetDetails->timesheet[0]->rosteredEmployees[$x]->empId?>" curr-date="<?php echo $timesheetDetails->timesheet[$x]->currentDate?>" timesheet-id="<?php echo $timesheetDetails->id;?>">
		<div style="background:pink;border-radius: 5px;padding:3px">
		<div style="display:flex;flex-direction: column;background:#307bd3;color:white;border-radius: 5px">
					<?php 
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
							<span>Total Hours : <?php echo  intVal($totalTime/100) .".". $totalTime%100; ?></span>
							<span>Total visits : <?php echo $totalVisits; ?></span>
						</div>
					</div>
				</td>
			 <?php }} ?>
			<td class=" " style="min-width:18vw;font-weight:bolder"><?php echo "$".$weeklyTotal;?></td>
		</tr>

			<?php $x = $x+1;
		} 
			$count = count($timesheetDetails->timesheet[0]->unrosteredEmployees);
			for($x=0;$x<$count;$x++){ 
				$userLevel = $timesheetDetails->timesheet[0]->rosteredEmployees[$x]->level;
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
							<span class="col-3 icon-parent"><span class=" icon"><?php echo icon($timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->empName)?></span></span>
							<span class="col-6 name-role">
								<span class="empname row"><?php echo $timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->empName?></span>
								
							</span>
							<span class="hourly col-3"><?php echo  $variable ?></span>
						</span>
					<?php } ?>
					</td>
				
					<?php $weeklyTotal=0; 
					// to be changed to $value
					?>

					<?php for($p=0;$p<1;$p++){?>
		<td style="min-width:13vw;padding:7px" class="shift-edit" name="<?php  echo $timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->empName ?>"  cal-x="<?php echo $x; ?>"cal-p="<?php echo $p; ?>" array-type="unrosteredEmployees" emp-id="<?php echo $timesheetDetails->timesheet[0]->unrosteredEmployees[$x]->empId?>" curr-date="<?php echo $timesheetDetails->timesheet[$x]->empId?>" timesheet-id="<?php echo $timesheetDetails->id;?>">
						<div style="background:pink;border-radius: 5px;padding:3px">
							<div style="display:flex;flex-direction: column;background:#307bd3;color:white;border-radius: 5px">
					<?php 
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
								<span>Total Hours : <?php echo  $totalTime/100 .".". $totalTime%100; ?></span>
								<span>Total visits : <?php echo $totalVisits; ?></span>
							</div>
							
						</div>
					</td>

					  <?php } ?>
					<td class=" " style="min-width:18vw;font-weight:bolder"><?php echo "$".$weeklyTotal;?></td>

				</tr>
			<?php 
			//$x++; 
		} 


			 } //}?>
		</table>
	</div>
		<div class="total-budget" >
			<table>
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
	  		<span class="close col-2 d-flex align-items-center" >&times;</span>
	  	</span>
	    
	    <form  id="timesheet-form">
			
	 	</form>
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
					var arrayType = $(this).attr('array-type');
					var v = $(this).attr('name');
					var w = $('.day').eq($(this).index()).html();
					var x = $(this).attr('cal-x');
					var y = $(this).attr('cal-p');
					var eId = $('#employee-id').val($('this').attr('emp-id'))
					var sDate = $('#start-date').val($(this).attr('curr-date'))
					var tId = $('#timesheet-id').val($(this).attr('timesheet-id'))
	var url = "http://localhost/PN101/timesheet/getTimesheetDetailsModal?timesheetId="+"<?php echo $timesheetid;?>&x="+x+"&y="+y+"&aT="+arrayType ;
					 $.ajax({
					 	url : url,
					 	type : 'GET',
					 	success : function(response){
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
	$(document).on('click','.buttonn',function(e){
		e.preventDefault();
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

			}
		})
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
});
</script>
</body>
</html>
