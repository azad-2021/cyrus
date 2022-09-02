<script type = "text/javascript" >  
  function preventBack() { window.history.forward(); }  
  setTimeout("preventBack()", 0);  
  window.onunload = function () { null };  
</script> 


<?php 

  include 'connection.php';

  $OID = $_GET['oid'];
  $complaintID = $_GET['cid'];
  $EmployeeID = $_GET['eid'];
  $BranchCode = $_GET['brcode'];
  $approvalID = $_GET['apid'];
   $queryApprovalID="SELECT * FROM approval where ApprovalID=$approvalID";
  $resultApprovalID=mysqli_query($con2,$queryApprovalID);
  $dataApprovalID=mysqli_fetch_assoc($resultApprovalID);
  $JOBCARD= $dataApprovalID['JobCardNo'];
  //echo $JOBCARD;
  if(empty($_GET['zcode'])==true){
     $queryProduct="SELECT * FROM rates"; 
   }else{
     $ZoneCode = $_GET['zcode'];
     $queryProduct="SELECT * FROM rates WHERE Zone=$ZoneCode"; 
   }
  $Sub=0;
  
  $resultProduct=mysqli_query($con4,$queryProduct);  //select all products
  $queryProductList= "SELECT * FROM add_product where paEmployeeID=$EmployeeID";
  $resultProductList=mysqli_query($con3,$queryProductList);

    $queryBilling="SELECT * FROM add_product where paEmployeeID=$EmployeeID";
    $resultBilling=mysqli_query($con3,$queryBilling);


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
    $result1=mysqli_query($con3,$query1);
    if(empty($usedas)==true){
      echo '<script>alert("Please select Used As option")</script>';
    }elseif(empty(mysqli_fetch_assoc($result1))==false){
      echo '<script>alert("Product already in list")</script>';
    }else{

    $queryCheckStock="SELECT * From rates where RateID=$RateID";
    $resultCheckStock=mysqli_query($con4,$queryCheckStock);
    $dataCheckStock=mysqli_fetch_assoc($resultCheckStock);


    $paRateID = $dataCheckStock['RateID'];
    $paDiscription = $dataCheckStock['Description'];
    $paRate = $dataCheckStock['Rate'];
    if ($usedas=='Waranty') {
      $paRate = '';
    }
    //echo $EmployeeID;
    $queryAdd="INSERT INTO `add_product`( `paRateID`, `paEmployeeID`, `paDiscription`, `paRate`, `paqty`, `UsedAs`) VALUES ('$paRateID', '$EmployeeID', '$paDiscription', '$paRate', '$qty', '$usedas')";
    mysqli_query($con3,$queryAdd);
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
        mysqli_query($con3,$queryAdd);
      }


    $queryRemove="DELETE FROM `add_product` WHERE `paEmployeeID`='$EmployeeID'";
    $resultRemove=mysqli_query($con3,$queryRemove);

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
    <title>Add Product</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="icon" href="cyrus logo.png" type="image/icon type">
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

<?php 
  include 'navbar.php';
?>
<legend >Select Items</legend>
    <div class="container">
      <fieldset >        
          <form method="post" action="">
            <div class="form-row">
            <div class="form-group col-md-4">
            <label for="exampleFormControlSelect2">Item</label>
            <select  required name="RateID" class="form-control select my-select" id="exampleFormControlSelect2" >
              <?php
                while($data=mysqli_fetch_assoc($resultProduct)){

                  echo '<option value='.$data['RateID'].'>'.$data['Description'].'</option>'; 
                }  
              ?>
            </select>
            </div>
            
              <div class="form-group col-md-4">
            <label for="quantity">Quantity</label>
            <input type="number" required class="form-control my-select" name="qty" id="qt" maxlength="5" id="txtInput" onkeypress="return checkSpcialChar(event)" onkeydown="limit(this);" onkeyup="limit(this);">
            
            </div>
            <div class="form-group col-md-4">
            <label for="as">As</label>
            <select name="as" id="as" id="exampleFormControlSelect2" class="form-control my-select">
              <option value="">Choose option</option>
              <option value="Billing">Billing</option>
              <option value="Waranty">Waranty</option>
              <option value="CAMC">CAMC</option>
              <option value="Standby">Standby</option>
            </select>
            </div>
            
            </div>
              <center>
            <input type="submit" style="margin-bottom: 20px;" class=" btn btn-success my-button" value="Add" name="Add"></input>
            </center>            
            
          </form>
              
        <div class="col-lg-12">
          <table id="userTable2" class="display nowrap table-striped table-hover table-sm" id="exampleFormControlSelect2" class="form-control">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col"> Product</th>
                <th scope="col">As</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Price</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php while($data=mysqli_fetch_assoc($resultProductList)){ ?>
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
              <?php $Sub = $Sub + $SubTotal;} 


                ?>
            </tbody>
          </table>       
          <br>
        <div align="right"><strong>Total Price: <?php echo $Sub; ?></strong></div>
        <br><br>
        </div>        
        <form method="post" action="">
          <h5 align="center">Estimate Given:<br><br>
            <input type="radio" name="estimate" id="estimate" value="YES">
            <label for="OK">Yes</label>
            &nbsp;&nbsp;&nbsp;
            <input type="radio" id="estimate" name="estimate" value="NO">
            <label for="NOT OK">No</label>
          </h5>
          <br> <br>
            <center>
            <input type="submit"  class=" btn btn-success my-button" value="submit" name="submit"></input>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit"  class=" btn btn-danger my-button" value="Back" name="back"></input>
          </center> 
              
          </div>
        </form>
      </fieldset>
      </div>
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


<?php if(isset($_POST['removeProduct']))
  {
    $rate=$_POST['rateid'];
    $eid=$_POST['eid'];
    $UsedAs= $_POST['us'];

    $queryRemove="DELETE FROM `add_product` WHERE  `paRateID`='$rate' and `paEmployeeID`='$eid' and UsedAs='$UsedAs'";
    $resultRemove=mysqli_query($con3,$queryRemove);
    if($resultRemove){

      echo "<meta http-equiv='refresh' content='0'>";
    }
  }

  $con2 -> close();
  $con3 -> close();
  $con4 -> close();  

?>
