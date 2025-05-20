<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Permission Settings</title>
<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">
  
<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<style>
.navbar-nav .nav-item-header:nth-of-type(9) {
    background: var(--blue2) !important;
    position: relative;
}
.navbar-nav .nav-item-header:nth-of-type(9)::after {
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
	<?php $permissions = json_decode($permissions); ?>
	<input type="text" id="emplId" value="<?php echo $this->session->userdata('LoginId'); ?>" style="display:none">

		<div class="containers scrollY">
			<div class="settingsContainer">

				<span class="d-flex pageHead heading-bar">
					<div class="withBackLink">
						<a href="<?php echo base_url();?>/settings">
							<span class="material-icons-outlined">arrow_back</span>
						</a>				
						<span class="events_title">Edit Permissions</span>
					</div>
					<div class="rightHeader">
						<select placeholder="Select Center" id="centerValue" onchange="getEmployees()">
							<?php
								$centers = json_decode($centers);
								foreach($centers->centers as $center){
							?>
								<option value="<?php echo $center->centerid?>"><?php echo $center->name; ?></option>
							<?php }?>
						</select>
						<?php  if((isset($permissions->permissions) ? $permissions->permissions->editPermissionYN : "N") == "Y"){ ?>
							<span class="span-class employee-id-class">
								<span class="select_css">
									<select placeholder="Select Center" id="employeeValue" onchange="getPermissions()">

									</select>
								</span>
							</span>
						<?php  } ?>
					</div>
				</span>

				<div class="d-flex justify-content-end">
					<div class="form-check" style="margin-right:1.2rem;">
						<input class="form-check-input" type="checkbox" value="" id="centerManagerSelect">
						<label class="form-check-label" for="centerManagerSelect">
							Center Manager
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" id="selectAll">
						<label class="form-check-label" for="selectAll">
							Select All
						</label>
					</div>
				</div>
							<script>
								$('#selectAll').click(function(){
									$('.pc').prop('checked', this.checked); 
									$('#centerManagerSelect').prop('checked', false);
								});
								$('#centerManagerSelect').click(function(){
									$('#selectAll').prop('checked', false);
									$('.pc').prop('checked', false);
									$('#viewRosterYN,#editRosterYN,#viewTimesheetYN,#editTimesheetYN,#viewPayrollYN,#editLeaveTypeYN,#viewLeaveTypeYN,#viewOrgChartYN,#editOrgChartYN,#viewCenterProfileYN,#editCenterProfileYN,#editEmployeeYN,#createMomYN,#editPermissionYN,#viewPermissionYN').prop('checked', this.checked);
								});
							</script>
				<div class="table-div pageTableDiv">
					<table class="table">
						<!-- <thead>
							<th></th>
							<th></th>
						</thead> -->
						<style>
							.pc{
								float:right;
								margin-top:5px;
							}
						</style>
						<tbody id="tbody">
							<tr>
								<td>QR Reader</td>
								<td>
									<input type="checkbox" class="pc" id="isQrReaderYN" checked><label for="isQrReaderYN"></label>
								</td>
							</tr>
							<tr>
								<td>View Roster</td>
								<td>
									<input type="checkbox" class="pc" id="viewRosterYN" checked><label for="viewRosterYN"></label>
								</td>
							</tr>
							<tr>
								<td>Edit Roster</td>
								<td>
									<input type="checkbox" class="pc" id="editRosterYN" checked><label for="editRosterYN"></label>
								</td>
							</tr>
							<tr>
								<td>View Timesheet</td>
								<td>
									<input type="checkbox" class="pc" id="viewTimesheetYN" checked><label for="viewTimesheetYN"></label>
								</td>
							</tr>
							<tr>
								<td>Edit Timesheet</td>
								<td>
									<input type="checkbox" class="pc" id="editTimesheetYN" checked><label for="editTimesheetYN"></label>
								</td>
							</tr>
							<tr>
								<td>View Payroll</td>
								<td>
									<input type="checkbox" class="pc" id="viewPayrollYN" checked><label for="viewPayrollYN"></label>
								</td>
							</tr>
							<tr>
								<td>Edit Payroll</td>
								<td>
									<input type="checkbox" class="pc" id="editPayrollYN" checked><label for="editPayrollYN"></label>
								</td>
							</tr>
							<tr>
								<td>Edit Leave Types</td>
								<td>
									<input type="checkbox" class="pc" id="editLeaveTypeYN" checked><label for="editLeaveTypeYN"></label>
								</td>
							</tr>
							<tr>
								<td>View Leave Type</td>
								<td>
									<input type="checkbox" class="pc" id="viewLeaveTypeYN" checked><label for="viewLeaveTypeYN"></label>
								</td>
							</tr>
							<tr>
								<td>Create Notice</td>
								<td>
									<input type="checkbox" class="pc" id="createNoticeYN" checked><label for="createNoticeYN"></label>
								</td>
							</tr>
							<tr>
								<td>View Org Chart</td>
								<td>
									<input type="checkbox" class="pc" id="viewOrgChartYN" checked><label for="viewOrgChartYN"></label>
								</td>
							</tr>
							<tr>
								<td>Edit OrgChart</td>
								<td>
									<input type="checkbox" class="pc" id="editOrgChartYN" checked><label for="editOrgChartYN"></label>
								</td>
							</tr>
							<tr>
								<td>View Center Profile</td>
								<td>
									<input type="checkbox" class="pc" id="viewCenterProfileYN" checked><label for="viewCenterProfileYN"></label>
								</td>
							</tr>
							<tr>
								<td>Edit Center Profile</td>
								<td>
									<input type="checkbox" class="pc" id="editCenterProfileYN" checked><label for="editCenterProfileYN"></label>
								</td>
							</tr>
							<!-- <tr>
								<td>View Room Settings</td>
								<td>
									<input type="checkbox" id="viewRoomSettingsYN" checked><label for="viewRoomSettingsYN"></label>
								</td>
							</tr>
							<tr>
								<td>Edit Room Settings</td>
								<td>
									<input type="checkbox" id="editRoomSettingsYN" checked><label for="editRoomSettingsYN"></label>
								</td>
							</tr> -->
							<tr>
								<td>View Entitlements</td>
								<td>
									<input type="checkbox" class="pc" id="viewEntitlementsYN" checked><label for="viewEntitlementsYN"></label>
								</td>
							</tr>
							<tr>
								<td>Edit Entitlements</td>
								<td>
									<input type="checkbox" class="pc" id="editEntitlementsYN" checked><label for="editEntitlementsYN"></label>
								</td>
							</tr>
							<tr>
								<td>Edit Employees</td>
								<td>
									<input type="checkbox" class="pc" id="editEmployeeYN" checked><label for="editEmployeeYN"></label>
								</td>
							</tr>
							<tr>
								<td>Xero Settings</td>
								<td>
									<input type="checkbox" class="pc" id="xeroYN" checked><label for="xeroYN"></label>
								</td>
							</tr>
							<tr>
								<td>View Awards</td>
								<td>
									<input type="checkbox" class="pc" id="viewAwardsYN" checked><label for="viewAwardsYN"></label>
								</td>
							</tr>
							<tr>
								<td>Edit Awards</td>
								<td>
									<input type="checkbox" class="pc" id="editAwardsYN" checked><label for="editAwardsYN"></label>
								</td>
							</tr>
							<tr>
								<td>View Superfunds</td>
								<td>
									<input type="checkbox" class="pc" id="viewSuperfundsYN" checked><label for="viewSuperfundsYN"></label>
								</td>
							</tr>
							<tr>
								<td>Edit Superfunds</td>
								<td>
									<input type="checkbox" class="pc" id="editSuperfundsYN" checked><label for="editSuperfundsYN"></label>
								</td>
							</tr>
							<tr>
								<td>Create MOM</td>
								<td>
									<input type="checkbox" class="pc" id="createMomYN" checked><label for="createMomYN"></label>
								</td>
							</tr>
							<tr>
								<td>Edit Permissions</td>
								<td>
									<input type="checkbox" class="pc" id="editPermissionYN" checked><label for="editPermissionYN"></label>
								</td>
							</tr>
							<tr>
								<td>View Permissions</td>
								<td>
									<input type="checkbox" class="pc" id="viewPermissionYN" checked><label for="viewPermissionYN"></label>
								</td>
							</tr>
							<tr>
								<td>Kidsoft Permissions</td>
								<td>
									<input type="checkbox" class="pc" id="kidsoftYN" checked><label for="kidsoftYN"></label>
								</td>
							</tr>
						</tbody>
		
					</table>
		
				</div>

				<?php  if((isset($permissions->permissions) ? $permissions->permissions->editPermissionYN : "N") == "Y"){ ?>
				<div class="formSubmit" >
					<button onclick="savePermission()" class="btn btn-default btn-small btnOrange pull-right savePermissionButton">
						<span class="material-icons-outlined">save</span>
						Save
					</button>
				</div>
				<?php  } ?>
		</div>
	</div>
</div>

<div class="loading">
	<div class="loader"></div>
</div>

<div class="modal-logout">
    <div class="modal-content-logout">
        <h3>You have been logged out!!</h3>
        <h4><a class="btn btn-default btn-small btnOrange" href="<?php echo base_url(); ?>">Click here</a> to login</h4>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(()=>{
		if($(document).width() > 1024){
		    $('.containers').css('paddingLeft',$('.side-nav').width());
		}
});
</script>
<script type="text/javascript">


	function remove_loader_icon(){
		$('.loading').hide();
	};
	function loader_icon(){
		$('.loading').show();
	};
	var base_url = "<?php echo base_url();?>";
	function getEmployees(){

		$('#selectAll').removeAttr('checked');
		$('#centerManagerSelect').removeAttr('checked');

		var xhttp = new XMLHttpRequest();
		var centerId = document.getElementById("centerValue").value;
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var employees = xhttp.responseText;
				if(employees != "" && employees != null){
<?php  if((isset($permissions->permissions) ? $permissions->permissions->editPermissionYN : "N") == "Y"){ ?>
					employees = JSON.parse(employees)
				var finalStr = "";
				for(var i=0;i<employees.employees.length;i++){
					finalStr += '<option value = "' + employees.employees[i].id +  '">' + employees.employees[i].name + '</option>';
				}
				document.getElementById("employeeValue").innerHTML = finalStr;
<?php } ?>
				getPermissions();
				}
			}
		};
		xhttp.open("GET", base_url+"settings/getEmployeesByCenter/"+centerId, true);
		xhttp.send();
	}

	function getPermissions(){
		
		$('#selectAll').removeAttr('checked');
		$('#centerManagerSelect').removeAttr('checked');

		var xhttp = new XMLHttpRequest();
<?php  if((isset($permissions->permissions) ? $permissions->permissions->editPermissionYN : "N") == "Y"){ ?>
		var empId = document.getElementById("employeeValue").value;
	<?php } ?>
<?php  if((isset($permissions->permissions) ? $permissions->permissions->editPermissionYN : "N") == "N"){ ?>
		var empId = document.getElementById("emplId").value;
	<?php } ?>
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var permissions = xhttp.responseText;
				if(permissions != "" && permissions != null){
					permissions = JSON.parse(permissions)
				if(permissions.permissions != null){
					document.getElementById("isQrReaderYN").checked = permissions.permissions.isQrReaderYN == "Y";
					document.getElementById("viewRosterYN").checked = permissions.permissions.viewRosterYN == "Y";
					document.getElementById("editRosterYN").checked = permissions.permissions.editRosterYN == "Y";
					document.getElementById("viewTimesheetYN").checked = permissions.permissions.viewTimesheetYN == "Y";
					document.getElementById("editTimesheetYN").checked = permissions.permissions.editTimesheetYN == "Y";
					document.getElementById("viewPayrollYN").checked = permissions.permissions.viewPayrollYN == "Y";
					document.getElementById("editPayrollYN").checked = permissions.permissions.editPayrollYN == "Y";
					document.getElementById("editLeaveTypeYN").checked = permissions.permissions.editLeaveTypeYN == "Y";
					document.getElementById("viewLeaveTypeYN").checked = permissions.permissions.viewLeaveTypeYN == "Y";
					document.getElementById("createNoticeYN").checked = permissions.permissions.createNoticeYN == "Y";
					document.getElementById("viewOrgChartYN").checked = permissions.permissions.viewOrgChartYN == "Y";
					document.getElementById("editOrgChartYN").checked = permissions.permissions.editOrgChartYN == "Y";
					document.getElementById("viewCenterProfileYN").checked = permissions.permissions.viewCenterProfileYN == "Y";
					document.getElementById("editCenterProfileYN").checked = permissions.permissions.editCenterProfileYN == "Y";
					// document.getElementById("viewRoomSettingsYN").checked = permissions.permissions.viewRoomSettingsYN == "Y";
					// document.getElementById("editRoomSettingsYN").checked = permissions.permissions.editRoomSettingsYN == "Y";
					document.getElementById("viewEntitlementsYN").checked = permissions.permissions.viewEntitlementsYN == "Y";
					document.getElementById("editEntitlementsYN").checked = permissions.permissions.editEntitlementsYN == "Y";
					document.getElementById("editEmployeeYN").checked = permissions.permissions.editEmployeeYN == "Y";
					document.getElementById("xeroYN").checked = permissions.permissions.xeroYN == "Y";
					document.getElementById("viewAwardsYN").checked = permissions.permissions.viewAwardsYN == "Y";
					document.getElementById("editAwardsYN").checked = permissions.permissions.editAwardsYN == "Y";
					document.getElementById("viewSuperfundsYN").checked = permissions.permissions.viewSuperfundsYN == "Y";
					document.getElementById("editSuperfundsYN").checked = permissions.permissions.editSuperfundsYN == "Y";
					document.getElementById("createMomYN").checked = permissions.permissions.createMomYN == "Y";
					document.getElementById("editPermissionYN").checked = permissions.permissions.editPermissionYN == "Y";
					document.getElementById("viewPermissionYN").checked = permissions.permissions.viewPermissionYN == "Y";
					document.getElementById("kidsoftYN").checked = permissions.permissions.kidsoftYN == "Y";
					setTimeout(remove_loader_icon,200)
				}
				else{
					document.getElementById("isQrReaderYN").checked = false;
					document.getElementById("viewRosterYN").checked = false;
					document.getElementById("editRosterYN").checked = false;
					document.getElementById("viewTimesheetYN").checked = false;
					document.getElementById("editTimesheetYN").checked = false;
					document.getElementById("viewPayrollYN").checked = false;
					document.getElementById("editPayrollYN").checked = false;
					document.getElementById("editLeaveTypeYN").checked = false;
					document.getElementById("viewLeaveTypeYN").checked = false;
					document.getElementById("createNoticeYN").checked = false;
					document.getElementById("viewOrgChartYN").checked = false;
					document.getElementById("editOrgChartYN").checked = false;
					document.getElementById("viewCenterProfileYN").checked = false;
					document.getElementById("editCenterProfileYN").checked = false;
					// document.getElementById("viewRoomSettingsYN").checked = false;
					// document.getElementById("editRoomSettingsYN").checked = false;
					document.getElementById("viewEntitlementsYN").checked = false;
					document.getElementById("editEntitlementsYN").checked = false;
					document.getElementById("editEmployeeYN").checked = false;
					document.getElementById("xeroYN").checked = false;
					document.getElementById("viewAwardsYN").checked = false;
					document.getElementById("editAwardsYN").checked = false;
					document.getElementById("viewSuperfundsYN").checked = false;
					document.getElementById("editSuperfundsYN").checked = false;
					document.getElementById("createMomYN").checked = false;
					document.getElementById("editPermissionYN").checked = false;
					document.getElementById("viewPermissionYN").checked = false;
					document.getElementById("kidsoftYN").checked = false;
					setTimeout(remove_loader_icon,200)
				}
				}
			}
		};
		xhttp.open("GET", base_url+"settings/getPermissionByEmployee/"+empId, true);
		xhttp.send();
	}
<?php  if((isset($permissions->permissions) ? $permissions->permissions->editPermissionYN : "N") == "Y"){ ?>
	function savePermission(){
		var empId = document.getElementById("employeeValue").value;
		var isQrReaderYN = document.getElementById("isQrReaderYN").checked ? "Y" : "N";
		var viewRosterYN = document.getElementById("viewRosterYN").checked ? "Y" : "N";
		var editRosterYN = document.getElementById("editRosterYN").checked ? "Y" : "N";
		var viewTimesheetYN = document.getElementById("viewTimesheetYN").checked ? "Y" : "N";
		var editTimesheetYN = document.getElementById("editTimesheetYN").checked ? "Y" : "N";
		var viewPayrollYN = document.getElementById("viewPayrollYN").checked ? "Y" : "N";
		var editPayrollYN = document.getElementById("editPayrollYN").checked ? "Y" : "N";
		var editLeaveTypeYN = document.getElementById("editLeaveTypeYN").checked ? "Y" : "N";
		var viewLeaveTypeYN = document.getElementById("viewLeaveTypeYN").checked ? "Y" : "N";
		var createNoticeYN = document.getElementById("createNoticeYN").checked ? "Y" : "N";
		var viewOrgChartYN = document.getElementById("viewOrgChartYN").checked ? "Y" : "N";
		var editOrgChartYN = document.getElementById("editOrgChartYN").checked ? "Y" : "N";
		var viewCenterProfileYN = document.getElementById("viewCenterProfileYN").checked ? "Y" : "N";
		var editCenterProfileYN = document.getElementById("editCenterProfileYN").checked ? "Y" : "N";
		// var viewRoomSettingsYN = document.getElementById("viewRoomSettingsYN").checked ? "Y" : "N";
		// var editRoomSettingsYN = document.getElementById("editRoomSettingsYN").checked ? "Y" : "N";
		var viewEntitlementsYN = document.getElementById("viewEntitlementsYN").checked ? "Y" : "N";
		var editEntitlementsYN = document.getElementById("editEntitlementsYN").checked ? "Y" : "N";
		var editEmployeeYN = document.getElementById("editEmployeeYN").checked ? "Y" : "N";
		var xeroYN = document.getElementById("xeroYN").checked ? "Y" : "N";
		var viewAwardsYN = document.getElementById("viewAwardsYN").checked ? "Y" : "N";
		var editAwardsYN = document.getElementById("editAwardsYN").checked ? "Y" : "N";
		var viewSuperfundsYN = document.getElementById("viewSuperfundsYN").checked ? "Y" : "N";
		var editSuperfundsYN = document.getElementById("editSuperfundsYN").checked ? "Y" : "N";
		var createMomYN = document.getElementById("createMomYN").checked ? "Y" : "N";
		var editPermissionYN = document.getElementById("editPermissionYN").checked ? "Y" : "N";
		var viewPermissionYN = document.getElementById("viewPermissionYN").checked ? "Y" : "N";
		var kidsoftYN = document.getElementById("kidsoftYN").checked ? "Y" : "N";
		var data = 'empId='+empId+"&isQrReaderYN="+isQrReaderYN+"&viewRosterYN="+viewRosterYN+"&editRosterYN="+editRosterYN+"&viewTimesheetYN="+viewTimesheetYN+"&editTimesheetYN="+editTimesheetYN+"&viewPayrollYN="+viewPayrollYN+"&editPayrollYN="+editPayrollYN+"&editLeaveTypeYN="+editLeaveTypeYN+"&viewLeaveTypeYN="+viewLeaveTypeYN+"&createNoticeYN="+createNoticeYN+"&viewOrgChartYN="+viewOrgChartYN+"&editOrgChartYN="+editOrgChartYN+"&viewCenterProfileYN="+viewCenterProfileYN+"&editCenterProfileYN="+editCenterProfileYN+"&viewEntitlementsYN="+viewEntitlementsYN+"&editEntitlementsYN="+editEntitlementsYN+"&editEmployeeYN="+editEmployeeYN+"&xeroYN="+xeroYN+"&viewAwardsYN="+viewAwardsYN+"&editAwardsYN="+editAwardsYN+"&viewSuperfundsYN="+viewSuperfundsYN+"&editSuperfundsYN="+editSuperfundsYN+"&createMomYN="+createMomYN+"&editPermissionYN="+editPermissionYN+"&viewPermissionYN="+viewPermissionYN+"&kidsoftYN="+kidsoftYN;
	    var params = typeof data == 'string' ? data : Object.keys(data).map(
	        function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
	    ).join('&');
		var xhr = new XMLHttpRequest();
		xhr.open('POST', base_url+"settings/savePermission");
	    xhr.onreadystatechange = function() {
	        if (xhr.readyState>3 && xhr.status==200) {
	        	
	        }
	    };
	    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    xhr.send(params);
	    alert('Permissions Saved')
	}
<?php  } ?>
	getEmployees();

	$('.savePermissionButton').on('.click',function(){
		alert('Permissions Saved')
	})

</script>

<?php  if((isset($permissions->permissions) ? $permissions->permissions->editPermissionYN : "N") == "N"){ ?>
	<script type="text/javascript">
	$(document).ready(function(){
		$('input').prop('disabled',true);
		})
	</script>
<?php  } ?>



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
	$(document).ready(function(){
	$('#superfunds').click(function(){
		var url = "<?php echo base_url() ?>settings/syncXeroSuperfunds" ;
		$.ajax({
				url:url,
				type:'GET',
				success:function(){
					window.location.reload();
				}
			})
		})
	})
</script>

</body>
</html>