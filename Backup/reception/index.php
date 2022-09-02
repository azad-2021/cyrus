<?php 
include 'connection.php';
include 'session.php';
$Type=$_SESSION['usertype'];
$EXEID=$_SESSION['userid'];


date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$exdate=date('Y-m-d', strtotime($Date. ' + 2 days'));
$exdate2=date('Y-m-d', strtotime($Date. ' + 7 days'));

$Hour = date('G');
//echo $_SESSION['user'];

$user=$_SESSION['user'];

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
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            <div class="row g-3">
              <div class="col-md-12">
                <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
                <form class="needs-validation form-control novalidate rounded-corner" method="POST" style="margin-bottom: 5px;">
                  <div class="row g-3">

                    <div class="col-sm-4">
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
                    <div class="col-sm-4">
                      <select id="Zone" class="form-control rounded-corner" name="Zone" required>
                        <option value="">Zone</option>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <select id="Branch" class="form-control rounded-corner" name="Branch" required>
                        <option value="">Branch</option>
                      </select>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-8">
                <div class="col-lg-12" style="margin: 12px; overflow: auto;">
                  <table class="scrolldown table table-hover table-bordered border-primary table-responsive" id="resizeMe"> 
                    <h5 style="margin: 2px; text-align: center;">Orders</h5>
                    <thead> 
                      <tr> 
                        <th style="min-width: 150px;">Order ID</th>
                        <th style="min-width: 150px;">Information Date</th>
                        <th style="min-width: 500px;">Discription</th>
                        <th style="min-width: 150px;">Attended</th>
                        <th style="min-width: 150px;">Visit Date</th>
                        <th style="min-width: 500px;">Executive Remark</th>                          
                        <th style="min-width: 150px;">Gadget</th>                        
                        <th style="min-width: 150px;">Assign Date</th>                            
                        <th style="min-width: 150px;">Call Verified</th>   
                        <th style="min-width: 150px;">Employee</th>          
                      </tr>                     
                    </thead>                 
                    <tbody id="Order"> 
                    </tbody>
                  </table>
                </div>
                <div class="col-lg-12" style="margin: 12px; overflow: auto;">
                  <table class=" scrolldown table table-hover table-bordered border-primary"> 
                    <h5 style="margin: 5px; text-align: center;">Complaints</h5>
                    <thead> 
                      <tr> 
                        <th style="min-width: 150px;">Complaint ID</th>
                        <th style="min-width: 150px;">Information Date</th>
                        <th style="min-width: 500px;">Discription</th>
                        <th style="min-width: 150px;">Attended</th>
                        <th style="min-width: 150px;">Date of Visit</th>
                        <th style="min-width: 500px;">Executive Remark</th> 
                        <th style="min-width: 150px;">Gadget</th>            
                        <th style="min-width: 150px;">Assign Date</th>
                        <th style="min-width: 150px;">Call Verified</th>             
                        <th style="min-width: 150px;">Employee</th>            
                      </tr>                     
                    </thead>                 
                    <tbody id="Complaints" > 

                    </tbody>
                  </table> 
                </div>
                <div class="col-lg-12" style="margin: 12px; overflow: auto;">
                  <table class="display table table-hover table-bordered border-primary scrolldown" id="resizeMe3">
                    <h5 style="margin: 2px; text-align: center;">Jobcard</h5>
                    <thead> 
                      <tr> 
                        <th style="min-width: 150px;">Card No</th>
                        <th style="min-width: 170px;">Jobcard Number</th>
                        <th style="min-width: 800px;">Service Done</th>
                        <th style="min-width: 800px;">Pending Work</th>
                        <th style="min-width: 150px;">Date of Visit</th>
                        <th style="min-width: 150px;">Gadget</th>
                        <th style="min-width: 150px;">Employee</th>   
                      </tr>                     
                    </thead>                 
                    <tbody id="jobcard"> 

                    </tbody>
                  </table>   
                </div>
              </div>
              <div class="col-lg-4" >

                <div class="col-lg-12" style="margin: 12px; overflow: auto;">
                  <table class="scrolldown table table-hover table-bordered border-primary table-responsive" id="resizeMe"> 
                    <h5 style="margin: 2px; text-align: center;">AMC</h5>
                    <thead> 
                      <tr> 
                        <th style="min-width: 150px;">Device</th>
                        <th style="min-width: 150px;">Start Date</th>
                        <th style="min-width: 150px;">End date</th>
                        <th style="min-width: 150px;">Visits</th> 
                        <th style="min-width: 150px;">Rates</th>        
                      </tr>                     
                    </thead>                 
                    <tbody id="AMCVisit"> 
                    </tbody>
                  </table>
                </div>

                <h4 align="center" style="margin-bottom: 20px">Branch Details</h4>
                <div class="row lg-12" id="BranchData">
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- End Recent Sales -->
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
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="ajax-script.js"></script>

<script type="text/javascript">
 // Example starter JavaScript for disabling form submissions if there are invalid fields
 (function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
  .forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()

var exampleModal = document.getElementById('DiscriptionUpdate')
exampleModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget

  var recipient = button.getAttribute('data-bs-discription')
  var ID = button.getAttribute('data-bs-OrderID')
  var BranchCode = button.getAttribute('data-bs-BranchCode')

  var modalTitle = exampleModal.querySelector('.modal-title')
  var modalBodyInput = exampleModal.querySelector('.Discription input')
  var idInput = exampleModal.querySelector('.OrderID input')
  var brcInput = exampleModal.querySelector('.BranchCode input')

  modalTitle.textContent = 'Update Discription: '
  modalBodyInput.value = recipient
  idInput.value = ID
  brcInput.value = BranchCode
})


var exampleModal5 = document.getElementById('gadgetUpdate')
exampleModal5.addEventListener('show.bs.modal', function (event) {
  var button5 = event.relatedTarget
  var ID5 = button5.getAttribute('data-bs-OrderID5')
  console.log(gadget);
  var BranchCode5 = button5.getAttribute('data-bs-BranchCode5')
  var modalTitle5 = exampleModal5.querySelector('.modal-title5')
  var idInput5 = exampleModal5.querySelector('.OrderID5 input')
  var brcInput5 = exampleModal5.querySelector('.BranchCode5 input')

  modalTitle5.textContent = 'Update Gadget: '
  idInput5.value = ID5
  brcInput5.value = BranchCode5
})

var exampleModalC5 = document.getElementById('gadgetUpdateC')
exampleModalC5.addEventListener('show.bs.modal', function (event) {
  var buttonC5 = event.relatedTarget
  var IDC5 = buttonC5.getAttribute('data-bs-ComplaintID5')
  var BranchCodeC5 = buttonC5.getAttribute('data-bs-BranchCodeC5')
  var modalTitleC5 = exampleModalC5.querySelector('.modal-titleC5')
  var idInputC5 = exampleModalC5.querySelector('.ComplaintID5 input')
  var brcInputC5 = exampleModalC5.querySelector('.BranchCodeC5 input')

  modalTitleC5.textContent = 'Update Gadget: '
  idInputC5.value = IDC5
  brcInputC5.value = BranchCodeC5
})


var exampleModal2 = document.getElementById('InfoDateUpdate')
exampleModal2.addEventListener('show.bs.modal', function (event) {
  var button2 = event.relatedTarget
  var recipient2 = button2.getAttribute('data-bs-info')
  var ID2 = button2.getAttribute('data-bs-OrderID2')
  var BranchCode2 = button2.getAttribute('data-bs-BranchCode2')

  var modalTitle2 = exampleModal2.querySelector('.modal-title2')
  var modalBodyInput2 = exampleModal2.querySelector('.Info input')
  var idInput2 = exampleModal2.querySelector('.OrderID2 input')
  var brcInput2 = exampleModal2.querySelector('.BranchCode2 input')

  modalTitle2.textContent = 'Update Information Date '
  modalBodyInput2.value = recipient2
  idInput2.value = ID2
  brcInput2.value = BranchCode2
})


var exampleModal3 = document.getElementById('ReceivedByUpdate')
exampleModal3.addEventListener('show.bs.modal', function (event) {
  var button3 = event.relatedTarget
  var recipient3 = button3.getAttribute('data-bs-received')
  var ID3 = button3.getAttribute('data-bs-OrderID3')
  var BranchCode3 = button3.getAttribute('data-bs-BranchCode3')
  var modalTitle3 = exampleModal3.querySelector('.modal-title3')
  var modalBodyInput3 = exampleModal3.querySelector('.received input')
  var idInput3 = exampleModal3.querySelector('.OrderID3 input')
  var brcInput3 = exampleModal3.querySelector('.BranchCode3 input')

  modalTitle3.textContent = 'Update Received By '
  modalBodyInput3.value = recipient3
  idInput3.value = ID3
  brcInput3.value = BranchCode3
})

var exampleModal4 = document.getElementById('OrderByUpdate')
exampleModal4.addEventListener('show.bs.modal', function (event) {
  var button4 = event.relatedTarget
  var recipient4 = button4.getAttribute('data-bs-orderby')
  var ID4 = button4.getAttribute('data-bs-odid')
  var BranchCode4 = button4.getAttribute('data-bs-Brcd')
  var modalTitle4 = exampleModal4.querySelector('.modal-title4')
  var modalBodyInput4 = exampleModal4.querySelector('.orderby input')
  var idInput4 = exampleModal4.querySelector('.odid input')
  var brcInput4 = exampleModal4.querySelector('.Brcd input')

  modalTitle4.textContent = 'Update Order By '
  modalBodyInput4.value = recipient4
  idInput4.value = ID4
  brcInput4.value = BranchCode4
})




//complaints

var exampleModalC = document.getElementById('DiscriptionUpdateC')
exampleModalC.addEventListener('show.bs.modal', function (event) {
  var buttonC = event.relatedTarget
  var recipientC = buttonC.getAttribute('data-bs-discriptionC')
  var IDC = buttonC.getAttribute('data-bs-ComplaintID')
  var BranchCodeC = buttonC.getAttribute('data-bs-BranchCodeC')
  var modalTitleC = exampleModalC.querySelector('.modal-titleC')
  var modalBodyInputC = exampleModalC.querySelector('.DiscriptionC input')
  var idInputC = exampleModalC.querySelector('.ComplaintID input')
  var brcInputC = exampleModalC.querySelector('.BranchCodeC input')

  modalTitleC.textContent = 'Update Complaint Discription: '
  modalBodyInputC.value = recipientC
  idInputC.value = IDC
  brcInputC.value = BranchCodeC
})


var exampleModalC2 = document.getElementById('InfoDateUpdateC')
exampleModalC2.addEventListener('show.bs.modal', function (event) {
  var buttonC2 = event.relatedTarget
  var recipientC2 = buttonC2.getAttribute('data-bs-InfoC')
  var IDC2 = buttonC2.getAttribute('data-bs-ComplaintID2')
  var BranchCodeC2 = buttonC2.getAttribute('data-bs-BranchCodeC2')
  var modalTitleC2 = exampleModalC2.querySelector('.modal-titleC2')
  var modalBodyInputC2 = exampleModalC2.querySelector('.InfoC input')
  var idInputC2 = exampleModalC2.querySelector('.ComplaintID2 input')
  var brcInputC2 = exampleModalC2.querySelector('.BranchCodeC2 input')

  modalTitleC2.textContent = 'Update Information Date of Complaint: '
  modalBodyInputC2.value = recipientC2
  idInputC2.value = IDC2
  brcInputC2.value = BranchCodeC2
})


var exampleModalC3 = document.getElementById('ReceivedByUpdateC')
exampleModalC3.addEventListener('show.bs.modal', function (event) {
  var buttonC3 = event.relatedTarget
  var recipientC3 = buttonC3.getAttribute('data-bs-receivedC')
  var IDC3 = buttonC3.getAttribute('data-bs-ComplaintID3')
  var BranchCodeC3 = buttonC3.getAttribute('data-bs-BranchCodeC3')
  var modalTitleC3 = exampleModalC3.querySelector('.modal-titleC3')
  var modalBodyInputC3 = exampleModalC3.querySelector('.receivedC input')
  var idInputC3 = exampleModalC3.querySelector('.ComplaintID3 input')
  var brcInputC3 = exampleModalC3.querySelector('.BranchCodeC3 input')

  modalTitleC3.textContent = 'Update Received By Complaints'
  modalBodyInputC3.value = recipientC3
  idInputC3.value = IDC3
  brcInputC3.value = BranchCodeC3
})


var exampleModalC4 = document.getElementById('MadeByUpdateC')
exampleModalC4.addEventListener('show.bs.modal', function (event) {
  var buttonC4 = event.relatedTarget
  var recipientC4 = buttonC4.getAttribute('data-bs-madebyC')
  var IDC4 = buttonC4.getAttribute('data-bs-ComplaintID4')
  var BranchCodeC4 = buttonC4.getAttribute('data-bs-BranchCodeC4')
  var modalTitleC4 = exampleModalC4.querySelector('.modal-titleC4')
  var modalBodyInputC4 = exampleModalC4.querySelector('.madebyC input')
  var idInputC4 = exampleModalC4.querySelector('.ComplaintID4 input')
  var brcInputC4 = exampleModalC4.querySelector('.BranchCodeC4 input')

  modalTitleC4.textContent = 'Update Made By '
  modalBodyInputC4.value = recipientC4
  idInputC4.value = IDC4
  brcInputC4.value = BranchCodeC4
})

function printDiv(divName) {
 var printContents = document.getElementById(divName).innerHTML;
 var originalContents = document.body.innerHTML;

 document.body.innerHTML = printContents;

 window.print();

 document.body.innerHTML = originalContents;
}




var exampleModalPhone = document.getElementById('PhoneUpdate')
exampleModalPhone.addEventListener('show.bs.modal', function (event) {
  var buttonp = event.relatedTarget
  var recipientp = buttonp.getAttribute('data-bs-phone')
  console.log(recipientp);
  var modalTitlep = exampleModalPhone.querySelector('.modal-title')
  var modalBodyInputp = exampleModalPhone.querySelector('.modal-body-phone input')

  modalTitlep.textContent = 'Upadte Phone Number '
  modalBodyInputp.value = recipientp
})


var exampleModalMobile = document.getElementById('MobileUpdate')
exampleModalMobile.addEventListener('show.bs.modal', function (event) {
  var buttonp = event.relatedTarget
  var recipientp = buttonp.getAttribute('data-bs-mobile')
  console.log(recipientp);
  var modalTitlep = exampleModalMobile.querySelector('.modal-titleM')
  var modalBodyInputp = exampleModalMobile.querySelector('.modal-body-mobile input')

  modalTitlep.textContent = 'Update Mobile Number '
  modalBodyInputp.value = recipientp
})


var exampleModalEmail = document.getElementById('EmailUpdate')
exampleModalEmail.addEventListener('show.bs.modal', function (event) {
  var buttonp = event.relatedTarget
  var recipientp = buttonp.getAttribute('data-bs-email')
  var modalTitlep = exampleModalEmail.querySelector('.modal-titleE')
  var modalBodyInputp = exampleModalEmail.querySelector('.modal-body-email input')
  modalTitlep.textContent = 'Update Email '
  modalBodyInputp.value = recipientp
})


$(document).on('change','#Type', function(){
  var Type = $(this).val();
  console.log(Type);
  if(Type=='Complaint'){
    document.getElementById("ExpectedAdd").value = "<?php echo $exdate; ?>";
  }else{
    document.getElementById("ExpectedAdd").value = "<?php echo $exdate2; ?>";
  }

  if (Type=='AMC') {
   document.getElementById("ReceivedBy").value = "Auto";
   document.getElementById("MadeBy").value = "System";
 }else{
  document.getElementById("ReceivedBy").value = "";
  document.getElementById("MadeBy").value = "";
}
});

/*
$(document).on('click','#Branch', function(){

  var BranchCode = $(this).val();
  if(BranchCode){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'BranchCodeD':BranchCode},
      success:function(result){
        var r = (result);

      }
    }); 
  }

});
*/
</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>