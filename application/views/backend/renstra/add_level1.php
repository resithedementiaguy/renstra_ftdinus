<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Renstra</li>
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
                        <h5 class="pt-2">Tambah IKU Level 1</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        $current_url = current_url(); // Dapatkan URL saat ini
                        ?>
                        <a href="<?= base_url('renstra/create_view1') ?>" type="button" class="btn btn-primary mb-4 <?= $current_url == base_url('renstra/create_view1') ? 'disabled' : '' ?>">Ke Level 1</a>
                        <a href="<?= base_url('renstra/create_view2') ?>" type="button" class="btn btn-primary mb-4 <?= $current_url == base_url('renstra/create_view2') ? 'disabled' : '' ?>">Ke Level 2</a>
                        <a href="<?= base_url('renstra/create_view3') ?>" type="button" class="btn btn-primary mb-4 <?= $current_url == base_url('renstra/create_view3') ? 'disabled' : '' ?>">Ke Level 3</a>
                        <a href="<?= base_url('renstra/create_view4') ?>" type="button" class="btn btn-primary mb-4 <?= $current_url == base_url('renstra/create_view4') ? 'disabled' : '' ?>">Ke Level 4</a>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            *Silahkan untuk isi form dibawah sesuai dengan level RENSTRA
                        </div>
                        <form method="post" action="<?= base_url('renstra/add_level1') ?>">
                            <div class="row mb-3">
                                <label for="no_iku" class="col-sm-2 col-form-label">Nomor Butir</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_iku" id="no_iku" class="form-control" placeholder="Masukkan nomor butir (e.g 1., 2., 3., dll)" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="isi_iku1" class="col-sm-2 col-form-label">Butir</label>
                                <div class="col-sm-10">
                                    <input type="text" name="isi_iku1" id="isi_iku1" class="form-control" placeholder="Masukkan isi butir" required>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <div>
                            <a href="<?= base_url('iku') ?>" type="button" class="btn btn-secondary my-3">Kembali</a>
                        </div>
                        <button type="submit" class="btn btn-primary my-3">Simpan</button>
                    </div>
                    </form>
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
                    Data berhasil disimpan!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mb-4" data-bs-dismiss="modal">Tutup</button>
                    <a href="<?= base_url('renstra/create_view2') ?>" class="btn btn-primary mb-4">Ke Level 2</a>
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