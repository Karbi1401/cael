<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<main class="container col-xl-10 col-xxl-8 px-4 py-5">
  <div class="row align-items-center g-lg-5 py-5">
    <div class="col mx-auto">
      <form class="p-4 p-md-5 border rounded-3 bg-light" action="<?php echo URLROOT; ?>/users/signup" method="POST">
        <h1 class="mb-3"><span class="span-orange">Create an user account</span></h1>

        <div class="row">
          <div class="col-6">
            <div class="mb-3">
              <label for="floatingInputFirstName" class="form-label">First Name<span class="text-danger"> *</span></label>
              <input type="text" class="form-control <?php echo (!empty($data['first_name_err'])) ? 'is-invalid' : ''; ?>" id="floatingInputFirstName" value="<?php echo $data['first_name']; ?>" name="first_name">
              <span class="invalid-feedback"><?php echo $data['first_name_err']; ?></span>
            </div>
          </div>

          <div class="col-6">
            <div class="mb-3">
              <label for="floatingInputLastName" class="form-label">Last Name<span class="text-danger"> *</span></label>
              <input type="text" class="form-control <?php echo (!empty($data['last_name_err'])) ? 'is-invalid' : ''; ?>" id="floatingInputLastName" value="<?php echo $data['last_name']; ?>" name="last_name">
              <span class="invalid-feedback"><?php echo $data['last_name_err']; ?></span>
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="floatingInputAddress" class="form-label">Email address<sup class="text-danger"> *</sup></label>
          <input type="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" id="floatingInputAddress" value="<?php echo $data['email']; ?>" name="email">
          <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
        </div>

        <div class="mb-3">
          <label for="floatingInputContact" class="form-label">Contact Number<sup class="text-danger"> *</sup></label>
          <input type="text" class="form-control <?php echo (!empty($data['contact_err'])) ? 'is-invalid' : ''; ?>" id="floatingInputContact" value="<?php echo $data['contact']; ?>" name="contact">
          <span class="invalid-feedback"><?php echo $data['contact_err']; ?></span>
        </div>

        <div class="mb-3">
          <label for="floatingInputAddress" class="form-label">Address<sup class="text-danger"> *</sup></label>
          <input type="text" class="form-control <?php echo (!empty($data['address_err'])) ? 'is-invalid' : ''; ?>" id="floatingInputAddress" value="<?php echo $data['address']; ?>" name="address">
          <span class="invalid-feedback"><?php echo $data['address_err']; ?></span>
        </div>

        <div class="mb-3">
          <label for="floatingInputCity" class="form-label">City<sup class="text-danger"> *</sup></label>
          <input type="text" class="form-control <?php echo (!empty($data['city_err'])) ? 'is-invalid' : ''; ?>" id="floatingInputCity" value="<?php echo $data['city']; ?>" name="city">
          <span class="invalid-feedback"><?php echo $data['city_err']; ?></span>
        </div>

        <div class="mb-3">
          <label for="floatingInputUsername" class="form-label">Username<span class="text-danger"> *</span></label>
          <input type="text" class="form-control <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>" id="floatingInputUsername" value="<?php echo $data['username']; ?>" name="username">
          <span class="invalid-feedback"><?php echo $data['username_err']; ?></span>
        </div>

        <div class="mb-3">
          <label for="floatingPassword" class="form-label">Password<sup class="text-danger"> *</sup></label>
          <input type="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" id="floatingPassword" value="<?php echo $data['password']; ?>" name="password">
          <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
        </div>

        <div class="mb-3">
          <label for="floatingConfirmPassword" class="form-label">Confirm Password<sup class="text-danger"> *</sup></label>
          <input type="password" class="form-control <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" id="floatingConfirmPassword" value="<?php echo $data['confirm_password']; ?>" name="confirm_password">
          <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
        </div>

        <input class="w-100 btn btn-orange btn-lg" type="submit" value="Signup">

        <hr class="my-4">
        <p class="text-muted">Already have an account?
          <a href="<?php echo URLROOT; ?>/users/login">Login</a> instead
        </p>
      </form>
    </div>
  </div>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>