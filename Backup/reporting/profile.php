<?php 
include 'connection.php';
include 'session.php';

$EXEID=$_SESSION['userid'];
$Type=$_SESSION['usertype'];
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$Hour = date('G');
//echo $_SESSION['user'];


if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
}


if(isset($_POST['submit'])){

  $newPassword=$_POST['Password'];
  $OldPassword=$_POST['OldPassword'];
    //echo $newPassword;
  $query ="SELECT * FROM `pass` WHERE ID=$EXEID and Password='$OldPassword'";
  $results = mysqli_query($con, $query);

  if ($results->num_rows > 0) {
   $sql = "UPDATE pass SET Password='$newPassword' WHERE ID=$EXEID";

   if ($con->query($sql) === TRUE) {
     header('location:logout.php');
   } else {
    echo "Error updating record: " . $con->error;
  }
}else{
  echo '<script>alert("Old Password not matched")</script>';
}

}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Account Settings</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/cyrus logo.png" rel="icon">
  

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="assets/js/sweetalert.min.js"></script>


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/cyrus logo.png" alt="">
        <span class="d-none d-lg-block">Cyrus</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <?php echo $wish; ?>
    </div>
    <?php 
    include "nav.php";
    //include "modals.php";
    ?>

  </header><!-- End Header -->
  <?php 
  include "sidebar.php";
  include "modals.php";
  ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <center>
            <form class="form-signin" action="" method="POST">
              <center>
                <h5>Change Password</h5>
              </center>
              <input type="text" id="pass" name="OldPassword" class="form-control rounded-corner" placeholder="Old Password" disabled style="max-width:300px" value='<?php echo $_SESSION['user'] ?>'>
              <br>
              <input type="password" id="pass" name="OldPassword" class="form-control rounded-corner" placeholder="Old Password" required style="max-width:300px">
              <input type="password" id="pass" name="Password" class="form-control rounded-corner" placeholder="New Password" required style="max-width:300px">
              <br>
              <center>
                <button class="btn btn-primary" name="submit" type="submit">Submit</button>
              </center>  
            </form>
          </center>
        </div>
      </div>
    </section>
    <div id="data"></div>
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright 2022 <strong><span>Cyrus</span></strong>. All Rights Reserved
    </div>
  </footer>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script type="text/javascript">
    $(document).on('click','.Find', function(){

     var Challan= document.getElementById("ChallanF").value;
     if(Challan){
      window.open("challan.php?ChallanNo="+Challan, '_blank').focus();

    }
  });



    $(document).on('change','#EmployeeCodeW', function(){
     document.getElementById("Sdate").value='';
   });

    $(document).on('change','#Sdate', function(){

     Sdate= document.getElementById("Sdate").value;
     EmployeeCode= document.getElementById("EmployeeCodeW").value;

     if(Sdate){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'SDateCh':Sdate, 'EmployeeCodeCh':EmployeeCode},
        success:function(result){
         $('#ChallanView').html(result);
       }
     });

    }
  });


    $(document).on('click','.CancelChallan', function(){

     Challan =  $(this).attr("id");
     Sdate= document.getElementById("Sdate").value;
     EmployeeCode= document.getElementById("EmployeeCodeW").value;
     console.log(EmployeeCode);
     console.log(Sdate);

     if(Challan){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'ChallanCancel':Challan},
        success:function(result){
      //console.log((result));
      swal("success","Challan Cancelled","success");

      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'SDateCh':Sdate, 'EmployeeCodeCh':EmployeeCode},
        success:function(result){
          $('#ChallanView').html(result);

        }
      }); 

    }

  }); 

    }
  });



    $(document).on('click','.PrintChallan', function(){

     Challan =  $(this).attr("id");
     Type=$(this).attr("id2");
     window.open("challan.php?ChallanNo="+Challan+"&Type="+Type, '_blank').focus();

   });

 </script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>