<style>
    th {
        text-align: center;
        /* Mengatur teks ke tengah */
        vertical-align: middle;
        /* Mengatur teks secara vertikal ke tengah */
    }
</style>
<table id="" class="table table-sm table-bordered">
    <thead>
        <tr>
            <th class="text-center" style="width: 30px;font-size: 10pt;vertical-align: baseline;">No</th>
            <th style="font-size: 10pt;vertical-align: baseline;">Nama</th>
            <?php foreach ($skp as $s) : ?>
                <th class="text-center" style="font-size: 8pt;vertical-align: baseline;"><?= $s->no . ' - ' . $s->kategori ?></th>
            <?php endforeach ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 0;
        foreach ($data_user as $u) {
            $no++;
        ?>
            <tr>
                <td class="text-center"><?= $no ?></td>
                <td><?= $u->nama ?></td>
                <?php
                // Variabel bantuan untuk menandai apakah nilai RTL ditemukan
                $rtl_ditemukan = false;

                // Iterasi melalui setiap SKP
                foreach ($skp as $s) {
                    // Iterasi melalui data RTL
                    foreach ($data_rtl as $rtl) {
                        // Periksa apakah id user dan id skp cocok
                        if ($rtl->id_user == $u->id && $rtl->id_skp == $s->id) {
                            // Jika ditemukan, tampilkan nilai dan RTL
                            echo '<td> Nilai : ' . $rtl->nilai . ' <br>
                                    RTL : ' . $rtl->saran . '
                        </td>';
                            // Setel variabel bantuan menjadi true
                            $rtl_ditemukan = true;
                            // Keluar dari loop setelah menemukan RTL
                            break;
                        }
                    }

                    // Jika nilai RTL tidak ditemukan, tampilkan -
                    if (!$rtl_ditemukan) {
                        echo '<td>-</td>';
                    }

                    // Reset variabel bantuan
                    $rtl_ditemukan = false;
                }
                ?>
            </tr>
        <?php } ?>
    </tbody>

</table>


<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            ordering: false
        });
    });
</script>