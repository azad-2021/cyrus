<?php 
include 'connection.php';
include 'session.php';
$EXEID=$_SESSION['userid'];
$Bulk=1;
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
  <title>Multi-Orders Confirmation</title>
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
  //include 'modals.php';

  ?>
  <div class="container">
    <div class="modal fade" data-bs-backdrop="static" id="AddMulti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Materials</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <table class="table" id="myTable">
              <thead>
                <tr class="w3-blue">
                  <th nowrap>Sl.No</th>      
                  <th nowrap>Rate ID</th>      
                  <th nowrap>Quantity</th>
                  <th nowrap>Action</th>
                </tr>
              </thead>
              <tbody >
              </tbody>
            </table>
            <br>
            <form id="f1">
              <div class="row text-centered">
                <div class="col-lg-5">
                  <center>
                    <label >Select Items</label>
                  </center>
                  <select id="MaterialView" class="form-control my-select3" name="Items" required>
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
                  <button type="button" class="btn btn-primary btn-lg" id="save">Add</button>
                </div>
                <div class="col-lg-3 d-none">
                  <input type="number" name="" id="orderid" class="form-control">
                </div>
                <div class="col-lg-3 d-none">
                  <input type="number" name="" id="ZoneCode" class="form-control">
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary cl" data-bs-dismiss="modal">Close</button>
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
              <select id="BankM" class="form-control my-select3" name="Bank" required>
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
              <select id="ZoneM" class="form-control my-select3" name="Zone" required>
                <option value="">Zone</option>
              </select>
            </div>
            <div class="col-sm-4">
              <!--
              <select id="MaterialView" class="form-control my-select3" name="" required>
                <option value="">select</option>
              </select>
            -->
            <button type="button" style="margin-top: 10px;" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#AddMulti">Select Material</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <br><br>
  <div id="viewResult"></div>
  <table class="table table-hover table-bordered border-primary display">
    <thead>
      <tr>
        <th>Branch</th>
        <th>Order ID</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="MultiOrders">

    </tbody>
  </table>
  <center>
    <button class="btn-primary S" id="button">Submit</button>
  </center>
</div>
<script src="ajax.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script type="text/javascript">
    /*
    $(document).ready(function() {
      $('table.display').DataTable( {
        responsive: false
      } );
    } );
    */

    var BankCode=0;
    $(document).on('change','#BankM', function(){
      BankCode = $(this).val();
      if(BankCode){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'BankCode':BankCode},
          success:function(result){
            $('#ZoneM').html(result);

          }
        }); 
      }else{
        $('#ZoneM').html('<option value="">Zone</option>');
      }
    });

    $(document).on('change','#ZoneM', function(){
      var ZoneCode = $(this).val();
      console.log(BankCode);
      if(ZoneCode){
        $.ajax({
          type:'POST',
          url:'multiordersdata.php',
          data:{'ZoneCode':ZoneCode, 'BankCode':BankCode},
          success:function(result){
            $('#MultiOrders').html(result);

          }
        }); 
      }
    });

    $(document).on('change','#ZoneM', function(){
      var ZoneCode = $(this).val();
      console.log(BankCode);
      if(ZoneCode){
        $.ajax({
          type:'POST',
          url:'multiordersdata.php',
          data:{'ZoneCodeM':ZoneCode},
          success:function(result){
            $('#MaterialView').html(result);

          }
        }); 
      }else{
        $('#MaterialView').html('<option value="">material</option>'); 
      }
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

    var qty = [];
    var rateid = [];
    var ItemID=[];
    $('#save').on('click', function() {
      console.log($('#MaterialView').val());
      const obj = JSON.parse($('#MaterialView').val());
      
      if (obj.ItemID==1654) {
        alert("Item is in undecided category. Please contact to store");
      }else if(rateid.contains(obj.RateID)==true){
        alert("Item already exist");
      }else{
        var RateID=obj.RateID;
        var Qty=$('#qty').val();
        var count = $('#myTable tr').length;
        if(RateID!="" && Qty !=""){
          qty.push(Qty);
          rateid.push(RateID);
          ItemID.push(obj.ItemID);
          console.log(qty);
          console.log(rateid);
          $('#myTable tbody').append('<tr class="child"><td>'+count+'</td><td>'+obj.Name+'</td><td>'+Qty+'</td><td><a href="javascript:void(0);" class="remCF1 btn btn-small btn-danger">Remove</a></td></tr>');
        }
      }
      document.getElementById("f1").reset();

    });
    $(document).on('click','.remCF1',function(){
      $(this).parent().parent().remove();
      $('#myTable tbody tr').each(function(i){            
       $($(this).find('td')[0]).html(i+1);          
     });
    });


    function limit(element)
    {
      var max_chars = 5;

      if(element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
      }
    }

/*
    $(document).on('click', '.S', function(){

      var delayInMilliseconds = 1000; 

      setTimeout(function() {
        location.reload();
      }, delayInMilliseconds);


    });

*/

    $('#button').on('click', function() {
      var array = [];
      $("input:checkbox[name=select]:checked").each(function() {
        //
        array.push($(this).val());
      });
      console.log(array);
      const Data= JSON.stringify(array);
      console.log(Data);
      if (array[0]=='' || rateid[0]=='') {
        alert("Item or Order field is empty");
      }else{
        $.ajax({
          type:'POST',
          url:'addmultiorders.php',
          data:{OrderID:Data, RateID: JSON.stringify(rateid), ItemID: JSON.stringify(ItemID), Qty: JSON.stringify(qty)},
          success:function(result){
            $('#viewResult').html(result);

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