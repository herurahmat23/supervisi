<div class="card card-outline card-lightblue">
    <div class="card-header">
        <h3 class="card-title">
        </h3>
        <div class="col-auto ms-auto d-print-none">
            <div class="card-action">
                <!-- <a href="<?= site_url('Master') ?>" class="btn btn-danger btn-flat"><i class="fas fa-caret-left"></i> Kembali</a> -->
                <button data-toggle="modal" data-target="#addData" type="button" class="btn btn-primary btn-flat"><i class="fas fa-plus-circle"></i> Tambah Data</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive list-data">

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addData" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="save-data" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">NIK</label>
                            <input type="number" name="nik" id="nik" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="" selected disabled>PILIH</option>
                                <?php foreach ($role as $r) { ?>
                                    <option value="<?= $r->id ?>"><?= $r->role ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Jabatan</label>
                            <select name="jabatan" id="jabatan" class="form-control">
                                <option value="" selected disabled>PILIH</option>
                                <?php foreach ($jabatan as $j) { ?>
                                    <option value="<?= $j->id ?>"><?= $j->jabatan ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Ruangan</label>
                            <select name="ruangan" id="ruangan" class="form-control">
                                <option value="" selected disabled>PILIH</option>
                                <?php foreach ($ruangan as $ru) { ?>
                                    <option value="<?= $ru->id ?>"><?= $ru->ruangan ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                <option value="" selected disabled>PILIH</option>
                                <option value="Laki - laki">Laki - laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Email</label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Pendidikan</label>
                            <select name="pendidikan" id="pendidikan" class="form-control">
                                <option value="" selected disabled>PILIH</option>
                                <option value="DIII">DIII</option>
                                <option value="DIV">DIV</option>
                                <option value="Ners">Ners</option>
                                <option value="S2">S2</option>
                                <option value="S2 + Spesialis">S2 + Spesialis</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Masa Kerja</label>
                            <!-- <select name="masa_kerja" id="masa_kerja" class="form-control">
                                <option value="" selected disabled>PILIH</option>
                                <option value="1-5 tahun">1-5 tahun</option>
                                <option value="6-10 tahun">6-10 tahun</option>
                                <option value="> 11 tahun">> 11 tahun</option>
                            </select> -->
                            <input type="text" class="form-control" name="masa_kerja" id="masa_kerja">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Pelatihan Pasien Safety</label>
                            <select name="pelatihan_patient_safety" id="pelatihan_patient_safety" class="form-control">
                                <option value="" selected disabled>PILIH</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4" id="div_tahun" style="display: none;">
                            <label for="">Tahun Pelatihan Pasien Safety</label>
                            <input type="text" name="tahun_pelatihan_patient_safety" id="tahun_pelatihan_patient_safety" class="form-control">
                        </div>
                        <div class="form-group col-md-4" id="div_no_sertifikat" style="display: none;">
                            <label for="">No Sertifikat Pasien Safety</label>
                            <input type="text" name="no_sertifikat_patient_safety" id="no_sertifikat_patient_safety" class="form-control">
                        </div>
                        <div class="form-group col-md-8">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto">
                            <footer class="text-danger">
                                *File Type JPEG
                            </footer>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save <i class="fas fa-save"></i></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fas fa-times"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editData" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="edit-data" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="e_id" class="form-control">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">NIK</label>
                            <input type="number" name="nik" id="e_nik" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Nama</label>
                            <input type="text" name="nama" id="e_nama" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Role</label>
                            <select name="role" id="e_role" class="form-control">
                                <option value="" disabled>PILIH</option>
                                <?php foreach ($role as $r) { ?>
                                    <option value="<?= $r->id ?>"><?= $r->role ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Jabatan</label>
                            <select name="jabatan" id="e_jabatan" class="form-control">
                                <option value="" selected disabled>PILIH</option>
                                <?php foreach ($jabatan as $j) { ?>
                                    <option value="<?= $j->id ?>"><?= $j->jabatan ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Ruangan</label>
                            <select name="ruangan" id="e_ruangan" class="form-control">
                                <option value="" selected disabled>PILIH</option>
                                <?php foreach ($ruangan as $ru) { ?>
                                    <option value="<?= $ru->id ?>"><?= $ru->ruangan ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="e_jenis_kelamin" class="form-control">
                                <option value="" selected disabled>PILIH</option>
                                <option value="Laki - laki">Laki - laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Email</label>
                            <input type="text" name="email" id="e_email" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Pendidikan</label>
                            <select name="pendidikan" id="e_pendidikan" class="form-control">
                                <option value="" selected disabled>PILIH</option>
                                <option value="DIII">DIII</option>
                                <option value="DIV">DIV</option>
                                <option value="Ners">Ners</option>
                                <option value="S2">S2</option>
                                <option value="S2 + Spesialis">S2 + Spesialis</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Masa Kerja</label>
                            <!-- <select name="masa_kerja" id="e_masa_kerja" class="form-control">
                                <option value="" selected disabled>PILIH</option>
                                <option value="1-5 tahun">1-5 tahun</option>
                                <option value="6-10 tahun">6-10 tahun</option>
                                <option value="> 11 tahun">> 11 tahun</option>
                            </select> -->
                            <input type="text" class="form-control" name="e_masa_kerja" id="e_masa_kerja">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Pelatihan Pasien Safety</label>
                            <select name="pelatihan_patient_safety" id="e_pelatihan_patient_safety" class="form-control">
                                <option value="" selected disabled>PILIH</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4" id="e_div_tahun" style="display: none;">
                            <label for="">Tahun Pelatihan Pasien Safety</label>
                            <input type="text" name="tahun_pelatihan_patient_safety" id="e_tahun_pelatihan_patient_safety" class="form-control">
                        </div>
                        <div class="form-group col-md-4" id="e_div_no_sertifikat" style="display: none;">
                            <label for="">No Sertifikat Pasien Safety</label>
                            <input type="text" name="no_sertifikat_patient_safety" id="e_no_sertifikat_patient_safety" class="form-control">
                        </div>
                        <div class="form-group col-md-8">
                            <label for="exampleInputFile">Foto</label>
                            <input type="file" class="form-control" name="foto" id="e_foto_baru">
                            <input type="hidden" class="form-control" name="old_foto" id="e_foto">
                            <footer class="text-danger">
                                *File Type JPEG
                            </footer>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save <i class="fas fa-save"></i></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fas fa-times"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="changePassword" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="edit-password" method="post">
                <input type="hidden" name="id" id="c_id" class="form-control">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Masukan Password Baru</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="change_password()" type="button" class="btn btn-primary">Save <i class="fas fa-save"></i></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fas fa-times"></i></button>
                </div>
            </form>
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
            <form action="" id="delete-data" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_delete">
                    <div class="modal-body">
                        <h4><span>Apakah Anda Yakin Hapus Data : <strong><span id="nama_delete"></span></strong> ?</span></h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="hapus_data()" type="button" class="btn btn-primary">Delete <i class="fas fa-check"></i></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fas fa-times"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        load_data();

        $("#pelatihan_patient_safety").on("change", function() {
            var selectedValue = $(this).val();

            if (selectedValue === "Ya") {
                $("#div_tahun").show();
                $("#div_no_sertifikat").show();
            } else if (selectedValue === "Tidak") {
                $("#div_tahun").hide();
                $("#div_no_sertifikat").hide();
            }
        });

        $("#e_pelatihan_patient_safety").on("change", function() {
            var selectedValue = $(this).val();

            if (selectedValue === "Ya") {
                $("#e_div_tahun").show();
                $("#e_div_no_sertifikat").show();
            } else if (selectedValue === "Tidak") {
                $("#e_div_tahun").hide();
                $("#e_div_no_sertifikat").hide();
            }
        });

        $('#save-data').submit(function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: '<?= site_url('User/save') ?>',
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {
                    if (data.status == "fail") {
                        Toast.fire({
                            icon: 'error',
                            title: data.message
                        });
                    } else {
                        Toast.fire({
                            icon: 'success',
                            title: data.message
                        });
                        $('#nik').val('');
                        $('#nama').val('');
                        $('#role').val('');
                        $('#jabatan').val('');
                        $('#ruangan').val('');
                        $('#jenis_kelamin').val('');
                        $('#email').val('');
                        $('#pendidikan').val('');
                        $('#masa_kerja').val('');
                        $('#pelatihan_patient_safety').val('');
                        $('#tahun_pelatihan_patient_safety').val('');
                        $('#no_sertifikat_patient_safety').val('');
                        $('#foto').val('');
                        load_data();
                    }
                }

            });
            return false;
        });

        $('#edit-data').submit(function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            console.log(formData);
            $.ajax({
                url: '<?= site_url('User/update') ?>',
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {
                    if (data.status == "fail") {
                        Toast.fire({
                            icon: 'error',
                            title: data.message
                        });
                    } else {
                        Toast.fire({
                            icon: 'success',
                            title: data.message
                        });

                        $('#editData').modal('hide');
                        load_data();
                    }
                }

            });
            return false;
        });


    });


    function load_data() {
        $.ajax({
            url: '<?= site_url('User/load_data') ?>',
            type: 'POST',
            dataType: "HTML",
            success: function(data) {
                $('.list-data').html(data)
            },
            complete: function() {}
        });
    }

    // function save_data() {
    //     $.ajax({
    //         url: '<?= site_url('User/save') ?>',
    //         type: 'POST',
    //         data: $('#save-data').serialize(),
    //         dataType: "JSON",
    //         success: function(data) {
    //             if (data.status == "fail") {
    //                 Toast.fire({
    //                     icon: 'error',
    //                     title: data.message
    //                 });
    //             } else {
    //                 Toast.fire({
    //                     icon: 'success',
    //                     title: data.message
    //                 });
    //                 $('#nik').val('');
    //                 $('#nama').val('');
    //                 $('#role').val('');
    //                 $('#jabatan').val('');
    //                 $('#ruangan').val('');
    //                 $('#jenis_kelamin').val('');
    //                 $('#email').val('');
    //                 $('#pendidikan').val('');
    //                 $('#masa_kerja').val('');
    //                 $('#pelatihan_patient_safety').val('');
    //                 $('#tahun_pelatihan_patient_safety').val('');
    //                 $('#no_sertifikat_patient_safety').val('');
    //                 $('#foto').val('');
    //                 load_data();
    //             }
    //         },
    //         complete: function() {}
    //     });
    // }



    function edit_data(id, nik, nama, role, jabatan, ruangan, jenis_kelamin, email, pendidikan, masa_kerja, pelatihan_patient_safety, tahun_pelatihan_patient_safety, no_sertifikat_patient_safety, foto) {
        $('#e_id').val(id);
        $('#e_nik').val(nik);
        $('#e_nama').val(nama);
        $('#e_role').val(role);
        $('#e_jabatan').val(jabatan);
        $('#e_ruangan').val(ruangan);
        $('#e_jenis_kelamin').val(jenis_kelamin);
        $('#e_email').val(email);
        $('#e_pendidikan').val(pendidikan);
        $('#e_masa_kerja').val(masa_kerja);
        $('#e_pelatihan_patient_safety').val(pelatihan_patient_safety);
        $('#e_tahun_pelatihan_patient_safety').val(tahun_pelatihan_patient_safety);
        $('#e_no_sertifikat_patient_safety').val(no_sertifikat_patient_safety);
        $('#e_foto').val(foto);

        if (pelatihan_patient_safety === "Ya") {
            $("#e_div_tahun").show();
            $("#e_div_no_sertifikat").show();
        } else {
            $("#e_div_tahun").hide();
            $("#e_div_no_sertifikat").hide();
        }
        $('#editData').modal('show');
    }

    function change_pass(id) {
        $('#c_id').val(id);
        $('#changePassword').modal('show');
    }


    // function update_data() {
    //     $.ajax({
    //         url: '<?= site_url('User/update') ?>',
    //         type: 'POST',
    //         data: $('#edit-data').serialize(),
    //         dataType: "JSON",
    //         success: function(data) {
    //             if (data.status == "fail") {
    //                 Toast.fire({
    //                     icon: 'error',
    //                     title: data.message
    //                 });
    //             } else {
    //                 Toast.fire({
    //                     icon: 'success',
    //                     title: data.message
    //                 });

    //                 $('#editData').modal('hide');
    //                 load_data();
    //             }
    //         },
    //         complete: function() {}
    //     });
    // }

    function change_password() {
        $.ajax({
            url: '<?= site_url('User/edit_password') ?>',
            type: 'POST',
            data: $('#edit-password').serialize(),
            dataType: "JSON",
            success: function(data) {
                if (data.status == "fail") {
                    Toast.fire({
                        icon: 'error',
                        title: data.message
                    });
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });

                    $('#changePassword').modal('hide');
                    load_data();
                }
            },
            complete: function() {}
        });
    }

    function delete_data(id, nama) {
        $('#id_delete').val(id);
        $('#nama_delete').html(nama);
        $('#deleteData').modal('show');
    }

    function hapus_data() {
        $.ajax({
            url: '<?= site_url('User/delete') ?>',
            type: 'POST',
            data: $('#delete-data').serialize(),
            dataType: "JSON",
            success: function(data) {
                if (data.status == "fail") {
                    Toast.fire({
                        icon: 'error',
                        title: data.message
                    });
                } else {
                    Toast.fire({
                        icon: 'info',
                        title: data.message
                    });
                    $('#deleteData').modal('hide');
                    load_data();
                }
            },
            complete: function() {}
        });
    }
</script>