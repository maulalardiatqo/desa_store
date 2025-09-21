<div class="content-body">
    <div class="container-fluid">

        <!-- row -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Kelas</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <?php foreach ($kelas as $s) : ?>
                            <form class="needs-validation" novalidate="" action="<?= base_url('admin/updateKelas/' . $s['id_kelas']) ?>" method="POST">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="nama">Tingkat
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="<?= $s['nama_kelas'] ?>" required="">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="nama">Wali Kelas
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="default-select wide form-control" id="id_guru" name="id_guru">
                                                <option data-display="Select">Please select</option>
                                                <?php foreach ($guru as $k) : ?>
                                                    <option value="<?= $k['id_guru']; ?>"><?= $k['nama_guru'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                 <div class="mb-3 row">
                                            <div class="col-lg-8 ms-auto">
                                                <button type="submit" class="btn btn-primary">Update</button>
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