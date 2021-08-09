<?php

class Mlogin extends CI_Model {

    function cek_login($username, $password) {


        $this->db->where('username', $username);
        $this->db->where('password', $password);

        $query = $this->db->get('user');
        return $query->row(); //untuk memastikan baris dari query  tersebut ada
    }

    function cek() {
         $this->db->where('username', 'haiannesa');
//        $this->db->where('password', '21232f297a57a5a743894a0e4a801fc3');
        $query = $this->db->get('user');
        return $query->row();
    }

      function cek2() {
        $this->db->where('id_obat', 1);
        $query = $this->db->get('obat');
        return $query->row(); //untuk memastikan baris dari query  tersebut ada
    }
}

?>