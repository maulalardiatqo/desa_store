<!--**********************************
            Sidebar start
        ***********************************-->
<div class="dlabnav">
  <div class="dlabnav-scroll">
    <ul class="metismenu" id="menu">
      <li>
        <a href="<?= base_url('admin') ?>" aria-expanded="false">
          <i class="fas fa-home"></i>
          <span class="nav-text">Dashboard</span>
        </a>
      </li>

      <li>
        <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
          <i class="fas fa-cog"></i> <!-- Ikon roda gigi = pengaturan -->
          <span class="nav-text">Kelola Website</span>
        </a>
        <ul aria-expanded="false">
           <li>
            <a href="<?= base_url('admin/fotoWebsite') ?>">
              <i class="fas fa-user-cog"></i>
              Profil Desa
            </a>
          </li>
          <li>
            <a href="<?= base_url('admin/kegiatanDesa') ?>">
              <i class="fas fa-calendar-alt"></i> <!-- Ikon kegiatan -->
              Kegiatan Desa
            </a>
          </li>
          <li>
            <a href="<?= base_url('admin/berita') ?>">
              <i class="fas fa-newspaper"></i> <!-- Ikon berita -->
              Berita
            </a>
          </li>
          <li>
            <a href="<?= base_url('admin/fotoWebsite') ?>">
              <i class="fas fa-image"></i> <!-- Ikon foto -->
              Foto Website
            </a>
          </li>
        </ul>
      </li>

      <li>
        <a href="<?= base_url('admin/produk') ?>" aria-expanded="false">
          <i class="fas fa-box-open"></i> <!-- Ikon kotak produk -->
          <span class="nav-text">Produk</span>
        </a>
      </li>

      <!-- Tambahan Logout -->
      <li>
        <a href="<?= base_url('auth/logout') ?>" aria-expanded="false">
          <i class="fas fa-sign-out-alt"></i> <!-- Ikon logout -->
          <span class="nav-text">Logout</span>
        </a>
      </li>
    </ul>
  </div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->
