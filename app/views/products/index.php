<?php require APPROOT . '/views/admins/inc/header.php'; ?>
<?php require APPROOT . '/views/admins/inc/navbar.php'; ?>
<?php require APPROOT . '/views/admins/inc/sidebar.php'; ?>


<main class="container px-4">
  <h1 class="mt-4">Products</h1>
  <?php flash('product_message'); ?>
  <a class="btn btn-primary my-3" href="<?php echo URLROOT; ?>/products/add" role="button"><i class="fa-solid fa-plus"></i> Add Product</a>
  <table id="datatablesSimple">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Description</th>
        <th>Image</th>
        <th>Status</th>
        <th>Category</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($data['products'] as $product) : ?>
        <tr>
          <td><?php echo $product->product_id; ?></td>
          <td><?php echo $product->product_name; ?></td>
          <td><?php echo $product->product_price; ?></td>
          <td><?php echo $product->product_description; ?></td>
          <td><img class='img-fluid' src='<?php echo URLROOT; ?>/public/img/<?php echo $product->product_image; ?>' alt='image' width='100'></td>
          <td>
            <?php
            if ($product->product_status == 1) {
              echo "Active";
            } elseif ($product->product_status == 0) {
              echo "Inactive";
            }
            ?>
          </td>
          <td><?php echo $product->categoryName; ?></td>
          <td>
            <a class="btn btn-success" href="<?php echo URLROOT; ?>/products/edit/<?php echo $product->product_id; ?>" role="button"><i class="fa-solid fa-pen-to-square"></i>
            </a>
          </td>
          <td>
            <a onclick="deleteProduct()" href="<?php echo URLROOT; ?>/products/delete/<?php echo $product->product_id; ?>" class="btn btn-danger" role="button"><i class="fa-solid fa-trash"></i></a>
          </td>
        </tr>
      <?php endforeach; ?>

    </tbody>
  </table>
</main>

<?php require APPROOT . '/views/admins/inc/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>

<script>
  function deleteProduct() {
    var result = confirm("Are you sure you want to delete the product?");
    if (result == false) {
      event.preventDefault();
    }
  }

  window.addEventListener('DOMContentLoaded', event => {

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
      new simpleDatatables.DataTable(datatablesSimple);
    }
  });
</script>