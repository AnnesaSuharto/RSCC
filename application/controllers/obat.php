<?php

//
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') != "login") {
            redirect("auth");
        }
        $this->load->model('crud/mobat');
    }

    public function index() {
        $data['obat'] = $this->mobat->get_list_obat();
        $data['title'] = 'obat/title';
        $data['konten'] = 'obat/vobat';
        $this->load->view('template/template',$data);
    }
    

    public function form($id = 0) {
        if ($this->input->post('submitObat')) {
            $input = $this->input->post(NULL, TRUE);
            extract($input);

            if (isset($id_obat)) {
                $idObat = $id_obat;
            }
            $dataItem = array(
                'kode_obat'     => $kode_obat,
                'nama_obat'     => $nama_obat,
                'satuan'        => $satuan,
                'harga_beli'    => $harga_beli,
                'harga_jual'    => $harga_jual,
                'kandungan'     => $kandungan
            );
            
            if ($branchId = $this->save($dataItem, $idObat)) {
                redirect("obat");
            }
        } else {
            $obj = new stdClass();
            $obj->id_obat = $id;
            $obj->kode_obat = '';
            $obj->nama_obat = '';
            $obj->satuan = '';
            $obj->harga_beli = '';
            $obj->harga_jual = '';
            $obj->kandungan = '';

            // Ubah
            if ($id != 0) {
                $obj = $this->mobat->get_by_id($id);
            }
            $data['data'] = $obj; //obat
            $data['title'] = 'obat/title';
            $data['konten'] = 'obat/vform';
            $this->load->view('template/template', $data);
        }
    }
    
    private function save($data, $idObat = 0) {
        return $this->mobat->saveData($data, $idObat);
    }
    
    function delete($id) {
        if ($this->mobat->delete($id)) {
            redirect('obat'); 
        }
    }

}
