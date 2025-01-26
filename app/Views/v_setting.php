<style>
    /* Style untuk label */
    label {
        font-weight: bold;
    }

    /* Style untuk gambar lama */
    .custom-img-style {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px;
        background-color: #f9f9f9;
        max-width: 200px;
        margin-bottom: 10px;
    }

    /* Style untuk input file */
    input[type="file"] {
        display: none;
    }

    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
        background-color: #f9f9f9;
        border-radius: 5px;
    }

    .custom-file-upload:hover {
        background-color: #e9e9e9;
    }

    /* Style untuk marker */
    .custom-marker {
        width: 12px;
        /* Ukuran default untuk marker */
        height: 12px;
    }

    /* Media query untuk menyesuaikan ukuran marker berdasarkan zoom level */
    @media (min-width: 768px) {
        .leaflet-container .leaflet-marker-icon.custom-marker {
            width: 18px;
            height: 18px;
        }
    }

    @media (min-width: 992px) {
        .leaflet-container .leaflet-marker-icon.custom-marker {
            width: 24px;
            height: 24px;
        }
    }

    @media (min-width: 1200px) {
        .leaflet-container .leaflet-marker-icon.custom-marker {
            width: 32px;
            height: 32px;
        }
    }
</style>


<?php if (in_groups('admin')) : ?>
    <div class="col-md-12">
    <?php elseif (in_groups('superadmin')) : ?>
        <div class="col-md-8">
        <?php endif; ?>
        <!-- Card untuk Setting Web -->
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Setting Web</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('pesan')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> <?= session()->getFlashdata('pesan'); ?></h5>
                    </div>
                <?php endif; ?>
                <?php echo form_open_multipart('Admin/UpdateSetting', ['id' => 'save-web']) ?> <!-- Tambahkan atribut enctype untuk pengiriman file -->
                <div class="row">
                    <!-- Kolom untuk preview gambar dan unggah gambar -->
                    <div class="col-sm-4 text-center">
                        <div class="form-group">
                            <label for="logo">Preview</label><br>
                            <!-- Tampilkan gambar lama jika ada -->
                            <?php if (!empty($web['logo'])): ?>
                                <img id="preview-logo" src="<?= base_url('AdminLTE/dist/img/' . $web['logo']) ?>" alt="Old Logo" class="custom-img-style"><br>
                            <?php endif; ?>
                            <!-- Tombol unggah gambar kustom -->
                            <label class="custom-file-upload">
                                <input type="file" name="logo" id="logo" onchange="previewImage(this)">Unggah Gambar
                            </label>
                        </div>
                    </div>

                    <!-- Kolom untuk form lainnya -->
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama Website</label>
                                    <input name="nama_web" value="<?= $web['nama_web'] ?>" class="form-control" placeholder="Nama Website" required>
                                </div>
                                <div class="form-group">
                                    <label>Koordinat Wilayah</label>
                                    <input name="koordinat_wilayah" value="<?= $web['koordinat_wilayah'] ?>" class="form-control" placeholder="Koordinat Wilayah" required>
                                </div>
                                <div class="form-group">
                                    <label>Size Marker</label>
                                    <input type="number" value="<?= $web['zoom_marker'] ?>" name="zoom_marker" class="form-control" placeholder="Size Marker" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Zoom View</label>
                                    <input type="number" value="<?= $web['zoom_view'] ?>" name="zoom_view" class="form-control" placeholder="Zoom View" required>
                                </div>
                                <!-- <div class="form-group">
                                    <label>Jarak Pasar (meter)</label>
                                    <input type="number" name="jarakpasar" value="<?= $web['jarakpasar'] ?>" class="form-control" placeholder="Jarak Pasar" required>
                                </div>
                                <div class="form-group">
                                    <label>Jarak Minimarket (Meter)</label>
                                    <input type="number" value="<?= $web['jarakminimarket'] ?>" name="jarakminimarket" class="form-control" placeholder="Jarak Minimarket" required>
                                </div> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" value="<?= $web['title'] ?>" class="form-control" placeholder="Title" required>
                        </div>
                        <!-- Bagian Informasi -->
                        <div class="form-group">
                            <label>Informasi</label>
                            <textarea name="informasi" class="form-control" placeholder="Informasi" required><?= $web['informasi'] ?></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> Save
                </button>
                <?php echo form_close() ?>
            </div>
        </div>
        </div>

        <?php if (in_groups('superadmin')) : ?>
            <div class="col-md-4">
                <!-- Card untuk Setting Email -->
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Setting Sender's Email</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if (session()->getFlashdata('email')): ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> <?= session()->getFlashdata('email'); ?></h5>
                            </div>
                        <?php endif; ?>
                        <?php echo form_open_multipart('Admin/UpdateEmail', ['id' => 'save-email']) ?>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="<?= $web['email'] ?>" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label>For Name</label>
                            <input name="name" value="<?= $web['name'] ?>" class="form-control" placeholder="For Name" required>
                        </div>
                        <div class="form-group">
                            <label>App Password</label>
                            <input name="apppassword" value="<?= $web['apppassword'] ?>" class="form-control" placeholder="App Password" required>
                        </div>
                        <div class="form-group">
                            <label>SMTPHost</label>
                            <input name="SMTPHost" value="<?= $web['SMTPHost'] ?>" class="form-control" placeholder="SMTPHost" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>SMTPPort</label>
                                    <input type="number" name="SMTPPort" value="<?= $web['SMTPPort'] ?>" class="form-control" placeholder="SMTPPort" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>SMTPCrypto</label>
                                    <input name="SMTPCrypto" value="<?= $web['SMTPCrypto'] ?>" class="form-control" placeholder="SMTPCrypto" required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Save
                        </button>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-12">
            <!-- Map Section -->
            <div id="map" style="width: 100%; height: 730px;"></div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

            var layerControl = L.control.layers(baseMaps, null, {
                position: 'topleft'
            }).addTo(map);

            // Contoh menggunakan ikon default dengan ukuran disesuaikan
            var marker = L.marker([<?= $web['koordinat_wilayah'] ?>], {
                icon: L.icon({
                    iconUrl: '<?= base_url('marker/new.png') ?>', // URL ikon gambar
                    iconSize: <?= $web['zoom_marker'] ?>, // Ukuran ikon [lebar, tinggi] dalam piksel
                    iconAnchor: [15, 30], // Anchor point dari ikon di mana marker ditempatkan
                    popupAnchor: [0, -30] // Anchor point untuk popup
                })
            }).addTo(map);

            // Event listener untuk tombol Save pada form Setting Web
            // Event listener untuk form Setting Web
            document.getElementById('save-web').addEventListener('submit', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to save the Setting Web data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, save it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });

            // Event listener untuk form Setting Email (hanya untuk Superadmin)
            <?php if (in_groups('superadmin')) : ?>
                document.getElementById('save-email').addEventListener('submit', function(event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you want to save the Setting Sender's Email data?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, save it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            <?php endif; ?>



            // Fungsi untuk menampilkan preview gambar sebelum diunggah
            function previewImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#preview-logo')
                            .attr('src', e.target.result)
                            .addClass('custom-img-style');
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>