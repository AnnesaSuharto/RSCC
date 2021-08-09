<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pengadaanobat
 *
 * @author Annesa
 */
class Pengadaanobat extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') != "login") {
            redirect("auth");
        }
        $this->load->model('crud/mpengadaan');
    }

    public function index() {
        $data['pengadaan'] = $this->mpengadaan->get_list_pengadaan();
        $data['title'] = 'pengadaan/title';
        $data['konten'] = 'pengadaan/vpengadaan';
        $this->load->view('template/template', $data);
    }

    function delete($id) {
        if ($this->mpengadaan->delete($id)) {
            redirect('Pengadaanobat');
        }
    }

    public function update_hitung() {
        $id_pengadaan = $this->input->post('id_pengadaan');
        $jumlah_peramalan = $this->input->post('jumlah_peramalan');
        $jumlah_stok_akhir = $this->input->post('jumlah_stok_akhir');
        $jumlah_pengajuan = $this->input->post('jumlah_pengajuan');
       // $jumlah_pengajuan = $jumlah_stok_akhir - $jumlah_peramalan;
        
        $data = array(
          'jumlah_peramalan'  => $jumlah_peramalan,
          'jumlah_stok_akhir' => $jumlah_stok_akhir,
          'jumlah_pengajuan'  => $jumlah_pengajuan  
        );
        $where = array(
          'id_pengadaan' => $id_pengadaan  
        );
        $this->mpengadaan->update_hitung($where, $data, 'pengadaan');
        redirect('Pengadaanobat');
    }
    public function hitung($id) {
       $where = array('id_pengadaan' => $id);
       $data['pengadaan'] = $this->mpengadaan->hitung($where, 'pengadaan')->result();
       $data['title'] = 'pengadaan/title';
       $data['konten'] = 'pengadaan/vhitung';
       $this->load->view('template/template', $data);
        
    }
    
}
