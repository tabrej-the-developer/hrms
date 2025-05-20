<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
  <title>Forgot Password</title> 
  <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
      <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">
 
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

</head>
<body>
  <div class="login-container">
    <div class="forgotPassInner">
      <div class="col-md-12 login-form-1 text-center">
        <h3>Did you forget your password?</h3>
				<small>Enter your email address you're using for your account below and we will send you a password reset link.</small>
        <form method="POST" action="<?php echo base_url().'Welcome/forgotPasswordRequest';?>"> 

        <div class="form-floating mb-1">
            <input id="floatingInput" type="email" class="form-control" placeholder="Enter You Email" value="" name="email" required />
          <label for="floatingInput">Email</label>
        </div> 
          <span class="error"><?php print_r(isset($message) ? $message : ""); ?></span>
        <div class="form-group submit-block">
          <button type="submit" class="btnSubmit" value="Request Reset Link">
            Request Reset Link
          </button>
        </div>
        <div class="forgotPass">
          <a href="<?php echo site_url('welcome/login') ?>" class="ForgetPwd">
            Back to Sign in</a>
        </div>
        </form>
      </div>
    </div>
  </div>
  
 
<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>