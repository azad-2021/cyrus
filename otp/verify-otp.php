<!DOCTYPE html>
<html lang="en">
	<?php
		session_start();
	
		// Retrieving otp with session variable
		$otp=$_SESSION["OTP"];
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
			<h3>welcome to my website</h3>
		</div>
	</div>
</head>

<body>
	<form class="form-login">
		<div class="form-group">
			<input type="text" class="form-control"
				name="otp" id="OTP"
				aria-describedby="emailHelp"
				placeholder="Enter OTP" required>
		</div>

		<button type="button"
			class="btn btn-primary btn-lg"
			id="verify-otp">
			verify otp
		</button>
	</form>

	<script>
		$("#resend-otp").click(function () {
			window.location.replace("resend-otp.php");
		});
		$("#verify-otp").click(function () {

			// window.location.replace("index.php");
			var otp1 = document.getElementById("OTP").value;

			// alert(otp1);
			var otp2 = ("<?php echo($otp)?>");
			
			// alert(otp2);
			if (otp1 == otp2) {
				window.location.replace("logged-in.php");
			}
			else {
				alert("otp not matches")
			}
		});
	</script>
</body>

</html>
