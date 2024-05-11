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
            <td>Nama Supervisor</td>
            <td style="width: 40%;"> : <?= $data[0]->nama; ?></td>
            <td>Hari/Tanggal</td>
            <td> : <?= ($data[0]->evaluasi_tanggal != "" ? date('d F Y', strtotime($data[0]->evaluasi_tanggal)) : ""); ?></td>
        </tr>
        <tr>
            <td>Atasan Supervisor</td>
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
        $dilakukan = 0;
        $tidakdilakukan = 0;
        foreach ($data as $dat) {
            $no++;
            if ($dat->evaluasi_detail_jawaban == '1') {
                $dilakukan++;
            } else {
                $tidakdilakukan++;
            }
        ?>
            <tr>
                <td style="padding-left: 30px;"><?= $no . '. ' . $dat->instrumen; ?></td>
                <td style="text-align: center;"><?= ($dat->evaluasi_detail_jawaban == '1' ? '&#10004;' : ''); ?></td>
                <td style="text-align: center;"><?= ($dat->evaluasi_detail_jawaban == '0' ? '&#10004;' : ''); ?></td>
            </tr>
        <?php
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
    </table>




    <br><br>



    <table style="text-align: center;" align="center" width="90%" style="border-collapse: collapse; border-spacing: 0px;">
        <tr>
            <td style="width: 50%;">

            </td>
            <td>
                Atasan Supervisor
                <br><br><br><br><br><br>
                <b>( <?= $data[0]->spv_nama; ?> )</b>
            </td>
        </tr>

    </table>






</html>