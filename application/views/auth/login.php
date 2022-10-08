<?= $this->session->flashdata('pesan_notifikasi'); ?>
<!-- /.login-logo -->
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <a href="#" class="h1"><?= $judul; ?></a>
    </div>
    <div class="card-body">
        <p class="login-box-msg">Masukkan username dan password</p>

        <form action="<?= base_url('auth'); ?>" method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="username" value="<?= set_value('username'); ?>" placeholder="Username">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
            <small class="text-danger"><?= form_error('username'); ?>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <small class="text-danger"><?= form_error('password'); ?>
                    <div class="row">
                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <!-- /.col -->
                    </div>
        </form>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.login-box -->