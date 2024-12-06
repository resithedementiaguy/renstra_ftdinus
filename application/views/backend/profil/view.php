<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Profil Saya</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-info">
                        <h5 class="pt-2"><strong>Profil Saya</strong></h5>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-3" id="tabs-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="tabs-profil-tab" data-bs-toggle="pill" data-bs-target="#tabs-profil" type="button" role="tab" aria-controls="tabs-profil" aria-selected="false">Profil</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tabs-contact-tab" data-bs-toggle="pill" data-bs-target="#tabs-contact" type="button" role="tab" aria-controls="tabs-contact" aria-selected="false">Edit</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="myTabContent">
                            <div class="tab-pane fade show active" id="tabs-profil" role="tabpanel" aria-labelledby="profil-tab">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="border: none; width: 100px;">Username</th>
                                            <td style="border: none; width: 100px;">A22.2022.02929</td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td>Alfaturachman</td>
                                        </tr>
                                        <tr>
                                            <th style="border: none;">Level</th>
                                            <td style="border: none;">Mahasiswa</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-contact" role="tabpanel" aria-labelledby="contact-tab">
                                <form method="post" action="<?= base_url('renstra/add_level1') ?>">
                                    <div class="row mb-3">
                                        <label for="no_iku" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="no_iku" id="no_iku" class="form-control" placeholder="Masukkan Nama" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="isi_iku1" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="isi_iku1" id="isi_iku1" class="form-control" placeholder="Masukkan password" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="isi_iku1" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="isi_iku1" id="isi_iku1" class="form-control" placeholder="Masukkan Konfirmasi Password" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info my-3"><i class="ri-save-2-line"></i> Simpan Profil</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>