<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('dosen') ?>">Data Dosen</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h5 class="pt-2">Tambah Jumlah Dosen</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            *Silahkan untuk isi form jumlah dosen di bawah
                        </div>
                        <form method="post" action="<?= base_url('dosen/add') ?>">
                            <div class="row mb-3">
                                <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-10">
                                    <input type="number" name="tahun" id="tahun" class="form-control" placeholder="Masukkan tahun jumlah dosen" required>
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Program Studi</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="prodi" id="prodi1" value="Teknik Elektro" checked>
                                        <label class="form-check-label" for="prodi1">Teknik Elektro</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="prodi" id="prodi2" value="Teknik Industri">
                                        <label class="form-check-label" for="prodi2">Teknik Industri</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="prodi" id="prodi3" value="Teknik Biomedis">
                                        <label class="form-check-label" for="prodi3">Teknik Biomedis</label>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row mb-3">
                                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah Dosen</label>
                                <div class="col-sm-10">
                                    <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Masukkan jumlah dosen" required>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="<?= base_url('dosen') ?>" type="button" class="btn btn-secondary my-3">Kembali</a>
                                <button type="submit" class="btn btn-primary my-3">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Berhasil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Data Jumlah Dosen Berhasil Disimpan!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mb-4" data-bs-dismiss="modal">Tutup</button>
                    <a href="<?= base_url('dosen') ?>" class="btn btn-primary mb-4">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Check if success flashdata is set and trigger modal -->
    <?php if ($this->session->flashdata('success')): ?>
        <script>
            window.onload = function() {
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            };
        </script>
    <?php endif; ?>
</main>