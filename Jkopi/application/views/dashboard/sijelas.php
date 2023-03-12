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
                                    <h1 class="page-header-title-dashboard text-center">Grafik Data Rekapitulasi Permintaan Surat-Surat Untuk Seluruh Kecamatan</h1>
                                </div>
                                <div class="col-xxl-1 col-xl-1 col-md-1 col-sm-1 mt-4">
                                    <img class="img-logo-dashboard-right" src="<?= base_url("assets/img/logo_sijelas.png") ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="container mt-n10">
                    <div class="card shadow-none card-header-actions mx-auto mb-4">
                        <div class="card-header">
                            <div class="btn btn-sm btn-dark px-3">
                                <a class="text-light" href="https://simpedasign.jemberkab.go.id/simpeda-pdf/view-report/home.html" target="_blank">Detail</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <iframe id="iframe_sijelas" src="https://simpedasign.jemberkab.go.id/simpeda-pdf/view-report-mobile/home.html" style=" width: 100%; height: 151rem; border: none;"></iframe>
                        </div>
                    </div>
            </main>
            <?php $this->load->view("_partials/footer") ?>
        </div>
    </div>
    <?php $this->load->view("_partials/js") ?>

</body>

</html>