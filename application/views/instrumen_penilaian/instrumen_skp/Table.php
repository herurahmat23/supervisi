<table id="myTable" class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center" style="width: 20px;">No</th>
            <th class="text-center" style="width: 30px;">SKP</th>
            <th class="text-center" style="width: 30px;">No Urut</th>
            <th>Kategori</th>
            <th>Instrumen</th>
            <th style="width: 120px;">Jenis</th>
            <th class="text-center" style="width: 70px;"><i class="fas fa-sliders-h"></i></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 0;
        foreach ($data as $d) :
            $no++;
            if ($d->jenis == "1") {
                $jenis = 'Kemenkes';
            } else  if ($d->jenis == "2") {
                $jenis = 'SPO Rumah Sakit';
            }
        ?>
            <tr>
                <td class="text-center"><?= $no ?></td>
                <td class="text-center"><?= $d->no_skp ?></td>
                <td class="text-center"><?= $d->no ?></td>
                <td><?= $d->nama_kategori ?></td>
                <td><?= $d->instrumen ?></td>
                <td><?= $jenis ?></td>
                <td class="text-center">
                    <a onclick="edit_data('<?= $d->id ?>','<?= $d->no ?>','<?= $d->id_kategori ?>','<?= $d->instrumen ?>')" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                    <a onclick="delete_data('<?= $d->id ?>','<?= $d->instrumen ?>')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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