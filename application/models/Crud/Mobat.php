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
class Mobat extends CI_Model {
    //untuk mengambil data dari database
    
    /*nama tabel obat
     * input NULL
     * return ALL data barang
     */
    function get_list_obat() {
        $query = $this->db->get('obat');
        return $query->result();
    }
    
    function get_data_obat() {
        $this->db->select('*');
        $this->db->from('alpha');
        $this->db->join('obat', 'obat.id_obat = alpha.id_obat');
        $query = $this->db->get();
        return $query->result();
    }

     /*
     * input id_obat pada data tabel obat
     * return all data barang berdasarkan id_obat
     */
    function get_by_id($id) {
        $this->db->where('id_obat', $id);
        $query = $this->db->get('obat');
        return $query->row(); //untuk memastikan baris dari query  tersebut ada
    }

    /*
     * insert nama_barang, alamat_barang, telp_barang pada data tabel obat
     * return TRUE/FALSE
     */
    function insert($data) {
        if ($this->db->insert('obat', $data)) {
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
        $this->db->where('id_obat', $id); //memasukkan berdasarkan id yg telah ada
        if ($this->db->update('obat', $data)) { //proses untuk memasukan data yg baru
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * delete data tabel obat berdasarkan id_obat
     */
    function delete($id) {
        if ($this->db->delete('obat', array('id_obat' => $id))) {
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
    public function saveData($data, $idObat = 0) {
        /*
         * apabila form id membawa id !=0 ini menandakan suatu data baru (Input data baru) 
         */
        if ($idObat != 0) {

            $this->db->where('id_obat', $idObat);

            if ($this->db->update('obat', $data)) {
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
            if ($this->db->insert('obat', $data)) {
                $this->session->set_userdata('tipeNotif', 'successAdd');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('tipeNotif', 'error');
                return FALSE;
            }
        }
    }

}
