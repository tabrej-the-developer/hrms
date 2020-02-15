<!DOCTYPE html>
<html>
<head>
	<title></title>
		<?php $this->load->view('header'); ?>
<meta content="width=device-width, initial-scale=1" name="viewport" />
	<title>Roster</title>
	<link href="https//:maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https//:maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https//:cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<style type="text/css">
	*{
		text-align: center;
		font-family: 'Roboto', sans-serif;

	}
	body{
		background:#EAE6FF;
	}
.containers{
	width:95%;
	
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
.roster-dates{
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
	background:rgba(0,150,150,0.3);
	margin:0 10px 0 10px;
}
.cell-back-2{
	background:rgba(100,100,100,0.3);
	margin:0 10px 0 10px;
}
.cell-back-3{
	background:yellow;
	margin:0 10px 0 10px;
}
.cell-back-4{
	background:yellow;
	margin:0 10px 0 10px;
}
.cell-back-5{
	background:yellow;
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
#roster-form{
	position: relative;
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

@media only screen and (max-width: 600px) {
.modal-content{
	min-width:100vw;
}
}
</style>
</head>
<body>

	<?php $rosterDetails = json_decode($rosterDetails); ?>
	<div class="containers" id="containers">
		<div class="heading">Rosters</div>
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
	$str = explode(" ",$str);
	if(count($str) >1 ){
	    return strtoupper($str[0][0].$str[1][0]);
	}else{
	    return strtoupper($str[0][0]);
	}
}

//PHP functions //

		 $str1 = $rosterDetails->roster[0]->occupancy[0]->date;
		 $str2 = $rosterDetails->roster[0]->occupancy[4]->date; 
		 $v1 = explode("-",$str1);
		 $v2 = explode("-",$str2);
		 echo date("M d",mktime(0,0,0,$v1[1],intval($v1[2]),(intval($v1[0]))))." to ". 
		 date("M d , Y",mktime(0,0,0,$v2[1],intval($v2[2]),(intval($v2[0]))))
		 ?> </div>
		<div class="table-div" style="">
			<table>
				<tr>
					<th id="table-id-1" class="day">Employees</th>	<?php $x=0;?>
					<th id="table-id-2" class="day">Mon <?php echo dateToDay($rosterDetails->roster[$x]->occupancy[0]->date) ?></th>
					<th id="table-id-3" class="day">Tue <?php echo dateToDay($rosterDetails->roster[$x]->occupancy[1]->date) ?></th>
					<th id="table-id-4" class="day">Wed <?php echo dateToDay($rosterDetails->roster[$x]->occupancy[2]->date) ?></th>
					<th id="table-id-5" class="day">Thu <?php echo dateToDay($rosterDetails->roster[$x]->occupancy[3]->date) ?></th>
					<th id="table-id-6" class="day">Fri <?php echo dateToDay($rosterDetails->roster[$x]->occupancy[4]->date) ?></th>
					<th id="table-id-7" class="day">
						<span class=" d-flex justify-content-center">
							<span class="row">Budget (Emp wise)</span>
						</span>
					</td>
				</tr>
			
				<?php 
				$count = count($rosterDetails->roster);

				for($x=0;$x<$count;$x++){ 
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
				$value = count($rosterDetails->roster[$x]->roles);
				for($counter=0;$counter<$value;$counter++){ ?>
				<tr  class="table-row">
					<td   style="width:18vw" class=" cell-boxes left-most">
						<span class="row" style="padding:0;margin:0;">
							<span class="col-3 icon-parent"><span class=" icon"><?php echo icon($rosterDetails->roster[$x]->roles[$counter]->empName)?></span></span>
							<span class="col-6 name-role">
								<span class="empname row"><?php echo $rosterDetails->roster[$x]->roles[$counter]->empName?></span>
								<span class="title row"><?php echo $rosterDetails->roster[$x]->roles[$counter]->empTitle ?></span>
							</span>
							<span class="hourly col-3"><?php echo  $rosterDetails->roster[$x]->roles[$counter]->hourlyRate ?></span>
						</span>
					</td>
					<?php $weeklyTotal=0; ?>
					<td class="shift-edit cell-boxes count-1"  style="width:13vw"  name4="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[0]->shiftid?>"  name2="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[0]->roleid ?>"
						name3="<?php echo $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[0]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[0]->startTime)/100; ?>" stime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[0]->startTime?>" etime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[0]->endTime?>" name="<?php echo $rosterDetails->roster[$x]->roles[$counter]->empName?>"><div class="cell-back-1"><?php echo timex(intval($rosterDetails->roster[$x]->roles[$counter]->shifts[0]->startTime)). "-" .timex( intval($rosterDetails->roster[$x]->roles[$counter]->shifts[0]->endTime));
					  $weeklyTotal = $weeklyTotal + $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[0]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[0]->startTime)/100; ?> </div></td>
					<td class="shift-edit cell-boxes count-2" style="width:13vw"  name4="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[1]->shiftid?>"  name2="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[1]->roleid ?>" name3="<?php echo $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[1]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[1]->startTime)/100; ?>" stime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[0]->startTime?>" etime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[0]->endTime?>" name="<?php echo $rosterDetails->roster[$x]->roles[$counter]->empName?>"><div class="cell-back-2"><?php echo timex(intval($rosterDetails->roster[$x]->roles[$counter]->shifts[1]->startTime)). "-" .timex(intval($rosterDetails->roster[$x]->roles[$counter]->shifts[1]->endTime));
					  $weeklyTotal = $weeklyTotal + $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[1]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[1]->startTime)/100; ?></div></td>
					<td class="shift-edit cell-boxes count-3" style="width:13vw"  name4="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[2]->shiftid?>"  name2="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[2]->roleid ?>"  name3="<?php echo $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[2]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[2]->startTime)/100; ?>" stime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[0]->startTime?>" etime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[0]->endTime?>" name="<?php echo $rosterDetails->roster[$x]->roles[$counter]->empName?>"><div class="cell-back-3"><?php echo timex(intval($rosterDetails->roster[$x]->roles[$counter]->shifts[2]->startTime)). "-" .timex(intval($rosterDetails->roster[$x]->roles[$counter]->shifts[2]->endTime));
					  $weeklyTotal = $weeklyTotal + $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[2]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[2]->startTime)/100; ?></div></td>
					<td class="shift-edit cell-boxes count-4" style="width:13vw"  name4="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[3]->shiftid?>"  name2="<?php echo$rosterDetails->roster[$x]->roles[$counter]->shifts[3]->roleid ?>" name3="<?php echo $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[3]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[3]->startTime)/100; ?>" stime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[0]->startTime?>" etime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[0]->endTime?>" name="<?php echo $rosterDetails->roster[$x]->roles[$counter]->empName?>"><div class="cell-back-4"><?php echo timex(intval($rosterDetails->roster[$x]->roles[$counter]->shifts[3]->startTime)). "-" .timex(intval($rosterDetails->roster[$x]->roles[$counter]->shifts[3]->endTime));
					  $weeklyTotal = $weeklyTotal + $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[3]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[3]->startTime)/100; ?></div></td>
					<td class="shift-edit cell-boxes count-5" style="width:13vw"  name4="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[4]->shiftid?>"  name2="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[4]->roleid ?>" name3="<?php echo $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[4]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[4]->startTime)/100; ?>" stime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[0]->startTime?>" etime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[0]->endTime?>" name="<?php echo $rosterDetails->roster[$x]->roles[$counter]->empName?>"><div class="cell-back-5"><?php echo timex(intval($rosterDetails->roster[$x]->roles[$counter]->shifts[4]->startTime)). "-" .timex(intval($rosterDetails->roster[$x]->roles[$counter]->shifts[4]->endTime));
					  $weeklyTotal = $weeklyTotal + $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[4]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[4]->startTime)/100; ?></div></td>
					<td class=" " style="width:13vw;font-weight:bolder"><?php echo "$".$weeklyTotal;?></td>
				</tr>
			<?php } } }?>
			</table>
		</div>
		<div class="total-budget" >
			<table>
				<tr class="total-budget-row">
					<td class="total-budget-box" style="width:18vw">Total Budget</td>
					<td class="total-budget-box" style="width:13vw" id="count-1" >$</td>
					<td class="total-budget-box" style="width:13vw" id="count-2">$</td>
					<td class="total-budget-box" style="width:13vw" id="count-3">$</td>
					<td class="total-budget-box" style="width:13vw" id="count-4">$</td>
					<td class="total-budget-box" style="width:13vw" id="count-5">$</td>
					<td class="total-budget-box" style="width:13vw">---</td>
				</tr>
			</table>
		</div>
		<div class="buttons d-flex justify-content-end">
			<button id="discard-roster" class="button">Discard</button>
			<button id="draft-roster" class="button">Save Draft</button>
			<button id="publish-roster" class="button">Publish</button>
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
	    
	    <form  id="roster-form">
			<div>
				<label>Start Time</label>
				<input type="time" name="startTime" id="startTime" style="margin:30px 30px 0 30px">
			</div>
			<div>
				<label>End Time</label>
				<input type="time" name="endTime" id="endTime" style="margin:30px">
			</div>
	 		<input type="text" name="shiftId"  id="shiftId" style="display:none">
	 		<input type="text" name="roleId" id="roleId" style="display:none">
	 		<input type="text" name="status" value="2"  id="status" style="display:none">
	 		<input type="text" name="userId"   id="userId" style="display:none">
	 		<input type="button" name="shift-submit" id="shift-submit" value="send" style="margin:30px">
	 	</form>
	  </div>
</div>
<?php } ?>
<!-- Till here -->>

<!-- This is meant for staff -->
<?php if($this->session->userdata('UserType') == STAFF){?>
<div id="mxModal" class="modal">
 
	  <div class="modal-content">
	  	<div class="row titl">
	  		<div class="col-8 box-name-space">
		  		<div style=""  class="row box-name">Title Here </div>
		  		<div  class="row box-space">Time Here</div>
		  	</div>
		 	<span class="close col-2" >&times;</span>
		</div>
		   <form  id="user-form">	
		 		<input type="text" name="shiftId"  id="shift-Id" style="display:none">
		 		<input type="text" name="roleId" id="role-Id" style="display:none">
		 		<input type="text" name="status" value="3"  id="sta-tus" style="display:none">
		 		<input type="text" name="userId"   id="user-Id" style="display:none">
		 		<input type="button" name="user-submit" id="user-submit" value="Accept" style="margin:30px">
		 		<input type="button" name="user-deny" id="user-deny" style="margin:30px" value="Deny">
		 	</form>
	  </div>
</div>
<?php } ?>


<?php if($this->session->userdata('UserType') == STAFF ){?>
<script type="text/javascript">
				var model = document.getElementById("mxModal");

				$(document).on('click','.shift-edit',function(){
					 model.style.display = "block";
				})

				$(document).on('click','.close',function(){
					 model.style.display = "none";
					 $('#user-form').trigger('reset');
				})
				$(document).on('click','#user-deny',function(){
					 model.style.display = "none";
					 $('#user-form').trigger('reset');
				})

			</script>

<script type="text/javascript">
	$(document).on('click','.shift-edit',function(){
	var timings = $(this).text();
	var name = $(this).index();
	var role = 4;
	var status = 3;
	var userid = "<?php echo $userid ?>";
	var shiftid = $(this).attr('name4');
	
	document.getElementsByClassName('box-name')[0].innerHTML = $('th').eq(name).html();
	document.getElementsByClassName('box-space')[0].innerHTML = timings;
	})
</script>
<?php  } ?>
<!-- Till here -->


<!-- This is meant for staff -->

<?php if($this->session->userdata('UserType')==STAFF){?>

<script type="text/javascript">
	$(document).ready(function(){
		
		$(document).on('click','#user-submit',function(){
			var startingTime = document.getElementById('start-Time').getAttribute('stime') ;
			var endingTime = document.getElementById('end-Time').getAttribute('etime');
			var shiftid = $(this).attr('name4');
			var status = 3;
			var userid = "<?php echo $userid ?>";
			var roleid = $(this).attr('name2');
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
					userid:userid
				},
				success:function(response){
						var modal = document.getElementById("mxModal");
						modal.style.display="none";

					$('user-form').trigger('reset');

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
					 modal.style.display = "block";
				})

				$(document).on('click','.close',function(){
					 modal.style.display = "none";
					 $('#roster-form').trigger('reset');
				})

			</script>
			<script type="text/javascript">
				$(document).ready(function(){
			    $("#shift-submit").click(function(){
			        $("#roster-form").trigger("reset");
			    });
			});
</script>
<script type="text/javascript">

$(document).ready(function(){
		
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
			var shiftid = $(this).attr('name4');
			var status = document.getElementById('status').value;
			var userid = "<?php echo $userid ?>";
			var roleid = $(this).attr('name2');
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
					userid:userid
				},
				success:function(response){
						var modal = document.getElementById("myModal");
						modal.style.display="none";

					$('#roster-form').trigger('reset');

				}
			})
		})
		
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
				$(document).ready(function(){
				var	total = 0;
				var count = $('.count-1').length
				for(var i=0;i<count;i++){
				total = total + parseInt($('.count-1').eq(i).attr('name3'))
			}
				$('#count-1').html('$'+total)
				//
				total = 0;
				 count = $('.count-2').length
				for( i=0;i<count;i++){
				total = total + parseInt($('.count-2').eq(i).attr('name3'))
			}
				$('#count-2').html('$'+total)
				//
				total = 0;
				 count = $('.count-3').length
				for( i=0;i<count;i++){
				total = total + parseInt($('.count-3').eq(i).attr('name3'))
			}
				$('#count-3').html('$'+total)
				//
				total = 0;
				 count = $('.count-4').length
				for( i=0;i<count;i++){
				total = total + parseInt($('.count-4').eq(i).attr('name3'))
			}
				$('#count-4').html('$'+total)
				//
				total = 0;
				 count = $('.count-5').length
				for( i=0;i<count;i++){
				total = total + parseInt($('.count-5').eq(i).attr('name3'))
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
			document.getElementById('userId').value = "<?php echo $userid ?>";
			document.getElementById('roleId').value = $(this).attr('name2');
						})
				})
							

</script>
<script type="text/javascript">
	$(document).ready(function(){
		
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
			var shiftid = $(this).attr('name4');
			var status = document.getElementById('status').value;
			var userid = "<?php echo $userid ?>";
			var roleid = $(this).attr('name2');
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
					userid:userid
				},
				success:function(response){
											var modal = document.getElementById("myModal");
																	modal.style.display="none";

					$('$roster-form').trigger('reset');

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
						status: 'Drafted'
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
						window.location.href= window.location.origin+"/PN101/roster/roster_dashboard";
					}

				})
			}
		})
	})
</script>
<?php }?>



</body>
</html>
