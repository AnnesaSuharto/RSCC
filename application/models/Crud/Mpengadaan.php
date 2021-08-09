<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mbarang
 *
 * @author annesams
 */
class Mpengadaan extends CI_Model {
    //untuk mengambil data dari database
    
    /*nama tabel obat
     * input NULL
     * return ALL data barang
     */
    function get_list_pengadaan() {
       $query = $this->db->query("SELECT p.id_pengadaan, p.tgl_pengadaan, p.tgl_awal_training, p.tgl_akhir_training, p.jumlah_peramalan, 
o.kode_obat, o.id_obat, o.nama_obat, p.jumlah_stok_akhir, p.jumlah_pengajuan FROM pengadaan p INNER JOIN obat o  ON p.id_obat = o.id_obat");
        return $query->result();
    }

     /*
     * input id_obat pada data tabel obat
     * return all data barang berdasarkan id_obat
     */
    function hitung($where, $table) {
        return $this->db->get_where($table, $where);
    }

    function update_hitung($where, $data, $table) {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    /*
     * insert nama_barang, alamat_barang, telp_barang pada data tabel obat
     * return TRUE/FALSE
     */
    function insert($data) {
        if ($this->db->insert('detail_pengadaan', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * update nama_barang, alamat_barang, telp_barang berdasarkan $id_obat pada data tabel obat
     * return TRUE/FALSE
     */
    function update($data, $id_pengadaan) {        
        $this->db->where('id_pengadaan', $id_pengadaan); //memasukkan berdasarkan id yg telah ada
        if ($this->db->update('pengadaan', $data)) { //proses untuk memasukan data yg baru
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * delete data tabel obat berdasarkan id_obat
     */
    function delete($id) {
        if ($this->db->delete('pengadaan', array('id_pengadaan' => $id))) {
            $this->session->set_userdata('tipeNotif', 'successDelete');
            return TRUE;
        } else {
            $this->session->set_userdata('tipeNotif', 'error');
            return FALSE;
        }
    }
    
     /*
     * menyimpan data baru/data edit pada data tabel obat berdasarkan id_obat
     */
    public function save($dataItem) {
        /*
         * apabila form id membawa id !=0 ini menandakan suatu data baru (Input data baru) 
         */
        
            if ($this->db->insert('detail_pengadaan', $dataItem)) {
                $this->session->set_userdata('tipeNotif', 'successAdd');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('tipeNotif', 'error');
                return FALSE;
            }
        
    }

}
