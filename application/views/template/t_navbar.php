<nav class="navbar navbar-expand-lg p-0 navbar-dark mb-5 sticky-top border-bottom">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url(); ?>">
            <img src="<?= base_url(); ?>assets/img/logo.svg" alt="" class="navbar-brand" width="50">
            <b>SimPinBuk</b>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav mx-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <?php if ($this->session->userdata('account')) : ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($title == 'Beranda') ? 'active' : ''; ?>" aria-current="page"
                        href="<?= base_url(); ?>"><i class="bi bi-house"></i>
                        Beranda</a>
                </li>

                <?php if ($this->session->userdata('role') == 'Member' && $title !== 'Beranda') : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link nlink dropdown-toggle <?= ($title == 'Semua Buku' || $title == 'Simpan Buku' || $title == 'Perbarui Buku' || $title == 'Riwayat') ? 'active' : ''; ?>"
                        href="javascript:void(0)" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Menu
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item <?= ($title == 'Semua Buku') ? 'active' : ''; ?>"
                                href="<?= base_url(); ?>buku">Lihat Daftar Buku</a></li>
                        <li><a class="dropdown-item <?= ($title == 'Simpan Buku' || $title == 'Perbarui Buku') ? 'active' : ''; ?>"
                                href="<?= base_url(); ?>buku/simpanbuku">Simpan Buku</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item <?= ($title == 'Riwayat') ? 'active' : ''; ?>"
                                href="<?= base_url(); ?>riwayat">Riwayat</a></li>
                    </ul>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link nlink" aria-current="page" href="<?= base_url(); ?>">Lihat Daftar Buku</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nlink" aria-current="page" href="<?= base_url(); ?>">Riwayat Pinjam</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nlink" aria-current="page" href="<?= base_url(); ?>">Pinjamkan Buku</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nlink" aria-current="page" href="<?= base_url(); ?>">Riwayat Meminjamkan</a>
                </li> -->
                <?php endif; ?>
                <?php endif; ?>

            </ul>
            <div class="d-flex">
                <?php if ($this->session->userdata('account')) : ?>
                <a class="btn btn-info" href="<?= base_url('auth/logout'); ?>"><b>
                        <i class="bi bi-box-arrow-right"></i>
                        Keluar</b></a>
                <?php endif; ?>
                <?php if ($title == 'Login') : ?>
                <a class="btn btn-info" href="<?= base_url('auth/register'); ?>"><b>
                        <i class="bi bi-person-circle"></i>
                        Register</b></a>
                <?php endif; ?>
                <a href="" id="navHiddenButton" class="btn btn-info"></a>
            </div>
        </div>
    </div>
</nav>