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
                    <li class="breadcrumb-item active" aria-current="page">Rosters</li>
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
								<div class="col-md-6"><a href="">Create roster template</a></div>
							</div>
                        </div><hr>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6"><a href="<?php echo site_url('roster/open_roster') ?>">Open a roster</a></div>
								<div class="col-md-6"><a href="">Open a roster template</a></div>
							</div>
                        </div><hr>
						<div class="form-group">
                            <a href="">Shift mangment</a>
                        </div><hr>
						<div class="form-group">
                            <a href="">Deleted shifts</a>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
</body>
</html>