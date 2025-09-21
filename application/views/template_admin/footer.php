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
<script src="<?= base_url('assets/') ?>js/styleSwitcher.js"></script>


<!-- Calenders -->
<script src="<?= base_url('assets/') ?>vendor/fullcalendar/js/main.min.js"></script>
<script src="<?= base_url('assets/') ?>js/plugins-init/fullcalendar-init.js"></script>
<script src="<?= base_url('assets/') ?>vendor/moment/moment.min.js"></script>

<!-- Sweet Alert -->
<script src="<?= base_url('assets/') ?>swettjs/dist/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets/') ?>swettjs/scriptku.js"></script>
<script src="<?= base_url('assets/') ?>js/<?= $js ?>.js"></script>
<script>
    function cardsCenter() {

        /*  testimonial one function by = owl.carousel.js */



        jQuery('.card-slider').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            //center:true,
            slideSpeed: 3000,
            paginationSpeed: 3000,
            dots: true,
            navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 1
                },
                800: {
                    items: 1
                },
                991: {
                    items: 1
                },
                1200: {
                    items: 1
                },
                1600: {
                    items: 1
                }
            }
        })
    }

    jQuery(window).on('load', function() {
        setTimeout(function() {
            cardsCenter();
        }, 1000);
    });
    jQuery(document).ready(function() {
        setTimeout(function() {
            dlabSettingsOptions.version = '';
            new dlabSettings(dlabSettingsOptions);
        }, 1500)
    });

     $(document).ready(function() {
  $(document).on('click', '.btn-edit', function() {
    var id = $(this).data('id');
    var nama_event = $(this).data('nama_event');
    var start_date = $(this).data('start_date');
    var end_date = $(this).data('end_date');
    var keterangan = $(this).data('keterangan');
    
    console.log('triggered')

    $('#edit-id').val(id);
    $('#edit-nama_event').val(nama_event);
    $('#edit-start_date').val(start_date);
    $('#edit-end_date').val(end_date);
    $('#edit-keterangan').val(keterangan);

    var myModal = new bootstrap.Modal(document.getElementById('editModal'));
    myModal.show();
  });
});
   

    
</script>

</body>

<script>

</script>

</html>