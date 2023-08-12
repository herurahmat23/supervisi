<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
        $header['title'] = "Dashboard";
        $header['menu'] = "mn_dashboard";
        $this->load->view('template/Header', $header);
        $this->load->view('Dashboard');
        $this->load->view('template/Footer');
    }
}
