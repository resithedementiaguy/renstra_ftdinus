<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('ewmp') ?>">Pelaporan EWMP</a></li>
                <li class="breadcrumb-item active">Edit Artikel Ilmiah</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h5 class="pt-2"><strong>Edit Pelaporan EWMP - Prosiding</strong></h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('ewmp/update_prosiding/' . $prosiding['id_pelaporan']) ?>" method="post">
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Kategori Prosiding</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori" id="kategori1" value="Nasional" <?php echo (isset($prosiding['kategori']) && $prosiding['kategori'] === 'Nasional') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="kategori1">Nasional</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori" id="kategori2" value="Internasional" <?php echo (isset($prosiding['kategori']) && $prosiding['kategori'] === 'Internasional') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="kategori2">Internasional</label>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Kategori Jurnal</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori_jurnal" id="kategori_jurnal1" value="Penelitian" <?php echo (isset($prosiding['kategori_jurnal']) && $prosiding['kategori_jurnal'] === 'Penelitian') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="kategori_jurnal1">Penelitian</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori_jurnal" id="kategori_jurnal2" value="Pengabdian" <?php echo (isset($prosiding['kategori_jurnal']) && $prosiding['kategori_jurnal'] === 'Pengabdian') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="kategori_jurnal2">Pengabdian</label>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row mb-3">
                                <label for="nama_pertama" class="col-sm-2 col-form-label">Nama Pertama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_pertama" name="nama_pertama" value="<?= htmlspecialchars($prosiding['nama_pertama']) ?>" required>
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Program Studi</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="prodi" id="prodi1" value="Teknik Elektro" <?php echo (isset($prosiding['prodi']) && $prosiding['prodi'] === 'Teknik Elektro') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="prodi1">Teknik Elektro</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="prodi" id="prodi2" value="Teknik Industri" <?php echo (isset($prosiding['prodi']) && $prosiding['prodi'] === 'Teknik Industri') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="prodi2">Teknik Industri</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="prodi" id="prodi3" value="Teknik Biomedis" <?php echo (isset($prosiding['prodi']) && $prosiding['prodi'] === 'Teknik Biomedis') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="prodi3">Teknik Biomedis</label>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row mb-3">
                                <label for="nama_korespon" class="col-sm-2 col-form-label">Nama Korespondensi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_korespon" name="nama_korespon" value="<?= htmlspecialchars($prosiding['nama_korespon']) ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="judul_artikel" class="col-sm-2 col-form-label">Judul Artikel</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="judul_artikel" name="judul_artikel" rows="3" required><?= htmlspecialchars($prosiding['judul_artikel']) ?></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="judul_jurnal" class="col-sm-2 col-form-label">Judul Conference/Seminar</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="judul_jurnal" name="judul_jurnal" rows="3" required><?= htmlspecialchars($prosiding['judul_seminar']) ?></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="bukti_loa" class="col-sm-2 col-form-label">Link Google Drive Bukti LOA</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="bukti_loa" name="bukti_loa" value="<?= $prosiding['bukti_loa'] ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="doi" class="col-sm-2 col-form-label">DOI (jika sudah terbit)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="doi" name="doi" value="<?= htmlspecialchars($prosiding['doi']) ?>" required>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                <a href="<?= base_url('ewmp') ?>" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
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
                <p class="mb-0">Data artikel ilmiah berhasil diperbarui.</p>
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

    // Add form submit handler with success modal
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        // Submit the form using AJAX
        $.ajax({
            type: "POST",
            url: this.action,
            data: $(this).serialize(),
            success: function(response) {
                // Show success modal
                $('#successModal').modal('show');
                
                // Redirect after 2 seconds
                setTimeout(function() {
                    window.location.href = '<?= base_url('ewmp/detail_pelaporan/'. $editor_jurnal['id_pelaporan']) ?>';
                }, 2000);
            },
            error: function(xhr, status, error) {
                // Handle error if needed
                alert('Terjadi kesalahan saat memperbarui data.');
            }
        });
    });

    // Initialize modal if it hasn't been initialized
    $(document).ready(function() {
        // Make sure Bootstrap Modal is properly initialized
        var successModal = new bootstrap.Modal(document.getElementById('successModal'), {
            keyboard: false
        });
    });
</script>