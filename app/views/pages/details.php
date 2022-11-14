<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<main>
  <div class="container col-xxl-8 px-4 py-5">
    <div class="card border rounded-3 shadow-sm">
      <div class="card-body">
        <div class="row flex-lg align-items-center g-5 py-5">
          <div class="col-10 col-sm-8 col-lg-6">
            <img src="<?php echo URLROOT; ?>/img/<?php echo $data['products']->product_image; ?>" class="d-block mx-lg-auto img-fluid rounded" alt="Bootstrap Themes" width="100%" loading="lazy">
          </div>
          <div class="col-lg-6">
            <h1 class="display-5 fw-bold lh-1 mb-3"><?php echo $data['products']->product_name; ?></h1>
            <p class="lead fs-2 fw-bold span-orange">&#8369;<?php echo $data['products']->product_price; ?></p>
            <p class="lead"><?php echo $data['products']->product_description; ?></p>
            <div class="d-grid">
              <a href="<?php echo URLROOT; ?>/carts/add/<?php echo $data['products']->product_id; ?>/<?php echo $data['products']->product_price; ?>" class="btn btn-orange btn-lg px-4 me-md-2" role="button"><i class="fa-solid fa-cart-shopping"></i> Add to cart</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>