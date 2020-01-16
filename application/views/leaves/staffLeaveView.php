<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header'); ?>
<title>Leaves</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  
  <style>

            .dark-area {
                background-color: #666;
                padding: 40px;
                margin: 0 -40px 20px -40px;
                clear: both;
            }

            .clearfix:before,.clearfix:after {content: " "; display: table;}
            .clearfix:after {clear: both;}
            .clearfix {*zoom: 1;}
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
</style>
</head>
<body>


<div class="container">

        <div class="col-md-12">
            <div class="card">
			
			
                <div class="card-header">
				<div class="row">
                    <div class="col-md-12"><h4>Leave Managment</h4></div>
                </div>
				<div class="row mt-3">
                    <div class="col-md-12"><h6>Leave Balance</h6></div>
                </div>
				<div class="row shadow-sm p-3 mb-4 bg-white rounded vdivide">
                    
					<div class="col-sm-3">
					<div class="chat_people">
					<div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
					<div class="chat_ib">
					  <h4>John Doe (You)</h4>
					  <p>Emp45698</p>
					</div>
					</div>
					</div>
					
						<div class="col-sm-3 text-center">
						<div class="c100 p12 small green">
							<span>2</span>
							<div class="slice">
								<div class="bar"></div>
								<div class="fill"></div>
							</div>
						</div>
						<p>Casual Leave</p>
						<small> <i class="far fa-circle rounded-circle" style=";background-color:green;color:green;"></i> Used Leaves</small><br>
						<small> <i class="far fa-circle rounded-circle" style=";background-color:#ccc;color:#ccc;"></i> Balance Leaves</small>
						</div>		
						
						<div class="col-sm-3 text-center">
						<div class="c100 p12 small orange">
						<span>2</span>
						<div class="slice">
							<div class="bar"></div>
							<div class="fill"></div>
						</div>
						</div>
						<p>Sick Leave</p>
						<small> <i class="far fa-circle rounded-circle" style=";background-color:orange;color:orange;"></i> Used Leaves</small><br>
						<small> <i class="far fa-circle rounded-circle" style=";background-color:#ccc;color:#ccc;"></i> Balance Leaves</small>
						</div>
						
						<div class="col-sm-3 text-center">
						<div class="c100 p12 small">
						<span>2</span>
						<div class="slice">
							<div class="bar"></div>
							<div class="fill"></div>
						</div>
						</div>
						<p>Emergency Leave</p>
						<small> <i class="far fa-circle rounded-circle" style=";background-color:blue;color:blue;"></i> Used Leaves</small><br>
						<small> <i class="far fa-circle rounded-circle" style=";background-color:#ccc;color:#ccc;"></i> Balance Leaves</small>
						</div>
					
                </div>
				<div class="row">
                    <div class="col-md-6"><h6>My Leave Requests</h6></div>
					<div class="col-md-6 text-right">
					<button type="button" name="add_button" id="add_button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-plus-circle"></i> Apply Leave</button>
					
					<button type="button" name="reports" id="reports" class="btn btn-default btn-sm" data-toggle="modal" data-target="#ReportsModal"><i class="fas fa-download"></i> Downlad Report</button>
					
					</div>
                </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-borderless table-hover border-shadow" id="example" style="width:100%;">
                        <thead>
                            <tr class="text-muted">
                            <th>S.No</th>
                            <th>Leave Type</th>
                            <th>Start Date</th>
                            <th>Days</th>
                            <th>End Date </th>
                            <th>Reason</th>
                            <th>Request To</th>
                            <th>Status</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
							<tr>
								<td>1</td>
								<td>Casual leave</td>
								<td>2011/04/26</td>
								<td>2011/04/25</td>
								<td>1</td>
								<td><a href="#" data-toggle="modal" data-target="#showModalCenter"><i class="far fa-file-alt"></i><a></td>
								<td>Manager</td>
								<td style="color:#e97613;">pending</td>
								<td>
								<a href="#" title="Edit"><i class="far fa-edit" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Delete"><i class="far fa-trash-alt" style="color:red;font-size:18px;margin-left:10px;"></i></a>
								</td>
								<!--<td><a href="#" title="Approve"><i class="far fa-check-circle" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Reject"><i class="far fa-times-circle" style="color:red;font-size:18px;margin-left:10px;"></i></a></td>-->
								
							</tr>
							<tr>
								<td>2</td>
								<td>Casual leave</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
								<td>1</td>
								<td><a href="#" data-toggle="modal" data-target="#showModalCenter"><i class="far fa-file-alt"></i><a></td>
								<td>Manager</td>
								<td style="color:#05b223;">Approved</td>
								<td>
								<!--<a href="#" title="Edit"><i class="far fa-edit" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Delete"><i class="far fa-trash-alt" style="color:red;font-size:18px;margin-left:10px;"></i></a>-->
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Casual leave</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
								<td>1</td>
								<td><a href="#" data-toggle="modal" data-target="#showModalCenter"><i class="far fa-file-alt"></i><a></td>
								<td>Manager</td>
								<td style="color:#ef0a0a;">Rejected</td>
								<td>
								<!--<a href="#" title="Edit"><i class="far fa-edit" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Delete"><i class="far fa-trash-alt" style="color:red;font-size:18px;margin-left:10px;"></i></a>-->
								</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Casual leave</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
								<td>1</td>
								<td><a href="#" data-toggle="modal" data-target="#showModalCenter"><i class="far fa-file-alt"></i><a></td>
								<td>Manager</td>
								<td style="color:#e97613;">pending</td>
								<td>
								<a href="#" title="Edit"><i class="far fa-edit" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Delete"><i class="far fa-trash-alt" style="color:red;font-size:18px;margin-left:10px;"></i></a>
								</td>
							</tr><tr>
								<td>5</td>
								<td>Casual leave</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
								<td>1</td>
								<td><a href="#" data-toggle="modal" data-target="#showModalCenter"><i class="far fa-file-alt"></i><a></td>
								<td>Manager</td>
								<td style="color:#e97613;">pending</td>
								<td>
								<a href="#" title="Edit"><i class="far fa-edit" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Delete"><i class="far fa-trash-alt" style="color:red;font-size:18px;margin-left:10px;"></i></a>
								</td>
							</tr><tr>
								<td>6</td>
								<td>Casual leave</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
								<td>1</td>
								<td><a href="#" data-toggle="modal" data-target="#showModalCenter"><i class="far fa-file-alt"></i><a></td>
								<td>Manager</td>
								<td style="color:#e97613;">pending</td>
								<td>
								<a href="#" title="Edit"><i class="far fa-edit" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Delete"><i class="far fa-trash-alt" style="color:red;font-size:18px;margin-left:10px;"></i></a>
								</td>
							</tr><tr>
								<td>14</td>
								<td>Casual leave</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
								<td>1</td>
								<td><a href="#" data-toggle="modal" data-target="#showModalCenter"><i class="far fa-file-alt"></i><a></td>
								<td>Manager</td>
								<td style="color:#e97613;">pending</td>
								<td>
								<a href="#" title="Edit"><i class="far fa-edit" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Delete"><i class="far fa-trash-alt" style="color:red;font-size:18px;margin-left:10px;"></i></a>
								</td>
							</tr><tr>
								<td>16</td>
								<td>Casual leave</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
								<td>1</td>
								<td><a href="#" data-toggle="modal" data-target="#showModalCenter"><i class="far fa-file-alt"></i><a></td>
								<td>Manager</td>
								<td style="color:#05b223;">Approved</td>
								<td>
								<!--<a href="#" title="Edit"><i class="far fa-edit" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Delete"><i class="far fa-trash-alt" style="color:red;font-size:18px;margin-left:10px;"></i></a>-->
								</td>
							</tr>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

    </div>
<!--reaspn Modal -->
<div class="modal fade" id="showModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#fff;">
        <h5 class="modal-title text-dark" id="exampleModalLongTitle">Leave Reason</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Reason for leave goes here...</p>
      </div>
      <div class="form-group text-center">
		<button class="btn btn-secondary rounded-0" type="button" data-dismiss="modal">Cancel</button> 
		</div>
    </div>
  </div>
</div>
<!--reaspn Modal end-->
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
						<button class="btn btn-secondary rounded-0" type="button" >Apply</button>
						<button class="btn btn-secondary rounded-0" type="button" data-dismiss="modal">Cancel</button> 
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
						<button class="btn btn-secondary rounded-0" type="button" >Save</button>
						<button class="btn btn-secondary rounded-0" type="button" data-dismiss="modal">Cancel</button> 
					</div>
                    </div>
					</form>
                </div>
            </div>
            <!-- Reports modal end here -->


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
</script>
</html>