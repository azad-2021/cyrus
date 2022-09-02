  <!-- ======= Sidebar ======= -->
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
            <a href="search.php" target="blank">
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
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Executive</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/cyrus/executive/index.php?user=6" target="_blank">
              <i class="bi bi-circle"></i><span>Abhineet Anand</span>
            </a>
          </li>
          <li>
            <a href="/cyrus/executive/index.php?user=3" target="_blank">
              <i class="bi bi-circle"></i><span>Raj Kamal kapoor</span>
            </a>
          </li>
          <li>
            <a href="/cyrus/executive/index.php?user=8" target="_blank">
              <i class="bi bi-circle"></i><span>Zeeshan Sayeed</span>
            </a>
          </li>
        </ul>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Work Verification & Jobcard Entry</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/cyrus/reporting/index.php?userid=21&name=Jayant Saxena&type=Reporting" target="_blank">
              <i class="bi bi-circle"></i><span>Jayant Saxena</span>
            </a>
          </li>
          <li>
            <a href="/cyrus/reporting/index.php?userid=23&name=Shreyansh&type=Reporting" target="_blank">
              <i class="bi bi-circle"></i><span>Shreyansh Awasthi</span>
            </a>
          </li>
          <li>
            <a href="/cyrus/reporting/index.php?userid=26&name=Shreyansh&type=Dataentry" target="_blank">
              <i class="bi bi-circle"></i><span>Rahul</span>
            </a>
          </li>
          <li>
            <a href="/cyrus/reporting/index.php?userid=12&name=Shreyansh&type=Dataentry" target="_blank">
              <i class="bi bi-circle"></i><span>Tarun Singh</span>
            </a>
          </li>
          <li>
            <a href="/cyrus/reporting/index.php?userid=32&name=Shreyansh&type=Dataentry" target="_blank">
              <i class="bi bi-circle"></i><span>Varsha</span>
            </a>
          </li>
        </ul>
      </li>
      
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-grid"></i><span>Employees</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="" data-bs-toggle="modal" data-bs-target="#AddEmployees">
            <i class="bi bi-circle"></i><span>Add Service Engineer</span>
          </a>
        </li>
        <li>
          <a href="" data-bs-toggle="modal" data-bs-target="#AddExecutive">
            <i class="bi bi-circle"></i><span>Add Executive</span>
          </a>
        </li>
        <li>
          <a href="" data-bs-toggle="modal" data-bs-target="Employees" class="Employees">
            <i class="bi bi-circle"></i><span>Service Engineer</span>
          </a>
        </li>

        <li>
          <a href="" data-bs-toggle="modal" data-bs-target="Executive" class="Executive">
            <i class="bi bi-circle"></i><span>Executuive</span>
          </a>
        </li>
      </ul>
    </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="/cyrus/reception/" target="_blank">
      <i class="bi bi-grid"></i>
      <span>Reception</span>
    </a>
  </li><!-- End Contact Page Nav -->


  <li class="nav-heading" style="font-size:15px">Inventory</li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="/cyrus/inventory/" target="_blank">
      <i class="bi bi-card-list"></i>
      <span>Inventory Release</span>
    </a>
  </li>
    <li class="nav-item">
    <a class="nav-link collapsed" href="/cyrus/InventoryRates/" target="_blank">
      <i class="bi bi-card-list"></i>
      <span>Item & Material add / update</span>
    </a>
  </li>
  <!-- End Forms Nav -->
  <!--
  <li class="nav-item">
    <a class="nav-link collapsed" href="">
      <i class="bi bi-card-list"></i>
      <span>Service Engineer</span>
    </a>
  </li> 

  
  <li class="nav-item">
    <a class="nav-link collapsed" href="/cyrus/reporting/reporting.php?user=jobcardentry" target="_blank">
      <i class="bi bi-grid"></i>
      <span>Jobacrd Entry</span>
    </a>
  </li>
-->
<li class="nav-heading" style="font-size:15px">Work</li>
<li class="nav-item">
  <a class="nav-link collapsed" href="UnassignedWork.php" target="_blank">
    <i class="bi bi-grid"></i>
    <span>Unassigned Work</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link collapsed" href="PendingWork.php" target="_blank">
    <i class="bi bi-grid"></i>
    <span>Pending Work</span>
  </a>
</li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="/cyrus/amc/" target="_blank">
      <i class="bi bi-grid"></i>
      <span>AMC Report</span>
    </a>
  </li><!-- End Contact Page Nav -->
<li class="nav-item">
  <a class="nav-link collapsed" href="district.php">
    <i class="bi bi-grid"></i>
    <span>Work Region Details</span>
  </a>
</li>

<li class="nav-heading" style="font-size:15px">Payment</li>
<li class="nav-item">
  <a class="nav-link collapsed BankReminders" href="" data-bs-toggle="modal" data-bs-target="#BankReminders">
    <i class="bi bi-grid"></i>
    <span>Assign Zone</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link collapsed" href="PendingBills.php" target="_blank">
    <i class="bi bi-grid"></i>
    <span>Pending Payment</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link collapsed" href="PendingWorkJobcard.php">
    <i class="bi bi-grid"></i>
    <span>Pending Work from Jobcard</span>
  </a>
</li>
</ul>

</aside><!-- End Sidebar-->