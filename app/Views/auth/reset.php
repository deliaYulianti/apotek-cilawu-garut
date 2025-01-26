<?= $this->extend('auth/template/index')?>
<?= $this->section('content'); ?>
<style>
body {

    background: linear-gradient(to right, #50cc7f, #f5cc70);
}

.card-login {
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 15px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
}

.btn-login {
    font-size: 0.9rem;
    letter-spacing: 0.05rem;
    padding: 0.75rem 1rem;
}
</style>
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-sm-9 col-md-7 col-lg-5">
            <div class="card card-login border-0 shadow rounded-3 my-5">


                <div class="card-body p-4 p-sm-5">
                    <h5 class=" text-center mb-5 fw-light fs-5"><?=lang('Auth.resetYourPassword')?></h5>
                    <?= view('Myth\Auth\Views\_message_block') ?>
                    <p><?=lang('Auth.enterCodeEmailPassword')?></p>
                    <form action="<?= url_to('reset-password') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-floating mb-3">
                            <input type="text"
                                class="form-control <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>"
                                name="token" placeholder="<?=lang('Auth.token')?>"
                                value="<?= old('token', $token ?? '') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors.token') ?>
                            </div>
                            <label for="token"><?=lang('Auth.token')?></label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email"
                                class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                                name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>"
                                value="<?= old('email') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors.email') ?>
                            </div>
                            <label for="email"><?=lang('Auth.email')?></label>
                        </div>
                        <hr>
                        <div class="form-floating mb-3 position-relative">
    <input type="password"
        class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
        name="password" id="password">
    <label for="password"><?= lang('Auth.newPassword') ?></label>
    <div class="invalid-feedback">
        <?= session('errors.password') ?>
    </div>
    <span id="togglePassword" class="position-absolute" style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;">
        <i class="fa fa-eye-slash" aria-hidden="true"></i>
    </span>
</div>
<div class="form-floating mb-3 position-relative">
    <input type="password"
        class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"
        name="pass_confirm" id="pass_confirm">
    <label for="pass_confirm"><?= lang('Auth.newPasswordRepeat') ?></label>
    <div class="invalid-feedback">
        <?= session('errors.pass_confirm') ?>
    </div>
    <span id="togglePassConfirm" class="position-absolute" style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;">
        <i class="fa fa-eye-slash" aria-hidden="true"></i>
    </span>
</div>


                        <div class="d-grid">
                            <button type="submit"
                                class="btn btn-success btn-block"><?=lang('Auth.resetPassword')?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('togglePassword').addEventListener('click', function (e) {
        const passwordField = document.getElementById('password');
        const passwordFieldType = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', passwordFieldType);
        
        const icon = e.target.tagName === 'I' ? e.target : e.target.querySelector('i');
        if (passwordFieldType === 'password') {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    document.getElementById('togglePassConfirm').addEventListener('click', function (e) {
        const passConfirmField = document.getElementById('pass_confirm');
        const passConfirmFieldType = passConfirmField.getAttribute('type') === 'password' ? 'text' : 'password';
        passConfirmField.setAttribute('type', passConfirmFieldType);
        
        const icon = e.target.tagName === 'I' ? e.target : e.target.querySelector('i');
        if (passConfirmFieldType === 'password') {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
<?= $this->endSection(); ?>