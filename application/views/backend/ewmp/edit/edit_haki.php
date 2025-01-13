<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('ewmp') ?>">Pelaporan EWMP</a></li>
                <li class="breadcrumb-item active">Edit Editor Jurnal</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h5 class="pt-2"><strong>Edit Pelaporan EWMP - Editor Jurnal</strong></h5>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($haki['kategori'] == "Hak Cipta") {
                        ?>
                            <form action="<?= base_url('ewmp/update_haki/' . $haki['id']) ?>" method="post">
                                <div class="row mb-3">
                                    <label for="nama_usul" class="col-sm-2 col-form-label">Nama Pengusul</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_usul" name="nama_usul" value="<?= htmlspecialchars($haki['nama_usul']) ?>" required>
                                    </div>
                                </div>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Program Studi Ketua</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi1" value="Teknik Elektro" <?= isset($haki['prodi']) && $haki['prodi'] === 'Teknik Elektro' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi1">Teknik Elektro</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi2" value="Teknik Industri" <?= isset($haki['prodi']) && $haki['prodi'] === 'Teknik Industri' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi2">Teknik Industri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi" id="prodi3" value="Teknik Biomedis" <?= isset($haki['prodi']) && $haki['prodi'] === 'Teknik Biomedis' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="prodi3">Teknik Biomedis</label>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="row mb-3">
                                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="judul" name="judul" value="<?= htmlspecialchars($haki['judul']) ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="sertifikat" class="col-sm-2 col-form-label">Sertifikat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="sertifikat" name="sertifikat" value="<?= htmlspecialchars($haki['sertifikat']) ?>" required>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                    <a href="<?= base_url('ewmp') ?>" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>
                        <?php
                        }
                        ?>
                    </div>
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
                <p class="mb-0">Data editor jurnal berhasil diperbarui.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Update your existing script tag with this new version -->
<script>
    function formatRupiah(input) {
        // Remove all non-numeric characters
        let rawValue = input.value.replace(/[^\d]/g, '');

        // Store the raw value in hidden input
        document.getElementById('besar_hibah_raw').value = rawValue;

        // Format the display value
        if (rawValue) {
            let number = parseInt(rawValue);
            let formatted = new Intl.NumberFormat('id-ID').format(number);
            input.value = 'Rp ' + formatted;
        } else {
            input.value = '';
        }
    }


    // Initialize modal if it hasn't been initialized
    $(document).ready(function() {
        // Make sure Bootstrap Modal is properly initialized
        var successModal = new bootstrap.Modal(document.getElementById('successModal'), {
            keyboard: false
        });
    });
</script>