<!DOCTYPE html>
<html>
<head>
	<title>Edit Employee</title>
 
	<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css');?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css');?>">
  
<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<style>
.navbar-nav .nav-item-header:nth-of-type(8) {
    background: var(--blue2) !important;
    position: relative;
}
.navbar-nav .nav-item-header:nth-of-type(8)::after {
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
	<!-- <script>
		$(document).ready(function(){
			alert("Hello world");
		});
	</script> -->

<div class="wrapperContainer">
	<?php include 'headerNew.php'; ?>
<?php 
	$employeeData = json_decode($getEmployeeData);
	$superfunds = json_decode($superfunds);
?>
<div class="containers scrollY">
    <div class="settingsContainer ">

		<span class="d-flex pageHead heading-bar">
			<div class="withBackLink">
				<a onclick="goBack()" href="#">
				<span class="material-icons-outlined">arrow_back</span>
				</a>				
				<span class="events_title">Edit Employee</span>
			</div>
			<div class="rightHeader">
			</div>
		</span>
	
		<div class="addEmployee-container">
			<div class="addEmployee-container-child">
				<?php $permissions = json_decode($permissions); ?>
				<?php // if(isset($permissions->permissions) ? $permissions->permissions->editEmployeeYN : "N" == "N"){ ?>
					<section class="tab-buttons">
						<div class="tab-buttons-div">
						<span class="nav-button e-s"><span>Personal</span></span>
						<span class="nav-button e-b-a-s"><span>Bank Account</span></span>
						<span class="nav-button e-s-s"><span> Superannuation </span></span>
						<span class="nav-button e-t-d-s"><span>Tax Declaration </span></span>
						<span class="nav-button e-u-s"><span>Employment</span></span>	
						<span class="nav-button c-t"><span>Courses</span></span>
						<span class="nav-button m-i"><span>Medical Info</span></span>
						<span class="nav-button d-c"><span>Documents</span></span>
						<span class="hover"></span>
						</div>	
					</section>
					<form method="POST" action="<?php echo base_url('settings/updateEmployeeProfile/').$employeeId;?>" style="height: 100%" enctype="multipart/form-data" id="formSubmit">
						<section class="employee-section">	
							<!-- <h3>Personal</h3> -->

							<?php /* 
							<span class="span-class profileImage_parent col-3" style="width: auto !important">
								<span style="height:100px;width:100px">

									<?php if(file_exists('api/application/assets/profileImages/'.$employeeData->employee->userid.'.png') && filesize("api/application/assets/profileImages/".$employeeData->employee->userid.".png") > 0){
									?>
										<img src="<?php echo BASE_API_URL."application/assets/profileImages/".$employeeData->employee->userid.".png"?>" style="height:100px;width:100px;border-radius:0.5rem">
										<?php
									}else{

										if($this->session->has_userdata('Name')){
													$side_bar_name =  $this->session->userdata('Name');
													$side_bar_name = explode(' ',$side_bar_name);
													$userid = $this->session->userdata('LoginId');
										}
										?>

										<span class="user_profileImage icon-parent">
											<span class=" icon"><?php echo isset($side_bar_name[0]) ? icon($side_bar_name[0]) : ""; ?></span>
										</span>
									<?php } ?>
								</span>
								<span class="d-block">
									<input id="profileImage" class="profileImage" type="FILE" name="profileImage">
								</span>
							</span> */ ?>

							<span class="span-class profileImage_parent col-3" style="width: auto !important">
								<span style="height:100px;width:100px">
									<?php if(file_exists('api/application/assets/profileImages/'.$employeeData->employee->userid.'.png') && filesize("api/application/assets/profileImages/".$employeeData->employee->userid.".png") > 0){?>
										<img src="<?php echo BASE_API_URL."application/assets/profileImages/".$employeeData->employee->userid.".png"?>" style="height:100px;width:100px;border-radius:0.5rem">
										<?php }else{

										if($this->session->has_userdata('Name')){
													$side_bar_name =  $this->session->userdata('Name');
													$side_bar_name = explode(' ',$side_bar_name);
													$userid = $this->session->userdata('LoginId');
										}
										?>

										<span class="user_profileImage icon-parent">
											<span class=" icon"><?php echo isset($side_bar_name[0]) ? icon($side_bar_name[0]) : ""; ?></span>
										</span>
									<?php } ?>
								</span>
								<span class="d-block col-md-3 inputfile-box mb30">
									<input id="profileImage" class="profileImage inputfile" type="FILE" name="profileImage" onchange="uploadFile(this)">
									<label for="profileImage">
										<span id="file-name" class="file-box"></span>
										<span class="file-button">
											<span class="material-icons-outlined">publish</span>
										Select File
										</span>
									</label>
								</span>
							</span>


							<span class="d-flex">							
								<div class="col-md-3">
									<div class="form-floating">
										<select placeholder="Title" id="title"  class="form-control" type="text" name="title" value="<?php echo isset($employeeData->employee->title) ? $employeeData->employee->title : ''; ?>"> 
											<option value="Ms">Ms</option> 
											<option value="Mr">Mr</option>
											<option value="Mrs">Mrs</option>
										</select>
										<label for="title" class="labels__">Title</label>
									</div>
								</div>			
								<div class="col-md-3">
									<div class="form-floating">
										<input placeholder="First Name" id="fname"  class="form-control" type="text" name="fname" value="<?php echo isset($employeeData->employee->fname) ? $employeeData->employee->fname : ''; ?>" >
										<label for="fname" class="labels__">First Name<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating">
										<input placeholder="Middle Name" id="mname"  class="form-control" type="text" name="mname" value="<?php echo isset($employeeData->employee->mname) ? $employeeData->employee->mname : ''; ?>">
										<label id="mname" class="labels__">Middle Name</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating">
										<input placeholder="Last Name" id="lname"  class="form-control" type="text" name="lname" value="<?php echo isset($employeeData->employee->lname) ? $employeeData->employee->lname : ''; ?>">
										<label for="lname" class="labels__">Last Name<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>" ></sup></label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating">
										<input placeholder="Alias" id="alias"  class="form-control" type="text" name="alias" value="<?php echo isset($employeeData->users->alias) ? $employeeData->users->alias : ''; ?>">
										<label for="alias" class="labels__">Alias</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating">
										<input placeholder="Date Of Birth" id="dateOfBirth"  class="form-control" type="date" name="dateOfBirth" value="<?php echo isset($employeeData->employee->dateOfBirth) ? $employeeData->employee->dateOfBirth : ''; ?>">
										<label for="dateOfBirth" class="labels__">Date Of Birth<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating">
										<?php $gender = isset($employeeData->employee->gender) ? $employeeData->employee->gender : ''; ?>
										<select placeholder="Gender" id="gender"  class="form-control" name="gender" value="<?php echo $gender ?>">
											<option value="N" <?php echo ($gender == 'N') ? 'selected' : "" ?>>Not Given</option>
											<option value="M" <?php echo ($gender == 'M') ? 'selected' : "" ?>>Male</option>
											<option value="F" <?php echo ($gender == 'F') ? 'selected' : "" ?>>Female</option>
											<option value="I" <?php echo ($gender == 'I') ? 'selected' : "" ?>>Non binary</option>
										</select>	
										<label for="gender" class="labels__">Gender</label>
									</div>
								</div>

							</span>

							<hr>
			
							<span class="d-flex">	
								<div class="col-md-3">
									<div class="form-floating">
										<input placeholder="Home Address Line1" id="homeAddLine1"  class="form-control" type="text" name="homeAddLine1" value="<?php echo isset($employeeData->employee->homeAddLine1) ? $employeeData->employee->homeAddLine1 : ''; ?>">
										<label for="homeAddLine1" class="labels__">Home Address Line1</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating">
										<input placeholder="Home Address Line2" id="homeAddLine2"  class="form-control" type="text" name="homeAddLine2" value="<?php echo isset($employeeData->employee->homeAddLine2) ? $employeeData->employee->homeAddLine2 : ''; ?>">
										<label for="homeAddLine2" class="labels__">Home Address Line2</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating">
										<input  type="text" placeholder="City" id="homeAddCity"  class="form-control"  name="homeAddCity" value="<?php echo isset($employeeData->employee->homeAddCity) ? $employeeData->employee->homeAddCity : ''; ?>">
										<label for="homeAddCity" class="labels__">City</label>
									</div>
								</div>	
								<div class="col-md-3">
									<div class="form-floating">
										<select placeholder="Region" id="homeAddRegion"  class="form-control" type="text" name="homeAddRegion" value="<?php echo isset($employeeData->employee->homeAddRegion) ? $employeeData->employee->homeAddRegion : ''; ?>">
											<option value="ACT">Australian Capital Territory</option>
											<option value="NSW">New South Wales</option>
											<option value="NT">Northern Territory</option>
											<option value="QLD">Queensland </option>
											<option value="SA">South Australia</option>
											<option value="TAS">Tasmania </option>
											<option value="VIC">Victoria</option>
											<option value="WA">Western Australia</option>
										</select>
										<label for="homeAddRegion" class="labels__">Region</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating">
										<input placeholder="Postal" id="homeAddPostal"  class="form-control" type="text" name="homeAddPostal" value="<?php echo isset($employeeData->employee->homeAddPostal) ? $employeeData->employee->homeAddPostal : ''; ?>">
										<label for="homeAddPostal" class="labels__">Postal</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating">
										<input placeholder="Country" id="homeAddCountry"  class="form-control" type="text" name="homeAddCountry" value="<?php echo isset($employeeData->employee->homeAddCountry) ? $employeeData->employee->homeAddCountry : ''; ?>">
										<label for="homeAddCountry" class="labels__">Country</label>
									</div>
								</div>
							</span>
							<hr>
							<span class="d-flex">
								<div class="col-md-3">
									<div class="form-floating">
										<input placeholder="Emergency Contact" id="emergency_contact"  class="form-control" type="text" name="emergency_contact" value="<?php echo isset($employeeData->employee->emergency_contact) ? $employeeData->employee->emergency_contact : ''; ?>">
										<label for="emergency_contact">Emergency Contact</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating">
										<input placeholder="Relationship" id="relationship"  class="form-control" type="text" name="relationship" value="<?php echo isset($employeeData->employee->relationship) ? $employeeData->employee->relationship : ''; ?>">
										<label for="relationship">Relationship</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating">
										<input placeholder="Emergency Contact Email" id="emergency_contact_email"  class="form-control" type="email" name="emergency_contact_email" value="<?php echo isset($employeeData->employee->emergency_contact_email) ? $employeeData->employee->emergency_contact_email : ''; ?>">
										<label for="emergency_contact_email">Emergency Contact Email</label>
									</div>
								</div>
							</span>
			
						</section>

						
						<section class="employee-bank-account-section">
							<h3 class="add_remove_bank_account">Bank Account 
								<span class="add-remove-row">
									<span class="remove-row btn btn-default btn-small pull-right"><span class="material-icons-outlined">highlight_off</span> Remove </span>
									<span class="add-row btn btn-default btn-small btnBlue pull-right"><span class="material-icons-outlined">add_circle_outline</span> Add </span>
								</span>
							</h3>

							<div class="parent-child">
								<?php 
								$eba = $employeeData->employeeBankAccount;
								for($i=0;$i<count($employeeData->employeeBankAccount);$i++){ ?>
									<div class="child">
										<div class="statement"></div>
									
										<div class="d-flex">
											<div class="col-md-3">
												<div class="form-floating">
													<input placeholder="Account Name" type="text" id="accountName" class="accountName form-control" name="accountName[]" value="<?php echo isset($eba[$i]->accountName) ? $eba[$i]->accountName : ''; ?>">
													<label for="accountName">Account Name</label>
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-floating">
													<input placeholder="BSB" id="bsb" type="text" class="bsb form-control" name="bsb[]" value="<?php echo isset($eba[$i]->bsb) ? $eba[$i]->bsb : ''; ?>">
													<label for="bsb">BSB</label>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-floating">
													<input placeholder="Account Number" id="accountNumber" type="text" class="accountNumber form-control" name="accountNumber[]" value="<?php echo isset($eba[$i]->accountNumber) ? $eba[$i]->accountNumber : ''; ?>">
													<label for="accountNumber">Account Number</label>
												</div>
											</div>
											<div class="amount-class-parent col-md-3">
												<div class="form-floating">
													<input placeholder="Amount" id="amount" type="text" class="amount" name="amount[]" value="<?php echo isset($eba[$i]->amount) ? $eba[$i]->amount : ''; ?>">
													<label for="amount">Amount</label>
												</div>
											</div>
											<?php if($i ==  0){ ?>
												<span class="col-md-3 radioFlex remainder_parent">
													<label>Remainder</label>
													<div class="d-flex">
														<span>
															<label class="yn-label">Yes</label>
															<input value="Y" class="remainderYN yn-input" type="radio" name="remainderYN[]" <?php echo isset($eba[$i]->remainderYN) ? ($eba[$i]->remainderYN == 'Y' ? 'checked' : '') : ''; ?>>
														</span>
														<span>
															<label class="yn-label">No</label>
															<input value="N" class="remainderYN yn-input" type="radio" name="remainderYN[]" <?php echo isset($eba[$i]->remainderYN) ? (($eba[$i]->remainderYN == 'Y') ? 'checked' : '') : ''; ?>>
														</span>
													</div>
												</span>
											<?php   } ?>


										</div>
									</div>
								<?php }
								if(count($eba) == 0){ ?>
									<div class="child">
										<div class="statement"></div>
				
										<div class="d-flex">
											<div class="col-md-3">
												<div class="form-floating">
													<input placeholder="Account Name" type="text" id="accountName" class="accountName form-control" name="accountName[]" >
													<label for="accountName">Account Name</label>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-floating">
													<input placeholder="BSB" id="bsb" type="text" class="bsb form-control" name="bsb[]" >
													<label for="bsb">BSB</label>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-floating">
													<input placeholder="Account Number" type="text" id="accountNumber" class="accountNumber form-control" name="accountNumber[]" >
													<label for="accountNumber">Account Number</label>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-floating">
													<input placeholder="Amount" id="amount" type="text" class="amount form-control" name="amount[]" >
													<label for="amount">Amount</label>
												</div>
											</div>
											<?php if($i ==  0){ ?>
												<span class="span-class col-3 radioFlex remainder_parent">
													<label>Remainder</label>
													<div class="d-flex">
														<span>
															<label class="yn-label">Yes</label>
															<input value="Y" class="remainderYN yn-input" type="radio" name="remainderYN[]" >
														</span>
														<span>
															<label class="yn-label">No</label>
															<input value="N" class="remainderYN yn-input" type="radio" name="remainderYN[]" >
														</span>
													</div>
												</span>
											<?php   } ?>
									</div>
								<?php } ?>
							</div>
						</section>
						
						
						<section class="employee-superfund-section">
							<div class="superAnnoucement"> 
								<div class="form-floating">
									<?php 
										$centers = json_decode($centers); 
										if(isset($centers->centers) && count($centers->centers) > 0){
									?>
									<select name="" id="Superannuation" class="center-select form-control">
										<?php foreach($centers->centers as $center){ ?>
										<option value="<?php echo $center->centerid; ?>"><?php echo $center->name; ?></option>
										<?php } ?>
									</select>
									<?php } ?>
									<label for="Superannuation">Superannuation</label>
								</div>
								<span class="add_remove_superfund">
									<span class="superfund-remove btn btn-default btn-small pull-right"><span class="material-icons-outlined">highlight_off</span> Remove </span>
									<span id="superfund-add" class="btn btn-default btn-small btnBlue pull-right"><span class="material-icons-outlined">add_circle_outline</span> Add </span>
								</span>
							</div>
		
							<div class="superfund-parent">
								<?php 
								$checkSuperfund = count($employeeData->employeeSuperfunds);
								foreach($employeeData->employeeSuperfunds as $supFund){ ?>
									<div class="superfund-child row">
										<span class="col-md-4">						
											<div class="form-floating">
												<select placeholder="Super Fund Id" id="superFundId" class="superFundId form-control" name="superFund[Id][]" value="<?php echo isset($supFund->superFundId) ? $supFund->superFundId : ''; ?>">
												<?php 
												$superFundValue = isset($supFund->superFundId) ? $supFund->superFundId : '';
												foreach($superfunds->superfunds as $superfund){
													if($superFundValue == $superfund->superFundId){
														echo "<option value='$superfund->superFundId' selected>$superfund->name</option>";
													}else{
														echo "<option value='$superfund->superFundId'>$superfund->name</option>";
													}
												}
												?>
												</select>
												<label for="superFundId">Super Fund Id</label>
											</div>
										</span>
										<span class="col-md-4">						
											<div class="form-floating">
												<input placeholder="Super Membership Id" id="superMembership" class="superMembershipId form-control" type="text" name="superFund[MembershipId][]" value="<?php echo isset($supFund->superMembershipId) ? $supFund->superMembershipId : ''; ?>">
												<label for="superMembership">Super Membership Id</label>
											</div>
										</span>
										<span class="col-md-4">						
											<div class="form-floating">
												<input class="employeeNumber form-control" id="superEmpNum" type="text" name="superFund[EmployeeNumber][]" value="<?php echo isset($supFund->employeeNumber) ? $supFund->employeeNumber : ''; ?>">
												<label for="superEmpNum" class="labels__">Employee Number</label>
											</div>
										</span>
									</div>
								<?php }
								if($checkSuperfund == 0){ ?>
									<div class="superfund-child row">
										<span class="col-md-4">
											<div class="form-floating">
												<select placeholder="Super Fund Id" id="superFundId" class="superFundId form-control" name="superFund[Id][]">
												<?php 
												foreach($superfunds->superfunds as $superfund){
														echo "<option value='$superfund->superFundId'>$superfund->name</option>";
												}
												?>
												</select>
												<label for="superFundId">Super Fund Id</label>
											</div>
										</span>
										<span class="col-md-4">
											<div class="form-floating">
												<input placeholder="Super Membership Id" id="superMembershipId" class="superMembershipId form-control" type="text" name="superFund[MembershipId][]" >
												<label for="superMembershipId">Super Membership Id</label>
											</div>
										</span>
										<span class="col-md-4">
											<div class="form-floating">
												<input class="employeeNumber form-control" id="employeeNumber" type="text" name="superFund[EmployeeNumber][]" >
												<label for="employeeNumber" class="labels__">Employee Number</label>
											</div>
										</span>
									</div>
								<?php } ?>

							</div>
						
							<span id="subm" class="saveSuperfund btn btn-default btnOrange btn-small pull-right">SAVE</span>
				
						</section>
						
						<section class="employee-tax-declaration-section">
							<!-- <h3>Employee Tax Declaration Section</h3> -->


							<div class="form-floating">
								<select placeholder="tfnExemptionType" id="tfnExemptionType" class="form-control" name="tfnExemptionType" select="<?php echo isset($employeeData->employeeTaxDeclaration->tfnExemptionType) ? $employeeData->employeeTaxDeclaration->tfnExemptionType : ''; ?>">
									<option value="NONE">NONE</option>
									<option value="NOTQUOTED">NOTQUOTED</option>
									<option value="PENDING">PENDING</option>
									<option value="PENSIONER">PENSIONER</option>
									<option value="UNDER18">UNDER18</option>
								</select>
								<label for="tfnExemptionType">TFN Exemption Type</label>
							</div> 
							<div class="tax-declaration-class col-lg-12">
								<div class="d-flex">
									<span class="span-class col-md-4">
										<div class="form-floating">
											<input placeholder="Tax File Number" class="form-control" id="taxFileNumber" name="taxFileNumber" type="text" value="<?php echo isset($employeeData->employeeTaxDeclaration->taxFileNumber) ? $employeeData->employeeTaxDeclaration->taxFileNumber : ''; ?>">
											<label for="taxFileNumber">Tax File Number</label>
										</div>
									</span>
									<span class="span-class radioFlex col-md-4">
										<label>Australian Resident For TaxPurpose</label>
										<div class="d-flex">
											<span>
												<label class="yn-label">Yes</label>
												<input placeholder="Australian Resident For TaxPurpose" type="radio"  name="australiantResidentForTaxPurposeYN" class="australiantResidentForTaxPurposeYN yn-input" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->australiantResidentForTaxPurposeYN) ? (($employeeData->employeeTaxDeclaration->australiantResidentForTaxPurposeYN == 'Y') ? 'checked' : '') : ''; ?>>
											</span>
											<span>
												<label class="yn-label">No</label>
												<input type="radio" name="australiantResidentForTaxPurposeYN" class="australiantResidentForTaxPurposeYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->australiantResidentForTaxPurposeYN) ? (($employeeData->employeeTaxDeclaration->australiantResidentForTaxPurposeYN == 'N') ? 'checked' : '') : ''; ?>>
											</span>
										</div>
									</span>
									<span class="span-class col-md-4">
										<div class="form-floating">
											<select placeholder="residencyStatue" class="form-control" id="residencyStatue" name="residencyStatue" value="<?php echo isset($employeeData->employeeTaxDeclaration->residencyStatue) ? $employeeData->employeeTaxDeclaration->residencyStatue : ''; ?>">
												<option value="AUSTRALIANRESIDENT">Australian Resident</option>
												<option value="FOREIGNRESIDENT">Foreign Resident</option>
												<option value="WORKINGHOLIDAY">Working Holiday</option>
											</select>
											<label for="residencyStatue">Residency Status</label>
										</div>
									</span>
									<span class="span-class radioFlex col-md-4">
										<label>Tax Free Threshold Claimed</label>
										<div class="d-flex">
											<span>
												<label class="yn-label">Yes</label>
												<input placeholder="taxFreeThresholdClaimedYN" type="radio" name="taxFreeThresholdClaimedYN" class="taxFreeThresholdClaimedYN yn-input" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->taxFreeThresholdClaimedYN) ? (($employeeData->employeeTaxDeclaration->taxFreeThresholdClaimedYN == 'Y') ? 'checked' : '') : ''; ?>>
											</span>
											<span>
												<label class="yn-label">No</label>
												<input type="radio" name="taxFreeThresholdClaimedYN" class="taxFreeThresholdClaimedYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->taxFreeThresholdClaimedYN) ? (($employeeData->employeeTaxDeclaration->taxFreeThresholdClaimedYN == 'N') ? 'checked' : '') : ''; ?>>
											</span>
										</div>
									</span>
									<span class="span-class col-md-4">
										<div class="form-floating">
											<input placeholder="Tax Offset Estimated Amount" class="form-control" id="taxOffsetEstimatedAmount" type="number" name="taxOffsetEstimatedAmount" value="<?php echo isset($employeeData->employeeTaxDeclaration->taxOffsetEstimatedAmount) ? $employeeData->employeeTaxDeclaration->taxOffsetEstimatedAmount : ''; ?>">
											<label for="taxOffsetEstimatedAmount">Tax Offset Estimated Amount</label>
										</div>
									</span>
									<span class="span-class radioFlex col-md-4">
										<label>Has HELP Debt</label>
										<div class="d-flex">
											<span>
												<label class="yn-label">Yes</label>
												<input placeholder="hasHELPDebtYN" name="hasHELPDebtYN" class="hasHELPDebtYN yn-input" value="Y" type="radio" <?php echo isset($employeeData->employeeTaxDeclaration->hasHELPDebtYN) ? (($employeeData->employeeTaxDeclaration->hasHELPDebtYN == 'Y') ? 'checked' : '') : ''; ?>>
											</span>
											<span>
												<label class="yn-label">No</label>
												<input type="radio" name="hasHELPDebtYN" class="hasHELPDebtYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->hasHELPDebtYN) ? (($employeeData->employeeTaxDeclaration->hasHELPDebtYN == 'N') ? 'checked' : '') : ''; ?>>	
											</span>
										</div>
									</span>
									<span class="span-class radioFlex col-md-4">
										<label>Has SFSS Debt</label>
										<div class="d-flex">
											<span>
												<label class="yn-label">Yes</label>
												<input placeholder="hasSFSSDebtYN" type="radio" name="hasSFSSDebtYN" class="hasSFSSDebtYN yn-input" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->hasSFSSDebtYN) ? (($employeeData->employeeTaxDeclaration->hasSFSSDebtYN == 'Y') ? 'checked' : '') : ''; ?>>
											</span>
											<span>
												<label class="yn-label">No</label>
												<input type="radio" name="hasSFSSDebtYN" class="hasSFSSDebtYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->hasSFSSDebtYN) ? (($employeeData->employeeTaxDeclaration->hasSFSSDebtYN == 'N') ? 'checked' : '') : ''; ?>>
											</span>
										</div>
									</span>
									<span class="span-class radioFlex col-md-4">
										<label>Has Trade Support Loan Debt</label>
										<div class="d-flex">
											<span>
												<label class="yn-label">Yes</label>
												<input placeholder="hasTradeSupportLoanDebtYN" type="radio" name="hasTradeSupportLoanDebtYN " class="hasTradeSupportLoanDebtYN yn-input" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->hasTradeSupportLoanDebtYN) ? (($employeeData->employeeTaxDeclaration->hasTradeSupportLoanDebtYN == 'Y') ? 'checked' : '') : ''; ?>>
											</span>
											<span>
												<label class="yn-label">No</label>
												<input type="radio" name="hasTradeSupportLoanDebtYN " class="hasTradeSupportLoanDebtYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->hasTradeSupportLoanDebtYN) ? (($employeeData->employeeTaxDeclaration->hasTradeSupportLoanDebtYN == 'N') ? 'checked' : '') : ''; ?>>
											</span>
										</div>
									</span>
									<span class="span-class col-md-4">
										<div class="form-floating">
											<input placeholder="Upward Variation Tax Witholding Amount" class="form-control" id="upwardVariationTaxWitholdingAmount" name="upwardVariationTaxWitholdingAmount" type="number" value="<?php echo isset($employeeData->employeeTaxDeclaration->upwardVariationTaxWitholdingAmount) ? $employeeData->employeeTaxDeclaration->upwardVariationTaxWitholdingAmount : ''; ?>">
											<label for="upwardVariationTaxWitholdingAmount">Upward Variation Tax Witholding Amount</label>
										</div>
									</span>
									<span class="span-class radioFlex col-md-4">
										<label>Eligible To Receive Leave Loading</label>
										<div class="d-flex">
											<span>
												<label class="yn-label">Yes</label>
												<input placeholder="eligibleToReceiveLeaveLoadingYN" type="radio" class="eligibleToReceiveLeaveLoadingYN yn-input" name="eligibleToReceiveLeaveLoadingYN" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->eligibleToReceiveLeaveLoadingYN) ? (($employeeData->employeeTaxDeclaration->eligibleToReceiveLeaveLoadingYN == 'Y') ? 'checked' : '') : ''; ?>>
											</span>
											<span>
												<label class="yn-label">No</label>
												<input type="radio" name="eligibleToReceiveLeaveLoadingYN" class="eligibleToReceiveLeaveLoadingYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->eligibleToReceiveLeaveLoadingYN) ? (($employeeData->employeeTaxDeclaration->eligibleToReceiveLeaveLoadingYN == 'N') ? 'checked' : '') : ''; ?>>
											<span>
										</div>
									</span>
									<span class="span-class col-md-4">
										<div class="form-floating">
											<input placeholder="Approved Witholding Variation Percentage" class="form-control" id="approvedWitholdingVariationPercentage" name="approvedWitholdingVariationPercentage" type="number" value="<?php echo isset($employeeData->employeeTaxDeclaration->approvedWitholdingVariationPercentage) ? $employeeData->employeeTaxDeclaration->approvedWitholdingVariationPercentage : ''; ?>">
											<label for="approvedWitholdingVariationPercentage">Approved Witholding Variation Percentage</label>
										</div>
									</span>
									
								</div>
							</div>
						</section>

						<section class="employee-details">
							<div class="d-flex">
								<span class="span-class col-md-4" style="display:none">
									<div class="form-floating">
										<input placeholder="Employee Number" class="form-control" id="employee_no" type="text" name="employee_no" value="<?php echo isset($employeeData->employee->userid) ? $employeeData->employee->userid : ''; ?>">
										<label for="employee_no">Employee Number</label>
									</div>
								</span>
								<span class="span-class col-md-4" style="display:none">
									<div class="form-floating">
										<input placeholder="Xero Employee Id" class="form-control" id="xeroEmployeeId" type="text" name="xeroEmployeeId" value="<?php echo isset($employeeData->employee->xeroEmployeeId) ? $employeeData->employee->xeroEmployeeId : ''; ?>">
										<label for="xeroEmployeeId">Xero Employee Id</label>
									</div>
								</span>
							</div>


							<div class="d-flex">
								<span class="span-class col-md-4">
									<div class="form-floating">
										<input placeholder="Highest-qual-held" class="form-control" id="highest_qual_held" name="highest_qual_held" type="text"  value="<?php echo isset($employeeData->employeeRecord->highestQualHeld) ? $employeeData->employeeRecord->highestQualHeld : ''; ?>">
										<label for="highest_qual_held">Highest qual held</label>
									</div>
								</span>
								<span class="span-class col-md-4">
									<div class="form-floating">
										<input placeholder="Date Obtained" class="form-control" id="highest_qual_date_obtained" name="highest_qual_date_obtained" type="date"  value="<?php echo isset($employeeData->employeeRecord->highestQualDateObtained) ? $employeeData->employeeRecord->highestQualDateObtained : ''; ?>">
										<label for="highest_qual_date_obtained">Date Obtained</label>
									</div>
								</span>
								<span class="span-class col-md-4">
									<div class="form-floating">
										<input placeholder="Date Obtained" class="form-control" id="highest_qual_cert" name="highest_qual_cert" type="text" value=" ">
										<label for="highest_qual_cert">Highest Qualification Certificate</label>
									</div>
								</span>
								<!-- 		<span class="span-class col-3">
											<label>Highest-qual-type	 </label>
											<input placeholder="Highest-qual-type" id="highest_qual_type" type="text">
										</span>
								-->		
								<span class="span-class col-md-4">
									<div class="form-floating">
										<input placeholder="Qual-towards-desc" class="form-control" id="qual_towards_desc" name="qual_towards_desc" type="text" value="<?php echo isset($employeeData->employeeRecord->qualWorkingTowards) ? $employeeData->employeeRecord->qualWorkingTowards : ''; ?>">
										<label for="qual_towards_desc">Qualification working Toward</label>
									</div>
								</span>
								<span class="span-class col-md-4">
									<div class="form-floating">
										<input placeholder="Qual towards % comp" class="form-control" id="qual_towards_percent_comp" name="qual_towards_percent_comp" type="number" value="<?php echo isset($employeeData->employeeRecord->qualTowardsPercentcomp) ? $employeeData->employeeRecord->qualTowardsPercentcomp : ''; ?>">
										<label for="qual_towards_percent_comp">Qual towards % comp</label>
									</div>
								</span>

								<!-- 		<span class="span-class col-3">
											<label>	Workcover</label>
											<input placeholder="Workcover" id="workcover" type="text">
										</span>
										<span class="span-class col-3">
											<label>	PIAWE</label>
											<input placeholder="PIAWE" id="piawe" type="text">
										</span>
										<span class="span-class col-3">
											<label>	Annual-leave-in-contract</label>
											<input placeholder="Annual-leave-in-contract" id="annual_leave_in_contract" type="text">
										</span> -->
								<span class="span-class col-md-4">
									<div class="form-floating">
										<input placeholder="Classification" id="classification" class="form-control" name="classification" type="text" value="<?php echo isset($employeeData->employee->classification) ? $employeeData->employee->classification : ''; ?>">
										<label for="classification">Classification</label>
									</div>
								</span>
								<span class="span-class col-md-4">
									<div class="form-floating">
										<select placeholder="Ordinary Earning Rate Id" class="form-control" id="ordinaryEarningRateId" name="ordinaryEarningRateId" type="text" value="<?php echo isset($employeeData->employee->ordinaryEarningRateId) ? $employeeData->employee->ordinaryEarningRateId : ''; ?>">

										</select>
										<label for="ordinaryEarningRateId">Ordinary Earning Rate Id</label>
									</div>
								</span>

								<!-- 		<span class="span-class col-3">
											<label>Payroll Calendar</label>
											<input placeholder="Payroll Calendar" id="payroll_calendar" name="payroll_calendar" type="text" value="<?php echo isset($employeeData->employee->payrollCalendarId) ? $employeeData->employee->payrollCalendarId : ''; ?>">
										</span> -->

								<span class="span-class radioFlex col-md-4">
									<label>Visa Holder</label>
									<div class="d-flex">
										<span>
											<label class="yn-label">Yes</label>
											<input  type="radio" name="visa_holder" class="visa_holder yn-input" value="Y" <?php echo isset($employeeData->employeeRecord->visaHolderYN) ? (($employeeData->employeeRecord->visaHolderYN == 'Y') ? 'checked' : '') : ''; ?>>
										</span>
										<span>
											<label class="yn-label">No</label>
											<input type="radio" name="visa_holder" class="visa_holder yn-input" value="N" <?php echo isset($employeeData->employeeRecord->visaHolderYN) ? (($employeeData->employeeRecord->visaHolderYN == 'N') ? 'checked' : '') : ''; ?>>
										</span>
									</div>
								</span>
								<span class="span-class col-md-4">
									<div class="form-floating">
										<input placeholder="Visa-type" id="visa_type" class="form-control" name="visa_type" type="text" value="<?php echo isset($employeeData->employeeRecord->visaType) ? $employeeData->employeeRecord->visaType : ''; ?>">
										<label for="visa_type">Visa type</label>
									</div>
								</span>
								<span class="span-class col-md-4">
									<div class="form-floating">
										<input placeholder="Visa-grant-date" id="visa_grant_date" class="form-control" name="visa_grant_date" type="date" value="<?php echo isset($employeeData->employeeRecord->visaGrantDate) ? $employeeData->employeeRecord->visaGrantDate : ''; ?>">
										<label for="visa_grant_date">Visa Grant Date</label>
									</div>
								</span>
								<span class="span-class col-md-4">
									<div class="form-floating">
										<input placeholder="Visa-end-date" class="form-control" id="visa_end_date" name="visa_end_date" type="date" value="<?php echo isset($employeeData->employeeRecord->visaEndDate) ? $employeeData->employeeRecord->visaEndDate : ''; ?>">
										<label for="visa_end_date">Visa End Date</label>
									</div>
								</span>
								<span class="span-class col-md-4">
									<div class="form-floating">
										<input placeholder="Visa-conditions" class="form-control" id="visa_conditions" name="visa_conditions" type="text" value="<?php echo isset($employeeData->employee->visaConditions) ? $employeeData->employee->visaConditions : ''; ?>">
										<label for="visa_conditions">	Visa Conditions</label>
									</div>
								</span>
								<span class="span-class col-md-4">
									<div class="form-floating">
										<input placeholder="Termination Date" id="terminationDate"  class="form-control" type="date" name="terminationDate" value="<?php echo isset($employeeData->employee->terminationDate) ? $employeeData->employee->terminationDate : ''; ?>">
										<label for="terminationDate">Termination Date</label>
									</div>
								</span>

							</div>
						</section>

						<section class="courses-tab">
							<?php $toCount = isset($employeeData->employeeCourses) ? $employeeData->employeeCourses : ''; 
								// count($toCount)
								for($i=0;$i<count($toCount);$i++){ ?>
									<div class="courses_div">
										<input type="text" name="course_id[]" style="display:none" value="<?php echo isset($employeeData->employeeCourses[$i]->id) ? $employeeData->employeeCourses[$i]->id : ''; ?>">
						
										<div class="d-flex">
											<span class="span-class col-md-3">
												<div class="form-floating">
													<input placeholder="Course Name" id="course_Name" class="course_name form-control" name="course_name[]" type="text" value="<?php echo isset($employeeData->employeeCourses[$i]->courseName) ? $employeeData->employeeCourses[$i]->courseName : ''; ?>">
													<label for="course_Name">Course Name</label>
												</div>
											</span>
											<span class="span-class col-md-3">
												<div class="form-floating">
													<input placeholder="Date Obtained" id="date_obtained" class="date_obtained form-control" name="date_obtained[]" type="date" value="<?php echo isset($employeeData->employeeCourses[$i]->dateObtained) ? $employeeData->employeeCourses[$i]->dateObtained : ''; ?>">
													<label for="date_obtained">Date Obtained</label>
												</div>
											</span>
											<span class="span-class col-md-3">
												<div class="form-floating">
													<input placeholder="Certificate" id="Certificate" class="certificate form-control" name="certificate[]" type="FILE">
													<label for="Certificate">Certificate </label>
												</div>
											</span>
											<span class="span-class col-md-3">
												<div class="form-floating">
													<input placeholder="Expiry Date" id="expiry_date" class="expiry_date form-control" name="expiry_date[]" type="date" value="<?php echo isset($employeeData->employeeCourses[$i]->courseExpiryDate) ? date('Y-m-d',strtotime($employeeData->employeeCourses[$i]->courseExpiryDate)) : ''; ?>">
													<label for="expiry_date">Expiry Date</label>
												</div>
											</span>
											<span class="span-class col-md-12">
												<div class="form-floating">
													<textarea placeholder="Course Description" id="course_description" class="course_description form-control" name="course_description[]" type="text" value="" inputType="textarea"><?php echo isset($employeeData->employeeCourses[$i]->courseDescription) ? $employeeData->employeeCourses[$i]->courseDescription : ''; ?></textarea>
													<label for="course_description">Course Description</label>
												</div>
											</span>
											<?php if( isset($employeeData->employeeCourses[$i]->id) ){ ?>
												<span class="course_delete" courseId="<?php echo isset($employeeData->employeeCourses[$i]->id) ? $employeeData->employeeCourses[$i]->id : ''; ?>">Delete</span>
											<?php } ?>
										</div>
									</div>
								<?php } ?>
								<div class="courses_buttons">
									<span class="remove_course btn btn-default btn-small pull-right"><span class="material-icons-outlined">highlight_off</span> Remove</span>
									<span class="add_course btn btn-default btn-small btnBlue pull-right"><span class="material-icons-outlined">add_circle_outline</span> Add</span>
								</div>

								<div class="courses_div_new">
									<input type="text" name="course_id[]" style="display:none" value="">
									<div class="d-flex">
										<span class="span-class col-md-3">
											<div class="form-floating">
												<input placeholder="Course Name" id="course_name" class="course_name form-control" name="course_name[]" type="text" value="">
												<label for="course_name">Course Name</label>
											</div>
										</span>
										<span class="span-class col-md-3">
											<div class="form-floating">
												<input placeholder="Date Obtained" id="date_obtained" class="date_obtained form-control" name="date_obtained[]" type="date" value="">
												<label for="date_obtained">Date Obtained</label>
											</div>
										</span>
										<span class="col-md-3 inputfile-box">
											<input placeholder="Certificate" id="certificate" class="certificate form-control inputfile" name="certificate[]" type="FILE" onchange="uploadFile2(this)">
											<label for="certificate">
												<span id="file-name2" class="file-box"></span>
												<span class="file-button">
													<span class="material-icons-outlined">publish</span>
													Select File
												</span>
											</label>
										</span>
										<span class="span-class col-md-3">
											<div class="form-floating">
												<input placeholder="Expiry Date" id="expiry_date" class="expiry_date form-control" name="expiry_date[]" type="date" value="">
												<label for="expiry_date">Expiry Date</label>
											</div>
										</span>
										<span class="span-class col-md-12">
											<div class="form-floating">
												<textarea placeholder="Course Description" id="course_description" class="course_description form-control" name="course_description[]" type="text" value="" inputType="textarea"></textarea>
												<label for="course_description">Course Description</label>
											</div>
										</span>
									</div>
								</div>
						</section>

						<section class="medical-info">
							<div class="d-flex">
								<span class="span-class col-md-3">
									<div class="form-floating">
										<input  type="text" id="medicareNo" name="medicareNo" class="medicareNo form-control" value="<?php echo isset($employeeData->employeeMedicalInfo->medicareNo) ? $employeeData->employeeMedicalInfo->medicareNo : ''; ?>">
										<label for="medicareNo">Medicare Number</label>
									</div>
								</span>
								<span class="span-class col-md-3">
									<div class="form-floating">
										<input  type="text" id="medicareRefNo" name="medicareRefNo" class="medicareRefNo form-control" value="<?php echo isset($employeeData->employeeMedicalInfo->medicareRefNo) ? $employeeData->employeeMedicalInfo->medicareRefNo : ''; ?>">
										<label for="medicareRefNo">Medicare Reference Number</label>
									</div>
								</span>
								<span class="span-class col-md-3">
									<div class="form-floating">
										<input  type="text" id="healthInsuranceFund" name="healthInsuranceFund" class="healthInsuranceFund form-control" value="<?php echo isset($employeeData->employeeMedicalInfo->healthInsuranceFund) ? $employeeData->employeeMedicalInfo->healthInsuranceFund : ''; ?>">
										<label for="healthInsuranceFund">Health Insurance Fund</label>
									</div>
								</span>
								<span class="span-class col-md-3">
									<div class="form-floating">
										<input  type="text" id="healthInsuranceNo" name="healthInsuranceNo" class="healthInsuranceNo form-control" value="<?php echo isset($employeeData->employeeMedicalInfo->healthInsuranceNo) ? $employeeData->employeeMedicalInfo->healthInsuranceNo : ''; ?>">
										<label for="healthInsuranceNo">Health Insurance Number</label>
									</div>
								</span>
								<span class="span-class col-md-3">
									<div class="form-floating">
										<input  type="text" id="ambulanceSubscriptionNo" name="ambulanceSubscriptionNo" class="ambulanceSubscriptionNo form-control"  value="<?php echo isset($employeeData->employeeMedicalInfo->ambulanceSubscriptionNo) ? $employeeData->employeeMedicalInfo->ambulanceSubscriptionNo : ''; ?>">
										<label for="ambulanceSubscriptionNo">Ambulance Subscription Number</label>
									</div>
								</span>
							</div>
							<?php $toSize = isset($employeeData->employeeMedicals) ? $employeeData->employeeMedicals : ''; ?>
							<?php for($i=0;$i<count($toSize);$i++){ ?>
							<input type="text" name="medicals_id[]" style="display:none" value="<?php echo isset($employeeData->employeeMedicals[$i]->id) ? $employeeData->employeeMedicals[$i]->id : ''; ?>">
			
								<div class="d-flex">
									<span class="span-class col-md-3">
										<div class="form-floating">
											<input id="medicalConditions" type="text"  name="medicalConditions[]" class="medicalConditions form-contol" value="<?php echo isset($employeeData->employeeMedicals[$i]->medicalConditions) ? $employeeData->employeeMedicals[$i]->medicalConditions : ''; ?>">
											<label for="medicalConditions">Medical Conditions</label>
										</div>
									</span>
									<span class="span-class col-md-3">
										<div class="form-floating">
											<input  type="text" id="medicalAllergies"  name="medicalAllergies[]" class="medicalAllergies form-contol" value="<?php echo isset($employeeData->employeeMedicals[$i]->medicalAllergies) ? $employeeData->employeeMedicals[$i]->medicalAllergies : ''; ?>">
											<label for="medicalAllergies">Medical Allergies</label>
										</div>
									</span>
									<span class="span-class col-md-3">
										<div class="form-floating">
											<input  type="text" id="medication" name="medication[]" class="medication form-contol" value="<?php echo isset($employeeData->employeeMedicals[$i]->medication) ? $employeeData->employeeMedicals[$i]->medication : ''; ?>">
											<label for="medication">Medication</label>
										</div>
									</span>
									<span class="span-class col-md-3">
										<div class="form-floating">
											<input  type="text" id="dietaryPreferences" name="dietaryPreferences[]" class="dietaryPreferences form-contol" value="<?php echo isset($employeeData->employeeMedicals[$i]->dietaryPreferences) ? $employeeData->employeeMedicals[$i]->dietaryPreferences : ''; ?>">
											<label for="dietaryPreferences">Dietary Preferences</label>
										</div>
									</span>
								</div>

							<?php } ?>
						</section>


						<section class="documents-tab">
							<div class="addRemoveDocument">
								<span class="addRemoveDocumentSpan btn btn-default btn-small btnBlue pull-right">
									<span class="material-icons-outlined">add_circle_outline</span> Add
								</span>
							</div>
			
							<div class="addDocumentsDiv template_table">

								<table class="documentsTable">
									<tr style="text-align:center">
										<th>Document Name</th>
										<th>Download</th>
										<th>Delete</th>
									</tr>
									<tr>
										<td>Resume Document </td>
										<td class="singleDocDownload"><span class="btn btn-default btn-small btn-diable">Download</span></td>
										<td><input  id="resume_doc" name="resume_doc" type="file" value=" "></td>
									</tr>
									<tr>
										<td>Contract Document</td>
										<td class="singleDocDownload"><span class="btn btn-default btn-small btn-diable">Download</span></td>
										<td><input  id="contract_doc" name="contract_doc" type="file" value=" "></td>
									</tr>
									<?php foreach($employeeData->employeeDocuments as $docs){ ?>
										<tr class="singleDocBlock">
											<td class="singleDocName"><?php echo $docs->name ?></td>
											<td class="singleDocDownload">
												<a class="btn btn-default btn-small btnBlue" href="<?php echo DOCUMENTS_PATH.($docs->document) ?>" download>Download</a>
											</td>
											<td><button class="deleteDocument btn btn-default btn-small btnOrange" docId="<?php echo $docs->id ?>">Delete</button></td>
										</tr>
									<?php } ?>
									<tr class="addSingleDocument">
										<td><input type="text" name="addFileName[]"></td>
										<td><input type="FILE" name="addFile[]" class="addFile"></td>
										<td><span class="removeDocumentButton btn btn-default btn-small btnOrange">Remove</span></td>
									</tr>
								</table>
							</div>
						</section>

						<div class="submit-div editEmpSubmit">
							<button id="subm" class="btn btn-deault btn-small btnOrange pull-right" type="submit">
								<span class="material-icons-outlined">send</span> Submit
							</button>
						</div>
					</form>
	<?php // } ?>
			</div>
		</div>
	</div>
</div>

<!-- Notification -->
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
<!-- Notification -->
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
		$(document).on('click','.e-b-a-s',function(){
			$('.employee-bank-account-section').css('display','block')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','none');
			$('.medical-info').css('display','none');
			$('.documents-tab').css('display','none');
			$('.courses-tab').css('display','none');
		})
		$(document).on('click','.e-s',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','block');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','none');
			$('.medical-info').css('display','none');
			$('.documents-tab').css('display','none');
			$('.courses-tab').css('display','none');
		})
		$(document).on('click','.e-s-s',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','block');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','none');
			$('.medical-info').css('display','none');
			$('.documents-tab').css('display','none');
			$('.courses-tab').css('display','none');
		})
		$(document).on('click','.e-t-d-s',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','block');
			$('.employee-details').css('display','none');
			$('.medical-info').css('display','none');
			$('.documents-tab').css('display','none');
			$('.courses-tab').css('display','none');
		})
		$(document).on('click','.e-u-s',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','block');
			$('.medical-info').css('display','none');
			$('.documents-tab').css('display','none');
			$('.courses-tab').css('display','none');
		})
		$(document).on('click','.m-i',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','none');
			$('.medical-info').css('display','block');
			$('.documents-tab').css('display','none');
			$('.courses-tab').css('display','none');
		})
		$(document).on('click','.d-c',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','none');
			$('.medical-info').css('display','none');
			$('.documents-tab').css('display','block');
			$('.courses-tab').css('display','none');
		})
		$(document).on('click','.c-t',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','none');
			$('.medical-info').css('display','none');
			$('.documents-tab').css('display','none');
			$('.courses-tab').css('display',' block');
		})
	})

	var new_child = $('.parent-child ').children('.child')[0].outerHTML;

	$(document).on('click','.add-row',function(){
		$('.parent-child').append(new_child);
				accountCount();
			console.log(new_child)
	});
	function accountCount(){
		var count = $('.statement').length;
			for(x=0 ; x< count ; x++){
			$('.statement').eq(x).text('Account '+ (x+1))
		}
	}

	accountCount();
		
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.add-row',function(){
			var count = $('.statement').length;
			if(count > 1){
				$('.amount-class-parent').eq(0).empty();
				$('.remainderYN[value="Y"]').eq(0).prop('checked',true);
				for(i = 1 ; i < count ; i++){
					$('.remainder_parent').eq(i).css('display','none')
					$('.remainderYN[value="Y"]').eq(i).attr('name','remaindeYN-'+i);
					$('.remainderYN[value="N"]').eq(i).attr('name','remaindeYN-'+i);
					$('.remainderYN[value="N"]').eq(i).prop('checked',true);
					$('.remainderYN[value="Y"]').eq(i).attr('disabled',true);
					$('.remainderYN[value="N"]').eq(i).attr('disabled',true);

					}
					
				}
			});
					$('.amount-class').eq(0).css('display','none')
					$('.remainderYN[value="Y"]').eq(0).prop('checked',true);
		});
</script>
<script type="text/javascript">
	
$(document).ready(function(){
	var saved = $('.tax-declaration-class').html();
	$(document).on('change','#tfnExemptionType',function(){
		if($('#tfnExemptionType').val() == 'NONE'){
			$('.tax-declaration-class').append(saved);
		}
		else{
			$('.tax-declaration-class').empty();
		}
	})
	if($('#tfnExemptionType').val() != 'NONE'){
		$('.tax-declaration-class').empty();
	}
})
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#center').change(function(){
	var id = this.value;
	var url = "<?php echo base_url();?>settings/addEmployee/"+id;
	console.log(id)
	$.ajax({
		url:url,
		type:'GET',
		success:function(response){
			// $('body').html($(response).find('#area'))
			$('#area-select').html($(response).find('#area'))
			$('#role-select').html($(response).find('#role'))
			for(x=0;x<$('#role').children().length;x++){
					$('#role').children('option').eq(x).css('display','none')
			}
				}
			})
		})
	});
</script>

<script type="text/javascript">
		for(x=0;x<$('#role').children().length;x++){
		if($('#role').children('option').eq(x).attr('area-id') == 1){
			
		}
		else{
			$('#role').children('option').eq(x).css('display','none')
		}
	}



	$(document).on('change','#area',function(){
	var areaId = this.value;
	console.log(areaId);
	for(x=0;x<$('#role').children().length;x++){
		if($('#role').children('option').eq(x).attr('area-id') == areaId){
			$('#role').children('option').eq(x).css('display','block')
		}
		else{
			$('#role').children('option').eq(x).css('display','none')
		}

		console.log($('#role').children('option').eq(x).attr('area-id'))
			}
		});


</script>


<script type="text/javascript">
	$(document).ready(function(){
		var superfundHTML = $('.superfund-child')[0].outerHTML;
		$(document).on('click','#superfund-add',function(){
			$('.superfund-parent').append(superfundHTML);
		})
	})

	$(document).on('change','.center-select',function(){
			var userid = "<?php echo $employeeId ?>";
			var centerid = $(this).val();
			var url = "<?php echo base_url() ?>settings/superfundByCenter/"+centerid+"/"+userid;
			$.ajax({
				url : url,
				success : function(response){
					var encode = JSON.parse(response);
					var empsups = encode.empSuperfunds;
					var sups = encode.superfunds;
					var code = "";
					empsups.forEach(function(empsup){
						var option = "";
						sups.forEach(function(sup){
							if(sup.superfundId == empsup.superFundId){
								option +=`<option value="${sup.superfundId}" selected>${sup.name}</option>`
							}else{
								option +=`<option value="${sup.superfundId}">${sup.name}</option>`
							}
						})
						code += `<div class='superfund-child row'>
							<span class='span-class col-3'>
								<label>Super Fund Id</label>
								<span class='select_css'>
									<select placeholder='Super Fund Id' class='superFundId' name='superFund[Id][]'>${option}</select>
								</span>
							</span>
							<span class='span-class col-3'>
								<label>Super Membership Id</label>
								<input placeholder='Super Membership Id' class='superMembershipId' type='text' name='superFund[MembershipId][]' value='${empsup.superMembershipId}'>
							</span>
							<span class='span-class col-3'>
								<label class='labels__'>Employee Number</label>
								<input class='employeeNumber' type='text' name='superFund[EmployeeNumber][]' value='${empsup.employeeNumber}'>
							</span>
						</div>`; 	
					})
					$('.superfund-parent').html(code)
				}
			})
		})

	$(document).on('click','.saveSuperfund',function(){
		var userid = "<?php echo $employeeId ?>";
		var centerid = $('.center-select').val();
		var url = `<?php echo base_url() ?>settings/saveSuperfundByCenter/${centerid}/${userid}`;
		var values = [];
		var obj = {};
		$('.superfund-child').each(function(child){
			obj = {};
			obj.superfundId = $(this).find('select').val();
			obj.superMembershipId = $(this).find('.superMembershipId').val();
			obj.employeeNumber = $(this).find('.employeeNumber').val();
			values.push(obj);
		})
		console.log(values)
		$.ajax({
			url : url,
			type: 'POST',
			data : {
				values : values
			},
			success : function(response){
				console.log(response)
			}
		})
	})
</script>

<script type="text/javascript">
	$(document).ready(()=>{
			$('.e-s span').addClass('arrow');
        $('.e-s').click(function(){
        	$('.e-s span').addClass('arrow');
					$('.e-b-a-s span').removeClass('arrow');
					$('.e-s-s span').removeClass('arrow');
					$('.e-t-d-s span').removeClass('arrow');
					$('.e-u-s span').removeClass('arrow');
					$('.m-i span').removeClass('arrow');
					$('.d-c span').removeClass('arrow');
					$('.c-t span').removeClass('arrow');
        })
        $('.e-b-a-s').click(function(){
        	$('.e-s span').removeClass('arrow');
					$('.e-b-a-s span').addClass('arrow');
					$('.e-s-s span').removeClass('arrow');
					$('.e-t-d-s span').removeClass('arrow');
					$('.e-u-s span').removeClass('arrow');
					$('.m-i span').removeClass('arrow');
					$('.d-c span').removeClass('arrow');
					$('.c-t span').removeClass('arrow');
        })
        $('.e-s-s').click(function(){
        	$('.e-s span').removeClass('arrow');
					$('.e-b-a-s span').removeClass('arrow');
					$('.e-s-s span').addClass('arrow');
					$('.e-t-d-s span').removeClass('arrow');
					$('.e-u-s span').removeClass('arrow');
					$('.m-i span').removeClass('arrow');
					$('.d-c span').removeClass('arrow');
					$('.c-t span').removeClass('arrow');
        })
        $('.e-t-d-s').click(function(){
        	$('.e-s span').removeClass('arrow');
					$('.e-b-a-s span').removeClass('arrow');
					$('.e-s-s span').removeClass('arrow');
					$('.e-t-d-s span').addClass('arrow');
					$('.e-u-s span').removeClass('arrow');
					$('.m-i span').removeClass('arrow');
					$('.d-c span').removeClass('arrow');
					$('.c-t span').removeClass('arrow');
        })
        $('.e-u-s').click(function(){
        	$('.e-s span').removeClass('arrow');
					$('.e-b-a-s span').removeClass('arrow');
					$('.e-s-s span').removeClass('arrow');
					$('.e-t-d-s span').removeClass('arrow');
					$('.e-u-s span').addClass('arrow');
					$('.m-i span').removeClass('arrow');
					$('.d-c span').removeClass('arrow');
					$('.c-t span').removeClass('arrow');
        })
        $('.m-i').click(function(){
        	$('.e-s span').removeClass('arrow');
					$('.e-b-a-s span').removeClass('arrow');
					$('.e-s-s span').removeClass('arrow');
					$('.e-t-d-s span').removeClass('arrow');
					$('.e-u-s span').removeClass('arrow');
					$('.m-i span').addClass('arrow');
					$('.d-c span').removeClass('arrow');
					$('.c-t span').removeClass('arrow');
        })
        $('.d-c').click(function(){
        	$('.e-s span').removeClass('arrow');
					$('.e-b-a-s span').removeClass('arrow');
					$('.e-s-s span').removeClass('arrow');
					$('.e-t-d-s span').removeClass('arrow');
					$('.e-u-s span').removeClass('arrow');
					$('.m-i span').removeClass('arrow');
					$('.d-c span').addClass('arrow');
					$('.c-t span').removeClass('arrow');
        })
        $('.c-t').click(function(){
        	$('.e-s span').removeClass('arrow');
					$('.e-b-a-s span').removeClass('arrow');
					$('.e-s-s span').removeClass('arrow');
					$('.e-t-d-s span').removeClass('arrow');
					$('.e-u-s span').removeClass('arrow');
					$('.m-i span').removeClass('arrow');
					$('.d-c span').removeClass('arrow');
					$('.c-t span').addClass('arrow');
        })
    });

    $(document).on('click','.superfund-remove',function(){
    	var superfundLength = $('.superfund-child').length ;
    	if(superfundLength > 1){
    		$('.superfund-child').eq(length-1).remove();
    	} 
    })
    $(document).on('click','.remove-row',function(){
    	var bankLength = $('.child').length ;
    	if(bankLength > 1){
    		$('.child').eq(length-1).remove();
    	} 
    })

    $(document).ready(function(){
    	var block = $('.addSingleDocument')[0].outerHTML;
    	var parent = $('.singleDocBlock').eq(0).parent();
    	$(document).on('click','.addRemoveDocumentSpan',function(){
    		$('.documentsTable').append(block);
    	})

    	$(document).on('click','.removeDocumentButton',function(){
    		$(this).closest('.addSingleDocument').remove();
    	})

	    $(document).on('click','.deleteDocument',function(){
	    	var docId = $(this).attr('docId')
	    	var url = '<?php echo base_url();?>settings/deleteDocument/'+docId;
	    	$.ajax({
	    		url : url,
	    		type : 'GET',
	    		success : function(response){
	    			window.location.reload();
	    		}
	    	})
	    })

	    var course = $('.courses_div_new')[0].outerHTML;
	    $(document).on('click','.add_course',function(){
	    	var len = ($('.courses_div_new').length)-1;
	    	if(len < 0)
	    		$('.courses_buttons').after(course)
	    	else
					$('.courses_div_new').eq(len).after(course);
	    })
	    $(document).on('click','.remove_course',function(){
	    	var len = ($('.courses_div_new').length)-1;
		    	$('.courses_div_new').eq(len).remove();
	    })

	    $(document).on('click','.course_delete',function(){
	    	var courseId = $(this).attr('courseId');
	    	var url = '<?php echo base_url();?>settings/DeleteCourse/'+courseId;
	    	$.ajax({
	    		url : url,
	    		type : 'GET',
	    		success: function(response){
					window.location.href = "<?php echo base_url('settings/editEmployee'); ?>";
	    		}
	    	})
	    })

    })

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
  // Notification //

  function onFormSubmit(e){
			e.preventDefault();
			var falseOrTrue = true;
			if(!(/^[a-zA-Z]+$/).test($('#fname').val()) ){
		      	addMessageToNotification('Enter First Name');
		      	showNotification();
		     	setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}
			if(!(/^[a-zA-Z]+$/).test($('#lname').val())){
		        addMessageToNotification('Enter Last Name');
		      	showNotification();
		        setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}
			if($('#dateOfBirth').val() == null || $('#dateOfBirth').val() == ""){
		    	addMessageToNotification('Enter DOB');
		      	showNotification();
		        setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}
			if($('#phone').val() == null || $('#phone').val() == ""   ){
		        addMessageToNotification('Enter Phone Number');
		      	showNotification();
		        setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}
			if($('#alias').val() == null || ! ($('#alias').val() == "" ||  (/^[a-zA-Z]+$/).test($('#alias').val())) ){
		        addMessageToNotification('Invalid Alias');
		      	showNotification();
		        setTimeout(closeNotification,5000)
					falseOrTrue = false;
			}
			// if( !( (/\b^[a-zA-Z]+[\s]*[a-zA-Z]+$\b/).test($('#homeAddCity').val())) ){
		    //     addMessageToNotification('Invalid City');
		    //   	showNotification();
		    //     setTimeout(closeNotification,5000)
			// 		falseOrTrue = false;
			// }
			if( $('#homeAddPostal').val() == null || !(  $('#homeAddPostal').val() == ""  || (/^[0-9]+$/).test($('#homeAddPostal').val() ) ) ){
		        addMessageToNotification('Invalid Postal Code');
		      	showNotification();
		        setTimeout(closeNotification,5000)
					falseOrTrue = false;
			}
			// if( $('#homeAddCountry').val() == null || !(  $('#homeAddCountry').val() == ""  || (/^[0-9]+$/).test($('#homeAddCountry').val() ) ) ){
		    //     addMessageToNotification('Invalid Country');
		    //   	showNotification();
		    //     setTimeout(closeNotification,5000)
			// 		falseOrTrue = false;
			// }
			// if( $('#phone').val() == null || !( $('#phone').val() == "" || (/^[0-9]{6,}$/).test($('#phone').val() ) )  ){
		    //     addMessageToNotification('Invalid Phone');
		    //   	showNotification();
		    //     setTimeout(closeNotification,5000)
			// 		falseOrTrue = false;
			// }
			// if( $('#mobile').val() == null || $('#mobile').val() == "" || !((/^[0-9]{6,}$/).test($('#mobile').val() ) )  ){
		    //     addMessageToNotification('Invalid mobile');
		    //   	showNotification();
		    //     setTimeout(closeNotification,5000)
			// 		falseOrTrue = false;
			// }
			if( $('#emergency_contact').val() == null || $('#emergency_contact').val() == "" || !(  (/^[0-9]{6,}$/).test($('#emergency_contact').val() ) )  ){
		        addMessageToNotification('Invalid Emergency Contact');
		      	showNotification();
		        setTimeout(closeNotification,5000)
					falseOrTrue = false;
			}
			if(falseOrTrue){
				document.getElementById('formSubmit').submit();
			}
			return falseOrTrue;
		}

		function uploadFile(target) {
			document.getElementById("file-name").innerHTML = target.files[0].name;
		}
		function uploadFile2(target) {
			document.getElementById("file-name2").innerHTML = target.files[0].name;
		}

</script>
</body>
</html>
