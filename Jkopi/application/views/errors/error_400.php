<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("_partials/head") ?>

<body class="bg-white">
    <div id="layoutError">
        <main class="error-container">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center mt-4">
                            <img class="img-fluid p-4" src="<?= base_url("assets/img/error_400.gif") ?>" alt="ComingSoon" />
                            <p class="lead">Bad Request</p>
                            <a class="text-arrow-icon" href="javascript:history.go(-1)">
                                <i class="ml-0 mr-1" data-feather="arrow-left"></i>
                                Kembali ke halaman sebelumnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <div id="layoutError_footer">
            <footer class="footer mt-auto footer-light center">
                <div class="container-fluid">
                    <div class="col-md-12 align-items-center justify-content-center small">
                        Copyright &copy; Dinas Komunikasi dan Informatika Kabupaten Jember | <?= date("Y"); ?></a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <?php $this->load->view("_partials/js") ?>
</body>

</html>