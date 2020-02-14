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
.containers{
	width:100%;
	background:#EAE6FF;
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
}
.table-div{
	background:white;
}
.area-name{
	background:#352BFF;
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
	text-align: left
}
.hourly::before{
	content:'$';
}
.hourly::after{
	content:'/hr';
}
.title{
	font-size:12px;

}
.icon{
	font-size:10px;
}
.empname{
	font-size:15px;
}
.modal-content{
max-width:30vw;
	}
	.modal-content span{
		text-align: right;
		min-width:20px;
		max-width:100px;
	}
	.ui-timepicker-container{
		z-index:999;
	}
	.buttons{
		padding:20px;
		margin:2px;
	}
	.button{
		background-color: rgba(31,0,0,0.5);
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
		<div class="roster-dates"><?php echo  $rosterDetails->roster[0]->occupancy[0]->date."-".$rosterDetails->roster[0]->occupancy[4]->date; ?> </div>
		<div class="table-div" style="max-height:70vh;overflow-y:scroll">
			<table>
				<tr>
					<td id="table-id-1" class="day">Employees</td>	<?php $x=0;?>
					<td id="table-id-2" class="day">Monday <?php $rosterDetails->roster[$x]->occupancy[0]->date ?></td>
					<td id="table-id-3" class="day">Tuesday <?php $rosterDetails->roster[$x]->occupancy[1]->date ?></td>
					<td id="table-id-4" class="day">Wednesday <?php $rosterDetails->roster[$x]->occupancy[2]->date ?></td>
					<td id="table-id-5" class="day">Thursday <?php $rosterDetails->roster[$x]->occupancy[3]->date ?></td>
					<td id="table-id-6" class="day">Friday <?php $rosterDetails->roster[$x]->occupancy[4]->date ?></td>
					<td id="table-id-7" class="day">
						<span class="">
							<span class="">Budget</span>
							<span class="">Employee wise</span>
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
					<td   style="width:18vw" class=" cell-boxes">
						<span class="row" >
							<span class="col-3 icon">Icon</span>
							<span class="col-6">
								<span class="empname row"><?php echo $rosterDetails->roster[$x]->roles[$counter]->empName?></span>
								<span class="title row"><?php echo $rosterDetails->roster[$x]->roles[$counter]->empTitle ?></span>
							</span>
							<span class="hourly col-1"><?php echo $rosterDetails->roster[$x]->roles[$counter]->hourlyRate ?></span>
						</span>
					</td>
					<?php $weeklyTotal=0; ?>
					<td class="shift-edit cell-boxes count-1"  style="width:13vw"  name4="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[0]->shiftid?>"  name2="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[0]->roleid ?>"
						name3="<?php echo $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[0]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[0]->startTime)/100; ?>" ><?php echo intval($rosterDetails->roster[$x]->roles[$counter]->shifts[0]->startTime)/(100).":00". "-" .($rosterDetails->roster[$x]->roles[$counter]->shifts[0]->endTime)/(100).":00";
					  $weeklyTotal = $weeklyTotal + $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[0]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[0]->startTime)/100; ?></td>
					<td class="shift-edit cell-boxes count-2" style="width:13vw"  name4="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[1]->shiftid?>"  name2="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[1]->roleid ?>" name3="<?php echo $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[1]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[1]->startTime)/100; ?>"><?php echo ($rosterDetails->roster[$x]->roles[$counter]->shifts[1]->startTime)/(100).":00". "-" .($rosterDetails->roster[$x]->roles[$counter]->shifts[1]->endTime)/(100).":00";
					  $weeklyTotal = $weeklyTotal + $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[1]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[1]->startTime)/100; ?></td>
					<td class="shift-edit cell-boxes count-3" style="width:13vw"  name4="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[2]->shiftid?>"  name2="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[2]->roleid ?>"  name3="<?php echo $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[2]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[2]->startTime)/100; ?>"><?php echo ($rosterDetails->roster[$x]->roles[$counter]->shifts[2]->startTime)/(100).":00". "-" .($rosterDetails->roster[$x]->roles[$counter]->shifts[2]->endTime)/(100).":00";
					  $weeklyTotal = $weeklyTotal + $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[2]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[2]->startTime)/100; ?></td>
					<td class="shift-edit cell-boxes count-4" style="width:13vw"  name4="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[3]->shiftid?>"  name2="<?php echo$rosterDetails->roster[$x]->roles[$counter]->shifts[3]->roleid ?>" name3="<?php echo $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[3]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[3]->startTime)/100; ?>"><?php echo ($rosterDetails->roster[$x]->roles[$counter]->shifts[3]->startTime)/(100).":00". "-" .($rosterDetails->roster[$x]->roles[$counter]->shifts[3]->endTime)/(100).":00";
					  $weeklyTotal = $weeklyTotal + $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[3]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[3]->startTime)/100; ?></td>
					<td class="shift-edit cell-boxes count-5" style="width:13vw"  name4="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[4]->shiftid?>"  name2="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[4]->roleid ?>" name3="<?php echo $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[4]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[4]->startTime)/100; ?>"><?php echo ($rosterDetails->roster[$x]->roles[$counter]->shifts[4]->startTime)/(100).":00". "-" .($rosterDetails->roster[$x]->roles[$counter]->shifts[4]->endTime)/(100).":00";
					  $weeklyTotal = $weeklyTotal + $rosterDetails->roster[$x]->roles[$counter]->hourlyRate * ($rosterDetails->roster[$x]->roles[$counter]->shifts[4]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[4]->startTime)/100; ?></td>
					<td class=" " style="width:13vw"><?php echo $weeklyTotal;?></td>
				</tr>
			<?php } } }?>
			</table>
		</div>
		<div class="total-budget" >
			<table>
				<tr>
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
	<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" style="padding:30px">&times;</span>
    <form  id="roster-form">
    	<div>
 <label>Start Time</label>		<input type="time" name="startTime" id="startTime" style="margin:30px">
</div>
<div>
<label>End Time</label> 		<input type="time" name="endTime" id="endTime" style="margin:30px">
</div>
 		<input type="text" name="shiftId"  id="shiftId" style="display:none">
 		<input type="text" name="roleId" id="roleId" style="display:none">
 		<input type="text" name="status" value="2"  id="status" style="display:none">
 		<input type="text" name="userId"   id="userId" style="display:none">
 		<input type="button" name="shift-submit" id="shift-submit" value="send" style="margin:30px">
 	</form>
  </div>
</div>
	<script type="text/javascript">
	
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
		$('$roster-form').trigger('reset');
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

		<script type="text/javascript">
	$(document).ready(function(){
		
		$(document).on('click','#shift-submit',function(){
			var startTime = document.getElementById('startTime').value ;
			var endTime = document.getElementById('endTime').value;
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
		$(document).on('click','.cell-boxes',function(){
			
			document.getElementById('shiftId').value = $(this).attr('name4');
			document.getElementById('userId').value = "<?php echo $userid ?>";
			document.getElementById('roleId').value = $(this).attr('name2');
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
console.log(response)					}

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

</body>
</html>
