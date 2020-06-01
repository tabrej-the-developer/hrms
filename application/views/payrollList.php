<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('header'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Timesheet</title>
	
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
	*{
		font-family: 'Open Sans', sans-serif;
	}
		thead tr{
			background:rgba(255,255,255,1) !important;
		}
		tr:nth-child(even){
			background:rgb(255,255,255);
		}
		tr:nth-child(odd){

			background:rgb(243, 244, 247);
		}
		.table-div{
			height:70vh;
			overflow-y: auto;
			padding: 0 20px;
		}	
		.table  td,.table th{
			padding: 1rem;
			border: none;
		}
		.sort-by{

		}
		table{
			box-shadow: 0 0 20px 2px #eeeff2;
		}
		

		.filter-icon{
			border:1px solid rgba(0,0,0,0.7);
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
.dataTables_info{
	font-size:0.8rem;
}
.dataTables_paginate{
	font-size:0.8rem;
}
.paginate_button{
	background:transparent;
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
        z-index:150;
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
@media only screen and (max-width:1024px) {
.modal-content{
	min-width:100vw;
}
.containers {
     width: 100%;
    margin: 0px;
    padding:0;
}
.containers {
     width: 100%;
    margin: 0px;
    padding:0;
}
}
</style>
</head>
<body>
	<?php
		function dateToDay($date){
			$date = explode("-",$date);
			return date("M d",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
		}
	?>
<div class="containers">
	<div class="d-flex">
		<span class="m-3" style="font-size: 2rem;font-weight: bold">Payrolls</span>
		<span class="btn sort-by m-3 <?php if($this->session->userdata('UserType') == ADMIN) {echo "ml-auto"; }?>">
			<?php if($this->session->userdata('UserType') == SUPERADMIN){?> 
<!-- 			<div class="filter-icon row">
				<span class="col">Sort&nbsp;by</span>
				<span class="col"><img src="../assets/images/filter-icon.png" height="20px"></span>
			</div> -->
		
				<select class="center-list " id="center-list">
						<?php $centers = json_decode($centers);
						
						for($i=0;$i<count($centers->centers);$i++){
					?>
					<option href="javascript:void(0)" class="center-class" id="<?php echo $centers->centers[$i]->centerid ?>" value="<?php echo $centers->centers[$i]->centerid ?>">
						<?php echo $centers->centers[$i]->name?>
					</option>
				<?php } ?>
				</select>	
		</span>
		<?php } ?>
		<?php if($this->session->userdata('UserType') == SUPERADMIN || $this->session->userdata('UserType') == ADMIN ){?>
		
		<?php } ?>
	</div>
	<div class="table-div">
		<table class="table">
			<thead>
				<th>S.No</th>
				<?php if($this->session->userdata('UserType')==SUPERADMIN || $this->session->userdata('UserType')== ADMIN) {?>
				<th>Payroll Name</th>
			<?php } ?>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Status</th>
			</thead>
			
			<tbody id="tbody">

				<?php 
				$centerId; 
				if(isset($payrolls)){
				$payroll = json_decode($payrolls);
				for($i=0;$i<count($payroll->timesheets);$i++){
				?>
				<?php if($this->session->userdata('UserType')==SUPERADMIN || $this->session->userdata('UserType')== ADMIN) {?>
				<tr id="<?php echo $payroll->timesheets[$i]->id?>">
					<td><?php echo $i+1 ?></td>
					<?php if($this->session->userdata('UserType') == ADMIN ){?>
						<td><?php print_r(json_decode($centers)->centers[0]->name) ?></td>
					<?php } ?>
					<?php if($this->session->userdata('UserType') ==SUPERADMIN ) { ?>
					<td><?php echo 'Payroll | '.dateToDay($payroll->timesheets[$i]->startDate).'-'.dateToDay($payroll->timesheets[$i]->endDate) ?></td>
				<?php }?>
					<td><?php echo $payroll->timesheets[$i]->startDate ?></td>
					<td><?php echo $payroll->timesheets[$i]->endDate ?></td>
					<td><?php echo $payroll->timesheets[$i]->status ?></td>
					</tr>
				<?php }?>
			<?php if($this->session->userdata('UserType') == STAFF ) { ?>
					<tr id="<?php echo $timesheet->timesheets[$i]->id?>">
					<td><?php echo $i+1 ?></td>
					<td><?php echo $timesheet->timesheets[$i]->startDate ?></td>
					<td><?php echo $timesheet->timesheets[$i]->endDate ?></td>
					<td><?php echo $timesheet->timesheets[$i]->status ?></td>
					</tr>
				<?php } ?>
<?php } } ?>
			</tbody>
		
		</table>
		
	</div>
	<div>
	
</div>
</div>

<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">

<div style="position: relative;margin-top:40px ">
 	<form id="create-timesheet-form"  method="POST" action=<?php echo base_url()."timesheet/createTimesheet" ?>>
 		<span id="down-arrow" style="display:flex;justify-content: center;margin:20px"><input  name="timesheet-date" id="timesheet-date" autocomplete="off"></span>
 		<input type="text" name="userId" id="userId" style="display:none" value="<?php echo $userId?>">
 		
 		<?php if($this->session->userdata('UserType')==ADMIN) {?><input type="text" name="centerId" id="center-id" value="<?php echo $cents;?>" style="display:none">
 	<?php } ?>
 		<?php if($this->session->userdata('UserType')==SUPERADMIN){ ?><input type="text" name="centerId" id="center-id" value="<?php echo $centerId;?>" style="display:none"><?php } ?>
 		<div class="text-center">
 		<input type="submit" name="timesheet-submit" id="timesheet-submit" class="button" value="Create">
 		<input type="reset" name="" id="" class="button" value="Reset">
 	</div>
 	</form>
 </div>
 	<p id="alert-data"></p>
  </div>
</div>

<div class="modal-logout">
    <div class="modal-content-logout">
        <h3>You have been logged out!!</h3>
        <h4><a href="<?php echo base_url(); ?>">Click here</a> to login</h4>
    </div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		<?php if($this->session->userdata('UserType')==SUPERADMIN){?>
		$(document).on('change','.center-list',function(){
			var val = $(this).val();
			if(val == null || val == ""){
				val=1;
			}
		var url = "<?php echo base_url();?>payroll/payrollList?center="+val;
		$.ajax({
			url:url,
			type:'GET',
			success:function(response){
				$('#tbody').html($(response).find('#tbody').html());
				document.getElementById('center-id').value = parseInt(val);
			}
		});
	});
	<?php } ?>

		$(document).on('click','#tbody tr',function(){
			var timesheetId = $(this).prop('id')
	var url = "<?php echo base_url();?>payroll/payrollShifts?timesheetId="+timesheetId;
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

	$(document).on('click','#create-new-timesheet',function(){
		 modal.style.display = "block";
	})

	$(document).on('click','.close',function(){
		 modal.style.display = "none";
	})

</script>
<script type="text/javascript">
	 $(function() {
	 	
$("#timesheet-date").datepicker();
	 });
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','#timesheet-submit',function(e){
			var a = $('#timesheet-date').val();
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
		if($(document).width() > 1024){
		    $('.containers').css('paddingLeft',$('.side-nav').width());
		}
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

</body>
</html>
<!--<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.center-class',function(){
			var id = $(this).prop('id');
		var url = "<?php echo base_url();?>timesheet/timesheet_dashboard/"+id;
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