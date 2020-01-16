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
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Location</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo site_url('roster/roster1') ?>">Rosters</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Open Rosters</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white"> Rosters
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
							<div class="row">
								<div class="col-md-6"><a href="<?php echo site_url('roster/create_roster') ?>">Create new roster</a></div>
								<div class="col-md-6"></div>
							</div>
                        </div><hr>
						<div class="form-group">
							<div class="table-responsive" id="sailorTableArea">
								<table id="sailorTable" class="table table-striped table-bordered" width="100%">
							 
									<thead>
										<tr>
											<th>Roster name</th>
											<th>Start Date</th>
											<th>End Date</th>
											<th>Publisged sites</th>
										   
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>jan 1st 2020 roster</td>
											<td>mon 01/01/2020</td>
											<td>sun 07/01/2020</td>
											<td>3/3</td>
										   
										</tr>
										<tr>
											<td>jan 7th 2020 roster</td>
											<td>mon 07/01/2020</td>
											<td>sun 14/01/2020</td>
											<td>0/3</td>
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