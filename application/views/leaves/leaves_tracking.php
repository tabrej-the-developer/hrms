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
			background-color: #17a2b8;
			color: #fff;
		}
		.modal-content {
			border-radius:0;	
		}
		.modal-footer {
			border-top:0;
			border-bottom-right-radius:0;
			border-bottom-left-radius:0;
		}
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
.dropdown-toggle::after {
            content: none;
            display: none;
        }
</style>
</head>
<body>


<div class="container">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
				<div class="row">
                    <div class="col-md-6"><h4>Leave Managment</h4></div>
					<div class="col-md-6 text-right">
						<button type="button" name="create_leave_button" id="create_leave_button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-plus-circle"></i> Add Leave Type</button>
					</div>
                </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-borderless table-hover border-shadow" id="example" style="width:100%;">
                        <thead>
                            <tr class="text-muted">
                            <th>Emp.ID</th>
                            <th>Emp Name</th>
                            <th>Leave Type</th>
                            <th>Start Date</th>
                            <th>End Date </th>
                            <th>Days</th>
                            <th>Reason</th>
                            <th>Request To</th>
                            <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
							<tr>
								<td>54651</td>
								<td>James</td>
								<td>Casual leave</td>
								<td>2011/04/26</td>
								<td>2011/04/25</td>
								<td>2</td>
								<td>
								<div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="far fa-file-alt"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right p-3 " aria-labelledby="gedf-drop1">
                                        <p>leave reason goes here ...</p>
                                    </div>
                                </div>
								</td>
								<td>Manager</td>
								<td style="color:#05b223;">Approved</td>
								
								
							</tr>
							<tr>
								<td>24234</td>
								<td>Samuel</td>
								<td>martin leave</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
								<td>2</td>
								<td>
								<div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="far fa-file-alt"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right p-3 " aria-labelledby="gedf-drop1">
                                        <p>leave reason goes here ...</p>
                                    </div>
                                </div>
								</td>
								<td>Manager</td>
								<td style="color:#ef0a0a;">Rejected</td>
							</tr>
							<tr>
								<td>3545</td>
								<td>mahesh</td>
								<td>clark</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
								<td>2</td>
								<td>
								<div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="far fa-file-alt"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right p-3 " aria-labelledby="gedf-drop1">
                                        <p>leave reason goes here ...</p>
                                    </div>
                                </div>
								</td>
								<td>Manager</td>
								<td style="color:#ef0a0a;">Rejected</td>
							</tr>
							<tr>
								<td>45454</td>
								<td>john doe</td>
								<td>Casual leave</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
								<td>2</td>
								<td>
								<div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="far fa-file-alt"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right p-3 " aria-labelledby="gedf-drop1">
                                        <p>leave reason goes here ...</p>
                                    </div>
                                </div>
								</td>
								<td>Manager</td>
								<td style="color:#e97613;">pending</td>
							</tr><tr>
								<td>56767</td>
								<td>michel</td>
								<td>Casual leave</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
								<td>2</td>
								<td>
								<div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="far fa-file-alt"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right p-3 " aria-labelledby="gedf-drop1">
                                        <p>leave reason goes here ...</p>
                                    </div>
                                </div>
								</td>
								<td>Manager</td>
								<td style="color:#ef0a0a;">Rejected</td>
							</tr><tr>
								<td>6767</td>
								<td>jack sparrow</td>
								<td>Casual leave</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
								<td>2</td>
								<td>
								<div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="far fa-file-alt"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right p-3 " aria-labelledby="gedf-drop1">
                                        <p>leave reason goes here ...</p>
                                    </div>
                                </div>
								</td>
								<td>Manager</td>
								<td style="color:#e97613;">pending</td>
							</tr><tr>
								<td>7346</td>
								<td>Emmanual</td>
								<td>Casual leave</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
								<td>2</td>
								<td>
								<div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="far fa-file-alt"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right p-3 " aria-labelledby="gedf-drop1">
                                        <p>leave reason goes here ...</p>
                                    </div>
                                </div>
								</td>
								<td>Manager</td>
								<td style="color:#ef0a0a;">Rejected</td>
							</tr><tr>
								<td>8345</td>
								<td>karan</td>
								<td>Casual leave</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
								<td>2</td>
								<td>
								<div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="far fa-file-alt"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right p-3 " aria-labelledby="gedf-drop1">
                                        <p>leave reason goes here ...</p>
                                    </div>
                                </div>
								</td>
								<td>Manager</td>
								<td style="color:#e97613;">pending</td>
							</tr><tr>
								<td>93454</td>
								<td>sam</td>
								<td>Casual leave</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
								<td>2</td>
								<td>
								<div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="far fa-file-alt"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right p-3 " aria-labelledby="gedf-drop1">
                                        <p>leave reason goes here ...</p>
                                    </div>
                                </div>
								</td>
								<td>Manager</td>
								<td style="color:#05b223;">Approved</td>
							</tr><tr>
								<td>1350</td>
								<td>john</td>
								<td>Casual leave</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
								<td>2</td>
								<td>
								<div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="far fa-file-alt"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right p-3 " aria-labelledby="gedf-drop1">
                                        <p>leave reason goes here ...</p>
                                    </div>
                                </div>
								</td>
								<td>Manager</td>
								<td style="color:#e97613;">pending</td>
							</tr>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

    </div>
 
<!-- modal start here -->
            <div class="modal fade" id="userModal">
                <div class="modal-dialog">
                    
					<form id="user_form" name="" action="" method="POST">
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
										<select class="form-control" id="leave_type" name="leave_type" required >
										  <option value="" selected disabled>Select Leave Type </option>
										  <option value="casual leave">Casual Leave</option>
										  <option value="sick leave">Sick Leave</option>
										  <option value="emergency leave">Emergency Leave</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="md-form">
										<label>Start Date</label>
										<div class="input-group date" id="datetimepicker12" data-target-input="nearest">
										<input type="text" name="from_date" id="from_date" class="form-control datetimepicker-input" data-target="#datetimepicker12"  />
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
                                    <input type="text" name="to_date" id="to_date" class="form-control datetimepicker-input" data-target="#datetimepicker13"  />
                                    <div class="input-group-append" data-target="#datetimepicker13" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
									</div>
									</div>
								</div>
							</div>
								
									<div class="md-form">
										<label for="message">Leave Reason</label>
										<textarea id="reason" name="reason" class="form-control" placeholder="Reason" ></textarea>
										
									</div>
								
								
									<div class="md-form">
										<label for="message">Reports To</label>
										<select class="form-control" id="reports_to" name="reports_to"  >
										  <option value="" selected disabled>Select Reports To </option>
										  <option value="admin">Admin</option>
										  <option value="manager">Manager</option>
										  <option value="supervisor">Supervisor</option>
										</select>
									</div>
								
							
						
						
						</div>	
					</div>
					<div class="text-center mt-2 mb-4">
						<button class="btn btn-secondary" type="button" >Apply</button>
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button> 
					</div>
                    </div>
					</form>
                </div>
            </div>
            <!-- modal end here -->
			
			<!--Reports modal start here -->
            <div class="modal fade" id="ReportsModal">
                <div class="modal-dialog">
                    
					<form id="user_form" name="" action="" method="POST">
					<div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" >Download Leave Report</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                <div class="modal-body">						
					<div class="col-md-12 col-xl-12">
							<div class="row">
								<div class="col-md-12">
									<div class="md-form">
									<label>Leave Reports</label>
										<select class="form-control" id="leave_type" name="leave_type" required >
										  <option value="" selected disabled>Select Leave Type </option>
										  <option value="casual leave">Casual Leave</option>
										  <option value="sick leave">Sick Leave</option>
										  <option value="emergency leave">Emergency Leave</option>
										</select>
									</div>
								</div>
							</div>
							</br>
							<div class="row">
								<div class="col-md-6">
									<div class="md-form">
										<label>Start Date</label>
										<div class="input-group date" id="datetimepicker121" data-target-input="nearest">
										<input type="text" name="from_date" id="from_date" class="form-control datetimepicker-input" data-target="#datetimepicker121"  />
										<div class="input-group-append" data-target="#datetimepicker121" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="md-form">
									<label>End Date</label>
									<div class="input-group date" id="datetimepicker131" data-target-input="nearest">
                                    <input type="text" name="to_date" id="to_date" class="form-control datetimepicker-input" data-target="#datetimepicker131"  />
                                    <div class="input-group-append" data-target="#datetimepicker131" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
									</div>
									</div>
								</div>
							</div>
								<br>
									<div class="md-form">
										<label for="message">Departments</label>
											<div class="col-sm-12">
												<div class="checkbox">
												  <label>
													<input type="checkbox" value="">
													<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
													HR
												  </label>
												</div>
												<div class="checkbox">
												  <label>
													<input type="checkbox" value="">
													<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
													Finance
												  </label>
												</div>
												<div class="checkbox disabled">
												  <label>
													<input type="checkbox" value="" >
													<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
													Care Takers
												  </label>
												</div>
											</div>
										</div>
						</div>	
					</div>
					<div class="text-center mt-2 mb-4">
						<button class="btn btn-secondary" type="button" >Save</button>
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button> 
					</div>
                    </div>
					</form>
                </div>
            </div>
            <!-- Reports modal end here -->
		<!-- add leave type modal start here -->
            <div class="modal fade" id="createLeaveModal">
                <div class="modal-dialog">
                    
					<form id="user_form" name="" action="" method="POST">
					<div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" >Add New Leave Type</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                <div class="modal-body">
					<div class="col-md-12 col-xl-12">	
					<form id="add_new_leave_type_form" method="POST" action="<?php //echo base_url().'test_api_controller/createLeaveType';?>">
						
						<div class="form-group">
						  <label>New Leave Type</label>
						  <input type="text" class="form-control" id="name" placeholder="Enter leave type" name="name" >
						  <span id="new_leave_type_error" class="text-danger"></span>
						</div>
						 
						<div class="form-group">
							<label>Slug</label>
							<input type="text" class="form-control" name="slug" id="slug" placeholder="slug"  >
						  <span id="slug_error" class="text-danger"></span>
						</div>
						
						<div class="form-group">
						<label for="slugyn">IsPaid</label><br>
						<div class="outerDivFull" >
						<div class="switchToggle">
						<!--dont rename id="switch"-->
							<input type="checkbox" id="switch" name="slugyn">
							<label for="switch">Toggle</label>
						</div>
						</div>
						</div>
						<div class="form-group text-center">
						<button class="btn btn-secondary rounded-0" type="button" >Apply</button>
						<button class="btn btn-secondary rounded-0" type="button" data-dismiss="modal">Cancel</button> 
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
    $('#datetimepicker13').datetimepicker({
                defaultDate: new Date(),
                //format: 'YYYY-MM-DD hh:mm:ss A'
                format: 'DD-MM-YYYY'
    });
	$('#datetimepicker121').datetimepicker({
                defaultDate: new Date(),
                format: 'DD-MM-YYYY'
    });
    $('#datetimepicker131').datetimepicker({
                defaultDate: new Date(),
                //format: 'YYYY-MM-DD hh:mm:ss A'
                format: 'DD-MM-YYYY'
    });
	
	
	$(document).ready(function() {
            $('#example').DataTable({

                dom: 'Bfrtip',
                responsive: true,
                pageLength: 10,
                // lengthMenu: [0, 5, 10, 20, 50, 100, 200, 500],

                buttons: [
                     'excel'
                ],
				language: {
				paginate: {
				  next: '<i class="fas fa-chevron-right"></i>', 
				  previous: '<i class="fas fa-chevron-left"></i>' 
				}
			  }

            });
        });
	$('#add_button').click(function(){
        
        $('#userModal').modal('show');
    });
	
	$('#reports').click(function(){
        
        $('#ReportsModal').modal('show');
    });
	$('#create_leave_button').click(function(){
        
        $('#createLeaveModal').modal('show');
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
</html>
