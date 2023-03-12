<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("_partials/head") ?>

<body class="nav-fixed">
    <?php $this->load->view("_partials/navbar") ?>
    <div id="layoutSidenav">
        <?php $this->load->view("_partials/sidebar") ?>
        <div id="layoutSidenav_content">
            <main>
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                    <div class="container">
                        <div class="page-header-content pt-4">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mt-4">
                                    <h1 class="page-header-title">
                                        <div class="page-header-icon"><i data-feather="smartphone"></i></div>
                                        Tambah Data Versi Aplikasi
                                    </h1>
                                    <div class="page-header-subtitle">Jember Kota Pintar</div>
                                </div>
                            </div>
                        </div>
                        <div id="alert"><?php echo $this->session->flashdata('message') ?></div>
                    </div>
                </header>
                <div class="container mt-n10">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="card shadow-none mb-4">
                            <div id="alert"><?php echo $this->session->flashdata('message') ?></div>
                            <div class="card-header">Data Versi Aplikasi</div>
                            <div class="card-body">
                                <div class="form-group col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <label class="small mb-1" for="versi_aplikasi">Versi Aplikasi</label>
                                    <input class="form-control" id="versi_aplikasi" name="versi_aplikasi" type="text" placeholder="Masukkan versi aplikasi" value="<?= isset($_POST["versi_aplikasi"]) ? $_POST["versi_aplikasi"] : ''; ?>" />
                                    <?= form_error('versi_aplikasi', '<small class="text-danger pl-2">', '</small>'); ?>
                                </div>
                                <div class="form-group col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 px-2">
                                    <label class="small mb-1" for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" type="text" rows="10" placeholder="Masukkan deskripsi versi aplikasi"><?= isset($_POST["deskripsi"]) ? $_POST["deskripsi"] : ''; ?></textarea>
                                    <?= form_error('deskripsi', '<small class="text-danger pl-2">', '</small>'); ?>
                                </div>
                                <hr class="my-4" />
                                <button class="btn btn-primary" type="submit">Simpan</button>
                                <a class="btn btn-danger" href="javascript:history.go(-1)">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </main>
            <?php $this->load->view("_partials/footer") ?>
        </div>
    </div>
    <?php $this->load->view("_partials/js") ?>
</body>
<script>
    CKEDITOR.replace('deskripsi');
    CKEDITOR.config.autoParagraph = false;
    CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
    CKEDITOR.config.shiftEnterMode = CKEDITOR.ENTER_P;

    var timeout = 3000;
    $('#alert').delay(timeout).fadeOut(300);
</script>

</html>