<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_login')) {
            $this->session->set_flashdata('need_login', 'Anda Harus Login Terlebih Dahulu!');
            redirect('Login');
        }
        $this->load->model('User_model');
    }

    public function index()
    {
        $header['title'] = "Data User";
        $header['menu'] = "mn_user";
        $data['role'] = $this->db->get('role')->result();
        $this->load->view('template/Header', $header);
        $this->load->view('user/Index', $data);
        $this->load->view('template/Footer');
    }

    public function load_data()
    {
        $data['data'] = $this->User_model->getData();
        $this->load->view('user/Table', $data);
    }

    public function save()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
        $this->form_validation->set_rules('role', 'Role', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            $data = [
                'nik' => $this->input->post('nik'),
                'nama' => $this->input->post('nama'),
                'role' => $this->input->post('role'),
                'password' => password_hash("siatan123", PASSWORD_DEFAULT),
            ];
            $this->db->insert('user', $data);
            $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
        }
        echo json_encode($array);
    }

    public function update()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
        $this->form_validation->set_rules('role', 'Role', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            $data = [
                'nik' => $this->input->post('nik'),
                'nama' => $this->input->post('nama'),
                'role' => $this->input->post('role')
            ];
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('user', $data);
            $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
        }
        echo json_encode($array);
    }

    public function edit_password()
    {
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            $data = [
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            ];
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('user', $data);
            $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
        }
        echo json_encode($array);
    }

    public function delete()
    {
        $this->db->where('id', $this->input->post('id'));
        $this->db->delete('user');
        $array = array('status' => 'success', 'message' => 'Data Berhasil Dihapus.');
        echo json_encode($array);
    }
}
