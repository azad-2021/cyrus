<!DOCTYPE html>
<html lang="en">

<?php
	session_start();
	$otp=$_SESSION["OTP"];
	if(isset($_SESSION["logged-in"])){
		header("Location:profile.php");
	}
	$username="sign up";
	$login_btn="Login";
	if(isset($_SESSION["username"])){
		$username=$_SESSION["username"];
		$login_btn="Logout";
	}
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$con=mysqli_connect('localhost',
			'database_username',
			'database_pass','database_name');

		if(!$con)
			echo ("failed to connect to database");
		$username1=$_POST['username'];
		$prefix="_";
		$username=$prefix.$username1;
		$password=$_POST['Password'];
		$repassword=$_POST['RePassword'];
		$email1=$_POST['Email'];
		$email=strval($email1);
		if($password!=$repassword){
			echo("<script>alert('password not matches')</script>");
		}
		else{
			if(strlen($password)<8){
				echo(
	"<script>alert('password length must be atleast 8')</script>");
			}
			else{
				$query="insert into 1_user(username,email,password)
						values('$username','$email','$password')";

				$sql = "SELECT id,username, password FROM 1_user";
				$result = $con->query($sql);
				$username_already_exist=false;
				$email_already_exist=false;

				// Checking if user already exist
				if(($result->num_rows)> 0){
					while($row = $result->fetch_assoc()) {

						// echo "<br> id: " . $row["id"] .
							" - username= " . $row["username"] .
							" password= " . $row["password"] . "<br>";

						if($row["username"]==$username){
							$username_already_exist=true;
							break;
						}
						if($row["email"]==$email){
							$email_already_exist=true;
							break;
						}
					}
				}

				// echo($ok);
				if($username_already_exist==false){

					// This is my hosting mail
					$from ="suryavanshianantsingh@gmail.com";
					$to=$email;
					$subject="verify-account-otp";

					// Generating otp with php rand variable
					$otp=rand(100000,999999);
					$message=strval($otp);
					$headers="From:" .$from;
					if(mail($to,$subject,$message,$headers)){
						$_SESSION["username"]=$username;
						$_SESSION["OTP"]=$otp;
						$_SESSION["Email"]=$email;
						$_SESSION["Password"]=$password;
						$_SESSION["registration-going-on"]="1";
						header("Location:verify-otp.php");
					}
					else
						echo("mail send faild");
				}
				else{
					echo(
			"<script>alert('username already taken')</script>");
				}
			}
		}
	}
?>


<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content=
		"width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" type="text/css"
		href="css/style.css" media="screen" />
	<!-- adding bootstrap -->
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
	<form class="form-register"
		action="register.php" method="POST">
		<div class="form-group">
			<label>username</label>
			<input type="text" class="form-control"
				name="username" id="username"
				aria-describedby="emailHelp"
				placeholder="username" required>
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="email" class="form-control"
				name="Email" id="Email"
				placeholder="Email" required>
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" class="form-control"
				name="Password" id="Password"
				placeholder="Password" required>
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password"
				class="form-control" name="RePassword"
				id="RePassword" placeholder="RePassword"
				required>
		</div>

		<button type="submit"
			class="btn btn-primary btn-lg">
			Register
		</button>

		<button type="button"
			class="btn btn-warning btn-lg"
			id="login-button">
			Already Registered
		</button>
	</form>
	
	<script>
		$("#login-button").click(function () {
			window.location.replace("index.php");
		});
	</script>
</body>

</html>
