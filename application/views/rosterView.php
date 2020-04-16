<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('header'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Roster</title>
	
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<style type="text/css">
		thead{
			background:rgba(0,0,0,0.2);
		}
		tr:nth-child(even){
			background:rgba(0,0,0,0.3);
		}
		.table-div{
			height:70vh;
			overflow-y: auto;
			box-shadow:0px 0px 5px 5px rgb(242, 242, 242);
		}	
		.sort-by{

		}
		.center-list{
			display:none;
			box-shadow:0 0 1px 1px rgb(242, 242, 242) ;
		}
		.center-list a{
			display:block;
			position: relative;
			text-decoration: none;
			color:black;			
		}
		.sort-by:hover .center-list{
			display:block;
			background:white;
			position:absolute;
			margin-top:5px;
			margin-left:-15px;
			padding:10px;
		}
		.sort-by:hover::after{
			position:absolute;
						
		}

		.filter-icon{
			border:3px solid rgb(242, 242, 242);
			padding:8px;
			border-radius: 20px
		}
		.create{
			border:3px solid rgb(242, 242, 242);
			border-radius: 20px;
			padding:8px;
		}
		.data-buttons{
			padding:10px;
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

#ui-datepicker-div{
	background:white;
	color:black;
	background: white;
    padding: 50px;
    border-radius: 30px;
}
.ui-state-default{
	color:black;
	font-size:20px;
}
.ui-datepicker-prev{
margin:20px;
padding:10px;
background:#e0e0e0;
border-top-left-radius: 20px;
border-bottom-left-radius: 20px;
}
.ui-datepicker-next{
	margin: 20px;
	padding:10px;
	background:#e0e0e0;
border-top-right-radius: 20px;
border-bottom-right-radius: 20px;
}
.ui-datepicker-title{
	text-align: center;
	margin:30px 30px 10px 30px;
}
#down-arrow::after{
		position:relative;
        content: " \2193";
        top: 0px;
        right: 20px;
        height: 10px;
        width: 20px;
}
.ui-datepicker-current-day{
	background:green;
}
.ui-datepicker-today{
	background:skyblue;
}
.ui-datepicker-calendar thead tr{
	background: #80B9FF
}
.ui-datepicker-calendar thead th{
	margin:5px;
}
.ui-datepicker-calendar tbody tr:nth-child(even){
	background: white
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

</style>
</head>
<body>
	<?php
		function dateToDay($date){
			$date = explode("-",$date);
			return date("M d",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
		}
		function dateToDayAndYear($date){
			$date = explode("-",$date);
			return date("M d,Y",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
		}
	?>
<div class="container">
	<div class="d-flex">
		<span class="m-3" style="font-size: 30px;font-weight: bold">Rosters</span>
		<span class="btn sort-by m-3 <?php if($this->session->userdata('UserType') == ADMIN) {echo "ml-auto"; }?>">
			<?php if($this->session->userdata('UserType') == SUPERADMIN){?> 
			<div class="filter-icon row">
				<span class="col">Sort&nbsp;by</span>
				<span class="col"><img src="../assets/images/filter-icon.png" height="20px"></span>
			</div>
		
				<div class="center-list " id="center-list">
						<?php $centers = json_decode($centers);
						
						for($i=0;$i<count($centers->centers);$i++){
					?>
					<a href="javascript:void(0)" class="center-class" id="<?php echo $centers->centers[$i]->centerid ?>"><?php echo $centers->centers[$i]->name?></a>
				<?php } ?>
				</div>	
		</span>
		<?php } ?>
		<?php if($this->session->userdata('UserType') == SUPERADMIN || $this->session->userdata('UserType') == ADMIN ){?>
		<span class="btn ml-auto d-flex align-self-center create"><a href="javascript:void(0)" id="create-new-roster"><span style="margin:0 10px 0 10px"><img src="../assets/images/plus.png" ></span>Create&nbsp;new&nbsp;roster</a></span>
		<?php } ?>
	</div>
	<div class="table-div">
		<table class="table">
			<thead>
				<th>S.No</th>
				<?php if($this->session->userdata('UserType')==SUPERADMIN || $this->session->userdata('UserType')== ADMIN) {?>
				<th>Roster Name</th>
			<?php } ?>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Status</th>
			</thead>
			
			<tbody id="tbody">

				<?php $centerId?>
				<?php $roster = json_decode($rosters);
				for($i=0;$i<count($roster->rosters);$i++){
				?>
				<?php if($this->session->userdata('UserType')==SUPERADMIN || $this->session->userdata('UserType')== ADMIN) {?>
				<tr id="<?php echo $roster->rosters[$i]->id?>">
					<td><?php echo $i+1 ?></td>
					<?php if($this->session->userdata('UserType') == ADMIN ){?>
						<td><?php print_r(json_decode($centers)->centers[0]->name) ?></td>
					<?php } ?>
					<?php if($this->session->userdata('UserType') ==SUPERADMIN ) { ?>
					<td><?php echo 'Roster | '.dateToDay($roster->rosters[$i]->startDate).'-'.dateToDay($roster->rosters[$i]->endDate) ?></td>
				<?php }?>
					<td><?php echo dateToDayAndYear($roster->rosters[$i]->startDate) ?></td>
					<td><?php echo dateToDayAndYear($roster->rosters[$i]->endDate) ?></td>
					<td><?php echo $roster->rosters[$i]->status ?></td>
					</tr>
				<?php }?>
			<?php if($this->session->userdata('UserType') == STAFF ) { ?>
					<tr id="<?php echo $roster->rosters[$i]->id?>">
					<td><?php echo $i+1 ?></td>
					<td><?php echo $roster->rosters[$i]->startDate ?></td>
					<td><?php echo $roster->rosters[$i]->endDate ?></td>
					<td><?php echo $roster->rosters[$i]->status ?></td>
					</tr>
				<?php } ?>
<?php } ?>
			</tbody>
		
		</table>
		
	</div>
	<div>
	
</div>
</div>

<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
   <div class="row" style="background: #307bd3;padding: 0;margin: 0;position: absolute;top:0;width:100%;left:0;padding:10px">
   	<span class="col-10 text-center" style="color:white;font-size:25px">Create New Roster </span>
    <span class="close col-2" style="display:flex;justify-content:flex-end;float:right">&times;</span>
</div>
<div style="position: relative;margin-top:40px ">
 	<form id="create-roster-form"  method="POST" action=<?php echo base_url()."roster/createRoster" ?>>
 		<span id="down-arrow" style="display:flex;justify-content: center;margin:20px"><input  name="roster-date" id="roster-date" autocomplete="off"></span>
 		<input type="text" name="userId" id="userId" style="display:none" value="<?php echo $userId?>">
 		
 		<?php if($this->session->userdata('UserType')==ADMIN) {?><input type="text" name="centerId" id="center-id" value="<?php echo $cents;?>" style="display:none">
 	<?php } ?>
 		<?php if($this->session->userdata('UserType')==SUPERADMIN){ ?><input type="text" name="centerId" id="center-id" value="<?php echo $centerId;?>" style="display:none"><?php } ?>
 		<div class="text-center">
 		<input type="submit" name="roster-submit" id="roster-submit" class="button" value="Create">
 		<input type="reset" name="" id="" class="button" value="Reset">
 	</div>
 	</form>
 </div>
 	<p id="alert-data"></p>
  </div>
</div>




<script type="text/javascript">
	$(document).ready(function(){
		<?php if($this->session->userdata('UserType')==SUPERADMIN){?>
		$(document).on('click','.center-class',function(){
			var id = $(this).prop('id');
			if(id == null || id == ""){
				id=1;
			}
		var url = "http://localhost/PN101/roster/roster_dashboard?center="+id;
		$.ajax({
			url:url,
			type:'GET',
			success:function(response){
				$('#tbody').html($(response).find('#tbody').html());
				document.getElementById('center-id').value = parseInt(id);
			}
		});
	});
	<?php } ?>

		$(document).on('click','tr',function(){
			var rosterId = $(this).prop('id')
	var url = "http://localhost/PN101/roster/getRosterDetails?rosterId="+rosterId;
			window.location.href=url;
		})
})
</script>
<script type="text/javascript">
	<?php if($this->session->userdata('UserType')==SUPERADMIN){?>
	$(document).ready(function(){
			equalElements('sort-by','center-list');
		})
		function equalElements(original,toBeModified){
			var originalHeight = document.getElementsByClassName(original)[0].offsetHeight;
			var originalWidth = document.getElementsByClassName(original)[0].offsetWidth;
			var toBeModifiedWidth =document.getElementById(toBeModified);
			toBeModifiedWidth.style.width = originalWidth+"px";
		}
	<?php } ?>
</script>
<script type="text/javascript">
	var modal = document.getElementById("myModal");

	$(document).on('click','#create-new-roster',function(){
		 modal.style.display = "block";
	})

	$(document).on('click','.close',function(){
		 modal.style.display = "none";
	})

</script>
<script type="text/javascript">
	 $(function() {
	 	
$("#roster-date").datepicker();
	 });
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','#roster-submit',function(e){
			var a = $('#roster-date').val();
			var b = a.split("/");
			var date = new Date(b).getDay();
			if(date != 1){
				var alert = "Please select a monday";
				document.getElementById('alert-data').style.color = "red";
				document.getElementById('alert-data').innerHTML = alert;
				e.preventDefault();
			}

		})
	})
</script>
<script type="text/javascript">
	$(document).ready(()=>{
    $('.container').css('paddingLeft',$('.side-nav').width());
});
</script>
</body>
</html>
<!--<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.center-class',function(){
			var id = $(this).prop('id');
		var url = "http://localhost/PN101/roster/roster_dashboard/"+id;
		$.ajax({
			url:url,
			type:'GET',
			success:function(response){
				$('body').html(response);
				
			}
		}).fail(function(){
			alert('whyys')
		})
	})
		})
</script>-->
