  <?php 
  $EXEID=$_SESSION['userid'];


  ?>

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <?php 
      if ( $EXEID==11) { 
        ?>

        <li class="nav-item">
          <a class="nav-link collapsed" href="/cyrus/reception/" target="_blank">
            <i class="bi bi-grid"></i>
            <span>Reception</span>
          </a>
        </li><!-- End Contact Page Nav -->
        <?php 
      }
      ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="PendingBills.php">
          <i class="bi bi-card-list"></i>
          <span>All Pending Bills</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="pendingGstbills.php">
          <i class="bi bi-card-list"></i>
          <span>Based on next reminder</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="NoGstbills.php">
          <i class="bi bi-card-list"></i>
          <span>Based on no reminder</span>
        </a>
      </li>

      <?php 
      if ( $EXEID==24) { 
        ?>

        <li class="nav-item">
          <a class="nav-link collapsed" href="branchdetails.php" target="_blank">
            <i class="bi bi-grid"></i>
            <span>Branch Detail</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="PendingWorkJobcard.php">
            <i class="bi bi-grid"></i>
            <span>Pending Work from jobcard</span>
          </a>
        </li>
        <?php 
      }
      ?>

    </ul>

</aside><!-- End Sidebar-->