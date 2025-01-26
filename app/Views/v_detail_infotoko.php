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
   
</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
  <br>
<div class="col-md-12">
   
    <div class="card card-outline card-success">
      
        <div class="card-header">
          
            <h3 class="card-title"><?= $judul?></h3>
                <!-- /.card-tools -->
        </div>
        
              <!-- /.card-header -->
        <div class="card-body">
                <div class="row">
<div class="col-sm-6">
  <div id="map" style="width: 100%; height: 500px;"></div>
</div>

<div class="col-sm-6">
  <img src="<?= base_url('foto/' . $infotoko['foto']) ?>" width="100%" height="500px">
</div>

<div class="col-sm-12">
  <table class="table table-bordered table-sm">
  <?php if (in_groups('admin') || in_groups('superadmin')) : ?>
    <tr>
      <th width="180px">Nama Pemiliki</th>
      <th width="50px" class="text-center">:</th>
      <td><?= $infotoko['nama_pemohon'] ?></td>
    </tr>
    <tr>
      <th width="180px">Nama Pemilik</th>
      <th width="50px" class="text-center">:</th>
      <td><?= $infotoko['nama_perusahaan'] ?></td>
    </tr>
    <tr>
      <th width="180px">Nomor Izin</th>
      <th width="50px" class="text-center">:</th>
      <td><?= $infotoko['nomor_izin'] ?></td>
    </tr>
    <tr>
      <th width="180px">Tanggal Izin</th>
      <th width="50px" class="text-center">:</th>
      <td><?= $infotoko['tanggal_izin'] ?></td>
    </tr>
    <?php endif;?>
    <tr>
      <th>Tipe Apotek</th>
      <th class="text-center">:</th>
      <td><?= $infotoko['merek'] ?></td>
    </tr>
    
    <tr>
      <th>Alamat Toko</th>
      <th class="text-center">:</th>
      <td><?= $infotoko['alamat'] ?>,Prov. <?= $infotoko['nama_provinsi'] ?>, Kab. <?= $infotoko['nama_kabupaten'] ?>, Kec. <?= $infotoko['nama_kecamatan'] ?></td>
    </tr>
    <tr>
      <th>Koordinat</th>
      <th class="text-center">:</th>
      <td><?= $infotoko['koordinat'] ?></td>
    </tr>
  </table>
  <a href="<?= base_url('Home/index') ?>" class="btn btn-warning btn-flat">
                <i class=" fa fa-arrow-left"></i> Back
            </a>
</div>
  </div>
              </div>
              </div>
              <footer class="main-footer">
            <!-- To the right -->
            <center> <strong>Copyright &copy; <?= date('Y') ?> <a href="<?= base_url() ?>"><?= $web['nama_web'] ?></a>.</strong>
            All rights reserved.</center>
            <!-- Default to the left -->
           
        </footer>
<script>
  var peta1 = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
  });

  var peta2 = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
  });

  var peta3 = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}.png', {
    attribution: '© CartoDB'
  });

  const map = L.map('map', {
    center: [<?= $infotoko['koordinat'] ?>],
    zoom: 20,
    layers: [peta2]
  });

  const baseMaps = {
    'Streets': peta1,
    'Satelite': peta2,
    'Dark': peta3,
  };

  var layerControl = L.control.layers(baseMaps).addTo(map);

  var icon = L.icon({
    iconUrl: '<?= base_url('marker/'.$infotoko['marker'])?>',
    iconSize: <?= $web['zoom_marker'] ?>, // Sesuaikan ukuran ikon jika diperlukan
  });

  L.marker([<?= $infotoko['koordinat'] ?>], { icon: icon }).addTo(map);
</script>
 <!-- jQuery -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>

</body>

</html>