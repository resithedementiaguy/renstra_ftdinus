<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Renstra</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h5 class="pt-2"><strong>Pencapaian Fakultas Teknik</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            Silahkan untuk mengisi Rencana Strategis Fakultas Teknik UDINUS Semarang
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('renstra/generate_pdf') ?>" type="button" target="_blank" class="btn btn-danger mb-4">Cetak PDF</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th style="text-align: start; width: 50px;">No</th>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align: start;">1</td>
                                        <td>Total Publikasi Internasional</td>
                                        <td><a href="<?= base_url('ewmp/publikasi_internasional') ?>" type="button" class="btn btn-success">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: start;">2</td>
                                        <td>Total Publikasi Nasional</td>
                                        <td><a href="<?= base_url('ewmp/generate_pdf') ?>" type="button" class="btn btn-success">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: start;">3</td>
                                        <td>Total Hibah Penelitian</td>
                                        <td><a href="<?= base_url('ewmp/generate_pdf') ?>" type="button" class="btn btn-success">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: start;">4</td>
                                        <td>Total Hibah Pengabdian</td>
                                        <td><a href="<?= base_url('ewmp/generate_pdf') ?>" type="button" class="btn btn-success">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: start;">5</td>
                                        <td>List Kesesuaian Publikasi per Program Studi</td>
                                        <td><a href="<?= base_url('ewmp/generate_pdf') ?>" type="button" class="btn btn-success">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: start;">6</td>
                                        <td>List Kesesuaian Penelitian per Program Studi</td>
                                        <td><a href="<?= base_url('ewmp/generate_pdf') ?>" type="button" class="btn btn-success">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: start;">7</td>
                                        <td>List Kesesuaian Pengabdian per Program Studi</td>
                                        <td><a href="<?= base_url('ewmp/generate_pdf') ?>" type="button" class="btn btn-success">Detail</a></td>
                                    </tr>
                                </tbody>
                            </table>
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