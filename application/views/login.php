<!DOCTYPE html>  
 <html>  
 <head>  
      <title><?php //echo $title; ?></title>  
	  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<style type="text/css">
    *{
        text-align: center;
font-family: 'Open Sans', sans-serif;
    }
 body{
	background-color:#f2f2f2;
    overflow: hidden
}
.login-container{
    /*margin-top: 10%;*/
}
.login-form-1{
    padding: 3%;
	background-color:#fff;
    height: 100%;
    box-shadow: 0px 0px 10px 1px rgba(0,0,0,0.3);
}
.login-form-1 h3{
    text-align: center;
    color: #fff;
}
.login-form-2{
    padding: 3%;
    background: #fff;
    margin:auto;
}

.login-container form{
    padding-right: 15%;
    padding-left: 15%;
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
.login-container-child{
    height: 100%;
    width: 100%;
    position: absolute;
    padding: 4rem 10rem;
}
.login-form-3{
    padding-right: 0px; 
    padding-left: 0px;
    background:url('<?php base_url();?>/PN101/assets/images/login.PNG');
    background-size: 100% 100%;
    background-repeat: no-repeat;
    box-shadow: 0px 0px 10px 1px rgba(0,0,0,0.3);
}
.text-class{
    color:white;
    font-size: 4rem;
    margin:30% 5%;
}
.text-class > span{
    text-align: left;
    font-weight: bolder;
    display: block;
    font-family: Montserrat;
}
input[type="submit"]{
    background: linear-gradient(180deg, #BD252A -101.83%, #263579 100%);
    padding: 10%;
    border-radius: 1.5rem !important;
}
.form-control{
    border-bottom: 1px solid #ced4da;
    border-top: none;
    border-right: none;
    border-left: none;
    text-align: left
}
.submit-block{
    width: 6rem;
    height: 2rem;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    align-items: center;
    margin-bottom: 0;
}
.remember-me{
    color: #9E9E9E;
    font-weight: 400;
    font-size: 13px
}
.remember_parent{
    height: 3rem;
}
@media only screen and (max-width:600px){
    body{
        max-width: 100vw;
        max-height: 100%;
        overflow-x:hidden;
        overflow-y: hidden;
    }
    .login-form-3{
        display: none
    }
    .login-container-child{
        height: 100%;
        width: 100%;
        position: absolute;
        padding: 0rem !important;
    }
}
 </style>
 </head>  
  
 <div class="login-container">

            <div class="login-container-child d-flex">
                <!-- Image div element -->
                <!-- <div class="col-md-5 login-form-2 text-center ">
                    <img src="<?php echo base_url();?>assets/images/Todquest_logo.png" alt="company_logo" class="img-fluid mt-5" width="200" height="200">
                </div> -->
				
                <div class="col-12 col-md-5 login-form-1">
                    <div class="col-md-3 login-form-2 d-flex justify-content-center">
                        <img src="<?php echo base_url();?>assets/images/Todquest_logo.png" alt="company_logo" class="img-fluid " width="200" height="200">
                    </div> 
                    <div><h1 style="font-weight: 900;font-family: Open Sans;color: #9B9B9B">Login</h1></div>
                     <form method="post" action="<?php echo base_url('welcome/login'); ?>">    
					  <?php  echo '<label class="text-danger">'.$this->session->flashdata("error").'</label>';  ?>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Email Address" value="<?php echo $email;?>" required />
                        </div> 
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" value="" required />
                        </div>


                        <center><span style="color: red;"><?php echo $errorText;?></span></center>
                        
                    <div class="d-flex justify-content-around position-relative remember_parent">
                        <div class="remember-me position-absolute ml-auto " style="left:0">
                            <input type="checkbox" name="" class=""> Remember me</div>
                        <div class="form-group d-flex justify-content-end position-absolute mr-auto" style="right:0">
                             <a href="<?php echo site_url('welcome/forgotPassword') ?>" class="ForgetPwd">Forgot Password?</a> 
                        </div>
                    </div>
						<div style="display: flex;justify-content: center;height: 5rem;align-items: center;">
                  <div class="form-group submit-block">
                    <input type="submit" name="insert" class="btnSubmit rounded" value="LOGIN" />
                  </div>                  
              </div>

                    </form>
                </div>
                <div class="col-0 col-md-7 login-form-3" >
                    <div class="text-class">
                        <span class="">Glad</span>
                        <span class="">to see You.</span>
                    </div>
                </div>
            </div>
        </div>
		</body>
 </html>  