<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<div class="container col-xl-10 col-xxl-8 px-4 py-5">
  <div class="row align-items-center g-lg-5 py-5">
    <div class="col mx-auto">

      <form class="p-4 p-md-5 border rounded-3 bg-light" action="<?php echo URLROOT; ?>/users/avatar/<?php echo $data['user']; ?>" method="POST" enctype="multipart/form-data">
        <h2 style="color: #e67e22;">Edit your profile picture</h2>

        <div class="mb-3">
          <label for="food_image" class="form-label">Upload profile picture</label>
          <input class="form-control <?php echo isset($data['user_image_err']) ? 'is-invalid' : '' ?>" type="file" id="user_image" name="user_image">
        </div>
        <small><?php echo isset($data['user_image_err']) ? '<div class="text-danger">' . $data['user_image_err'] . '</div>' : '' ?></small>

        <input type="submit" class="btn btn-orange" value="Submit" name="user_image">
      </form>

    </div>
  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>