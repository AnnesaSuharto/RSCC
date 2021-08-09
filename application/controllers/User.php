<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Akun
 *
 * @author Annesa
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') != "login") {
            redirect("auth");
        }
        $this->load->model('crud/muser');
    }

    public function index() {
        $data['user'] = $this->muser->get_list_user();
        $data['title'] = 'user/title';
        $data['konten'] = 'user/vuser';
        $this->load->view('template/template', $data);
    }
    
     public function form($id = 0) {
        if ($this->input->post('submitUser')) {
            $input = $this->input->post(NULL, TRUE);
            extract($input);

            if (isset($id)) {
                $idUser = $id;
            }
            $dataItem = array(
                'nama'          => $nama,
                'email'         => $email,
                'password'      => $password
            );
            
            if ($branchId = $this->save($dataItem, $idUser)) {
                redirect("user");
            }
        } else {
            $obj = new stdClass();
            $obj->id = $id;
            $obj->nama = '';
            $obj->email = '';
            $obj->password = '';

            // Ubah
            if ($id != 0) {
                $obj = $this->muser->get_by_id($id);
            }
            $data['data'] = $obj; //obat
            $data['title'] = 'user/title';
            $data['konten'] = 'user/vform';
            $this->load->view('template/template', $data);
        }
    }
    
    private function save($data, $idUser = 0) {
        return $this->muser->saveData($data, $idUser);
    }
    
    function delete($id) {
        if ($this->muser->delete($id)) {
            redirect('user'); 
        }
    }

}
