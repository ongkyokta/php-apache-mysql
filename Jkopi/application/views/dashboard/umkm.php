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
                                <div class="col-xxl-1 col-xl-1 col-md-1 col-sm-1 mt-4">
                                    <img class="img-logo-dashboard-left" src="<?= base_url("assets/img/logo_pemkab.png") ?>" alt="">
                                </div>
                                <div class="col-xxl-10 col-xl-10 col-md-10 col-sm-10 mt-4">
                                    <h1 class="page-header-title-dashboard text-center">
                                        Grafik Data UMKM Pemkab Jember
                                    </h1>
                                </div>
                                <div class="col-xxl-1 col-xl-1 col-md-1 col-sm-1 mt-4">
                                    <img class="img-logo-dashboard-right" src="<?= base_url("assets/img/logo_umkm.png") ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="container mt-n10">
                    <div class="col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-xs-12 mb-4">
                        <div class="card shadow-none card-header-actions mx-auto mb-4">
                            <div class="card-header">
                                Grafik Kategori Produk
                            </div>
                            <div class="card-body">
                                <div style="position: relative; width:100%;">
                                    <canvas id="chartJumlahProduk" width="100%" height="50" style="position: relative; width: 100%; height: auto"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-xs-12 mb-4">
                        <div class="card shadow-none card-header-actions mx-auto mb-4">
                            <div class="card-header">
                                Grafik Rata-Rata Harga Tiap Kategori
                            </div>
                            <div class="card-body">
                                <div style="position: relative; width:100%;">
                                    <canvas id="chartHarga" width="100%" height="50" style="position: relative; width: 100%; height: auto"></canvas>
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
        var chartJumlahProduk = document
            .getElementById("chartJumlahProduk")
            .getContext("2d");
        var chartHarga = document.getElementById("chartHarga").getContext("2d");
        $.ajax({
            url: "https://produkumkmjember.id/api/product?perpage=2000&apikey=sjP5KNp9A5sjPvHMVr4qQ7sQ8mku7sgNzYLb8V23",
            dataType: "jsonp",
            method: "GET",
            // cors: true,
            contentType: "application/json",
            secure: true,
            // headers: {
            //   'Access-Control-Allow-Origin': '*',
            // },
            beforeSend: function(data) {
                // console.log("Please Wait....");
                document.getElementById("myNav").style.height = "100%";
            },
            success: function(data) {
                document.getElementById("myNav").style.height = "0%";
                const response = data.results;

                // BAHAN DASAR
                let sumBahanDasar = 0;
                const bahanDasar = response.filter((item) => item.pr_kategori.ct_id === 7);
                const countBahanDasar = bahanDasar.length;
                bahanDasar.forEach((item) => (sumBahanDasar += item.pr_harga));
                const avgPriceBahanDasar = (sumBahanDasar / countBahanDasar).toFixed(0);

                // console.log("jumlah bahan dasar", countBahanDasar);
                // console.log("sum bahan dasar", sumBahanDasar);
                // console.log("avg bahan dasar", avgPriceBahanDasar);
                // console.log("=============================");

                // BATIK JEMBER
                let sumBatikJember = 0;
                const batikJember = response.filter((item) => item.pr_kategori.ct_id === 8);
                const countBatikJember = batikJember.length;
                batikJember.forEach((item) => (sumBatikJember += item.pr_harga));
                const avgPriceBatikJember = (sumBatikJember / countBatikJember).toFixed(0);

                // console.log("jumlah batik jember", countBatikJember);
                // console.log("sum batik jember", sumBatikJember);
                // console.log("avg batik jember", avgPriceBatikJember);
                // console.log("=============================");

                // CRAFT
                let sumCraft = 0;
                const craft = response.filter((item) => item.pr_kategori.ct_id === 5);
                const countCraft = craft.length;
                craft.forEach((item) => (sumCraft += item.pr_harga));
                const avgPriceCraft = (sumCraft / countCraft).toFixed(0);

                // console.log("jumlah craft", countCraft);
                // console.log("sum craft", sumCraft);
                // console.log("avg craft", avgPriceCraft);
                // console.log("=============================");

                // FASHON
                let sumFashion = 0;
                const fashion = response.filter((item) => item.pr_kategori.ct_id === 1);
                const countFashion = fashion.length;
                fashion.forEach((item) => (sumFashion += item.pr_harga));
                const avgPriceFashion = (sumFashion / countFashion).toFixed(0);

                // console.log("jumlah fashion", countFashion);
                // console.log("sum fashion", sumFashion);
                // console.log("avg fashion", avgPriceFashion);
                // console.log("=============================");

                // MAKANAN
                let sumMakanan = 0;
                const makanan = response.filter((item) => item.pr_kategori.ct_id === 4);
                const countMakanan = makanan.length;
                makanan.forEach((item) => (sumMakanan += item.pr_harga));
                const avgPriceMakanan = (sumMakanan / countMakanan).toFixed(0);

                // console.log("jumlah makanan", countMakanan);
                // console.log("sum makanan", sumMakanan);
                // console.log("avg makanan", avgPriceMakanan);
                // console.log("=============================");

                // MINUMAN
                let sumMinuman = 0;
                const minuman = response.filter((item) => item.pr_kategori.ct_id === 3);
                const countMinuman = minuman.length;
                minuman.forEach((item) => (sumMinuman += item.pr_harga));
                const avgPriceMinuman = (sumMinuman / countMinuman).toFixed(0);

                // console.log("jumlah minuman", countMinuman);
                // console.log("sum minuman", sumMinuman);
                // console.log("avg minuman", avgPriceMinuman);
                // console.log("=============================");

                // LAINNYA
                let sumLainnya = 0;
                const lainnya = response.filter((item) => item.pr_kategori.ct_id === 6);
                const countLainnya = lainnya.length;
                lainnya.forEach((item) => (sumLainnya += item.pr_harga));
                const avgPriceLainnya = (sumLainnya / countLainnya).toFixed(0);

                // console.log("jumlah lainnya", countLainnya);
                // console.log("sum lainnya", sumLainnya);
                // console.log("avg lainnya", avgPriceLainnya);
                // console.log("=============================");

                // RUMAH TANGGA
                let sumRumahTangga = 0;
                const rumahTangga = response.filter((item) => item.pr_kategori.ct_id === 2);
                const countRumahTangga = rumahTangga.length;
                rumahTangga.forEach((item) => (sumRumahTangga += item.pr_harga));
                const avgPriceRumahTangga = (sumRumahTangga / countRumahTangga).toFixed(0);

                // console.log("jumlah rumah tangga", countRumahTangga);
                // console.log("sum rumah tangga", sumLainnya);
                // console.log("avg rumah tangga", avgPriceRumahTangga);
                // console.log("=============================");

                const labels = [
                    "Bahan Dasar",
                    "Batik Jember",
                    "Craft",
                    "Fashion",
                    "Makanan",
                    "Minuman",
                    "Lainnya",
                    "Rumah Tangga",
                ];
                const averages = [
                    avgPriceBahanDasar,
                    avgPriceBatikJember,
                    avgPriceCraft,
                    avgPriceFashion,
                    avgPriceMakanan,
                    avgPriceMinuman,
                    avgPriceLainnya,
                    avgPriceRumahTangga,
                ];
                const counts = [
                    countBahanDasar,
                    countBatikJember,
                    countCraft,
                    countFashion,
                    countMakanan,
                    countMinuman,
                    countLainnya,
                    countRumahTangga,
                ];

                chartProduk(labels, counts);
                chartJumlah(labels, averages);
            },
        });

        function chartProduk(labels, data) {
            // console.log("Chart Produk");

            // console.log("label", labels);
            // console.log("data", data);

            var myChart = new Chart(chartJumlahProduk, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: labels,
                        data: data,
                        backgroundColor: [
                            "rgba(255,99,132,1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                            "rgba(255, 159, 64, 1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                            "rgba(255, 159, 64, 1)",
                        ],
                        borderColor: [
                            "rgba(255,99,132,1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                            "rgba(255, 159, 64, 1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                            "rgba(255, 159, 64, 1)",
                        ],
                        borderWidth: 1,
                    }, ],
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                            },
                        }, ],
                    },
                },
            });
        }

        function chartJumlah(labels, data) {
            // console.log("Chart Jumlah");
            // console.log("label", labels);
            // console.log("data", data);

            var myChart = new Chart(chartHarga, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: labels,
                        data: data,
                        backgroundColor: [
                            "rgba(255,99,132,1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                            "rgba(255, 159, 64, 1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                            "rgba(255, 159, 64, 1)",
                        ],
                        borderColor: [
                            "rgba(255,99,132,1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                            "rgba(255, 159, 64, 1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                            "rgba(255, 159, 64, 1)",
                        ],
                        borderWidth: 1,
                    }, ],
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                            },
                        }, ],
                    },
                    plugins: {
                        datalabels: {
                            formatter: (value, chartHarga) => {
                                let sum = 0;
                                let dataArr = chartHarga.chart.data.datasets[0].data;
                                dataArr.map((data) => {
                                    sum += data;
                                });
                                let percentage = "Rp " + value;
                                return percentage;
                            },
                        },
                    },
                },
            });
        }
    </script>
</body>

</html>