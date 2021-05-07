<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="post" action="<?php echo base_url().'auth/newPassword';?>" id="passwordForm">
	<input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
	<input type="hidden" name="token" id ="token" value="<?php echo $token;?>">
	<input type="password" name="newpassword1" id="newpassword1" required><br>
	<input type="password" name="newpassword2" id="newpassword2" required><br>
	<span style="color: red" id="error"></span>
	<div style="color: green;" onclick="matchPasswords()">Submit</div>
</form>

<script type="text/javascript">
	function matchPasswords(){
		var pass1 = document.getElementById("newpassword1").value;
		var pass2 = document.getElementById("newpassword2").value;
		if(pass1!= "" && pass1 == pass2){
			document.getElementById("passwordForm").submit();
		}
		else{
			document.getElementById("error").innerHTML = "Passwords do not match";
		}
	}
</script>
</body>
</html>