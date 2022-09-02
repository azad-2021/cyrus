<?php 
include 'connection.php';
include 'session.php';

$EXEID=$_SESSION['userid'];
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



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Add New</title>
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
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <!--
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Total <span>| Students </span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6>145</h6>
                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase today</span>

                    </div>
                  </div>
                </div>

              </div>
              </div>
            -->
            <!-- End Sales Card -->

            <!-- Revenue Card -->
            <!--
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Total <span>| Received Amount</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6>$3,264</h6>
                      <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase this month</span>

                    </div>
                  </div>
                </div>

              </div>
              </div>
            -->
            <!-- End Revenue Card -->

            <!-- Customers Card -->
            <!--
            <div class="col-xxl-4 col-xl-4">

              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Total <span>| Expence</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>1244</h6>
                      <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease this month</span>

                    </div>
                  </div>

                </div>
              </div>

            </div>
          -->
          <!-- End Customers Card -->

          <!-- Reports -->
            <!--
            <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Reports <span>/Today</span></h5>
                -->

                <!-- Line Chart -->
                  <!--
                  <div id="reportsChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'Sales',
                          data: [31, 40, 28, 51, 42, 82, 56],
                        }, {
                          name: 'Revenue',
                          data: [11, 32, 45, 32, 34, 52, 41]
                        }, {
                          name: 'Customers',
                          data: [15, 11, 32, 18, 9, 24, 11]
                        }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy HH:mm'
                          },
                        }
                      }).render();
                    });
                  </script>
                -->
                <!-- End Line Chart -->

              </div>

            </div>
          </div><!-- End Reports -->

          <!-- Recent Sales -->
          <div class="col-12">
            <div class="card recent-sales overflow-auto">

              <div class="card-body">
                <h6 class="card-title">Create  <span>| Challan</span>
                  &nbsp;&nbsp;
                  <input class="form-check-input TypeRR" type="radio" name="Type" value="Railways" id="Type">
                  <label class="form-check-label">
                    For Railways
                  </label>
                  
                  &nbsp;&nbsp;
                  
                  <input class="form-check-input TypeRR" type="radio" name="Type" value="Employee Purchase" id="Type">
                  <label class="form-check-label">
                    Employee Purchase
                  </label>
                  
                  
                </h6>

                <form class="form-control rounded-corner" method="POST" style="margin-bottom: 5px;" id="f1">
                  <div class="row g-3">

                    <div class="col-sm-3">
                      <label>States</label>
                      <select id="states" class="form-control rounded-corner" required>
                        <option value="">Select</option>
                        <?php

                        $Data="Select * from states order by `State Name`";
                        $result=mysqli_query($con2,$Data);
                        if (mysqli_num_rows($result)>0)
                        {
                          while ($arr=mysqli_fetch_assoc($result))
                          {
                            ?>
                            <option value="<?php echo $arr['StateCode']; ?>"><?php echo $arr['State Name']; ?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <label>Employee</label>
                      <select id="Employee" class="form-control rounded-corner" required>
                        <option value="">select</option>
                      </select>
                    </div>
                    <div class="col-sm-2">
                      <label>State Code</label>
                      <input type="number" id="statecode" class="form-control rounded-corner" disabled>
                    </div>
                    <div class="col-sm-2">
                      <label>Number of Rows</label>
                      <input type="number" id="addrows" class="form-control rounded-corner" disabled>
                    </div>
                    <div class="col-sm-2">
                      <button type="button" style="margin-top:25px" class="btn btn-primary AddRows" >Add</button>
                    </div>
                  </div>
                </form>
                <center><input type="text" class="form-control rounded-corner" id="address" Name="Address" placeholder="Address" style="max-width:300px"></center>
                <br><br>
                <div class="table-responsive container">
                  <table class="table table-bordered border-primary display datatable"  id="myTable">
                    <thead>
                      <tr>
                        <th style="min-width:80px">Sr. No.</th>
                        <th style="min-width:300px">Description</th>
                        <th style="min-width:150px">Bar Code</th>
                        <th style="min-width:120px">Rate</th>
                        <th style="min-width:120px">Discount</th>
                        <th style="min-width:200px">Select Category</th>
                      </tr>
                    </thead>
                    <tbody id="material">

                    </tbody>
                  </table>
                </div>
                <center>
                  <button type="button" style="margin-top:25px" class="btn btn-primary save" >Submit</button>
                </center>
                <br>

                <div id="indata"></div>
                <!--<div id="inid2"></div>-->
              </div>

            </div>

          </div>
        </div><!-- End Recent Sales -->
      </div>
    </div><!-- End Left side columns -->

  </div>
</section>

</main><!-- End #main -->

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


  var hsncode = [];
  var gstrates = [];
  var rows=0;


  function limit(element)
  {
    var max_chars = 5;

    if(element.value.length > max_chars) {
      element.value = element.value.substr(0, max_chars);
    }
  }

  $(document).on('change','#states', function(){
    var StateCode = $(this).val();
    document.getElementById("statecode").value = StateCode;
    if(StateCode){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'StateCode':StateCode},
        success:function(result){
          $('#Employee').html(result);

        }
      }); 
    }else{
      $('#Employee').html('<option value="">Employee</option>');
    }
  });


  $(document).on('change','#Employee', function(){
    document.getElementById("addrows").disabled = false;
  });

  var Type='Employee';


  $(document).on('change','#Type', function(){

    if ($("input:radio[name=Type]:checked")) {
      Type=$(this).val();
      
    }
  });


  $(document).on('click', '.AddRows', function () {
   rows = document.getElementById("addrows").value;
   var element = document.getElementById("material");
   element.classList.remove("d-none");
   if(rows){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'Rows':rows, 'Type':Type},
      success:function(result){
        $('#material').html(result);

      }
    }); 
  }else{
    swal("error", "Enter Number of rows.", "error");
  }

});



  $(document).on('click', '.save', function () {
    var Desc = [];
    var BarCode = [];
    var HSN=[];
    var GST=[];
    var rate=[];
    var amount=[];
    var category=[];
    var Discount=[];
    var i2=2000
    var i3=3000
    var i4=4000
    var i5=5000


    alert(Type);

    for (let i = 1; i <=rows; i++) {
      console.log(i);
      var EmployeeCode=document.getElementById("Employee").value;
      var StateCode=document.getElementById("states").value;
      var Address=document.getElementById("address").value;
      var desc=document.getElementById(i).value;
      var barcode=document.getElementById(i2).value;
      var Rate=document.getElementById(i3).value;
      var data=document.getElementById(i4).value;
      var discount=document.getElementById(i5).value;
      var error=0;
      if (desc=='' || barcode=='' || Rate=='' || data=='' || Address=='') {
        swal("error", "Please enter all fields", "error");
        error=1;
      }else{
        const obj = JSON.parse(data);
        hsn = obj.HSN;
        gst=obj.GST;
        Desc.push(desc);
        BarCode.push(barcode);
        HSN.push(hsn);
        GST.push(gst);
        rate.push(Rate);

        category.push(obj.ItemID);

        if (discount!='') {
          Discount.push(discount);
        }else{
          Discount.push(0);
        }

        i2++;
        i3++;
        i4++;
        i5++;
      }


    }


    if(error==0){

      console.log(Discount);
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'ItemID':Desc, 'BarCode2':BarCode, 'HSN2':HSN, 'GST2':GST, 'rate':rate, 'OrderID2':0, 'EmployeeCode2':EmployeeCode, 'Statecode':StateCode, 'Discount':Discount, 'Type':Type, 'Address':Address},
        success:function(result){
          var InsertedID=(result);
          console.log(InsertedID);
          if (InsertedID>0) {
            swal("success","Material Confirmed","success");
            var element = document.getElementById("material");
            element.classList.add("d-none");
            document.getElementById("f1").reset();
            document.getElementById("address").value='';
            var delayInMilliseconds = 2000; 
            
            setTimeout(function() {
              location.reload();
            }, delayInMilliseconds);
          }else{
            alert(InsertedID);
          }
        }
      });

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
      data:{'SDate':Sdate, 'EmployeeCodeW':EmployeeCode},
      success:function(result){
        var AStatus = (result);
        if (AStatus==1) {
          document.getElementById("address").required = false;
          var element = document.getElementById("address");
          element.classList.add("d-none");
        }else{
          document.getElementById("address").required = true;
          var element = document.getElementById("address");
          element.classList.remove("d-none");            
        }

      }
    }); 
  }
});

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