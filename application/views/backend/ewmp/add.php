<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Pelaporan EWMP</li>
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
                        <h5>Tambah Pelaporan EWMP</h5>
                    </div>
                    <form method="post" action="<?= base_url('ewmp/add') ?>">
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Masukkan email anda" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jenis_lapor" class="col-sm-2 col-form-label">Jenis Pelaporan</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="jenis_lapor" id="jenis_lapor">
                                        <option value="" selected hidden>Pilih Jenis Pelaporan</option>
                                        <option value="Penelitian">Penelitian</option>
                                        <option value="Pengabdian">Pengabdian</option>
                                        <option value="Artikel/Karya Ilmiah">Artikel/Karya Ilmiah</option>
                                        <option value="Prosiding">Prosiding</option>
                                        <option value="HAKI">HAKI</option>
                                        <option value="Editor Jurnal">Editor Jurnal</option>
                                        <option value="Reviewer Jurnal">Reviewer Jurnal</option>
                                        <option value="Invited Speaker">Invited Speaker</option>
                                        <option value="Pengurus Organisasi Profesi">Pengurus Organisasi Profesi</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Komponen Penelitian -->
                            <div class="penelitian d-none" id="penelitian">
                                <div class="row mb-3">
                                    <label for="nama_ketua_penelitian" class="col-sm-2 col-form-label">Nama Ketua</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_ketua_penelitian" id="nama_ketua_penelitian" class="form-control" placeholder="Masukkan nama ketua" required>
                                    </div>
                                </div>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Program Studi</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_penelitian" id="prodi_penelitian1" value="Teknik Elektro" checked>
                                            <label class="form-check-label" for="prodi_penelitian1">Teknik Elektro</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_penelitian" id="prodi_penelitian2" value="Teknik Industri">
                                            <label class="form-check-label" for="prodi_penelitian2">Teknik Industri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_penelitian" id="prodi_penelitian3" value="Teknik Biomedis">
                                            <label class="form-check-label" for="prodi_penelitian3">Teknik Biomedis</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Kategori Penelitian</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kategori_penelitian" id="kategori_penelitian1" value="Mandiri" checked>
                                            <label class="form-check-label" for="kategori_penelitian1">Mandiri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kategori_penelitian" id="kategori_penelitian2" value="Internal">
                                            <label class="form-check-label" for="kategori_penelitian2">Internal</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kategori_penelitian" id="kategori_penelitian3" value="Nasional">
                                            <label class="form-check-label" for="kategori_penelitian3">Nasional</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kategori_penelitian" id="kategori_penelitian4" value="Internasional">
                                            <label class="form-check-label" for="kategori_penelitian4">Internasional</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="row mb-3">
                                    <label for="nama_anggota_penelitian" class="col-sm-2 col-form-label">Nama Anggota</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="nama_anggota_penelitian" id="nama_anggota_penelitian" required></textarea>
                                        <p>contoh: (Anggota 1; Anggota 2; dst)</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_penelitian" class="col-sm-2 col-form-label">Judul Penelitian</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_penelitian" id="judul_penelitian" class="form-control" placeholder="Masukkan judul penelitian" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="skim_penelitian" class="col-sm-2 col-form-label">Skim Penelitian</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="skim_penelitian" id="skim_penelitian" class="form-control" placeholder="Masukkan skim penelitian" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="pemberi_hibah_penelitian" class="col-sm-2 col-form-label">Pemberi Hibah</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="pemberi_hibah_penelitian" id="pemberi_hibah_penelitian" class="form-control" placeholder="Masukkan pemberi hibah" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="besar_hibah_penelitian" class="col-sm-2 col-form-label">Besar Hibah</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="besar_hibah_penelitian" id="besar_hibah_penelitian" class="form-control" placeholder="Masukkan besar hibah" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nama_mahasiswa_penelitian" class="col-sm-2 col-form-label">Nama Mahasiswa yang Terlibat</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="nama_mahasiswa_penelitian" id="nama_mahasiswa_penelitian" required></textarea>
                                        <p>Contoh : Mahasiswa 1 (NIM1) ; Mahasiswa 2 (NIM2) ; Dst</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="kontrak_penelitian" class="col-sm-2 col-form-label">Unggah Kontrak Penelitian</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="kontrak_penelitian" id="kontrak_penelitian">
                                        Upload 1 file yang didukung: PDF. Maks 100 MB.
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="laporan_maju_penelitian" class="col-sm-2 col-form-label">Unggah Laporan Kemajuan / Akhir Penelitian</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="laporan_maju_penelitian" id="laporan_maju_penelitian">
                                        Upload 1 file yang didukung: PDF. Maks 100 MB.
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Pengabdian -->
                            <div class="pengabdian d-none" id="pengabdian">
                                <div class="row mb-3">
                                    <label for="nama_ketua_pengabdian" class="col-sm-2 col-form-label">Nama Ketua</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_ketua_pengabdian" id="nama_ketua_pengabdian" class="form-control" placeholder="Masukkan nama ketua" required>
                                    </div>
                                </div>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Program Studi</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_pengabdian" id="prodi_pengabdian1" value="Teknik Elektro" checked>
                                            <label class="form-check-label" for="prodi_pengabdian1">Teknik Elektro</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_pengabdian" id="prodi_pengabdian2" value="Teknik Industri">
                                            <label class="form-check-label" for="prodi_pengabdian2">Teknik Industri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_pengabdian" id="prodi_pengabdian3" value="Teknik Biomedis">
                                            <label class="form-check-label" for="prodi_pengabdian3">Teknik Biomedis</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Kategori pengabdian</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kategori_pengabdian" id="kategori_pengabdian1" value="Mandiri" checked>
                                            <label class="form-check-label" for="kategori_pengabdian1">Mandiri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kategori_pengabdian" id="kategori_pengabdian2" value="Internal">
                                            <label class="form-check-label" for="kategori_pengabdian2">Internal</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kategori_pengabdian" id="kategori_pengabdian3" value="Nasional">
                                            <label class="form-check-label" for="kategori_pengabdian3">Nasional</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kategori_pengabdian" id="kategori_pengabdian4" value="Internasional">
                                            <label class="form-check-label" for="kategori_pengabdian4">Internasional</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="row mb-3">
                                    <label for="nama_anggota_pengabdian" class="col-sm-2 col-form-label">Nama Anggota</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="nama_anggota_pengabdian" id="nama_anggota_pengabdian" required></textarea>
                                        <p>contoh: (Anggota 1; Anggota 2; dst)</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_pengabdian" class="col-sm-2 col-form-label">Judul pengabdian</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_pengabdian" id="judul_pengabdian" class="form-control" placeholder="Masukkan judul pengabdian" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="skim_pengabdian" class="col-sm-2 col-form-label">Skim pengabdian</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="skim_pengabdian" id="skim_pengabdian" class="form-control" placeholder="Masukkan skim pengabdian" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="pemberi_hibah_pengabdian" class="col-sm-2 col-form-label">Pemberi Hibah</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="pemberi_hibah_pengabdian" id="pemberi_hibah_pengabdian" class="form-control" placeholder="Masukkan pemberi hibah" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="besar_hibah_pengabdian" class="col-sm-2 col-form-label">Besar Hibah</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="besar_hibah_pengabdian" id="besar_hibah_pengabdian" class="form-control" placeholder="Masukkan besar hibah" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nama_mahasiswa_pengabdian" class="col-sm-2 col-form-label">Nama Mahasiswa yang Terlibat</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="nama_mahasiswa_pengabdian" id="nama_mahasiswa_pengabdian" required></textarea>
                                        <p>Contoh : Mahasiswa 1 (NIM1) ; Mahasiswa 2 (NIM2) ; Dst</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="kontrak_pengabdian" class="col-sm-2 col-form-label">Unggah Kontrak Pengabdian</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="kontrak_pengabdian" id="kontrak_pengabdian">
                                        Upload 1 file yang didukung: PDF. Maks 100 MB.
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="laporan_pengabdian" class="col-sm-2 col-form-label">Unggah Laporan Pengabdian</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="laporan_pengabdian" id="laporan_pengabdian">
                                        Upload 1 file yang didukung: PDF. Maks 100 MB.
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Artikel Ilmiah -->
                            <div class="artikel_ilmiah d-none" id="artikel_ilmiah">
                                <div class="row mb-3">
                                    <label for="kategori_ilmiah" class="col-sm-2 col-form-label">Kategori Artikel Ilmiah</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="kategori_ilmiah" id="kategori_ilmiah">
                                            <option value="" selected hidden>Pilih Kategori Artikel Ilmiah</option>
                                            <option value="Nasional Sinta 1">Nasional Sinta 1</option>
                                            <option value="Nasional Sinta 2">Nasional Sinta 2</option>
                                            <option value="Nasional Sinta 3">Nasional Sinta 3</option>
                                            <option value="Nasional Sinta 4">Nasional Sinta 4</option>
                                            <option value="Nasional Sinta 5">Nasional Sinta 5</option>
                                            <option value="Nasional Sinta 6">Nasional Sinta 6</option>
                                            <option value="Nasional Tidak Terakreditasi">Nasional Tidak Terakreditasi</option>
                                            <option value="Internasional Q1">Internasional Q1</option>
                                            <option value="Internasional Q2">Internasional Q2</option>
                                            <option value="Internasional Q3">Internasional Q3</option>
                                            <option value="Internasional Q4">Internasional Q4</option>
                                            <option value="Internasional Non Scopus">Internasional Non Scopus</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen HAKI -->
                            <div class="HAKI d-none" id="HAKI">
                                <div class="row mb-3">
                                    <label for="kategori_haki" class="col-sm-2 col-form-label">Kategori HAKI</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="kategori_haki" id="kategori_haki">
                                            <option value="" selected hidden>Pilih Kategori HAKI</option>
                                            <option value="hak_cipta">Hak Cipta</option>
                                            <option value="paten">Paten</option>
                                            <option value="desain_industri">Desain Industri</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Hak Cipta -->
                            <div class="hak_cipta d-none" id="hak_cipta">
                                <div class="row mb-3">
                                    <label for="nama_pengusul" class="col-sm-2 col-form-label">Nama Pengusul</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_pengusul" id="nama_pengusul" class="form-control" placeholder="Masukkan nama Pengusul" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nama_pemegang_hak_cipta" class="col-sm-2 col-form-label">Nama Pemegang Hak Cipta</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="nama_pemegang_hak_cipta" id="nama_pemegang_hak_cipta" placeholder="Masukkan nama pemegang hak cipta" required></textarea>
                                        <p class="text-danger">*contoh: (Nama 1; Nama 2; dst)</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_hak_cipta" class="col-sm-2 col-form-label">Judul Hak Cipta</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_hak_cipta" id="judul_hak_cipta" class="form-control" placeholder="Masukkan judul hak cipta" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="sertifikat_hak_cipta" class="col-sm-2 col-form-label">Unggah Sertifikat Hak Cipta</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="sertifikat_hak_cipta" id="sertifikat_hak_cipta">
                                        <p class="text-danger">*Upload 1 file yang didukung: PDF. Maks 10 MB.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Paten -->
                            <div class="paten d-none" id="paten">
                                <div class="row mb-3">
                                    <label for="nama_pemegang_hak_cipta" class="col-sm-2 col-form-label">Nama Inventor (Inventor 1; Inventor 2; dst)</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="nama_pemegang_hak_cipta" id="nama_pemegang_hak_cipta" placeholder="Masukkan nama pemegang hak cipta" required></textarea>
                                        <p class="text-danger">*contoh: (Inventor 1; Inventor 2; dst)</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_hak_cipta" class="col-sm-2 col-form-label">Judul Invensi</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_hak_cipta" id="judul_hak_cipta" class="form-control" placeholder="Masukkan judul invensi" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="sertifikat_hak_cipta" class="col-sm-2 col-form-label">Unggah Sertifikat Paten</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="sertifikat_hak_cipta" id="sertifikat_hak_cipta">
                                        <p class="text-danger">*Upload 1 file yang didukung: PDF. Maks 10 MB.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Desain Industri -->
                            <div class="desain_industri d-none" id="desain_industri">
                                <div class="row mb-3">
                                    <label for="nama_pemegang_hak_cipta" class="col-sm-2 col-form-label">Nama Pengusul</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="nama_pemegang_hak_cipta" id="nama_pemegang_hak_cipta" placeholder="Masukkan nama pemegang hak cipta" required></textarea>
                                        <p class="text-danger">*contoh: (Pengusul 1; Pengusul 2; dst)</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_hak_cipta" class="col-sm-2 col-form-label">Judul Invensi</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_hak_cipta" id="judul_hak_cipta" class="form-control" placeholder="Masukkan judul invensi" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="sertifikat_hak_cipta" class="col-sm-2 col-form-label">Unggah Sertifikat Desain Industri</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="sertifikat_hak_cipta" id="sertifikat_hak_cipta">
                                        <p class="text-danger">*Upload 1 file yang didukung: PDF. Maks 10 MB.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="<?= base_url('ewmp') ?>" class="btn btn-secondary mb-4">Kembali</a>
                            <button type="submit" class="btn btn-primary mb-4">Simpan</button>
                        </div>
                    </form>
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
                    <a href="<?= base_url('renstra/create_view3') ?>" class="btn btn-primary mb-4">Ke Level 3</a>
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
    // Mengontrol visibilitas komponen penelitian berdasarkan pilihan jenis pelaporan
    document.getElementById("jenis_lapor").addEventListener("change", function() {
        var penelitianDiv = document.getElementById("penelitian");
        var pengabdianDiv = document.getElementById("pengabdian");
        var ilmiahDiv = document.getElementById("artikel_ilmiah");
        var hakiDiv = document.getElementById("HAKI");

        // Kondisi untuk menampilkan atau menyembunyikan komponen penelitian
        if (this.value === "Penelitian") {
            penelitianDiv.classList.remove("d-none");
        } else {
            penelitianDiv.classList.add("d-none");
        }

        // Kondisi untuk komponen pengabdian
        if (this.value === "Pengabdian") {
            pengabdianDiv.classList.remove("d-none");
        } else {
            pengabdianDiv.classList.add("d-none");
        }

        // Kondisi untuk komponen artikel ilmiah
        if (this.value === "Artikel/Karya Ilmiah") {
            ilmiahDiv.classList.remove("d-none");
        } else {
            ilmiahDiv.classList.add("d-none");
        }

        // Kondisi untuk komponen HAKI
        if (this.value === "HAKI") {
            hakiDiv.classList.remove("d-none");
        } else {
            hakiDiv.classList.add("d-none");
        }
    });

    // Event listener untuk menampilkan komponen hak_cipta berdasarkan pilihan pada kategori HAKI
    document.getElementById("kategori_haki").addEventListener("change", function() {
        var hakCiptaDiv = document.getElementById("hak_cipta");

        // Tampilkan komponen hak_cipta jika pilihan adalah 'hak_cipta', sembunyikan jika bukan
        if (this.value === "hak_cipta") {
            hakCiptaDiv.classList.remove("d-none"); // Tampilkan komponen hak_cipta
        } else {
            hakCiptaDiv.classList.add("d-none"); // Sembunyikan komponen hak_cipta
        }
    });
</script>