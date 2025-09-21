<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Presensi</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <?php foreach ($tanggal as $tgl) : ?>
                                            <th><?= $tgl ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1;
                                    foreach ($data_presensi as $presensi) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $presensi['nama_siswa'] ?></td>
                                            <?php foreach ($tanggal as $tgl) : ?>
                                                <?php 
                                                    $status = $presensi['presensi'][$tgl];
                                                    $style = $status === 'Libur' ? 'style="color:red; font-weight:bold;"' : '';
                                                ?>
                                                <td <?= $style ?>><?= $status ?></td>
                                            <?php endforeach; ?>
                                        </tr>
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

