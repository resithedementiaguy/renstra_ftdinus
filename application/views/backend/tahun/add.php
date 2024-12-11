<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item">Tahun</li>
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
                        <h5 class="pt-2">Tambah Tahun Akademik</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            *Silahkan untuk isi form tahun di bawah
                        </div>
                        <form method="post" action="<?= base_url('tahun/add') ?>">
                            <div class="row mb-3">
                                <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-10">
                                    <input type="number" name="tahun" id="tahun" class="form-control" placeholder="Masukkan tahun akademik (e.g., 2024, 2025, 2026, dst)" required>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="<?= base_url('tahun') ?>" type="button" class="btn btn-secondary my-3">Kembali</a>
                                <button type="submit" class="btn btn-primary my-3">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>