<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title"><?= $judul?></h3>
        </div>
        <div class="card-body">
            <?php 
                session();
                $validation = \Config\Services::validation();
            ?>
            <?php echo form_open_multipart('Wilayah/InsertData', ['id' => 'create-form']) ?>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama Wilayah</label>
                        <input name="nama_wilayah" value="<?= old('nama_wilayah') ?>" placeholder="Masukan Nama Wilayah" class="form-control">
                        <p class="text-danger"><?= $validation->hasError('nama_wilayah') ? $validation->getError('nama_wilayah') : '' ?></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Warna Wilayah</label>
                        <input name="warna" value="<?= old('warna') ?>" placeholder="Masukan Warna Wilayah" class="form-control my-colorpicker1">
                        <p class="text-danger"><?= $validation->hasError('warna') ? $validation->getError('warna') : '' ?></p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="geojson_file" class="form-label" style="font-weight: bold; font-size: 1.2em; color: #333;">Unggah File GeoJSON</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" name="geojson_file" id="geojson_file" class="custom-file-input" accept=".geojson">
            <label class="custom-file-label" for="geojson_file" id="geojson_file_label">Pilih file GeoJSON...</label>
        </div>
    </div>
    <small class="form-text text-muted mt-2">Pilih file dengan format .geojson untuk diunggah.</small>
                <br>
                <textarea name="geojson" id="geojson_textarea" placeholder="Masukan file geoJSON atau pastekan geoJSON di sini" class="form-control" rows="15"><?= old('geojson') ?></textarea>
                <p class="text-danger"><?= $validation->hasError('geojson') ? $validation->getError('geojson') : '' ?></p>
            </div>
            <button type="submit" class="btn btn-success btn-flat" id="save-button">
                <i class="fa fa-save"></i> Save
            </button>
            <a href="<?= base_url('Wilayah') ?>" class="btn btn-warning btn-flat">
                <i class="fa fa-arrow-left"></i>  Back
            </a>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<!-- SweetAlert Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Initialize color picker
    $('.my-colorpicker1').colorpicker();
    $('.my-colorpicker2').colorpicker();

    // Handle file input change to toggle textarea display
    document.getElementById('geojson_file').addEventListener('change', function() {
        var fileInput = this;
        var textarea = document.getElementById('geojson_textarea');
        if (fileInput.files.length > 0) {
            textarea.style.display = 'none';
        } else {
            textarea.style.display = 'block';
        }
    });

    // Handle form submission with SweetAlert confirmation
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
    document.querySelector('#geojson_file').addEventListener('change', function(e){
        var fileName = document.getElementById("geojson_file").files[0].name;
        document.getElementById("geojson_file_label").innerText = fileName;
    });
</script>
