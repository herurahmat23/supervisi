<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Grafik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_login')) {
            $this->session->set_flashdata('need_login', 'Anda Harus Login Terlebih Dahulu!');
            redirect('Login');
        }
        $this->load->model('Grafik_model');
    }

    public function index()
    {
        $header['title'] = "Grafik Hasil Supervisi";
        $header['menu'] = "mn_grafik";
        $data['ruangan'] = $this->db->get('ruangan')->result();
        $this->load->view('template/Header', $header);
        $this->load->view('grafik/Index', $data);
        $this->load->view('template/Footer');
    }

    public function get_grafik_rata_individu()
    {
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        $ruangan = $this->input->post('ruangan');

        $user_peruangan = $this->db->get_where('user', ['ruangan' => $ruangan])->result();

        $grafik = [];

        foreach ($user_peruangan as $u) {
            $get = $this->Grafik_model->get_rata2_individu($tahun, $bulan, $ruangan, $u->id);
            $cek_row = $get->num_rows();
            $total = 0;

            if ($cek_row > 0) {
                foreach ($get->result() as $row) {
                    $total += $row->nilai;
                }
                $rata = $total / $cek_row;
            } else {
                $rata = 0;
            }

            $grafik[] = [
                'rata2' => round($rata, 2),
                'nama' => $u->nama
            ];
        }

        echo json_encode($grafik);
    }

    public function get_grafik_rata_skp()
    {
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        $ruangan = $this->input->post('ruangan');

        $skp = $this->db->order_by('id', 'ASC')->get('kategori_instrumen_skp')->result();

        $grafik = [];

        foreach ($skp as $u) {
            $get = $this->Grafik_model->get_rata2_skp($tahun, $bulan, $ruangan, $u->id);
            $cek_row = $get->num_rows();
            $total = 0;

            if ($cek_row > 0) {
                foreach ($get->result() as $row) {
                    $total += $row->nilai;
                }
                $rata = $total / $cek_row;
            } else {
                $rata = 0;
            }

            $grafik[] = [
                'rata2' => round($rata, 2),
                'nama' => $u->no
            ];
        }

        echo json_encode($grafik);
    }

    public function get_grafik_rata_skp_tahunan()
    {
        $tahun = $this->input->post('tahun');
        $ruangan = $this->input->post('ruangan');
        $arrayBulanAngka = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');

        $arrayBulanNama = [];
        $grafik = [];

        foreach ($arrayBulanAngka as $bulan) {
            $namaBulan = date('F', mktime(0, 0, 0, $bulan, 1));
            $arrayBulanNama[] = $namaBulan;
            $get = $this->Grafik_model->get_rata2_skp_tahunan($tahun, $bulan, $ruangan);
            $cek_row = $get->num_rows();
            $total = 0;

            if ($cek_row > 0) {
                foreach ($get->result() as $row) {
                    $total += $row->nilai;
                }
                $rata = $total / $cek_row;
            } else {
                $rata = 0;
            }

            $grafik[] = [
                'rata2' => round($rata, 2),
                'nama' => $namaBulan
            ];
        }
        echo json_encode($grafik);
    }
}