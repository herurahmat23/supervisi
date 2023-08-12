<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
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
        $header['title'] = "Data Master";
        $header['menu'] = "mn_master";
        $this->load->view('template/Header', $header);
        $this->load->view('master/Index');
        $this->load->view('template/Footer');
    }

    public function jabatan()
    {
        $header['title'] = "Data Jabatan";
        $header['menu'] = "mn_master";
        $this->load->view('template/Header', $header);
        $this->load->view('master/jabatan/Index');
        $this->load->view('template/Footer');
    }

    public function load_data_jabatan()
    {
        $data['data'] = $this->db->get('jabatan')->result();
        $this->load->view('master/jabatan/Table', $data);
    }

    public function save_jabatan()
    {
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            $data = [
                'jabatan' => $this->input->post('jabatan')
            ];
            $this->db->insert('jabatan', $data);
            $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
        }
        echo json_encode($array);
    }

    public function update_jabatan()
    {
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            $data = [
                'jabatan' => $this->input->post('jabatan')
            ];
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('jabatan', $data);
            $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
        }
        echo json_encode($array);
    }

    public function delete_jabatan()
    {
        $this->db->where('id', $this->input->post('id'));
        $this->db->delete('jabatan');
        $array = array('status' => 'success', 'message' => 'Data Berhasil Dihapus.');
        echo json_encode($array);
    }

    public function ruangan()
    {
        $header['title'] = "Data Ruangan";
        $header['menu'] = "mn_master";
        $this->load->view('template/Header', $header);
        $this->load->view('master/ruangan/Index');
        $this->load->view('template/Footer');
    }

    public function load_data_ruangan()
    {
        $data['data'] = $this->db->get('ruangan')->result();
        $this->load->view('master/ruangan/Table', $data);
    }

    public function save_ruangan()
    {
        $this->form_validation->set_rules('ruangan', 'ruangan', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            $data = [
                'ruangan' => $this->input->post('ruangan')
            ];
            $this->db->insert('ruangan', $data);
            $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
        }
        echo json_encode($array);
    }

    public function update_ruangan()
    {
        $this->form_validation->set_rules('ruangan', 'Ruangan', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            $data = [
                'ruangan' => $this->input->post('ruangan')
            ];
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('ruangan', $data);
            $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
        }
        echo json_encode($array);
    }

    public function delete_ruangan()
    {
        $this->db->where('id', $this->input->post('id'));
        $this->db->delete('ruangan');
        $array = array('status' => 'success', 'message' => 'Data Berhasil Dihapus.');
        echo json_encode($array);
    }
}
