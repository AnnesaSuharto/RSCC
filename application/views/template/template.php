<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Ayo Mangats!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url('assets/'); ?>images/favicon.ico">
        <!-- DataTables -->
        <link href="<?= base_url('assets/'); ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/'); ?>libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="<?= base_url('assets/'); ?>libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />  
        <!-- Responsive Table css -->
        <link href="<?= base_url('assets/'); ?>libs/RWD-Table-Patterns/css/rwd-table.min.css" rel="stylesheet" type="text/css" />
        <!-- Selectize -->
        <link href="<?= base_url('assets/'); ?>libs/selectize/css/selectize.css" rel="stylesheet" type="text/css" /> 
        <!-- Sweet Alert-->
        <link href="<?= base_url('assets/'); ?>libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        <!-- datepicker -->
        <link href="<?= base_url('assets/'); ?>libs/air-datepicker/css/datepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/'); ?>bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
        <!-- Bootstrap Css -->
        <link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?= base_url('assets/'); ?>css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?= base_url('assets/'); ?>css/app.min.css" rel="stylesheet" type="text/css" />  

        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />-->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <!-- chartist chart css -->
        <link href="<?= base_url('assets/'); ?>libs/chartist/chartist.min.css" rel="stylesheet">
        <link href="<?= base_url('assets/'); ?>jquery.sparkline.js" rel="stylesheet">
        <link href="<?= base_url('assets/'); ?>sparkline-chart.js" rel="stylesheet">



    </head>

    <body data-topbar="colored">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?= base_url('assets/'); ?>images/logo-rscc.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url('assets/'); ?>images/logo-rscc.png" alt="" height="20">
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?= base_url('assets/'); ?>images/logo-rscc.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url('assets/'); ?>images/logo-rscc.png" alt="" height="20">
                                </span>
                            </a>

                        </div>
                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="mdi mdi-backburger"></i>
                        </button>
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ml-2">
                            <!--                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-magnify"></i>
                                                        </button>-->
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                                 aria-labelledby="page-header-search-dropdown">

                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="<?= base_url('assets/'); ?>images/users/avatar-1.jpg" alt="Header Avatar">
                            <span class="d-none d-sm-inline-block ml-1"><?php echo $this->session->userdata("nama"); ?></span>
                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a href="<?php echo base_url('Auth/logout'); ?>" class="dropdown-item" href="#"><i class="mdi mdi-logout font-size-16 align-middle mr-1"></i> Logout</a>
                        </div>
                    </div>

                </div>
        </div>

    </header>

    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Menu</li>
                    <li>
                        <a href="<?php echo site_url('Beranda'); ?>" class="waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('obat'); ?>" class="waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                            <span>Obat</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('transaksi'); ?>" class=" waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-schedule"></i></div>
                            <span>Transaksi Penjualan </span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('prediksiDES'); ?>" class="waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-sign-in-alt"></i></div> 
                            <span>Prediksi Penjualan</span>
                        </a>
                    </li>

                    <!--                    <li>
                                            <a href="<?php echo site_url('doubleperamalan'); ?>" class="waves-effect">
                                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-sign-in-alt"></i></div> 
                                                <span>Peramalan</span>
                                            </a>
                                        </li>-->

                    <li>
                        <a href="<?php echo site_url('user'); ?>" class="waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-plus-square"></i></div>
                            <span>Akun</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">

            <?php $this->load->view($title) ?>
            <?php $this->load->view($konten) ?>
            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">

                        2020 © RS Condong Catur
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-right d-none d-sm-block">
<!--                            Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign-->
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="<?= base_url('assets/'); ?>libs/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/metismenu/metisMenu.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/simplebar/simplebar.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/node-waves/waves.min.js"></script>

<script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>
<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Responsive Table js -->
<script src="<?= base_url('assets/'); ?>libs/RWD-Table-Patterns/js/rwd-table.min.js"></script>
<!-- Buttons examples -->
<script src="<?= base_url('assets/'); ?>libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/jszip/jszip.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/pdfmake/build/vfs_fonts.js"></script>
<script src="<?= base_url('assets/'); ?>libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="<?= base_url('assets/'); ?>libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<!-- Selectize -->
<script src="<?= base_url('assets/'); ?>libs/selectize/js/standalone/selectize.min.js"></script>
<!-- Init js -->
<script src="<?= base_url('assets/'); ?>js/pages/table-responsive.init.js"></script>

<script src="<?= base_url('assets/'); ?>js/app.js"></script>
<script src="<?= base_url('assets/'); ?>libs/chartist/chartist.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/chartist-plugin-tooltips-updated/chartist-plugin-tooltip.min.js"></script>
<!-- Sweet Alerts js -->
<script src="<?= base_url('assets/'); ?>libs/sweetalert2/sweetalert2.min.js"></script>
<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Responsive examples -->
<script src="<?= base_url('assets/'); ?>libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="<?= base_url('assets/'); ?>js/pages/datatables.init.js"></script>
<!-- Sweet alert init js-->
<script src="<?= base_url('assets/'); ?>js/pages/sweet-alerts.init.js"></script>
<script src="<?= base_url('assets/'); ?>js/pages/alpha.js"></script>


<!-- demo js-->
<!--<script src="<?php //echo base_url('assets/');                  ?>js/pages/chartist.init.js"></script>-->
<!--<script>
    document.getElementById("hitung").addEventListener("click", function (event) {
        event.preventDefault()
        a = document.getElementById("nilai_stok_akhir").value
        b = document.getElementById("jumlah_peramalan").value

        c = b - a
        if (c < 0) {
            c = 0;
        }
        document.getElementById("hasil_pengadaan").value = c
    });
</script>-->

<script>
//    console.log('keluar dong plis banget lisssss');
    $("#chart-with-area").length && new Chartist.Line("#chart-with-area",
            {
                labels:<?= json_encode($t) ?>,
                series: [
                    {
                        data: <?= (json_encode($d)) ?> //Data Peramalan
                    },
                    {
                        data: <?= (json_encode($p2)) ?> //Data Awal
                    },
                    {
                        data: <?= (json_encode($p)) ?> //Data Awal
                    }
                ]
            },
            {
                low: 0,
                showArea: !0,
                plugins: [
                    Chartist.plugins.tooltip()
                ]
            }
    )
</script>


<?php
if (isset($detail)) {
    foreach ($detail as $key => $detail) {
        ?>
        <script>
            console.log('keluar dong plis banget lisssss detail');
            $("#detail-<?= $key ?>").length && new Chartist.Line("#detail-<?= $key ?>",
                    {
                        labels:<?= json_encode($detail['t']) ?>,
                        series: [
                            {
                                data: <?= (json_encode($detail['d'])) ?> //Data Peramalan
                            },
                            {
                                data: <?= (json_encode($detail['p2'])) ?> //Data Awal
                            },
                            {
                                data: <?= (json_encode($detail['p'])) ?> //Data Awal
                            }
                        ]
                    },
                    {
                        low: 0,
                        showArea: !0,
                        plugins: [
                            Chartist.plugins.tooltip()
                        ]
                    }
            )
        </script>

        <?php
    }
}
?> 

<!--<script>
//    console.log('keluar dong plis banget lisssss');
    $(".chart-area").length && new Chartist.Line(".chart-area",
            {
                labels:<?= json_encode($t) ?>,
                series: [
                    {
                        data: <?= (json_encode($d)) ?> //Data Peramalan
                    },
                    {
                        data: <?= (json_encode($p2)) ?> //Data Awal
                    },
                    {
                        data: <?= (json_encode($p)) ?> //Data Awal
                    }
                ]
            },
            {
                low: 0,
                showArea: !0,
                plugins: [
                    Chartist.plugins.tooltip()
                ]
            }
    )
</script>-->


<!--<script>
    $("#ct-chart").length && new Chartist.Line('.ct-chart', {
        labels: <?= json_encode($t) ?>,
        series: [
            {
                data: <?= (json_encode($d)) ?> //Data Awal
            }
        ]
    }, {
        low: 0,
        showArea: !0,
        plugins: [
            Chartist.plugins.tooltip()
        ]
    });
</script>-->
</body>
</html>
