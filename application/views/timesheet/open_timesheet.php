<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->load->view('header'); ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<title>roster</title>
	
	</head>
	<body>
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Location</a></li>
					<li class="breadcrumb-item active" aria-current="page"><a href="<?php //echo site_url('timesheet/timesheet1') ?>">Timesheets</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Open Timesheets</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white"> Open Timesheet</div>
                <div class="card-body">
                    <form>
                       <div class="form-group text-right">
							<a href="<?php echo site_url('timesheet/manage_timesheet') ?>"> <i class="fas fa-tasks"></i> Manage Timesheet</a>
					   </div>
						<div class="form-group">
							<div class="table-responsive" id="sailorTableArea">
								<table id="sailorTable" class="table table-striped table-bordered" width="100%">
							 
									<thead>
										<tr>
											<th>Name</th>
											<th>Start Date</th>
											<th>End Date</th>
											<th>Approved Shifts/total</th>
											<th>Warnings</th>
											<th>Finalised</th>
										   
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>jan 1st 2020 roster</td>
											<td>mon 01/01/2020</td>
											<td>sun 07/01/2020</td>
											<td>0/0</td>
											<td>0</td>
											<td style="color:orange;">No</td>
										   
										</tr>
										<tr>
											<td>jan 7th 2020 roster</td>
											<td>mon 07/01/2020</td>
											<td>sun 14/01/2020</td>
											<td>0/10</td>
											<td>0</td>
											<td style="color:orange;" >No</td>
										</tr>
										
										
									</tbody>
								</table>
							</div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
</body>
</html>