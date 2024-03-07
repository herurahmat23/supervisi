<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Instrumen_penilaian_model extends CI_Model
{
    function get_instrumen_skp()
    {
        return $this->db->select('instrumen_skp.id,instrumen_skp.instrumen,instrumen_skp.kategori as id_kategori,instrumen_skp.no,kategori_instrumen_skp.no as no_skp,kategori_instrumen_skp.kategori as nama_kategori,kategori_instrumen_skp.jenis')
            ->from('instrumen_skp')
            ->join('kategori_instrumen_skp', 'instrumen_skp.kategori=kategori_instrumen_skp.id')
            ->get();
    }

    function get_instrumen_evaluasi()
    {
        return $this->db->select('*')
            ->from('instrumen_evaluasi')
            ->order_by('no', 'ASC')
            ->get();
    }
}
