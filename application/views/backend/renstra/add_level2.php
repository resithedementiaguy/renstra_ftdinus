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
                        <h5>Tambah IKU Level 2</h5>
                    </div>
                    <div class="card-body">
                    <form method="post" action="<?= base_url('renstra/add_level2')?>">
                        <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Pilih Butir</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="id_level1" id="id_level1" aria-label="Default select example">
                                <?php foreach($iku_level1 as $level1): ?>
                                    <option value="<?= $level1->id?>"><?= $level1->no_iku?> <?= $level1->isi_iku?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        </div>
                        <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Nomor Butir</label>
                        <div class="col-sm-10">
                            <input type="text" name="no_iku" id="no_iku" class="form-control" placeholder="masukkan nomor butir (e.g 1.1., 1.2., 1.3., dll)" required>
                        </div>
                        </div>
                        <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Butir</label>
                        <div class="col-sm-10">
                            <input type="text" name="isi_iku2" id="isi_iku2" class="form-control" placeholder="masukkan isi butir" required>
                        </div>
                        </div>                  
                    </div>
                    <div class="card-footer">
                        <a href="<?= base_url('renstra/create_view1')?>" type="button" class="btn btn-primary mb-4">Ke Level 1</a>
                        <a href="<?= base_url('renstra/create_view3')?>" type="button" class="btn btn-primary mb-4">Ke Level 3</a>
                        <a href="<?= base_url('renstra')?>" type="button" class="btn btn-secondary mb-4">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form><!-- End General Form Elements -->
                </div>
            </div>
        </div>
    </section>