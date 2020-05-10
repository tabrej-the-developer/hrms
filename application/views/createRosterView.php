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
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
	*{
font-family: 'Open Sans', sans-serif;
	}
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
		<?php $date = date_create($startDate);
		date_add($date,date_interval_create_from_date_string("4 days"));
		$date =  date_format($date,"Y-m-d");
		
		function addToDate($val){
		$date = date_create($startDate);
		date_add($date,date_interval_create_from_date_string($val." days"));
		return date_format($date,"Y-m-d");
		}
		?>
		<div class=""><?php echo $startDate ."-". $date?> </div>
		<div class="">
			<table id="tbl">
				<tr>
					
					<td id="table-id-1">Employees</td>
					<td id="table-id-2">Monday <?php echo $startDate;?></td>
					<td id="table-id-3">Tuesday <?php echo addToDate(1) ?></td>
					<td id="table-id-4">Wednesday <?php echo addToDate(2)  ?></td>
					<td id="table-id-5">Thursday <?php echo addToDate(3)  ?></td>
					<td id="table-id-6">Friday <?php echo addToDate(4)  ?></td>
					<td id="table-id-7">
						<span class="">
							<span class="">Budget</span>
							<span class="">Employee wise</span>
						</span>
					</td>
				</tr>
				
				<?php 
				$staff = json_decode($staff);
				$number = 0;
				foreach($staff as $x){
					if($x->centerid == $centerid && $x->roleid == 4){
						$workingStaff[$number] = $x;
						$number++;
					}
				}
				for($count=0;$count<count($workingStaff);$count++){ ?>
				<tr value="<?php echo $workingStaff[$count]->roleid?>">
					<td   style="width:13vw" class="shift-edit cell-boxes">
						<span class="name-class" id="<?php $workingStaff[$count]->roleid ?>" name="<?php $workingStaff[$count]->name ?>">
							<span class="">Icon</span>
							<span>
								<span class=""><?php $workingStaff[$count]->name; ?></span>
								<span class=""><?php $workingStaff[$count]->title;?></span>
							</span>
							<span class=""><?php $workingStaff[$count]->hourlyRate; ?></span>
						</span>
					</td>
					<td class="shift-edit cell-boxes" style="width:13vw" class="count-1" name="<?php $workingStaff[$count]->name ?>"><?php if()?></td>
					<td class="shift-edit cell-boxes" style="width:13vw" class="count-2" name="<?php $workingStaff[$count]->name ?>"></td>
					<td class="shift-edit cell-boxes" style="width:13vw" class="count-3" name="<?php $workingStaff[$count]->name ?>"></td>
					<td class="shift-edit cell-boxes" style="width:13vw" class="count-4" name="<?php $workingStaff[$count]->name ?>"></td>
					<td class="shift-edit cell-boxes" style="width:13vw" class="count-5" name="<?php $workingStaff[$count]->name ?>"></td>
					<td class="shift-edit cell-boxes" style="width:13vw"></td>
				</tr>
			<?php } ?>
			</table>
		</div>
	
		<div>
			<button id="discard-button">Discard</button>
			<button id="save-button">Save Draft</button>
		</div>
	</div>
	<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <form id="data-form">
 		<span id="name-span"></span>
 		<span id="cell-date"></span>
		<input type="time" name="startTime">
		<input type="time" name="endTime"> 	
		<input type="number" name="status" style="display:none" value="1">	
		<input type="text" name="roleId" style="display:none" value="" id="roleId">	
 		<input type="button" name="submit" id="form-submit">
 		<input type="reset" name="">
 	</form>
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

	$(document).on('click','td',function(){
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
$(document).on('click','.name-class',function(){
var id = $(this).prop('id');
document.getElementById('roleId').value = id;
document.getElementById('name-span').innerHTML = $(this).attr('name');
document.getElementById('cell-date').innerHTML = <?php echo $startDate ."-". $date;?>
})
})
	$(document).ready(function(){
		$(document).on('click','#form-submit',function(){
			var url = "http://localhost/PN101/api/rosters/updateShift";
			var startTime = document.getElementById('startTime').value ;
			var endTime = document.getElementById('endTime').value;
			var roleId = document.getElementById('roleId').value;
			var status = document.getElementById('status').value;
			var userid = <?php echo $userid ?>;
			//var shiftId = //document.getElementById('shiftId');
			var modal = document.getElementById("myModal");
			$.ajax({
				url:url,
				type:'POST',
				data:{
					startTime:startTime,
					endTime:endTime,
					shiftid:shiftId,
					roleid:roleId,
					status:status,
					userid:userid
					}
				success:function(){
					$('#data-form').reset();
				 modal.style.display = "none";
			  }
			})
		})
	})
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','save-button',function(){
			url = "";
			$.ajax({

			})
		})
		$(document).on('click','discard-button',function(){
			url = "";
			$.ajax({

			})
		})
	})
</script>
</body>
</html>
