<?php      
session_start();
include('connection.php'); 

$con3 = mysqli_connect('192.168.1.2:3306', 'Ashok', 'Cyrus@123', 'saas');  
if(mysqli_connect_errno()) {  
  die("Failed to connect with MySQL: ". mysqli_connect_error());  
}


if (isset($_POST['submit'])) {
     // code...

    $username = $_POST['user'];  
    $password = $_POST['password'];  

    //to prevent from mysqli injection  
    $username = stripcslashes($username);  
    $password = stripcslashes($password);  
    $username = mysqli_real_escape_string($con, $username);  
    $password = mysqli_real_escape_string($con, $password);  

    $sql = "select * from pass where UserName = '$username' and Password = '$password'";  
    $result = mysqli_query($con, $sql);  
    $row = mysqli_fetch_assoc($result);  
    $count = mysqli_num_rows($result);  
    ///$EmployeeID = $row['ID'];
    if($count == 1){
        $_SESSION['user']=$row['UserName'];
        $_SESSION['userid']=$row['ID'];
        $ID=$row['ID'];
        $_SESSION['usertype']=$row['UserType'];

        $queryAdd="INSERT INTO `userlog`( `Name`, `EmployeeID`) VALUES ('$username', '$ID')";
        $resultAdd = mysqli_query($con3,$queryAdd); 

        if (($_SESSION['usertype']=="Reporting" or $_SESSION['usertype']=='Dataentry' or $_SESSION['userid']==32) and ($_SESSION['userid']!=26)) {
           header("location: reporting/?");
       }elseif ($_SESSION['usertype']=="Reception") {
        header("location: reception/");
    }elseif ($_SESSION['usertype']=="Executive") {
        header("location: executive/");
    }elseif ($_SESSION['usertype']=="Production") {
        header("location: SaaS/protable.php");
    }elseif ($_SESSION['usertype']=="Store") {
        header("location: SaaS/storetable.php");
    }elseif ($_SESSION['usertype']=="Installation") {
        header("location: SaaS/instable.php");
    }elseif ($_SESSION['usertype']=="Sim Provider") {
        header("location: SaaS/simtable.php");
    }elseif ($_SESSION['usertype']=="Inventory" and $_SESSION['userid']!=27) {
        header("location: inventory/");
    }elseif ($_SESSION['usertype']=="Reminders") {
        header("location: reminders/");
    }elseif ($_SESSION['usertype']=="Accounts") {
        header("location: accounts/");
    }elseif ($_SESSION['usertype']=="Inventory" and $_SESSION['userid']==27) {
        header("location: InventoryRates/");
    }elseif ($_SESSION['usertype']=="AMC" or $_SESSION['userid']==26) {
        header("location: amc/");
    }elseif ($_SESSION['usertype']=="Super User") {
        header("location: admin/");
    }elseif ($_SESSION['usertype']=="Supervisor") {
        header("location: supervisor/");
    }elseif ($_SESSION['usertype']=="Executive Projects") {
        header("location: projects/");
    }elseif ($_SESSION['usertype']=="Sr Executive") {
        header("location: srexecutive/");
    }elseif ($_SESSION['usertype']=="Project Reporting") {
        header("location: projects/");
    }elseif ($_SESSION['usertype']=="Work Report") {
        header("location: amc/workreport.php");
    }elseif ($_SESSION['usertype']=="Billing") {
        header("location: billing/");
    }                    
}else{  
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
        <meta name="author" content="Anant Singh Suryavanshi">
        <title>Cyrus</title>
        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="css/sign-in.css" rel="stylesheet">
        <link rel="icon" href="cyrus logo.png" type="image/icon type">
        <style type="text/css">
        .dropbtn {
          background-color: #04AA6D;
          color: white;
          padding: 16px;
          font-size: 16px;
          border: none;
      }

      .dropdown {
          position: relative;
          display: inline-block;
      }

      .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f1f1f1;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
      }

      .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
      }

      .dropdown-content a:hover {background-color: #ddd;}

      .dropdown:hover .dropdown-content {display: block;}

      .dropdown:hover .dropbtn {background-color: #3e8e41;}
  </style>
</head>
<body>
    <div class="container">
        <center>
            <img class="img-fluid mb-4" alt="Cyrus Logo" height="50" src="cyrus logo.png" width="50">
            <h1 class="h3 mb-3 font-weight-normal">Welcome to Cyrus</h1>
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        </center>
        <form class="form-signin" action="" method="post">           
            <input type="text" id="UName" name="user" class="form-control select" placeholder="User Name" required autofocus>
            
            <input type="password" id="pass" name="password" class="form-control select" placeholder="Password" required>
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
