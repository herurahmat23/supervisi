<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getData()
    {
        return $this->db->select('user.*,user.id,user.nik,user.nama,role.role,user.role as id_role,ruangan.ruangan as nama_ruangan, jabatan.jabatan as nama_jabatan')
            ->from('user')
            ->join('role', 'user.role=role.id')
            ->join('ruangan', 'user.ruangan=ruangan.id', 'LEFT')
            ->join('jabatan', 'user.jabatan=jabatan.id', 'LEFT')
            ->get()
            ->result();
    }
}
