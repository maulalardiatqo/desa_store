<div class="content-body">
    <div class="container-fluid">
        <!-- row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Pengguna</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>User Role</th>
                                        <th>Date Crate</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($pengguna as $p) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $p['nama'] ?></td>
                                            <td><?= $p['username'] ?></td>
                                            <td><?php if ($p['role_id'] == 1) {
                                                    echo "Admin";
                                                } elseif ($p['role_id'] == 2) {
                                                    echo "Kepala Sekolah";
                                                } elseif ($p['role_id'] == 3) {
                                                    echo "Waka Kurikulum";
                                                } elseif ($p['role_id'] == 4) {
                                                    echo "Guru";
                                                } else {
                                                    echo "Siswa";
                                                } ?></td>
                                            <td><?= $p['date_create'] ?></td>
                                            <td><div class="d-flex">
                                                        <a href="<?= base_url('admin/editUser/') . $p['id'] ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
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