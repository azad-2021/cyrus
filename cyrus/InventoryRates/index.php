<?php 
include 'connection.php';
include 'session.php';

//$EXEID=$_SESSION['userid'];
//$_SESSION['user']='Accounts';
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$Hour = date('G');

if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
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
  include "modals.php";
  ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Accounts</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row g-3">
            <div class="col-md-12">
              <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
              <form class="needs-validation form-control novalidate rounded-corner" method="POST" style="margin-bottom: 5px;">
                <div class="row g-3">

                  <div class="col-sm-6">
                    <select id="Bank" class="form-control rounded-corner" name="Bank" required>
                      <option value="">Bank</option>
                      <?php
                      $BankData="Select BankCode, BankName from bank order by BankName";
                      $result=mysqli_query($con,$BankData);
                      if (mysqli_num_rows($result)>0)
                      {
                        while ($arr=mysqli_fetch_assoc($result))
                        {
                          ?>
                          <option value="<?php echo $arr['BankCode']; ?>"><?php echo $arr['BankName']; ?></option>
                          <?php
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <select id="Zone" class="form-control rounded-corner" name="Zone" required>
                      <option value="">Zone</option>
                    </select>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="table-responsive" style="margin:20px">
          <center>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Materials.." class="form-control rounded-corner">
            <br>
          </center>
          <table class="table table-hover table-bordered border-primary" id="myTable">
            <thead>
              <th>Sr. No</th>
              <th style="min-width:200px">Item Name</th>
              <th style="min-width:200px">Description</th>
              <th style="min-width:50px">Rate</th>
              <th style="min-width:150px">Updated On</th>
              <th style="min-width:100px">Status</th>
              <th style="min-width:150px">Enable/Disable</th>
              <th style="min-width:150px">Change Category</th>         
            </thead>
            <tbody id="itemdata">

            </tbody>
          </table>
        </div>
        <div id="re"></div>
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

    function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

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

$(document).on('change', '#Enb', function(){

  var Enable = $(this).val();
  var RateID = $(this).attr("id2");

  var ZoneCode = document.getElementById("Zone").value;

  if (Enable!='' && RateID!='') {
    console.log(Enable);
    console.log(RateID);
    $.ajax({
      type:'POST',
      url:'update.php',
      data:{'Enabled':Enable, 'RateID':RateID},
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
  }
});


$(document).on('click', '.ChangeDesc', function(){
  //var Desc = $(this).attr("id");
  var RateID = $(this).attr("id2");
  document.getElementById("DescRateID").value=RateID;
  //document.getElementById("NewDesc").value=Desc;
});


$(document).on('click', '.SaveDesc', function(){
  var RateID=document.getElementById("DescRateID").value;
  var Desc= document.getElementById("NewDesc").value;
  var ZoneCode = document.getElementById("Zone").value;
  console.log(Desc);

  if (Desc) {

    $.ajax({
      type:'POST',
      url:'update.php',
      data:{'Desc':Desc, 'RateID':RateID},
      success:function(data){
        $('#DescForm').trigger("reset");

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
  }
});



$(document).on('click', '.ChangeRate', function(){
  //var Desc = $(this).attr("id");
  var RateID = $(this).attr("id2");
  document.getElementById("RateRateID").value=RateID;
  //document.getElementById("NewDesc").value=Desc;
});


$(document).on('click', '.SaveRate', function(){
  var RateID=document.getElementById("RateRateID").value;
  var Rate= document.getElementById("NewRate").value;
  var ZoneCode = document.getElementById("Zone").value;
  console.log(RateID);

  if (Rate) {

    $.ajax({
      type:'POST',
      url:'update.php',
      data:{'RateC':Rate, 'RateIDRC':RateID},
      success:function(data){
        $('#RateForm').trigger("reset");

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
  }
});

</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>