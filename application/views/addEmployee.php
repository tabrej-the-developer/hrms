
<!DOCTYPE html>
<html>
<head>
	<title>Add Employee</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/stylesheet.css') ?>" />
	<style type="text/css">
		.select_css::after{
	  content: ' ';
	  position: absolute;
	  background: url(<?php echo base_url('assets/images/icons/down.png') ?>);
	  background-repeat: no-repeat;
	  padding: 15px;
    margin-left: -28px;
    margin-top: 10px !important;
    background-size: 0.6rem 0.6rem;
	}

	</style>
</head>
<body class="add_employee_body">
<?php $this->load->view('header'); ?>
<div class="containers">
<span class="d-flex justify-content-between pt-2">
	<span style="top:20px;padding-left: 2rem">
      <a href="<?php echo base_url();?>/settings">
        <button class="btn back-button">
          <img src="<?php echo base_url('assets/images/back.svg');?>">
          <span style="font-size:0.8rem">Add Employee</span>
        </button>
      </a>
    </span>
    <span class="addEmployee_top_select">
    	<a href="<?php echo base_url('settings/AddMultipleEmployees');?>">
    		<button id="addEmployee_multipleEmployees">Add Multiple Employees</button>
    	</a>
    </span>
</span>
	<div class="addEmployee-container">
	<div class="addEmployee-container-child">
	<?php $permissions = json_decode($permissions); ?>
<?php if(isset($permissions->permissions) ? $permissions->permissions->editEmployeeYN : "N" == "Y"){ ?>
	<section class="tab-buttons">
		<div class="tab-buttons-div">
		<span class="nav-button e-s"><span>Personal</span></span>
		<span class="nav-button e-b-a-s"><span>Bank Account</span></span>
		<span class="nav-button e-s-s"><span> Superannuation </span></span>
		<span class="nav-button e-t-d-s"><span>Tax Declaration </span></span>
		<span class="nav-button e-u-s"><span>Employment</span></span>	
		<span class="nav-button m-i"><span>Medical Info</span></span>
		</div>	
	</section>
<form method="POST" action="createEmployeeProfile" style="height: 100%" onsubmit="return onFormSubmit()" enctype="multipart/form-data">
	<section class="employee-section">	
		<!-- <h3>Personal</h3> -->
		<span class="d-flex">
		<span class="span-class ">
			<label class="labels__">Title</label>
			<span class="select_css">
				<select  id="title"  class="" type="text" name="title"> 
					<option value="Ms">Ms</option> 
					<option value="Mr">Mr</option>
					<option value="Mrs">Mrs</option>
				</select>
			</span>
		</span>
	<span class="span-class name__">
		<label class="labels__">Name<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
		<span class=" row row_addEmployee ml-1 ">
		<span class="span-class col-4 ">
			<!-- <label class="labels__">First Name</label> -->
			<input id="fname"  class="" type="text" name="fname" placeholder="First Name">
		</span>
		<span class="span-class col-4 ">
			<!-- <label class="labels__">Middle Name</label> -->
			<input id="mname"  class="" value="" type="text" name="mname" placeholder="Middle Name">
		</span>
		<span class="span-class col-4 ">
			<!-- <label class="labels__">Last Name</label> -->
			<input id="lname"  class="" type="text" name="lname" placeholder="Last Name">
		</span>
	</span>
	</span>
</span>
		
		<span class="span-class">
			<label class="labels__">Email<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
			<input id="emails"  class="" type="text" name="emails">
		</span>
		<span class="span-class">
			<label class="labels__">Alias<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
			<input id="alias"  class="" type="text" name="alias">
		</span>
		<span class="span-class">
			<label class="labels__">Date Of Birth</label>
			<input id="dateOfBirth"  class="" type="date" name="dateOfBirth">
		</span>
		<span class="span-class">
			<label class="labels__">Gender</label>
			<span class="select_css">
				<select id="gender"  class="" name="gender">
					<option value="N">Not Given</option>
					<option value="M">Male</option>
					<option value="F">Female</option>
					<option value="I">Non binary</option>
				</select>				
			</span>
		</span>
		<span class="span-class">
			<label class="labels__">Profile Image</label>
			<input id="profileImage"  class="profileImage" type="FILE" name="profileImage">
		</span>

				
		<span class="span-class">
			<label class="labels__">Job Title<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
			<input id="jobTitle"  class="" type="text" name="jobTitle">
		</span>
	
		<span class="span-class row row_addEmployee ">
		<label class="labels__">Address</label>	
			<span class="span-class  col-4">
				<!-- <label class="labels__">Home Address Line1</label> -->
	<input id="homeAddLine1"  class="" type="text" name="homeAddLine1">
			</span>
			<span class="span-class col-4">
				<!-- <label class="labels__">Home Address Line2</label> -->
	<input id="homeAddLine2"  class="" type="text" name="homeAddLine2">
			</span>
			<span class="span-class col-4">
				<!-- <label class="labels__">City</label> -->
	<input  type="text" id="homeAddCity"  class=""  name="homeAddCity">
			</span>				
			<span class="span-class col-4">
				<!-- <label class="labels__">Region</label> -->
				<span class="select_css">
		<select id="homeAddRegion"  class="" type="text" name="homeAddRegion">
						<option value="ACT">Australian Capital Territory</option>
						<option value="NSW">New South Wales</option>
						<option value="NT">Northern Territory</option>
						<option value="QLD">Queensland </option>
						<option value="SA">South Australia</option>
						<option value="TAS">Tasmania </option>
						<option value="VIC">Victoria</option>
						<option value="WA">Western Australia</option>
					</select>
				</span>
			</span>
			<span class="span-class col-4">
				<!-- <label class="labels__">Postal</label> -->
				<input id="homeAddPostal"  class="" type="text" name="homeAddPostal">
			</span>
			<span class="span-class col-4">
				<!-- <label class="labels__">Country</label> -->
				<input id="homeAddCountry"  class="" type="text" name="homeAddCountry">
			</span>
		</span>
		<span class="span-class contact__">
			<label class="labels__">Contact</label>
				<span class="span-class">
					<input id="phone"  class="" type="text" name="phone">
				</span>
				<span class="span-class">
					<input id="mobile"  class="" type="text" name="mobile">
				</span>
		</span>
	<span class="d-block">
		<span class="span-class col-3">
			<label class="labels__">Start Date<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
		<input id="startDate"  class="" type="date" name="startDate">
		</span>
		<span class="span-class col-3">
			<label class="labels__">Termination Date</label>
		<input id="terminationDate"  class="" type="date" name="terminationDate">
		</span>
	</span>
<!-- 		<span class="span-class">
			<label class="labels__">created_at</label>
			<input placeholder="created_at" id="created_at"  class="" type="text">
		</span>
		<span class="span-class">
			<label class="labels__">created_by</label>
			<input placeholder="created_by" id="created_by"  class="" type="text">
		</span> -->
		<span class="span-class col-4">
			<label class="labels__">Emergency Contact</label>
		<input id="emergency_contact"  class="" type="text" name="emergency_contact">
		</span>
		<span class="span-class col-4">
			<label class="labels__">Relationship</label>
		<input id="relationship"  class="" type="text" name="relationship">
		</span>
		<span class="span-class col-3">
			<label class="labels__">Emergency Contact Email</label>
			<input id="emergency_contact_email"  class="" type="email" name="emergency_contact_email">
		</span>
	</section>

	<section class="employee-bank-account-section">
		<h3 class="add_remove_bank_account">Bank Account 
			<span class="add-remove-row">
				<span class="add-row"> Add </span>
				<span class="remove-row"> Remove </span>
			</span>
		</h3>
		<div class="parent-child">
			<div class="child">
				<div class="statement"></div>
					<div class="row employee-bank-account-section_row">
				<!-- 		<span class="span-class col-4">
							<label class="labels__">Statement Text</label>
							<input type="text" class="statementText" >
						</span> -->
						<span class="span-class col-4">
							<label class="labels__">Account Name</label>
							<input type="text" class="accountName" name="accountName">
						</span>
						<span class="span-class col-4">
							<label class="labels__">BSB</label>
							<input type="text" class="bsb" name="bsb">
						</span>
					</div>
		
	<span class="row employee-bank-account-section_row">
		<span class="span-class col-4">
			<label class="labels__">Account Number</label>
			<input type="text" class="accountNumber" name="accountNumber">
		</span>
		<span class="span-class col-4">
			<label class="labels__">Remainder</label>
				<span>
					<label  class="yn-label">Yes</label>
					<input value="Y" class="remainderYN yn-input" type="radio" name="remainderYN">
				</span>
				<span>
					<label  class="yn-label">No</label>
					<input value="N" class="remainderYN yn-input" type="radio" name="remainderYN">
				</span>
		</span>
		<span class="span-class amount-class-parent col-4">
			<div class="amount-class">
				<label class="labels__">Amount</label>
				<input type="text" class="amount" name="amount">
			</div>
		</span>
	</span>
			</div>
		</div>
	</section>



	<section class="employee-superfund-section">
		<h3 class="add_remove_superannutation"> Superannuation 
			<span class="add-remove-superfund">
				<span id="superfund-add"> Add </span>
				<span class="superfund-remove"> Remove </span>
			</span>
		</h3>
<!-- 		<span class="span-class">
			<label class="labels__">Employee Id</label>
			<input id="employeeId" >
		</span> -->
			<div class="superfund-parent">
				<div class="superfund-child row row_addEmployee ">
					<span class="span-class col-4">
						<label class="labels__">Super Fund Id</label>
						<?php $superfunds = json_decode($superfunds); ?>
						<span class="select_css">
							<select class="superFundId" name="superFundId">
								<?php foreach($superfunds->superfunds as $superfund){ ?>
								<option value="<?php echo $superfund->usi; ?>"><?php echo $superfund->name; ?></option>
								<?php } ?>
							</select>
						</span>
					</span>
					<span class="span-class col-4">
						<label class="labels__">Super Membership Id</label>
						<input class="superMembershipId" type="text" name="superMembershipId">
					</span>
				</div>
			</div>

	</section>





	<section class="employee-tax-declaration-section">
		<!-- <h3>Employee Tax Declaration Section</h3> -->

		<span class="span-class col-4">
			<label class="labels__">Employment Basis</label>
			<span class="select_css">
				<select id="employmentBasis" name="employmentBasis">
					<option value="FULLTIME">FULLTIME </option>
					<option value="PARTTIME">PARTTIME</option>
					<option value="CASUAL">CASUAL</option>
					<option value="LABOURHIRE">LABOURHIRE</option>
					<option value="SUPERINCOMEST">SUPERINCOMEST</option>
				</select>
			</span>
		</span> 
		<span class="span-class col-4">
			<label class="labels__">TFN Exemption Type</label>
			<span class="select_css">
				<select id="tfnExemptionType" name="tfnExemptionType">
					<option value="NONE">NONE</option>
					<option value="NOTQUOTED">NOTQUOTED</option>
					<option value="PENDING">PENDING</option>
					<option value="PENSIONER">PENSIONER</option>
					<option value="UNDER18">UNDER18</option>
				</select>
			</span>
		</span> 
		<div class="tax-declaration-class col-lg-12">
		<span class="span-class col-4">
			<label class="labels__">Tax File Number</label>
			<input id="taxFileNumber" name="taxFileNumber" type="text">
		</span>
		<span class="span-class col-4">
			<label class="labels__">Australian Resident For TaxPurpose</label>
			<span>
				<label class="yn-label">Yes</label>
				<input type="radio"  name="australiantResidentForTaxPurposeYN" class="australiantResidentForTaxPurposeYN yn-input" value="Y">
			</span>
			<span>
				<label class="yn-label">No</label>
				<input type="radio" name="australiantResidentForTaxPurposeYN" class="australiantResidentForTaxPurposeYN yn-input" value="N">
			</span>
		</span>
		<span class="span-class col-3">
			<label class="labels__">Residency Statue</label>
			<span class="select_css">
				<select id="residencyStatue" name="residencyStatue">
					<option value="AUSTRALIANRESIDENT">Australian Resident</option>
					<option value="FOREIGNRESIDENT">Foreign Resident</option>
					<option value="WORKINGHOLIDAY">Working Holiday</option>
				</select>
			</span>
		</span>
		<span class="span-class col-4">
			<label class="labels__">Tax Free Threshold Claimed</label>
			<label class="yn-label">Yes</label>
				<input type="radio" name="taxFreeThresholdClaimedYN" class="taxFreeThresholdClaimedYN yn-input" value="Y">
			<label class="yn-label">No</label>
				<input type="radio" name="taxFreeThresholdClaimedYN" class="taxFreeThresholdClaimedYN yn-input" value="N">
		</span>
		<span class="span-class col-4">
			<label class="labels__">Tax Offset Estimated Amount</label>
			<input id="taxOffsetEstimatedAmount" type="text" name="taxOffsetEstimatedAmount">
		</span>
		<span class="span-class col-3">
			<label class="labels__">Has HELP Debt</label>
			<label class="yn-label">Yes</label>
			<input name="hasHELPDebtYN" class="hasHELPDebtYN yn-input" value="Y" type="radio">
			<label class="yn-label">No</label>
			<input type="radio" name="hasHELPDebtYN" class="hasHELPDebtYN yn-input" value="N">	
		</span>
		<span class="span-class col-4">
			<label class="labels__">Has SFSS Debt</label>
			<label class="yn-label">Yes</label>
			<input type="radio" name="hasSFSSDebtYN" class="hasSFSSDebtYN yn-input"
			 value="Y">
			<label class="yn-label">No</label>
			<input type="radio" name="hasSFSSDebtYN" class="hasSFSSDebtYN yn-input" value="N">
		</span>
		<span class="span-class col-4">
			<label class="labels__">Has Trade Support Loan Debt</label>
			<label class="yn-label">Yes</label>
			<input type="radio" name="hasTradeSupportLoanDebtYN " class="hasTradeSupportLoanDebtYN yn-input" value="Y">
			<label class="yn-label">No</label>
			<input type="radio" name="hasTradeSupportLoanDebtYN " class="hasTradeSupportLoanDebtYN yn-input" value="N">
		</span>
		<span class="span-class col-3">
			<label class="labels__">Upward Variation Tax Witholding Amount</label>
			<input id="upwardVariationTaxWitholdingAmount" name="upwardVariationTaxWitholdingAmount" type="text">
		</span>
		<span class="span-class col-4">
			<label class="labels__">Eligible To Receive Leave Loading</label>
			<label class="yn-label">Yes</label>
			<input type="radio" class="eligibleToReceiveLeaveLoadingYN yn-input" name="eligibleToReceiveLeaveLoadingYN" value="Y">
			<label class="yn-label">No</label>
			<input type="radio" name="eligibleToReceiveLeaveLoadingYN" class="eligibleToReceiveLeaveLoadingYN yn-input" value="N">
		</span>
		<span class="span-class col-4">
			<label class="labels__">Approved Witholding Variation Percentage</label>
			<input id="approvedWitholdingVariationPercentage" name="approvedWitholdingVariationPercentage" type="text">
		</span>
		
	</div>
	</section>


	<section class="employee-details">
		<span class="span-class">
			<label class="labels__">Employee Number<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
			<input id="employee_no" type="text" name="employee_no">
		</span>
		<span class="span-class">
			<label class="labels__">Xero Employee Id</label>
			<input id="xeroEmployeeId" type="text" name="xeroEmployeeId">
		</span>
		<span class="span-class">
			<label class="labels__">Center</label>
			<span class="select_css">
				<select id="center" name="center">
					<option>--Center--</option>
					<?php 
						$centers = json_decode($centers);
					foreach($centers->centers as $center){ ?> 
						<option value="<?php echo $center->centerid;?>"><?php echo $center->name;?></option>
					<?php } 
					$centerId = "";
					foreach($centers->centers as $center){ 
							$centerId = $centerId . $center->centerid . "|";
					 } ?>
					<option value="<?php echo $centerId; ?>">All Centers</option>
				</select>
			</span>
		</span>

		<span class="span-class">
			<label class="labels__">Area<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>

				<span class="" id="area-select">
					<span class="select_css">
						<select id="area" name="area">
							<option>--select--</option>
						<?php 
						$areas = json_decode($areas);
						foreach($areas->areas as $area){
						?>
						<option value="<?php echo $area->areaId; ?>" ><?php echo $area->areaName; ?></option>
						<?php } ?>
					</select>
				</span>
			</span>
		</span>

		<span class="span-class">
			<label class="labels__">Role<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
			<span id="role-select">
				<span class="select_css">
					<select id="role" name="role">
						<option>--select--</option>

						<?php foreach($areas->areas as $roles){?>
							<?php foreach($roles->roles as $role){?>
						<option area-id="<?php print_r($role->areaid); ?>" value="<?php echo $role->roleid ?>"><?php print_r($role->roleName) ?></option>
						<?php } } ?>
					</select>
				</span>
		</span>
		</span>

		<span class="span-class">
			<label class="labels__">Manager</label>
			<input id="manager" type="text" name="manager">
		</span>


		<span class="span-class">
			<label class="labels__">Level<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
			<span class="select_css">
				<select id="level" name="level">
					<?php $levels = json_decode($levels);
						foreach($levels->entitlements as $level){
						?>
					<option><?php echo $level->name; ?></option>
					<?php } ?>
				</select>
			</span>
		</span>
		<span class="span-class">
			<label class="labels__">Bonus Rates</label>
			<input id="bonusRates" name="bonusRates" type="number" step="0.01" min="0">
		</span>

<!-- 		<span class="span-class">
			<label class="labels__">	Currently-employed</label>
			<label class="labels__" class="yn-label">Yes</label>
			<input  type="radio" name="currently_employed " class="currently_employed yn-input" value="Y">
			<label class="labels__" class="yn-label">No</label>
			<input type="radio" name="currently_employed " class="currently_employed yn-input" value="N">
		</span>
		<span class="span-class">
			<label class="labels__">	Commencement-date</label>
			<input placeholder="Commencement-date" id="commencement_date" type="date">
		</span> -->
<!-- 
		<span class="span-class">
			<label class="labels__">Contract-position	</label>
			<input placeholder="Contract-position	" id=" " type="text">
		</span> -->
<!-- 		<span class="span-class">
			<label class="labels__">Resume-supplied</label>
			<label class="labels__" class="yn-label">Yes</label>
			<input  type="radio" name="resume_supplied" class="resume_supplied yn-input" value="Y">
			<label class="labels__" class="yn-label">No</label>
			<input type="radio" name="resume_supplied" class="resume_supplied yn-input" value="N">
		</span>
 -->
		<span class="span-class">
			<label class="labels__">Resume Document </label>
			<input  id="resume_doc" name="resume_doc" type="file">
		</span>
		<span class="span-class">
			<label class="labels__">Contract Document </label>
			<input  id="contract_doc" name="contract_doc" type="file">
		</span>

		<span class="span-class">
			<label class="labels__">Employment-type</label>
			<span class="select_css">
				<select id="employement_type" name="employement_type">
					<option value="FT">Full Time</option>
					<option value="PT">Part Time</option>
					<option value="Casual">Casual</option>
				</select>
			</span>
		</span>
<!-- 		<span class="span-class">
			<label class="labels__">Current-contract-notes</label>
			<input placeholder="Current-contract-notes" id="current_contract_notes" type="date">
		</span>
		<span class="span-class">
			<label class="labels__">Current-contract-signature-date 	</label>
			<input placeholder="Current-contract-signature-date" id="current_contract_signature_date" type="date">
		</span>
		<span class="span-class">
			<label class="labels__">Current-contract-commencement-date </label>
			<input placeholder="Current-contract-commencement-date" id="current_contract_commencement_date" type="date">
		</span>
		<span class="span-class">
			<label class="labels__">Current-contract-end-date	</label>
			<input placeholder="Current-contract-end-date" id="current_contract_end_date" type="date">
		</span>
		<span class="span-class">
			<label class="labels__">Current-contract-paid-start-date </label>
			<input placeholder="Current-contract-paid-start-date" id="current_contract_paid_start_date" type="date">
		</span>
		<span class="span-class">
			<label class="labels__">Probation-end-date 	</label>
			<input id="probation_end_date" type="date">
		</span> -->
<!-- 		<span class="span-class">
			<label class="labels__">Industry-years-exp-as-nov19	</label>
			<input placeholder="Industry-years-exp-as-nov19	" id="industry_years_exp_as_nov19" type="text">
		</span> -->

		<span class="span-class">
			<label class="labels__">Highest-qual-held</label>
		<input id="highest_qual_held" name="highest_qual_held" type="text">
		</span>
		<span class="span-class">
			<label class="labels__">Date Obtained</label>
		<input id="highest_qual_date_obtained" name="highest_qual_date_obtained" type="text">
		</span>
		<span class="span-class">
			<label class="labels__">Highest Qualification Certificate</label>
		<input id="highest_qual_cert" name="highest_qual_cert" type="text">
		</span>
<!-- 		<span class="span-class">
			<label class="labels__">Highest-qual-type	 </label>
			<input placeholder="Highest-qual-type" id="highest_qual_type" type="text">
		</span>
 -->		<span class="span-class">
			<label class="labels__">Qualification working Toward</label>
		<input  id="qual_towards_desc" name="qual_towards_desc" type="text">
		</span>
		<span class="span-class">
			<label class="labels__">Qual-towards-%-comp</label>
		<input  id="qual_towards_percent_comp" name="qual_towards_percent_comp" type="text">
		</span>

<!-- 		<span class="span-class">
			<label class="labels__">	Workcover</label>
			<input id="workcover" type="text">
		</span>
		<span class="span-class">
			<label class="labels__">	PIAWE</label>
			<input id="piawe" type="text">
		</span>
		<span class="span-class">
			<label class="labels__">	Annual-leave-in-contract</label>
			<input placeholder="Annual-leave-in-contract" id="annual_leave_in_contract" type="text">
		</span> -->
		<span class="span-class">
			<label class="labels__">Classification</label>
			<input id="classification" name="classification" type="text">
		</span>
		<span class="span-class">
			<label class="labels__">Ordinary Earning Rate Id</label>
			<span class="select_css">
				<select id="ordinaryEarningRateId" name="ordinaryEarningRateId"  class="" type="text">
				<?php
						$ordinaryEarningRate = json_decode($ordinaryEarningRate);
						foreach($ordinaryEarningRate->awards as $rate){
				?>
					<option value="<?php echo $rate->earningRateId?>"><?php echo $rate->name?></option>
				<?php }?>
				</select>
			</span>
		</span>

		<span class="span-class">
			<label class="labels__">Payroll Calendar</label>
			<input id="payroll_calendar" name="payroll_calendar" type="text">
		</span>
		<span class="span-class">
			<label class="labels__">Visa Holder</label>
			<label class="yn-label">Yes</label>
			<input  type="radio" name="visa_holder" class="visa_holder yn-input" value="Y">
			<label class="yn-label">No</label>
			<input type="radio" name="visa_holder" class="visa_holder yn-input" value="N">
		</span>
		<span class="span-class">
			<label class="labels__">	Visa-type		</label>
			<input id="visa_type" name="visa_type" type="text">
		</span>
		<span class="span-class">
			<label class="labels__">	Visa-grant-date	</label>
			<input  id="visa_grant_date" name="visa_grant_date" type="date">
		</span>
		<span class="span-class">
			<label class="labels__">	Visa-end-date	</label>
			<input  id="visa_end_date" name="visa_end_date" type="date">
		</span>
		<span class="span-class">
			<label class="labels__">	Visa-conditions</label>
			<input  id="visa_conditions" name="visa_conditions" type="text">
		</span>

		<div>
				<span class="span-class">
					<label class="labels__">Course Name</label>
					<input class="course_name" name="course_name[]" type="text">
				</span>
				<span class="span-class">
					<label class="labels__">course Description</label>
					<input class="course_description" name="course_description[]" type="text">
				</span>
				<span class="span-class">
					<label class="labels__">Date Obtained</label>
					<input class="date_obtained" name="date_obtained[]" type="date">
				</span>
				<span class="span-class">
					<label class="labels__">Expiry Date</label>
					<input class="expiry_date" name="expiry_date[]" type="date">
				</span>
				<span class="span-class">
					<label class="labels__">Certificate </label>
					<input class="certificate" name="certificate[]" type="FILE">
				</span>
		</div>
<!-- 		<span class="span-class">
			<label class="labels__">CPR-expiry</label>
			<input placeholder="CPR-expiry" id="cpr_expiry" type="text">
		</span>
		<span class="span-class">
			<label class="labels__">Prohibition-Notice-Declaration</label>
			<input placeholder="Prohibition-Notice-Declaration" id="prohibition_notice_declaration" type="date">
		</span>
		<span class="span-class">
			<label class="labels__">VIT-card-no</label>
			<input placeholder="VIT-card-no" id="vit_card_no" type="text">
		</span>
		<span class="span-class">
			<label class="labels__">VIT-expiry</label>
			<input placeholder="VIT-expiry" id="vit_expiry" type="text">
		</span>
		<span class="span-class">
			<label class="labels__">WWCC-card-no	</label>
			<input placeholder="WWCC-card-no" id="wwcc_card_no" type="text">
		</span>
		<span class="span-class">
			<label class="labels__">WWCC-expiry</label>
			<input placeholder="WWCC-expiry" id="wwcc_expiry" type="text">
		</span>
		<span class="span-class">
			<label class="labels__">Food-handling-safety</label>
			<input placeholder="Food-handling-safety" id="food_handling_safety" type="date">
		</span>
		<span class="span-class">
			<label class="labels__">Last-police-check</label>
			<input placeholder="Last-police-check" id="last_police_check" type="date">
		</span>
		<span class="span-class">
			<label class="labels__">Child-protection-check</label>
			<input placeholder="Child-protection-check" id="child_protection_check" type="date">
		</span>
		<span class="span-class">
			<label class="labels__">Nominated-supervisor</label>
			<label class="labels__" class="yn-label">Yes</label>
				<input  type="radio"  name="nominated_supervisor" class="nominated_supervisor yn-input" value="Y">
			<label class="labels__" class="yn-label">No</label>
				<input type="radio" name="nominated_supervisor" class="nominated_supervisor yn-input" value="N">
		</span> -->
	</section>

	<section class="medical-info">
		<h3>Medical Information<!-- <span id="Medical Information"> + </span> --></h3>
<!-- 		<span class="span-class">
			<label class="labels__">Employee Id</label>
			<input id="employeeId" >
		</span> -->
		<span class="span-class">
			<label class="labels__">Medicare Number</label>
				<input  type="text"  name="medicareNo" class="medicareNo">
		</span>
		<span class="span-class">
			<label class="labels__">Medicare Reference Number</label>
				<input  type="text"  name="medicareRefNo" class="medicareRefNo">
		</span>
		<span class="span-class">
			<label class="labels__">Health Insurance Fund</label>
				<input  type="text"  name="healthInsuranceFund" class="healthInsuranceFund">
		</span>
		<span class="span-class">
			<label class="labels__">Health Insurance Number</label>
				<input  type="text"  name="healthInsuranceNo" class="healthInsuranceNo">
		</span>
		<span class="span-class">
			<label class="labels__">Ambulance Subscription Number</label>
				<input  type="text"  name="ambulanceSubscriptionNo" class="ambulanceSubscriptionNo" >
		</span>
		<span class="span-class">
			<label class="labels__">Medical Conditions</label>
				<input  type="text"  name="medicalConditions[]" class="medicalConditions">
		</span>
		<span class="span-class">
			<label class="labels__">Medical Allergies</label>
				<input  type="text"  name="medicalAllergies[]" class="medicalAllergies">
		</span>
		<span class="span-class">
			<label class="labels__">Medication</label>
				<input  type="text"  name="medication[]" class="medication">
		</span>
		<span class="span-class">
			<label class="labels__">Dietary Preferences</label>
				<input  type="text"  name="dietaryPreferences[]" class="dietaryPreferences">
		</span>
<!-- 		<span class="span-class">
			<label class="labels__">Anaphylaxis</label>
				<input  type="date"  name="anaphylaxis" class="anaphylaxis">
		</span>
		<span class="span-class">
			<label class="labels__">Asthma</label>
				<input  type="date"  name="asthma" class="asthma">
		</span>
		<span class="span-class">
			<label class="labels__">Maternity Start Date</label>
				<input  type="date"  name="maternityStartDate" class="maternityStartDate">
		</span>
		<span class="span-class">
			<label class="labels__">Maternity End Date</label>
				<input  type="date"  name="maternityEndDate" class="maternityEndDate">
		</span> -->
	</section>
	<div class="submit_addEmployee">
		<button id="submit">
			<i>
				<img src="<?php echo base_url('assets/images/icons/send.png'); ?>" style="max-height:1rem;margin-right:10px">
			</i>Submit</button>
	</div>
</form>
<?php } ?>
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
<?php if(isset($permissions->permissions) ? $permissions->permissions->editEmployeeYN : "N" == "Y"){ ?>


<script type="text/javascript">

// Notification //
    function showNotification(){
      $('.notify_').css('visibility','visible');
    }
    function addMessageToNotification(message){
      $('._notify_message').append(`<li>${message}</li>`)
    }
    function closeNotification(){
      $('.notify_').css('visibility','hidden');
      $('._notify_message').empty();
    }
  // Notification //

	$(document).ready(function(){
		$(document).on('click','.e-b-a-s',function(){
			$('.employee-bank-account-section').css('display','block')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','none');
			$('.medical-info').css('display','none');
		})
		$(document).on('click','.e-s',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','block');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','none');
			$('.medical-info').css('display','none');
		})
		$(document).on('click','.e-s-s',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','block');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','none');
			$('.medical-info').css('display','none');
		})
		$(document).on('click','.e-t-d-s',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','block');
			$('.employee-details').css('display','none');
			$('.medical-info').css('display','none');
		})
		$(document).on('click','.e-u-s',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','block');
			$('.medical-info').css('display','none');
		})
		$(document).on('click','.m-i',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','none');
			$('.medical-info').css('display','block');
		})
	})

	var new_child = $('.parent-child ').html();
	$(document).on('click','.add-row',function(){
		$('.parent-child').append(new_child);
				accountCount();
	});
	$(document)
	function accountCount(){
		var count = $('.statement').length;
			for(x=0 ; x< count ; x++){
			$('.statement').eq(x).text('Account '+ (x+1))
		}
	}

	accountCount();
		

	$(document).ready(function(){
		$(document).on('click','.add-row',function(){
			var count = $('.statement').length;
			if(count > 1){
				$('.amount-class-parent').eq(0).empty();
				$('.remainderYN[value="N"]').eq(0).prop('checked',true);
				for(i = 1 ; i < count ; i++){
					$('.remainderYN[value="Y"]').eq(i).attr('name','remaindeYN-'+i);
					$('.remainderYN[value="N"]').eq(i).attr('name','remaindeYN-'+i);
					$('.remainderYN[value="Y"]').eq(i).prop('checked',true);
					$('.remainderYN[value="Y"]').eq(i).attr('disabled',true);
					$('.remainderYN[value="N"]').eq(i).attr('disabled',true);

					}
					
				}
			});
					$('.remainderYN[value="N"]').eq(0).prop('checked',true);
		});

	
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
			console.log($(response).find('#area').html())
			$('#area-select').html($(response).find('#area'))
			$('#role-select').html($(response).find('#role'))
			for(x=0;x<$('#role').children().length;x++){
					$('#role').children('option').eq(x).css('display','none')
			}
				}
			})
		})
	});

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



	function onFormSubmit(e){
		if($('#fname').val() == null || $('#fname').val() == "" || 	$('#lname').val() == null || $('#lname').val() == ""){
		$('#fname').css({"border-color": "red", 
             "border-width":"1px", 
             "border-style":"solid"})
	    showNotification();
      addMessageToNotification('All Name Fields are required');
      setTimeout(closeNotification,5000)
		return false;
		}
		if($('#emails').val() == null || $('#emails').val() == ""){
			$('#emails').css({"border-color": "red", 
             "border-width":"1px", 
             "border-style":"solid"})
      showNotification();
      addMessageToNotification('Enter Email');
      setTimeout(closeNotification,5000)
			return false;
		}
		if($('#alias').val() == null || $('#alias').val() == ""){
			$('#alias').css({"border-color": "red", 
             "border-width":"1px", 
             "border-style":"solid"})
      showNotification();
      addMessageToNotification('Enter Alias Name');
      setTimeout(closeNotification,5000)
			return false;
		}
		if($('#jobTitle').val() == null || $('#jobTitle').val() == ""){
			$('#jobTitle').css({"border-color": "red", 
             "border-width":"1px", 
             "border-style":"solid"})
      showNotification();
      addMessageToNotification('Enter Job Title');
      setTimeout(closeNotification,5000)
			return false;
		}
		if($('#startDate').val() == null || $('#startDate').val() == ""){
			$('#startDate').css({"border-color": "red", 
             "border-width":"1px", 
             "border-style":"solid"})
      showNotification();
      addMessageToNotification('Enter Start Date');
      setTimeout(closeNotification,5000)
			return false;
		}
		if( $('#employee_no').val() == null || $('#employee_no').val() == "" ){
			$('#employee_no').css({"border-color": "red", 
             "border-width":"1px", 
             "border-style":"solid"})
      showNotification();
      addMessageToNotification('Enter Employee Number');
      setTimeout(closeNotification,5000)
			return false;
		}
		if( $('#area').val() == null || $('#area').val() == "" ){
			$('#area').css({"border-color": "red", 
             "border-width":"1px", 
             "border-style":"solid"})
      showNotification();
      addMessageToNotification('Select Area');
      setTimeout(closeNotification,5000)
			return false;
		}
		if( $('#role').val() == null || $('#role').val() == "" ){
			$('#role').css({"border-color": "red", 
             "border-width":"1px", 
             "border-style":"solid"})
      showNotification();
      addMessageToNotification('Select Role');
      setTimeout(closeNotification,5000)
			return false;
		}
		if( $('#level').val() == null || $('#level').val() == "" ){
			$('#level').css({"border-color": "red", 
             "border-width":"1px", 
             "border-style":"solid"})
      showNotification();
      addMessageToNotification('Select Level');
      setTimeout(closeNotification,5000)
			return false;
		}
	}

	$(document).ready(function(){

		var superfundHTML = $('.superfund-parent').html();
		$(document).on('click','#superfund-add',function(){
		$('.superfund-parent').append(superfundHTML);
		})
	})

	$(document).ready(()=>{
			$('.e-s span').addClass('arrow');
        $('.e-s').click(function(){
        	$('.e-s span').addClass('arrow');
					$('.e-b-a-s span').removeClass('arrow');
					$('.e-s-s span').removeClass('arrow');
					$('.e-t-d-s span').removeClass('arrow');
					$('.e-u-s span').removeClass('arrow');
					$('.m-i span').removeClass('arrow');
        })
        $('.e-b-a-s').click(function(){
        	$('.e-s span').removeClass('arrow');
					$('.e-b-a-s span').addClass('arrow');
					$('.e-s-s span').removeClass('arrow');
					$('.e-t-d-s span').removeClass('arrow');
					$('.e-u-s span').removeClass('arrow');
					$('.m-i span').removeClass('arrow');
        })
        $('.e-s-s').click(function(){
        	$('.e-s span').removeClass('arrow');
					$('.e-b-a-s span').removeClass('arrow');
					$('.e-s-s span').addClass('arrow');
					$('.e-t-d-s span').removeClass('arrow');
					$('.e-u-s span').removeClass('arrow');
					$('.m-i span').removeClass('arrow');
        })
        $('.e-t-d-s').click(function(){
        	$('.e-s span').removeClass('arrow');
					$('.e-b-a-s span').removeClass('arrow');
					$('.e-s-s span').removeClass('arrow');
					$('.e-t-d-s span').addClass('arrow');
					$('.e-u-s span').removeClass('arrow');
					$('.m-i span').removeClass('arrow');
        })
        $('.e-u-s').click(function(){
        	$('.e-s span').removeClass('arrow');
					$('.e-b-a-s span').removeClass('arrow');
					$('.e-s-s span').removeClass('arrow');
					$('.e-t-d-s span').removeClass('arrow');
					$('.e-u-s span').addClass('arrow');
					$('.m-i span').removeClass('arrow');
        })
        $('.m-i').click(function(){
        	$('.e-s span').removeClass('arrow');
					$('.e-b-a-s span').removeClass('arrow');
					$('.e-s-s span').removeClass('arrow');
					$('.e-t-d-s span').removeClass('arrow');
					$('.e-u-s span').removeClass('arrow');
					$('.m-i span').addClass('arrow');
        })
    });
</script>
<?php } ?>
</body>
</html>


