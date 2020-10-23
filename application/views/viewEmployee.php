<!DOCTYPE html>
<html>
<head>
	<title>View Employee</title>
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
		input[type="text"],input[type=time],input[type=date],input[type=email],input[type=number]
			,textarea,select{
			min-width: 12rem !important;
			width: 12rem !important;
			max-width: 12rem !important;
		}
		a:hover{
			text-decoration: none !important;
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
		}
		.tab-buttons-div{
			border-radius: 4px;
			display: flex;

			justify-content: center;
			width: 100%;
		}
		.nav-button{
			position: relative;
			color: #171D4B;
			background: #A4D9D6;
			font-size:0.95rem;
			flex: 1 1 0px;
			display: flex;
			justify-content: center;
			font-weight: 700
		}
		.nav-button > span{
/*			border:1px solid #307bd3;
			background:  #307bd3;
			color: white;
			padding:5px;
			border-radius: 3px*/
			padding: 10px;
		    width: 100%;
		    display: flex;
		    justify-content: center;
		}
		.nav-button > span:hover{
			cursor: pointer;
		}
/*		input,select{
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
		} */
    input[type="text"],input[type=time],input[type=date],input[type=email],input[type=number],select,textarea{
      background: #ebebeb !important;
      border-radius: 5px !important;
      padding: 5px !important;
      border: 1px solid #D2D0D0 !important;
      border-radius: 20px !important;
      padding-left: 1rem;
      font-size: 0.85rem !important;
    }
    select{
      background: #E7E7E7 !important;
      border: none !important;
      height: 2.5rem !important;
      border-radius: 20px !important;
      border: 1px solid #D2D0D0 !important;
      padding-left: 1rem !important;
      font-size: 0.75rem !important;
    }

		.span-class{
			padding:10px;
			display: inline-block;
			width: 33%;
		}
		.span-class .col-4{
			padding-left:0;
		}
		.name__{
			width: 66%;
		}
		.contact__{
			width: 66%;
		}
		label{
			width:100%;
			margin: 0 !important;
		}
		.button,#submit{
	  	border: none;
	  	color: rgb(23, 29, 75);
	  	text-align: center;
	  	text-decoration: none;
	  	display: inline-block;
	  	font-weight: 700;
	  	margin: 2px;
	  	width:8rem;
    	border-radius: 20px;
    	padding: 8px;
    	background: rgb(164, 217, 214);
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
			justify-content: flex-end;
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
		.row.ml-1 > .span-class:nth-of-type(1){
			padding-left: 0;
		}
		.row{
			margin-left: 0 !important;
			margin-right: 0 !important
		}
		.arrow{
			border:1px solid #D2D0D0;
		    background: #F3F4F7;
		    color:  #171D4B;
		    padding:3px;
		    border-radius:;
		}
		input:disabled{
			color: black;
		}
		.top_select{
			position: absolute;
			right: 3.5rem;
			top:0.5rem;
		}
	.addEmployee-container{
		height:100vh;
		padding: 1rem 3rem 2rem 2rem;
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
	<div>
	<span style="padding-left: 2rem;">
      <a href="<?php echo base_url();?>/settings">
        <button class="btn back-button">
          <img src="<?php echo base_url('assets/images/back.svg');?>">
          <span style="font-size:0.8rem">View Employee</span>
        </button>
      </a>
    </span>
<!--     <span class="top_select">
			<span class="select_css">
				<select placehdr="Center" id="centerValue" name="centerValue" onchange="getEmployees()">
					<?php 
						$employeeData = json_decode($getEmployeeData);
						$permissions = json_decode($permissions);
						$centers = json_decode($centers);
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
			</span>
    </span> -->
	</div>
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
		<span class="nav-button m-i"><span>Medical Info</span></span>
		</div>	
	</section>
<form  style="height: 100%" id="employeeProfileId" onsubmit="return false">
	<section class="employee-section">	
		<!-- <h3>Personal</h3> -->
		<span class="d-flex">
		<span class="span-class ">
			<label>Title</label>
				<input disabled  placehdr="Title" id="title"  class="" type="text" name="title" value="<?php echo isset($employeeData->employee->title) ? $employeeData->employee->title : ''; ?>"> 

		</span>
	<span class="span-class name__">
		<label>Name</label>
		<span class="row ml-1 ">
		<span class="span-class col-4 ">
			<!-- <label>First Name</label> -->
			<input disabled  placehdr="First Name" id="fname"  class="" type="text" name="fname" value="<?php echo isset($employeeData->employee->fname) ? $employeeData->employee->fname : ''; ?>" required>
		</span>
		<span class="span-class col-4 ">
			<!-- <label>Middle Name</label> -->
			<input disabled  placehdr="Middle Name" id="mname"  class="" type="text" name="mname" value="<?php echo isset($employeeData->employee->mname) ? $employeeData->employee->mname : ''; ?>">
		</span>
		<span class="span-class col-4 ">
			<!-- <label>Last Name</label> -->
			<input disabled  placehdr="Last Name" id="lname"  class="" type="text" name="lname" value="<?php echo isset($employeeData->employee->lname) ? $employeeData->employee->lname : ''; ?>">
		</span>
	</span>
	</span>
</span>
		<?php var_dump($employeeData);?>
		<span class="span-class">
			<label>Email</label>
			<input disabled  placehdr="Emails" id="emails"  class="" type="text" name="emails" value="<?php echo isset($employeeData->employee->emails) ? $employeeData->employee->emails : ''; ?>">
		</span>
		<span class="span-class">
			<label>Alias</label>
			<input disabled  placehdr="Alias" id="alias"  class="" type="text" name="alias" value="<?php echo isset($employeeData->users->alias) ? $employeeData->users->alias : ''; ?>">
		</span>
		<span class="span-class">
			<label>Date Of Birth</label>
			<input disabled  placehdr="Date Of Birth" id="dateOfBirth"  class="" type="text" name="dateOfBirth" value="<?php echo isset($employeeData->employee->dateOfBirth) ? $employeeData->employee->dateOfBirth : ''; ?>">
		</span>
		<span class="span-class">
			<label>Gender</label>
				<input disabled  placehdr="Gender" id="gender"  class="" name="gender" value="<?php echo isset($employeeData->employee->gender) ? $employeeData->employee->gender : ''; ?>" type="text">
		</span>
		<span class="span-class" style="width:30rem;">
			<label>Profile Image</label>
			<span style="height:100px;width:100px;border-radius:0.5rem">
				<img style="border-radius:0.5rem" src="<?php echo base_url('api/').isset($employeeData->users->imageUrl) ? $employeeData->users->imageUrl : '' ?>" height="100px" width="100px">
			</span>
		</span>
<!-- 		<span class="span-class">
			<label>Job Title</label>
			<input disabled  placehdr="Job Title" id="jobTitle"  class="" type="text" name="jobTitle" value="<?php //echo isset($employeeData->users->title) ? $employeeData->users->title : ''; ?>">
		</span> -->
	
		<span class="span-class row">
		<label>Address</label>	
			<span class="span-class  col-4">
				<!-- <label>Home Address Line1</label> -->
	<input disabled  placehdr="Home Address Line1" id="homeAddLine1"  class="" type="text" name="homeAddLine1"
	value="<?php echo isset($employeeData->employee->homeAddLine1) ? $employeeData->employee->homeAddLine1 : ''; ?>">
			</span>
			<span class="span-class col-4">
				<!-- <label>Home Address Line2</label> -->
	<input disabled  placehdr="Home Address Line2" id="homeAddLine2"  class="" type="text" name="homeAddLine2"
	value="<?php echo isset($employeeData->employee->homeAddLine2) ? $employeeData->employee->homeAddLine2 : ''; ?>">
			</span>
			<span class="span-class col-4">
				<!-- <label>City</label> -->
	<input disabled   type="text" placehdr="City" id="homeAddCity"  class=""  name="homeAddCity"
	value="<?php echo isset($employeeData->employee->homeAddCity) ? $employeeData->employee->homeAddCity : ''; ?>">
			</span>				
			<span class="span-class col-4">
				<!-- <label>Region</label> -->
			<input disabled  placehdr="Region" id="homeAddRegion"  class="" type="text" name="homeAddRegion" value="<?php echo isset($employeeData->employee->homeAddRegion) ? $employeeData->employee->homeAddRegion : ''; ?>">
			</span>
			<span class="span-class col-4">
				<!-- <label>Postal</label> -->
				<input disabled  placehdr="Postal" id="homeAddPostal"  class="" type="text" name="homeAddPostal" value="<?php echo isset($employeeData->employee->homeAddPostal) ? $employeeData->employee->homeAddPostal : ''; ?>">
			</span>
			<span class="span-class col-4">
				<!-- <label>Country</label> -->
				<input disabled  placehdr="Country" id="homeAddCountry"  class="" type="text" name="homeAddCountry" value="<?php echo isset($employeeData->employee->homeAddCountry) ? $employeeData->employee->homeAddCountry : ''; ?>">
			</span>
		</span>
		<span class="span-class contact__">
			<label>Contact</label>
				<span class="span-class">
					<input disabled  placehdr="Phone" id="phone"  class="" type="text" name="phone" value="<?php echo isset($employeeData->employee->phone) ? $employeeData->employee->phone : ''; ?>">
				</span>
				<span class="span-class">
					<input disabled  placehdr="Mobile" id="mobile"  class="" type="text" name="mobile" value="<?php echo isset($employeeData->employee->mobile) ? $employeeData->employee->mobile : ''; ?>">
				</span>
		</span>
	<span class="d-block">
		<span class="span-class col-3">
			<label>Start Date</label>
		<input disabled  placehdr="Start Date" id="startDate"  class="" type="text" name="startDate" value="<?php  echo isset($employeeData->employee->startDate) ? $employeeData->employee->startDate : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Termination Date</label>
		<input disabled  placehdr="Termination Date" id="terminationDate"  class="" type="text" name="terminationDate" value="<?php echo isset($employeeData->employee->terminationDate) ? $employeeData->employee->terminationDate : ''; ?>">
		</span>
	</span>
<!-- 		<span class="span-class">
			<label>created_at</label>
			<input disabled  placehdr="created_at" id="created_at"  class="" type="text">
		</span>
		<span class="span-class">
			<label>created_by</label>
			<input disabled  placehdr="created_by" id="created_by"  class="" type="text">
		</span> -->
		<span class="span-class col-4">
			<label>Emergency Contact</label>
		<input disabled  placehdr="Emergency Contact" id="emergency_contact"  class="" type="text" name="emergency_contact" value="<?php echo isset($employeeData->employee->emergency_contact) ? $employeeData->employee->emergency_contact : ''; ?>">
		</span>
		<span class="span-class col-4">
			<label>Relationship</label>
		<input disabled  placehdr="Relationship" id="relationship"  class="" type="text" name="relationship" value="<?php echo isset($employeeData->employee->relationship) ? $employeeData->employee->relationship : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Emergency Contact Email</label>
			<input disabled  placehdr="Emergency Contact Email" id="emergency_contact_email"  class="" type="email" name="emergency_contact_email" value="<?php echo isset($employeeData->employee->emergency_contact_email) ? $employeeData->employee->emergency_contact_email : ''; ?>">
		</span>
	</section>

	<section class="employee-bank-account-section">
		<div class="parent-child">
			<div class="child">
				<div class="statement"></div>
			<div class="row">
<!-- 		<span class="span-class col-4">
			<label>Statement Text</label>
			<input disabled  placehdr="Statement Text" type="text" class="statementText" >
		</span> -->
		<span class="span-class col-4">
			<label>Account Name</label>
			<input disabled  placehdr="Account Name" type="text" class="accountName" name="accountName" value="<?php echo isset($employeeData->employeeBankAccount->accountName) ? $employeeData->employeeBankAccount->accountName : ''; ?>">
		</span>
		<span class="span-class col-4">
			<label>BSB</label>
			<input disabled  placehdr="BSB" type="text" class="bsb" name="bsb" value="<?php echo isset($employeeData->employeeBankAccount->bsb) ? $employeeData->employeeBankAccount->bsb : ''; ?>">
		</span>
	</div>
		
	<span class="row">
		<span class="span-class col-4">
			<label>Account Number</label>
			<input disabled  placehdr="Account Number" type="text" class="accountNumber" name="accountNumber" value="<?php echo isset($employeeData->employeeBankAccount->accountNumber) ? $employeeData->employeeBankAccount->accountNumber : ''; ?>">
		</span>

		<span class="span-class col-4">
			<label>Remainder</label>
				<span>
					<label class="yn-label">Yes</label>
					<input disabled  value="Y" class="remainderYN yn-input" type="radio" name="remainderYN" <?php echo isset($employeeData->employeeBankAccount->remainderYN) ? ($employeeData->employeeBankAccount->remainderYN == 'Y' ? 'checked' : '') : ''; ?>>
				</span>
				<span>
					<label class="yn-label">No</label>
					<input disabled  value="N" class="remainderYN yn-input" type="radio" name="remainderYN" <?php echo isset($employeeData->employeeBankAccount->remainderYN) ? (($employeeData->employeeBankAccount->remainderYN == 'N') ? 'checked' : '') : ''; ?>>
				</span>
		</span>
		<span class="span-class amount-class-parent col-4">
			<div class="amount-class">
				<label>Amount</label>
				<input disabled  placehdr="Amount" type="text" class="amount" name="amount" value="<?php echo isset($employeeData->employeeBankAccount->amount) ? $employeeData->employeeBankAccount->amount : ''; ?>">
			</div>
		</span>
	</span>
			</div>
		</div>
	</section>



	<section class="employee-superfund-section">
<!-- 		<span class="span-class">
			<label>Employee Id</label>
			<input disabled  placehdr="Employee Id" id="employeeId" >
		</span> -->
			<div class="superfund-parent">
				<div class="superfund-child row">
					<span class="span-class col-4">
						<label>Super Fund Id</label>
							<input disabled  placehdr="Super Fund Id" type="text" class="superFundId" name="superFundId" value="<?php echo isset($employeeData->employeeSuperfunds->superFundId) ? $employeeData->employeeSuperfunds->superFundId : ''; ?>">
					</span>
					<span class="span-class col-4">
						<label>Super Membership Id</label>
						<input disabled  placehdr="Super Membership Id" class="superMembershipId" type="text" name="superMembershipId" value="<?php echo isset($employeeData->employeesuperfund->superMembershipId) ? $employeeData->employeesuperfund->superMembershipId : ''; ?>">
					</span>
				</div>
			</div>

	</section>





	<section class="employee-tax-declaration-section">
		<!-- <h3>Employee Tax Declaration Section</h3> -->


		<span class="span-class col-4 pl-4">
			<label>TFN Exemption Type</label>
				<input disabled  placehdr="tfnExemptionType" id="tfnExemptionType" name="tfnExemptionType" select="<?php echo isset($employeeData->employeeTaxDeclaration->tfnExemptionType) ? $employeeData->employeeTaxDeclaration->tfnExemptionType : ''; ?>" type="text">
		</span> 
		<div class="tax-declaration-class col-lg-12">
		<span class="span-class col-4">
			<label>Tax File Number</label>
			<input disabled  placehdr="Tax File Number" id="taxFileNumber" name="taxFileNumber" type="text" value="<?php echo isset($employeeData->employeeTaxDeclaration->taxFileNumber) ? $employeeData->employeeTaxDeclaration->taxFileNumber : ''; ?>">
		</span>
		<span class="span-class col-4">
			<label>Australian Resident For TaxPurpose</label>
			<label class="yn-label">Yes</label>
				<input disabled  placehdr="Australian Resident For TaxPurpose" type="radio"  name="australiantResidentForTaxPurposeYN" class="australiantResidentForTaxPurposeYN yn-input" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->australiantResidentForTaxPurposeYN) ? (($employeeData->employeeTaxDeclaration->australiantResidentForTaxPurposeYN == 'Y') ? 'checked' : '') : ''; ?>>
			<label class="yn-label">No</label>
				<input disabled  type="radio" name="australiantResidentForTaxPurposeYN" class="australiantResidentForTaxPurposeYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->australiantResidentForTaxPurposeYN) ? (($employeeData->employeeTaxDeclaration->australiantResidentForTaxPurposeYN == 'N') ? 'checked' : '') : ''; ?>>
		</span>
		<span class="span-class col-3">
			<label>Residency Statue</label>
				<input disabled   placehdr="residencyStatue" id="residencyStatue" name="residencyStatue" value="<?php echo isset($employeeData->employeeTaxDeclaration->residencyStatue) ? $employeeData->employeeTaxDeclaration->residencyStatue : ''; ?>" type="text">
		</span>
		<span class="span-class col-4">
			<label>Tax Free Threshold Claimed</label>
			<label class="yn-label">Yes</label>
				<input disabled  placehdr="taxFreeThresholdClaimedYN" type="radio" name="taxFreeThresholdClaimedYN" class="taxFreeThresholdClaimedYN yn-input" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->taxFreeThresholdClaimedYN) ? (($employeeData->employeeTaxDeclaration->taxFreeThresholdClaimedYN == 'Y') ? 'checked' : '') : ''; ?>>
			<label class="yn-label">No</label>
				<input disabled  type="radio" name="taxFreeThresholdClaimedYN" class="taxFreeThresholdClaimedYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->taxFreeThresholdClaimedYN) ? (($employeeData->employeeTaxDeclaration->taxFreeThresholdClaimedYN == 'N') ? 'checked' : '') : ''; ?>>
		</span>
		<span class="span-class col-4">
			<label>Tax Offset Estimated Amount</label>
			<input disabled  placehdr="Tax Offset Estimated Amount" id="taxOffsetEstimatedAmount" type="text" name="taxOffsetEstimatedAmount" value="<?php echo isset($employeeData->employeeTaxDeclaration->taxOffsetEstimatedAmount) ? $employeeData->employeeTaxDeclaration->taxOffsetEstimatedAmount : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Has HELP Debt</label>
			<label class="yn-label">Yes</label>
			<input disabled  placehdr="hasHELPDebtYN" name="hasHELPDebtYN" class="hasHELPDebtYN yn-input" value="Y" type="radio" <?php echo isset($employeeData->employeeTaxDeclaration->hasHELPDebtYN) ? (($employeeData->employeeTaxDeclaration->hasHELPDebtYN == 'Y') ? 'checked' : '') : ''; ?>>
			<label class="yn-label">No</label>
			<input disabled  type="radio" name="hasHELPDebtYN" class="hasHELPDebtYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->hasHELPDebtYN) ? (($employeeData->employeeTaxDeclaration->hasHELPDebtYN == 'N') ? 'checked' : '') : ''; ?>>	
		</span>
		<span class="span-class col-4">
			<label>Has SFSS Debt</label>
			<label class="yn-label">Yes</label>
			<input disabled  placehdr="hasSFSSDebtYN" type="radio" name="hasSFSSDebtYN" class="hasSFSSDebtYN yn-input" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->hasSFSSDebtYN) ? (($employeeData->employeeTaxDeclaration->hasSFSSDebtYN == 'Y') ? 'checked' : '') : ''; ?>>
			<label class="yn-label">No</label>
			<input disabled  type="radio" name="hasSFSSDebtYN" class="hasSFSSDebtYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->hasSFSSDebtYN) ? (($employeeData->employeeTaxDeclaration->hasSFSSDebtYN == 'N') ? 'checked' : '') : ''; ?>>
		</span>
		<span class="span-class col-4">
			<label>Has Trade Support Loan Debt</label>
			<label class="yn-label">Yes</label>
			<input disabled  placehdr="hasTradeSupportLoanDebtYN" type="radio" name="hasTradeSupportLoanDebtYN " class="hasTradeSupportLoanDebtYN yn-input" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->hasTradeSupportLoanDebtYN) ? (($employeeData->employeeTaxDeclaration->hasTradeSupportLoanDebtYN == 'Y') ? 'checked' : '') : ''; ?>>
			<label class="yn-label">No</label>
			<input disabled  type="radio" name="hasTradeSupportLoanDebtYN " class="hasTradeSupportLoanDebtYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->hasTradeSupportLoanDebtYN) ? (($employeeData->employeeTaxDeclaration->hasTradeSupportLoanDebtYN == 'N') ? 'checked' : '') : ''; ?>>
		</span>
		<span class="span-class col-3">
			<label>Upward Variation Tax Witholding Amount</label>
			<input disabled  placehdr="Upward Variation Tax Witholding Amount" id="upwardVariationTaxWitholdingAmount" name="upwardVariationTaxWitholdingAmount" type="text" value="<?php echo isset($employeeData->employeeTaxDeclaration->upwardVariationTaxWitholdingAmount) ? $employeeData->employeeTaxDeclaration->upwardVariationTaxWitholdingAmount : ''; ?>">
		</span>
		<span class="span-class col-4">
			<label>Eligible To Receive Leave Loading</label>
			<label class="yn-label">Yes</label>
			<input disabled  placehdr="eligibleToReceiveLeaveLoadingYN" type="radio" class="eligibleToReceiveLeaveLoadingYN yn-input" name="eligibleToReceiveLeaveLoadingYN" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->eligibleToReceiveLeaveLoadingYN) ? (($employeeData->employeeTaxDeclaration->eligibleToReceiveLeaveLoadingYN == 'Y') ? 'checked' : '') : ''; ?>>
			<label class="yn-label">No</label>
			<input disabled  type="radio" name="eligibleToReceiveLeaveLoadingYN" class="eligibleToReceiveLeaveLoadingYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->eligibleToReceiveLeaveLoadingYN) ? (($employeeData->employeeTaxDeclaration->eligibleToReceiveLeaveLoadingYN == 'N') ? 'checked' : '') : ''; ?>>
		</span>
		<span class="span-class col-4">
			<label>Approved Witholding Variation Percentage</label>
			<input disabled  placehdr="Approved Witholding Variation Percentage" id="approvedWitholdingVariationPercentage" name="approvedWitholdingVariationPercentage" type="text" value="<?php echo isset($employeeData->employeeTaxDeclaration->approvedWitholdingVariationPercentage) ? $employeeData->employeeTaxDeclaration->approvedWitholdingVariationPercentage : ''; ?>">
		</span>
		
	</div>
	</section>


	<section class="employee-details">
		<span class="span-class" style="display:none">
			<label>Employee Number</label>
			<input disabled  placehdr="Employee Number" id="employee_no" type="text" name="employee_no" value="<?php echo isset($employeeData->employee->userid) ? $employeeData->employee->userid : ''; ?>">
		</span>
		<span class="span-class" style="display:none">
			<label>Xero Employee Id</label>
			<input disabled  placehdr="Xero Employee Id" id="xeroEmployeeId" type="text" name="xeroEmployeeId" value="<?php echo isset($employeeData->employee->xeroEmployeeId) ? $employeeData->employee->xeroEmployeeId : ''; ?>">
		</span>

<!-- 		<span class="span-class">
			<label>	Currently-employed</label>
			<label class="yn-label">Yes</label>
			<input disabled   type="radio" name="currently_employed " class="currently_employed yn-input" value="Y">
			<label class="yn-label">No</label>
			<input disabled  type="radio" name="currently_employed " class="currently_employed yn-input" value="N">
		</span>
		<span class="span-class">
			<label>	Commencement-date</label>
			<input disabled  placehdr="Commencement-date" id="commencement_date" type="text">
		</span> -->
<!-- 
		<span class="span-class">
			<label>Contract-position	</label>
			<input disabled  placehdr="Contract-position	" id=" " type="text">
		</span> -->
<!-- 		<span class="span-class">
			<label>Resume-supplied</label>
			<label class="yn-label">Yes</label>
			<input disabled   type="radio" name="resume_supplied" class="resume_supplied yn-input" value="Y">
			<label class="yn-label">No</label>
			<input disabled  type="radio" name="resume_supplied" class="resume_supplied yn-input" value="N">
		</span>
 -->
		<span class="span-class">
			<label>Resume Document </label>
			<a href="" id="resume_doc" name="resume_doc"  download>
				<button class="button">
			<i>
				<img src="<?php echo base_url('assets/images/icons/download.png'); ?>" style="max-height:1rem;margin-right:10px">
			</i>Download</button>
			</a>
		</span>
		<span class="span-class">
			<label>Contract Document </label>
			<a href="" id="contract_doc" name="contract_doc"  download>
				<button class="button">
			<i>
				<img src="<?php echo base_url('assets/images/icons/download.png'); ?>" style="max-height:1rem;margin-right:10px">
			</i>Download</button>
			</a>
		</span>

<!-- 		<span class="span-class">
			<label>Employment-type</label>
			<span class="select_css">
				<select id="employement_type" name="employement_type" value="<?php echo isset($employeeData->employeeRecord->employmentType) ? $employeeData->employeeRecord->employmentType : ''; ?>">
					<option value="FT">Full Time</option>
					<option value="PT">Part Time</option>
					<option value="Casual">Casual</option>
				</select>
			</span>
		</span>
 --><!-- 		<span class="span-class">
			<label>Current-contract-notes</label>
			<input disabled  placehdr="Current-contract-notes" id="current_contract_notes" type="text">
		</span>
		<span class="span-class">
			<label>Current-contract-signature-date 	</label>
			<input disabled  placehdr="Current-contract-signature-date" id="current_contract_signature_date" type="text">
		</span>
		<span class="span-class">
			<label>Current-contract-commencement-date </label>
			<input disabled  placehdr="Current-contract-commencement-date" id="current_contract_commencement_date" type="text">
		</span>
		<span class="span-class">
			<label>Current-contract-end-date	</label>
			<input disabled  placehdr="Current-contract-end-date" id="current_contract_end_date" type="text">
		</span>
		<span class="span-class">
			<label>Current-contract-paid-start-date </label>
			<input disabled  placehdr="Current-contract-paid-start-date" id="current_contract_paid_start_date" type="text">
		</span>
		<span class="span-class">
			<label>Probation-end-date 	</label>
			<input disabled  placehdr="Probation end date" id="probation_end_date" type="text">
		</span> -->
<!-- 		<span class="span-class">
			<label>Industry-years-exp-as-nov19	</label>
			<input disabled  placehdr="Industry-years-exp-as-nov19	" id="industry_years_exp_as_nov19" type="text">
		</span> -->

		<span class="span-class">
			<label>Highest-qual-held</label>
		<input disabled  placehdr="Highest-qual-held" id="highest_qual_held" name="highest_qual_held" type="text"  value="<?php echo isset($employeeData->employeeRecord->highestQualHeld) ? $employeeData->employeeRecord->highestQualHeld : ''; ?>">
		</span>
		<span class="span-class">
			<label>Date Obtained</label>
		<input disabled  placehdr="Date Obtained" id="highest_qual_date_obtained" name="highest_qual_date_obtained" type="text"  value="<?php echo isset($employeeData->employeeRecord->highestQualDateObtained) ? $employeeData->employeeRecord->highestQualDateObtained : ''; ?>">
		</span>
		<span class="span-class">
			<label>Highest Qualification Certificate</label>
		<input disabled  placehdr="Date Obtained" id="highest_qual_cert" name="highest_qual_cert" type="text" value=" ">
		</span>
<!-- 		<span class="span-class">
			<label>Highest-qual-type	 </label>
			<input disabled  placehdr="Highest-qual-type" id="highest_qual_type" type="text">
		</span>
 -->		<span class="span-class">
			<label>Qualification working Toward</label>
		<input disabled  placehdr="Qual-towards-desc" id="qual_towards_desc" name="qual_towards_desc" type="text" value="<?php echo isset($employeeData->employeeRecord->qualWorkingTowards) ? $employeeData->employeeRecord->qualWorkingTowards : ''; ?>">
		</span>
		<span class="span-class">
			<label>Qual-towards-%-comp</label>
		<input disabled  placehdr="Qual towards % comp" id="qual_towards_percent_comp" name="qual_towards_percent_comp" type="text" value="<?php echo isset($employeeData->employeeRecord->qualTowardsPercentcomp) ? $employeeData->employeeRecord->qualTowardsPercentcomp : ''; ?>">
		</span>

<!-- 		<span class="span-class">
			<label>	Workcover</label>
			<input disabled  placehdr="Workcover" id="workcover" type="text">
		</span>
		<span class="span-class">
			<label>	PIAWE</label>
			<input disabled  placehdr="PIAWE" id="piawe" type="text">
		</span>
		<span class="span-class">
			<label>	Annual-leave-in-contract</label>
			<input disabled  placehdr="Annual-leave-in-contract" id="annual_leave_in_contract" type="text">
		</span> -->
		<span class="span-class">
			<label>Classification</label>
			<input disabled  placehdr="Classification" id="classification" name="classification" type="text" value="<?php echo isset($employeeData->employee->classification) ? $employeeData->employee->classification : ''; ?>">
		</span>
		<span class="span-class">
			<label>Ordinary Earning Rate Id</label>
				<input disabled  placehdr="Ordinary Earning Rate Id" id="ordinaryEarningRateId" name="ordinaryEarningRateId"  class="" type="text" value="<?php echo isset($employeeData->employee->ordinaryEarningRateId) ? $employeeData->employee->ordinaryEarningRateId : ''; ?>">
		</span>

		<span class="span-class">
			<label>Payroll Calendar</label>
			<input disabled  placehdr="Payroll Calendar" id="payroll_calendar" name="payroll_calendar" type="text" value="<?php echo isset($employeeData->employee->payrollCalendarId) ? $employeeData->employee->payrollCalendarId : ''; ?>">
		</span>
		<span class="span-class">
			<label>Employee Group</label>
			<input disabled  placehdr="Employee Group" id="employee_group" name="employee_group" type="text" value="<?php echo isset($employeeData->employee->employee_group) ? $employeeData->employee->employee_group : ''; ?>">
		</span>
		<span class="span-class">
			<label>Holiday Group</label>
			<input disabled  placehdr="Holiday Group" id="holiday_group" name="holiday_group" type="text" value="<?php echo isset($employeeData->employee->holiday_group) ? $employeeData->employee->holiday_group : ''; ?>">
		</span>
		<span class="span-class">
			<label>Visa Holder</label>
			<label class="yn-label">Yes</label>
			<input disabled   type="radio" name="visa_holder" class="visa_holder yn-input" value="Y" <?php echo isset($employeeData->employeeRecord->visaHolderYN) ? (($employeeData->employeeRecord->visaHolderYN == 'Y') ? 'checked' : '') : ''; ?>>
			<label class="yn-label">No</label>
			<input disabled  type="radio" name="visa_holder" class="visa_holder yn-input" value="N" <?php echo isset($employeeData->employeeRecord->visaHolderYN) ? (($employeeData->employeeRecord->visaHolderYN == 'N') ? 'checked' : '') : ''; ?>>
		</span>
		<span class="span-class">
			<label>	Visa-type		</label>
			<input disabled  placehdr="Visa-type" id="visa_type" name="visa_type" type="text" value="<?php echo isset($employeeData->employeeRecord->visaType) ? $employeeData->employeeRecord->visaType : ''; ?>">
		</span>
		<span class="span-class">
			<label>	Visa-grant-date	</label>
			<input disabled  placehdr="Visa-grant-date" id="visa_grant_date" name="visa_grant_date" type="text" value="<?php echo isset($employeeData->employeeRecord->visaGrantDate) ? $employeeData->employeeRecord->visaGrantDate : ''; ?>">
		</span>
		<span class="span-class">
			<label>	Visa-end-date	</label>
			<input disabled  placehdr="Visa-end-date" id="visa_end_date" name="visa_end_date" type="text" value="<?php echo isset($employeeData->employeeRecord->visaEndDate) ? $employeeData->employeeRecord->visaEndDate : ''; ?>">
		</span>
		<span class="span-class">
			<label>	Visa-conditions</label>
			<input disabled  placehdr="Visa-conditions" id="visa_conditions" name="visa_conditions" type="text" value="<?php echo isset($employeeData->employee->visaConditions) ? $employeeData->employee->visaConditions : ''; ?>">
		</span>
<?php $toCount = isset($employeeData->employeeCourses) ? $employeeData->employeeCourses : ''; ?>
<?php for($i=0;$i<count($toCount);$i++){ ?>
		<div>
				<input disabled  type="text" name="course_id[]" style="display:none" value="<?php echo isset($employeeData->employeeCourses[$i]->id) ? $employeeData->employeeCourses[$i]->id : ''; ?>">
				<span class="span-class">
					<label>Course Name</label>
					<input disabled  placehdr="Course Name" class="course_name" name="course_name[]" type="text" value="<?php echo isset($employeeData->employeeCourses[$i]->courseName) ? $employeeData->employeeCourses[$i]->courseName : ''; ?>">
				</span>
				<span class="span-class">
					<label>course Description</label>
					<input disabled  placehdr="course Description" class="course_description" name="course_description[]" type="text" value="<?php echo isset($employeeData->employeeCourses[$i]->courseDescription) ? $employeeData->employeeCourses[$i]->courseDescription : ''; ?>">
				</span>
				<span class="span-class">
					<label>Date Obtained</label>
					<input disabled  placehdr="Date Obtained" class="date_obtained" name="date_obtained[]" type="text" value="<?php echo isset($employeeData->employeeCourses[$i]->dateObtained) ? $employeeData->employeeCourses[$i]->dateObtained : ''; ?>">
				</span>
				<span class="span-class">
					<label>Expiry Date</label>
					<input disabled  placehdr="Expiry Date" class="expiry_date" name="expiry_date[]" type="text" value="<?php echo isset($employeeData->employeeCourses[$i]->courseExpiryDate) ? $employeeData->employeeCourses[$i]->courseExpiryDate : ''; ?>">
				</span>
				<span class="span-class">
					<label>Certificate </label>
					<input disabled  placehdr="Certificate" class="certificate" name="certificate[]" type="FILE">
				</span>
		</div>
	<?php } ?>
<!-- 		<span class="span-class">
			<label>CPR-expiry</label>
			<input disabled  placehdr="CPR-expiry" id="cpr_expiry" type="text">
		</span>
		<span class="span-class">
			<label>Prohibition-Notice-Declaration</label>
			<input disabled  placehdr="Prohibition-Notice-Declaration" id="prohibition_notice_declaration" type="text">
		</span>
		<span class="span-class">
			<label>VIT-card-no</label>
			<input disabled  placehdr="VIT-card-no" id="vit_card_no" type="text">
		</span>
		<span class="span-class">
			<label>VIT-expiry</label>
			<input disabled  placehdr="VIT-expiry" id="vit_expiry" type="text">
		</span>
		<span class="span-class">
			<label>WWCC-card-no	</label>
			<input disabled  placehdr="WWCC-card-no" id="wwcc_card_no" type="text">
		</span>
		<span class="span-class">
			<label>WWCC-expiry</label>
			<input disabled  placehdr="WWCC-expiry" id="wwcc_expiry" type="text">
		</span>
		<span class="span-class">
			<label>Food-handling-safety</label>
			<input disabled  placehdr="Food-handling-safety" id="food_handling_safety" type="text">
		</span>
		<span class="span-class">
			<label>Last-police-check</label>
			<input disabled  placehdr="Last-police-check" id="last_police_check" type="text">
		</span>
		<span class="span-class">
			<label>Child-protection-check</label>
			<input disabled  placehdr="Child-protection-check" id="child_protection_check" type="text">
		</span>
		<span class="span-class">
			<label>Nominated-supervisor</label>
			<label class="yn-label">Yes</label>
				<input disabled   type="radio"  name="nominated_supervisor" class="nominated_supervisor yn-input" value="Y">
			<label class="yn-label">No</label>
				<input disabled  type="radio" name="nominated_supervisor" class="nominated_supervisor yn-input" value="N">
		</span> -->
	</section>

	<section class="medical-info">
		<h3>Medical Information<!-- <span id="Medical Information"> + </span> --></h3>
<!-- 		<span class="span-class">
			<label>Employee Id</label>
			<input disabled  placehdr="Employee Id" id="employeeId" >
		</span> -->
		<span class="span-class">
			<label>Medicare Number</label>
				<input disabled   type="text"  name="medicareNo" class="medicareNo" value="<?php echo isset($employeeData->employeeMedicalInfo->medicareNo) ? $employeeData->employeeMedicalInfo->medicareNo : ''; ?>">
		</span>
		<span class="span-class">
			<label>Medicare Reference Number</label>
				<input disabled   type="text"  name="medicareRefNo" class="medicareRefNo" value="<?php echo isset($employeeData->employeeMedicalInfo->medicareRefNo) ? $employeeData->employeeMedicalInfo->medicareRefNo : ''; ?>">
		</span>
		<span class="span-class">
			<label>Health Insurance Fund</label>
				<input disabled   type="text"  name="healthInsuranceFund" class="healthInsuranceFund" value="<?php echo isset($employeeData->employeeMedicalInfo->healthInsuranceFund) ? $employeeData->employeeMedicalInfo->healthInsuranceFund : ''; ?>">
		</span>
		<span class="span-class">
			<label>Health Insurance Number</label>
				<input disabled   type="text"  name="healthInsuranceNo" class="healthInsuranceNo" value="<?php echo isset($employeeData->employeeMedicalInfo->healthInsuranceNo) ? $employeeData->employeeMedicalInfo->healthInsuranceNo : ''; ?>">
		</span>
		<span class="span-class">
			<label>Ambulance Subscription Number</label>
				<input disabled   type="text"  name="ambulanceSubscriptionNo" class="ambulanceSubscriptionNo"  value="<?php echo isset($employeeData->employeeMedicalInfo->ambulanceSubscriptionNo) ? $employeeData->employeeMedicalInfo->ambulanceSubscriptionNo : ''; ?>">
		</span>
<?php $toSize = isset($employeeData->employeeMedicals) ? $employeeData->employeeMedicals : ''; ?>
		<?php for($i=0;$i<count($toSize);$i++){ ?>
			<input disabled  type="text" name="medicals_id[]" style="display:none" value="<?php echo isset($employeeData->employeeMedicals[$i]->id) ? $employeeData->employeeMedicals[$i]->id : ''; ?>">
		<span class="span-class">
			<label>Medical Conditions</label>
				<input disabled   type="text"  name="medicalConditions[]" class="medicalConditions" value="<?php echo isset($employeeData->employeeMedicals[$i]->medicalConditions) ? $employeeData->employeeMedicals[$i]->medicalConditions : ''; ?>">
		</span>
		<span class="span-class">
			<label>Medical Allergies</label>
				<input disabled   type="text"  name="medicalAllergies[]" class="medicalAllergies" value="<?php echo isset($employeeData->employeeMedicals[$i]->medicalAllergies) ? $employeeData->employeeMedicals[$i]->medicalAllergies : ''; ?>">
		</span>
		<span class="span-class">
			<label>Medication</label>
				<input disabled   type="text"  name="medication[]" class="medication" value="<?php echo isset($employeeData->employeeMedicals[$i]->medication) ? $employeeData->employeeMedicals[$i]->medication : ''; ?>">
		</span>
		<span class="span-class">
			<label>Dietary Preferences</label>
				<input disabled   type="text"  name="dietaryPreferences[]" class="dietaryPreferences" value="<?php echo isset($employeeData->employeeMedicals[$i]->dietaryPreferences) ? $employeeData->employeeMedicals[$i]->dietaryPreferences : ''; ?>">
		</span>
	<?php } ?>
<!-- 		<span class="span-class">
			<label>Anaphylaxis</label>
				<input disabled   type="text"  name="anaphylaxis" class="anaphylaxis">
		</span>
		<span class="span-class">
			<label>Asthma</label>
				<input disabled   type="text"  name="asthma" class="asthma">
		</span>
		<span class="span-class">
			<label>Maternity Start Date</label>
				<input disabled   type="text"  name="maternityStartDate" class="maternityStartDate">
		</span>
		<span class="span-class">
			<label>Maternity End Date</label>
				<input disabled   type="text"  name="maternityEndDate" class="maternityEndDate">
		</span> -->
	</section>
</form>
<?php // } ?>
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
