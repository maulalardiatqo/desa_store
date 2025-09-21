<div class="content-body">
    <div class="container-fluid">

        <!-- row -->
        <div class="col-lg-12">
            <div class="card">
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row page-titles">
                                <div class="d-flex justify-content-between">
                                    <div class="judul">
                                        <h4 class="card-title">Detail Presensi</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama Siswa</th>
                                            <th>Date</th>
                                            <th>Waktu Masuk</th>
                                            <th>Waktu Keluar</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($siswa as $p) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $p['nis'] ?></td>
                                            <td><?= $p['nama_siswa'] ?></td>
                                            <td><?= $date ?></td>

                                            <?php if ($p['presensi']) : ?>
                                                <td><?= $p['presensi']['time_in'] ?></td>
                                                <td><?= $p['presensi']['time_out'] ?></td>
                                                <td><?= $p['presensi']['status'] ?></td>
                                                <td><?= $p['presensi']['keterangan'] ?? '-' ?></td>
                                                <td>
                                                    <div class="d-flex">
                                                   <button type="button"
                                                          class="btn btn-primary btn-sm open-edit-modal"
                                                          data-id="<?= $p['presensi']['id_presensi'] ?>"
                                                          data-nis="<?= $p['nis'] ?>"
                                                          data-nama="<?= $p['nama_siswa'] ?>"
                                                          data-date="<?= $date ?>"
                                                          data-timein="<?= $p['presensi']['time_in'] ?>"
                                                          data-timeout="<?= $p['presensi']['time_out'] ?>"
                                                          data-status="<?= $p['presensi']['status'] ?>"
                                                          data-keterangan="<?= $p['presensi']['keterangan'] ?? '-' ?>">
                                                      Edit
                                                  </button>

                                                    </div>
                                                </td>
                                            <?php else : ?>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            <?php endif; ?>
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

<div class="modal fade" id="editPresensiModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('guru/updatePresensi') ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Presensi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">

          <input type="hidden" name="id_presensi" id="modal_id_presensi">

          <div class="mb-3">
            <label>NIS</label>
            <input type="text" class="form-control" id="modal_nis" disabled>
          </div>

          <div class="mb-3">
            <label>Nama Siswa</label>
            <input type="text" class="form-control" id="modal_nama" disabled>
          </div>

          <div class="mb-3">
            <label>Tanggal</label>
            <input type="text" class="form-control" id="modal_date" disabled>
          </div>

          <div class="mb-3">
            <label>Waktu Masuk</label>
            <input type="time" class="form-control" name="time_in" id="modal_timein" step="1">
          </div>

          <div class="mb-3">
            <label>Waktu Keluar</label>
            <input type="time" class="form-control" name="time_out" id="modal_timeout" step="1">
          </div>

          <div class="mb-3">
            <label>Status</label>
            <select class="form-control" name="status" id="modal_status">
              <option value="Hadir">Hadir</option>
              <option value="Sakit">Sakit</option>
              <option value="Izin">Izin</option>
              <option value="Alfa">Alfa</option>
            </select>
          </div>

          <div class="mb-3">
            <label>Keterangan</label>
            <input type="text" class="form-control" name="keterangan" id="modal_keterangan">
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </form>
  </div>
</div>




