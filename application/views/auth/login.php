<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <link rel="shortcut icon" href="<?= base_url('assets/images/logo-smk.png'); ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:title" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:image" content="https://fillow.dexignlab.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>Login Applikasi KWT Desa Kajen</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/') ?>images/favicon.png">
    <link href="<?= base_url('assets/') ?>css/style.css" rel="stylesheet">

</head>

<body class="vh-100">
    <div id="flash-data" data-typealert="<?= $this->session->flashData('flashtype'); ?>" data-flashdata="<?= $this->session->flashData('flash'); ?>"></div>
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="index.html"><img style="width:40px; height:45px;" src="<?= base_url('images/logo kab tegal.png'); ?>" alt=""></a>
                                    </div>
                                    <h4 class="text-center mb-4">WELCOME</h4>
                                    <?= $this->session->flashdata('message'); ?>
                                    <form action="<?= base_url('auth/loginAdmin') ?>" method="POST">
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Username</strong></label>
                                            <input type="text" class="form-control" placeholder="username" name="username" id="username">
                                            <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="mb-3 position-relative">
  <label class="mb-1"><strong>Password</strong></label>
  <div class="input-group">
    <input type="password" class="form-control" placeholder="password" name="password" id="password">
    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
      <i class="fa fa-eye" id="eyeIcon"></i>
    </button>
  </div>
  <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
</div>
                                        <div class="row d-flex justify-content-between mt-4 mb-2">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                            </div>
                                        </div>
                                        <!-- <div class="row d-flex justify-content-center"> Develop By TKJ SMK Al Amiriyah</div> -->
                                    </form>
                                    <div class="new-account mt-3">
                                        <p><a class="text-primary" href="<?= base_url('auth') ?>">Back To Website</a></p>
                                    </div>
                                    <div class="new-account mt-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="<?= base_url('assets/') ?>vendor/global/global.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/custom.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/dlabnav-init.js"></script>
    <script src="<?= base_url('assets/') ?>js/styleSwitcher.js"></script>
    <script src="<?= base_url('assets/') ?>swettjs/dist/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('assets/') ?>swettjs/scriptku.js"></script>
    <script>
  const togglePassword = document.querySelector("#togglePassword");
  const passwordInput = document.querySelector("#password");
  const eyeIcon = document.querySelector("#eyeIcon");

  togglePassword.addEventListener("click", function () {
    const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute("type", type);

    // ganti icon
    if (type === "password") {
      eyeIcon.classList.remove("fa-eye-slash");
      eyeIcon.classList.add("fa-eye");
    } else {
      eyeIcon.classList.remove("fa-eye");
      eyeIcon.classList.add("fa-eye-slash");
    }
  });
</script>
</body>

</html>