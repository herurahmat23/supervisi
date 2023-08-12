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
}
