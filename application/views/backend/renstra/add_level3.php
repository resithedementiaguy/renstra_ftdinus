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
                        <h5 class="pt-2">Tambah IKU Level 3</h5>
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
                        <form method="post" action="<?= base_url('renstra/add_level3') ?>">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Pilih Butir 1</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="id_level1" id="id_level1" aria-label="Default select example">
                                        <option value="">- Pilih Butir 1 -</option>
                                        <?php foreach ($iku_level1 as $level1): ?>
                                            <option value="<?= $level1->id ?>"><?= $level1->no_iku ?> <?= $level1->isi_iku ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Pilih Butir 2</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="id_level2" id="id_level2" aria-label="Default select example">
                                        <option value="">- Pilih Butir 1 terlebih dahulu -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Nomor IKU</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_iku" id="no_iku" class="form-control" placeholder="Masukkan nomor IKU (e.g 1.1.1., 1.1.2., 1.1.3., dll)" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Indikator Kinerja Utama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="isi_iku3" id="isi_iku3" class="form-control" placeholder="Masukkan isi IKU" required>
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Target IKU</legend>
                                <div class="col-sm-10">
                                    <label class="form-check-label" for="gridRadios1">
                                        Apakah IKU ini ada targetnya? Pilih <span class="text text-primary">Iya</span> jika ada dan pilih <span class="text text-primary">Tidak</span> jika tidak ada.
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="ket_target" id="gridRadios1" value="Iya">
                                        <label class="form-check-label" for="gridRadios1">
                                            Iya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="ket_target" id="gridRadios2" value="Tidak" checked>
                                        <label class="form-check-label" for="gridRadios2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <div>
                            <a href="<?= base_url('renstra') ?>" type="button" class="btn btn-secondary my-3">Kembali</a>
                        </div>
                        <button type="submit" class="btn btn-primary my-3">Simpan</button>
                    </div>
                    </form><!-- End General Form Elements -->
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
                    <a href="<?= base_url('renstra/create_view4') ?>" class="btn btn-primary mb-4">Ke Level 4</a>
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

<script>
    $(document).ready(function() {
        $('#id_level1').on('change', function() {
            var idLevel1 = $(this).val();
            $.ajax({
                url: '<?= base_url("renstra/get_level2_by_level1") ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    id_level1: idLevel1
                },
                success: function(response) {
                    $('#id_level2').empty(); // Kosongkan select level 2 terlebih dahulu
                    if (response.length) {
                        $.each(response, function(index, item) {
                            $('#id_level2').append('<option value="' + item.id + '">' + item.no_iku + ' ' + item.isi_iku + '</option>');
                        });
                    } else {
                        $('#id_level2').append('<option value="">Tidak ada data level 2</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                    console.error("Response: " + xhr.responseText);
                }
            });
        });
    });
</script>