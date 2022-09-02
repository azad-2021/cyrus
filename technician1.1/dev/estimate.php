<script type = "text/javascript" >  
  function preventBack() { window.history.forward(); }  
  setTimeout("preventBack()", 0);  
  window.onunload = function () { null };  
</script> 


<?php 
  include 'connection.php';

  $OID = $_GET['oid'];
  $complaintID = $_GET['cid'];
  $EmployeeUID = $_GET['eid'];
  $BranchCode = $_GET['brcode'];
  $approvalID = $_GET['apid'];
  $ZoneCode = $_GET['zcode'];
  $Sub = 0;
  
   $queryApprovalID="SELECT * FROM approval where ApprovalID=$approvalID";
  $resultApprovalID=mysqli_query($con2,$queryApprovalID);
  $dataApprovalID=mysqli_fetch_assoc($resultApprovalID);
  $JOBCARD= $dataApprovalID['JobCardNo'];

  $queryEstimate="SELECT * FROM rates WHERE Zone=$ZoneCode"; 
  $resultEstimate=mysqli_query($con4,$queryEstimate);  //select all products
  $queryEstimateList= "SELECT * FROM add_estimate where EmployeeUID=$EmployeeUID";
  $resultEstimateList=mysqli_query($con3,$queryEstimateList);

  if(isset($_POST['Add']))
  {
    $RateID=$_POST['RateID'];
    $qty=$_POST['qty'];
    $query1="SELECT * FROM add_estimate where peRateID=$RateID and EmployeeUID=$EmployeeUID"; 
    $result1=mysqli_query($con3,$query1); 
    if(empty(mysqli_fetch_assoc($result1))==false){
      echo '<script>alert("Product already in list")</script>';
    }else{
    $queryCheckStock="SELECT * From rates where RateID=$RateID";
    $resultCheckStock=mysqli_query($con4,$queryCheckStock);
    $dataCheckStock=mysqli_fetch_assoc($resultCheckStock);
    $peRateID = $dataCheckStock['RateID'];
    $peDiscription = $dataCheckStock['Description'];
    $peRate = $dataCheckStock['Rate'];

    $queryAdd="INSERT INTO `add_estimate`( `peRateID`, `peDiscription`, `peRate`,  `peqty`, `EmployeeUID`) VALUES ('$peRateID','$peDiscription', '$peRate', '$qty', $EmployeeUID)";
    mysqli_query($con3,$queryAdd);
    if($queryAdd){
      echo "<meta http-equiv='refresh' content='0'>";
    }  
  }
  }
 if(isset($_POST['back'])){
  
$sql3 = "DELETE FROM add_estimate WHERE EmployeeUID=$EmployeeID";

if ($con3->query($sql3) === TRUE) {
  echo "Record deleted successfully";

}
header("location:est.php?cid=$complaintID&eid=$EmployeeUID&brcode=$BranchCode&oid=$OID&apid=$approvalID&zcode=$ZoneCode&card=$JOBCARD");
}

  if(isset($_POST['submit'])){

     $queryAddEstimate="SELECT * FROM add_estimate WHERE EmployeeUID = $EmployeeUID"; 
    $resultAddEstimate=mysqli_query($con3,$queryAddEstimate);
    while($dataEstimate=mysqli_fetch_assoc($resultAddEstimate)){ 
      $RateID = $dataEstimate['peRateID'];
      $Quantity = $dataEstimate['peqty'];
      $query = "INSERT INTO `estimates`(`ApprovalID`, `RateID`, `Qty`) VALUES ('$approvalID', '$RateID', '$Quantity')";
     $queryAdd=  mysqli_query($con3,$query);

      if($queryAdd){
      $queryRemove="DELETE FROM `add_estimate` WHERE `EmployeeUID`='$EmployeeUID'";
      $resultRemove=mysqli_query($con3,$queryRemove);
      header("location:invoice.php?oid=$OID&cid=$complaintID&eid=$EmployeeUID&brcode=$BranchCode&apid=$approvalID&zcode=$ZoneCode");
      }

    }
  }
  


   
?>





<!DOCTYPE html>
<html lang="en">
<head>
  <title>Estimate</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css"> 
 <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>

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
  <body>
  <?php 
  include 'navbar.php';
?>
<legend>Select Items</legend>
  <div class="container">
    <fieldset >  
          <form method="post" action="">
            <div class="form-row" align="center">
            <div class="form-group col-md-4">
            <label for="exampleFormControlSelect2">Item</label>
            <select  required name="RateID" class="form-control my-select" class="selectpicker" id="exampleFormControlSelect2">
              <?php
                while($data=mysqli_fetch_assoc($resultEstimate)){
                  echo '<option style=" word-wrap: break-word;" value='.$data['RateID'].">".$data['Description']."</option>"; 
                }  
              ?>
            </select>
            </div>
              <div class="form-group col-md-4">
            <label for="quantity">Quantity</label>
            <input type="number" required class="form-control my-select" name="qty" id="txtInput" onkeypress="return checkSpcialChar(event)" onkeyup="limit(this);">
            </div>
            </div>
              <center>
            <input type="submit" style="margin-bottom: 20px;" class=" btn btn-success my-button" value="Add" name="Add"></input>
            </center>
          </form>

        <br><br>

        <div class="col-lg-12 table-responsive" style="width: auto;">
          <table id="userTable2" class="display nowrap table-striped table-hover table-sm" id="exampleFormControlSelect2" class="form-control">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col"> Product</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Price</th>
                <th scope="col">Action</th>
              </tr>
            </thead>

            <tbody>

              <?php while($data=mysqli_fetch_assoc($resultEstimateList)){ ?>
                <tr>
                  <td >
                    <?php echo $ipaid =$data['peRateID']; ?>
                  </td>
                  <td >
                    <?php echo $data['peDiscription']; ?>
                  </td>
                  <td >
                    <?php echo $data['peRate']; ?>
                  </td>
                  <td >
                    <?php echo $data['peqty']; ?>
                  </td>
                  <td >
                    <?php echo $SubTotal = $data['peqty']* $data['peRate']; ?>
                  </td>
                  <td >
                    <form accept="" method="post">
                      <input type="hidden" name="peid" value=" <?php echo $ipaid ?>">
                      <input type="hidden" name="eid" value="<?php echo $EmployeeUID ?>">
                      <input type="hidden" name="penid" value="<?php echo $data['peid'] ?>">
                      <input type="submit" name="removeEstimate" value="Remove" class="btn btn-danger my-button">
                    </form>
                  </td>
                </tr>
              <?php $Sub = $Sub + $SubTotal; } 
              
              
              ?>
            </tbody>
          </table>
        </div>
        <br>
        <div align="right"><strong>Total Price: <?php echo $Sub; ?></strong></div>
        <br><br>
        <form method="post" action="">
          <center>
          <input type="submit"  class=" btn btn-success my-button" value="submit" name="submit"></input>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <input type="submit"  class=" btn btn-danger my-button" value="Back" name="back"></input>
          </center> 
          <!--
          <center> 
          <br>
          <input type="submit"  class=" btn btn-danger" value="Back" name="back"></input>
          </center>
        -->
      </form>  
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


<?php if(isset($_POST['removeEstimate']))
  {
    $peid=$_POST['peid'];
    $penid= $_POST['penid'];

    $queryRemove="DELETE FROM `add_estimate` WHERE  `EmployeeUID`='$EmployeeUID' and `peid`='$penid'";
    $resultRemove=mysqli_query($con3,$queryRemove);
    if($resultRemove){

      echo "<meta http-equiv='refresh' content='0'>";
    }
  }
  $con2 -> close();
  $con3 -> close();
  $con4 -> close();
?>