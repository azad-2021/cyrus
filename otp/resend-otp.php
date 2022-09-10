<!DOCTYPE html>
<html lang="en">

<?php

	session_start();
	
	// ini_set('dispaly_errors',1);
	// error_reporting(E_ALL);
	$from ="support@libraryatcoer.tk";
	$to=$_SESSION["Email"];
	$subject="verify-account-otp";
	$otp=rand(100000,999999);
	$message=strval($otp);
	$headers="From:" .$from;
		
	if(mail($to,$subject,$message,$headers)){
		$_SESSION["OTP"]=$otp;
		header("Location:verify-otp.php");
	}
	else
		echo("mail send faild");
?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content=
		"width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" type="text/css"
		href="css/style.css" media="screen" />

	<!-- Adding bootstrap -->
	<link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity=
"sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
		crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
		integrity=
"sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
		crossorigin="anonymous">
	</script>
	
	<script src=
"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
		integrity=
"sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous">
	</script>
	
	<script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
		integrity=
"sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
		crossorigin="anonymous">
	</script>
	
	<div class="nav-bar">
		<div class="title">
			<h3>welcome to coer library</h3>
		</div>
	</div>
</head>

<body>
	<div class="form">
		<form action="register.php" method="POST">
			<label><b>Register To MY website</b></label>
			<hr class="first">
			<label><b>Coer-ID</b></label>
			<input type="text" name="Coer-ID"
				placeholder="Coer-ID" required id="Coer-ID"
				class="float-left1">
			<br><br>

			<label><b>Email</b></label>
			<input type="email" name="Email"
				placeholder="Email" required id="Email"
				class="float-left1">
			<br><br>

			<label><b>Password </b> </label>
			<input type="Password" name="Password"
				placeholder="Password" required id="Password"
				class="float-left1">
			<br><br>

			<label><b>RePassword </b> </label>
			<input type="Password" name="RePassword"
				placeholder=" Re Type Password"
				required id="Repassword"
				class="float-left1">
			<br><br>

			<button type="submit" name="login"
				value="login" id="register-button">
				create account
			</button>
			<br><br>
		</form>
	</div>
</body>

</html>
