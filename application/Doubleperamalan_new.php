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

class Doubleperamalan_new extends CI_Controller {

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
//        echo "<pre>";

        $x = array();
        $no = 1;
        $id_obat = $this->input->get('id_obat');

        if (empty($id_obat)) {
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
//            echo '<pre>';
//            print_r($data);
        } else {
            $query = $this->db->query("SELECT COUNT(*) AS jumlah, tanggal FROM rekap_transaksi WHERE id_obat = '" . $id_obat . "' "
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
                //peramalan double exponenthial smoothing
//                $smse = 0;
                $no = 1;
                $d = array(); //nilai x grafik
                $t = array(); //nilai array x grafik

                foreach ($x as $key => $value) {
                    $x[$no] = $value;
                    array_push($d, $value);
                    array_push($t, $no);
                    $no++;
                }

//               
                $n = count($x);
//                $alpha = 2 / ($n + 1);
                $alpha = 0.5;
                $p = array(); //nilai peramalan pertama
                $pangkat = 2;

                $data_latih = array();
                $data_uji = array();
                $no_ = 1;
                foreach ($x as $key => $value) {
                    if ($key < 18) {
                        if ($key == 1) {
                        $sa[$key] = $x[$key];
                        $saa[$key] = $x[$key];
                        $a[$key] = 0;
                        $b[$key] = 0;
                        $f[$key] = 0;
                        array_push($p, $x[$key]);
                    } else {
                        $sa[$key] = ($alpha * $x[$key]) + ((1 - $alpha) * $sa[($key - 1)]);
                        $saa[$key] = ($alpha * $sa[$key]) + ((1 - $alpha) * $saa[($key - 1)]);
                        $a[$key] = (2 * $sa[$key]) - $saa[$key];
                        $b[$key] = (($alpha) / (1 - $alpha)) * ($sa[$key] - $saa[$key]);
                        if ($key == 2) {
                            $f[$key] = 0;
                            array_push($p, $x[$key]);
                        } else {
                            $f[$key] = $a[$key] + $b[$key];
                            array_push($p, $f[$key]);
                        }
                    }
                    $a_model = $a[$key];
                    $b_model = $b[$key];
                    $key_model = $key;

                    } else {
//                        array_push($data_uji, $value);
                        $data_uji[$no_++] = $value;
                        
                    }
                }
                
                foreach ($data_uji as $nilai_key => $nilai_value) {
                    $f_p[$key_model + $nilai_key] = $a_model+ $b_model* $nilai_key ;
                    array_push($p, ($f_p[$key_model + $nilai_key ]));
                }
                echo "ini a $a_model ini $b_model <br>";
                 echo '<pre>';
                print_r($f);
                print_r($f_p);
                 echo '<pre>';
                print_r($p);
                exit();
                array_push($t, $key + 1);
                array_push($t, $key + 2);

//                $smse = 0;
                foreach ($data_uji as $nilai_keykey => $nilai_value) {
                    if ($nilai_keykey <= 2) {
                        $mad[$nilai_keykey] = 0;
                        $mse[$nilai_keykey] = 0;
                    } else {
                        $mad[$nilai_keykey] = abs($nilai_value - $f[$nilai_keykey]);
                        $mse[$nilai_keykey] = pow(($nilai_value - $f[$nilai_keykey]), $pangkat);
                    }

                    $mape[$nilai_keykey] = ($mad[$nilai_keykey] / $nilai_value) * 100;
                }
                echo "<pre>";
                print_r($mape);
                exit();
                
                $data = array(
                    'x' => $x,
                    'sa' => $sa,
                    'saa' => $saa,
                    'a' => $a,
                    'b' => $b,
                    'f' => $f,
                    'mad' => $mad,
                    'mape' => $mape,
                    'mse' => $mse,
                    'id_obat' => $id_obat,
                    't' => $t,
                    'd' => $d, 
                    'p' => $p,
                    'tgl_awal_training' => $tgl_awal_training,
                    'tgl_akhir_training' => $tgl_akhir_training
                );
            }
        }

        $data['obat'] = $this->mobat->get_list_obat();
        $data['title'] = 'peramalan/title';
        $data['konten'] = 'peramalan/vperamalan_1';
        $this->load->view('template/template', $data);
    }

    public function simpan_peramalan() {

        $data = $this->input->post(null, true);
        extract($data);

        $dataItem = array(
            'id_obat' => $id_obat,
            'tgl_awal_training' => $tgl_awal_training,
            'tgl_akhir_training' => $tgl_akhir_training,
            'jumlah_peramalan' => $jumlah_peramalan
        );

        if ($branchId = $this->mperamalan->save($dataItem)) {
            redirect("pengadaanobat");
        }
    }

}
