<div class="card card-outline card-lightblue">
    <div class="card-header">
        <h3 class="card-title">
        </h3>
        <div class="col-auto ms-auto d-print-none">
            <div class="card-action">
                <a href="<?= site_url('Master') ?>" class="btn btn-danger btn-flat"><i class="fas fa-caret-left"></i> Kembali</a>
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
                        <label for="">Ruangan</label>
                        <input type="text" name="ruangan" id="ruangan" class="form-control">
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
                        <label for="">Ruangan</label>
                        <input type="text" name="ruangan" id="e_ruangan" class="form-control">
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
            url: '<?= site_url('Master/load_data_ruangan') ?>',
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
            url: '<?= site_url('Master/save_ruangan') ?>',
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
                    $('#ruangan').val('');
                    load_data();
                }
            },
            complete: function() {}
        });
    }

    function edit_data(id, ruangan) {
        $('#e_id').val(id);
        $('#e_ruangan').val(ruangan);
        $('#editData').modal('show');
    }

    function update_data() {
        $.ajax({
            url: '<?= site_url('Master/update_ruangan') ?>',
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

                    $('#e_ruangan').val('');
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
            url: '<?= site_url('Master/delete_ruangan') ?>',
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