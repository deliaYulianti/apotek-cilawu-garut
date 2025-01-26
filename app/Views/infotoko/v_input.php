<div class="col-md-12">
            <div class="card card-outline card-success">
              <div class="card-header">
                <h3 class="card-title"><?= $judul?></h3>

                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php 
                    session();
                    $validation = \Config\Services::validation();
                ?>
              <?php echo form_open_multipart('InfoToko/InsertData', ['id' => 'create-form']) ?>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Nama Pemohon</label>
                <input name="nama_pemohon" value="<?= old('nama_pemohon') ?>" placeholder="Nama Pemohon" class="form-control">
                <p class="text-danger"><?= $validation->hasError('nama_pemohon') ? $validation->getError('nama_pemohon') : '' ?></p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Nama Perusahaan</label>
                <input name="nama_perusahaan" value="<?= old('nama_perusahaan') ?>" placeholder="Nama Perusahaan" class="form-control">
                <p class="text-danger"><?= $validation->hasError('nama_perusahaan') ? $validation->getError('Nama Perusahaan') : '' ?></p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Tipe Apotek</label>
                <select name="id_merek" class="form-control">
                    <option value="">-- Pilih Tipe Apotek --</option>
                    <?php foreach ($toko as $key => $value) { ?>
                        <option value="<?= $value ['id_merek']?>"><?= $value ['merek']?></option>
                    <?php } ?>
                </select>
                <p class="text-danger"><?= $validation->hasError('id_merek') ? $validation->getError('id_merek') : '' ?></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Nomor Izin</label>
                <input name="nomor_izin" value="<?= old('nomor_izin') ?>" placeholder="Nomor Izin" class="form-control">
                <p class="text-danger"><?= $validation->hasError('nomor_izin') ? $validation->getError('nomor_izin') : '' ?></p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Tanggal izin</label>
                <input type="text" name="tanggal_izin" value="<?= old('tanggal_izin') ?>" placeholder="Tanggal izin" class="form-control">
                <p class="text-danger"><?= $validation->hasError('tanggal_izin') ? $validation->getError('tanggal_izin') : '' ?></p>
            </div>
        </div>
    </div>
    <div class="form-group">
    <label>Koordinat Apotek</label>
    <div id="map" style="width: 100%; height: 500px;"></div>
    <input name="koordinat" id="Koordinat" value="<?= old('koordinat') ?>" class="form-control" placeholder="Koordinat Apotek" >
    <p class="text-danger"><?= $validation->hasError('koordinat') ? $validation->getError('koordinat') : '' ?></p>    
</div>
<div class="row">
    <div class="col-sm-4">
            <div class="form-group">
                <label >Provinsi</label>
                <select name="id_provinsi" id="id_provinsi" class="form-control select2 select2-success" style="width : 100%" data-dropdown-css-class="select2-success">
                <option value="">-- Pilih Provinsi --</option>
                <?php foreach ($provinsi as $key => $value) { ?>
                    <option value="<?= $value['id_provinsi'] ?>"><?= $value['nama_provinsi'] ?></option>
               <?php } ?>
                </select>
                <p class="text-danger"><?= $validation->hasError('id_provinsi') ? $validation->getError('id_provinsi') : '' ?></p>    
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label >Kabupaten</label>
                 <select name="id_kabupaten" id="id_kabupaten" class="form-control select2 select2-success" style="width : 100%" data-dropdown-css-class="select2-success">
    
                </select>
                <p class="text-danger"><?= $validation->hasError('id_kabupaten') ? $validation->getError('id_kabupaten') : '' ?></p>    
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label >Kecamatan</label>
                <select name="id_kecamatan" id="id_kecamatan" class="form-control select2 select2-success" style="width : 100%" data-dropdown-css-class="select2-success">
    
                </select>
                <p class="text-danger"><?= $validation->hasError('id_kecamatan') ? $validation->getError('id_kecamatan') : '' ?></p>    
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
        <div class="form-group">
        <label>Alamat Toko</label>
        <input name="alamat" value="<?= old('alamat') ?>" placeholder="Alamat Toko"  class="form-control" >
        <p class="text-danger"><?= $validation->hasError('alamat') ? $validation->getError('alamat') : '' ?></p>    
        </div>
    </div>

    <div class="col-sm-4">
            <div class="form-group">
                <label >Wilayah Administrasi</label>
                <select name="id_wilayah" class="form-control select2 select2-success" style="width : 100%" data-dropdown-css-class="select2-success">
                    <option value="">-- Pilih Wilayah Administrasi --</option>
                    <?php foreach ($wilayah as $key => $value) { ?>
                        <option value="<?= $value['id_wilayah'] ?>"><?= $value['nama_wilayah'] ?></option>
                   <?php } ?>
                </select>
                <p class="text-danger"><?= $validation->hasError('id_wilayah') ? $validation->getError('id_wilayah') : '' ?></p>    
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Foto Apotek</label>
        <input type="file" accept=".jpg" name="foto" value="<?= old('foto') ?>" class="form-control" >
        <p class="text-danger"><?= $validation->hasError('foto') ? $validation->getError('foto') : '' ?></p>    
    </div>

    <button type="submit" class="btn btn-success btn-flat" id="save-button">
        <i class="fa fa-save"></i> Save
    </button>
    <a href="<?= base_url('InfoToko') ?>" class="btn btn-warning btn-flat">
        <i class=" fa fa-arrow-left"></i>Back
    </a>
</div>
<?php echo form_close() ?>

              </div>
              </div>
              </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
       $(document).ready(function () {
        //Initialize Select2 Elements
    $('.select2').select2();
         $('#id_provinsi').change(function () { 
            var id_provinsi = $('#id_provinsi').val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('InfoToko/Kabupaten')?>",
                data: {
                    id_provinsi: id_provinsi,
                },
                success: function (response) {
                  $('#id_kabupaten').html(response);  
                }
            })
         });

         $('#id_kabupaten').change(function () { 
            var id_kabupaten = $('#id_kabupaten').val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('InfoToko/Kecamatan')?>",
                data: {
                    id_kabupaten: id_kabupaten,
                },
                success: function (response) {
                  $('#id_kecamatan').html(response);  
                }
            })
         });
       });
    </script>
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
	center: [<?= $web['koordinat_wilayah'] ?>],
	zoom: <?= $web['zoom_view'] ?>,
	layers: [peta2]
});

const baseMaps = {
	'Streets': peta1,
    'Satelite' : peta2,
	'Dark': peta3,
    
};

var layerControl = L.control.layers(baseMaps).addTo(map);

var koordinat = document.querySelector("[name=koordinat]");
var curLocation = [<?= $web['koordinat_wilayah']?>];
map.attributionControl.setPrefix(false);
var marker = new L.marker(curLocation,{
    draggable : 'true',
    });
//koordinat saat marker di geser
marker.on('dragend', function(e){
    var position = marker.getLatLng();
    marker.setLatLng(position,{
        curLocation
    }).bindPopup(position).update();
    $("#Koordinat").val(position.lat + "," + position.lng );
});

//koordinat saat map di klik
map.on("click", function (e) {
    var lat = e.latlng.lat;
    var lng = e.latlng.lng;
    if (!marker) {
        marker = L.marker(e.latlng).addTo(map);
    } else {
        marker.setLatLng(e.latlng);
    }
    koordinat.value=lat + ',' + lng;
});

map.addLayer(marker);
document.getElementById('save-button').addEventListener('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to save the data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('create-form').submit();
            }
        });
    });
</script>
</script>

