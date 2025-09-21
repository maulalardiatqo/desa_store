<div class="content-body">
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Settings</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form class="needs-validation" novalidate="" action="<?= base_url('admin/tambahSetting') ?>" method="POST">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="day">Hari
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="default-select wide form-control" id="day" name="day">
                                                    <option value="" disabled selected>Pilih Hari</option>
                                                    <option value="Senin">Senin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Kamis">Kamis</option>
                                                    <option value="Jum'at">Jum'at</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Minggu">Minggu</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="start_time">Jam Masuk
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <div class="col-lg-6">
                                                <input type="time" class="form-control" id="start_time" name="start_time" required>
                                            </div>

                                        </div>
                                    </div>
                                     <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="end_time">Jam Pulang
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <div class="col-lg-6">
                                                <input type="time" class="form-control" id="end_time" name="end_time" required>
                                            </div>

                                        </div>
                                    </div>
                                     <div class="mb-3 row">
                                        <div class="col-lg-8 ms-auto">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Setting</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Hari</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam keluar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($settings as $p) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $p['day'] ?></td>
                                            <td><?= $p['start_time'] ?></td>
                                            <td><?= $p['end_time'] ?></td>
                                            <td>
                                                <div class="d-flex">
                                                   <button 
                                                        class="btn btn-primary shadow btn-xs sharp me-1 btn-edit-setting" 
                                                        data-id="<?= $p['id_setting'] ?>" 
                                                        data-day="<?= $p['day'] ?>" 
                                                        data-start="<?= $p['start_time'] ?>" 
                                                        data-end="<?= $p['end_time'] ?>" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editModal">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>

                                                    <a href="<?= base_url('admin/haspusSettings/' . $p['id_setting']) ?>" class="btn btn-danger shadow btn-xs sharp tombol-hapus"><i class="fa fa-trash "></i></a>
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

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="<?= base_url('admin/updateSetting') ?>">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Setting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_setting" id="edit-id-setting">
                <div class="mb-3">
                    <label for="edit-day" class="form-label">Hari</label>
                    <select class="form-control" name="day" id="edit-day" disabled>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jum'at">Jum'at</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                    </select>

                </div>
                <div class="mb-3">
                    <label for="edit-start-time" class="form-label">Jam Masuk</label>
                    <input type="time" class="form-control" name="start_time" id="edit-start-time" required>
                </div>
                <div class="mb-3">
                    <label for="edit-end-time" class="form-label">Jam Pulang</label>
                    <input type="time" class="form-control" name="end_time" id="edit-end-time" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.btn-edit-setting');
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const day = this.dataset.day;
            const start = this.dataset.start;
            const end = this.dataset.end;

            document.getElementById('edit-id-setting').value = id;
            document.getElementById('edit-day').value = day;
            document.getElementById('edit-start-time').value = start;
            document.getElementById('edit-end-time').value = end;
        });
    });
});
</script>

