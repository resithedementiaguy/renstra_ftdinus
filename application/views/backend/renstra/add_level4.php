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
                        <h5>Tambah IKU Level 4</h5>
                    </div>
                    <div class="card-body">
                    <form method="post" action="<?= base_url('renstra/add_level4')?>">
                        <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Pilih Butir 1</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="id_level1" id="id_level1" aria-label="Default select example">
                                <?php foreach($iku_level1 as $level1): ?>
                                    <option value="<?= $level1->id?>"><?= $level1->no_iku?> <?= $level1->isi_iku?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        </div>
                        <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Pilih Butir 2</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="id_level2" id="id_level2" aria-label="Default select example">
                                <?php foreach($iku_level2 as $level2): ?>
                                    <option value="<?= $level2->id?>"><?= $level2->no_iku?> <?= $level2->isi_iku?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        </div>
                        <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Pilih IKU</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="id_level3" id="id_level3" aria-label="Default select example">
                                <?php foreach($iku_level3 as $level3): ?>
                                    <option value="<?= $level3->id?>"><?= $level3->no_iku?> <?= $level3->isi_iku?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        </div>
                        <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Nomor IKU</label>
                        <div class="col-sm-10">
                            <input type="text" name="no_iku" id="no_iku" class="form-control" placeholder="masukkan nomor IKU (e.g 1.1.1.a., 1.1.1.b., 1.1.2.a., 1.1.2.b. dst)" required>
                        </div>
                        </div>
                        <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Indikator Kinerja Utama</label>
                        <div class="col-sm-10">
                            <input type="text" name="isi_iku4" id="isi_iku4" class="form-control" placeholder="masukkan isi IKU" required>
                        </div>
                        </div>            
                    </div>
                    <div class="card-footer">
                        <a href="<?= base_url('renstra/create_view3')?>" type="button" class="btn btn-primary mb-4">Ke Level 3</a>
                        <a href="<?= base_url('renstra/create_view1')?>" type="button" class="btn btn-primary mb-4">Ke Level 1</a>
                        <a href="<?= base_url('renstra')?>" type="button" class="btn btn-secondary mb-4">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form><!-- End General Form Elements -->
                </div>
            </div>
        </div>
    </section>