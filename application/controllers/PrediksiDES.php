<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of Doubleperamalan

 *
 * @author Annesa
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class PrediksiDES extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') != "login") {
            redirect("auth");
        }
        $this->load->model('crud/mperamalan');
        $this->load->model('crud/mobat');
    }

    public function index() {
        $tanggal_start = '2018-01-01';
        $tanggal_end = '2019-12-31';
        $data_obat = array();

        $x = array();
        $xt = array();
        $t = 0;
        $i = 30;
        $x[$t] = $tanggal_start;
        $xt[$tanggal_start] = $t;

        while ($tanggal_start <= $tanggal_end) {
            $tanggal_start = date('Y-m-d', strtotime('+' . $i . ' days', strtotime($tanggal_start)));

            $t++;
            $x1[$t] = $tanggal_start;
            $xt[$tanggal_start] = $t;
        }
        $x = array();
        $no = 1;
        $satuan = $this->input->get('satuan');
//        $alpha = $this->input->get('alpha');

        if (empty($satuan)) {
            $data = array(
                'x' => array(),
                'sa' => array(),
                'saa' => array(),
                'a' => array(),
                'b' => array(),
                'f' => array(),
                'mad' => array(),
                'mape' => array(),
                'mse' => array(),
                'obat' => array(),
                'id_obat' => array()
            );
            $data['obat'] = $this->mobat->get_data_obat();
            $data['title'] = 'prediksi/title';
            $data['konten'] = 'prediksi/vprediksi';
        } else {
            $sum = 0;
            $mobil_alphard = array();
            
            //mengambil data berdasarkan kategori
            $ambil_data = $this->db->query("SELECT o.nama_obat, o.id_obat FROM alpha a JOIN obat o ON a.id_obat = o.id_obat WHERE o.satuan = '" . $satuan . "' ")->result_array();
             set_time_limit(0);
            foreach ($ambil_data as $ambil_data) {
                $no = 1;
                $x = array();
                $sa = array();
                $saa = array();
                $a = array();
                $b = array();
                $f = array();
                $mad = array();
                $mape = array();
                $mse = array();
                $obat = array();
                $id_obat = array();

                //mengambil satuan data dari kategori berdasarkan id_obat
                array_push($data_obat, $ambil_data);
                $id_obat = $ambil_data['id_obat'];
                //mengambil data transaksi berdasarkan id_obat
                $query = $this->db->query("SELECT sum(jumlah) AS jumlah, tanggal FROM rekap_transaksi WHERE id_obat = '" . $id_obat . "' "
                                . " GROUP BY YEAR(tanggal),MONTH(tanggal)")->result_array();
                foreach ($query as $key => $value) {
                    if (!(is_null($value['jumlah']))) {
                        $x[$no++] = $value['jumlah'];
                    }
                }
                for ($i = 1; $i < 10; $i++) {

                    if (empty($x)) {
                        $data = array(
                            'x' => $x,
                            'id_obat' => $id_obat
                        );
                    } else {
//                    $mape_akhir = array();
                        $mape_uji = array();
                        //peramalan double exponenthial smoothing
                        $alpha = $i / 10;
                        $no__ = 1;
                        $d = array(); //nilai x grafik
                        $t = array(); //nilai array x grafik

                        foreach ($x as $key => $value) {
                            $x[$no__] = $value;
                            array_push($d, $value);
                            array_push($t, $no__);
                            $no__++;
                        }

//               
                        $n = count($x);
                        $p = array(); //nilai peramalan pertama
                        $p2 = array(); //nilai peramalan pertama

                        $pangkat = 2;

                        $data_latih = array();
                        $data_uji = array();
                        $no_ = 1;
                        foreach ($x as $key => $value) {
                            if ($key < 19) {
                                if ($key == 1) {
                                    $sa[$key] = $x[$key];
                                    $saa[$key] = $x[$key];
                                    $a[$key] = 0;
                                    $b[$key] = 0;
                                    $f[$key] = 0;
                                    array_push($p, $x[$key]);
                                    array_push($p2, $x[$key]);
                                } else {
                                    $sa[$key] = ($alpha * $x[$key]) + ((1 - $alpha) * $sa[($key - 1)]);
                                    $saa[$key] = ($alpha * $sa[$key]) + ((1 - $alpha) * $saa[($key - 1)]);
                                    $a[$key] = (2 * $sa[$key]) - $saa[$key];
                                    $b[$key] = (($alpha) / (1 - $alpha)) * ($sa[$key] - $saa[$key]);
                                    if ($key == 2) {
                                        $f[$key] = 0;
                                        array_push($p, $x[$key]);
                                        array_push($p2, $x[$key]);
                                    } else {
                                        $f[$key] = $a[$key] + $b[$key];
                                        array_push($p, $f[$key]);
                                        array_push($p2, $f[$key]);
                                    }
                                }
                                $a_model = $a[$key];
                                $b_model = $b[$key];
                                $key_model = $key;
                                $data_latih[$key] = $value;
                            } else {
//                        array_push($data_uji, $value);
                                $data_uji[$no_++] = $value;
                            }
                        }

                        foreach ($data_uji as $nilai_key => $nilai_value) {
                            $f_p[$nilai_key] = abs($a_model + $b_model * $nilai_key);
                            $p2[$key_model + $nilai_key - 1] = $f_p[$nilai_key];
                            $mad[$nilai_key] = abs($nilai_value - $f_p[$nilai_key]);
                            $mape_uji[$nilai_key] = ($mad[$nilai_key] / $nilai_value) * 100;
//                            echo $mape_uji[$nilai_key] . '<br>';
                        }
                        $mape_akhir[$i] = array_sum($mape_uji) / count($mape_uji);
                        $data[$i] = array(
                            'id_obat' => $id_obat,
                            'x' => $x,
                            'sa' => $sa,
                            'saa' => $saa,
                            'a' => $a,
                            'b' => $b,
                            'f' => $f,
                            'f_p' => $f_p,
                            'mape_uji' => $mape_uji,
                            't' => $t,
                            'd' => $d,
                            'p' => $p,
                            'p2' => $p2,
                            'data_latih' => $data_latih,
                            'data_uji' => $data_uji,
                        );
                    }
                }
                $mape_min = min($mape_akhir);
                $alpha_akhir = array_search($mape_min, $mape_akhir);
                $sum = $sum + $alpha_akhir / 10;
//                exit;
                $detail[$id_obat] = array(
                    'nama_obat' => $ambil_data['nama_obat'],
                    'data' => $data,
                    'alpha_fix' => $alpha_akhir / 10,
                    'mape_fix' => $mape_min,
                    
                );
                
                $mobil_alphard[$id_obat]=$alpha_akhir/10;
            }
            
            $alpha_final = $mobil_alphard;
            $ambil_data = $this->db->query("SELECT o.nama_obat, o.id_obat FROM alpha a JOIN obat o ON a.id_obat = o.id_obat WHERE o.satuan = '" . $satuan . "'  ")->result_array();

            $dataperamalan = array();
            set_time_limit(0);
            foreach ($ambil_data as $ambil_data) {
                $no = 1;
                $x = array();
                $sa = array();
                $saa = array();
                $a = array();
                $b = array();
                $f = array();
                $mad = array();
                $mape = array();
                $mse = array();
                $obat = array();
                $id_obat = array();
                $id_obat = $ambil_data['id_obat'];
                $nama_obat = $ambil_data['nama_obat'];
                $query = $this->db->query("SELECT sum(jumlah) AS jumlah, tanggal FROM rekap_transaksi WHERE id_obat = '" . $id_obat . "' "
                                . " GROUP BY YEAR(tanggal),MONTH(tanggal)")->result_array();
                foreach ($query as $key => $value) {
                    if (!(is_null($value['jumlah']))) {
                        $x[$no++] = $value['jumlah'];
                    }
                }
                if (empty($x)) {
                    $data = array(
                        'x' => $x,
                        'id_obat' => $id_obat
                    );
                } else {
//                    $mape_akhir = array();
                    $mape_uji = array();
                    //peramalan double exponenthial smoothing
                    $alpha = $alpha_final[$id_obat];
                    $no__ = 1;
                    $d = array(); //nilai x grafik
                    $t = array(); //nilai array x grafik

                    foreach ($x as $key => $value) {
                        $x[$no__] = $value;
                        array_push($d, $value);
                        array_push($t, $no__);
                        $no__++;
                    }

//               
                    $n = count($x);
                    $p = array(); //nilai peramalan pertama
                    $p2 = array(); //nilai peramalan kedua

                    $pangkat = 2;

                    $data_latih = array();
                    $data_uji = array();
                    $no_ = 1;
                    foreach ($x as $key => $value) {
                        if ($key == 1) {
                            $sa[$key] = $x[$key];
                            $saa[$key] = $x[$key];
                            $a[$key] = 0;
                            $b[$key] = 0;
                            $f[$key] = 0;
                            array_push($p, $x[$key]);
                            array_push($p2, $x[$key]);
                        } else {
                            $sa[$key] = ($alpha * $x[$key]) + ((1 - $alpha) * $sa[($key - 1)]);
                            $saa[$key] = ($alpha * $sa[$key]) + ((1 - $alpha) * $saa[($key - 1)]);
                            $a[$key] = (2 * $sa[$key]) - $saa[$key];
                            $b[$key] = (($alpha) / (1 - $alpha)) * ($sa[$key] - $saa[$key]);
                            if ($key == 2) {
                                $f[$key] = 0;
                                array_push($p, $x[$key]);
                                array_push($p2, $x[$key]);
                            } else {
                                $f[$key] = $a[$key] + $b[$key];
                                array_push($p, $f[$key]);
                                array_push($p2, $f[$key]);
                            }
                        }
                    }

                    $f[$key + 1] = ceil($a[$key] + ($b[$key] * 1));
                    $f[$key + 2] = ceil($a[$key] + ($b[$key] * 2));

                    array_push($p, ceil($f[$key + 1]));
                    array_push($p, ceil($f[$key + 2]));
                    $f_akhir = ceil($a[$key] + ($b[$key] * 1));

                    array_push($t, $key + 1);
                    array_push($t, $key + 2);

//                $smse = 0;
                    foreach ($x as $key => $value) {
                        if ($key <= 2) {
                            $mad[$key] = 0;
                            $mse[$key] = 0;
                        } else {
                            $mad[$key] = abs($value - $f[$key]);
                            $mse[$key] = pow(($value - $f[$key]), $pangkat);
                        }

                        $mape[$key] = ($mad[$key] / $value) * 100;
                    }
                    $data1 = array(
                        'id_obat' => $id_obat,
                        'nama_obat' => $nama_obat,
                        'x' => $x,
                        'sa' => $sa,
                        'saa' => $saa,
                        'a' => $a,
                        'b' => $b,
                        'f' => $f,
                        'f_akhir' => $f_akhir,
                        't' => $t,
                        'd' => $d,
                        'p' => $p,
                        'p2' => $p2,
                        'mape' => $mape
                    );
                    array_push($dataperamalan, $data1);
                }
            }
            //        echo "<pre>";
//        print_r($dataperamalan);
//        exit;

            $data['detail'] = $detail;
            $data['hitung'] = $data;
            $data['alpha_final'] = $alpha_final;
            $data['detail_akhir'] = $dataperamalan;
            $data['obat'] = $this->mobat->get_data_obat();
            $data['title'] = 'prediksi/title';
            $data['konten'] = 'prediksi/vprediksi';
        }
        $this->load->view('template/template', $data);
    }

    public function detail($id) {
        $tanggal_start = '2018-01-01';
        $tanggal_end = '2019-12-31';
        $data_obat = array();

        $x = array();
        $xt = array();
        $t = 0;
        $i = 30;
        $x[$t] = $tanggal_start;
        $xt[$tanggal_start] = $t;

        while ($tanggal_start <= $tanggal_end) {
            $tanggal_start = date('Y-m-d', strtotime('+' . $i . ' days', strtotime($tanggal_start)));

            $t++;
            $x1[$t] = $tanggal_start;
            $xt[$tanggal_start] = $t;
        }
        $x = array();
        $no = 1;
        $id_obat = $id;
        if(empty($id_obat)){
             $data = array(
                'x' => array(),
                'sa' => array(),
                'saa' => array(),
                'a' => array(),
                'b' => array(),
                'f' => array(),
                'mad' => array(),
                'mape' => array(),
                'mse' => array(),
                'obat' => array(),
                'id_obat' => array()
            );
        } else{
             $sum = 0;
            //mengambil data berdasarkan kategori
           
                $query = $this->db->query("SELECT sum(jumlah) AS jumlah, tanggal FROM rekap_transaksi WHERE id_obat = '" . $id_obat . "' "
                                . " GROUP BY YEAR(tanggal),MONTH(tanggal)")->result_array();
                foreach ($query as $key => $value) {
                    if (!(is_null($value['jumlah']))) {
                        $x[$no++] = $value['jumlah'];
                    }
                }
                for ($i = 1; $i < 10; $i++) {

                    if (empty($x)) {
                        $data = array(
                            'x' => $x,
                            'id_obat' => $id_obat
                        );
                    } else {
//                    $mape_akhir = array();
                        $mape_uji = array();
                        //peramalan double exponenthial smoothing
                        $alpha = $i / 10;
                        $no__ = 1;
                        $d = array(); //nilai x grafik
                        $t = array(); //nilai array x grafik

                        foreach ($x as $key => $value) {
                            $x[$no__] = $value;
                            array_push($d, $value);
                            array_push($t, $no__);
                            $no__++;
                        }

//               
                        $n = count($x);
                        $p = array(); //nilai peramalan pertama
                        $p2 = array(); //nilai peramalan pertama

                        $pangkat = 2;

                        $data_latih = array();
                        $data_uji = array();
                        $no_ = 1;
                        foreach ($x as $key => $value) {
                            if ($key < 19) {
                                if ($key == 1) {
                                    $sa[$key] = $x[$key];
                                    $saa[$key] = $x[$key];
                                    $a[$key] = 0;
                                    $b[$key] = 0;
                                    $f[$key] = 0;
                                    array_push($p, $x[$key]);
                                    array_push($p2, $x[$key]);
                                } else {
                                    $sa[$key] = ($alpha * $x[$key]) + ((1 - $alpha) * $sa[($key - 1)]);
                                    $saa[$key] = ($alpha * $sa[$key]) + ((1 - $alpha) * $saa[($key - 1)]);
                                    $a[$key] = (2 * $sa[$key]) - $saa[$key];
                                    $b[$key] = (($alpha) / (1 - $alpha)) * ($sa[$key] - $saa[$key]);
                                    if ($key == 2) {
                                        $f[$key] = 0;
                                        array_push($p, $x[$key]);
                                        array_push($p2, $x[$key]);
                                    } else {
                                        $f[$key] = $a[$key] + $b[$key];
                                        array_push($p, $f[$key]);
                                        array_push($p2, $f[$key]);
                                    }
                                }
                                $a_model = $a[$key];
                                $b_model = $b[$key];
                                $key_model = $key;
                                $data_latih[$key] = $value;
                            } else {
//                        array_push($data_uji, $value);
                                $data_uji[$no_++] = $value;
                            }
                        }

                        foreach ($data_uji as $nilai_key => $nilai_value) {
                            $f_p[$nilai_key] = abs($a_model + $b_model * $nilai_key);
                            $p2[$key_model + $nilai_key - 1] = $f_p[$nilai_key];
                            $mad[$nilai_key] = abs($nilai_value - $f_p[$nilai_key]);
                            $mape_uji[$nilai_key] = ($mad[$nilai_key] / $nilai_value) * 100;
//                            echo $mape_uji[$nilai_key] . '<br>';
                        }
                        $mape_akhir[$i] = array_sum($mape_uji) / count($mape_uji);
                        $data['detail'][$i] = array(
                            'id_obat' => $id_obat,
                            'x' => $x,
                            'sa' => $sa,
                            'saa' => $saa,
                            'a' => $a,
                            'b' => $b,
                            'f' => $f,
                            'f_p' => $f_p,
                            'mape_uji' => $mape_uji,
                            't' => $t,
                            'd' => $d,
                            'p' => $p,
                            'p2' => $p2,
                            'data_latih' => $data_latih,
                            'data_uji' => $data_uji,
                        );
                    }
                }
                $mape_min = min($mape_akhir);
                $alpha_akhir = array_search($mape_min, $mape_akhir);
                $sum = $sum + $alpha_akhir / 10;
//                exit;
                
            
        }
        
//        $data['detail']= $data;
        $data['title'] = 'prediksi/title';
        $data['konten'] = 'prediksi/vdetail';
        $this->load->view('template/template', $data);
    }

}
