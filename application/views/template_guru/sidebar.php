  <!--**********************************
            Sidebar start
        ***********************************-->
  <div class="dlabnav">
      <div class="dlabnav-scroll">
          <ul class="metismenu" id="menu">
              <li><a href="<?= base_url('guru') ?>" aria-expanded="false">
                      <i class="fas fa-home"></i>
                      <span class="nav-text">Dashboard</span>
                  </a>
              </li>
              <li><a href="<?= base_url('guru/kelolaPresensi') ?>" aria-expanded="false">
                      <i class="fas fa-wallet"></i>
                      <span class="nav-text">Kelola Presensi</span>
                  </a>
              </li>
               <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-book"></i>
                        <span class="nav-text">Report Presensi</span>
                  </a>
                  <ul aria-expanded="false">
                        <li><a href="<?= base_url('guru/detailReport') ?>">Detail Pertanggal</a></li>
                        <li><a href="<?= base_url('guru/summaryReport') ?>">Summary Perbulan</a></li>
                        <li><a href="<?= base_url('guru/filterReport') ?>">Report Filter Date</a></li>
                  </ul>
              </li>
          </ul>
          
      </div>
  </div>
  <!--**********************************
            Sidebar end
        ***********************************-->