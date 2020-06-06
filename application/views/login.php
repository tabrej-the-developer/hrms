<!DOCTYPE html>  
 <html>  
 <head>  
      <title><?php //echo $title; ?></title>  
	  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
    *{
        text-align: center;
font-family: 'Open Sans', sans-serif;
    }
 body{
	background-color:#307bd3;
}
.login-container{
    margin-top: 10%;
}
.login-form-1{
    padding: 3%;
	background-color:#fff;
}
.login-form-1 h3{
    text-align: center;
    color: #fff;
}
.login-form-2{
    padding: 3%;
    background: #fff;
	border-right: 1px solid #D2D2D2;
}

.login-container form{
    padding: 10%;
}
.btnSubmit
{
    width: 100%;
    padding: 1.5%;








    
    border: none;
    cursor: pointer;
	background-color:#307bd3;
	color:#fff;
}

.login-form-2 .ForgetPwd{
    color: #fff;
    font-weight: 600;
    text-decoration: none;
}
.login-form-1 .ForgetPwd{
    color: #9E9E9E;
    font-weight: 400;
    text-decoration: none;
	font-size:13px;
}
.form-control:focus {
   
    box-shadow: none;
}
.forgot-password{
    color: #444444;
    font-size: 0.8rem;
    font-family: : Open Sans;
}
 </style>
 </head>  
  
 <div class="container login-container">

            <div class="row d-flex justify-content-center">
                <div class="col-md-5 login-form-2 text-center ">
                    <img src="<?php echo base_url();?>assets/images/Todquest_logo.png" alt="company_logo" class="img-fluid mt-5" width="200" height="200">
                </div>
				
                <div class="col-md-5 login-form-1">
                    <h3>Login</h3>
                     <form method="post" action="<?php echo base_url('welcome/login'); ?>">    
					  <?php  echo '<label class="text-danger">'.$this->session->flashdata("error").'</label>';  ?>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email;?>" required />
                        </div> 
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Your Password" value="" required />
                        </div>


                        <center><span style="color: red;"><?php echo $errorText;?></span></center>
                        
                        <div class="form-group text-right">
                             <a href="<?php echo site_url('welcome/forgotPassword') ?>" class="ForgetPwd">Forgot Password?</a> 
                        </div>
						<div class="form-group">
                            <input type="submit" name="insert" class="btnSubmit rounded" value="Login" />
                        </div>

                    </form>
                </div>
            </div>
        </div>
		</body>
 </html>  