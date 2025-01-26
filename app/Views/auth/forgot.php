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
                <h3 class="mb-3"><?=lang('Auth.forgotPassword')?></h3>
                <div class="bg-white shadow rounded">
                    <div class="row">
                        <div class="col-md-7 pe-0">
                            <div class="form-left h-100 py-5 px-5">
                                <?= view('Myth\Auth\Views\_message_block') ?>

                                <p><?=lang('Auth.enterEmailForInstructions')?></p>
                                <form action="<?= url_to('forgot') ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="col-12">
                                        <label for="email"><?=lang('Auth.emailAddress')?></label>
                                        <div class="input-group">
                                            <div type="email" class="input-group-text"><i class="fas fa-envelope"></i>
                                            </div>
                                            <input type="email"
                                                class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                                                name="email" aria-describedby="emailHelp"
                                                placeholder="<?=lang('Auth.email')?>">
                                            <div class="invalid-feedback">
                                                <?= session('errors.email') ?>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row justify-content-end">
                                        <div class="col-4 text-end">
                                            <button type="submit"
                                                class="btn btn-success"><?=lang('Auth.sendInstructions')?></button>
                                        </div>
                                    </div>
                                    <br>
                                    <p>Back To <a href="<?= url_to('login') ?>"><?=lang('Auth.signIn')?></a></p>

                                </form>
                            </div>
                        </div>
                        <div class="col-md-5 ps-0 d-none d-md-block">
                            <div class="form-right h-100 bg-success text-white text-center pt-5">
                                <img src="<?= base_url() ?>/icon/forgot2.png" width="100%" height="100%" alt="Forgot">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>