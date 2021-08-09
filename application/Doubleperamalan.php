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

class Doubleperamalan extends CI_Controller {

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

//            foreach ($x1 as $key => $value) {
//                // query $value - $x[$key+1]
//                $query = $this->db->query("SELECT SUM(jumlah) AS jumlah FROM rekap_transaksi WHERE id_obat = '" . $id_obat . "' "
//                                . "AND tanggal BETWEEN '" . $value . "' AND '" . date('Y-m-d 23:59:59', strtotime('+29 days', strtotime($value))) . "'")->result_array();
//                
//                $temp = array_map(function($value) { //variabel query di looping
//                    return $value['jumlah'];
//                }, $query);
//                //Jika ada data kosong maka tidak di masukin ke array
//                if (!(is_null($temp[0]))) {
//                    $x[$no++] = $temp[0];
//                }
//            }
//            var_dump($x);
//            exit();
            $query = $this->db->query("SELECT COUNT(*) AS jumlah, tanggal FROM rekap_transaksi WHERE id_obat = '" . $id_obat . "' "
                            . " GROUP BY YEAR(tanggal),MONTH(tanggal)")->result_array();
            $tgl_awal_training = $query[0]['tanggal'];
            $tgl_akhir_training = $query[count($query) - 1]['tanggal'];
//            var_dump($tgl_awal_training);
//            var_dump($tgl_akhir_training);
//            exit();
            foreach ($query as $key => $value) {
                if (!(is_null($value['jumlah']))) {
                    $x[$no++] = $value['jumlah'];
                }
            }
//            var_dump(empty($x)); //apakah bernilai kosong atau tidak
//            exit();
            if (empty($x)) {
                $data = array(
                    'x' => $x,
                    'id_obat' => $id_obat
                );
            } else {
                //peramalan double exponenthial smoothing
//                $smse = 0;
                $no = 1;
                $d = array();
                $t = array();

                foreach ($x as $key => $value) {
                    $x[$no] = $value;
//            echo '<br>' . $rx['tahun'] . '=' . $rx['jumlah'];
                    array_push($d, $value);
                    array_push($t, $no);
                    $no++;
                }
//                echo "<pre>";
//                print_r($d);
                
//                $data_latih = array();
//                $data_uji = array();
//                foreach ($d as $key => $value) {
//                    if($key < 18){
//                        array_push($data_latih, $value);
//                    } else{
//                        array_push($data_uji, $value);
//                    }
//                }
//                print_r($data_latih);
//                print_r($data_uji);
                exit();
                $n = count($x);
//                $alpha = 2 / ($n + 1);
                $alpha = 0.5;
                $p = array();
                $pangkat = 2;
                //rumus 
                foreach ($x as $key => $value) {
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
                }

                $f[$key + 1] = ceil($a[$key] + ($b[$key] * 1));
                $f[$key + 2] = ceil($a[$key] + ($b[$key] * 2));

                array_push($p, ceil($f[$key + 1]));
                array_push($p, ceil($f[$key + 2]));
               
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

//    public function simpan_peramalan() {
//       
//        $data = $this->input->post(null, true);
//        extract($data);
//
//        $dataItem = array(
//            'id_obat' => $id_obat,
//            'tgl_awal_training' => $tgl_awal_training,
//            'tgl_akhir_training' => $tgl_akhir_training,
//            'jumlah_peramalan' => $jumlah_peramalan
//        );
//
//        if ($branchId = $this->mperamalan->save($dataItem)) {
//            redirect("pengadaanobat");
//        }
//    }

}
