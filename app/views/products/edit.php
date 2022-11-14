<?php require APPROOT . '/views/admins/inc/header.php'; ?>
<?php require APPROOT . '/views/admins/inc/navbar.php'; ?>
<?php require APPROOT . '/views/admins/inc/sidebar.php'; ?>

<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Add Product</h1>
    <div class="row align-items-center">
      <div class="col mx-auto">
        <form class="p-4 p-md-5 border rounded-3 bg-light" action="<?php echo URLROOT; ?>/products/edit/<?php echo $data['id']; ?>" method="POST" id="formProduct" enctype="multipart/form-data">

          <div class="mb-3">
            <label for="formControlProductName" class="form-label">Product Name</label>
            <input type="text" class="form-control <?php echo (!empty($data['product_name_err'])) ? 'is-invalid' : ''; ?>" id="formControlProductName" name="product_name" value="<?php echo $data['product_name']; ?>" placeholder="Enter Product Name">
            <span class="invalid-feedback"><?php echo $data['product_name_err']; ?></span>
          </div>

          <div class="mb-3">
            <label for="formControlProductPrice" class="form-label">Product Price</label>
            <input type="text" class="form-control <?php echo (!empty($data['product_price_err'])) ? 'is-invalid' : ''; ?>" id="formControlProductPrice" name="product_price" value="<?php echo $data['product_price']; ?>" placeholder="Enter Product Price">
            <span class="invalid-feedback"><?php echo $data['product_price_err']; ?></span>
          </div>

          <div class="mb-3">
            <label for="formControlProductDescription">Product Description</label>
            <textarea class="form-control <?php echo (!empty($data['product_description_err'])) ? 'is-invalid' : ''; ?>" placeholder="Enter Product Description" id="formControlProductDescription" name="product_description"><?php echo $data['product_description']; ?></textarea>
            <span class="invalid-feedback"><?php echo $data['product_description_err']; ?></span>
          </div>

          <div class="mb-3">
            <label for="formControlProductImage" class="form-label">Product Image</label>
            <input class="form-control <?php echo isset($data['product_image_err']) ? 'is-invalid' : '' ?>" type="file" id="formControlProductImage" name="image">
          </div>
          <small><?php echo isset($data['product_image_err']) ? '<div class="text-danger">' . $data['product_image_err'] . '</div>' : '' ?></small>

          <div class="mb-3">
            <label for="formControlCategory" class="form-label">Product Category</label>
            <select class="form-select mb-3" action="formProduct" name="category_id">
              <?php foreach ($data['categories'] as $category) : ?>
                <option value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label for="formControlProductStatus" class="form-label">Product Status</label>
            <select class="form-select" form="formProduct" name="product_status">
              <option value="0">Inactive</option>
              <option value="1">Active</option>
            </select>
          </div>

          <div class="d-flex gap-2">
            <input class="w-100 btn btn-success btn-lg" type="submit" value="Edit Product">
            <a class="w-100 btn btn-danger btn-lg" href="<?php echo URLROOT; ?>/products" role="button"> Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>

</main>

<?php require APPROOT . '/views/admins/inc/footer.php'; ?>