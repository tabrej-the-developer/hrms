<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('header'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Timesheet</title>
	
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<style type="text/css">
	*{
font-family: 'Open Sans', sans-serif;
	}
		.containers{
		background:	rgb(243, 244, 247);
		height: calc(100vh);
	}
		thead{
			background:rgba(0,0,0,0.2);
		}
		tr:nth-child(even){
			background:rgb(255,255,255) !important;
		}
		tr:nth-child(odd){

			background:rgb(243, 244, 247) !important;
		}
		th{
			background: white
		}
		.table  td,.table th{
			padding: 1rem;
			border: none;
		}
		.table-div{
			height:75vh;
			overflow-y: auto;
			padding: 0 20px 0 20px;
		}	
		.sort-by{

		}
/*		.center-list{
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
						
		}*/
		.filter-icon{
			border:1px solid rgba(0,0,0,0.7);
			padding:8px;
			border-radius: 20px
		}
		.create{
			border:3px solid rgb(242, 242, 242);
			border-radius: 20px;
			padding:8px;
			background: rgb(75, 144, 226);
		}
		.create a{
		    color: white !important;
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
  width: 50%;
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
        content: "";
        background: url("<?php echo base_url('/assets/images/calendar.png') ?>");
        background-repeat: no-repeat;
        background-size: 20px;
        padding:10px;
        top: 5px;
        right: 30px;
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
  color: white !important;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 2px
}
	.close{
		float: none; 
	    font-size: inherit; 
	    font-weight: inherit; 
	    line-height: inherit; 
	    color: inherit; 
	    text-shadow: inherit; 
	    opacity: inherit; 
	}
	.close:hover{
		background:#9E9E9E;
	}
.heading-bar{
	padding: 0 20px 0 20px;
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
td{
	cursor: pointer;
}
	select{
	background: #ebebeb !important;
	border-radius: 5px !important;
    padding: 5px !important;
    border: 2px solid #e9e9e9 !important;
		}
	.dataTables_wrapper {
		height:95%;
		overflow-y: hidden;
		background: white;
		box-shadow: 0 0 4px 1px rgba(0,0,0,0.1);

	}
		.dataTables_paginate{
		position: fixed;
		bottom: 0;
		right: 0
	}
	.paginate_button .current{
		background:transparent !important;
		border:none !important;
		border-color: transparent;
	}
	.dataTables_paginate span .paginate_button{
		background:none !important;
		border:none !important;
		border-color: transparent
	}
table.dataTable tbody th, table.dataTable tbody td{
	padding:1rem;
	border-bottom: none;
}
table.dataTable thead th, table.dataTable thead td {
    padding: 1rem;
    border-bottom: none;
}
table.dataTable.no-footer{
	border-bottom: none
}
table.dataTable{
	margin-top: 0 !important;
	margin-bottom: 0 !important;
}
@media only screen and (max-width:600px){
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}
.table-div{
	padding:0;
}

}
</style>
</head>
<body>
	<?php
		function dateToDayAndYear($date){
			$date = explode("-",$date);
			return date("M d,Y",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
		}
	?>
<div class="containers">
	<div class="d-flex heading-bar">
		<span class="m-3" style="font-size: 1.75rem;font-weight: bold">Timesheet</span>
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
					<option href="javascript:void(0)" class="center-class" id="<?php echo $centers->centers[$i]->centerid ?>" value="<?php echo $centers->centers[$i]->centerid; ?>"><?php echo $centers->centers[$i]->name?></option>
				<?php } ?>
				</select>	
		</span>
		<?php } ?>
		<?php if($this->session->userdata('UserType') == SUPERADMIN || $this->session->userdata('UserType') == ADMIN ){?>
		<span class="btn ml-auto d-flex align-self-center create">
			<a href="javascript:void(0)" id="create-new-timesheet" class="d-flex">
				<span style="margin:0 10px 0 10px">
					<img src="../assets/images/plus.png" >
				</span>Create&nbsp;new&nbsp;Timesheet</a>
			</span>
		<?php } ?>
	</div>
	<div class="table-div">
		<table class="table">
			<thead>
				<th>S.No</th>
				<?php if($this->session->userdata('UserType')==SUPERADMIN || $this->session->userdata('UserType')== ADMIN) {?>
				<th>Timesheet Name</th>
				<th>Edit Y/N</th>
			<?php } ?>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Status</th>
			</thead>
			
			<tbody id="tbody">

				<?php $centerId;
				if(isset($timesheets)){
				 $timesheet = json_decode($timesheets);
				for($i=0;$i<count($timesheet->timesheets);$i++){
				?>
				<?php if($this->session->userdata('UserType')==SUPERADMIN || $this->session->userdata('UserType')== ADMIN) {?>
				<tr id="<?php echo $timesheet->timesheets[$i]->id?>">
					<td><?php echo $i+1 ?></td>
					<?php if($this->session->userdata('UserType') == ADMIN ){?>
						<td><?php print_r(json_decode($centers)->centers[0]->name) ?></td>
					<?php } ?>
					<?php if($this->session->userdata('UserType') ==SUPERADMIN ) { ?>
					<td><?php echo $centers->centers[$id]->name ?></td>
					<td><?php echo $timesheet->timesheets[$i]->isEditYN ?></td>
				<?php }?>
					<td><?php echo dateToDayAndYear($timesheet->timesheets[$i]->startDate) ?></td>
					<td><?php echo dateToDayAndYear($timesheet->timesheets[$i]->endDate) ?></td>
					<td><?php echo $timesheet->timesheets[$i]->status ?></td>
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
<?php }} ?>
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
   	<span class="col-12 text-center" style="color:white;font-size:25px">Create New Timesheet </span>

</div>
<div style="position: relative;margin-top:40px ">
 	<form id="create-timesheet-form"  method="POST" action=<?php echo base_url()."timesheet/createTimesheet" ?>>
 		<span id="down-arrow" class="row" style="display:flex;justify-content: center;margin:20px">
 			
 			<input class="col-4" name="timesheet-date" id="timesheet-date" autocomplete="off" placeholder="Start Date"></span>
 		<input type="text " name="userId" id="userId" style="display:none" value="<?php echo $userId?>">
 		
 		<?php if($this->session->userdata('UserType')==ADMIN) {?><input type="text" name="centerId" id="center-id" value="<?php echo $cents;?>" style="display:none">
 	<?php } ?>
 		<?php if($this->session->userdata('UserType')==SUPERADMIN){ ?><input type="text" name="centerId" id="center-id" value="<?php echo $centerId;?>" style="display:none"><?php } ?>
 		<div class="text-center">
 		<input type="submit" name="timesheet-submit" id="timesheet-submit" class="button" value="Create">
 		<input type="reset" name="" id="" class="button" value="Reset">
 		<input type="button" name="cancel" value="Cancel" class="close button">
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
		var url = "<?php echo base_url();?>timesheet/timesheetDashboard?center="+val;
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
	var url = "<?php echo base_url();?>timesheet/gettimesheetDetails?timesheetId="+timesheetId;
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
    $('.containers').css('paddingLeft',$('.side-nav').width());
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
	  $(document).ready( function () {
		    $('table').dataTable({
		     pageLength:7,
		     ordering : false,
		     select: false,
		     searching : false
		    });
		} );
</script>
<script type="text/javascript">
	$(document).ready(function(){
			$('.dataTables_length').remove()
			$('.dataTables_info').remove()
			$('#ui-datepicker-div').hide()
	})
</script>
</body>
</html>
<!--<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.center-class',function(){
			var id = $(this).prop('id');
		var url = "http://localhost/PN101/timesheet/timesheet_dashboard/"+id;
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