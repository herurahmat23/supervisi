<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WS extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('WS_model');
    }




    function getBulan()
    {
        $bulan = '{values: [
                            {"bulan_id":"' . date('m') . '","bulan_nama":"' . date('F') . '"},
                            {"bulan_id":"01","bulan_nama":"Januari"},
                            {"bulan_id":"02","bulan_nama":"Februari"},
                            {"bulan_id":"03","bulan_nama":"Maret"},
                            {"bulan_id":"04","bulan_nama":"April"},
                            {"bulan_id":"05","bulan_nama":"Mei"},
                            {"bulan_id":"06","bulan_nama":"Juni"},
                            {"bulan_id":"07","bulan_nama":"Juli"},
                            {"bulan_id":"08","bulan_nama":"Agustus"},
                            {"bulan_id":"09","bulan_nama":"September"},
                            {"bulan_id":"10","bulan_nama":"Oktober"},
                            {"bulan_id":"11","bulan_nama":"November"},
                            {"bulan_id":"12","bulan_nama":"Desember"}
                            ]}';
        echo $bulan;
    }

    public function tentang_rs()
    {
        $data = $this->db->get_where('tentang_rs', ['id' => 1]);

        if ($data->num_rows() > 0) {
            $array = array('status' => 'success', 'data' => $data->row_array());
        } else {
            $array = array('status' => 'fail', 'message' => 'Terjadi kesalahan');
        }
        echo json_encode($array);
    }





     public function regulasi()
    {
        $nama_file = "";
        $directory = "regulasi/";
        $getpdf = glob($directory . "*.*");
        $filecount = count($getpdf);

        $data = [];
        for ($i = 0; $i < $filecount; $i++) {
            $nama_file = explode("/", $getpdf[$i]);
            $data[$i]["namafile"] = $nama_file[1];
        }

        echo '{ "status": true, "data":' . json_encode($data) . '}';
    }
    

   

    public function loginWS()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == true) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $cek_un = $this->WS_model->cek_username($username);
            if ($cek_un->num_rows() > 0) {
                $hasil = $cek_un->row();
                if (password_verify($password, $hasil->password)) {
                    $array = array('status' => 'success', 'message' => 'Login Berhasil.', 'data' => $cek_un->row_array());
                } else {
                    $array = array('status' => 'fail', 'message' => 'Login Gagal : Password Anda Salah!.');
                }
            } else {
                $array = array('status' => 'fail', 'message' => 'Login Gagal : NIK Tidak Terdaftar!.');
            }
        } else {
            $array = array('status' => 'fail', 'message' => 'Login gagal: ' . validation_errors());
        }
        echo json_encode($array);
    }






    public function UploadFotoProfil()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('foto', 'foto', 'trim|required|xss_clean');
        if ($this->form_validation->run() == true) {
            $username = $this->input->post('username');
            $foto = $this->input->post('foto');

            define('UPLOAD_DIR', 'profil/');

            $img = $_POST['image'];

            $img = str_replace('data:image/png;base64,', '', $foto);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $file = UPLOAD_DIR . $username . '.png';
            $success = file_put_contents($file, $data);

            $array = array('status' => 'success', 'message' => $success);
        } else {
            $array = array('status' => 'fail', 'message' => 'gagal: ' . validation_errors());
        }
        echo json_encode($array);
    }




    public function getRuangan()
    {
        $username = $this->input->post('username');
        $data = $this->WS_model->getRuangan($username);
        if ($data->num_rows() > 0) {
            $array = array('status' => 'success', 'message' => 'OK', 'data' => $data->result());
        } else {
            $array = array('status' => 'fail', 'message' => 'Data Tidak ditemukan');
        }
        echo json_encode($array);
    }


    public function getUserPerRuangan()
    {
        $id_ruangan = $this->input->post('id_ruangan');
        $data = $this->WS_model->getUserPerRuangan($id_ruangan);
        if ($data->num_rows() > 0) {
            $array = array('status' => 'success', 'message' => 'OK', 'data' => $data->result());
        } else {
            $array = array('status' => 'fail', 'message' => 'Data Tidak ditemukan');
        }
        echo json_encode($array);
    }


    public function getUserbyNik()
    {
        $nik = $this->input->post('nik');

        $cek_un = $this->WS_model->cek_username($nik);
        if ($cek_un->num_rows() > 0) {
            $array = array('status' => 'success', 'message' => 'Login Berhasil.', 'data' => $cek_un->row_array());
        } else {
            $array = array('status' => 'fail', 'message' => 'Login Gagal : NIK Tidak Terdaftar!.');
        }
        echo json_encode($array);
    }




    function getStaff($parameter, $tanggal, $ruangan)
    {
        $bulan = explode('-', $tanggal);
        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan[1], $bulan[2]);

        $data  = $this->WS_model->getStaff($parameter, $tanggal, $bulan[1], $bulan[2], $ruangan);
        if (count($data) > 0) {
            # code...
        } else {
            $query = $this->db->query("SELECT '' AS staff_id, '' AS staff_nama");
            $data = $query->result();
        }
        $data1 = "{values: " . json_encode($data) . "}";
        echo  $data1;
    }




    function saveJadwal()
    {
        $staff_id = $this->input->post('staff_id');
        $tanggal = $this->input->post('tanggal');
        $tanggal = date('Y-m-d', strtotime($tanggal));
        if ($staff_id != "") {
            $this->WS_model->saveJadwal($tanggal, $staff_id);
        }
        echo  json_encode(array("status" => TRUE));
    }


    function getJadwal()
    {
        $id_role = $this->input->post('id_role');
        $bulan_id = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $ruangan = $this->input->post('ruangan');

        $des = $this->WS_model->getJadwal($id_role, $bulan_id, $tahun, $ruangan);
        echo '{ "status": true, "data":' . json_encode($des) . '}';
    }

    function deleteJadwal()
    {
        $jadwal_id = $this->input->post('jadwal_id');
        $this->WS_model->deleteJadwal($jadwal_id);
        echo json_encode(array('status' => true));
    }









    function getJadwalInstrument()
    {
        $id_role = $this->input->post('id_role');
        $ruangan = $this->input->post('ruangan');

        $des = $this->WS_model->getJadwalInstrument($id_role, $ruangan);
        echo '{ "status": true, "data":' . json_encode($des) . '}';
    }



    function getJadwalInstrumentDetail()
    {
        $jadwal_id = $this->input->post('jadwal_id');
        $id_role = $this->input->post('id_role');
        $ruangan = $this->input->post('ruangan');

        $des = $this->WS_model->getJadwalInstrumentDetail($jadwal_id, $id_role, $ruangan);
        echo '{ "status": true, "data":' . json_encode($des) . '}';
    }


    function getSupervisi()
    {
        $jadwal_id = $this->input->post('jadwal_id');
        $kategori_id = $this->input->post('kategori_id');
        $sp_id = $this->input->post('sp_id');


        $des = $this->WS_model->getSupervisi($jadwal_id, $kategori_id, $sp_id);
        echo $des;
    }





    function saveSupervisi()
    {
        $id = $this->input->post('id');
        $jadwal_id = $this->input->post('jadwal_id');
        $intrumen_kategori = $this->input->post('intrumen_kategori');
        $pengarahan = $this->input->post('pengarahan');
        $saran = $this->input->post('saran');

        $this->WS_model->saveSupervisi($id, $jadwal_id, $intrumen_kategori, $pengarahan, $saran);
        echo json_encode(array("status" => true));
    }


    function saveInfoSupervisi()
    {

        $jadwal_id = $this->input->post('jadwal_id');
        $intrumen_kategori = $this->input->post('intrumen_kategori');

        $cek_un = $this->WS_model->saveInfoSupervisi($jadwal_id, $intrumen_kategori);
        if ($cek_un->num_rows() > 0) {
            $array = array('status' => 'success', 'message' => 'Data ditemukan.', 'data' => $cek_un->row_array());
        } else {
            $array = array('status' => 'fail', 'message' => 'Data tidak ditemukan');
        }

        echo json_encode($array);
    }









    function getJadwalHasil()
    {
        $username = $this->input->post('username');
        $id_role = $this->input->post('id_role');
        $bulan_id = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $ruangan = $this->input->post('ruangan');

        $des = $this->WS_model->getJadwalHasil($username, $id_role, $bulan_id, $tahun, $ruangan);
        echo '{ "status": true, "data":' . json_encode($des) . '}';
    }



    function getHasilOpen()
    {
        $jadwal_id = $this->input->post('jadwal_id');
        $id_role = $this->input->post('id_role');
        $ruangan = $this->input->post('ruangan');

        $des = $this->WS_model->getHasilOpen($jadwal_id, $id_role, $ruangan);
        echo '{ "status": true, "data":' . json_encode($des) . '}';
    }

    function saveTanggapan()
    {
        $id = $this->input->post('id');
        $jadwal_id = $this->input->post('jadwal_id');
        $intrumen_kategori = $this->input->post('intrumen_kategori');
        $tanggapan = $this->input->post('tanggapan');

        $this->WS_model->saveTanggapan($id, $jadwal_id, $intrumen_kategori, $tanggapan);
        echo json_encode(array("status" => true));
    }







    function getevaluasi()
    {
        $id_role = $this->input->post('id_role');
        $bulan_id = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $ruangan = $this->input->post('ruangan');

        $des = $this->WS_model->getevaluasi($id_role, $bulan_id, $tahun, $ruangan);
        echo '{ "status": true, "data":' . json_encode($des) . '}';
    }



    function getStaffEvaluasi($parameter,  $ruangan, $evaluasi_id)
    {

        $data  = $this->WS_model->getStaffEvaluasi($parameter, $ruangan, $evaluasi_id);
        if (count($data) > 0) {
            # code...
        } else {
            $query = $this->db->query("SELECT '' AS staff_id, '' AS staff_nama");
            $data = $query->result();
        }
        $data1 = "{values: " . json_encode($data) . "}";
        echo  $data1;
    }



    function getFromEvaluasi()
    {
        $evaluasi_id = $this->input->post('evaluasi_id');
        $evaluasi_detail_id = $this->input->post('evaluasi_detail_id');
        $user_id = $this->input->post('user_id');
        $staff_id = $this->input->post('staff_id');



        $des = $this->WS_model->getFromEvaluasi($evaluasi_id, $evaluasi_detail_id, $user_id, $staff_id);
        echo $des;
    }



    function getHasilEvaluasi()
    {
        $evaluasi_id = $this->input->post('evaluasi_id');

        $des = $this->WS_model->getHasilEvaluasi($evaluasi_id);
        echo $des;
    }
}
