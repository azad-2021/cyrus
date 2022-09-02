<?php 
include 'connection.php';
include 'session.php';

$EXEID=$_SESSION['userid'];
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

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.0.1/css/stateRestore.dataTables.min.css">

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
          <li class="breadcrumb-item active">Pending Bills</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <!-- Recent Sales -->
      <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="container">

            <div class="modal fade" data-bs-backdrop="static" id="AddMulti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content rounded-corner">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Materials</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <table class="table" id="myTable">
                      <thead>
                        <tr class="w3-blue">
                          <th nowrap>Sl.No</th>      
                          <th nowrap>Rate ID</th>      
                          <th nowrap>Quantity</th>
                          <th nowrap>Action</th>
                        </tr>
                      </thead>
                      <tbody >
                      </tbody>
                    </table>
                    <br>
                    <form id="f1">
                      <div class="row text-centered">
                        <div class="col-lg-5">
                          <center>
                            <label >Select Items</label>
                          </center>
                          <select id="MaterialView" class="form-control rounded-corner" name="Items" required>
                            <option value="">Select</option>
                          </select>
                        </div>
                        <div class="col-lg-5">
                          <center>
                            <label>Enter Quantity</label>
                          </center>
                          <input type="number" name="" id="qty" class="form-control rounded-corner" onkeydown="limit(this);" onkeyup="limit(this);">
                        </div>
                        <div class="col-lg-2">
                          <center>
                            <label></label>
                            <br>
                          </center>
                          <button type="button" class="btn btn-primary btn-lg" id="save">Add</button>
                        </div>
                        <div class="col-lg-3 d-none">
                          <input type="number" name="" id="orderid" class="form-control">
                        </div>
                        <div class="col-lg-3 d-none">
                          <input type="number" name="" id="ZoneCode" class="form-control">
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cl" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="row g-3">
              <div class="col-md-12">
                <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
                <form class="needs-validation form-control novalidate my-select4" method="POST" style="margin-bottom: 5px;">
                  <div class="row g-3">

                    <div class="col-sm-4">
                      <select id="BankM" class="form-control rounded-corner" name="Bank" required>
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
                    <div class="col-sm-4">
                      <select id="ZoneM" class="form-control rounded-corner" name="Zone" required>
                        <option value="">Zone</option>
                      </select>
                    </div>
                    <div class="col-sm-4">
              <!--
              <select id="MaterialView" class="form-control rounded-corner" name="" required>
                <option value="">select</option>
              </select>
            -->
            <button type="button"  class="btn btn-primary form-control rounded-corner" data-bs-toggle="modal" data-bs-target="#AddMulti">Select Material</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <br><br>
  <div id="viewResult"></div>
  <table class="table table-hover table-bordered border-primary display">
    <thead>
      <tr>
        <th>Branch</th>
        <th>Order ID</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="MultiOrders">

    </tbody>
  </table>

  <center>
    <button class="btn btn-primary S" style="margin: 20px;" id="button">Submit</button>
  </center>

</div>
</div>
</div>
<!-- End Recent Sales -->
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
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="ajax.js"></script>


<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>

<script type="text/javascript">
  var qty = [];
  var rateid = [];
  var ItemID=[];
  var BankCode=0;
  $(document).on('change','#BankM', function(){
    BankCode = $(this).val();
    if(BankCode){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BankCode':BankCode},
        success:function(result){
          $('#ZoneM').html(result);

        }
      }); 
    }else{
      $('#ZoneM').html('<option value="">Zone</option>');
    }
  });

  $(document).on('change','#ZoneM', function(){
    var ZoneCode = $(this).val();
    console.log(BankCode);
    if(ZoneCode){
      $.ajax({
        type:'POST',
        url:'multiordersdata.php',
        data:{'ZoneCode':ZoneCode, 'BankCode':BankCode},
        success:function(result){
          $('#MultiOrders').html(result);

        }
      }); 
    }
  });



  Array.prototype.contains = function(obj) {
    var i = this.length;
    while (i--) {
      if (this[i] == obj) {
        return true;
      }
    }
    return false;
  }


  $('#save').on('click', function() {
      //console.log($('#MaterialView').val());
      const obj = JSON.parse($('#MaterialView').val());
      console.log(rateid[0]);
      if (obj.ItemID==1654) {
        swal("error", "Item is in undecided category. Please contact to store","error");
      }else if(rateid.contains(obj.RateID)==true){
        swal("error", "Item already exist", "error");
      }else{
        var RateID=obj.RateID;
        var Qty=$('#qty').val();
        var count = $('#myTable tr').length;
        if(RateID!="" && Qty !=""){
          qty.push(Qty);
          rateid.push(RateID);
          ItemID.push(obj.ItemID);
          //console.log(qty);
          //console.log(rateid);
          $('#myTable tbody').append('<tr class="child"><td>'+count+'</td><td>'+obj.Name+'</td><td>'+Qty+'</td><td><a href="javascript:void(0);" class="remCF1 btn btn-small btn-danger" id="'+obj.ItemID+'">Remove</a></td></tr>');
        }
      }
      document.getElementById("f1").reset();

    });
  $(document).on('click','.remCF1',function(){
    var delItem = $(this).attr("id");
    console.log(ItemID);
    const index = ItemID.indexOf(delItem);
    if (index > -1) {
      ItemID.splice(index, 1);
      rateid.splice(index, 1);
      qty.splice(index, 1);
    }
    console.log(ItemID);
    $(this).parent().parent().remove();
    $('#myTable tbody tr').each(function(i){            
     $($(this).find('td')[0]).html(i+1);          
   });
  });



  $(document).on('change','#ZoneM', function(){
    var ZoneCode = $(this).val();
    console.log('>> '+ rateid.length);
    ItemID.splice(0,ItemID.length);
    rateid.splice(0,rateid.length);
    qty.splice(0,qty.length);
    console.log('>>> '+ rateid.length);

    console.log(BankCode);
    if(ZoneCode){
      $.ajax({
        type:'POST',
        url:'multiordersdata.php',
        data:{'ZoneCodeM':ZoneCode},
        success:function(result){
          $('#MaterialView').html(result);

        }
      }); 
    }else{
      $('#MaterialView').html('<option value="">material</option>'); 
    }
  });

  function limit(element)
  {
    var max_chars = 5;

    if(element.value.length > max_chars) {
      element.value = element.value.substr(0, max_chars);
    }
  }



  var data=[];
  
  $('#button').on('click', function() {
    var array = [];

    $("input:checkbox[name=select]:checked").each(function() {
        //
        array.push($(this).val());
      });
    console.log(array);
    data=array;
    console.log(rateid);
    const Data= JSON.stringify(array);
    console.log(Data);
    if (array.length==0 || rateid.length==0) {
      swal("error", "Item or Order field is empty", "error");
    }else{

      var element = document.getElementById("button");
      element.classList.add("d-none");

      $.ajax({
        type:'POST',
        url:'addmultiorders.php',
        data:{OrderID:Data, RateID: JSON.stringify(rateid), ItemID: JSON.stringify(ItemID), Qty: JSON.stringify(qty)},
        success:function(result){
 
          var delayInMilliseconds = 2000; 
          console.log(array);
          setTimeout(function() {
            location.reload();
          }, delayInMilliseconds);
          $('#viewResult').html(result);

        }
      }); 
    }
  });


  $(document).on('click', '.S', function(){
    var flag=0;
    flag = data[0];
    flag2 = rateid[0];
    console.log('f:'+flag);
    if (!flag) {
      swal("error", "Please select OrderID", "error");
    }else if (!flag2) {
      swal("error", "Please select Items", "error");
    }else{

      var delayInMilliseconds = 2000; 
      console.log(array);
      setTimeout(function() {
        location.reload();
      }, delayInMilliseconds);


    }
  });
</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>