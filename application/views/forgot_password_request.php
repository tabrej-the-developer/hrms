<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
    *{
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
    color: #307bd3;
}
.login-form-2{
    padding: 3%;
    background: #fff;
	border-right: 1px solid #D2D2D2;
}

.login-container form{
    padding: 5%;
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
    font-weight: 500;
    text-decoration: none;
	font-size:14px;
}
.login-form-1 small{
    color: #9E9E9E;
    font-weight: 400;
    text-decoration: none;
	font-size:14px;
	text-align:center
}
.form-control:focus {
   
    box-shadow: none;
}
</style>
</head>
<body>
<div class="container login-container">

            <div class="row d-flex justify-content-center">
                
                <div class="col-md-8 login-form-1 text-center">
                    <h3>Did you forgot your password?</h3>
					<small>Enter your email address you're using for your account below <br>and we will send you a password reset link.</small>
                    <form method="post" action="<?php echo base_url().'welcome/forgotPassword';?>"> 
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Your Email" value="" required />
                        </div>
						<div class="form-group">
                            <input type="submit" class="btnSubmit rounded" value="Request Reset Link" />
                        </div>
                        
                        <div class="form-group text-center">
                            <a href="<?php echo site_url('welcome/login') ?>" class="ForgetPwd">Back to Sign in</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
		</body>
		</html>