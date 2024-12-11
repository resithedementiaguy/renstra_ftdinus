<style>
    div.dt-container select.dt-input {
        margin-right: 8px;
    }
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active">Data Dosen</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h5 class="pt-2"><strong>Data Dosen per Tahun</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            Silahkan untuk mengecek atau menambah Data Dosen Fakultas Teknik UDINUS Semarang
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="<?= base_url('dosen/create_view') ?>" type="button" class="btn btn-primary mb-4">Tambah Data Dosen</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-start align-middle" style="width: 200px;">No</th>
                                        <th class="text-start align-middle" style="width: 200px;">Tahun</th>
                                        <th class="text-start align-middle" style="width: 200px;">Prodi</th>
                                        <th class="text-start align-middle" style="width: 200px;">Jumlah Dosen</th>
                                        <th class="text-start align-middle" style="width: 200px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($dosen as $dsn): ?>
                                        <tr>
                                            <td class="align-middle text-start"><?= $no++ ?></td>
                                            <td class="align-middle text-start"><?= htmlspecialchars($dsn->tahun) ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($dsn->prodi) ?></td>
                                            <td class="align-middle text-start"><?= htmlspecialchars($dsn->jumlah) ?></td>
                                            <td class="align-middle">
                                                <a href="<?= site_url('dosen/detail/' . htmlspecialchars($dsn->id)) ?>" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-journal-text"></i> Edit
                                                </a>
                                                <a class="btn btn-sm btn-danger" href="<?= site_url('dosen/delete/' . $dsn->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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