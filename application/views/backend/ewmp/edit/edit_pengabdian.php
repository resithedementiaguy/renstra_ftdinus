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
                            <div class="mb-3">
                                <label for="nama_ketua" class="form-label">Nama Ketua</label>
                                <input type="text" class="form-control" id="nama_ketua" name="nama_ketua" value="<?= htmlspecialchars($pengabdian['nama_ketua']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="prodi" class="form-label">Program Studi Ketua</label>
                                <input type="text" class="form-control" id="prodi" name="prodi" value="<?= htmlspecialchars($pengabdian['prodi']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori Pengabdian</label>
                                <select class="form-select" id="kategori" name="kategori" required>
                                    <option value="A" <?= $pengabdian['kategori'] == 'A' ? 'selected' : '' ?>>Kategori A</option>
                                    <option value="B" <?= $pengabdian['kategori'] == 'B' ? 'selected' : '' ?>>Kategori B</option>
                                    <option value="C" <?= $pengabdian['kategori'] == 'C' ? 'selected' : '' ?>>Kategori C</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Pengabdian</label>
                                <textarea class="form-control" id="judul" name="judul" rows="3" required><?= htmlspecialchars($pengabdian['judul']) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="skim" class="form-label">Skim Pengabdian</label>
                                <input type="text" class="form-control" id="skim" name="skim" value="<?= htmlspecialchars($pengabdian['skim']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="pemberi_hibah" class="form-label">Pemberi Hibah</label>
                                <input type="text" class="form-control" id="pemberi_hibah" name="pemberi_hibah" value="<?= htmlspecialchars($pengabdian['pemberi_hibah']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="besar_hibah" class="form-label">Besar Hibah</label>
                                <input type="number" class="form-control" id="besar_hibah" name="besar_hibah" value="<?= $pengabdian['besar_hibah'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="kontrak" class="form-label">File Kontrak Pengabdian (Link GDrive)</label>
                                <input type="url" class="form-control" id="kontrak" name="kontrak" value="<?= $pengabdian['kontrak'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="laporan" class="form-label">File Laporan Maju (Link GDrive)</label>
                                <input type="url" class="form-control" id="laporan" name="laporan" value="<?= $pengabdian['laporan'] ?>">
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