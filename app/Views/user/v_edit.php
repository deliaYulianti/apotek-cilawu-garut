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
            <?php echo form_open_multipart('UserControll/UpdateData/'. $user['id']) ?>
            <div class="row">
                <div class="col-sm-8">
                     <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control">
                            <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="superadmin" <?= $user['role'] == 'superadmin' ? 'selected' : '' ?>>Super Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        
                        <label>Fullname</label>
                        <input name="fullname" value="<?= $user['fullname'] ?>" placeholder="Full Name"
                            class="form-control">
                        <p class="text-danger">
                            <?= $validation->hasError('fullname') ? $validation->getError('fullname') : '' ?></p>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input name="username" value="<?= $user['username'] ?>" placeholder="Username"
                            class="form-control">
                        <p class="text-danger">
                            <?= $validation->hasError('username') ? $validation->getError('username') : '' ?></p>
                    </div>

                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" name="email" value="<?= $user['email'] ?>" placeholder="E-mail"
                            class="form-control">
                        <p class="text-danger">
                            <?= $validation->hasError('email') ? $validation->getError('email') : '' ?></p>
                    </div>
                    <div class="form-group">
                        <label>Ganti Foto</label>
                        <!-- Tambahkan ID 'inputFoto' ke input file -->
                        <input type="file" name="foto" id="inputFoto" value="<?= $user['foto'] ?>" placeholder="Foto"
                            class="form-control">
                        <p class="text-danger"><?= $validation->hasError('foto') ? $validation->getError('foto') : '' ?>
                        </p>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Image Preview</h3>
                        </div>
                        <div class="card-body text-center">
                            <!-- Perbarui ID elemen di bagian preview foto -->
                            <img id="previewFoto" src="<?= base_url('foto/'.$user['foto'])?>"
                                class="card-img-top mx-auto d-block" style="width: 150px; border-radius: 50%;">
                            <div id="namaFoto" class="card-text"><?= $user['foto'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-success btn-flat">
        <i class="fa fa-save"></i> Save
    </button>
    <a href="<?= base_url('UserControll') ?>" class="btn btn-warning btn-flat">
        <i class=" fa fa-arrow-left"></i>Back
    </a>
</div>
<?php echo form_close() ?>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>

<!-- jQuery harus diimpor sebelum menggunakan jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Fungsi untuk memperbarui preview foto saat foto dipilih
function previewFoto(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#previewFoto').attr('src', e.target.result); // Memperbarui src img dengan data URL baru
            $('#namaFoto').text(input.files[0].name); // Memperbarui teks dengan nama file baru
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Menghubungkan fungsi previewFoto dengan input file
$(document).ready(function() {
    $('#inputFoto').change(function() {
        previewFoto(this);
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Fungsi untuk memperbarui preview foto saat foto dipilih
function previewFoto(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#previewFoto').attr('src', e.target.result); // Memperbarui src img dengan data URL baru
            $('#namaFoto').text(input.files[0].name); // Memperbarui teks dengan nama file baru
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Menghubungkan fungsi previewFoto dengan input file
$(document).ready(function() {
    $('#inputFoto').change(function() {
        previewFoto(this);
    });

    // Menampilkan peringatan sebelum mengirim form
    $('form').submit(function(e) {
        e.preventDefault(); // Mencegah pengiriman form langsung

        // Menampilkan alert SweetAlert
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menyimpan data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#28a745'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika dikonfirmasi, lanjutkan pengiriman form
                $(this).unbind('submit').submit();
            }
        });
    });
});
</script>
