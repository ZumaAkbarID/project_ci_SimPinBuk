<main class="container">
    <div class="text-center">
        <img class="d-block mx-auto mb-4" src="<?= base_url(); ?>assets/img/logo.svg" alt="" width="72" height="57">
        <h2><?= $title; ?> Form</h2>
    </div>

    <div class="row g-5">
        <div class="col-md-8 col-lg-8">
            <form action="" method="POST">
                <div class="row g-3">
                    <div class="col-6">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap"
                            placeholder="Masukkan nama lengkap Anda..." required>
                    </div>

                    <div class="col-6">
                        <label for="pin" class="form-label">Buat PIN</label>
                        <input type="number" class="form-control" id="pin" name="pin" maxlength="6"
                            placeholder="PIN Hanya Angka Max 6" required>
                    </div>

                    <div class="col-6">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Password" required>
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="repeat_password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="repeat_password" id="repeat_password" class="form-control"
                                placeholder="Ulangi Password" required>
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="1">Laki-Laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
                    </div>

                </div>

                <hr class="my-4">

                <button class="w-100 btn btn-primary btn-lg mb-3" type="submit">Register</button>
                <a href="<?= base_url('auth/login'); ?>" class="iki-link">Sudah memiliki akun? <span
                        class="simpinbuk">Login
                        disini</span></a>
            </form>
        </div>
        <div class="col-md-4 col-lg-4">
            <h3>Cara Daftar <span class="simpinbuk"><b>SimPinBuk</b></span></h3>
            <ol>
                <li>Masukkan nama lengkap Anda.</li>
                <li>Buat PIN Anda (max. 6 angka).</li>
                <li>Buat password Anda.</li>
                <li>Pilih jenis kelamin sesuai jenis kelamin Anda.</li>
                <li>Masukkan Tanggal Lahir sesuai Tanggal Lahir Anda.</li>
                <li>Jika sudah terisi semua tekan tombol Register.</li>
                <li>Jika muncul popup <b class="simpinbuk">"Berhasil"</b>, berarti akun Anda berhasil dibuat.</li>
                <li>Silahkan login menggunakan data yang telah Anda daftarkan.</li>
            </ol>
        </div>
    </div>
</main>

<script>
<?php if (!empty($this->session->flashdata('error'))) : ?>
Swal.fire({
    icon: 'error',
    title: 'Gagal',
    html: '<?= $this->session->flashdata('error'); ?>',
});
<?php endif; ?>

<?php if (!empty($this->session->flashdata('success'))) : ?>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    html: '<?= $this->session->flashdata('success'); ?>',
});
<?php endif; ?>
</script>