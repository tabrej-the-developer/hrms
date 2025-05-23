<!DOCTYPE html>  
 <html>  
 <head>  
      <title><?php echo $title; ?></title>  
	  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
      <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">

 </head>  
  
 <div class="login-container">
  <div class="login-container-child d-flex">

    <div class="col-12 col-md-6 loginFormLeft">
      <div class="hrmsLogo">
        <img src="<?php echo base_url();?>assets/images/hrmsLogo.png" alt="company_logo" class="img-fluid " >
      </div>
      <img src="<?php echo base_url();?>assets/images/loginApp.png" alt="">
    </div>

    <div class="col-0 col-md-6 loginFormRight" >
      <h1>Welcome to <span> Our Application<span></h1>
      <div class="text-class">
      <?php 
if (!empty($quotations) && is_string($quotations)) {
    $quotations = json_decode($quotations);
}

// Defensive check in case decoding failed or structure is unexpected
if (isset($quotations->quotations) && is_array($quotations->quotations)) {
    $quoteLength = count($quotations->quotations);
    $rand = rand(0, $quoteLength - 1);
} else {
    $quoteLength = 0;
    $rand = 0;
    $quotations = (object)[ 'quotations' => [] ]; // Ensure it's safe to access later
}
?>

        <span class="quotation"><?php echo $quotations->quotations[$rand]->quote ?></span>
        <span class="author_name"><i> <br>- <?php echo $quotations->quotations[$rand]->author ?></i></span>
      </div>
      <form method="post" action="<?php echo base_url('welcome/login'); ?>">          
        <?php  echo '<div class="text-danger">'.$this->session->flashdata("error").'</div>';  ?>
        <div class="form-floating mb-1">
          <input id="floatingInput" type="text" name="email" class="form-control" placeholder="name@example.com" value="<?php echo $email;?>" required />
          <label for="floatingInput">Email Id/Employee Id</label>
        </div> 
        <div class="password_group form-floating mb-1">
          <input type="password" name="password" id="floatingPassword" class="form-control" placeholder="Password"  value="" required />
          <label for="floatingPassword">Password</label>
          <span class="material-icons-outlined hide_password" onclick="pword()">visibility_off</span>
          <!-- <img src="<?php // echo base_url('assets/images/icons/hide_password.png'); ?>" class="hide_password" onclick="pword()"> -->
          <!-- <img src="<?php // echo base_url('assets/images/icons/hide_password.png'); ?>" class="hide_password"> -->
        </div>
        <span class="error"><?php echo $errorText;?></span>
          <div class="form-group submit-block">
            <input type="submit" name="insert" class="btnSubmit rounded" value="LOGIN" />
          </div>     

          <div class="forgotPass">
            <a href="<?php echo site_url('welcome/forgotPassword') ?>" class="ForgetPwd">Forgot Password?</a> 
          </div>

          <!-- <div class="d-flex justify-content-around position-relative remember_parent">
        <div class="remember-me position-absolute ml-auto " style="left:0">
          <input type="checkbox" name="" class=""> Remember me</div> 
          
        </div>-->
      </form>
    </div>
  </div>
</div>

<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  <script type="text/javascript">
  // window.onload = function(){
    var pword = () =>{
      var passwordClass = document.getElementsByClassName('hide_password');
      var passWord = document.getElementById('floatingPassword'); 
      if(passwordClass[0].classList.contains('showingPassword')){
        //passwordClass[0].setAttribute('src','<?php // echo base_url('assets/images/icons/hide_password.png'); ?>');
        passwordClass[0].innerHTML="visibility_off";
         passwordClass[0].classList.remove('showingPassword');
         passWord.setAttribute('type','password');
      }else{
        //passwordClass[0].setAttribute('src','<?php // echo base_url('assets/images/icons/password.png'); ?>');
        passwordClass[0].innerHTML="visibility";
        passwordClass[0].classList.add('showingPassword');
        passWord.setAttribute('type','text');
      }
    }
  // }

 
  </script>
		</body>
 </html>  