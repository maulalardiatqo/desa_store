<div class="content-body">
    <div class="container-fluid">

        <!-- row -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Reset Password</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <?php foreach ($userS as $s) : ?>
                            <form class="needs-validation" novalidate="" action="<?= base_url('admin/resetPassword/' . $s['id']) ?>" method="POST">
                                <button type="submit" class="btn btn-success">Reset Password</button>
                                <span>Jika menekan tombol ini password akan di reset menjadi : <b style="color:aliceblue;">Smekal123</b></span>
                            </form>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="card-header">
                    <h4 class="card-title">Edit User</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <?php foreach ($userS as $s) : ?>
                            <form class="needs-validation" novalidate="" action="<?= base_url('admin/updateUser/' . $s['id']) ?>" method="POST">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="nama">Nama
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $s['nama'] ?>" required="">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="nis">Username
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="nis" name="nis" value="<?= $s['username'] ?>" required="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="gender">Role Login
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="default-select wide form-control" id="gender" name="gender">
                                                    <option data-display="Select">Please select</option>
                                                    <option value="1">Admin</option>
                                                    <option value="2">Kepala Sekolah</option>
                                                    <option value="3">Waka Kurikulum</option>
                                                    <option value="4">Guru</option>
                                                    <option value="5">Siswa</option>
                                                    <option value="6">Admin PPDB</option>
                                                    <option value="7">Piket Guru</option>
                                                </select>
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