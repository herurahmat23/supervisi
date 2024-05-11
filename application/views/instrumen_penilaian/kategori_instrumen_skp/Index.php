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
                        <label for="">No Kategori</label>
                        <select name="no" id="no" class="form-control">
                            <option value="">PILIH</option>
                            <option value="SKP 1">SKP 1</option>
                            <option value="SKP 2">SKP 2</option>
                            <option value="SKP 3">SKP 3</option>
                            <option value="SKP 4">SKP 4</option>
                            <option value="SKP 5">SKP 5</option>
                            <option value="SKP 6">SKP 6</option>

                            <option value="SKP 7">SKP 7</option>
                            <option value="SKP 8">SKP 8</option>
                            <option value="SKP 9">SKP 9</option>
                            <option value="SKP 10">SKP 10</option>
                            <option value="SKP 11">SKP 11</option>
                            <option value="SKP 12">SKP 12</option>
                            <option value="SKP 13">SKP 13</option>
                            <option value="SKP 14">SKP 14</option>
                            <option value="SKP 15">SKP 15</option>
                            <option value="SKP 16">SKP 16</option>
                            <option value="SKP 17">SKP 17</option>
                            <option value="SKP 18">SKP 18</option>
                            <option value="SKP 19">SKP 19</option>
                            <option value="SKP 20">SKP 20</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Kategori</label>
                        <input type="text" name="kategori" id="kategori" class="form-control">
                    </div>
                    <input type="hidden" name="jenis" id="jenis" value="2">
                    <!-- <div class="form-group">
                        <label for="">Jenis</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="">PILIH</option>
                            <option value="1">Kemenkes</option>
                            <option value="2">SPO Rumah Sakit</option>
                        </select>
                    </div> -->
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
                        <label for="">No Kategori</label>
                        <select name="no" id="e_no" class="form-control">
                            <option value="">PILIH</option>
                            <option value="SKP 1">SKP 1</option>
                            <option value="SKP 2">SKP 2</option>
                            <option value="SKP 3">SKP 3</option>
                            <option value="SKP 4">SKP 4</option>
                            <option value="SKP 5">SKP 5</option>
                            <option value="SKP 6">SKP 6</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Kategori</label>
                        <input type="text" name="kategori" id="e_kategori" class="form-control">
                    </div>
                    <input type="hidden" name="jenis" id="e_jenis" value="2">
                    <!-- <div class="form-group">
                        <label for="">Jenis</label>
                        <select name="jenis" id="e_jenis" class="form-control">
                            <option value="">PILIH</option>
                            <option value="1">Kemenkes</option>
                            <option value="2">SPO Rumah Sakit</option>
                        </select>
                    </div> -->
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
            url: '<?= site_url('Instrumen_penilaian/load_kategori_instrumen_skp') ?>',
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
            url: '<?= site_url('Instrumen_penilaian/save_kategori_instrumen_skp') ?>',
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
                    $('#kategori').val('');
                    $('#jenis').val('');
                    load_data();
                }
            },
            complete: function() {}
        });
    }

    function edit_data(id, no, kategori, jenis) {
        $('#e_id').val(id);
        $('#e_no').val(no);
        $('#e_kategori').val(kategori);
        $('#e_jenis').val(jenis);
        $('#editData').modal('show');
    }

    function update_data() {
        $.ajax({
            url: '<?= site_url('Instrumen_penilaian/update_kategori_instrumen_skp') ?>',
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

                    $('#e_no').val('');
                    $('#e_kategori').val('');
                    $('#e_jenis').val('');
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
            url: '<?= site_url('Instrumen_penilaian/delete_kategori_instrumen_skp') ?>',
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