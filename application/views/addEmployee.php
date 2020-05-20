<!DOCTYPE html>
<html>
<head>
	<title>Add Employee</title>
	<style type="text/css">
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
		.tab-buttons{
			margin-bottom:10px;
			padding: 5px;
			align-content: flex-start
		}
		.nav-button{
			padding: 5px;
		}
		.nav-button > button{
			border:1px solid #307bd3;
			background:  #307bd3;
			color: white;
			padding:5px;
			border-radius: 3px
		}
		.nav-button > button:hover{
			border-radius: 3px;
			padding:5px;
			border:none;
			background:  white;
			color: #307bd3;
			border:1px solid #307bd3;
		}
		input,select{
			display: block;
		    width: 300px;
		    height: calc(1.5em + .75rem + 2px);
		    padding: .375rem .75rem;
		    font-size: 1rem;
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
		}
	</style>
</head>
<body>
<?php $this->load->view('header'); ?>
<div class="containers">
	<section class="tab-buttons">
		<span class="nav-button e-s"><button>Employee Section</button></span>
		<span class="nav-button e-b-a-s"><button>Employee Bank Account Section</button></span>
		<span class="nav-button e-s-s"><button>Employee Superfund Section</button></span>
		<span class="nav-button e-t-d-s"><button>Employee Tax Declaration Section</button></span>
		<span class="nav-button e-u-s"><button>Employee Details</button></span>		
	</section>
	<section class="employee-section">	
		<h3>Employee Section</h3>
		<span class="span-class">
			<label>xero Employee Id</label>
			<input placeholder="xero Employee Id" id="xeroEmployeeId"  class="" type="text">
		</span>
		<span class="span-class">
			<label>User Id</label>
			<input placeholder="User Id" id="userid"  class="" type="text">
		</span>
		<span class="span-class">
			<label>Title</label>
			<select placeholder="Title" id="title"  class="" type="text"> 
				<option value="Ms">Ms</option> 
				<option value="Mr">Mr</option>
				<option value="Mrs">Mrs</option>
			</select>
		</span>
		<span class="span-class">
			<label>First Name</label>
			<input placeholder="First Name" id="fname"  class="" type="text">
		</span>
		<span class="span-class">
			<label>Middle Name</label>
			<input placeholder="Middle Name" id="mname"  class="" type="text">
		</span>
		<span class="span-class">
			<label>Last Name</label>
			<input placeholder="Last Name" id="lname"  class="" type="text">
		</span>

		<span class="span-class">
			<label>Status</label>
		<!-- ACTIVE, TERMINATED -->
			<input placeholder="Status" id="status"  class="" type="text">
		</span>	

		<span class="span-class">
			<label>Emails</label>
			<input placeholder="Emails" id="emails"  class="" type="text">
		</span>
		<span class="span-class">
			<label>Date Of Birth</label>
			<input placeholder="Date Of Birth" id="dateOfBirth"  class="" type="date">
		</span>
		<span class="span-class">
			<label>Job Title</label>
			<input placeholder="Job Title" id="jobTitle"  class="" type="text">
		</span>
		<span class="span-class">
			<label>Gender</label>
			<select placeholder="Gender" id="gender"  class="" >
				<option value="N">N</option>
				<option value="M">Male</option>
				<option value="F">Female</option>
				<option value="I">I</option>
			</select>
		</span>		
		<span class="span-class">
			<label>Home Address Line1</label>
			<input placeholder="Home Address Line1" id="homeAddLine1"  class="" type="text">
		</span>
		<span class="span-class">
			<label>Home Address Line2</label>
			<input placeholder="Home Address Line2" id="homeAddLine2"  class="" type="text">
		</span>
		<span class="span-class">
			<label>City</label>
			<select placeholder="homeAddCity" id="homeAddCity"  class="" >
				<option value="ACT">ACT</option>
				<option value="NSW">NSW</option>
				<option value="NT">NT</option>
				<option value="QLD">QLD</option>
				<option value="SA">SA</option>
				<option value="TAS">TAS</option>
				<option value="VIC">VIC</option>
				<option value="WA">WA</option>
			</select>
		</span>				
		<span class="span-class">
			<label>Region</label>
			<input placeholder="Region" id="homeAddRegion"  class="" type="text">
		</span>
		<span class="span-class">
			<label>Postal</label>
			<input placeholder="Postal" id="homeAddPostal"  class="" type="text">
		</span>
		<span class="span-class">
			<label>Country</label>
			<input placeholder="Country" id="homeAddCountry"  class="" type="text">
		</span>
		<span class="span-class">
			<label>Phone</label>
			<input placeholder="Phone" id="phone"  class="" type="text">
		</span>
		<span class="span-class">
			<label>Mobile</label>
			<input placeholder="Mobile" id="mobile"  class="" type="text">
		</span>
		<span class="span-class">
			<label>Start Date</label>
			<input placeholder="Start Date" id="startDate"  class="" type="text">
		</span>
		<span class="span-class">
			<label>Termination Date</label>
			<input placeholder="Termination Date" id="terminationDate"  class="" type="text">
		</span>
		<span class="span-class">
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
		<span class="span-class">
			<label>Payroll Calendar Id</label>
			<input placeholder="Payroll Calendar Id" id="payrollCalendarId"  class="" type="text">
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
		<span class="span-class">
			<label>Statement Text</label>
			<input placeholder="Statement Text"  class="statementText" >
		</span>
		<span class="span-class">
			<label>Account Name</label>
			<input placeholder="Account Name"  class="accountName" >
		</span>
		<span class="span-class">
			<label>BSB</label>
			<input placeholder="BSB"  class="bsb" >
		</span>
		<span class="span-class">
			<label>Account Number</label>
			<input placeholder="Account Number"  class="accountNumber" >
		</span>
		<span class="span-class">
			<label>Remainder</label>
			<select placeholder="Remainder"  class="remainderYN" >
				<option value="Y">Y</option>
				<option value="N">N</option>
			</select>
		</span>
		<span class="span-class">
			<label>Amount</label>
			<input placeholder="Amount"  class="amount" >
		</span>
			</div>
		</div>
	</section>



	<section class="employee-superfund-section">
		<h3>Employee Superfund Section</h3>
		<span class="span-class">
			<label>Employee Id</label>
			<input placeholder="Employee Id" id="employeeId" >
		</span>
		<span class="span-class">
			<label>Super Fund Id</label>
			<input placeholder="Super Fund Id" id="superFundId" >
		</span>
		<span class="span-class">
			<label>Employee Number</label>
			<input placeholder="Employee Number" id="employeeNumber" >
		</span>
		<span class="span-class">
			<label>Super Membership Id</label>
			<input placeholder="Super Membership Id" id="superMembershipId" >
		</span>
	</section>





	<section class="employee-tax-declaration-section">
		<h3>Employee Tax Declaration Section</h3>
		<span class="span-class">
			<label>Employee Id</label>
			<input placeholder="Employee Id" id="employeeId">
		</span>
		<span class="span-class">
			<label>Employment Basis</label>
			<select placeholder="employmentBasis" id="employmentBasis">
				<option value="FULLTIME">FULLTIME </option>
				<option value="PARTTIME">PARTTIME</option>
				<option value="CASUAL">CASUAL</option>
				<option value="LABOURHIRE">LABOURHIRE</option>
				<option value="SUPERINCOMEST">SUPERINCOMEST</option>
			</select>
		</span> 
		<span class="span-class">
			<label>TFN Exemption Type</label>
			<select placeholder="tfnExemptionType" id="tfnExemptionType">
				<option value="NOTQUOTED">NOTQUOTED</option>
				<option value="PENDING">PENDING</option>
				<option value="PENSIONER">PENSIONER</option>
				<option value="UNDER18">UNDER18</option>
			</select>
		</span> 
		<span class="span-class">
			<label>Tax File Number</label>
			<input placeholder="Tax File Number" id="taxFileNumber">
		</span>
		<span class="span-class">
			<label>Australian Resident For TaxPurpose</label>
			<input placeholder="Australian Resident For TaxPurpose" id="australiantResidentForTaxPurposeYN">
		</span>
		<span class="span-class">
			<label>Residency Statue</label>
			<select placeholder="residencyStatue" id="residencyStatue">
				<option value="AUSTRALIANRESIDENT">AUSTRALIANRESIDENT</option>
				<option value="FOREIGNRESIDENT">FOREIGNRESIDENT</option>
				<option value="WORKINGHOLIDAY">WORKINGHOLIDAY</option>
			</select>
		</span> 
		<span class="span-class">
			<label>Tax Free Threshold Claimed</label>
			<select placeholder="taxFreeThresholdClaimedYN" id="taxFreeThresholdClaimedYN">
				<option class="Y">Y</option>
				<option class="N">N</option>
			</select>
		</span>
		<span class="span-class">
			<label>Tax Offset Estimated Amount</label>
			<input placeholder="Tax Offset Estimated Amount" id="taxOffsetEstimatedAmount">
		</span>
		<span class="span-class">
			<label>Has HELP Debt</label>
			<select placeholder="hasHELPDebtYN" id="hasHELPDebtYN">
				<option value="Y">Y</option>
				<option value="N">N</option>
			</select>
		</span>
		<span class="span-class">
			<label>Has SFSS Debt</label>
			<select placeholder="hasSFSSDebtYN" id="hasSFSSDebtYN">
				<option value="Y">Y</option>
				<option value="N">N</option>
			</select>
		</span>
		<span class="span-class">
			<label>Has Trade Support Loan Debt</label>
			<select placeholder="hasTradeSupportLoanDebtYN" id="hasTradeSupportLoanDebtYN">
				<option value="Y">Y</option>
				<option value="N">N</option>
			</select>
		</span>
		<span class="span-class">
			<label>Upward Variation Tax Witholding Amount</label>
			<input placeholder="Upward Variation Tax Witholding Amount" id="upwardVariationTaxWitholdingAmount">
		</span>
		<span class="span-class">
			<label>Eligible To Receive Leave Loading</label>
			<select placeholder="eligibleToReceiveLeaveLoadingYN" id="eligibleToReceiveLeaveLoadingYN">
				<option value="Y">Y</option>
				<option value="N">N</option>
			</select>
		</span>
		<span class="span-class">
			<label>Approved Witholding Variation Percentage</label>
			<input placeholder="Approved Witholding Variation Percentage" id="approvedWitholdingVariationPercentage">
		</span>
	</section>
	<section class="employee-details">
		<span class="span-class">
			<label>Center</label>
			<input placeholder="Center" id="center">
		</span>
		<span class="span-class">
			<label>Manager</label>
			<input placeholder="Manager" id="manager">
		</span>
		<span class="span-class">
			<label>Role</label>
			<input placeholder="Role" id="role">
		</span>
		<span class="span-class">
			<label>Level</label>
			<input placeholder="Level" id="level">
		</span>
		<span class="span-class">
			<label>Bonus Rates</label>
			<input placeholder="Bonus Rates" id="bonusRates">
		</span>
	</section>
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

<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','#submit',function(){
		var xeroEmployeeId = $('#xeroEmployeeId').val();
		var userid = $('#userid').val();
		var title = $('#title').val();
		var fname = $('#fname').val();
		var mname = $('#mname').val();
		var lname = $('#lname').val();
		var status = $('#status').val();
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
		var payrollCalendarId = $('#payrollCalendarId').val();
		// var created_at = $('#created_at').val();
		// var created_by = $('#created_by').val();
		var employeeId = $('#employeeId').val();
		// var statementText = $('.statementText').val();
		// var accountName = $('.accountName').val();
		// var bsb = $('.bsb').val();
		// var accountNumber = $('.accountNumber').val();
		// var remainderYN = $('.remainderYN').val();
		// var amount = $('.amount').val();
		var employeeId = $('#employeeId').val();
		var superFundId = $('#superFundId').val();
		var employeeNumber = $('#employeeNumber').val();
		var superMembershipId = $('#superMembershipId').val();
		var employeeId = $('#employeeId').val();
		var employmentBasis = $('#employmentBasis').val();
		var tfnExemptionType = $('#tfnExemptionType').val();
		var taxFileNumber = $('#taxFileNumber').val();
		var australiantResidentForTaxPurposeYN = $('#australiantResidentForTaxPurposeYN').val();
		var residencyStatue = $('#residencyStatue').val();
		var taxFreeThresholdClaimedYN = $('#taxFreeThresholdClaimedYN').val();
		var taxOffsetEstimatedAmount = $('#taxOffsetEstimatedAmount').val();
		var hasHELPDebtYN = $('#hasHELPDebtYN').val();
		var hasSFSSDebtYN = $('#hasSFSSDebtYN').val();
		var hasTradeSupportLoanDebtYN = $('#hasTradeSupportLoanDebtYN').val();
		var upwardVariationTaxWitholdingAmount = $('#upwardVariationTaxWitholdingAmount').val();
		var eligibleToReceiveLeaveLoadingYN = $('#eligibleToReceiveLeaveLoadingYN').val();
		var approvedWitholdingVariationPercentage = $('#approvedWitholdingVariationPercentage').val();
		var bankAccount = [];
		var banckAccountArray =	function(statementText,accountName,bsb,accountNumber,remainderYN,amount){
				this.statementText = statementText;
				this.accountName = accountName;
				this.bsb = bsb;
				this.accountNumber = accountNumber;
				this.remainderYN = remainderYN;
				this.amount = amount;
				return {statementText : statementText,accountName : accountName,bsb : bsb,				accountNumber : accountNumber,remainderYN : remainderYN,amount : amount}
			}
		var z = $('.child').length;
			for(x=0;x<z;x++){
				let statementText = $('.statementText').eq(x).val();
				let accountName = $('.accountName').eq(x).val();
				let bsb = $('.bsb').eq(x).val();
				let accountNumber = $('.accountNumber').eq(x).val();
				let remainderYN = $('.remainderYN').eq(x).val();
				let amount = $('.amount').eq(x).val();
	bankAccount.push(banckAccountArray(statementText,accountName,bsb,accountNumber,remainderYN,amount));
			}
			var url = window.location.origin + "/PN101/settings/createEmployeeProfile";
		$.ajax({
			url:,
			data:{
				xeroEmployeeId : xeroEmployeeId,
				userid: userid,
				title: title,
				fname: fname,
				mname: mname,
				lname: lname,
				status: status,
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
				payrollCalendarId: payrollCalendarId,
				// created_at: created_at,
				// created_by: created_by,
				employeeId: employeeId,
				bankAccount: bankAccount,
				employeeId: employeeId,
				superFundId: superFundId,
				employeeNumber: employeeNumber,
				superMembershipId: superMembershipId,
				employeeId: employeeId,
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
				approvedWitholdingVariationPercentage: approvedWitholdingVariationPercentage
				//To Do ,Users
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
			$('employee-details').css('display','none');
		})
		$(document).on('click','.e-s',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','block');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','none');
		})
		$(document).on('click','.e-s-s',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','block');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','none');
		})
		$(document).on('click','.e-t-d-s',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','block');
			$('.employee-details').css('display','none');
		})
		$(document).on('click','.e-u-s',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','block');
		})
	})

	$(document).on('click','.add-row',function(){
		$new_child = $('.parent-child').html();
		$('.parent-child').append($new_child);
	})
</script>
</body>
</html>