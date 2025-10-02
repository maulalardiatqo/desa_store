
    <section id="billboard" class="position-relative overflow-hidden bg-light-blue">
  <div class="swiper main-swiper">
    <div class="swiper-wrapper">
      
      <!-- Slide 1 -->
       <?php foreach($foto_desa as $f): ?>
      <div class="swiper-slide">
        <div class="image-holder">
          <img src="<?= base_url('assets/foto_desa/' .$f['foto']); ?>" alt="banner">
        </div>

      </div>
      <?php endforeach; ?>
    </div>

    <!-- Pagination (Titik-titik) -->
    <div class="swiper-pagination"></div>

    <!-- Navigation Arrows -->
    
  </div>
</section>
    <section id="company-services" class="padding-large">
      <div class="container">
        <div class="row">
          <div class="col-lg">
             <h3 class="card-title text-uppercase text-dark">tentang</h3>
              <p class="text-dark"><?=$isi_tentang?></p>
          </div>
        </div>
      </div>
    </section>

   