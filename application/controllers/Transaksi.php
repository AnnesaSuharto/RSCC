<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transaksi
 *
 * @author Annesa
 */
class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') != "login") {
            redirect("auth");
        }
        $this->load->model('crud/mtransaksi');
        $this->load->model('crud/mobat');
    }

    //put your code here
    public function index() {
        $id_obat = $this->input->get('id_obat');
//        $id_obat = 2;
        $query = $this->db->query("SELECT COUNT(*) AS jumlah, tanggal, o.nama_obat FROM rekap_transaksi rt INNER JOIN obat o ON rt.id_obat = o.id_obat "
                        . "WHERE rt.id_obat = '" . $id_obat . "' GROUP BY YEAR(tanggal),MONTH(tanggal)")->result_array();
//        echo "<pre>";
//        var_dump($query);
//exit();
        $data['tampil'] = $query;
        $data['obat'] = $this->mobat->get_list_obat();
        $data['title'] = 'transaksi/title';
        $data['konten'] = 'transaksi/vtransaksi';
        $this->load->view('template/template', $data);
    }

    public function form($id = 0) {
        if ($this->input->post('submitTransaksi')) {
            $input = $this->input->post(NULL, TRUE);
            extract($input);

            if (isset($id_rekap)) {
                $id_rekap = $id_rekap;
            }
            $dataItem = array(
                'id_rekap' => $id_rekap,
                'tanggal' => $tanggal,
                'jumlah' => $jumlah,
                'id_obat' => $id_obat
            );

            if ($branchId = $this->save($dataItem, $id_rekap)) {
                redirect("transaksi");
            }
        } else {
            $obj = new stdClass();
            $obj->id_rekap = $id;
            $obj->tanggal = '';
            $obj->jumlah = '';
            $obj->id_obat = '';

            // Ubah
            if ($id != 0) {
                $obj = $this->mtransaksi->get_by_id($id);
            }
            $data['transaksi'] = $obj; //obat
            $data['title'] = 'transaksi/title';
            $data['konten'] = 'transaksi/vform';
            $this->load->view('template/template', $data);
        }
    }

    private function save($data, $id_rekap = 0) {
        return $this->mtransaksi->saveData($data, $id_rekap);
    }

    function delete($id) {
        if ($this->mtransaksi->delete($id)) {
            redirect('transaksi');
        }
    }

}
