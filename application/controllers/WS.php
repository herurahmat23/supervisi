<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WS extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('WS_model');
    }


    // WS
    public function loginWS()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == true) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $cek_un = $this->WS_model->cek_username($username);
            if ($cek_un->num_rows() > 0) {
                $hasil = $cek_un->row();
                if (password_verify($password, $hasil->password)) {
                    $array = array('status' => 'success', 'message' => 'Login Berhasil.', 'data' => $cek_un->row_array());
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






    public function UploadFotoProfil()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('foto', 'foto', 'trim|required|xss_clean');
        if ($this->form_validation->run() == true) {
            $username = $this->input->post('username');
            $foto = $this->input->post('foto');

            define('UPLOAD_DIR', 'profil/');

            $img = $_POST['image'];

            $img = str_replace('data:image/png;base64,', '', $foto);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $file = UPLOAD_DIR . $username . '.png';
            $success = file_put_contents($file, $data);

            $array = array('status' => 'success', 'message' => $success);
        } else {
            $array = array('status' => 'fail', 'message' => 'gagal: ' . validation_errors());
        }
        echo json_encode($array);
    }




    public function getRuangan()
    {
        $username = $this->input->post('username');
        $data = $this->WS_model->getRuangan($username);
        if ($data->num_rows() > 0) {
            $array = array('status' => 'success', 'message' => 'OK', 'data' => $data->result());
        } else {
            $array = array('status' => 'fail', 'message' => 'Data Tidak ditemukan');
        }
        echo json_encode($array);
    }


    public function getUserPerRuangan()
    {
        $id_ruangan = $this->input->post('id_ruangan');
        $data = $this->WS_model->getUserPerRuangan($id_ruangan);
        if ($data->num_rows() > 0) {
            $array = array('status' => 'success', 'message' => 'OK', 'data' => $data->result());
        } else {
            $array = array('status' => 'fail', 'message' => 'Data Tidak ditemukan');
        }
        echo json_encode($array);
    }


    public function getUserbyNik()
    {
        $nik = $this->input->post('nik');

        $cek_un = $this->WS_model->cek_username($nik);
        if ($cek_un->num_rows() > 0) {
            $array = array('status' => 'success', 'message' => 'Login Berhasil.', 'data' => $cek_un->row_array());
        } else {
            $array = array('status' => 'fail', 'message' => 'Login Gagal : NIK Tidak Terdaftar!.');
        }
        echo json_encode($array);
    }
}
