<?php 
include 'connection.php';
include 'session.php';
require_once 'vendor/shuchkin/simplexlsx/src/SimpleXLSX.php';
use Shuchkin\SimpleXLSX;
//$EXEID=$_SESSION['userid'];
//$_SESSION['user']='Accounts';
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$DateTime = date('d-m-YH.i.s',strtotime($timestamp));
$Hour = date('G');

if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
}


if(isset($_POST['submit'])){

  $file_name = $_FILES['ExcelFile']['name'];
    //$file_name = 'data';
  $file_size =$_FILES['ExcelFile']['size'];
  $file_tmp =$_FILES['ExcelFile']['tmp_name'];
  $file_type=$_FILES['ExcelFile']['type'];
  $tmp = explode('.', $_FILES['ExcelFile']['name']);
  $file_ext = strtolower(end($tmp));    
  $newfilename=$DateTime.".".$file_ext;         
  $extensions= array("xlsx");


  if(in_array($file_ext,$extensions)=== false){
    echo '<script>alert("File must be excel type")</script>';
  }else{

    $Upload=move_uploaded_file($file_tmp,"uploaded/".$newfilename);
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', true);

    if ($xlsx = SimpleXLSX::parse('uploaded/'.$newfilename)) {

     $Data=$xlsx->rows();
   //print(gettype($Data));
     $err=0;
     $InvoiceArr=array();
     for ($i=1; $i <count($Data) ; $i++) { 
      $AckNo=$Data[$i][1];
      $AckDate=date('Y-m-d H:i:s',strtotime($Data[$i][2]));
      $IRNNo=$Data[$i][9];
      $QRCode=$Data[$i][10];
      $InvoiceNo=$Data[$i][3];
      

      $query="SELECT * from `e-invoice-details` WHERE InvoiceNo='$InvoiceNo'";
      $result = mysqli_query($con2,$query);
      if(mysqli_num_rows($result)>0)
      {
       // echo '<script>alert("File already uploaded")</script>';
        $err=1;
        //break;
        $InvoiceArr[]=$InvoiceNo;
      }else{

        $sql = "INSERT INTO `e-invoice-details` (AckNo, AckDate, IRNNo, QRCode, InvoiceNo)
        VALUES ($AckNo, '$AckDate', '$IRNNo', '$QRCode', '$InvoiceNo')";

        if ($con2->query($sql) === TRUE) {
          //echo "New record created successfully";
        } else {
          $err=1;
          echo "Error: " . $sql . "<br>" . $con2->error;
        }

      }
    }

    
    
    $d='';
    if ($InvoiceArr) {
      //echo 'Invoice already uploaded</br>';
      for ($i=0; $i < count($InvoiceArr); $i++) { 
        $d.= $InvoiceArr[$i].', ';
      }
       //echo $d;
       echo '<script>alert("'.count($InvoiceArr).' Invoice already uploaded \n'.$d.'")</script>';
       echo "<meta http-equiv='refresh' content='0'>";
    }else{

      echo '<script>alert("File uploaded successfully")</script>';
      echo "<meta http-equiv='refresh' content='0'>";
    }
    
    
  }else {
    echo SimpleXLSX::parseError();
  }

}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home</title>
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
  <script src="assets/js/jquery-3.6.0.min.js"></script>
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
    </div>

    <div class="search-bar">
      <?php echo $wish; ?>
    </div>
    <?php 
    include "nav.php";
    //include "modals.php";
    ?>
  </header>
  <?php 
  include "sidebar.php";
  ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">E-Invoice</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12" style="margin-bottom:250px">

          <div class="col-lg-12">
            <form class="form-control rounded-corner" action = "" method = "POST" enctype = "multipart/form-data">
              <div class="row">
                <center>
                  <label style="margin: 25px;"><h3>Upload E-Invoice Excel File</h3></label>
                  <div class="col-lg-6">
                    <input type="file" name="ExcelFile">
                  </div>
                  <div class="col-lg-6" style="margin: 25px;">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Submit</button>
                  </div>

                </center>
              </div>
            </form>

          </div>

        </div>
      </div>
      <!-- End Left side columns -->
    </section>
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

  <script src="ajax.js"></script>
  <script type="text/javascript">

    $(document).on('change', '#Category', function(){
      var ItemID = $(this).val();
      var RateID = $(this).attr("id3");
      var ZoneCode = document.getElementById("Zone").value;
      console.log(RateID);
      if(confirm("Do you wish to change item name?")){
        $.ajax({
          url:"update.php",
          method:"POST",
          data:{'ItemIDC':ItemID, 'RateIDC':RateID},
          success:function(data){

            $.ajax({
              type:'POST',
              url:'dataget.php',
              data:{'ZoneCode':ZoneCode},
              success:function(result){
                $('#itemdata').html(result);

              }
            }); 

          }
        });
      }else{
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'ZoneCode':ZoneCode},
          success:function(result){
            $('#itemdata').html(result);

          }
        });
      }
    });



  </script>
</body>

</html>

<?php 




$con->close();
$con2->close();
?>