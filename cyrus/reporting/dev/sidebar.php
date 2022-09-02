  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
       <?php 

       if ($Type=='Executive') {

        echo '<a class="nav-link " href="/cyrus/executive/index.php">';
      }elseif ($Type=='Dataentry') {
        echo '<a class="nav-link " href="reporting.php">';
      }else{
        echo '<a class="nav-link " href="index.php">';
      }
      ?>
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <?php 

  if ($Type=='Reporting') {

   ?>
   <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-search"></i><span>Find</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="" data-bs-toggle="modal" data-bs-target="#FindBranch">
          <i class="bi bi-circle"></i><span>Find Branch</span>
        </a>
      </li>
      <li>
        <a href="branchdetails.php" target="_blank">
          <i class="bi bi-circle"></i><span>Branch Detail</span>
        </a>
      </li>
      <li>
        <a href="estimate_edit.php">
          <i class="bi bi-circle"></i><span>Estimate</span>
        </a>
      </li>
      <li>
        <a href="" data-bs-toggle="modal" data-bs-target="#FindEmployee">
          <i class="bi bi-circle"></i><span>Employee</span>
        </a>
      </li>
      <li>
        <a href=""  data-bs-toggle="modal" data-bs-target="#FindOrder">
          <i class="bi bi-circle"></i><span>Order</span>
        </a>
      </li>
      <li>
        <a href="" data-bs-toggle="modal" data-bs-target="#FindComplaint">
          <i class="bi bi-circle"></i><span>Complaint</span>
        </a>
      </li>
      <li>
        <a href="/cyrus/reporting/search.php" target="blank">
          <i class="bi bi-circle"></i><span>Job Card</span>
        </a>
      </li>
      <li>
        <a href="" data-bs-toggle="modal" data-bs-target="#FindJobcard">
          <i class="bi bi-circle"></i><span>Job Card Detail</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="reporting.php">
      <i class="bi bi-grid"></i>
      <span>Reporting</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="rejectedData.php" target="_blank">
      <i class="bi bi-grid"></i>
      <span>Rejected Verification</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="Work.php">
      <i class="bi bi-grid"></i>
      <span>Unassigned & Pending Work</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="delaywork.php">
      <i class="bi bi-grid"></i>
      <span>Delayed Work</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="abouttodelay.php">
      <i class="bi bi-grid"></i>
      <span>About to Delay</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="InventoryData.php">
      <i class="bi bi-card-list"></i>
      <span>Pending Materials at Inventory</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="multiamc.php">
      <i class="bi bi-grid"></i>
      <span>Multi-AMC Assigning</span>
    </a>
  </li>
  <?php 
  if (isset($Edit)) {
    ?>
    <li class="nav-item">
      <a class="nav-link collapsed" href="/technician/editjobcard.php?apid=<?php echo $enApprovalID.'&cardno='.$enJobcard;  ?>">
        <i class="bi bi-grid"></i>
        <span>Edit Jobcard</span>
      </a>
    </li>
    <?php 
  }
}elseif($Type=='Dataentry'){
  ?>
  <li class="nav-item">
    <a class="nav-link collapsed" href="search.php">
      <i class="bi bi-grid"></i>
      <span>Search Jobcard</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="addjobcard.php">
      <i class="bi bi-grid"></i>
      <span>Add Jobcard</span>
    </a>
  </li>
  <?php 
  if ($_SESSION['userid']==32) {
   ?>
   <li class="nav-item">
    <a class="nav-link collapsed" href="/cyrus/reminders/" target="_blank">
      <i class="bi bi-grid"></i>
      <span>Payment Reminder</span>
    </a>
  </li>
<?php }

}elseif($Type=='Executive'){
  ?>

  <li class="nav-item">
    <a class="nav-link collapsed" href="Work.php">
      <i class="bi bi-grid"></i>
      <span>Unassigned & Pending Work</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="delaywork.php">
      <i class="bi bi-grid"></i>
      <span>Delayed Work</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="abouttodelay.php">
      <i class="bi bi-grid"></i>
      <span>About to Delay</span>
    </a>
  </li>

<?php 
}
?>
</ul>
</aside>
<!-- End Sidebar-->