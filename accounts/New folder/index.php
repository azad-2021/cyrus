<?php 
include 'connection.php';
//include 'session.php';
//$EXEID=$_SESSION['userid'];
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
  <title>Accounts</title>
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

  <style type="text/css">
  label{
    margin: 5px;
  }
</style>

</head>  
<body> 
  <?php 
  include 'navbar.php';
  include 'modals.php';

  ?>
  <div class="container">


    <div class="row g-3">
      <div class="col-md-12">
        <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
        <form class="needs-validation form-control novalidate my-select4" method="POST" style="margin-bottom: 5px;">
          <div class="row g-3">

            <div class="col-sm-4">
              <select id="Bank" class="form-control my-select3" name="Bank" required>
                <option value="">Bank</option>
                <?php
                $BankData="Select BankCode, BankName from bank order by BankName";
                $result=mysqli_query($con,$BankData);
                if (mysqli_num_rows($result)>0)
                {
                  while ($arr=mysqli_fetch_assoc($result))
                  {
                    ?>
                    <option value="<?php echo $arr['BankCode']; ?>"><?php echo $arr['BankName']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>
            <div class="col-sm-4">
              <select id="Zone" class="form-control my-select3" name="Zone" required>
                <option value="">Zone</option>
              </select>
            </div>
            <div class="col-sm-4">
              <select id="Branch" class="form-control my-select3" name="Branch" required>
                <option value="">Branch</option>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div id="VatView" class="table-responsive">

    </div>
    <br>
    <div id="GSTView" class="table-responsive">

    </div>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="ajax-script.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('table.display').DataTable( {
          responsive: false
        } );
      } );


      var exampleModal = document.getElementById('GSTPayment')
      exampleModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var billdate = button.getAttribute('data-bs-billdate')
        var SGST = button.getAttribute('data-bs-SGST')
        var CGST = button.getAttribute('data-bs-CGST')
        var IGST = button.getAttribute('data-bs-IGST')
        var Billno = button.getAttribute('data-bs-Billno')
        var TotalAmount = button.getAttribute('data-bs-Totalamount')
        var ReceiveAmount = button.getAttribute('data-bs-Receiveamount')
        var ReceiveDate = button.getAttribute('data-bs-ReceiveDate')
        var DD = button.getAttribute('data-bs-DD')
        var Remark = button.getAttribute('data-bs-Remark')

        var Samount = button.getAttribute('data-bs-Samount')
        document.getElementById("securityamount").value = Samount;
        console.log(Samount);
        if (Samount>0.00) {
          var SDt = button.getAttribute('data-bs-SDt')
          document.getElementById("securityDate").type="text";
          document.getElementById("securityDate").value = SDt;
        }
        var SRAmount = button.getAttribute('data-bs-SRAmount')
        document.getElementById("SreceiveAmount").value = SRAmount;
        if (SRAmount>0.00) {
          var SRDt = button.getAttribute('data-bs-SRDt')
          document.getElementById("SreceiveDate").type="text";
          document.getElementById("SreceiveDate").value = SRDt;
          
        }





  /*
  console.log(recipient);
  console.log(recipient2);
  console.log(recipient3);
  console.log(recipient4);
  console.log(recipient5);
  console.log(recipient6);
  console.log(recipient7);
  console.log(recipient8);
  */
  document.getElementById("receiveamount").value = ReceiveAmount;


  document.getElementById("billdate").value = billdate;
  document.getElementById("sgst").value = SGST;
  document.getElementById("cgst").value = CGST;
  document.getElementById("igst").value = IGST;
  document.getElementById("billedamount").value = TotalAmount;
  
  document.getElementById("receivedate").value = ReceiveDate;
  document.getElementById("billno").value = Billno;
  document.getElementById("DD").value = DD;
  document.getElementById("Remark").value = Remark;


  //console.log(typeof ReceiveAmount);
  if (parseInt(ReceiveAmount) != 0) {
    document.getElementById("receivedate").type="text";
    document.getElementById("receivedate").value = ReceiveDate;
    document.getElementById("receiveamount").disabled = true;
    document.getElementById("receivedate").disabled = true;
    document.getElementById("securityamount").disabled = true;
    document.getElementById("SreceiveAmount").disabled = true;
    //document.getElementById("Sreceivedate").disabled = true;
    //document.getElementById("Sreleasedate").disabled = true;


  }else{
    document.getElementById("receivedate").type="date";
    document.getElementById("receiveamount").disabled = false;
    document.getElementById("receivedate").disabled = false;
    document.getElementById("securityamount").disabled = false;
    document.getElementById("SreceiveAmount").disabled = false;
  }



  })



</script>
</body>
</html>
<?php 
$con->close();
$con2->close();
?>