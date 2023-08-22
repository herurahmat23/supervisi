<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tentang_rs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_login')) {
            $this->session->set_flashdata('need_login', 'Anda Harus Login Terlebih Dahulu!');
            redirect('Login');
        }
    }

    public function index()
    {
        $header['title'] = "Tentang Rumah Sakit";
        $header['menu'] = "mn_tentang_rs";
        $data['data'] = $this->db->get_where('tentang_rs', ['id' => 1])->row();
        $this->load->view('template/Header', $header);
        $this->load->view('tentang_rs/Index', $data);
        $this->load->view('template/Footer');
    }

    public function load_data()
    {
        $data['data'] = $this->db->get_where('tentang_rs', ['id' => 1])->row();
        $this->load->view('tentang_rs/Data', $data);
    }

    public function update()
    {
        $this->form_validation->set_rules('nama', 'Nama Rumah Sakit', 'trim|required|xss_clean');
        $this->form_validation->set_rules('profil', 'Profil Rumah Sakit', 'trim|required|xss_clean');
        $this->form_validation->set_rules('visi', 'visi', 'trim|required|xss_clean');
        $this->form_validation->set_rules('misi', 'misi', 'trim|required|xss_clean');
        $this->form_validation->set_rules('motto', 'motto', 'trim|required|xss_clean');
        $this->form_validation->set_rules('maklumat_pelayanan', 'Maklumat Pelayanan', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'profil' => $this->input->post('profil'),
                'visi' => $this->input->post('visi'),
                'misi' => $this->input->post('misi'),
                'motto' => $this->input->post('motto'),
                'maklumat_pelayanan' => $this->input->post('maklumat_pelayanan'),
            ];
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tentang_rs', $data);
            $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
        }
        echo json_encode($array);
    }
}
