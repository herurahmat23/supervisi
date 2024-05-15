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

        if ($cek->jabatan == '1' || $cek->jabatan == '2' || $cek->jabatan == '') {
            return $this->db->select('*')
                ->from('ruangan')
                ->where('ruangan.is_active', '1')
                ->get();
        } else {
            return $this->db->select('ruangan.*')
                ->from('ruangan')
                ->join('user', 'user.ruangan=ruangan.id')
                ->where('ruangan.is_active', '1')
                ->where('user.nik', $username)
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


    function getStaff($parameter, $tanggal, $bulan, $tahun, $ruangan)
    {
        if ($parameter == '3') {
            $query = $this->db->query("SELECT *, id AS staff_id, nama AS staff_nama FROM user WHERE jabatan='3' AND id NOT IN (
                SELECT jadwal_user_id FROM jadwal WHERE jadwal_tanggal BETWEEN '$tahun-$bulan-01' AND '$tahun-$bulan-$tanggal' 
            )");
            return $query->result();
        } elseif ($parameter == '4') {
            $query = $this->db->query("SELECT *, id AS staff_id, nama AS staff_nama 
            FROM user  
            WHERE ruangan='$ruangan' AND jabatan='4' AND id NOT IN (
                SELECT jadwal_user_id FROM jadwal WHERE jadwal_tanggal BETWEEN '$tahun-$bulan-01' AND '$tahun-$bulan-$tanggal' 
            )");
            return $query->result();
        } elseif ($parameter == '5') {
            $query = $this->db->query("SELECT *, id AS staff_id, nama AS staff_nama 
            FROM user 
            WHERE ruangan='$ruangan' AND jabatan='5' AND id NOT IN (
                SELECT jadwal_user_id FROM jadwal WHERE jadwal_tanggal BETWEEN '$tahun-$bulan-01' AND '$tahun-$bulan-$tanggal' 
            )");
            return $query->result();
        }
    }



    function saveJadwal($tanggal, $staff_id)
    {
        $this->db->query("INSERT INTO  jadwal (jadwal_tanggal,jadwal_user_id) VALUES ('$tanggal', '$staff_id')");
    }


    function getJadwal($id_role, $bulan_id, $tahun, $ruangan, $username)
    {
        $tanggal = 01;
        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan_id, $tahun);

        $select = 'SELECT 
        jadwal.jadwal_id,
        jadwal.jadwal_user_id,
        user.nama,
        jadwal.jadwal_tanggal, 
        jadwal.jadwal_status,
        jabatan.jabatan, 
        ruangan.ruangan';

        $from = 'FROM jadwal
        JOIN user ON user.id=jadwal.jadwal_user_id
        JOIN jabatan ON user.jabatan=jabatan.id
        JOIN ruangan ON user.ruangan=ruangan.id';

        if ($id_role == '3') {
            $query = $this->db->query("$select $from
            WHERE (user.jabatan='3' OR user.jabatan='4' OR user.jabatan='5' OR user.nik='$username') AND jadwal.jadwal_tanggal BETWEEN '$tahun-$bulan_id-01' AND '$tahun-$bulan_id-$tanggal'
            ");
        } elseif ($id_role == '4') {
            $query = $this->db->query("$select $from
            WHERE (user.jabatan='4' OR user.jabatan='5' OR user.nik='$username') AND  user.ruangan='$ruangan' AND jadwal.jadwal_tanggal BETWEEN  '$tahun-$bulan_id-01' AND '$tahun-$bulan_id-$tanggal'
            ");
        } elseif ($id_role == '5') {
            $query = $this->db->query("$select $from
            WHERE (user.jabatan='5' OR user.nik='$username')  AND user.ruangan='$ruangan' AND jadwal.jadwal_tanggal BETWEEN  '$tahun-$bulan_id-01' AND '$tahun-$bulan_id-$tanggal'
            ");
        } elseif ($id_role == '6') {
            $query = $this->db->query("$select $from
            WHERE user.jabatan='5' AND user.nik='$username' AND user.ruangan='$ruangan' AND jadwal.jadwal_tanggal BETWEEN  '$tahun-$bulan_id-01' AND '$tahun-$bulan_id-$tanggal'
            ");
        } else {
            $query = $this->db->query("$select $from
            WHERE jadwal.jadwal_tanggal BETWEEN '$tahun-$bulan_id-01' AND '$tahun-$bulan_id-$tanggal'
            ");
        }
        return $query->result();
    }



    function deleteJadwal($jadwal_id)
    {
        $this->db->query("DELETE FROM jadwal WHERE jadwal_id='$jadwal_id'");
    }






    function getJadwalInstrument($id_role, $ruangan)
    {
        $select = 'SELECT 
        jadwal.jadwal_id,
        jadwal.jadwal_user_id,
        user.nama,
        jadwal.jadwal_tanggal, 
        jadwal.jadwal_status,
        jadwal.jadwal_tanggal_selesai, 
        jabatan.jabatan, 
        user.jabatan AS jabatan_id,
        ruangan.ruangan';

        $from = 'FROM jadwal
        JOIN user ON user.id=jadwal.jadwal_user_id
        JOIN jabatan ON user.jabatan=jabatan.id
        JOIN ruangan ON user.ruangan=ruangan.id';

        if ($id_role == '3') {
            $query = $this->db->query("$select $from
            WHERE user.jabatan='3' AND jadwal.jadwal_status ='0'
            ");
        } elseif ($id_role == '4') {
            $query = $this->db->query("$select $from
            WHERE user.jabatan='4' AND  user.ruangan='$ruangan' AND jadwal.jadwal_status ='0'
            ");
        } elseif ($id_role == '5') {
            $query = $this->db->query("$select $from
            WHERE user.jabatan='5' AND user.ruangan='$ruangan'  AND jadwal.jadwal_status ='0'
            ");
        } else {
            $query = $this->db->query("$select $from
            WHERE jadwal.jadwal_status ='0'
            ");
        }
        return $query->result();
    }




    function getJadwalInstrumentDetail($jadwal_id, $id_role, $ruangan)
    {
        $this->db->query("INSERT INTO form_supervisi (sp_jadwal_id, sp_instrumen_id,sp_time) SELECT '$jadwal_id',id,NOW() FROM instrumen_skp WHERE id NOT IN (SELECT sp_instrumen_id FROM form_supervisi WHERE sp_jadwal_id='$jadwal_id')");

        $select = 'SELECT 
        jadwal.jadwal_id,
        jadwal.jadwal_user_id,
        user.nama,
        jadwal.jadwal_tanggal, 
        jadwal.jadwal_status,
        jadwal.jadwal_tanggal_selesai, 
        jabatan.jabatan, 
        user.jabatan AS jabatan_id,
        kategori_instrumen_skp.kategori AS kategori_skp,
        kategori_instrumen_skp.id AS kategori_skp_id,
        COUNT(jadwal_id) AS jumlah, SUM(sp_jawaban) AS jawaban,  ROUND((SUM(sp_jawaban)/COUNT(jadwal_id)) * 100,2) AS nilai';

        $from = 'FROM jadwal
        JOIN user ON user.id=jadwal.jadwal_user_id
        JOIN jabatan ON user.jabatan=jabatan.id
        JOIN ruangan ON user.ruangan=ruangan.id
        JOIN form_supervisi ON jadwal.jadwal_id=form_supervisi.sp_jadwal_id
        JOIN instrumen_skp ON form_supervisi.sp_instrumen_id=instrumen_skp.id
        JOIN kategori_instrumen_skp ON instrumen_skp.kategori=kategori_instrumen_skp.id';

        if ($id_role != '4' && $id_role != '5') {
            $query = $this->db->query("$select $from
            WHERE user.jabatan='5'  AND jadwal.jadwal_status ='0'
            GROUP BY kategori_instrumen_skp.id
            ");
        } else {
            $query = $this->db->query("$select $from
            WHERE user.jabatan='5' AND user.ruangan='$ruangan'  AND jadwal.jadwal_status ='0'
            GROUP BY kategori_instrumen_skp.id
            ");
        }


        return $query->result();
    }



    function getSupervisi($jadwal_id, $kategori_id, $sp_id)
    {
        $cek = $this->db->query("SELECT * 
        FROM jadwal
        JOIN user ON jadwal.jadwal_user_id=user.id
        WHERE jadwal.jadwal_id='$jadwal_id'")->row();

        if ($kategori_id == '') {
            if ($cek->jabatan == '3') {
                $this->db->query("INSERT INTO form_supervisi (sp_jadwal_id, sp_instrumen_id,sp_time) SELECT '$jadwal_id',id,NOW() FROM instrumen_karu WHERE id NOT IN (SELECT sp_instrumen_id FROM form_supervisi WHERE sp_jadwal_id='$jadwal_id')");

                $query = $this->db->query("SELECT aspek.aspek,instrumen_karu.instrumen,form_supervisi.* FROM form_supervisi
                JOIN instrumen_karu ON form_supervisi.sp_instrumen_id=instrumen_karu.id
                JOIN aspek ON instrumen_karu.aspek=aspek.id
                JOIN jadwal ON form_supervisi.sp_jadwal_id=jadwal.jadwal_id
                WHERE form_supervisi.sp_jadwal_id = '$jadwal_id'
                ORDER BY instrumen_karu.no ASC")->result();

                $query_nilai = $this->db->query("SELECT jadwal.*,form_supervisi.pengarahan,form_supervisi.saran,form_supervisi.tanggapan,
                COUNT(jadwal_id) AS jumlah, SUM(sp_jawaban) AS jawaban,  ROUND((SUM(sp_jawaban)/COUNT(jadwal_id)) * 100,2) AS nilai
                FROM form_supervisi
                JOIN instrumen_karu ON form_supervisi.sp_instrumen_id=instrumen_karu.id
                JOIN jadwal ON form_supervisi.sp_jadwal_id=jadwal.jadwal_id
                WHERE form_supervisi.sp_jadwal_id = '$jadwal_id'
                GROUP BY jadwal_id")->row();
            } elseif ($cek->jabatan == '4') {


                $this->db->query("INSERT INTO form_supervisi (sp_jadwal_id, sp_instrumen_id,sp_time) SELECT '$jadwal_id',id,NOW() FROM instrumen_katim WHERE id NOT IN (SELECT sp_instrumen_id FROM form_supervisi WHERE sp_jadwal_id='$jadwal_id')");

                $query = $this->db->query("SELECT aspek.aspek,instrumen_katim.instrumen,form_supervisi.* FROM form_supervisi
                JOIN instrumen_katim ON form_supervisi.sp_instrumen_id=instrumen_katim.id
                JOIN aspek ON instrumen_katim.aspek=aspek.id
                JOIN jadwal ON form_supervisi.sp_jadwal_id=jadwal.jadwal_id
                WHERE form_supervisi.sp_jadwal_id = '$jadwal_id'
                ORDER BY instrumen_katim.no ASC")->result();

                $query_nilai = $this->db->query("SELECT jadwal.*,form_supervisi.pengarahan,form_supervisi.saran,form_supervisi.tanggapan,
                COUNT(jadwal_id) AS jumlah, SUM(sp_jawaban) AS jawaban,  ROUND((SUM(sp_jawaban)/COUNT(jadwal_id)) * 100,2) AS nilai
                FROM form_supervisi
                JOIN instrumen_katim ON form_supervisi.sp_instrumen_id=instrumen_katim.id
                JOIN jadwal ON form_supervisi.sp_jadwal_id=jadwal.jadwal_id
                WHERE form_supervisi.sp_jadwal_id = '$jadwal_id'
                GROUP BY jadwal_id")->row();
            }
        } else {
            $query = $this->db->query("SELECT kategori_instrumen_skp.kategori AS aspek, instrumen_skp.instrumen,form_supervisi.* 
            FROM form_supervisi
            JOIN instrumen_skp ON form_supervisi.sp_instrumen_id=instrumen_skp.id
            JOIN kategori_instrumen_skp ON instrumen_skp.kategori=kategori_instrumen_skp.id
            JOIN jadwal ON form_supervisi.sp_jadwal_id=jadwal.jadwal_id
            WHERE form_supervisi.sp_jadwal_id = '$jadwal_id' and instrumen_skp.kategori='$kategori_id'
            ORDER BY instrumen_skp.no ASC")->result();

            $query_nilai = $this->db->query("SELECT jadwal.*,form_supervisi.pengarahan,form_supervisi.saran,form_supervisi.tanggapan,
            COUNT(jadwal_id) AS jumlah, SUM(sp_jawaban) AS jawaban,  ROUND((SUM(sp_jawaban)/COUNT(jadwal_id)) * 100,2) AS nilai
            FROM form_supervisi
            JOIN instrumen_skp ON form_supervisi.sp_instrumen_id=instrumen_skp.id
            JOIN kategori_instrumen_skp ON instrumen_skp.kategori=kategori_instrumen_skp.id
            JOIN jadwal ON form_supervisi.sp_jadwal_id=jadwal.jadwal_id
            WHERE form_supervisi.sp_jadwal_id = '$jadwal_id' and instrumen_skp.kategori='$kategori_id'
            GROUP BY jadwal_id")->row();
        }



        if ($sp_id != "") {
            $this->db->query("UPDATE form_supervisi SET sp_jawaban=IF((SELECT sp_jawaban FROM form_supervisi WHERE sp_id='$sp_id') = 1,0,1),sp_time=NOW() WHERE sp_id='$sp_id'");
        }
        $return =  '{"status": true, "data":' . json_encode($cek) . ',"instrumen":' . json_encode($query) . ',"nilai":' . json_encode($query_nilai) . '}';
        return $return;
    }



    function saveInfoSupervisi($jadwal_id, $kategori_id)
    {
        $cek = $this->db->query("SELECT * 
        FROM jadwal
        JOIN user ON jadwal.jadwal_user_id=user.id
        WHERE jadwal.jadwal_id='$jadwal_id'")->row();

        if ($kategori_id == '') {
            if ($cek->jabatan == '3') {

                $query = $this->db->query("SELECT jadwal.*,form_supervisi.pengarahan,form_supervisi.saran,form_supervisi.tanggapan,
               COUNT(jadwal_id) AS jumlah, SUM(sp_jawaban) AS jawaban,  ROUND((SUM(sp_jawaban)/COUNT(jadwal_id)) * 100,2) AS nilai
               FROM form_supervisi
               JOIN jadwal ON form_supervisi.sp_jadwal_id=jadwal.jadwal_id
               WHERE form_supervisi.sp_jadwal_id = '$jadwal_id'
               GROUP BY jadwal_id");
            } elseif ($cek->jabatan == '4') {
                $query = $this->db->query("SELECT jadwal.*,form_supervisi.pengarahan,form_supervisi.saran,form_supervisi.tanggapan,
                COUNT(jadwal_id) AS jumlah, SUM(sp_jawaban) AS jawaban,  ROUND((SUM(sp_jawaban)/COUNT(jadwal_id)) * 100,2) AS nilai
                FROM form_supervisi
                JOIN jadwal ON form_supervisi.sp_jadwal_id=jadwal.jadwal_id
                WHERE form_supervisi.sp_jadwal_id = '$jadwal_id'
                GROUP BY jadwal_id");
            }
        } else {
            $query = $this->db->query("SELECT jadwal.*,form_supervisi.pengarahan,form_supervisi.saran,form_supervisi.tanggapan,
            COUNT(jadwal_id) AS jumlah, SUM(sp_jawaban) AS jawaban,  ROUND((SUM(sp_jawaban)/COUNT(jadwal_id)) * 100,2) AS nilai
            FROM form_supervisi
            JOIN instrumen_skp ON form_supervisi.sp_instrumen_id=instrumen_skp.id
            JOIN jadwal ON form_supervisi.sp_jadwal_id=jadwal.jadwal_id
            WHERE form_supervisi.sp_jadwal_id = '$jadwal_id' and instrumen_skp.kategori='$kategori_id'
            GROUP BY jadwal_id");
        }

        return $query;
    }

    function saveSupervisi($id, $jadwal_id, $intrumen_kategori, $pengarahan, $saran)
    {
        if ($intrumen_kategori == "") {
            $this->db->query("UPDATE form_supervisi SET pengarahan='$pengarahan', saran='$saran',supervisor='$id' WHERE sp_jadwal_id='$jadwal_id'");
            $this->db->query("UPDATE jadwal SET jadwal_status='1', jadwal_tanggal_selesai=NOW() WHERE jadwal_id='$jadwal_id'");
        } else {
            $this->db->query("UPDATE form_supervisi SET pengarahan='$pengarahan', saran='$saran',supervisor='$id' WHERE sp_jadwal_id='$jadwal_id' AND sp_instrumen_id IN (
                SELECT id FROM instrumen_skp WHERE kategori='$intrumen_kategori'
            )");

            $query = $this->db->query("SELECT instrumen_skp.instrumen,form_supervisi.* 
            FROM form_supervisi
            JOIN instrumen_skp ON form_supervisi.sp_instrumen_id=instrumen_skp.id
            JOIN jadwal ON form_supervisi.sp_jadwal_id=jadwal.jadwal_id
            WHERE form_supervisi.sp_jadwal_id = '$jadwal_id' AND pengarahan IS NULL
            ORDER BY instrumen_skp.no ASC")->result();

            if (COUNT($query) == 0) {
                $this->db->query("UPDATE jadwal SET jadwal_status='1', jadwal_tanggal_selesai=NOW() WHERE jadwal_id='$jadwal_id'");
            }
        }
    }







    function getJadwalHasil($username, $id_role, $bulan_id, $tahun, $ruangan)
    {
        $tanggal = 01;
        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan_id, $tahun);

        $select = 'SELECT 
        jadwal.jadwal_id,
        jadwal.jadwal_user_id,
        user.nama,
        jadwal.jadwal_tanggal, 
        jadwal.jadwal_status,
        jadwal.jadwal_tanggapan,
        jadwal.jadwal_tanggal_selesai, 
        jabatan.jabatan, 
        user.jabatan AS jabatan_id,
        ruangan.ruangan';

        $from = 'FROM jadwal
        JOIN user ON user.id=jadwal.jadwal_user_id
        JOIN jabatan ON user.jabatan=jabatan.id
        JOIN ruangan ON user.ruangan=ruangan.id';

        $query_2 = "";
        if ($id_role == '3') {
            $query = $this->db->query("$select $from
            WHERE user.jabatan='3' AND jadwal.jadwal_tanggal BETWEEN '$tahun-$bulan_id-01' AND '$tahun-$bulan_id-$tanggal'
            ");

            $query_2 = $this->db->query("$select $from
            WHERE user.nik='$username' AND jadwal.jadwal_tanggal BETWEEN '$tahun-$bulan_id-01' AND '$tahun-$bulan_id-$tanggal'
            ");
        } elseif ($id_role == '4') {
            $query = $this->db->query("$select $from
            WHERE user.jabatan='4' AND  user.ruangan='$ruangan' AND jadwal.jadwal_tanggal BETWEEN '$tahun-$bulan_id-01' AND '$tahun-$bulan_id-$tanggal'
            ");

            $query_2 = $this->db->query("$select $from
            WHERE user.nik='$username' AND jadwal.jadwal_tanggal BETWEEN '$tahun-$bulan_id-01' AND '$tahun-$bulan_id-$tanggal'
            ");
        } elseif ($id_role == '5') {
            $query = $this->db->query("$select $from
            WHERE user.jabatan='5' AND user.ruangan='$ruangan' AND jadwal.jadwal_tanggal BETWEEN '$tahun-$bulan_id-01' AND '$tahun-$bulan_id-$tanggal'
            ");

            $query_2 = $this->db->query("$select $from
            WHERE user.nik='$username' AND jadwal.jadwal_tanggal BETWEEN '$tahun-$bulan_id-01' AND '$tahun-$bulan_id-$tanggal'
            ");
        } elseif ($id_role == '6') {
            $query = "";

            $query_2 = $this->db->query("$select $from
            WHERE user.nik='$username' AND jadwal.jadwal_tanggal BETWEEN '$tahun-$bulan_id-01' AND '$tahun-$bulan_id-$tanggal'
            ");
        } else {
            $query = $this->db->query("$select $from
            WHERE jadwal.jadwal_tanggal BETWEEN '$tahun-$bulan_id-01' AND '$tahun-$bulan_id-$tanggal'
            ");
        }


        if ($query_2 == "") {
            return $query->result();
        } elseif ($query == "") {
            return $query_2->result();
        } else {
            $mergedArray = array_merge($query_2->result(), $query->result());
            return $mergedArray;
        }
    }



    function getHasilOpen($jadwal_id, $id_role, $ruangan)
    {
        $this->db->query("INSERT INTO form_supervisi (sp_jadwal_id, sp_instrumen_id,sp_time) SELECT '$jadwal_id',id,NOW() FROM instrumen_skp WHERE id NOT IN (SELECT sp_instrumen_id FROM form_supervisi WHERE sp_jadwal_id='$jadwal_id')");

        $select = 'SELECT 
        jadwal.jadwal_id,
        jadwal.jadwal_user_id,
        user.nama,
        jadwal.jadwal_tanggal, 
        jadwal.jadwal_status,
        jadwal.jadwal_tanggal_selesai, 
        jabatan.jabatan, 
        user.jabatan AS jabatan_id,
        kategori_instrumen_skp.kategori AS kategori_skp,
        kategori_instrumen_skp.id AS kategori_skp_id,
        COUNT(jadwal_id) AS jumlah, SUM(sp_jawaban) AS jawaban,  ROUND((SUM(sp_jawaban)/COUNT(jadwal_id)) * 100,2) AS nilai';

        $from = 'FROM jadwal
        JOIN user ON user.id=jadwal.jadwal_user_id
        JOIN jabatan ON user.jabatan=jabatan.id
        JOIN ruangan ON user.ruangan=ruangan.id
        JOIN form_supervisi ON jadwal.jadwal_id=form_supervisi.sp_jadwal_id
        JOIN instrumen_skp ON form_supervisi.sp_instrumen_id=instrumen_skp.id
        JOIN kategori_instrumen_skp ON instrumen_skp.kategori=kategori_instrumen_skp.id';

        $query = $this->db->query("$select $from
            WHERE user.jabatan='5' AND jadwal.jadwal_id='$jadwal_id' 
            GROUP BY kategori_instrumen_skp.id
            ");

        return $query->result();
    }



    function saveTanggapan($id, $jadwal_id, $intrumen_kategori, $tanggapan)
    {
        if ($intrumen_kategori == "") {
            $this->db->query("UPDATE form_supervisi SET tanggapan='$tanggapan' WHERE sp_jadwal_id='$jadwal_id'");
            $this->db->query("UPDATE jadwal SET jadwal_tanggapan='1', jadwal_status='0' WHERE jadwal_id='$jadwal_id'");
        } else {
            $this->db->query("UPDATE form_supervisi 
            JOIN instrumen_skp ON form_supervisi.sp_instrumen_id=instrumen_skp.id 
            SET tanggapan='$tanggapan' 
            WHERE sp_jadwal_id='$jadwal_id' AND instrumen_skp.kategori='$intrumen_kategori'");
            $this->db->query("UPDATE jadwal SET jadwal_tanggapan='1', jadwal_status='0' WHERE jadwal_id='$jadwal_id'");
        }
    }











    function getevaluasi($id_role, $bulan_id, $tahun, $ruangan)
    {
        $tanggal = 01;
        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan_id, $tahun);

        $select = 'SELECT *,jabatan.jabatan AS jabatan_nama,
        (SELECT ROUND((SUM(evaluasi_detail_jawaban)/COUNT(evaluasi_detail_id)) * 100,2) AS nilai FROM form_evaluasi_detail 
                WHERE evaluasi_detail_evaluasi_id = form_evaluasi.evaluasi_id GROUP BY evaluasi_id
             ) AS nilai';

        $from = 'FROM form_evaluasi
        JOIN user ON form_evaluasi.evaluasi_user_dinilai=user.id
        JOIN jabatan ON user.jabatan=jabatan.id
        ';

        if ($id_role == '2') {
            $query = $this->db->query("$select $from
            WHERE user.jabatan='2' AND evaluasi_tanggal BETWEEN '$tahun-$bulan_id-01' AND '$tahun-$bulan_id-$tanggal'
            ");
        } elseif ($id_role == '3') {
            $query = $this->db->query("$select $from
            WHERE user.jabatan='3' AND evaluasi_tanggal BETWEEN  '$tahun-$bulan_id-01' AND '$tahun-$bulan_id-$tanggal'
            ");
        } elseif ($id_role == '4') {
            $query = $this->db->query("$select $from
            WHERE user.jabatan='4' AND user.ruangan='$ruangan' AND evaluasi_tanggal BETWEEN  '$tahun-$bulan_id-01' AND '$tahun-$bulan_id-$tanggal'
            ");
        }
        return $query->result();
    }


    function getStaffEvaluasi($parameter, $ruangan, $evaluasi_id)
    {
        if ($evaluasi_id == "nodata") {
            $bulan = date('n'); // 'n' untuk mendapatkan bulan dalam format angka (1-12) tanpa nol di depan
            $tahun = date('Y'); // 'Y' untuk mendapatkan tahun dalam format empat digit
            $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

            if ($parameter == '2') {
                $query = $this->db->query("SELECT *, id AS staff_id, nama AS staff_nama FROM user WHERE jabatan='2' AND id NOT IN (
                SELECT evaluasi_user_dinilai FROM form_evaluasi WHERE evaluasi_tanggal BETWEEN '$tahun-$bulan-01' AND '$tahun-$bulan-$tanggal' 
            )");
                return $query->result();
            } elseif ($parameter == '3') {
                $query = $this->db->query("SELECT *, id AS staff_id, nama AS staff_nama FROM user WHERE jabatan='3' AND id NOT IN (
                SELECT evaluasi_user_dinilai FROM form_evaluasi WHERE evaluasi_tanggal BETWEEN '$tahun-$bulan-01' AND '$tahun-$bulan-$tanggal' 
            )");
                return $query->result();
            } elseif ($parameter == '4') {
                $query = $this->db->query("SELECT *, id AS staff_id, nama AS staff_nama 
            FROM user  
            WHERE ruangan='$ruangan' AND jabatan='4' AND id NOT IN (
                SELECT evaluasi_user_dinilai FROM form_evaluasi WHERE evaluasi_tanggal BETWEEN '$tahun-$bulan-01' AND '$tahun-$bulan-$tanggal' 
            )");
                return $query->result();
            }
        } else {
            $query = $this->db->query("SELECT *, id AS staff_id, nama AS staff_nama 
            FROM user 
            JOIN form_evaluasi ON user.id=form_evaluasi.evaluasi_user_dinilai
            WHERE form_evaluasi.evaluasi_id='$evaluasi_id'  
            ");
            return $query->result();
        }
    }




    function getFromEvaluasi($evaluasi_id, $evaluasi_detail_id, $user_id, $staff_id)
    {
        $bulan = date('n'); // 'n' untuk mendapatkan bulan dalam format angka (1-12) tanpa nol di depan
        $tahun = date('Y'); // 'Y' untuk mendapatkan tahun dalam format empat digit
        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

        if ($evaluasi_id == "nodata" && $staff_id != "") {
            $cek = $this->db->query("SELECT *, id AS staff_id, nama AS staff_nama 
            FROM form_evaluasi
            JOIN user ON form_evaluasi.evaluasi_user_dinilai=user.id
            WHERE user.id='$staff_id' AND evaluasi_tanggal BETWEEN '$tahun-$bulan-01' AND '$tahun-$bulan-$tanggal' 
            ");

            if (COUNT($cek->result()) == 0) {
                $this->db->query("INSERT INTO form_evaluasi (evaluasi_tanggal, evaluasi_user_dinilai,evaluasi_user_penilai) VALUES (NOW(), '$staff_id','$user_id')");
            }

            $cek = $this->db->query("SELECT *, id AS staff_id, nama AS staff_nama 
            FROM form_evaluasi
            JOIN user ON form_evaluasi.evaluasi_user_dinilai=user.id
            WHERE user.id='$staff_id' AND evaluasi_tanggal BETWEEN '$tahun-$bulan-01' AND '$tahun-$bulan-$tanggal' 
            ")->row();

            $evaluasi_id = $cek->evaluasi_id;
        } else {
            $cek = $this->db->query("SELECT *, id AS staff_id, nama AS staff_nama 
            FROM form_evaluasi
            JOIN user ON form_evaluasi.evaluasi_user_dinilai=user.id
            WHERE evaluasi_id='$evaluasi_id' 
            ")->row();
        }

        if ($staff_id != "") {
            $this->db->query("INSERT INTO form_evaluasi_detail (evaluasi_detail_evaluasi_id, evaluasi_detail_instrumen_id) SELECT '$evaluasi_id',id FROM instrumen_evaluasi WHERE id NOT IN (SELECT evaluasi_detail_instrumen_id FROM form_evaluasi_detail WHERE evaluasi_detail_evaluasi_id='$evaluasi_id')");
        }



        $query = $this->db->query("SELECT * 
                FROM form_evaluasi
                JOIN form_evaluasi_detail ON evaluasi_id=evaluasi_detail_evaluasi_id
                JOIN instrumen_evaluasi ON evaluasi_detail_instrumen_id=instrumen_evaluasi.id
                WHERE evaluasi_id = '$evaluasi_id'
                ORDER BY instrumen_evaluasi.no ASC")->result();

        $query_nilai = $this->db->query("SELECT 
                COUNT(evaluasi_detail_id) AS jumlah, SUM(evaluasi_detail_jawaban) AS jawaban,  ROUND((SUM(evaluasi_detail_jawaban)/COUNT(evaluasi_detail_id)) * 100,2) AS nilai
                FROM form_evaluasi
                JOIN form_evaluasi_detail ON evaluasi_id=evaluasi_detail_evaluasi_id
                JOIN instrumen_evaluasi ON evaluasi_detail_instrumen_id=instrumen_evaluasi.id
                WHERE evaluasi_id = '$evaluasi_id'
                GROUP BY evaluasi_id")->row();

        if ($evaluasi_detail_id != "") {
            $this->db->query("UPDATE form_evaluasi_detail SET evaluasi_detail_jawaban=IF((SELECT evaluasi_detail_jawaban FROM form_evaluasi_detail WHERE evaluasi_detail_id='$evaluasi_detail_id') = 1,0,1),evaluasi_detail_tanggal=NOW() WHERE evaluasi_detail_id='$evaluasi_detail_id'");
        }
        $return =  '{"status": true, "data":' . json_encode($cek) . ',"instrumen":' . json_encode($query) . ',"nilai":' . json_encode($query_nilai) . '}';
        return $return;
    }




    function getHasilEvaluasi($evaluasi_id)
    {
        $cek = $this->db->query("SELECT *, id AS staff_id, nama AS staff_nama 
        FROM form_evaluasi
        JOIN user ON form_evaluasi.evaluasi_user_dinilai=user.id
        WHERE evaluasi_id='$evaluasi_id' 
        ")->row();

        $query = $this->db->query("SELECT * 
                FROM form_evaluasi
                JOIN form_evaluasi_detail ON evaluasi_id=evaluasi_detail_evaluasi_id
                JOIN instrumen_evaluasi ON evaluasi_detail_instrumen_id=instrumen_evaluasi.id
                WHERE evaluasi_id = '$evaluasi_id'
                ORDER BY instrumen_evaluasi.no ASC")->result();

        $query_nilai = $this->db->query("SELECT 
        COUNT(evaluasi_detail_id) AS jumlah, SUM(evaluasi_detail_jawaban) AS jawaban,  ROUND((SUM(evaluasi_detail_jawaban)/COUNT(evaluasi_detail_id)) * 100,2) AS nilai
        FROM form_evaluasi
        JOIN form_evaluasi_detail ON evaluasi_id=evaluasi_detail_evaluasi_id
        JOIN instrumen_evaluasi ON evaluasi_detail_instrumen_id=instrumen_evaluasi.id
        WHERE evaluasi_id = '$evaluasi_id'
        GROUP BY evaluasi_id")->row();




        $return =  '{"status": true, "data":' . json_encode($cek) . ',"instrumen":' . json_encode($query) . ',"nilai":' . json_encode($query_nilai) . '}';
        return $return;
    }







    function loadInstrumen($mninstrumen)
    {
    }
}
