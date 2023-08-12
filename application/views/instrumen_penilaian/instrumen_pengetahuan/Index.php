<div class="card card-outline card-lightblue">
    <div class="card-header">
        <h3 class="card-title">
        </h3>
        <div class="col-auto ms-auto d-print-none">
            <div class="card-action">
                <a href="<?= site_url('Instrumen_penilaian') ?>" class="btn btn-danger btn-flat"><i class="fas fa-caret-left"></i> Kembali</a>
                <button data-toggle="modal" data-target="#addData" type="button" class="btn btn-primary btn-flat"><i class="fas fa-plus-circle"></i> Tambah Data</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive list-data">

        </div>
    </div>
</div>

<div class="modal fade" id="addData" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="save-data" method="post">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-1">
                            <label for="">No Soal</label>
                            <input type="number" name="no" id="no" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Soal</label>
                            <textarea name="soal" id="soal" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="">Pilihan A</label>
                            <textarea name="pilihan_a" id="pilihan_a" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Nilai A</label>
                            <input type="number" name="nilai_a" id="nilai_a" class="form-control">
                        </div>
                        <div class="form-group col-md-10">
                            <label for="">Pilihan B</label>
                            <textarea name="pilihan_b" id="pilihan_b" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Nilai B</label>
                            <input type="number" name="nilai_b" id="nilai_b" class="form-control">
                        </div>
                        <div class="form-group col-md-10">
                            <label for="">Pilihan C</label>
                            <textarea name="pilihan_c" id="pilihan_c" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Nilai C</label>
                            <input type="number" name="nilai_c" id="nilai_c" class="form-control">
                        </div>
                        <div class="form-group col-md-10">
                            <label for="">Pilihan D</label>
                            <textarea name="pilihan_d" id="pilihan_d" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Nilai D</label>
                            <input type="number" name="nilai_d" id="nilai_d" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="save_data()" type="button" class="btn btn-primary">Save <i class="fas fa-save"></i></button>
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
            <form action="" id="edit-data" method="post">
                <input type="hidden" name="id" id="e_id" class="form-control">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-1">
                            <label for="">No Soal</label>
                            <input type="number" name="no" id="e_no" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Soal</label>
                            <textarea name="soal" id="e_soal" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="">Pilihan A</label>
                            <textarea name="pilihan_a" id="e_pilihan_a" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Nilai A</label>
                            <input type="number" name="nilai_a" id="e_nilai_a" class="form-control">
                        </div>
                        <div class="form-group col-md-10">
                            <label for="">Pilihan B</label>
                            <textarea name="pilihan_b" id="e_pilihan_b" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Nilai B</label>
                            <input type="number" name="nilai_b" id="e_nilai_b" class="form-control">
                        </div>
                        <div class="form-group col-md-10">
                            <label for="">Pilihan C</label>
                            <textarea name="pilihan_c" id="e_pilihan_c" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Nilai C</label>
                            <input type="number" name="nilai_c" id="e_nilai_c" class="form-control">
                        </div>
                        <div class="form-group col-md-10">
                            <label for="">Pilihan D</label>
                            <textarea name="pilihan_d" id="e_pilihan_d" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Nilai D</label>
                            <input type="number" name="nilai_d" id="e_nilai_d" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="update_data()" type="button" class="btn btn-primary">Save <i class="fas fa-save"></i></button>
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
                        <h4><span>Apakah Anda Yakin Hapus Soal No : <strong><span id="nama_delete"></span></strong> ?</span></h4>
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
    });

    function load_data() {
        $.ajax({
            url: '<?= site_url('Instrumen_penilaian/load_instrumen_pengetahuan') ?>',
            type: 'POST',
            dataType: "HTML",
            success: function(data) {
                $('.list-data').html(data)
            },
            complete: function() {}
        });
    }

    function save_data() {
        $.ajax({
            url: '<?= site_url('Instrumen_penilaian/save_instrumen_pengetahuan') ?>',
            type: 'POST',
            data: $('#save-data').serialize(),
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
                    $('#no').val('');
                    $('#soal').val('');
                    $('#pilihan_a').val('');
                    $('#pilihan_b').val('');
                    $('#pilihan_c').val('');
                    $('#pilihan_d').val('');
                    $('#nilai_a').val('');
                    $('#nilai_b').val('');
                    $('#nilai_c').val('');
                    $('#nilai_d').val('');
                    load_data();
                }
            },
            complete: function() {}
        });
    }

    function edit_data(id) {
        $.ajax({
            url: '<?= site_url('Instrumen_penilaian/get_by_id_instrumen_pengetahuan') ?>',
            type: 'POST',
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(data) {
                $('#e_id').val(data.id);
                $('#e_no').val(data.no);
                $('#e_soal').val(data.soal);
                $('#e_pilihan_a').val(data.pilihan_a);
                $('#e_pilihan_b').val(data.pilihan_b);
                $('#e_pilihan_c').val(data.pilihan_c);
                $('#e_pilihan_d').val(data.pilihan_d);
                $('#e_nilai_a').val(data.nilai_a);
                $('#e_nilai_b').val(data.nilai_b);
                $('#e_nilai_c').val(data.nilai_c);
                $('#e_nilai_d').val(data.nilai_d);
                $('#editData').modal('show');
            },
            complete: function() {}
        });
    }

    function change_pass(id) {
        $('#c_id').val(id);
        $('#changePassword').modal('show');
    }

    function update_data() {
        $.ajax({
            url: '<?= site_url('Instrumen_penilaian/update_instrumen_pengetahuan') ?>',
            type: 'POST',
            data: $('#edit-data').serialize(),
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
            url: '<?= site_url('Instrumen_penilaian/delete_instrumen_pengetahuan') ?>',
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