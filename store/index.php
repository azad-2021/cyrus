<?php 
include 'connection.php';
include 'session.php';

$EXEID=$_SESSION['userid'];
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$Hour = date('G');
//echo $_SESSION['user'];


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

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="assets/js/sweetalert.min.js"></script>


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/cyrus logo.png" alt="">
        <span class="d-none d-lg-block">Cyrus</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <?php echo $wish; ?>
    </div>
    <?php 
    include "nav.php";
    //include "modals.php";
    ?>

  </header><!-- End Header -->
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
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <!-- Recent Sales -->
      <div class="col-12">
        <div class="card recent-sales overflow-auto">

          <div class="card-body">
            <h5 class="card-title">Create  <span>| Challan</span></h5>

            <form class="form-control rounded-corner" method="POST" style="margin-bottom: 5px;" id="f1">
              <div class="row g-3">

                <div class="col-sm-3">
                  <label>States</label>
                  <select id="states" class="form-control rounded-corner" required>
                    <option value="">Select</option>
                    <?php

                    $Data="Select * from states order by `State Name`";
                    $result=mysqli_query($con2,$Data);
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
                <div class="col-sm-3">
                  <label>Employee</label>
                  <select id="Employee" class="form-control rounded-corner" required>
                    <option value="">select</option>
                  </select>
                </div>
                <div class="col-sm-3">
                  <label>Release To</label>
                  <input type="text" class="form-control rounded-corner" id="ReleaseTo" Name="ReleaseTo" placeholder="Name" >
                </div>
                <div class="col-sm-2 d-none">
                  <label>State Code</label>
                  <input type="number" id="statecode" class="form-control rounded-corner" disabled>
                </div>
                <div class="col-sm-3">
                  <label>Enter Address</label>
                  <input type="text" class="form-control rounded-corner" id="address" Name="Address" placeholder="Address" >
                </div>
              </div>
            </div>
          </form>
          <center>
            <input type="text" class="form-control rounded-corner" onkeyup="myFunction()" id="SearchData" placeholder="search" style="max-width:300px">
          </center>
          <br>
          <div class="table-responsive container">

            <table class="table table-bordered border-primary display datatable"  id="ItemData">

              <thead>
                <tr>
                  <th style="min-width:80px">Sr. No.</th>
                  <th style="min-width:120px">Order ID</th>
                  <th style="min-width:300px">Description</th>
                  <th style="min-width:150px">Bar Code</th>
                  <th style="min-width:120px">Rate</th>
                  <th style="min-width:120px">Discount</th>
                  <th style="min-width:200px">Select Category</th>
                </tr>
              </thead>
              <tbody id="material">

              </tbody>
            </table>
          </div>
          <center>
            <button type="button" style="margin-top:25px" class="btn btn-primary save" >Submit</button>
          </center>
          <br>

          <div id="indata"></div>
          <!--<div id="inid2"></div>-->
        </div>

      </div>

    </div>
  </div><!-- End Recent Sales -->
</div>
</div><!-- End Left side columns -->

</div>
</section>
<div id="data"></div>
</main><!-- End #main -->

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
<script src="assets/js/main.js"></script>
<script src="assets/js/jquery-3.6.0.min.js"></script>

<script type="text/javascript">

  var barColors = ["#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff"];
  var hoverBackground='rgba(200, 200, 200, 1)';
  var hoverBorder='rgba(200, 200, 200, 1)';



  var hsncode = [];
  var gstrates = [];
  var rows=0;

  function myFunction() {
  // Declare variables
  var input, filter2, table, tr, td, i, txtValue;
  input = document.getElementById("SearchData");
  console.log(input);
  filter2 = input.value.toUpperCase();
  table = document.getElementById("ItemData");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter2) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}


function limit(element)
{
  var max_chars = 5;

  if(element.value.length > max_chars) {
    element.value = element.value.substr(0, max_chars);
  }
}

$(document).on('change','#states', function(){
  var StateCode = $(this).val();
  document.getElementById("statecode").value = StateCode;
  if(StateCode){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'StateCode':StateCode},
      success:function(result){
        $('#Employee').html(result);

      }
    }); 
  }else{
    $('#Employee').html('<option value="">Employee</option>');
  }
});


$(document).on('change','#Employee', function(){

 EmployeeCode= document.getElementById("Employee").value;

 if(EmployeeCode){
  $.ajax({
    type:'POST',
    url:'dataget.php',
    data:{'EmployeeID':EmployeeCode},
    success:function(result){
      $('#material').html(result);
      var element = document.getElementById("material");
      element.classList.remove("d-none");

    }
  }); 
}
});


$(document).on('change','#EmployeeCodeW', function(){
 document.getElementById("Sdate").value='';
});

$(document).on('change','#Sdate', function(){

 Sdate= document.getElementById("Sdate").value;
 EmployeeCode= document.getElementById("EmployeeCodeW").value;

 if(Sdate){
  $.ajax({
    type:'POST',
    url:'dataget.php',
    data:{'SDateCh':Sdate, 'EmployeeCodeCh':EmployeeCode},
    success:function(result){
     $('#ChallanView').html(result);
   }
 });

}
});


$(document).on('click','.Find', function(){

 var Challan= document.getElementById("ChallanF").value;
 if(Challan){
  window.open("challan.php?ChallanNo="+Challan, '_blank').focus();

}
});



$(document).on('click', '.save', function () {
  var Desc = [];
  var BarCode = [];
  var HSN=[];
  var GST=[];
  var rate=[];
  var amount=[];
  var Discount=[];
  var OrderID=[];
  var ExendedID=[];
  //var Qty =[];

  var i2=2000
  var i3=3000
  var i4=4000
  var i5=5000
  var i6=6000
  var i8=8000
  //var i9=900

  var rows=document.getElementById("count").value;
  console.log(rows);
  for (let i = 1; i <=rows; i++) {
    var EmployeeCode=document.getElementById("Employee").value;
    var StateCode=document.getElementById("states").value;
    var Address=document.getElementById("address").value;
    var ReleaseTo=document.getElementById("ReleaseTo").value;
    var orderid=document.getElementById(i6).value;
    var desc=document.getElementById(i).value;
    var barcode=document.getElementById(i2).value;
    var Rate=document.getElementById(i3).value;
    var data=document.getElementById(i4).value;
    var discount=document.getElementById(i5).value;
    var extended=document.getElementById(i8).value;
    //var qty=document.getElementById(i9).value;

    var error=0;

        //console.log(desc);
        //console.log(barcode);
        //console.log(Rate);
        console.log(data);
        //console.log(i2);
        //console.log(i3);
        //console.log(i4);
        
        
        if (data) {
          const obj = JSON.parse(data);
          hsn = obj.HSN;
          gst=obj.GST;
        }else{
          hsn=0;
          gst=0;
        }
        console.log(desc);
        Desc.push(desc);
        BarCode.push(barcode);
        HSN.push(hsn);
        GST.push(gst);
        rate.push(Rate);
        OrderID.push(orderid);
        ExendedID.push(extended);
          //Qty.push(qty);

          if (discount!='') {
            Discount.push(discount);
          }else{
            Discount.push(0);
          }

          i2++;
          i3++;
          i4++;
          i5++;
          i6++;
          i8++;
          //i9++;


        }

        for (let i = 1; i <=rows; i++) {
          //console.log(ItemID);
          const index = HSN.indexOf(0);
          if (index > -1) {
            HSN.splice(index, 1);
            GST.splice(index, 1);
            Desc.splice(index, 1);
            BarCode.splice(index, 1);
            rate.splice(index, 1);
            Discount.splice(index, 1);
            OrderID.splice(index, 1);
            ExendedID.splice(index, 1);

          }
        }


        console.log(Desc);
        console.log(BarCode);
        console.log(HSN);
        console.log(GST);
        console.log(rate);
        console.log(Discount);
        console.log(OrderID);
        console.log(ExendedID);

        if(EmployeeCode!='' && StateCode!='' && Address!='' && ReleaseTo!=''){
          $.ajax({
            type:'POST',
            url:'dataget.php',
            data:{'ItemID':Desc, 'BarCode2':BarCode, 'HSN2':HSN, 'GST2':GST, 'rate':rate, 'OrderID2':OrderID, 'EmployeeCode2':EmployeeCode, 'Statecode':StateCode, 'Discount':Discount, 'Type':'Employee', 'Address':Address, 'ExtendedID':ExendedID, 'ReleaseTo':ReleaseTo},
            success:function(results){
              $('#inid2').html(results);
              var res=(results);
              console.log(res);
              if (res>0) {
                swal("success","Material Confirmed","success");
                var element = document.getElementById("material");
                element.classList.add("d-none");
                document.getElementById("f1").reset();
                document.getElementById("address").value='';
                var delayInMilliseconds = 2000; 
                
                setTimeout(function() {
                  location.reload();
                }, delayInMilliseconds);

              }else{
                if (res.includes("exist")) {
                  alert(res);
                }else{
                  swal("error","Please enter all fields","error");
                }

              }
            }
          });

        }else{
          swal("error","Please enter all fields","error");
        }

      });

//All pages

$(document).on('click','.PrintChallan', function(){

 Challan =  $(this).attr("id");
 Type=$(this).attr("id2");
 window.open("challan.php?ChallanNo="+Challan+"&Type="+Type, '_blank').focus();

});


$(document).on('click','.CancelChallan', function(){

 Challan =  $(this).attr("id");
 Sdate= document.getElementById("Sdate").value;
 EmployeeCode= document.getElementById("EmployeeCodeW").value;
 console.log(EmployeeCode);
 console.log(Sdate);

 if(Challan){
  $.ajax({
    type:'POST',
    url:'dataget.php',
    data:{'ChallanCancel':Challan},
    success:function(result){
      //console.log((result));
      swal("success","Challan Cancelled","success");

      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'SDateCh':Sdate, 'EmployeeCodeCh':EmployeeCode},
        success:function(result){
          $('#ChallanView').html(result);

        }
      }); 

    }

  }); 

}




});


$(document).on('click','.ServiceCenter', function(){
  $.ajax({
    type:'POST',
    url:'dataget.php',
    data:{'ServiceCenter':'ServiceCenter'},
    success:function(result){
      $('#ServiceCenterData').html(result);

    }
  });

});


$(document).on('change','#RItemID', function(){
  var ItemID = $(this).val();
  if(ItemID){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'RItemID':ItemID},
      success:function(result){
        $('#RSerialNo').html(result);

      }
    }); 
  }else{
    $('#RSerialNo').html('<option value="">Select</option>');
  }
});
document.getElementById("NewSr").disabled = true;
var NewSr='NA';

$(document).on('change','#NewSerialNo', function(){

  if ($('#NewSerialNo').is(":checked")) {
    NewSr=$(this).val();
    

    if (NewSr=='New') {
     document.getElementById("NewSr").disabled = false;
   }
 }else{
  document.getElementById("NewSr").disabled = true;    
  NewSr='NA';
}
console.log(NewSr);
});


$(document).on('click','.SaveReturned', function(){
  var ItemID=document.getElementById("RItemID").value;
  var OldSrNo=document.getElementById("RSerialNo").value;
  var ReturnDate=document.getElementById("RDate").value;
  console.log(NewSr);
  if (NewSr=='New') {
    var NewSrNo=document.getElementById("NewSr").value;
  }else{
    NewSrNo='NA';
  }
  console.log(NewSrNo);

  if(ItemID!='' && OldSrNo!='' && ReturnDate!='' && ((NewSr=='NA' && NewSrNo=='NA') || (NewSr=='New' && NewSr!='NA'))){

    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'ReturnedItemID':ItemID, 'OldSrNo':OldSrNo, 'ReturnDate':ReturnDate, 'NewSrNo':NewSrNo},
      success:function(result){
        swal("success","Update Success","success");
        document.getElementById("Freturn").reset();
        var delayInMilliseconds = 2000; 

        setTimeout(function() {
          location.reload();
        }, delayInMilliseconds);
      }
    });
  }else{
    swal("error","Please enter all fields","error");
  }

});

function showResult(str) {
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      
    }
  }
  xmlhttp.open("GET","dataget.php?bar="+str,true);
  xmlhttp.send();
}


$(document).on('click','.SaveReturned', function(){
  var ExendedID=document.getElementById("RREmployeeCode").value;
  var ItemID=document.getElementById("RRItemID").value;
  var BarCode=document.getElementById("RRBarCode").value;
  var Address=document.getElementById("RRAddress").value;
  console.log(NewSr);
  if (NewSr=='New') {
    var NewSrNo=document.getElementById("NewSr").value;
  }else{
    NewSrNo='NA';
  }
  console.log(NewSrNo);

  if(ItemID!='' && OldSrNo!='' && ReturnDate!='' && ((NewSr=='NA' && NewSrNo=='NA') || (NewSr=='New' && NewSr!='NA'))){

    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'ReturnedItemID':ItemID, 'OldSrNo':OldSrNo, 'ReturnDate':ReturnDate, 'NewSrNo':NewSrNo},
      success:function(result){
        swal("success","Update Success","success");
        document.getElementById("Freturn").reset();
        var delayInMilliseconds = 2000; 

        setTimeout(function() {
          location.reload();
        }, delayInMilliseconds);
      }
    });
  }else{
    swal("error","Please enter all fields","error");
  }

});
</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>