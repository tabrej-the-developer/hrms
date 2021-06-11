<!DOCTYPE html>
<html>
<head>
	<title>Edit Employee</title>
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
		.documents-tab{
			display: none;
			padding-left: 10px;
			padding-right: 10px;
			flex-wrap: wrap
		}
		.courses-tab{
			display: none;
			padding-left: 10px;
			padding-right: 10px;
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
      height: 2rem !important;
      border-radius: 20px !important;
      border: 1px solid #D2D0D0 !important;
      padding-left: 1rem !important;
      font-size: 0.85rem !important;
    }

		.span-class{
			padding: 10px 0 10px 0;
			display: inline-block;
			/*width: 33%;*/
		}
		.span-class .col-3{
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
	.add_remove_bank_account{
		position: relative;
	}
	.add-remove-row,.add-remove-superfund{
		position: absolute;
		right: 1rem;
	}
	.add-row,#superfund-add,.add_course,.remove_course,.course_delete{
		display: inline-flex;
		justify-content: center;
		align-items: center;
		background: rgb(164, 217, 214);
		padding : 0.25rem 0.75rem;
		border-radius: 20px;
		font-size: 1rem !important;
		font-weight: 700;
		cursor: pointer;
	}
	.remove-row,.superfund-remove{
		display: inline-flex;
		justify-content: center;
		align-items: center;
		background: rgb(164, 217, 214);
		padding : 0.25rem 0.75rem;
		border-radius: 20px;
		font-size: 1rem !important;
		font-weight: 700;
		cursor: pointer;
	}
		#subm,
		.addRemoveDocumentAdd,
		.removeDocumentButton,
		.singleDocDownload,
		.deleteDocument{
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
			.addRemoveDocumentAdd{
				cursor: pointer;
			}
			.removeDocumentButton
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
		table{
			width: 100%;
			text-align: center;
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
	.employee-tax-declaration-section,.employee-details,.medical-info,.courses-tab{
		max-height: 80%;
		height: 80%;
		overflow: auto
	}
	.profileImage{
/*		padding-left: 1rem;*/
	}
	.user_profileImage{
		font-size: 2rem !important;
	    height: 80px;
	    width: 80px;
	    border-radius: 50%;
	    background: #e3e4e7;
	}
	.user_profileImage .icon{
		font-size: 3rem;
		height:4rem;
		width: 4rem;
	}
	.profileImage_parent{
		width: auto !important;
	    align-items: center;
	}
	.labels__{
		font-weight: bolder;
		width:100%;
		margin: 0 !important;
	}
	body{
		font-size: 0.8rem !important;
	}
	.col-3{
		padding-right: 0 !important;
		padding-left: 0 !important;
		width: 24% !important
	}
	input[type="FILE"]{
	    margin-top: 10px;
	    width: 10rem;
	}
	.add_remove_superfund{
	    position: absolute;
	    right: 0;
	}
	.icon{
		margin-top: 0 !important;
		vertical-align: middle !important;
		padding: 0 !important
	}
	.addDocumentsDiv{
		position: relative;
	}
	.addRemoveDocument{
		display: flex;
    justify-content: flex-end;
   }
   .singleDocBlock{
   	line-height: 1.5rem;
   }
	.files__{
		width: 70%;
		display: flex;
		justify-content: space-evenly;
	}
	.addFile{
		margin-top: 0 !important;
	}
	.addSingleDocument{
		background: rgba(0,0,0,0.1);
		border-radius: 5px;
		padding: 0.2rem;
		align-items: center;
	}
	.course_delete{
		margin-top: 2rem;
    float: right;
    margin-right: 8rem;
	}
	table td {
		text-align: center;
	}
	th{
		font-size: 0.95rem;
	}
	.col-9{
		padding-left: 0 !important;
	}
	textarea[inputType="textarea"]{
		min-width: 100% !important; 
		max-width: 100% !important;
		border-radius: 10px !important;
	}
	.courses_buttons{
		text-align: right;
	}
	</style>
</head>
<body>
<?php $this->load->view('header'); ?>
<?php 
	$employeeData = json_decode($getEmployeeData);
	$superfunds = json_decode($superfunds);
?>
<div class="containers">
	<span style="position: absolute;top:20px;padding-left: 2rem" class="d-inline-flex align-items-center">
      <a onclick="goBack()">
        <button class="btn back-button">
          <img src="<?php echo base_url('assets/images/back.svg');?>">
        </button>
      </a>
	<span class="employeeNameView">Edit Employee</span>
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
		</div>	
	</section>
<form method="POST" action="updateEmployeeProfile" style="height: 100%" enctype="multipart/form-data" onsubmit="return onFormSubmit(event)" id="formSubmit">
	<section class="employee-section">	
		<!-- <h3>Personal</h3> -->
		<span class="d-flex">
		<span class="span-class col-3">
			<label class="labels__">Title</label>
			<span class="select_css">
				<select placeholder="Title" id="title"  class="" type="text" name="title" value="<?php echo isset($employeeData->employee->title) ? $employeeData->employee->title : ''; ?>"> 
					<option value="Ms">Ms</option> 
					<option value="Mr">Mr</option>
					<option value="Mrs">Mrs</option>
				</select>
			</span>
		</span>
		<span class="span-class col-3 ">
			<label class="labels__">First Name<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
			<input placeholder="First Name" id="fname"  class="" type="text" name="fname" value="<?php echo isset($employeeData->employee->fname) ? $employeeData->employee->fname : ''; ?>" >
		</span>
		<span class="span-class col-3 ">
			<label class="labels__">Middle Name</label>
			<input placeholder="Middle Name" id="mname"  class="" type="text" name="mname" value="<?php echo isset($employeeData->employee->mname) ? $employeeData->employee->mname : ''; ?>">
		</span>
		<span class="span-class col-3 ">
			<label class="labels__">Last Name<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
			<input placeholder="Last Name" id="lname"  class="" type="text" name="lname" value="<?php echo isset($employeeData->employee->lname) ? $employeeData->employee->lname : ''; ?>">
		</span>
</span>
		
		<span class="span-class col-3">
			<label class="labels__">Alias</label>
			<input placeholder="Alias" id="alias"  class="" type="text" name="alias" value="<?php echo isset($employeeData->users->alias) ? $employeeData->users->alias : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label class="labels__">Date Of Birth<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
			<input placeholder="Date Of Birth" id="dateOfBirth"  class="" type="date" name="dateOfBirth" value="<?php echo isset($employeeData->employee->dateOfBirth) ? $employeeData->employee->dateOfBirth : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label class="labels__">Gender</label>
			<span class="select_css">
			<?php $gender = isset($employeeData->employee->gender) ? $employeeData->employee->gender : ''; ?>
				<select placeholder="Gender" id="gender"  class="" name="gender" value="<?php echo $gender ?>">
					<option value="N" <?php echo ($gender == 'N') ? 'selected' : "" ?>>Not Given</option>
					<option value="M" <?php echo ($gender == 'M') ? 'selected' : "" ?>>Male</option>
					<option value="F" <?php echo ($gender == 'F') ? 'selected' : "" ?>>Female</option>
					<option value="I" <?php echo ($gender == 'I') ? 'selected' : "" ?>>Non binary</option>
				</select>				
			</span>
		</span>

		<span class="span-class profileImage_parent col-3" style="width: auto !important">
			<span style="height:100px;width:100px">
				<?php if(file_exists('api/application/assets/profileImages/'.$this->session->userdata('LoginId').'.png') && filesize("api/application/assets/profileImages/".$this->session->userdata('LoginId').".png") > 0){ 
					?>
				<img src="<?php echo BASE_API_URL."application/assets/profileImages/".$this->session->userdata("LoginId").".png"?>" style="height:100px;width:100px;border-radius:0.5rem">
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
				<input id="profileImage"  class="profileImage" type="FILE" name="profileImage">
			</span>
		</span>
		<hr>
<!-- 		<span class="span-class col-3">
			<label>Job Title</label>
			<input placeholder="Job Title" id="jobTitle"  class="" type="text" name="jobTitle" value="<?php //echo isset($employeeData->users->title) ? $employeeData->users->title : ''; ?>">
		</span> -->
	
		<span class="span-class row">
			<span class="span-class  col-3">
				<label class="labels__">Home Address Line1</label>
	<input placeholder="Home Address Line1" id="homeAddLine1"  class="" type="text" name="homeAddLine1"
	value="<?php echo isset($employeeData->employee->homeAddLine1) ? $employeeData->employee->homeAddLine1 : ''; ?>">
			</span>
			<span class="span-class col-3">
				<label class="labels__">Home Address Line2</label>
	<input placeholder="Home Address Line2" id="homeAddLine2"  class="" type="text" name="homeAddLine2"
	value="<?php echo isset($employeeData->employee->homeAddLine2) ? $employeeData->employee->homeAddLine2 : ''; ?>">
			</span>
			<span class="span-class col-3">
				<label class="labels__">City</label>
	<input  type="text" placeholder="City" id="homeAddCity"  class=""  name="homeAddCity"
	value="<?php echo isset($employeeData->employee->homeAddCity) ? $employeeData->employee->homeAddCity : ''; ?>">
			</span>				
			<span class="span-class col-3">
				<label class="labels__">Region</label>
				<span class="select_css">
		<select placeholder="Region" id="homeAddRegion"  class="" type="text" name="homeAddRegion" value="<?php echo isset($employeeData->employee->homeAddRegion) ? $employeeData->employee->homeAddRegion : ''; ?>">
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
			<span class="span-class col-3">
				<label class="labels__">Postal</label>
				<input placeholder="Postal" id="homeAddPostal"  class="" type="text" name="homeAddPostal" value="<?php echo isset($employeeData->employee->homeAddPostal) ? $employeeData->employee->homeAddPostal : ''; ?>">
			</span>
			<span class="span-class col-3">
				<label class="labels__">Country</label>
				<input placeholder="Country" id="homeAddCountry"  class="" type="text" name="homeAddCountry" value="<?php echo isset($employeeData->employee->homeAddCountry) ? $employeeData->employee->homeAddCountry : ''; ?>">
			</span>
		</span>
		<hr>
			<span class="span-class col-3">
				<label class="labels__">Phone<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
				<input placeholder="Phone" id="phone"  class="" type="text" name="phone" value="<?php echo isset($employeeData->employee->phone) ? $employeeData->employee->phone : ''; ?>">
			</span>
			<span class="span-class col-3">
				<label class="labels__">Mobile</label>
				<input placeholder="Mobile" id="mobile"  class="" type="text" name="mobile" value="<?php echo isset($employeeData->employee->mobile) ? $employeeData->employee->mobile : ''; ?>">
			</span>
			<span class="span-class col-3" >
				<label class="labels__">Email</label>
				<input style="cursor: not-allowed" placeholder="Emails" id="emails"  class="" type="text" name="emails" readonly="readonly" value="<?php echo isset($employeeData->employee->emails) ? $employeeData->employee->emails : ''; ?>">
			</span>
			<hr>
	<span class="d-block">
<!-- 		<span class="span-class col-3">
			<label>Start Date</label>
		<input placeholder="Start Date" id="startDate"  class="" type="date" name="startDate" value="<?php // echo isset($employeeData->employee->startDate) ? $employeeData->employee->startDate : ''; ?>">
		</span> -->
	</span>
<!-- 		<span class="span-class col-3">
			<label>created_at</label>
			<input placeholder="created_at" id="created_at"  class="" type="text">
		</span>
		<span class="span-class col-3">
			<label>created_by</label>
			<input placeholder="created_by" id="created_by"  class="" type="text">
		</span> -->
		<span class="span-class col-3">
			<label>Emergency Contact</label>
		<input placeholder="Emergency Contact" id="emergency_contact"  class="" type="text" name="emergency_contact" value="<?php echo isset($employeeData->employee->emergency_contact) ? $employeeData->employee->emergency_contact : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Relationship</label>
		<input placeholder="Relationship" id="relationship"  class="" type="text" name="relationship" value="<?php echo isset($employeeData->employee->relationship) ? $employeeData->employee->relationship : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Emergency Contact Email</label>
			<input placeholder="Emergency Contact Email" id="emergency_contact_email"  class="" type="email" name="emergency_contact_email" value="<?php echo isset($employeeData->employee->emergency_contact_email) ? $employeeData->employee->emergency_contact_email : ''; ?>">
		</span>
		<hr>
	</section>

	<section class="employee-bank-account-section">
    <h3 class="add_remove_bank_account">Bank Account 
      <span class="add-remove-row">
        <span class="add-row"> Add </span>
        <span class="remove-row"> Remove </span>
      </span>
    </h3>
		<div class="parent-child">
			<?php 
				$eba = $employeeData->employeeBankAccount;
				for($i=0;$i<count($employeeData->employeeBankAccount);$i++){ ?>
			<div class="child">
				<div class="statement"></div>
<!-- 			<div class="row">
 --><!-- 		<span class="span-class col-3">
			<label>Statement Text</label>
			<input placeholder="Statement Text" type="text" class="statementText" >
		</span> -->
		<span class="span-class col-3">
			<label>Account Name</label>
			<input placeholder="Account Name" type="text" class="accountName" name="accountName[]" value="<?php echo isset($eba[$i]->accountName) ? $eba[$i]->accountName : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>BSB</label>
			<input placeholder="BSB" type="text" class="bsb" name="bsb[]" value="<?php echo isset($eba[$i]->bsb) ? $eba[$i]->bsb : ''; ?>">
		</span>
<!-- 	</div>
 -->		
<!-- 	<span class="row">
 -->		<span class="span-class col-3">
			<label>Account Number</label>
			<input placeholder="Account Number" type="text" class="accountNumber" name="accountNumber[]" value="<?php echo isset($eba[$i]->accountNumber) ? $eba[$i]->accountNumber : ''; ?>">
		</span>
		<?php if($i ==  0){ ?>
		<span class="span-class col-3 remainder_parent">
			<label>Remainder</label>
				<span>
					<label class="yn-label">Yes</label>
					<input value="Y" class="remainderYN yn-input" type="radio" name="remainderYN[]" <?php echo isset($eba[$i]->remainderYN) ? ($eba[$i]->remainderYN == 'Y' ? 'checked' : '') : ''; ?>>
				</span>
				<span>
					<label class="yn-label">No</label>
					<input value="N" class="remainderYN yn-input" type="radio" name="remainderYN[]" <?php echo isset($eba[$i]->remainderYN) ? (($eba[$i]->remainderYN == 'Y') ? 'checked' : '') : ''; ?>>
				</span>
		</span>
		<?php   } ?>
		<span class="span-class amount-class-parent col-3">
			<div class="amount-class">
				<label>Amount</label>
				<input placeholder="Amount" type="text" class="amount" name="amount[]" value="<?php echo isset($eba[$i]->amount) ? $eba[$i]->amount : ''; ?>">
			</div>
		</span>
<!-- 	</span>
 -->			</div>
				<?php }if(count($eba) == 0){ ?>
			<div class="child">
				<div class="statement"></div>
<!-- 			<div class="row">
 --><!-- 		<span class="span-class col-3">
			<label>Statement Text</label>
			<input placeholder="Statement Text" type="text" class="statementText" >
		</span> -->
		<span class="span-class col-3">
			<label>Account Name</label>
			<input placeholder="Account Name" type="text" class="accountName" name="accountName[]" >
		</span>
		<span class="span-class col-3">
			<label>BSB</label>
			<input placeholder="BSB" type="text" class="bsb" name="bsb[]" >
		</span>
<!-- 	</div>
 -->		
<!-- 	<span class="row">
 -->		<span class="span-class col-3">
			<label>Account Number</label>
			<input placeholder="Account Number" type="text" class="accountNumber" name="accountNumber[]" >
		</span>
		<?php if($i ==  0){ ?>
		<span class="span-class col-3 remainder_parent">
			<label>Remainder</label>
				<span>
					<label class="yn-label">Yes</label>
					<input value="Y" class="remainderYN yn-input" type="radio" name="remainderYN[]" >
				</span>
				<span>
					<label class="yn-label">No</label>
					<input value="N" class="remainderYN yn-input" type="radio" name="remainderYN[]" >
				</span>
		</span>
		<?php   } ?>
		<span class="span-class amount-class-parent col-3">
			<div class="amount-class">
				<label>Amount</label>
				<input placeholder="Amount" type="text" class="amount" name="amount[]" >
			</div>
		</span>
<!-- 	</span>
 -->			</div>
				<?php } ?>
		</div>
	</section>



	<section class="employee-superfund-section">
		<h3> Superannuation 
			<span class="add_remove_superfund">
				<span id="superfund-add"> Add </span>
				<span class="superfund-remove"> Remove </span></span></h3>
<!-- 		<span class="span-class col-3">
			<label>Employee Id</label>
			<input placeholder="Employee Id" id="employeeId" >
		</span> -->
			<div class="superfund-parent">
			<?php 
			$checkSuperfund = count($employeeData->employeeSuperfunds);
			foreach($employeeData->employeeSuperfunds as $supFund){ ?>
				<div class="superfund-child row">
					<span class="span-class col-3">
						<label>Super Fund Id</label>
						<span class="select_css">
							<select placeholder="Super Fund Id" class="superFundId" name="superFund[Id][]" value="<?php echo isset($supFund->superFundId) ? $supFund->superFundId : ''; ?>">
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
						</span>
					</span>
					<span class="span-class col-3">
						<label>Super Membership Id</label>
						<input placeholder="Super Membership Id" class="superMembershipId" type="text" name="superFund[MembershipId][]" value="<?php echo isset($supFund->superMembershipId) ? $supFund->superMembershipId : ''; ?>">
					</span>
					<span class="span-class col-3">
						<label class="labels__">Employee Number</label>
						<input class="employeeNumber" type="text" name="superFund[EmployeeNumber][]" value="<?php echo isset($supFund->employeeNumber) ? $supFund->employeeNumber : ''; ?>">
					</span>
				</div>
				<?php }if($checkSuperfund == 0){ ?>
				<div class="superfund-child row">
					<span class="span-class col-3">
						<label>Super Fund Id</label>
						<span class="select_css">
							<select placeholder="Super Fund Id" class="superFundId" name="superFund[Id][]">
							<?php 
							foreach($superfunds->superfunds as $superfund){
									echo "<option value='$superfund->superFundId'>$superfund->name</option>";
							}
							?>
							</select>
						</span>
					</span>
					<span class="span-class col-3">
						<label>Super Membership Id</label>
						<input placeholder="Super Membership Id" class="superMembershipId" type="text" name="superFund[MembershipId][]" >
					</span>
					<span class="span-class col-3">
						<label class="labels__">Employee Number</label>
						<input class="employeeNumber" type="text" name="superFund[EmployeeNumber][]" >
					</span>
				</div>
				<?php } ?>
			</div>

	</section>





	<section class="employee-tax-declaration-section">
		<!-- <h3>Employee Tax Declaration Section</h3> -->


		<span class="span-class col-3 pl-4">
			<label>TFN Exemption Type</label>
			<span class="select_css">
				<select placeholder="tfnExemptionType" id="tfnExemptionType" name="tfnExemptionType" select="<?php echo isset($employeeData->employeeTaxDeclaration->tfnExemptionType) ? $employeeData->employeeTaxDeclaration->tfnExemptionType : ''; ?>">
					<option value="NONE">NONE</option>
					<option value="NOTQUOTED">NOTQUOTED</option>
					<option value="PENDING">PENDING</option>
					<option value="PENSIONER">PENSIONER</option>
					<option value="UNDER18">UNDER18</option>
				</select>
			</span>
		</span> 
		<div class="tax-declaration-class col-lg-12">
		<span class="span-class col-3">
			<label>Tax File Number</label>
			<input placeholder="Tax File Number" id="taxFileNumber" name="taxFileNumber" type="text" value="<?php echo isset($employeeData->employeeTaxDeclaration->taxFileNumber) ? $employeeData->employeeTaxDeclaration->taxFileNumber : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Australian Resident For TaxPurpose</label>
			<label class="yn-label">Yes</label>
				<input placeholder="Australian Resident For TaxPurpose" type="radio"  name="australiantResidentForTaxPurposeYN" class="australiantResidentForTaxPurposeYN yn-input" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->australiantResidentForTaxPurposeYN) ? (($employeeData->employeeTaxDeclaration->australiantResidentForTaxPurposeYN == 'Y') ? 'checked' : '') : ''; ?>>
			<label class="yn-label">No</label>
				<input type="radio" name="australiantResidentForTaxPurposeYN" class="australiantResidentForTaxPurposeYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->australiantResidentForTaxPurposeYN) ? (($employeeData->employeeTaxDeclaration->australiantResidentForTaxPurposeYN == 'N') ? 'checked' : '') : ''; ?>>
		</span>
		<span class="span-class col-3">
			<label>Residency Status</label>
			<span class="select_css">
				<select placeholder="residencyStatue" id="residencyStatue" name="residencyStatue" value="<?php echo isset($employeeData->employeeTaxDeclaration->residencyStatue) ? $employeeData->employeeTaxDeclaration->residencyStatue : ''; ?>">
					<option value="AUSTRALIANRESIDENT">Australian Resident</option>
					<option value="FOREIGNRESIDENT">Foreign Resident</option>
					<option value="WORKINGHOLIDAY">Working Holiday</option>
				</select>
			</span>
		</span>
		<span class="span-class col-3">
			<label>Tax Free Threshold Claimed</label>
			<label class="yn-label">Yes</label>
				<input placeholder="taxFreeThresholdClaimedYN" type="radio" name="taxFreeThresholdClaimedYN" class="taxFreeThresholdClaimedYN yn-input" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->taxFreeThresholdClaimedYN) ? (($employeeData->employeeTaxDeclaration->taxFreeThresholdClaimedYN == 'Y') ? 'checked' : '') : ''; ?>>
			<label class="yn-label">No</label>
				<input type="radio" name="taxFreeThresholdClaimedYN" class="taxFreeThresholdClaimedYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->taxFreeThresholdClaimedYN) ? (($employeeData->employeeTaxDeclaration->taxFreeThresholdClaimedYN == 'N') ? 'checked' : '') : ''; ?>>
		</span>
		<span class="span-class col-3">
			<label>Tax Offset Estimated Amount</label>
			<input placeholder="Tax Offset Estimated Amount" id="taxOffsetEstimatedAmount" type="number" name="taxOffsetEstimatedAmount" value="<?php echo isset($employeeData->employeeTaxDeclaration->taxOffsetEstimatedAmount) ? $employeeData->employeeTaxDeclaration->taxOffsetEstimatedAmount : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Has HELP Debt</label>
			<label class="yn-label">Yes</label>
			<input placeholder="hasHELPDebtYN" name="hasHELPDebtYN" class="hasHELPDebtYN yn-input" value="Y" type="radio" <?php echo isset($employeeData->employeeTaxDeclaration->hasHELPDebtYN) ? (($employeeData->employeeTaxDeclaration->hasHELPDebtYN == 'Y') ? 'checked' : '') : ''; ?>>
			<label class="yn-label">No</label>
			<input type="radio" name="hasHELPDebtYN" class="hasHELPDebtYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->hasHELPDebtYN) ? (($employeeData->employeeTaxDeclaration->hasHELPDebtYN == 'N') ? 'checked' : '') : ''; ?>>	
		</span>
		<span class="span-class col-3">
			<label>Has SFSS Debt</label>
			<label class="yn-label">Yes</label>
			<input placeholder="hasSFSSDebtYN" type="radio" name="hasSFSSDebtYN" class="hasSFSSDebtYN yn-input" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->hasSFSSDebtYN) ? (($employeeData->employeeTaxDeclaration->hasSFSSDebtYN == 'Y') ? 'checked' : '') : ''; ?>>
			<label class="yn-label">No</label>
			<input type="radio" name="hasSFSSDebtYN" class="hasSFSSDebtYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->hasSFSSDebtYN) ? (($employeeData->employeeTaxDeclaration->hasSFSSDebtYN == 'N') ? 'checked' : '') : ''; ?>>
		</span>
		<span class="span-class col-3">
			<label>Has Trade Support Loan Debt</label>
			<label class="yn-label">Yes</label>
			<input placeholder="hasTradeSupportLoanDebtYN" type="radio" name="hasTradeSupportLoanDebtYN " class="hasTradeSupportLoanDebtYN yn-input" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->hasTradeSupportLoanDebtYN) ? (($employeeData->employeeTaxDeclaration->hasTradeSupportLoanDebtYN == 'Y') ? 'checked' : '') : ''; ?>>
			<label class="yn-label">No</label>
			<input type="radio" name="hasTradeSupportLoanDebtYN " class="hasTradeSupportLoanDebtYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->hasTradeSupportLoanDebtYN) ? (($employeeData->employeeTaxDeclaration->hasTradeSupportLoanDebtYN == 'N') ? 'checked' : '') : ''; ?>>
		</span>
		<span class="span-class col-3">
			<label>Upward Variation Tax Witholding Amount</label>
			<input placeholder="Upward Variation Tax Witholding Amount" id="upwardVariationTaxWitholdingAmount" name="upwardVariationTaxWitholdingAmount" type="number" value="<?php echo isset($employeeData->employeeTaxDeclaration->upwardVariationTaxWitholdingAmount) ? $employeeData->employeeTaxDeclaration->upwardVariationTaxWitholdingAmount : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Eligible To Receive Leave Loading</label>
			<label class="yn-label">Yes</label>
			<input placeholder="eligibleToReceiveLeaveLoadingYN" type="radio" class="eligibleToReceiveLeaveLoadingYN yn-input" name="eligibleToReceiveLeaveLoadingYN" value="Y" <?php echo isset($employeeData->employeeTaxDeclaration->eligibleToReceiveLeaveLoadingYN) ? (($employeeData->employeeTaxDeclaration->eligibleToReceiveLeaveLoadingYN == 'Y') ? 'checked' : '') : ''; ?>>
			<label class="yn-label">No</label>
			<input type="radio" name="eligibleToReceiveLeaveLoadingYN" class="eligibleToReceiveLeaveLoadingYN yn-input" value="N" <?php echo isset($employeeData->employeeTaxDeclaration->eligibleToReceiveLeaveLoadingYN) ? (($employeeData->employeeTaxDeclaration->eligibleToReceiveLeaveLoadingYN == 'N') ? 'checked' : '') : ''; ?>>
		</span>
		<span class="span-class col-3">
			<label>Approved Witholding Variation Percentage</label>
			<input placeholder="Approved Witholding Variation Percentage" id="approvedWitholdingVariationPercentage" name="approvedWitholdingVariationPercentage" type="number" value="<?php echo isset($employeeData->employeeTaxDeclaration->approvedWitholdingVariationPercentage) ? $employeeData->employeeTaxDeclaration->approvedWitholdingVariationPercentage : ''; ?>">
		</span>
		
	</div>
	</section>


	<section class="employee-details">
		<span class="span-class col-3" style="display:none">
			<label>Employee Number</label>
			<input placeholder="Employee Number" id="employee_no" type="text" name="employee_no" value="<?php echo isset($employeeData->employee->userid) ? $employeeData->employee->userid : ''; ?>">
		</span>
		<span class="span-class col-3" style="display:none">
			<label>Xero Employee Id</label>
			<input placeholder="Xero Employee Id" id="xeroEmployeeId" type="text" name="xeroEmployeeId" value="<?php echo isset($employeeData->employee->xeroEmployeeId) ? $employeeData->employee->xeroEmployeeId : ''; ?>">
		</span>

<!-- 		<span class="span-class col-3">
			<label>	Currently-employed</label>
			<label class="yn-label">Yes</label>
			<input  type="radio" name="currently_employed " class="currently_employed yn-input" value="Y">
			<label class="yn-label">No</label>
			<input type="radio" name="currently_employed " class="currently_employed yn-input" value="N">
		</span>
		<span class="span-class col-3">
			<label>	Commencement-date</label>
			<input placeholder="Commencement-date" id="commencement_date" type="date">
		</span> -->
<!-- 
		<span class="span-class col-3">
			<label>Contract-position	</label>
			<input placeholder="Contract-position	" id=" " type="text">
		</span> -->
<!-- 		<span class="span-class col-3">
			<label>Resume-supplied</label>
			<label class="yn-label">Yes</label>
			<input  type="radio" name="resume_supplied" class="resume_supplied yn-input" value="Y">
			<label class="yn-label">No</label>
			<input type="radio" name="resume_supplied" class="resume_supplied yn-input" value="N">
		</span>
 -->


<!-- 		<span class="span-class col-3">
			<label>Employment-type</label>
			<span class="select_css">
				<select id="employement_type" name="employement_type" value="<?php echo isset($employeeData->employeeRecord->employmentType) ? $employeeData->employeeRecord->employmentType : ''; ?>">
					<option value="FT">Full Time</option>
					<option value="PT">Part Time</option>
					<option value="Casual">Casual</option>
				</select>
			</span>
		</span>
 --><!-- 		<span class="span-class col-3">
			<label>Current-contract-notes</label>
			<input placeholder="Current-contract-notes" id="current_contract_notes" type="date">
		</span>
		<span class="span-class col-3">
			<label>Current-contract-signature-date 	</label>
			<input placeholder="Current-contract-signature-date" id="current_contract_signature_date" type="date">
		</span>
		<span class="span-class col-3">
			<label>Current-contract-commencement-date </label>
			<input placeholder="Current-contract-commencement-date" id="current_contract_commencement_date" type="date">
		</span>
		<span class="span-class col-3">
			<label>Current-contract-end-date	</label>
			<input placeholder="Current-contract-end-date" id="current_contract_end_date" type="date">
		</span>
		<span class="span-class col-3">
			<label>Current-contract-paid-start-date </label>
			<input placeholder="Current-contract-paid-start-date" id="current_contract_paid_start_date" type="date">
		</span>
		<span class="span-class col-3">
			<label>Probation-end-date 	</label>
			<input placeholder="Probation end date" id="probation_end_date" type="date">
		</span> -->
<!-- 		<span class="span-class col-3">
			<label>Industry-years-exp-as-nov19	</label>
			<input placeholder="Industry-years-exp-as-nov19	" id="industry_years_exp_as_nov19" type="text">
		</span> -->

		<span class="span-class col-3">
			<label>Highest qual held</label>
		<input placeholder="Highest-qual-held" id="highest_qual_held" name="highest_qual_held" type="text"  value="<?php echo isset($employeeData->employeeRecord->highestQualHeld) ? $employeeData->employeeRecord->highestQualHeld : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Date Obtained</label>
		<input placeholder="Date Obtained" id="highest_qual_date_obtained" name="highest_qual_date_obtained" type="date"  value="<?php echo isset($employeeData->employeeRecord->highestQualDateObtained) ? $employeeData->employeeRecord->highestQualDateObtained : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Highest Qualification Certificate</label>
		<input placeholder="Date Obtained" id="highest_qual_cert" name="highest_qual_cert" type="text" value=" ">
		</span>
<!-- 		<span class="span-class col-3">
			<label>Highest-qual-type	 </label>
			<input placeholder="Highest-qual-type" id="highest_qual_type" type="text">
		</span>
 -->		<span class="span-class col-3">
			<label>Qualification working Toward</label>
		<input placeholder="Qual-towards-desc" id="qual_towards_desc" name="qual_towards_desc" type="text" value="<?php echo isset($employeeData->employeeRecord->qualWorkingTowards) ? $employeeData->employeeRecord->qualWorkingTowards : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Qual towards % comp</label>
		<input placeholder="Qual towards % comp" id="qual_towards_percent_comp" name="qual_towards_percent_comp" type="number" value="<?php echo isset($employeeData->employeeRecord->qualTowardsPercentcomp) ? $employeeData->employeeRecord->qualTowardsPercentcomp : ''; ?>">
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
		<span class="span-class col-3">
			<label>Classification</label>
			<input placeholder="Classification" id="classification" name="classification" type="text" value="<?php echo isset($employeeData->employee->classification) ? $employeeData->employee->classification : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Ordinary Earning Rate Id</label>
			<span class="select_css">
				<select placeholder="Ordinary Earning Rate Id" id="ordinaryEarningRateId" name="ordinaryEarningRateId"  class="" type="text" value="<?php echo isset($employeeData->employee->ordinaryEarningRateId) ? $employeeData->employee->ordinaryEarningRateId : ''; ?>">

				</select>
			</span>
		</span>

<!-- 		<span class="span-class col-3">
			<label>Payroll Calendar</label>
			<input placeholder="Payroll Calendar" id="payroll_calendar" name="payroll_calendar" type="text" value="<?php echo isset($employeeData->employee->payrollCalendarId) ? $employeeData->employee->payrollCalendarId : ''; ?>">
		</span> -->

		<span class="span-class col-3">
			<label>Visa Holder</label>
			<label class="yn-label">Yes</label>
			<input  type="radio" name="visa_holder" class="visa_holder yn-input" value="Y" <?php echo isset($employeeData->employeeRecord->visaHolderYN) ? (($employeeData->employeeRecord->visaHolderYN == 'Y') ? 'checked' : '') : ''; ?>>
			<label class="yn-label">No</label>
			<input type="radio" name="visa_holder" class="visa_holder yn-input" value="N" <?php echo isset($employeeData->employeeRecord->visaHolderYN) ? (($employeeData->employeeRecord->visaHolderYN == 'N') ? 'checked' : '') : ''; ?>>
		</span>
		<span class="span-class col-3">
			<label>	Visa type		</label>
			<input placeholder="Visa-type" id="visa_type" name="visa_type" type="text" value="<?php echo isset($employeeData->employeeRecord->visaType) ? $employeeData->employeeRecord->visaType : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>	Visa Grant Date	</label>
			<input placeholder="Visa-grant-date" id="visa_grant_date" name="visa_grant_date" type="date" value="<?php echo isset($employeeData->employeeRecord->visaGrantDate) ? $employeeData->employeeRecord->visaGrantDate : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>	Visa End Date	</label>
			<input placeholder="Visa-end-date" id="visa_end_date" name="visa_end_date" type="date" value="<?php echo isset($employeeData->employeeRecord->visaEndDate) ? $employeeData->employeeRecord->visaEndDate : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>	Visa Conditions</label>
			<input placeholder="Visa-conditions" id="visa_conditions" name="visa_conditions" type="text" value="<?php echo isset($employeeData->employee->visaConditions) ? $employeeData->employee->visaConditions : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Termination Date</label>
		<input placeholder="Termination Date" id="terminationDate"  class="" type="date" name="terminationDate" value="<?php echo isset($employeeData->employee->terminationDate) ? $employeeData->employee->terminationDate : ''; ?>">
		</span>

<!-- 		<span class="span-class col-3">
			<label>CPR-expiry</label>
			<input placeholder="CPR-expiry" id="cpr_expiry" type="text">
		</span>
		<span class="span-class col-3">
			<label>Prohibition-Notice-Declaration</label>
			<input placeholder="Prohibition-Notice-Declaration" id="prohibition_notice_declaration" type="date">
		</span>
		<span class="span-class col-3">
			<label>VIT-card-no</label>
			<input placeholder="VIT-card-no" id="vit_card_no" type="text">
		</span>
		<span class="span-class col-3">
			<label>VIT-expiry</label>
			<input placeholder="VIT-expiry" id="vit_expiry" type="text">
		</span>
		<span class="span-class col-3">
			<label>WWCC-card-no	</label>
			<input placeholder="WWCC-card-no" id="wwcc_card_no" type="text">
		</span>
		<span class="span-class col-3">
			<label>WWCC-expiry</label>
			<input placeholder="WWCC-expiry" id="wwcc_expiry" type="text">
		</span>
		<span class="span-class col-3">
			<label>Food-handling-safety</label>
			<input placeholder="Food-handling-safety" id="food_handling_safety" type="date">
		</span>
		<span class="span-class col-3">
			<label>Last-police-check</label>
			<input placeholder="Last-police-check" id="last_police_check" type="date">
		</span>
		<span class="span-class col-3">
			<label>Child-protection-check</label>
			<input placeholder="Child-protection-check" id="child_protection_check" type="date">
		</span>
		<span class="span-class col-3">
			<label>Nominated-supervisor</label>
			<label class="yn-label">Yes</label>
				<input  type="radio"  name="nominated_supervisor" class="nominated_supervisor yn-input" value="Y">
			<label class="yn-label">No</label>
				<input type="radio" name="nominated_supervisor" class="nominated_supervisor yn-input" value="N">
		</span> -->
	</section>
	<section class="courses-tab">
	<?php $toCount = isset($employeeData->employeeCourses) ? $employeeData->employeeCourses : ''; 
		// count($toCount)
	for($i=0;$i<count($toCount);$i++){ ?>
			<div class="courses_div">
					<input type="text" name="course_id[]" style="display:none" value="<?php echo isset($employeeData->employeeCourses[$i]->id) ? $employeeData->employeeCourses[$i]->id : ''; ?>">
					<span class="span-class col-3">
						<label>Course Name</label>
						<input placeholder="Course Name" class="course_name" name="course_name[]" type="text" value="<?php echo isset($employeeData->employeeCourses[$i]->courseName) ? $employeeData->employeeCourses[$i]->courseName : ''; ?>">
					</span>
					<span class="span-class col-3">
						<label>Date Obtained</label>
						<input placeholder="Date Obtained" class="date_obtained" name="date_obtained[]" type="date" value="<?php echo isset($employeeData->employeeCourses[$i]->dateObtained) ? $employeeData->employeeCourses[$i]->dateObtained : ''; ?>">
					</span>
					<span class="span-class col-3">
						<label>Certificate </label>
						<input placeholder="Certificate" class="certificate" name="certificate[]" type="FILE">
					</span>
					<span class="span-class col-3">
						<label>Expiry Date</label>
						<input placeholder="Expiry Date" class="expiry_date" name="expiry_date[]" type="date" value="<?php echo isset($employeeData->employeeCourses[$i]->courseExpiryDate) ? date('Y-m-d',strtotime($employeeData->employeeCourses[$i]->courseExpiryDate)) : ''; ?>">
					</span>
					<span class="span-class col-9">
						<label>Course Description</label>
						<textarea placeholder="Course Description" class="course_description" name="course_description[]" type="text" value="" inputType="textarea"><?php echo isset($employeeData->employeeCourses[$i]->courseDescription) ? $employeeData->employeeCourses[$i]->courseDescription : ''; ?></textarea>
					</span>
					<?php if( isset($employeeData->employeeCourses[$i]->id) ){ ?>
					<span class="course_delete" courseId="<?php echo isset($employeeData->employeeCourses[$i]->id) ? $employeeData->employeeCourses[$i]->id : ''; ?>">Delete</span>
				<?php } ?>
			</div>
		<?php } ?>
	<div class="courses_buttons">
		<span><span class="add_course">Add</span></span>
		<span><span class="remove_course">Remove</span></span>
	</div>
				<div class="courses_div_new">
					<input type="text" name="course_id[]" style="display:none" value="">
					<span class="span-class col-3">
						<label>Course Name</label>
						<input placeholder="Course Name" class="course_name" name="course_name[]" type="text" value="">
					</span>
					<span class="span-class col-3">
						<label>Date Obtained</label>
						<input placeholder="Date Obtained" class="date_obtained" name="date_obtained[]" type="date" value="">
					</span>
					<span class="span-class col-3">
						<label>Certificate </label>
						<input placeholder="Certificate" class="certificate" name="certificate[]" type="FILE">
					</span>
					<span class="span-class col-3">
						<label>Expiry Date</label>
						<input placeholder="Expiry Date" class="expiry_date" name="expiry_date[]" type="date" value="">
					</span>
					<span class="span-class col-9">
						<label>Course Description</label>
						<textarea placeholder="Course Description" class="course_description" name="course_description[]" type="text" value="" inputType="textarea"></textarea>
					</span>
				</div>
	</section>
	<section class="medical-info">
		<span class="span-class col-3">
			<label>Medicare Number</label>
				<input  type="text"  name="medicareNo" class="medicareNo" value="<?php echo isset($employeeData->employeeMedicalInfo->medicareNo) ? $employeeData->employeeMedicalInfo->medicareNo : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Medicare Reference Number</label>
				<input  type="text"  name="medicareRefNo" class="medicareRefNo" value="<?php echo isset($employeeData->employeeMedicalInfo->medicareRefNo) ? $employeeData->employeeMedicalInfo->medicareRefNo : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Health Insurance Fund</label>
				<input  type="text"  name="healthInsuranceFund" class="healthInsuranceFund" value="<?php echo isset($employeeData->employeeMedicalInfo->healthInsuranceFund) ? $employeeData->employeeMedicalInfo->healthInsuranceFund : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Health Insurance Number</label>
				<input  type="text"  name="healthInsuranceNo" class="healthInsuranceNo" value="<?php echo isset($employeeData->employeeMedicalInfo->healthInsuranceNo) ? $employeeData->employeeMedicalInfo->healthInsuranceNo : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Ambulance Subscription Number</label>
				<input  type="text"  name="ambulanceSubscriptionNo" class="ambulanceSubscriptionNo"  value="<?php echo isset($employeeData->employeeMedicalInfo->ambulanceSubscriptionNo) ? $employeeData->employeeMedicalInfo->ambulanceSubscriptionNo : ''; ?>">
		</span>
<?php $toSize = isset($employeeData->employeeMedicals) ? $employeeData->employeeMedicals : ''; ?>
		<?php for($i=0;$i<count($toSize);$i++){ ?>
			<input type="text" name="medicals_id[]" style="display:none" value="<?php echo isset($employeeData->employeeMedicals[$i]->id) ? $employeeData->employeeMedicals[$i]->id : ''; ?>">
		<span class="span-class col-3">
			<label>Medical Conditions</label>
				<input  type="text"  name="medicalConditions[]" class="medicalConditions" value="<?php echo isset($employeeData->employeeMedicals[$i]->medicalConditions) ? $employeeData->employeeMedicals[$i]->medicalConditions : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Medical Allergies</label>
				<input  type="text"  name="medicalAllergies[]" class="medicalAllergies" value="<?php echo isset($employeeData->employeeMedicals[$i]->medicalAllergies) ? $employeeData->employeeMedicals[$i]->medicalAllergies : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Medication</label>
				<input  type="text"  name="medication[]" class="medication" value="<?php echo isset($employeeData->employeeMedicals[$i]->medication) ? $employeeData->employeeMedicals[$i]->medication : ''; ?>">
		</span>
		<span class="span-class col-3">
			<label>Dietary Preferences</label>
				<input  type="text"  name="dietaryPreferences[]" class="dietaryPreferences" value="<?php echo isset($employeeData->employeeMedicals[$i]->dietaryPreferences) ? $employeeData->employeeMedicals[$i]->dietaryPreferences : ''; ?>">
		</span>
	<?php } ?>
<!-- 		<span class="span-class col-3">
			<label>Anaphylaxis</label>
				<input  type="date"  name="anaphylaxis" class="anaphylaxis">
		</span>
		<span class="span-class col-3">
			<label>Asthma</label>
				<input  type="date"  name="asthma" class="asthma">
		</span>
		<span class="span-class col-3">
			<label>Maternity Start Date</label>
				<input  type="date"  name="maternityStartDate" class="maternityStartDate">
		</span>
		<span class="span-class col-3">
			<label>Maternity End Date</label>
				<input  type="date"  name="maternityEndDate" class="maternityEndDate">
		</span> -->
	</section>
	<section class="documents-tab">
		<div class="addRemoveDocument">
			<span class="addRemoveDocumentSpan">
				<span class="addRemoveDocumentAdd">Add</span>
			</span>
		</div>
		<div class="addDocumentsDiv">
<!-- 			<span class="span-class col-3">
				<label>Resume Document </label>
				<input  id="resume_doc" name="resume_doc" type="file" value=" ">
			</span>
			<span class="span-class col-3">
				<label>Contract Document </label>
				<input  id="contract_doc" name="contract_doc" type="file" value=" ">
			</span> -->
			<table class="documentsTable">
				<tr style="text-align:center">
					<th>Document Name</th>
					<th>Download</th>
					<th>Delete</th>
				</tr>
				<tr>
					<td>Resume Document </td>
					<td class="singleDocDownload">Download</td>
					<td><input  id="resume_doc" name="resume_doc" type="file" value=" "></td>
				</tr>
				<tr>
					<td>Contract Document</td>
					<td class="singleDocDownload">Download</td>
					<td><input  id="contract_doc" name="contract_doc" type="file" value=" "></td>
				</tr>
				<?php foreach($employeeData->employeeDocuments as $docs){ ?>
					<tr class="singleDocBlock">
						<td class="singleDocName"><?php echo $docs->name ?></td>
						<td class="singleDocDownload">
							<a href="<?php echo DOCUMENTS_PATH.($docs->document) ?>" download>Download</a>
						</td>
						<td><button class="deleteDocument" docId="<?php echo $docs->id ?>">Delete</button></td>
					</tr>
				<?php } ?>
				<tr class="addSingleDocument">
					<td><input type="text" name="addFileName[]"></td>
					<td><input type="FILE" name="addFile[]" class="addFile"></td>
					<td><span class="removeDocumentButton">Remove</span></td>
				</tr>
			</table>
		</div>
	</section>
	<div class="submit-div">
		<button id="subm">
			<i>
				<img src="<?php echo base_url('assets/images/icons/send.png'); ?>" style="max-height:1rem;margin-right:10px">
			</i>Submit</button>
	</div>
</form>
<?php // } ?>
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
			if( !($('#mname').val() == null ||  !(/^[\sa-zA-Z]+$/).test($('#mname').val())) ){
		        addMessageToNotification('Invalid Last Name');
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
			if($('#phone').val() == null || $('#phone').val() == ""){
		        addMessageToNotification('Enter Phone Number');
		      	showNotification();
		        setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}
			if( ! ($('#alias').val() == null || $('#alias').val() == "" ||  (/^[a-zA-Z]+$/).test($('#alias').val())) ){
		        addMessageToNotification('Invalid Alias');
		      	showNotification();
		        setTimeout(closeNotification,5000)
					falseOrTrue = false;
			}
			if( !($('#homeAddCity').val() == null || $('#homeAddCity').val() == "" ||  (/^[a-zA-Z]+$/).test($('#homeAddCity').val())) ){
		        addMessageToNotification('Invalid City');
		      	showNotification();
		        setTimeout(closeNotification,5000)
					falseOrTrue = false;
			}
			if( !( $('#homeAddPostal').val() == null || $('#homeAddPostal').val() == ""  || (/^[0-9]+$/).test($('#homeAddPostal').val() ) ) ){
		        addMessageToNotification('Invalid Postal Code');
		      	showNotification();
		        setTimeout(closeNotification,5000)
					falseOrTrue = false;
			}
			if( !( $('#homeAddCountry').val() == null || $('#homeAddCountry').val() == ""  || (/^[0-9]+$/).test($('#homeAddCountry').val() ) ) ){
		        addMessageToNotification('Invalid Country');
		      	showNotification();
		        setTimeout(closeNotification,5000)
					falseOrTrue = false;
			}
			if(  !($('#phone').val() == null || $('#phone').val() == "" ||(/^[0-9]+$/).test($('#phone').val() ) )  ){
		        addMessageToNotification('Invalid Phone');
		      	showNotification();
		        setTimeout(closeNotification,5000)
					falseOrTrue = false;
			}
			if(  !($('#mobile').val() == null || $('#mobile').val() == "" ||(/^[0-9]+$/).test($('#mobile').val() ) )  ){
		        addMessageToNotification('Invalid mobile');
		      	showNotification();
		        setTimeout(closeNotification,5000)
					falseOrTrue = false;
			}
			if(  !($('#emergency_contact').val() == null || $('#emergency_contact').val() == "" ||(/^[0-9]+$/).test($('#emergency_contact').val() ) )  ){
		        addMessageToNotification('Invalid Emergency Contact');
		      	showNotification();
		        setTimeout(closeNotification,5000)
					falseOrTrue = false;
			}
			if(  !($('#employeeNumber').val() == null || $('#employeeNumber').val() == "" ||(/^[0-9]+$/).test($('#employeeNumber').val() ) )  ){
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

</script>
</body>
</html>
