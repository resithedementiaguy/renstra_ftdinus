<style>
    #main {
        min-height: 90vh;
        display: flex;
        flex-direction: column;
    }
</style>
<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-2"><strong>Dashboard</strong></h1>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card info-card sales-card">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-0">Tahun Ajaran</h5>
                        <h6 class="text-center"><?= date('Y') ?></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Dosen</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= htmlspecialchars($jumlah_dosen) ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Mahasiswa</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= htmlspecialchars($jumlah_mahasiswa) ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>