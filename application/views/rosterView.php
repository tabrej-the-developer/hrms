<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Roster</title>
<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">

<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<style>
.navbar-nav .nav-item-header:nth-of-type(2) {
    background: var(--blue2) !important;
    position: relative;
}
.navbar-nav .nav-item-header:nth-of-type(2)::after {
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
		<div class="rosterContainer ">
			<?php $permissions = json_decode($permissions); ?>
				<div class="d-flex pageHead heading-bar">
					<span class="events_title" id="roster-heading">Rosters</span>
					<span class=" sort-by rightHeader">
					<?php // if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?> 
					<!-- 			<div class="filter-icon d-flex">
									<span class="">Sort&nbsp;by</span>
									<span class=""><img src="../assets/images/filter-icon.png" height="20px"></span>
								</div> -->
						<select class="center-list " id="center-list">
							<?php $centers = json_decode($centers);
							
							for($i=0;$i<count($centers->centers);$i++){
								if($_SESSION['centerr'] == $centers->centers[$i]->centerid){
							?>
							<option href="javascript:void(0)" class="center-class" id="<?php echo $centers->centers[$i]->centerid ?>" value="<?php echo $centers->centers[$i]->centerid; ?>" selected><?php echo $centers->centers[$i]->name?></option>
							<?php }else{ ?>
							<option href="javascript:void(0)" class="center-class" id="<?php echo $centers->centers[$i]->centerid ?>" value="<?php echo $centers->centers[$i]->centerid; ?>"><?php echo $centers->centers[$i]->name?></option>
							<?php }}  ?>
						</select>
					<?php // } ?>

					<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?>
						<a href="javascript:void(0)" id="create-new-roster" class="d-flex btn btn-default btn-small btnOrange pull-right">
							<span class="material-icons-outlined">add</span>
							Create&nbsp;New&nbsp;Roster
						</a>
						<a href="javascript:void(0)" id="create-Template" class="d-flex btn btn-default btn-small btnBlue pull-right">
							<span class="material-icons-outlined">add</span>
							Create&nbsp;Roster&nbsp;Template
						</a>

					<?php } ?>
				</div>
				<div class="table-div pageTableDiv">
					<table class="table">
						<thead>
							<tr class="rowHead">
								<th>S.No</th>
								<th>Roster Name</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Status</th>
							</tr>
						</thead>
						
						<tbody id="tbody">

							<?php 
							$centerId;
							if(isset($rosters)){
							$roster = json_decode($rosters);
							for($i=0;$i<count($roster->rosters);$i++){
							?>
							<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?>
							<tr id="<?php echo $roster->rosters[$i]->id?>" clickable="yes">
								<td><?php echo $i+1 ?></td>
								<td><?php echo 'Roster | '.dateToDay($roster->rosters[$i]->startDate).'-'.dateToDay($roster->rosters[$i]->endDate) ?></td>
								<td><?php echo dateToDayAndYear($roster->rosters[$i]->startDate) ?></td>
								<td><?php echo dateToDayAndYear($roster->rosters[$i]->endDate) ?></td>
								<td><?php echo $roster->rosters[$i]->status ?></td>
							</tr>
							<?php }?>
							<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "N"){ ?>
								<tr id="<?php echo $roster->rosters[$i]->id?>" clickable="yes">
								<td><?php echo $i+1 ?></td>
								<td><?php echo 'Roster | '.dateToDay($roster->rosters[$i]->startDate).'-'.dateToDay($roster->rosters[$i]->endDate) ?></td>
								<td><?php echo $roster->rosters[$i]->startDate ?></td>
								<td><?php echo $roster->rosters[$i]->endDate ?></td>
								<td><?php echo $roster->rosters[$i]->status ?></td>
								</tr>
							<?php } ?>
							<?php } } ?>
						</tbody>
					
					</table>
				
				</div>
			</div>
		</div>
	</div>
</div>
	

<div id="myModal" class="modal modalNew">
<div class="modal-dialog mw-40">
	<div class="modal-content NewFormDesign">
		<div class="modal-header " >
			<h3 class="modal-title ">Create New Roster </h3>
		</div>
		<div class="modal-body container">
			<form id="create-roster-form"  method="POST" action=<?php echo base_url("roster/createRoster") ?>>
				<div class="col-md-12">
					<div class="form-floating">
						<input id="roster-date" type="date" name="roster-date" class="form-control" placeholder="dd-mm-yyyy" required />
						<label for="roster-date">Roster Date</label>
					</div> 
				</div>
				<?php 
					$rosterTemplates = json_decode($rosterTemplates);
				?>
					<?php if(count($rosterTemplates->templates) > 0){ ?>
							<div class="col-md-12">
								
							<div class="form-floating">
								<select class="template-list form-control" id="template-list" name="template-list">
									<option value="not_selected">Select Template</option>
									<?php
										for($i=0;$i<count($rosterTemplates->templates);$i++){
									?>
									<option href="javascript:void(0)" class="center-class" id="<?php echo $rosterTemplates->templates[$i]->id ?>" value="<?php echo $rosterTemplates->templates[$i]->id; ?>"><?php echo $rosterTemplates->templates[$i]->name?></option>
								<?php } ?>
								</select>
								<label for="template-list">Select Template</label>
							</div> 
							</div>
					<?php } ?>
				<input type="text" name="userId" id="userId" style="display:none" value="<?php echo $userId?>">
				<input type="text" name="centerId" id="center-id" value="<?php echo $center__;?>" style="display:none">

				<div class="modal-footer">
					<input type="submit" name="roster-submit" id="roster-submit" class="button btn btn-default btn-small btnOrange" value="Create">
					<input type="reset" name="" id="" class="button btn btn-default btn-small btnBlue" value="Reset">
					<input type="button" name="cancel" value="Cancel" class="close button  btn btn-default btn-small">	
				</div>
			</form>
 		<p id="alert-data"></p>
		</div>
  	</div>
</div>
</div>

<div id="mxModal" class="templateModal modalNew">
<div class="modal-dialog mw-75">
  <!-- Modal content -->
  	<div class="template-modal-content modal-content NewFormDesign">
		<div class="modal-header" >
			<h3 class="modal-title">Create Roster Template </h3>
		</div>
		<div class="modal-body container">
			<form id="createTemplate"  method="POST" action=<?php echo base_url("roster/createRosterTemplate") ?>>

			
				<div class="col-md-12">
					<div class="form-floating">
						<input type = "text" placeholder = "Roster Name" class="form-control" name="roster-name" id="roster-name">
						<label for="roster-name">Roster Name</label>
					</div> 
				</div>

				<input type="text" name="userId" id="templateUserId" style="display:none" value="<?php echo $userId?>">
				<input type="text" name="centerId" id="template-center-id" value="<?php echo $center__;?>" style="display:none">
				<div class="modal-footer">
					<input type="submit" name="roster-submit" id="roster-template-submit" class="button btn btn-default btn-small btnOrange" value="Create">
					<input type="reset"  class="button btn btn-default btn-small btnBlue" value="Reset">
					<input type="button" name="cancel" value="Cancel" class="close button btn btn-default btn-small">
				</div>
			</form>
			<div class="rosterTemplateTable">
				<table class="template_table">
					<thead>
						<tr class="template_header_row">
							<th class="template_header_first_child">Template Name</th>
							<!-- <th class="template_header_second_child">Edit</th> -->
							<th class="template_header_third_child">Delete</th>
						</tr>
					</thead>
					<tbody class="template_tbody">
						<?php foreach($rosterTemplates->templates as $templates){ ?>
							<tr class="template_row">
								<td class="template_td_name"><a href="<?php echo base_url('roster/getRosterTemplateDetails/').$templates->id.'/'.$this->session->userdata("LoginId") ?>" class="template_name"><?php echo $templates->name ?></a></td>
								<!-- <td class="template_td_edit">Edit</td> -->
								<td class="template_td_delete roster_template_style" id='<?php echo $templates->id ?>'>
									<span class="material-icons-outlined">delete</span>
								</td>
							</tr>
						<?php 	}  ?>
					</tbody>
				</table>
			</div>
		</div>
		<p id="alert-data"></p>
  	</div>
</div>
</div>

<div class="notify_">
	<div class="note">
		<div class="notify_body">
			<span class="_notify_message">
			
			</span>
			<span class="_notify_close" onclick="closeNotification()">
			&times;
			</span>
  		</div>
	</div>
</div>

<div class="modal-logout">
    <div class="modal-content-logout">
        <h3>You have been logged out!!</h3>
        <h4><a class="btn btn-default btnOrange" href="<?php echo base_url(); ?>">Click here</a> to login</h4>
        
    </div>
</div>


<div class="loading">
	<div class="loader"></div>
</div>

<script type="text/javascript">
	/*		---------------
						This code contains the session storage
				---------------   */
	// localStorage.setItem('currentCenter',2)
	// currentCenter();
	// 			document.getElementsByClassName('center-list')[0].value=2;
	// function currentCenter() {
	// 	// if(typeof(Storage) != undefined){
	// 	// 	let val = localStorage.getItem('currentCenter');
	// 	var url = "<?php // echo base_url();?>roster/roster_dashboard?center="+parseInt(val);
	// 	$.ajax({
	// 		url:url,
	// 		type:'GET',
	// 		success:function(response){
	// 			remove_loader_icon();
	// 			$('#tbody').html($(response).find('#tbody').html());
	// 			document.getElementById('center-id').value = parseInt(val);
	// 		}
	// 	});
	// }
// }

// Notification //
    function showNotification(){
      $('.notify_').css('visibility','visible');
    }
    function addMessageToNotification(message){
    	if($('.notify_').css('visibility') == 'hidden'){
     		$('._notify_message').append(`<li>${message}</li>`)
      }
    }
    function closeNotification(){
      $('.notify_').css('visibility','hidden');
      $('._notify_message').empty();
    }

<?php  if(($this->session->flashdata('errorMessage') != null) && ($this->session->flashdata('errorMessage') != "") ){ ?>
	addMessageToNotification('<?php echo $this->session->flashdata('errorMessage') ?>');
      showNotification();
      setTimeout(closeNotification,5000)
    <?php  } ?>
  // Notification //

	$(document).ready(function(){
		$(document).on('change','.center-list',function(){
			
			var val = $(this).val();
			if(val == null || val == ""){
				val=1;
			}
		var url = "<?php echo base_url();?>roster/roster_dashboard?center="+val;

				loader_icon();
		$.ajax({
			url:url,
			type:'GET',
			success:function(response){
				remove_loader_icon();
				$('#tbody').html($(response).find('#tbody').html());
				document.getElementById('center-id').value = parseInt(val);
				document.getElementById('template-center-id').value = parseInt(val);
						var url_template = "<?php echo base_url();?>roster/getTemplates/"+val;
				$.ajax({
					url : url_template,
					type : 'GET',
					success : function(response){
						$('#template-list').empty();
						$('.template_tbody').empty();
						var resp = JSON.parse(response);
						var co = `<option value="not_selected">Select Template</option>`;
						$('#template-list').append(co)
						resp.templates.forEach(function(item){
						var code = `<option href="javascript:void(0)" class="center-class" id="${item.id}" value="${item.id}">${item.name}</option>`;
						var tableCode = `<tr class="template_row"><td class="template_td_name"><a href="<?php echo base_url("roster/getRosterTemplateDetails/"); ?>${item.id}<?php echo '/'.$this->session->userdata("LoginId") ?>">${item.name}</a></td><td class="template_td_edit">Edit</td><td class="template_td_delete roster_template_style" id='${item.id}'><i><img src="<?php echo base_url("assets/images/icons/x.png") ?>" style="max-height:0.8rem;margin-right:10px"> </i></td></tr>`;
						$('.template_tbody').eq(0).append(tableCode);
						$('#template-list').append(code);
						})
					}
				})
			}
		});
	});

		$(document).on('click','#tbody tr[clickable="yes"]',function(){
			var rosterId = $(this).prop('id');
			var url = "<?php echo base_url();?>roster/getRosterDetails?rosterId="+rosterId+'&showBudgetYN=N';
			window.location.href=url;
		})
})
</script>
<script type="text/javascript">
	<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?>
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

	var mod = document.getElementById("mxModal");

	$(document).on('click','#create-Template',function(){
		 mod.style.display = "block";
	})

	$(document).on('click','.close',function(){
		 mod.style.display = "none";
	})



	 $(function() {

	 	// datepicker
$("#roster-date").datepicker();
	 });



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


// validate
$('#roster-template-submit').prop('disabled','disabled');
	$(document).on('keyup','#roster-name',function(){
		if($('#roster-name').val() == null || $('#roster-name').val() == ""){
			$('#roster-template-submit').prop('disabled','disabled');
		}
		if($('#roster-name').val() != null && $('#roster-name').val() != ""){
			$('#roster-template-submit').prop('disabled',false);
		}
	})
	$(document).ready(()=>{
		remove_loader_icon();
    $('.containers').css('paddingLeft',$('.side-nav').width());
});
</script>
<?php if( isset($error) != null){ ?>
	<script type="text/javascript">
		
   var modal = document.querySelector(".modal-logout");
       function toggleModal() {
   	     modal.classList.toggle("show-modal");
    	}
	$(document).ready(function(){
  		toggleModal();	
  		});
	</script>
<?php }	?>

<script type="text/javascript">
	  $(document).ready( function () {
		    $('.table').dataTable({
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
			$('#ui-datepicker-div').remove()
			$('.table-div').css('maxWidth','100vw')
		})
</script>
<script type="text/javascript">
	function remove_loader_icon(){
		$('.loading').hide();
	};
	function loader_icon(){
		$('.loading').show();
	};
	//----------------

$(document).ready(function(){
	$(document).on('click','.roster_template_style',function(){
			var url = window.location.origin+"/HRMS101/roster/updateRosterTemplate";
			var rosterTemplateId = $(this).attr('id');
			var userid = "<?php echo $this->session->userdata('LoginId'); ?>";
				$.ajax({
					url:url,
					type:'POST',
					data:{
						userid: userid,
						rosterid: rosterTemplateId,
						status: 'Discarded'
					},
					success:function(response){
						window.location.href= window.location.origin+"/HRMS101/roster/roster_dashboard";
					}

				})
	})
})
</script>
<script type="text/javascript">
	$('#ui-datepicker-div').remove()
</script>
</body>
</html>
<!--<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.center-class',function(){
			var id = $(this).prop('id');
		var url = "http://localhost/HRMS101/roster/roster_dashboard/"+id;
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


					$('#create-template').attr('href','<?php echo base_url('createRosterTemplate/') ?>'+$('.center-list').val());
</script>-->

