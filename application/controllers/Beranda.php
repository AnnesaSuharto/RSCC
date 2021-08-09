<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Beranda
 *
 * @author Annesa
 */
class Beranda extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') != "login") {
            redirect("auth");
        }
    }

    function index() {
//        $data['obat'] = $this->mobat->get_list_obat();
        $data['title'] = 'template/title';
        $data['konten'] = 'template/vberanda';
        $this->load->view('template/template', $data);
    }

}
