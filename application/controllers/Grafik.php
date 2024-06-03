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
        $data['ruangan'] = $this->db->order_by('id', 'ASC')->where('ruangan NOT LIKE', '%MANAJEMEN%')->get('ruangan')->result();
        $data['skp'] = $this->db->order_by('id', 'ASC')->get('kategori_instrumen_skp')->result();
        $this->load->view('template/Header', $header);
        $this->load->view('grafik/Index', $data);
        $this->load->view('template/Footer');
    }

    public function get_user_by_ruangan()
    {
        $ruangan = $this->input->post('ruangan_id');
        $users = $this->Grafik_model->getUserByRuangan($ruangan);
        $userOptions = '';

        if ($users) {
            foreach ($users as $user) {
                $userOptions .= '<option value="' . $user['id'] . '">' . $user['nama'] . '</option>';
            }
        } else {
            $userOptions .= '<option value="">Tidak ada PP diruangan ini.</option>';
        }

        echo $userOptions;
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

    public function get_grafik_rata_per_user()
    {
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        $user = $this->input->post('user');

        $grafik = [];

        $get = $this->Grafik_model->get_rata2_skp_individu($tahun, $bulan, $user);

        foreach ($get->result() as $row) {
            $grafik[] = [
                'rata2' => round($row->nilai, 2),
                'nama' => $row->no
            ];
        }

        echo json_encode($grafik);
    }

    public function get_grafik_rata_ruangan_per_skp()
    {
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        $skp = $this->input->post('skp');

        $ruangan = $this->db->order_by('id', 'ASC')->where('ruangan NOT LIKE', '%MANAJEMEN%')->get('ruangan')->result();

        $grafik = [];

        foreach ($ruangan as $u) {
            $get = $this->Grafik_model->get_rata2_skp($tahun, $bulan, $u->id, $skp);
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
                'nama' => $u->ruangan
            ];
        }

        echo json_encode($grafik);
    }

    public function get_grafik_rata_per_user_triwulan()
    {
        $tahun = $this->input->post('tahun');
        $triwulan = $this->input->post('triwulan');
        $user = $this->input->post('user');

        $pertahun = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');

        $arrayBulanAngka = [];
        if ($triwulan == 'tw1') {
            $arrayBulanAngka = array('01', '02', '03');
        } else if ($triwulan == 'tw2') {
            $arrayBulanAngka = array('04', '05', '06');
        } else if ($triwulan == 'tw3') {
            $arrayBulanAngka = array('07', '08', '09');
        } else if ($triwulan == 'tw4') {
            $arrayBulanAngka = array('10', '11', '12');
        }
        $grafik = [];
        $arrayBulanNama = [];


        $get_pertahun = $this->Grafik_model->get_rata2_skp_individu_pertahun($tahun, $user);
        $cek_row_pertahun = $get_pertahun->num_rows();
        $total = 0;

        if ($cek_row_pertahun > 0) {
            foreach ($get_pertahun->result() as $row) {
                $total += $row->nilai;
            }
            $rata_pertahun = $total / $cek_row_pertahun;
        } else {
            $rata_pertahun = 0;
        }


        foreach ($arrayBulanAngka as $bulan) {
            $namaBulan = date('F', mktime(0, 0, 0, $bulan, 1));
            $arrayBulanNama[] = $namaBulan;
            $get = $this->Grafik_model->get_rata2_skp_individu($tahun, $bulan, $user);
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
                'nama' => $namaBulan,
                'rata_pertahun' => round($rata_pertahun, 2)
            ];
        }
        echo json_encode($grafik);
    }
}
