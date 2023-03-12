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
                                        Tambah Data Admin
                                    </h1>
                                    <div class="page-header-subtitle">Jember Kota Pintar</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="container mt-n10">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card shadow-none mb-4">
                                <div class="card-body">
                                    <div id="alert"><?php echo $this->session->flashdata('message') ?></div>
                                    <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                                        <h5>Data Akun Admin</h5>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="small mb-1" for="email">Email</label>
                                                <input class="form-control" id="email" name="email" type="text" placeholder="Email" value="<?= isset($_POST["email"]) ? $_POST["email"] : ''; ?>" maxlength="128" />
                                                <?= form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="small mb-1" for="opd">OPD</label>
                                                <select class="form-control" id="opd" name="opd" required>
                                                    <?php foreach ($OPD as $data) { ?>
                                                        <option value="<?= $data['id_opd'] ?>"><?= $data['nama_opd'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?= form_error('opd', '<small class="text-danger pl-2">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <h5>Buat Password Baru</h5>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="small mb-1" for="password">Password</label>
                                                <div class="row d-flex align-items-center mx-0">
                                                    <input class="form-control" id="password" name="password" type="password" placeholder="Masukkan password" maxlength="16" />
                                                    <i id="toggle-password" class="form-icon fas fa-eye"></i>
                                                </div>
                                                <?= form_error('password', '<small class="text-danger pl-2">', '</small>'); ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="small mb-1" for="konfirmasiPassword">Konfirmasi Password</label>
                                                <div class="row d-flex align-items-center mx-0">
                                                    <input class="form-control" id="konfirmasiPassword" name="konfirmasiPassword" type="password" placeholder="Masukkan ulang password" maxlength="16" />
                                                    <i id="toggle-konfirmasiPassword" class="form-icon fas fa-eye"></i>
                                                </div>
                                                <?= form_error('konfirmasiPassword', '<small class="text-danger pl-2">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <hr class="my-4" />
                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                        <a class="btn btn-danger" href="javascript:history.go(-1)">Batal</a>
                                    </form>
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
</body>
<script>
    $(document).ready(function() {
        $("#opd").select2({
            data: getDataOPD()
        });
    });

    function getDataOPD() {
        $.ajax({
            url: "<?= base_url("OPD/data_kecamatan") ?>",
            dataType: "json",
            success: function(data) {
                var html = '<option value="">' + " Pilih OPD Admin " + '</option>';
                var no = 1;
                for (var i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i].id_opd + '">' + data[i].nama_opd + '</option>';
                }
                $('#opd').html(html);
            },
        });
    }

    $(document).on('click', '#toggle-password', function() {

        $(this).toggleClass("fa-eye fa-eye-slash");

        var input = $("#password");
        input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
    });

    $(document).on('click', '#toggle-konfirmasiPassword', function() {

        $(this).toggleClass("fa-eye fa-eye-slash");

        var input = $("#konfirmasiPassword");
        input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
    });

    var timeout = 3000;
    $('#alert').delay(timeout).fadeOut(300);
</script>

</html>