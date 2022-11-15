<?php require APPROOT . '/views/admins/inc/header.php'; ?>
<?php require APPROOT . '/views/admins/inc/navbar.php'; ?>
<?php require APPROOT . '/views/admins/inc/sidebar.php'; ?>

<main class="container px-4">
  <h1 class="mt-4">Users</h1>
  <?php flash('users_message'); ?>

  <table id="datatablesSimple">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Address</th>
        <th>City</th>
        <th>User Image</th>
        <th>User Role</th>
        <th>Edit Role</th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($data['users'] as $user) : ?>
        <tr>
          <td><?php echo $user->user_first_name; ?></td>
          <td><?php echo $user->user_last_name; ?></td>
          <td><?php echo $user->user_email; ?></td>
          <td><?php echo $user->user_contact; ?></td>
          <td><?php echo $user->user_address; ?></td>
          <td><?php echo $user->user_city; ?></td>
          <td>
            <img class='img-fluid' src='<?php echo URLROOT; ?>/public/img/<?php echo $user->user_image; ?>' alt='image' width='100'>
          </td>
          <td><?php echo $user->user_role; ?></td>
          <td>
            <a class="btn btn-success" href="<?php echo URLROOT; ?>/users/editrole/<?php echo $user->user_id; ?>" role="button"><i class="fa-solid fa-pen-to-square"></i>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>

    </tbody>
  </table>
</main>

<?php require APPROOT . '/views/admins/inc/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>

<script>
  window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
      new simpleDatatables.DataTable(datatablesSimple);
    }
  });
</script>