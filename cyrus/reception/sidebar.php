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
        <a href="" data-bs-toggle="modal" data-bs-target="#FindJobcard">
          <i class="bi bi-circle"></i><span>Job Card</span>
        </a>
      </li>
      <li>
        <a href="search.php" target="blank">
          <i class="bi bi-circle"></i><span>View Job Card</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="d">
      <i class="bi bi-grid"></i>
      <span>Add Order & Complaint</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="multiorders.php">
      <i class="bi bi-grid"></i>
      <span>Add Multiple Order & Complaint</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="UpdateMultiGst.php">
      <i class="bi bi-grid"></i>
      <span>Update GST Multiple Branch</span>
    </a>
  </li>
</ul>
</aside>
<!-- End Sidebar-->