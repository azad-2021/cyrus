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

	<title>Update GST</title>
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

		?>

	</header><!-- End Header -->
	<?php 
	include "sidebar.php";
	
	?>
	<main id="main" class="main">

		<div class="pagetitle">
			<h1>Dashboard</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active">Update GST</li>
				</ol>
			</nav>
		</div><!-- End Page Title -->

		<section class="section dashboard">
			<div class="row">

				<div class="row g-3">
					<div class="col-md-12">
						<!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
						<form class="needs-validation" method="POST" style="margin-bottom: 5px;">
							<div class="row g-3">

								<div class="col-sm-4">
									<select id="BankM" class="form-control rounded-corner" name="Bank" required>
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
									<select id="ZoneM" class="form-control rounded-corner" name="Zone" required>
										<option value="">Zone</option>
									</select>
								</div>
								<div class="col-sm-4">
									<input type="text" id="GST" class="form-control rounded-corner" name="" placeholder="Enter GST Number">
								</div>
							</div>
						</form>
					</div>
				</div>
				<br><br>
				<!--<div id="viewResult"></div>-->

				<table class="table table-hover table-bordered border-primary display">
					<thead>
						<tr>
							<th>Branch</th>
							<th>Branch Code</th>
							<th>GST Number</th>
						</tr>
					</thead>
					<tbody id="viewResult">

					</tbody>
				</table>

				<table class="table table-hover table-bordered border-primary display" id="branchdata">
					<thead>
						<tr>
							<th>Branch</th>
							<th>Branch Code</th>
							<th>District</th>
							<th>GST No</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="Branchlist">

					</tbody>
				</table>
				<center>
					<button class="btn btn-primary S" id="button">Submit</button>
				</center>
			</div>
			<br>
		</div>
		<div class="col-lg-12">

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



	$(document).on('change','#BankM', function(){
		var BankCodeM = $(this).val();
		if(BankCodeM){
			$.ajax({
				type:'POST',
				url:'dataget.php',
				data:{'Bank':BankCodeM},
				success:function(result){
					$('#ZoneM').html(result);

				}
			}); 
		}else{
			$('#ZoneM').html('<option value="">Zone</option>');
		}
	});




	$(document).on('change','#ZoneM', function(){
		var ZoneCodeM = $(this).val();
		var BankCodeM=document.getElementById("BankM").value;
		console.log(ZoneCodeM);
		console.log(BankCodeM);
		if(ZoneCodeM){
			$.ajax({
				type:'POST',
				url:'multiordersdata.php',
				data:{'ZoneCodeGST':ZoneCodeM, 'BankCodeGST':BankCodeM},
				success:function(result){
					$('#Branchlist').html(result);
					$('#addmultiorders').modal('show');

				}
			});

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



	$('#button').on('click', function() {
		var GST = document.getElementById("GST").value;
		var BranchCode = [];
		$("input:checkbox[name=select]:checked").each(function() {
			BranchCode.push($(this).val());
		});
		console.log(BranchCode);
		var flag=0;
		if (BranchCode[0]>0) {
			flag=1;
		}			
		if (flag==0) {
			swal("error","Please Select Branch","error");
		} else if(GST == ''){
			swal("error","Please enter GST","error");
		}else{

			$.ajax({
				type:'POST',
				url:'addmultiorders.php',
				data:{'BranchCodeGST':BranchCode, 'GST':GST},
				success:function(result){
					$('#viewResult').html(result);

				}
			}); 

			var element = document.getElementById("branchdata");
			element.classList.add("d-none");
			var element = document.getElementById("button");
			element.classList.add("d-none");
		}
	});


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

</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>