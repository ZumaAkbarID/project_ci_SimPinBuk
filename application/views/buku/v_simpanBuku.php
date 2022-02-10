<main class="container">
    <div class="text-center">
        <img class="d-block mx-auto mb-4" src="<?= base_url(); ?>assets/img/logo.svg" alt="" width="72" height="57">
        <h2>Form Simpan Buku</h2>
    </div>

    <div class="row g-5">
        <div class="col-md-8 col-lg-8">
            <h4 class="mb-3 border-bottom pb-1">Informasi Buku</h4>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="judul" class="form-label">Judul Buku</label>
                        <input type="text" class="form-control" name="judul" id="judul" placeholder="Masukkan judul..."
                            required>
                        <div class="invalid-feedback">
                            Judul Buku
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="gamber" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gamber" name="gambar" required
                            accept=".png,.jpg,.jpeg">
                        <div class="invalid-feedback">
                            Gambar diperlukan
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <div class="input-group has-validation">
                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" maxlength="100"
                                class="form-control"
                                placeholder="Deskripsikan buku Anda secara singkat (max. 100 karakter)"></textarea>
                            <div class="invalid-feedback">
                                Deskripsi dibutuhkan
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="pengarang" class="form-label">Pengarang</label>
                        <input type="text" class="form-control" id="pengarang" name="pengarang"
                            placeholder="Pengarang buku...">
                        <div class="invalid-feedback">
                            Pengarang diperlukan
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="tahun_terbit" class="form-label">Tahun terbit</label>
                        <select name="tahun_terbit" id="tahun_terbit" class="form-control"></select>
                        <div class="invalid-feedback">
                            Tahun terbit diperlukan
                        </div>
                    </div>

                </div>

                <hr class="my-4">

                <button class="w-100 btn btn-primary btn-lg" type="submit">Simpan Buku</button>
            </form>
        </div>
        <div class="col-md-4 col-lg-4">
            <h3>Peraturan <span class="simpinbuk"><b>SimPinBuk</b></span></h3>
            <ol>
                <li>Buku yang telah disimpan wajib untuk disetorkan.</li>
                <li>Buku yang telah disimpan tidak dapat diminta kembali atau dihapus dengan alasan apapun.</li>
            </ol>
        </div>
    </div>
</main>

<script>
$(document).ready(function() {
    let startYear = 1900;
    let endYear = new Date().getFullYear();
    for (i = endYear; i > startYear; i--) {
        $('#tahun_terbit').append($('<option />').val(i).html(i));
    }
});

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