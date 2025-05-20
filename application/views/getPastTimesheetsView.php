<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Timesheet</title>
	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">

<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<style>
.navbar-nav .nav-item-header:nth-of-type(3) {
    background: var(--blue2) !important;
    position: relative;
}
.navbar-nav .nav-item-header:nth-of-type(3)::after {
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
		function dateToDayAndYear($date){
			$date = explode("-",$date);
			return date("M d,Y",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
		}
		function dateToDay($date){
			$date = explode("-",$date);
			return date("M d",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
		}

		?>
		<div class="containers scrollY">			
			<div class="timesheetContainer">
				<div class="d-flex pageHead heading-bar">
					<span class="events_title">Timesheet</span>
					<span class="sort-by rightHeader">
						<?php if((isset($permissions->permissions) ? $permissions->permissions->editTimesheetYN : "N") == "Y"){ ?> 
						<!-- <div class="filter-icon row">
							<span class="col">Sort&nbsp;by</span>
							<span class="col"><img src="../assets/images/filter-icon.png" height="20px"></span>
						</div> -->
							<select class="center-list " id="center-list">
									<?php $centers = json_decode($centers);
									
									for($i=0;$i<count($centers->centers);$i++){
										if($centers->centers[$i]->centerid == $center__){
								?>
								<option href="javascript:void(0)" 
												class="center-class" 
												id="<?php echo $centers->centers[$i]->centerid ?>" 
												value="<?php echo $centers->centers[$i]->centerid; ?>" selected>
													<?php echo $centers->centers[$i]->name?></option>
							<?php }
							else{ ?>
								<option href="javascript:void(0)" 
												class="center-class" 
												id="<?php echo $centers->centers[$i]->centerid ?>" 
												value="<?php echo $centers->centers[$i]->centerid; ?>">
												<?php echo $centers->centers[$i]->name?>
								</option>
							<?php		}
								} ?>
							</select>	
						<?php } ?>
						<?php if((isset($permissions->permissions) ? $permissions->permissions->editTimesheetYN : "N") == "Y"){ ?> 
							<a href="javascript:void(0)" id="create-new-timesheet" class="btn btn-default btn-small btnOrange pull-right">
								<span class="material-icons-outlined">add</span>Create New Timesheet
							</a>
						<?php } ?>
					</span>
					
				</div>
				<div class="table-div pageTableDiv">
					<table class="table">
						<thead>
							<th>S.No</th>
							<th>Timesheet Name</th>
							<!-- <th>Edit Y/N</th> -->
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
								<?php if((isset($permissions->permissions) ? $permissions->permissions->editTimesheetYN : "N") == "Y"){ ?> 
								<tr id="<?php echo $timesheet->timesheets[$i]->id?>" clickable="yes">
									<td><?php echo $i+1 ?></td>

									<td><?php echo  'Timesheet | '.dateToDay($timesheet->timesheets[$i]->startDate).'-'.dateToDay($timesheet->timesheets[$i]->endDate) ?></td>
									<!-- <td><?php // echo $timesheet->timesheets[$i]->isEditYN ?></td> -->

									<td><?php echo dateToDayAndYear($timesheet->timesheets[$i]->startDate) ?></td>
									<td><?php echo dateToDayAndYear($timesheet->timesheets[$i]->endDate) ?></td>
									<td style="text-align:center;"><?php echo $timesheet->timesheets[$i]->status ?></td>
								</tr>
								<?php }?>
							<?php if((isset($permissions->permissions) ? $permissions->permissions->editTimesheetYN : "N") == "N"){ ?>
								<tr id="<?php echo $timesheet->timesheets[$i]->id?>" clickable="yes">
									<td><?php echo $i+1 ?></td>
									<td><?php echo  'Timesheet | '.dateToDay($timesheet->timesheets[$i]->startDate).'-'.dateToDay($timesheet->timesheets[$i]->endDate) ?></td>
									<td><?php echo dateToDayAndYear($timesheet->timesheets[$i]->startDate) ?></td>
									<td><?php echo dateToDayAndYear($timesheet->timesheets[$i]->endDate) ?></td>
									<td style="text-align:center;"><?php echo $timesheet->timesheets[$i]->status ?></td>
								</tr>
								<?php } ?>
							<?php }} ?>
						</tbody>
			
					</table>
			
				</div>
			</div>
		<div>
	
</div>

<div id="myModal" class="modal modalNew">
  	<!-- Modal content -->
	<div class="modal-dialog mw-40">
		<div class="modal-content NewFormDesign">
			<div class="modal-header " >
				<h3 class="modal-title ">Create New Timesheet </span>
			</div>
			<div class="modal-body container">
				<form id="create-timesheet-form" method="POST" action=<?php echo base_url()."timesheet/createTimesheet" ?>>
					<div class="col-md-12">
						<div class="form-floating">
							<input class="form-control" name="timesheet-date" id="timesheet-date" autocomplete="off" placeholder="dd-mm-yyyy" type="date">
							<label for="roster-date">Start Date</label>
						</div>
					</div>
					<span id="down-arrow" class="row" > 			
					</span>
					<input type="text " name="userId" id="userId" style="display:none" value="<?php echo $userId?>">
					<input type="text" name="centerId" id="center-id" value="<?php echo $center__;?>" style="display:none">
					<div class="modal-footer">
						<input type="button" name="timesheet-submit" id="timesheet-submit" class="button btn btn-default btn-small btnOrange" value="Create">
						<input type="reset" name="" id="" class="button btn btn-default btn-small btnBlue" value="Reset">
						<input type="button" name="cancel" value="Cancel" class="close button  btn btn-default btn-small">
					</div>
				</form>

			</div>
			<center><p id="alert-data"></p></center>
		</div>
	</div>
</div>


<div class="modal-logout">
    <div class="modal-content-logout">
        <h3>You have been logged out!!</h3>
        <h4><a class="btn btn-default btnOrange" href="<?php echo base_url(); ?>">Click here</a> to login</h4>
        
    </div>
</div>



<script type="text/javascript">
	$(document).ready(function(){
	<?php if((isset($permissions->permissions) ? $permissions->permissions->editTimesheetYN : "N") == "Y"){ ?> 
		$(document).on('change','.center-list',function(){
			var val = $(this).val();
			if(val == null || val == ""){
				var url = "<?php echo base_url();?>timesheet/timesheetDashboard";
			}else{
				var url = "<?php echo base_url();?>timesheet/timesheetDashboard?center="+val;
			}

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

		$(document).on('click','#tbody tr[clickable="yes"]',function(){
			var timesheetId = $(this).prop('id')
	var url = "<?php echo base_url();?>timesheet/gettimesheetDetails?timesheetId="+timesheetId;
			window.location.href=url;
		})
})
</script>
<script type="text/javascript">
<?php if((isset($permissions->permissions) ? $permissions->permissions->editTimesheetYN : "N") == "Y"){ ?> 
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
	$(document).ready(function(){
		function timeSheetSubmit(){
			var xdeviceid = '<?php echo $this->session->userdata('x-device-id'); ?>';
			var xtoken = '<?php echo $this->session->userdata('AuthToken'); ?>';
			var fullurl = '<?php echo base_url('api/timesheet/createTimesheet'); ?>';
			var startdate = $('#timesheet-date').val();
			var userid = $('#userId').val();
			var centerid = $('#center-id').val();
			if(startdate == "" || userid == "" || centerid == ""){
				alert("Start Date/UserId/Centerid is empty");
			}else{
				$.ajax({
					url:fullurl,
					type:'POST',
					headers: {
						"x-device-id":xdeviceid,
						"x-token":xtoken
					},
					data:JSON.stringify({
						"startDate":startdate,
						"centerid":centerid,
						"userid":userid
					}),
					beforeSend:function(){
						$('#timesheet-submit').val('Creating...');
					},
					success:function(result,status,xhr){
						$('#timesheet-submit').val('Create');
						// console.log(result);
						var da = jQuery.parseJSON(result);
						// console.log(da);
						if(da.Status == "SUCCESS"){
							document.getElementById('alert-data').style.color = "green";
							document.getElementById('alert-data').innerHTML = "Timesheet Created";
							location.reload();
						}else if(da.Status == "ERROR"){
							document.getElementById('alert-data').style.color = "red";
							document.getElementById('alert-data').innerHTML = da.Message;
						}
					}
				});
			}
		}

		$(document).on('click','#timesheet-submit',function(e){
			var a = $('#timesheet-date').val();
			var b = a.split("/");
			var date = new Date(b).getDay();
			if(date != 1){
				var alert = "Please select a monday";
				document.getElementById('alert-data').style.color = "red";
				document.getElementById('alert-data').innerHTML = alert;
				e.preventDefault();
			}else{
				timeSheetSubmit();
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

<!-- 
<script type="text/javascript">
	  $(document).ready( function () {
		    $('.table').DataTable({
		     pageLength:7,
		     ordering : false,
		     select: false,
		     searching : false
		    });
		} );
</script>
 -->
<script type="text/javascript">
	$(document).ready(function(){
		$('.dataTables_length').remove()
		$('.dataTables_info').remove()
		$('#ui-datepicker-div').remove()
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