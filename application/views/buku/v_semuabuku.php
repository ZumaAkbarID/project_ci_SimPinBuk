<main class="container">

    <div class="row g-0 align-items-center mb-5">
        <label>Cari buku berdasarkan judul</label>
        <div class="col-6 col-lg-4">
            <input type="text" id="cariByJudul" placeholder="Masukkan judul..." class="form-control">
        </div>
        <div class="col-2 col-lg-2">
            <a onclick="cariBuku()" class="btn btn-primary"><i class="bi bi-search"></i></a>
        </div>
    </div>

    <div id="bukuItems"></div>
</main>

<script>
function loadFirst() {
    $.ajax({
        url: '<?= base_url(); ?>buku/getBuku',
        dataType: 'html',
        beforeSend: function() {
            $('#bukuItems').html('Tunggu Sebentar...');
        },
        success: function(ress) {
            $('#bukuItems').html(ress);
        },
        error: function(err) {
            $('#bukuItems').html('Terjadi Kesalahan');
        }
    });
}

loadFirst();


function cariBuku() {
    var judul = $('#cariByJudul').val();
    $.ajax({
        url: '<?= base_url(); ?>buku/getBukuByJudul',
        method: 'post',
        data: {
            judul: judul
        },
        dataType: 'html',
        beforeSend: function() {
            $('#bukuItems').html('Tunggu Sebentar...');
        },
        success: function(ress) {
            $('#bukuItems').html(ress);
        },
        error: function(err) {
            $('#bukuItems').html('Terjadi Kesalahan');
        }
    });
}

function pinjamBuku(idBuku, judul) {
    $.ajax({
        url: '<?= base_url(); ?>buku/prosesPinjam',
        method: 'post',
        data: {
            idBuku: idBuku,
            judul: judul
        },
        success: function(res) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                html: 'Pinjam Buku Berhasil. <br> Silahkan ambil di perpustakaan SimPinBuk terdekat dengan menunjukkan kode pinjam. <br> Cek kode pinjam di riwayat Anda',
            });
            loadFirst();
        },
        error: function(err) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                html: 'Terjadi Masalah',
            });
        }
    });
}
</script>