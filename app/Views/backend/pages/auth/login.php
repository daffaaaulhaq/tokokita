<?php $this->extend('backend/layout/auth-layout') ?>
<?php $this->section('content') ?>

<div class="login-box bg-white box-shadow border-radius-10">
    <div class="login-title">
        <h2 class="text-center text-primary">Login</h2>
    </div>

    <?php $validation = \Config\Services::validation(); ?>

    <!-- Form Start -->
    <form action="" method="POST">
        <?= csrf_field() ?>

        <!-- Success Alert -->
        <?php if (!empty(session()->getFlashdata('success'))): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <!-- Failure Alert -->
        <?php if (!empty(session()->getFlashdata('fail'))): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('fail') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <!-- Username or Email Input -->
        <div class="input-group custom mb-3">
            <input 
                type="text" 
                class="form-control form-control-lg" 
                placeholder="Username or Email" 
                name="login_id" 
                value="<?= set_value('login_id') ?>"
            >
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
            </div>
        </div>
        <?php if ($validation->getError('login_id')): ?>
            <div class="text-danger mb-3">
                <?= $validation->getError('login_id') ?>
            </div>
        <?php endif; ?>

        <!-- Password Input -->
        <div class="input-group custom mb-3">
            <input 
                type="password" 
                class="form-control form-control-lg" 
                placeholder="**********" 
                name="password" 
                value="<?= set_value('password') ?>"
            >
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
            </div>
        </div>
        <?php if ($validation->getError('password')): ?>
            <div class="text-danger mb-3">
                <?= $validation->getError('password') ?>
            </div>
        <?php endif; ?>

        <!-- Submit Button -->
        <div class="row">
            <div class="col-sm-12">
                <input 
                    class="btn btn-primary btn-lg btn-block" 
                    type="submit" 
                    value="Sign In"
                >
            </div>
        </div>
    </form>
</div>

<?php $this->endSection() ?>
