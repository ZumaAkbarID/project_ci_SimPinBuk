<div class="row">

    <?php if (empty($dataBuku) || !isset($dataBuku)) : ?>
    <div class="d-flex justify-content-center" style="margin-top: 20%;">
        <div class="alert alert-danger p-5"><b>Data tidak ditemukan</b></div>
    </div>
    <?php endif; ?>

    <?php foreach ($dataBuku as $dB) : ?>
    <div class="col-lg-4">
        <div class="card mb-3 p-2" style="max-width: 540px; min-height: 400px;">
            <div class="row g-0">
                <div class="col-md-5">
                    <img src="<?= base_url(); ?>assets/img/buku/<?= $dB->gambar; ?>" class="cover-buku rounded"
                        width="100%" height="100%" alt="<?= $dB->judul; ?>">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title"><?= $dB->judul; ?></h5>
                        <p class="rodok-ireng"><?= $dB->deskripsi; ?></p>
                        <ul class="ireng unlisted">
                            <li>Pengarang : <?= $dB->pengarang; ?></li>
                            <li>Tahun Terbit : <?= $dB->tahun_terbit; ?></li>
                            <li>Pemilik : <?= $dB->nama; ?></li>
                            <li>Status :
                                <?= ($dB->status == 1) ? '<span class="btn btn-success btn-sm p-0">Tersedia</span>' : '<span class="btn btn-warning p-1">Tidak tersedia</span>'; ?>
                            </li>
                            <?php if ($this->session->userdata('nama') == $dB->nama) : ?>
                            <li>
                                <a href="<?= base_url(); ?>buku/perbaruiBuku/<?= $dB->id_buku; ?>"
                                    class="btn btn-info btn-sm mt-1">Perbarui</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                        <button type="button" onclick="pinjamBuku(<?= $dB->id_buku; ?>, '<?= $dB->judul; ?>')"
                            class="btn container-fluid btn-sm <?= ($dB->status == 1) ? 'pinjam' : 'cant-pinjam disabled'; ?>">Pinjam</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

</div>