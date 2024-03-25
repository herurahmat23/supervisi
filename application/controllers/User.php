<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_login')) {
            $this->session->set_flashdata('need_login', 'Anda Harus Login Terlebih Dahulu!');
            redirect('Login');
        }
        $this->load->model('User_model');
    }

    public function index()
    {
        $header['title'] = "Data User";
        $header['menu'] = "mn_user";
        $data['role'] = $this->db->get('role')->result();
        $data['jabatan'] = $this->db->get('jabatan')->result();
        $data['ruangan'] = $this->db->get('ruangan')->result();
        $this->load->view('template/Header', $header);
        $this->load->view('user/Index', $data);
        $this->load->view('template/Footer');
    }

    public function load_data()
    {
        $data['data'] = $this->User_model->getData();
        $this->load->view('user/Table', $data);
    }

    public function save()
    {
        $this->load->library('upload');
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
        $this->form_validation->set_rules('role', 'Role', 'trim|required|xss_clean');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ruangan', 'Ruangan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('masa_kerja', 'Masa Kerja', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pelatihan_patient_safety', 'Pelatihan patient safety', 'trim|required|xss_clean');
        $this->form_validation->set_rules('no_sertifikat_patient_safety', 'No sertifikat patient safety', 'trim|xss_clean');
        $this->form_validation->set_rules('tahun_pelatihan_patient_safety', 'Tahun pelatihan patient safety', 'trim|xss_clean');
        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            // $upload_image = $_FILES['foto'];
            $config['upload_path']          = './uploads/foto_profil';
            $config['allowed_types']        = 'jpeg|jpg';
            $config['max_size']             = 1000;
            $config['overwrite']            = true;
            $config['file_name']            = $this->input->post('nik');
            $this->upload->initialize($config);

            if (!empty($_FILES['foto']['name'])) {

                if ($this->upload->do_upload('foto')) {
                    $new_name = $this->upload->data('file_name');
                    $data = [
                        'nik' => $this->input->post('nik'),
                        'nama' => $this->input->post('nama'),
                        'role' => $this->input->post('role'),
                        'password' => password_hash("siatan123", PASSWORD_DEFAULT),
                        'jabatan' => $this->input->post('jabatan'),
                        'ruangan' => $this->input->post('ruangan'),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                        'email' => $this->input->post('email'),
                        'pendidikan' => $this->input->post('pendidikan'),
                        'masa_kerja' => $this->input->post('masa_kerja'),
                        'pelatihan_patient_safety' => $this->input->post('pelatihan_patient_safety'),
                        'no_sertifikat_patient_safety' => $this->input->post('no_sertifikat_patient_safety'),
                        'tahun_pelatihan_patient_safety' => $this->input->post('tahun_pelatihan_patient_safety'),
                        'foto' => $new_name
                    ];
                    $this->db->insert('user', $data);
                    $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
                } else {
                    $array = array('status' => 'fail', 'message' => 'Upload Foto gagal: ' . $this->upload->display_errors());
                }
            } else {
                $data = [
                    'nik' => $this->input->post('nik'),
                    'nama' => $this->input->post('nama'),
                    'role' => $this->input->post('role'),
                    'password' => password_hash("siatan123", PASSWORD_DEFAULT),
                    'jabatan' => $this->input->post('jabatan'),
                    'ruangan' => $this->input->post('ruangan'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'email' => $this->input->post('email'),
                    'pendidikan' => $this->input->post('pendidikan'),
                    'masa_kerja' => $this->input->post('masa_kerja'),
                    'pelatihan_patient_safety' => $this->input->post('pelatihan_patient_safety'),
                    'no_sertifikat_patient_safety' => $this->input->post('no_sertifikat_patient_safety'),
                    'tahun_pelatihan_patient_safety' => $this->input->post('tahun_pelatihan_patient_safety'),
                ];
                $this->db->insert('user', $data);
                $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
            }
        }
        echo json_encode($array);
    }

    public function update()
    {
        $this->load->library('upload');
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
        $this->form_validation->set_rules('role', 'Role', 'trim|required|xss_clean');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ruangan', 'Ruangan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('masa_kerja', 'Masa Kerja', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pelatihan_patient_safety', 'Pelatihan patient safety', 'trim|required|xss_clean');
        $this->form_validation->set_rules('no_sertifikat_patient_safety', 'No sertifikat patient safety', 'trim|xss_clean');
        $this->form_validation->set_rules('tahun_pelatihan_patient_safety', 'Tahun pelatihan patient safety', 'trim|xss_clean');
        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            // $upload_image = $_FILES['foto'];
            $config['upload_path']          = './uploads/foto_profil';
            $config['allowed_types']        = 'jpeg|jpg|JPG|JPEG';
            $config['max_size']             = 2000;
            $config['overwrite']            = true;
            $config['file_name']            = $this->input->post('nik');
            $this->upload->initialize($config);

            if (!empty($_FILES['foto']['name'])) {
                if ($this->upload->do_upload('foto')) {
                    $old_foto = $this->input->post('old_foto');
                    unlink(FCPATH . 'uploads/foto_profil/' . $old_foto);
                    $new_name = $this->upload->data('file_name');
                    $data = [
                        'nik' => $this->input->post('nik'),
                        'nama' => $this->input->post('nama'),
                        'role' => $this->input->post('role'),
                        'jabatan' => $this->input->post('jabatan'),
                        'ruangan' => $this->input->post('ruangan'),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                        'email' => $this->input->post('email'),
                        'pendidikan' => $this->input->post('pendidikan'),
                        'masa_kerja' => $this->input->post('masa_kerja'),
                        'pelatihan_patient_safety' => $this->input->post('pelatihan_patient_safety'),
                        'no_sertifikat_patient_safety' => $this->input->post('no_sertifikat_patient_safety'),
                        'tahun_pelatihan_patient_safety' => $this->input->post('tahun_pelatihan_patient_safety'),
                        'foto' => $new_name
                    ];
                    $this->db->where('id', $this->input->post('id'));
                    $this->db->update('user', $data);
                    $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
                } else {

                    // $new_name = $this->upload->data('old_foto');
                    $array = array('status' => 'fail', 'message' => 'Upload Foto gagal: ' . $this->upload->display_errors());
                }
            } else {
                $data2 = [
                    'nik' => $this->input->post('nik'),
                    'nama' => $this->input->post('nama'),
                    'role' => $this->input->post('role'),
                    'jabatan' => $this->input->post('jabatan'),
                    'ruangan' => $this->input->post('ruangan'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'email' => $this->input->post('email'),
                    'pendidikan' => $this->input->post('pendidikan'),
                    'masa_kerja' => $this->input->post('masa_kerja'),
                    'pelatihan_patient_safety' => $this->input->post('pelatihan_patient_safety'),
                    'no_sertifikat_patient_safety' => $this->input->post('no_sertifikat_patient_safety'),
                    'tahun_pelatihan_patient_safety' => $this->input->post('tahun_pelatihan_patient_safety'),
                ];
                $this->db->where('id', $this->input->post('id'));
                $this->db->update('user', $data2);
                $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
            }
        }
        echo json_encode($array);
    }

    public function edit_password()
    {
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $array = array('status' => 'fail', 'message' => 'Input data gagal: ' . validation_errors());
        } else {
            $data = [
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            ];
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('user', $data);
            $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
        }
        echo json_encode($array);
    }

    public function delete()
    {
        $query = $this->db->get_where('user', array('id' => $this->input->post('id')))->row();
        if ($query->foto) {
            unlink(FCPATH . 'uploads/foto_profil/' . $query->foto);
            $this->db->where('id', $this->input->post('id'));
            $this->db->delete('user');
            $array = array('status' => 'success', 'message' => 'Data Berhasil Dihapus.');
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->delete('user');
            $array = array('status' => 'success', 'message' => 'Data Berhasil Dihapus.');
        }
        echo json_encode($array);
    }
}
