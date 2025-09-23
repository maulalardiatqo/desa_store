<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <header>
    <h1>Katalog Produk</h1>
  </header>
  <main>
    <div class="catalog" id="catalog"></div>
  </main>

  <script>
    const products = <?= json_encode($produk) ?>
    console.log('product', product)
    const catalog = document.getElementById("catalog");

    products.forEach(product => {
      const card = document.createElement("div");
      card.className = "product-card";

      card.innerHTML = `
        <img src="<?= base_url('assets/product/' . $product['product_picture'])?>" alt="${product.product_name}" class="product-image">
        <div class="product-content">
          <h3 class="product-name">${product.name}</h3>
          <p class="product-price">${product.price}</p>
          <p class="product-desc">${product.desc}</p>
          <button class="btn-order">Pesan</button>
        </div>
      `;

      catalog.appendChild(card);
    });
  </script>
</body>

</html>