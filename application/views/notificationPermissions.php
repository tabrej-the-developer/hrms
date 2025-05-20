<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Notification Settings</title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
	
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
<?php $permissions = json_decode($permissions);
      $notification = json_decode($notifications);
?>
    <input type="text" id="emplId" value="<?php echo $this->session->userdata('LoginId'); ?>" style="display:none">
    <div class="containers scrollY">
        <div class="permission-container settingsContainer">
            <span class="d-flex pageHead heading-bar">
                <div class="withBackLink">
                <a href="<?php echo base_url();?>/settings">
                    <span class="material-icons-outlined">arrow_back</span>
                </a>				
                            <span class="events_title">Notification Settings</span>
                        </div>
            </span>

            <form method="POST" action="postNotificationSettings" class="permission-container-child">
                <div  class="table-div pageTableDiv">
                    <table class="table">
                        <thead>
                            <th>Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">App</th>
                        </thead>
                        <tbody id="tbody">
                        <tr>
                            <td>Meeting_Created</td>
                            <td class="text-center"><input <?php if(isset($notification->Meeting_Created) && $notification->Meeting_Created->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Meeting_Created_Email" id="Meeting_Created_Email"><label for="Meeting_Created_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Meeting_Created) && $notification->Meeting_Created->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Meeting_Created_App" id="Meeting_Created_App"><label for="Meeting_Created_App"></label></td>
                        </tr>
                        <tr>
                            <td>Meeting_Ended</td>
                            <td class="text-center"><input <?php if(isset($notification->Meeting_Ended) && $notification->Meeting_Ended->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Meeting_Ended_Email" id="Meeting_Ended_Email"><label for="Meeting_Ended_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Meeting_Ended) && $notification->Meeting_Ended->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Meeting_Ended_App" id="Meeting_Ended_App"><label for="Meeting_Ended_App"></label></td>
                        </tr>
                        <tr>
                            <td>Birthday_Anniversary</td>
                            <td class="text-center"><input <?php if(isset($notification->Birthday_Anniversary) && $notification->Birthday_Anniversary->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Birthday_Anniversary_Email" id="Birthday_Anniversary_Email"><label for="Birthday_Anniversary_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Birthday_Anniversary) && $notification->Birthday_Anniversary->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Birthday_Anniversary_App" id="Birthday_Anniversary_App"><label for="Birthday_Anniversary_App"></label></td>
                        </tr>
                        <tr>
                            <td>Shift_Updated</td>
                            <td class="text-center"><input <?php if(isset($notification->Shift_Updated) && $notification->Shift_Updated->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Shift_Updated_Email" id="Shift_Updated_Email"><label for="Shift_Updated_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Shift_Updated) && $notification->Shift_Updated->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Shift_Updated_App" id="Shift_Updated_App"><label for="Shift_Updated_App"></label></td>
                        </tr>
                        <tr>
                            <td>Roster_Published</td>
                            <td class="text-center"><input <?php if(isset($notification->Roster_Published) && $notification->Roster_Published->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Roster_Published_Email" id="Roster_Published_Email"><label for="Roster_Published_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Roster_Published) && $notification->Roster_Published->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Roster_Published_App" id="Roster_Published_App"><label for="Roster_Published_App"></label></td>
                        </tr>
                        <tr>
                            <td>Shift_Status_Changed</td>
                            <td class="text-center"><input <?php if(isset($notification->Shift_Status_Changed) && $notification->Shift_Status_Changed->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Shift_Status_Changed_Email" id="Shift_Status_Changed_Email"><label for="Shift_Status_Changed_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Shift_Status_Changed) && $notification->Shift_Status_Changed->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Shift_Status_Changed_App" id="Shift_Status_Changed_App"><label for="Shift_Status_Changed_App"></label></td>
                        </tr>
                        <tr>
                            <td>Roster_Permission</td>
                            <td class="text-center"><input <?php if(isset($notification->Roster_Permission) && $notification->Roster_Permission->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Roster_Permission_Email" id="Roster_Permission_Email"><label for="Roster_Permission_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Roster_Permission) && $notification->Roster_Permission->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Roster_Permission_App" id="Roster_Permission_App"><label for="Roster_Permission_App"></label></td>
                        </tr>
                        <tr>
                            <td>Timesheet_Published</td>
                            <td class="text-center"><input <?php if(isset($notification->Timesheet_Published) && $notification->Timesheet_Published->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Timesheet_Published_Email" id="Timesheet_Published_Email"><label for="Timesheet_Published_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Timesheet_Published) && $notification->Timesheet_Published->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Timesheet_Published_App" id="Timesheet_Published_App"><label for="Timesheet_Published_App"></label></td>
                        </tr>
                        <tr>
                            <td>Payroll_Flagged</td>
                            <td class="text-center"><input <?php if(isset($notification->Payroll_Flagged) && $notification->Payroll_Flagged->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Payroll_Flagged_Email" id="Payroll_Flagged_Email"><label for="Payroll_Flagged_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Payroll_Flagged) && $notification->Payroll_Flagged->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Payroll_Flagged_App" id="Payroll_Flagged_App"><label for="Payroll_Flagged_App"></label></td>
                        </tr>
                        <tr>
                            <td>Payroll_Published</td>
                            <td class="text-center"><input <?php if(isset($notification->Payroll_Published) && $notification->Payroll_Published->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Payroll_Published_Email" id="Payroll_Published_Email"><label for="Payroll_Published_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Payroll_Published) && $notification->Payroll_Published->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Payroll_Published_App" id="Payroll_Published_App"><label for="Payroll_Published_App"></label></td>
                        </tr>
                        <tr>
                            <td>Notice_Created</td>
                            <td class="text-center"><input <?php if(isset($notification->Notice_Created) && $notification->Notice_Created->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Notice_Created_Email" id="Notice_Created_Email"><label for="Notice_Created_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Notice_Created) && $notification->Notice_Created->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Notice_Created_App" id="Notice_Created_App"><label for="Notice_Created_App"></label></td>
                        </tr>
                        <tr>
                            <td>Employee_Profile_Updated</td>
                            <td class="text-center"><input <?php if(isset($notification->Employee_Profile_Updated) && $notification->Employee_Profile_Updated->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Employee_Profile_Updated_Email" id="Employee_Profile_Updated_Email"><label for="Employee_Profile_Updated_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Employee_Profile_Updated) && $notification->Employee_Profile_Updated->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Employee_Profile_Updated_App" id="Employee_Profile_Updated_App"><label for="Employee_Profile_Updated_App"></label></td>
                        </tr>
                        <tr>
                            <td>Employee_Synced_With_Xero</td>
                            <td class="text-center"><input <?php if(isset($notification->Employee_Synced_With_Xero) && $notification->Employee_Synced_With_Xero->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Employee_Synced_With_Xero_Email" id="Employee_Synced_With_Xero_Email"><label for="Employee_Synced_With_Xero_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Employee_Synced_With_Xero) && $notification->Employee_Synced_With_Xero->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Employee_Synced_With_Xero_App" id="Employee_Synced_With_Xero_App"><label for="Employee_Synced_With_Xero_App"></label></td>
                        </tr>
                        <tr>
                            <td>Password_Updated</td>
                            <td class="text-center"><input <?php if(isset($notification->Password_Updated) && $notification->Password_Updated->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Password_Updated_Email" id="Password_Updated_Email"><label for="Password_Updated_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Password_Updated) && $notification->Password_Updated->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Password_Updated_App" id="Password_Updated_App"><label for="Password_Updated_App"></label></td>
                        </tr>
                        <tr>
                            <td>Center_Added_Removed</td>
                            <td class="text-center"><input <?php if(isset($notification->Center_Added_Removed) && $notification->Center_Added_Removed->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Center_Added_Removed_Email" id="Center_Added_Removed_Email"><label for="Center_Added_Removed_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Center_Added_Removed) && $notification->Center_Added_Removed->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Center_Added_Removed_App" id="Center_Added_Removed_App"><label for="Center_Added_Removed_App"></label></td>
                        </tr>
                        <tr>
                            <td>Level_Changed</td>
                            <td class="text-center"><input <?php if(isset($notification->Level_Changed) && $notification->Level_Changed->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Level_Changed_Email" id="Level_Changed_Email"><label for="Level_Changed_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Level_Changed) && $notification->Level_Changed->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Level_Changed_App" id="Level_Changed_App"><label for="Level_Changed_App"></label></td>
                        </tr>
                        <tr>
                            <td>Employee_Role_Changed</td>
                            <td class="text-center"><input <?php if(isset($notification->Employee_Role_Changed) && $notification->Employee_Role_Changed->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Employee_Role_Changed_Email" id="Employee_Role_Changed_Email"><label for="Employee_Role_Changed_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Employee_Role_Changed) && $notification->Employee_Role_Changed->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Employee_Role_Changed_App" id="Employee_Role_Changed_App"><label for="Employee_Role_Changed_App"></label></td>
                        </tr>
                        <tr>
                            <td>Employee_Area_Changed</td>
                            <td class="text-center"><input <?php if(isset($notification->Employee_Area_Changed) && $notification->Employee_Area_Changed->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Employee_Area_Changed_Email" id="Employee_Area_Changed_Email"><label for="Employee_Area_Changed_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Employee_Area_Changed) && $notification->Employee_Area_Changed->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Employee_Area_Changed_App" id="Employee_Area_Changed_App"><label for="Employee_Area_Changed_App"></label></td>
                        </tr>
                        <tr>
                            <td>Leave_Applied</td>
                            <td class="text-center"><input <?php if(isset($notification->Leave_Applied) && $notification->Leave_Applied->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Leave_Applied_Email" id="Leave_Applied_Email"><label for="Leave_Applied_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Leave_Applied) && $notification->Leave_Applied->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Leave_Applied_App" id="Leave_Applied_App"><label for="Leave_Applied_App"></label></td>
                        </tr>
                        <tr>
                            <td>Leave_Status_Changed</td>
                            <td class="text-center"><input <?php if(isset($notification->Leave_Status_Changed) && $notification->Leave_Status_Changed->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Leave_Status_Changed_Email" id="Leave_Status_Changed_Email"><label for="Leave_Status_Changed_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Leave_Status_Changed) && $notification->Leave_Status_Changed->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Leave_Status_Changed_App" id="Leave_Status_Changed_App"><label for="Leave_Status_Changed_App"></label></td>
                        </tr>
                        <tr>
                            <td>Xero_Token_Created</td>
                            <td class="text-center"><input <?php if(isset($notification->Xero_Token_Created) && $notification->Xero_Token_Created->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Xero_Token_Created_Email" id="Xero_Token_Created_Email"><label for="Xero_Token_Created_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Xero_Token_Created) && $notification->Xero_Token_Created->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Xero_Token_Created_App" id="Xero_Token_Created_App"><label for="Xero_Token_Created_App"></label></td>
                        </tr>
                        <tr>
                            <td>Kidsoft_Servicekey</td>
                            <td class="text-center"><input <?php if(isset($notification->Kidsoft_Servicekey) && $notification->Kidsoft_Servicekey->isEmailYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Kidsoft_Servicekey_Email" id="Kidsoft_Servicekey_Email"><label for="Kidsoft_Servicekey_Email"></label></td>
                            <td class="text-center"><input <?php if(isset($notification->Kidsoft_Servicekey) && $notification->Kidsoft_Servicekey->isAppYN == "Y"){ echo "checked"; } ?> type="checkbox" name="Kidsoft_Servicekey_App" id="Kidsoft_Servicekey_App"><label for="Kidsoft_Servicekey_App"></label></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="formSubmit mt20 mb10">
                    <button class="button btn btn-default btn-small btnBlue pull-right">
                        <span class="material-icons-outlined">save</span> Save
                    </button>
                </div>
            </form>
        </div>
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