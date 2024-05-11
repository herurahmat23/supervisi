<div class="card card-outline card-lightblue">
    <div class="card-header">
        <h3 class="card-title">
        </h3>

    </div>
    <div class="card-body">
        <div class="table-responsive list-data">
            <table id="myTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Jabatan</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Penilai</th>
                        <th class="text-center">Nilai</th>';
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
                            <td class="text-center"><?= $dat->evaluasi_tanggal; ?></td>
                            <td><?= $dat->spv_nama; ?></td>
                            <td class="text-center"><?= $dat->nilai; ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('Instrumen_penilaian/evaluasi_cetak/') . $dat->evaluasi_id; ?>" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>



        </div>
    </div>
</div>

<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>