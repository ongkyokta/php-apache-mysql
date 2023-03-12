<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("_partials/head") ?>

<body class="nav-fixed">
    <?php $this->load->view("_partials/navbar") ?>
    <div id="layoutSidenav">
        <?php $this->load->view("_partials/sidebar") ?>
        <div id="layoutSidenav_content">
            <main>
                <header class="page-header page-header-dark bg-white pb-10">
                    <div class="container">
                        <div class="page-header-content pt-4">
                            <div class="col-12 row align-items-center justify-content-center p-0 m-0">
                                <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-3 col-xs-3 mt-4">
                                    <img class="img-logo-dashboard-left" src="<?= base_url("assets/img/logo_pemkab.png") ?>" alt="">
                                </div>
                                <div class="col-xxl-8 col-xl-8 col-md-8 col-sm-6 col-xs-6 mt-4">
                                    <h1 class="page-header-title-dashboard text-center">
                                        Grafik Data Aplikasi J-KOPI (Jember Kota Pintar)
                                    </h1>
                                </div>
                                <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-3 col-xs-3 mt-4">
                                    <img class="img-logo" src="<?= base_url("assets/img/logo_j_kopi_s.svg") ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="container mt-n10">
                    <div class="col-12 p-0">
                        <div class="row">
                            <div class="col-6">
                                <div class="card shadow-none mx-auto mb-4">
                                    <div class="card-body">
                                        <div class="row mb-4">
                                            <div class="col-4">
                                                <div class="card-header-total">
                                                    Total Registrasi
                                                </div>
                                                <div class="card-subheader-dashboard">
                                                    1.234.567
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="card-header-total">
                                                    Total Aktivasi
                                                </div>
                                                <div class="card-subheader-dashboard">
                                                    1.234.567
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="card-header-total">
                                                    Total Ditolak
                                                </div>
                                                <div class="card-subheader-dashboard">
                                                    1.234.567
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <canvas id="total_kunjungan"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card shadow-none mx-auto mb-4">
                                    <div class="card-body">
                                        <div class="card-header-dashboard mb-2">
                                            Total Kunjungan Per Kategori (Bulanan)
                                        </div>
                                        <canvas id="kategori_kunjungan"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 p-0">
                            <div class="card shadow-none mx-auto mb-4">
                                <div class="card-body">
                                    <div class="card-header-dashboard mb-2">
                                        Total Kunjungan Setiap Kategori
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="align-items-center justify-content-center">
                                                <canvas id="chart-pie1" style="position: relative; width: 2vw; height: 2vh"></canvas>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="datatable table-responsive">
                                                <table class="table table-striped table-bordered table-hover" id="category_table" width="100%" cellspacing="0">
                                                    <thead class="text-dark">
                                                        <tr>
                                                            <th width="30px">No</th>
                                                            <th>Nama Kategori</th>
                                                            <th width="100px">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-dark" id="category_table_body">
                                                        <tr>
                                                            <td>123</td>
                                                            <td>Nama kategori</td>
                                                            <td>123.456.789</td>
                                                        </tr>
                                                        <tr>
                                                            <td>123</td>
                                                            <td>Nama kategori</td>
                                                            <td>123.456.789</td>
                                                        </tr>
                                                        <tr>
                                                            <td>123</td>
                                                            <td>Nama kategori</td>
                                                            <td>123.456.789</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </main>
            <?php $this->load->view("_partials/footer") ?>
        </div>
    </div>
    <?php $this->load->view("_partials/js") ?>
    <script>
        $(document).ready(function() {
            $("#category_table").DataTable({
                paging: true,
                ordering: true,
                info: true,
                searching: true,
            });
        });

        var ctx = document.getElementById("kategori_kunjungan").getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["J-Yanmas", "Kedaruratan", "J-News", "J-Der", "Fasilitas Umum", "PPID", "UMKM"],
                datasets: [{
                    label: 'data-1',
                    data: [28, 24, 19, 17, 12, 7, 3],
                    backgroundColor: "rgba(0, 97, 242, 1)",
                }, ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                legend: {
                    display: false
                },
                plugins: {
                    datalabels: {
                        display: false,
                    },
                    outlabels: {
                        display: true,
                    },
                },
            },
        });

        var ctx = document.getElementById("total_kunjungan");
        var myLineChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                datasets: [{
                    label: "Kunjugnan",
                    lineTension: 0.3,
                    backgroundColor: "rgba(0, 97, 242, 0.05)",
                    borderColor: "rgba(0, 97, 242, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(0, 97, 242, 1)",
                    pointBorderColor: "rgba(0, 97, 242, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(0, 97, 242, 1)",
                    pointHoverBorderColor: "rgba(0, 97, 242, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [500, 50, 2424, 14040, 14141, 4111, 4544, 47, 5555, 6811, 14141, 4111],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    datalabels: {
                        display: false,
                    },
                    outlabels: {
                        display: true,
                    },
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: "date"
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                    }],
                    yAxes: [{
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: "#6e707e",
                    titleFontSize: 14,
                    borderColor: "#dddfeb",
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: "index",
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel =
                                chart.datasets[tooltipItem.datasetIndex].label || "";
                            return datasetLabel + ": " + tooltipItem.yLabel;
                        }
                    }
                }
            }
        });

        var ctx = $("#chart-pie1");
        var myPieChart = new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: [
                    "Kedaruratan",
                    "J-News",
                    "J-Der",
                    "J-Yanmas",
                    "Fasilitas Umum",
                ],
                datasets: [{
                    data: [25000, 20000, 15000, 10000, 5000],
                    borderWidth: 0,
                    backgroundColor: [
                        "#4799e2",
                        "#318dde",
                        "#2180d4",
                        "#1e73be",
                        "#1b66a8",
                    ],
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                tooltips: {
                    enabled: true,
                },
                legend: {
                    display: false,
                },
                zoomOutPercentage: 100,
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 50,
                        bottom: 50,
                    },
                },
                plugins: {
                    datalabels: {
                        formatter: (value, ctx) => {
                            let sum = 0;
                            let dataArr = ctx.chart.data.datasets[0].data;
                            dataArr.map((data) => {
                                sum += data;
                            });
                            let percentage = ((value * 100) / sum).toFixed(2) + "%";
                            return percentage;
                        },
                        color: "#fff",
                    },
                    legend: false,
                    outlabels: {
                        text: "%l %p",
                        color: "white",
                        stretch: 20,
                        font: {
                            resizable: true,
                            minSize: 12,
                            maxSize: 16,
                        },
                    },
                },
                cutoutPercentage: 0,
            },
        });
    </script>
</body>

</html>