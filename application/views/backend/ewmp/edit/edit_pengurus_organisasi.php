<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('ewmp') ?>">Pelaporan EWMP</a></li>
                <li class="breadcrumb-item active">Edit Pengurus Organisasi Profesi</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h5 class="pt-2"><strong>Edit Pelaporan EWMP - Pengurus Organisasi Profesi</strong></h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('ewmp/update_pengurus_organisasi/' . $pengurus_organisasi['id_pelaporan']) ?>" method="post">
                            <div class="row mb-3">
                                <label for="nama_org" class="col-sm-2 col-form-label">Nama Organisasi Profesi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_org" name="nama_org" value="<?= htmlspecialchars($pengurus_organisasi['nama_org']) ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= htmlspecialchars($pengurus_organisasi['jabatan']) ?>" required>
                                </div>
                            </div>                            
                            <div class="row mb-3">
                                <label for="masa_jabatan" class="col-sm-2 col-form-label">Masa Jabatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="masa_jabatan" name="masa_jabatan" value="<?= htmlspecialchars($pengurus_organisasi['masa_jabatan']) ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="file_sk" class="col-sm-2 col-form-label">Link Google Drive SK dan Surat tugas serta bukti lain telah menyelesaikan tugas</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="file_sk" name="file_sk" value="<?= $pengurus_organisasi['file_sk'] ?>">
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
                <p class="mb-0">Data Pengurus Organisasi Profesi berhasil diperbarui.</p>
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
                    window.location.href = '<?= base_url('ewmp/detail_pelaporan/'. $pengurus_organisasi['id_pelaporan']) ?>';
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