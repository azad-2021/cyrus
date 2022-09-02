  <!-- ======= Sidebar ======= -->
  <?php 
  $Type=$_SESSION['usertype'];
  ?>
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      
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


      <!-- End Components Nav -->
    <!--
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Add</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="" data-bs-toggle="modal" data-bs-target="#AddUser">
            <i class="bi bi-circle"></i><span>User</span>
          </a>
        </li>
        <li>
          <a href="" data-bs-toggle="modal" data-bs-target="#AddInstitute">
            <i class="bi bi-circle"></i><span>Institute</span>
          </a>
        </li>
        <li>
          <a href="" data-bs-toggle="modal" data-bs-target="#AddStudent">
            <i class="bi bi-circle"></i><span>Student</span>
          </a>
        </li>
        <li>
          <a href="" data-bs-toggle="modal" data-bs-target="#AddState">
            <i class="bi bi-circle"></i><span>State</span>
          </a>
        </li>
        <li>
          <a href="" data-bs-toggle="modal" data-bs-target="#AddDistrict">
            <i class="bi bi-circle"></i><span>District</span>
          </a>
        </li>
      </ul>
    </li>
  -->
  <!-- End Forms Nav -->


  <?php 
  if ($Type=='Executive') {
   ?>
   <li class="nav-item">
    <a class="nav-link collapsed" target="_blank" href="/cyrus/reporting/reporting.php">
      <i class="bi bi-grid"></i>
      <span>Reporting</span>
    </a>
  </li><!-- End Profile Page Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="/cyrus/SaaS/ordertable.php" target="_blank">
      <i class="bi bi-grid"></i>
      <span>SaaS</span>
    </a>
  </li><!-- End F.A.Q Page Nav -->
  <?php 
}
?>

<li class="nav-item">
  <a class="nav-link collapsed AssignedRegion" href="" data-bs-toggle="modal" data-bs-target="#AssignedRegion">
    <i class="bi bi-grid"></i>
    <span>Assigned Region & District</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link collapsed" href="PendingMaterial.php">
    <i class="bi bi-grid"></i>
    <span>Pending Material Confirmation</span>
  </a>
</li><!-- End Contact Page Nav -->

<li class="nav-item">
  <a class="nav-link collapsed" href="InventoryData.php">
    <i class="bi bi-card-list"></i>
    <span>Pending Material at Inventory</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link collapsed" href="UnassignedWork.php">
    <i class="bi bi-grid"></i>
    <span>Unassigned Work</span>
  </a>
</li><!-- End Profile Page Nav -->

<li class="nav-item">
  <a class="nav-link collapsed" href="PendingWork.php">
    <i class="bi bi-grid"></i>
    <span>Pending Work</span>
  </a>
</li><!-- End F.A.Q Page Nav -->

<li class="nav-item">
  <a class="nav-link collapsed" href="PendingBills.php">
    <i class="bi bi-grid"></i>
    <span>Pending Bill</span>
  </a>
</li><!-- End Contact Page Nav -->

<li class="nav-item">
  <a class="nav-link collapsed" href="multiorders.php">
    <i class="bi bi-grid"></i>
    <span>Multi-Orders Confirmation</span>
  </a>
</li>
<!--
<li class="nav-item">
  <a class="nav-link collapsed" href="oldwork.php">
    <i class="bi bi-grid"></i><span>Old Pending Work</span>
  </a>
</li>
-->
<!-- End Register Page Nav -->

</ul>

</aside><!-- End Sidebar-->