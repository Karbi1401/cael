<?php require APPROOT . '/views/admins/inc/header.php'; ?>
<?php require APPROOT . '/views/admins/inc/navbar.php'; ?>
<?php require APPROOT . '/views/admins/inc/sidebar.php'; ?>

<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Add Category</h1>
    <div class="row align-items-center">
      <div class="col mx-auto">
        <form class="p-4 p-md-5 border rounded-3 bg-light" action="<?php echo URLROOT; ?>/categories/edit/<?php echo $data['id']; ?>" method="POST" id="formCategory" enctype="multipart/form-data">

          <div class="mb-3">
            <label for="formControlCategoryName" class="form-label">Category Name</label>
            <input type="text" class="form-control <?php echo (!empty($data['category_name_err'])) ? 'is-invalid' : ''; ?>" id="formControlCategoryName" name="category_name" value="<?php echo $data['category_name']; ?>" placeholder="Enter category name">
            <span class="invalid-feedback"><?php echo $data['category_name_err']; ?></span>
          </div>

          <div class="mb-3">
            <label for="formControlCategoryStatus" class="form-label">Category Status</label>
            <select class="form-select" form="formCategory" name="category_status" id="formControlCategoryStatus">
              <option value="0">Inactive</option>
              <option value="1">Active</option>
            </select>
          </div>

          <div class="d-flex gap-2">
            <input class="w-100 btn btn-success btn-lg" type="submit" value="Edit Category">
            <a class="w-100 btn btn-danger btn-lg" href="<?php echo URLROOT; ?>/categories" role="button"> Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<?php require APPROOT . '/views/admins/inc/footer.php'; ?>