<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>
        <div class="card-body">
            <?php session(); ?>
            <?= view('\Myth\Auth\Views\_message_block') ?>
            <!-- Form -->
            <?php echo form_open_multipart('UserControll/InsertData', ['id' => 'create-form']) ?>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                            <option value="superadmin">Super Admin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control form-control-user <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                    </div>

                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" class="form-control form-control-user <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control form-control-user <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                            <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Repeat Password</label>
                        <div class="input-group">
                            <input type="password" name="pass_confirm" id="pass_confirm" class="form-control form-control-user <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                            <button type="button" class="btn btn-outline-secondary toggle-password" data-target="pass_confirm">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h5 class="card-title">Image Preview</h5>
                        </div>
                        <div class="card-body text-center">
                            <img id="preview" src="<?= base_url('foto/avatar4.png') ?>" alt="Preview Image" class="img-fluid" style="border-radius: 50%;"/>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-flat" id="save-button">
                <i class="fa fa-save"></i> Save
            </button>
            <a href="<?= base_url('UserControll') ?>" class="btn btn-warning btn-flat">
                <i class="fa fa-arrow-left"></i> Back
            </a>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<!-- SweetAlert Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- JavaScript to Preview Image -->
<script>
function previewImage() {
    var fileInput = document.getElementById('foto');
    var preview = document.getElementById('preview');

    if (fileInput.files && fileInput.files[0]) {
        // Jika file dipilih, tampilkan gambar yang baru diunggah
        preview.src = URL.createObjectURL(fileInput.files[0]);
    } else {
        // Jika tidak ada file yang dipilih, tampilkan gambar template
        preview.src = "<?= base_url('foto/avatar4.png') ?>";
    }
}

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

document.addEventListener('DOMContentLoaded', function() {
    const togglePasswordButtons = document.querySelectorAll('.toggle-password');

    togglePasswordButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const targetInput = document.getElementById(targetId);

            // Toggle visibility
            if (targetInput.type === 'password') {
                targetInput.type = 'text';
                this.innerHTML = '<i class="fas fa-eye"></i>';
            } else {
                targetInput.type = 'password';
                this.innerHTML = '<i class="fas fa-eye-slash"></i>';
            }
        });
    });
});
</script>
