<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $web['nama_web'] ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.min.css">
    <link rel="icon" href="<?= base_url('icon/dpmptsp.png') ?>" type="image/png">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/logins/login-9/assets/css/login-9.css">
    <style>
    /* CSS untuk membuat tautan berwarna hijau */
    a {
        color: green;
        /* Mengatur warna hijau untuk tautan */
    }
    </style>
</head>

<body class="hold-transition login-page">
    <?= $this->renderSection('content'); ?>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>
    <script>
    window.addEventListener('load', function() {
        var link = document.querySelector("link[rel~='icon']");
        if (link !== null) {
            link.href = '<?= base_url('icon/dpmptsp.png') ?>';
        }
    });
    </script>
    <script>
    document.getElementById('showLoginBtn').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('menuLogin').style.display = 'block';
        document.querySelector('.logo-container').style.display = 'none';
        document.querySelector('.show-login-btn').style.display = 'none'; // Menyembunyikan tombol login
    });
    </script>
</body>

</html>