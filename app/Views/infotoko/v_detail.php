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
                        <img src="<?= base_url('foto/'.$infotoko ['foto'])?>" width="100%" height= "500px">
                    </div>
                    <div class="col-sm-12">
                        <table class="table table-border">
                            <tr>
                                <th>Nama Pemohon</th>
                                <th width="30px">:</th>
                                <td><?= $infotoko['nama_pemohon']?></td>
                            </tr>
                            <tr>
                                <th>Nama Perusahaan</th>
                                <th width="30px">:</th>
                                <td><?= $infotoko['nama_perusahaan']?></td>
                            </tr>
                            <tr>
                                <th>Tipe Apotek</th>
                                <th>:</th>
                                <td><?= $infotoko['merek']?></td>
                            </tr>
                            <tr>
                                <th>Nomor izin</th>
                                <th>:</th>
                                <td><?= $infotoko['nomor_izin']?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Izin</th>
                                <th>:</th>
                                <td><?= $infotoko['tanggal_izin']?></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <th>:</th>
                                <td><?= $infotoko['alamat']?></td>
                            </tr>
                        </table>
                        <a href="<?= base_url('InfoToko') ?>" class="btn btn-warning btn-flat">
                            <i class=" fa fa-arrow-left"></i>Back
                        </a>
                    </div>
                </div>

              </div>
              </div>
              </div>
    
              <script>
     var peta1 = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                        maxZoom: 20,
                        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                    });
    var peta2 =  L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                        maxZoom: 20,
                        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                    });
    var peta3 = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}.png', {
    attribution: '© CartoDB'
});



const map = L.map('map', {
	center: [<?= $infotoko ['koordinat']?>],
	zoom: 20,
	layers: [peta2]
});

const baseMaps = {
	'Streets': peta1,
    'Satelite' : peta2,
	'Dark': peta3,
};


L.geoJSON(<?= $infotoko['geojson'] ?>, { 
    fillColor: '<?= $infotoko['warna'] ?>', 
    fillOpacity: 0.2,})
  .bindPopup("<b><?= $infotoko['nama_wilayah'] ?></b>")
  .addTo(map);

var icon = L.icon({
    iconUrl: '<?= base_url('marker/'.$infotoko['marker'])?>',

    iconSize: <?= $web['zoom_marker'] ?>, // size of the icon
    
});

L.marker([<?= $infotoko ['koordinat']?>],{
    icon: icon
}).addTo(map);

</script>

