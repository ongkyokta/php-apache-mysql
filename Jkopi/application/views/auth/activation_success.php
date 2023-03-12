<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("_partials/head.php") ?>

<body class="bg-white">
    <div id="layoutError">
        <main class="container">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div>
                        <div class="text-center mt-4">
                            <img class="img-fluid p-2" src="<?= base_url("assets/img/activation-success.gif") ?>" alt="Activation Success" />
                            <h3>Berhasil Mengaktifkan Akun</h3>
                            <p class="lead">Selamat datang di aplikasi J-KOPI.
                                Silahkan login pada aplikasi Android untuk mengajukan layanan surat menyurat, pengaduan, melihat berita terkini, event, dan fitur lainnya.
                            </p>
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
    <?php $this->load->view("_partials/js.php") ?>
</body>

</html>