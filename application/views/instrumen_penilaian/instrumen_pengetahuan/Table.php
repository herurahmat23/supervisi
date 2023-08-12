<table id="myTable" class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center" style="width: 30px;">No</th>
            <th>Soal</th>
            <th class="text-center" style="width: 100px;"><i class="fas fa-sliders-h"></i></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($data as $d) :  ?>
            <tr>
                <td class="text-center"><?= $d->no ?></td>
                <td><?= $d->soal ?></td>
                <td class="text-center">
                    <a onclick="edit_data('<?= $d->id ?>')" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                    <a onclick="delete_data('<?= $d->id ?>','<?= $d->no ?>')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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