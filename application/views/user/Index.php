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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="save-data" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">NIK</label>
                        <input type="number" name="nik" id="nik" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="" selected disabled>PILIH</option>
                            <?php foreach ($role as $r) { ?>
                                <option value="<?= $r->id ?>"><?= $r->role ?></option>
                            <?php } ?>
                        </select>
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
    <div class="modal-dialog modal-lg">
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
                    <div class="form-group">
                        <label for="">NIK</label>
                        <input type="number" name="nik" id="e_nik" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="nama" id="e_nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Role</label>
                        <select name="role" id="e_role" class="form-control">
                            <option value="" disabled>PILIH</option>
                            <?php foreach ($role as $r) { ?>
                                <option value="<?= $r->id ?>"><?= $r->role ?></option>
                            <?php } ?>
                        </select>
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

    function save_data() {
        $.ajax({
            url: '<?= site_url('User/save') ?>',
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
                    $('#nik').val('');
                    $('#nama').val('');
                    $('#role').val('');
                    load_data();
                }
            },
            complete: function() {}
        });
    }

    function edit_data(id, nik, nama, role) {
        $('#e_id').val(id);
        $('#e_nik').val(nik);
        $('#e_nama').val(nama);
        $('#e_role').val(role);
        $('#editData').modal('show');
    }

    function change_pass(id) {
        $('#c_id').val(id);
        $('#changePassword').modal('show');
    }

    function update_data() {
        $.ajax({
            url: '<?= site_url('User/update') ?>',
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