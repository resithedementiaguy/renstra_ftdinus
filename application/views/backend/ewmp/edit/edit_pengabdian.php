<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('ewmp') ?>">Pelaporan EWMP</a></li>
                <li class="breadcrumb-item active">Edit Pengabdian</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h5 class="pt-2"><strong>Edit Pelaporan EWMP - Pengabdian</strong></h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('ewmp/update_pengabdian/' . $pengabdian['id_pelaporan']) ?>" method="post">
                            <div class="row mb-3">
                                <label for="nama_ketua" class="col-sm-2 col-form-label">Nama Ketua</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_ketua" name="nama_ketua" value="<?= htmlspecialchars($pengabdian['nama_ketua']) ?>" required>
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Program Studi Ketua</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="prodi" id="prodi1" value="Teknik Elektro" <?php echo (isset($pengabdian['prodi']) && $pengabdian['prodi'] === 'Teknik Elektro') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="prodi1">Teknik Elektro</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="prodi" id="prodi2" value="Teknik Industri" <?php echo (isset($pengabdian['prodi']) && $pengabdian['prodi'] === 'Teknik Industri') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="prodi2">Teknik Industri</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="prodi" id="prodi3" value="Teknik Biomedis" <?php echo (isset($pengabdian['prodi']) && $pengabdian['prodi'] === 'Teknik Biomedis') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="prodi3">Teknik Biomedis</label>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Kategori Pengabdian</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori" id="kategori1" value="Mandiri" <?php echo (isset($pengabdian['kategori']) && $pengabdian['kategori'] === 'Mandiri') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="kategori1">Mandiri</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori" id="kategori2" value="Internal" <?php echo (isset($pengabdian['kategori']) && $pengabdian['kategori'] === 'Internal') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="kategori2">Internal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori" id="kategori3" value="Nasional" <?php echo (isset($pengabdian['kategori']) && $pengabdian['kategori'] === 'Nasional') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="kategori3">Nasional</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori" id="kategori4" value="Internasional" <?php echo (isset($pengabdian['kategori']) && $pengabdian['kategori'] === 'Internasional') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="kategori4">Internasional</label>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row mb-3">
                                <label for="judul" class="col-sm-2 col-form-label">Judul Pengabdian</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="judul" name="judul" rows="3" required><?= htmlspecialchars($pengabdian['judul']) ?></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="skim" class="col-sm-2 col-form-label">Skim Pengabdian</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="skim" name="skim" value="<?= htmlspecialchars($pengabdian['skim']) ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pemberi_hibah" class="col-sm-2 col-form-label">Pemberi Hibah</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="pemberi_hibah" name="pemberi_hibah" value="<?= htmlspecialchars($pengabdian['pemberi_hibah']) ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="besar_hibah" class="col-sm-2 col-form-label">Besar Hibah</label>
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        name="besar_hibah"
                                        id="besar_hibah"
                                        class="form-control"
                                        placeholder="Masukkan besar hibah"
                                        oninput="formatRupiah(this)"
                                        value="<?= 'Rp ' . number_format($pengabdian['besar_hibah'], 0, ',', '.') ?>">
                                    <!-- Add hidden input to store the raw value -->
                                    <input 
                                        type="hidden" 
                                        name="besar_hibah_raw" 
                                        id="besar_hibah_raw"
                                        value="<?= $pengabdian['besar_hibah'] ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="kontrak" class="col-sm-2 col-form-label">Link Google Drive Kontrak Pengabdian</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="kontrak" name="kontrak" value="<?= $pengabdian['kontrak'] ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="laporan" class="col-sm-2 col-form-label">Link Google Drive Laporan Pengabdian</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="laporan" name="laporan" value="<?= $pengabdian['laporan'] ?>">
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
                <p class="mb-0">Data pengabdian berhasil diperbarui.</p>
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
        
        // Get the raw value from hidden input
        let rawValue = document.getElementById('besar_hibah_raw').value;
        
        // Update the original input's value to the raw number before submission
        document.getElementById('besar_hibah').value = rawValue;
        
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