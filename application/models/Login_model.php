<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends CI_Model
{
    function cek_username($username)
    {
        // return $this->db->get_where('user', ['nik' => $username]);
        return $this->db->select('user.*,role.id as id_role,role.role as nama_role,ruangan.ruangan as nama_ruangan,jabatan.jabatan as nama_jabatan')
            ->from('user')
            ->join('role', 'user.role=role.id')
            ->join('jabatan', 'user.jabatan=jabatan.id', 'left')
            ->join('ruangan', 'user.ruangan=ruangan.id', 'left')
            ->where('user.nik', $username)
            ->get();
    }
}
