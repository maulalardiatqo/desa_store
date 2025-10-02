<div class="content-body">
    <div class="container-fluid">
        <!-- row -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Gambar</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form class="needs-validation" method="POST" action="<?= base_url('admin/addFotoDesa') ?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-xl-6">
                                <!-- Tambahan upload gambar -->
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="fotoDesa">Upload Gambar <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="file" class="form-control" id="fotoDesa" name="fotoDesa" accept="image/*" required>
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
                            <h4 class="card-title">Daftar Foto</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php $no = 1; ?>
                                        <?php foreach ($foto_desa as $p) : ?>
                                             <tr>
                                            <td><?= $no ?></td>
                                             <td>
                                                    <img src="<?= base_url('assets/foto_desa/' . $p['foto']) ?>" 
                                                        alt="" 
                                                        width="100">
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                       
                                                        <a href="<?= base_url('admin/deleteFotoDesa/') . $p['id_foto'] ?>" class="btn btn-danger shadow btn-xs sharp tombol-hapus"><i class="fa fa-trash"></i></a>
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

