<div id="map" style="width: 100%; height: 800px;"></div>
<style>
        #map {
            width: 100%;
            height: 600px;
            position: relative;
        }
        .popup-content {
            max-width: 300px;
        }
        .popup-content img {
            width: 100%;
            height: auto;
        }
        .popup-buttons {
            margin-top: 10px;
        }
        .popup-buttons button {
            margin-right: 5px;
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .popup-buttons button:hover {
            background-color: #0056b3;
        }
    </style>
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

  // var map = L.map('map').setView([-0.8971600935330516, 100.3764066301208], 12);

  // var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
  //   attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  // }).addTo(map);

  const map = L.map('map', {
	center: [<?= $web['koordinat_wilayah'] ?>],
	zoom: <?= $web['zoom_view'] ?>,
	layers: [peta2]
});

const baseMaps = {
	'Streets': peta1,
    'Satelite' : peta2,
    'Dark' : peta3,
};

  var layerControl = L.control.layers(baseMaps).addTo(map);

  <?php foreach ($wilayah as $key => $value) { ?>
    L.geoJSON(<?= $value['geojson'] ?>, {
        fillColor: '<?= $value['warna'] ?>',
        fillOpacity: 0.3,
      })
      .bindPopup("<b><?= $value['nama_wilayah'] ?></b>")
      .addTo(map);
  <?php } ?>

  <?php foreach ($infotoko as $key => $value) { ?>
    var Icon = L.icon({
      iconUrl: '<?= base_url('marker/' . $value['marker']) ?>',
      iconSize: <?= $web['zoom_marker'] ?>, // size of the icon
    });

    L.marker([<?= $value['koordinat'] ?>], {
        icon: Icon
      })
      .bindPopup(
                "<div class='popup-content'>" +
                "<img src='<?= base_url('foto/' . $value['foto']) ?>' width='300px' height='170px'><br><br>"+
                "<table>" +
                "<tr><td><b>Nama Toko:</b></td><td><?= $value['nama_perusahaan'] ?></td></tr>" +
                "<tr><td><b>Alamat:</b></td><td><?= $value['alamat'] ?></td></tr>" +
                "<tr><td><b>Tipe:</b></td><td><?= $value['merek'] ?></td></tr>" +
                "</table>" +
                "</div>" +
                 "<div class='popup-buttons'>" +
                "<button onclick=\"viewGoogleMap('<?= $value['koordinat'] ?>')\">Lihat Google Map</button>" +
                "<button onclick=\"showDetail('<?= base64_encode($value['id_toko']) ?>')\">Detail</button>" +
                "</div>").addTo(map);
  <?php } ?>
  function viewGoogleMap(coords) {
            var lat = coords.split(',')[0];
            var lon = coords.split(',')[1];
            window.open("https://www.google.com/maps/search/?api=1&query=" + lat + "," + lon, "_blank");
        }

        
        function showDetail(id) {
            window.location.href="<?= base_url('Home/DetailInfoToko/'. urlencode(base64_encode($value['id_toko'])))?>";
        }
</script>