<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-md-5">
                                    <div>
                                        <label>Kategori Satuan Obat</label>
                                        <select class="form-control" name="satuan">
                                            <option>Select</option>
                                            <option value="capsul">CAPSUL</option>
                                            <option value="tablet">TABLET</option>
                                            <option value="ampul">AMPUL</option>
                                            <option value="botol">BOTOL</option>
                                            <option value="tube">TUBE</option>
                                            <option value="buah">BUAH</option>
                                            <option value="biji">BIJI</option>
                                            <option value="sachet">SACHET</option>
                                            <option value="pieces">PIECES</option>
                                            <option value="mili liter">MILI LITER</option>
                                            <option value="vial">VIAL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div>
                                        <pre></pre>
                                        <pre></pre>
                                        <button class="btn btn-primary waves-effect waves-light " type="submit">Prediksi</button>
                                    </div>
                                </div>                                                           
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <pre></pre>
                        <h4 class="header-title">Hasil Prediksi </h4>
                        <?php
//                                        echo '<pre>';
//                        print_r($detail);
//                        exit();
                        ?>
                        <div class="table-rep-plugin">
                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead style="text-align: center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Obat</th>
                                            <th>Alpha</th>
                                            <th>MAPE</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        if (empty($detail)) {
                                            ?>

                                            <?php
                                        } else {
                                            $sum = 0;
                                            foreach ($detail as $key => $value) {
                                                $no++;
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no ?></td>
                                                    <td class="text-center"><?php echo $value['nama_obat'] ?></td>
                                                    <td class="text-center"><?php echo $value['alpha_fix'] ?></td>
                                                    <td class="text-center"><?php echo round($value['mape_fix'], 3)  ?></td>
                                                    <td class="text-center">
                                                        <a href="<?php echo site_url('PrediksiDES/detail/').$key; ?>" class="">
                                                            <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="modal" data-target="#modalhitung<?= $key ?>">detail</button>
                                                        </a>
                                                    </td>
                                                </tr>                                                    
                                                <?php
                                                $sum = $sum + $value['alpha_fix'];
                                            }
                                            $alpha_rata = $sum / $no;
                                            ?>
                                            <tr>
<!--                                                <th colspan="2"style="text-align: center"> Rata-rata Alpha</th>
                                                <th colspan="3" style="text-align: center"><?= $alpha_final; ?></th>-->
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                    <p><!-- comment -->     
                                </table>
                            </div>
                        </div>                            

                        <pre>  </pre>
                        <pre></pre>  
                        <div id="accordion">
                            <div class="card mb-0">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="m-0 font-size-14">
                                        <a class="collapsed text-dark" data-toggle="collapse"
                                           data-parent="#accordion" href="#collapseTwo"
                                           aria-expanded="false" aria-controls="collapseTwo">
                                            Hasil Peramalan
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="table-rep-plugin">
                                            <!--<div class="table-responsive">-->
                                            <table class="table table-centered mb-0">
                                                <thead style="text-align: center">
                                                    <tr>
                                                        <td>No</td>
                                                        <td>Nama Obat</td>
                                                        <td>Prediksi</td>
                                                        <td>Aksi</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 0;

//                                if (!$this->input->get('id_obat')) {
//                                    
//                                } else
                                                    if (empty($detail_akhir)) {
                                                        ?>
                                                        <tr>
                                                            <td colspan="10">Data Transaksi Tidak Ada :)</td>
                                                        </tr>
                                                        <?php
                                                    } else {
                                                        foreach ($detail_akhir as $key => $value) {
                                                            $no++;
                                                            ?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $no ?></td>
                                                                <td class="text-center"><?php echo $value['nama_obat'] ?></td>                                            
                                                                <td class="text-center"><?php echo $value['f_akhir'] ?></td>
                                                                <td class="text-center">

                                                                    <!-- Extra Large modal -->
                                                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="modal" data-target="#modalobat<?= $value['id_obat'] ?>">
                                                                        <i class="mdi mdi-eye"></i>
                                                                    </button>

                                                                    <!--  Modal content for the above example -->
                                                                    <div id="modalobat<?= $value['id_obat'] ?>" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-xl">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Detail Perhitungan <?php echo $value['nama_obat']; ?></h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <table id="tech-companies-1" class="table table-striped">
                                                                                        <thead style="text-align: center">
                                                                                            <tr>
                                                                                                <td>No</td>
                                                                                                <td>Data Aktual</td>
                                                                                                <td>SES</td>
                                                                                                <td>DES</td>
                                                                                                <td>a</td>
                                                                                                <td>b</td>
                                                                                                <td>f</td>
                                                                                            </tr>                                                                            
                                                                                        </thead>

                                                                                        <?php
                                                                                        for ($j = 1; $j <= count($value['x']); $j++) {
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td><?php echo $j; ?></td>
                                                                                                <td><?php echo $value['x'][$j]; ?></td>
                                                                                                <td><?php echo $value['sa'][$j]; ?></td>
                                                                                                <td><?php echo $value['saa'][$j]; ?></td>
                                                                                                <td><?php echo $value['a'][$j]; ?></td>
                                                                                                <td><?php echo $value['b'][$j]; ?></td>
                                                                                                <td><?php echo $value['f'][$j]; ?></td>
                                                                                            </tr>
                                                                                            <?php
                                                                                        }
                                                                                        ?>


                                                                                    </table>
                                                                                </div>
                                                                            </div><!-- /.modal-content -->
                                                                        </div><!-- /.modal-dialog -->
                                                                    </div><!-- /.modal -->
                                                                </td>
                                                            </tr>                                                    
                                                            <?php
                                                        }
                                                        ?>
                                                    <?php }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  <!--end col-->
                </div> 
            </div>
        </div> <!--     end container-fluid -->
    </div> <!--page-content-wrapper-->
</div>