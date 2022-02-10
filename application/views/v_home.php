<div class="container">

    <div class="px-5 py-5 my-auto text-center">
        <img class="d-block mx-auto mb-4" src="<?= base_url(); ?>assets/img/logo.svg" alt="">
        <h1 class="display-5 fw-bold">
            <?= ($this->session->userdata('nama')) ? "Selamat datang, <br>{$this->session->userdata('nama')}" : 'Simpan Pinjam Buku'; ?>
        </h1>
        <div class="col-lg-6 mx-auto">
            <?php if (!$this->session->userdata('account')) : ?>
            <p class="lead mb-4">Aplikasi sederhana menyimpan dan meminjam buku menggunakan framework CodeIgniter 3.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="<?= base_url(); ?>auth/login" class="btn btn-primary btn-lg px-4 gap-3">Login</a>
                <a href="<?= base_url(); ?>auth/register" class="btn btn-outline-secondary btn-lg px-4">Register</a>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($this->session->userdata('account')) : ?>

    <div class="container px-4 py-5" id="hanging-icons">
        <h2 class="pb-2 border-bottom">Fitur</h2>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="col-lg-3 col-md-6 d-flex align-items-start">
                <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
                    <i class="bi bi-journals"></i>
                </div>
                <div>
                    <h2>Semua Buku</h2>
                    <p>Lihat semua buku yang terdapat pada aplikasi <span class="simpinbuk">SimPinBuk</span>.</p>
                    <a href="<?= base_url(); ?>buku" class="btn btn-primary">
                        Lihat Semua
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 d-flex align-items-start">
                <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
                    <i class="bi bi-bookmark-plus"></i>
                </div>
                <div>
                    <h2>Pinjam Buku</h2>
                    <p>Pinjam buku melalui aplikasi <span class="simpinbuk">SimPinBuk</span>.</p>
                    <a href="<?= base_url(); ?>buku" class="btn btn-primary">
                        Pinjam
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 d-flex align-items-start">
                <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
                    <i class="bi bi-book"></i>
                </div>
                <div>
                    <h2>Simpan Buku</h2>
                    <p>Simpan buku Anda agar dapat dipinjam oleh anggota lain.</p>
                    <a href="<?= base_url(); ?>buku/simpanbuku" class="btn btn-primary">
                        Simpan
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 d-flex align-items-start">
                <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div>
                    <h2>Riwayat</h2>
                    <p>Periksa riwayat Simpan Pinjam yang telah Anda lakukan.</p>
                    <a href="<?= base_url(); ?>riwayat" class="btn btn-primary">
                        Riwayat
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>

</div>