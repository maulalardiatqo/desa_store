<div class="content-body">
    <div class="container-fluid">

        <!-- row -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Guru</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <?php foreach ($guru as $s) : ?>
                            <form class="needs-validation" novalidate="" action="<?= base_url('admin/updateGuru/' . $s['kode_guru']) ?>" method="POST">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="kode_guru">Kode
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" readonly class="form-control" id="kode_guru" name="kode_guru" value="<?= $s['kode_guru'] ?>" required="">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="nama">Nama
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="<?= $s['nama_guru'] ?>" required="">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-lg-8 ms-auto">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>