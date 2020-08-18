<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<style>
body{
	background-color:#8D91AA;
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
    color: #8D91AA;
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
	background-color:#8D91AA;
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
          <div class="col-md-5 login-form-1 text-center">
              <h3>Reset Password</h3>
              <form method="post" action="<?php echo base_url().'welcome/resetPassword';?>"> 
                <div class="form-group">
                  <input type="password" class="form-control" placeholder="New Password" value="" required name="new_password"/>
                </div>
        				<div class="form-group">
                  <input type="password" class="form-control" placeholder="Confirm Password" required name="confirm_password"/>
                </div>
  	       			<div class="form-group">
                  <input type="submit" class="btnSubmit rounded" value="Reset Password" />
                </div>
                <span class="alert"></span>
            </form>
          </div>
          
      </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $(document).on('click','.btnSubmit',function(e){
      if($('input[name="new_password"]').val() !== $('input[name="confirm_password"]')){
           e.preventDefault();
           $('.alert').text('Passwords do not match')
           setTimeout(function(){
            $('.alert').text(" ");
           },"2000");
           
        }
      })
    })
  </script>
	</body>
	</html>