<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"> Tambah Transaksi</h4>
                        <form method="POST" action="<?= base_url('transaksi/form') ?>">
                            <div class="form-group row">
                                <label for="example-search-input" class="col-md-2 col-form-label">Tanggal</label>
                                <div class="col-md-10">
                                    <?php
                                    if ($transaksi->tanggal == !0) {
                                        ?>
                                        <input class="form-control" type="text" name="tanggal" value="<?= $transaksi->tanggal ?>" id="example-date-input">
                                        <?php
                                    } else {
                                        ?>
                                        <input class="form-control" type="datetime-local" name="tanggal" id="example-date-input">
                                    <?php }
                                    ?>

                                </div> </div>
                            <div class="form-group row">
                                <label for="example-number-input" class="col-md-2 col-form-label">Jumlah</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="jumlah" value="<?= $transaksi->jumlah ?>" >
                                </div>
                            </div>     
                            <div class="form-group row">
                                <label for="example-number-input" class="col-md-2 col-form-label">Id Obat</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="id_obat" value="<?= $transaksi->id_obat ?>" >
                                </div>
                            </div>     
                            <input type="text" hidden id="id_rekap" name="id_rekap" value"">
                            <input type="text" hidden id="submitObat" name="submitTransaksi" value="submitTransaksi">
                            <?php
                            if ($transaksi->id_rekap == 0) {
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
                        </form>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
    </div>
</div>