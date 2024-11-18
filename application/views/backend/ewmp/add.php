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
                    <form method="post" action="<?= base_url('ewmp/add') ?>" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Masukkan email anda">
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
                                        <input type="text" name="nama_ketua_penelitian" id="nama_ketua_penelitian" class="form-control" placeholder="Masukkan nama ketua">
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
                                        <textarea class="form-control" style="height: 100px" name="nama_anggota_penelitian" id="nama_anggota_penelitian"></textarea>
                                        <p>contoh: (Anggota 1; Anggota 2; dst)</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_penelitian" class="col-sm-2 col-form-label">Judul Penelitian</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_penelitian" id="judul_penelitian" class="form-control" placeholder="Masukkan judul penelitian">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="skim_penelitian" class="col-sm-2 col-form-label">Skim Penelitian</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="skim_penelitian" id="skim_penelitian" class="form-control" placeholder="Masukkan skim penelitian">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="pemberi_hibah_penelitian" class="col-sm-2 col-form-label">Pemberi Hibah</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="pemberi_hibah_penelitian" id="pemberi_hibah_penelitian" class="form-control" placeholder="Masukkan pemberi hibah">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="besar_hibah_penelitian" class="col-sm-2 col-form-label">Besar Hibah</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="besar_hibah_penelitian" id="besar_hibah_penelitian" class="form-control" placeholder="Masukkan besar hibah">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nama_mahasiswa_penelitian" class="col-sm-2 col-form-label">Nama Mahasiswa yang Terlibat</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="nama_mahasiswa_penelitian" id="nama_mahasiswa_penelitian"></textarea>
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
                                        <input type="text" name="nama_ketua_pengabdian" id="nama_ketua_pengabdian" class="form-control" placeholder="Masukkan nama ketua">
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
                                        <textarea class="form-control" style="height: 100px" name="nama_anggota_pengabdian" id="nama_anggota_pengabdian"></textarea>
                                        <p>contoh: (Anggota 1; Anggota 2; dst)</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_pengabdian" class="col-sm-2 col-form-label">Judul pengabdian</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_pengabdian" id="judul_pengabdian" class="form-control" placeholder="Masukkan judul pengabdian">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="skim_pengabdian" class="col-sm-2 col-form-label">Skim pengabdian</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="skim_pengabdian" id="skim_pengabdian" class="form-control" placeholder="Masukkan skim pengabdian">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="pemberi_hibah_pengabdian" class="col-sm-2 col-form-label">Pemberi Hibah</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="pemberi_hibah_pengabdian" id="pemberi_hibah_pengabdian" class="form-control" placeholder="Masukkan pemberi hibah">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="besar_hibah_pengabdian" class="col-sm-2 col-form-label">Besar Hibah</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="besar_hibah_pengabdian" id="besar_hibah_pengabdian" class="form-control" placeholder="Masukkan besar hibah">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nama_mahasiswa_pengabdian" class="col-sm-2 col-form-label">Nama Mahasiswa yang Terlibat</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="nama_mahasiswa_pengabdian" id="nama_mahasiswa_pengabdian"></textarea>
                                        <p>Contoh : Mahasiswa 1 (NIM1) ; Mahasiswa 2 (NIM2) ; Dst</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="kontrak_pengabdian" class="col-sm-2 col-form-label">Unggah Kontrak Pengabdian</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="kontrak_pengabdian" id="kontrak_pengabdian">
                                        Upload 1 file yang didukung: PDF. Maks 10 MB.
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="laporan_pengabdian" class="col-sm-2 col-form-label">Unggah Laporan Pengabdian</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="laporan_pengabdian" id="laporan_pengabdian">
                                        Upload 1 file yang didukung: PDF. Maks 10 MB.
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Kategori Artikel Ilmiah -->
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
                            <!-- Komponen Artikel Ilmiah -->
                            <div class="ilmiah d-none" id="ilmiah">
                                <div class="row mb-3">
                                    <label for="nama_pertama_ilmiah" class="col-sm-2 col-form-label">Nama Penulis Pertama</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_pertama_ilmiah" id="nama_pertama_ilmiah" class="form-control" placeholder="Masukkan nama penulis pertama">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nama_korespon_ilmiah" class="col-sm-2 col-form-label">Nama Penulis Korespondensi</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_korespon_ilmiah" id="nama_korespon_ilmiah" class="form-control" placeholder="Masukkan nama penulis korespondensi">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nama_anggota_ilmiah" class="col-sm-2 col-form-label">Nama Anggota</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="nama_anggota_ilmiah" id="nama_anggota_ilmiah"></textarea>
                                        <p>contoh: (Anggota 1; Anggota 2; dst)</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_artikel_ilmiah" class="col-sm-2 col-form-label">Judul Artikel</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_artikel_ilmiah" id="judul_artikel_ilmiah" class="form-control" placeholder="Masukkan judul artikel">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_jurnal_ilmiah" class="col-sm-2 col-form-label">Judul Jurnal</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_jurnal_ilmiah" id="judul_jurnal_ilmiah" class="form-control" placeholder="Masukkan judul jurnal">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="link_jurnal_ilmiah" class="col-sm-2 col-form-label">Link Jurnal</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="link_jurnal_ilmiah" id="link_jurnal_ilmiah"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="volume_jurnal_ilmiah" class="col-sm-2 col-form-label">Volume Jurnal</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="volume_jurnal_ilmiah" id="volume_jurnal_ilmiah" class="form-control" placeholder="Masukkan volume jurnal">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nomor_jurnal_ilmiah" class="col-sm-2 col-form-label">Nomor Jurnal</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nomor_jurnal_ilmiah" id="nomor_jurnal_ilmiah" class="form-control" placeholder="Masukkan nomor jurnal">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="doi_ilmiah" class="col-sm-2 col-form-label">DOI</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="doi_ilmiah" id="doi_ilmiah" class="form-control" placeholder="Masukkan DOI">
                                    </div>
                                </div>
                                <div class="pengindeks d-none" id="pengindeks">
                                    <div class="row mb-3">
                                        <label for="pengindeks_ilmiah" class="col-sm-2 col-form-label">Pengindeks</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="pengindeks_ilmiah" id="pengindeks_ilmiah" class="form-control" placeholder="Masukkan pengindeks">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Prosiding -->
                            <div class="prosiding d-none" id="prosiding">
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Kategori Prosiding</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kategori_prosiding" id="kategori_prosiding1" value="Nasional" checked>
                                            <label class="form-check-label" for="kategori_prosiding1">Nasional</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kategori_prosiding" id="kategori_prosiding2" value="Internasional">
                                            <label class="form-check-label" for="kategori_prosiding2">Internasional</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="row mb-3">
                                    <label for="nama_pertama_prosiding" class="col-sm-2 col-form-label">Nama Penulis Pertama</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_pertama_prosiding" id="nama_pertama_prosiding" class="form-control" placeholder="Masukkan nama penulis pertama">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nama_korespon_prosiding" class="col-sm-2 col-form-label">Nama Penulis Korespondensi</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_korespon_prosiding" id="nama_korespon_prosiding" class="form-control" placeholder="Masukkan nama penulis korespondensi">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nama_anggota_prosiding" class="col-sm-2 col-form-label">Nama Anggota</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="nama_anggota_prosiding" id="nama_anggota_prosiding"></textarea>
                                        <p>contoh: (Anggota 1; Anggota 2; dst)</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_artikel_prosiding" class="col-sm-2 col-form-label">Judul Artikel</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_artikel_prosiding" id="judul_artikel_prosiding" class="form-control" placeholder="Masukkan judul artikel">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_seminar_prosiding" class="col-sm-2 col-form-label">Judul Conference/Seminar</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_seminar_prosiding" id="judul_seminar_prosiding" class="form-control" placeholder="Masukkan judul seminar">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="bukti_loa_prosiding" class="col-sm-2 col-form-label">Bukti LOA</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="bukti_loa_prosiding" id="bukti_loa_prosiding">
                                        Upload 1 file yang didukung: PDF. Maks 10 MB.
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="doi_prosiding" class="col-sm-2 col-form-label">DOI (jika sudah terbit)</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="doi_prosiding" id="doi_prosiding" class="form-control" placeholder="Masukkan DOI">
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
                                            <option value="Hak Cipta">Hak Cipta</option>
                                            <option value="Paten">Paten</option>
                                            <option value="Desain Industri">Desain Industri</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Hak Cipta -->
                            <div class="hak_cipta d-none" id="hak_cipta">
                                <div class="row mb-3">
                                    <label for="nama_pengusul" class="col-sm-2 col-form-label">Nama Pengusul</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_pengusul" id="nama_pengusul" class="form-control" placeholder="Masukkan nama Pengusul">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nama_pemegang_hak_cipta" class="col-sm-2 col-form-label">Nama Pemegang Hak Cipta</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="nama_pemegang_hak_cipta" id="nama_pemegang_hak_cipta" placeholder="Masukkan nama pemegang hak cipta"></textarea>
                                        <p class="text-danger">*contoh: (Nama 1; Nama 2; dst)</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_hak_cipta" class="col-sm-2 col-form-label">Judul Hak Cipta</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_hak_cipta" id="judul_hak_cipta" class="form-control" placeholder="Masukkan judul hak cipta">
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
                                        <textarea class="form-control" style="height: 100px" name="nama_pemegang_hak_cipta" id="nama_pemegang_hak_cipta" placeholder="Masukkan nama pemegang hak cipta"></textarea>
                                        <p class="text-danger">*contoh: (Inventor 1; Inventor 2; dst)</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_hak_cipta" class="col-sm-2 col-form-label">Judul Invensi</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_hak_cipta" id="judul_hak_cipta" class="form-control" placeholder="Masukkan judul invensi">
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
                                        <textarea class="form-control" style="height: 100px" name="nama_pemegang_hak_cipta" id="nama_pemegang_hak_cipta" placeholder="Masukkan nama pemegang hak cipta"></textarea>
                                        <p class="text-danger">*contoh: (Pengusul 1; Pengusul 2; dst)</p>
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
                            <!-- Komponen Editor Jurnal -->
                            <div class="editor_jurnal d-none" id="editor_jurnal">
                                <div class="row mb-3">
                                    <label for="nama_pengusul" class="col-sm-2 col-form-label">Nama Pengusul</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_pengusul" id="nama_pengusul" class="form-control" placeholder="Masukkan nama pengusul">
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
                                <div class="row mb-3">
                                    <label for="judul_jurnal" class="col-sm-2 col-form-label">Judul Jurnal</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_jurnal" id="judul_jurnal" class="form-control" placeholder="Masukkan judul jurnal">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="laporan_maju_jurnal" class="col-sm-2 col-form-label">Unggah SK</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="laporan_maju_jurnal" id="laporan_maju_jurnal">
                                        <p>Upload 1 file yang didukung: PDF. Maks 10 MB.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Reviewer Jurnal -->
                            <div class="reviewer_jurnal d-none" id="reviewer_jurnal">
                                <div class="row mb-3">
                                    <label for="nama_pengusul_reviewer" class="col-sm-2 col-form-label">Nama Pengusul</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_pengusul_reviewer" id="nama_pengusul_reviewer" class="form-control" placeholder="Masukkan nama pengusul">
                                    </div>
                                </div>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Program Studi</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_reviewer" id="prodi_reviewer1" value="Teknik Elektro" checked>
                                            <label class="form-check-label" for="prodi_reviewer1">Teknik Elektro</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_reviewer" id="prodi_reviewer2" value="Teknik Industri">
                                            <label class="form-check-label" for="prodi_reviewer2">Teknik Industri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_reviewer" id="prodi_reviewer3" value="Teknik Biomedis">
                                            <label class="form-check-label" for="prodi_reviewer3">Teknik Biomedis</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="row mb-3">
                                    <label for="judul_artikel_review" class="col-sm-2 col-form-label">Judul artikel yang telah direview</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_artikel_review" id="judul_artikel_review" class="form-control" placeholder="Masukkan judul artikel yang telah direview">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_jurnal_review" class="col-sm-2 col-form-label">Judul Jurnal</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_jurnal_review" id="judul_jurnal_review" class="form-control" placeholder="Masukkan judul jurnal">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="laporan_maju_reviewer" class="col-sm-2 col-form-label">Sertifikat Reviewer / bukti lain yang menyatakan telah menyelesaikan proses review</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="laporan_maju_reviewer" id="laporan_maju_reviewer">
                                        <p>Upload 1 file yang didukung: PDF. Maks 10 MB.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Invited Speaker -->
                            <div class="invited_speaker d-none" id="invited_speaker">
                                <div class="row mb-3">
                                    <label for="nama_pengusul_reviewer" class="col-sm-2 col-form-label">Nama Pengusul</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_pengusul_reviewer" id="nama_pengusul_reviewer" class="form-control" placeholder="Masukkan nama pengusul">
                                    </div>
                                </div>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Program Studi</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_reviewer" id="prodi_reviewer1" value="Teknik Elektro" checked>
                                            <label class="form-check-label" for="prodi_reviewer1">Teknik Elektro</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_reviewer" id="prodi_reviewer2" value="Teknik Industri">
                                            <label class="form-check-label" for="prodi_reviewer2">Teknik Industri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_reviewer" id="prodi_reviewer3" value="Teknik Biomedis">
                                            <label class="form-check-label" for="prodi_reviewer3">Teknik Biomedis</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="row mb-3">
                                    <label for="judul_kegiatan" class="col-sm-2 col-form-label">Judul Kegiatan</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_kegiatan" id="judul_kegiatan" class="form-control" placeholder="Masukkan judul kegiatan">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="penyelenggara" class="col-sm-2 col-form-label">Penyelenggara</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="penyelenggara" id="penyelenggara" class="form-control" placeholder="Masukkan penyelenggara">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="laporan_maju_reviewer" class="col-sm-2 col-form-label">Unggah Undangan, sertifikat dan bukti telah menyelesaikan kegiatan (dijadikan 1 dokumen)</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="laporan_maju_reviewer" id="laporan_maju_reviewer">
                                        <p>Upload 1 file yang didukung: PDF. Maks 10 MB.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Pengurus Organisasi Profesi -->
                            <div class="pengurus_organisasi d-none" id="pengurus_organisasi">
                                <div class="row mb-3">
                                    <label for="nama_organisasi_profesi" class="col-sm-2 col-form-label">Nama Organisasi Profesi</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_organisasi_profesi" id="nama_organisasi_profesi" class="form-control" placeholder="Masukkan nama organisasi profesi">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="Masukkan jabatan">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="masa_jabatan" class="col-sm-2 col-form-label">Masa Jabatan</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="masa_jabatan" id="masa_jabatan" class="form-control" placeholder="Masukkan masa jabatan">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="dokumen_bukti" class="col-sm-2 col-form-label">Unggah SK dan Surat tugas serta bukti lain telah menyelesaikan tugas</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="dokumen_bukti" id="dokumen_bukti">
                                        <p>Upload 1 file yang didukung: PDF. Maks 10 MB.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div>
                                <a href="<?= base_url('ewmp') ?>" type="button" class="btn btn-secondary my-2">Kembali</a>
                            </div>
                            <button type="submit" class="btn btn-primary my-2">Simpan</button>
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
        var ilmiahDiv = document.getElementById("ilmiah"); // Tambahkan ini agar seluruh komponen ilmiah tampil
        var artikelIlmiahDiv = document.getElementById("artikel_ilmiah"); // Pastikan elemen ini dipanggil
        var prosidingDiv = document.getElementById("prosiding");

        // Reset visibility for all divs
        penelitianDiv.classList.add("d-none");
        pengabdianDiv.classList.add("d-none");
        ilmiahDiv.classList.add("d-none");
        artikelIlmiahDiv.classList.add("d-none"); // Tambahkan reset visibilitas kategori ilmiah
        prosidingDiv.classList.add("d-none");

        if (this.value === "Penelitian") {
            penelitianDiv.classList.remove("d-none");
        } else if (this.value === "Pengabdian") {
            pengabdianDiv.classList.remove("d-none");
        } else if (this.value === "Artikel/Karya Ilmiah") {
            ilmiahDiv.classList.remove("d-none"); // Tampilkan seluruh komponen ilmiah
            artikelIlmiahDiv.classList.remove("d-none"); // Tampilkan kategori ilmiah
        } else if (this.value === "Prosiding") {
            prosidingDiv.classList.remove("d-none");
        }

        // Nested event listener for kategori_ilmiah
        document.getElementById("kategori_ilmiah").addEventListener("change", function() {
            var pengindeksDiv = document.getElementById("pengindeks");
            var ilmiahKategoriDiv = document.getElementById("ilmiah");

            // Reset visibility of both divs in kategori_ilmiah section
            ilmiahKategoriDiv.classList.add("d-none");
            pengindeksDiv.classList.add("d-none");

            var nasionalValues = [
                "Nasional Sinta 1", "Nasional Sinta 2", "Nasional Sinta 3",
                "Nasional Sinta 4", "Nasional Sinta 5", "Nasional Sinta 6",
                "Nasional Tidak Terakreditasi"
            ];
            var internasionalValues = [
                "Internasional Q1", "Internasional Q2", "Internasional Q3",
                "Internasional Q4", "Internasional Non Scopus"
            ];

            if (nasionalValues.includes(this.value)) {
                ilmiahKategoriDiv.classList.remove("d-none"); // Tampilkan ilmiah
            } else if (internasionalValues.includes(this.value)) {
                ilmiahKategoriDiv.classList.remove("d-none"); // Tampilkan ilmiah
                pengindeksDiv.classList.remove("d-none"); // Tampilkan pengindeks
            }
        });
    });

    // HAKI
    document.getElementById("jenis_lapor").addEventListener("change", function() {
        var hakiDiv = document.getElementById("HAKI");
        var hakCiptaDiv = document.getElementById("hak_cipta");
        var patenDiv = document.getElementById("paten");
        var desainIndustriDiv = document.getElementById("desain_industri");

        // Reset visibility for all HAKI-related divs
        hakiDiv.classList.add("d-none");
        hakCiptaDiv.classList.add("d-none");
        patenDiv.classList.add("d-none");
        desainIndustriDiv.classList.add("d-none");

        // Show HAKI section if "HAKI" is selected
        if (this.value === "HAKI") {
            hakiDiv.classList.remove("d-none");
        }

        // Event listener for Kategori HAKI selection
        document.getElementById("kategori_haki").addEventListener("change", function() {
            // Reset visibility for all specific HAKI categories
            hakCiptaDiv.classList.add("d-none");
            patenDiv.classList.add("d-none");
            desainIndustriDiv.classList.add("d-none");

            // Display appropriate category based on selection
            if (this.value === "Hak Cipta") {
                hakCiptaDiv.classList.remove("d-none");
            } else if (this.value === "Paten") {
                patenDiv.classList.remove("d-none");
            } else if (this.value === "Desain Industri") {
                desainIndustriDiv.classList.remove("d-none");
            }
        });
    });

    // Editor Jurnal
    document.getElementById("jenis_lapor").addEventListener("change", function() {
        var editorJurnalDiv = document.getElementById("editor_jurnal");

        editorJurnalDiv.classList.add("d-none");

        if (this.value === "Editor Jurnal") {
            editorJurnalDiv.classList.remove("d-none");
        }
    });

    // Show Reviewer Jurnal
    document.getElementById("jenis_lapor").addEventListener("change", function() {
        var reviewerJurnalDiv = document.getElementById("reviewer_jurnal");

        // Reset visibility for all sections
        reviewerJurnalDiv.classList.add("d-none");

        // Show reviewer jurnal section if "Reviewer Jurnal" is selected
        if (this.value === "Reviewer Jurnal") {
            reviewerJurnalDiv.classList.remove("d-none");
        }
    });

    // Invited Speaker
    document.getElementById("jenis_lapor").addEventListener("change", function() {
        var reviewerJurnalDiv = document.getElementById("invited_speaker");

        // Reset visibility for all sections
        reviewerJurnalDiv.classList.add("d-none");

        // Show Invited Speaker section if "Invited Speaker" is selected
        if (this.value === "Invited Speaker") {
            reviewerJurnalDiv.classList.remove("d-none");
        }
    });

    // Pengurus Organisasi Profesi
    document.getElementById("jenis_lapor").addEventListener("change", function() {
        var reviewerJurnalDiv = document.getElementById("pengurus_organisasi");

        // Reset visibility for all sections
        reviewerJurnalDiv.classList.add("d-none");

        // Show Pengurus Organisasi Profesi section if "Pengurus Organisasi Profesi" is selected
        if (this.value === "Pengurus Organisasi Profesi") {
            reviewerJurnalDiv.classList.remove("d-none");
        }
    });
</script>