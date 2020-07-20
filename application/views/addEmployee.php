
<!DOCTYPE html>
<html>
<head>
	<title>Add Employee</title>
	<style type="text/css">
		label{
			font-weight: bolder
		}
		h5{
			padding-left: 10px
		}
		body{
			background: #f2f2f2 !important;
			font-size: 0.8rem;
		}
		.employee-section{
			padding-left: 10px;
		}
		.employee-bank-account-section{
			display: none;
			padding-left: 10px;
			flex-wrap: wrap
		}
		.employee-superfund-section{
			display: none;
			padding-left: 10px;
			flex-wrap: wrap
		}
		.employee-tax-declaration-section{
			display: none;
			padding-left: 10px;
			flex-wrap: wrap
		}
		.employee-details{
			display: none;
			padding-left: 10px;
			flex-wrap: wrap
		}
		.medical-info{
			display: none;
			padding-left: 10px;
			flex-wrap: wrap
		}
		.tab-buttons{
			margin-bottom:10px;
			display: flex;
			justify-content: center;
			align-content: center;
			color: white;
			width:100%;
			border-bottom: 1px solid #979797;
		}
		.tab-buttons-div{
			border-radius: 4px;
			padding: 10px;
			display: flex;
			justify-content: center;
		}
		.nav-button{
			padding-right:15px;
			position: relative;
			color: #4B4B4B;
			font-size:0.85rem;
		}
		.nav-button > span{
/*			border:1px solid #307bd3;
			background:  #307bd3;
			color: white;
			padding:5px;
			border-radius: 3px*/
		}
		.nav-button > span:hover{
			cursor: pointer;
		}
		input,select{
			display: block;
		    width: auto;
		    height: 1.5rem;
		    font-size: 0.8rem;
		    font-weight: 400;
		    line-height: 1.5;
		    color: #495057;
		    background-color: #fff;
		    background-clip: padding-box;
		    border: 1px solid #ced4da;
		    border-radius: .25rem;
		    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
		}
		.span-class{
			padding:10px;
			display: inline-block;
		}

		label{
			width:100%;
			margin: 0 !important;
		}
		#submit{
		background-color: #60AC0C;
  		border: none;
  		color: white;
  		padding: 0.5rem 0.5rem;
  		text-align: center;
  		border-radius: 5px;
  		text-decoration: none;
  		display: inline-block;
  		margin: 2px
			}
		.span-class.row{
			margin:0;
			width:100%;
		}
		.span-class.row span input{
			padding:10px;
			width:auto;
		}
		.yn-input{
			width:auto;
			display: inline;
			height: auto
		}
		.yn-label{
			display: inline;
			font-weight: normal;
		}
		.submit-div{
			display: flex;
			justify-content: center;
			position: absolute;
			bottom: 0;
			width: 100%;
			border-top:1px solid #979797;
			padding: 0.5%;
		}
		.row.ml-1 > .span-class{
			padding:0;
			padding-left: 10px
		}
		.row{
			margin-left: 0 !important;
			margin-right: 0 !important
		}
		.arrow{

		    background: white;
		    color:  #307bd3;
		    padding:3px;
		    border-radius:;
		}
		.arrow::after{
			content: " ";
		    /* background: red; */
		    margin-top: 29px;
		    position: absolute;
		    width: 100%;
		    border-top: 2px solid #307bd3;
		    left:0;
		}
	.addEmployee-container{
		height:100vh;
		padding:4rem 3rem 2rem 2rem;
	}
	.addEmployee-container-child{
		height:100%;
		background: white;
		position: relative;
	}
	.employee-section,.employee-bank-account-section,.employee-superfund-section, 
	.employee-tax-declaration-section,.employee-details,.medical-info{
		max-height: 80%;
		height: 80%;
		overflow: auto
	}
	</style>
</head>
<body>
<?php $this->load->view('header'); ?>
<div class="containers">
	<span style="position: absolute;top:20px;padding-left: 2rem">
      <a href="<?php echo base_url();?>/settings">
        <button class="btn back-button">
          <img src="<?php echo base_url('assets/images/back.svg');?>">
          <span style="font-size:0.8rem">Add Employee</span>
        </button>
      </a>
    </span>
	<div class="addEmployee-container">
	<div class="addEmployee-container-child">
	<?php $permissions = json_decode($permissions); ?>
<?php if(isset($permissions->permissions) ? $permissions->permissions->editEmployeeYN : "N" == "Y"){ ?>
	<section class="tab-buttons">
		<div class="tab-buttons-div">
		<span class="nav-button e-s"><span>Employee Section</span></span>
		<span class="nav-button e-b-a-s"><span>Employee Bank Account Section</span></span>
		<span class="nav-button e-s-s"><span>Employee Superfund Section</span></span>
		<span class="nav-button e-t-d-s"><span>Employee Tax Declaration Section</span></span>
		<span class="nav-button e-u-s"><span>Employee Details</span></span>	
		<span class="nav-button m-i"><span>Medical Info</span></span>
		</div>	
	</section>
	<section class="employee-section">	
		<!-- <h3>Employee Section</h3> -->
		<span class="d-flex">
		<span class="span-class ">
			<label>Title</label>
			<select placeholder="Title" id="title"  class="" type="text"> 
				<option value="Ms">Ms</option> 
				<option value="Mr">Mr</option>
				<option value="Mrs">Mrs</option>
			</select>
		</span>
	<span class="span-class ">
		<label>Name</label>
		<span class="row ml-1 ">
		<span class="span-class col-4 ">
			<!-- <label>First Name</label> -->
			<input placeholder="First Name" id="fname"  class="" type="text">
		</span>
		<span class="span-class col-4 ">
			<!-- <label>Middle Name</label> -->
			<input placeholder="Middle Name" id="mname"  class="" type="text">
		</span>
		<span class="span-class col-4 ">
			<!-- <label>Last Name</label> -->
			<input placeholder="Last Name" id="lname"  class="" type="text">
		</span>
	</span>
	</span>
</span>
		
		<span class="span-class">
			<label>Email</label>
			<input placeholder="Emails" id="emails"  class="" type="text">
		</span>
		<span class="span-class">
			<label>Date Of Birth</label>
			<input placeholder="Date Of Birth" id="dateOfBirth"  class="" type="date">
		</span>
		<span class="span-class">
			<label>Gender</label>
			<select placeholder="Gender" id="gender"  class="" >
				<option value="N">Not Given</option>
				<option value="M">Male</option>
				<option value="F">Female</option>
				<option value="I">Non binary</option>
			</select>
		</span>
				
		<span class="span-class">
			<label>Job Title</label>
			<input placeholder="Job Title" id="jobTitle"  class="" type="text">
		</span>
	
		<span class="span-class row">
		<label>Address</label>	
			<span class="span-class  col-4">
				<!-- <label>Home Address Line1</label> -->
				<input placeholder="Home Address Line1" id="homeAddLine1"  class="" type="text">
			</span>
			<span class="span-class col-4">
				<!-- <label>Home Address Line2</label> -->
				<input placeholder="Home Address Line2" id="homeAddLine2"  class="" type="text">
			</span>
			<span class="span-class col-4">
				<!-- <label>City</label> -->
				<input placeholder="City" id="homeAddCity"  class="" >
			</span>				
			<span class="span-class col-4">
				<!-- <label>Region</label> -->
				<select placeholder="Region" id="homeAddRegion"  class="" type="text">
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
			<span class="span-class col-4">
				<!-- <label>Postal</label> -->
				<input placeholder="Postal" id="homeAddPostal"  class="" type="text">
			</span>
			<span class="span-class col-4">
				<!-- <label>Country</label> -->
				<input placeholder="Country" id="homeAddCountry"  class="" type="text">
			</span>
		</span>
		<span class="span-class">
			<label>Contact</label>
				<span class="span-class">
					<input placeholder="Phone" id="phone"  class="" type="text">
				</span>
				<span class="span-class">
					<input placeholder="Mobile" id="mobile"  class="" type="text">
				</span>
		</span>
	<span class="d-block">
		<span class="span-class col-3">
			<label>Start Date</label>
			<input placeholder="Start Date" id="startDate"  class="" type="date">
		</span>
		<span class="span-class col-3">
			<label>Termination Date</label>
			<input placeholder="Termination Date" id="terminationDate"  class="" type="date">
		</span>
				
		<span class="span-class col-3">
			<label>Ordinary Earning Rate Id</label>
			<select placeholder="Ordinary Earning Rate Id" id="ordinaryEarningRateId"  class="" type="text">
			<?php
					$ordinaryEarningRate = json_decode($ordinaryEarningRate);
					foreach($ordinaryEarningRate->awards as $rate){
			?>
				<option value="<?php echo $rate->earningRateId?>"><?php echo $rate->name?></option>
			<?php }?>
			</select>
		</span>
	</span>
<!-- 		<span class="span-class">
			<label>created_at</label>
			<input placeholder="created_at" id="created_at"  class="" type="text">
		</span>
		<span class="span-class">
			<label>created_by</label>
			<input placeholder="created_by" id="created_by"  class="" type="text">
		</span> -->
	</section>

	<section class="employee-bank-account-section">
		<h3>Employee Bank Account Section<span class="add-row"> + </span></h3>
		<div class="parent-child">
			<div class="child">
				<div class="statement"></div>
			<div class="row">
		<span class="span-class col-4">
			<label>Statement Text</label>
			<input placeholder="Statement Text"  class="statementText" >
		</span>
		<span class="span-class col-4">
			<label>Account Name</label>
			<input placeholder="Account Name"  class="accountName" >
		</span>
		<span class="span-class col-4">
			<label>BSB</label>
			<input placeholder="BSB"  class="bsb" >
		</span>
	</div>
		
	<span class="row">
		<span class="span-class col-4">
			<label>Account Number</label>
			<input placeholder="Account Number"  class="accountNumber" >
		</span>
		<span class="span-class col-4">
			<label>Remainder</label>
				<span>
					<label class="yn-label">Yes</label>
					<input value="Y" class="remainderYN yn-input" type="radio" name="remainderYN">
				</span>
				<span>
					<label class="yn-label">No</label>
					<input value="N" class="remainderYN yn-input" type="radio" name="remainderYN">
				</span>
		</span>
		<span class="span-class amount-class-parent col-4">
			<div class="amount-class">
				<label>Amount</label>
				<input placeholder="Amount"  class="amount" >
			</div>
		</span>
	</span>
			</div>
		</div>
	</section>



	<section class="employee-superfund-section">
		<h3>Employee Superfund Section<span id="superfund-add"> + </span></h3>
<!-- 		<span class="span-class">
			<label>Employee Id</label>
			<input placeholder="Employee Id" id="employeeId" >
		</span> -->
			<div class="superfund-parent">
				<div class="superfund-child row">
					<span class="span-class col-4">
						<label>Super Fund Id</label>
						<?php $superfunds = json_decode($superfunds); ?>
						<select placeholder="Super Fund Id" class="superFundId" >
							<?php foreach($superfunds->superfunds as $superfund){ ?>
							<option value="<?php echo $superfund->usi; ?>"><?php echo $superfund->name; ?></option>
							<?php } ?>
						</select>
					</span>
					<span class="span-class col-4">
						<label>Employee Number</label>
						<input placeholder="Employee Number" class="employeeNumber" >
					</span>
					<span class="span-class col-4">
						<label>Super Membership Id</label>
						<input placeholder="Super Membership Id" class="superMembershipId" >
					</span>
				</div>
			</div>

	</section>





	<section class="employee-tax-declaration-section">
		<!-- <h3>Employee Tax Declaration Section</h3> -->

		<span class="span-class col-4">
			<label>Employment Basis</label>
			<select placeholder="employmentBasis" id="employmentBasis">
				<option value="FULLTIME">FULLTIME </option>
				<option value="PARTTIME">PARTTIME</option>
				<option value="CASUAL">CASUAL</option>
				<option value="LABOURHIRE">LABOURHIRE</option>
				<option value="SUPERINCOMEST">SUPERINCOMEST</option>
			</select>
		</span> 
		<span class="span-class col-4">
			<label>TFN Exemption Type</label>
			<select placeholder="tfnExemptionType" id="tfnExemptionType">
				<option value="NONE">NONE</option>
				<option value="NOTQUOTED">NOTQUOTED</option>
				<option value="PENDING">PENDING</option>
				<option value="PENSIONER">PENSIONER</option>
				<option value="UNDER18">UNDER18</option>
			</select>
		</span> 
		<div class="tax-declaration-class col-lg-12">
		<span class="span-class col-4">
			<label>Tax File Number</label>
			<input placeholder="Tax File Number" id="taxFileNumber">
		</span>
		<span class="span-class col-4">
			<label>Australian Resident For TaxPurpose</label>
			<label class="yn-label">Yes</label>
				<input placeholder="Australian Resident For TaxPurpose" type="radio"  name="australiantResidentForTaxPurposeYN" class="australiantResidentForTaxPurposeYN yn-input" value="Y">
			<label class="yn-label">No</label>
				<input type="radio" name="australiantResidentForTaxPurposeYN" class="australiantResidentForTaxPurposeYN yn-input" value="N">
		</span>
		<span class="span-class col-3">
			<label>Residency Statue</label>
			<select placeholder="residencyStatue" id="residencyStatue">
				<option value="AUSTRALIANRESIDENT">Australian Resident</option>
				<option value="FOREIGNRESIDENT">Foreign Resident</option>
				<option value="WORKINGHOLIDAY">Working Holiday</option>
			</select>
		</span>
		<span class="span-class col-4">
			<label>Tax Free Threshold Claimed</label>
			<label class="yn-label">Yes</label>
				<input placeholder="taxFreeThresholdClaimedYN" type="radio" name="taxFreeThresholdClaimedYN" class="taxFreeThresholdClaimedYN yn-input" value="Y">
			<label class="yn-label">No</label>
				<input type="radio" name="taxFreeThresholdClaimedYN" class="taxFreeThresholdClaimedYN yn-input" value="N">
		</span>
		<span class="span-class col-4">
			<label>Tax Offset Estimated Amount</label>
			<input placeholder="Tax Offset Estimated Amount" id="taxOffsetEstimatedAmount">
		</span>
		<span class="span-class col-3">
			<label>Has HELP Debt</label>
			<label class="yn-label">Yes</label>
			<input placeholder="hasHELPDebtYN" name="hasHELPDebtYN" class="hasHELPDebtYN yn-input" value="Y" type="radio">
			<label class="yn-label">No</label>
			<input type="radio" name="hasHELPDebtYN" class="hasHELPDebtYN yn-input" value="N">	
		</span>
		<span class="span-class col-4">
			<label>Has SFSS Debt</label>
			<label class="yn-label">Yes</label>
			<input placeholder="hasSFSSDebtYN" type="radio" name="hasSFSSDebtYN" class="hasSFSSDebtYN yn-input"
			 value="Y">
			<label class="yn-label">No</label>
			<input type="radio" name="hasSFSSDebtYN" class="hasSFSSDebtYN yn-input" value="N">
		</span>
		<span class="span-class col-4">
			<label>Has Trade Support Loan Debt</label>
			<label class="yn-label">Yes</label>
			<input placeholder="hasTradeSupportLoanDebtYN" type="radio" name="hasTradeSupportLoanDebtYN " class="hasTradeSupportLoanDebtYN yn-input" value="Y">
			<label class="yn-label">No</label>
			<input type="radio" name="hasTradeSupportLoanDebtYN " class="hasTradeSupportLoanDebtYN yn-input" value="N">
		</span>
		<span class="span-class col-3">
			<label>Upward Variation Tax Witholding Amount</label>
			<input placeholder="Upward Variation Tax Witholding Amount" id="upwardVariationTaxWitholdingAmount">
		</span>
		<span class="span-class col-4">
			<label>Eligible To Receive Leave Loading</label>
			<label class="yn-label">Yes</label>
			<input placeholder="eligibleToReceiveLeaveLoadingYN" type="radio" class="eligibleToReceiveLeaveLoadingYN yn-input" name="eligibleToReceiveLeaveLoadingYN" value="Y">
			<label class="yn-label">No</label>
			<input type="radio" name="eligibleToReceiveLeaveLoadingYN" class="eligibleToReceiveLeaveLoadingYN yn-input" value="N">
		</span>
		<span class="span-class col-4">
			<label>Approved Witholding Variation Percentage</label>
			<input placeholder="Approved Witholding Variation Percentage" id="approvedWitholdingVariationPercentage">
		</span>
		
	</div>
	</section>


	<section class="employee-details">
		<span class="span-class">
			<label>Center</label>

			<select placeholder="Center" id="center">
				<option>--Center--</option>
				<?php 
					$centers = json_decode($centers);
				foreach($centers->centers as $center){ ?> 
					<option value="<?php echo $center->centerid;?>"><?php echo $center->name;?></option>
				<?php } ?>
			</select>
		</span>

		<span class="span-class">
			<label>Area</label>

				<span class="" id="area-select">
					<select placeholder="Area" id="area">
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

		<span class="span-class">
			<label>Role</label>
			<span id="role-select">
			<select placeholder="Role" id="role">
				<option>--select--</option>

				<?php foreach($areas->areas as $roles){?>
					<?php foreach($roles->roles as $role){?>
				<option area-id="<?php print_r($role->areaid); ?>" ><?php print_r($role->roleName) ?></option>
				<?php } } ?>
			</select>
		</span>
		</span>

		<span class="span-class">
			<label>Manager</label>
			<input placeholder="Manager" id="manager">
		</span>


		<span class="span-class">
			<label>Level</label>
			<select placeholder="Level" id="level">
				<?php $levels = json_decode($levels);
					foreach($levels->entitlements as $level){
					?>
				<option><?php echo $level->name; ?></option>
				<?php } ?>
			</select>
		</span>
		<span class="span-class">
			<label>Bonus Rates</label>
			<input placeholder="Bonus Rates" id="bonusRates" type="number" step="0.01" min="0">
		</span>
		<span class="span-class">
			<label>	Employee-no </label>
			<input placeholder="Employee-no " id="employee_no " type="text">
		</span>
		<span class="span-class">
			<label>	Currently-employed</label>
			<label class="yn-label">Yes</label>
			<input  type="radio" name="currently_employed " class="currently_employed yn-input" value="Y">
			<label class="yn-label">No</label>
			<input type="radio" name="currently_employed " class="currently_employed yn-input" value="N">
		</span>
		<span class="span-class">
			<label>	Commencement-date</label>
			<input placeholder="Commencement-date" id="commencement_date" type="date">
		</span>

		<span class="span-class">
			<label>Contract-position	</label>
			<input placeholder="Contract-position	" id=" " type="text">
		</span>
		<span class="span-class">
			<label>Resume-supplied</label>
			<label class="yn-label">Yes</label>
			<input  type="radio" name="resume_supplied" class="resume_supplied yn-input" value="Y">
			<label class="yn-label">No</label>
			<input type="radio" name="resume_supplied" class="resume_supplied yn-input" value="N">
		</span>

		<span class="span-class">
			<label>Resume Document </label>
			<input  id="resume_doc" type="file">
		</span>

		<span class="span-class">
			<label>Employment-type</label>
			<select id="employement_type">
				<option value="FT">Full Time</option>
				<option value="PT">Part Time</option>
				<option value="Casual">Casual</option>
			</select>
		</span>
		<span class="span-class">
			<label>Current-contract-notes</label>
			<input placeholder="Current-contract-notes" id="current_contract_notes" type="date">
		</span>
		<span class="span-class">
			<label>Current-contract-signature-date 	</label>
			<input placeholder="Current-contract-signature-date" id="current_contract_signature_date" type="date">
		</span>
		<span class="span-class">
			<label>Current-contract-commencement-date </label>
			<input placeholder="Current-contract-commencement-date" id="current_contract_commencement_date" type="date">
		</span>
		<span class="span-class">
			<label>Current-contract-end-date	</label>
			<input placeholder="Current-contract-end-date" id="current_contract_end_date" type="date">
		</span>
		<span class="span-class">
			<label>Current-contract-paid-start-date </label>
			<input placeholder="Current-contract-paid-start-date" id="current_contract_paid_start_date" type="date">
		</span>
		<span class="span-class">
			<label>Probation-end-date 	</label>
			<input placeholder="Probation end date" id="probation_end_date" type="date">
		</span>
		<span class="span-class">
			<label>Industry-years-exp-as-nov19	</label>
			<input placeholder="Industry-years-exp-as-nov19	" id="industry_years_exp_as_nov19" type="text">
		</span>

		<span class="span-class">
			<label>Highest-qual-held</label>
			<input placeholder="Highest-qual-held" id="highest_qual_held" type="text">
		</span>
		<span class="span-class">
			<label>Highest-qual-type	 </label>
			<input placeholder="Highest-qual-type" id="highest_qual_type" type="text">
		</span>
		<span class="span-class">
			<label>Qual-towards-desc</label>
			<input placeholder="Qual-towards-desc" id="qual_towards_desc" type="text">
		</span>
		<span class="span-class">
			<label>Qual-towards-%-comp</label>
			<input placeholder="Qual towards % comp" id="qual_towards_percent_comp" type="text">
		</span>

		<span class="span-class">
			<label>	Workcover</label>
			<input placeholder="Workcover" id="workcover" type="text">
		</span>
		<span class="span-class">
			<label>	PIAWE</label>
			<input placeholder="PIAWE" id="piawe" type="text">
		</span>
		<span class="span-class">
			<label>	Annual-leave-in-contract</label>
			<input placeholder="Annual-leave-in-contract" id="annual_leave_in_contract" type="text">
		</span>
		<span class="span-class">
			<label>	Visa-type		</label>
			<input placeholder="Visa-type		" id="visa_type		" type="text">
		</span>
		<span class="span-class">
			<label>	Visa-grant-date	</label>
			<input placeholder="Visa-grant-date	" id="visa_grant_date	" type="text">
		</span>
		<span class="span-class">
			<label>	Visa-end-date	</label>
			<input placeholder="Visa-end-date	" id="visa_end_date	" type="text">
		</span>
		<span class="span-class">
			<label>	Visa-conditions</label>
			<input placeholder="Visa-conditions" id="visa_conditions" type="text">
		</span>
		<span class="span-class">
			<label>First-aid-expiry</label>
			<input placeholder="First-aid-expiry" id="first_aid_expiry" type="text">
		</span>
		<span class="span-class">
			<label>CPR-expiry</label>
			<input placeholder="CPR-expiry" id="cpr_expiry" type="text">
		</span>
		<span class="span-class">
			<label>Prohibition-Notice-Declaration</label>
			<input placeholder="Prohibition-Notice-Declaration" id="prohibition_notice_declaration" type="date">
		</span>
		<span class="span-class">
			<label>VIT-card-no</label>
			<input placeholder="VIT-card-no" id="vit_card_no" type="text">
		</span>
		<span class="span-class">
			<label>VIT-expiry</label>
			<input placeholder="VIT-expiry" id="vit_expiry" type="text">
		</span>
		<span class="span-class">
			<label>WWCC-card-no	</label>
			<input placeholder="WWCC-card-no" id="wwcc_card_no" type="text">
		</span>
		<span class="span-class">
			<label>WWCC-expiry</label>
			<input placeholder="WWCC-expiry" id="wwcc_expiry" type="text">
		</span>
		<span class="span-class">
			<label>Food-handling-safety</label>
			<input placeholder="Food-handling-safety" id="food_handling_safety" type="date">
		</span>
		<span class="span-class">
			<label>Last-police-check</label>
			<input placeholder="Last-police-check" id="last_police_check" type="date">
		</span>
		<span class="span-class">
			<label>Child-protection-check</label>
			<input placeholder="Child-protection-check" id="child_protection_check" type="date">
		</span>
		<span class="span-class">
			<label>Nominated-supervisor</label>
			<label class="yn-label">Yes</label>
				<input  type="radio"  name="nominated_supervisor" class="nominated_supervisor yn-input" value="Y">
			<label class="yn-label">No</label>
				<input type="radio" name="nominated_supervisor" class="nominated_supervisor yn-input" value="N">
		</span>
	</section>

	<section class="medical-info">
		<h3>Medical Information<!-- <span id="Medical Information"> + </span> --></h3>
<!-- 		<span class="span-class">
			<label>Employee Id</label>
			<input placeholder="Employee Id" id="employeeId" >
		</span> -->
		<span class="span-class">
			<label>Medicare Number</label>
				<input  type="text"  name="medicareNo" class="medicareNo">
		</span>
		<span class="span-class">
			<label>Medicare Reference Number</label>
				<input  type="text"  name="medicareRefNo" class="medicareRefNo">
		</span>
		<span class="span-class">
			<label>Health Insurance Fund</label>
				<input  type="text"  name="healthInsuranceFund" class="healthInsuranceFund">
		</span>
		<span class="span-class">
			<label>Health Insurance Number</label>
				<input  type="text"  name="healthInsuranceNo" class="healthInsuranceNo">
		</span>
		<span class="span-class">
			<label>Ambulance Subscription Number</label>
				<input  type="text"  name="ambulanceSubscriptionNo" class="ambulanceSubscriptionNo" >
		</span>
		<span class="span-class">
			<label>Medical Conditions</label>
				<input  type="text"  name="medicalConditions" class="medicalConditions">
		</span>
		<span class="span-class">
			<label>Medical Allergies</label>
				<input  type="text"  name="medicalAllergies" class="medicalAllergies">
		</span>
		<span class="span-class">
			<label>Medication</label>
				<input  type="text"  name="medication" class="medication">
		</span>
		<span class="span-class">
			<label>Dietary Preferences</label>
				<input  type="text"  name="dietaryPreferences" class="dietaryPreferences">
		</span>
		<span class="span-class">
			<label>Anaphylaxis</label>
				<input  type="date"  name="anaphylaxis" class="anaphylaxis">
		</span>
		<span class="span-class">
			<label>Asthma</label>
				<input  type="date"  name="asthma" class="asthma">
		</span>
		<span class="span-class">
			<label>Maternity Start Date</label>
				<input  type="date"  name="maternityStartDate" class="maternityStartDate">
		</span>
		<span class="span-class">
			<label>Maternity End Date</label>
				<input  type="date"  name="maternityEndDate" class="maternityEndDate">
		</span>
	</section>

	<div class="submit-div">
		<button id="submit">Submit</button>
	</div>
<?php } ?>
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
	$(document).ready(function(){
		$(document).on('click','#submit',function(){
		var title = $('#title').val();
		var fname = $('#fname').val();
		var mname = $('#mname').val();
		var lname = $('#lname').val();
		var emails = $('#emails').val();
		var dateOfBirth = $('#dateOfBirth').val();
		var jobTitle = $('#jobTitle').val();
		var gender = $('#gender').val();
		var homeAddLine1 = $('#homeAddLine1').val();
		var homeAddLine2 = $('#homeAddLine2').val();
		var homeAddCity = $('#homeAddCity').val();
		var homeAddRegion = $('#homeAddRegion').val();
		var homeAddPostal = $('#homeAddPostal').val();
		var homeAddCountry = $('#homeAddCountry').val();
		var phone = $('#phone').val();
		var mobile = $('#mobile').val();
		var startDate = $('#startDate').val();
		var terminationDate = $('#terminationDate').val();
		var ordinaryEarningRateId = $('#ordinaryEarningRateId').val();
		// var created_at = $('#created_at').val();
		// var created_by = $('#created_by').val();
		// var employeeId = $('#employeeId').val();
		// var statementText = $('.statementText').val();
		// var accountName = $('.accountName').val();
		// var bsb = $('.bsb').val();
		// var accountNumber = $('.accountNumber').val();
		// var remainderYN = $('.remainderYN').val();
		// var amount = $('.amount').val();
		// var employeeId = $('#employeeId').val();
		// var superFundId = $('#superFundId').val();
		// var employeeNumber = $('#employeeNumber').val();
		// var superMembershipId = $('#superMembershipId').val();
		// var employeeId = $('#employeeId').val();
		var employmentBasis = $('#employmentBasis').val();
		var tfnExemptionType = $('#tfnExemptionType').val();
		var taxFileNumber = $('#taxFileNumber').val();
		var australiantResidentForTaxPurposeYN = $('input[name=australiantResidentForTaxPurposeYN]:checked').val()
		var residencyStatue = $('#residencyStatue').val();
		var taxFreeThresholdClaimedYN = $("input[name='taxFreeThresholdClaimedYN']:checked").val()
		var taxOffsetEstimatedAmount = $('#taxOffsetEstimatedAmount').val();
		var hasHELPDebtYN = $('input[name=hasHELPDebtYN]:checked').val()
		var hasSFSSDebtYN = $('input[name=hasSFSSDebtYN]:checked').val()
		var hasTradeSupportLoanDebtYN = $('input[name=hasTradeSupportLoanDebtYN]:checked').val()
		var upwardVariationTaxWitholdingAmount =  $('#upwardVariationTaxWitholdingAmount').val();
		var eligibleToReceiveLeaveLoadingYN = $('input[name=eligibleToReceiveLeaveLoadingYN]:checked').val()
		var approvedWitholdingVariationPercentage = $('#approvedWitholdingVariationPercentage').val();
    var medicareNo = $('.medicareNo').val();
    var medicareRefNo = $('.medicareRefNo').val();
    var healthInsuranceFund = $('.healthInsuranceFund').val();
    var healthInsuranceNo = $('.healthInsuranceNo').val();
    var ambulanceSubscriptionNo = $('.ambulanceSubscriptionNo').val();
    var medicalConditions = $('.medicalConditions').val();
    var medicalAllergies = $('.medicalAllergies').val();
    var medication = $('.medication').val();
    var dietaryPreferences = $('.dietaryPreferences').val();
    var anaphylaxis = $('.anaphylaxis').val();
    var asthma = $('.asthma').val();
    var maternityStartDate = $('.maternityStartDate').val();
    var maternityEndDate = $('.maternityEndDate').val();
		var employee_no = $('#employee_no').val();
		var currently_employed = $('input[name=currently_employed]:checked').val();
		var commencement_date = $('#commencement_date').val();
		var resume_supplied = $('input[name=resume_supplied]:checked').val();
		var resume_doc = $('#resume_doc').val();
		var employement_type = $('#employement_type').val();
		var current_contract_notes = $('#current_contract_notes').val();
		var current_contract_signature = $('#current_contract_signature_date').val();
		var current_contract_commencement = $('#current_contract_commencement_date').val();
		var current_contract_end_date = $('#current_contract_end_date').val();
		var current_contract_paid_start_date = $('#current_contract_paid_start_date').val();
		var probation_end_date = $('#probation_end_date').val();
		var industry_years_exp_as_nov19 = $('#industry_years_exp_as_nov19').val();
		var highest_qual_held = $('#highest_qual_held').val();
		var highest_qual_type = $('#highest_qual_type').val();
		var qual_towards_desc = $('#qual_towards_desc').val();
		var qual_towards_percent_comp = $('#qual_towards_percent_comp').val();
		var workcover = $('#workcover').val();
		var piawe = $('#piawe').val();
		var annual_leave_in_contract = $('#annual_leave_in_contract').val();
		var visa_type = $('#visa_type').val();
		var visa_grant_date = $('#visa_grant_date').val();
		var visa_end_date = $('#visa_end_date').val();
		var visa_conditions = $('#visa_conditions').val();
		var first_aid_expiry = $('#first_aid_expiry').val();
		var cpr_expiry = $('#cpr_expiry').val();
		var prohibition_notice_declaration = $('#prohibition_notice_declaration').val();
		var vit_card_no = $('#vit_card_no').val();
		var vit_expiry = $('#vit_expiry').val();
		var wwcc_card_no = $('#wwcc_card_no').val();
		var wwcc_expiry = $('#wwcc_expiry').val();
		var food_handling_safety = $('#food_handling_safety').val();
		var last_police_check = $('#last_police_check').val();
		var child_protection_check = $('#child_protection_check').val();
		var nominated_supervisor = $('input[name=nominated_supervisor]:checked').val();

		var bankAccount = [];
		var superfund = [];
		var banckAccountArray =	function(statementText,accountName,bsb,accountNumber,remainderYN,amount){
				this.statementText = statementText;
				this.accountName = accountName;
				this.bsb = bsb;
				this.accountNumber = accountNumber;
				this.remainderYN = remainderYN;
				this.amount = amount;
				return {statementText : statementText,accountName : accountName,bsb : bsb,				accountNumber : accountNumber,remainderYN : remainderYN,amount : amount}
			}
		var bankAccountCount = $('.child').length;
			for(x=0;x<bankAccountCount;x++){
				let statementText = $('.statementText').eq(x).val();
				let accountName = $('.accountName').eq(x).val();
				let bsb = $('.bsb').eq(x).val();
				let accountNumber = $('.accountNumber').eq(x).val();
				let remainderYN = $('.remainderYN[name=remainderYN]:checked').eq(x).val();
				let amount = $('.amount').eq(x).val();
	bankAccount.push(banckAccountArray(statementText,accountName,bsb,accountNumber,remainderYN,amount));
			}
			var superfundArray =	function(superFundId,employeeNumber,superMembershipId){
				this.superFundId = superFundId;
				this.employeeNumber = employeeNumber;
				this.superMembershipId = superMembershipId;
				return {superFundId : superFundId,employeeNumber : employeeNumber,superMembershipId : superMembershipId}
			}
			var superfundCount = $('.superfund-child').length;
			for(x=0;x<superfundCount;x++){
				let	superFundId = $('.superFundId').eq(x).val();
				let	employeeNumber = $('.employeeNumber').eq(x).val();
				let	superMembershipId = $('.superMembershipId').eq(x).val();
	superfund.push(superfundArray(superFundId,employeeNumber,superMembershipId));
			}
			var center = $('#center').val();
			var area = $('#area').val();
			var role = $('#role').val();
			var manager = $('#manager').val();
			var level = $('#level').val();
			var bonusRates = $('#bonusRates').val();
			var url = window.location.origin + "/PN101/settings/createEmployeeProfile";
				$.ajax({
			url:url,
			data:{
				title: title,
				fname: fname,
				mname: mname,
				lname: lname,
				emails: emails,
				dateOfBirth: dateOfBirth,
				jobTitle: jobTitle,
				gender: gender,
				homeAddLine1: homeAddLine1,
				homeAddLine2: homeAddLine2,
				homeAddCity: homeAddCity,
				homeAddRegion: homeAddRegion,
				homeAddPostal: homeAddPostal,
				homeAddCountry: homeAddCountry,
				phone: phone,
				mobile: mobile,
				startDate: startDate,
				terminationDate: terminationDate,
				ordinaryEarningRateId: ordinaryEarningRateId,
				bankAccount: bankAccount,
				superfund: superfund,
				employmentBasis: employmentBasis,
				tfnExemptionType: tfnExemptionType,
				taxFileNumber: taxFileNumber,
				australiantResidentForTaxPurposeYN: australiantResidentForTaxPurposeYN,
				residencyStatue: residencyStatue,
				taxFreeThresholdClaimedYN: taxFreeThresholdClaimedYN,
				taxOffsetEstimatedAmount: taxOffsetEstimatedAmount,
				hasHELPDebtYN: hasHELPDebtYN,
				hasSFSSDebtYN: hasSFSSDebtYN,
				hasTradeSupportLoanDebtYN: hasTradeSupportLoanDebtYN,
				upwardVariationTaxWitholdingAmount: upwardVariationTaxWitholdingAmount,
				eligibleToReceiveLeaveLoadingYN: eligibleToReceiveLeaveLoadingYN,
				approvedWitholdingVariationPercentage: approvedWitholdingVariationPercentage,
				center : center,
				area : area,
				role : role,
				manager : manager,
				level : level,
				bonusRates : bonusRates,
				medicareNo : medicareNo,
				medicareRefNo : medicareRefNo,
				healthInsuranceFund : healthInsuranceFund,
				healthInsuranceNo : healthInsuranceNo,
				ambulanceSubscriptionNo : ambulanceSubscriptionNo,
				medicalConditions : medicalConditions,
				medicalAllergies : medicalAllergies,
				medication : medication,
				dietaryPreferences : dietaryPreferences,
				anaphylaxis : anaphylaxis,
				asthma : asthma,
				maternityStartDate : maternityStartDate,
				maternityEndDate : maternityEndDate,
				employee_no : employee_no,
				currently_employed : currently_employed, 
				commencement_date : commencement_date, 
				resume_supplied : resume_supplied, 
				resume_doc : resume_doc, 
				employement_type : employement_type, 
				current_contract_notes : current_contract_notes, 
				current_contract_signature : current_contract_signature, 
				current_contract_commencement : current_contract_commencement, 
				current_contract_end_date : current_contract_end_date, 
				current_contract_paid_start_date : current_contract_paid_start_date, 
				probation_end_date : probation_end_date, 
				industry_years_exp_as_nov19 : industry_years_exp_as_nov19, 
				highest_qual_held : highest_qual_held, 
				highest_qual_type : highest_qual_type, 
				qual_towards_desc : qual_towards_desc, 
				qual_towards_percent_comp : qual_towards_percent_comp, 
				workcover : workcover, 
				piawe : piawe, 
				annual_leave_in_contract : annual_leave_in_contract, 
				visa_type : visa_type, 
				visa_grant_date : visa_grant_date, 
				visa_end_date : visa_end_date, 
				visa_conditions : visa_conditions, 
				first_aid_expiry : first_aid_expiry, 
				cpr_expiry : cpr_expiry, 
				prohibition_notice_declaration : prohibition_notice_declaration, 
				vit_card_no : vit_card_no, 
				vit_expiry : vit_expiry, 
				wwcc_card_no : wwcc_card_no, 
				wwcc_expiry : wwcc_expiry, 
				food_handling_safety : food_handling_safety, 
				last_police_check : last_police_check, 
				child_protection_check : child_protection_check, 
				nominated_supervisor : nominated_supervisor 
			},
			method:'POST',
			success:function(response){

			}
		})

		})
	})
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.e-b-a-s',function(){
			$('.employee-bank-account-section').css('display','block')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','none');
			$('.employee-info').css('display','none');
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

		var superfundHTML = $('.superfund-parent').html();
		$(document).on('click','#superfund-add',function(){
		$('.superfund-parent').append(superfundHTML);
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
