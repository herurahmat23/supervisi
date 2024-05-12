<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Grafik_model extends CI_Model
{
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
}
