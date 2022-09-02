<?php 
include 'connection.php';
//include 'session.php';
//$EXEID=$_SESSION['userid'];
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date =date('Y-m-d',strtotime($timestamp));

$exdate=date('Y-m-d', strtotime($Date. ' + 2 days'));
$exdate2=date('Y-m-d', strtotime($Date. ' + 7 days'));
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
	<title>Multi-Orders/omplaints/AMC</title>
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

		<div class="modal fade" id="addmultiorders" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add Order / Complaints/ AMC</h5>
					</div>
					<div class="modal-body">

						<form class="row g-3 needs-validation" novalidate id="form" name="form">

							<div class="col-md-4 d-none">
								<label for="validationCustom04" class="form-label">Branch</label>
								<select id="BranchC" class="form-control my-select3" name="BranchCode" required>
								</select>
								<div class="invalid-feedback">
									Please select a valid Branch.
								</div>
							</div>

							<div class="col-md-4">
								<label for="validationCustom04" class="form-label">Select Type</label>
								<select id="Type" class="form-control my-select3" name="Type" required>
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
								<select id="Device" class="form-control my-select3" name="GadgetID" required>
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
								<input type="text" class="form-control my-select2" id="ReceivedBy" name="ReceivedBy" required>
							</div>
							<div class="col-md-4">
								<label for="validationCustom02" class="form-label ">Made By</label>
								<input type="text" class="form-control my-select2" id="MadeBy" name="MadeBy" required>
							</div>
							<div class="col-md-4">
								<label for="validationCustom01" class="form-label ">Date Of Information</label>
								<input type="date" value="<?php echo $Date ?>" class="form-control my-select3" id="InfoDateAdd" name="InfoDate" required>
							</div>
							<div class="col-md-4">
								<label for="validationCustom01" class="form-label ">Expected Completion</label>
								<input type="date" class="form-control my-select3" id="ExpectedAdd" name="ExpDate" required>
							</div>

							<div class="col-md-12">
								<label for="validationCustomUsername" class="form-label">Discription</label>
								<div class="input-group has-validation">
									<textarea class="form-control my-select2" id="DiscriptionAdd" name="Discription" required></textarea>
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
								<button type="button" style="margin-top: 10px;" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#addmultiorders">Add</button>
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
				<button class="btn-primary S" id="button">Submit</button>
			</center>
		</div>
		<br>
	</div>

	<script src="ajax-script.js"></script>
	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
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
				alert("Please Select Zone");
			}if (flag==0) {
				alert("Please Select Branch");
			} else if(Device == '' || Type == '' || ReceivedBy == '' || MadeBy == '' || InfoDate == '' || Expected == '' || Discription == ''){
				alert("Please enter all fields");
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

	</script>
</body>
</html>
<?php 
$con->close();
$con2->close();
?>