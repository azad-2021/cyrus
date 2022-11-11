<?php 
include 'connection.php';
include 'session.php';

//$EXEID=$_SESSION['userid'];

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));
$NintyDays = date('Y-m-d', strtotime($Date. ' - 90 days'));

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

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.0.1/css/stateRestore.dataTables.min.css">


  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="assets/js/sweetalert.min.js"></script>
  <style type="text/css">
  table{
    font-size: 14px;
  }
  th,a {
    cursor: pointer;
  }


  .overlay{
    display: none;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 999;
    background: rgba(255,255,255,0.8) url("assets/img/loader.gif") center no-repeat;
  }
  /* Turn off scrollbar when body element has the loading class */
  body.loading{
    overflow: hidden;   
  }
  /* Make spinner image visible when body element has the loading class */
  body.loading .overlay{
    display: block;
  }

</style>
</head>
<body>
 <div class="overlay"></div>
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
        <li class="breadcrumb-item active">Billing</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">

        <form class="form-control rounded-corner" method="POST" style="margin-bottom: 5px;">
          <div class="row">

            <div class="col-lg-3">
              <label>Select Bank</label>
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
            <div class="col-lg-3">
              <label>Select Zone/Region</label>
              <select id="Zone" class="form-control rounded-corner" name="Zone" required>
                <option value="">Zone</option>
              </select>
            </div>
            <div class="col-lg-3">
              <label>Select Branch</label>
              <select id="Branch" class="form-control rounded-corner" name="Branch" required>
                <option value="">Branch</option>
              </select>
            </div>

            <div class="col-lg-3">
              <label>Branch Code</label>
              <input type="text" class="form-control rounded-corner" id="Branch_Code" name="" disabled>
            </div>

            <div class="col-lg-3">
              <label>GST No.</label>
              <input type="text" class="form-control rounded-corner" id="BranchGST" name="" disabled>
            </div>

            <div class="col-lg-3">
              <label>Branch Email</label>
              <input type="text" class="form-control rounded-corner" id="BranchEmail" name="" disabled>
            </div>
            <div class="col-lg-3">
              <label>Billing From</label>
              <select id="BillingFrom" class="form-control rounded-corner" name="" required>
                <option value="">Select</option>
                <option value="CEBH">Bihar</option>
                <option value="CECH">Chandigarh</option>
                <option value="CEDL">Delhi</option>
                <option value="CEUP">Uttar Pradesh</option>
                <option value="CIUP">CISPL</option>
              </select>
            </div>
            <div class="col-lg-3">
              <label>State</label>
              <select id="BillingTo" class="form-control rounded-corner" name="" required>
                <option value="">Select</option>
                <?php
                $Data="SELECT * FROM cyrusbilling.states ORDER BY `State Name`";
                $result=mysqli_query($con,$Data);
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
          </div>
          <center>
            <div class="col-lg-3">
              <label>Select Employee</label>
              <select id="employee" class="form-control rounded-corner" name="Employee" required>
                <option value="">Select</option>
                <?php
                $Data="SELECT * FROM cyrusbackend.employees WHERE Inservice=1 ORDER BY `Employee Name`";
                $result=mysqli_query($con,$Data);
                if (mysqli_num_rows($result)>0)
                {
                  while ($arr=mysqli_fetch_assoc($result))
                  {
                    ?>
                    <option value="<?php echo $arr['EmployeeCode']; ?>"><?php echo $arr['Employee Name']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>
          </center>

        </div>
      </form>

      <div class="row">


        <div class="col-lg-12" align="center">
         <center><label>Select material type</label></center>
         <div class="form-check form-check-inline">
          <input class="form-check-input MaterialType" type="radio" name="MaterialType" value="Approved">
          <label class="form-check-label" for="inlineRadio1">Approved Material</label>
        </div>
        <div class="form-check form-check-inline MaterialType">
          <input class="form-check-input MaterialType" type="radio" name="MaterialType" id="MaterialType" value="Additional">
          <label class="form-check-label" for="inlineRadio2">Additional Material</label>
        </div>

      </div>

        <!--
        <div class="col-lg-6" align="center">
          <center><label>Select discount type</label></center>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="DiscountType1" name="DiscountType" value="Percent" disabled>
            <label class="form-check-label" for="inlineRadio1">Discount in %</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="DiscountType2" name="DiscountType" value="Rupees" disabled>
            <label class="form-check-label" for="inlineRadio2">Discount in ₹</label>
          </div>

        </div>
      -->


    </div>

    <form id="f1" style="margin:25px;">
      <div class="row text-centered">

        <div class="col-lg-3" id="ApprovedItem">
          <center>
            <label >Select Items</label>
          </center>
          <select id="ItemA" class="form-control rounded-corner2" name="Items" required disabled>
            <option value="">Select</option>
          </select>
        </div>

        <div class="col-lg-2" id="ApprovedRate">
          <center>
            <label >Rate</label>
          </center>
          <input type="text" name="" id="Rate" class="form-control rounded-corner" disabled>
        </div>


        <div class="col-lg-3 d-none" id="AdditionalItem">
          <center>
            <label >Enter Material Name</label>
          </center>
          <input type="text" name="" id="ItemAA" class="form-control rounded-corner">
        </div>



        <div class="col-lg-2 d-none" id="AdditionalRate">
          <center>
            <label >Rate</label>
          </center>
          <input type="number" name="" id="RateA" class="form-control rounded-corner" onkeydown="limit3(this);" onkeyup="limit3(this);">
        </div>

        <div class="col-lg-3">
          <center>
            <label>Bar Code</label>
          </center>
          <input type="text" name="BarCode" id="BarCode" class="form-control rounded-corner" style="text-transform: uppercase; ">
        </div>
        <div class="col-lg-2">
          <center>
            <label>Enter Quantity</label>
          </center>
          <input type="number" name="" id="qty" class="form-control rounded-corner" onkeydown="limit2(this);" onkeyup="limit2(this);" disabled>
        </div>

        <div class="col-lg-2">
          <center>
            <label>Amount</label>
          </center>
          <input type="text" name="" id="Amount" class="form-control rounded-corner" disabled>
        </div>
        <div class="col-lg-3">
          <center>
            <label>Discount</label>
          </center>
          <input type="number" name="" id="Discount" class="form-control rounded-corner" value="0" onkeydown="limit4(this);" onkeyup="limit4(this);">
        </div>

        <div class="col-lg-3">
          <center>
            <label >GST Rate</label>
          </center>
          <input type="text" name="" id="GSTRate" class="form-control rounded-corner" disabled>
        </div>

        <div class="col-lg-3">
          <center>
            <label >HSN Code</label>
          </center>
          <input type="text" name="HSNCode" id="HSNCode" class="form-control rounded-corner" disabled>
        </div>


        <div class="col-lg-3">
          <center>
            <label >Select Item Category</label>
          </center>
          <select class="form-control rounded-corner" id="GstRates">
            <option value="">Select</option>
            <?php
            $Query="SELECT * FROM `gst rates` order by CatagoryName";
            $resultG=mysqli_query($con2,$Query);
            while ($rowG=mysqli_fetch_assoc($resultG)){

              $d = array("HSN"=>$rowG['HSNCode'], "GST"=>$rowG['Rate'], "CategoryID"=>$rowG['ItemID']);
              $data = json_encode($d);
              echo "<option value='".$data."''>".$rowG['CatagoryName'].'</option>';
            }
            ?>

          </select>
        </div>

        <center>
          <div class="col-lg-12"> 
            <br>           
            <button type="button" class="btn btn-primary btn-lg CreateInvoice">Add</button>
          </div>
        </center>
      </div>
    </form>
    <div class="table-responsive" style="margin:25px;">
      <table class="table table-hover table-bordered border-primary display">
        <thead>
          <tr>
            <th style="min-width:200px">Material Name</th>
            <th style="min-width:80px">Rate</th>
            <th style="min-width:80px">Quantity</th>
            <th style="min-width:100px">Amount</th>
            <th style="min-width:100px">Discount</th> 
            <th style="min-width:100px">Accessible Value</th> 
            <th style="min-width:80px">GST %</th>
            <th style="min-width:80px">HSN/SAC</th>
            <th style="min-width:120px">Category</th>
            <th style="min-width:100px">Action</th>

          </tr>
        </thead>
        <tbody id="MaterialDetails">

        </tbody>
      </table>
    </div>
    <h4 style="float:right;">Total Amount with GST : <span id="GSTAmount"></span></h4>
    <div class="row">
      <div class="col-lg-4" align="center">
        <label>Enter Additional Discount</label>
        <input type="number" name="AdditionalDisc" id="AdditionalDisc" class="form-control rounded-corner">
      </div>
    </div>
    <center>
      <button type="button" class="btn btn-primary GenerateInvoice">Generate Invoice</button>
    </center>
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


<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>

<script src="assets/js/main.js"></script>
<script src="ajax.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('table.display').DataTable( {
      responsive: false,
      stateSave: false,
    } );
  } );


  function limit(element)
  {
    var max_chars = 5;

    if(element.value.length > max_chars) {
      element.value = element.value.substr(0, max_chars);
    }
  }

  function limit2(element)
  {
    var max_chars = 5;

    if(element.value.length > max_chars) {
      element.value = element.value.substr(0, max_chars);
    }

    var Qty=document.getElementById("qty").value;
    var Rate= document.getElementById("Rate").value;
    var RateA= document.getElementById("RateA").value;
    if (Qty && Rate) {
      //alert(Rate*Qty);
      document.getElementById("Amount").value=parseFloat(Rate)*parseFloat(Qty);
    }else if (Qty && RateA){
      document.getElementById("Amount").value=parseFloat(RateA)*parseFloat(Qty);
    }

  }


  function limit3(element)
  {
    var max_chars = 10;

    if(element.value.length > max_chars) {
      element.value = element.value.substr(0, max_chars);
    }

    var Qty=document.getElementById("qty").value;
    var Rate= document.getElementById("Rate").value;
    var RateA= document.getElementById("RateA").value;
    if (Qty && Rate) {
      //alert(Rate*Qty);
      var Amount=parseFloat(Rate)*parseFloat(Qty);
      document.getElementById("Amount").value=parseFloat((Amount).toFixed(2));
    }else if (Qty && RateA){
      var Amount=parseFloat(RateA)*parseFloat(Qty);
      document.getElementById("Amount").value=parseFloat((Amount).toFixed(2));
    }

  }


  function limit4(element)
  {
    var max_chars = 10;

    if(element.value.length > max_chars) {
      element.value = element.value.substr(0, max_chars);
    }

    var Discount=document.getElementById("Discount").value;

    if (Discount>0) {
      document.getElementById("DiscountType1").disabled=false;
      document.getElementById("DiscountType2").disabled=false;
    }else{
      document.getElementById("DiscountType1").disabled=true;
      document.getElementById("DiscountType2").disabled=true;
    }

  }



  $(document).on('change','#Zone', function(){
    var ZoneCode = $(this).val();

    if(ZoneCode){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'ZoneCode':ZoneCode},
        success:function(result){
          $('#Branch').html(result);

        }
      }); 

      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'ZoneCodeM':ZoneCode},
        success:function(result){
          $('#ItemA').html(result);

        }
      });


    }else{

      $('#Branch').html('<option value=""> Branch </option>'); 
    }
  });


  $(document).on('change','#Branch', function(){
    var BranchCode = $(this).val();
    var EmployeeCode=document.getElementById("employee").value;
    if(BranchCode){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BranchCodeD':BranchCode},
        success:function(result){

          const obj = JSON.parse(result);
          Branch_Code = obj.Branch_Code;
          GST=obj.GST;
          Email=obj.Email;

          document.getElementById("Branch_Code").value=Branch_Code;
          document.getElementById("BranchGST").value=GST;
          document.getElementById("BranchEmail").value=Email;

        }
      });

      if(BranchCode && EmployeeCode){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'BranchAddShow':BranchCode,'EmployeeCodeAdddShow':EmployeeCode},
          success:function(result){

            $('.display').DataTable().clear();
            $('.display').DataTable().destroy();
            $('#MaterialDetails').html(result);

            $('table.display').DataTable( {

              rowReorder: {
                selector: 'td:nth-child(2)'
              },
              "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
              responsive: false
            } );

          }
        }); 


        $.ajax({
          type:'POST',
          url:'addbilling.php',
          data:{'BranchCodeAmount':BranchCode,'EmployeeCodeAmount':EmployeeCode},
          success:function(result){

            document.getElementById("GSTAmount").innerHTML=result;

          }
        }); 

      }

      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'CInvoiceNo':BranchCode},
        success:function(result){
          $('#CInvoiceNo').html(result);

        }
      });


    }else{
      $('#CInvoiceNo').html('<option value="">Select</option>');
    }
  });


  $(document).on('change','#employee', function(){
    var BranchCode = document.getElementById("Branch").value;
    var EmployeeCode=document.getElementById("employee").value;
    if(BranchCode && EmployeeCode){

      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BranchAddShow':BranchCode,'EmployeeCodeAdddShow':EmployeeCode},
        success:function(result){

          $('.display').DataTable().clear();
          $('.display').DataTable().destroy();
          $('#MaterialDetails').html(result);

          $('table.display').DataTable( {

            rowReorder: {
              selector: 'td:nth-child(2)'
            },
            "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
            responsive: false
          } );

        }

      }); 

      $.ajax({
        type:'POST',
        url:'addbilling.php',
        data:{'BranchCodeAmount':BranchCode,'EmployeeCodeAmount':EmployeeCode},
        success:function(result){

          document.getElementById("GSTAmount").innerHTML=result;

        }
      }); 


      

    }
  });


  $(document).on('change','#ItemA', function(){
    var Data = $(this).val();

    if(Data){

      document.getElementById("qty").disabled=false;
      const obj = JSON.parse(Data);
      RateID = obj.RateID;
      Rate=obj.Rate;
      var Qty=document.getElementById("qty").value;
      document.getElementById("Rate").value=Rate;
      if (Qty) {
        document.getElementById("Amount").value=Rate*Qty;
      }

    }else{
      document.getElementById("qty").disabled=true;
    }
  });




  $(document).on('change','#BankR', function(){
    var BankCode = $(this).val();
    if(BankCode){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BankCode':BankCode},
        success:function(result){
          $('#ZoneR').html(result);

        }
      }); 
    }else{
      $('#ZoneR').html('<option value="">Zone</option>');
    }
  });


  $(document).on('change','#ZoneR', function(){
    var ZoneCode = $(this).val();
    if(ZoneCode){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'ZoneCodeR':ZoneCode},
        success:function(result){
          $('#materialRates').html(result);

        }
      }); 

    }
  });


  $(document).on('change','#GstRates', function(){
    var Data = $(this).val();
    console.log(Data);
    const obj = JSON.parse(Data);
    HSN = obj.HSN;
    GST=obj.GST;

    document.getElementById("HSNCode").value = HSN;
    document.getElementById("GSTRate").value = GST;
  });


  var Materialtype='';

  $( ".MaterialType" ).change(function() {
    Materialtype=$(this).val();
    $('#f1').trigger("reset");
  //alert(Materialtype);
  if (Materialtype) {
    if (Materialtype=='Approved') {
      document.getElementById("ItemA").disabled=false;
      //document.getElementById("qty").disabled=true;
      $("#ApprovedItem").removeClass("d-none");
      $("#ApprovedRate").removeClass("d-none");

      $("#AdditionalItem").addClass("d-none");
      $("#AdditionalRate").addClass("d-none");

    }else if (Materialtype=='Additional') {

      document.getElementById("ItemA").disabled=true;
      document.getElementById("qty").disabled=false;
      $("#ApprovedItem").addClass("d-none");
      $("#ApprovedRate").addClass("d-none");

      $("#AdditionalItem").removeClass("d-none");
      $("#AdditionalRate").removeClass("d-none");

    }
  }
});


  $(document).on('click','.CreateInvoice', function(){

    var BranchCode=document.getElementById("Branch").value;
    var BillingFrom=document.getElementById("BillingFrom").value;
    var BillingTo=document.getElementById("BillingTo").value;
    var GST=document.getElementById("BranchGST").value;
    var EmployeeCode=document.getElementById("employee").value;
    
    var HSNAdd=document.getElementById("HSNCode").value;
    var ItemDetails=document.getElementById("ItemA").value;
    var Qty=document.getElementById("qty").value;

    var ItemAA=document.getElementById("ItemAA").value;
    ItemAA = ItemAA.replace(/\\/g, "/");

    var RateA=document.getElementById("RateA").value;

    var DiscAdd=document.getElementById("Discount").value;
    //var DiscountType= $('input[name="DiscountType"]:checked').val();
    var DiscountType='Rupees';
    var Materialtype= $('input[name="MaterialType"]:checked').val();

    var BarCode=document.getElementById("BarCode").value;
    //alert(BarCode);
    var Data=document.getElementById("GstRates").value;
    if (Data) {
      const obj = JSON.parse(Data);
      CategoryID = obj.CategoryID;
    }
    var Material='';
    var Rate=0;
    var Data2=document.getElementById("ItemA").value;
    if (Data2) {
      const obj2 = JSON.parse(Data2);
      Material = obj2.Description;
      Rate=obj2.Rate;
    }

    

    if (!BranchCode) {
      swal("error", "Please select branch", "error");
    }else if (BillingFrom=='') {
      swal("error", "Please select Billing from", "error");
    }else if (BillingTo=='') {
      swal("error", "Please select Billing to", "error");
    }else if (!GST) {
      swal("error", "No GST number found", "error");
    }else if (!EmployeeCode) {
      swal("error", "Please select employee", "error");
    }else if (Materialtype=='Approved' && ItemDetails=='') {
      swal("error", "Please select material", "error");
    }else if (Materialtype=='Additional' && ItemAA=='') {
      swal("error", "Please enter material name", "error");
    }else if((ItemAA.indexOf("/") > -1)){
      swal("error", "Do not use forwardslash or backslash", "error");
    }else if (Materialtype=='Additional' && RateA=='') {
      swal("error", "Please enter material rate", "error");
    }else if (!BarCode) {
      swal("error", "Please enter barcode", "error");
    }else if (!Qty) {
      swal("error", "Please enter quantity", "error");
    }else if (!HSNAdd) {
      swal("error", "No HSN Code found", "error");
    }else if (!DiscountType && DiscAdd>0) {
      swal("error", "Please select discount type", "error");
    }else{

      $.ajax({
        type:'POST',
        url:'addbilling.php',
        data:{'BranchCodeAdd':BranchCode, 'Material':Material, 'ItemAA':ItemAA, 'RateA':RateA, 'Qty':Qty, 'CategoryID':CategoryID, 'DiscAdd':DiscAdd, 'EmployeeCode':EmployeeCode, 'Rate':Rate, 'BarCode':BarCode, 'DiscountType':DiscountType},
        success:function(result){
          //alert(result);

          if (result==1) {

            $('#f1').trigger("reset");
            

            $.ajax({
              type:'POST',
              url:'dataget.php',
              data:{'BranchAddShow':BranchCode,'EmployeeCodeAdddShow':EmployeeCode},
              success:function(result){

                $('.display').DataTable().clear();
                $('.display').DataTable().destroy();
                $('#MaterialDetails').html(result);

                $('table.display').DataTable( {

                  rowReorder: {
                    selector: 'td:nth-child(2)'
                  },
                  "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
                  responsive: false
                } );


              }
            });

          }else{
            swal("error",result,"error");
          }

          $.ajax({
            type:'POST',
            url:'addbilling.php',
            data:{'BranchCodeAmount':BranchCode,'EmployeeCodeAmount':EmployeeCode},
            success:function(result){

              document.getElementById("GSTAmount").innerHTML=result;

            }
          });        

        }
      });

    }
  });




$(document).on('click','.deleteAdd', function(){
  var ID = $(this).attr("id");
  var BranchCode=document.getElementById("Branch").value;
  var EmployeeCode=document.getElementById("employee").value;
  if (confirm("You want to Delete Item. do you wish to continue?")) {

    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'DeleteAdd':ID},
      success:function(result){
        if (result==1) {
          swal("success", "Item Deleted", "success"); 


          var delayInMilliseconds = 1000; 

          setTimeout(function() {


            $.ajax({
              type:'POST',
              url:'dataget.php',
              data:{'BranchAddShow':BranchCode,'EmployeeCodeAdddShow':EmployeeCode},
              success:function(result){

                $('.display').DataTable().clear();
                $('.display').DataTable().destroy();
                $('#MaterialDetails').html(result);

                $('table.display').DataTable( {

                  rowReorder: {
                    selector: 'td:nth-child(2)'
                  },
                  "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
                  responsive: false
                } );


              }
            });


            $.ajax({
              type:'POST',
              url:'addbilling.php',
              data:{'BranchCodeAmount':BranchCode,'EmployeeCodeAmount':EmployeeCode},
              success:function(result){

                document.getElementById("GSTAmount").innerHTML=result;

              }
            }); 


          }, delayInMilliseconds);

        }else{
          swal("error", result, "error");
        }
      }
    }); 

  }
});




$(document).on('click','.GenerateInvoice', function(){
  var BranchCode=document.getElementById("Branch").value;
  var BillingFrom=document.getElementById("BillingFrom").value;
  var BillingTo=document.getElementById("BillingTo").value;
  var EmployeeCode=document.getElementById("employee").value;
  var BranchGST=document.getElementById("BranchGST").value;
  var AddDiscount=document.getElementById("AdditionalDisc").value;

      //alert(BillingID.length);
      if (!AddDiscount) {
        swal("error","Please enter additional discount","error");
      }else{


        if (confirm("You want to generate invoice. Do you wish to continue?")) {

          if (BranchGST && AddDiscount) {

            $.ajax({
              type:'POST',
              url:'generateinvoice.php',
              data:{'BranchCode':BranchCode, 'BillingFrom':BillingFrom, 'BillingTo':BillingTo, 'AddDiscount':AddDiscount, 'EmployeeCode':EmployeeCode, 'BranchGST':BranchGST},
              success:function(result){

                if(result==1){
                  $.ajax({
                    type:'POST',
                    url:'exportpdf.php',
                    data:{'Genearate':'Generate'},
                    success:function(result){

                      swal({
                        title: "Invoice Generated",
                        text: result,
                        icon: "success",
                        buttons: true,
                        dangerMode: false,
                      })
                      .then((willDelete) => {
                        if (willDelete) {
                          window.open("printinvoice.php?Billno="+result, '_blank');
                          location.reload();
                        } else {
                          window.open("printinvoice.php?Billno="+result, '_blank');
                          location.reload();
                        }
                      });                            

                    }
                  });
                }

              }
            });

          }else if(BranchGST==''){

            swal("error","No GST number found in branch", "error"); 

          }else if(AddDiscount==''){

            swal("error","Please enter additional discount", "error"); 

          } 
        }
      }

    });


$(document).on('click','.GenerateCreditNote', function(){
  var InvoiceNo=document.getElementById("CInvoiceNo").value;

  if(InvoiceNo){

    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'GenerateCreditNote':InvoiceNo},
      success:function(result){
        if (result==1) {
          $.ajax({
            type:'POST',
            url:'printcreditnote.php',
            data:{'Genearate':'Generate'},
            success:function(result){

              swal({
                title: "Credit Note Generated",
                text: result,
                icon: "success",
                buttons: true,
                dangerMode: false,
              })
              .then((willDelete) => {
                if (willDelete) {
                  window.open("printcn.php?CNNo="+result, '_blank');
                  location.reload();
                } else {
                  window.open("printcn.php?CNNo="+result, '_blank');
                  location.reload();
                }
              });


              // swal("success","Credit Note No : "+result,"success");
              // var delayInMilliseconds = 5000; 

              // setTimeout(function() {
              //   location.reload();
              // }, delayInMilliseconds);                                    

            }
          });
        }else{
          swal("error", result, "error");

        }


      }
    }); 

  }else{
    swal("error","Please select Invoice No","error");
  }
});


$(document).on('change','.Calculate', function(){
  var TaxAmout=document.getElementById("TaxAmout").value;
  var Tax=document.getElementById("Taxx").value;

  if (TaxAmout && Tax) {
      //alert(Rate*Qty);
      TaxAmout=parseFloat(TaxAmout).toFixed(2);
      Tax=parseFloat(Tax).toFixed(2);

      var TA=(TaxAmout*Tax);
      var Tax2=Tax*1;
      //alert(typeof(Tax2));
      var TD=(Tax2+100);
      
      var Avalue = (TA/TD).toFixed(2);
      document.getElementById("AWTax").value=Avalue;
    }else{
      document.getElementById("AWTax").value=0;
    }

  });


</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>