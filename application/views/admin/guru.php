<div class="content-body">
    <div class="container-fluid">
        <!-- row -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Guru</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form class="needs-validation" method="POST" action="<?= base_url('admin/tambahGuru') ?>">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="kode_guru">Kode <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="kode_guru" name="kode_guru" placeholder="Kode Guru.." required pattern="^\S+$" title="Tidak boleh mengandung spasi">

                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="nama_guru">Nama <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="nama_guru" name="nama_guru" placeholder="Nama Guru.." required="">
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
                            <h4 class="card-title">Daftar Guru</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($guru as $p) : ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $p['kode_guru'] ?></td>
                                                <td><?= $p['nama_guru'] ?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="<?= base_url('admin/editGuru/') . $p['id_guru'] ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="<?= base_url('admin/hapusGuru/') . $p['id_guru'] ?>" class="btn btn-danger shadow btn-xs sharp tombol-hapus"><i class="fa fa-trash"></i></a>
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