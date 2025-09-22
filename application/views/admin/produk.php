<?php function decimalToCurrency($value) {
    return 'Rp. ' . number_format($value, 0, ',', '.');
}
?>
<div class="content-body">
    <div class="container-fluid">
        <!-- row -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Product</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form class="needs-validation" method="POST" action="<?= base_url('admin/addProduct') ?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="product_code">Kode Produk <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Kode Product" required pattern="^\S+$" title="Tidak boleh mengandung spasi">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="product_name">Nama Produk <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Nama Product" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row"> 
                                        <label class="col-lg-4 col-form-label" for="price">Harga <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="price" name="price" placeholder="Rp..." required>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="desc">Deskripsi <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="desc" name="desc" placeholder="Deskripsi Produk" required="">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="stok">Stok <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="stok" name="stok" placeholder="Stok" required="">
                                        </div>
                                    </div>

                                    <!-- Tambahan upload gambar -->
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="product_image">Upload Gambar <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*" required>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-lg-8 ms-auto">
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Daftar Produk</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Pruduk</th>
                                            <th>Nama Produk</th>
                                            <th>Harga</th>
                                            <th>Deskripsi</th>
                                            <th>Gambar</th>
                                            <th>Stock</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($produk as $p) : ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $p['product_code'] ?></td>
                                                <td><?= $p['product_name'] ?></td>
                                                <td><?= decimalToCurrency($p['price']) ?></td>
                                                <td><?= $p['desc'] ?></td>
                                                <td>
                                                    <img src="<?= base_url('assets/products/' . $p['product_picture']) ?>" 
                                                        alt="<?= $p['product_name'] ?>" 
                                                        width="100">
                                                </td>
                                                <td><?= $p['jumlah'] ?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <button type="button" 
                                                                class="btn btn-primary shadow btn-xs sharp me-1" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#editProductModal<?= $p['id_product'] ?>">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                        <a href="<?= base_url('admin/hapusProduct/') . $p['id_product'] ?>" class="btn btn-danger shadow btn-xs sharp tombol-hapus"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Modal Edit -->
        <div class="modal fade" id="editProductModal<?= $p['id_product'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?= base_url('admin/updateProduct/' . $p['id_product']) ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                            <div class="mb-3">
                                <label>Kode Produk</label>
                                <input type="text" name="product_code" class="form-control" 
                                       value="<?= $p['product_code'] ?>" readonly>
                            </div>
                            
                            <div class="mb-3">
                                <label>Nama Produk</label>
                                <input type="text" name="product_name" class="form-control" 
                                       value="<?= $p['product_name'] ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label>Harga</label>
                                <input type="number" name="price" class="form-control" 
                                       value="<?= $p['price'] ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label>Deskripsi</label>
                                <textarea name="desc" class="form-control" rows="3"><?= $p['desc'] ?></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label>Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" 
                                       value="<?= $p['jumlah'] ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label>Gambar Produk</label><br>
                                <img src="<?= base_url('assets/products/' . $p['product_picture']) ?>" 
                                     alt="<?= $p['product_name'] ?>" 
                                     width="120" class="mb-2"><br>
                                <input type="file" name="product_picture" class="form-control">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar</small>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>