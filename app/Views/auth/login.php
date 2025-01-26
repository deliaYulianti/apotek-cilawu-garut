<?= $this->extend('auth/template/index') ?>
<?= $this->section('content'); ?>

<section class="bg-success py-2 py-md-5 py-xl-8">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 col-xl-7">
                <div class="d-flex justify-content-center text-bg-success">
                    <div class="col-12 col-xl-9">
                        <div class="row">
                            <div class="col-md-3">
                                <img class="img-fluid rounded mb-4" loading="lazy"
                                    src="<?= base_url() ?>/icon/dpmptsp.png" width="100%" height="100%"
                                    alt="BootstrapBrain Logo">
                            </div>
                            <div class="col-md-9">
                                <h2 class="h1 ">PEMERINTAH KABUPATEN GARUT</h2>
                            </div>
                        </div>
                        <hr class="border-success-subtle mb-4">
                        <h2 class="h1 mb-4">Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu</h2>
                        <p class="lead mb-5">PETA POTENSI DAN PELUANG INVESTASI (PETA DIGITAL INVESTASI) DINAS PENANAMAN
                            MODAL DAN PELAYANAN TERPADU SATU
                            PINTU KABUPATEN GARUT</p>
                        <div class="text-endx">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor"
                                class="bi bi-grip-horizontal" viewBox="0 0 16 16">
                                <path
                                    d="M2 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 ">
                <div class="card border-0 rounded-4">
                    <div class="card-body p-3 p-md-4 p-xl-5">
                        <div class="text-center mb-4">
                            <h3><?= lang('Auth.loginTitle') ?></h3>
                        </div>
                        <?= view('Myth\Auth\Views\_message_block') ?>
                        <form action="<?= url_to('login') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="form-floating mb-3">
                                <?php if ($config->validFields === ['email']) : ?>
                                <input type="email"
                                    class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                                    name="login" placeholder="<?= lang('Auth.email') ?>">
                                <?php else : ?>
                                <input type="text"
                                    class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                                    name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                                <?php endif; ?>
                                <label for="login"><?= lang('Auth.emailOrUsername') ?></label>
                                <div class="invalid-feedback">
                                    <?= session('errors.login') ?>
                                </div>
                            </div>
                            <div class="form-floating mb-3 position-relative">
    <input type="password"
        class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
        name="password" id="password" placeholder="<?= lang('Auth.password') ?>">
    <label for="password"><?= lang('Auth.password') ?></label>
    <div class="invalid-feedback">
        <?= session('errors.password') ?>
    </div>
    <span id="togglePassword" class="position-absolute" style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;">
        <i class="fa fa-eye-slash" aria-hidden="true"></i>
    </span>
</div>
                            <?php if ($config->allowRemembering) : ?>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" name="remember"
                                    <?php if (old('remember')) : ?> checked <?php endif ?>>
                                <label class="form-check-label text-secondary"
                                    for="remember"><?= lang('Auth.rememberMe') ?></label>
                            </div>
                            <?php endif; ?>
                            <div class="d-grid">
                                <?php if (!logged_in()) : ?>
                                <button class="btn btn-success btn-lg"
                                    type="submit"><?= lang('Auth.loginAction') ?></button>
                                <?php endif; ?>
                            </div>
                        </form>
                        <hr>


                        <div class="row justify-content-center">
                            <?php if ($config->allowRegistration) : ?>
                            <div class="col-12 mb-3">
                                <p>Don't have an account? <a
                                        href="<?= url_to('register') ?>"><?= lang('Auth.needAnAccount') ?></a></p>
                            </div>
                            <?php endif; ?>
                            <?php if ($config->activeResetter) : ?>
                            <div class="col-12">
                                <p><a href="<?= url_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a></p>
                            </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class=" text-black py-4">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <strong>Copyright &copy; <?= date('Y') ?> <a href="<?= base_url() ?>"><?= $web['nama_web'] ?></a>.</strong>
                All rights reserved.
            </div>
        </div>
    </div>
</footer>
<script>
    document.getElementById('togglePassword').addEventListener('click', function (e) {
        const passwordField = document.getElementById('password');
        const passwordFieldType = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', passwordFieldType);
        
        const icon = e.target;
        if (passwordFieldType === 'password') {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
<?= $this->endSection(); ?>