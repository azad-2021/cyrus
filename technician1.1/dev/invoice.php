<script type = "text/javascript" >  
  function preventBack() { window.history.forward(); }  
  setTimeout("preventBack()", 0);  
  window.onunload = function () { null };  
</script> 

<?php 

	include'connection.php';
	ob_start();
  $OID = $_GET['oid'];
  $complaintID = $_GET['cid'];
  $EmployeeUID = $_GET['eid'];
  $BranchCode = $_GET['brcode'];
  $approvalID = $_GET['apid'];
  $ZoneCode = $_GET['zcode'];
  $Date =  date("d/m/Y");

    $queryName="SELECT * FROM employees where EmployeeCode=$EmployeeUID";
    $resultName=mysqli_query($con2,$queryName);
    $dataName=mysqli_fetch_assoc($resultName);
    $name = $dataName['Employee Name']; 

$queryBank="SELECT * FROM branchs where BranchCode=$BranchCode";
$resultBank=mysqli_query($con2,$queryBank);
$dataBank=mysqli_fetch_assoc($resultBank);
$BranchName = $dataBank['BranchName'];
$District = $dataBank['Address3'];
$Zone = $dataBank['ZoneRegionCode'];
//echo $Zone;

$queryzone="SELECT * FROM zoneregions where ZoneRegionCode=$Zone";
$resultzone=mysqli_query($con2,$queryzone);
$datazone=mysqli_fetch_assoc($resultzone);
$BankCode = $datazone['BankCode'];

$queryBankName="SELECT * FROM Bank where BankCode=$BankCode";
$resultBankName=mysqli_query($con2,$queryBankName);
$dataBankName=mysqli_fetch_assoc($resultBankName);
$BankName = $dataBankName['BankName'];
    


    //echo '<script src="pdf.js"></script>';
    if(isset($_POST['submit'])){

       if(empty($_POST['more'])==true){
        echo '<script>alert("Please select more status")</script>';
      }elseif($_POST['more']=='YES') {
        header("location:card.php?cid=$complaintID&eid=$EmployeeUID&brcode=$BranchCode&oid=$OID&gid=&zcode=$ZoneCode");
      }elseif($_POST['more']=='NO'){
        header("location:redirect.php?eid=$EmployeeUID");
      } 
    //header("location:/html/redirect.php?eid=$EmployeeUID");

    }



?>

<html>

	<head>
	<title>Estimate</title>
	  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.js"></script>

		<style type="text/css">
		body {
			padding: 50px;		
			font-family: Verdana;
			font-size: 16px;
		}
		
		div.invoice {
		/*border:1px solid Black;*/
		padding:1px;
		height:900pt;
		width:700pt;
		}

		div.company-address {
			/*border:1px solid #ccc;*/
			float:left;
			width:800pt;
		}
		
		div.invoice-details {
			border:1px solid #ccc;
			float:right;
			width:200pt;
		}
		
		div.customer-address {
			border:1px solid #ccc;
			float:right;
			margin-bottom:50px;
			margin-top:100px;
			width:200pt;
		}
		
		div.clear-fix {
			clear:both;
			float:none;
		}
		
		table {
			width:100%;
		}
		
		th {
			text-align: center;
		}
		
		td {
			text-align: center;
			margin: 5px;
		}
		
		.text-left {
			text-align:center;
		}
		
		.text-center {
			text-align:center;
		}
		
		.text-right {
			text-align:right;
		}


		
		</style>
		  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

    <script>
				function printContent(el){
				var restorepage = $('body').html();
				var printcontent = $('#' + el).clone();
				$('body').empty().html(printcontent);
				window.print();
				$('body').html(restorepage);
				}
    </script>

	</head>
<div id="invoice">

		<div class="container" align="center">
			<h1><img src="cyrus logo.png" alt="Cyrus Electronics Pvt. Ltd." style="width:50px;height:60px;">
			<strong>Cyrus Electronics Pvt. Ltd.</strong></h1>
		</div>
		<br>
  
		<div class="container">
			<span><strong style="float: right;">Date: <?php echo $Date; ?></strong></span>
				<div class="company-address">
					<strong>The Branch Manager</strong><br>
					<strong>Branch: </strong> <?php echo $BranchName; ?><br>
					<strong>Bank: </strong> <?php echo $BankName; ?><br>
					<strong>District: </strong><?php echo $District; ?>
				</div>
				<br><br><br><br><br><br>
			<h4 align="center">Sub: Estimate for items in Security / Surveillance System</h4>
			<br>
			<p>Dear Sir,
				<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				After checking the security / Surveillance system, it was found that the undermentioned items are required to be installed for smooth functioning of the equipment. So, we are hereby presenting you the estimate for the same. 
			</p>
		
		<br>
		
		<div class="clear-fix"></div>
			<table border='1' cellspacing='0'>
				<tr>
					<th width=20>S.No.</th>
					<th width=250>Description</th>
					<th width=80>Unit Price</th>
					<th width=100>Quantity</th>
					<th width=100>Total price</th>
				</tr>

			<?php
			
			$queryProductList= "SELECT * FROM estimates WHERE ApprovalID=$approvalID";
 			$resultProductList=mysqli_query($con3,$queryProductList);
 			$count = 1;
 			$Sub = 0;
			while($data=mysqli_fetch_assoc($resultProductList)){
				$RateID = $data['RateID'];
				$QTY = $data['Qty'];
				//$Discription = $data['peDiscription'];
				$query= "SELECT * FROM rates WHERE RateID=$RateID";
				$result=mysqli_query($con4,$query);
				$dataMaterial=mysqli_fetch_assoc($result);
				$Description = $dataMaterial['Description'];
				$Rate = $dataMaterial['Rate'];

			 ?>

                          <tr>
                              <td >
                              <?php echo $count; ?>
                            </td>                         
                             <td >
                              <?php echo $Description; ?>
                            </td>
                             <td >
                               ₹<?php echo $Rate; ?>
                            </td>
                             <td >
                              <?php echo $QTY; ?>
                            </td>
                             <td >
                              ₹<?php echo $SubTotal =  $QTY* $Rate; ?>
                            </td>
                            
                            
                          </tr>
                        <?php
                        $count++;
                        $Sub = $Sub + $SubTotal;
                         }
                           	$con2 -> close();
  													$con3 -> close();
  													$con4 -> close();
  												?>
          
			</table>
			<br>
			<label><strong>Total : ₹<?php echo $Sub;?></strong></label><br>
			<strong>Note:</strong>
			<p>
				<ol>
					<li>
						Wiring (if mentioned) is an approximation and it will be charged on actual consumption basis.
					</li>
					<li>100% payment at the time of installation.</li>
					<li>GST shall be charged as per prevailing rates. (if applicable)</li>
				</ol>
				Hope you find the estimate satisfactory as per your requirement. We request you to kindly approve the estimates as soon as possible so that security / surveillance system can be made functional in the branch at the earliest.
				<br><br>
				With Warm Regards<p align="right">Name of Field Staff: <?php echo $name; ?></p>
				For Cyrus ELectronics Pvt. Ltd.
			</p>
		</div>
		<center>
			<br><br>
			<p style="font-size: 10px;"><strong>Cyrus house, B 44/69 Sector Q, Aliganj, Lucknow-24 Ph. (0522)274916, 2374190</strong></p>
		</center>
		</div>
		</div>
 </div>
 <div align="center">
 <button id="print" onclick="printContent('invoice'); " class=" btn btn-success">Print</button>
    </div>
    <br><br>
    <div class="container">
      <fieldset>
        
        <form method="post" action="">
          <h5 align="center">More cards:<br><br>
            <input type="radio" name="more" id="more" value="YES">
            <label for="YES">Yes</label>
            &nbsp;&nbsp;&nbsp;
            <input type="radio" id="more" name="more" value="NO">
            <label for="NO">No</label>
          </h5>
          <br><br>
          <center>
          <input type="submit"  class=" btn btn-success" value="submit" name="submit"></input>
          </center>      
        </form>
        <br>
      </fieldset>
    </div>
   <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>


    </script>
    <form method="post" action="" name="Home"></form>
	</body>


</html>


