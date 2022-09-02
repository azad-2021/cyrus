<?php

include 'connection.php';
include 'session.php';
$Type=$_SESSION['usertype'];
$EXEID=$_SESSION['userid'];

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$Hour = date('G');
//echo $_SESSION['user'];

$user=$_SESSION['user'];

if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
}

$query ="SELECT BankName, ZoneRegionName, BranchName, Gadget, orders.OrderID, simprovider.SimProvider,
simprovider.SimType, MobileNumber, SimNo, Operator, simprovider.ReleaseDate as SimReleaseDate,
production.IssueDate as InuseDate, ActivationDate, ExpDate, simprovider.ID as SimID,
ProductionID, DATEDIFF(ExpDate,ActivationDate) as leftDays, `Employee Name` as InstalledBY, InstallationDate, store.ReleaseDate as StoreDate, store.EmployeeCode as StoreReleaseTo,
Executive, orders.Remark as RemarkOrders, simprovider.Remark as RemarkSim, installation.Remark as RemarkInst
FROM saas.orders
join cyrusbackend.branchdetails on orders.BranchCode=branchdetails.BranchCode
join production on orders.OrderID=production.OrderID
join simprovider on production.SimID=simprovider.ID
join gadget on orders.GadgetID=gadget.GadgetID
join operators on orders.OperatorID=operators.OperatorID
join installation on orders.OrderID=installation.OrderID
join store on orders.OrderID=store.OrderID
join cyrusbackend.employees on installation.InstalledBy=employees.EmployeeCode
where orders.Status=3 and Installed=1 order by orders.OrderID";

$results = mysqli_query($con, $query);

if(isset($_POST['submit'])){



  $OrderID=$_POST['OrderID'];
  $Remark=$_POST['Remark'];



  $sql = "UPDATE installation SET Remark='$Remark' WHERE OrderID=$OrderID";

  if ($con->query($sql) === TRUE) {
    echo '<script>alert("Your response recorded successfully")</script>';
    echo '<meta http-equiv="refresh" content="0">';
  }else {
    echo "Error updating record: " . $con->error;
  }


}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Installation Details</title>
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

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="assets/js/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="datatable/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" type="text/css" href="datatable/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="datatable/css/responsive.bootstrap5.min.css"/>

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
  //include "modals.php";
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

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content rounded-corner">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Update Remark</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="">
                    <div class="mb-3 d-none">
                      <label for="recipient-name" class="col-form-label ">Recipient:</label>
                      <input type="text" class="form-control rounded-corner" id="recipient-name" name="OrderID">

                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Remark</label>
                      <textarea class="form-control rounded-corner" id="message-text" name="Remark"></textarea>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <input type="submit"  class=" btn btn-primary" value="submit" name="submit">
                  </form>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
              </div>
            </div>
          </div>

          <h3 align="center">View Installation Details</h3>  
          <br />  
          <div class="table-responsive">  
            <table class="table table-hover table-bordered border-primary" id="example" width="100%"> 
            <thead> 
              <tr>  
                <th>Bank</th> 
                <th>Zone</th> 
                <th>Branch</th> 
                <th>Order ID</th>
                <th>Gadget</th> 
                <th>Mobile No</th> 
                <th>Sim NO</th> 
                <th>Sim Type</th> 
                <th>Operator</th> 
                <th>Sim Provider</th>
                <th>Executive</th>
                <th>Remark Orders</th>
                <th>Remark Sim Provider</th>
                <th>Production Date</th>       
                <th>Released To</th>
                <th>Store Release Date</th>
                <th>Installed By</th>
                <th>Installation Date</th>
                <th>Validity days</th>
                <th>Remark Installation</th>
              </tr>                     
            </thead>                 
            <tbody> 
              <?php  
              while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 
                $EmployeeID=$row["StoreReleaseTo"];
                $query="SELECT `Employee Name` from cyrusbackend.employees WHERE EmployeeCode=$EmployeeID";
                $results2 = mysqli_query($con, $query);
                $row2=mysqli_fetch_array($results2,MYSQLI_ASSOC);
                if ($row["leftDays"]<0) {
                  $Bank='<span style="color: red;">'.$row["BankName"].'</span>';
                }elseif ($row["leftDays"]<=30) {
                  $Bank='<span style="color: blue;">'.$row["BankName"].'</span>';
                }else{
                 $Bank=$row["BankName"]; 
               }



               echo '  
               <tr> 
               <td>'.$Bank.'</td> 
               <td>'.$row["ZoneRegionName"].'</td>  
               <td>'.$row["BranchName"].'</td>  
               <td>'.$row["OrderID"].'</td>
               <td>'.$row["Gadget"].'</td>           
               <td>'.$row["MobileNumber"].'</td>
               <td>'.$row["SimNo"].'</td> 
               <td>'.$row["SimType"].'</td>   
               <td>'.$row["Operator"].'</td>  
               <td>'.$row["SimProvider"].'</td>  
               <td>'.$row["Executive"].'</td>
               <td>'.$row["RemarkOrders"].'</td>
               <td>'.$row["RemarkSim"].'</td>
               <td>'.$row["InuseDate"].'</td>
               <td>'.$row2["Employee Name"].'</td>
               <td>'.$row["StoreDate"].'</td>
               <td>'.$row["InstalledBY"].'</td>
               <td>'.$row["InstallationDate"].'</td> 
               <td>'.$row["leftDays"].'</td>
               <td>'
               ?>

               <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="<?php print $row["OrderID"]; ?>"><?php print $row["RemarkInst"].' : Update'; ?></a>
               <?php
               print '<a target="blank" href=update.php?id='.$row["OrderID"].'&Type=Ins> Update Number</a>';
               "</td>"
               ;  
             }
             ?> 

           </table>  
         </div>  
       </div>
     </div>
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

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<!-- Template Main JS File -->
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="datatable/js/jquery.dataTables.min.js"></script>]
<script src="datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="datatable/js/dataTables.responsive.min.js"></script>
<script src="datatable/js/responsive.bootstrap5.min.js"></script>
<script>

  $(document).ready(function() {
    $('#example').DataTable( {
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

  var exampleModal = document.getElementById('exampleModal')
  exampleModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = exampleModal.querySelector('.modal-title')
  var modalBodyInput = exampleModal.querySelector('.modal-body input')

  modalTitle.textContent = 'New Remark for Order ID ' + recipient
  modalBodyInput.value = recipient
})

</script>
</body>
</html>