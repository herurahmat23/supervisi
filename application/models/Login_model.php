<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends CI_Model
{
    function cek_username($username)
    {
        // return $this->db->get_where('user', ['nik' => $username]);
        return $this->db->select('user.id,user.nik,user.nama,user.password,role.id as id_role,role.role as nama_role')
            ->from('user')
            ->join('role', 'user.role=role.id')
            ->where('user.nik', $username)
            ->get();
    }
}
