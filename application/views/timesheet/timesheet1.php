<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->load->view('header'); ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<title>Timesheet</title>
	
	</head>
	<body>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Location</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Timesheets</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white"> Timesshet
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
							<div class="row">
								<div class="col-md-6"><i class="fas fa-user"></i> <a href="<?php echo site_url('timesheet/my_timesheet') ?>">My Time sheet</a>
								<p>view or change your timesheet</p>
								</div>
								<div class="col-md-6"></div>
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