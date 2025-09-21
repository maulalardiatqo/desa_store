<div class="content-body">
    <div class="container-fluid">

        <!-- row -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Input Presensi Siswa Manual</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                            <form class="needs-validation" novalidate="" action="<?= base_url('guru/inputPresensi') ?>" method="POST">
                                <div class="row">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="date">Tanggal
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="date" class="form-control" id="date" name="date" required="">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="id_siswa">Pilih Siswa
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="default-select wide form-control" id="id_siswa" name="id_siswa">
                                                    <option data-display="Select">Please select</option>
                                                    <?php foreach ($siswa as $k) : ?>
                                                        <option value="<?= $k['id_siswa']; ?>"><?= $k['nama_siswa'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="status">Status
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="default-select wide form-control" id="status" name="status">
                                                    <option data-display="Select">Please select</option>
                                                    <option value="Hadir">Hadir</option>
                                                    <option value="Izin">Izin</option>
                                                    <option value="Sakit">Sakit</option>
                                                </select>
                                            </div>
                                        </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="keterangan">Keterangan
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" required="">
                                                </div>
                                            </div>
                                        <div class="mb-3 row">
                                            <div class="col-lg-8 ms-auto">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>