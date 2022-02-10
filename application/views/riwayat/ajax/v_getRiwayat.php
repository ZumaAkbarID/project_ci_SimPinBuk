<table class="table table-hover rounded-start p-3 table-dark">
    <thead>
        <tr>
            <th scope="col-1">#</th>
            <th scope="col">Tipe</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Waktu</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($dataRiwayat as $dR) : ?>
        <tr>
            <th scope="row"><?= $i++; ?></th>
            <td>
                <?php if ($dR->tipe == 'Pinjam') : ?>
                <button disabled class="btn btn-success btn-sm">Pinjam</button>
                <?php elseif ($dR->tipe == 'Kembalikan') : ?>
                <button disabled class="btn btn-info">Pengembalian</button>
                <?php elseif ($dR->tipe == 'Simpan') : ?>
                <button disabled class="btn btn-success btn-sm">Simpan</button>
                <?php elseif ($dR->tipe == 'Hapus') : ?>
                <button disabled class="btn btn-warning btn-sm">Hapus</button>
                <?php elseif ($dR->tipe == 'Perbarui') : ?>
                <button disabled class="btn btn-info btn-sm">Perbarui</button>
                <?php endif; ?>
            </td>
            <td><?= $dR->deskripsi; ?></td>
            <td><?= date('H:i d-M-Y', strtotime($dR->waktu)); ?></td>
            <td>
                <?php if (is_null($dR->id_pinjam)) : ?>
                <button onclick="hapusRiwayat(<?= $dR->id_riwayat; ?>)" class=" btn btn-danger btn-sm w-100">Hapus
                    Riwayat</button>
                <?php endif; ?>

                <?php foreach ($dataBuku as $dB) :
                        foreach ($dataPinjam as $dP) :
                            if ($dR->tipe == 'Pinjam' && $dR->deleted == 0 && $dR->id_buku == $dB->id_buku && $dR->id_pinjam == $dP->id_pinjam) :
                    ?>
                <button
                    onclick="kembalikanBuku(<?= $dB->id_buku; ?>, <?= $dP->id_pinjam; ?>, <?= $dR->id_riwayat; ?>, '<?= $dB->judul; ?>')"
                    class=" btn btn-warning btn-sm w-100">Kembalikan Buku</button>
                <?php endif;
                        endforeach;
                    endforeach; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>