<?php      
session_start();
    include('connection.php');  
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

           // $queryAdd="INSERT INTO `userlog`( `Name`, `EmployeeID`) VALUES ('$username', '$EmployeeID')";
            //$resultAdd = mysqli_query($con,$queryAdd);
                header("location: reporting.php?");
                echo "loged in successfully" ;             
           //header("location: form.php"); 
           }  
        else{  
            echo '<script>alert("Invalid Username or Password")</script>';  
        }     
?>  