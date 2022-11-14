<?php require APPROOT . '/views/admins/inc/header.php'; ?>
<?php require APPROOT . '/views/admins/inc/navbar.php'; ?>
<?php require APPROOT . '/views/admins/inc/sidebar.php'; ?>

<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Orders</h1>
    <?php flash('orders_message'); ?>
    <?php
    if (!empty($data['orders'])) : ?>
      <table id="datatablesSimple">
        <thead>
          <tr>
            <th>ID</th>
            <th>Customer First Name</th>
            <th>Customer Last Name</th>
            <th>Shipping ID</th>
            <th>Payment Method</th>
            <th>Order Total</th>
            <th>Order Status</th>
            <th>Payment Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['orders'] as $order) : ?>
            <tr>
              <td><?php echo $order->order_id; ?></td>
              <td><?php echo $order->user_first_name; ?></td>
              <td><?php echo $order->user_last_name; ?></td>
              <td><?php echo $order->shipping_id; ?></td>
              <td><?php echo $order->payment_method; ?></td>
              <td>&#8369;<?php echo $order->order_total; ?></td>
              <td>
                <?php
                if ($order->order_status == 0) {
                  echo "pending";
                } elseif ($order->order_status == 1) {
                  echo "completed";
                }
                ?>
              </td>
              <td>
                <?php
                if ($order->payment_status == 0) {
                  echo "pending";
                } elseif ($order->order_status == 1) {
                  echo "completed";
                }
                ?>
              </td>
              <td>
                <a href="<?php echo URLROOT; ?>/orders/details/<?php echo $order->order_id; ?>" class="btn btn-primary" role="button">
                  <i class="fa-solid fa-info text-white"></i>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else : ?>
      <div class="d-flex flex-column align-items-center justify-content-center">
        <h2 class="fw-bold"><i class="fa-solid fa-list-check"></i></h2>
        <h2 class="fw-bold">There are no current orders</h2>
      </div>
    <?php endif; ?>
  </div>
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