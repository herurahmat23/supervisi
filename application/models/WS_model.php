<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class WS_model extends CI_Model
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






    function getRuangan($username)
    {
        $cek = $this->db->select('user.*')
            ->from('user')
            ->where('user.nik', $username)
            ->get()->row();

        if (strlen($cek->ruangan) > 0) {
            return $this->db->select('ruangan.*')
                ->from('ruangan')
                ->join('user', 'user.ruangan=ruangan.id')
                ->where('ruangan.is_active', '1')
                ->where('user.nik', $username)
                ->get();
        } elseif ($cek->ruangan == '') {
            return $this->db->select('*')
                ->from('ruangan')
                ->where('ruangan.is_active', '1')
                ->get();
        }
    }



    function getUserPerRuangan($id_ruangan)
    {
        return $this->db->select('user.*,role.id as id_role,role.role as nama_role,ruangan.ruangan as nama_ruangan,jabatan.jabatan as nama_jabatan')
            ->from('user')
            ->join('role', 'user.role=role.id')
            ->join('jabatan', 'user.jabatan=jabatan.id')
            ->join('ruangan', 'user.ruangan=ruangan.id')
            ->where('ruangan.id', $id_ruangan)
            ->get();
    }
}
