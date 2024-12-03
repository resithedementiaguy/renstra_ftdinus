<style>
    div.dt-container select.dt-input {
        margin-right: 8px;
    }
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Mahasiswa</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h5 class="pt-2"><strong>Data Mahasiswa per Tahun</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            Silahkan untuk mengecek atau menambah Data Mahasiswa Fakultas Teknik UDINUS Semarang
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="<?= base_url('mahasiswa/create_view') ?>" type="button" class="btn btn-primary mb-4">Tambah Data Mahasiswa</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-start align-middle" style="width: 50px;">No.</th>
                                        <th class="text-start align-middle" style="width: 50px;">Tahun</th>
                                        <th class="text-start align-middle" style="width: 200px;">Prodi</th>
                                        <th class="text-start align-middle" style="width: 200px;">Jumlah</th>
                                        <th class="text-start align-middle" style="width: 200px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($mahasiswa as $mhs): ?>
                                        <tr>
                                            <td class="align-middle text-start"><?= $no++ ?></td>
                                            <td class="align-middle text-start"><?= htmlspecialchars($mhs->tahun) ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($mhs->prodi) ?></td>
                                            <td class="align-middle text-start"><?= htmlspecialchars($mhs->jumlah) ?></td>
                                            <td class="align-middle">
                                                <a href="<?= site_url('mahasiswa/detail/' . htmlspecialchars($mhs->id)) ?>" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-journal-text"></i> Edit
                                                </a>
                                                <a class="btn btn-sm btn-danger" href="<?= site_url('mahasiswa/delete/' . $mhs->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

<script>
    new DataTable('#datatable');
</script>