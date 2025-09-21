<div class="content-body">
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Hari Libur</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form class="needs-validation" novalidate="" action="<?= base_url('admin/tambahHoliday') ?>" method="POST">
                            <div class="row">
                                <div class="col-xl-6">
                                     <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="nama_event">Nama Event
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="nama_event" name="nama_event" placeholder="Nama Event.." required="">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xl-6">
                                     <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="start_date">Tanggal Mulai
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" id="start_date" name="start_date" required="">
                                        </div>
                                    </div>

                                </div>

                                   <div class="col-xl-6">
                                     <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="keterangan">Keterangan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="keterangant.." required="">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xl-6">
                                     <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="end_date">Tanggal Selesai
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" id="end_date" name="end_date" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <div class="col-lg-8 ms-auto">
                                            <button type="submit" class="btn btn-primary">Tambah</button>
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
                        <h4 class="card-title">Daftar Hari Libur</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Even</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>KKeterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($holiday as $p) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $p['nama_event'] ?></td>
                                            <td><?= $p['start_date'] ?></td>
                                            <td><?= $p['end_date'] ?></td>
                                            <td><?= $p['keterangan'] ?></td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="#" 
                                                        class="btn btn-primary shadow btn-xs sharp me-1 btn-edit"
                                                        data-id="<?= $p['id_libur'] ?>"
                                                        data-nama_event="<?= $p['nama_event'] ?>"
                                                        data-start_date="<?= $p['start_date'] ?>"
                                                        data-end_date="<?= $p['end_date'] ?>"
                                                        data-keterangan="<?= $p['keterangan'] ?>">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <a href="<?= base_url('admin/hapusHoliday/' . $p['id_libur']) ?>" class="btn btn-danger shadow btn-xs sharp tombol-hapus"><i class="fa fa-trash "></i></a>
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

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="<?= base_url('admin/updateHoliday') ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Hari Libur</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_libur" id="edit-id">

          <div class="mb-3">
            <label>Nama Event</label>
            <input type="text" class="form-control" name="nama_event" id="edit-nama_event" required>
          </div>

          <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" class="form-control" name="start_date" id="edit-start_date" required>
          </div>

          <div class="mb-3">
            <label>Tanggal Selesai</label>
            <input type="date" class="form-control" name="end_date" id="edit-end_date" required>
          </div>

          <div class="mb-3">
            <label>Keterangan</label>
            <input type="text" class="form-control" name="keterangan" id="edit-keterangan" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </div>
    </form>
  </div>
</div>
