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
	background-color:#8D91AA;
}
.login-container{
    margin-top: 10%;
}
.login-form-1{
  border-radius: 1rem;
  padding: 3% 5%;
	background-color:#fff;
}
  .row{
    margin-right: 0 !important;
    margin-left:  0 !important;
  }
h3{
    font-size: 1.25rem;
    font-weight: 700;
    color:  #171D4B !important;
    padding: 3%;
}
.login-form-1 h3{
    text-align: center;
    color: #8D91AA;
}
.login-form-2{
    padding: 3%;
    background: #fff;
	border-right: 1px solid #D2D2D2;
}

.login-container form{
    padding: 7%;
}
.btnSubmit
{
  font-weight: 700;
    font-size: 0.9rem;
    width: 100%;
    padding: 1.5%;
    border: none;
    cursor: pointer;
	background-color: #A4D9D6;
	color: #171D4B;
}


.login-form-1 small{
    color: rgba(23, 31, 75,0.7);
    font-weight: 700;
    text-decoration: none;
	font-size: 0.9rem;
	text-align:center
}
.form-control:focus {
   
    box-shadow: none;
}
.btnSubmit{
    border-radius: 20px;
    padding-left: 2rem;
}
input[type="text"],input[type=email],select{
    background: #f3f4f7;
    border-radius: 5px;
    padding: 5px;
    padding-left: 1rem;
    border: 1px solid #D2D0D0 !important;
    border-radius: 20px;
    line-height: 2rem;
}
input.form-control::placeholder{
  text-align: center;
}
.back_to_sign_in a{
  font-weight: 700;
  font-size: 0.8rem;
  color: #171D4B !important;
}
.back_to_sign_in{
    display: flex;
    justify-content: flex-start;
        position: absolute;
    bottom: 1rem;
    left: 1rem;
}
</style>
</head>
<body>
  <div class="container login-container">
    <div class="row d-flex justify-content-center">
      <div class="col-md-6 login-form-1 text-center">
        <h3>Did you forget your password?</h3>
				<small>Enter your email address you're using for your account below <br>and we will send you a password reset link.</small>
        <form method="POST" action="<?php echo base_url().'Welcome/forgotPasswordRequest';?>"> 
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Enter You Email" value="" name="email" required />
          </div>
					<div class="form-group">
            <button type="submit" class="btnSubmit" value="Request Reset Link">
            <i>
              <img src="<?php echo base_url('assets/images/icons/link.png'); ?>" style="max-height:1remrem;margin-right:10px">
            </i>Request Reset Link</button>
          </div>
          <div class="back_to_sign_in">
            <a href="<?php echo site_url('welcome/login') ?>" class="ForgetPwd">
              <i>
                <img src="<?php echo base_url('assets/images/icons/back.png'); ?>" style="max-height:1rem;margin-right:10px">
              </i>Back to Sign in</a>
          </div>
        </form>
          <div style="margin-top:10px;margin-bottom:20px;"><?php print_r(isset($message) ? $message : ""); ?></div>
      </div>
    </div>
  </div>
</body>
</html>