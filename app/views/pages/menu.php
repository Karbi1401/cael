<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<main class="container">

  <section class="py-5 text-center container">
    <div class="row py-3">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-bold"><span class="span-orange">Cael's</span> Delivery</h1>
        <p class="lead text-muted">Our collection of tasty, elegant and rich-flavored dishes that surely will leave a good impression that will last for a lifetime.</p>
      </div>
    </div>
  </section>

  <hr>

  <section class="row p-5">
    <?php flash('cart_message'); ?>
    <div class="col-lg-3">
      <div class="row">
        <div class="col-md-6 col-lg-12 mb-5">
          <div class="card" style="width: 18rem;">
            <div class="card-header">
              <h4 class="mb-0 span-orange">Categories</h4>
            </div>
            <ul class="list-group list-group-flush">
              <?php foreach ($data['categories'] as $category) : ?>
                <li class="list-group-item">
                  <a href="<?php echo URLROOT; ?>/pages/category/<?php echo $category->category_id; ?>" class="fs-5"><?php echo $category->category_name; ?></a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>

    </div>

    <div class="col-lg-9">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        <?php foreach ($data['products'] as $product) : ?>

          <div class="col d-flex align-items-stretch">
            <div class="card shadow-sm">
              <img class="img-fluid rounded" src="<?php echo URLROOT; ?>/img/<?php echo $product->product_image; ?>" width="100%" height="225">
              <div class="card-body">
                <h4><?php echo $product->product_name; ?></h4>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="gap-3">
                    <a href="<?php echo URLROOT; ?>/pages/details/<?php echo $product->product_id; ?>" class="btn btn-orange" role="button"><i class="fa-solid fa-circle-info"></i></a>
                    <a href="<?php echo URLROOT; ?>/carts/add/<?php echo $product->product_id; ?>/<?php echo $product->product_price; ?>" class="btn btn-orange" role="button"><i class="fa-solid fa-cart-shopping"></i></a>
                  </div>
                  <h5>&#8369;<?php echo $product->product_price; ?></h5>
                </div>
              </div>
            </div>
          </div>

        <?php endforeach; ?>

      </div>
    </div>
  </section>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>