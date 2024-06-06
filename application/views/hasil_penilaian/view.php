<div class="card card-outline card-lightblue">
    <div class="card-header">
        <h3 class="card-title">
        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive list-data">
            <?php if (!empty($data)) { ?>
                <table id="myTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Jabatan</th>
                            <th class="text-center">Jadwal</th>
                            <th class="text-center">Selesai</th>
                            <?php
                            if ($data[0]->jabatan_id != '5') {
                                echo '<th class="text-center">Nilai</th>';
                            }
                            ?>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data as $dat) {
                            $no++;
                        ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td><?= $dat->nama; ?></td>
                                <td><?= $dat->jabatan; ?></td>
                                <td class="text-center"><?= $dat->jadwal_tanggal; ?></td>
                                <td class="text-center"><?= $dat->jadwal_tanggal_selesai; ?></td>
                                <?php
                                if ($data[0]->jabatan_id != '5') {
                                    echo '<td class="text-center">' . $dat->nilai . '</td>';
                                }
                                ?>
                                <td class="text-center">
                                    <?php
                                    $url = '';
                                    $button = '';
                                    if ($dat->jabatan_id == '3') {
                                        $button = '<a href="' . base_url('Instrumen_penilaian/hasil_karu_cetak/') . $dat->jadwal_id . '" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-print"></i></a>';
                                    } elseif ($dat->jabatan_id == '4') {
                                        $button = '<a href="' . base_url('Instrumen_penilaian/hasil_katim_cetak/') . $dat->jadwal_id . '" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-print"></i></a>';
                                    } elseif ($dat->jabatan_id == '5') {
                                        $url_info = explode(',', $dat->skp);
                                        $url_kategori = explode(',', $dat->kategori_id);
                                        for ($i = 0; $i < count($url_info); $i++) {
                                            $button =  $button . '<a href="' . base_url('Instrumen_penilaian/hasil_staff_cetak/') . $url_kategori[$i] . '/' . $dat->jadwal_id . '" target="_blank" class="btn btn-info btn-sm" style="margin-top: 5px;"><i class="fas fa-print"></i> ' . $url_info[$i] . '</a><br>';
                                        }
                                    }
                                    ?>
                                    <?= $button; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="alert alert-warning text-center" role="alert">
                    Data tidak tersedia.
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>