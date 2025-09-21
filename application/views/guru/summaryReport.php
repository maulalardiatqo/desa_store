<div class="content-body">
    <div class="container-fluid">

        <!-- row -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-validation">
                        <form class="needs-validation" novalidate="" action="<?= base_url('guru/tampilDetail') ?>" method="POST">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label">Pilih Bulan & Tahun <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <select class="form-select" name="bulan" required>
                                                        <option value="">-- Pilih Bulan --</option>
                                                        <?php 
                                                            $bulan = [
                                                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
                                                                4 => 'April', 5 => 'Mei', 6 => 'Juni',
                                                                7 => 'Juli', 8 => 'Agustus', 9 => 'September',
                                                                10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                                            ];
                                                            foreach ($bulan as $num => $nama) {
                                                                echo "<option value='$num'>$nama</option>";
                                                            }
                                                        ?>
                                                    </select>

                                                    <select class="form-select ms-2" name="tahun" required>
                                                        <option value="">-- Pilih Tahun --</option>
                                                        <?php 
                                                            $tahunSekarang = date('Y');
                                                            for ($i = $tahunSekarang; $i >= $tahunSekarang - 10; $i--) {
                                                                echo "<option value='$i'>$i</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
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