
<?php 
include 'connection.php';
include 'session.php';
$EXEID=$_SESSION['userid'];
$Type=$_SESSION['usertype'];
?>


<!DOCTYPE html>  
<html>  
<head>   
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="Anant Singh Suryavanshi">
  <title>Assign</title>
  <link rel="icon" href="cyrus logo.png" type="image/icon type">
  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

  

</head>  
<body> 

  <?php 
  include 'navbar.php';
  include 'modals.php';
  ?>
  <div class="container">
    <div class="row">
      <div class="col-12">

        <div class="modal fade" id="ViewUNO" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unassigned Orders</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="UNOData">

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="ViewAO" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assigned Orders</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="AOData">

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="ViewAC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assigned Complaints</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="ACData">

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="ViewUNC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unassigned Complaints</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="UNCData">

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="ViewUAMC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unassigned AMC</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="UAMCData">

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="ViewAMC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assigned AMC</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="AMCData">

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div id="ref" class="table-responsive">
          <table id="unassigned" class="table table-hover table-bordered border-primary display  nowrap" style="width:100%">
            <h5 align="center" style="margin:20px;">Unassigned Orders/Complaints/AMC</h5>
            <thead id="unhead">
              <tr>
                <th>Service Engineer</th>
                <th>Unassigned Orders </th>
                <th>Unassigned Complaints</th>                
                <th>Unassigned AMC</th>           
              </tr>
            </thead>
            <tbody >
              <?php 
              if ($Type=="Executive") {
                $query="SELECT EmployeeCode, `Employee Name` FROM employees WHERE Inservice=1 Order By `Employee Name`";
              }else{              
                $query="SELECT EmployeeCode, `Employee Name` FROM cyrusbackend.reporting join employees on reporting.EmployeeID=employees.EmployeeCode WHERE ExecutiveID=$EXEID order by `Employee Name`";
              }
              $resultTech=mysqli_query($con,$query);
              while($rowE=mysqli_fetch_assoc($resultTech)){
                $Employee=$rowE["Employee Name"];
                $EmployeeID=$rowE["EmployeeCode"];

                $query="SELECT count(ComplaintID), `Employee NAME`, EmployeeCode FROM cyrusbackend.vallcomplaintsd WHERE AssignDate is null and Attended=0 and EmployeeCode=$EmployeeID";
                $result=mysqli_query($con,$query);
                $row = mysqli_fetch_array($result);

                $query2="SELECT count(vallordersd.OrderID), vallordersd.`Employee NAME`, vallordersd.EmployeeCode FROM vallordersd WHERE vallordersd.AssignDate is null and vallordersd.Discription like '%AMC%' and vallordersd.EmployeeCode=$EmployeeID";
                $result2=mysqli_query($con,$query2);
                $row2 = mysqli_fetch_array($result2);

                $query3 = "SELECT count(vallordersd.OrderID), vallordersd.`Employee NAME`, vallordersd.EmployeeCode FROM vallordersd WHERE AssignDate is null and Discription not like '%AMC%' and vallordersd.EmployeeCode=$EmployeeID";
                $result3 = mysqli_query($con, $query3);
                $row3 = mysqli_fetch_array($result3);
                ?>
                <tr>
                  <th><?php echo $Employee; ?></th>

                  <td><a class="view_UNO" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewUNO"><?php echo $row3["count(vallordersd.OrderID)"]; ?></a></td>

                  <td ><a class="view_UNC" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewUNC"><?php echo $row["count(ComplaintID)"]; ?></a></td>

                  <td><a class="view_UAMC" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewUAMC"><?php echo $row2["count(vallordersd.OrderID)"];; ?></a></td>              
                </tr>
              <?php } ?>
            </tbody>
          </table>

          <div class="table-responsive">
          <table id="assigned" class="table table-hover table-bordered border-primary display responsive nowrap" style="width:100%">
            <h5 align="center">Assigned Orders/Complaints/AMC</h5>
            <thead id="ahead">
              <tr>
                <th>Service Engineer</th>
                <th>Assigned Orders</th>  
                <th>Assigned Complaints</th> 
                <th>Assigned AMC</th>               
              </tr>
            </thead>
            <tbody>
              <?php 
              $row3='';
              if ($Type=="Executive") {
                $query="SELECT * FROM employees WHERE Inservice=1 Order By `Employee Name`";
              }else{
                $query="SELECT EmployeeCode, `Employee Name` FROM cyrusbackend.reporting join employees on reporting.EmployeeID=employees.EmployeeCode WHERE ExecutiveID=$EXEID order by `Employee Name`";
              }
              $resultTech=mysqli_query($con,$query);
              while($rowE=mysqli_fetch_assoc($resultTech)){
               $Employee=$rowE["Employee Name"];
               $EmployeeID=$rowE["EmployeeCode"];

               $query="SELECT count(ComplaintID), `Employee NAME`, EmployeeCode FROM cyrusbackend.allcomplaint WHERE AssignDate is not null and Attended=0 and EmployeeCode=$EmployeeID";
               $result=mysqli_query($con,$query);
               $row = mysqli_fetch_array($result);

               $query2="SELECT count(OrderID), `Employee NAME`, EmployeeCode FROM cyrusbackend.allorders WHERE AssignDate is not null and Attended=0 and Discription like '%AMC%' and EmployeeCode=$EmployeeID";
               $result2=mysqli_query($con,$query2);
               $row2 = mysqli_fetch_array($result2);
               $AMC=$row2["count(OrderID)"];

               $query3 = "SELECT count(OrderID), `Employee NAME`, EmployeeCode FROM allorders WHERE EmployeeCode=$EmployeeID and AssignDate is not NULL and Attended=0 and Discription not like '%AMC%'";
               $result3 = mysqli_query($con, $query3);
               $row3 = mysqli_fetch_array($result3);
               $AO=$row3["count(OrderID)"]
               ?>
               <tr>
                <th><?php echo $Employee; ?></th>
                <td><a class="view_AO" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewAO"><?php echo $AO; ?></a></td>

                <td><a class="view_AC" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewAC"><?php echo $row["count(ComplaintID)"]; ?></a></td>


                <td><a class="view_AMC" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewAMC"><?php echo $AMC; ?></a></td>              
              </tr>

            <?php } ?>
          </tbody>
        </table>
      </div>
      </div>
    </div>
  </div>
</div>
<script src="search.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('table.display').DataTable( {
      responsive: true,
      "scrollY":        "200px",
      "scrollCollapse": true,
      "ordering": false,
      "searching": false,
      "paging":         false
    } );
  } );

</script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="ajax.js"></script>

</body>
</html>
<?php 
$con->close();
$con2->close();
?>
