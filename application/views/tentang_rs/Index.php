<div class="card card-lightblue">
    <div class="card-header">
        <h3 class="card-title">Tentang Rumah Sakit</h3>
    </div>

    <div class="card-body list-data">

    </div>

    <div class="card-footer">
        <button data-toggle="modal" data-target="#addData" class="btn btn-primary btn-block"><i class="fas fa-sync-alt"></i> Edit Tentang RS </button>
    </div>
</div>

<div class="modal fade" id="addData" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Rumah sakit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="save-data" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Rumah Sakit</label>
                        <input type="hidden" name="id" id="id" class="form-control" value="<?= $data->id ?>">
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $data->nama ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Profil Rumah Sakit</label>
                        <textarea rows="10" name="profil" id="profil" class="form-control"><?= $data->profil ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Visi</label>
                        <textarea rows="10" name="visi" id="visi" class="form-control"><?= $data->visi ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Misi</label>
                        <textarea rows="10" name="misi" id="misi" class="form-control"><?= $data->misi ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Motto</label>
                        <textarea rows="10" name="motto" id="motto" class="form-control"><?= $data->motto ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Maklumat Pelayanan</label>
                        <textarea rows="10" name="maklumat_pelayanan" id="maklumat_pelayanan" class="form-control"><?= $data->maklumat_pelayanan ?></textarea>
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

<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        load_data();


        $('#save-data').submit(function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: '<?= site_url('Tentang_rs/update') ?>',
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
                        $('#addData').modal('hide');
                        load_data();
                    }
                }

            });
            return false;
        });
    });

    function load_data() {
        $.ajax({
            url: '<?= site_url('Tentang_rs/load_data') ?>',
            type: 'POST',
            dataType: "HTML",
            success: function(data) {
                $('.list-data').html(data)
            },
            complete: function() {}
        });
    }
</script>