<table id="myTable" class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center" style="width: 20px;">No</th>
            <th>Aspek</th>
            <th class="text-center" style="width: 30px;">No Urut</th>
            <th>Instrumen</th>
            <th class="text-center" style="width: 70px;"><i class="fas fa-sliders-h"></i></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 0;
        foreach ($data as $d) :
            $no++;

        ?>
            <tr>
                <td class="text-center"><?= $no ?></td>
                <td><?= $d->nama_aspek ?></td>
                <td class="text-center"><?= $d->no ?></td>
                <td><?= $d->instrumen ?></td>
                <td class="text-center">
                    <a onclick="edit_data('<?= $d->id ?>','<?= $d->no ?>','<?= $d->id_aspek ?>','<?= $d->instrumen ?>')" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
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