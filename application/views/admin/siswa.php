<div class="content-body">
    <div class="container-fluid">

        <!-- row -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Siswa</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form class="needs-validation" novalidate="" action="<?= base_url('admin/tambahSiswa') ?>" method="POST">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="nama_siswa">Nama
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Nama Siswa.." required="">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="nis">NIS
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="nis" name="nis" placeholder="NIS.." required="">
                                        </div>
                                    </div>
                                  
                                </div>
                                <div class="col-xl-6">
                                      <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="jenis_kelamin">Jenis Klamin
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="default-select wide form-control" id="jenis_kelamin" name="jenis_kelamin">
                                                <option data-display="Select">Please select</option>
                                                <option value="1">Laki - Laki</option>
                                                <option value="2">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="id_kelas">Kelas
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="default-select wide form-control" id="id_kelas" name="id_kelas">
                                                <option data-display="Select">Please select</option>
                                                <?php foreach ($kelas as $k) : ?>
                                                    <option value="<?= $k['id_kelas']; ?>"><?= $k['nama_kelas'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
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

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row page-titles">
                                <div class="d-flex justify-content-between">
                                    <div class="judul">
                                        <h4 class="card-title">Daftar Siswa</h4>
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
                                                <th>Nama</th>
                                                <th>NIS</th>
                                                <th>Kelas</th>
                                                <th>Jenis Kelamin</th>
                                                <th>RFID Number</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php foreach ($siswa as $p) : ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $p['nama_siswa'] ?></td>
                                                    <td><?= $p['nis'] ?></td>
                                                    <td><?= $p['nama_kelas'] ?></td>
                                                    <td><?php if ($p['jenis_kelamin'] == 1) {
                                                            echo 'Laki-Laki';
                                                        } else {
                                                            echo 'Perempuan';
                                                        }
                                                        ?></td>
                                                    <td>
                                                        <?php if (!empty($p['rfid_code'])): ?>
                                                            <?= htmlspecialchars($p['rfid_code']) ?>
                                                        <?php else: ?>
                                                            <a href="<?= base_url('admin/registerRfid/') . $p['id_siswa'] ?>" class="btn btn-success btn-sm">Register RFID</a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="<?= base_url('admin/editSiswa/') . $p['id_siswa'] ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                            <a href="<?= base_url('admin/hapusSiswa/') . $p['id_siswa'] ?>" class="btn btn-danger shadow btn-xs sharp tombol-hapus"><i class="fa fa-trash"></i></a>
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
