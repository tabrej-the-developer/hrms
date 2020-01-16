<!DOCTYPE html>  
 <html>  
 <head>  
      <title><?php echo $title; ?></title>  
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
 <style>
 body{
	 background-color:#f5f5f5;
	 }
 </style>
 </head>  
 <body>  
      <div class="container">  
      <div class="row">  
	   
      <div class="col-md-6 col-md-offset-3 col-sm-4 col-lg-6">  
			<h3>SIGN IN</h3>
            <hr>
           <form method="post" action="<?php echo base_url(); ?>main/login_validation">  
		   <?php  echo '<label class="text-danger">'.$this->session->flashdata("error").'</label>';  ?>
                <div class="form-group">  
                     <label for="email"> Username</label>  
                     <input type="text" name="email" class="form-control" placeholder="Email.."/>  
                     <span class="text-danger"><?php //echo form_error('username'); ?></span>                 
                </div>  
                <div class="form-group">  
                     <label for="password">Password</label>  
                     <input type="password" name="password" class="form-control" placeholder="Password.."/>  
                     <span class="text-danger"><?php //echo form_error('password'); ?></span>  
                </div>  
                <div class="form-group">  
                     <input type="submit" name="insert" value="Login" class="btn btn-primary" />  
                       
                </div>  
           </form>  
      </div>  
      </div>  
      </div>
	  
 </body>  
 </html>  