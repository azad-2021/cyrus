<?php 
include 'connection.php';
include 'session.php';



date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));
$NintyDays = date('Y-m-d', strtotime($Date. ' - 90 days'));

$Hour = date('G');

if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['Tuser'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['Tuser'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['Tuser'];
}


$EmployeeID=$_SESSION['empid'];
$OID = $_GET['oid'];
$complaintID = $_GET['cid'];
$BranchCode = $_GET['brcode'];
$approvalID = $_GET['apid'];
$queryApprovalID="SELECT * FROM approval where ApprovalID=$approvalID";
$resultApprovalID=mysqli_query($con,$queryApprovalID);
$dataApprovalID=mysqli_fetch_assoc($resultApprovalID);
$JOBCARD= $dataApprovalID['JobCardNo'];
  //echo $JOBCARD;
if(empty($_GET['zcode'])==true){
 $queryProduct="SELECT * FROM rates"; 
}else{
 $ZoneCode = $_GET['zcode'];
 $queryProduct="SELECT * FROM rates WHERE Zone=$ZoneCode and ItemID!=1654"; 
}
$Sub=0;

  $resultProduct=mysqli_query($con2,$queryProduct);  //select all products
  $queryProductList= "SELECT * FROM add_product where paEmployeeID=$EmployeeID";
  $resultProductList=mysqli_query($con2,$queryProductList);

  $queryBilling="SELECT * FROM add_product where paEmployeeID=$EmployeeID";
  $resultBilling=mysqli_query($con2,$queryBilling);


  if(isset($_POST['back'])){
    $sql2 = "DELETE FROM add_product WHERE paEmployeeID=$EmployeeID";

    if ($con3->query($sql2) === TRUE) {
      echo "Record deleted successfully";

    }
    header("location:pro.php?apid=$approvalID&cid=$complaintID&eid=$EmployeeID&brcode=$BranchCode&oid=$OID&cardno=$JOBCARD&zcode=$ZoneCode");
  }



  if(isset($_POST['Add']))
  {
    $RateID=$_POST['RateID'];
    $qty=$_POST['qty'];
    $usedas = $_POST['as'];

    $query1="SELECT * FROM add_product where paRateID=$RateID and UsedAs='$usedas' and paEmployeeID=$EmployeeID"; 
    $result1=mysqli_query($con2,$query1);
    if(empty($usedas)==true){
      echo '<script>alert("Please select Used As option")</script>';
    }elseif(empty(mysqli_fetch_assoc($result1))==false){
      echo '<script>alert("Product already in list")</script>';
    }else{

      $queryCheckStock="SELECT * From rates where RateID=$RateID";
      $resultCheckStock=mysqli_query($con2,$queryCheckStock);
      $dataCheckStock=mysqli_fetch_assoc($resultCheckStock);


      $paRateID = $dataCheckStock['RateID'];
      $paDiscription = $dataCheckStock['Description'];
      $paRate = $dataCheckStock['Rate'];
      if ($usedas=='Waranty') {
        $paRate = '';
      }
    //echo $EmployeeID;
      $queryAdd="INSERT INTO `add_product`( `paRateID`, `paEmployeeID`, `paDiscription`, `paRate`, `paqty`, `UsedAs`) VALUES ('$paRateID', '$EmployeeID', '$paDiscription', '$paRate', '$qty', '$usedas')";
      mysqli_query($con2,$queryAdd);
      if($queryAdd){
        echo "<meta http-equiv='refresh' content='0'>";
      }
    }  
  }

  if(isset($_POST['submit'])){ 



    while($dataBilling=mysqli_fetch_assoc($resultBilling)){
      $RateID = $dataBilling['paRateID'];
      $quantity = $dataBilling['paqty'];
      $UsedAs = $dataBilling['UsedAs'];
      
      
      /* Insert Data into Billing database */
      $queryAdd="INSERT INTO `pbills`( `ApprovalID`, `RateID`, `UsedAs`, `qty`) VALUES ('$approvalID', '$RateID','$UsedAs', '$quantity')";
      
      if ($con2->query($queryAdd) === TRUE) {
      } else {
        echo "Error: " . $queryAdd . "<br>" . $con2->error;

        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $con->error);
        fclose($myfile);
      }

    }


    $queryRemove="DELETE FROM `add_product` WHERE `paEmployeeID`='$EmployeeID'";
    $resultRemove=mysqli_query($con2,$queryRemove);

    if(isset($_POST['estimate'])){
      $AddEstimate = $_POST['estimate'];
      if ($AddEstimate=='YES') {
        header("location:estimate.php?cid=$complaintID&eid=$EmployeeID&brcode=$BranchCode&oid=$OID&apid=$approvalID&zcode=$ZoneCode");
      }elseif($AddEstimate=='NO'){
        header("location:more.php?cid=$complaintID&eid=$EmployeeID&brcode=$BranchCode&oid=$OID&zcode=$ZoneCode");
      }
    }else{
      echo '<script>alert("Please select Estimate option")</script>';
    }
  }





  ?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Add Employee</title>
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


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">


    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <style type="text/css">
    table, tr, th{
      font-size: 14px;
      align-items: center;
    }
    a {
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

  <script type="text/javascript">
    function checkSpcialChar(event){
      if(!((event.keyCode >= 65) && (event.keyCode <= 90) || (event.keyCode >= 97) && (event.keyCode <= 122) || (event.keyCode >= 48) && (event.keyCode <= 57))){
       event.returnValue = false;
       return;
     }
     event.returnValue = true;
   }


    // Restricts input for the given textbox to the given inputFilter function.
    function setInputFilter(textbox, inputFilter) {
      ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
        textbox.addEventListener(event, function() {
          if (inputFilter(this.value)) {
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
          } else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
          } else {
            this.value = "";
          }
        });
      });
    }

    function limit(element)
    {
      var max_chars = 5;

      if(element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
      }
    }
  </script>

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

?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Add Employee</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">

        <center>
          <div class="pagetitle">
            <h1>Enter Details</h1>
          </div>

        </center>


        <form class="form-control rounded-corner" name="fileUpload" action = "" method = "POST" enctype = "multipart/form-data">
          <div class="row">
            <center>
              <div class="col-lg-4">
                <label>Select Item</label>
                <select  required name="RateID" class="form-control rounded-corner">
                  <?php
                  while($data=mysqli_fetch_assoc($resultProduct)){

                    echo '<option value='.$data['RateID'].'>'.$data['Description'].'</option>'; 
                  }  
                  ?>
                </select>
              </div>
              <div class="col-lg-4">
                <input type="number" required class="form-control rounded-corner" name="qty" id="qt" maxlength="5" id="txtInput" onkeypress="return checkSpcialChar(event)" onkeydown="limit(this);" onkeyup="limit(this);">
              </div>

              <div class="col-lg-4">
               <label for="as">As</label>
               <select name="as" id="as" class="form-control rounded-corner">
                <option value="">Choose option</option>
                <option value="Billing">Billing</option>
                <option value="Waranty">Waranty</option>
                <option value="CAMC">CAMC</option>
                <option value="Standby">Standby</option>
              </select>
            </div>

            <div class="col-lg-4" style="margin:20px;">
              <input type="submit" class=" btn btn-primary" value="Add" name="Add"></input>
            </div>
          </center>
        </form>
        <div class="col-lg-12 table-responsive">
          <table id="userTable2" class="display nowrap table-striped table-hover table-sm" id="exampleFormControlSelect2" class="form-control">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Contact Number</th>
              </tr>
            </thead>
            <tbody>

              <?php 

              $query= "SELECT * FROM add_product where paEmployeeID=$EmployeeID";
              $result=mysqli_query($con2,$query);

              if (mysqli_num_rows($result)>0)
              {

               while($data=mysqli_fetch_assoc($result)){ ?>
                <tr>
                  <td >
                    <?php echo $rateid =$data['paRateID']; ?>
                  </td>
                  <td >
                    <?php echo $data['paDiscription']; ?>
                  </td>
                  <td >
                    <?php echo $data['UsedAs']; ?>
                  </td>
                  <td >
                    <?php echo $data['paRate']; ?>
                  </td>
                  <td >
                    <?php echo $data['paqty']; ?>
                  </td>
                  <td >
                    <?php echo $SubTotal=$data['paqty']* $data['paRate']; ?>
                  </td>
                  <td >
                    <form accept="" method="post">
                      <input type="hidden" name="rateid" value=" <?php echo $rateid ?>">
                      <input type="hidden" name="eid" value="<?php echo $EmployeeID ?>">
                      <input type="hidden" name="us" value="<?php echo $data['UsedAs'] ?>">
                      <input type="submit" name="removeProduct" value="Remove" class="btn btn-danger my-button">
                    </form>
                  </td>
                </tr>
                <?php $Sub = $Sub + $SubTotal; 
              } } 


              ?>
            </tbody>
          </table>     

        </div>
        <center>
          <br><br>
          <form method="post" action="">


           <div class="col-lg-4" style="margin: 20px;">
            <label>Estimate Given</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="estimate" id="material" value="YES">
              <label class="form-check-label" for="inlineRadio1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="estimate" id="material" value="NO">
              <label class="form-check-label" for="inlineRadio2">No</label>
            </div>
          </div>


          <input name="submit" class="btn btn-primary" value="Submit" type = "submit">
          <input type="submit"  class=" btn btn-danger my-button" value="Back" name="back"></input>
        </form>
      </center>



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

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>




<script src="assets/js/main.js"></script>
<script src="ajax.js"></script>

<script type="text/javascript">
  function preventBack() { window.history.forward(); }  
  setTimeout("preventBack()", 0);  
  window.onunload = function () { null };  

  $(document).ready(function() {
   var table = $('#userTable2').DataTable( {
    rowReorder: {
      selector: 'td:nth-child(2)'
    },
    responsive: true
  } );
 } );

</script>
</body>

</html>


<?php

if(isset($_POST['removeProduct']))
{
  $rate=$_POST['rateid'];
  $eid=$_POST['eid'];
  $UsedAs= $_POST['us'];

  $queryRemove="DELETE FROM `add_product` WHERE  `paRateID`='$rate' and `paEmployeeID`='$eid' and UsedAs='$UsedAs'";
  $resultRemove=mysqli_query($con2,$queryRemove);
  if($resultRemove){

    echo "<meta http-equiv='refresh' content='0'>";
  }
}

$con -> close();
$con2 -> close();

?>