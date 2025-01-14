<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('ewmp') ?>">Pelaporan EWMP</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('ewmp/detail_pelaporan/' . $haki['id_pelaporan']) ?>">Detail <?php echo $haki['kategori'] ?></a></li>
                <li class="breadcrumb-item active">Edit <?php echo $haki['kategori'] ?></li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h5 class="pt-2"><strong>Edit Pelaporan EWMP - <?php echo $haki['kategori'] ?></strong></h5>
                    </div>
                    <?php
                    if ($haki['kategori'] == "Hak Cipta") {
                    ?>
                        <form action="<?= base_url('ewmp/update_haki_hcipta/' . $haki['id']) ?>" method="post">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="nama_usul" class="col-sm-2 col-form-label">Nama Pengusul</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_usul" name="nama_usul" value="<?= htmlspecialchars($haki['hcipta_nama_usul']) ?>" required>
                                    </div>
                                </div>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Program Studi Ketua</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi1" value="Teknik Elektro" <?= isset($haki['hcipta_prodi']) && $haki['hcipta_prodi'] === 'Teknik Elektro' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi1">Teknik Elektro</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi2" value="Teknik Industri" <?= isset($haki['hcipta_prodi']) && $haki['hcipta_prodi'] === 'Teknik Industri' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi2">Teknik Industri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi3" value="Teknik Biomedis" <?= isset($haki['hcipta_prodi']) && $haki['hcipta_prodi'] === 'Teknik Biomedis' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi3">Teknik Biomedis</label>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="row mb-3">
                                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="judul" name="judul" value="<?= htmlspecialchars($haki['hcipta_judul']) ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="sertifikat" class="col-sm-2 col-form-label">Sertifikat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="sertifikat" name="sertifikat" value="<?= htmlspecialchars($haki['hcipta_sertifikat']) ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <a href="<?= base_url('ewmp/detail_pelaporan/' . $haki['id_pelaporan']) ?>" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                    <?php
                    } elseif ($haki['kategori'] == "Lisensi") {
                    ?>
                        <form action="<?= base_url('ewmp/update_haki_lisensi/' . $haki['id']) ?>" method="post">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="nama_usul" class="col-sm-2 col-form-label">Nama Pengusul</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_usul" name="nama_usul" value="<?= htmlspecialchars($haki['lisensi_nama_usul']) ?>" required>
                                    </div>
                                </div>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Program Studi Ketua</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi1" value="Teknik Elektro" <?= isset($haki['lisensi_prodi']) && $haki['lisensi_prodi'] === 'Teknik Elektro' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi1">Teknik Elektro</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi2" value="Teknik Industri" <?= isset($haki['lisensi_prodi']) && $haki['lisensi_prodi'] === 'Teknik Industri' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi2">Teknik Industri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi3" value="Teknik Biomedis" <?= isset($haki['lisensi_prodi']) && $haki['lisensi_prodi'] === 'Teknik Biomedis' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi3">Teknik Biomedis</label>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="row mb-3">
                                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="judul" name="judul" value="<?= htmlspecialchars($haki['lisensi_judul']) ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="sertifikat" class="col-sm-2 col-form-label">Sertifikat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="sertifikat" name="sertifikat" value="<?= htmlspecialchars($haki['lisensi_sertifikat']) ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <a href="<?= base_url('ewmp/detail_pelaporan/' . $haki['id_pelaporan']) ?>" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                    <?php
                    } elseif ($haki['kategori'] == "Merk") {
                    ?>
                        <form action="<?= base_url('ewmp/update_haki_merk/' . $haki['id']) ?>" method="post">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="nama_usul" class="col-sm-2 col-form-label">Nama Pengusul</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_usul" name="nama_usul" value="<?= htmlspecialchars($haki['merk_nama_usul']) ?>" required>
                                    </div>
                                </div>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Program Studi Ketua</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi1" value="Teknik Elektro" <?= isset($haki['merk_prodi']) && $haki['merk_prodi'] === 'Teknik Elektro' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi1">Teknik Elektro</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi2" value="Teknik Industri" <?= isset($haki['merk_prodi']) && $haki['merk_prodi'] === 'Teknik Industri' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi2">Teknik Industri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi3" value="Teknik Biomedis" <?= isset($haki['merk_prodi']) && $haki['merk_prodi'] === 'Teknik Biomedis' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi3">Teknik Biomedis</label>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="row mb-3">
                                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="judul" name="judul" value="<?= htmlspecialchars($haki['merk_judul']) ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="sertifikat" class="col-sm-2 col-form-label">Sertifikat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="sertifikat" name="sertifikat" value="<?= htmlspecialchars($haki['merk_sertifikat']) ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <a href="<?= base_url('ewmp/detail_pelaporan/' . $haki['id_pelaporan']) ?>" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                    <?php
                    } elseif ($haki['kategori'] == "Paten") {
                    ?>
                        <form action="<?= base_url('ewmp/update_haki_paten/' . $haki['id']) ?>" method="post">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="nama_usul" class="col-sm-2 col-form-label">Nama Pengusul</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_usul" name="nama_usul" value="<?= htmlspecialchars($haki['paten_nama_usul']) ?>" required>
                                    </div>
                                </div>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Program Studi Ketua</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi1" value="Teknik Elektro" <?= isset($haki['paten_prodi']) && $haki['paten_prodi'] === 'Teknik Elektro' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi1">Teknik Elektro</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi2" value="Teknik Industri" <?= isset($haki['paten_prodi']) && $haki['paten_prodi'] === 'Teknik Industri' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi2">Teknik Industri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi3" value="Teknik Biomedis" <?= isset($haki['paten_prodi']) && $haki['paten_prodi'] === 'Teknik Biomedis' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi3">Teknik Biomedis</label>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="row mb-3">
                                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="judul" name="judul" value="<?= htmlspecialchars($haki['paten_judul']) ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="sertifikat" class="col-sm-2 col-form-label">Sertifikat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="sertifikat" name="sertifikat" value="<?= htmlspecialchars($haki['paten_sertifikat']) ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nama_inventor" class="col-sm-2 col-form-label">Nama Inventor</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="nama_inventor" name="nama_inventor" rows="3" required><?= htmlspecialchars($haki['paten_nama_inventor']) ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <a href="<?= base_url('ewmp/detail_pelaporan/' . $haki['id_pelaporan']) ?>" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                    <?php
                    } elseif ($haki['kategori'] == "Desain Industri") {
                    ?>
                        <form action="<?= base_url('ewmp/update_haki_dindustri/' . $haki['id']) ?>" method="post">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="nama_usul" class="col-sm-2 col-form-label">Nama Pengusul</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_usul" name="nama_usul" value="<?= htmlspecialchars($haki['dindustri_nama_usul']) ?>" required>
                                    </div>
                                </div>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Program Studi Ketua</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi1" value="Teknik Elektro" <?= isset($haki['dindustri_prodi']) && $haki['dindustri_prodi'] === 'Teknik Elektro' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi1">Teknik Elektro</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi2" value="Teknik Industri" <?= isset($haki['dindustri_prodi']) && $haki['dindustri_prodi'] === 'Teknik Industri' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi2">Teknik Industri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi3" value="Teknik Biomedis" <?= isset($haki['dindustri_prodi']) && $haki['dindustri_prodi'] === 'Teknik Biomedis' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi3">Teknik Biomedis</label>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="row mb-3">
                                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="judul" name="judul" value="<?= htmlspecialchars($haki['dindustri_judul']) ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="sertifikat" class="col-sm-2 col-form-label">Sertifikat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="sertifikat" name="sertifikat" value="<?= htmlspecialchars($haki['dindustri_sertifikat']) ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <a href="<?= base_url('ewmp/detail_pelaporan/' . $haki['id_pelaporan']) ?>" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                    <?php
                    } elseif ($haki['kategori'] == "Buku") {
                    ?>
                        <form action="<?= base_url('ewmp/update_haki_buku/' . $haki['id']) ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="nama_usul" class="col-sm-2 col-form-label">Nama Pengusul</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_usul" name="nama_usul" value="<?= htmlspecialchars($haki['buku_nama_usul']) ?>" required>
                                    </div>
                                </div>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Program Studi Ketua</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi1" value="Teknik Elektro" <?= isset($haki['buku_prodi']) && $haki['buku_prodi'] === 'Teknik Elektro' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi1">Teknik Elektro</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi2" value="Teknik Industri" <?= isset($haki['buku_prodi']) && $haki['buku_prodi'] === 'Teknik Industri' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi2">Teknik Industri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi3" value="Teknik Biomedis" <?= isset($haki['buku_prodi']) && $haki['buku_prodi'] === 'Teknik Biomedis' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi3">Teknik Biomedis</label>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="row mb-3">
                                    <label for="isbn" class="col-sm-2 col-form-label">ISBN</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="isbn" name="isbn" value="<?= htmlspecialchars($haki['buku_isbn']) ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="judul_buku" class="col-sm-2 col-form-label">Judul Buku</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="judul_buku" name="judul_buku" value="<?= htmlspecialchars($haki['buku_judul_buku']) ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="file_buku" class="col-sm-2 col-form-label">File Buku</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="file_buku" name="file_buku">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <a href="<?= base_url('ewmp/detail_pelaporan/' . $haki['id_pelaporan']) ?>" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</main>

<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">Sukses</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                <h4 class="mt-3">Berhasil!</h4>
                <p class="mb-0">Data HAKI berhasil diperbarui.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Make sure Bootstrap Modal is properly initialized
        var successModal = new bootstrap.Modal(document.getElementById('successModal'), {
            keyboard: false
        });
    });
</script>