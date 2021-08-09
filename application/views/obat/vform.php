<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"> <?= $data->id_obat == 0 ? 'Tambah' : 'Ubah' ?> Data Obat</h4>
                        <form method="POST" action="<?= base_url('obat/form') ?>">
                            <div class="form-group row">
                                <label for="example-search-input" class="col-md-2 col-form-label">Kode Obat</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="kode_obat" value="<?= $data->kode_obat ?>" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-search-input" class="col-md-2 col-form-label">Nama Obat</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="nama_obat" value="<?= $data->nama_obat ?>" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-email-input" class="col-md-2 col-form-label">Satuan</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="satuan" value="<?= $data->satuan ?>" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-number-input" class="col-md-2 col-form-label">Harga Beli</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="harga_beli" value="<?= $data->harga_beli ?>" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-tel-input" class="col-md-2 col-form-label">Harga Jual</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="harga_jual" value="<?= $data->harga_jual ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-url-input" class="col-md-2 col-form-label">Kandungan</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="kandungan" value="<?= $data->kandungan ?>" >
                                </div>
                            </div>       
                            <input type="text" hidden id="id_obat" name="id_obat" value="<?php echo $data->id_obat; ?>">
                            <input type="text" hidden id="submitObat" name="submitObat" value="submitObat">
                            <?php
                            if ($data->id_obat == 0) {
                                ?> 
                                <div class="text-right">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Tambah Data</button>
                                </div>
                            <?php
                            } else {
                                ?>  <div class="text-right">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Perbarui Data</button>
                                </div>
                            <?php }
                            ?>
<!--                            <div class="text-right">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">Tambah Data</button>
                            </div>-->
                        </form>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
    </div>
</div>