<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Grafik_model extends CI_Model
{
    public function getUserByRuangan($ruanganId)
    {
        $this->db->select('id, nama');
        $this->db->from('user');
        $this->db->where('ruangan', $ruanganId);
        $this->db->where('role', 6);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function get_rata2_individu($tahun, $bulan, $ruangan, $user)
    {
        return $this->db->query("
            SELECT user
            .id as id_user,
            user.nama,
            instrumen_skp.instrumen,
            kategori_instrumen_skp.NO,
            kategori_instrumen_skp.kategori,
            ROUND((SUM(sp_jawaban)/COUNT(jadwal_id)) * 100,2) AS nilai,
            ruangan.ruangan 
        FROM
            form_supervisi
            JOIN instrumen_skp ON instrumen_skp.id = form_supervisi.sp_instrumen_id
            JOIN kategori_instrumen_skp ON instrumen_skp.kategori = kategori_instrumen_skp.id
            JOIN jadwal ON jadwal.jadwal_id = form_supervisi.sp_jadwal_id
            JOIN user ON user.id = jadwal.jadwal_user_id
            JOIN ruangan ON ruangan.id = user.ruangan 
        WHERE
            YEAR ( jadwal.jadwal_tanggal )= '$tahun' 
            AND MONTH ( jadwal.jadwal_tanggal )= '$bulan' 
            AND ruangan.id = '$ruangan' 
            AND user.id='$user'
        GROUP BY
        kategori_instrumen_skp.kategori  
        ORDER BY
            kategori_instrumen_skp.NO ASC
        ");
    }
    function get_rata2_skp($tahun, $bulan, $ruangan, $skp)
    {
        return $this->db->query("
            SELECT user
            .id as id_user,
            user.nama,
            instrumen_skp.instrumen,
            kategori_instrumen_skp.NO,
            kategori_instrumen_skp.kategori,
            ROUND((SUM(sp_jawaban)/COUNT(jadwal_id)) * 100,2) AS nilai,
            ruangan.ruangan 
        FROM
            form_supervisi
            JOIN instrumen_skp ON instrumen_skp.id = form_supervisi.sp_instrumen_id
            JOIN kategori_instrumen_skp ON instrumen_skp.kategori = kategori_instrumen_skp.id
            JOIN jadwal ON jadwal.jadwal_id = form_supervisi.sp_jadwal_id
            JOIN user ON user.id = jadwal.jadwal_user_id
            JOIN ruangan ON ruangan.id = user.ruangan 
        WHERE
            YEAR ( jadwal.jadwal_tanggal )= '$tahun' 
            AND MONTH ( jadwal.jadwal_tanggal )= '$bulan' 
            AND ruangan.id = '$ruangan' 
            AND kategori_instrumen_skp.id='$skp'
        GROUP BY
        kategori_instrumen_skp.kategori  
        ORDER BY
            kategori_instrumen_skp.NO ASC
        ");
    }

    function get_rata2_skp_tahunan($tahun, $bulan, $ruangan)
    {
        return $this->db->query("
            SELECT user
            .id as id_user,
            user.nama,
            instrumen_skp.instrumen,
            kategori_instrumen_skp.NO,
            kategori_instrumen_skp.kategori,
            ROUND((SUM(sp_jawaban)/COUNT(jadwal_id)) * 100,2) AS nilai,
            ruangan.ruangan 
        FROM
            form_supervisi
            JOIN instrumen_skp ON instrumen_skp.id = form_supervisi.sp_instrumen_id
            JOIN kategori_instrumen_skp ON instrumen_skp.kategori = kategori_instrumen_skp.id
            JOIN jadwal ON jadwal.jadwal_id = form_supervisi.sp_jadwal_id
            JOIN user ON user.id = jadwal.jadwal_user_id
            JOIN ruangan ON ruangan.id = user.ruangan 
        WHERE
            YEAR ( jadwal.jadwal_tanggal )= '$tahun' 
            AND MONTH ( jadwal.jadwal_tanggal )= '$bulan' 
            AND ruangan.id = '$ruangan' 
        GROUP BY
        kategori_instrumen_skp.kategori  
        ORDER BY
            kategori_instrumen_skp.NO ASC
        ");
    }

    function get_rata2_skp_individu($tahun, $bulan, $id_user)
    {
        return $this->db->query("

        SELECT 
                user.id as id_user,
                user.nama,
                instrumen_skp.instrumen,
                kategori_instrumen_skp.id as id_skp,
                kategori_instrumen_skp.no,
                kategori_instrumen_skp.kategori,
                form_supervisi.sp_jawaban,
                form_supervisi.saran,
                SUM( sp_jawaban ) AS jawaban,
                ROUND(( SUM( sp_jawaban )/ COUNT( jadwal_id )) * 100, 2 ) AS nilai,
                ruangan.ruangan 
            FROM
                form_supervisi
                JOIN instrumen_skp ON instrumen_skp.id = form_supervisi.sp_instrumen_id
                JOIN kategori_instrumen_skp ON instrumen_skp.kategori = kategori_instrumen_skp.id
                JOIN jadwal ON jadwal.jadwal_id = form_supervisi.sp_jadwal_id
                JOIN user ON user.id = jadwal.jadwal_user_id
                JOIN ruangan ON ruangan.id = user.ruangan 
            WHERE
                YEAR ( jadwal.jadwal_tanggal )= '$tahun' 
                AND MONTH ( jadwal.jadwal_tanggal )= '$bulan' 
                AND user.id = '$id_user' 
           
                
            GROUP BY
                kategori_instrumen_skp.kategori,
                user.nama 
            ORDER BY
                kategori_instrumen_skp.NO ASC

        ");
    }
}
