<main class="container">
    <div class="text-center mb-4">
        <img class="d-block mx-auto mb-2" src="<?= base_url(); ?>assets/img/logo.svg" alt="" width="72" height="57">
        <h2>Riwayat <?= $this->session->userdata('nama'); ?></h2>
    </div>

    <div id="tbl-riwayat"></div>
</main>

<script>
function loadFirst() {
    $.ajax({
        url: '<?= base_url(); ?>riwayat/ajaxRiwayat',
        dataType: 'html',
        beforeSend: function() {
            $('#tbl-riwayat').html('Tunggu Sebentar...');
        },
        success: function(ress) {
            $('#tbl-riwayat').html(ress);
        },
        error: function(err) {
            $('#tbl-riwayat').html('Terjadi Kesalahan');
        }
    });
}

loadFirst();

function hapusRiwayat(idRiwayat) {
    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data yang telah dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url(); ?>riwayat/hapusRiwayat',
                method: 'POST',
                data: {
                    idRiwayat: idRiwayat,
                },
                success: function(res) {
                    if (res == 'success') {
                        Swal.fire({
                            title: 'Berhasil',
                            text: "Buku berhasil ditarik. Silahkan datang ke perpustakaan SimPinBuk terdekat.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ya',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                loadFirst();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: "Terjadi kesalahan di database.",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ya',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                loadFirst();
                            }
                        });
                    }
                },
                error: function(err) {
                    Swal.fire({
                        title: 'Gagal!',
                        text: "Terjadi kesalahan.",
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ya',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            loadFirst();
                        }
                    });
                }
            });
        }
    });
}

function kembalikanBuku(idBuku, idPinjam, idRiwayat, judul) {
    Swal.fire({
        title: 'Perhatian',
        text: "Sudah selesai bacanya? siap mengembalikan?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url(); ?>riwayat/kembalikanBuku',
                method: 'POST',
                data: {
                    idBuku: idBuku,
                    idRiwayat: idRiwayat,
                    idPinjam: idPinjam,
                    judul: judul
                },
                success: function(res) {
                    if (res == 'success') {
                        Swal.fire({
                            title: 'Berhasil',
                            text: "Buku berhasil dikembalikan, silahkan mengirimkan buku ke Perpustakaan SimPinBuk terdekat.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ya',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                loadFirst();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: "Terjadi kesalahan di database.",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ya',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                loadFirst();
                            }
                        });
                    }
                },
                error: function(err) {
                    Swal.fire({
                        title: 'Gagal!',
                        text: "Terjadi kesalahan.",
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ya',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            loadFirst();
                        }
                    });
                }
            });
        }
    });
}
</script>