<?php require APPROOT . '/views/admins/inc/header.php'; ?>
<?php require APPROOT . '/views/admins/inc/navbar.php'; ?>
<?php require APPROOT . '/views/admins/inc/sidebar.php'; ?>


<main class="container px-4">
  <h1 class="mt-4">Categories</h1>
  <?php flash('category_message'); ?>

  <a class="btn btn-primary my-3" href="<?php echo URLROOT; ?>/categories/add" role="button"><i class="fa-solid fa-plus"></i> Add Category</a>

  <table id="datatablesSimple">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Created By</th>
        <th scope="col">Status</th>
        <th scope="col">Created At</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($data['categories'] as $category) : ?>
        <tr>
          <td><?php echo $category->category_id; ?></td>
          <td><?php echo $category->category_name; ?></td>
          <td><?php echo $category->user_last_name; ?></td>
          <td>
            <?php
            if ($category->category_status == 1) {
              echo "active";
            } else {
              echo "inactive";
            }
            ?>
          </td>
          <td><?php echo $category->categoryCreated; ?></td>
          <td>
            <a class="btn btn-success" href="<?php echo URLROOT; ?>/categories/edit/<?php echo $category->category_id; ?>" role="button"><i class="fa-solid fa-pen-to-square"></i>
            </a>
          </td>
          <td>
            <a onclick="deleteCategory()" href="<?php echo URLROOT; ?>/categories/delete/<?php echo $category->category_id; ?>" class="btn btn-danger" role="button"><i class="fa-solid fa-trash"></i></a>
          </td>
        </tr>
      <?php endforeach; ?>

    </tbody>
  </table>
</main>

<?php require APPROOT . '/views/admins/inc/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>

<script>
  function deleteCategory() {
    var result = confirm("Are you sure you want to delete the category?");
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