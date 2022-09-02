<?php 
include 'connection.php';
include 'session.php';

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
$DateR = date('d-M-y h:i A',strtotime($timestamp));


$Hour = date('G');
//echo $_SESSION['user'];


if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
}

if (isset($_POST['submit'])) {
  $OrderID=$_POST['EOrderID'];
  $Remark=$_POST['ERemark'];

  $sql ="SELECT `Executive Remark` FROM orders WHERE OrderID=$OrderID";

  $result = mysqli_query($con,$sql);
  
  if (mysqli_num_rows($result)>0)
  { 
    $row = mysqli_fetch_array($result);
    $exRemark=$row["Executive Remark"];
  }else{
    $exRemark='';
  }
  $Remark=$_SESSION['user'].' - '.$DateR.' - '.$Remark.' '.$exRemark;
  $sql = "UPDATE orders SET `Executive Remark`='$Remark' WHERE OrderID=$OrderID";
  if ($con->query($sql) === TRUE) {
    echo '<meta http-equiv="refresh" content="0">';
  }else {
    echo "Error: " . $sql . "<br>" . $con->error;

  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pending Material Confirmation</title>
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
          <li class="breadcrumb-item active">Pending Material Confirmation</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <div class="modal fade" data-bs-backdrop="static" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content rounded-corner">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Materials</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="material">

              </div>
              <br>
              <form id="f1">
                <div class="row text-centered">
                  <div class="col-lg-5">
                    <center>
                      <label >Select Items</label>
                    </center>
                    <select id="ItemID" class="form-control rounded-corner" name="Items" required>
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
                    <button type="button" class="btn btn-primary btn-lg addItems">Add</button>
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
              <button type="button" class="btn btn-primary confirm">Confirm</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" data-bs-backdrop="static" id="SaaS" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content rounded-corner">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add to SaaS</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="fSaaS">
                <div class="row text-centered">
                  <div class="col-lg-4">
                    <center>
                      <label >Gadget</label>
                    </center>
                    <select class="form-control rounded-corner" id="Gadget" name="GadgetID" required>
                      <option value="">Select</option>
                      <?php 
                      $query ="SELECT * FROM `gadget`";
                      $results = mysqli_query($con4, $query);
                      while ($arr=mysqli_fetch_assoc($results))
                      {
                        ?>
                        <option value="<?php echo $arr['GadgetID']; ?>"><?php echo $arr['Gadget']; ?></option>
                        <?php
                      }?>      
                    </select>
                  </div>
                  <div class="col-lg-4">
                    <label>SIM Provider</label>
                    <select class="form-control rounded-corner" id="provider" name="Provider" required>
                      <option value="">Select</option>
                      <option value="Bank">Bank</option>
                      <option value="Cyrus">Cyrus</option>  
                      <option value="No SIM">No SIM</option>     
                    </select>
                  </div>

                  <div class="col-lg-4">
                    <label>SIM Type</label>
                    <select class="form-control rounded-corner" id="SimType" name="SimType">
                      <option value="">Select</option>
                      <option value="Prepaid">Prepaid</option>
                      <option value="Postpaid">Postpaid</option>      
                    </select> 
                  </div>

                  <div class="col-lg-4">
                    <label for="Operator">Operator</label>
                    <select class="form-control rounded-corner" id="Operator" name="OperatorID">
                      <option value="">Select</option>
                      <?php 
                      $query ="SELECT * FROM `operators`";
                      $resultOperator = mysqli_query($con4, $query);
                      while ($arr=mysqli_fetch_assoc($resultOperator))
                      {
                        ?>
                        <option value="<?php echo $arr['OperatorID']; ?>"><?php echo $arr['Operator']; ?></option>
                        <?php
                      }?>      
                    </select>
                  </div>

                  <div class="form-group col-lg-4">
                    <label for="Validity of Recharge">Validity</label>
                    <select class="form-control rounded-corner" id="Validity">
                      <option value="">Select</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>   
                      <option value="5">5</option>
                      <option value="6">6</option>   
                      <option value="7">7</option>
                      <option value="8">8</option>   
                      <option value="9">9</option>
                      <option value="10">10</option> 
                      <option value="11">11</option>
                      <option value="12">12</option>   
                      <option value="24">24</option>   
                    </select>

                  </div>

                  <div class="col-lg-4">
                    <label>Reference ID</label>
                    <input type="text" name="" id="orderidSaaS" class="form-control rounded-corner" disabled>
                  </div>

                  <div class="col-lg-3">
                    <label for="Validity of Recharge">Voice Category for Zone 1</label>
                    <select class="form-control rounded-corner" id="1" name="categoryZ2M1">
                      <option value="">Select</option>
                      <option value="Alarm">Alarm</option>
                      <option value="Fire Alarm">Fire Alarm</option>
                    </select>
                  </div>

                  <div class="col-lg-3">
                    <label for="Validity of Recharge">Voice Category for Zone 2</label>
                    <select class="form-control rounded-corner" id="2" name="categoryZ2M2">
                      <option value="">Select</option>
                      <option value="Alarm">Alarm</option>
                      <option value="Fire Alarm">Fire Alarm</option>
                    </select>
                  </div>

                  <div class="col-lg-3">
                    <label for="Validity of Recharge">Category Zone 3</label>
                    <select class="form-control rounded-corner" id="3" name="categoryZ4M3">
                      <option value="">Select</option>
                      <option value="Alarm">Alarm</option>
                      <option value="Fire Alarm">Fire Alarm</option>
                    </select>
                  </div>

                  <div class="col-lg-3">
                    <label for="Validity of Recharge">Category Zone 4</label>
                    <select class="form-control rounded-corner" id="4" name="categoryZ4M4">
                      <option value="">Select</option>
                      <option value="Alarm">Alarm</option>
                      <option value="Fire Alarm">Fire Alarm</option>
                    </select>
                  </div>

                  <div class="col-lg-3 form-check" style="margin-top: 35px;">
                    <input class="form-check-input" type="checkbox" value="" id="other" >
                    <label class="form-check-label" for="flexCheckDefault">
                      Other (Remark mandatory)
                    </label>
                  </div>

                  <div class="col-lg-9">
                    <label>Remark</label>
                    <textarea class="form-control rounded-corner" id="RemarkSaaS"></textarea>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary cl" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary SaveSaaS">Save</button>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" data-bs-backdrop="static" id="AddRemark" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content rounded-corner">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Executive Remark</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="f1" method="POST" action="">
                <div class="row text-centered">
                  <center>
                    <div class="col-lg-6">

                      <label >Enter Remark</label>
                      <textarea class="form-control rounded-corner" name="ERemark" required></textarea>

                    </div>
                  </center>
                  <div class="col-lg-3 d-none">
                    <input type="text" id="EOrderID" name="EOrderID" class="form-control">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary cl" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Recent Sales -->
      <div class="col-12">
        <div class="card recent-sales overflow-auto">

          <div class="card-body">
            <br>

            <div class="table-responsive container">
              <table class="table display text-start align-middle table-bordered border-primary table-hover mb-0">
                <thead>
                  <tr class="text-dark">
                    <th scope="col" style="min-width:200px">Bank</th>
                    <th scope="col" style="min-width:200px">Zone</th>
                    <th scope="col" style="min-width:200px">Branch</th>
                    <th scope="col" style="min-width:100px">Order ID</th>
                    <th scope="col" style="min-width:300px">Description</th>
                    <th scope="col" style="min-width:150px">Order Date</th>
                    <th scope="col" style="min-width:150px">Remark</th>
                    <th scope="col" style="min-width:150px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $sql ="SELECT orders.OrderID, StatusID, Discription, DateOfInformation, orders.BranchCode, DemandGenDate, BankName, ZoneRegionName, ZoneRegionCode, BranchName, `Executive Remark` FROM cyrusbackend.orders 
                  join demandbase on orders.OrderID=demandbase.OrderID
                  join branchdetails on orders.BranchCode=branchdetails.BranchCode
                  join districts on branchdetails.Address3=districts.district
                  join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                  WHERE demandbase.StatusID=1 and ControlerID=$EXEID order by DateOfInformation";

                  $result = mysqli_query($con,$sql);
                  while ($row = mysqli_fetch_array($result)) { 
                   ?>
                   <tr>

                    <td><?php echo $row["BankName"]; ?></td>
                    <td><?php echo $row["ZoneRegionName"]; ?></td>
                    <td><?php echo $row["BranchName"]; ?></td>

                    <td  ><a href="" class="add" data-bs-toggle="modal" data-bs-target="#add" id="<?php print $row["ZoneRegionCode"]; ?>" data-bs-orderid="<?php echo $row["OrderID"]; ?>" data-bs-zonecode="<?php echo $row["ZoneRegionCode"]; ?>"><?php echo $row["OrderID"]; ?></a></td>

                    <td><?php echo $row["Discription"]; ?></td>
                    <td><?php echo $row["DateOfInformation"]; ?></td>
                    <td><?php echo $row["Executive Remark"]; ?></td>
                    <td  >

                      <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Action
                        </button>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="" class="dropdown-item AddRemark" data-bs-toggle="modal" data-bs-target="#AddRemark" id="<?php print $row["OrderID"]; ?>">Add Remark</a>
                          </li>
                          <!--<li>
                            <a class="dropdown-item SaaSOrder" data-bs-toggle="modal" data-bs-target="#SaaS" id="<?php echo $row["OrderID"] ?>">
                            Add to SaaS</a>
                          </li>-->
                        </ul>
                      </div>

                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
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
<script src="assets/js/main.js"></script>
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="ajax.js"></script>


<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('table.display').DataTable( {
      responsive: true,
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal( {
            header: function ( row ) {
              var data = row.data();
              return 'Details for '+data[0]+' '+data[1];
            }
          } ),
          renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
            tableClass: 'table'
          } )
        }
      },
      stateSave: true,
    } );
  } );

  var exampleModal = document.getElementById('add')
  exampleModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget
    var ID = button.getAttribute('data-bs-orderid')
    var ZoneCode=button.getAttribute('data-bs-zonecode')
      //console.log(recipient);
      document.getElementById("orderid").value = ID;
      document.getElementById("ZoneCode").value = ZoneCode;
    })


  $(document).on('click', '.cl', function(){

    var delayInMilliseconds = 1000; 

    setTimeout(function() {
      location.reload();
    }, delayInMilliseconds);


  });

  function limit(element)
  {
    var max_chars = 5;

    if(element.value.length > max_chars) {
      element.value = element.value.substr(0, max_chars);
    }
  }


  $(document).on('click', '.AddRemark', function(){
  //$('#dataModal').modal();
  var OrderID=$(this).attr("id");
  document.getElementById("EOrderID").value=OrderID;
  //console.log(OrderID);
});

  $(document).on('click', '.SaaSOrder', function(){
  //$('#dataModal').modal();
  var OrderID=$(this).attr("id");
  document.getElementById("orderidSaaS").value=OrderID;
  //console.log(OrderID);
});

  $(document).on('change','#provider', function(){
    var Provider = document.getElementById("provider").value;
    console.log(Provider);
    if (Provider=='No SIM') {
      document.getElementById("SimType").disabled = true;
      document.getElementById("Operator").disabled = true;
    }else{
      document.getElementById("SimType").disabled = false;
      document.getElementById("Operator").disabled = false;
    }
  });

  document.getElementById("1").disabled = true;
  document.getElementById("2").disabled = true;
  document.getElementById("3").disabled = true;
  document.getElementById("4").disabled = true;
  $(document).on('change','#Gadget', function(){
    var GadgetID = $(this).val();

    if (GadgetID==5) {
      document.getElementById("1").disabled = false;
      document.getElementById("2").disabled = false;
      document.getElementById("3").disabled = true;
      document.getElementById("4").disabled = true;
    }else if(GadgetID==6){
      document.getElementById("1").disabled = false;
      document.getElementById("2").disabled = false;
      document.getElementById("3").disabled = false;
      document.getElementById("4").disabled = false;
    }else{
      document.getElementById("1").disabled = true;
      document.getElementById("2").disabled = true;
      document.getElementById("3").disabled = true;
      document.getElementById("4").disabled = true;
    }

  }); 

  $(document).on('click','.SaveSaaS', function(){
    var Other=0;
    var err=0;
    var GadgetID = parseInt(document.getElementById("Gadget").value);
    var SIMProvider = document.getElementById("provider").value;
    var SIMType = document.getElementById("SimType").value;
    var Operator = document.getElementById("Operator").value;
    var Validity = document.getElementById("Validity").value;
    var ReferenceID = document.getElementById("orderidSaaS").value;
    var Zone1 = document.getElementById("1").value;
    var Zone2 = document.getElementById("2").value;
    var Zone3 = document.getElementById("3").value;
    var Zone4 = document.getElementById("4").value;
    var Remark = document.getElementById("RemarkSaaS").value;
    alert(typeof(GadgetID)+' '+SIMProvider+' '+ReferenceID);
    if ($('#other').is(":checked") && Remark=='') {
      err=1;
      swal("error","For other, remark is mandatory","error");
    }

    if(SIMProvider=="No SIM"){

      if (GadgetID==5 && SIMProvider && ReferenceID && Zone1 && Zone2){

        var Data={'GadgetID':GadgetID, 'SIMProvider':SIMProvider, 'SIMType':SIMType, 'Operator':Operator, 'Validity':Validity, 'ReferenceID':ReferenceID, 'Zone1':Zone1, 'Zone2':Zone2,'Remark':Remark}

      }else if (GadgetID==6 && SIMProvider && ReferenceID && Zone1 && Zone2 && Zone3 && Zone4){

        var Data={'GadgetID':GadgetID, 'SIMProvider':SIMProvider, 'SIMType':SIMType, 'Operator':Operator, 'Validity':Validity, 'ReferenceID':ReferenceID, 'Zone1':Zone1, 'Zone2':Zone2, 'Zone3':Zone3, 'Zone4':Zone4, 'Remark':Remark}

      }else if (GadgetID!=5 && GadgetID!=6 && SIMProvider && ReferenceID) {

        var Data={'GadgetID':GadgetID, 'SIMProvider':SIMProvider, 'SIMType':SIMType, 'Operator':Operator, 'Validity':Validity, 'ReferenceID':ReferenceID, 'Remark':Remark}

      }else{
        swal("error","Please enter all fields","error");
        err=1;
      }

    }else if (SIMProvider=='Bank'){

      if (GadgetID==5 && SIMProvider && ReferenceID && Zone1 && Zone2) {

        var Data={'GadgetID':GadgetID, 'SIMProvider':SIMProvider, 'SIMType':SIMType, 'Operator':Operator, 'Validity':Validity, 'ReferenceID':ReferenceID, 'Zone1':Zone1, 'Zone2':Zone2,'Remark':Remark}

      }else if (GadgetID==6 && SIMProvider && ReferenceID && Zone1 && Zone2 && Zone3 && Zone4) {

        var Data={'GadgetID':GadgetID, 'SIMProvider':SIMProvider, 'SIMType':SIMType, 'Operator':Operator, 'Validity':Validity, 'ReferenceID':ReferenceID, 'Zone1':Zone1, 'Zone2':Zone2, 'Zone3':Zone3, 'Zone4':Zone4, 'Remark':Remark}

      }else if (GadgetID!=5 && GadgetID!=6 && SIMProvider && ReferenceID) {

        var Data={'GadgetID':GadgetID, 'SIMProvider':SIMProvider, 'SIMType':SIMType, 'Operator':Operator, 'Validity':Validity, 'ReferenceID':ReferenceID, 'Remark':Remark}

      }else{
        swal("error","Please enter all fields","error");
        err=1;
      }

    }else{

      if (GadgetID==5 && SIMProvider && SIMType && Operator && Validity && ReferenceID && Zone1 && Zone2) {


        var Data={'GadgetID':GadgetID, 'SIMProvider':SIMProvider, 'SIMType':SIMType, 'Operator':Operator, 'Validity':Validity, 'ReferenceID':ReferenceID, 'Zone1':Zone1, 'Zone2':Zone2,'Remark':Remark}

      }else if (GadgetID==6 && SIMProvider && SIMType && Operator && Validity && ReferenceID && Zone1 && Zone2 && Zone3 && Zone4) {

        var Data={'GadgetID':GadgetID, 'SIMProvider':SIMProvider, 'SIMType':SIMType, 'Operator':Operator, 'Validity':Validity, 'ReferenceID':ReferenceID, 'Zone1':Zone1, 'Zone2':Zone2, 'Zone3':Zone3, 'Zone4':Zone4, 'Remark':Remark}

      }else if (GadgetID!=5 && GadgetID!=6 && SIMProvider && SIMType && Operator && Validity && ReferenceID ) {

        var Data={'GadgetID':GadgetID, 'SIMProvider':SIMProvider, 'SIMType':SIMType, 'Operator':Operator, 'Validity':Validity, 'ReferenceID':ReferenceID, 'Remark':Remark}

      }else{
        swal("error","Please enter all fields in Cyrus","error");
        err=1;
      }
    }

    if (err==0) {

      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:Data,
        success:function(result){
          if(result==1){
            swal("success","Order added SaaS","success");
            var delayInMilliseconds = 1000; 

            setTimeout(function() {
              location.reload();
            }, delayInMilliseconds);
          }else{
            swal("error",result,"error");
          }

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