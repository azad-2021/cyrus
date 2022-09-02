  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">

        <a class="nav-link " href="index.php">

          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
  <!--
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-search"></i><span>Find</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="" data-bs-toggle="modal" data-bs-target="#FindBranch">
          <i class="bi bi-circle"></i><span>Find Site</span>
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
        <a href="branchdetails.php">
          <i class="bi bi-circle"></i><span>Site Detail</span>
        </a>
      </li>

      <<li>
        <a href="" data-bs-toggle="modal" data-bs-target="#FindJobcard">
          <i class="bi bi-circle"></i><span>Job Card</span>
        </a>
      </li>
    </ul>
  </li>
-->
<?php if(isset($AddEn)){ ?>
<li class="nav-item">
  <a class="nav-link collapsed" href="" data-bs-toggle="modal" data-bs-target="#AddOrder">
    <i class="bi bi-grid"></i>
    <span>Add Order</span>
  </a>
</li>
<?php } ?>
<li class="nav-item">
  <a class="nav-link collapsed" href="DivisionDetails.php">
    <i class="bi bi-grid"></i>
    <span>Division Detail</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link collapsed" href="PendingMaterial.php">
    <i class="bi bi-grid"></i>
    <span>Pending Material Confirmation</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link collapsed" href="InventoryData.php">
    <i class="bi bi-grid"></i>
    <span>Pending Material at Inventory</span>
  </a>
</li>
</ul>
</aside>
<!-- End Sidebar-->