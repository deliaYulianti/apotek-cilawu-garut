<div class="col-md-12 mx-auto"> <!-- Tambahkan kelas mx-auto di sini -->
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title"><?= $judul?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php 
                session();
                $validation = \Config\Services::validation();
            ?>
            <?php echo form_open_multipart('Toko/InsertData', ['id' => 'create-form']) ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tipe Apotek</label>
                            <input name="merek" value="<?= old('merek') ?>" placeholder=" Masukan Tipe Apotek" class="form-control" require>
                            <p class="text-danger"><?= $validation->hasError('merek') ? $validation->getError('merek') : '' ?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Marker Apotek</label>
                            <div class="custom-file">
                                <input type="file" name="marker" id="marker" class="custom-file-input" accept=".png" require>
                                <label class="custom-file-label" for="marker" id="markerLabel">Choose file</label>
                            </div>
                            <p class="text-danger"><?= $validation->hasError('marker') ? $validation->getError('marker') : '' ?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Logo Apotek</label>
                            <div class="custom-file">
                                <input type="file" name="logo" id="logo" class="custom-file-input" accept=".png" require>
                                <label class="custom-file-label" for="logo" id="logoLabel">Choose file</label>
                            </div>
                            <p class="text-danger"><?= $validation->hasError('logo') ? $validation->getError('logo') : '' ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title">Preview Marker</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body text-center"> <!-- Menggunakan kelas text-center untuk memusatkan gambar -->
                                <!-- Preview image -->
                                <div id="markerPreview" class="mt-3">
                                    <?php if (isset($markerURL)): ?>
                                        <img src="<?= $markerURL ?>" class="img-fluid card-img-top mx-auto d-block"  style="max-width: 300px; max-height: 300px;" alt="Preview Marker" >
                                    <?php else: ?>
                                        <img src="<?= base_url('marker/default.png') ?>" class="img-fluid card-img-top mx-auto d-block" alt="Contoh Marker" style="max-width: 300px; max-height: 300px;">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title">Preview Logo</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body text-center"> <!-- Menggunakan kelas text-center untuk memusatkan gambar -->
                                <!-- Preview image -->
                                <div id="logoPreview" class="mt-3">
                                    <?php if (isset($logoURL)): ?>
                                        <img src="<?= $logoURL ?>" class="img-fluid card-img-top mx-auto d-block"  style="max-width: 300px; max-height: 300px;" alt="Preview Logo" >
                                    <?php else: ?>
                                        <img src="<?= base_url('icon/default.png') ?>" class="img-fluid card-img-top mx-auto d-block" alt="Contoh Logo" style="max-width: 300px; max-height: 300px;">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <button type="submit" class="btn btn-success btn-flat" id="save-button">
                <i class="fa fa-save"></i> Save
            </button>
            <a href="<?= base_url('Toko') ?>" class="btn btn-warning btn-flat">
                <i class=" fa fa-arrow-left"></i>Back
            </a>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<!-- SweetAlert Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('marker').addEventListener('change', function() {
        var file = this.files[0];
        var fileName = file.name;
        var label = document.getElementById('markerLabel');
        label.innerHTML = fileName;

        if (file) {
            var reader = new FileReader();
            reader.onload = function(event) {
                var imgElement = document.createElement('img');
                imgElement.setAttribute('src', event.target.result);
                imgElement.setAttribute('class', 'img-fluid mt-3');
                imgElement.setAttribute('style', 'max-width: 100%; max-height: 300px;'); // Set the maximum width to 100% and maximum height to 300px
                document.getElementById('markerPreview').innerHTML = '';
                document.getElementById('markerPreview').appendChild(imgElement);
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('markerPreview').innerHTML = '';
        }
    });

    document.getElementById('logo').addEventListener('change', function() {
        var file = this.files[0];
        var fileName = file.name;
        var label = document.getElementById('logoLabel');
        label.innerHTML = fileName;

        if (file) {
            var reader= new FileReader();
            reader.onload = function(event) {
                var imgElement = document.createElement('img');
                imgElement.setAttribute('src', event.target.result);
                imgElement.setAttribute('class', 'img-fluid mt-3');
                imgElement.setAttribute('style', 'max-width: 100%; max-height: 300px;'); // Set the maximum width to 100% and maximum height to 300px
                document.getElementById('logoPreview').innerHTML = '';
                document.getElementById('logoPreview').appendChild(imgElement);
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('logoPreview').innerHTML = '';
        }
    });

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

