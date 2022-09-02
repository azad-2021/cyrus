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

      if ($Type=='Executive') {

       ?>

       <li class="nav-item">
        <a class="nav-link collapsed" href="orders.php">
          <i class="bi bi-grid"></i>
          <span>Add Orders</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="CompletedOrders.php">
          <i class="bi bi-grid"></i>
          <span>Completed Orders</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="cancelorders.php">
          <i class="bi bi-grid"></i>
          <span>Cancelled Orders</span>
        </a>
      </li>

      <?php 
    }elseif ($Type=='Sim Provider') {
      ?>

      <li class="nav-item">
        <a class="nav-link collapsed" href="simpending.php">
          <i class="bi bi-grid"></i>
          <span>Pending Orders</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="sim.php">
          <i class="bi bi-grid"></i>
          <span>Release SIM Card</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="viewsim.php">
          <i class="bi bi-grid"></i>
          <span>Active SIM Cards</span>
        </a>
      </li>

      <?php 
    }elseif ($Type=='Production') {
      ?>

      <li class="nav-item">
        <a class="nav-link collapsed" href="viewproduction.php">
          <i class="bi bi-grid"></i>
          <span>Production Details</span>
        </a>
      </li>

      <?php 
    }elseif ($Type=='Store') {
      ?>

      <li class="nav-item">
        <a class="nav-link collapsed" href="viewstore.php?">
          <i class="bi bi-grid"></i>
          <span>Store Details</span>
        </a>
      </li>

      <?php 
    }elseif ($Type=='Installation') {
      ?>

      <li class="nav-item">
        <a class="nav-link collapsed" href="viewinst.php">
          <i class="bi bi-grid"></i>
          <span>Installation Details</span>
        </a>
      </li>
      <?php 
      if(isset($type)) {
        ?>

        <li class="nav-item">
          <a class="nav-link collapsed" href="add.php?id= <?php echo $ID; ?> ">
            <i class="bi bi-grid"></i>
            <span>Add Number</span>
          </a>
        </li>

        <?php 
      }
    }
    ?>

  </ul>
</aside>
  <!-- End Sidebar-->