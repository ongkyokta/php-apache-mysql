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
                                        Tambah Data API Key
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
                            <div class="card-header">Data API Key</div>
                            <div class="card-body">
                                <div class="form-group col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <label class="small mb-1" for="nama_api">Nama API</label>
                                    <input class="form-control" id="nama_api" name="nama_api" type="text" placeholder="Masukkan nama API" value="<?= isset($_POST["nama_api"]) ? $_POST["nama_api"] : ''; ?>" />
                                    <?= form_error('nama_api', '<small class="text-danger pl-2">', '</small>'); ?>
                                </div>
                                <div class="form-group col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <label class="small mb-1" for="url">URL</label>
                                    <input class="form-control" id="url" name="url" type="text" placeholder="Masukkan URL" value="<?= isset($_POST["url"]) ? $_POST["url"] : ''; ?>" />
                                    <?= form_error('url', '<small class="text-danger pl-2">', '</small>'); ?>
                                </div>
                                <div class="form-group col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <label class="small mb-1" for="token">Token</label>
                                    <input class="form-control" id="token" name="token" type="text" placeholder="Masukkan token" value="<?= isset($_POST["token"]) ? $_POST["token"] : ''; ?>" />
                                    <?= form_error('token', '<small class="text-danger pl-2">', '</small>'); ?>
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
    var timeout = 3000;
    $('#alert').delay(timeout).fadeOut(300);
</script>

</html>