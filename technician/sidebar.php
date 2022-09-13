  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="deleteapid.php">
          <i class="bi bi-grid"></i>
          <span>Home</span>
        </a>
      </li><!-- End Dashboard Nav 
      

        End Contact Page Nav -->
        <?php 
        if (isset($shownav)) {
         ?>
         <li class="nav-item">
          <a class="nav-link collapsed" href="rejected.php">
            <i class="bi bi-card-list"></i>
            <span>Rejected Verifications</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="performance.php">
            <i class="bi bi-card-list"></i>
            <span>Performance</span>
          </a>
        </li>
        <?php 
        if ($_SESSION['pass']!='cyrus@123') {

         ?>
         <li class="nav-item">
          <a class="nav-link collapsed" href=<?php echo $sheet ; ?>>
            <i class="bi bi-card-list"></i>
            <span>Expenses</span>
          </a>
        </li>
        <?php
      }
    }
    ?>
  </ul>

</aside><!-- End Sidebar-->