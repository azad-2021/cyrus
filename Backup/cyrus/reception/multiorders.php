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
					<li class="breadcrumb-item active">Dashboard</li>
				</ol>
			</nav>
		</div><!-- End Page Title -->

		<section class="section dashboard">
			<div class="row">
				<div class="modal fade" id="addmultiorders" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content rounded-corner">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Add Order / Complaints/ AMC</h5>
							</div>
							<div class="modal-body">

								<form class="row g-3 needs-validation" novalidate id="form" name="form">

									<div class="col-md-4 d-none">
										<label for="validationCustom04" class="form-label">Branch</label>
										<select id="BranchC" class="form-control rounded-corner" name="BranchCode" required>
										</select>
										<div class="invalid-feedback">
											Please select a valid Branch.
										</div>
									</div>

									<div class="col-md-4">
										<label for="validationCustom04" class="form-label">Select Type</label>
										<select id="Type" class="form-control rounded-corner" name="Type" required>
											<option value="">Select</option>
											<option value="Order">Order</option>
											<option value="Complaint">Complaint</option>
											<option value="AMC">AMC</option>
										</select>
										<div class="invalid-feedback">
											Please select a valid Type.
										</div>
									</div>

									<div class="col-md-4">
										<label for="validationCustom04" class="form-label">Device</label>
										<select id="Device" class="form-control rounded-corner" name="GadgetID" required>
											<option value="">Device</option>
											<?php
											$Device="Select * from gadget order by Gadget";
											$result=mysqli_query($con,$Device);
											if (mysqli_num_rows($result)>0)
											{
												while ($arr=mysqli_fetch_assoc($result))
												{
													?>
													<option value="<?php echo $arr['GadgetID']; ?>"><?php echo $arr['Gadget']; ?></option>
													<?php
												}
											}
											?>
										</select>
										<div class="invalid-feedback">
											Please select a valid Device.
										</div>
									</div>
									<div class="col-md-4">
										<label for="validationCustom01" class="form-label ">Received By</label>
										<input type="text" class="form-control rounded-corner" id="ReceivedBy" name="ReceivedBy" required>
									</div>
									<div class="col-md-4">
										<label for="validationCustom02" class="form-label ">Made By</label>
										<input type="text" class="form-control rounded-corner" id="MadeBy" name="MadeBy" required>
									</div>
									<div class="col-md-4">
										<label for="validationCustom01" class="form-label ">Date Of Information</label>
										<input type="date" value="<?php echo $Date ?>" class="form-control rounded-corner" id="InfoDateAdd" name="InfoDate" required>
									</div>
									<div class="col-md-4">
										<label for="validationCustom01" class="form-label ">Expected Completion</label>
										<input type="date" class="form-control rounded-corner" id="ExpectedAdd" name="ExpDate" required>
									</div>

									<div class="col-md-12">
										<label for="validationCustomUsername" class="form-label">Discription</label>
										<div class="input-group has-validation">
											<textarea class="form-control rounded-corner" id="DiscriptionAdd" name="Discription" required></textarea>
											<div class="invalid-feedback">
												Please enter a Discription.
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<input class="btn btn-secondary"  data-bs-dismiss="modal" value="Close">  </div>
								</form>
							</div>
						</div>
					</div>
				</div>

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
									<button type="button" class="btn btn-primary form-control rounded-corner" data-bs-toggle="modal" data-bs-target="#addmultiorders">Add</button>
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
							<th>ID</th>
							<th>Description</th>
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
				data:{'ZoneCode':ZoneCodeM, 'BankCode':BankCodeM},
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
		var ZoneCode = document.getElementById("ZoneM").value;
		var Device = document.getElementById("Device").value;
		var Type = document.getElementById("Type").value;
		var ReceivedBy = document.getElementById("ReceivedBy").value;
		var MadeBy = document.getElementById("MadeBy").value;
		var InfoDate = document.getElementById("InfoDateAdd").value;
		var Expected = document.getElementById("ExpectedAdd").value;
		var Discription = document.getElementById("DiscriptionAdd").value;
		var array = [];
		$("input:checkbox[name=select]:checked").each(function() {
			array.push($(this).val());
		});
		const branch= JSON.stringify(array);
		console.log(branch);
		var flag=0;
		if (array[0]>0) {
			flag=1;
		}			
		if (ZoneCode=='') {
			swal("error","Please Select Zone","error");
		}if (flag==0) {
			swal("error","Please Select Branch","error");
		} else if(Device == '' || Type == '' || ReceivedBy == '' || MadeBy == '' || InfoDate == '' || Expected == '' || Discription == ''){
			swal("error","Please enter all fields","error");
		}else{
			const obj = {Device: Device, Type: Type, ReceivedBy: ReceivedBy, MadeBy: MadeBy, InfoDate: InfoDate, Expected: Expected, Discription: Discription };
			const data = JSON.stringify(obj);

			$.ajax({
				type:'POST',
				url:'addmultiorders.php',
				data:{Data:data, branch:branch},
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
</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>