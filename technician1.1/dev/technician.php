<script type = "text/javascript" >  
  function preventBack() { window.history.forward(); }  
  setTimeout("preventBack()", 0);  
  window.onunload = function () { null };  
</script> 


<?php 

  include 'connection.php';
  include 'session.php';
  
  $OID = $_GET['oid'];
  $card = $_GET['cardno'];
  $complaintID = $_GET['cid'];
  $EmployeeID = $_GET['eid'];
  $BranchCode = $_GET['brcode'];
  $Status = $_GET['site'];

  $ZoneCode = $_GET['zcode'];
  $JobCARD = $_GET['cardno'];
  $GadgetID = $_GET['gid'];

  date_default_timezone_set('Asia/Kolkata');
  $timestamp =date('y-m-d H:i:s');
  $Date =date('Y-m-d',strtotime($timestamp));

  $queryTech="SELECT * FROM employees Where Inservice=1 order by `Employee Name`"; 
  $resultTech=mysqli_query($con2,$queryTech);

  $queryTechnicianList= "SELECT * FROM employees inner join add_technician on employees.EmployeeCode=add_technician.TechnicianID where add_technician.EmployeeUID=$EmployeeID";
  $resultTechnicianList=mysqli_query($con2,$queryTechnicianList);

  $queryApprovalID="SELECT * FROM approval where JobCardNo='$JobCARD' and posted='0'";
  $resultApprovalID=mysqli_query($con2,$queryApprovalID);
  $dataApprovalID=mysqli_fetch_assoc($resultApprovalID);
  $approvalID = $dataApprovalID['ApprovalID'];
//echo $JobCARD;
    if(isset($_POST['Addtech']))
  {
    $Employee=$_POST['EmployeeCode'];

    $query="SELECT * FROM add_technician where TechnicianID=$Employee and EmployeeUID=$EmployeeID"; 
    $result=mysqli_query($con2,$query); 
    if(empty(mysqli_fetch_assoc($result))==false){
      echo '<script>alert("Technician already in list")</script>';
    }else{
    $queryCheckTechnician="SELECT * From employees where EmployeeCode=$Employee";
    $resultCheckTechnician=mysqli_query($con2,$queryCheckTechnician);
    $dataCheckTechnician=mysqli_fetch_assoc($resultCheckTechnician);
    $TechnicianName = $dataCheckTechnician['Employee Name'];
    $TechnicianContact = $dataCheckTechnician['Phone'];
    $TechnicianCode = $dataCheckTechnician['Employee Code'];

      $queryAddtech="INSERT INTO `add_technician` (`tanid`, `EmployeeUID`, `TechnicianID`, `TechnicianName`, `TechnicianContact`) VALUES ('', '$EmployeeID', '$Employee', '$TechnicianName', $TechnicianContact);";
      mysqli_query($con2,$queryAddtech);

      if($queryAddtech){
        echo "<meta http-equiv='refresh' content='0'>";
      }
    }
  }

  if(isset($_POST['submit']))
  {
    $a = 1;
    $queryTechnician="SELECT TechnicianID FROM add_technician"; 
    $resultTechnician=mysqli_query($con2,$queryTechnician); 

    while($data=mysqli_fetch_assoc($resultTechnician)){
     $te = $data['TechnicianID'];;
      $jobcard = $card .$a;

       /* Insert Data into Approval database */
      $queryAdd="INSERT INTO `approval`( `BranchCode`, `ComplaintID`, `OrderID`, `JobCardNo`, `Status`, `EmployeeID`, `VisitDate`, `GadgetID`) VALUES ('$BranchCode','$complaintID','$OID', '$jobcard', '$Status', '$te', '$Date', '$GadgetID')";
      mysqli_query($con2,$queryAdd);
      $a++;
    }

    $queryRemove="DELETE FROM `add_technician` WHERE `EmployeeUID`='$EmployeeID'";
    $resultRemove=mysqli_query($con2,$queryRemove); 
    header("location:pro.php?cid=$complaintID&eid=$EmployeeID&brcode=$BranchCode&oid=$OID&cardno=$JobCARD&zcode=$ZoneCode");
  }

  


?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Add Technician</title>
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


  </head>

  <body>
<?php 
  include 'navbar.php';
?>
<legend>Add Technician</legend>
    <div class="container">
      <!-- Add technician Section -->
      
      <fieldset >
            
        <div class="col-lg-12" align="center">
            <form method="post" action="" class="form-inline">
              <label for="exampleFormControlSelect2">Select Technician
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <select  required name="EmployeeCode" class="form-control select my-select" id="exampleFormControlSelect2" >
                <?php
                  while($data=mysqli_fetch_assoc($resultTech)){
                    echo "<option value=".$data['EmployeeCode'].">".$data['Employee Name']."</option>";
                  }  
                ?>
              </select>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="submit"  class=" btn btn-success button my-button" value="Add" name="Addtech"></input>
            </form>
          </div>  
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
                <?php while($data=mysqli_fetch_assoc($resultTechnicianList)){ ?>
                  <tr>
                    <td >
                      <?php echo $ttid =$data['TechnicianID']; ?>
                    </td>
                    <td >
                      <?php echo $data['TechnicianName']; ?>
                    </td>
                    <td >
                      <?php echo $data['TechnicianContact']; ?>
                    </td>
                      <td >
                    <td >
                      <form accept="" method="post">
                        <input type="hidden" name="ttid" value=" <?php echo $ttid ?>">
                        <input type="hidden" name="tid" value="<?php echo $tid ?>">
                        <input type="hidden" name="tCode" value="<?php echo $data['TechnicianCode'] ?>">
                        <input type="submit" name="removeTechnician" value="Remove" class="btn btn-danger my-button">
                      </form>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>     
            <br><br>  
            <form method="post" action="">
              <center>
                <input type="submit"  class=" btn btn-success my-button" value="submit" name="submit"></input>
              </center>      
            </form>
            <br>
          </div>
      </fieldset>
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


<?php if(isset($_POST['removeTechnician']))
  {
    $ttid=$_POST['ttid'];
    $tid=$_POST['tid'];
    $queryRemove="DELETE FROM `add_technician` WHERE  `TechnicianID`='$ttid' and `EmployeeUID`='$EmployeeID'";
    $resultRemove=mysqli_query($con2,$queryRemove);
    if($resultRemove){

      echo "<meta http-equiv='refresh' content='0'>";
    }
  }

  $con2 -> close();
  $con3 -> close();
  $con4 -> close();
?>