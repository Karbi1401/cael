<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">

          <div class="sb-sidenav-menu-heading">Core</div>
          <a class="nav-link" href="<?php echo URLROOT . '/admins'; ?>">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Dashboard
          </a>

          <a class="nav-link" href="<?php echo URLROOT . '/categories'; ?>">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-table"></i></div>
            Categories
          </a>

          <a class="nav-link" href="<?php echo URLROOT . '/products'; ?>">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-table"></i></div>
            Products
          </a>

          <a class="nav-link" href="<?php echo URLROOT . '/drivers'; ?>">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-id-card"></i></div>
            Driver
          </a>

          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon">
              <i class="fa-solid fa-list"></i>
            </div>
            Orders
            <div class="sb-sidenav-collapse-arrow">
              <i class="fas fa-angle-down"></i>
            </div>
          </a>
          <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link" href="<?php echo URLROOT; ?>/orders/index">Pending Orders</a>
              <a class="nav-link" href="<?php echo URLROOT; ?>/orders/completed">Completed Orders</a>
            </nav>
          </div>

        </div>
      </div>
      <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        <?php echo $_SESSION['admin_name'] ?>
      </div>
    </nav>
  </div>
  <div id="layoutSidenav_content">