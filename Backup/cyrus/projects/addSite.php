<?php 
include 'connection.php';
include 'session.php';
$Type=$_SESSION['usertype'];
if (isset($_GET['user'])) {
  $EXEID=$_GET['user'];
  $_SESSION['query']=$EXEID;
}if (isset($_SESSION['query'])) {
  $EXEID=$_SESSION['query'];
}else{
  $EXEID=$_SESSION['userid'];
}
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));
$NintyDays = date('Y-m-d', strtotime($Date. ' - 90 days'));

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
  <?php include"header.php" ?>
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
          <li class="breadcrumb-item active">Add Division</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">

          <div class="card info-card sales-card">
            <div class="card-body">


              <div class="col-12">
                <div class="card recent-sales overflow-auto">
                  <div class="card-body">


                    <form class="form-control" novalidate id="form" name="form" style="margin:20px;" align="center">
                      <div class="row">

                        <div class="col-lg-4">
                          <label for="validationCustom01" class="form-label ">Organization</label>
                          <select class="form-control rounded-corner" id="Organization">
                            <option>Select</option>
                            <?php
                            $query="SELECT * from projects.organization order by OrganizationName";
                            $result=mysqli_query($con,$query);
                            if (mysqli_num_rows($result)>0)
                            {
                              while ($arr=mysqli_fetch_assoc($result))
                              {
                                ?>
                                <option value="<?php echo $arr['OrganizationCode']; ?>"><?php echo $arr['OrganizationName']; ?></option>
                                <?php
                              }
                            }
                            ?>
                          </select>

                        </div>

                        <div class="col-lg-4">
                          <label for="validationCustom01" class="form-label ">Division</label>
                          <select class="form-control rounded-corner" id="Division">
                            <option>Select</option>
                          </select>
                        </div>

                        <div class="col-lg-4">
                          <label for="validationCustom01" class="form-label ">Enter Site Name</label>
                          <input type="text" min=0 class="form-control rounded-corner" id="SiteName" name="SiteName">
                        </div>

                      </div>
                    </form>
                  </div>
                  <h4 align="center">Enter Material Details</h4>
                  <form class="row g-3 needs-validation field" novalidate id="form" name="form" align="center">
                  </form>
                  <div ><button style="float: right; margin: 20px;" class="btn btn-primary add_button" onclick="javascript:void(0);">New material</button></div>

                  
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered border-primary">
                      <thead>
                        <tr>
                          <th>Material Name</th>
                          <th>Rate</th>
                          <th>Quantity</th>
                          <th>Select Item</th>
                          </tr>
                        </thead>
                        <tbody id="MaterialData">

                        </tbody>
                      </table>
                    </div>
                    <center><button style="margin: 20px;" class="btn btn-primary SaveSite">Save</button></center>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Left side columns -->

      </section>
    </main>

    <!-- End #main -->

    <?php include"footer.php"; ?>

    <script type="text/javascript">

      $(document).on('change','#Organization', function(){
        var OrganizationCode = $(this).val();
        if(OrganizationCode){
          $.ajax({
            type:'POST',
            url:'dataget.php',
            data:{'Organization':OrganizationCode},
            success:function(result){
              $('#Division').html(result);

            }
          }); 
        }else{
          $('#Division').html('<option value="">No Division</option>'); 
        }
      });


      $("#SelectAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
      });

/*
    $(document).on('keyup','#MaterialName', function(){
      var DivisionCode = document.getElementById("Division").value;
      var MaterialName = document.getElementById("MaterialName").value;
      console.log(DivisionCode);
      if(DivisionCode  && MaterialName){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'DivisionCodeM':DivisionCode, 'MaterialNameS':MaterialName},
          success:function(result){
             document.getElementById("suggestion").innerHTML = (result);

          }
        }); 
      }else{
         document.getElementById("suggestion").innerHTML = 'aa'; 
      }
    });

    $(document).on('keydown','#MaterialName', function(){
      var DivisionCode = document.getElementById("Division").value;
      var MaterialName = document.getElementById("MaterialName").value;
      console.log(DivisionCode);
      if(DivisionCode  && MaterialName){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'DivisionCodeM':DivisionCode, 'MaterialNameS':MaterialName},
          success:function(result){
             document.getElementById("suggestion").innerHTML = (result);

          }
        }); 
      }else{
         document.getElementById("suggestion").innerHTML = 'aa'; 
      }
    });

    $(document).on('onclick','#suggestion', function(){
      var suggestion = document.getElementById("suggestion").value;
     document.getElementById("MaterialName").value=suggestion;

    });
    */


    $(document).on('change','#Division', function(){
      var DivisionCode = $(this).val();
      if(DivisionCode){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'DivisionCodeM':DivisionCode},
          success:function(result){
            $('#MaterialData').html(result);

          }
        }); 
      }
    });



    $(document).ready(function(){
      var id=2;
      var x=0;
      var maxField = 1000; 
      var addButton = $('.add_button'); 
      var wrapper = $('.field'); 

      var inb='<div class="col-lg-5" id="f1'+id+'"><label for="recipient-name" class="col-form-label">Material Name</label><input type="text" class="form-control rounded-corner" id="B'+id+'" name="NameArray[]"></div>';

      var inb2='<div class="col-lg-3" id="f2'+id+'"><label for="recipient-name" class="col-form-label">Rate</label><input type="number" min=0 class="form-control rounded-corner" id="C'+id+'" name="RateArray[]"></div>';

      var inb3='<div class="col-lg-2" id="f4'+id+'"><label for="recipient-name" class="col-form-label">Quantity</label><input type="number" min=0 class="form-control rounded-corner" id="D'+id+'" name="QtyArray[]"></div>';

      var fieldHTML = inb + inb2 + inb3 + '<div class="col-lg-2" style="margin-top:55px;" id="f3'+id+'"><button class="btn btn-danger remove_button" onclick="javascript:void(0);" id="'+id+'"> Remove</button></div>';

      $(addButton).click(function(){

       if(x < maxField){ 
        x++;
        $(wrapper).append(fieldHTML); 
        id++;
      }


    });


      $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        var idf=$(this).attr("id");
        console.log(idf);
        $('#'+'f1'+idf).remove();
        $('#'+'f2'+idf).remove();
        $('#'+'f3'+idf).remove();
        $('#'+'f4'+idf).remove();
        id--;
      });
    });

    $(document).on('click','.SaveSite', function(){
      var Material=[];
      var Rate=[];
      var RateID=[];
      var QtyNew=[];
      var Qty=[];

      var DivisionCode=document.getElementById("Division").value;
      var SiteName=document.getElementById("SiteName").value;
      var input = document.getElementsByName('NameArray[]');
      var input2 = document.getElementsByName('RateArray[]');
      var input3 = document.getElementsByName('QtyArray[]');
      var input4 = document.getElementsByName('Qty[]');
      $("input:checkbox[name=select]:checked").each(function() {
        RateID.push($(this).val());
      });

      if (DivisionCode && SiteName && input4) {
        var err=0;

        if (input) {
          for (var i = 0; i < input.length; i++) {

            var a = input[i];
            var b = input2[i];
            var c = input3[i];
            if (a.value!='' && b.value!='' && c.value!='') {
              Material.push(a.value);
              Rate.push(b.value);            
              QtyNew.push(c.value);    
            }else{
              swal("error","Please enter all fields","error");
              err=1;
              break;
            }
          }
        }
        for (var i = 0; i < input4.length; i++) {

          var d = input4[i];

          if (d.value!='') {
            Qty.push(d.value);  
          }
        }
        console.log(Material);
        console.log(Rate);
        console.log(DivisionCode);
        console.log(RateID);
        console.log(QtyNew);
        console.log(Qty);
        if (err==0 && Qty.length>0) {

          if (RateID.length>0) {


            if (Material.length>0 && Rate.length>0) {
             var Data = {'DivisionCode':DivisionCode, 'SiteName':SiteName, 'Material':Material, 'NewRate':Rate, 'NewQty':QtyNew, 'SiteRateID':RateID, 'SiteQty':Qty}
           }else if(Material.length==0 && RateID.length>0){
            var Data = {'DivisionCode':DivisionCode, 'SiteName':SiteName, 'SiteRateID':RateID, 'SiteQty':Qty}
          }

          console.log(Data);

          $.ajax({
            type:'POST',
            url:'dataget.php',
            data:Data,
            success:function(result){

              if ((result)==1) {
                swal("success","Site Created","success");
                var delayInMilliseconds = 2000; 

                setTimeout(function() {
                  location.reload();
                }, delayInMilliseconds);


              }else{
                swal("error",(result),"error");
              }


            }
          });
          
        }else{

          swal("error","Please select items","error");
        }
      }else if(Qty.length==0){
        swal("error","Please enter quantity","error");
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