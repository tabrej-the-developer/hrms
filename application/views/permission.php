<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('header'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Permission Settings</title>
	
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

<div class="containers">
	<div class="d-flex">
		<span class="m-3" style="font-size: 30px;font-weight: bold">Permissions</span>
		<!-- <span class="d-flex align-items-center"><button id="superfunds">Sync Xero Superfunds</button></span> -->
	</div>
		<span class="span-class">
			<select placeholder="Select Center" id="centerValue" onchange="getEmployees()">
			<?php
				$centers = json_decode($centers);
				foreach($centers->centers as $center){
			?>
				<option value="<?php echo $center->centerid?>"><?php echo $center->name; ?></option>
			<?php }?>
			</select>
		</span>
		<span class="span-class">
			<select placeholder="Select Center" id="employeeValue" onchange="getPermissions()">

			</select>
		</span>

	<div class="table-div">
		<table class="table">
			<thead>
				<th></th>
				<th></th>
			</thead>
			
			<tbody id="tbody">
				<tr>
					<td>QR Reader</td>
					<td>
						<input type="checkbox" id="isQrReaderYN" checked>
					</td>
				</tr>
				<tr>
					<td>View Roster</td>
					<td>
						<input type="checkbox" id="viewRosterYN" checked>
					</td>
				</tr>
				<tr>
					<td>Edit Roster</td>
					<td>
						<input type="checkbox" id="editRosterYN" checked>
					</td>
				</tr>
				<tr>
					<td>View Timesheet</td>
					<td>
						<input type="checkbox" id="viewTimesheetYN" checked>
					</td>
				</tr>
				<tr>
					<td>Edit Timesheet</td>
					<td>
						<input type="checkbox" id="editTimesheetYN" checked>
					</td>
				</tr>
				<tr>
					<td>View Payroll</td>
					<td>
						<input type="checkbox" id="viewPayrollYN" checked>
					</td>
				</tr>
				<tr>
					<td>Edit Payroll</td>
					<td>
						<input type="checkbox" id="editPayrollYN" checked>
					</td>
				</tr>
				<tr>
					<td>Edit Leave Types</td>
					<td>
						<input type="checkbox" id="editLeaveTypeYN" checked>
					</td>
				</tr>
				<tr>
					<td>View Leave Type</td>
					<td>
						<input type="checkbox" id="viewLeaveTypeYN" checked>
					</td>
				</tr>
				<tr>
					<td>Create Notice</td>
					<td>
						<input type="checkbox" id="createNoticeYN" checked>
					</td>
				</tr>
				<tr>
					<td>View Org Chart</td>
					<td>
						<input type="checkbox" id="viewOrgChartYN" checked>
					</td>
				</tr>
				<tr>
					<td>Edit OrgChart</td>
					<td>
						<input type="checkbox" id="editOrgChartYN" checked>
					</td>
				</tr>
				<tr>
					<td>View Center Profile</td>
					<td>
						<input type="checkbox" id="viewCenterProfileYN" checked>
					</td>
				</tr>
				<tr>
					<td>Edit Center Profile</td>
					<td>
						<input type="checkbox" id="editCenterProfileYN" checked>
					</td>
				</tr>
				<tr>
					<td>View Room Settings</td>
					<td>
						<input type="checkbox" id="viewRoomSettingsYN" checked>
					</td>
				</tr>
				<tr>
					<td>Edit Room Settings</td>
					<td>
						<input type="checkbox" id="editRoomSettingsYN" checked>
					</td>
				</tr>
				<tr>
					<td>View Entitlements</td>
					<td>
						<input type="checkbox" id="viewEntitlementsYN" checked>
					</td>
				</tr>
				<tr>
					<td>Edit Entitlements</td>
					<td>
						<input type="checkbox" id="editEntitlementsYN" checked>
					</td>
				</tr>
				<tr>
					<td>Edit Employees</td>
					<td>
						<input type="checkbox" id="editEmployeeYN" checked>
					</td>
				</tr>
				<tr>
					<td>Xero Settings</td>
					<td>
						<input type="checkbox" id="xeroYN" checked>
					</td>
				</tr>
				<tr>
					<td>View Awards</td>
					<td>
						<input type="checkbox" id="viewAwardsYN" checked>
					</td>
				</tr>
				<tr>
					<td>Edit Awards</td>
					<td>
						<input type="checkbox" id="editAwardsYN" checked>
					</td>
				</tr>
				<tr>
					<td>View Superfunds</td>
					<td>
						<input type="checkbox" id="viewSuperfundsYN" checked>
					</td>
				</tr>
				<tr>
					<td>Edit Superfunds</td>
					<td>
						<input type="checkbox" id="editSuperfundsYN" checked>
					</td>
				</tr>
				<tr>
					<td>Create MOM</td>
					<td>
						<input type="checkbox" id="createMomYN" checked>
					</td>
				</tr>
				<tr>
					<td>Edit Permissions</td>
					<td>
						<input type="checkbox" id="editPermissionYN" checked>
					</td>
				</tr>
				<tr>
					<td>View Permissions</td>
					<td>
						<input type="checkbox" id="viewPermissionYN" checked>
					</td>
				</tr>
			</tbody>
		
		</table>
		
	</div>
	<div>
	<button onclick="savePermission()">Save</button>
</div>
</div>



<div class="modal-logout">
    <div class="modal-content-logout">
        <h3>You have been logged out!!</h3>
        <h4><a href="<?php echo base_url(); ?>">Click here</a> to login</h4>
    </div>
</div>


<script type="text/javascript">
	var base_url = "<?php echo base_url();?>";
	function getEmployees(){
		var xhttp = new XMLHttpRequest();
		var centerId = document.getElementById("centerValue").value;
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var employees = JSON.parse(xhttp.responseText);
				var finalStr = "";
				for(var i=0;i<employees.employees.length;i++){
					finalStr += '<option value = "' + employees.employees[i].id +  '">' + employees.employees[i].name + '</option>';
				}
				document.getElementById("employeeValue").innerHTML = finalStr;
				getPermissions();
			}
		};
		xhttp.open("GET", base_url+"settings/getEmployeesByCenter/"+centerId, true);
		xhttp.send();
	}

	function getPermissions(){
		var xhttp = new XMLHttpRequest();
		var empId = document.getElementById("employeeValue").value;
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var permissions = JSON.parse(xhttp.responseText);
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
					document.getElementById("viewRoomSettingsYN").checked = permissions.permissions.viewRoomSettingsYN == "Y";
					document.getElementById("editRoomSettingsYN").checked = permissions.permissions.editRoomSettingsYN == "Y";
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
					document.getElementById("viewRoomSettingsYN").checked = false;
					document.getElementById("editRoomSettingsYN").checked = false;
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
				}
			}
		};
		xhttp.open("GET", base_url+"settings/getPermissionByEmployee/"+empId, true);
		xhttp.send();
	}

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
		var viewRoomSettingsYN = document.getElementById("viewRoomSettingsYN").checked ? "Y" : "N";
		var editRoomSettingsYN = document.getElementById("editRoomSettingsYN").checked ? "Y" : "N";
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
		var data = 'empId='+empId+"&isQrReaderYN="+isQrReaderYN+"&viewRosterYN="+viewRosterYN+"&editRosterYN="+editRosterYN+"&viewTimesheetYN="+viewTimesheetYN+"&editTimesheetYN="+editTimesheetYN+"&viewPayrollYN="+viewPayrollYN+"&editPayrollYN="+editPayrollYN+"&editLeaveTypeYN="+editLeaveTypeYN+"&viewLeaveTypeYN="+viewLeaveTypeYN+"&createNoticeYN="+createNoticeYN+"&viewOrgChartYN="+viewOrgChartYN+"&editOrgChartYN="+editOrgChartYN+"&viewCenterProfileYN="+viewCenterProfileYN+"&editCenterProfileYN="+editCenterProfileYN+"&viewRoomSettingsYN="+viewRoomSettingsYN+"&editRoomSettingsYN="+editRoomSettingsYN+"&viewEntitlementsYN="+viewEntitlementsYN+"&editEntitlementsYN="+editEntitlementsYN+"&editEmployeeYN="+editEmployeeYN+"&xeroYN="+xeroYN+"&viewAwardsYN="+viewAwardsYN+"&editAwardsYN="+editAwardsYN+"&viewSuperfundsYN="+viewSuperfundsYN+"&editSuperfundsYN="+editSuperfundsYN+"&createMomYN="+createMomYN+"&editPermissionYN="+editPermissionYN+"&viewPermissionYN="+viewPermissionYN;
	    var params = typeof data == 'string' ? data : Object.keys(data).map(
	        function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
	    ).join('&');
		var xhr = new XMLHttpRequest();
		xhr.open('POST', base_url+"settings/savePermission");
	    xhr.onreadystatechange = function() {
	        if (xhr.readyState>3 && xhr.status==200) { 
	        	console.log(xhr.responseText);
	        	// location.reload();
	        }
	    };
	    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    xhr.send(params);
	}

	getEmployees();
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

<script type="text/javascript">
	$(document).ready(function(){
	$('#superfunds').click(function(){
		var url = window.location.origin + "/PN101/settings/syncXeroSuperfunds" ;
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
