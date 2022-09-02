
<?php 

  include 'connection.php';
  include 'session.php';
  $EXEID=$_SESSION['userid'];
  $ApprovalID = $_GET['apid'];

  $sql = "SELECT * from pbills where ApprovalID = '$ApprovalID'";  
  $resultB = mysqli_query($con2, $sql);  

  $Sub=0;

?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Material Consumed</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
 <link rel="stylesheet" type="text/css" href="css/style.css"> 
 <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>

    <style>
      fieldset {
        background-color: #eeeeee;
        margin: 10px;
      }

      legend {
        background-color: #26082F;
        color: white;
        padding: 5px 10px;
      }

      .r {
        margin: 5px;
      }
    </style>

  </head>

  <body>
<?php 
  include 'navbar.php';
?>


    <div class="container">
      <!-- Add technician Section -->
<br><br> 
        <div class="col-lg-12">
            <form method="post" action="" name="sub">     
          <div class="col-lg-12 table-responsive">
            <table id="userTable2" class="display nowrap table-striped table-hover table-sm" id="exampleFormControlSelect2" class="form-control">
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Used As</th>
                  <th scope="col">Unit Price</th>
                  <th scope="col">Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    while($rowB = mysqli_fetch_assoc($resultB)){
                      $RateID=$rowB["RateID"];
                      $UsedAs=$rowB["UsedAs"];
                      $Qty=$rowB["Qty"]; 

                      $queryProduct="SELECT * FROM rates Where RateID=$RateID"; 
                      $resultP = mysqli_query($con2, $queryProduct);  
                      $rowP = mysqli_fetch_assoc($resultP);
                      $UnitRate=$rowP["Rate"];
                      $Description=$rowP["Description"];
                      if ($UsedAs=='Waranty') {
                        // code...
                        $Rate=0;
                      }else{
                      $Rate=$rowP["Rate"];
                    }
                       
                 ?>
                  <tr>
                    <td>
                      <?php echo $Description;  ?>
                    </td>
                    <td >
                      <?php echo $Qty; ?>
                    </td>
                    <td >
                      <?php echo $UsedAs; ?>
                    </td>

                    <td >
                      <?php echo $UnitRate; ?>
                    </td>
                    <td >
                      <?php echo $SubTotal = $Rate*$Qty; ?>
                    </td>
                  </tr>
                <?php  $Sub = $Sub + $SubTotal;  } ?>
              </tbody>
            </table>    
          </div>
        <br>
        <div align="right"><strong>Total Price: <?php echo $Sub; ?></strong></div>
        <br><br>
    </div> 
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js
"></script>

    <script type="text/javascript">
      
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
