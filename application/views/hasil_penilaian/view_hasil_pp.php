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
                        <th class="text-center" width="20px">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Ruangan</th>
                        <th class="text-center">Jadwal</th>
                        <!-- <th class="text-center">Selesai</th> -->
                        <th class="text-center" width="150px">Aksi</th>
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
                            <td><?= $dat->ruangan; ?></td>
                            <td class="text-center"><?= $dat->jadwal_tanggal; ?></td>
                            <!-- <td class="text-center"><?= $dat->jadwal_tanggal_selesai; ?></td> -->
                            <td class="text-center">
                                <?php

                                $this->db->select('kategori_instrumen_skp.no, kategori_instrumen_skp.kategori, form_supervisi.sp_id, kategori_instrumen_skp.id AS kategori_id');
                                $this->db->from('form_supervisi');
                                $this->db->join('instrumen_skp', 'form_supervisi.sp_instrumen_id = instrumen_skp.id');
                                $this->db->join('kategori_instrumen_skp', 'instrumen_skp.kategori = kategori_instrumen_skp.id');
                                $this->db->where('form_supervisi.sp_jadwal_id',  $dat->jadwal_id);
                                $this->db->where('form_supervisi.tanggapan IS NOT NULL', null, false);
                                $this->db->where('form_supervisi.pengarahan IS NOT NULL', null, false);
                                $this->db->where('form_supervisi.saran IS NOT NULL', null, false);
                                $this->db->group_by('kategori_instrumen_skp.no, kategori_instrumen_skp.kategori');
                                $this->db->order_by('kategori_instrumen_skp.no', 'ASC');

                                $query = $this->db->get()->result();


                                foreach ($query as $q) {
                                    echo '<a sty href="' . base_url('Instrumen_penilaian/hasil_staff_cetak/') . $q->kategori_id . '/' . $dat->jadwal_id . '" target="_blank" title="' . $q->kategori . '" class="btn btn-block btn-info btn-sm"><i class="fas fa-print"></i> ' . $q->no . ' <i class="fas fa-info-circle"></i></a>';
                                }

                                ?>
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