<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-rep-plugin">
                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Obat</th>
                                            <th>Nama Obat</th>
                                            <th>Satuan</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>   
                                            <th>Kandungan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            $no = 1;
                                            foreach ($obat as $obat) {
                                                $delMessage = "Apakah anda yakin ingin menghapus Barang : " . $obat->nama_obat . " ?";
                                                ?>
                                                <td><?php echo $no ?></td>
                                                <td><?php echo $obat->id_obat ?></td>
                                                <td><?php echo $obat->nama_obat ?></td>
                                                <td><?php echo $obat->satuan ?></td>
                                                <td><?php echo $obat->harga_beli ?></td>
                                                <td><?php echo $obat->harga_jual ?></td>
                                                <td><?php echo $obat->kandungan ?></td> 
                                                <td>
                                                    <a href="<?php echo site_url('obat/form/') . $obat->id_obat ?>" class="btn btn-warning ">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <a href="<?php echo site_url('obat/delete/') . $obat->id_obat ?>" class="btn btn-primary waves-effect waves-light sa-warning" >
                                                        <i class="far fa-trash-alt"></i>
                                                    </a> 
                                                </td>
                                            </tr>
                                            <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  <!--end col-->
        </div>  <!--end row--> 
    </div>
    <!--     end container-fluid -->
</div> 