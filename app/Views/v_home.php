<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaflet Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="icon" href="<?= base_url('icon/dpmptsp.png') ?>" type="image/png">
    <style>
    #map {
        width: 100%;
        height: 900px;
        position: relative;
    }

    .leaflet-tile-container {
        background-color: transparent !important;
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
        background-color: green;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    .popup-buttons button:hover {
        background-color: darkgreen;
    }
    </style>
</head>

<body>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
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
        center: [<?= $web['koordinat_wilayah'] ?>],
        zoom: <?= $web['zoom_view'] ?>,
        layers: [peta2]
    });

    const baseMaps = {
        'Streets': peta1,
        'Satellite': peta2,
        'Dark': peta3,
    };

    var layerControl = L.control.layers(baseMaps).addTo(map);

    <?php foreach ($wilayah as $key => $value) { ?>
    L.geoJSON(<?= $value['geojson'] ?>, {
            fillColor: '<?= $value['warna'] ?>',
            fillOpacity: 0.2,
        })
        .bindPopup("<b><?= $value['nama_wilayah'] ?></b>")
        .addTo(map);
    <?php } ?>

    <?php foreach ($infotoko as $key => $value) { ?>
    var Icon = L.icon({
        iconUrl: '<?= base_url('marker/' . $value['marker']) ?>',
        iconSize: <?= $web['zoom_marker'] ?>, // size of the icon
    });

    var popupContent = "<div class='popup-content'>" +
        "<img src='<?= base_url('foto/' . $value['foto']) ?>'><br>" +
        "<table>" +
        "<tr><td><b>Alamat:</b></td><td><?= $value['alamat'] ?></td></tr>" +
        "<tr><td><b>Tipe:</b></td><td><?= $value['merek'] ?></td></tr>" +
        "<tr><td><b>Koordinat:</b></td><td><?= $value['koordinat'] ?></td></tr>" +
        "</table>" +
        "</div>" +
        "<div class='popup-buttons'>" +
        "<button onclick=\"viewGoogleMap('<?= $value['koordinat'] ?>')\">Lihat Google Map</button>" +
        "<button onclick=\"showDetail('<?= base64_encode($value['id_toko']) ?>')\">Detail</button>" +
        "</div>";

    L.marker([<?= $value['koordinat'] ?>], {
            icon: Icon
        })
        .bindPopup(popupContent)
        .addTo(map);
    <?php } ?>

    function viewGoogleMap(coords) {
        var lat = coords.split(',')[0];
        var lon = coords.split(',')[1];
        window.open("https://www.google.com/maps/search/?api=1&query=" + lat + "," + lon, "_blank");
    }


    function showDetail(id) {
        // Tambahkan pengecekan apakah id_toko valid
        if (id) {
            window.location.href = "<?= base_url('Home/DetailInfoToko/')?>" +"/" + id;
        } else {
            // Jika id_toko tidak valid, arahkan ke halaman 404
            window.location.href = "<?= base_url('Home/Error')?>";
        }
    }
    </script>

</body>

</html>