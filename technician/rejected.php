<?php 
include 'connection.php';
include 'session.php';

$EmployeeCode=$_SESSION['empid'];

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
        <li class="breadcrumb-item active"></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <center>
          <div class="pagetitle">
            <h1>Rejected AMC</h1>
          </div>

        </center>
        <div class="table-responsive container">
          <table width="100%" class="table display text-start align-middle table-bordered border-primary table-hover mb-0">
            <thead id="unhead">
              <tr>
                <th>Bank</th>
                <th>Zone</th>
                <th>Branch</th>
                <th>District</th>
                <th>AMC ID</th>
                <th>Description</th>
                <th>Rejection Remark</th>
                <th>Rejection Date</th>
                <th>Posted On</th>
                <th>Assigned On</th>
              </tr>
            </thead>
            <tbody >
              <?php 
              $query="SELECT distinct approval.OrderID, BankName, ZoneRegionName, ZoneRegionCode, BranchName, approval.BranchCode, Address3, Discription, DateOfInformation, AssignDate, VDate, Vremark, orders.GadgetID, Gadget FROM cyrusbackend.approval
              left join cyrusbackend.orders on approval.OrderID=orders.OrderID
              join cyrusbackend.gadget on orders.GadgetID=gadget.GadgetID
              join cyrusbackend.branchdetails on orders.BranchCode=branchdetails.BranchCode
              WHERE Vremark like '%REJECTED%' and orders.Discription like '%AMC%' and Attended=0 and orders.EmployeeCode=$EmployeeCode";

              $result=mysqli_query($con,$query);

              while($row = mysqli_fetch_array($result)){
               $orgDate = $row["AssignDate"];  
               $date = str_replace('-"', '/', $orgDate);  
               $AssignDate = date("d/m/y", strtotime($date));  
               $Bankname=$row["BankName"];
               $PDate = $row["DateOfInformation"];  
               $date = str_replace('-"', '/', $PDate);  
               $PostedDate = date("d/m/y", strtotime($date));

               $dedline = date('Y-m-d', strtotime($orgDate. ' + 90 days'));

               $datetime1 = date_create($Date);
               $datetime2 = date_create($dedline);

               $interval = date_diff($datetime1, $datetime2);
               $d= $interval->format('%R%a');
                       // echo $d;
               $int = (int)$d;
               $tr='<tr class="table-success">';
               if ($int<0) {

                $tr='<tr class="table-danger">';

              }
              if ($int<=59) {
               $tr='<tr class="table-warning">';
             }

             $ZoneCode=$row["ZoneRegionCode"];
             $Gadget=$row["Gadget"];
             $duration='';
             $sql ="SELECT datediff(EndDate, StartDate) as days, visits, StartDate, EndDate FROM cyrusbackend.amcs WHERE ZoneRegionCode=$ZoneCode and Device='$Gadget' and datediff(EndDate, current_date())>=0";
             $resultAMC=mysqli_query($con,$sql);


             if (mysqli_num_rows($resultAMC)>0)
             {

              $row2=mysqli_fetch_array($resultAMC,MYSQLI_ASSOC);
              $D=0;
              $Q1='';
              if (!empty($row2["StartDate"])) {

               $D= round($row2["days"]/$row2["visits"]);
               $SDate=date('d-m-Y',strtotime($row2["StartDate"]));
               $Q=date('d-m-Y', strtotime($SDate. ' + '.$D.' days'));

               for ($i=0; $i < $row2["visits"]; $i++) { 

                 if (date_create($Q)>=date_create($Date)) {

                   $duration=$SDate.' to '.$Q;
                   break;
                 }else{
                  $SDate=$Q;
                  $Q=date('d-m-Y', strtotime($SDate. ' + '.$D.' days'));
                }  
              }

            }
          }

          print $tr;
          print "<td >".$row["BankName"]."</td>";
          print "<td>".$row["ZoneRegionName"]."</td>";
          print "<td>".$row["BranchName"]."</td>";
          print "<td>".$row["Address3"]."</td>";
          //print "<td>".$row["OrderID"]."</td>";
          print "<td><a href=\"card.php?oid=&amcid=" . $row['OrderID'] . "&cid=&eid=".$EmployeeCode ."&brcode=".$row["BranchCode"]."&zcode=".$row["ZoneRegionCode"]."&gid=".$row["GadgetID"]."&PostedDate=".$row["DateOfInformation"]."\">".$row["OrderID"]."</a></td>";
          print "<td>".$row["Discription"]. ' Duration '.$duration."</td>";
          print "<td>".$row["Vremark"]."</td>";
          print "<td>".date('Y-m-d',strtotime($row["VDate"]))."</td>";
          print "<td>".$PostedDate."</td>";
          print "<td>".$AssignDate."</td>";
          print "</tr>";


        }

        ?>
      </tbody>
    </table>


    <center>
      <div class="pagetitle">
        <h1>Rejected Orders</h1>
      </div>

    </center>
    <div class="table-responsive container">
      <table width="100%" class="table display text-start align-middle table-bordered border-primary table-hover mb-0">
        <thead>
          <tr>
            <th>Bank</th> 
            <th>Zone</th> 
            <th>Branch</th> 
            <th>District</th> 
            <th>OrderID</th>
            <th>Description</th>
            <th>Rejection Remark</th>
            <th>Rejection Date</th>
            <th>Posted On</th>
            <th>Assigned On</th>        
          </tr>
        </thead>
        <tbody >
          <?php 
          $query="SELECT distinct approval.OrderID, BankName, ZoneRegionName, ZoneRegionCode, BranchName, approval.BranchCode, Address3, Discription, DateOfInformation, AssignDate, VDate, Vremark, Gadget FROM cyrusbackend.approval
          left join cyrusbackend.orders on approval.OrderID=orders.OrderID
          join cyrusbackend.branchdetails on orders.BranchCode=branchdetails.BranchCode
          join cyrusbackend.gadget on orders.GadgetID=gadget.GadgetID
          WHERE Vremark like '%REJECTED%' and orders.Discription not like '%AMC%' and Attended=0 and orders.EmployeeCode=$EmployeeCode";

          $result=mysqli_query($con,$query);

          while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $orgDate = $row["AssignDate"];  
            $date = str_replace('-"', '/', $orgDate);  
            $AssignDate = date("d/m/y", strtotime($date));  
            $Bank=$row["BankName"];
            $PDate = $row["DateOfInformation"];  
            $date = str_replace('-"', '/', $PDate);  
            $PostedDate = date("d/m/y", strtotime($date));

            $Zone = $row["ZoneRegionName"];
            $ZoneCode=$row["ZoneRegionCode"];

            $dedline = date('Y-m-d', strtotime($orgDate. ' + 7 days'));

            $datetime1 = date_create($Date);
            $datetime2 = date_create($dedline);

            $interval = date_diff($datetime1, $datetime2);
            $d= $interval->format('%R%a');
            $tr='<tr class="table-success">';
            $int = (int)$d;

            if ($int<0) {
             $tr='<tr class="table-danger">';
           }
           if ($int<1) {
             $tr='<tr class="table-warning">';
           }

           print $tr;
           print "<td>".$row["BankName"]."</td>";
           print "<td>".$row["ZoneRegionName"]."</td>";
           print "<td>".$row["BranchName"]."</td>";
           print "<td>".$row["Address3"]."</td>";
                    //print "<td>".$row["OrderID"]."</td>";
           print "<td><a href=\"card.php?amcid=&oid=" . $row['OrderID'] . "&cid=&eid=".$EmployeeCode ."&brcode=".$row["BranchCode"]."&zcode=".$ZoneCode."&gid=".$row["GadgetID"]."&PostedDate=".$row["DateOfInformation"]."\">".$row["OrderID"]."</a></td>";
           print "<td>".$row["Discription"]."</td>";
           print "<td>".$row["Vremark"]."</td>";
           print "<td>".date('Y-m-d',strtotime($row["VDate"]))."</td>";
           print "<td>".$PostedDate."</td>";
           print "<td>".$AssignDate."</td>";
           print "</tr>";

         }
         ?>
       </tbody>
     </table>


     <center>
      <div class="pagetitle">
        <h1>Total Rejected Complaints</h1>
      </div>

    </center>
    <div class="table-responsive container">
      <table width="100%" class="table display text-start align-middle table-bordered border-primary table-hover mb-0">
        <thead>
          <tr>
            <th>Bank</th> 
            <th>Zone</th> 
            <th>Branch</th> 
            <th>District</th> 
            <th>Complaint ID</th>
            <th>Description</th>
            <th>Rejection Remark</th>
            <th>Rejection Date</th>
            <th>Posted On</th>
            <th>Assigned On</th>        
          </tr>
        </thead>
        <tbody >
          <?php 
          $query="SELECT distinct approval.OrderID, ZoneRegionName, ZoneRegionCode, approval.BranchCode, ZoneRegionCode, BranchName, Address3, Discription, DateOfInformation, AssignDate, VDate, Vremark FROM cyrusbackend.approval
          left join cyrusbackend.complaints on approval.ComplaintID=complaints.ComplaintID
          join cyrusbackend.branchdetails on complaints.BranchCode=branchdetails.BranchCode
          WHERE Vremark like '%REJECTED%' and Attended=0 and complaints.EmployeeCode=$EmployeeCode";

          $result=mysqli_query($con,$query);

          while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $org = $row["AssignDate"];

            $date = str_replace('-"', '/', $org);  
            $AssignDate = date("d/m/Y", strtotime($date));  

            $PDate = $row["DateOfInformation"];  
            $date = str_replace('-"', '/', $PDate);  
            $PostedDate = date("d/m/y", strtotime($date));

            $BankName=$row["BankName"];
            $Zone = $row["ZoneRegionName"];
            $BranchCode = $row["BranchCode"];
            $ZoneCode=$row["ZoneRegionCode"];

            $ded = date('Y-m-d', strtotime($org. ' + 2 days'));

            $datetime1 = date_create($Date);
            $datetime2 = date_create($ded);
            $interva = date_diff($datetime1, $datetime2);
            $de= $interva->format('%R%a');
            $tr='<tr class="table-success">';
            $int = (int)$de;

            if ($int<0) {
              $tr='<tr class="table-danger">';
            }
            if ($int<1) {
             $tr='<tr class="table-warning">';
           }

           print $tr;
           print "<td>".$row["BankName"]."</td>";
           print "<td>".$row["ZoneRegionName"]."</td>";
           print "<td>".$row["BranchName"]."</td>";
           print "<td>".$row["Address3"]."</td>";
                    //print "<td>".$row["ComplaintID"]."</td>";
           print "<td><a href=\"card.php?amcid=&cid=" . $row['ComplaintID'] . "&oid=&eid=".$EmployeeCode ."&brcode=".$row["BranchCode"]."&zcode=".$ZoneCode."&gid=".$row["GadgetID"]."&PostedDate=".$row["DateOfInformation"]."\">".$row["ComplaintID"]."</a></td>";
           print "<td>".$row["Discription"]."</td>";
           print "<td>".$row["Vremark"]."</td>";
           print "<td>".date('Y-m-d',strtotime($row["VDate"]))."</td>";
           print "<td>".$PostedDate."</td>";
           print "<td>".$AssignDate."</td>";
           print "</tr>";
           $org='';
         }
         ?>
       </tbody>
     </table>


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
  $(document).ready(function() {
    $('table.display').DataTable( {
      responsive: true,
      stateSave: false,
    } );
  } );


  $(document).on('click', '.view_WorkReportO', function(){
    var EmployeeCode=$(this).attr("id");
    if (EmployeeCode) {
      $.ajax({
        type:'POST',
        url:'attended.php',
        data:{'EmployeeCodeO':EmployeeCode},
        success:function(result){
          $('.displayO').DataTable().clear();
          $('.displayO').DataTable().destroy();
          $('#work_data').html(result);

          $('table.displayO').DataTable( {

            rowReorder: {
              selector: 'td:nth-child(2)'
            },
            "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
            responsive: false
          } );

          $('#WorkReport').modal('show');        
        }
      }); 
    }
  });

  $(document).on('click', '.view_WorkReportA', function(){
    var EmployeeCode=$(this).attr("id");
    if (EmployeeCode) {
      $.ajax({
        type:'POST',
        url:'attended.php',
        data:{'EmployeeCodeA':EmployeeCode},
        success:function(result){
          $('#work_data').html(result);
          $('#WorkReport').modal('show');        
        }
      }); 
    }
  });


  $(document).on('click', '.view_WorkReportC', function(){
    var EmployeeCode=$(this).attr("id");
    if (EmployeeCode) {
      $.ajax({
        type:'POST',
        url:'attended.php',
        data:{'EmployeeCodeC':EmployeeCode},
        success:function(result){
          $('#work_data').html(result);
          $('#WorkReport').modal('show');        
        }
      }); 
    }
  });


  $(document).on('click', '.view_WorkReportB', function(){
    var EmployeeCode=$(this).attr("id");
    if (EmployeeCode) {
      $.ajax({
        type:'POST',
        url:'attended.php',
        data:{'EmployeeCodeB':EmployeeCode},
        success:function(result){
          $('#work_data').html(result);
          $('#WorkReport').modal('show');        
        }
      }); 
    }
  });

  $(document).on('change', '#SDate', function(){
    document.getElementById("EDate").value = "";
  });

  $(document).on('change', '#employee', function(){
    document.getElementById("SDate").value = "";
  });

  $(document).on('change', '#EDate', function(){
    var SDate = document.getElementById("SDate").value;
    var EDate = document.getElementById("EDate").value;
        //var EmployeeCode = document.getElementById("employee").value;

        if (SDate==''){
          swal("error","Please select Start Date","error");
        }else{
          $.ajax({
            type:'POST',
            url:'dataget.php',
            data:{'EmployeeCodeP':'xyz', 'SDate':SDate, 'EDate':EDate},
            success:function(result){
              $('.display2').DataTable().clear();
              $('.display2').DataTable().destroy();
              $('#work_dataP').html(result); 

              
              $('table.display2').DataTable( {

                rowReorder: {
                  selector: 'td:nth-child(2)'
                },
                "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
                responsive: false
              } );

            }
          });
        }
      });


  $(document).on('click', '.view_WorkReportOP', function(){
    var EmployeeCode=$(this).attr("id");
    var SDate = document.getElementById("SDate").value;
    var EDate = document.getElementById("EDate").value;
    if (EmployeeCode) {
      $.ajax({
        type:'POST',
        url:'attended.php',
        data:{'EmployeeCodeOP':EmployeeCode, 'SDate':SDate, 'EDate':EDate},
        success:function(result){
          $('#work_data').html(result);
          $('#WorkReport').modal('show');        
        }
      }); 
    }
  });

  $(document).on('click', '.view_WorkReportAP', function(){
    var EmployeeCode=$(this).attr("id");
    var SDate = document.getElementById("SDate").value;
    var EDate = document.getElementById("EDate").value;
    if (EmployeeCode) {
      $.ajax({
        type:'POST',
        url:'attended.php',
        data:{'EmployeeCodeAP':EmployeeCode, 'SDate':SDate, 'EDate':EDate},
        success:function(result){
          $('#work_data').html(result);
          $('#WorkReport').modal('show');        
        }
      }); 
    }
  });


  $(document).on('click', '.view_WorkReportCP', function(){
    var EmployeeCode=$(this).attr("id");
    var SDate = document.getElementById("SDate").value;
    var EDate = document.getElementById("EDate").value;
    if (EmployeeCode) {
      $.ajax({
        type:'POST',
        url:'attended.php',
        data:{'EmployeeCodeCP':EmployeeCode, 'SDate':SDate, 'EDate':EDate},
        success:function(result){
          $('#work_data').html(result);
          $('#WorkReport').modal('show');        
        }
      }); 
    }
  });


  $(document).on('click', '.view_WorkReportBP', function(){
    var EmployeeCode=$(this).attr("id");
    var SDate = document.getElementById("SDate").value;
    var EDate = document.getElementById("EDate").value;
    if (EmployeeCode) {
      $.ajax({
        type:'POST',
        url:'attended.php',
        data:{'EmployeeCodeBP':EmployeeCode, 'SDate':SDate, 'EDate':EDate},
        success:function(result){
          $('#work_data').html(result);
          $('#WorkReport').modal('show');        
        }
      }); 
    }
  });

  $(document).on({
    ajaxStart: function(){
      $("body").addClass("loading"); 
    },
    ajaxStop: function(){ 
      $("body").removeClass("loading"); 
    }    
  });

</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>