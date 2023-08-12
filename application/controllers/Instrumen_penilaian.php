<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Instrumen_penilaian extends CI_Controller
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
        $header['title'] = "Instrumen Penilaian";
        $header['menu'] = "mn_instrumen";
        $this->load->view('template/Header', $header);
        $this->load->view('instrumen_penilaian/Index');
        $this->load->view('template/Footer');
    }

    public function instrumen_pengetahuan()
    {
        $header['title'] = "Instrumen Pengetahuan tentang Supervisi Klinik 4S";
        $header['menu'] = "mn_instrumen";
        $this->load->view('template/Header', $header);
        $this->load->view('instrumen_penilaian/instrumen_pengetahuan/Index');
        $this->load->view('template/Footer');
    }

    public function load_instrumen_pengetahuan()
    {
        $data['data'] = $this->db->order_by('no', 'ASC')->get('soal_instrumen_pengetahuan')->result();
        $this->load->view('instrumen_penilaian/instrumen_pengetahuan/Table', $data);
    }

    public function save_instrumen_pengetahuan()
    {
        $this->form_validation->set_rules('no', 'No Soal', 'trim|required|xss_clean');
        $this->form_validation->set_rules('soal', 'Soal', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pilihan_a', 'Pilihan A', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pilihan_b', 'Pilihan B', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pilihan_c', 'Pilihan C', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pilihan_d', 'Pilihan D', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nilai_a', 'Nilai A', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nilai_b', 'Nilai B', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nilai_c', 'Nilai C', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nilai_d', 'Nilai D', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            $data = [
                'no' => $this->input->post('no'),
                'soal' => $this->input->post('soal'),
                'pilihan_a' => $this->input->post('pilihan_a'),
                'pilihan_b' => $this->input->post('pilihan_b'),
                'pilihan_c' => $this->input->post('pilihan_c'),
                'pilihan_d' => $this->input->post('pilihan_d'),
                'nilai_a' => $this->input->post('nilai_a'),
                'nilai_b' => $this->input->post('nilai_b'),
                'nilai_c' => $this->input->post('nilai_c'),
                'nilai_d' => $this->input->post('nilai_d'),
            ];
            $this->db->insert('soal_instrumen_pengetahuan', $data);
            $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
        }
        echo json_encode($array);
    }

    public function get_by_id_instrumen_pengetahuan()
    {
        $id = $this->input->post('id');
        $data = $this->db->get_where('soal_instrumen_pengetahuan', ['id' => $id])->row();
        echo json_encode($data);
    }

    public function update_instrumen_pengetahuan()
    {
        $this->form_validation->set_rules('no', 'No Soal', 'trim|required|xss_clean');
        $this->form_validation->set_rules('soal', 'Soal', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pilihan_a', 'Pilihan A', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pilihan_b', 'Pilihan B', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pilihan_c', 'Pilihan C', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pilihan_d', 'Pilihan D', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nilai_a', 'Nilai A', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nilai_b', 'Nilai B', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nilai_c', 'Nilai C', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nilai_d', 'Nilai D', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            $data = [
                'no' => $this->input->post('no'),
                'soal' => $this->input->post('soal'),
                'pilihan_a' => $this->input->post('pilihan_a'),
                'pilihan_b' => $this->input->post('pilihan_b'),
                'pilihan_c' => $this->input->post('pilihan_c'),
                'pilihan_d' => $this->input->post('pilihan_d'),
                'nilai_a' => $this->input->post('nilai_a'),
                'nilai_b' => $this->input->post('nilai_b'),
                'nilai_c' => $this->input->post('nilai_c'),
                'nilai_d' => $this->input->post('nilai_d'),
            ];
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('soal_instrumen_pengetahuan', $data);
            $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
        }
        echo json_encode($array);
    }

    public function delete_instrumen_pengetahuan()
    {
        $this->db->where('id', $this->input->post('id'));
        $this->db->delete('soal_instrumen_pengetahuan');
        $array = array('status' => 'success', 'message' => 'Data Berhasil Dihapus.');
        echo json_encode($array);
    }
}
