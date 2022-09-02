<?php
session_start();

include('connection.php'); 



if(isset($_POST['submit'])){

    $username = $_POST['user'];  
    $password = $_POST['pass'];
        //to prevent from mysqli injection  
    $username = stripcslashes($username);  
    $password = stripcslashes($password);  
    $username = mysqli_real_escape_string($con, $username);  
    $password = mysqli_real_escape_string($con, $password);  

    $sql = "SELECT * from user where Name = '$username' and Password = '$password'";  
    $result = mysqli_query($con, $sql);  
    $row = mysqli_fetch_assoc($result);  
    $count = mysqli_num_rows($result);  

    if($count == 1){
        $_SESSION['user']=$row['Name'];
        $_SESSION['id']=$row['ID']; 
        $Type=$row['Type'];
        $EmployeeID=$row['ID'];  
        $queryAdd="INSERT INTO `userlog`( `Name`, `EmployeeID`) VALUES ('$username', '$EmployeeID')";
        $resultAdd = mysqli_query($con,$queryAdd); 
        if ($password=='Sirius@123') {
            header("location: changepass.php?");
                //echo "loged in successfully" ;       
        }elseif($Type=='Sim Providers'){
           header("location: simtable.php?");   
       }elseif($Type=='Orders'){
        header("location: ordertable.php?"); 
    }elseif($Type=='Production'){
        header("location: protable.php?"); 
    }elseif($Type=='Store'){
        header("location: storetable.php?"); 
    }elseif($Type=='Installation'){
        header("location: instable.php?"); 
    }elseif($Type=='Super User'){
        header("location: home.php?"); 
    }

           //header("location: form.php"); 
}  
else{  
    echo '<script>alert("Invalid Username or Password")</script>';
} 
}

?>

<!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Cyrus</title>
        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <link rel="icon" href="cyrus logo.png" type="image/icon type">
        <!-- Custom styles for this template -->
        <link href="css/sign-in.css" rel="stylesheet">
    </head>
    <body>
       <div class="container">
        <center>
            <img class="img-fluid mb-4" alt="Cyrus Logo" height="50" src="cyrus logo.png" width="50">
            <h1 class="h3 mb-3 font-weight-normal">Welcome to Cyrus</h1>
            <h1 class="h3 mb-3 font-weight-normal">Please sign in as SaaS User</h1>
        </center>       
        <form class="form-signin" action="" method="POST">
            <input type="text" id="UName" name="user" class="form-control" placeholder="User Name" required autofocus>
            <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" required>
            <center>
                <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Sign in</button>
                <p class="mt-5 mb-3 text-muted">&copy; Cyrus Electronics Pvt. Ltd.</p>
            </center>  
        </form>
        </div>

            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/popper.js"></script>
            <script src="bootstrap/js/bootstrap.min.js"></script>



        </body>
        </html>

        <?php 
        $con -> close();
        $con2 -> close();
        ?>
