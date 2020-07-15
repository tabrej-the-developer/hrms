<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header'); ?>
<title>Leaves</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<style type="text/css">
	*{
font-family: 'Open Sans', sans-serif;
	}
	.containers{
		background:	rgb(243, 244, 247);
		height: calc(100vh);
	}
  
		.leave-heading{
			font-size: 1.75rem;
			font-weight: bolder
		}
        .card-header {
            padding: 0.2rem 1.25rem;
            /* margin-bottom: 0; */
            background-color: transparent;
            border-bottom: 0px;
        }
        .card{
        	background-color: transparent;
        }
        .sort-by{
        	margin:0 0 0 2rem !important;
        }
        .card-body {
            padding: 0;
            height:75vh;
        }
        
        p {
            margin-top: 0;
            margin-bottom: 10px;
        }
        .balance-tile{
        	padding: 0 2rem !important;
        	position: relative;
        }
        .balance-tile-div{
        	height: 8rem;
			    background: rgba(0,0,255,0.6);
			    border-radius: 5px;
			    color: white;
			    position: relative;
        }
        .leave-name{
        	width: 100%;
    			display: inline-block;
        	text-align: left;
        }
        .leave-balance{
        	position: absolute;
        	bottom: 0;
        	text-align: right;
        	width: 100%
        }
        .leave-balance:before{
        	content: 'Hrs : ';
        	color: white;
        }

        .cardContainer {
				  display: flex;
				  justify-content: center;
				}
				.cardItem {
				  text-align: center;
				  transition: all 500ms ease-in-out;
				}
				.cardItem:hover {
					  cursor: pointer;
					  box-shadow: 0px 12px 30px 0px rgba(0, 0, 0, 0.2);
					  transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
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

        .nav-tabs{
        	border-bottom: none;
        }
        .heading-leave-approval{
        	display: flex;
        	justify-content: flex-start;
        	color: black;
        	font-weight: bolder;
        	font-size: 1.5rem
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
			    box-shadow: 0;

		}
		.no-gutters > div{
			display: inline-block !important;
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
	.row{
		margin-right: 0px;
   		margin-left: 0px;
	}
		
		/* tabs */


.tab-content{
    line-height: 25px;
    padding:0 !important;
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

 /* Data Tables */
     select{
	background: #ebebeb;
	border-radius: 5px;
    padding: 5px;
    border: 2px solid #e9e9e9 !important;
		}
.dataTables_wrapper {
	height:95%;
	overflow-y: hidden;
	background: white;
	box-shadow: 0 0 4px 1px rgba(0,0,0,0.1);
}
table.dataTable tbody th, table.dataTable tbody td{
	padding:1rem;
	border-bottom: none;
}
table.dataTable thead th, table.dataTable thead td {
    padding: 1rem;
    border-bottom: none;
}
table.dataTable.no-footer{
	border-bottom: none
}
table.dataTable{
	margin-top: 0 !important;
	margin-bottom: 0 !important;
}
	.dataTables_paginate span .paginate_button{
		background:none !important;
		border:none !important;
		border-color: transparent;
	}
	.dataTables_paginate{
		position: fixed;
		bottom: 0;
		right: 0
	}
 /* Data Tables */
/*corousel*/	
.carousel-control-next, .carousel-control-prev {
   
    width: 2%;
   
}
.carousel-control-next-icon, .carousel-control-prev-icon {
    height: 40px;
    background-color: #ccc;
}
	
/*corousel end*/		
		

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
    @media only screen and (max-width:600px){
    	.col-sm-12{
    		padding-left: 0 !important;
    		padding-right: 0 !important;
    	}
    }

</style>
</head>
<body>
<div class="containers">

  <div class="row">
    <div class="col-sm-12 ">
		<div class="row d-flex pt-3">
	    <div class="ml-2"><span class="leave-heading">Leave Management</span></div>
	    	<div class="btn sort-by m-3 <?php if($this->session->userdata('UserType') == ADMIN) {echo "ml-auto"; }?>">
		<?php if($this->session->userdata('UserType') == SUPERADMIN){?> 
			<!-- 			<div class="filter-icon d-flex">
				<span class="">Sort&nbsp;by</span>
				<span class=""><img src="../assets/images/filter-icon.png" height="20px"></span>
			</div> -->

			<select class="center-list " id="center-list">
				<?php $centers = json_decode($centers);	
					for($i=0;$i<count($centers->centers);$i++){
				?>
			<option href="javascript:void(0)" class="center-class" id="<?php echo $centers->centers[$i]->centerid ?>" value="<?php echo $centers->centers[$i]->centerid; ?>"><?php echo $centers->centers[$i]->name?></option>
		<?php } ?>
		</select>	
				<?php } ?>
	</div>
	    </div>

<?php
	if($this->session->userdata('UserType') != SUPERADMIN){ ?>
				<div class="row mt-3">
                    <div class="col-md-12"><h6>Leave Balance</h6></div>
                </div>
				<div class="row shadow-sm mb-4 bg-white rounded vdivide">
                    
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
        		// print_r($balance);
        		$balance = json_decode($balance);
        		// var_dump($balance);
        		for($i=0;$i<count($balance->balance);$i+=3){ ?>
            <div class="carousel-item row no-gutters  <?php if($i == 0) echo 'active';?>">
        	<?php 
        		$var = 0;
        		while($var < 3){ 
        			if($var+$i < count($balance->balance)){
    			?>
         <div class="col-md-4 balance-tile cardContainer">
         	<div class="balance-tile-div cardItem">
							<div class="leave-name"><?php echo $balance->balance[$i + $var]->leaveName;?></div>
							<div class="leave-balance"><?php echo sprintf('%.2f',$balance->balance[$i + $var]->leavesRemaining);?></div>
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
                    <div class="nav  nav-fill" id="nav-tab" >

	              <?php
	              	if($this->session->userdata('UserType') != STAFF && $this->session->userdata('UserType') != SUPERADMIN){ ?>
                      <a class="nav-item nav-link heading-leave-approval" >Leave Approvals</a>
                  <?php }?>
                     
                  	<!-- <a class="nav-item nav-link <?php if($this->session->userdata('UserType') == STAFF || $this->session->userdata('UserType') == SUPERADMIN) echo 'active';?>" id="nav-contact-tab1" data-toggle="tab" href="#nav-contact1" role="tab" aria-controls="nav-contact" aria-selected="false">My Leave Requests</a> -->
					  

                     
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
	                        	// print_r($leaveRequests);
	                        		$leaveRequests = json_decode($leaveRequests);
	                        		foreach ($leaveRequests->leaves as $leave) { 

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
										<td class="d-flex">
										<?php 
							if($leave->userid == $this->session->userdata('LoginId')){
								echo $leave->status;
							}else{
											if($leave->status == "Applied"){ 

												?>
												<div onclick="updateLeaveApp('<?php echo $leave->id;?>','2')" class="pr-1">
													<img src="<?php echo base_url("assets/images/accept.png"); ?>" style="max-width:1.3rem;cursor: pointer" />
												</div>
												<div onclick="updateLeaveApp('<?php echo $leave->id;?>','3')" class="pl-1">
													<img src="<?php echo base_url("assets/images/deny.png"); ?>"  style="max-width:1.3rem;cursor: pointer">
												</div>
										<?php }
											else{
												$color = $leave->status == "Approved" ? '#4CAF50' : '#F44336'; ?>
												<span style="color: <?php echo $color;?>;">
													<?php echo $leave->status;?>
												</span>
												<?php
											}}
										?>
										</td>
									</tr>
								<?php }?>
								
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
	                            		if($this->session->userdata('UserType') == SUPERADMIN ){ ?>
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
			                        	if(isset($leaves)){
			                        	$leaves = json_decode($leaves);
			                        	foreach ($leaves->leaves as $l) { ?>
										<tr>
	                            		<?php
	                            			if($this->session->userdata('UserType') == SUPERADMIN || $this->session->userdata('UserType') == ADMIN ){ ?>
											<td><?php echo $l->name;?></td>
								<?php if($l->title != "Centre Manager"){ ?>
											<td><?php echo $l->title;?></td>
			                       		<?php } else {echo "<td>--</td>";} }?>
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
											<td class="d-flex">
										<?php 
							if($l->userid == $this->session->userdata('LoginId')){
								echo $l->status;
							}else{
											if($l->status == "Applied"){ 

												?>
												<div onclick="updateLeaveApp('<?php echo $l->id;?>','2')" class="pr-1">
													<img src="<?php echo base_url("assets/images/accept.png"); ?>" style="max-width:1.3rem;cursor: pointer" />
												</div>
												<div onclick="updateLeaveApp('<?php echo $l->id;?>','3')" class="pl-1">
													<img src="<?php echo base_url("assets/images/deny.png"); ?>"  style="max-width:1.3rem;cursor: pointer">
												</div>
										<?php }
											else{
												$color = $l->status == "Approved" ? '#4CAF50' : '#F44336'; ?>
												<span style="color: <?php echo $color;?>;">
													<?php echo $l->status;?>
												</span>
												<?php
											}}
										?>
										</td>
											
											
										</tr>
									<?php } }?>
										
			                        </tbody>
			                    </table>
			                </div>

			            </div>
			      </div>
              

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
                            <h5 class="modal-title" >Apply Leave</h5>
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
									<?php // $balance = json_decode($balance) ?>
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
		<div class="row">
			<div class="col-md-12">
				<div class="md-form">
					<label>Total leave hours</label>
				<span class="row pl-5">
					<select name="total-leave-hours" id="total-leave-hours">
						<?php
						for($v = 0; $v < 10; $v+=0.5){
						?>
						<option value="<?php echo $v;?>"><?php echo $v; ?></option>
						<?php
							}
						?>
					</select>
				</span>		
				</div>
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

 <div class="modal-logout">
      <div class="modal-content-logout">
          <h3>You have been logged out!!</h3>
          <h4><a href="<?php echo base_url(); ?>">Click here</a> to login</h4>
          
      </div>
  </div>

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
			console.log(leaveId+" "+status);
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
			var hours = document.getElementById("total-leave-hours").value;
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
			var url = window.location.origin+"/PN101/leave/applyLeave";
			$.ajax({
				url : url,
				data : {
					applyLeaveId : leaveId,
					applyLeaveFromDate : startDate,
					applyLeaveToDate : endDate,
					applyLeaveNotes : notes,
					total_leave_hours : hours 
				},
				success:function(){
					window.location.reload();
				}
			})
		}
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on('change','.center-list',function(){
			var val = $(this).val();
			if(val == null || val == ""){
				val=1;
			}
		var url = "<?php echo base_url();?>leave?center="+val;
		$.ajax({
			url:url,
			type:'GET',
			success:function(response){
				$('tbody').html($(response).find('tbody').html());
					}
				});
			});
		})
	</script>
<script type="text/javascript">
	$(document).ready(()=>{
    $('.containers').css('paddingLeft',$('.side-nav').width());
});
</script>
<?php if( isset($error) != null){ ?>
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
else{

};
?>
<script type="text/javascript">
	  $(document).ready( function () {
		    $('table').dataTable({
		     pageLength:7,
		     ordering : false,
		     select: false,
		     searching : false
		    });
		} );
</script>
<script type="text/javascript">
	$(document).ready(function(){
			$('.dataTables_length').remove()
			$('.dataTables_info').remove()
			$('#ui-datepicker-div').hide()
			$('.table-div').css('maxWidth','100vw')
		})
</script>
</html>
