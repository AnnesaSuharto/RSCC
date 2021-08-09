<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mperamalan
 *
 * @author Annesa
 */
class Mperamalan extends CI_Model {
    //put your code here
    function get_list_transaksi() {
//        $this->db->select('data');
//        $query = $this->db->get('test');
        $query = $this->db->query("SELECT SUM(jumlah) AS jumlah FROM rekap_transaksi WHERE id_obat = '109' AND tanggal BETWEEN '" . $value . "' AND '" . date('Y-m-d 23:59:59', strtotime('+29 days', strtotime($value))) . "'")->result_array();

        return $query->result();
    }
     public function save($dataItem) {
        /*
         * apabila form id membawa id !=0 ini menandakan suatu data baru (Input data baru) 
         */
        
            if ($this->db->insert('pengadaan', $dataItem)) {
                $this->session->set_userdata('tipeNotif', 'successAdd');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('tipeNotif', 'error');
                return FALSE;
            }
        
    }

}
