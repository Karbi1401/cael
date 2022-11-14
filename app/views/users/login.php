<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<main class="container col-xl-10 col-xxl-8 px-4 py-5">
  <div class="row align-items-center g-lg-5 py-5">
    <div class="col-lg-7 text-center text-lg-start">
      <h1 class="display-4 fw-bold lh-1 mb-3"><span class="span-orange">Cael's</span> Delivery</h1>
      <p class="col-lg-10 fs-4">Cael's Delivery is a family business that not just caters delicious foods, but lives with the perspective that nothing makes people closer together like pleasure and laughter.</p>
    </div>
    <div class="col-md-10 mx-auto col-lg-5">
      <form class="p-4 p-md-5 border rounded-3 bg-light" action="<?php echo URLROOT; ?>/users/login" method="POST">
        <?php
        flash('user_message');
        ?>
        <h2 class="mb-3"><span class="span-orange">Login</span></h2>
        <div class="mb-3">
          <label for="formControlUsername" class="form-label">Username</label>
          <input type="text" class="form-control <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['username']; ?>" id=" formControlUsername" name="username">
          <span class="invalid-feedback"><?php echo $data['username_err']; ?></span>
        </div>
        <div class="mb-3">
          <label for="formControlPassword" class="form-label">Password</label>
          <input type="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>" id=" formControlPassword" name="password">
          <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
        </div>
        <input class="w-100 btn btn-lg btn-orange mb-3" type="submit" value="Login">
        <a href="<?php echo URLROOT; ?>/users/forgot">Forgot Password</a>
        <hr class="my-4">
        <small class="text-muted">Don't have an account? <a href="<?php echo URLROOT; ?>/users/signup" class="signup-link">Sign up</a> instead</small>
      </form>
    </div>
  </div>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>