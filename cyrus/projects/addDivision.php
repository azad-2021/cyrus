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
                          <select class="form-control rounded-corner" id="OrganizationCode">
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
                          <input type="text" class="form-control rounded-corner" id="DivisionAdd" name="Division">
                        </div>

                        <div class="col-lg-4">
                          <label for="validationCustom01" class="form-label ">LOA Date</label>
                          <input type="date" class="form-control rounded-corner" id="LOADateAdd" name="InfoDate">
                        </div>
                        <div class="col-lg-4">
                          <label for="validationCustom01"  class="form-label ">Completion Date</label>
                          <input type="date" class="form-control rounded-corner" id="ComplitionDate" name="ExpDate" required>
                        </div>


                        <div class="col-lg-4">
                          <label for="validationCustom01" class="form-label ">BG Amount</label>
                          <input type="number" min=0 class="form-control rounded-corner" id="BGAmount" name="BGAmount">
                        </div>
                        <div class="col-lg-4">
                          <label for="validationCustom01"  class="form-label ">BG Date</label>
                          <input type="date" class="form-control rounded-corner" id="BGDate" name="BGDate" required>
                        </div>
                        <div class="col-lg-3">
                          <label for="validationCustomUsername" class="form-label">Warranty in months</label>
                          <input type="number" min=0 class="form-control rounded-corner" name="warranty" id="WarrantyAdd">
                        </div>

                        <div class="col-lg-9">
                          <label for="validationCustomUsername" class="form-label">Description</label>
                          <textarea class="form-control rounded-corner" id="DescriptionAdd" name="Description" required></textarea> 
                        </div>

                      </div>
                    </form>
                  </div>
                  <h4 align="center">Enter Material Details</h4>
                  <form class="row g-3 needs-validation field" novalidate id="form" name="form">

                    <div class="col-lg-8">
                      <label for="validationCustom01" class="form-label ">Material Name</label>
                      <input type="text" class="form-control rounded-corner" id="MaterialName" name="NameArray[]">
                    </div>

                    <div class="col-lg-4">
                      <label for="validationCustom01" class="form-label ">Rate</label>
                      <input type="number" min=0 class="form-control rounded-corner" id="MaterialRate" name="RateArray[]">
                    </div>
                  </form>
                  <div ><button style="float: right; margin: 20px;" class="btn btn-primary add_button" onclick="javascript:void(0);">More material</button></div>

                  <center><button style="margin: 20px;" class="btn btn-primary SaveDivision">Save</button></center>
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

    $("#SelectAll").change(function () {
      $("input:checkbox").prop('checked', $(this).prop("checked"));
    });


    $(document).ready(function(){
      var id=2;
      var x=0;
      var maxField = 1000; 
      var addButton = $('.add_button'); 
      var wrapper = $('.field'); 

      var inb='<div class="col-lg-6" id="f1'+id+'"><label for="recipient-name" class="col-form-label">Material Name</label><input type="text" class="form-control rounded-corner" id="B'+id+'" name="NameArray[]"></div>';

      var inb2='<div class="col-lg-4" id="f2'+id+'"><label for="recipient-name" class="col-form-label">Rate</label><input type="number" min=0 class="form-control rounded-corner" id="C'+id+'" name="RateArray[]"></div>';

      var fieldHTML = inb + inb2 + '<div class="col-lg-2" style="margin-top:55px;" id="f3'+id+'"><button class="btn btn-danger remove_button" onclick="javascript:void(0);" id="'+id+'"> Remove</button></div>';

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
        id--;
      });
    });

    $(document).on('click','.SaveDivision', function(){
      var Material=[];
      var Rate=[];
      var OrganizationCode=document.getElementById("OrganizationCode").value;
      var BGAmount=document.getElementById("BGAmount").value;
      var BGDate=document.getElementById("BGDate").value;
      var LOADateAdd=document.getElementById("LOADateAdd").value;
      var ComplitionDate=document.getElementById("ComplitionDate").value;
      var Division=document.getElementById("DivisionAdd").value;
      var Description=document.getElementById("DescriptionAdd").value;

      var input = document.getElementsByName('NameArray[]');
      var input2 = document.getElementsByName('RateArray[]');
      if (Division && OrganizationCode && BGDate && BGAmount && LOADateAdd && ComplitionDate && Description) {
        var err=0;
        for (var i = 0; i < input.length; i++) {

          var a = input[i];
          var b = input2[i];
          if (a.value!='' && b.value!='') {
            Material.push(a.value);
            Rate.push(b.value);            

          }else{
            swal("error","Please enter all fields","error");
            err=1;
            break;
          }
        }

        if (err==0) {
          console.log(Material);
          console.log(Rate);
          console.log(Division);
          console.log(OrganizationCode);
          //swal("success","Division Created","success");

          
          $.ajax({
            type:'POST',
            url:'dataget.php',
            data:{'DivisionName':Division, 'OrganizationCode':OrganizationCode, 'BGDate':BGDate, 'BGAmount':BGAmount, 'LOADate':LOADateAdd, 'ComplitionDate':ComplitionDate, 'DivRate':Rate, 'DivMaterial':Material, 'Description':Description},
            success:function(result){

              if ((result)==1) {
                swal("success","Division Created","success");

                var delayInMilliseconds = 2000; 

                setTimeout(function() {
                  location.reload();
                }, delayInMilliseconds);


              }else{
                swal("error",(result),"error");
              }


            }
          });
        }


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