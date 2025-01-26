<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title"><?= $judul?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- Form -->
            <?php 
                session();
                $validation = \Config\Services::validation();
            ?>
            <?php echo form_open_multipart('Toko/UpdateData/'.$toko['id_merek'], ['id' => 'edit-form']) ?>
            <div class="row">
                <div class="col-md-4">    
                    <div class="form-group">
                        <label>Tipe Apotek</label>
                        <input name="merek" value="<?= $toko['merek'] ?>"  class="form-control">
                        <p class="text-danger"><?= $validation->hasError('merek') ? $validation->getError('merek') : '' ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Marker Apotek</label>
                        <!-- Ganti name menjadi marker -->
                        <input type="file" id="inputFileMarker" name="marker" class="form-control">
                        <p class="text-danger"><?= $validation->hasError('marker') ? $validation->getError('marker') : '' ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Logo Apotek</label>
                        <!-- Tambah form untuk upload logo -->
                        <input type="file" id="inputFileLogo" name="logo" class="form-control">
                        <p class="text-danger"><?= $validation->hasError('logo') ? $validation->getError('logo') : '' ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Marker View</h3>
                        </div>
                        <div class="card-body">
                            <!-- Image Display untuk marker -->
                            <div id="imagePreviewMarker" class="text-center">
                                <?php if (!empty($toko['marker'])): ?>
                                    <img src="<?= base_url('marker/' . $toko['marker']) ?>" alt="Marker Image" class="img-fluid" style="max-width: 150px; max-height: 150px;">
                                    <p><?= $toko['marker'] ?></p>
                                <?php else: ?>
                                    <img src="#" alt="Marker Image" class="img-fluid">
                                    <p>Pilih gambar untuk ditampilkan</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Logo View</h3>
                        </div>
                        <div class="card-body">
                            <!-- Image Display untuk logo -->
                            <div id="imagePreviewLogo" class="text-center">
                                <?php if (!empty($toko['logo'])): ?>
                                    <img src="<?= base_url('icon/' . $toko['logo']) ?>" alt="Logo Image" class="img-fluid" style="max-width: 150px; max-height: 150px;">
                                    <p><?= $toko['logo'] ?></p>
                                <?php else: ?>
                                    <img src="#" alt="Logo Image" class="img-fluid">
                                    <p>Pilih gambar untuk ditampilkan</p>
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
                <i class="fa fa-arrow-left"></i> Back
            </a>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<!-- SweetAlert Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById("inputFileMarker").addEventListener('change', function() {
        var file = this.files[0];
        var imageType = /image.*/;

        if (file.type.match(imageType)) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = new Image();
                img.src = reader.result;
                img.onload = function() {
                    var maxWidth = 400;
                    var maxHeight = 300;
                    var ratio = Math.min(maxWidth / img.width, maxHeight / img.height);
                    var width = img.width * ratio;
                    var height = img.height * ratio;
                    document.getElementById('imagePreviewMarker').innerHTML = '<img src="' + img.src + '" alt="Marker Image" class="img-fluid" style="max-width: ' + width + 'px; max-height: ' + height + 'px;">';
                };
            };

            reader.readAsDataURL(file);
        } else {
            alert("Please select an image file.");
        }
    });

    // Script untuk preview logo
    document.getElementById("inputFileLogo").addEventListener('change', function() {
        var file = this.files[0];
        var imageType = /image.*/;

        if (file.type.match(imageType)) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = new Image();
                img.src = reader.result;
                img.onload = function() {
                    var maxWidth = 400;
                    var maxHeight = 300;
                    var ratio = Math.min(maxWidth / img.width, maxHeight / img.height);
                    var width = img.width * ratio;
                    var height = img.height * ratio;
                    document.getElementById('imagePreviewLogo').innerHTML = '<img src="' + img.src + '" alt="Logo Image" class="img-fluid" style="max-width: ' + width + 'px; max-height: ' + height + 'px;">';
                };
            };

            reader.readAsDataURL(file);
        } else {
            alert("Please select an image file.");
        }
    });

    document.getElementById('save-button').addEventListener('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to save the changes?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('edit-form').submit();
            }
        });
    });
</script>
