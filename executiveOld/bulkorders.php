
<?php 
//include 'connection.php';
include 'session.php';
$host = "localhost";  
$user = "root";  
$password = '';  
$db_2 = "backend";
$db_3 = "cyrusbilling";

$con = mysqli_connect($host, $user, $password, $db_2);  
if(mysqli_connect_errno()) {  
  die("Failed to connect with MySQL: ". mysqli_connect_error());  
}
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
  <title>Home</title>
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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.0.1/css/stateRestore.dataTables.min.css">

  

</head>  
<body> 

  <?php 
  include 'navbar.php';
  include 'modals.php';
  ?>
  <div class="container">




    <div class="modal fade" data-bs-backdrop="static" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  <select id="ItemID" class="form-control my-select3" name="Items" required>
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
    <div id="viewResult"></div>
    <table id="materialP" class="table table-hover table-bordered border-primary display responsive nowrap" style="width:100%">
      <h5 align="center" style="margin:20px;">Pending Material Confirmation for bulk orders</h5>
      <thead id="unhead">
        <tr>

          <th>Bank</th>
          <th>Zone</th>
          <th>Branch</th>
          <th>Order ID</th>
          <th>Select</th>       
        </tr>
      </thead>
      <tbody >
        <?php 
        $query="SELECT orders.OrderID, StatusID, Discription, DateOfInformation, orders.BranchCode, DemandGenDate, BankName, ZoneRegionName, ZoneRegionCode, BranchName
        FROM backend.orders join demandbase on orders.OrderID=demandbase.OrderID
        join branchdetails on orders.BranchCode=branchdetails.BranchCode
        WHERE demandbase.StatusID=1 order by DateOfInformation";

        $result=mysqli_query($con,$query);
        while($row = mysqli_fetch_array($result)){
          ?>
          <tr>

            <td><?php echo $row["BankName"]; ?></td>

            <td><?php echo $row["ZoneRegionName"]; ?></td>

            <td><?php echo $row["BranchName"];; ?></td>

            <td  ><a href="" class="add" data-bs-toggle="modal" data-bs-target="#add" id="<?php print $row["ZoneRegionCode"]; ?>" data-bs-orderid="<?php echo $row["OrderID"]; ?>" data-bs-zonecode="<?php echo $row["ZoneRegionCode"]; ?>"><?php echo $row["OrderID"]; ?></a></td>
            <td><input class="form-check-input checkb" name="select" type="checkbox" value="<?php echo $row["OrderID"]; ?>"></td>   

          </tr>
        <?php } ?>
      </tbody>
    </table>
    <center>
      <button class="btn-primary S" id="button">Submit</button>
    </center>
    <br><br>
  </div>


  <script type="text/javascript">
    $(document).ready(function() {
      $('table.display').DataTable( {
        responsive: true,
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal( {
              header: function ( row ) {
                var data = row.data();
                return 'Details for '+data[0]+' '+data[1];
              }
            } ),
            renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
              tableClass: 'table'
            } )
          }
        },
        stateSave: true,
      } );
    } );




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
      console.log($('#ItemID').val());
      const obj = JSON.parse($('#ItemID').val());
      
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

/*
    $('.checkb').on('change', function() {
      if($('input[name=select]').is(':checked'))
      {
        console.log('checked');
        show_hide_column(1, false);
      }else
      {
        console.log('unchecked');
        show_hide_column(1, true);
      }
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
          url:'test.php',
          data:{OrderID:Data, RateID: JSON.stringify(rateid), ItemID: JSON.stringify(ItemID), Qty: JSON.stringify(qty)},
          success:function(result){
            $('#viewResult').html(result);

          }
        }); 
      }
    });

  </script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>
  <script src="ajax.js"></script>

  <script type="text/javascript">
    var exampleModal = document.getElementById('add')
    exampleModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget
      var ID = button.getAttribute('data-bs-orderid')
      var ZoneCode=button.getAttribute('data-bs-zonecode')
      //console.log(recipient);
      document.getElementById("orderid").value = ID;
      document.getElementById("ZoneCode").value = ZoneCode;
    })


    $(document).on('click', '.S', function(){

      var delayInMilliseconds = 1000; 

      setTimeout(function() {
        location.reload();
      }, delayInMilliseconds);


    });

    function limit(element)
    {
      var max_chars = 5;

      if(element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
      }
    }



    function show_hide_column(col_no, do_show) {
      var rows = document.getElementById('materialP').rows;

      for (var row = 0; row < rows.length; row++) {
        var cols = rows[row].cells;
        if (col_no >= 0 && col_no < cols.length) {
          cols[col_no].style.display = do_show ? '' : 'none';
        }
      }
    }

  </script>
</body>
</html>
<?php 
$con->close();
//$con2->close();
?>
