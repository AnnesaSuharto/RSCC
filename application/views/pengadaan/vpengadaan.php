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
                                            <th>Tanggal Awal Training</th>
                                            <th>Tanggal Akhir Training</th>
                                            <th>Tanggal Pengadaan</th>
                                            <th>Jumlah Peramalan</th>
                                            <th>Stok Obat Akhir</th>
                                            <th>Jumlah Pengadaan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            $no = 1;
                                            foreach ($pengadaan as $pengadaan) {
                                                $delMessage = "Apakah anda yakin ingin menghapus Barang : " . $pengadaan->nama_obat . " ?";
                                                ?>
                                                <td><?php echo $no ?></td>
                                                <td><?php echo $pengadaan->kode_obat ?></td>
                                                <td><?php echo $pengadaan->nama_obat ?></td>
                                                <td><?php echo $pengadaan->tgl_awal_training ?></td>
                                                <td><?php echo $pengadaan->tgl_akhir_training ?></td>
                                                <td><?php echo date('Y-m-d', strtotime('+29 days', strtotime($pengadaan->tgl_akhir_training))) ?></td>
                                                <td><?php echo $pengadaan->jumlah_peramalan ?></td>  
                                                <td><?php echo $pengadaan->jumlah_stok_akhir ?></td>
                                                <td><?php echo $pengadaan->jumlah_pengajuan ?></td>  
                                                <td>
                                                    <a href="<?php echo site_url('pengadaanobat/hitung/') . $pengadaan->id_pengadaan ?>" class="btn btn-warning " >
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="<?php echo site_url('pengadaanobat/delete/') . $pengadaan->id_pengadaan ?>" onclick="return confirm('<?php echo $delMessage ?>')" class="btn btn-danger ">
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
