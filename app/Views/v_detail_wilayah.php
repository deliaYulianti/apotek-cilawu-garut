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
    'Satelite': peta2,
    'Dark': peta3,
};

var layerControl = L.control.layers(baseMaps).addTo(map);

var wilayah = L.geoJSON(<?= $detailwilayah['geojson'] ?>, {
        fillColor: '<?= $detailwilayah['warna'] ?>',
        fillOpacity: 0.1,
    }).addTo(map)
    .bindPopup("<b><?= $detailwilayah['nama_wilayah'] ?></b>")
    .openPopup();

map.fitBounds(wilayah.getBounds());

<?php foreach ($infotoko as $key => $value) { ?>
var Icon = L.icon({
    iconUrl: '<?= base_url('marker/' . $value['marker']) ?>',
    iconSize: <?= $web['zoom_marker'] ?>, // size of the icon
});

var marker = L.marker([<?= $value['koordinat'] ?>], {
        icon: Icon,
        id: <?= $value['id_merek'] ?> // Assigning the ID of the minimarket to the marker
    })
    .bindPopup(
        "<div class='popup-content'>" +
        "<img src='<?= base_url('foto/' . $value['foto']) ?>' width='300px' height='170px'><br><br>" +
        "<table>" +
        "<tr><td><b>Alamat:</b></td><td><?= $value['alamat'] ?></td></tr>" +
        "<tr><td><b>Tipe:</b></td><td><?= $value['merek'] ?></td></tr>" +
        "<tr><td><b>Koordinat:</b></td><td><?= $value['koordinat'] ?></td></tr>" +
        "</table>" +
        "</div>" +
        "<div class='popup-buttons'>" +
        "<button  onclick=\"viewGoogleMap('<?= $value['koordinat'] ?>')\">Lihat Google Map</button>" +
        "<button onclick=\"showDetail('<?= base64_encode($value['id_toko']) ?>')\">Detail</button>" +
        "<button onclick=\"hitungJarak('<?= $value['koordinat'] ?>', <?= $value['id_merek'] ?>, '<?= $value['merek'] ?>')\">Jarak</button>" +
        "</div>").addTo(map);

// Hide the marker if it's not the selected minimarket
<?php if (!empty($selected_merek_id) && $value['id_merek'] != $selected_merek_id): ?>
marker.setOpacity(0);
<?php endif; ?>
<?php } ?>

// Function to show only the selected minimarket or all minimarkets if no minimarket is selected
function showSelectedMinimarket(selectedId) {
    map.eachLayer(function(layer) {
        if (layer instanceof L.Marker) {
            if (selectedId === '' || layer.options.id == selectedId) {
                layer.setOpacity(1);
            } else {
                layer.setOpacity(0);
            }
        }
    });
}

function viewGoogleMap(coords) {
    var lat = coords.split(',')[0];
    var lon = coords.split(',')[1];
    window.open("https://www.google.com/maps/search/?api=1&query=" + lat + "," + lon, "_blank");
}


function showDetail(id) {
    // Tambahkan pengecekan apakah id_toko valid
    window.location.href = "<?= base_url('Home/DetailInfoToko/')?>" +"/"+ id;

}


// Handle dropdown change event
$(document).on('change', '#selectMerek', function() {
    var selectedId = $(this).val();
    showSelectedMinimarket(selectedId);
});

// Show all minimarkets if no minimarket is selected initially
$(document).ready(function() {
    var selectedId = $('#selectMerek').val();
    showSelectedMinimarket(selectedId);
});

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

var lineLayer;

// Fungsi untuk menampilkan garis antara dua titik dan menghitung jarak
function showLineBetweenPoints(newCoords, minimarketCoords) {
    // Hapus garis yang ada sebelumnya jika ada
    if (lineLayer) {
        map.removeLayer(lineLayer);
    }

    // Buat garis baru dari koordinat baru ke koordinat minimarket
    lineLayer = L.polyline([newCoords, [minimarketCoords.lat, minimarketCoords.lng]], {
        color: 'red'
    }).addTo(map);

    // Hitung jarak antara dua titik
    var distance = haversineDistance(newCoords[0], newCoords[1], minimarketCoords.lat, minimarketCoords.lng);

}

// Fungsi untuk menambahkan marker baru saat tombol "Tambah Marker Baru" diklik
function addNewMarker() {
    var latlng = document.getElementById("inputLatLong").value.split(',');
    var lat = parseFloat(latlng[0]);
    var lng = parseFloat(latlng[1]);
    var newCoords = [lat, lng];

    // Dapatkan ID minimarket yang dipilih
    var selectedMerekId = document.getElementById("selectMerek").value;

    // Kirimkan ID minimarket ke controller untuk mendapatkan koordinatnya
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('Infotoko/getMinimarketCoords/'); ?>" + selectedMerekId,
        success: function(data) {
            var minimarketCoords = JSON.parse(data);

            // Tampilkan garis dan hitung jarak jika data koordinat minimarket diterima
            if (minimarketCoords) {
                showLineBetweenPoints(newCoords, minimarketCoords);
            }
        }
    });
}

function hitungJarak(koordinatMinimarket, idMerek, merek) {
    var koordinatBaru = document.getElementById("inputLatLong").value.split(',');
    var latBaru = parseFloat(koordinatBaru[0]);
    var lngBaru = parseFloat(koordinatBaru[1]);

    var latMinimarket = parseFloat(koordinatMinimarket.split(',')[0]);
    var lngMinimarket = parseFloat(koordinatMinimarket.split(',')[1]);

    // Tampilkan garis dan hitung jarak antara dua titik
    showLineBetweenPoints([latBaru, lngBaru], {
        lat: latMinimarket,
        lng: lngMinimarket
    });

    // Menghitung jarak berdasarkan id_merek atau merek
    var distance = haversineDistance(latBaru, lngBaru, latMinimarket, lngMinimarket);

    // Menentukan di mana hasil perhitungan jarak akan ditampilkan
    if (idMerek == 5 || merek == 'pasar') {
        // Jika id_merek adalah 5 atau merek adalah 'pasar', tampilkan hitungan jarak ke kolom "jarak ke pasar tradisional"
        document.getElementById("jarakPasar").value = distance.toFixed(2) + " meter";

    } else {
        // Jika id_merek bukan 5 atau merek bukan 'pasar', tampilkan hitungan jarak ke kolom "jarak ke minimarket"
        document.getElementById("jarakMinimarket").value = distance.toFixed(2) + " meter";

    }
}


// Fungsi untuk menampilkan garis dan menghitung jarak
function showDistanceAndLine(coords1, coords2) {
    // Buat garis dari koordinat baru ke koordinat minimarket
    const line = L.polyline([coords1, coords2], {
        color: 'red'
    }).addTo(map);

    // Hitung jarak antara dua titik koordinat
    const distance = haversineDistance(coords1[0], coords1[1], coords2[0], coords2[1]);

    // Tampilkan jarak dalam meter
    alert("Jarak antara dua titik: " + distance.toFixed(2) + " meter");

    // Kembalikan referensi garis untuk disimpan
    return line;
}
// Fungsi untuk menghitung jarak antara dua titik koordinat menggunakan rumus haversine
function haversineDistance(lat1, lon1, lat2, lon2) {
    // Konversi sudut menjadi radian
    const toRadian = angle => (Math.PI / 180) * angle;

    // Radius bumi dalam meter
    const R = 6371e3;

    // Konversi koordinat ke radian
    const φ1 = toRadian(lat1);
    const φ2 = toRadian(lat2);
    const Δφ = toRadian(lat2 - lat1);
    const Δλ = toRadian(lon2 - lon1);

    // Rumus haversine
    const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
        Math.cos(φ1) * Math.cos(φ2) *
        Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

    // Jarak dalam meter
    const distance = R * c;

    return distance;
}
</script>