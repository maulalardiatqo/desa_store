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
          <img src="<?= base_url('assets/products/' . $p['product_picture']) ?>" alt="$" class="product-image">
          <div class="product-content">
            <h3 class="product-name"><?=$p['product_name']?></h3>
            <p class="product-price"><?= decimalToCurrency($p['price'])?></p>
            <p class="product-desc"><?= $p['desc']?></p>
            <button class="btn-order">Pesan</button>
          </div>
        </div>
       
        <?php endforeach ?>
    </div>
    </div>
       
   </section> 
   



