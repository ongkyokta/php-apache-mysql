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
                                        <div class="page-header-icon"><i data-feather="users"></i></div>
                                        Detail User
                                    </h1>
                                    <div class="page-header-subtitle">Jember Kota Pintar</div>
                                </div>
                            </div>
                        </div>
                        <div id="alert"><?php echo $this->session->flashdata('message') ?></div>
                    </div>
                </header>
                <div class="container mt-n10">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="card shadow-none mb-4">
                            <div class="card-header">Data User</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-12">
                                        <label>ID Pengguna</label>
                                        <p><b><?= $User->id_pengguna ?></b></p>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <label>NIK</label>
                                        <p><b><?= $User->nik ?></b></p>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <label>Nama Lengkap</label>
                                        <p><b><?= $User->nama_lengkap ?></b></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-12">
                                        <label>Email</label>
                                        <p><b><?= $User->email ?></b></p>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <label>Nomor Telepon</label>
                                        <p><b><?= $User->nomor_telepon ?></b></p>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <label>Alamat</label>
                                        <p><b><?= $User->alamat ?></b></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-12">
                                        <label>Status</label><br>
                                        <?php if ($User->is_active == 'aktif') { ?>
                                            <div class="badge badge-success badge-pill">Aktif</div>
                                        <?php } else { ?>
                                            <div class="badge badge-danger badge-pill">Tidak Aktif</div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <?php if ($User->is_active == 'aktif') { ?>
                                    <a class="btn btn-danger" href="onclick=" confirm_modal() data-toggle="modal" data-target="#modalNonactive">Non Aktifkan Akun</a>
                                <?php } else { ?>
                                    <a class="btn btn-success" href="onclick=" confirm_modal() data-toggle="modal" data-target="#modalActive">Aktifkan Akun</a>
                                <?php } ?>
                                <a class="btn btn-primary" href="<?= base_url("master_data/Pengguna") ?>">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </main>
            <div class="modal fade" id="modalNonactive" tabindex="-1" role="dialog" aria-labelledby="nonactiveModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="nonactiveModalLabel">Nonaktifkan Akun</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Apakah Anda yakin untuk menonaktifkan akun ini?</div>
                        <div class="modal-footer">
                            <a class="btn btn-primary" type="button" href="<?= base_url('master_data/Pengguna/nonaktif/' . $User->id_pengguna) ?>">Ya</a>
                            <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalActive" tabindex="-1" role="dialog" aria-labelledby="activeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="activeModalLabel">Aktifkan Akun</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Apakah Anda yakin untuk mengaktifkan akun ini?</div>
                        <div class="modal-footer">
                            <a class="btn btn-primary" type="button" href="<?= base_url('master_data/Pengguna/aktifkan/' . $User->id_pengguna) ?>">Ya</a>
                            <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
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