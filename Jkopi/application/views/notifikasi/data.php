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
                                        <div class="page-header-icon"><i data-feather="bell"></i></div>
                                        Menu Notifikasi
                                    </h1>
                                    <div class="page-header-subtitle">Jember Kota Pintar</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="container mt-n10">
                    <div id="alert"><?php echo $this->session->flashdata('message') ?></div>
                    <div class="card shadow-none card-header-actions mb-4">
                        <div class="card-header">
                            Daftar Notifikasi
                        </div>
                        <div class="card-body">
                            <div class="datatable table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="300px">Tanggal/Waktu</th>
                                            <th>Notifikasi</th>
                                            <th width="100px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-dark">
                                        <?php foreach ($notif as $n) { ?>
                                            <tr>
                                                <td><?= $n['created_at'] ?></td>
                                                <td><?= $n['status'] ?></td>

                                                <td>
                                                    <div class="small">
                                                        <?php if ($n['status'] == 'Verifikasi KTP') { ?>
                                                            <a class="text-arrow-icon" href="<?= base_url('master_data/Verifikasi_KTP/statusread/' . $n['id_notif']) ?>">
                                                                Detail
                                                                <i class="ml-2 mr-1" data-feather="arrow-right"></i>
                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php $this->load->view("_partials/footer") ?>
        </div>
    </div>
    <?php $this->load->view("_partials/js") ?>
</body>

</html>