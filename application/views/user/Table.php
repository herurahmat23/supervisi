<table id="myTable" class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center" style="width: 30px;">No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Role</th>
            <th class="text-center" style="width: 100px;"><i class="fas fa-sliders-h"></i></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 0;
        foreach ($data as $d) : $no++; ?>
            <tr>
                <td class="text-center"><?= $no ?></td>
                <td><?= $d->nik ?></td>
                <td><?= $d->nama ?></td>
                <td><?= $d->role ?></td>
                <td class="text-center">
                    <a onclick="edit_data('<?= $d->id ?>',
                    '<?= $d->nik ?>',
                    '<?= $d->nama ?>',
                    '<?= $d->id_role ?>',
                    '<?= $d->jabatan ?>',
                    '<?= $d->ruangan ?>',
                    '<?= $d->jenis_kelamin ?>',
                    '<?= $d->email ?>',
                    '<?= $d->pendidikan ?>',
                    '<?= $d->masa_kerja ?>',
                    '<?= $d->pelatihan_patient_safety ?>',
                    '<?= $d->tahun_pelatihan_patient_safety ?>',
                    '<?= $d->no_sertifikat_patient_safety ?>',
                    '<?= $d->foto ?>',
                    )" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                    <a onclick="change_pass('<?= $d->id ?>')" class="btn btn-success btn-sm"><i class="fas fa-key"></i></a>
                    <a onclick="delete_data('<?= $d->id ?>','<?= $d->nama ?>')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                </td>
            </tr>

        <?php endforeach ?>
    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>