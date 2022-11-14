<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<div class="container col-xl-10 col-xxl-8 px-4 py-5">
  <div class="row align-items-center g-lg-5 py-5">
    <div class="col mx-auto">
      <form class="p-4 p-md-5 border rounded-3 bg-light" action="<?php echo URLROOT; ?>/users/edit/<?php echo $data['user_id']; ?>" method="POST">
        <h2 class="span-orange">Edit User Details</h2>

        <div class="mb-3">
          <label for="inputUsername" class="form-label">Username <span class="text-danger">*</span></label>
          <input type="text" class="form-control <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>" id="inputUsername" value="<?php echo $data['username']; ?>" name="username">
          <span class="invalid-feedback"><?php echo $data['username_err']; ?></span>
        </div>

        <div class="mb-3">
          <label for="inputFirstName" class="form-label">First Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control <?php echo (!empty($data['first_name_err'])) ? 'is-invalid' : ''; ?>" id="inputFirstName" value="<?php echo $data['first_name']; ?>" name="first_name">
          <span class="invalid-feedback"><?php echo $data['first_name_err']; ?></span>
        </div>

        <div class="mb-3">
          <label for="inputLastName" class="form-label">Last Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control <?php echo (!empty($data['last_name_err'])) ? 'is-invalid' : ''; ?>" id="inputLastName" value="<?php echo $data['last_name']; ?>" name="last_name">
          <span class="invalid-feedback"><?php echo $data['last_name_err']; ?></span>
        </div>

        <div class="mb-3">
          <label for="inputEmail" class="form-label">Email Address <span class="text-danger">*</span></label>
          <input type="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" id="inputEmail" value="<?php echo $data['email']; ?>" name="email">
          <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
        </div>

        <div class="mb-3">
          <label for="inputContact" class="form-label">Contact Number <span class="text-danger">*</span></label>
          <input type="text" class="form-control <?php echo (!empty($data['contact_err'])) ? 'is-invalid' : ''; ?>" id="inputContact" value="<?php echo $data['contact']; ?>" name="contact">
          <span class="invalid-feedback"><?php echo $data['contact_err']; ?></span>
        </div>

        <div class="mb-3">
          <label for="inputAddress" class="form-label">Address <span class="text-danger">*</span></label>
          <input type="text" class="form-control <?php echo (!empty($data['address_err'])) ? 'is-invalid' : ''; ?>" id="inputAddress" value="<?php echo $data['address']; ?>" name="address">
          <span class="invalid-feedback"><?php echo $data['address_err']; ?></span>
        </div>

        <div class="mb-3">
          <label for="inputCity" class="form-label">City <span class="text-danger">*</span></label>
          <input type="text" class="form-control <?php echo (!empty($data['city_err'])) ? 'is-invalid' : ''; ?>" id="inputCity" value="<?php echo $data['city']; ?>" name="city">
          <span class="invalid-feedback"><?php echo $data['city_err']; ?></span>
        </div>

        <input class="w-100 btn btn-orange btn-lg" type="submit" value="Edit">
      </form>
    </div>
  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>