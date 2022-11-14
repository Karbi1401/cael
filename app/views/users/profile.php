<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<?php
$total = 0;
$qty = 0;
?>
<main>
  <div class="container p-5">
    <h1 class="mt-3 span-orange">Profile</h1>
    <?php flash('user_message') ?>
    <div class="row mt-5">

      <div class="col-lg-4">

        <div class="card shadow-sm h-100">
          <div class="card-body text-center">
            <?php if (empty($data['users']->user_image)) : ?>
              <img style='height:150px;width:150px' class="img-thumbnail rounded-circle card-img-top" src="<?php echo URLROOT; ?>/public/img/default_avatar.png" alt="Card image cap">
            <?php else : ?>
              <img style='height:150px;width:150px' class="img-thumbnail rounded-circle card-img-top" src="<?php echo URLROOT; ?>/public/img/<?php echo $data['users']->user_image; ?>" alt="Card image cap">
            <?php endif; ?>
            <h4>
              <a href="<?php echo URLROOT; ?>/users/avatar/<?php echo $data['users']->user_id; ?>" class="btn btn-orange mt-3" role="button">
                <i class="fa-solid fa-pen-to-square"></i> Edit
              </a>
            </h4>
            <ul class="list-group list-group-flush rounded-3">
              <li class="list-group-item">
                <span class="fw-bold">User ID:</span> <?php echo $data['users']->user_id; ?>
              </li>
              <li class="list-group-item">
                <span class="fw-bold">Username:</span> <?php echo $data['users']->user_username; ?>
              </li>
            </ul>
          </div>
        </div>

      </div>

      <div class="col-lg-8">

        <div class="card shadow-sm h-100">
          <div class="card-header">
            <h4 class="mb-0 span-orange py-3">User Details</h4>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush rounded-3">
              <li class="list-group-item">
                <span class="fw-bold span-orange">First Name:</span> <?php echo $data['users']->user_first_name; ?>
              </li>
              <li class="list-group-item">
                <span class="fw-bold span-orange">Last Name:</span> <?php echo $data['users']->user_last_name; ?>
              </li>
              <li class="list-group-item">
                <span class="fw-bold span-orange">Email:</span> <?php echo $data['users']->user_email; ?>
              </li>
              <li class="list-group-item">
                <span class="fw-bold span-orange">Contact:</span> <?php echo $data['users']->user_contact; ?>
              </li>
              <li class="list-group-item">
                <span class="fw-bold span-orange">Address:</span> <?php echo $data['users']->user_address; ?>
              </li>
              <li class="list-group-item">
                <span class="fw-bold span-orange">City:</span> <?php echo $data['users']->user_city; ?>
              </li>
              <li class="list-group-item text-end">
                <a href="<?php echo URLROOT; ?>/users/edit/<?php echo $data['users']->user_id; ?>" class="btn btn-orange" role="button">
                  <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
              </li>
            </ul>
          </div>
        </div>

      </div>

    </div>

    <div class="row mt-5">

      <div class="col-lg-12">

        <div class="card shadow-sm h-100">
          <div class="card-header py-3">
            <h4 class="mb-0 span-orange">
              Your Order History
            </h4>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush rounded-3">
              <?php if (!empty($data['orders'])) : ?>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Food Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Order Created</th>
                        <th scope="col">Order Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($data['orders'] as $order) : ?>
                        <tr>
                          <td><?php echo $order->order_id; ?></td>
                          <td><?php echo $order->product_name; ?></td>
                          <td>&#8369;<?php echo $order->product_price; ?></td>
                          <td><?php echo $order->quantity; ?></td>

                          <td>&#8369;<?php echo $order->product_price * $order->quantity; ?></td>
                          <td><?php echo $order->created_at; ?></td>
                          <td>
                            <?php
                            if ($order->order_status == 1) {
                              echo "completed";
                            } elseif ($order->order_status == 0) {
                              echo "pending";
                            }
                            ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              <?php else : ?>
                <li class="list-group-item">
                  <h5>
                    <i class="fa-solid fa-ban text-danger"></i> No past orders recorded
                  </h5>
                </li>
            </ul>
          <?php endif; ?>
          </div>
        </div>

      </div>
    </div>
  </div>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>