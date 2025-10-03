<section>
  <footer id="footer" class="bg-dark text-light pt-5 pb-3">
    <div class="container">
      <div class="row">
        <!-- Contact Info -->
        <div class="col-lg-4 col-md-6 mb-4">
          <h5 class="text-uppercase mb-3">Contact U</h5>
          <p>
            <i class="fas fa-envelope me-2"></i>
            <a href="mailto:yourinfo@gmail.com" class="text-decoration-none text-light"><?=$contact->email ?? ''?></a>
          </p>
          <p>
            <i class="fas fa-phone-alt me-2"></i>
            <a href="tel:+5511122233344" class="text-decoration-none text-light"><?= $contact->whatsapp ?? ''?></a>
          </p>
        </div>

        <!-- Social Media -->
        <div class="col-lg-4 col-md-6 mb-4">
          <h5 class="text-uppercase mb-3">Follow Us</h5>
          <div class="d-flex gap-3">
            <a href="<?=$contact->facebook ?? ''?>" target="_blank" class="text-light fs-4">
              <i class="fab fa-facebook"></i>
            </a>
            <a href="<?=$contact->instagram?? ''?>" target="_blank" class="text-light fs-4">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="https://wa.me/<?= $contact->whatsapp ?? '' ?>"  target="_blank" class="text-light fs-4">
              <i class="fab fa-whatsapp"></i>
            </a>
            <a href="mailto:<?=$contact->email ?? ''?>" target="_blank" class="text-light fs-4">
              <i class="fas fa-envelope"></i>
            </a>
          </div>
        </div>
      </div>

      <hr class="border-light">
      <div class="text-center">
        <small>&copy; 2025 KWT Desa Kajen Kecamatan Talang.</small>
      </div>
    </div>
  </footer>
</section>

<!-- Tambahkan link Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">



    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
  const swiper = new Swiper(".main-swiper", {
    loop: true,
    effect: "fade",
    fadeEffect: {
      crossFade: true, // biar lebih smooth
    },
    autoplay: {
      delay: 3000, // 3 detik per slide
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-arrow-next",
      prevEl: ".swiper-arrow-prev",
    },
  });
</script>

  </body>
</html>