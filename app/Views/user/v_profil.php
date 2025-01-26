<style>
.custom-container {
    max-width: 1700px;
    /* Sesuaikan dengan lebar yang Anda inginkan */
    margin-right: auto;
    margin-left: auto;
}

.nav-pills .nav-link.active {
    background-color: #28a745;
    /* Warna success */
    color: #fff;
    /* Warna teks putih */
}
</style>

<div class="container custom-container">
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">My Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="#update" data-toggle="tab">Update Data</a></li>
                <li class="nav-item"><a class="nav-link" href="#reset" data-toggle="tab">Reset Pasword</a></li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body p-5">
            <?php 
                
                  // notif update
                  if (session()->getFlashdata('update')) {
                    echo '<div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> ';
                    echo session()->getFlashdata('update');
                    echo '</h5></div>';
                  }
                  
                ?>
            <div class="tab-content">

                <div class="tab-pane active" id="profile">
                    <?php 
                session();
                $validation = \Config\Services::validation();
            ?>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td><b>Role</b></td>
                                <td><?= $user['group_name'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Foto</b></td>
                                <td>
                                    <img src="<?= base_url('foto') . '/' . user()->foto ?>"
                                        class="img-fluid img-thumbnail" alt="User Profile Picture"
                                        style="width: 100px; height: 100px;">
                                </td>
                            </tr>
                            <tr>
                                <td><b>Fullname</b></td>
                                <td><?= user()->fullname ?></td>
                            </tr>
                            <tr>
                                <td><b>Username</b></td>
                                <td><?= user()->username ?></td>
                            </tr>
                            <tr>
                                <td><b>Email</b></td>
                                <td><?= user()->email ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="update">
                   <?php echo form_open_multipart('UserControll/UpdateData/'. $user['id'], ['id' => 'updateForm']) ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="fullname" class="col-md-2 col-form-label">Fullname</label>
                                <div class="col-md-10">
                                    <input type="text" name="fullname" id="fullname" value="<?= $user['fullname'] ?>"
                                        placeholder="Full Name" class="form-control">
                                </div>
                                <div class="col-md-10 offset-md-3">
                                    <p class="text-danger">
                                        <?= $validation->hasError('fullname') ? $validation->getError('fullname') : '' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-md-2 col-form-label">Username</label>
                                <div class="col-md-10">
                                    <input type="text" name="username" id="username" value="<?= $user['username'] ?>"
                                        placeholder="Username" class="form-control">
                                </div>
                                <div class="col-md-10 offset-md-3">
                                    <p class="text-danger">
                                        <?= $validation->hasError('username') ? $validation->getError('username') : '' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label">E-mail</label>
                                <div class="col-md-10">
                                    <input type="email" name="email" id="email" value="<?= $user['email'] ?>"
                                        placeholder="E-mail" class="form-control">
                                </div>
                                <div class="col-md-10 offset-md-3">
                                    <p class="text-danger">
                                        <?= $validation->hasError('email') ? $validation->getError('email') : '' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top: 20px;">
                                <label for="foto" class="col-md-2 col-form-label">Ganti Foto</label>
                                <div class="col-md-10">
                                    <input type="file" name="foto" id="foto" value="<?= $user['foto'] ?>"
                                        class="form-control">
                                </div>
                                <div class="col-md-10 offset-md-3">
                                    <p class="text-danger">
                                        <?= $validation->hasError('foto') ? $validation->getError('foto') : '' ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-outline card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Foto Preview</h3>
                                </div>
                                <div class="card-body text-center">
                                    <img id="previewFoto" src="<?= base_url('foto/'.$user['foto'])?>"
                                        class="card-img-top mx-auto d-block" style="width: 150px;">
                                    <div id="namaFoto" class="card-text"><?= $user['foto'] ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" id="saveButton">
    <i class="fa fa-save"></i> Save
</button>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Event saat tombol Save diklik
    document.getElementById('saveButton').addEventListener('click', function() {
        // Menampilkan Sweet Alert
        Swal.fire({
            title: 'Are you sure?',
            text: 'Once saved, you won\'t be able to revert!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then((result) => {
            // Jika pengguna mengklik tombol "Yes"
            if (result.isConfirmed) {
                // Submit form
                document.getElementById('updateForm').submit();
            }
        });
    });
</script>
                    <?php echo form_close() ?>
                </div>
                <div class="tab-pane" id="reset">
                    <div class="login-box">
                        <div class="card card-outline card-success">
                            <div class="card-header text-center">
                                <a href="" class="h1"><b>SIG</b>Market</a>
                            </div>
                            <div class="card-body">
                                <p><?=lang('Auth.enterEmailForInstructions')?></p>
                                <form action="<?= url_to('forgot') ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="input-group mb-3">
                                        <input type="email"
                                            class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                                            name="email" aria-describedby="emailHelp"
                                            placeholder="<?=lang('Auth.email')?>">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"><?= session('errors.email') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn btn-success btn-block"><?=lang('Auth.sendInstructions')?></button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>
                            </div>
                            <!-- /.login-card-body -->
                        </div>
                    </div>
                </div>


            </div>
        </div><!-- /.card-body -->
    </div><!-- /.card -->
</div><!-- /.container -->