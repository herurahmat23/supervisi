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
                                    echo '<div class="btn-group mb-1" role="group" aria-label="Basic example">';
                                    echo '<a href="' . base_url('Instrumen_penilaian/hasil_staff_cetak/') . $q->kategori_id . '/' . $dat->jadwal_id . '" target="_blank" title="' . $q->kategori . '" class="btn btn-block btn-info btn-sm"><i class="fas fa-print"></i> ' . $q->no . ' <i class="fas fa-info-circle"></i></a>';
                                    if ($this->session->userdata('id_role') == 1) {
                                        echo '<a onclick="modaldelete(' . $q->kategori_id . ',' . $dat->jadwal_id . ')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                                    }
                                    echo '</div>';
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

<div class="modal fade" id="deleteData" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('Instrumen_penilaian/delete_hasil_staff') ?>" id="delete-data" method="post">
                <div class="modal-body">
                    <input type="hidden" name="kategori" id="id_kategori">
                    <input type="hidden" name="jadwal" id="id_jadwal">
                    <div class="modal-body">
                        <h4><span>Apakah Anda Yakin Hapus Data?</span></h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Delete <i class="fas fa-check"></i></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fas fa-times"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });

    function modaldelete(kategori, jadwal) {
        $('#id_kategori').val(kategori);
        $('#id_jadwal').val(jadwal);
        $('#deleteData').modal('show');
    }
</script>

<script>
    $(document).ready(function() {
        <?php if ($this->session->flashdata('message')) : ?>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '<?php echo $this->session->flashdata('message'); ?>',
                toast: true,
                position: 'top-right',
                showConfirmButton: false,
                timer: 3000
            });
        <?php endif; ?>
    });
</script>