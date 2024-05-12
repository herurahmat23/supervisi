<div class="card card-outline card-lightblue">
    <div class="card-header">
        <h3 class="card-title">
        </h3>
        <div class="col-auto ms-auto d-print-none">
            <div class="card-action">
                <div class="container">
                    <form class="form-inline">
                        <label class="mr-2" for="bulan">Bulan:</label>
                        <select class="form-control mr-4" id="bulan" name="bulan">
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>

                        <label class="mr-2" for="tahun">Tahun:</label>
                        <select class="form-control mr-4" id="tahun" name="tahun">
                            <?php
                            $tahun_sekarang = date("Y");
                            for ($tahun = 2024; $tahun <= 2030; $tahun++) {
                                echo "<option value='" . $tahun . "'>" . $tahun . "</option>";
                            }
                            ?>
                        </select>

                        <label class="mr-2" for="tahun">Ruangan:</label>
                        <select class="form-control mr-4" id="ruangan" name="ruangan">
                            <option>PILIH RUANGAN</option>
                            <?php foreach ($ruangan as $r) : ?>
                                <option value="<?= $r->id ?>"><?= $r->ruangan ?></option>
                            <?php endforeach ?>
                        </select>

                        <button class="btn btn-primary" type="button" onclick="load_data()"><i class="fas fa-eye"></i> View Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive list-data">

        </div>
    </div>
</div>

<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
<script>
    // $(document).ready(function() {
    //     load_data();
    // });

    function load_data() {
        $.ajax({
            url: '<?= site_url('Instrumen_penilaian/get_laporan_rtl_bulanan') ?>',
            type: 'POST',
            data: {
                ruangan: $('#ruangan').val(),
                tahun: $('#tahun').val(),
                bulan: $('#bulan').val()
            },
            dataType: "HTML",
            success: function(data) {
                Toast.fire({
                    icon: 'success',
                    title: 'Success'
                });
                $('.list-data').html(data)
            },
            complete: function() {}
        });
    }
</script>