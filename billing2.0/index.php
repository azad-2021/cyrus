<?php 
include 'connection.php';
include 'session.php';

//$EXEID=$_SESSION['userid'];

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));
$NintyDays = date('Y-m-d', strtotime($Date. ' - 90 days'));

$Hour = date('G');

if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
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

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.0.1/css/stateRestore.dataTables.min.css">


  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="assets/js/sweetalert.min.js"></script>
  <style type="text/css">
  table{
    font-size: 14px;
  }
  th,a {
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
        <li class="breadcrumb-item active">Billing</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">

        <form class="form-control rounded-corner" method="POST" style="margin-bottom: 5px;">
          <div class="row">

            <div class="col-lg-3">
              <label>Select Bank</label>
              <select id="Bank" class="form-control rounded-corner" name="Bank" required>
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
            <div class="col-lg-3">
              <label>Select Zone/Region</label>
              <select id="Zone" class="form-control rounded-corner" name="Zone" required>
                <option value="">Zone</option>
              </select>
            </div>
            <div class="col-lg-3">
              <label>Select Branch</label>
              <select id="Branch" class="form-control rounded-corner" name="Branch" required>
                <option value="">Branch</option>
              </select>
            </div>

            <div class="col-lg-3">
              <label>Branch Code</label>
              <input type="text" class="form-control rounded-corner" id="Branch_Code" name="" disabled>
            </div>

            <div class="col-lg-3">
              <label>GST No.</label>
              <input type="text" class="form-control rounded-corner" id="BranchGST" name="" disabled>
            </div>

            <div class="col-lg-3">
              <label>Branch Email</label>
              <input type="text" class="form-control rounded-corner" id="BranchEmail" name="" disabled>
            </div>
            <div class="col-lg-3">
              <label>Billing From</label>
              <select id="BillingFrom" class="form-control rounded-corner" name="" required>
                <option value="">Select</option>
                <option value="CEBH">Bihar</option>
                <option value="CECH">Chandigarh</option>
                <option value="CEDL">Delhi</option>
                <option value="CEUP">Uttar Pradesh</option>
                <option value="CIUP">CISPL</option>
              </select>
            </div>
            <div class="col-lg-3">
              <label>State</label>
              <select id="BillingTo" class="form-control rounded-corner" name="" required>
                <option value="">Select</option>
                <?php
                $Data="SELECT * FROM cyrusbilling.states ORDER BY `State Name`";
                $result=mysqli_query($con,$Data);
                if (mysqli_num_rows($result)>0)
                {
                  while ($arr=mysqli_fetch_assoc($result))
                  {
                    ?>
                    <option value="<?php echo $arr['StateCode']; ?>"><?php echo $arr['State Name']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>

            <!--<div class="col-lg-3">
              <select id="employee" class="form-control rounded-corner" name="Employee" required>
                <option value="">Select</option>
                <?php
                $Data="SELECT * FROM cyrusbackend.employees WHERE Inservice=1 ORDER BY `Employee Name`";
                $result=mysqli_query($con,$Data);
                if (mysqli_num_rows($result)>0)
                {
                  while ($arr=mysqli_fetch_assoc($result))
                  {
                    ?>
                    <option value="<?php echo $arr['EmployeeCode']; ?>"><?php echo $arr['Employee Name']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>-->

          </div>
        </form>

        <div class="table-responsive" style="margin:25px;">
          <table class="table table-hover table-bordered border-primary display" id="branchdata">
            <thead>
              <tr>
                <th style="min-width:150px">Employee</th>
                <th style="min-width:80px">Order ID</th>
                <th style="min-width:80px">Complaint ID</th>
                <th style="min-width:200px">Description</th>                            
                <th style="min-width:150px">Visit Date</th>
                <th style="min-width:100px"><input  class="form-check-input" type="checkbox" value="" id="SelectAll">
                  <label class="form-check-label">
                    Select All
                  </label></th>

                </tr>
              </thead>
              <tbody id="Branchlist">

              </tbody>
            </table>
          </div>
          <button type="button" class="btn btn-lg btn-primary CreateInvoice" style="float:right">Save for Billing</button>

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


  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>

  <script src="assets/js/main.js"></script>
  <script src="ajax.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('table.display').DataTable( {
        responsive: false,
        stateSave: false,
      } );
    } );

    $("#SelectAll").change(function () {
      $("input:checkbox").prop('checked', $(this).prop("checked"));
    });


    var rateid = [];
    var hsncode = [];
    var gstrates = [];


    function limit(element)
    {
      var max_chars = 5;

      if(element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
      }
    }



    $(document).on('change','#Zone', function(){
      var ZoneCode = $(this).val();

      if(ZoneCode){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'ZoneCode':ZoneCode},
          success:function(result){
            $('#Branch').html(result);

          }
        }); 

        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'ZoneCodeM':ZoneCode},
          success:function(result){
            $('#ItemA').html(result);

          }
        });


      }else{

        $('#Branch').html('<option value=""> Branch </option>'); 
      }
    });


    $(document).on('change','#Branch', function(){
      var BranchCode = $(this).val();
      //var BranchCode = document.getElementById("Branch").value
      if(BranchCode){


        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'BranchCodeD':BranchCode},
          success:function(result){
            //$('#ItemA').html(result);
            //alert(result);

            const obj = JSON.parse(result);
            Branch_Code = obj.Branch_Code;
            GST=obj.GST;
            Email=obj.Email;

            document.getElementById("Branch_Code").value=Branch_Code;
            document.getElementById("BranchGST").value=GST;
            document.getElementById("BranchEmail").value=Email;

          }
        });


        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'BranchCode':BranchCode},
          success:function(result){

            $('.display').DataTable().clear();
            $('.display').DataTable().destroy();
            $('#Branchlist').html(result);

            $('table.display').DataTable( {

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



    $(document).on('change','#BankR', function(){
      var BankCode = $(this).val();
      if(BankCode){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'BankCode':BankCode},
          success:function(result){
            $('#ZoneR').html(result);

          }
        }); 
      }else{
        $('#ZoneR').html('<option value="">Zone</option>');
      }
    });


    $(document).on('change','#ZoneR', function(){
      var ZoneCode = $(this).val();
      if(ZoneCode){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'ZoneCodeR':ZoneCode},
          success:function(result){
            $('#materialRates').html(result);

          }
        }); 

      }
    });


    $(document).on('change','#GstRates', function(){
      var Data = $(this).val();
      console.log(Data);
      const obj = JSON.parse(Data);
      HSN = obj.HSN;
      GST=obj.GST;
      BillingID=obj.BillingID;
      ID=obj.ID;
      
      document.getElementById(BillingID).value = GST;
      document.getElementById(ID).value = HSN;
    });




    var APID = [];
    $(document).on('click','.CreateInvoice', function(){
      APID=[];
      var BranchCode=document.getElementById("Branch").value;
      var BillingFrom=document.getElementById("BillingFrom").value;
      var BillingTo=document.getElementById("BillingTo").value;
      $("input:checkbox[name=select]:checked").each(function() {
        //
        APID.push($(this).val());
      });

      if (APID.length==0) {
        swal("error", "No Work ID Selected", "error");
      }else if (BillingFrom=='') {
        swal("error", "Please select Billing from", "error");
      }else if (BillingTo=='') {
        swal("error", "Please select Billing to", "error");
      }else{
        //var element = document.getElementByClass("button");
        //element.classList.add("d-none");

        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'APIDArr':APID},
          success:function(result){

            $('#material').html(result);
            $('#ViewWork').modal('show');

            $.ajax({
              type:'POST',
              url:'dataget.php',
              data:{'BranchAddShow':BranchCode},
              success:function(result){

                $('#materialAD').html(result);

              }
            });


            $.ajax({
              type:'POST',
              url:'dataget.php',
              data:{'AddAmount':BranchCode},
              success:function(result){
                document.getElementById("TotalAmount").innerHTML='';
                document.getElementById("TotalAmount").innerHTML='Total Amount with GST:'+result;

              }
            });


          }
        });

      }
    });


    $(document).on('click','.delete', function(){
      var data = $(this).attr("id");
      const obj = JSON.parse(data);
      Apid = obj.ApprovalID;
      console.log(Apid);
      if (confirm("You want to Delete Item. do you wish to continue?")) {

        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'Delete':data},
          success:function(result){

            swal("success", "Item Deleted", "success"); 
          }
        }); 


        var delayInMilliseconds = 1000; 

        setTimeout(function() {


          $.ajax({
            type:'POST',
            url:'dataget.php',
            data:{'APIDArr':APID},
            success:function(result){

              $('#material').html(result);
              $('#ViewWork').modal('show');

            }
          });  

        }, delayInMilliseconds);

      }
    });



    $(document).on('click','.ShowMaterial', function(){

      var delayInMilliseconds = 1000; 
      var BranchCode=document.getElementById("Branch").value;
      setTimeout(function() {


        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'APIDArr':APID},
          success:function(result){

            $('#material').html(result);
            $('#ViewWork').modal('show');

          }
        });  


        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'BranchAddShow':BranchCode},
          success:function(result){

            $('#materialAD').html(result);
            //$('#ViewWork').modal('show');

          }
        });


        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'AddAmount':BranchCode},
          success:function(result){
            document.getElementById("TotalAmount").innerHTML='';
            document.getElementById("TotalAmount").innerHTML='Total Amount with GST:'+result;

          }
        });



      }, delayInMilliseconds);


    });

    var CategoryID=0;
    $(document).on('change','#GstRatesNew', function(){
      var Data = $(this).val();
      console.log(Data);
      
      const obj = JSON.parse(Data);
      HSN = obj.HSN;
      GST=obj.GST;
      CategoryID = obj.CategoryID;
      document.getElementById("GSTAdd").value = GST;
      document.getElementById("HSNAdd").value = HSN;
    });




    $(document).on('click','.SaveAdditionalItems', function(){

      var HSNAdd=document.getElementById("HSNAdd").value;
      
      var ItemName=document.getElementById("ItemAdd").value;
      var RateAdd=document.getElementById("RateAdd").value;
      var QtyAdd=document.getElementById("QtyAdd").value;
      
      var DiscAdd=document.getElementById("DiscAdd").value;
      var BranchCode=document.getElementById("Branch").value;

      if (ItemName && RateAdd && QtyAdd && HSNAdd && DiscAdd && BranchCode) {


        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'ItemNameAdd':ItemName, 'RateAdd':RateAdd, 'QtyAdd':QtyAdd, 'CategoryID':CategoryID, 'DiscAdd':DiscAdd, 'BranchCodeAdd':BranchCode},
          success:function(result){

            if (result==1) {
              swal("success","material added","success");
              $('#FAdd').trigger("reset");
            }else{
              swal("error",result,"error");
            }


            $.ajax({
              type:'POST',
              url:'dataget.php',
              data:{'AddAmount':BranchCode},
              success:function(result){
                document.getElementById("TotalAmount").innerHTML='';
                document.getElementById("TotalAmount").innerHTML='Total Amount with GST:'+result;

              }
            });


            
          }
        });

      }else{
        swal("error","Please enter all fields","error");
      }

    });


    $(document).on('click','.deleteAdd', function(){
      var ID = $(this).attr("id");
      var BranchCode=document.getElementById("Branch").value;
      if (confirm("You want to Delete Item. do you wish to continue?")) {

        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'DeleteAdd':ID},
          success:function(result){
            if (result==1) {
              swal("success", "Item Deleted", "success"); 


              var delayInMilliseconds = 1000; 

              setTimeout(function() {


                $.ajax({
                  type:'POST',
                  url:'dataget.php',
                  data:{'BranchAddShow':BranchCode},
                  success:function(result){

                    $('#materialAD').html(result);
                  }
                });
              }, delayInMilliseconds);

            }else{
              swal("success", result, "success");
            }
          }
        }); 




      }
    });


    $(document).on('click','.addItems', function(){
      var data = document.getElementById("ItemA").value;
      var Apid=APID;
      var Qty=document.getElementById("qty").value;
      const obj = JSON.parse(data);
      RateID = obj.RateID;
      console.log(RateID);
      if(data){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'Add':RateID, 'Approval':Apid, 'Qty':Qty},
          success:function(result){

            if(result==1){
              swal("success", "Material Added", "success"); 
              document.getElementById("f1").reset();
            }else{
              swal("error", result, "error"); 
            }
            
            
          }
        }); 
      }

    });
    

    var BillingErr=0;

    $(document).on('change','#BillingSelect', function(){
      var BillingID = $(this).val();
      var HSNID= $(this).attr("id2");
      var BranchCode=document.getElementById("Branch").value;
      var amt= document.getElementById("TotalAmount").innerHTML;
      var amountarr=[];
      if(this.checked) {
        var BarCode = document.getElementById("Bar"+BillingID).value;
        var Disc = document.getElementById("Disc"+BillingID).value;
        var HSN = document.getElementById(HSNID).value;
        var GST=document.getElementById(BillingID).value;

        if (BarCode=='') {
          swal("error", "Please enter barcode", "error"); 

          $(this).prop('checked', false);
        }else if (HSN=='') {
          swal("error", "Please Select GST Category", "error"); 

          $(this).prop('checked', false);
        }else if (Disc=='') {
          swal("error", "Please enter discount", "error"); 

          $(this).prop('checked', false);
        }else{
          //var data= $(this).attr("id3");
          //const obj = JSON.parse(data);
          document.getElementById("Disc"+BillingID).disabled=true;
        }


      }else{
        document.getElementById("Disc"+BillingID).disabled=false;
      }
      $("input:checkbox[name=BillingSelect]:checked").each(function() {

        var BillingID1 = $(this).val();

        var Disc1 = document.getElementById("Disc"+BillingID1).value;
        var GST1=document.getElementById(BillingID1).value;

        Value = parseInt($(this).attr("id3"));

        var GSTAmount=((Value*GST1)/100);
        var Amount=Value+GSTAmount;
        Amount=Amount-((Amount*Disc)/100);
            //alert(Value);
            //alert(GSTAmount);
            //alert(Amount);
            //alert(GST);
            amountarr.push(Amount);

          });

          const SumAmount = amountarr.reduce(add, 0); // with initial value to avoid when the array is empty

          function add(accumulator, a) {
            return accumulator + a;
          }
          document.getElementById("TotalAmount").innerHTML='';

          $.ajax({
            type:'POST',
            url:'dataget.php',
            data:{'AddAmount':BranchCode},
            success:function(result){
              var Sum =(SumAmount+parseFloat(result)).toFixed(2);
              document.getElementById("TotalAmount").innerHTML='';
              document.getElementById("TotalAmount").innerHTML = "Total Amount with GST: "+Sum;

            },
            async: false
          });


          
        });


    $(document).on('click','.GenerateInvoice', function(){
      var BranchCode=document.getElementById("Branch").value;
      var BillingFrom=document.getElementById("BillingFrom").value;
      var BillingTo=document.getElementById("BillingTo").value;
      var BranchGST=document.getElementById("BranchGST").value;

      var BarCodeArr = document.getElementsByName('BarCodeArray[]');
      var HSNArr = document.getElementsByName('HSN[]');
      var DiscArr = document.getElementsByName('Discount[]');
      var AddDiscount=document.getElementById("AddDiscount").value;

      var BillingID=[];
      var BarCode=[];
      var HSN=[];
      var Discount=[];
      var Consumed=0;
      var merr=0;

      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'CheckConsumed':BranchCode},
        success:function(result){

          if(result==1){
            Consumed=1;
          }else{
            Consumed=0;
          }
        },
        async: false
      }); 


      
      $("input:checkbox[name=BillingSelect]:checked").each(function() {

        BillingID.push($(this).val());

      });



      for (var i = 0; i < BarCodeArr.length; i++) {

        var a = BarCodeArr[i];
        var b = HSNArr[i];
        var c = DiscArr[i];

        if (a.value!='' && b.value!='' && c.value!='') {
          BarCode.push(a.value);
          HSN.push(b.value);            
          Discount.push(c.value);
        }
      }

      console.log(BarCode);
      console.log(HSN);
      console.log(Discount);

      
      //alert(BillingID.length);
      if (BillingID.length==0 && Consumed==0) {
        swal("error","Please select materials for billing","error");
      }else{


        if (confirm("You want to generate invoice. Do you wish to continue?")) {

          if (BranchGST && AddDiscount) {

            $.ajax({
              type:'POST',
              url:'generateinvoice.php',
              data:{'BranchCode':BranchCode, 'BillingFrom':BillingFrom, 'BillingTo':BillingTo, 'BillingID':BillingID, 'BarCode':BarCode, 'HSN':HSN, 'Discount':Discount, 'Consumed':Consumed, 'BranchGST':BranchGST, 'APID':APID, 'AddDiscount':AddDiscount},
              success:function(result){

                //alert(result);

                if(result==1){
                  window.open('exportpdf.php', '_blank').focus();
                  window.location.reload();
                }

              }
            });

          }else if(BranchGST==''){

            swal("error","No GST number found in branch", "error"); 

          }else if(AddDiscount==''){

            swal("error","Please enter additional discount", "error"); 

          } 
        }
      }

    });

  </script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>