<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->load->view('header'); ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<title>create roster</title>
	
	</head>
	<body>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Location</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo site_url('roster/roster1') ?>">Rosters</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Rosters</li>
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
								<div class="col-md-4">Roster Name:</div>
								<div class="col-md-4">jan 1st 2020 roster</div>
								<div class="col-md-4 text-right"><button type="button" class="btn-btn-primary" onclick="window.location.href ='<?php echo site_url("roster/roster2") ?>'">create</button></div>
							</div><hr>
                        </div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Roster Period:</div>
								<div class="col-md-4">jan 1st 2020 to jan 7th 2020</div>
								<div class="col-md-4"></div>
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