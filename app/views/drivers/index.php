<?php require APPROOT . '/views/admins/inc/header.php'; ?>
<?php require APPROOT . '/views/admins/inc/navbar.php'; ?>
<?php require APPROOT . '/views/admins/inc/sidebar.php'; ?>

<main class="container px-4">
  <h1 class="mt-4">Drivers</h1>
  <?php flash('driver_message'); ?>

  <a class="btn btn-primary my-3" href="<?php echo URLROOT; ?>/drivers/add" role="button"><i class="fa-solid fa-plus"></i> Add Driver</a>

  <table id="datatablesSimple">
    <thead>
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Address</th>
        <th>City</th>
        <th>Username</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($data['drivers'] as $driver) : ?>
        <tr>
          <td><?php echo $driver->driver_id; ?></td>
          <td><?php echo $driver->driver_first_name; ?></td>
          <td><?php echo $driver->driver_last_name; ?></td>
          <td><?php echo $driver->driver_email; ?></td>
          <td><?php echo $driver->driver_contact; ?></td>
          <td><?php echo $driver->driver_address; ?></td>
          <td><?php echo $driver->driver_city; ?></td>
          <td><?php echo $driver->driver_username; ?></td>
          <td>
            <?php
            if ($driver->driver_status == 1) {
              echo "on delivery";
            } else {
              echo "available";
            }
            ?>
          </td>
          <td><?php echo $driver->created_at; ?></td>
          <td>
            <a onclick="deleteDriver()" href="<?php echo URLROOT; ?>/drivers/delete/<?php echo $driver->driver_id; ?>" class="btn btn-danger" role="button"><i class="fa-solid fa-trash"></i></a>
          </td>
        </tr>
      <?php endforeach; ?>

    </tbody>
  </table>
</main>

<?php require APPROOT . '/views/admins/inc/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>

<script>
  function deleteDriver() {
    var result = confirm("Are you sure you want to delete the driver?");
    if (result == false) {
      event.preventDefault();
    }
  }

  window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
      new simpleDatatables.DataTable(datatablesSimple);
    }
  });
</script>