<div class="content-body">
    <div class="container-fluid">

        <!-- row -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Register RFID</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <?php foreach ($siswa as $s) : ?>
                            <form class="needs-validation" novalidate="" action="<?= base_url('admin/updateRfid/' . $s['id_siswa']) ?>" method="POST">
                                <div class="row">
                                   <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="nis">NIS
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" disabled class="form-control" id="nis" name="nis" value="<?= $s['nis'] ?>" required="">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="nama_siswa">Nama
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $s['nama_siswa'] ?>" required="">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="rfid_number">RFID Number
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="rfid_number" name="rfid_number" value="" placeholder="Scan atau masukkan RFID">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-lg-8 ms-auto">
                                            <button type="submit" class="btn btn-primary">Register</button>
                                        </div>
                                    </div>
                                </div>


                                </div>

                            </form>
                            <script>
                            setInterval(function () {
                                $.ajax({
                                    url: "<?= base_url('admin/get_latest_uid') ?>",
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(res) {
                                        console.log("Response from get_latest_uid:", res);
                                        if (res.uid && res.uid !== "") {
                                            $('#rfid_number').val(res.uid);
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error("Error polling get_latest_uid:", status, error);
                                    }
                                });
                            } , 1000);
                            window.addEventListener("beforeunload", function (e) {
                                console.log("Halaman ditutup / reload, kirim reset status...");

                                var url = "<?= base_url('admin/reset_status') ?>";
                                navigator.sendBeacon(url);

                                console.log("Status reset terkirim pakai sendBeacon.");
                            });
                            </script>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>