<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<div role="alert" aria-live="assertive" aria-atomic="true" class="toast fixed-bottom m-5 ms-auto" data-bs-autohide="false">
  <div class="toast-header">
    <img src="<?php echo URLROOT; ?>/img/logo-dark.png" height="40px" width="40px" class="rounded me-2" alt="...">
    <strong class="me-auto">Cael's Delivery</strong>
    <small>Just now</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    Welcome to Cael's Delivery
  </div>
</div>

<main>
  <section class="bg-paralax">
    <div class="container col-xxl-8 px-4 py-5">
      <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
          <img src="<?php echo URLROOT; ?>/img/hero.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
        </div>
        <div class="col-lg-6">
          <h1 class="display-5 fw-bold lh-1 mb-3"><span class="span-orange">Cael's</span> Delivery</h1>
          <p class="lead">Cael's Delivery is a family business that not just caters delicious foods, but lives with the perspective that nothing makes people closer together like pleasure and laughter.</p>
          <a href="<?php echo URLROOT; ?>/pages/menu" class="btn btn-orange btn-lg px-4 me-md-2" role="button"><i class="fa-solid fa-arrow-right"></i> See Full Menu</a>
        </div>
      </div>
    </div>
  </section>

  <section class="container py-5">
    <h1 class="text-center fw-bold lh-1 display-5">You are our top priority</h1>
    <div class="row pt-5">
      <div class="col-lg-6 text-center">
        <h2 class="fw-bold mb-3">Mission</h2>
        <i class="fa-solid fa-bullseye fa-3x mb-3"></i>
        <p class="lead text-start">Cael's Party Mania is dedicated in providing an excellent and successful event service with creativity and originality that leaves the best impression to everyone.</p>
      </div>
      <div class="col-lg-6 text-center">
        <h2 class="fw-bold mb-3">Vision</h2>
        <i class="fa-sharp fa-solid fa-eye fa-3x mb-3"></i>
        <p class="lead text-start">Cael's Party Mania's vision is to be one of the most well-known event organizing company that meets the highest quality of service that exceeds customers expectations.</p>
      </div>
    </div>
  </section>

  <section class="container my-5">
    <div class="jumbotron row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border">
      <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
        <figure>
          <blockquote class="blackquote lead">
            <i class="fa-sharp fa-solid fa-quote-left"></i> Excellent food. Menu is extensive and seasonal to a particularly high standard. Definitely fine dining. The price is worth it and they do different deals on different nights so it's worth checking them out before you book. Highly recommended! <i class="fa-solid fa-quote-right"></i>
          </blockquote>
          <figcaption class="blockquote-footer">
            Maria C.
          </figcaption>
        </figure>
      </div>
      <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
        <img class="rounded-lg-3" src="<?php echo URLROOT; ?>/img/jumbotron.jpg" alt="" width="550">
      </div>
    </div>
  </section>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>