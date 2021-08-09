<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Pilih Nama Obat</label>                            
                                <div class="col-md-10">
                                    <select class="form-control" name="id_obat">                                        
                                        <option>Select</option>
                                        <?php                                       
                                        foreach ($obat as $data) {
                                            ?>       
                                            <option value="<?php echo $data->id_obat; ?>" ><?php echo $data->nama_obat; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="text-left">
                                <button class="btn btn-primary waves-effect waves-light " type="submit">Tampil Grafik</button>
                            </div>
                        </form>
                        <pre></pre>  
                        <h4 class="header-title">Grafik Penjualan Obat </h4>
                        
                        <div id="ct-chart" class="ct-chart ct-golden-section" dir="ltr"></div>
                       <div id="spline_area" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>  <!--end col--
            <!--end col--> 
        </div>  <!--end row--> 
    </div>
    <!--     end container-fluid -->
</div> 