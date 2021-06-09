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
		max-height: 100vw;
	}
	body{
		background: #f2f2f2;
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
<?php  if((isset($permissions->permissions) ? $permissions->permissions->editPermissionYN : "N") == "Y"){ ?>
		.table-div{
			overflow-y: auto;
			height: 75%;
			padding: 0;
		}	
<?php } ?>
<?php  if((isset($permissions->permissions) ? $permissions->permissions->editPermissionYN : "N") == "N"){ ?>
	.table-div{
			overflow-y: auto;
			height: 100%;
			padding: 0;
		}	
<?php } ?>
		.table  td,.table th{
			padding: 0.25rem;
			padding-left: 4rem;
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
/*#down-arrow::after{
		position:relative;
        content: " \2193";
        top: 0px;
        right: 20px;
        height: 10px;
        width: 20px;
}*/
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
    .button{
    	background-color: #9E9E9E;
  		border: none;
  		color: white;
  		padding: 5px 10px;
  		text-align: center;
  		text-decoration: none;
  		display: inline-block;
  		margin: 2px
    }
    .button-class{
    	display: flex;
    	justify-content: flex-end;
    	right:5%;
    	bottom: 5px;
    }
    .select-class{
    	display: flex;
    	justify-content: flex-end;
    	padding: 1rem
    }
    .center-class{
    	padding-right: 2%;
    	position: relative;
    	margin-left: auto;
    display: flex;
    justify-content: center;
    align-items: center;
    }
/*    .center-class:after{
    	background: url("../assets/images/dropdown.png");
    	padding:10px;
    	position:absolute;
    	right:25px;
    	content: " "
    }*/
    .employee-id-class{
    	padding-right: 2%;
    	position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    }
/*    .employee-id-class:after{
    	background: url("../assets/images/dropdown.png");
    	padding:10px;
    	position:absolute;
    	right:25px;
    	content: " "
    }*/

	.loader {
	  border: 16px solid #f3f3f3;
	  border-radius: 50%;
	  border-top: 16px solid #307bd3;
	  width: 120px;
	  height: 120px;
	  animation: spin 2s linear infinite;
	}
	.loading{
		position: fixed;
		height: 100vh;
		width: 100vw;
		top: 0;
		display: flex;
		justify-content: center;
		align-items: center;
		background: rgba(255,255,255);
	}

	@keyframes spin {
	  0% { transform: rotate(0deg); }
	  100% { transform: rotate(360deg); }
	}
    #centerValue{
    	border-radius: 3px;
    	background-color:#F0F0F0; 
    }
    #employeeValue{
    	border-radius: 3px;
    	background-color:#F0F0F0; 
    }
select::-ms-expand {
    display: none;
}
input[type=checkbox] + label {
  margin: 0.2em;
  cursor: pointer;
  padding: 0.2em;
}

input[type=checkbox] {
  display: none;
}

input[type=checkbox] + label:before {
  content: "\2714";
  border: 0.1em solid #000;
  border-radius: 0.2em;
  display: inline-block;
  width: 1em;
  height: 1.3em;
  vertical-align: bottom;
  color: transparent;
  transition: .2s;
}

input[type=checkbox] + label:active:before {
  transform: scale(0);
}

input[type=checkbox]:checked + label:before {
  background-color: #307bd3 ;
  border-color: #307bd3 ;
  color: #fff;
}

.permission-container{
	padding: 1rem 3rem 2rem 2rem;
	height:calc(100vh - 5rem);
}
.permission-container-child{
	background: white;
	height: 100%;
}
tbody{
	padding-bottom: 16rem;
}
.buttonn,
.button,
button[type=button]{
  /*position: absolute;*/
/*  right: 0;*/
    border: none !important;
    color: rgb(23, 29, 75) !important;
    text-align: center !important;
    text-decoration: none !important;
    display: inline-block;
    font-weight: 700 !important;
    margin: 2px !important;
    min-width:6rem !important;
      border-radius: 20px !important;
      padding: 4px 8px !important;
      background: rgb(164, 217, 214) !important;
      font-size: 1rem !important;
      margin-right:5px !important;
      justify-content: center !important;
}
    select{
	background: rgb(164, 217, 214) !important;
	font-weight: 700 !important;
	color: rgb(23, 29, 75) !important;
	border-radius: 20px !important;
    padding: 5px !important;
    padding-left: 20px !important;
    border: 2px solid #e9e9e9 !important;
    padding-right: 2rem !important;
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
<?php $permissions = json_decode($permissions);
      $notification = json_decode($notifications);
?>
<input type="text" id="emplId" value="<?php echo $this->session->userdata('LoginId'); ?>" style="display:none">
    <div class="containers">
        <div class="permission-container">
            <span  class="d-inline-flex">
                <a href="<?php echo base_url();?>/settings">
                    <button class="btn back-button">
                    <img src="<?php echo base_url('assets/images/back.svg');?>">
                    </button>
                </a>
                <span class="settings_title">Edit Permissions</span>
            </span>
            <form method="POST" action="postNotificationSettings" class="permission-container-child">
                <div  class="table-div">
                    <table class="table">
                        <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>App</th>
                        </thead>
                        <tbody id="tbody">
                        <tr>
                            <td>Meeting_Created</td>
                            <td><input <?php if(isset($notification->Meeting_Created) && $notification->Meeting_Created->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Meeting_Created_Email" id="Meeting_Created_Email"><label for="Meeting_Created_Email"></label></td>
                            <td><input <?php if(isset($notification->Meeting_Created) && $notification->Meeting_Created->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Meeting_Created_App" id="Meeting_Created_App"><label for="Meeting_Created_App"></label></td>
                        </tr>
                        <tr>
                            <td>Meeting_Ended</td>
                            <td><input <?php if(isset($notification->Meeting_Ended) && $notification->Meeting_Ended->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Meeting_Ended_Email" id="Meeting_Ended_Email"><label for="Meeting_Ended_Email"></label></td>
                            <td><input <?php if(isset($notification->Meeting_Ended) && $notification->Meeting_Ended->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Meeting_Ended_App" id="Meeting_Ended_App"><label for="Meeting_Ended_App"></label></td>
                        </tr>
                        <tr>
                            <td>Birthday_Anniversary</td>
                            <td><input <?php if(isset($notification->Birthday_Anniversary) && $notification->Birthday_Anniversary->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Birthday_Anniversary_Email" id="Birthday_Anniversary_Email"><label for="Birthday_Anniversary_Email"></label></td>
                            <td><input <?php if(isset($notification->Birthday_Anniversary) && $notification->Birthday_Anniversary->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Birthday_Anniversary_App" id="Birthday_Anniversary_App"><label for="Birthday_Anniversary_App"></label></td>
                        </tr>
                        <tr>
                            <td>Shift_Updated</td>
                            <td><input <?php if(isset($notification->Shift_Updated) && $notification->Shift_Updated->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Shift_Updated_Email" id="Shift_Updated_Email"><label for="Shift_Updated_Email"></label></td>
                            <td><input <?php if(isset($notification->Shift_Updated) && $notification->Shift_Updated->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Shift_Updated_App" id="Shift_Updated_App"><label for="Shift_Updated_App"></label></td>
                        </tr>
                        <tr>
                            <td>Roster_Published</td>
                            <td><input <?php if(isset($notification->Roster_Published) && $notification->Roster_Published->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Roster_Published_Email" id="Roster_Published_Email"><label for="Roster_Published_Email"></label></td>
                            <td><input <?php if(isset($notification->Roster_Published) && $notification->Roster_Published->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Roster_Published_App" id="Roster_Published_App"><label for="Roster_Published_App"></label></td>
                        </tr>
                        <tr>
                            <td>Shift_Status_Changed</td>
                            <td><input <?php if(isset($notification->Shift_Status_Changed) && $notification->Shift_Status_Changed->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Shift_Status_Changed_Email" id="Shift_Status_Changed_Email"><label for="Shift_Status_Changed_Email"></label></td>
                            <td><input <?php if(isset($notification->Shift_Status_Changed) && $notification->Shift_Status_Changed->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Shift_Status_Changed_App" id="Shift_Status_Changed_App"><label for="Shift_Status_Changed_App"></label></td>
                        </tr>
                        <tr>
                            <td>Roster_Permission</td>
                            <td><input <?php if(isset($notification->Roster_Permission) && $notification->Roster_Permission->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Roster_Permission_Email" id="Roster_Permission_Email"><label for="Roster_Permission_Email"></label></td>
                            <td><input <?php if(isset($notification->Roster_Permission) && $notification->Roster_Permission->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Roster_Permission_App" id="Roster_Permission_App"><label for="Roster_Permission_App"></label></td>
                        </tr>
                        <tr>
                            <td>Timesheet_Published</td>
                            <td><input <?php if(isset($notification->Timesheet_Published) && $notification->Timesheet_Published->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Timesheet_Published_Email" id="Timesheet_Published_Email"><label for="Timesheet_Published_Email"></label></td>
                            <td><input <?php if(isset($notification->Timesheet_Published) && $notification->Timesheet_Published->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Timesheet_Published_App" id="Timesheet_Published_App"><label for="Timesheet_Published_App"></label></td>
                        </tr>
                        <tr>
                            <td>Payroll_Flagged</td>
                            <td><input <?php if(isset($notification->Payroll_Flagged) && $notification->Payroll_Flagged->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Payroll_Flagged_Email" id="Payroll_Flagged_Email"><label for="Payroll_Flagged_Email"></label></td>
                            <td><input <?php if(isset($notification->Payroll_Flagged) && $notification->Payroll_Flagged->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Payroll_Flagged_App" id="Payroll_Flagged_App"><label for="Payroll_Flagged_App"></label></td>
                        </tr>
                        <tr>
                            <td>Payroll_Published</td>
                            <td><input <?php if(isset($notification->Payroll_Published) && $notification->Payroll_Published->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Payroll_Published_Email" id="Payroll_Published_Email"><label for="Payroll_Published_Email"></label></td>
                            <td><input <?php if(isset($notification->Payroll_Published) && $notification->Payroll_Published->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Payroll_Published_App" id="Payroll_Published_App"><label for="Payroll_Published_App"></label></td>
                        </tr>
                        <tr>
                            <td>Notice_Created</td>
                            <td><input <?php if(isset($notification->Notice_Created) && $notification->Notice_Created->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Notice_Created_Email" id="Notice_Created_Email"><label for="Notice_Created_Email"></label></td>
                            <td><input <?php if(isset($notification->Notice_Created) && $notification->Notice_Created->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Notice_Created_App" id="Notice_Created_App"><label for="Notice_Created_App"></label></td>
                        </tr>
                        <tr>
                            <td>Employee_Profile_Updated</td>
                            <td><input <?php if(isset($notification->Employee_Profile_Updated) && $notification->Employee_Profile_Updated->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Employee_Profile_Updated_Email" id="Employee_Profile_Updated_Email"><label for="Employee_Profile_Updated_Email"></label></td>
                            <td><input <?php if(isset($notification->Employee_Profile_Updated) && $notification->Employee_Profile_Updated->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Employee_Profile_Updated_App" id="Employee_Profile_Updated_App"><label for="Employee_Profile_Updated_App"></label></td>
                        </tr>
                        <tr>
                            <td>Employee_Synced_With_Xero</td>
                            <td><input <?php if(isset($notification->Employee_Synced_With_Xero) && $notification->Employee_Synced_With_Xero->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Employee_Synced_With_Xero_Email" id="Employee_Synced_With_Xero_Email"><label for="Employee_Synced_With_Xero_Email"></label></td>
                            <td><input <?php if(isset($notification->Employee_Synced_With_Xero) && $notification->Employee_Synced_With_Xero->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Employee_Synced_With_Xero_App" id="Employee_Synced_With_Xero_App"><label for="Employee_Synced_With_Xero_App"></label></td>
                        </tr>
                        <tr>
                            <td>Password_Updated</td>
                            <td><input <?php if(isset($notification->Password_Updated) && $notification->Password_Updated->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Password_Updated_Email" id="Password_Updated_Email"><label for="Password_Updated_Email"></label></td>
                            <td><input <?php if(isset($notification->Password_Updated) && $notification->Password_Updated->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Password_Updated_App" id="Password_Updated_App"><label for="Password_Updated_App"></label></td>
                        </tr>
                        <tr>
                            <td>Center_Added_Removed</td>
                            <td><input <?php if(isset($notification->Center_Added_Removed) && $notification->Center_Added_Removed->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Center_Added_Removed_Email" id="Center_Added_Removed_Email"><label for="Center_Added_Removed_Email"></label></td>
                            <td><input <?php if(isset($notification->Center_Added_Removed) && $notification->Center_Added_Removed->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Center_Added_Removed_App" id="Center_Added_Removed_App"><label for="Center_Added_Removed_App"></label></td>
                        </tr>
                        <tr>
                            <td>Level_Changed</td>
                            <td><input <?php if(isset($notification->Level_Changed) && $notification->Level_Changed->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Level_Changed_Email" id="Level_Changed_Email"><label for="Level_Changed_Email"></label></td>
                            <td><input <?php if(isset($notification->Level_Changed) && $notification->Level_Changed->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Level_Changed_App" id="Level_Changed_App"><label for="Level_Changed_App"></label></td>
                        </tr>
                        <tr>
                            <td>Employee_Role_Changed</td>
                            <td><input <?php if(isset($notification->Employee_Role_Changed) && $notification->Employee_Role_Changed->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Employee_Role_Changed_Email" id="Employee_Role_Changed_Email"><label for="Employee_Role_Changed_Email"></label></td>
                            <td><input <?php if(isset($notification->Employee_Role_Changed) && $notification->Employee_Role_Changed->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Employee_Role_Changed_App" id="Employee_Role_Changed_App"><label for="Employee_Role_Changed_App"></label></td>
                        </tr>
                        <tr>
                            <td>Employee_Area_Changed</td>
                            <td><input <?php if(isset($notification->Employee_Area_Changed) && $notification->Employee_Area_Changed->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Employee_Area_Changed_Email" id="Employee_Area_Changed_Email"><label for="Employee_Area_Changed_Email"></label></td>
                            <td><input <?php if(isset($notification->Employee_Area_Changed) && $notification->Employee_Area_Changed->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Employee_Area_Changed_App" id="Employee_Area_Changed_App"><label for="Employee_Area_Changed_App"></label></td>
                        </tr>
                        <tr>
                            <td>Leave_Applied</td>
                            <td><input <?php if(isset($notification->Leave_Applied) && $notification->Leave_Applied->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Leave_Applied_Email" id="Leave_Applied_Email"><label for="Leave_Applied_Email"></label></td>
                            <td><input <?php if(isset($notification->Leave_Applied) && $notification->Leave_Applied->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Leave_Applied_App" id="Leave_Applied_App"><label for="Leave_Applied_App"></label></td>
                        </tr>
                        <tr>
                            <td>Leave_Status_Changed</td>
                            <td><input <?php if(isset($notification->Leave_Status_Changed) && $notification->Leave_Status_Changed->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Leave_Status_Changed_Email" id="Leave_Status_Changed_Email"><label for="Leave_Status_Changed_Email"></label></td>
                            <td><input <?php if(isset($notification->Leave_Status_Changed) && $notification->Leave_Status_Changed->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Leave_Status_Changed_App" id="Leave_Status_Changed_App"><label for="Leave_Status_Changed_App"></label></td>
                        </tr>
                        <tr>
                            <td>Xero_Token_Created</td>
                            <td><input <?php if(isset($notification->Xero_Token_Created) && $notification->Xero_Token_Created->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Xero_Token_Created_Email" id="Xero_Token_Created_Email"><label for="Xero_Token_Created_Email"></label></td>
                            <td><input <?php if(isset($notification->Xero_Token_Created) && $notification->Xero_Token_Created->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Xero_Token_Created_App" id="Xero_Token_Created_App"><label for="Xero_Token_Created_App"></label></td>
                        </tr>
                        <tr>
                            <td>Kidsoft_Servicekey</td>
                            <td><input <?php if(isset($notification->Kidsoft_Servicekey) && $notification->Kidsoft_Servicekey->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Kidsoft_Servicekey_Email" id="Kidsoft_Servicekey_Email"><label for="Kidsoft_Servicekey_Email"></label></td>
                            <td><input <?php if(isset($notification->Kidsoft_Servicekey) && $notification->Kidsoft_Servicekey->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Kidsoft_Servicekey_App" id="Kidsoft_Servicekey_App"><label for="Kidsoft_Servicekey_App"></label></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="button-class">
                    <button class="button">
                        <i>
                            <img src="<?php echo base_url('assets/images/icons/save.png'); ?>" style="max-height:0.8rem;margin-right:10px">
                        </i>Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- <div class="loading">
        <div class="loader"></div>
    </div> -->

    <div class="modal-logout">
        <div class="modal-content-logout">
            <h3>You have been logged out!!</h3>
            <h4><a href="<?php echo base_url(); ?>">Click here</a> to login</h4>
        </div>
    </div>

<script type="text/javascript">
	$(document).ready(()=>{
		if($(document).width() > 1024){
		    $('.containers').css('paddingLeft',$('.side-nav').width());
		}
    });

	function remove_loader_icon(){
		$('.loading').hide();
	};
	function loader_icon(){
		$('.loading').show();
	};

    <?php if(isset($error)){ ?>
      var modal = document.querySelector(".modal-logout");
      function toggleModal() {
        modal.classList.toggle("show-modal");
      }
	  $(document).ready(function(){
	  	toggleModal();	
	  })
	<?php } ?>
</script>

</body>
</html>