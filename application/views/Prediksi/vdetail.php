<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php
//                        echo '<pre>';
//                        print_r($detail);
//                        echo '</pre>';
//                         exit();
                        ?>
                        <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Detail Perhitungan </h5>
                        <div class="modal-body">
                            <ul class="nav nav-tabs" role="tablist">
                                <?php
                                for ($k = 1; $k < 10; $k++) {
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="<?php echo '#parameter' . $k ?>" role="tab">
                                            <i class="fas fa-user mr-1"></i> <span class="d-none d-md-inline-block"><?php echo '0.' . $k; ?> </span>
                                        </a>
                                    </li>                                                                           
                                    <?php
                                }
                                ?>
                            </ul> 

                            <div class="tab-content p-3"> 
                                <?php
                                for ($k = 1; $k < 10; $k++) {
                                    ?>
                                    <div class="tab-pane" id="<?php echo 'parameter' . $k; ?>" role="tabpanel">
                                        <div class="table-rep-plugin">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead style="text-align: center">
                                                    <tr>
                                                        <td>No</td>
                                                        <td>Data Aktual</td>
                                                        <td>S'</td>
                                                        <td>S"</td>
                                                        <td>a</td>
                                                        <td>b</td>
                                                        <td>F</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
//                                                                                            foreach ($hitung[$k] as $key => $values) {                                                                                             

                                                    for ($l = 1; $l <= count($detail[$k]['sa']); $l++) {
                                                        ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $l; ?></td>
                                                            <td class="text-center"><?php echo $detail[$k]['x'][$l]; ?></td>
                                                            <td class="text-right"><?php echo round($detail[$k]['sa'][$l], 3); ?></td>
                                                            <td class="text-right"><?php echo round($detail[$k]['saa'][$l], 3); ?></td> 
                                                            <td class="text-right"><?php echo round($detail[$k]['a'][$l], 3); ?></td>  
                                                            <td class="text-right"><?php echo round($detail[$k]['b'][$l], 3); ?></td>
                                                            <td class="text-right"><?php echo round($detail[$k]['f'][$l], 3); ?></td>                                                                                            
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <pre></pre>
                                            <pre></pre>
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead style="text-align: center">
                                                    <tr>
                                                        <td>No</td>
                                                        <td>Data Aktual</td>
                                                        <td>F</td>
                                                        <td>Mape Uji</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($detail[$k]['data_uji'] as $key => $values) {


//                                                    for ($l = 1; $l <= count($detail[$k]['data_uji']); $l++) {
                                                        ?>
                                                        <tr class="text-center">
                                                            <td class=""><?php echo $key ?></td>
                                                            <td class="text-center"><?php echo $values ?></td>
                                                            <td class="text-center"><?php echo round($detail[$k]['f_p'][$key], 3) ?></td>
                                                            <td class="text-center"><?php echo round($detail[$k]['mape_uji'][$key], 3) ?></td>

                                                        </tr>                                                       

                                                        <?php
                                                    }
                                                    ?>
                                                    <tr>
                                                        <th colspan="2"style="text-align: center"> Jumlah Rata-rata MAPE</th>
                                                        <th colspan="3" style="text-align: center"><?= array_sum($detail[$k]['mape_uji']) / count($detail[$k]['mape_uji']) ?></th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--                                            <div class="col-lg-12">
                                                                                            <div class="card">
                                                                                                <div class="card-body">
                                                                                                    <h4 class="header-title">Grafik </h4>
                                                                                                    <p class="card-title-desc">Hasil Orediksi Penjualan Obat</p>
                                                                                                </div>
                                            
                                                                                                <div id="chart-with-area<?= $k; ?>" class="ct-chart ct-golden-section"></div>
                                            
                                                                                            </div>
                                                                                        </div>-->
                                        </div>  
                                        <?php
                                        $t = $detail[$k]['t'];
                                        $d = $detail[$k]['d'];
                                        $p = $detail[$k]['p'];
                                        $p2 = $detail[$k]['p2'];
                                        ?>
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="header-title">Grafik </h4>
                                                    <p class="card-title-desc">Hasil Orediksi Penjualan Obat</p>
                                                </div>                                            
                                                <div id="detail-<?= $k ?>" class="ct-chart ct-golden-section"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                }
//                                echo "<pre>";
//                                echo "<br>ini p2 <br>";
//                                print_r($p2);
//                                echo "<br>ini t <br>";
//                                print_r($t);
//                                echo "<br>ini p <br>";
//                                print_r($p);
//                                echo "<br>ini d <br>";
//                                print_r($d);
//                                echo "</pre>";
                                ?>
                                <!--                                <div class="col-lg-12">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h4 class="header-title">Grafik </h4>
                                                                            <p class="card-title-desc">Hasil Orediksi Penjualan Obat</p>
                                                                        </div>
                                
                                                                        <div id="chart-with-area" class="ct-chart ct-golden-section"></div>
                                
                                                                    </div>
                                                                </div>-->

                            </div>                            
                        </div> <!--//modal boday  >--> 
                    </div> 
                </div> 
            </div> 
        </div>
    </div>
</div>  <!--end col-->
<!--        </div>  end row 
    </div>
         end container-fluid 
</div> -->
