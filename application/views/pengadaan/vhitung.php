<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!--<h4 class="header-title"> <?= $data->id_obat == 0 ? 'Tambah' : 'Ubah' ?> Data Obat</h4>-->
                        <?php foreach ($pengadaan as $pengadaan) {?>
                          <form method="POST" action="<?php echo base_url('pengadaanobat/update_hitung') ?>" >
                            <input type="hidden"  name="id_pengadaan" value="<?= $pengadaan->id_pengadaan ?>">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-md-2 col-form-label" style="color: black">Jumlah Peramalan</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="jumlah_peramalan"  value="<?= $pengadaan->jumlah_peramalan ?>" id="jumlah_peramalan" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-md-2 col-form-label" style="color: black">Sisa Stok Akhir</label>
                                <div class="col-md-10">
                                     <!--<input class="form-control" type="text" name="kode_obat" value="test" >-->
                                    <input class="form-control" type="text" name="jumlah_stok_akhir" value="" id="nilai_stok_akhir">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-md-2 col-form-label" ></label>
                                <div class="col-md-10">
                                    <button type="" class="btn btn-primary waves-effect waves-light" id="hitung">Hitung </button>                                                                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-md-2 col-form-label" style="color: black">Hasil Pengadaan</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="jumlah_pengajuan"  value="" id="hasil_pengadaan">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan </button>
                            </div>
                        </form>  
                     <?php   }?>                        
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
    </div>
</div>