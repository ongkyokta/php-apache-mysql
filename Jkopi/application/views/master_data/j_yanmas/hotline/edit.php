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
                                        <div class="page-header-icon"><i data-feather="hard-drive"></i></div>
                                        Edit Data OPD/Dinas
                                    </h1>
                                    <div class="page-header-subtitle">Jember Kota Pintar</div>
                                </div>
                            </div>
                        </div>
                        <div id="alert"><?php echo $this->session->flashdata('message') ?></div>
                    </div>
                </header>
                <div class="container mt-n10">
                    <form action="" method="POST">
                        <div class="card shadow-none mb-4">
                            <div id="alert"><?php echo $this->session->flashdata('message') ?></div>
                            <div class="card-header">Data OPD/Dinas</div>
                            <div class="card-body">
                                <div class="form-row px-2">
                                    <div class="form-group col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label class="small mb-1" for="nama_opd">Nama OPD/Dinas</label>
                                        <input class="form-control" id="nama_opd" name="nama_opd" type="text" placeholder="Masukkkan nama OPD" value="<?= $Hotline->nama_opd ?>" disabled />
                                        <input class="form-control" id="id_opd" name="id_opd" type="text" value="<?= $Hotline->id_opd ?>" hidden />
                                        <?= form_error('nama_opd', '<small class="text-danger pl-2">', '</small>'); ?>
                                    </div>
                                    <div class="form-group col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label class="small mb-1" for="no_telp">Nomor Telepon</label>
                                        <input class="form-control" id="no_telp" name="no_telp" type="text" placeholder="Masukkkan Nomor Telepon" value="<?= $Hotline->no_telp ?>" onkeypress="return onlyNumber(event)" />
                                        <?= form_error('no_telp', '<small class="text-danger pl-2">', '</small>'); ?>
                                    </div>
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