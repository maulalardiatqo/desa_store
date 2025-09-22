<!--**********************************
            Footer start
        ***********************************-->
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin Keluar</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Tekan Logout, jika yakin keluar</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <div class="copyright">
        <!-- <p>Copyright © Designed &amp; Developed by <a href="../index.htm" target="_blank">TKJ SMK AL Amiriyah</a> 2022</p> -->
    </div>
</div>
<!--**********************************
            Footer end
        ***********************************-->

<!--**********************************
           Support ticket button start
        ***********************************-->

<!--**********************************
           Support ticket button end
        ***********************************-->


</div>
<!--**********************************
        Main wrapper end
    ***********************************-->

<!--**********************************
        Scripts
    ***********************************-->
<!-- Required vendors -->
<script src="<?= base_url('assets/') ?>vendor/global/global.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.bundle.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

<!-- Apex Chart -->
<script src="<?= base_url('assets/') ?>vendor/apexchart/apexchart.js"></script>

<script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.bundle.min.js"></script>

<!-- Datatable -->
<script src="<?= base_url('assets/') ?>vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>js/plugins-init/datatables.init.js"></script>


<!-- Chart piety plugin files -->
<script src="<?= base_url('assets/') ?>vendor/peity/jquery.peity.min.js"></script>
<!-- Dashboard 1 -->
<script src="<?= base_url('assets/') ?>js/dashboard/dashboard-1.js"></script>

<script src="<?= base_url('assets/') ?>vendor/owl-carousel/owl.carousel.js"></script>

<script src="<?= base_url('assets/') ?>js/custom.min.js"></script>
<script src="<?= base_url('assets/') ?>js/dlabnav-init.js"></script>
<script src="<?= base_url('assets/') ?>js/demo.js"></script>
<!-- <script src="<?= base_url('assets/') ?>js/styleSwitcher.js"></script> -->


<!-- Calenders -->
<script src="<?= base_url('assets/') ?>vendor/fullcalendar/js/main.min.js"></script>
<script src="<?= base_url('assets/') ?>js/plugins-init/fullcalendar-init.js"></script>
<script src="<?= base_url('assets/') ?>vendor/moment/moment.min.js"></script>

<!-- Sweet Alert -->
<script src="<?= base_url('assets/') ?>swettjs/dist/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets/') ?>swettjs/scriptku.js"></script>
<script src="<?= base_url('assets/') ?>js/<?= $js ?>.js"></script>
<script>
    const priceInput = document.getElementById("price");

    priceInput.addEventListener("input", function (e) {
        // Hapus semua karakter non-digit
        let value = this.value.replace(/\D/g, "");

        if (value) {
            // Format angka ke Rupiah
            let formatted = new Intl.NumberFormat("id-ID").format(value);
            this.value = "Rp. " + formatted;
        } else {
            this.value = "";
        }
    });

    // Opsional: agar cursor tidak lompat ke akhir saat edit
    priceInput.addEventListener("focus", function () {
        if (this.value === "") {
            this.value = "Rp. ";
        }
    });
</script>

</body>

<script>

</script>

</html>