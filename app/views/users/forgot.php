<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<div class="container col-xl-10 col-xxl-8 px-4 py-5">
  <div class="row align-items-center g-lg-5 py-5">
    <div class="col mx-auto">
      <?php flash('user_message') ?>
      <form class="p-4 p-md-5 border rounded-3 bg-light" action="<?php echo URLROOT; ?>/users/forgot" method="POST">
        <h2 class="span-orange">Enter email address</h2>

        <div class="form-floating mb-3">
          <input type="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" id="floatingInput" placeholder="name@example.com" value="<?php echo $data['email']; ?>" name="email">
          <label for="floatingInput">Email address</label>
          <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
        </div>

        <input class="w-100 btn btn-orange btn-lg mb-3" type="submit" value="Send Password Reset">
      </form>
    </div>
  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>