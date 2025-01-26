<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $web['nama_web'] ?> | <?= $judul ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet"
        href="<?= base_url('AdminLTE') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="icon" href="<?= base_url('icon/dpmptsp.png') ?>" type="image/png">
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet"
        href="<?= base_url('AdminLTE') ?>/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.min.css">

    <!-- jQuery -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <!-- Select2 -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/select2/js/select2.full.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bootstrap color picker -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>
    <!-- leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <style>
    .user-header {
    position: relative;
    text-align: center;
    color: white;
    padding: 20px;
    background: linear-gradient(135deg, #6e8efb, #a777e3);
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.user-header:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.user-header img {
    border-radius: 50%;
    border: 5px solid white;
    width: 100px;
    height: 100px;
    transition: transform 0.3s ease;
}

.user-header img:hover {
    transform: scale(1.1);
}

.user-info {
    margin-top: 10px;
}

.user-info p {
    font-size: 18px;
    margin-bottom: 5px;
}

.user-info small {
    display: block;
    margin-bottom: 5px;
    font-size: 14px;
}

.role {
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 14px;
    margin-top: 5px;
    display: inline-block;
    /* text-transform: uppercase; */ /* Hapus atau nonaktifkan jika ingin teks sesuai aslinya */
    letter-spacing: 1px;
    font-weight: bold;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
}

.role-user {
    background-color: #007bff;
    color: white;
}

.role-admin {
    background-color: #ffc107;
    color: black;
}

.role-superadmin {
    background-color: #dc3545;
    color: white;
}

@media (max-width: 768px) {
    .user-header img {
        width: 80px;
        height: 80px;
    }

    .user-info p {
        font-size: 16px;
        margin-bottom: 3px;
    }

    .user-info small {
        font-size: 12px;
        margin-bottom: 3px;
    }

    .role {
        font-size: 12px;
        padding: 3px 8px;
        margin-top: 3px;
    }
}
.user-footer {
    padding: 10px;
    background-color: #f8f9fa; /* Warna latar belakang */
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.footer-link {
    display: block;
    padding: 3px 10px;
    color: #343a40; /* Warna teks */
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s;
}

.footer-link:hover {
    background-color: #218838; /* Warna latar belakang saat dihover */
    color: white; /* Warna teks saat dihover */
    border-radius: 5px;
}

.footer-link i {
    margin-right: 10px;
}

@media (max-width: 768px) {
    .footer-link {
        padding: 8px 16px;
    }

    .user-footer {
        margin-top: 20px;
    }
}

    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
               <li class="nav-item d-none d-sm-inline-block">
    <a href="<?= base_url('Home/index') ?>" class="btn btn-success">Peta Investasi</a>
</li>

                <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown user-menu">
                    <?php
        $photoUrl = base_url('foto') . '/' . user()->foto . '?' . time();
    ?>
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $photoUrl ?>" class="user-image img-circle elevation-2" alt="User Image">
                        
                    </a>
                    <!-- Dropdown menu -->
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                       <li class="user-header">
    <img src="<?= $photoUrl ?>" class="img-circle elevation-2" alt="User Image">
    <p>
        <p><?= user()->username ?></p>
        
        
        
    </p>
</li>



                        <!-- Menu Footer-->
                        <li class="user-footer">
    <ul class="list-unstyled">
        <?php if (in_groups('admin') || in_groups('superadmin')) : ?>
            <li>
                <a href="<?= base_url('UserControll/profil') ?>" class="footer-link">
                    <i class="fas fa-user fa-lg"></i> My Profile
                </a>
            </li>
        <?php endif; ?>
        
        <?php if (in_groups('superadmin') || in_groups('admin')) : ?>
            <li>
                <a href="<?= base_url('UserControll') ?>" class="footer-link">
                    <i class="fas fa-users-cog fa-lg"></i> Settings
                </a>
            </li>
        <?php endif; ?>

        <li>
            <a href="<?= base_url('logout') ?>" class="footer-link">
                <i class="fas fa-sign-out-alt fa-lg"></i> Sign out
            </a>
        </li>

        <li class="text-center mt-3">
            <small>Member since <?= user()->created_at ?></small>
        </li>
    </ul>
</li>

                    </ul>
                </li>


            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url('Admin') ?>" class="brand-link" style="display: flex; align-items: center;">
    <img src="<?= base_url('AdminLTE') ?>/dist/img/<?= $web['logo'] ?>" alt="Logo"
        class="brand-image  elevation-3" style="opacity: 0.8; max-width: 100%; height: auto; background-color: transparent;">
    <span class="brand-text font-weight-light"><?= $web['nama_web'] ?></span>
</a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <?php if (in_groups('admin') || in_groups('superadmin')) : ?>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin')?>"
                                class="nav-link <?= $menu == 'dashboard'  ? 'active bg-success' : ''?>">

                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Wilayah')?>"
                                class="nav-link <?= $menu == 'wilayah'  ? 'active bg-success'  : ''?>">
                                <i class="nav-icon fas fa-map"></i>
                                <p>
                                    Wilayah
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('toko')?>"
                                class="nav-link <?= $menu == 'toko'  ? 'active bg-success' : ''?>">
                                <i class="nav-icon fas fa-store"></i>
                                <p>
                                    Tipe Apotek
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('infotoko')?>"
                                class="nav-link <?= $menu == 'infotoko'  ? 'active bg-success' : ''?>">
                                <i class="nav-icon fas fa-info-circle"></i>
                                <p>
                                    Detail Apotek
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('UserControll') ?>"
                                class="nav-link <?= $menu == 'user'  ? 'active bg-success'  : ''?>">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    User
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/setting') ?>"
                                class="nav-link <?= $menu == 'setting'  ? 'active bg-success' : ''?>">
                                <i class="nav-icon fas fa-duotone fa-wrench"></i>
                                <p>
                                    Setting
                                </p>
                            </a>
                        </li>
                        <?php endif;?>
                        <?php if(in_groups('user')) : ?>
                        <li class="nav-item">
                            <a href="<?= base_url('UserControll/profil') ?>"
                                class="nav-link <?= $menu == 'profil'  ? 'active bg-success'  : ''?>">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    My Profile
                                </p>
                            </a>
                        </li>
                        <?php endif;?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= $judul ?></h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- isi konten -->
                        <?php 
                if($page){
                   echo view($page); 
                }
            ?>

                        <!-- /.isi konten -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Main Footer -->
        <footer class="main-footer">
            <center><strong>Copyright &copy; <?= date('Y') ?> <a href="<?= base_url() ?>"><?= $web['nama_web'] ?></a>.</strong>
            All rights reserved.</center>
        </footer>

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <script>
    // Fungsi untuk mengklik pushmenu setelah 5 detik
    function klikPushMenu() {
        setTimeout(function() {
            var pushMenu = document.querySelector('[data-widget="pushmenu"]');
            if (pushMenu) {
                pushMenu.click();
            }
        }, 2000); // Waktu penundaan dalam milidetik (5000ms = 5 detik)
    }

    // Panggil fungsi klikPushMenu saat dokumen selesai dimuat
    document.addEventListener('DOMContentLoaded', function() {
        klikPushMenu();
    });
    </script>
    <script>
    window.addEventListener('load', function() {
        var link = document.querySelector("link[rel~='icon']");
        if (link !== null) {
            link.href = '<?= base_url('icon/dpmptsp.png') ?>';
        }
    });
    // Fungsi untuk menghapus cookie berdasarkan nama

    document.addEventListener('DOMContentLoaded', function() {
        const userHeader = document.querySelector('.user-header');
        const userImage = userHeader.querySelector('img');
        userHeader.addEventListener('mouseover', function() {
            userImage.classList.add('shadow-lg');
        });
        userHeader.addEventListener('mouseout', function() {
            userImage.classList.remove('shadow-lg');
        });
    });
    </script>

</body>

</html>