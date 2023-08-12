<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
    }

    public function index()
    {
        $this->load->view('template/Login');
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == true) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $cek_un = $this->Login_model->cek_username($username);
            if ($cek_un->num_rows() > 0) {
                $hasil = $cek_un->row();
                if (password_verify($password, $hasil->password)) {
                    $this->session->set_userdata('id', $hasil->id);
                    $this->session->set_userdata('nama', $hasil->nama);
                    $this->session->set_userdata('nik', $hasil->nik);
                    $this->session->set_userdata('id_role', $hasil->id_role);
                    $this->session->set_userdata('nama_role', $hasil->nama_role);
                    $this->session->set_userdata('is_login', TRUE);
                    $this->session->set_flashdata('success_login', 'message');

                    $array = array('status' => 'success', 'message' => 'Login Berhasil.');
                } else {
                    $array = array('status' => 'fail', 'message' => 'Login Gagal : Password Anda Salah!.');
                }
            } else {
                $array = array('status' => 'fail', 'message' => 'Login Gagal : NIK Tidak Terdaftar!.');
            }
        } else {
            $array = array('status' => 'fail', 'message' => 'Login gagal: ' . validation_errors());
        }
        echo json_encode($array);
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('Login');
    }
}
