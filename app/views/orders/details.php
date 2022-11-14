<?php require APPROOT . '/views/admins/inc/header.php'; ?>
<?php require APPROOT . '/views/admins/inc/navbar.php'; ?>
<?php require APPROOT . '/views/admins/inc/sidebar.php'; ?>

<main>
  <div class="container-fluid px-4">
    <h1 class="my-4">Order Details</h1>
    <div class="row mb-4">

      <div class="col-6">

        <div class="card">
          <div class="card-header">
            <i class="fa-solid fa-table-list"></i> Shipping Details
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">First Name: <?php echo $data['shipping_first_name']; ?></li>
            <li class="list-group-item">Last Name: <?php echo $data['shipping_last_name']; ?></li>
            <li class="list-group-item">Email: <?php echo $data['shipping_email']; ?></li>
            <li class="list-group-item">Contact: <?php echo $data['shipping_contact']; ?></li>
            <li class="list-group-item">Address: <?php echo $data['shipping_address']; ?></li>
            <li class="list-group-item">City: <?php echo $data['shipping_city']; ?></li>
          </ul>
        </div>

      </div>

      <div class="col-6">

        <div class="card">
          <div class="card-header">
            <i class="fa-solid fa-table-list"></i> Customer Details
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">First Name: <?php echo $data['user_first_name']; ?></li>
            <li class="list-group-item">Last Name: <?php echo $data['user_last_name']; ?></li>
            <li class="list-group-item">Email: <?php echo $data['user_email']; ?></li>
            <li class="list-group-item">Contact: <?php echo $data['user_contact']; ?></li>
            <li class="list-group-item">Address: <?php echo $data['user_address']; ?></li>
            <li class="list-group-item">City: <?php echo $data['user_city']; ?></li>
          </ul>
        </div>

      </div>

    </div>

    <div class="row">
      <div class="col-12">

        <div class="card">
          <div class="card-header">
            <i class="fa-solid fa-table-list"></i> Product Details
          </div>
          <div class="card-body">
            <table class="table" id="datatablesSimple">
              <thead>
                <tr>
                  <th scope="col">Product ID</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Product Price</th>
                  <th scope="col">Product Quantity</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['order_details'] as $order_detail) : ?>
                  <tr>
                    <td><?php echo $order_detail->product_id; ?></td>
                    <td><?php echo $order_detail->product_name; ?></td>
                    <td>&#8369;<?php echo $order_detail->amount; ?></td>
                    <td><?php echo $order_detail->quantity; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php require APPROOT . '/views/admins/inc/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>

<script>
  window.addEventListener('DOMContentLoaded', event => {

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
      new simpleDatatables.DataTable(datatablesSimple);
    }
  });
</script>