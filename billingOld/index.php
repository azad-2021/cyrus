<?php 
include 'connection.php';
//include 'session.php';
//$EXEID=$_SESSION['userid'];
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date =date('Y-m-d',strtotime($timestamp));

?>

<!DOCTYPE html>  
<html>  
<head>   
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="Anant Singh Suryavanshi">
  <title>Billing</title>
  <link rel="icon" href="cyrus logo.png" type="image/icon type">
  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="sweetalert.min.js"></script>
</head>  
<body> 
  <?php 
  include 'navbar.php';
  //include 'modals.php';

  ?>
  <div class="container">

    <!-- Modal -->
    <div class="modal fade" id="FindRates" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Find Rates</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

           <div class="row g-3">
            <div class="col-md-12">
              <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
              <form class="needs-validation form-control novalidate my-select4" method="POST" style="margin-bottom: 5px;">
                <div class="row g-3">

                  <div class="col-sm-4">
                    <select id="BankR" class="form-control my-select3" name="Bank" required>
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
                    <select id="ZoneR" class="form-control my-select3" name="Zone" required>
                      <option value="">Zone</option>
                    </select>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control my-select3" onkeyup="myFunction()" id="searchRates" placeholder="search item">

                  </div>
                </div>
              </form>
            </div>
            <table class="table table-hover table-bordered border-primary display" id="itemData">
              <thead>
                <tr>
                  <th style="min-width:80px">Sr. No.</th>
                  <th style="min-width:200px">Item Name</th>
                  <th style="min-width:200px">Description</th>
                  <th style="min-width:100px">Rate</th>
                  <th style="min-width:150px">Update On</th>
                  <th style="min-width:200px">Change Item</th>
                </tr>
              </thead>
              <tbody id="materialRates">

              </tbody>
            </table>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#NewMateial">Add New Material</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="NewMateial" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
      <div class="modal-content" style="background-color:#E7E5F0">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Add New Material</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

         <div class="row g-3">
          <div class="col-md-12">
            <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
            <form class="needs-validation form-control novalidate my-select4" method="POST" style="margin-bottom: 5px;">
              <div class="row g-3">

                <div class="col-sm-4">
                  <select id="BankR" class="form-control my-select3" name="Bank" required>
                    <option value="">Select Item</option>
                    <?php
                    $Data="Select * from item order by ItemName";
                    $result=mysqli_query($con,$Data);
                    if (mysqli_num_rows($result)>0)
                    {
                      while ($arr=mysqli_fetch_assoc($result))
                      {
                        ?>
                        <option value="<?php echo $arr['ItemID']; ?>"><?php echo $arr['ItemName']; ?></option>
                        <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-2">
                  <input type="number" class="form-control my-select3" id="AddRate" placeholder="Enter Rate">
                </div>
                <div class="col-sm-6">
                  <input type="text" class="form-control my-select3" placeholder="Enter Description">

                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="UpdateRates" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-top modal-dialog-scrollable modal-lg">
    <div class="modal-content" style="background-color:#E8E3DC">
      <div class="modal-header">
        <input type="text" class="modal-title my-select3 form-control" id="ItemName" disabled>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

       <div class="row g-3">
        <div class="col-md-12">
          <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
          <form class="needs-validation novalidate my-select4" method="POST" style="margin-bottom: 5px;" id="f3">
            <center>
              <div class="col-md-6">

                <input type="number" class="form-control my-select3" id="NewRate" placeholder="Enter New Rate">


                <input type="text" class="form-control my-select3 d-none" id="rate_id">
              </div>
            </center>
          </form>
        </div>
      </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary SaveRate">Save</button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

    </div>
  </div>
</div>
</div>


<div class="modal fade" id="ViewOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Materials</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <table class="table table-hover table-bordered border-primary display" id="branchdata">
          <thead>
            <tr>
              <th style="min-width:60px">Sr. No.</th>
              <th style="min-width:200px">Item Name</th>
              <th style="min-width:200px">Description</th>
              <th style="min-width:100px">Item Rate</th>
              <th style="min-width:120px">GST Rate</th>
              <th style="min-width:120px">HSN Code</th>
              <th style="min-width:100px">Quantity</th>
              <th style="min-width:100px">Amount</th>
              <th style="min-width:250px">Select Category</th>
              <th style="min-width:100px">Delete</th>
            </tr>
          </thead>
          <tbody id="material">

          </tbody>
        </table>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary Add" data-bs-toggle="modal" data-bs-target="#addItem">Add Material</button>
        <button type="button" class="btn btn-primary generate" data-bs-dismiss="modal">Generate Invoice</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" data-bs-backdrop="static" id="addItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-xl modal-dialog-top modal-dialog-scrollable">
    <div class="modal-content" style="background-color:#E7E5F0">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Materials</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="material">

        </div>
        <br>
        <form id="f1">
          <div class="row text-centered">
            <div class="col-lg-5">
              <center>
                <label >Select Items</label>
              </center>
              <select id="ItemA" class="form-control my-select3" name="Items" required>
                <option value="">Select</option>
              </select>
            </div>
            <div class="col-lg-5">
              <center>
                <label>Enter Quantity</label>
              </center>
              <input type="number" name="" id="qty" class="form-control my-select3" onkeydown="limit(this);" onkeyup="limit(this);">
            </div>
            <div class="col-lg-2">
              <center>
                <label></label>
                <br>
              </center>
              <button type="button" class="btn btn-primary btn-lg addItems">Add</button>
            </div>
            <div class="col-lg-3 d-none">
              <input type="number" name="" id="approval" class="form-control">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary cl confirm">Confirm</button>-->
      </div>
    </div>
  </div>
</div>

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
<br><br>
<!--<div id="viewResult"></div>-->

<div class="table-responsive">
  <table class="table table-hover table-bordered border-primary display" id="branchdata">
    <thead>
      <tr>
        <th style="min-width:200px">Employee</th>
        <!--<th style="min-width:120px">Approval ID</th>-->
        <th style="min-width:100px">Order ID</th>
        <th style="min-width:120px">Complaint ID</th>
        <th style="min-width:250px">Description</th>
        <th style="min-width:120px">Visit Date</th>
        <th style="min-width:80px">Status</th>
        <th style="min-width:160px">Job Card Number</th>
        <th style="min-width:200px">View Installation Paper</th>
        <th style="min-width:150px">Material</th>

      </tr>
    </thead>
    <tbody id="Branchlist">

    </tbody>
  </table>
</div>
</div>
</div>

<script type="text/javascript">

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

  $(document).on('change','#Bank', function(){
    var BankCode = $(this).val();
    if(BankCode){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BankCode':BankCode},
        success:function(result){
          $('#Zone').html(result);

        }
      }); 
    }else{
      $('#Zone').html('<option value="">Zone</option>');
      $('#Branch').html('<option value="">Branch</option>'); 
    }
  });


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

    if(BranchCode){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BranchCode':BranchCode},
        success:function(result){
          $('#Branchlist').html(result);

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


  $(document).on('click','.viewMaterial', function(){
    console.log('>> '+ rateid.length);
    rateid.splice(0,rateid.length);
    hsncode.splice(0,hsncode.length);
    gstrates.splice(0,gstrates.length);
    console.log('>>> '+ rateid.length);
    var Apid = $(this).attr("id");
    document.getElementById("approval").value = Apid;
    
    if(Apid){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'ApprovalID':Apid},
        success:function(result){
          $('#material').html(result);
          $('#ViewOrder').modal('show');

        }
      }); 
    }
  });


  $(document).on('click','.addDesc', function(){
    var Desc = $(this).attr("id");
    var RateID= $(this).attr("id2");
    document.getElementById("ItemName").value = Desc;
    document.getElementById("rate_id").value = RateID;
  });



  Array.prototype.contains = function(obj) {
    var i = this.length;
    while (i--) {
      if (this[i] == obj) {
        return true;
      }
    }
    return false;
  }


  $(document).on('change','#GstRates', function(){
    var Data = $(this).val();
    console.log(Data);
    const obj = JSON.parse(Data);
    HSN = obj.HSN;
    GST=obj.GST;
    RateID=obj.RateID;
    ID=obj.ID;

    if (rateid.contains(RateID)==true) {
      const index = rateid.indexOf(RateID);
      hsncode.splice(index, 1);
      rateid.splice(index, 1);
      gstrates.splice(index, 1);
      rateid.push(RateID);
      hsncode.push(HSN);
      gstrates.push(GST);
    }else{
      rateid.push(RateID);
      hsncode.push(HSN);
      gstrates.push(GST);
    }
    console.log(hsncode);
    console.log(rateid);
    console.log(gstrates);
    document.getElementById(RateID).value = GST;
    document.getElementById(ID).value = HSN;
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

      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'ApprovalID':Apid},
        success:function(result){
          $('#material').html(result);
          $('#ViewOrder').modal('show');

        }
      }); 
    }
  });


  $(document).on('click','.addItems', function(){
    var data = document.getElementById("ItemA").value;
    var Apid=document.getElementById("approval").value;
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
          var err=result
          if(err==1){
            swal("error", "Item already exist", "error"); 
          }else{
            swal("success", "Item Added", "success"); 
          }
          document.getElementById("f1").reset();
          document.getElementById("approval").value = Apid;
        }
      }); 
    }

    if(Apid){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'ApprovalID':Apid},
        success:function(result){
          $('#material').html(result);
          $('#ViewOrder').modal('show');

        }
      }); 
    }

  });


  $(document).on('click','.SaveRate', function(){
    var RateID = document.getElementById("rate_id").value;
    var Rate=document.getElementById("NewRate").value;
    var ZoneCode=document.getElementById("ZoneR").value;

    console.log(RateID);

    if(Rate){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'RateID':RateID, 'Rate':Rate},
        success:function(result){
          swal("success", "Rate Updated", "success"); 
          document.getElementById("f3").reset();
          $('#UpdateRates').modal('hide');
        }
      }); 
    }else{
      swal("error", "Please enter rate", "error"); 
    }

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


  $(document).on('click','.generate', function(){
    var Apid=document.getElementById("approval").value;
    var BranchCode=document.getElementById("Branch").value;
    console.log(hsncode);
    console.log(rateid);
    console.log(gstrates);
    //window.open("invoice.php?apid="+Apid+"&bcode="+BranchCode, "_blank");


    var delayInMilliseconds = 5000; 

    setTimeout(function() {
      if(BranchCode){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'BranchCode':BranchCode},
          success:function(result){
            $('#Branchlist').html(result);

          }
        });
      }
    }, delayInMilliseconds);

  });

  function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchRates");
  filter = input.value.toUpperCase();
  table = document.getElementById("itemData");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}


$(document).on('change','#ChangeItem', function(){
  var ZoneCode=document.getElementById("ZoneR").value;
  var ItemID=$(this).val();
  var sr=$(this).attr("id2");
  
  var RateID = document.getElementById(sr).value;
  console.log(sr);
  console.log(RateID);
  console.log(ItemID);
  if(ItemID){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'ItemID':ItemID, 'RateID':RateID},
      success:function(result){

        swal("success", "Item Category updated", "success");
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
  }
});
</script>
</body>
</html>
<?php 
$con->close();
$con2->close();
?>