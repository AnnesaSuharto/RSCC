<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mtransaksi
 *
 * @author Annesa
 */
class Mtransaksi extends CI_Model {

    //put your code here
    
    function get_list_transaksi() {
//        $this->db->select('data');
//        $query = $this->db->get('test');
        $query = $this->db->query("SELECT rt.id_rekap, rt.tanggal, rt.jumlah, rt.id_obat, o.nama_obat FROM rekap_transaksi rt
                                   INNER JOIN obat o ON rt.id_obat = o.id_obat limit 100");

        return $query->result();
    }
    
    function jumlah_data($bulan) {
        $query = $this->db->query("SELECT rt.id_rekap, rt.tanggal, rt.jumlah, rt.id_obat, o.nama_obat FROM rekap_transaksi rt
                                   INNER JOIN obat o ON rt.id_obat = o.id_obat where month(tanggal)='" . $bulan . "' limit 100  ");
        //     $sql = " ";
        //     $query = $this->db->get('rekap_transaksi', 10);
        return $query->result();
    }
    
    function get_by_id($id) {
        $this->db->where('id_rekap', $id);
        $query = $this->db->get('rekap_transaksi');
        return $query->row(); //untuk memastikan baris dari query  tersebut ada
    }

    /*
     * insert nama_barang, alamat_barang, telp_barang pada data tabel obat
     * return TRUE/FALSE
     */
    function insert($data) {
        if ($this->db->insert('rekap_transaksi', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * update nama_barang, alamat_barang, telp_barang berdasarkan $id_obat pada data tabel obat
     * return TRUE/FALSE
     */
    function update($data, $id) {        
        $this->db->where('id_rekap', $id); //memasukkan berdasarkan id yg telah ada
        if ($this->db->update('rekap_transaksi', $data)) { //proses untuk memasukan data yg baru
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
     public function saveData($data, $id_rekap = 0) {
        /*
         * apabila form id membawa id !=0 ini menandakan suatu data baru (Input data baru) 
         */
        if ($id_rekap != 0) {

            $this->db->where('rekap_transaksi', $id_rekap);

            if ($this->db->update('rekap_transaksi', $data)) {
                $this->session->set_userdata('tipeNotif', 'successEdit');
                return TRUE;
            } else {
                $this->session->set_userdata('tipeNotif', 'error');
                return FALSE;
            }
        } 
        /*
         * apabila form id membawa id =0 ini menandakan mengedit suatu data
         */
        else {
            if ($this->db->insert('rekap_transaksi', $data)) {
                $this->session->set_userdata('tipeNotif', 'successAdd');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('tipeNotif', 'error');
                return FALSE;
            }
        }
    }
    
    function delete($id) {
        if ($this->db->delete('rekap_transaksi', array('id_rekap' => $id))) {
            $this->session->set_userdata('tipeNotif', 'successDelete');
            return TRUE;
        } else {
            $this->session->set_userdata('tipeNotif', 'error');
            return FALSE;
        }
    }

}
