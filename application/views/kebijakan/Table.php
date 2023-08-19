<table id="myTable" class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center" style="width: 30px;">No</th>
            <th>Judul </th>
            <th class="text-center" style="width: 80px;"><i class="fas fa-sliders-h"></i></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 0;
        foreach ($data as $d) : $no++; ?>
            <tr>
                <td class="text-center"><?= $no ?></td>
                <td><?= $d->nama ?></td>
                <td class="text-center">
                    <a href="<?= base_url('uploads/kebijakan/') . $d->file ?>" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
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