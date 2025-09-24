<?php function decimalToCurrency($value) {
    return 'Rp. ' . number_format($value, 0, ',', '.');
}
?>
   
   <section class="padding-large">
    <div style="height: 30px;">
            
          </div>
    <div class="container">
        <div class="catalog" id="catalog">
          
      <?php foreach ($produk as $p) : ?>
        <div class="product-card">
  <img src="<?= base_url('assets/products/' . $p['product_picture']) ?>" 
       alt="<?= $p['product_name']?>" class="product-image">
  <div class="product-content">
    <h3 class="product-name"><?=$p['product_name']?></h3>
    <p class="product-price"><?= decimalToCurrency($p['price'])?></p>
    <p class="product-desc"><?= $p['desc_product']?></p>
    
    <?php 
      $waNumber = $whatsapp;
      $message = "Halo, saya ingin memesan produk:\n" .
                 "Nama: " . $p['product_name'] . "\n" .
                 "Harga: " . decimalToCurrency($p['price']) . "\n" .
                 "Deskripsi: " . $p['desc_product'];
      $waUrl = "https://wa.me/$waNumber?text=" . urlencode($message);
    ?>
    
    <a href="<?= $waUrl ?>" target="_blank">
      <button class="btn-order">Pesan</button>
    </a>
  </div>
</div>

       
        <?php endforeach ?>
    </div>
    </div>
       
   </section> 
   



