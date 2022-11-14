<header>
  <nav class="navbar navbar-expand-lg fixed-top menu shadow">
    <div class="container">
      <a class="navbar-brand" href="<?php echo URLROOT; ?>">
        <img src="<?php echo URLROOT; ?>/img/logo.png" alt="logo" width="75">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/pages/menu">Menu</a>
          </li>
        </ul>

        <div class="d-flex">
          <ul class="navbar-nav">
            <?php if (isset($_SESSION['user_id'])) : ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo URLROOT; ?>/users/profile/<?php echo $_SESSION['user_id']; ?>"><i class="fa-solid fa-circle-user"></i> Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link position-relative" href="<?php echo URLROOT; ?>/carts"><i class="fa-solid fa-cart-shopping"></i> Cart
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?php echo $_SESSION['user_cart'] ?>
                    <span class="visually-hidden">cart total</span>
                  </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
              </li>
            <?php else : ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo URLROOT; ?>/users/signup">Signup</a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</header>