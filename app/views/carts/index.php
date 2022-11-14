<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<main>
  <section class="h-100">
    <?php if ($data['carts']) : ?>
      <div class="container p-5">
        <div class="row d-flex justify-content-center my-4">
          <?php flash('cart_message'); ?>
          <div class="col-md-8">
            <div class="card mb-4">
              <div class="card-header py-3">
                <h4 class="mb-0 span-orange"><i class="fa-solid fa-cart-shopping"></i> Cart</h4>
              </div>
              <div class="card-body">
                <?php
                $total = 0;
                $qty = 0;
                foreach ($data['carts'] as $cart) :
                ?>
                  <div class="row">
                    <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                      <img src="<?php echo URLROOT; ?>/img/<?php echo $cart->product_image; ?>" class="w-100 rounded img-fluid" alt="Blue Jeans Jacket" />
                    </div>
                    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                      <p class="fs-5"><strong><?php echo $cart->product_name; ?></strong></p>
                      <p class="fs-5">Price: &#8369;<?php echo $cart->product_price; ?></p>
                      <p class="fs-5">Quantity: <?php echo $cart->cart_quantity; ?></p>
                      <a onclick="deleteItem()" href="<?php echo URLROOT; ?>/carts/delete/<?php echo $cart->cart_id; ?>" class="btn btn-danger me-1 mb-2" role="button" data-bs-toggle="tooltip" data-bs-title="Remove Item">
                        <i class="fa-solid fa-trash"></i>
                      </a>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                      <div style=" max-width: 300px">
                        <form action="<?php echo URLROOT; ?>/carts/updateQuantity/<?php echo $cart->product_id; ?>" method="POST" class="d-flex justify-content-between gap-2 mb-5">
                          <div class="form-floating">
                            <input type="number" min="0" class="form-control" id="floatingInputValue" name="quantity">
                            <label for="floatingInputValue">Quantity</label>
                          </div>
                          <input type="submit" value="Set Quantity" class="btn btn-sm btn-orange">
                        </form>
                      </div>
                      <p class="text-start text-md-center fs-5">
                        <strong>Total: &#8369;<?php echo number_format($cart->cart_quantity * $cart->cart_price, 2, '.', ''); ?></strong>
                      </p>
                    </div>
                  </div>
                  <hr class="my-4" />
                <?php
                  $delivery_fee = 50;
                  $total = $total + ($cart->cart_quantity * $cart->cart_price);
                  $qty = $qty + ($cart->cart_quantity);
                endforeach;
                ?>
                <a onclick="clearCart()" href="<?php echo URLROOT; ?>/carts/clear" class="btn btn-danger btn-lg btn-rounded" role="button">
                  Clear Cart
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card mb-4">
              <div class="card-header py-3">
                <h4 class="mb-0 span-orange">Summary</h4>
              </div>
              <div class="card-body">
                <ul class="list-group list-group-flush fs-5">
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                    <strong>Total Items:</strong>
                    <strong><span><?php echo $qty; ?></span></strong>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <strong>Grand Total:</strong>
                    <strong><span>&#8369;<?php echo number_format($total, 2, '.', ''); ?></span></strong>
                  </li>
                </ul>
                <hr>
                <a href="<?php echo URLROOT; ?>/carts/checkout" class="btn btn-orange btn-lg btn-block">
                  Go to checkout
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php else : ?>
      <div class="d-flex flex-column align-items-center justify-content-center text-center vh-100">
        <?php flash('cart_message'); ?>
        <h1 class="display-4 fw-bold span-orange"><i class="fa-solid fa-cart-shopping"></i> Cart</h1>
        <h2 class="display-5 fw-bold">There are no items in the cart</h2>
      </div>
    <?php endif; ?>
  </section>
</main>

<script>
  function deleteItem() {
    var result = confirm("Are you sure you want to delete the item?");
    if (result == false) {
      event.preventDefault();
    }
  }

  function clearCart() {
    var result = confirm("Are you sure you want to clear the items in the cart?");
    if (result == false) {
      event.preventDefault();
    }
  }
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>