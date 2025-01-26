<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $web['nama_web'] ?> | <?= $judul ?></title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.min.css">
    <link rel="icon" href="<?= base_url('icon/dpmptsp.png') ?>" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css"
        integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"
        integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
    <style>
        a {
            color: green;
            /* Mengatur warna hijau untuk tautan */
        }

        /* Tambahkan CSS berikut untuk membuat dropdown scrollable */
        .scrollable-dropdown {
            max-height: 400px;
            /* Sesuaikan dengan ketinggian yang Anda inginkan */
            overflow-y: auto;
        }

        .custom-dropdown {

            border-color: #28a745;
            /* Warna hijau */
        }


        .custom-dropdown .nav-link {
            color: white;
            /* Warna teks putih */
        }

        .custom-dropdown .nav-link:hover {
            background-color: #218838;
            /* Warna hijau yang sedikit lebih gelap pada hover */
        }


        .main-sidebar {
            width: 270px;
            /* Lebar default saat ditampilkan */

        }

        .sidebar-collapse .main-sidebar {
            width: 0px;
            /* Lebar sidebar saat disembunyikan */
        }

        /* Perbesar teks konten */
        .content-wrapper {
            font-size: 14px;
            /* Ubah sesuai kebutuhan */
        }

        /* Gaya CSS untuk sidebar content */
        #hitungJarakContent {
            padding: 20px;
            /* Padding untuk konten sidebar */
            color: white;
            /* Warna teks putih */
        }

        /* Gaya CSS untuk label dan input */
        .form-group label {
            color: white;
            /* Warna teks putih */
        }

        .form-group input[type="text"] {
            background-color: rgba(255, 255, 255, 0.1);
            /* Warna latar belakang input */
            border: none;
            /* Hapus border */
            color: white;
            /* Warna teks putih */
        }

        /* Gaya CSS untuk tombol */
        .btn-primary {
            background-color: #007bff;
            /* Warna latar tombol */
            border-color: #007bff;
            /* Warna border tombol */
        }

        .btn-primary:hover {
            background-color: #0056b3;
            /* Warna latar tombol saat hover */
            border-color: #0056b3;
            /* Warna border tombol saat hover */
        }

        .swal2-confirm {
            background-color: green !important;
        }

        @media (max-width: 768px) {
            .navbar-nav .nav-link h3.mb-0 {
                font-size: 12px;
            }

            h3.mb-0 {
                font-size: 12px;
                /* Atur ukuran font h3 */
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">

    <div class="wrapper">
        <!-- Navbar -->

        <nav class="main-header navbar navbar-expand-md navbar-light fixed-top" style="background-color: rgba(0, 0, 0, 0.5); border-radius: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); width: 90%; margin-left: auto; margin-right: auto; margin-top: 10px; border: 2px solid #28a745;">

            <div class="container-fluid">
                <a href="<?= base_url('Home/index') ?>" class="navbar-brand d-flex align-items-center">
                    <img src="<?= base_url('AdminLTE') ?>/dist/img/<?= $web['logo'] ?>" class="me-2 img-fluid" style="max-height: 60px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="<?= base_url('Home/index') ?>" role="button">
                                <h3 class="mb-0" style="font-size: 23px; font-weight: bold; color: #fff;">
                                    <?= $judul ?>
                                </h3>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <?php if (in_groups('admin') || in_groups('superadmin')) : ?>
                            <li class="nav-item">
                                <a href="<?= site_url('Admin') ?>" class="nav-link" style="font-size: 14px; font-weight: bold; color: #fff; white-space: nowrap;">
                                    Dashboard
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- <li class="nav-item" >
                    <a id="filterButton" data-widget="pushmenu" href="#" role="button" class="nav-link" style="font-size: 14px; font-weight: bold; color: #fff; white-space: nowrap;">
                        Filter
                    </a>
                </li>
                <li class="nav-item">
                    <a id="hitungJarakButton" data-widget="pushmenu" href="#" role="button" class="nav-link" style="font-size: 14px; font-weight: bold; color: #fff; white-space: nowrap;">
                        Hitung Jarak
                    </a>
                </li> -->

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="globalMarketDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                style="font-size: 14px; font-weight: bold; color: #fff;">
                                Tipe Apotek Global
                            </a>
                            <div class="dropdown-menu" aria-labelledby="globalMarketDropdown">
                                <?php foreach ($toko as $key => $value) { ?>
                                    <a class="dropdown-item" href="<?= base_url('Home/Toko/' . $value['id_merek']) ?>"
                                        style="font-size: 14px; font-weight: bold; color: #000;"><?= $value['merek'] ?></a>
                                <?php } ?>
                            </div>
                        </li>
                        <?php if (in_groups('user')) : ?>
                            <li class="nav-item">
                                <a href="<?= base_url('UserControll/profil') ?>" class="nav-link" style="font-size: 14px; font-weight: bold; color: #fff; white-space: nowrap;">
                                    My Profile
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Sidebar Container -->
        <aside id="sidebar" class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <br>
                        <br>

                        <div id="filterContent" class="sidebar-content">
                            <li style="color: white;">
                                <h3 style="margin-left: 13px; margin-top: 0; font-size: 24px;"> Filter</h3>
                            </li>
                            <li id="selectedWilayah" class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-map"></i>
                                    <p style="font-size: 14px;">
                                        Kecamatan
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <!-- Tambahkan kelas CSS untuk slider dropdown -->
                                <ul class="nav nav-treeview custom-dropdown">
                                    <!-- Form pencarian -->
                                    <li class="nav-item" style="margin-left: 15px;">
                                        <form id="searchForm" class="form-inline my-2 my-lg-0">
                                            <input class="form-control mr-sm-2" type="search"
                                                placeholder="Cari kecamatan..." aria-label="Search" id="searchInput"
                                                style="width: 100%;">
                                        </form>
                                    </li>
                                    <br>
                                    <!-- Daftar Kecamatan -->
                                    <div id="wilayahDropdown" class="scrollable-dropdown">
                                        <?php
                                        // Mengurutkan kecamatan berdasarkan nama
                                        usort($wilayah, function ($a, $b) {
                                            return strcmp($a['nama_wilayah'], $b['nama_wilayah']);
                                        });
                                        foreach ($wilayah as $key => $value) { ?>
                                            <a href="<?= base_url('Home/WilayahToko/' . $value['id_wilayah']) ?>"
                                                class="dropdown-item" style="font-size: 14px; padding-left: 15px;">
                                                <p><?= $value['nama_wilayah'] ?></p>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </ul>
                            </li>


                            <li id="minimarketDropdown" class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-store"></i>

                                    <p style="font-size: 14px;">
                                        Tipe Apotek Wilayah
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php
                                    // Pastikan $toko adalah sebuah array
                                    if (is_array($toko)) {
                                        // Urutkan array berdasarkan 'merek'
                                        usort($toko, function ($a, $b) {
                                            return strcmp($a['merek'], $b['merek']);
                                        });

                                        // Looping melalui setiap elemen dalam $toko
                                        foreach ($toko as $key => $value) {
                                    ?>
                                            <li class="nav-item">
                                                <a href="<?= base_url('Home/WilayahToko/' . session()->get('selected_wilayah', '') . '/' . $value['id_merek']) ?>"
                                                    class="nav-link">
                                                    <p style="font-size: 14px;"><?= $value['merek'] ?> </p>
                                                </a>
                                            </li>
                                    <?php
                                        } // Tutup loop
                                    } // Tutup pengecekan array
                                    ?>
                                </ul>
                            </li>
                        </div>
                    </ul>

                    <!-- /.sidebar-menu -->

                    <div id="hitungJarakContent" class="sidebar-content">

                        <h3 style="color: white;margin-left: 15px; margin-top: 0; font-size: 24px;">Hitung Jarak
                        </h3>

                        <div class="mt-3 ml-3">
                            <div class="form-group">
                                <label for="inputLatLong">Koordinat:</label>
                                <input type="text" id="inputLatLong" name="inputLatLong" class="form-control">
                            </div>
                            <button onclick="addNewMarker()" class="btn btn-success">Generate Koordinat</button>
                            <br>
                            <!-- Kolom Jarak -->
                            <br>
                            <div class="form-group">
                                <label for="jarakMinimarket">Jarak ke Apotek:</label>
                                <input type="text" id="jarakMinimarket" name="jarakMinimarket" class="form-control"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="jarakPasar">Jarak ke Pasar Rakayat:</label>
                                <input type="text" id="jarakPasar" name="jarakPasar" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <button onclick="cekJarak()" class="btn btn-success">Cek</button>
                            </div>
                            <div>
                                <button class="btn btn-warning btn-block" onclick="window.location.reload();">
                                    <i class="fa fa-remove"></i> Clear
                                </button>


                            </div>

                        </div>
                    </div>
                </nav>
                <!-- /.Form Input Koordinat Baru -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="row">
                    <!-- /.isi konten -->
                    <?php if ($page) {
                        echo view($page);
                    } ?>
                    <!-- /end isi konten -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <center> <strong>Copyright &copy; <?= date('Y') ?> <a href="<?= base_url() ?>"><?= $web['nama_web'] ?></a>.</strong>
                All rights reserved.</center>
            <!-- Default to the left -->

        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>

    <script>
        function toggleMinimarketDropdown() {
            var selectedWilayah = document.getElementById("selectedWilayah").getElementsByTagName('a')[0]
                .href; // Ambil URL dari link wilayah yang dipilih
            var minimarketDropdown = document.getElementById("minimarketDropdown");

            // Jika wilayah sudah dipilih (URL tidak sama dengan "#"), tampilkan dropdown minimarket
            // Jika tidak, sembunyikan dropdown minimarket
            if (selectedWilayah !== '#' && selectedWilayah !== '') {
                minimarketDropdown.style.display = "block";
            } else {
                minimarketDropdown.style.display = "none";
            }
        }

        // Fungsi untuk menambahkan marker baru dengan ikon dari folder marker/new.png
        function addNewMarkerWithIcon(latlng) {
            var newIcon = L.icon({
                iconUrl: '<?= base_url('marker/new.png') ?>',
                iconSize: <?= $web['zoom_marker'] ?>, // sesuaikan ukuran ikon jika diperlukan
            });

            var newMarker = L.marker(latlng, {
                icon: newIcon
            }).addTo(map);
            newMarker.bindPopup("<b>Marker Baru</b>").openPopup();
        }

        // Fungsi untuk menambahkan marker baru saat tombol "Tambah Marker Baru" diklik
        function addNewMarker() {
            var newCoords = document.getElementById("inputLatLong").value.split(',');
            var lat = parseFloat(newCoords[0]);
            var lng = parseFloat(newCoords[1]);
            addNewMarkerWithIcon([lat, lng]);

            // Dapatkan koordinat marker minimarket yang dipilih
            var selectedMinimarketCoords = null;
            map.eachLayer(function(layer) {
                if (layer instanceof L.Marker && layer.options.id == selectedMinimarketId) {
                    selectedMinimarketCoords = layer.getLatLng();
                }
            });

            // Tampilkan garis dan hitung jarak jika marker minimarket yang dipilih ada
            if (selectedMinimarketCoords) {
                showDistanceAndLine(newCoords, selectedMinimarketCoords);
            }
        }

        function cekJarak() {
            var jarakMinimarket = parseFloat(document.getElementById("jarakMinimarket").value);
            var jarakPasar = parseFloat(document.getElementById("jarakPasar").value);

            if (jarakMinimarket >= <?= $web['jarakminimarket'] ?> && jarakPasar >= <?= $web['jarakpasar'] ?>) {
                // Menampilkan popup sesuai regulasi
                Swal.fire({
                    title: 'Informasi',
                    text: 'Sudah Memenuhi Regulasi Jarak',
                    icon: 'success',
                    confirmButtonText: 'Tutup'
                });
            } else if (jarakMinimarket < <?= $web['jarakminimarket'] ?>) {
                // Menampilkan pesan jika jarak minimarket tidak memenuhi regulasi
                Swal.fire({
                    title: 'Peringatan',
                    text: 'Jarak Antar Titik Koordinat Baru Ke Apotek Tidak Memenuhi Regulasi',
                    icon: 'warning',
                    confirmButtonText: 'Tutup'
                });
            } else if (jarakPasar < <?= $web['jarakpasar'] ?>) {
                // Menampilkan pesan jika jarak pasar tidak memenuhi regulasi
                Swal.fire({
                    title: 'Peringatan',
                    text: 'Jarak Antar Titik Koordinat Baru Ke Pasar Rakyat Tidak Memenuhi Regulasi',
                    icon: 'warning',
                    confirmButtonText: 'Tutup'
                });
            }
        }


        document.addEventListener("DOMContentLoaded", function() {
            const filterButton = document.querySelector("#filterButton");
            const hitungJarakButton = document.querySelector("#hitungJarakButton");
            const sidebar = document.querySelector("#sidebar");

            // Handler for Filter button click
            filterButton.addEventListener("click", function() {
                toggleSidebar();
                // Menyembunyikan semua konten di dalam sidebar
                document.querySelectorAll(".sidebar-content").forEach(function(content) {
                    content.style.display = "none";
                });
                // Menampilkan konten Filter
                document.querySelector("#filterContent").style.display = "block";
            });

            // Handler for Hitung Jarak button click
            hitungJarakButton.addEventListener("click", function() {
                toggleSidebar();
                // Menyembunyikan semua konten di dalam sidebar
                document.querySelectorAll(".sidebar-content").forEach(function(content) {
                    content.style.display = "none";
                });
                // Menampilkan konten Hitung Jarak
                document.querySelector("#hitungJarakContent").style.display = "block";
            });

            // Function to toggle sidebar visibility
            function toggleSidebar() {
                sidebar.classList.toggle("show");
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById('searchInput');
            const wilayahDropdown = document.getElementById('wilayahDropdown').getElementsByTagName('a');

            searchInput.addEventListener('input', function(event) {
                const searchValue = event.target.value.trim().toLowerCase();

                for (let i = 0; i < wilayahDropdown.length; i++) {
                    const wilayah = wilayahDropdown[i].textContent.toLowerCase();
                    if (wilayah.includes(searchValue)) {
                        wilayahDropdown[i].style.display = 'block';
                    } else {
                        wilayahDropdown[i].style.display = 'none';
                    }
                }
            });
        });

        window.addEventListener('load', function() {
            var link = document.querySelector("link[rel~='icon']");
            if (link !== null) {
                link.href = '<?= base_url('icon/dpmptsp.png') ?>';
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
            // Periksa apakah popup sudah ditampilkan sebelumnya
            if (!document.cookie.includes("popupShown=true")) {
                // Tampilkan popup menggunakan SweetAlert2 saat halaman dimuat
                Swal.fire({
                    title: '<?= $web['title'] ?>',
                    text: '<?= $web['informasi'] ?>',
                    icon: 'info',
                    showCloseButton: true, // Menampilkan tombol close (icon silang)
                    showCancelButton: false, // Menghilangkan tombol cancel
                    showConfirmButton: false,
                }).then(function() {
                    // Setelah popup ditutup, atur cookie untuk menandai bahwa popup sudah ditampilkan
                    document.cookie = "popupShown=true; expires=Sat, 31 Dec 2030 12:00:00 UTC; path=/";
                });
            }
        });
        // Fungsi untuk menghapus cookie berdasarkan nama
        function deleteCookie(name) {
            document.cookie = name + '=; Max-Age=-99999999;';
        }

        // Contoh penggunaan untuk menghapus cookie 'popupShown'
        deleteCookie('popupShown');
    </script>

</body>

</html>