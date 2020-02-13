<!DOCTYPE html>
<html>
<head>
	<title></title>
		<?php $this->load->view('header'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Roster</title>
	<link href="https//:maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https//:maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https//:cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style type="text/css">
.containers{
	width:100%;
}
			/* The Modal (background) */
.modal {
  display: none; 
  position: fixed;
  z-index: 1; 
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
  padding: 20px;
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
	border:1px dotted black;
}

</style>
</head>
<body>
	<div class="containers" id="containers">
		<div class="">Rosters</div>
		<div class=""><?php $rosterid."-".$rosterDetails->roster[0]->occupancy[0]->date."-"$rosterDetails->roster[0]->occupancy[4]->date;.; ?> </div>
		<div class="">
			<table>
				<tr>
					<td id="table-id-1">Employees</td>	<?php $x=0;?>
					<td id="table-id-2">Monday <?php $rosterDetails->roster[$x]->occupancy[0]->date ?></td>
					<td id="table-id-3">Tuesday <?php $rosterDetails->roster[$x]->occupancy[1]->date ?></td>
					<td id="table-id-4">Wednesday <?php $rosterDetails->roster[$x]->occupancy[2]->date ?></td>
					<td id="table-id-5">Thursday <?php $rosterDetails->roster[$x]->occupancy[3]->date ?></td>
					<td id="table-id-6">Friday <?php $rosterDetails->roster[$x]->occupancy[4]->date ?></td>
					<td id="table-id-7">
						<span class="">
							<span class="">Budget</span>
							<span class="">Employee wise</span>
						</span>
					</td>
				</tr>
				<?php 
				$count = count($rosterDetails->roster)

				for($x=0;$x<$count;$x++){ 
					if($rosterDetails->roster[$x]->areadId->isRoomYN == "Y")
						{?>
				<tr >
					<td colspan="7">$rosterDetails->roster[$x]->areadId->areaName</td>
				</tr>
				$occupancy = 0;
				<tr>
					<td></td>
					<td><?php $rosterDetails->roster[$x]->occupancy[0]->occupancy?></td>
					<td><?php $rosterDetails->roster[$x]->occupancy[1]->occupancy?></td>
					<td><?php $rosterDetails->roster[$x]->occupancy[2]->occupancy?></td>
					<td><?php $rosterDetails->roster[$x]->occupancy[3]->occupancy?></td>
					<td><?php $rosterDetails->roster[$x]->occupancy[4]->occupancy?></td>
					<td> </td>
				</tr>
				<?php 
				$value = count($rosterDetails->roster[$x]->roles);
				for($count=0;$count<$value;$count++){ ?>
				<tr name="$rosterDetails->roster[$x]->roles[$count]->empName" class="table-row">
					<td   style="width:13vw" class="shift-edit cell-boxes">
						<span class="" >
							<span class="">Icon</span>
							<span>
								<span class=""><?php $rosterDetails->roster[$x]->roles[$count]->empName?></span>
								<span class=""><?php $rosterDetails->roster[$x]->roles[$count]->empTitle ?></span>
							</span>
							<span class=""><?php $rosterDetails->roster[$x]->roles[$count]->hourlyRate ?></span>
						</span>
					</td>
					<?php $weeklyTotal=0; ?>
					<td class="shift-edit cell-boxes"  style="width:13vw" class="total-1" name="<?php echo $rosterDetails->roster[$x]->roles[$count]->shiftid?>"  name2="<?php $rosterDetails->roster[$x]->roles[$count]->roleid ?>"><?php $rosterDetails->roster[$x]->roles[$count]->startTime. "-" .$rosterDetails->roster[$x]->roles[$count]->endTime;
					  $weeklyTotal = $weeklyTotal + $rosterDetails->roster[$x]->roles[$count]->hourlyRate * ($rosterDetails->roster[$x]->roles[$count]->endTime - $rosterDetails->roster[$x]->roles[$count]->startTime)/100; ?></td>
					<td class="shift-edit cell-boxes" style="width:13vw" class="count-2" name="<?php echo $rosterDetails->roster[$x]->roles[$count]->shiftid?>" name2="<?php $rosterDetails->roster[$x]->roles[$count]->roleid ?>"><?php $rosterDetails->roster[$x]->roles[$count]->startTime. "-" .$rosterDetails->roster[$x]->roles[$count]->endTime;  $weeklyTotal = $weeklyTotal + $rosterDetails->roster[$x]->roles[$count]->hourlyRate *($rosterDetails->roster[$x]->roles[$count]->endTime - $rosterDetails->roster[$x]->roles[$count]->startTime)/100?></td>
					<td class="shift-edit cell-boxes" style="width:13vw" class="count-3" name="<?php echo $rosterDetails->roster[$x]->roles[$count]->shiftid?>" name2="<?php $rosterDetails->roster[$x]->roles[$count]->roleid ?>"><?php $rosterDetails->roster[$x]->roles[$count]->startTime. "-" .$rosterDetails->roster[$x]->roles[$count]->endTime;  $weeklyTotal = $weeklyTotal + $rosterDetails->roster[$x]->roles[$count]->hourlyRate *($rosterDetails->roster[$x]->roles[$count]->endTime - $rosterDetails->roster[$x]->roles[$count]->startTime)/100?></td>
					<td class="shift-edit cell-boxes" style="width:13vw" class="count-4" name="<?php echo $rosterDetails->roster[$x]->roles[$count]->shiftid?>" name2="<?php $rosterDetails->roster[$x]->roles[$count]->roleid ?>"><?php $rosterDetails->roster[$x]->roles[$count]->startTime. "-" .$rosterDetails->roster[$x]->roles[$count]->endTime;  $weeklyTotal = $weeklyTotal + $rosterDetails->roster[$x]->roles[$count]->hourlyRate *($rosterDetails->roster[$x]->roles[$count]->endTime - $rosterDetails->roster[$x]->roles[$count]->startTime)/100?></td>
					<td class="shift-edit cell-boxes" style="width:13vw" class="count-5" name="<?php echo $rosterDetails->roster[$x]->roles[$count]->shiftid?>" name2="<?php $rosterDetails->roster[$x]->roles[$count]->roleid ?>"><?php $rosterDetails->roster[$x]->roles[$count]->startTime. "-" .$rosterDetails->roster[$x]->roles[$count]->endTime;  $weeklyTotal = $weeklyTotal + $rosterDetails->roster[$x]->roles[$count]->hourlyRate *($rosterDetails->roster[$x]->roles[$count]->endTime - $rosterDetails->roster[$x]->roles[$count]->startTime)/100?></td>
					<td class="shift-edit cell-boxes" style="width:13vw"><?php $weeklyTotal;?></td>
				</tr>
			<?php } } ?>
			</table>
		</div>
		<div class="" style="position:absolute;bottom:5%">
			<table>
				<tr>
					<td class="total-budget-box" style="width:13vw">Total Budget</td>
					<td class="total-budget-box" style="width:13vw" id="count-1" >$</td>
					<td class="total-budget-box" style="width:13vw" id="count-2">$</td>
					<td class="total-budget-box" style="width:13vw" id="count-3">$</td>
					<td class="total-budget-box" style="width:13vw" id="count-4">$</td>
					<td class="total-budget-box" style="width:13vw" id="count-5">$</td>
					<td class="total-budget-box" style="width:13vw">---</td>
				</tr>
			</table>
		</div>
		<div>
			<button>Discard</button>
			<button>Save Draft</button>
		</div>
	</div>
	<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
 		<input type="time" name="startTime">
 		<input type="time" name="endTime">
 		<input type="text" name="shiftId" style="display:none" value="">
 		<input type="text" name="roleId" >
 		<input type="text" name="status" value="">
 		<input type="text" name="userId" value="">
 		<input type="button" name="shift-submit">
 		
 	
  </div>
</div>
	<script type="text/javascript">
	var cell1 = document.getElementById('table-id-1').offsetWidth;
	var cell2 = document.getElementById('table-id-2').offsetWidth;
	document.querySelector('.cell-boxes').style.width = cell2 + "px"
	document.querySelector('.total-budget-box').style.width = cell2 + "px"
	if(screen.width < 768){

	}
	</script>
<script type="text/javascript">
	var modal = document.getElementById("myModal");

	$(document).on('click','.shift-edit',function(){
		 modal.style.display = "block";
	})

	$(document).on('click','.close',function(){
		 modal.style.display = "none";
	})

</script>
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
	var count_1 = $('.count-1').length;
	var total=0;
	for(var i=0;i<count_1;i++){
		total = total + parseInt($('.count-1')[i].val());
	} 
	document.getElementById('count-1').innerHTML = "$"+total;
	//
	var count_2 = $('.count-2').length;
	total=0;
	for(var i=0;i<count_2;i++){
		total = total + parseInt($('.count-2')[i].val());
	} 
	document.getElementById('count-2').innerHTML = "$"+total;
	//
	var count_3 = $('.count-3').length;
	total = 0;
	for(var i=0;i<count_3;i++){
		total = total + parseInt($('.count-3')[i].val());
	} 
	document.getElementById('count-3').innerHTML = "$"+total;
	//
	var count_4 = $('.count-4').length;
	total = 0;
	for(var i=0;i<count_4;i++){
		total = total + parseInt($('.count-4')[i].val());
	} 
	document.getElementById('count-4').innerHTML = "$"+total;
	//
	var count_5 = $('.count-5').length;
	total = 0;
	for(var i=0;i<count_5;i++){
		total = total + parseInt($('.count-5')[i].val());
	} 
	document.getElementById('count-5').innerHTML = "$"+total;
	})
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.cell-boxes',function(){
			
			document.getElementById('shiftid').innerHTML = $(this).attr('name');
			// var status = ;
			document.getElementById('userId').innerHTML = <?php echo $userid ?>;
			document.getElementById('roleid').innerHTML = $(this).attr('name2');
			})
		$(document).on('click','#shift-submit',function(){
			var startTime = document.getElementById('startTime').value ;
			var endTime = document.getElementById('endTime').value;
			var shiftid = $(this).attr('name');
			//var status = document.getElementById('status').value;
			var userid = <?php echo $userid ?>;
			var roleid = $(this).attr('name2');
			$url = "localhost/PN101/api/rosters/updateShift";
			$.ajax({
				url:url,
				type:'POST',
				data:{
					startTime:startTime,
					endTime:endTime,
					shiftid:shiftid,
					roleid:roleId,
					status:status,
					userid:userid
				}
			})
		})
	})
</script>
</body>
</html>