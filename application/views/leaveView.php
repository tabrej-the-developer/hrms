<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header'); ?>
<title>Leaves</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <style>
  

        .card-header {
            padding: 0.2rem 1.25rem;
            /* margin-bottom: 0; */
            background-color: #ffffff;
            border-bottom: 0px;
        }
        
        .card-body {
            padding: 0rem 1.25rem;
        }
        
        p {
            margin-top: 0;
            margin-bottom: 10px;
        }
        
        .card {
            border-radius: 0px;
            padding-top: 15px;
            padding-bottom: 15px;
			border:none;
			box-shadow: none;
        }
        
        .flex-wrap {
            margin-bottom: -35px;
        }
        
        div.dataTables_wrapper div.dataTables_paginate {
            margin-top: -25px;
        }
        
        .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #5D78FF;
            border-color: #5D78FF;
			
        }
		.btn.focus, .btn:focus {
			outline: 0;
			box-shadow: none;
		}
		.btn-group-sm>.btn, .btn-sm {
			padding: .25rem .5rem;
			font-size: .875rem;
			line-height: 1.5;
			border-radius: 1.2rem;
			border: 1px solid #ccc;
		}
		#example_filter input {
		  border-radius: 1.2rem;
		}
		.border-shadow{
			    box-shadow: 0 3px 10px rgba(0,0,0,.1);

		}
		.modal-header {
			border-bottom:none;
			border-top-left-radius:0;
			border-top-right-radius:0;
			background-color: #307bd3;
			color: #fff;
		}
		.modal-content {
			border-radius:0;	
		}
		
		
		/* tabs */
nav > div a.nav-item.nav-link,
nav > div a.nav-item.nav-link.active
{
  border: none;
    padding: 10px 15px;
    color:#212528;
    background:none;
    border-radius:0;
    font-size:15px;
    font-weight:500;
}
nav > div a.nav-item.nav-link.active:after
 {
  content: "";
  position: relative;
  bottom: -46px;
  left: -10%;
  border: 15px solid transparent;
  border-top-color: #ddd ;
}
.tab-content{
    line-height: 25px;
    padding:30px 25px;
}

nav > div a.nav-item.nav-link:hover,
nav > div a.nav-item.nav-link:focus
{
  border: none;
    background: none;
    color:#212528;
    border-radius:0;
    transition:background 0.20s linear;
}
		/* tabs end */
		
		
/* Toggle */
.switchToggle input[type=checkbox]{height: 0; width: 0; visibility: hidden; position: absolute; }
.switchToggle label {cursor: pointer; text-indent: -9999px; width: 70px; max-width: 70px; height: 30px; background: #d1d1d1; display: block; border-radius: 100px; position: relative; }
.switchToggle label:after {content: ''; position: absolute; top: 2px; left: 2px; width: 26px; height: 26px; background: #fff; border-radius: 90px; transition: 0.3s; }
.switchToggle input:checked + label, .switchToggle input:checked + input + label  {background: #4caf50a6; }
.switchToggle input + label:before, .switchToggle input + input + label:before {content: 'No'; position: absolute; top: 1px; left: 35px; width: 26px; height: 26px; border-radius: 90px; transition: 0.3s; text-indent: 0; color: #fff; }
.switchToggle input:checked + label:before, .switchToggle input:checked + input + label:before {content: 'Yes'; position: absolute; top: 1px; left: 10px; width: 26px; height: 26px; border-radius: 90px; transition: 0.3s; text-indent: 0; color: #fff; }
.switchToggle input:checked + label:after, .switchToggle input:checked + input + label:after {left: calc(100% - 2px); transform: translateX(-100%); }
.switchToggle label:active:after {width: 60px; } 
.toggle-switchArea { margin: 10px 0 10px 0; }
/* Toggle end */
		/*leaves balance bar*/
.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.chat_img {
  float: left;
  width: 11%;
}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}

.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}
img{ max-width:140%;}

.row.vdivide [class*='col-']:not(:last-child):after {
  background: #e0e0e0;
  width: 1px;
  content: "";
  display:block;
  position: absolute;
  top:0;
  bottom: 0;
  right: 0;
  min-height: 70px;
}
/*leaves balance bar end*/
.dropdown-toggle::after {
            content: none;
            display: none;
        }
		
/*corousol*/	
.carousel-control-next, .carousel-control-prev {
   
    width: 2%;
   
}
.carousel-control-next-icon, .carousel-control-prev-icon {
    height: 40px;
    background-color: #ccc;
}
	
/*corousol end*/		
		
</style>
</head>
<body>
<div class="container">

              <div class="row">
                <div class="col-sm-12 ">
				<div class="row">
                    <div class="col-md-12"><h4>Leave Managment</h4></div>
                </div>

<?php
	if($this->session->userdata('UserType') != SUPERADMIN){ ?>
				<div class="row mt-3">
                    <div class="col-md-12"><h6>Leave Balance</h6></div>
                </div>
				<div class="row shadow-sm p-3 mb-4 bg-white rounded vdivide">
                    
					<!-- <div class="col-sm-3">
					<div class="chat_people">
					<div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
					<div class="chat_ib">
					  <h4>Admin Name(You)</h4>
					  <p>Emp45698</p>
					</div>
					</div>
					</div> -->
					
		<div class="col-sm-12">	
			<div id="recipeCarousel" class="carousel slide w-100" data-ride="">
        <div class="carousel-inner w-100" role="listbox">
        	<?php
        		$balance = json_decode($balance);
        		for($i=0;$i<count($balance->balance);$i+=3){ ?>
            <div class="carousel-item row no-gutters <?php if($i == 0) echo 'active';?>">
        	<?php 
        		$var = 0;
        		while($var < 3){ 
        			if($var+$i < count($balance->balance)){
    			?>
                 <div class="col-4 float-left">
					<div class="text-center">
						<div class="c100 p12 small green">
							<span><?php echo $balance->balance[$i + $var]->closingBalance;?></span>
							<div class="slice">
								<div class="bar"></div>
								<div class="fill"></div>
							</div>
						</div>
						<p><?php echo $balance->balance[$i + $var]->leaveName;?></p>
						<small> <i class="far fa-circle rounded-circle" style=";background-color:green;color:green;"></i> Used Leaves</small><br>
						<small> <i class="far fa-circle rounded-circle" style=";background-color:#ccc;color:#ccc;"></i> Balance Leaves</small>
					</div>
				</div> 
			<?php 
				}	
				$var++;
			}?>
            </div>
        	<?php }?>

        </div>
        <!-- <a class="carousel-control-prev" href="#recipeCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a> -->
        <a class="carousel-control-next" href="#recipeCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    		</div>

					
					
                </div>
                </div>
<?php }?>

                 <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">

	              <?php
	              	if($this->session->userdata('UserType') != STAFF && $this->session->userdata('UserType') != SUPERADMIN){ ?>
                      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Leave Approvals</a>
                  <?php }?>
                     
                  	<a class="nav-item nav-link <?php if($this->session->userdata('UserType') == STAFF || $this->session->userdata('UserType') == SUPERADMIN) echo 'active';?>" id="nav-contact-tab1" data-toggle="tab" href="#nav-contact1" role="tab" aria-controls="nav-contact" aria-selected="false">My Leave Requests</a>
					  
	              <?php
	              	if($this->session->userdata('UserType') == SUPERADMIN){ ?>
				  	<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Manage Leave Type</a>
					<?php }?>
                     
                    </div>
                  </nav>
        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
          	<?php
          	if($this->session->userdata('UserType') != STAFF && $this->session->userdata('UserType') != SUPERADMIN){ ?>
				<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
	              	<div class="card">
	                <div class="card-header">
					<div class="row">
	                </div>
	                </div>

	                <div class="card-body">
	                    <table class="table table-striped table-borderless table-hover border-shadow" id="example1" style="width:100%;">
	                        <thead>
	                            <tr class="text-muted">
	                            <th>Emp. Name</th>
	                            <th>Emp. Designation</th>
	                            <th>Start Date </th>
	                            <th>End Date</th>
	                            <th>Leave Type</th>
	                            <th>Reason</th>
	                            <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        	<?php
	                        		$leaveRequests = json_decode($leaveRequests);
	                        		foreach ($leaveRequests->leaves as $leave) { 
	                        			if($leave->userid != $this->session->userdata('LoginId')){ 
                        			?>
									<tr>
										<td><?php echo $leave->name;?></td>
										<td><?php echo $leave->title;?></td>
										<td>
											<?php 
												$date = date_create($leave->startDate);
												echo date_format($date,"d/m/Y");
											?>
										</td>
										<td>
											<?php 
												$date = date_create($leave->endDate);
												echo date_format($date,"d/m/Y");
											?>
										</td>
										<td><?php echo $leave->leaveTypeName;?></td>
										<td>
										<div class="dropdown">
		                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                                        <i class="far fa-file-alt"></i>
		                                    </button>
		                                    <div class="dropdown-menu dropdown-menu-right p-3 " aria-labelledby="gedf-drop1">
		                                        <p><?php echo $leave->notes;?></p>
		                                    </div>
		                                </div>
										</td>
										<td>
										<?php 
											if($leave->status == "Applied"){ ?>
												<div onclick="updateLeaveApp('<?php echo $leave->id;?>','2')">
													<i class="far fa-check-circle" style="color:green;font-size:18px;"></i>
												</div>
												<div onclick="updateLeaveApp('<?php echo $leave->id;?>','3')">
													<i class="far fa-times-circle" style="color:red;font-size:18px;margin-left:10px;"></i>
												</div>
										<?php }
											else{
												$color = $leave->status == "Approved" ? '#4CAF50' : '#F44336'; ?>
												<span style="color: <?php echo $color;?>;">
													<?php echo $leave->status;?>
												</span>
												<?php
											}
										?>
										</td>
									</tr>
								<?php }}?>
								
	                        </tbody>
	                    </table>

	                </div>

	            	</div>
	      		</div>
	      	<?php }?>

              
				  <div class="tab-pane fade <?php if($this->session->userdata('UserType') == STAFF || $this->session->userdata('UserType') == SUPERADMIN) echo 'show active';?>" id="nav-contact1" role="tabpanel" aria-labelledby="nav-home-tab">
	                  	<div class="card">
			                <div class="card-header">
							<div class="row">
			                    <div class="col-md-6"></div>
								<div class="col-md-6 text-right">
									<?php 
									if($this->session->userdata('UserType') != SUPERADMIN){ ?>
										<button type="button" name="apply_button" id="apply_button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-plus-circle"></i> Apply Leave</button>
									<?php }?>
								</div>
			                </div>
			                </div>
			                <div class="card-body">
			                    <table class="table table-striped table-borderless table-hover border-shadow" id="example3" style="width:100%;">
			                        <thead>
			                            <tr class="text-muted">
	                            	<?php
	                            		if($this->session->userdata('UserType') == SUPERADMIN){ ?>
			                            <th>Emp Name</th>
			                            <th>Emp Designation</th>
			                        <?php }?>
			                            <th>Leave Type</th>
			                            <th>Start Date</th>
			                            <th>End Date </th>
			                            <th>Reason</th>
			                            <th>Applied Date</th>
			                            <th>Status</th>
			                            </tr>
			                        </thead>
			                        <tbody>
			                        	<?php 
			                        	$leaves = json_decode($leaves);
			                        	foreach ($leaves->leaves as $l) { ?>
										<tr>
	                            		<?php
	                            			if($this->session->userdata('UserType') == SUPERADMIN){ ?>
											<td><?php echo $l->name;?></td>
											<td><?php echo $l->title;?></td>
			                       		<?php }?>
											<td><?php echo $l->leaveTypeSlug;?></td>
											<td><?php
												$date = date_create($l->startDate);
												echo date_format($date,"d/m/Y");?></td>
											<td><?php
												$date = date_create($l->endDate);
												echo date_format($date,"d/m/Y");?></td>
											<td>
											<div class="dropdown">
			                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                                        <i class="far fa-file-alt"></i>
			                                    </button>
			                                    <div class="dropdown-menu dropdown-menu-right p-3 " aria-labelledby="gedf-drop1">
			                                        <p><?php echo $l->notes;?></p>
			                                    </div>
			                                </div>
											</td>
											<td><?php
												$date = date_create($l->appliedDate);
												echo date_format($date,"d/m/Y");?></td>
												<?php
													$color = '#F44336';
													if($l->status == "Applied") $color = '#9E9E9E';
													else if($l->status == "Approved") $color = '#4CAF50';
												?>
											<td style="color:<?php echo $color;?>;"><?php echo $l->status;?></td>
											
											
										</tr>
									<?php }?>
										
			                        </tbody>
			                    </table>
			                </div>

			            </div>
			      </div>
              
          	<?php
          		if($this->session->userdata('UserType') == SUPERADMIN){ ?>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
						<div class="card-header">
							<div class="row">
	                    <div class="col-md-6"></div>
						<div class="col-md-6 text-right">
						<button type="button" name="add_button" id="add_button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"  onclick="addLeaveType()"> <i class="fas fa-plus-circle"></i> Add Leave Type</button>
						</div>
		                </div>
		                </div>
	                  	<div class="card-body">
		                    <table class="table table-striped table-borderless table-hover border-shadow" id="example2" style="width:100%;">
		                        <thead>
		                            <tr class="text-muted">
		                            <th>S.No</th>
		                            <th>Leave Name</th>
		                            <th>Leave Slug</th>
		                            <th>Is Paid</th>
		                            <th>Action</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                        	<?php
		                        	$leaveType = json_decode($leaveType);
		                        	$var = 0;
		                        	foreach ($leaveType->leaveTypes as $leaveType) { 
		                        		$var++;
		                    		?>
									<tr>
										<td><?php echo $var;?></td>
										<td id="<?php echo $leaveType->id.'name';?>"><?php echo $leaveType->name;?></td>
										<td id="<?php echo $leaveType->id.'slug';?>"><?php echo $leaveType->slug;?></td>
										<td id="<?php echo $leaveType->id.'isPaidYN';?>"><?php echo $leaveType->isPaidYN;?></td>
										<td>
										<span onclick="editLeaveType('<?php echo $leaveType->id;?>')">
										<a href="#" title="Edit"><i class="far fa-edit" style="color:green;font-size:18px;"></i></a>
										</td>
									</tr>
									<?php }?>
									
		                        </tbody>
		                    </table>
	                	</div>
                    </div>
                <?php }?>
                    
                  </div>
                
                </div>
              </div>
        </div>
    
 <!-- apply leave modal start here -->
            <div class="modal fade" id="applyModal">
                <div class="modal-dialog">
                    
					<form id="applyLeaveForm" action="<?php echo base_url().'leave/applyLeave';?>" method="POST">
					<div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" >Leave Apply</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                <div class="modal-body">						
					<div class="col-md-12 col-xl-12">
							<div class="row">
								<div class="col-md-12">
									<div class="md-form">
									<label>Leave Type</label>
										<select class="form-control" id="applyLeaveId" name="applyLeaveId" required >
										  <option value="" selected disabled>Select Leave Type </option>
											<?php 
												foreach ($balance->balance as $bal) { ?>
										  <option value="<?php echo $bal->leaveTypeId;?>"><?php echo $bal->leaveName;?></option>
											<?php }?>
										</select>
									</div>
								</div>
							</div>
							<span style="color: red" id="applyLeaveIdError"></span>
							<div class="row">
								<div class="col-md-6">
									<div class="md-form">
										<label>Start Date</label>
										<div class="input-group date" id="datetimepicker12" data-target-input="nearest">
										<input type="text" name="applyLeaveFromDate" id="applyLeaveFromDate" class="form-control datetimepicker-input" data-target="#datetimepicker12"  />
										<div class="input-group-append" data-target="#datetimepicker12" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="md-form">
									<label>End Date</label>
									<div class="input-group date" id="datetimepicker13" data-target-input="nearest">
                                    <input type="text" name="applyLeaveToDate" id="applyLeaveToDate" class="form-control datetimepicker-input" data-target="#datetimepicker13"  />
                                    <div class="input-group-append" data-target="#datetimepicker13" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
									</div>
									</div>
								</div>
							</div>
							<span style="color: red" id="applyLeaveDateError"></span>
								
									<div class="md-form">
										<label for="message">Leave Reason</label>
										<textarea id="applyLeaveNotes" name="applyLeaveNotes" class="form-control" placeholder="Reason" ></textarea>
										
									</div>	
						</div>	
					</div>
					<div class="text-center mt-2 mb-4">
						<button class="btn btn-secondary rounded-0" type="button" onclick="applyLeave()">Apply</button>
					</div>
                    </div>
					</form>
                </div>
            </div>
            <!-- modal end here -->       
<!-- modal start here -->
            <div class="modal fade" id="userModal">
                <div class="modal-dialog">
                    
					<form id="leaveTypeForm" action="<?php echo base_url().'leave/addLeaveType';?>" method="POST">
					<div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Leave Type</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                <div class="modal-body">
					<div class="col-md-12 col-xl-12">	
					<form id="leaveType" method="POST" action="<?php echo base_url().'leave/addLeave';?>">
						<input type="hidden" name="leaveId" id="leaveId" value="">

						<div class="form-group">
						  <label>New Leave Type</label>
						  <input type="text" class="form-control" id="leaveName" placeholder="Enter leave name" name="leaveName" >
						  <span id="new_leave_type_error" class="text-danger"></span>
						</div>

						<span style="color: red" id="leaveNameError"></span>
						 
						<div class="form-group">
							<label>Slug</label>
							<input type="text" class="form-control" name="leaveSlug" id="leaveSlug" placeholder="slug"  >
						  <span id="slug_error" class="text-danger"></span>
						</div>
						<span style="color: red" id="leaveSlugError"></span>
						
						<div class="form-group">
						<label for="leaveIsPaid">IsPaid</label><br>
						<div class="outerDivFull" >
						<div class="switchToggle">
						<!--dont rename id="switch"-->
							<input type="checkbox" id="switch" name="leaveIsPaid">
							<label for="switch">Toggle</label>
						</div>
						</div>
						</div>
						<div class="form-group text-center" id="updateLeaveType" style="display: none;">
						<button class="btn btn-secondary rounded-0" type="button" onclick="addLeave()">Update</button>
						<button class="btn btn-danger rounded-0" type="button" onclick="deleteLeave()">Delete</button> 
						</div>
						<div class="form-group text-center" id="addLeaveType" style="display: block;">
						<button class="btn btn-secondary rounded-0" type="button" onclick="addLeave()">Add</button>
						</div>
				  </form>	
					</div>
					</div>
					
                    </div>
					</form>
                </div>
            </div>
            <!-- modal end here -->


</body>
<script type="text/javascript" language="javascript" >
	$('#datetimepicker12').datetimepicker({
                defaultDate: new Date(),
                format: 'DD-MM-YYYY'
    });
	$('#datetimepicker121').datetimepicker({
                defaultDate: new Date(),
                format: 'DD-MM-YYYY'
    });
    $('#datetimepicker13').datetimepicker({
                defaultDate: new Date(),
                //format: 'YYYY-MM-DD hh:mm:ss A'
                format: 'DD-MM-YYYY'
    });
	$('#datetimepicker131').datetimepicker({
                defaultDate: new Date(),
                //format: 'YYYY-MM-DD hh:mm:ss A'
                format: 'DD-MM-YYYY'
    });
	$('#apply_button').click(function(){
        
        $('#applyModal').modal('show');
    });
</script>
<script>
	$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});

	</script>


	<script type="text/javascript">
		var base_url = "<?php echo base_url();?>";

		function editLeaveType(leaveId){
			document.getElementById("leaveId").value = leaveId;
			document.getElementById("leaveName").value = document.getElementById(leaveId+"name").innerHTML;
			document.getElementById("leaveSlug").value = document.getElementById(leaveId+"slug").innerHTML;
			document.getElementById("switch").checked = document.getElementById(leaveId+"isPaidYN").innerHTML == "Y";
			document.getElementById("updateLeaveType").style.display = "block";
			document.getElementById("addLeaveType").style.display = "none";
			jQuery(function($) {
		        $("#userModal").modal('show');
		    });
		}

		function addLeaveType(){
			document.getElementById("leaveName").value =  "";
			document.getElementById("leaveSlug").value = "";
			document.getElementById("switch").checked = true;
			document.getElementById("updateLeaveType").style.display = "none";
			document.getElementById("addLeaveType").style.display = "block";
			jQuery(function($) {
		        $("#userModal").modal('show');
		    });
		}

		function addLeave(){
			var leaveName = document.getElementById("leaveName").value.trim();
			if(leaveName == ""){
				document.getElementById("leaveNameError").innerHTML = "Required field";
			}
			var leaveSlug = document.getElementById("leaveSlug").value.trim();
			if(leaveSlug == ""){
				document.getElementById("leaveSlugError").innerHTML = "Required field";
			}

			if(leaveName != "" && leaveSlug != ""){
				document.getElementById("leaveTypeForm").submit();
			}

		}

		function deleteLeave(){
			document.getElementById("leaveTypeForm").action = "<?php echo base_url();?>" + 'leave/deleteLeaveType';
			document.getElementById("leaveTypeForm").submit();
		}

		function updateLeaveApp(leaveId,status){
			console.log(leaveId);
			var data = 'leaveId='+leaveId+'&status='+status;
		    var params = typeof data == 'string' ? data : Object.keys(data).map(
		        function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
		    ).join('&');
			var xhr = new XMLHttpRequest();
			xhr.open('POST', base_url+"leave/updateLeaveApp");
		    xhr.onreadystatechange = function() {
		        if (xhr.readyState>3 && xhr.status==200) { 
		        	location.reload();
		        }
		    };
		    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
		    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		    xhr.send(params);
		}

		function applyLeave(){
			var leaveId = document.getElementById("applyLeaveId").value;
			var startDate = document.getElementById("applyLeaveFromDate").value;
			var endDate = document.getElementById("applyLeaveToDate").value;
			var notes = document.getElementById("applyLeaveNotes").value;
			console.log(leaveId);
			console.log(startDate);
			console.log(endDate);
			console.log(notes);
			if(leaveId == ""){
				document.getElementById("applyLeaveIdError").innerHTML = "Select a leave type";
			}
			else{
				document.getElementById("applyLeaveIdError").innerHTML = "";
			}
			if(endDate < startDate){
				document.getElementById("applyLeaveDateError").innerHTML = "End date cannot be less than start date";
			}
			else{
				document.getElementById("applyLeaveDateError").innerHTML = "";
			}
			if(leaveId != "" && endDate>startDate){
				document.getElementById("applyLeaveForm").submit();
			}
		}

	</script>
</html>