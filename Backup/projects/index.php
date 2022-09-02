<?php 
include 'connection.php';
include 'session.php';
$Type=$_SESSION['usertype'];
if (isset($_GET['user'])) {
  $EXEID=$_GET['user'];
  $_SESSION['query']=$EXEID;
}if (isset($_SESSION['query'])) {
  $EXEID=$_SESSION['query'];
}else{
  $EXEID=$_SESSION['userid'];
}
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));
$NintyDays = date('Y-m-d', strtotime($Date. ' - 90 days'));

$Hour = date('G');
//echo $_SESSION['user'];


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
  <?php include"header.php" ?>
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
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns 
        <div class="col-lg-12">
          <div class="row">

            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">

 
                  <div class="col-12">
                    <div class="card recent-sales overflow-auto">

                      <div class="card-body">

                      </div>
                    </div>
                  </div>

                </div>
              </div>
              End Left side columns -->

            </section>
          </main>
          <!-- End #main -->

          <?php include"footer.php"; ?>

          <script type="text/javascript">

            $("#SelectAll").change(function () {
              $("input:checkbox").prop('checked', $(this).prop("checked"));
            });

            $(document).on('change','#Organization', function(){
              var OrganizationCode = $(this).val();
              if(OrganizationCode){
                $.ajax({
                  type:'POST',
                  url:'dataget.php',
                  data:{'Organization':OrganizationCode},
                  success:function(result){
                    $('#Division').html(result);

                  }
                }); 
              }else{
                $('#Division').html('<option value="">No Division</option>'); 
              }
            });

            $(document).on('change','#Division', function(){
              var DivisionCode = $(this).val();
              if(DivisionCode){
                $.ajax({
                  type:'POST',
                  url:'dataget.php',
                  data:{'Division':DivisionCode},
                  success:function(result){
                    $('#Site').html(result);

                  }
                }); 
              }
            });

            $(document).on('click','.showAddOrder', function(){
              $('#AddOrder').modal('show');
            });

            $(document).on('click','.SaveOrder', function(){
              var SiteCode=[];
              var ItemID=[];
              var Rate=[];
              var ItemName=[];
             $("input:checkbox[name=select]:checked").each(function() {

              SiteCode.push($(this).val());
            });
             console.log(SiteCode);
             var input = document.getElementsByName('NameArray[]');
             var input2 = document.getElementsByName('RateArray[]');
             var input3 = document.getElementsByName('ItemArray[]');

             for (var i = 0; i < input.length; i++) {

              var a = input[i];
              var b = input2[i];
              var c = input3[i];

              ItemName.push(a.value);
              Rate.push(b.value);
              ItemID.push(c.value);
             }

             console.log(ItemName);
             console.log(Rate);
             console.log(ItemID);

             /*
             if(DivisionCode){
              $.ajax({
                type:'POST',
                url:'dataget.php',
                data:{'Division':DivisionCode},
                success:function(result){
                  $('#Site').html(result);

                }
              }); 
            }*/
          }); 


        </script>


      </body>

      </html>

      <?php 

      $con->close();
      $con2->close();
    ?>