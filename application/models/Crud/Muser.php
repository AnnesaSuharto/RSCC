<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Makun
 *
 * @author Annesa
 */
class Muser extends CI_Model {
    //put your code here
     function get_list_user() {
        $query = $this->db->get('user');
        return $query->result();
    }
    
    function get_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('user');
        return $query->row(); //untuk memastikan baris dari query  tersebut ada
    }
    
    function insert($data) {
        if ($this->db->insert('user', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * update nama_barang, alamat_barang, telp_barang berdasarkan $id_user pada data tabel user
     * return TRUE/FALSE
     */
    function update($data, $id) {        
        $this->db->where('id', $id); //memasukkan berdasarkan id yg telah ada
        if ($this->db->update('user', $data)) { //proses untuk memasukan data yg baru
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * delete data tabel user berdasarkan id
     */
    function delete($id) {
        if ($this->db->delete('user', array('id' => $id))) {
            $this->session->set_userdata('tipeNotif', 'successDelete');
            return TRUE;
        } else {
            $this->session->set_userdata('tipeNotif', 'error');
            return FALSE;
        }
    }
    
     /*
     * menyimpan data baru/data edit pada data tabel user berdasarkan id
     */
    public function saveData($data, $idUser = 0) {
        /*
         * apabila form id membawa id !=0 ini menandakan suatu data baru (Input data baru) 
         */
        if ($idUser != 0) {

            $this->db->where('id', $idUser);

            if ($this->db->update('user', $data)) {
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
            if ($this->db->insert('user', $data)) {
                $this->session->set_userdata('tipeNotif', 'successAdd');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('tipeNotif', 'error');
                return FALSE;
            }
        }
    }
}
