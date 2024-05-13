<div class="row">
    <div class="col-lg-6 col-6">
        <!-- small card -->
        <div class="small-box bg-lightblue">
            <div class="inner">
                <h4>Grafik Laporan SKP Ruangan Perbulan</h4>
                <br>
            </div>
            <div class="icon">
                <i class="fas fa-chart-bar"></i>
            </div>
            <a data-toggle="modal" data-target="#modal_grafik_1" class="small-box-footer">
                Go <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-6 col-6">
        <!-- small card -->
        <div class="small-box bg-lightblue">
            <div class="inner">
                <h4>Grafik Laporan SKP Ruangan Pertahun</h4>
                <br>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <a data-toggle="modal" data-target="#modal_grafik_2" class="small-box-footer">
                Go <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<div id="modal_grafik_1" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Grafik Laporan SKP Ruangan Perbulan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
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

                        <button class="btn btn-primary" type="button" onclick="get_grafik_bulanan()"><i class="fas fa-eye"></i> View Data</button>
                    </form>
                </div>

                <hr>
                <div class="card" style="padding: 0;" id="container_chart_rata_individu">
                    <div class="card-header">
                        <h5 class="card-title" id="judul_indikator">RATA-RATA SKP BULANAN PER INDIVIDU</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="chart_rata_individu" style="height: 350px;"></canvas>
                    </div>
                </div>
                <div class="card" style="padding: 0;" id="container_chart_rata_skp">
                    <div class="card-header">
                        <h5 class="card-title" id="judul_indikator">RATA-RATA SKP BULANAN
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="chart_rata_skp" style="height: 350px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" aria-hidden="true" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<div id="modal_grafik_2" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Grafik Rata rata SKP Ruangan Pertahun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container">
                    <form class="form-inline">

                        <label class="mr-2" for="tahun">Tahun:</label>
                        <select class="form-control mr-4" id="tahun_2" name="tahun">
                            <?php
                            $tahun_sekarang = date("Y");
                            for ($tahun = 2024; $tahun <= 2030; $tahun++) {
                                echo "<option value='" . $tahun . "'>" . $tahun . "</option>";
                            }
                            ?>
                        </select>

                        <label class="mr-2" for="tahun">Ruangan:</label>
                        <select class="form-control mr-4" id="ruangan_2" name="ruangan">
                            <option>PILIH RUANGAN</option>
                            <?php foreach ($ruangan as $r) : ?>
                                <option value="<?= $r->id ?>"><?= $r->ruangan ?></option>
                            <?php endforeach ?>
                        </select>

                        <button class="btn btn-primary" type="button" onclick="get_grafik_tahunan()"><i class="fas fa-eye"></i> View Data</button>
                    </form>
                </div>

                <hr>
                <div class="card" style="padding: 0;" id="container_chart_rata_skp_tahunan">
                    <div class="card-header">
                        <h5 class="card-title" id="judul_indikator">RATA-RATA SKP RUANGAN PERTAHUN</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="chart_rata_skp_tahunan" style="height: 350px;"></canvas>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" aria-hidden="true" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url('assets/') ?>plugins/chart.js/Chart.min.js"></script>

<script>
    function get_grafik_bulanan() {
        get_grafik_rata_individu()
        get_grafik_rata_skp()
    }

    function get_grafik_tahunan() {
        get_grafik_rata_skp_tahunan()
    }

    function get_grafik_rata_individu() {
        let tahun = $('#tahun').val();
        let bulan = $('#bulan').val();
        let ruangan = $('#ruangan').val();

        $.ajax({
            url: '<?= site_url('Grafik/get_grafik_rata_individu') ?>',
            type: 'post',
            data: {
                tahun: tahun,
                bulan: bulan,
                ruangan: ruangan
            },
            dataType: 'JSON',
            success: function(data) {
                let rata = [];
                let nama = [];

                for (let i in data) {
                    rata.push(data[i].rata2);
                    nama.push(data[i].nama);
                }

                $('#chart_rata_individu').remove();
                $('#container_chart_rata_individu').append('<canvas id="chart_rata_individu" style="height: 350px;"></canvas>');

                var ctx_imprs = document.getElementById('chart_rata_individu').getContext('2d')
                var chart_rata_individu = new Chart(ctx_imprs, {
                    type: 'bar',
                    data: {
                        labels: nama,
                        datasets: [{
                            label: 'Rata rata',
                            data: rata,
                            backgroundColor: 'rgba(1, 19, 248, 0.8)',
                            borderColor: 'rgba(1, 19, 248, 0.8)',
                            pointRadius: 5,
                            pointBackgroundColor: 'rgba(1, 19, 248, 0.8)',
                            tension: 0,
                            fill: false
                        }]
                    },
                    options: {
                        responsive: true,
                        interaction: {
                            intersect: false,
                        },
                        scales: {
                            xAxes: [{
                                stacked: true,
                            }],
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true, // Mulai sumbu Y dari 0
                                    min: 0,
                                    // Tambahkan nilai maksimal sumbu Y di sini
                                    max: Math.max(...rata) + 10 // Maksimum adalah nilai tertinggi dari data + 10
                                }
                            }]
                        },
                        layout: {
                            padding: 0
                        }
                    }
                });
            }
        });
    }

    function get_grafik_rata_skp() {
        let tahun = $('#tahun').val();
        let bulan = $('#bulan').val();
        let ruangan = $('#ruangan').val();

        $.ajax({
            url: '<?= site_url('Grafik/get_grafik_rata_skp') ?>',
            type: 'post',
            data: {
                tahun: tahun,
                bulan: bulan,
                ruangan: ruangan
            },
            dataType: 'JSON',
            success: function(data) {
                let rata = [];
                let nama = [];

                for (let i in data) {
                    rata.push(data[i].rata2);
                    nama.push(data[i].nama);
                }

                $('#chart_rata_skp').remove();
                $('#container_chart_rata_skp').append('<canvas id="chart_rata_skp" style="height: 350px;"></canvas>');

                var ctx_imprs = document.getElementById('chart_rata_skp').getContext('2d')
                var chart_rata_individu = new Chart(ctx_imprs, {
                    type: 'bar',
                    data: {
                        labels: nama,
                        datasets: [{
                            label: 'Rata rata',
                            data: rata,
                            backgroundColor: 'rgba(1, 19, 248, 0.8)',
                            borderColor: 'rgba(1, 19, 248, 0.8)',
                            pointRadius: 5,
                            pointBackgroundColor: 'rgba(1, 19, 248, 0.8)',
                            tension: 0,
                            fill: false
                        }]
                    },
                    options: {
                        responsive: true,
                        interaction: {
                            intersect: false,
                        },
                        scales: {
                            xAxes: [{
                                stacked: true,
                            }],
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true, // Mulai sumbu Y dari 0
                                    min: 0,
                                    // Tambahkan nilai maksimal sumbu Y di sini
                                    max: Math.max(...rata) + 10 // Maksimum adalah nilai tertinggi dari data + 10
                                }
                            }]
                        },
                        layout: {
                            padding: 0
                        }
                    }
                });
            }
        });
    }

    function get_grafik_rata_skp_tahunan() {
        let tahun = $('#tahun_2').val();
        let ruangan = $('#ruangan_2').val();

        $.ajax({
            url: '<?= site_url('Grafik/get_grafik_rata_skp_tahunan') ?>',
            type: 'post',
            data: {
                tahun: tahun,
                ruangan: ruangan
            },
            dataType: 'JSON',
            success: function(data) {
                console.log(data)
                let rata = [];
                let nama = [];

                for (let i in data) {
                    rata.push(data[i].rata2);
                    nama.push(data[i].nama);
                }

                $('#chart_rata_skp_tahunan').remove();
                $('#container_chart_rata_skp_tahunan').append('<canvas id="chart_rata_skp_tahunan" style="height: 350px;"></canvas>');

                var ctx_imprs = document.getElementById('chart_rata_skp_tahunan').getContext('2d')
                var chart_rata_individu = new Chart(ctx_imprs, {
                    type: 'line',
                    data: {
                        labels: nama,
                        datasets: [{
                            label: 'Rata rata',
                            data: rata,
                            backgroundColor: 'rgba(1, 19, 248, 0.8)',
                            borderColor: 'rgba(1, 19, 248, 0.8)',
                            pointRadius: 5,
                            pointBackgroundColor: 'rgba(1, 19, 248, 0.8)',
                            tension: 0,
                            fill: false
                        }]
                    },
                    options: {
                        responsive: true,
                        interaction: {
                            intersect: false,
                        },
                        scales: {
                            xAxes: [{
                                stacked: true,
                            }],
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true, // Mulai sumbu Y dari 0
                                    min: 0,
                                    // Tambahkan nilai maksimal sumbu Y di sini
                                    max: Math.max(...rata) + 10 // Maksimum adalah nilai tertinggi dari data + 10
                                }
                            }]
                        },
                        layout: {
                            padding: 0
                        }
                    }
                });
            }
        });
    }
</script>