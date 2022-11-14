<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<?php
$total = 0;
$qty = 0;
?>
<main class="mb-5">
  <div class="container">
    <section class="py-5 text-center container">
      <div class="row py-3">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-bold"><span class="span-orange">Cael's</span> Catering</h1>
          <p class="lead text-muted">Our collection of tasty, elegant and rich-flavored dishes that surely will leave a good impression that will last for a lifetime.</p>
        </div>
      </div>
    </section>

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="span-orange">Your cart</span>
          <span class="badge bg-danger rounded-pill text-white"><?php echo $_SESSION['user_cart']; ?></span>
        </h4>
        <ul class="list-group mb-3">
          <?php foreach ($data['carts'] as $cart) : ?>
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <div class="col-8">
                <h6 class="mb-3"><?php echo $cart->product_name; ?></h6>
                <img class="img-fluid rounded" src="<?php echo URLROOT; ?>/public/img/<?php echo $cart->product_image; ?>" alt="product image">
              </div>
              <div class="col-2">
                <span class="text-muted">&#8369;<?php echo $cart->product_price * $cart->cart_quantity; ?></span>
                <span class="text-muted">Qty: <?php echo $cart->cart_quantity; ?></span>
              </div>
            </li>
            <?php
            $total = $total + ($cart->cart_quantity * $cart->cart_price);
            $qty = $qty + ($cart->cart_quantity);
            ?>
          <?php endforeach; ?>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (PHP)</span>
            <strong>&#8369;<?php echo $total; ?>
            </strong>
          </li>
        </ul>
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3 span-orange">Billing address</h4>
        <form action="<?php echo URLROOT; ?>/carts/checkout" method="POST">

          <div class="row g-3">
            <div class="col-6">

              <label for="firstNameInput" class="form-label">First Name</label>
              <input type="text" class="form-control <?php echo (!empty($data['first_name_err'])) ? 'is-invalid' : ''; ?>" id="firstNameInput" value="<?php echo $data['first_name']; ?>" name="first_name">
              <span class="invalid-feedback"><?php echo $data['first_name_err']; ?></span>

            </div>

            <div class="col-6">

              <label for="lastNameInput" class="form-label">Last Name</label>
              <input type="text" class="form-control <?php echo (!empty($data['last_name_err'])) ? 'is-invalid' : ''; ?>" id="lastNameInput" value="<?php echo $data['last_name']; ?>" name="last_name">
              <span class="invalid-feedback"><?php echo $data['last_name_err']; ?></span>

            </div>

            <div class="col-12">

              <label for="emailInput" class="form-label">Email</label>
              <input type="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" id="emailInput" value="<?php echo $data['email']; ?>" name="email">
              <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>

            </div>

            <div class="col-12">

              <label for="contactInput" class="form-label">Contact</label>
              <input type="text" class="form-control <?php echo (!empty($data['contact_err'])) ? 'is-invalid' : ''; ?>" id="contactInput" value="<?php echo $data['contact']; ?>" name="contact">
              <span class="invalid-feedback"><?php echo $data['contact_err']; ?></span>

            </div>

            <div class="col-12">
              <label for="addressInput" class="form-label">Address</label>
              <input type="text" class="form-control <?php echo (!empty($data['address_err'])) ? 'is-invalid' : ''; ?>" id="addressInput" value="<?php echo $data['address']; ?>" name="address">
              <span class="invalid-feedback"><?php echo $data['address_err']; ?></span>
            </div>

            <div class="col-12">
              <label for="cityInput" class="form-label">City</label>
              <input type="text" class="form-control <?php echo (!empty($data['city_err'])) ? 'is-invalid' : ''; ?>" id="cityInput" value="<?php echo $data['city']; ?>" name="city">
              <span class="invalid-feedback"><?php echo $data['city_err']; ?></span>
            </div>

            <hr class="my-4">

            <h3 class="mb-3 span-orange">Payment <span class="text-danger">*</span></h3>
            <div class="my-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_method" id="flexRadioCOD" value="cash" required>
                <label class="form-check-label" for="flexRadioCOD">
                  Cash on delivery
                </label>
              </div>
              <br>

              <hr class="my-4">

              <div class="form-group">
                <input type="hidden" name="qty" value='<?php echo $qty; ?>'>
                <input type="hidden" name="total" value='<?php echo $total; ?>'>
                <input type="submit" value='Buy Now' class="w-100 btn btn-orange btn-lg">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>