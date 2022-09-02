<?php 
$Type=$_SESSION['usertype'];
if ($Type!="Executive") {

 ?>


 <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #E0E1DE;" id="nav">
  <div class="container-fluid" align="center">
    <a class="navbar-brand" href=""><img src="cyrus logo.png" alt="cyrus.com" width="30" height="40">Cyrus Electronics</a>
    <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown" align="center">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="reporting.php?">Home</a>
        </li>
        <?php if ($Type=='Dataentry') { ?>
          <li class="nav-item">
            <a class="nav-link" href="addjobcard.php">Add Job Card</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="search.php" target="_blank">Jobcard</a>
          </li>
        <?php } ?>
        <?php if ($Type=='Reporting') { ?>
          <li class="nav-item">
            <a class="nav-link" href="assign.php">Assign</a>
          </li>
          <!--
          <li class="nav-item">
            <a class="nav-link" href="estimate_edit.php">Find Estimates</a>
          </li>
        -->
        <li class="nav-item dropdown dropbtn">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Find
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#FindBranch">Branch</a></li>

            <li><a class="dropdown-item" href="branchdetails.php" target="_blank">Branch Details</a></li>
            <li><a class="dropdown-item" href="estimate_edit.php">Estimate</a></li>

            <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#FindEmployee">Employees</a></li>
            <li><hr class="dropdown-divider"></li>

            <li><a class="dropdown-item" href=""  data-bs-toggle="modal" data-bs-target="#FindOrder">Order</a></li>

            <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#FindComplaint">Complaint</a></li>

            <li><a class="dropdown-item" href="search.php" target="_blank">Jobcard</a></li>

            <li><a style="padding-right: 10px;" data-bs-toggle="modal" data-bs-target="#FindJobcard" class="dropdown-item" href="">Jobcard Details</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#WorkReport">Work Report</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="" target="_blank">SMS Report</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="materialView.php" target="_blank">Material Confirmation Pending</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rejectedData.php" target="_blank">Rejected Data</a>
        </li>
      <?php } ?>

      <li class="nav-item">
        <a class="nav-link" href="changepass.php">Change Password</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>

    </ul>
  </div>
</div>
</nav>

<?php 

}elseif ($Type=="Executive") {

  ?>

  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #E0E1DE;" id="nav">
    <div class="container-fluid" align="center">
      <a class="navbar-brand" href=""><img src="cyrus logo.png" alt="cyrus.com" width="30" height="35">Cyrus Electronics</a>
      <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown" align="center">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/cyrus/executive/index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/cyrus/executive/inventorydata.php" target="_blank">Pending Materials</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Find
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#FindBranch">Branch</a></li>

              <li><a class="dropdown-item" href="/cyrus/executive/branchdetails.php" target="_blank">Branch Details</a></li>
              <li><a class="dropdown-item" href="/cyrus/executive/estimate_edit.php">Estimate</a></li>

              <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#FindEmployee">Employees</a></li>
              <li><hr class="dropdown-divider"></li>

              <li><a class="dropdown-item" href=""  data-bs-toggle="modal" data-bs-target="#FindOrder">Order</a></li>

              <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#FindComplaint">Complaint</a></li>

              <li><a class="dropdown-item" href="/cyrus/reporting/search.php" target="_blank">Jobcard</a></li>

              <li><a style="padding-right: 10px;" data-bs-toggle="modal" data-bs-target="#FindJobcard" class="dropdown-item" href="">Jobcard Details</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/cyrus/reporting/reporting.php">Reporting</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="assign.php">Assign</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <?php 

}
?>