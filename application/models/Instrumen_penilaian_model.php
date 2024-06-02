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

    function get_instrumen_karu()
    {
        return $this->db->select('instrumen_karu.id,instrumen_karu.instrumen,instrumen_karu.aspek as id_aspek,instrumen_karu.no,aspek.aspek as nama_aspek')
            ->from('instrumen_karu')
            ->join('aspek', 'instrumen_karu.aspek=aspek.id')
            ->get();
    }

    function get_instrumen_katim()
    {
        return $this->db->select('instrumen_katim.id,instrumen_katim.instrumen,instrumen_katim.aspek as id_aspek,instrumen_katim.no,aspek.aspek as nama_aspek')
            ->from('instrumen_katim')
            ->join('aspek', 'instrumen_katim.aspek=aspek.id')
            ->get();
    }


















    // HASIL PENILAIAN----------------------------------------------------------------------------
    function hasil_karu()
    {
        $data = $this->db->query("
        SELECT 
        jadwal.jadwal_id,
        jadwal.jadwal_user_id,
        user.nama,
        jadwal.jadwal_tanggal, 
        jadwal.jadwal_status,
        jadwal.jadwal_tanggal_selesai, 
        jabatan.jabatan, 
        user.jabatan AS jabatan_id,
  
        COUNT(jadwal_id) AS jumlah, SUM(sp_jawaban) AS jawaban,  ROUND((SUM(sp_jawaban)/COUNT(jadwal_id)) * 100,2) AS nilai
        
        FROM jadwal
        JOIN user ON user.id=jadwal.jadwal_user_id
        JOIN jabatan ON user.jabatan=jabatan.id
        JOIN ruangan ON user.ruangan=ruangan.id
        JOIN form_supervisi ON jadwal.jadwal_id=form_supervisi.sp_jadwal_id
        JOIN instrumen_karu ON form_supervisi.sp_instrumen_id=instrumen_karu.id
        WHERE user.jabatan='3'
            GROUP BY jadwal_id ORDER BY jadwal_id DESC
            ");

        return $data->result();
    }



    function hasil_karu_cetak($id)
    {
        $data = $this->db->query("
        SELECT 
        jadwal.jadwal_id,
        jadwal.jadwal_user_id,
        user.nama,
        jadwal.jadwal_tanggal, 
        jadwal.jadwal_status,
        jadwal.jadwal_tanggal_selesai, 
        jabatan.jabatan, 
        user.jabatan AS jabatan_id,
        ruangan.ruangan AS ruangan_nama,
        spv.nama AS spv_nama,

        instrumen_karu.instrumen,
        aspek.aspek,

        form_supervisi.sp_jawaban,
        form_supervisi.tanggapan,
        form_supervisi.pengarahan,
        form_supervisi.saran,
        (SELECT nama FROM user WHERE user.jabatan='2' LIMIT 1) AS mng_perawat
        
        FROM jadwal
        JOIN user ON user.id=jadwal.jadwal_user_id
        JOIN jabatan ON user.jabatan=jabatan.id
        JOIN ruangan ON user.ruangan=ruangan.id
        JOIN form_supervisi ON jadwal.jadwal_id=form_supervisi.sp_jadwal_id
        JOIN instrumen_karu ON form_supervisi.sp_instrumen_id=instrumen_karu.id
        JOIN aspek ON instrumen_karu.aspek=aspek.id

        JOIN user spv ON form_supervisi.supervisor=spv.id

        WHERE jadwal_id='$id'
        ORDER BY instrumen_karu.no ASC
            ");

        return $data->result();
    }





    function hasil_katim()
    {
        $data = $this->db->query("
        SELECT 
        jadwal.jadwal_id,
        jadwal.jadwal_user_id,
        user.nama,
        jadwal.jadwal_tanggal, 
        jadwal.jadwal_status,
        jadwal.jadwal_tanggal_selesai, 
        jabatan.jabatan, 
        user.jabatan AS jabatan_id,
  
        COUNT(jadwal_id) AS jumlah, SUM(sp_jawaban) AS jawaban,  ROUND((SUM(sp_jawaban)/COUNT(jadwal_id)) * 100,2) AS nilai
        
        FROM jadwal
        JOIN user ON user.id=jadwal.jadwal_user_id
        JOIN jabatan ON user.jabatan=jabatan.id
        JOIN ruangan ON user.ruangan=ruangan.id
        JOIN form_supervisi ON jadwal.jadwal_id=form_supervisi.sp_jadwal_id
        JOIN instrumen_katim ON form_supervisi.sp_instrumen_id=instrumen_katim.id
        WHERE user.jabatan='4'
            GROUP BY jadwal_id ORDER BY jadwal_id DESC
            ");

        return $data->result();
    }


    function hasil_katim_cetak($id)
    {
        $data = $this->db->query("
        SELECT 
        jadwal.jadwal_id,
        jadwal.jadwal_user_id,
        user.nama,
        jadwal.jadwal_tanggal, 
        jadwal.jadwal_status,
        jadwal.jadwal_tanggal_selesai, 
        jabatan.jabatan, 
        user.jabatan AS jabatan_id,
        ruangan.ruangan AS ruangan_nama,
        spv.nama AS spv_nama,

        instrumen_katim.instrumen,
        aspek.aspek,

        form_supervisi.sp_jawaban,
        form_supervisi.tanggapan,
        form_supervisi.pengarahan,
        form_supervisi.saran,
        (SELECT nama FROM user WHERE user.jabatan='2' LIMIT 1) AS mng_perawat
        
        FROM jadwal
        JOIN user ON user.id=jadwal.jadwal_user_id
        JOIN jabatan ON user.jabatan=jabatan.id
        JOIN ruangan ON user.ruangan=ruangan.id
        JOIN form_supervisi ON jadwal.jadwal_id=form_supervisi.sp_jadwal_id
        JOIN instrumen_katim ON form_supervisi.sp_instrumen_id=instrumen_katim.id
        JOIN aspek ON instrumen_katim.aspek=aspek.id

        JOIN user spv ON form_supervisi.supervisor=spv.id

        WHERE jadwal_id='$id'
        ORDER BY instrumen_katim.no ASC
            ");

        return $data->result();
    }





    function hasil_staff()
    {
        $data = $this->db->query("
        SELECT 
        jadwal.jadwal_id,
        jadwal.jadwal_user_id,
        user.nama,
        jadwal.jadwal_tanggal, 
        jadwal.jadwal_status,
        jadwal.jadwal_tanggal_selesai, 
        jabatan.jabatan, 
        user.jabatan AS jabatan_id,
        kategori_instrumen_skp.kategori AS kategori_instrumen,
        kategori_instrumen_skp.id AS kategori_id,
      
  
        COUNT(jadwal_id) AS jumlah, SUM(sp_jawaban) AS jawaban,  ROUND((SUM(sp_jawaban)/COUNT(jadwal_id)) * 100,2) AS nilai,

        GROUP_CONCAT(DISTINCT kategori_instrumen_skp.id) AS kategori_id,
        GROUP_CONCAT(DISTINCT kategori_instrumen_skp.no) AS skp
        
        FROM jadwal
        JOIN user ON user.id=jadwal.jadwal_user_id
        JOIN jabatan ON user.jabatan=jabatan.id
        JOIN ruangan ON user.ruangan=ruangan.id
        JOIN form_supervisi ON jadwal.jadwal_id=form_supervisi.sp_jadwal_id
        JOIN instrumen_skp ON form_supervisi.sp_instrumen_id=instrumen_skp.id
        JOIN kategori_instrumen_skp ON instrumen_skp.kategori=kategori_instrumen_skp.id
        WHERE user.jabatan='5'
            GROUP BY jadwal_id ORDER BY jadwal_id DESC
            ");

        return $data->result();
    }

    function hasil_staff_web()
    {
        $data = $this->db->query("
        SELECT
            user.nama,
            jadwal.jadwal_tanggal,
            jadwal.jadwal_tanggal_selesai,
            jadwal.jadwal_id,
            user.id,
            user.nik,
            ruangan.ruangan 
        FROM
            jadwal
            INNER JOIN user ON jadwal.jadwal_user_id = user.id
            INNER JOIN ruangan ON user.ruangan = ruangan.id 
        WHERE
             user.jabatan = '5'
        GROUP BY jadwal_id ORDER BY jadwal_id DESC
            ");

        return $data->result();
    }



    function hasil_staff_cetak($kategori, $jadwal_id)
    {
        $data = $this->db->query("
        SELECT 
        jadwal.jadwal_id,
        jadwal.jadwal_user_id,
        user.nama,
        jadwal.jadwal_tanggal, 
        jadwal.jadwal_status,
        jadwal.jadwal_tanggal_selesai, 
        jabatan.jabatan, 
        user.jabatan AS jabatan_id,
        ruangan.ruangan AS ruangan_nama,
        spv.nama AS spv_nama,
        instrumen_skp.instrumen,
        kategori_instrumen_skp.kategori AS kategori_instrumen,
        kategori_instrumen_skp.id AS kategori_id,
        form_supervisi.sp_jawaban,
        form_supervisi.tanggapan,
        form_supervisi.pengarahan,
        form_supervisi.saran,
        (SELECT nama FROM user WHERE user.jabatan='2' LIMIT 1) AS mng_perawat,

        '' AS aspek
        
        FROM jadwal
        JOIN user ON user.id=jadwal.jadwal_user_id
        JOIN jabatan ON user.jabatan=jabatan.id
        JOIN ruangan ON user.ruangan=ruangan.id
        JOIN form_supervisi ON jadwal.jadwal_id=form_supervisi.sp_jadwal_id
        JOIN instrumen_skp ON form_supervisi.sp_instrumen_id=instrumen_skp.id
        JOIN kategori_instrumen_skp ON instrumen_skp.kategori=kategori_instrumen_skp.id

        JOIN user spv ON form_supervisi.supervisor=spv.id

        WHERE jadwal_id='$jadwal_id' AND kategori_instrumen_skp.id='$kategori'
             ORDER BY instrumen_skp.no ASC");

        return $data;
    }










    function hasil_evaluasi()
    {
        $query = $this->db->query("
        SELECT 
        evaluasi_id,
        user.nama,
        jabatan.jabatan, 
        evaluasi_tanggal,
        spv.nama AS spv_nama,

        (SELECT ROUND((SUM(evaluasi_detail_jawaban)/COUNT(evaluasi_detail_id)) * 100,2) AS nilai FROM form_evaluasi_detail 
                WHERE evaluasi_detail_evaluasi_id = form_evaluasi.evaluasi_id GROUP BY evaluasi_id
             ) AS nilai

        FROM form_evaluasi
        JOIN user ON form_evaluasi.evaluasi_user_dinilai=user.id
        JOIN jabatan ON user.jabatan=jabatan.id
        JOIN ruangan ON user.ruangan=ruangan.id

        JOIN user spv ON form_evaluasi.evaluasi_user_penilai=spv.id

        ");
        return $query->result();
    }



    function evaluasi_cetak($id)
    {
        $query = $this->db->query("
        SELECT 
        *,
        evaluasi_id,
        user.nama,
        jabatan.jabatan, 
        evaluasi_tanggal,
        spv.nama AS spv_nama,
        ruangan.ruangan AS ruangan_nama,
        instrumen_evaluasi.instrumen

        

        FROM form_evaluasi
        JOIN form_evaluasi_detail ON evaluasi_id=evaluasi_detail_evaluasi_id
        JOIN instrumen_evaluasi ON evaluasi_detail_instrumen_id=instrumen_evaluasi.id
        JOIN user ON form_evaluasi.evaluasi_user_dinilai=user.id
        JOIN jabatan ON user.jabatan=jabatan.id
        JOIN ruangan ON user.ruangan=ruangan.id

        JOIN user spv ON form_evaluasi.evaluasi_user_penilai=spv.id

        ");
        return $query->result();
    }

    function laporan_rtl($ruangan, $bulan, $tahun)
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
                AND ruangan.id = '$ruangan' 
            GROUP BY
                kategori_instrumen_skp.kategori,
                user.nama 
            ORDER BY
                kategori_instrumen_skp.NO ASC
        ")->result();
    }
}
