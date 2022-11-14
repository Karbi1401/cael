<?php require APPROOT . '/views/admins/inc/header.php'; ?>
<?php require APPROOT . '/views/admins/inc/navbar.php'; ?>
<?php require APPROOT . '/views/admins/inc/sidebar.php'; ?>

<main>
  <div class="container-fluid px-4">
    <h1 class="my-4">Assign Delivery Driver</h1>
    <div class="row align-items-center">
      <div class="col mx-auto">
        <form class="p-4 p-md-5 border rounded-3 bg-light" action="<?php echo URLROOT; ?>/orders/assignDriver/<?php echo $data['id']; ?>" method="POST" id="formDelivery" enctype="multipart/form-data">

          <div class="mb-3">
            <label for="driver_id" class="mb-3">Select delivery driver:</label>
            <select class="form-select" name="driver_id" id="driver_id" form="formDelivery">
              <?php foreach ($data['delivery_drivers'] as $drivers) : ?>
                <option value="<?php echo $drivers->driver_id; ?>"><?php echo $drivers->driver_first_name . " " . $drivers->driver_last_name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="d-flex gap-2">
            <input class="w-100 btn btn-success btn-lg" type="submit" value="Assign Delivery Driver">
            <a class="w-100 btn btn-danger btn-lg" href="<?php echo URLROOT; ?>/orders" role="button"> Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>

</main>

<?php require APPROOT . '/views/admins/inc/footer.php'; ?>