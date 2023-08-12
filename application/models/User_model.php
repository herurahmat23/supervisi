<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getData()
    {
        return $this->db->select('user.id,user.nik,user.nama,role.role,user.role as id_role')
            ->from('user')
            ->join('role', 'user.role=role.id')
            ->get()
            ->result();
    }
}
