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
        $this->load->model('Instrumen_penilaian_model');
    }

    public function index()
    {
        $header['title'] = "Instrumen Penilaian";
        $header['menu'] = "mn_instrumen";
        $this->load->view('template/Header', $header);
        $this->load->view('instrumen_penilaian/Index');
        $this->load->view('template/Footer');
    }

    // public function instrumen_pengetahuan()
    // {
    //     $header['title'] = "Instrumen Pengetahuan tentang Supervisi Klinik 4S";
    //     $header['menu'] = "mn_instrumen";
    //     $this->load->view('template/Header', $header);
    //     $this->load->view('instrumen_penilaian/instrumen_pengetahuan/Index');
    //     $this->load->view('template/Footer');
    // }

    // public function load_instrumen_pengetahuan()
    // {
    //     $data['data'] = $this->db->order_by('no', 'ASC')->get('soal_instrumen_pengetahuan')->result();
    //     $this->load->view('instrumen_penilaian/instrumen_pengetahuan/Table', $data);
    // }

    // public function save_instrumen_pengetahuan()
    // {
    //     $this->form_validation->set_rules('no', 'No Soal', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('soal', 'Soal', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('pilihan_a', 'Pilihan A', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('pilihan_b', 'Pilihan B', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('pilihan_c', 'Pilihan C', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('pilihan_d', 'Pilihan D', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('nilai_a', 'Nilai A', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('nilai_b', 'Nilai B', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('nilai_c', 'Nilai C', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('nilai_d', 'Nilai D', 'trim|required|xss_clean');

    //     if ($this->form_validation->run() == false) {
    //         $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
    //     } else {
    //         $data = [
    //             'no' => $this->input->post('no'),
    //             'soal' => $this->input->post('soal'),
    //             'pilihan_a' => $this->input->post('pilihan_a'),
    //             'pilihan_b' => $this->input->post('pilihan_b'),
    //             'pilihan_c' => $this->input->post('pilihan_c'),
    //             'pilihan_d' => $this->input->post('pilihan_d'),
    //             'nilai_a' => $this->input->post('nilai_a'),
    //             'nilai_b' => $this->input->post('nilai_b'),
    //             'nilai_c' => $this->input->post('nilai_c'),
    //             'nilai_d' => $this->input->post('nilai_d'),
    //         ];
    //         $this->db->insert('soal_instrumen_pengetahuan', $data);
    //         $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
    //     }
    //     echo json_encode($array);
    // }

    // public function get_by_id_instrumen_pengetahuan()
    // {
    //     $id = $this->input->post('id');
    //     $data = $this->db->get_where('soal_instrumen_pengetahuan', ['id' => $id])->row();
    //     echo json_encode($data);
    // }

    // public function update_instrumen_pengetahuan()
    // {
    //     $this->form_validation->set_rules('no', 'No Soal', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('soal', 'Soal', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('pilihan_a', 'Pilihan A', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('pilihan_b', 'Pilihan B', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('pilihan_c', 'Pilihan C', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('pilihan_d', 'Pilihan D', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('nilai_a', 'Nilai A', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('nilai_b', 'Nilai B', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('nilai_c', 'Nilai C', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('nilai_d', 'Nilai D', 'trim|required|xss_clean');

    //     if ($this->form_validation->run() == false) {
    //         $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
    //     } else {
    //         $data = [
    //             'no' => $this->input->post('no'),
    //             'soal' => $this->input->post('soal'),
    //             'pilihan_a' => $this->input->post('pilihan_a'),
    //             'pilihan_b' => $this->input->post('pilihan_b'),
    //             'pilihan_c' => $this->input->post('pilihan_c'),
    //             'pilihan_d' => $this->input->post('pilihan_d'),
    //             'nilai_a' => $this->input->post('nilai_a'),
    //             'nilai_b' => $this->input->post('nilai_b'),
    //             'nilai_c' => $this->input->post('nilai_c'),
    //             'nilai_d' => $this->input->post('nilai_d'),
    //         ];
    //         $this->db->where('id', $this->input->post('id'));
    //         $this->db->update('soal_instrumen_pengetahuan', $data);
    //         $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
    //     }
    //     echo json_encode($array);
    // }

    // public function delete_instrumen_pengetahuan()
    // {
    //     $this->db->where('id', $this->input->post('id'));
    //     $this->db->delete('soal_instrumen_pengetahuan');
    //     $array = array('status' => 'success', 'message' => 'Data Berhasil Dihapus.');
    //     echo json_encode($array);
    // }

    public function kategori_instrumen_skp()
    {
        $header['title'] = "Kategori Instrumen Sasaran Keselamatan Pasien";
        $header['menu'] = "mn_instrumen";
        $this->load->view('template/Header', $header);
        $this->load->view('instrumen_penilaian/kategori_instrumen_skp/Index');
        $this->load->view('template/Footer');
    }

    public function load_kategori_instrumen_skp()
    {
        $data['data'] = $this->db->order_by('no', 'ASC')->get('kategori_instrumen_skp')->result();
        $this->load->view('instrumen_penilaian/kategori_instrumen_skp/Table', $data);
    }

    public function save_kategori_instrumen_skp()
    {
        $this->form_validation->set_rules('no', 'No Kategori', 'trim|required|xss_clean');
        $this->form_validation->set_rules('kategori', 'Kategori', 'trim|required|xss_clean');
        $this->form_validation->set_rules('jenis', 'Jenis', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            $data = [
                'no' => $this->input->post('no'),
                'kategori' => $this->input->post('kategori'),
                'jenis' => $this->input->post('jenis')
            ];
            $this->db->insert('kategori_instrumen_skp', $data);
            $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
        }
        echo json_encode($array);
    }

    // public function get_by_id_kategori_instrumen_skp()
    // {
    //     $id = $this->input->post('id');
    //     $data = $this->db->get_where('kategori_instrumen_skp', ['id' => $id])->row();
    //     echo json_encode($data);
    // }

    public function update_kategori_instrumen_skp()
    {
        $this->form_validation->set_rules('no', 'No Kategori', 'trim|required|xss_clean');
        $this->form_validation->set_rules('kategori', 'Kategori', 'trim|required|xss_clean');
        $this->form_validation->set_rules('jenis', 'Kategori', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            $data = [
                'no' => $this->input->post('no'),
                'kategori' => $this->input->post('kategori'),
                'jenis' => $this->input->post('jenis')
            ];
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('kategori_instrumen_skp', $data);
            $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
        }
        echo json_encode($array);
    }

    public function delete_kategori_instrumen_skp()
    {
        $this->db->where('id', $this->input->post('id'));
        $this->db->delete('kategori_instrumen_skp');
        $array = array('status' => 'success', 'message' => 'Data Berhasil Dihapus.');
        echo json_encode($array);
    }

    public function instrumen_skp()
    {
        $header['title'] = "Instrumen Sasaran Keselamatan Pasien";
        $header['menu'] = "mn_instrumen";
        $data['kategori'] = $this->db->get('kategori_instrumen_skp')->result();
        $this->load->view('template/Header', $header);
        $this->load->view('instrumen_penilaian/instrumen_skp/Index', $data);
        $this->load->view('template/Footer');
    }

    public function load_instrumen_skp()
    {
        $data['data'] = $this->Instrumen_penilaian_model->get_instrumen_skp()->result();
        $this->load->view('instrumen_penilaian/instrumen_skp/Table', $data);
    }

    public function save_instrumen_skp()
    {
        $this->form_validation->set_rules('no', 'No Kategori', 'trim|required|xss_clean');
        $this->form_validation->set_rules('kategori', 'Kategori', 'trim|required|xss_clean');
        $this->form_validation->set_rules('instrumen', 'instrumen', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            $data = [
                'no' => $this->input->post('no'),
                'kategori' => $this->input->post('kategori'),
                'instrumen' => $this->input->post('instrumen')
            ];
            $this->db->insert('instrumen_skp', $data);
            $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
        }
        echo json_encode($array);
    }

    // public function get_by_id_instrumen_skp()
    // {
    //     $id = $this->input->post('id');
    //     $data = $this->db->get_where('instrumen_skp', ['id' => $id])->row();
    //     echo json_encode($data);
    // }

    public function update_instrumen_skp()
    {
        $this->form_validation->set_rules('no', 'No Kategori', 'trim|required|xss_clean');
        $this->form_validation->set_rules('kategori', 'Kategori', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            $data = [
                'no' => $this->input->post('no'),
                'kategori' => $this->input->post('kategori'),
                'instrumen' => $this->input->post('instrumen')
            ];
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('instrumen_skp', $data);
            $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
        }
        echo json_encode($array);
    }

    public function delete_instrumen_skp()
    {
        $this->db->where('id', $this->input->post('id'));
        $this->db->delete('instrumen_skp');
        $array = array('status' => 'success', 'message' => 'Data Berhasil Dihapus.');
        echo json_encode($array);
    }

    // Instrumen Evaluasi ---------------------------------------------------------------------------------------------------

    public function instrumen_evaluasi()
    {
        $header['title'] = "Instrumen Evaluasi Aktivitas Supervisi";
        $header['menu'] = "mn_instrumen";
        $this->load->view('template/Header', $header);
        $this->load->view('instrumen_penilaian/instrumen_evaluasi/Index');
        $this->load->view('template/Footer');
    }

    public function load_instrumen_evaluasi()
    {
        $data['data'] = $this->Instrumen_penilaian_model->get_instrumen_evaluasi()->result();
        $this->load->view('instrumen_penilaian/instrumen_evaluasi/Table', $data);
    }

    public function save_instrumen_evaluasi()
    {
        $this->form_validation->set_rules('no', 'No Kategori', 'trim|required|xss_clean');
        $this->form_validation->set_rules('instrumen', 'instrumen', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            $data = [
                'no' => $this->input->post('no'),
                'instrumen' => $this->input->post('instrumen')
            ];
            $this->db->insert('instrumen_evaluasi', $data);
            $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
        }
        echo json_encode($array);
    }

    // public function get_by_id_instrumen_evaluasi()
    // {
    //     $id = $this->input->post('id');
    //     $data = $this->db->get_where('instrumen_evaluasi', ['id' => $id])->row();
    //     echo json_encode($data);
    // }

    public function update_instrumen_evaluasi()
    {
        $this->form_validation->set_rules('no', 'No Kategori', 'trim|required|xss_clean');
        $this->form_validation->set_rules('instrumen', 'instrumen', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            $data = [
                'no' => $this->input->post('no'),
                'instrumen' => $this->input->post('instrumen')
            ];
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('instrumen_evaluasi', $data);
            $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
        }
        echo json_encode($array);
    }

    public function delete_instrumen_evaluasi()
    {
        $this->db->where('id', $this->input->post('id'));
        $this->db->delete('instrumen_evaluasi');
        $array = array('status' => 'success', 'message' => 'Data Berhasil Dihapus.');
        echo json_encode($array);
    }

    // Instrumen Kepala ruangan ---------------------------------------------------------------------------------------------------

    public function instrumen_karu()
    {
        $header['title'] = "Instrumen Penilaian Kepala Ruang";
        $header['menu'] = "mn_instrumen";
        $this->load->view('template/Header', $header);
        $this->load->view('instrumen_penilaian/instrumen_karu/Index');
        $this->load->view('template/Footer');
    }

    // Instrumen Kepala Tim  ---------------------------------------------------------------------------------------------------

    public function instrumen_katim()
    {
        $header['title'] = "Instrumen Penilaian Ketua Tim";
        $header['menu'] = "mn_instrumen";
        $this->load->view('template/Header', $header);
        $this->load->view('instrumen_penilaian/instrumen_katim/Index');
        $this->load->view('template/Footer');
    }
}
