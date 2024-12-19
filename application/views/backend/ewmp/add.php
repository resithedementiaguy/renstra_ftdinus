<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                <li class="breadcrumb-item">Pelaporan EWMP</li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-info">
                        <h5 class="pt-2"><strong>Tambah Pelaporan EWMP</strong></h5>
                    </div>
                    <form method="post" action="<?= base_url('ewmp/add') ?>" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                Silahkan untuk mengisi Pelaporan EWMP Fakultas Teknik UDINUS Semarang
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Masukkan email anda" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tahun" class="col-sm-2 col-form-label">Pilih Tahun Pelaporan</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="tahun" id="tahun" required>
                                        <option value="<?= date('Y') ?>" selected hidden><?= date('Y') ?></option>
                                        <?php foreach ($tahun as $thn): ?>
                                            <option value="<?= $thn->tahun ?>"><?= $thn->tahun ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jenis_lapor" class="col-sm-2 col-form-label">Jenis Pelaporan</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="jenis_lapor" id="jenis_lapor" required>
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
                                <div id="dynamicAnggotaPenelitianContainer"></div>
                                <div class="row mb-3">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-primary" id="addAnggotaPenelitian">Tambah Anggota</button>
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
                                    <label for="besar_hibah_penelitian" class="col-sm-2 col-form-label">Besar Hibah Penelitian</label>
                                    <div class="col-sm-10">
                                        <input
                                            type="text"
                                            name="besar_hibah_penelitian"
                                            id="besar_hibah_penelitian"
                                            class="form-control"
                                            placeholder="Masukkan besar hibah"
                                            oninput="formatRupiah(this)"
                                            data-raw-value="">
                                    </div>
                                </div>
                                <div id="dynamicMahasiswaPenelitianContainer"></div>
                                <div class="row mb-3">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-primary" id="addMahasiswaPenelitian">Tambah Mahasiswa</button>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="kontrak_penelitian" class="col-sm-2 col-form-label">Link Google Drive Kontrak Penelitian</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="kontrak_penelitian" id="kontrak_penelitian" placeholder="Masukkan link kontrak penelitian"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="laporan_maju_penelitian" class="col-sm-2 col-form-label">Link Google Drive Laporan Kemajuan / Akhir Penelitian</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="laporan_maju_penelitian" id="laporan_maju_penelitian" placeholder="Masukkan link laporan maju penelitian"></textarea>
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
                                <div id="dynamicAnggotaPengabdianContainer"></div>
                                <div class="row mb-3">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-primary" id="addAnggotaPengabdian">Tambah Anggota</button>
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
                                    <label for="besar_hibah_pengabdian" class="col-sm-2 col-form-label">Besar Hibah Pengabdian</label>
                                    <div class="col-sm-10">
                                        <input
                                            type="text"
                                            name="besar_hibah_pengabdian"
                                            id="besar_hibah_pengabdian"
                                            class="form-control"
                                            placeholder="Masukkan besar hibah"
                                            oninput="formatRupiah(this)"
                                            data-raw-value="">
                                    </div>
                                </div>
                                <div id="dynamicMahasiswaPengabdianContainer"></div>
                                <div class="row mb-3">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-primary" id="addMahasiswaPengabdian">Tambah Mahasiswa</button>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="kontrak_pengabdian" class="col-sm-2 col-form-label">Link Google Drive Kontrak Pengabdian</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="kontrak_pengabdian" id="kontrak_pengabdian" placeholder="Masukkan link kontrak pengabdian"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="laporan_pengabdian" class="col-sm-2 col-form-label">Link Google Drive Laporan Pengabdian</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="laporan_pengabdian" id="laporan_pengabdian" placeholder="Masukkan link laporan pengabdian"></textarea>
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
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Program Studi</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_ilmiah" id="prodi_ilmiah1" value="Teknik Elektro" checked>
                                            <label class="form-check-label" for="prodi_ilmiah1">Teknik Elektro</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_ilmiah" id="prodi_ilmiah2" value="Teknik Industri">
                                            <label class="form-check-label" for="prodi_ilmiah2">Teknik Industri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_ilmiah" id="prodi_ilmiah3" value="Teknik Biomedis">
                                            <label class="form-check-label" for="prodi_ilmiah3">Teknik Biomedis</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="row mb-3">
                                    <label for="nama_korespon_ilmiah" class="col-sm-2 col-form-label">Nama Penulis Korespondensi</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_korespon_ilmiah" id="nama_korespon_ilmiah" class="form-control" placeholder="Masukkan nama penulis korespondensi">
                                    </div>
                                </div>
                                <div id="dynamicAnggotaIlmiahContainer"></div>
                                <div class="row mb-3">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-primary" id="addAnggotaIlmiah">Tambah Anggota</button>
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
                                        <textarea class="form-control" style="height: 100px" name="link_jurnal_ilmiah" id="link_jurnal_ilmiah" placeholder="Masukkan link jurnal"></textarea>
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
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Program Studi</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_prosiding" id="prodi_prosiding1" value="Teknik Elektro" checked>
                                            <label class="form-check-label" for="prodi_prosiding1">Teknik Elektro</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_prosiding" id="prodi_prosiding2" value="Teknik Industri">
                                            <label class="form-check-label" for="prodi_prosiding2">Teknik Industri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_prosiding" id="prodi_prosiding3" value="Teknik Biomedis">
                                            <label class="form-check-label" for="prodi_prosiding3">Teknik Biomedis</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="row mb-3">
                                    <label for="nama_korespon_prosiding" class="col-sm-2 col-form-label">Nama Penulis Korespondensi</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_korespon_prosiding" id="nama_korespon_prosiding" class="form-control" placeholder="Masukkan nama penulis korespondensi">
                                    </div>
                                </div>
                                <div id="dynamicAnggotaProsidingContainer"></div>
                                <div class="row mb-3">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-primary" id="addAnggotaProsiding">Tambah Anggota</button>
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
                                    <label for="bukti_loa_prosiding" class="col-sm-2 col-form-label">Link Google Drive Bukti LOA</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="bukti_loa_prosiding" id="bukti_loa_prosiding" placeholder="Masukkan link bukti LOA"></textarea>
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
                                            <option value="Merk">Merk/Rahasia Dagang</option>
                                            <option value="Lisensi">Lisensi</option>
                                            <option value="Buku">Buku/Chapter</option>
                                            <option value="Paten">Paten</option>
                                            <option value="Desain Industri">Desain Industri</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Hak Cipta -->
                            <div class="hak_cipta d-none" id="hak_cipta">
                                <div class="row mb-3">
                                    <label for="nama_pengusul_hcipta" class="col-sm-2 col-form-label">Nama Pengusul</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_pengusul_hcipta" id="nama_pengusul_hcipta" class="form-control" placeholder="Masukkan nama Pengusul">
                                    </div>
                                </div>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Program Studi</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_hcipta" id="prodi_hcipta1" value="Teknik Elektro" checked>
                                            <label class="form-check-label" for="prodi_hcipta1">Teknik Elektro</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_hcipta" id="prodi_hcipta2" value="Teknik Industri">
                                            <label class="form-check-label" for="prodi_hcipta2">Teknik Industri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_hcipta" id="prodi_hcipta3" value="Teknik Biomedis">
                                            <label class="form-check-label" for="prodi_hcipta3">Teknik Biomedis</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div id="dynamicNamaHakCiptaContainer"></div>
                                <div class="row mb-3">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-primary" id="addNamaHakCipta">Tambah Nama Pemegang Hak Cipta</button>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_hcipta" class="col-sm-2 col-form-label">Judul Hak Cipta</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_hcipta" id="judul_hcipta" class="form-control" placeholder="Masukkan judul hak cipta">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="sertifikat_hcipta" class="col-sm-2 col-form-label">Link Google Drive Sertifikat Hak Cipta</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="sertifikat_hcipta" id="sertifikat_hcipta" placeholder="Masukkan link sertifikat"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Merk -->
                            <div class="merk d-none" id="merk">
                                <div class="row mb-3">
                                    <label for="nama_pengusul_merk" class="col-sm-2 col-form-label">Nama Pengusul</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_pengusul_merk" id="nama_pengusul_merk" class="form-control" placeholder="Masukkan nama Pengusul">
                                    </div>
                                </div>
                                <div id="dynamicNamaMerkContainer"></div>
                                <div class="row mb-3">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-primary" id="addNamaMerk">Tambah Nama Pemegang Merk</button>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_merk" class="col-sm-2 col-form-label">Judul Merk</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_merk" id="judul_merk" class="form-control" placeholder="Masukkan judul Merk">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="sertifikat_merk" class="col-sm-2 col-form-label">Link Google Drive Sertifikat Merk</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="sertifikat_merk" id="sertifikat_merk" placeholder="Masukkan link sertifikat"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Lisensi -->
                            <div class="lisensi d-none" id="lisensi">
                                <div class="row mb-3">
                                    <label for="nama_pengusul_lisensi" class="col-sm-2 col-form-label">Nama Pengusul</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_pengusul_lisensi" id="nama_pengusul_lisensi" class="form-control" placeholder="Masukkan nama Pengusul">
                                    </div>
                                </div>
                                <div id="dynamicNamaLisensiContainer"></div>
                                <div class="row mb-3">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-primary" id="addNamaLisensi">Tambah Nama Pemegang Lisensi</button>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_lisensi" class="col-sm-2 col-form-label">Judul Lisensi</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_lisensi" id="judul_lisensi" class="form-control" placeholder="Masukkan judul lisensi">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="sertifikat_lisensi" class="col-sm-2 col-form-label">Link Google Drive Sertifikat Lisensi</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="sertifikat_lisensi" id="sertifikat_lisensi" placeholder="Masukkan link sertifikat"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Buku/Chapter -->
                            <div class="buku d-none" id="buku">
                                <div class="row mb-3">
                                    <label for="nama_pengusul_buku" class="col-sm-2 col-form-label">Nama Pengusul</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_pengusul_buku" id="nama_pengusul_buku" class="form-control" placeholder="Masukkan nama Pengusul">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="isbn_buku" class="col-sm-2 col-form-label">ISBN</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="isbn_buku" id="isbn_buku" class="form-control" placeholder="Masukkan nomor ISBN">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_buku" class="col-sm-2 col-form-label">Judul buku</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_buku" id="judul_buku" class="form-control" placeholder="Masukkan judul buku">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="file_buku" class="col-sm-2 col-form-label">Link Google Drive File Buku</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="file_buku" id="file_buku" placeholder="Masukkan link file buku"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Paten -->
                            <div class="paten d-none" id="paten">
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Program Studi</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_paten" id="prodi_paten1" value="Teknik Elektro" checked>
                                            <label class="form-check-label" for="prodi_paten1">Teknik Elektro</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_paten" id="prodi_paten2" value="Teknik Industri">
                                            <label class="form-check-label" for="prodi_paten2">Teknik Industri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_paten" id="prodi_paten3" value="Teknik Biomedis">
                                            <label class="form-check-label" for="prodi_paten3">Teknik Biomedis</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div id="dynamicNamaInventorContainer"></div>
                                <div class="row mb-3">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-primary" id="addNamaInventor">Tambah Nama Inventor</button>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_invensi_paten" class="col-sm-2 col-form-label">Judul Invensi</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_invensi_paten" id="judul_invensi_paten" class="form-control" placeholder="Masukkan judul invensi">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="sertifikat_paten" class="col-sm-2 col-form-label">Link Google Drive Sertifikat Paten</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="sertifikat_paten" id="sertifikat_paten" placeholder="Masukkan link sertifikat"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Desain Industri -->
                            <div class="desain_industri d-none" id="desain_industri">
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Program Studi</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_desain" id="prodi_desain1" value="Teknik Elektro" checked>
                                            <label class="form-check-label" for="prodi_desain1">Teknik Elektro</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_desain" id="prodi_desain2" value="Teknik Industri">
                                            <label class="form-check-label" for="prodi_desain2">Teknik Industri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_desain" id="prodi_desain3" value="Teknik Biomedis">
                                            <label class="form-check-label" for="prodi_desain3">Teknik Biomedis</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div id="dynamicNamaDesainContainer"></div>
                                <div class="row mb-3">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-primary" id="addNamaDesain">Tambah Nama Pengusul</button>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_desain" class="col-sm-2 col-form-label">Judul Desain Industri</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_desain" id="judul_desain" class="form-control" placeholder="Masukkan judul desain industri">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="sertifikat_desain" class="col-sm-2 col-form-label">Link Google Drive Sertifikat Desain Industri</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="sertifikat_desain" id="sertifikat_desain" placeholder="Masukkan link sertifikat"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Editor Jurnal -->
                            <div class="editor_jurnal d-none" id="editor_jurnal">
                                <div class="row mb-3">
                                    <label for="nama_pengusul_editor" class="col-sm-2 col-form-label">Nama Pengusul</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_pengusul_editor" id="nama_pengusul_editor" class="form-control" placeholder="Masukkan nama pengusul">
                                    </div>
                                </div>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Program Studi</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_editor" id="prodi_editor1" value="Teknik Elektro" checked>
                                            <label class="form-check-label" for="prodi_editor1">Teknik Elektro</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_editor" id="prodi_editor2" value="Teknik Industri">
                                            <label class="form-check-label" for="prodi_editor2">Teknik Industri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_editor" id="prodi_editor3" value="Teknik Biomedis">
                                            <label class="form-check-label" for="prodi_editor3">Teknik Biomedis</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="row mb-3">
                                    <label for="judul_jurnal_editor" class="col-sm-2 col-form-label">Judul Jurnal</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_jurnal_editor" id="judul_jurnal_editor" class="form-control" placeholder="Masukkan judul jurnal">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="sk_editor" class="col-sm-2 col-form-label">Link Google Drive SK</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="sk_editor" id="sk_editor" placeholder="Masukkan link SK"></textarea>
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
                                    <label for="judul_artikel_reviewer" class="col-sm-2 col-form-label">Judul artikel yang telah direview</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_artikel_reviewer" id="judul_artikel_reviewer" class="form-control" placeholder="Masukkan judul artikel yang telah direview">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="judul_jurnal_reviewer" class="col-sm-2 col-form-label">Judul Jurnal</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul_jurnal_reviewer" id="judul_jurnal_reviewer" class="form-control" placeholder="Masukkan judul jurnal">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="sertifikat_reviewer" class="col-sm-2 col-form-label">Link Google Drive Sertifikat Reviewer / bukti lain yang menyatakan telah menyelesaikan proses review</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="sertifikat_reviewer" id="sertifikat_reviewer" placeholder="Masukkan link sertifikat/bukti lain"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Invited Speaker -->
                            <div class="invited_speaker d-none" id="invited_speaker">
                                <div class="row mb-3">
                                    <label for="nama_pengusul_speaker" class="col-sm-2 col-form-label">Nama Pengusul</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_pengusul_speaker" id="nama_pengusul_speaker" class="form-control" placeholder="Masukkan nama pengusul">
                                    </div>
                                </div>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Program Studi</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_speaker" id="prodi_speaker1" value="Teknik Elektro" checked>
                                            <label class="form-check-label" for="prodi_speaker1">Teknik Elektro</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_speaker" id="prodi_speaker2" value="Teknik Industri">
                                            <label class="form-check-label" for="prodi_speaker2">Teknik Industri</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prodi_speaker" id="prodi_speaker3" value="Teknik Biomedis">
                                            <label class="form-check-label" for="prodi_speaker3">Teknik Biomedis</label>
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
                                    <label for="laporan_maju_speaker" class="col-sm-2 col-form-label">Link Google Drive Undangan, sertifikat dan bukti telah menyelesaikan kegiatan (dijadikan 1 dokumen)</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="laporan_maju_speaker" id="laporan_maju_speaker" placeholder="Masukkan link google drive"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Komponen Pengurus Organisasi Profesi -->
                            <div class="pengurus_organisasi d-none" id="pengurus_organisasi">
                                <div class="row mb-3">
                                    <label for="nama_organisasi" class="col-sm-2 col-form-label">Nama Organisasi Profesi</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_organisasi" id="nama_organisasi" class="form-control" placeholder="Masukkan nama organisasi profesi">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jabatan_organisasi" class="col-sm-2 col-form-label">Jabatan</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="jabatan_organisasi" id="jabatan_organisasi" class="form-control" placeholder="Masukkan jabatan">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="masa_jabatan_organisasi" class="col-sm-2 col-form-label">Masa Jabatan</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="masa_jabatan_organisasi" id="masa_jabatan_organisasi" class="form-control" placeholder="Masukkan masa jabatan">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="dokumen_organisasi" class="col-sm-2 col-form-label">Link Google Drive SK dan Surat tugas serta bukti lain telah menyelesaikan tugas</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="dokumen_organisasi" id="dokumen_organisasi" placeholder="Masukkan link google drive"></textarea>
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
                    Pelaporan EWMP Berhasil Disimpan!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mb-4" data-bs-dismiss="modal">Tutup</button>
                    <a href="<?= base_url('ewmp') ?>" class="btn btn-primary mb-4">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Modal -->
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alertModalLabel">Peringatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if ($this->session->flashdata('error')): ?>
                        <ul>
                            <?= $this->session->flashdata('error'); ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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

    <!-- Cek apakah flash data untuk memicu modal ada -->
    <!-- <?php if ($this->session->flashdata('show_modal')): ?>
        <script>
            var myModal = new bootstrap.Modal(document.getElementById('alertModal'), {});
            myModal.show();
        </script>
    <?php endif; ?> -->
</main>

<script>
    function formatRupiah(input) {
        // Ambil nilai asli yang belum diformat
        let rawValue = input.value.replace(/[^0-9]/g, '');
        input.dataset.rawValue = rawValue; // Simpan nilai asli dalam atribut data

        // Format nilai ke dalam format rupiah
        if (rawValue) {
            let formatted = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(rawValue);
            input.value = formatted.replace('Rp ', 'Rp'); // Hapus spasi setelah "Rp"
        } else {
            input.value = '';
        }
    }

    // Saat form disubmit, hanya kirimkan angka asli
    document.querySelector('form').addEventListener('submit', function(event) {
        // Tangani kedua input
        let inputs = ['#besar_hibah_penelitian', '#besar_hibah_pengabdian'];
        inputs.forEach(function(selector) {
            let input = document.querySelector(selector);
            if (input) {
                input.value = input.dataset.rawValue;
            }
        });
    });

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
        var merkDiv = document.getElementById("merk");
        var LisensiDiv = document.getElementById("lisensi");
        var BukuDiv = document.getElementById("buku");
        var patenDiv = document.getElementById("paten");
        var desainIndustriDiv = document.getElementById("desain_industri");

        // Reset visibility for all HAKI-related divs
        hakiDiv.classList.add("d-none");
        hakCiptaDiv.classList.add("d-none");
        merkDiv.classList.add("d-none");
        LisensiDiv.classList.add("d-none");
        BukuDiv.classList.add("d-none");
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
            merkDiv.classList.add("d-none");
            LisensiDiv.classList.add("d-none");
            BukuDiv.classList.add("d-none");
            patenDiv.classList.add("d-none");
            desainIndustriDiv.classList.add("d-none");

            // Display appropriate category based on selection
            if (this.value === "Hak Cipta") {
                hakCiptaDiv.classList.remove("d-none");
            } else if (this.value === "Paten") {
                patenDiv.classList.remove("d-none");
            } else if (this.value === "Desain Industri") {
                desainIndustriDiv.classList.remove("d-none");
            } else if (this.value === "Lisensi") {
                LisensiDiv.classList.remove("d-none");
            } else if (this.value === "Merk") {
                merkDiv.classList.remove("d-none");
            } else if (this.value === "Buku") { // Added Buku condition
                BukuDiv.classList.remove("d-none");
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

    document.getElementById('addAnggotaPenelitian').addEventListener('click', function() {
        const container = document.getElementById('dynamicAnggotaPenelitianContainer');

        // Hitung jumlah anggota yang ada
        const anggotaCount = container.childElementCount + 1;

        // Buat elemen div baru untuk satu set anggota
        const newGroup = document.createElement('div');
        newGroup.className = 'row mb-3';
        newGroup.innerHTML = `
            <label class="col-sm-2 col-form-label">Program Studi Anggota ${anggotaCount}</label>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="prodi_anggota_penelitian_${anggotaCount}" value="Teknik Elektro">
                    <label class="form-check-label">Teknik Elektro</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="prodi_anggota_penelitian_${anggotaCount}" value="Teknik Industri">
                    <label class="form-check-label">Teknik Industri</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="prodi_anggota_penelitian_${anggotaCount}" value="Teknik Biomedis">
                    <label class="form-check-label">Teknik Biomedis</label>
                </div>
            </div>
            <label class="col-sm-2 col-form-label mt-3">Nama Anggota ${anggotaCount}</label>
            <div class="col-sm-10 mt-3">
                <input type="text" name="nama_anggota_penelitian[]" class="form-control" placeholder="Masukkan nama anggota ${anggotaCount}">
            </div>
        `;

        // Tambahkan elemen baru ke dalam kontainer
        container.appendChild(newGroup);
    });



    document.getElementById('addMahasiswaPenelitian').addEventListener('click', function() {
        const container = document.getElementById('dynamicMahasiswaPenelitianContainer');

        // Hitung jumlah mahasiswa yang ada
        const mahasiswaCount = container.childElementCount + 1;

        // Buat elemen div baru untuk satu set mahasiswa
        const newGroup = document.createElement('div');
        newGroup.className = 'row mb-3';
        newGroup.innerHTML = `
            <label for="nim_mahasiswa_penelitian" class="col-sm-2 col-form-label">NIM Mahasiswa yang Terlibat ${mahasiswaCount}</label>
            <div class="col-sm-10 mt-3">
                <input type="text" name="nim_mahasiswa_penelitian[]" class="form-control" placeholder="Masukkan NIM mahasiswa ${mahasiswaCount}">
            </div>
            <label for="nama_mahasiswa_penelitian" class="col-sm-2 col-form-label">Nama Mahasiswa yang Terlibat ${mahasiswaCount}</label>
            <div class="col-sm-10 mt-3">
                <input type="text" name="nama_mahasiswa_penelitian[]" class="form-control" placeholder="Masukkan nama mahasiswa ${mahasiswaCount}">
            </div>
        `;

        // Tambahkan elemen baru ke dalam kontainer
        container.appendChild(newGroup);
    });

    document.getElementById('addAnggotaPengabdian').addEventListener('click', function() {
        const container = document.getElementById('dynamicAnggotaPengabdianContainer');

        // Hitung jumlah anggota yang ada
        const anggotaCount = container.childElementCount + 1;

        // Buat elemen div baru untuk satu set anggota
        const newGroup = document.createElement('div');
        newGroup.className = 'row mb-3';
        newGroup.innerHTML = `
            <label class="col-sm-2 col-form-label">Program Studi Anggota ${anggotaCount}</label>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="prodi_anggota_pengabdian_${anggotaCount}" value="Teknik Elektro">
                    <label class="form-check-label">Teknik Elektro</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="prodi_anggota_pengabdian_${anggotaCount}" value="Teknik Industri">
                    <label class="form-check-label">Teknik Industri</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="prodi_anggota_pengabdian_${anggotaCount}" value="Teknik Biomedis">
                    <label class="form-check-label">Teknik Biomedis</label>
                </div>
            </div>
            <label class="col-sm-2 col-form-label mt-3">Nama Anggota ${anggotaCount}</label>
            <div class="col-sm-10 mt-3">
                <input type="text" name="nama_anggota_pengabdian[]" class="form-control" placeholder="Masukkan nama anggota ${anggotaCount}">
            </div>
        `;

        // Tambahkan elemen baru ke dalam kontainer
        container.appendChild(newGroup);
    });

    document.getElementById('addMahasiswaPengabdian').addEventListener('click', function() {
        const container = document.getElementById('dynamicMahasiswaPengabdianContainer');

        // Hitung jumlah mahasiswa yang ada
        const mahasiswaCount = container.childElementCount + 1;

        // Buat elemen div baru untuk satu set mahasiswa
        const newGroup = document.createElement('div');
        newGroup.className = 'row mb-3';
        newGroup.innerHTML = `
            <label for="nim_mahasiswa_pengabdian" class="col-sm-2 col-form-label">NIM Mahasiswa yang Terlibat ${mahasiswaCount}</label>
            <div class="col-sm-10 mt-3">
                <input type="text" name="nim_mahasiswa_pengabdian[]" class="form-control" placeholder="Masukkan NIM mahasiswa ${mahasiswaCount}">
            </div>
            <label for="nama_mahasiswa_pengabdian" class="col-sm-2 col-form-label">Nama Mahasiswa yang Terlibat ${mahasiswaCount}</label>
            <div class="col-sm-10 mt-3">
                <input type="text" name="nama_mahasiswa_pengabdian[]" class="form-control" placeholder="Masukkan nama mahasiswa ${mahasiswaCount}">
            </div>
        `;

        // Tambahkan elemen baru ke dalam kontainer
        container.appendChild(newGroup);
    });

    document.getElementById('addAnggotaIlmiah').addEventListener('click', function() {
        const container = document.getElementById('dynamicAnggotaIlmiahContainer');

        // Hitung jumlah anggota yang ada
        const anggotaCount = container.childElementCount + 1;

        // Buat elemen div baru untuk satu set anggota
        const newGroup = document.createElement('div');
        newGroup.className = 'row mb-3';
        newGroup.innerHTML = `
            <label class="col-sm-2 col-form-label">Program Studi Anggota ${anggotaCount}</label>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="prodi_anggota_ilmiah_${anggotaCount}" value="Teknik Elektro">
                    <label class="form-check-label">Teknik Elektro</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="prodi_anggota_ilmiah_${anggotaCount}" value="Teknik Industri">
                    <label class="form-check-label">Teknik Industri</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="prodi_anggota_ilmiah_${anggotaCount}" value="Teknik Biomedis">
                    <label class="form-check-label">Teknik Biomedis</label>
                </div>
            </div>
            <label class="col-sm-2 col-form-label mt-3">Nama Anggota ${anggotaCount}</label>
            <div class="col-sm-10 mt-3">
                <input type="text" name="nama_anggota_ilmiah[]" class="form-control" placeholder="Masukkan nama anggota ${anggotaCount}">
            </div>
        `;

        // Tambahkan elemen baru ke dalam kontainer
        container.appendChild(newGroup);
    });

    document.getElementById('addAnggotaProsiding').addEventListener('click', function() {
        const container = document.getElementById('dynamicAnggotaProsidingContainer');

        // Hitung jumlah anggota yang ada
        const anggotaCount = container.childElementCount + 1;

        // Buat elemen div baru untuk satu set anggota
        const newGroup = document.createElement('div');
        newGroup.className = 'row mb-3';
        newGroup.innerHTML = `
            <label class="col-sm-2 col-form-label">Program Studi Anggota ${anggotaCount}</label>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="prodi_anggota_prosiding_${anggotaCount}" value="Teknik Elektro">
                    <label class="form-check-label">Teknik Elektro</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="prodi_anggota_prosiding_${anggotaCount}" value="Teknik Industri">
                    <label class="form-check-label">Teknik Industri</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="prodi_anggota_prosiding_${anggotaCount}" value="Teknik Biomedis">
                    <label class="form-check-label">Teknik Biomedis</label>
                </div>
            </div>
            <label class="col-sm-2 col-form-label mt-3">Nama Anggota ${anggotaCount}</label>
            <div class="col-sm-10 mt-3">
                <input type="text" name="nama_anggota_prosiding[]" class="form-control" placeholder="Masukkan nama anggota ${anggotaCount}">
            </div>
        `;

        // Tambahkan elemen baru ke dalam kontainer
        container.appendChild(newGroup);
    });

    document.getElementById('addNamaHakCipta').addEventListener('click', function() {
        const container = document.getElementById('dynamicNamaHakCiptaContainer');

        // Hitung jumlah anggota yang ada
        const anggotaCount = container.childElementCount + 1;

        // Buat elemen div baru untuk satu set anggota
        const newGroup = document.createElement('div');
        newGroup.className = 'row';
        newGroup.innerHTML = `
            <label class="col-sm-2 col-form-label">Nama Pemegang Hak Cipta ${anggotaCount}</label>
            <div class="col-sm-10">
                <input type="text" name="nama_hcipta[]" class="form-control" placeholder="Masukkan Nama Pemegang Hak Cipta ${anggotaCount}">
            </div>
        `;

        // Tambahkan elemen baru ke dalam kontainer
        container.appendChild(newGroup);
    });

    document.getElementById('addNamaLisensi').addEventListener('click', function() {
        const container = document.getElementById('dynamicNamaLisensiContainer');

        // Hitung jumlah anggota yang ada
        const anggotaCount = container.childElementCount + 1;

        // Buat elemen div baru untuk satu set anggota
        const newGroup = document.createElement('div');
        newGroup.className = 'row';
        newGroup.innerHTML = `
            <label class="col-sm-2 col-form-label">Nama Pemegang Lisensi ${anggotaCount}</label>
            <div class="col-sm-10">
                <input type="text" name="nama_lisensi[]" class="form-control" placeholder="Masukkan Nama Pemegang Lisensi ${anggotaCount}">
            </div>
        `;

        // Tambahkan elemen baru ke dalam kontainer
        container.appendChild(newGroup);
    });

    document.getElementById('addNamaMerk').addEventListener('click', function() {
        const container = document.getElementById('dynamicNamaMerkContainer');

        // Hitung jumlah anggota yang ada
        const anggotaCount = container.childElementCount + 1;

        // Buat elemen div baru untuk satu set anggota
        const newGroup = document.createElement('div');
        newGroup.className = 'row';
        newGroup.innerHTML = `
            <label class="col-sm-2 col-form-label">Nama Pemegang Merk ${anggotaCount}</label>
            <div class="col-sm-10">
                <input type="text" name="nama_merk[]" class="form-control" placeholder="Masukkan Nama Pemegang Merk ${anggotaCount}">
            </div>
        `;

        // Tambahkan elemen baru ke dalam kontainer
        container.appendChild(newGroup);
    });

    document.getElementById('addNamaInventor').addEventListener('click', function() {
        const container = document.getElementById('dynamicNamaInventorContainer');

        // Hitung jumlah anggota yang ada
        const anggotaCount = container.childElementCount + 1;

        // Buat elemen div baru untuk satu set anggota
        const newGroup = document.createElement('div');
        newGroup.className = 'row mb-3';
        newGroup.innerHTML = `
            <label class="col-sm-2 col-form-label">Nama Inventor ${anggotaCount}</label>
            <div class="col-sm-10">
                <input type="text" name="nama_inventor[]" class="form-control" placeholder="Masukkan nama inventor ${anggotaCount}">
            </div>
        `;

        // Tambahkan elemen baru ke dalam kontainer
        container.appendChild(newGroup);
    });

    document.getElementById('addNamaDesain').addEventListener('click', function() {
        const container = document.getElementById('dynamicNamaDesainContainer');

        // Hitung jumlah anggota yang ada
        const anggotaCount = container.childElementCount + 1;

        // Buat elemen div baru untuk satu set anggota
        const newGroup = document.createElement('div');
        newGroup.className = 'row mb-3';
        newGroup.innerHTML = `
            <label class="col-sm-2 col-form-label">Nama Pengusul ${anggotaCount}</label>
            <div class="col-sm-10">
                <input type="text" name="nama_pengusul_desain[]" class="form-control" placeholder="Masukkan nama pengusul ${anggotaCount}">
            </div>
        `;

        // Tambahkan elemen baru ke dalam kontainer
        container.appendChild(newGroup);
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Get main form elements
        const form = document.querySelector('form');
        const jenisLapor = document.getElementById('jenis_lapor');
        const kategoriIlmiah = document.getElementById('kategori_ilmiah');
        const kategoriHaki = document.getElementById('kategori_haki');

        // Function to add required attributes and validation messages
        function addRequiredFields(fields) {
            fields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) {
                    field.setAttribute('required', '');
                    field.addEventListener('input', function() {
                        validateField(this);
                    });
                    field.addEventListener('blur', function() {
                        validateField(this);
                    });
                }
            });
        }

        // Function to validate individual field
        function validateField(field) {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                if (!field.nextElementSibling?.classList.contains('invalid-feedback')) {
                    const feedback = document.createElement('div');
                    feedback.className = 'invalid-feedback';
                    feedback.textContent = 'Field ini wajib diisi';
                    field.parentNode.appendChild(feedback);
                }
                return false;
            } else {
                field.classList.remove('is-invalid');
                const feedback = field.nextElementSibling;
                if (feedback?.classList.contains('invalid-feedback')) {
                    feedback.remove();
                }
                return true;
            }
        }

        // Function to clear validation states
        function clearValidationStates() {
            document.querySelectorAll('[required]').forEach(el => {
                el.removeAttribute('required');
            });
            document.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
            document.querySelectorAll('.invalid-feedback').forEach(el => {
                el.remove();
            });
        }

        // Handle jenis_lapor change
        jenisLapor.addEventListener('change', function() {
            clearValidationStates();

            // Add required attributes based on selected type
            switch(this.value) {
                case 'Penelitian':
                    addRequiredFields([
                        'nama_ketua_penelitian',
                        'judul_penelitian',
                        'skim_penelitian',
                        'pemberi_hibah_penelitian',
                        'besar_hibah_penelitian',
                        'kontrak_penelitian',
                        'laporan_maju_penelitian'
                    ]);
                    break;
                case 'Pengabdian':
                    addRequiredFields([
                        'nama_ketua_pengabdian',
                        'judul_pengabdian',
                        'skim_pengabdian',
                        'pemberi_hibah_pengabdian',
                        'besar_hibah_pengabdian',
                        'kontrak_pengabdian',
                        'laporan_pengabdian'
                    ]);
                    break;
                case 'Artikel/Karya Ilmiah':
                    // First add required to kategori_ilmiah
                    addRequiredFields(['kategori_ilmiah']);
                    // The rest will be handled by kategori_ilmiah change event
                    break;
                case 'Prosiding':
                    addRequiredFields([
                        'nama_pertama_prosiding',
                        'nama_korespon_prosiding',
                        'judul_artikel_prosiding',
                        'judul_seminar_prosiding',
                        'bukti_loa_prosiding',
                        'doi_prosiding'
                    ]);
                    break;
                case 'HAKI':
                    // First add required to kategori_haki
                    addRequiredFields(['kategori_haki']);
                    // The rest will be handled by kategori_haki change event
                    break;
                case 'Editor Jurnal':
                    addRequiredFields([
                        'nama_pengusul_editor',
                        'judul_jurnal_editor',
                        'sk_editor'
                    ]);
                    break;
                case 'Reviewer Jurnal':
                    addRequiredFields([
                        'nama_pengusul_reviewer',
                        'judul_artikel_reviewer',
                        'judul_jurnal_reviewer',
                        'sertifikat_reviewer'
                    ]);
                    break;
                case 'Invited Speaker':
                    addRequiredFields([
                        'nama_pengusul_speaker',
                        'judul_kegiatan',
                        'penyelenggara',
                        'laporan_maju_speaker'
                    ]);
                    break;
                case 'Pengurus Organisasi Profesi':
                    addRequiredFields([
                        'nama_organisasi',
                        'jabatan_organisasi',
                        'masa_jabatan_organisasi',
                        'dokumen_organisasi'
                    ]);
                    break;
            }
        });

        // Handle kategori_ilmiah change
        kategoriIlmiah.addEventListener('change', function() {
            clearValidationStates();
            
            // Base fields required for all article types
            const baseFields = [
                'nama_pertama_ilmiah',
                'nama_korespon_ilmiah',
                'judul_artikel_ilmiah',
                'judul_jurnal_ilmiah',
                'link_jurnal_ilmiah',
                'volume_jurnal_ilmiah',
                'nomor_jurnal_ilmiah',
                'doi_ilmiah'
            ];

            // Array of international categories
            const internasionalValues = [
                "Internasional Q1", "Internasional Q2", "Internasional Q3",
                "Internasional Q4", "Internasional Non Scopus"
            ];

            // Add required to base fields
            addRequiredFields(baseFields);

            // Show/hide and set required for pengindeks field
            const pengindeksDiv = document.getElementById('pengindeks');
            if (internasionalValues.includes(this.value)) {
                pengindeksDiv.classList.remove('d-none');
                addRequiredFields(['pengindeks_ilmiah']);
            } else {
                pengindeksDiv.classList.add('d-none');
                const pengindeksInput = document.getElementById('pengindeks_ilmiah');
                if (pengindeksInput) {
                    pengindeksInput.value = '';
                    pengindeksInput.removeAttribute('required');
                }
            }
        });

        // Handle kategori_haki change
        kategoriHaki.addEventListener('change', function() {
            clearValidationStates();

            switch(this.value) {
                case 'Hak Cipta':
                    addRequiredFields([
                        'nama_pengusul_hcipta',
                        'judul_hcipta',
                        'sertifikat_hcipta'
                    ]);
                    break;
                case 'Merk':
                    addRequiredFields([
                        'nama_pengusul_merk',
                        'judul_merk',
                        'sertifikat_merk'
                    ]);
                    break;
                case 'Lisensi':
                    addRequiredFields([
                        'nama_pengusul_lisensi',
                        'judul_lisensi',
                        'sertifikat_lisensi'
                    ]);
                    break;
                case 'Buku':
                    addRequiredFields([
                        'nama_pengusul_buku',
                        'isbn_buku',
                        'judul_buku',
                        'file_buku'
                    ]);
                    break;
                case 'Paten':
                    addRequiredFields([
                        'judul_invensi_paten',
                        'sertifikat_paten'
                    ]);
                    break;
                case 'Desain Industri':
                    addRequiredFields([
                        'judul_desain',
                        'sertifikat_desain'
                    ]);
                    break;
            }
        });

        // Add form submit handler
        form.addEventListener('submit', function(event) {
            let isValid = true;

            // Basic fields validation
            const basicFields = ['email', 'tahun', 'jenis_lapor'];
            basicFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field && !validateField(field)) {
                    isValid = false;
                }
            });

            // Validate visible section fields
            const jenisLaporValue = jenisLapor.value;
            let visibleSection;

            switch(jenisLaporValue) {
                case 'Penelitian':
                    visibleSection = document.getElementById('penelitian');
                    break;
                case 'Pengabdian':
                    visibleSection = document.getElementById('pengabdian');
                    break;
                case 'Artikel/Karya Ilmiah':
                    visibleSection = document.getElementById('ilmiah');
                    break;
                case 'Prosiding':
                    visibleSection = document.getElementById('prosiding');
                    break;
                case 'HAKI':
                    const hakiType = kategoriHaki.value;
                    visibleSection = document.getElementById(hakiType.toLowerCase().replace(/ /g, '_'));
                    break;
                case 'Editor Jurnal':
                    visibleSection = document.getElementById('editor_jurnal');
                    break;
                case 'Reviewer Jurnal':
                    visibleSection = document.getElementById('reviewer_jurnal');
                    break;
                case 'Invited Speaker':
                    visibleSection = document.getElementById('invited_speaker');
                    break;
                case 'Pengurus Organisasi Profesi':
                    visibleSection = document.getElementById('pengurus_organisasi');
                    break;
            }

            if (visibleSection) {
                const requiredFields = visibleSection.querySelectorAll('[required]');
                requiredFields.forEach(field => {
                    if (!validateField(field)) {
                        isValid = false;
                    }
                });
            }

            if (!isValid) {
                event.preventDefault();
                // Focus on the first invalid field
                const firstInvalid = document.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.focus();
                }
            }
        });

        // Initialize validation for initial form state if needed
        if (jenisLapor.value) {
            jenisLapor.dispatchEvent(new Event('change'));
        }
    });
</script>