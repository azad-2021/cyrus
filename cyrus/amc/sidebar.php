  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <?php 
      if ($_SESSION['usertype']!='Work Report') {
       ?>
      <li class="nav-item">
        <a class="nav-link " href="branchdetails.php">
          <i class="bi bi-grid"></i>
          <span>Branch Detail</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="amcs.php" target="_blank">
          <i class="bi bi-grid"></i>
          <span>AMC List</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="/cyrus/reporting/search.php" target="_blank">
          <i class="bi bi-grid"></i>
          <span>Search JobCard</span>
        </a>
      </li>
      <?php 
      if ($EXEID==26) {
       ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="/cyrus/reporting/reporting.php?user=jobcardentry" target="_blank">
          <i class="bi bi-grid"></i>
          <span>Jobacrd Entry</span>
        </a>
      </li>
      <?php } ?>
      <?php 
      if ($EXEID==7) {
       ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="workreport.php">
          <i class="bi bi-grid"></i>
          <span>Work Report</span>
        </a>
      </li>
      <?php } }?>

      <!-- End Dashboard Nav -->

    </ul>

</aside><!-- End Sidebar-->