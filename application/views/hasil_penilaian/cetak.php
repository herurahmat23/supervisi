<!DOCTYPE html>
<html>

<head>
    <title>Cetak Report</title>
    <link rel="icon" href="<?php echo base_url('aset'); ?>/logo.png" type="image/x-icon" />
    <style type="text/css">
        @page {
            margin: 10px;
        }
    </style>
</head>

<body onload="window.print()">

    <br>
    <br>
    <table border="0" align="center" width="90%" style="border-collapse: collapse;">
        <tr>
            <td style="width: 15%;">
                <!-- <img src="<?= base_url('assets/dist/img/siatan_logo.png') ?>" style="width: 80px;"> -->
            </td>
            <td align="center">
                <h3 style="margin: 0px;"><?= $judul1; ?></h3>
                <h3 style="margin: 0px;"><?= $judul2; ?></h3>
            </td>
            <td align=" right" style="width: 15%;">
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <!-- <hr style="border: 2px solid black"> -->
            </td>
        </tr>
    </table>

    <br><br>


    <table style="text-align: left;" align="center" width="90%" style="border-collapse: collapse; border-spacing: 0px;">
        <tr>
            <td>Nama Perawat</td>
            <td style="width: 40%;"> : <?= $data[0]->nama; ?></td>
            <td>Hari/Tanggal</td>
            <td> : <?= ($data[0]->jadwal_tanggal_selesai != "" ? date('d F Y', strtotime($data[0]->jadwal_tanggal_selesai)) : ""); ?></td>
        </tr>
        <tr>
            <td>Supervisor</td>
            <td> : <?= $data[0]->spv_nama; ?></td>
            <td>Ruangan</td>
            <td> : <?= $data[0]->ruangan_nama; ?></td>
        </tr>

        <tr>
            <td colspan="4">
                <br>
                Petunjuk:<br>
                Beri tanda check list (v) pada kolom “Ya” bila pekerjaan dilakukan dan pada kolom “Tidak” bila pekerjaan tidak dilakukan.

            </td>
        </tr>
    </table>

    <br><br>


    <table border cellpadding="3" align="center" width="90%" style="border-collapse: collapse;">
        <tr style="text-align: center; font-weight: bold;">
            <th style="text-align: center;" rowspan="2">Kriteria</th>
            <th style="text-align: center;" colspan="2">Dilakukan</th>
        </tr>
        <tr>
            <th style="text-align: center;width: 10%;">Ya</th>
            <th style="text-align: center;width: 10%;">Tidak</th>
        </tr>
        <?php
        $aspek_old = "";
        $no = 0;
        $no2 = 0;

        $dilakukan = 0;
        $tidakdilakukan = 0;
        foreach ($data as $dat) {
            $no2++;
            if ($dat->sp_jawaban == '1') {
                $dilakukan++;
            } else {
                $tidakdilakukan++;
            }
            if ($dat->aspek == $aspek_old) {
        ?>
                <tr>
                    <td style="padding-left: 30px;"><?= $no2 . '. ' . $dat->instrumen; ?></td>
                    <td style="text-align: center;"><?= ($dat->sp_jawaban == '1' ? '&#10004;' : ''); ?></td>
                    <td style="text-align: center;"><?= ($dat->sp_jawaban == '0' ? '&#10004;' : ''); ?></td>

                </tr>
            <?php } else {
                $no++; ?>
                <tr>
                    <td><b><?= getRomawi($no) . '. ' . $dat->aspek; ?></b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding-left: 30px;"><?= $no2 . '. ' . $dat->instrumen; ?></td>
                    <td style="text-align: center;"><?= ($dat->sp_jawaban == '1' ? '&#10004;' : ''); ?></td>
                    <td style="text-align: center;"><?= ($dat->sp_jawaban == '0' ? '&#10004;' : ''); ?></td>

                </tr>
        <?php $aspek_old = $dat->aspek;
            }
        } ?>
    </table>

    <br><br>

    <?php
    $skor = $dilakukan / ($dilakukan + $tidakdilakukan) * 100;
    ?>
    <table style="text-align: left;" align="center" width="90%" style="border-collapse: collapse; border-spacing: 0px;">
        <tr>
            <td style="width: 20%;">Keterangan</td>
            <td style="width: 40%;"></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Dilakukan</td>
            <td style="width: 40%;"> : <?= $dilakukan; ?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Tidak Dilakukan</td>
            <td style="width: 40%;"> : <?= $tidakdilakukan; ?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Nilai</td>
            <td style="width: 40%;"> : <?= $dilakukan; ?> / <?= $dilakukan + $tidakdilakukan; ?> * 100 = <?= round($skor, 2); ?>
            <td>
            <td></td>
            <td></td>
        </tr>


        <tr>
            <td colspan="2"><br><br></td>
        </tr>
        <tr>
            <td colspan="2"><b>Tanggapan yang disupervisi:</b></td>
        </tr>
        <tr>
            <td colspan="2" style="padding-left: 30px;"><?= $data[0]->tanggapan; ?></td>
        </tr>
        <tr>
            <td colspan="2"><b>Pengarahan Langsung:</b></td>
        </tr>
        <tr>
            <td colspan="2" style="padding-left: 30px;"><?= $data[0]->pengarahan; ?></td>
        </tr>
        <tr>
            <td colspan="2"><b> dan tindak lanjut:</b></td>
        </tr>
        <tr>
            <td colspan="2" style="padding-left: 30px;"><?= $data[0]->saran; ?></td>
        </tr>
    </table>




    <br><br> <br><br>



    <table style="text-align: center;" align="center" width="90%" style="border-collapse: collapse; border-spacing: 0px;">
        <tr>
            <td>
                Yang di supervisi
                <br><br><br><br><br><br>
                <b>( <?= $data[0]->nama; ?> )</b>
            </td>
            <td>
                Supervisor
                <br><br><br><br><br><br>
                <b>( <?= $data[0]->spv_nama; ?> )</b>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Mengetahui,<br>
                Manajer Keperawatan
                <br><br><br><br><br><br>
                <b>( <?= $data[0]->mng_perawat; ?> )</b>
            </td>
        </tr>
    </table>






    <?php

    function getRomawi($int)
    {

        switch ($int) {

            case 1:

                return "I";

                break;

            case 2:

                return "II";

                break;

            case 3:

                return "III";

                break;

            case 4:

                return "IV";

                break;

            case 5:

                return "V";

                break;

            case 6:

                return "VI";

                break;

            case 7:

                return "VII";

                break;

            case 8:

                return "VIII";

                break;

            case 9:

                return "IX";

                break;

            case 10:

                return "X";

                break;

            case 11:

                return "XI";

                break;

            case 12:

                return "XII";

                break;
        }
    }

    ?>

</body>

</html>