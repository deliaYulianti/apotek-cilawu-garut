<?= $this-> extend('auth/template/index')?>
<?= $this->section('content'); ?>
<style>
a {
    text-decoration: none;
}

.login-page {
    width: 100%;
    height: 100vh;
    display: inline-block;
    display: flex;
    align-items: center;
}

.form-right i {
    font-size: 100px;
}
</style>
<div class="login-page bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <h3 class="mb-3"><?=lang('Auth.register')?></h3>
                <div class="bg-white shadow rounded">
                    <div class="row">
                        <div class="col-md-7 pe-0">
                            <div class="form-left h-100 py-5 px-5">
                                <?= view('Myth\Auth\Views\_message_block') ?>
                                <form action="<?= url_to('register') ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="col-12">
                                        <label for="email"><?=lang('Auth.email')?></label>
                                        <div class="input-group">
                                            <div type="email" class="input-group-text"><i class="fas fa-envelope"></i>
                                            </div>
                                            <input type="email"
                                                class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                                                name="email" aria-describedby="emailHelp"
                                                placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="username"><?=lang('Auth.username')?></label>
                                        <div class="input-group">
                                            <div type="text" class="input-group-text"><i class="fas fa-user"></i>
                                            </div>
                                            <input type="text"
                                                class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>"
                                                name="username" placeholder="<?=lang('Auth.username')?>"
                                                value="<?= old('username') ?>">
                                        </div>
                                    </div>

                                    <div class="col-12">
    <label for="password"><?= lang('Auth.password') ?></label>
    <div class="input-group">
        <div class="input-group-text"><i class="fas fa-lock"></i></div>
        <input type="password" name="password" id="password"
            class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
            placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
        <span id="togglePassword" class="input-group-text" style="cursor: pointer;">
            <i class="fa fa-eye-slash" aria-hidden="true"></i>
        </span>
    </div>
</div>
<div class="col-12">
    <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
    <div class="input-group">
        <div class="input-group-text"><i class="fas fa-lock"></i></div>
        <input type="password" name="pass_confirm" id="pass_confirm"
            class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"
            placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
        <span id="togglePassConfirm" class="input-group-text" style="cursor: pointer;">
            <i class="fa fa-eye-slash" aria-hidden="true"></i>
        </span>
    </div>
</div>
                                    <hr>
                                    <div class="row justify-content-end">
                                        <div class="col-4 text-end">
                                            <button type="submit"
                                                class="btn btn-success"><?=lang('Auth.register')?></button>
                                        </div>
                                    </div>
                                    <br>
                                    <p><?=lang('Auth.alreadyRegistered')?> <a
                                            href="<?= url_to('login') ?>"><?=lang('Auth.signIn')?></a></p>

                                </form>
                            </div>
                        </div>
                        <div class="col-md-5 ps-0 d-none d-md-block">
                            <div class="form-right h-100 bg-success text-white text-center pt-5">
                                <img src="<?= base_url() ?>/icon/dpmptsp.png" width="250" height="60%"
                                    alt="Logo Kabupaten Garut">
                                <br>
                                <br>
                                <h3>Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu</h3>
                            </div>
                        </div>

                    </div>
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