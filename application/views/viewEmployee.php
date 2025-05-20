<!DOCTYPE html>
<html>
<head>
<title>View Employee</title>
<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">
  
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
<div class="wrapperContainer">
	<?php include 'headerNew.php'; ?>
	<div class="containers scrollY">
		<div class="settingsContainer ">
			
			
			<span class="d-flex pageHead heading-bar">
				<div class="withBackLink">
					<a href="<?php echo base_url('settings/viewEmployeeTable');?>">
					<span class="material-icons-outlined">arrow_back</span>
					</a>				
					<span class="events_title">View &nbsp;&nbsp;<span class="employeeNameView"></span> </span>
				</div>
				<div class="rightHeader">
					<?php 
						$employeeData = json_decode($getEmployeeData);
						$permissions = json_decode($permissions);
						$centers = json_decode($centers);
					?>
					<!--<span class="select_css">
					<select placehdr="Center" id="centerValue" name="centerValue" onchange="getEmployees()">
					<?php 

					foreach($centers->centers as $center){ ?> 
						<option value="<?php echo $center->centerid;?>"><?php echo $center->name;?></option>
					<?php } 
					$centerId = "";
					foreach($centers->centers as $center){ 
							$centerId = $centerId . $center->centerid . "|";
					} ?>
					</select>
					</span>
					<span class="select_css">
					<select placehdr="Employee" id="employeeValue" name="employeeValue" onchange="getEmployeeProfile()">

					</select>
					</span> -->
					<span class="syncXeroEmployees">
						<button class="button btn btn-default btn-small btnOrange pull-right" id="XeroEmployees" >
							<img src="<?php echo base_url('assets/images/icons/xero.png'); ?>" style="max-height:2rem;margin-right:10px">Sync Xero Employee
						</button>
					</span>
				</div>
			</span>


			<div class="addEmployee-container">
				<div class="addEmployee-container-child">
					<?php // if(isset($permissions->permissions) ? $permissions->permissions->viewEmployeeYN : "N" == "Y"){ ?>
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
					<form  style="height: 100%" id="employeeProfileId" onsubmit="return false">
						<section class="employee-section">	
							<!-- <h3>Personal</h3> -->


							<!-- <span class="span-class col-3" style="width:10rem;">
								<label class="labels__">Profile Image</label>
								<span style="height:100px;width:100px;border-radius:0.5rem">
									<?php if(file_exists("api/application/assets/profileImages/".$employeeId.".png")){ ?>
									<img style="border-radius:0.5rem" src="<?php echo BASE_API_URL."application/assets/profileImages/".$employeeId.".png" ?>" height="100px" width="100px">
								<?php }else{ 
										$empName = isset($employeeData->employee->fname) ? $employeeData->employee->fname : "";
									?>
									<span class="user_profileImage icon-parent">
										<span class=" icon"><?php echo isset($empName[0]) ? icon($empName[0]) : ""; ?></span>
									</span>
								<?php } ?>
								</span>
							</span> -->

							<span class="span-class profileImage_parent col-3" style="width: auto !important">
								<span style="height:100px;width:100px">
									
									<?php if(file_exists("api/application/assets/profileImages/".$employeeId.".png")){ ?>
										<img style="border-radius:0.5rem" src="<?php echo BASE_API_URL."application/assets/profileImages/".$employeeId.".png" ?>" height="100px" width="100px">
									<?php }else{ 
										$empName = isset($employeeData->employee->fname) ? $employeeData->employee->fname : "";
									?>

										<span class="user_profileImage icon-parent">
											<span class=" icon"><?php echo isset($empName[0]) ? icon($empName[0]) : ""; ?></span>
										</span>
									<?php } ?>
								</span>								
							</span>

							<span class="d-flex">														
								<div class="col-md-3">
									<div class="form-floating">
										<input disabled   id="title"  class="form-control" type="text" name="title" value="<?php echo isset($employeeData->employee->title) ? $employeeData->employee->title : ''; ?>"> 
										<label for="title" class="labels__">Title</label>
									</div>
								</div>														
								<div class="col-md-3">
									<div class="form-floating">
										<input disabled   id="fname"  class="form-control" type="text" name="fname" value="<?php echo isset($employeeData->employee->fname) ? $employeeData->employee->fname : ''; ?>" required>
										<label for="fname" class="labels__">First Name</label>
									</div>
								</div>													
								<div class="col-md-3">
									<div class="form-floating">
										<input disabled   id="mname"  class="form-control" type="text" name="mname" value="<?php echo isset($employeeData->employee->mname) ? $employeeData->employee->mname : ''; ?>">
										<label for="mname" class="labels__">middle Name</label>
									</div>
								</div>											
								<div class="col-md-3">
									<div class="form-floating">
										<input disabled   id="lname"  class="form-control" type="text" name="lname" value="<?php echo isset($employeeData->employee->lname) ? $employeeData->employee->lname : ''; ?>">
										<label for="lname" class="labels__">Last Name</label>
									</div>
								</div>										
								<div class="col-md-3">
									<div class="form-floating">
										<input disabled   id="alias"  class="form-control" type="text" name="alias" value="<?php echo isset($employeeData->users->alias) ? $employeeData->users->alias : ''; ?>">
										<label for="alias" class="labels__">Alias</label>
									</div>
								</div>									
								<div class="col-md-3">
									<div class="form-floating">
										<input disabled   id="dateOfBirth"  class="form-control" type="text" name="dateOfBirth" value="<?php echo isset($employeeData->employee->dateOfBirth) ? $employeeData->employee->dateOfBirth : ''; ?>">
										<label for="dateOfBirth" class="labels__">Date Of Birth</label>
									</div>
								</div>							
								<div class="col-md-3">
									<div class="form-floating">
										<input disabled   id="gender"  class="form-control" name="gender" value="<?php echo isset($employeeData->employee->gender) ? $employeeData->employee->gender : ''; ?>" type="text">
										<label for="gender" class="labels__">Gender</label>
									</div>
								</div>
							</span>

								<hr>

							<span class="d-flex">		
								<!-- 		<span class="span-class col-3">
									<label class="labels__">Job Title</label>
									<input disabled  placehdr="Job Title" id="jobTitle"  class="" type="text" name="jobTitle" value="<?php //echo isset($employeeData->users->title) ? $employeeData->users->title : ''; ?>">
								</span> -->

								<!-- <label class="labels__">Address</label>	 -->											
								<div class="col-md-3">
									<div class="form-floating">
										<input disabled id="homeAddLine1"  class="form-control" type="text" name="homeAddLine1"	value="<?php echo isset($employeeData->employee->homeAddLine1) ? $employeeData->employee->homeAddLine1 : ''; ?>">
										<label for="homeAddLine1" class="labels__">Home Address Line1</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating">
										<input disabled   id="homeAddLine2"  class="form-control" type="text" name="homeAddLine2"	value="<?php echo isset($employeeData->employee->homeAddLine2) ? $employeeData->employee->homeAddLine2 : ''; ?>">
										<label for="homeAddLine2" class="labels__">Home Address Line2</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating">
										<input disabled   type="text" id="homeAddCity"  class="form-control"  name="homeAddCity" 	value="<?php echo isset($employeeData->employee->homeAddCity) ? $employeeData->employee->homeAddCity : ''; ?>">
										<label for="homeAddCity" class="labels__">City</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating">
										<input disabled   id="homeAddRegion"  class="form-control" type="text" name="homeAddRegion" value="<?php echo isset($employeeData->employee->homeAddRegion) ? $employeeData->employee->homeAddRegion : ''; ?>">
										<label for="homeAddRegion" class="labels__">Region</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating">
										<input disabled  id="homeAddPostal"  class="form-control" type="text" name="homeAddPostal" value="<?php echo isset($employeeData->employee->homeAddPostal) ? $employeeData->employee->homeAddPostal : ''; ?>">
										<label for="homeAddPostal" class="labels__">Postal</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating">
										<input disabled   id="homeAddCountry"  class="form-control" type="text" name="homeAddCountry" value="<?php echo isset($employeeData->employee->homeAddCountry) ? $employeeData->employee->homeAddCountry : ''; ?>">
										<label for="homeAddCountry" class="labels__">Country</label>
									</div>
								</div>
							</span>

							<hr>

							<span class="d-flex">

								<div class="col-md-3">
									<div class="form-floating">
										<input disabled   id="phone"  class="form-control" type="text" name="phone" value="<?php echo isset($employeeData->employee->phone) ? $employeeData->employee->phone : ''; ?>">
										<label for="phone" class="labels__">Phone</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating">
										<input disabled   id="mobile"  class="form-control" type="text" name="mobile" value="<?php echo isset($employeeData->employee->mobile) ? $employeeData->employee->mobile : ''; ?>">
										<label for="mobile" class="labels__">Mobile</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating">
										<input disabled   id="emails"  class="form-control" type="text" name="emails" value="<?php echo isset($employeeData->employee->emails) ? $employeeData->employee->emails : ''; ?>">
										<label for="emails" class="labels__">Email</label>
									</div>
								</div>						

								<!-- 		<span class="span-class col-3">
									<label class="labels__">created_at</label>
									<input disabled  placehdr="created_at" id="created_at"  class="" type="text">
								</span>
								<span class="span-class col-3">
									<label class="labels__">created_by</label>
									<input disabled  placehdr="created_by" id="created_by"  class="" type="text">
								</span> -->
							
								<div class="col-md-3">
									<div class="form-floating">
										<input disabled  id="emergency_contact"  class="form-control" type="text" name="emergency_contact" value="<?php echo isset($employeeData->employee->emergency_contact) ? $employeeData->employee->emergency_contact : ''; ?>">
										<label for="emergency_contact" class="labels__">Emergency Contact</label>
									</div>
								</div>	
							
								<div class="col-md-3">
									<div class="form-floating">
										<input disabled   id="relationship"  class="form-control" type="text" name="relationship" value="<?php echo isset($employeeData->employee->relationship) ? $employeeData->employee->relationship : ''; ?>">
										<label for="relationship" class="labels__">Relationship</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating">
										<input disabled   id="emergency_contact_email"  class="form-control" type="email" name="emergency_contact_email" value="<?php echo isset($employeeData->employee->emergency_contact_email) ? $employeeData->employee->emergency_contact_email : ''; ?>">
										<label for="emergency_contact_email" class="labels__">Emergency Contact Email</label>
									</div>
								</div>	
							</span>			
						</section>

						<section class="employee-bank-account-section">
							<div class="parent-child">
								<div class="child">
									<div class="statement"></div>
									<!-- 		<span class="span-class col-3">
										<label class="labels__">Statement Text</label>
										<input disabled  placehdr="Statement Text" type="text" class="statementText" >
									</span> -->
									<div class="d-flex">
										<div class="col-md-3">
											<div class="form-floating">
												<input disabled  id="accountName" type="text" class="accountName form-control" name="accountName" value="<?php echo isset($employeeData->employeeBankAccount->accountName) ? $employeeData->employeeBankAccount->accountName : ''; ?>">
												<label for="accountName">Account Name</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-floating">
												<input disabled  id="bsb" type="text" class="bsb  form-control" name="bsb" value="<?php echo isset($employeeData->employeeBankAccount->bsb) ? $employeeData->employeeBankAccount->bsb : ''; ?>">
												<label for="bsb">BSB</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-floating">
												<input disabled  id="accountNumber" type="text" class="accountNumber  form-control" name="accountNumber" value="<?php echo isset($employeeData->employeeBankAccount->accountNumber) ? $employeeData->employeeBankAccount->accountNumber : ''; ?>">
												<label for="accountNumber">Account Number</label>
											</div>
										</div>
										<span class="col-md-3 radioFlex remainder_parent">
											<label>Remainder</label>
											<div class="d-flex">
												<span>
													<label class="yn-label">Yes</label>
													<input disabled  value="Y" class="remainderYN yn-input" type="radio" name="remainderYN" <?php echo isset($employeeData->employeeBankAccount->remainderYN) ? ($employeeData->employeeBankAccount->remainderYN == 'Y' ? 'checked' : '') : ''; ?>>
												</span>
												<span>
													<label class="yn-label">No</label>
													<input disabled  value="N" class="remainderYN yn-input" type="radio" name="remainderYN" <?php echo isset($employeeData->employeeBankAccount->remainderYN) ? (($employeeData->employeeBankAccount->remainderYN == 'N') ? 'checked' : '') : ''; ?>>
												</span>
											</div>
										</span>
										<div class="col-md-3">
											<div class="form-floating">
												<input disabled  id="amount" type="text" class="amount  form-control" name="amount" value="<?php echo isset($employeeData->employeeBankAccount->amount) ? $employeeData->employeeBankAccount->amount : ''; ?>">
												<label for="amount">Amount</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>

						<section class="employee-superfund-section">
							<!-- 		<span class="span-class col-3">
								<label class="labels__">Employee Id</label>
								<input disabled  placehdr="Employee Id" id="employeeId" >
							</span> -->
							<div class="superfund-parent">
								<div class="superfund-child row">
									
									<span class="col-md-4">						
										<div class="form-floating">
											<input disabled id="superFundId" type="text" class="superFundId form-control" name="superFundId" value="<?php echo isset($employeeData->employeeSuperfunds->name) ? $employeeData->employeeSuperfunds->name : ''; ?>">
											<label for="superFundId">Super Fund name</label>
										</div>
									</span>
									<span class="col-md-4">						
										<div class="form-floating">
											<input disabled  id="superMembershipId" class="superMembershipId form-control" type="text" name="superMembershipId" value="<?php echo isset($employeeData->employeeSuperfunds->superMembershipId) ? $employeeData->employeeSuperfunds->superMembershipId : ''; ?>">
											<label for="superMembershipId">Super Membership Id</label>
										</div>
									</span>

									<span class="col-md-4">						
										<div class="form-floating">
											<input id="employeeNumber" class="employeeNumber form-control" type="text" name="superfundEmployeeNumber" value="<?php echo isset($employeeData->employeeSuperfunds->employeeNumber) ? $employeeData->employeeSuperfunds->employeeNumber : null ?>">
											<label for="employeeNumber">Employee Number</label>
										</div>
									</span>
								</div>
							</div>

						</section>

						<section class="employee-tax-declaration-section">
							<!-- <h3>Employee Tax Declaration Section</h3> -->

							<div class="form-floating">
								<input disabled  id="tfnExemptionType" class="form-control" name="tfnExemptionType" value="<?php echo isset($employeeData->employeeTaxDeclaration->tfnExemptionType) ? $employeeData->employeeTaxDeclaration->tfnExemptionType : ''; ?>" type="text">
								<label for="tfnExemptionType">TFN Exemption Type</label>
							</div> 

							<div class="tax-declaration-class col-lg-12">
								<div class="d-flex">
									
									<span class="col-md-4">
										<div class="form-floating">
											<input disabled class="form-control" id="taxFileNumber" name="taxFileNumber" type="text" value="<?php echo isset($employeeData->employeeTaxDeclaration->taxFileNumber) ? $employeeData->employeeTaxDeclaration->taxFileNumber : ''; ?>">
											<label for="taxFileNumber" class="labels__">Tax File Number</label>
										</div>
									</span>
									<span class="col-md-4 radioFlex">
										<label class="labels__">Australian Resident For TaxPurpose</label>
										<div class="d-flex">
											<span>
												<label class="yn-label">Yes</label>
												<input disabled  type="radio"  name="australiantResidentForTaxPurposeYN" class="australiantResidentForTaxPurposeYN yn-input" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->australiantResidentForTaxPurposeYN) ? (($employeeData->employeeTaxDeclaration->australiantResidentForTaxPurposeYN == 'Y') ? 'checked' : '') : ''; ?>>
											</span>
											<span>
												<label class="yn-label">No</label>
												<input disabled  type="radio" name="australiantResidentForTaxPurposeYN" class="australiantResidentForTaxPurposeYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->australiantResidentForTaxPurposeYN) ? (($employeeData->employeeTaxDeclaration->australiantResidentForTaxPurposeYN == 'N') ? 'checked' : '') : ''; ?>>
											</span>
										</div>
									</span>
									<span class="col-md-4">
										<div class="form-floating">
											<input disabled  class="form-control" id="residencyStatue" name="residencyStatue" value="<?php echo isset($employeeData->employeeTaxDeclaration->residencyStatue) ? $employeeData->employeeTaxDeclaration->residencyStatue : ''; ?>" type="text">
											<label for="residencyStatue" class="labels__">Residency Status</label>
										</div>
									</span>
									<span class="col-md-4 radioFlex">
										<label class="labels__">Tax Free Threshold Claimed</label>
										<div class="d-flex">
											<span>
												<label class="yn-label">Yes</label>
												<input disabled  type="radio" name="taxFreeThresholdClaimedYN" class="taxFreeThresholdClaimedYN yn-input" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->taxFreeThresholdClaimedYN) ? (($employeeData->employeeTaxDeclaration->taxFreeThresholdClaimedYN == 'Y') ? 'checked' : '') : ''; ?>>
											</span>
											<span>
												<label class="yn-label">No</label>
												<input disabled  type="radio" name="taxFreeThresholdClaimedYN" class="taxFreeThresholdClaimedYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->taxFreeThresholdClaimedYN) ? (($employeeData->employeeTaxDeclaration->taxFreeThresholdClaimedYN == 'N') ? 'checked' : '') : ''; ?>>
											</span>
										</div>
									</span>
									<span class="col-md-4">
										<div class="form-floating">
											<input disabled class="form-control" id="taxOffsetEstimatedAmount" type="text" name="taxOffsetEstimatedAmount" value="<?php echo isset($employeeData->employeeTaxDeclaration->taxOffsetEstimatedAmount) ? $employeeData->employeeTaxDeclaration->taxOffsetEstimatedAmount : ''; ?>">
											<label for="taxOffsetEstimatedAmount" class="labels__">Tax Offset Estimated Amount</label>
										</div>
									</span>
									<span class="col-md-4 radioFlex">
										<label class="labels__">Has HELP Debt</label>
										<div class="d-flex">
											<span>
												<label class="yn-label">Yes</label>
												<input disabled  name="hasHELPDebtYN" class="hasHELPDebtYN yn-input" value="Y" type="radio" <?php echo isset($employeeData->employeeTaxDeclaration->hasHELPDebtYN) ? (($employeeData->employeeTaxDeclaration->hasHELPDebtYN == 'Y') ? 'checked' : '') : ''; ?>>
											</span>
											<span>
												<label class="yn-label">No</label>
												<input disabled  type="radio" name="hasHELPDebtYN" class="hasHELPDebtYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->hasHELPDebtYN) ? (($employeeData->employeeTaxDeclaration->hasHELPDebtYN == 'N') ? 'checked' : '') : ''; ?>>	
											</span>
										</div>
									</span>
									<span class="col-md-4 radioFlex">
										<label class="labels__">Has SFSS Debt</label>
										<div class="d-flex">
											<span>
												<label class="yn-label">Yes</label>
												<input disabled  type="radio" name="hasSFSSDebtYN" class="hasSFSSDebtYN yn-input" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->hasSFSSDebtYN) ? (($employeeData->employeeTaxDeclaration->hasSFSSDebtYN == 'Y') ? 'checked' : '') : ''; ?>>
											</span>
											<span>
												<label class="yn-label">No</label>
												<input disabled  type="radio" name="hasSFSSDebtYN" class="hasSFSSDebtYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->hasSFSSDebtYN) ? (($employeeData->employeeTaxDeclaration->hasSFSSDebtYN == 'N') ? 'checked' : '') : ''; ?>>
											</span>
										</div>
									</span>
									<span class="col-md-4 radioFlex">
										<label class="labels__">Has Trade Support Loan Debt</label>
										<div class="d-flex">
											<span>
												<label class="yn-label">Yes</label>
												<input disabled type="radio" name="hasTradeSupportLoanDebtYN " class="hasTradeSupportLoanDebtYN yn-input" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->hasTradeSupportLoanDebtYN) ? (($employeeData->employeeTaxDeclaration->hasTradeSupportLoanDebtYN == 'Y') ? 'checked' : '') : ''; ?>>
											</span>
											<span>
												<label class="yn-label">No</label>
												<input disabled  type="radio" name="hasTradeSupportLoanDebtYN " class="hasTradeSupportLoanDebtYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->hasTradeSupportLoanDebtYN) ? (($employeeData->employeeTaxDeclaration->hasTradeSupportLoanDebtYN == 'N') ? 'checked' : '') : ''; ?>>
											</span>
										</div>
									</span>
									<span class="col-md-4">
										<div class="form-floating">
											<input disabled class="form-control" id="upwardVariationTaxWitholdingAmount" name="upwardVariationTaxWitholdingAmount" type="text" value="<?php echo isset($employeeData->employeeTaxDeclaration->upwardVariationTaxWitholdingAmount) ? $employeeData->employeeTaxDeclaration->upwardVariationTaxWitholdingAmount : ''; ?>">
											<label for="upwardVariationTaxWitholdingAmount" class="labels__">Upward Variation Tax Witholding Amount</label>
										</div>
									</span>
									<span class="col-md-4 radioFlex">
										<label class="labels__">Eligible To Receive Leave Loading</label>
										<div class="d-flex">
											<span>
												<label class="yn-label">Yes</label>
												<input disabled type="radio" class="eligibleToReceiveLeaveLoadingYN yn-input" name="eligibleToReceiveLeaveLoadingYN" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->eligibleToReceiveLeaveLoadingYN) ? (($employeeData->employeeTaxDeclaration->eligibleToReceiveLeaveLoadingYN == 'Y') ? 'checked' : '') : ''; ?>>
											</span>
											<span>
												<label class="yn-label">No</label>
												<input disabled  type="radio" name="eligibleToReceiveLeaveLoadingYN" class="eligibleToReceiveLeaveLoadingYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->eligibleToReceiveLeaveLoadingYN) ? (($employeeData->employeeTaxDeclaration->eligibleToReceiveLeaveLoadingYN == 'N') ? 'checked' : '') : ''; ?>>
											</span>
										</div>
									</span>
									<span class="col-md-4">
										<div class="form-floating">
											<input disabled class="form-control" id="approvedWitholdingVariationPercentage" name="approvedWitholdingVariationPercentage" type="text" value="<?php echo isset($employeeData->employeeTaxDeclaration->approvedWitholdingVariationPercentage) ? $employeeData->employeeTaxDeclaration->approvedWitholdingVariationPercentage : ''; ?>">
											<label for="approvedWitholdingVariationPercentage" class="labels__">Approved Witholding Variation Percentage</label>
										</div>
									</span>
								</div>
							</div>
						</section>

						<section class="employee-details">

							<div class="d-flex">
								<span class="col-md-4" style="display:none">						
									<div class="form-floating">
										<input class="form-control" disabled id="employee_no" type="text" name="employee_no" value="<?php echo isset($employeeData->employee->userid) ? $employeeData->employee->userid : ''; ?>">
										<label for="employee_no">Employee Number</label>
									</div>
								</span>
							
								<span class="col-md-4" style="display:none">						
									<div class="form-floating">
										<input class="form-control" disabled id="xeroEmployeeId" type="text" name="xeroEmployeeId" value="<?php echo isset($employeeData->employee->xeroEmployeeId) ? $employeeData->employee->xeroEmployeeId : ''; ?>">
										<label for="xeroEmployeeId">Xero Employee Id</label>
									</div>
								</span>
							</div>
							<div class="d-flex">

								<!-- 		<span class="span-class col-3">
									<label class="labels__">	Currently-employed</label>
									<label class="yn-label">Yes</label>
									<input disabled   type="radio" name="currently_employed " class="currently_employed yn-input" value="Y">
									<label class="yn-label">No</label>
									<input disabled  type="radio" name="currently_employed " class="currently_employed yn-input" value="N">
								</span>
								<span class="span-class col-3">
									<label class="labels__">	Commencement-date</label>
									<input disabled  placehdr="Commencement-date" id="commencement_date" type="text">
								</span> -->
								<!-- 
								<span class="span-class col-3">
									<label class="labels__">Contract-position	</label>
									<input disabled  placehdr="Contract-position	" id=" " type="text">
								</span> -->
								<!-- 		<span class="span-class col-3">
									<label class="labels__">Resume-supplied</label>
									<label class="yn-label">Yes</label>
									<input disabled   type="radio" name="resume_supplied" class="resume_supplied yn-input" value="Y">
									<label class="yn-label">No</label>
									<input disabled  type="radio" name="resume_supplied" class="resume_supplied yn-input" value="N">
								</span>
								-->


								<!-- 		<span class="span-class col-3">
									<label class="labels__">Employment-type</label>
									<span class="select_css">
										<select id="employement_type" name="employement_type" value="<?php echo isset($employeeData->employeeRecord->employmentType) ? $employeeData->employeeRecord->employmentType : ''; ?>">
											<option value="FT">Full Time</option>
											<option value="PT">Part Time</option>
											<option value="Casual">Casual</option>
										</select>
									</span>
								</span>
								--><!-- 		<span class="span-class col-3">
									<label class="labels__">Current-contract-notes</label>
									<input disabled  placehdr="Current-contract-notes" id="current_contract_notes" type="text">
								</span>
								<span class="span-class col-3">
									<label class="labels__">Current-contract-signature-date 	</label>
									<input disabled  placehdr="Current-contract-signature-date" id="current_contract_signature_date" type="text">
								</span>
								<span class="span-class col-3">
									<label class="labels__">Current-contract-commencement-date </label>
									<input disabled  placehdr="Current-contract-commencement-date" id="current_contract_commencement_date" type="text">
								</span>
								<span class="span-class col-3">
									<label class="labels__">Current-contract-end-date	</label>
									<input disabled  placehdr="Current-contract-end-date" id="current_contract_end_date" type="text">
								</span>
								<span class="span-class col-3">
									<label class="labels__">Current-contract-paid-start-date </label>
									<input disabled  placehdr="Current-contract-paid-start-date" id="current_contract_paid_start_date" type="text">
								</span>
								<span class="span-class col-3">
									<label class="labels__">Probation-end-date 	</label>
									<input disabled  placehdr="Probation end date" id="probation_end_date" type="text">
								</span> -->
								<!-- 		<span class="span-class col-3">
									<label class="labels__">Industry-years-exp-as-nov19	</label>
									<input disabled  placehdr="Industry-years-exp-as-nov19	" id="industry_years_exp_as_nov19" type="text">
								</span> -->

								
								<span class="col-md-4">						
									<div class="form-floating">
										<input disabled class="form-control" id="highest_qual_held" name="highest_qual_held" type="text"  value="<?php echo isset($employeeData->employeeRecord->highestQualHeld) ? $employeeData->employeeRecord->highestQualHeld : ''; ?>">
										<label for="highest_qual_held">Highest-qual-held</label>
									</div>
								</span>
								<span class="col-md-4">						
									<div class="form-floating">
										<input disabled  class="form-control" id="highest_qual_date_obtained" name="highest_qual_date_obtained" type="text"  value="<?php echo isset($employeeData->employeeRecord->highestQualDateObtained) ? $employeeData->employeeRecord->highestQualDateObtained : ''; ?>">
										<label for="highest_qual_date_obtained">Date Obtained</label>
									</div>
								</span>
								<span class="col-md-4">						
									<div class="form-floating">
										<input disabled class="form-control" id="highest_qual_cert" name="highest_qual_cert" type="text" value=" ">
										<label for="highest_qual_cert">Highest Qualification Certificate</label>
									</div>
								</span>

								<!-- 		<span class="span-class col-3">
									<label class="labels__">Highest-qual-type	 </label>
									<input disabled  placehdr="Highest-qual-type" id="highest_qual_type" type="text">
								</span>
								-->		
								
								<span class="col-md-4">						
									<div class="form-floating">
										<input disabled class="form-control" id="qual_towards_desc" name="qual_towards_desc" type="text" value="<?php echo isset($employeeData->employeeRecord->qualWorkingTowards) ? $employeeData->employeeRecord->qualWorkingTowards : ''; ?>">
										<label for="qual_towards_desc">Qualification working Toward</label>
									</div>
								</span>
								<span class="col-md-4">						
									<div class="form-floating">
										<input disabled class="form-control" id="qual_towards_percent_comp" name="qual_towards_percent_comp" type="text" value="<?php echo isset($employeeData->employeeRecord->qualTowardsPercentcomp) ? $employeeData->employeeRecord->qualTowardsPercentcomp : ''; ?>">
										<label for="qual_towards_percent_comp">Qual-towards-%-comp</label>
									</div>
								</span>


								<!-- 		<span class="span-class col-3">
									<label class="labels__">	Workcover</label>
									<input disabled  placehdr="Workcover" id="workcover" type="text">
								</span>
								<span class="span-class col-3">
									<label class="labels__">	PIAWE</label>
									<input disabled  placehdr="PIAWE" id="piawe" type="text">
								</span>
								<span class="span-class col-3">
									<label class="labels__">	Annual-leave-in-contract</label>
									<input disabled  placehdr="Annual-leave-in-contract" id="annual_leave_in_contract" type="text">
								</span> -->

								
								<span class="col-md-4">						
									<div class="form-floating">
										<input disabled class="form-control"  id="classification" name="classification" type="text" value="<?php echo isset($employeeData->employee->classification) ? $employeeData->employee->classification : ''; ?>">
										<label for="classification">Classification</label>
									</div>
								</span>
								<span class="col-md-4">						
									<div class="form-floating">
										<input disabled class="form-control"  id="ordinaryEarningRateId" name="ordinaryEarningRateId"  class="" type="text" value="<?php echo isset($employeeData->employee->name) ? $employeeData->employee->name : ''; ?>">
										<label for="ordinaryEarningRateId">Ordinary Earning Rate Id</label>
									</div>
								</span>
								<span class="col-md-4">						
									<div class="form-floating">
										<input disabled class="form-control" id="payroll_calendar" name="payroll_calendar" type="text" value="<?php echo isset($employeeData->employee->payrollCalendarId) ? $employeeData->employee->payrollCalendarId : ''; ?>">
										<label for="payroll_calendar">Payroll Calendar</label>
									</div>
								</span>							
								<span class="col-md-4">						
									<div class="form-floating">
										<input disabled class="form-control"  id="employee_group" name="employee_group" type="text" value="<?php echo isset($employeeData->employee->employee_group) ? $employeeData->employee->employee_group : ''; ?>">
										<label for="employee_group">Employee Group</label>
									</div>
								</span>					
								<span class="col-md-4">						
									<div class="form-floating">
										<input disabled class="form-control"  id="holiday_group" name="holiday_group" type="text" value="<?php echo isset($employeeData->employee->holiday_group) ? $employeeData->employee->holiday_group : ''; ?>">
										<label for="holiday_group">Holiday Group</label>
									</div>
								</span>
								<span class="span-class radioFlex col-md-4">
									<label>Visa Holder</label>
									<div class="d-flex">
										<span>
											<label class="yn-label">Yes</label>
											<input disabled   type="radio" name="visa_holder" class="visa_holder yn-input" value="Y" <?php echo isset($employeeData->employeeRecord->visaHolderYN) ? (($employeeData->employeeRecord->visaHolderYN == 'Y') ? 'checked' : '') : ''; ?>>
										</span>
										<span>
											<label class="yn-label">No</label>
											<input disabled  type="radio" name="visa_holder" class="visa_holder yn-input" value="N" <?php echo isset($employeeData->employeeRecord->visaHolderYN) ? (($employeeData->employeeRecord->visaHolderYN == 'N') ? 'checked' : '') : ''; ?>>
										</span>
									</div>
								</span>				
								<span class="col-md-4">						
									<div class="form-floating">
										<input disabled class="form-control" id="visa_type" name="visa_type" type="text" value="<?php echo isset($employeeData->employeeRecord->visaType) ? $employeeData->employeeRecord->visaType : ''; ?>">
										<label for="visa_type">Visa-type</label>
									</div>
								</span>			
								<span class="col-md-4">						
									<div class="form-floating">
										<input disabled  class="form-control" id="visa_grant_date" name="visa_grant_date" type="text" value="<?php echo isset($employeeData->employeeRecord->visaGrantDate) ? $employeeData->employeeRecord->visaGrantDate : ''; ?>">
										<label for="visa_grant_date">Visa-grant-date</label>
									</div>
								</span>	
								<span class="col-md-4">						
									<div class="form-floating">
										<input disabled  class="form-control" id="visa_end_date" name="visa_end_date" type="text" value="<?php echo isset($employeeData->employeeRecord->visaEndDate) ? $employeeData->employeeRecord->visaEndDate : ''; ?>">
										<label for="visa_end_date">Visa-end-date</label>
									</div>
								</span>
								<span class="col-md-4">						
									<div class="form-floating">
										<input disabled  class="form-control" id="visa_conditions" name="visa_conditions" type="text" value="<?php echo isset($employeeData->employee->visaConditions) ? $employeeData->employee->visaConditions : ''; ?>">
										<label for="visa_conditions">Visa-conditions</label>
									</div>
								</span>


								<!-- 		<span class="span-class col-3">
									<label class="labels__">CPR-expiry</label>
									<input disabled  placehdr="CPR-expiry" id="cpr_expiry" type="text">
								</span>
								<span class="span-class col-3">
									<label class="labels__">Prohibition-Notice-Declaration</label>
									<input disabled  placehdr="Prohibition-Notice-Declaration" id="prohibition_notice_declaration" type="text">
								</span>
								<span class="span-class col-3">
									<label class="labels__">VIT-card-no</label>
									<input disabled  placehdr="VIT-card-no" id="vit_card_no" type="text">
								</span>
								<span class="span-class col-3">
									<label class="labels__">VIT-expiry</label>
									<input disabled  placehdr="VIT-expiry" id="vit_expiry" type="text">
								</span>
								<span class="span-class col-3">
									<label class="labels__">WWCC-card-no	</label>
									<input disabled  placehdr="WWCC-card-no" id="wwcc_card_no" type="text">
								</span>
								<span class="span-class col-3">
									<label class="labels__">WWCC-expiry</label>
									<input disabled  placehdr="WWCC-expiry" id="wwcc_expiry" type="text">
								</span>
								<span class="span-class col-3">
									<label class="labels__">Food-handling-safety</label>
									<input disabled  placehdr="Food-handling-safety" id="food_handling_safety" type="text">
								</span>
								<span class="span-class col-3">
									<label class="labels__">Last-police-check</label>
									<input disabled  placehdr="Last-police-check" id="last_police_check" type="text">
								</span>
								<span class="span-class col-3">
									<label class="labels__">Child-protection-check</label>
									<input disabled  placehdr="Child-protection-check" id="child_protection_check" type="text">
								</span>
								<span class="span-class col-3">
									<label class="labels__">Nominated-supervisor</label>
									<label class="yn-label">Yes</label>
										<input disabled   type="radio"  name="nominated_supervisor" class="nominated_supervisor yn-input" value="Y">
									<label class="yn-label">No</label>
										<input disabled  type="radio" name="nominated_supervisor" class="nominated_supervisor yn-input" value="N">
								</span> -->
							</div>
						</section>

						<section class="courses-tab">
							<?php $toCount = isset($employeeData->employeeCourses) ? $employeeData->employeeCourses : ''; ?>
							<?php for($i=0;$i<count($toCount);$i++){ ?>
									<input disabled  type="text" name="course_id[]" style="display:none" value="<?php echo isset($employeeData->employeeCourses[$i]->id) ? $employeeData->employeeCourses[$i]->id : ''; ?>">
									
										
								<div class="d-flex">
									<span class="col-md-4">						
										<div class="form-floating">
											<input disabled id="course_name"  class="course_name form-control" name="course_name[]" type="text" value="<?php echo isset($employeeData->employeeCourses[$i]->courseName) ? $employeeData->employeeCourses[$i]->courseName : ''; ?>">
											<label for="course_name">Course Name</label>
										</div>
									</span>
									<span class="col-md-4">						
										<div class="form-floating">
											<input disabled  id="course_description" class="course_description form-control" name="course_description[]" type="text" value="<?php echo isset($employeeData->employeeCourses[$i]->courseDescription) ? $employeeData->employeeCourses[$i]->courseDescription : ''; ?>">
											<label for="course_description">course Description</label>
										</div>
									</span>
									<span class="col-md-4">						
										<div class="form-floating">
											<input disabled  class="date_obtained form-control" name="date_obtained[]" type="text" value="<?php echo isset($employeeData->employeeCourses[$i]->dateObtained) ? $employeeData->employeeCourses[$i]->dateObtained : ''; ?>">
											<label for="date_obtained">Date Obtained</label>
										</div>
									</span>
									<span class="col-md-4">						
										<div class="form-floating">
											<input disabled  id="expiry_date" class="expiry_date form-control" name="expiry_date[]" type="text" value="<?php echo isset($employeeData->employeeCourses[$i]->courseExpiryDate) ? $employeeData->employeeCourses[$i]->courseExpiryDate : ''; ?>">
											<label for="expiry_date">Expiry Date</label>
										</div>
									</span>

									<!-- <span class="col-md-4">						
										<div class="form-floating">
											<input disabled  id="certificate" class="certificate form-control" name="certificate[]" type="FILE">
											<label for="certificate">Certificate</label>
										</div>
									</span> -->

									<?php
										if(isset($employeeData->employeeCourses[$i]->courseCertificate) !== ""){ ?>
											<span class="span-class col-md-4">
												<div class="form-floating" style="background: #f3f3f3;padding: 10px;">
												<label for="certificate">Certificate</label>
													<center><a href="<?= base_url('api/application/assets/uploads/documents/'.$employeeData->employeeCourses[$i]->courseCertificate) ?>" target="_blank">VIEW FILE</a></center>
												</div>
											</span>
										<?php }else{ ?>
											<span class="col-md-4">						
												<div class="form-floating">
													<input disabled  id="certificate" class="certificate form-control" name="certificate[]" type="FILE">
													<label for="certificate">Certificate</label>
												</div>
											</span>
										<?php }
									?>



								</div>
							<?php } ?>
						</section>

						<section class="medical-info">
							<h3>Medical Information<!-- <span id="Medical Information"> + </span> --></h3>
							<!-- 		<span class="span-class col-3">
								<label class="labels__">Employee Id</label>
								<input disabled  placehdr="Employee Id" id="employeeId" >
							</span> -->

							<div class="d-flex">
								<span class="col-md-4">						
									<div class="form-floating">
										<input disabled  id="medicareNo" type="text"  name="medicareNo" class="medicareNo form-control" value="<?php echo isset($employeeData->employeeMedicalInfo->medicareNo) ? $employeeData->employeeMedicalInfo->medicareNo : ''; ?>">
										<label for="medicareNo">Medicare Number</label>
									</div>
								</span>
								<span class="col-md-4">						
									<div class="form-floating">
										<input disabled id="medicareRefNo"  type="text"  name="medicareRefNo" class="medicareRefNo form-control" value="<?php echo isset($employeeData->employeeMedicalInfo->medicareRefNo) ? $employeeData->employeeMedicalInfo->medicareRefNo : ''; ?>">
										<label for="medicareRefNo">Medicare Reference Number</label>
									</div>
								</span>
								<span class="col-md-4">						
									<div class="form-floating">
										<input disabled id="healthInsuranceFund"  type="text"  name="healthInsuranceFund" class="healthInsuranceFund form-control" value="<?php echo isset($employeeData->employeeMedicalInfo->healthInsuranceFund) ? $employeeData->employeeMedicalInfo->healthInsuranceFund : ''; ?>">
										<label for="healthInsuranceFund">Health Insurance Fund</label>
									</div>
								</span>
								<span class="col-md-4">						
									<div class="form-floating">
										<input disabled   type="text"  name="healthInsuranceNo" class="healthInsuranceNo form-control" value="<?php echo isset($employeeData->employeeMedicalInfo->healthInsuranceNo) ? $employeeData->employeeMedicalInfo->healthInsuranceNo : ''; ?>">
										<label for="healthInsuranceNo">Health Insurance Number</label>
									</div>
								</span>
								<span class="col-md-4">						
									<div class="form-floating">
										<input disabled id="ambulanceSubscriptionNo"  type="text"  name="ambulanceSubscriptionNo" class="ambulanceSubscriptionNo form-control"  value="<?php echo isset($employeeData->employeeMedicalInfo->ambulanceSubscriptionNo) ? $employeeData->employeeMedicalInfo->ambulanceSubscriptionNo : ''; ?>">
										<label for="ambulanceSubscriptionNo">Ambulance Subscription Number</label>
									</div>
								</span>
							</div>

							<?php $toSize = isset($employeeData->employeeMedicals) ? $employeeData->employeeMedicals : ''; ?>
								<?php for($i=0;$i<count($toSize);$i++){ ?>
									<input disabled  type="text" name="medicals_id[]" style="display:none" value="<?php echo isset($employeeData->employeeMedicals[$i]->id) ? $employeeData->employeeMedicals[$i]->id : ''; ?>">
									<div class="d-flex">
										<span class="col-md-4">						
											<div class="form-floating">
												<input disabled  id="medicalConditions" type="text"  name="medicalConditions[]" class="medicalConditions form-control" value="<?php echo isset($employeeData->employeeMedicals[$i]->medicalConditions) ? $employeeData->employeeMedicals[$i]->medicalConditions : ''; ?>">
												<label for="medicalConditions">Medical Conditions</label>
											</div>
										</span>
										<span class="col-md-4">						
											<div class="form-floating">
												<input disabled  id="medicalAllergies" type="text"  name="medicalAllergies[]" class="medicalAllergies" value="<?php echo isset($employeeData->employeeMedicals[$i]->medicalAllergies) ? $employeeData->employeeMedicals[$i]->medicalAllergies : ''; ?>">
												<label for="medicalAllergies">Medical Allergies</label>
											</div>
										</span>
										<span class="col-md-4">						
											<div class="form-floating">
												<input disabled id="medication"  type="text"  name="medication[]" class="medication" value="<?php echo isset($employeeData->employeeMedicals[$i]->medication) ? $employeeData->employeeMedicals[$i]->medication : ''; ?>">
												<label for="medication">Medication</label>
											</div>
										</span>
										<span class="col-md-4">						
											<div class="form-floating">
												<input disabled id="dietaryPreferences"  type="text"  name="dietaryPreferences[]" class="dietaryPreferences" value="<?php echo isset($employeeData->employeeMedicals[$i]->dietaryPreferences) ? $employeeData->employeeMedicals[$i]->dietaryPreferences : ''; ?>">
												<label for="dietaryPreferences">Dietary Preferences</label>
											</div>
										</span>
									</div>
							<?php } ?>
							<!-- 		<span class="span-class col-3">
								<label class="labels__">Anaphylaxis</label>
									<input disabled   type="text"  name="anaphylaxis" class="anaphylaxis">
							</span>
							<span class="span-class col-3">
								<label class="labels__">Asthma</label>
									<input disabled   type="text"  name="asthma" class="asthma">
							</span>
							<span class="span-class col-3">
								<label class="labels__">Maternity Start Date</label>
									<input disabled   type="text"  name="maternityStartDate" class="maternityStartDate">
							</span>
							<span class="span-class col-3">
								<label class="labels__">Maternity End Date</label>
									<input disabled   type="text"  name="maternityEndDate" class="maternityEndDate">
							</span> -->
						</section>

						<section class="documents-tab">
							<div class="addDocumentsDiv template_table">

								<table>
									<tr>
										<th>Document Name</th>
										<th class="align-center">Download</th>
									</tr>
									<tr>
										<td>Contract Document</td>
										<td class="align-center">
											<a href="" id="contract_doc" name="contract_doc"  download>
												<button class="button btn btn-default btn-small btnOrange" <?php if(!isset($employeeData->employeeRecord->contractDocument)){ echo 'disabled'; } ?>>
													<span class="material-icons-outlined">file_download</span> Download
												</button>
											</a>
										</td>
									</tr>
									<tr>
										<td>Resume Document</td>
										<td class="align-center">
											<a href="" id="resume_doc" name="resume_doc"  download>
												<button class="button btn btn-default btn-small btnOrange" <?php if(!isset($employeeData->employeeRecord->resumeDoc)){ echo 'disabled'; } ?> >
												<span class="material-icons-outlined">file_download</span> Download</button>
											</a>
										</td>
									</tr>
									<?php foreach($employeeData->employeeDocuments as $docs){ ?>
										<tr class="singleDocBlock">
											<td class="singleDocName"><?php echo $docs->name ?></td>
											<td class="singleDocDownload">
												<a href="<?php echo DOCUMENTS_PATH.($docs->document) ?>" download class="button"><i>
														<img src="<?php echo base_url('assets/images/icons/download.png'); ?>" style="max-height:1rem;margin-right:10px">
													</i>Download</a>
											</td>
										</tr>
									<?php } ?>
								</table>

							</div>
						</section>
					</form>
					<?php // } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(()=>{
		// if($(document).width() > 1024){
		//     $('.containers').css('paddingLeft',$('.side-nav').width());
		// }
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
<?php // if(isset($permissions->permissions) ? $permissions->permissions->viewEmployeeYN : "N" == "Y"){ ?>


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

	var new_child = $('.parent-child ').html();

	$(document).on('click','.add-row',function(){
		$('.parent-child').append(new_child);
				accountCount();
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
<!-- 
<script type="text/javascript">
	$(document).ready(function(){
		$('#center').change(function(){
	var id = this.value;
	var url = window.location.origin+"/PN101/settings/addEmployee/"+id;
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
</script> -->

<script type="text/javascript">
		for(x=0;x<$('#role').children().length;x++){
		if($('#role').children('option').eq(x).attr('area-id') == 1){
			
		}
		else{
			$('#role').children('option').eq(x).css('display','none')
		}
	}

	$(document).on('click','.syncXeroEmployees',function(){
		var url = '<?php echo base_url() ?>settings/syncXeroEmployees/'+ "<?php echo $employeeId ?>";
		$.ajax({
			url : url,
			success : function(response){
				if(response != null && response != "" && response != " "){
					var res = JSON.parse(response)
					if(res.Status == 'OK'){
						window.location.href = "<?php echo base_url('settings/viewEmployeeTable'); ?>"
					}
					if(res.Type == 'Error'){
						alert(res.Message);
					}
				}else{
					alert("ERROR")
				}
			}
		})
	})

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

		var superfundHTML = $('.superfund-parent').html();
		$(document).on('click','#superfund-add',function(){
		$('.superfund-parent').append(superfundHTML);
		})
	})
</script>

<script type="text/javascript">
	$(document).ready(()=>{
		$('.e-s').addClass('arrow');
		$('.e-s').click(function(){
		$('.e-s').addClass('arrow');
			$('.e-b-a-s').removeClass('arrow');
			$('.e-s-s').removeClass('arrow');
			$('.e-t-d-s').removeClass('arrow');
			$('.e-u-s').removeClass('arrow');
			$('.m-i').removeClass('arrow');
			$('.d-c').removeClass('arrow');
			$('.c-t').removeClass('arrow');
		})
		$('.e-b-a-s').click(function(){
		$('.e-s').removeClass('arrow');
			$('.e-b-a-s').addClass('arrow');
			$('.e-s-s').removeClass('arrow');
			$('.e-t-d-s').removeClass('arrow');
			$('.e-u-s').removeClass('arrow');
			$('.m-i ').removeClass('arrow');
			$('.d-c ').removeClass('arrow');
			$('.c-t ').removeClass('arrow');
		})
		$('.e-s-s').click(function(){
		$('.e-s ').removeClass('arrow');
			$('.e-b-a-s ').removeClass('arrow');
			$('.e-s-s ').addClass('arrow');
			$('.e-t-d-s ').removeClass('arrow');
			$('.e-u-s ').removeClass('arrow');
			$('.m-i ').removeClass('arrow');
			$('.d-c ').removeClass('arrow');
			$('.c-t ').removeClass('arrow');
		})
		$('.e-t-d-s').click(function(){
		$('.e-s ').removeClass('arrow');
			$('.e-b-a-s ').removeClass('arrow');
			$('.e-s-s ').removeClass('arrow');
			$('.e-t-d-s ').addClass('arrow');
			$('.e-u-s ').removeClass('arrow');
			$('.m-i ').removeClass('arrow');
			$('.d-c ').removeClass('arrow');
			$('.c-t ').removeClass('arrow');
		})
		$('.e-u-s').click(function(){
		$('.e-s ').removeClass('arrow');
			$('.e-b-a-s ').removeClass('arrow');
			$('.e-s-s ').removeClass('arrow');
			$('.e-t-d-s ').removeClass('arrow');
			$('.e-u-s ').addClass('arrow');
			$('.m-i ').removeClass('arrow');
			$('.d-c ').removeClass('arrow');
			$('.c-t ').removeClass('arrow');
		})
		$('.m-i').click(function(){
		$('.e-s ').removeClass('arrow');
			$('.e-b-a-s ').removeClass('arrow');
			$('.e-s-s ').removeClass('arrow');
			$('.e-t-d-s ').removeClass('arrow');
			$('.e-u-s ').removeClass('arrow');
			$('.m-i ').addClass('arrow');
			$('.d-c ').removeClass('arrow');
			$('.c-t ').removeClass('arrow');
		})
		$('.d-c').click(function(){
		$('.e-s ').removeClass('arrow');
			$('.e-b-a-s ').removeClass('arrow');
			$('.e-s-s ').removeClass('arrow');
			$('.e-t-d-s ').removeClass('arrow');
			$('.e-u-s ').removeClass('arrow');
			$('.m-i ').removeClass('arrow');
			$('.d-c ').addClass('arrow');
			$('.c-t ').removeClass('arrow');
		})
		$('.c-t').click(function(){
		$('.e-s ').removeClass('arrow');
			$('.e-b-a-s ').removeClass('arrow');
			$('.e-s-s ').removeClass('arrow');
			$('.e-t-d-s ').removeClass('arrow');
			$('.e-u-s ').removeClass('arrow');
			$('.m-i ').removeClass('arrow');
			$('.d-c ').removeClass('arrow');
			$('.c-t ').addClass('arrow');
		})
		});

    $(document).ready(function(){
    	var firstName = $('#fname').val();
    	var middleName = $('#mname').val();
    	var lastName = $('#lname').val();
    	$('.employeeNameView').html(`${firstName} ${lastName}`)
    })

    $(document).ready(function(){
    	var block = $('.addSingleDocument')[0].outerHTML;
    	var parent = $('.singleDocBlock').eq(0).parent();
    	$(document).on('click','.addRemoveDocumentSpan',function(){
    		$('.addDocumentsDiv').append(block);
    	})
    	$(document).on('click','.removeDocumentButton',function(){
    		$(this).closest('.addSingleDocument').remove();
    	})
    })
</script>
<?php // } ?>
<!-- <script type="text/javascript">
	var base_url = "<?php echo base_url();?>";
	window.addEventListener('DOMContentLoaded', (event) => {
		getEmployees();
	});
		function getEmployees(){
			var xhttp = new XMLHttpRequest();
			var centerId = document.getElementById("centerValue").value;
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var employees = xhttp.responseText;
					if(employees != "" && employees != null){
						employees = JSON.parse(employees)
					var finalStr = "";
					for(var i=0;i<employees.employees.length;i++){
						finalStr += '<option value = "' + employees.employees[i].id +  '">' + employees.employees[i].name + '</option>';
					}
					document.getElementById("employeeValue").innerHTML = finalStr;
					getEmployeeProfile();
					}
				}
			};
			xhttp.open("GET", base_url+"settings/getEmployeesByCenter/"+centerId, true);
			xhttp.send();
		}

		function getEmployeeProfile(){
			var base_url = "<?php echo base_url();?>";
			var employeeId = $('#employeeValue').val();
			var url = base_url+"settings/viewEmployee/"+employeeId ;
			$.ajax({
				url : url,
				type : 'GET',
				success : function(response){
					$('#employeeProfileId').html($(response).find('#employeeProfileId').html());
				}
			})
		}
		</script> -->
</body>
</html>
