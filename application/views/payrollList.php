<!DOCTYPE html>
<html>
<head>
	<title>Payroll</title>
	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">

<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<style>
.navbar-nav .nav-item-header:nth-of-type(4) {
    background: var(--blue2) !important;
    position: relative;
}
.navbar-nav .nav-item-header:nth-of-type(4)::after {
    position: absolute;
    right: 0;
    top: 0;
    height: 100%;
    width: 3px;
    bottom: 0;
    content: "";
    background: var(--orange1);
}
</style>
</head>
<body>
	
<div class="wrapperContainer">
  <?php include 'headerNew.php'; ?>
	<?php
		$permissions = json_decode($permissions);
		function dateToDay($date){
			$date = explode("-",$date);
			return date("M d",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
		}
		function dateToDayAndYear($date){
			$date = explode("-",$date);
			return date("M d, Y",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
		}
	?>
		<div class="containers scrollY">
			<div class="payrollContainer">
				<div class="d-flex pageHead heading-bar">
					<span class="events_title" >Payrolls</span>
					<span class="sort-by rightHeader">
						<?php if ((isset($permissions->permissions) ? $permissions->permissions->editPayrollYN : "N") == "Y") { ?> 
						<!--<div class="filter-icon row">
							<span class="col">Sort&nbsp;by</span>
							<span class="col"><img src="../assets/images/filter-icon.png" height="20px"></span>
						</div> -->
		
							<select class="center-list " id="center-list">
								<?php $centers = json_decode($centers);
								
								for($i=0;$i<count($centers->centers);$i++){
									if($centers->centers[$i]->centerid == $id){ ?>
										<option selected href="javascript:void(0)" 
											class="center-class" 
											id="<?php echo $centers->centers[$i]->centerid ?>" 
											value="<?php echo $centers->centers[$i]->centerid; ?>" >
												<?php echo $centers->centers[$i]->name?></option>
									<?php } else{ ?>
										<option href="javascript:void(0)" 
											class="center-class" 
											id="<?php echo $centers->centers[$i]->centerid ?>" 
											value="<?php echo $centers->centers[$i]->centerid; ?>">
											<?php echo $centers->centers[$i]->name?>
										</option>
									<?php	}
								} ?>
							</select>
						<?php } ?>
					</span>
				</div>
				<div class="table-div pageTableDiv">
					<table class="table">
						<thead>
							<th>S.No</th>
							<th>Payroll Name</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Status</th>
						</thead>
			
						<tbody id="tbody">

							<?php 
							$centerId; 
							if(isset($payrolls)){
								$payroll = json_decode($payrolls);
								$payrollCount = 1;
								for($i=0;$i<count($payroll->timesheets);$i++){
								?>
								<?php if( $payroll->timesheets[$i]->status == 'Published'){ ?>
								<tr id="<?php echo $payroll->timesheets[$i]->id?>">
									<td><?php echo $payrollCount;$payrollCount++; ?></td>
									<td><?php echo 'Payroll | '.dateToDay($payroll->timesheets[$i]->startDate).'-'.dateToDay($payroll->timesheets[$i]->endDate) ?></td>
									<td><?php echo dateToDayAndYear($payroll->timesheets[$i]->startDate) ?></td>
									<td><?php echo dateToDayAndYear($payroll->timesheets[$i]->endDate) ?></td>
									<td class="text-center"><?php echo $payroll->timesheets[$i]->payrollStatus ?></td>
									</tr>
								<?php }
								} 
							} ?>
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
 		<?php if((isset($permissions->permissions) ? $permissions->permissions->editPayrollYN : "N") == "Y"){ ?>
			<input type="text" name="centerId" id="center-id" value="<?php echo $centerId;?>" style="display:none">
	<?php } ?>
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
		<?php if((isset($permissions->permissions) ? $permissions->permissions->editPayrollYN : "N") == "Y"){ ?>
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

	<?php if((isset($permissions->permissions) ? $permissions->permissions->editPayrollYN : "N") == "Y"){ ?>
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

	var modal = document.getElementById("myModal");

	$(document).on('click','#create-new-timesheet',function(){
		 modal.style.display = "block";
	})

	$(document).on('click','.close',function(){
		 modal.style.display = "none";
	})


	 $(function() {
		$("#timesheet-date").datepicker();
	 });

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
<script type="text/javascript">
	  $(document).ready( function () {
		    $('table').dataTable({
		     pageLength:7,
		     ordering : false,
		     select: false,
		     searching : false
		    });
		} );

	$(document).ready(function(){
			$('.dataTables_length').remove()
			$('.dataTables_info').remove()
			$('#ui-datepicker-div').hide()
			$('.table-div').css('maxWidth','100vw')
		})
</script>
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
		})
	})
		})
</script>-->