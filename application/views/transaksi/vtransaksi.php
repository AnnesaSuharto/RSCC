
<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">    
                                <form action="<?php echo base_url(); ?>import/importFile" method="post" enctype="multipart/form-data">
                                    <label>Upload excel file :</label> 
                                    <div class="custom-file">
                                        <input type="file" name="uploadFile" value=""  />                                       
                                        <input type="submit" name="submit" value="Upload" class="btn btn-primary waves-effect waves-light"/>
                                    </div>
                                </form>
                            </div> 
                        </div>
                        <pre></pre>
                        <form >
                            <div class="row"> 
                                <div class="col-md-10">
                                    <label>Pilih Nama Obat</label>
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
                                <div >
                                    <div>
                                        <pre></pre>
                                        <pre></pre>
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Tampil</button>

                                    </div>
                                </div>    

                            </div>
                        </form> 
                        <pre></pre>
                        <pre></pre>
                        <?php
                        if ($this->input->get('id_obat')) {
                            ?>
                            <p>Transaksi Penjualan : <?= $tampil[0]['nama_obat'] ?></p>
                        <?php }
                        ?>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead align="center">
                                <tr>
                                    <th >No</th>
                                    <th >Nama Obat</th>
                                    <th >Tanggal</th>
                                    <th >Jumlah Terjual</th>
                                </tr>
                            </thead>

                            <tbody  align="center">                                
                                <?php
                                $no = 1;
                                foreach ($tampil as $value) {
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $value['nama_obat'] ?></td>
                                        <td><?= $value['tanggal'] ?></td>
                                        <td><?= $value['jumlah'] ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
    <!-- end container-fluid -->
</div> 