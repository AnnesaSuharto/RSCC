<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('crud/mlogin');
        $this->load->model('crud/mobat');
    }

    public function index() {
        $this->load->view('auth/vlogin');
    }

    public function aksi_login() {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $cek = $this->mlogin->cek();
        if ($cek > 0) {
            $data_session = array(
                'nama' => $username,
                'status' => "login"
            );
            $this->session->set_userdata($data_session);
            redirect('beranda');
        } else {
            echo "Username atau Password anda salah";
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('Auth');
    }

}
