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
                                <button class="nav-link active" id="tabs-profil-tab" data-bs-toggle="pill" data-bs-target="#tabs-profil" type="button" role="tab" aria-controls="tabs-profil" aria-selected="true">Profil</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tabs-contact-tab" data-bs-toggle="pill" data-bs-target="#tabs-contact" type="button" role="tab" aria-controls="tabs-contact" aria-selected="false">Edit</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="myTabContent">
                            <!-- Tab Profil -->
                            <div class="tab-pane fade show active" id="tabs-profil" role="tabpanel" aria-labelledby="profil-tab">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="border: none;">Username</th>
                                            <td style="border: none;"><?= $user->username; ?></td>
                                        </tr>
                                        <tr>
                                            <th style="border: none;">Nama</th>
                                            <td style="border: none;"><?= $user->nama; ?></td>
                                        </tr>
                                        <tr>
                                            <th style="border: none;">Level</th>
                                            <td style="border: none;"><?= $user->level; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <!-- Tab Edit -->
                            <div class="tab-pane fade" id="tabs-contact" role="tabpanel" aria-labelledby="contact-tab">
                                <form method="post" action="<?= site_url('profil/update') ?>">
                                    <div class="row mb-3">
                                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $user->nama; ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password baru" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="confirm_password" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Konfirmasi password baru" required>
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