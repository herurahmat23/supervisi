<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kebijakan extends CI_Controller
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
        $header['title'] = "Kebijakan";
        $header['menu'] = "mn_kebijakan";
        $this->load->view('template/Header', $header);
        $this->load->view('kebijakan/Index');
        $this->load->view('template/Footer');
    }

    public function load_data()
    {
        $data['data'] = $this->db->get('kebijakan')->result();
        $this->load->view('kebijakan/Table', $data);
    }

    public function save()
    {
        $this->load->library('upload');
        $this->form_validation->set_rules('nama', 'Judul Dokumen', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            $config['upload_path']          = './uploads/kebijakan';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 5000;
            $config['overwrite']            = true;
            $config['encrypt_name']         = true;
            $this->upload->initialize($config);

            if (!empty($_FILES['file']['name'])) {
                if ($this->upload->do_upload('file')) {
                    $new_name = $this->upload->data('file_name');
                    $data = [
                        'nama' => $this->input->post('nama'),
                        'file' => $new_name
                    ];
                    $this->db->insert('kebijakan', $data);
                    $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
                } else {
                    $array = array('status' => 'fail', 'message' => 'Upload Foto gagal: ' . $this->upload->display_errors());
                }
            } else {
                $array = array('status' => 'fail', 'message' => 'File Belum Dipilih.');
            }
        }
        echo json_encode($array);
    }

    public function delete()
    {
        $this->db->select('file');
        $query = $this->db->get_where('kebijakan', array('id' => $this->input->post('id')))->row();
        unlink(FCPATH . 'uploads/kebijakan/' . $query->file);
        $this->db->where('id', $this->input->post('id'));
        $this->db->delete('kebijakan');
        $array = array('status' => 'success', 'message' => 'Data Berhasil Dihapus.');
        echo json_encode($array);
    }
}
