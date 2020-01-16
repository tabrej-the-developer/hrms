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
				<div class="row mt-3">
                    <div class="col-md-12"><h6>Leave Balance</h6></div>
                </div>
				<div class="row shadow-sm p-3 mb-4 bg-white rounded vdivide">
                    
					<div class="col-sm-3">
					<div class="chat_people">
					<div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
					<div class="chat_ib">
					  <h4>Admin Name(You)</h4>
					  <p>Emp45698</p>
					</div>
					</div>
					</div>
					
		<div class="col-sm-9">			
    <div id="recipeCarousel" class="carousel slide w-100" data-ride="">
        <div class="carousel-inner w-100" role="listbox">
            <div class="carousel-item row no-gutters active">
                <div class="col-4 float-left">
					<div class="text-center">
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
				</div>
                <div class="col-4 float-left">
					<div class="text-center">
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
				</div>
                <div class="col-4 float-left">
					<div class="text-center">
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
            </div>
            <div class="carousel-item row no-gutters">
                <div class="col-4 float-left">
					<div class="text-center">
						<div class="c100 p12 small green">
							<span>2</span>
							<div class="slice">
								<div class="bar"></div>
								<div class="fill"></div>
							</div>
						</div>
						<p>Casual Leave 2</p>
						<small> <i class="far fa-circle rounded-circle" style=";background-color:green;color:green;"></i> Used Leaves</small><br>
						<small> <i class="far fa-circle rounded-circle" style=";background-color:#ccc;color:#ccc;"></i> Balance Leaves</small>
					</div>
				</div>
                <div class="col-4 float-left">
					<div class="text-center">
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
				</div>
                
            </div>
        </div>
        <a class="carousel-control-prev" href="#recipeCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#recipeCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

					
					
                </div>
                </div>
                 <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Leave Approvals</a>
                     
                      <a class="nav-item nav-link" id="nav-contact-tab1" data-toggle="tab" href="#nav-contact1" role="tab" aria-controls="nav-contact" aria-selected="false">My Leave Requests</a>
					  
					  <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Manage Leave Type</a>
                     
                    </div>
                  </nav>
        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                      <div class="card">
                <div class="card-header">
				<div class="row">
                    <div class="col-md-6"></div>
					<div class="col-md-6 text-right">
					<button type="button" name="add_button" id="add_button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-plus-circle"></i> Add Leave Type</button>
					<button type="button" name="reports" id="reports" class="btn btn-default btn-sm" data-toggle="modal" data-target="#ReportsModal"><i class="fas fa-download"></i> Downlad Report</button>
					</div>
                </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-borderless table-hover border-shadow" id="example1" style="width:100%;">
                        <thead>
                            <tr class="text-muted">
                            <th>Emp.ID</th>
                            <th>Emp. Name</th>
                            <th>Days</th>
                            <th>Start Date </th>
                            <th>End Date</th>
                            <th>Leave Type</th>
                            <th>Reason</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
							<tr>
								<td>TE001</td>
								<td>John Doe</td>
								<td>1</td>
								<td>2011/04/25</td>
								<td>2011/04/26</td>
								<td>Casual Leave</td>
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
								<td><a href="#" title="Approve"><i class="far fa-check-circle" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Reject"><i class="far fa-times-circle" style="color:red;font-size:18px;margin-left:10px;"></i></a></td>
								
							</tr>
							<tr>
								<td>TE876</td>
								<td>John Doe</td>
								<td>1</td>
								<td>2011/04/25</td>
								<td>2011/04/26</td>
								<td>Casual Leave</td>
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
								<td><a href="#" title="Approve"><i class="far fa-check-circle" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Reject"><i class="far fa-times-circle" style="color:red;font-size:18px;margin-left:10px;"></i></a>
								</td>
							</tr>
							<tr>
								<td>TE667</td>
								<td>John Doe</td>
								<td>1</td>
								<td>2011/04/25</td>
								<td>2011/04/26</td>
								<td>Casual Leave</td>
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
								<td><a href="#" title="Approve"><i class="far fa-check-circle" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Reject"><i class="far fa-times-circle" style="color:red;font-size:18px;margin-left:10px;"></i></a>
								</td>
							</tr>
							<tr>
								<td>TE061</td>
								<td>John Doe</td>
								<td>1</td>
								<td>2011/04/25</td>
								<td>2011/04/26</td>
								<td>Casual Leave</td>
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
								<td><a href="#" title="Approve"><i class="far fa-check-circle" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Reject"><i class="far fa-times-circle" style="color:red;font-size:18px;margin-left:10px;"></i></a>
								</td>
							</tr>
							<tr>
								<td>TE034</td>
								<td>John Doe</td>
								<td>1</td>
								<td>2011/04/25</td>
								<td>2011/04/26</td>
								<td>Casual Leave</td>
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
								<td><a href="#" title="Approve"><i class="far fa-check-circle" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Reject"><i class="far fa-times-circle" style="color:red;font-size:18px;margin-left:10px;"></i></a>
								</td>
							</tr>
							<tr>
								<td>TE005</td>
								<td>John Doe</td>
								<td>1</td>
								<td>2011/04/25</td>
								<td>2011/04/26</td>
								<td>Casual Leave</td>
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
								<td><a href="#" title="Approve"><i class="far fa-check-circle" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Reject"><i class="far fa-times-circle" style="color:red;font-size:18px;margin-left:10px;"></i></a>
								</td>
							</tr>
                        </tbody>
                    </table>

                </div>

            </div>
      </div>
	  <div class="tab-pane fade" id="nav-contact1" role="tabpanel" aria-labelledby="nav-home-tab">
                      <div class="card">
                <div class="card-header">
				<div class="row">
                    <div class="col-md-6"></div>
					<div class="col-md-6 text-right">
					<button type="button" name="apply_button" id="apply_button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-plus-circle"></i> Apply Leave</button>
					<button type="button" name="reports" id="reports" class="btn btn-default btn-sm" data-toggle="modal" data-target="#ReportsModal"><i class="fas fa-download"></i> Downlad Report</button>
					</div>
                </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-borderless table-hover border-shadow" id="example3" style="width:100%;">
                        <thead>
                            <tr class="text-muted">
                            <th>S.No</th>
                            <th>Leave Type</th>
                            <th>Start Date</th>
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
								<td>
								<a href="#" title="Edit"><i class="far fa-edit" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Delete"><i class="far fa-trash-alt" style="color:red;font-size:18px;margin-left:10px;"></i></a>
								</td>
							</tr><tr>
								<td>5</td>
								<td>Casual leave</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
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
								<td>
								<a href="#" title="Edit"><i class="far fa-edit" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Delete"><i class="far fa-trash-alt" style="color:red;font-size:18px;margin-left:10px;"></i></a>
								</td>
							</tr><tr>
								<td>6</td>
								<td>Casual leave</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
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
								<td>
								<a href="#" title="Edit"><i class="far fa-edit" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Delete"><i class="far fa-trash-alt" style="color:red;font-size:18px;margin-left:10px;"></i></a>
								</td>
							</tr><tr>
								<td>14</td>
								<td>Casual leave</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
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
								<td>
								<a href="#" title="Edit"><i class="far fa-edit" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Delete"><i class="far fa-trash-alt" style="color:red;font-size:18px;margin-left:10px;"></i></a>
								</td>
							</tr><tr>
								<td>16</td>
								<td>Casual leave</td>
								<td>2011/04/25</td>
								<td>2011/04/25</td>
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
              
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
					<div class="card-header">
				<br>
                </div>
                      <div class="card-body">
                    <table class="table table-striped table-borderless table-hover border-shadow" id="example2" style="width:100%;">
                        <thead>
                            <tr class="text-muted">
                            <th>S.No</th>
                            <th>Leave Type</th>
                            <th>Added On</th>
                            <th>Added By</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
							<tr>
								<td>1</td>
								<td>Sick Leave 2</td>
								<td>2011/04/25</td>
								<td>John Doe</td>
								<td>
								<a href="#" title="Edit"><i class="far fa-edit" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Delete"><i class="far fa-trash-alt" style="color:red;font-size:18px;margin-left:10px;"></i></a>
								</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Emergency leave 2</td>
								<td>2011/04/25</td>
								<td>John Doe</td>
								<td>
								<a href="#" title="Edit"><i class="far fa-edit" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Delete"><i class="far fa-trash-alt" style="color:red;font-size:18px;margin-left:10px;"></i></a>
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Personal Leave</td>
								<td>2011/04/25</td>
								<td>John Doe</td>
								<td>
								<a href="#" title="Edit"><i class="far fa-edit" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Delete"><i class="far fa-trash-alt" style="color:red;font-size:18px;margin-left:10px;"></i></a>
								</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Sick Leave 3</td>
								<td>2011/04/25</td>
								<td>John Doe</td>
								<td>
								<a href="#" title="Edit"><i class="far fa-edit" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Delete"><i class="far fa-trash-alt" style="color:red;font-size:18px;margin-left:10px;"></i></a>
								</td>
							</tr>
							<tr>
								<td>5</td>
								<td>casual Leave 2/td>
								<td>2011/04/25</td>
								<td>John Doe</td>
								<td>
								<a href="#" title="Edit"><i class="far fa-edit" style="color:green;font-size:18px;"></i></a>
								<a href="#" title="Delete"><i class="far fa-trash-alt" style="color:red;font-size:18px;margin-left:10px;"></i></a>
								</td>
							</tr>
							
                        </tbody>
                    </table>

                </div>
                    </div>
                    
                  </div>
                
                </div>
              </div>
        </div>
    
 <!-- apply leave modal start here -->
            <div class="modal fade" id="applyModal">
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
<!-- modal start here -->
            <div class="modal fade" id="userModal">
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
										<input type="text" name="startdate" id="startdate" class="form-control datetimepicker-input" data-target="#datetimepicker121"  />
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
                                    <input type="text" name="endate" id="endate" class="form-control datetimepicker-input" data-target="#datetimepicker131"  />
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
	
	
	$(document).ready(function() {
            $('#example1,#example3,#example2').DataTable({
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
</html>