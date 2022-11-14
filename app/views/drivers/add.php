<?php require APPROOT . '/views/admins/inc/header.php'; ?>
<?php require APPROOT . '/views/admins/inc/navbar.php'; ?>
<?php require APPROOT . '/views/admins/inc/sidebar.php'; ?>

<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Add Driver</h1>
    <div class="row align-items-center">
      <div class="col mx-auto">
        <form class="p-4 p-md-5 border rounded-3 bg-light" action="<?php echo URLROOT; ?>/drivers/add" method="POST" id="formProduct" enctype="multipart/form-data">

          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="floatingInputFirstName" class="form-label">First Name<span class="text-danger"> *</span></label>
                <input type="text" class="form-control <?php echo (!empty($data['driver_first_name_err'])) ? 'is-invalid' : ''; ?>" id="floatingInputFirstName" value="<?php echo $data['driver_first_name']; ?>" name="driver_first_name">
                <span class="invalid-feedback"><?php echo $data['driver_first_name_err']; ?></span>
              </div>
            </div>

            <div class="col-6">
              <div class="mb-3">
                <label for="floatingInputLastName" class="form-label">Last Name<span class="text-danger"> *</span></label>
                <input type="text" class="form-control <?php echo (!empty($data['driver_last_name_err'])) ? 'is-invalid' : ''; ?>" id="floatingInputLastName" value="<?php echo $data['driver_last_name']; ?>" name="driver_last_name">
                <span class="invalid-feedback"><?php echo $data['driver_last_name_err']; ?></span>
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="floatingInputAddress" class="form-label">Email address<sup class="text-danger"> *</sup></label>
            <input type="email" class="form-control <?php echo (!empty($data['driver_email_err'])) ? 'is-invalid' : ''; ?>" id="floatingInputAddress" value="<?php echo $data['driver_email']; ?>" name="driver_email">
            <span class="invalid-feedback"><?php echo $data['driver_email_err']; ?></span>
          </div>

          <div class="mb-3">
            <label for="floatingInputContact" class="form-label">Contact Number<sup class="text-danger"> *</sup></label>
            <input type="text" class="form-control <?php echo (!empty($data['driver_contact_err'])) ? 'is-invalid' : ''; ?>" id="floatingInputContact" value="<?php echo $data['driver_contact']; ?>" name="driver_contact">
            <span class="invalid-feedback"><?php echo $data['driver_contact_err']; ?></span>
          </div>

          <div class="mb-3">
            <label for="floatingInputAddress" class="form-label">Address<sup class="text-danger"> *</sup></label>
            <input type="text" class="form-control <?php echo (!empty($data['driver_address_err'])) ? 'is-invalid' : ''; ?>" id="floatingInputAddress" value="<?php echo $data['driver_address']; ?>" name="driver_address">
            <span class="invalid-feedback"><?php echo $data['driver_address_err']; ?></span>
          </div>

          <div class="mb-3">
            <label for="floatingInputCity" class="form-label">City<sup class="text-danger"> *</sup></label>
            <input type="text" class="form-control <?php echo (!empty($data['driver_city_err'])) ? 'is-invalid' : ''; ?>" id="floatingInputCity" value="<?php echo $data['driver_city']; ?>" name="driver_city">
            <span class="invalid-feedback"><?php echo $data['driver_city_err']; ?></span>
          </div>

          <div class="mb-3">
            <label for="floatingInputUsername" class="form-label">Username<span class="text-danger"> *</span></label>
            <input type="text" class="form-control <?php echo (!empty($data['driver_username_err'])) ? 'is-invalid' : ''; ?>" id="floatingInputUsername" value="<?php echo $data['driver_username']; ?>" name="driver_username">
            <span class="invalid-feedback"><?php echo $data['driver_username_err']; ?></span>
          </div>

          <div class="mb-3">
            <label for="floatingPassword" class="form-label">Password<sup class="text-danger"> *</sup></label>
            <input type="password" class="form-control <?php echo (!empty($data['driver_password_err'])) ? 'is-invalid' : ''; ?>" id="floatingPassword" value="<?php echo $data['driver_password']; ?>" name="driver_password">
            <span class="invalid-feedback"><?php echo $data['driver_password_err']; ?></span>
          </div>

          <div class="mb-3">
            <label for="floatingConfirmPassword" class="form-label">Confirm Password<sup class="text-danger"> *</sup></label>
            <input type="password" class="form-control <?php echo (!empty($data['driver_confirm_password_err'])) ? 'is-invalid' : ''; ?>" id="floatingConfirmPassword" value="<?php echo $data['driver_confirm_password']; ?>" name="driver_confirm_password">
            <span class="invalid-feedback"><?php echo $data['driver_confirm_password_err']; ?></span>
          </div>

          <div class="d-flex gap-2">
            <input class="w-100 btn btn-success btn-lg" type="submit" value="Add Driver">
            <a class="w-100 btn btn-danger btn-lg" href="<?php echo URLROOT; ?>/drivers" role="button"> Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>

</main>

<?php require APPROOT . '/views/admins/inc/footer.php'; ?>