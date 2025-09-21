<div class="content-body">
    <div class="container-fluid">

        <!-- row -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Siswa</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <?php foreach ($siswa as $s) : ?>
                            <form class="needs-validation" novalidate="" action="<?= base_url('admin/updateSiswa/' . $s['id_siswa']) ?>" method="POST">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="nama_siswa">Nama
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $s['nama_siswa'] ?>" required="">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="nis">NIS
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="nis" name="nis" value="<?= $s['nis'] ?>" required="" readonly>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="gender">Gender
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="default-select wide form-control" id="gender" name="gender" value="<?= $s['gender'] ?>">
                                                    <option data-display="Select">Please select</option>
                                                    <option value="1" <?= $s['jenis_kelamin'] == '1' ? 'selected' : '' ?>>Laki - Laki</option>
                                                    <option value="2" <?= $s['jenis_kelamin'] == '2' ? 'selected' : '' ?>>Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">

                                        
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="kelas">Kelas
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="default-select wide form-control" id="kelas" name="kelas">
                                                    <option data-display="Select">Please select</option>
                                                    <?php foreach ($kelas as $k) : ?>
                                                        <option value="<?= $k['id_kelas']; ?>"><?= $k['nama_kelas'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-lg-6">
                                                <a href="<?= base_url('admin/registerRfid/') . $s['id_siswa'] ?>" class="btn btn-success btn-sm">Register Ulang</a>
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