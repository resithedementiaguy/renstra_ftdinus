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
                <li class="breadcrumb-item active">Tahun</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h5 class="pt-2"><strong>Tahun Akademik</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            Silahkan untuk mengecek atau menambah Tahun Fakultas Teknik UDINUS Semarang
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahTahunModal">
                                Tambah Tahun
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-start align-middle" style="width: 50px;">No.</th>
                                        <th class="text-start align-middle" style="width: 50px;">Tahun</th>
                                        <th class="text-start align-middle" style="width: 200px;">Waktu Input</th>
                                        <th class="text-start align-middle" style="width: 100px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($tahun as $thn): ?>
                                        <tr>
                                            <td class="align-middle text-start"><?= $no++ ?></td>
                                            <td class="align-middle text-start"><?= htmlspecialchars($thn->tahun) ?></td>
                                            <td class="align-middle"><?= formatDateTime($thn->ins_time) ?></td>
                                            <td class="align-middle">
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusTahunModal"
                                                    data-id="<?= $thn->id ?>" data-tahun="<?= $thn->tahun ?>">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
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

<!-- Modal Tambah Tahun -->
<div class="modal fade" id="tambahTahunModal" tabindex="-1" aria-labelledby="tambahTahunModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white d-flex align-items-center">
                <h5 class="modal-title" id="tambahTahunModalLabel">Tambah Tahun Akademik</h5>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="<?= base_url('tahun/add') ?>">
                <div class="modal-body">
                    <div class="alert alert-success">
                        *Silahkan isi form tahun akademik di bawah
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="number" name="tahun" id="tahun" class="form-control" placeholder="Masukkan tahun akademik (e.g., 2024, 2025)" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="hapusTahunModal" tabindex="-1" aria-labelledby="hapusTahunModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white d-flex align-items-center">
                <h5 class="modal-title" id="hapusTahunModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data tahun <strong id="tahunHapus"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="#" id="hapusTahunLink" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Berhasil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Data Tahun Akademik Berhasil Disimpan!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="<?= base_url('tahun') ?>" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</div>

<?php if ($this->session->flashdata('success')): ?>
    <script>
        window.onload = function() {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        };
    </script>
<?php endif; ?>

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

<script>
    new DataTable('#datatable');

    document.addEventListener('DOMContentLoaded', function() {
        var hapusModal = document.getElementById('hapusTahunModal');
        hapusModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var idTahun = button.getAttribute('data-id');
            var tahun = button.getAttribute('data-tahun');

            var tahunHapus = hapusModal.querySelector('#tahunHapus');
            tahunHapus.textContent = tahun;

            var hapusLink = hapusModal.querySelector('#hapusTahunLink');
            hapusLink.href = '<?= site_url('tahun/delete/') ?>' + idTahun;
        });
    });
</script>

<?php
// Format Tanggal dan Waktu
function formatDateTime($datetime)
{
    if (empty($datetime)) {
        return "-";
    }

    $date = new DateTime($datetime);
    $months = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];
    $day = $date->format('d');
    $month = $months[(int)$date->format('m')];
    $year = $date->format('Y');
    $time = $date->format('H:i:s');

    return "{$day} {$month} {$year}, {$time} WIB";
}
?>