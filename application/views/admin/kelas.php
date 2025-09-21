<div class="content-body">
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Kelas</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form class="needs-validation" novalidate="" action="<?= base_url('admin/tambahKelas') ?>" method="POST">
                            <div class="row">
                                <div class="col-xl-6">
                                     <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="nama_kelas">Nama Kelas
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Nama Kelas.." required="">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xl-6">

                                    <div class="mb-3 row">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="id_guru">Wali Kelas
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="default-select wide form-control" id="id_guru" name="id_guru">
                                                    <option data-display="Select">Please select</option>
                                                    <?php foreach ($guru as $g) : ?>
                                                        <option value="<?= $g['id_guru'] ?>"><?= $g['nama_guru'] ?></option>
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
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Kelas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kelas</th>
                                        <th>Wali Kelas</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($kelas as $p) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $p['nama_kelas'] ?></td>
                                            <td><?= $p['nama_guru'] ?></td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="<?= base_url('admin/editKelas/' . $p['id_kelas']) ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="<?= base_url('admin/hapusKelas/' . $p['id_kelas']) ?>" class="btn btn-danger shadow btn-xs sharp tombol-hapus"><i class="fa fa-trash "></i></a>
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

