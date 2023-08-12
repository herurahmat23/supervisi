<table id="myTable" class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center" style="width: 30px;">No</th>
            <th>Ruangan </th>
            <th class="text-center" style="width: 80px;"><i class="fas fa-sliders-h"></i></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 0;
        foreach ($data as $d) : $no++; ?>
            <tr>
                <td class="text-center"><?= $no ?></td>
                <td><?= $d->ruangan ?></td>
                <td class="text-center">
                    <a onclick="edit_data('<?= $d->id ?>','<?= $d->ruangan ?>')" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                    <a onclick="delete_data('<?= $d->id ?>','<?= $d->ruangan ?>')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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