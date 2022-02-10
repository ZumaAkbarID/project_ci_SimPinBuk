<div class="form my-auto">
    <div class="form-signin">
        <form action="" method="POST">
            <div class="text-center">
                <img class="mb-4" src="<?= base_url(); ?>assets/img/logo.svg" alt="" width="72" height="57">
                <h1 class="h3 mb-3 fw-normal"><?= $title; ?> Form</h1>
            </div>

            <div class="form-floating mb-1">
                <input type="number" name="pin" class="form-control" id="floatingInput" placeholder="1212" required>
                <label for="floatingInput">PIN</label>
                <div class="invalid-feedback">
                    <?= form_error('pin'); ?>
                </div>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password"
                    required>
                <label for="floatingPassword">Password</label>
                <div class="invalid-feedback">
                    <?= form_error('password'); ?>
                </div>
            </div>
            <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Login</button>
            <a href="<?= base_url('auth/register'); ?>" class="iki-link">Belum memiliki akun? <span
                    class="simpinbuk">Register
                    disini</span></a>
        </form>
    </div>
</div>

<script>
<?php if (!empty($this->session->flashdata('error'))) : ?>
Swal.fire({
    icon: 'error',
    title: 'Gagal',
    html: '<?= $this->session->flashdata('error'); ?>',
});
<?php endif; ?>
</script>