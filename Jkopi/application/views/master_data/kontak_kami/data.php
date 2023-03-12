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
                                        Kontak Kami
                                    </h1>
                                    <div class="page-header-subtitle">Jember Kota Pintar</div>
                                </div>
                            </div>
                        </div>
                        <div id="alert"><?php echo $this->session->flashdata('message') ?></div>
                    </div>
                </header>
                <div class="container mt-n10">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card shadow-none mb-4">
                                <div class="card-body">
                                    <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                                        <h5>Data Alamat</h5>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                                <label class="small mb-1" for="alamat">Alamat</label>
                                                <input class="form-control" id="alamat" name="alamat" type="text" placeholder="Alamat" value="<?= $kontak->alamat ?>" maxlength="128" />
                                                <?= form_error('alamat', '<small class="text-danger pl-2">', '</small>'); ?>
                                            </div>
                                            <div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                                <label class="small mb-1" for="kecamatan">Kecamatan</label>
                                                <select class="form-control" id="kecamatan" name="kecamatan" required>
                                                    <option class="mr-3" value="" selected hidden>Pilih Kecamatan</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                                <label class="small mb-1" for="kelurahan">Kelurahan/Desa</label>
                                                <select class="form-control" id="kelurahan" name="kelurahan" required>
                                                    <option class="mr-3" value="" selected hidden>Pilih Kelurahan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <h5>Data Kontak</h5>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <label class="small mb-1" for="email">Email Admin Pengaduan</label>
                                                <input class="form-control" id="email" name="email" type="text" placeholder="Email Admin Pengaduan" value="<?= $kontak->email ?>" maxlength="128" />
                                                <?= form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>
                                            </div>
                                            <div class="form-group col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <label class="small mb-1" for="telepon">Nomor Telepon</label>
                                                <input class="form-control" id="telepon" name="telepon" type="text" placeholder="Nomor Telepon" value="<?= $kontak->no_telp ?>" maxlength="14" onkeypress="return onlyNumber(event)" />
                                                <?= form_error('telepon', '<small class="text-danger pl-2">', '</small>'); ?>
                                            </div>
                                        </div>

                                        <hr class="my-4" />
                                        <button type="submit" class="btn btn-primary">Simpan</button>
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
        var idKey, kecamatan, kelurahan;
        getAllData();
        $("#kecamatan").select2({
            data: getAllData()
        }).on('change', function(e) {
            idKey = $("#kecamatan").val();
            $("#kelurahan").select2({
                data: getKelurahan(idKey)
            });
        });
    });


    function getAllData() {
        $.ajax({
            url: "<?= base_url() . "master_data/KontakKami/getAllData" ?>",
            method: "POST",
            async: false,
            dataType: "json",
            success: function(data) {
                console.log(data);
                var no = 1;
                for (var i = 0; i < data.length; i++) {
                    var html = '<option value="' + data[i].id_kecamatan + '">' + data[i].nama_kecamatan + '</option>';
                    idKey = data[i].id_kecamatan;
                    id_kelurahan = data[i].id_kelurahan;
                    nm_kecamatan = data[i].nama_kecamatan;
                    nama_kelurahan = data[i].nama_kelurahan;
                }
                $('#kecamatan').html(html);
                getKecamatan(idKey, nm_kecamatan);
                getDetKelurahan(idKey, id_kelurahan, nama_kelurahan);
            }
        });
    }

    function getKecamatan(idKey, nm_kecamatan) {
        $.ajax({
            url: "<?= base_url() . "master_data/kecamatan/get_kecamatan" ?>",
            dataType: "json",
            success: function(data) {
                var html = '<option value="' + idKey + '">' + nm_kecamatan + '</option>';
                var no = 1;
                for (var i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i].id_kecamatan + '">' + data[i].nama_kecamatan + '</option>';
                }
                $('#kecamatan').html(html);
            },
        });
    }

    function getDetKelurahan(idKey) {
        $.ajax({
            url: "<?= base_url(); ?>master_data/kelurahan/get_kelurahan",
            method: "POST",
            async: false,
            data: {
                id_kecamatan: idKey
            },
            dataType: "json",
            success: function(data) {
                console.log(data)
                var html = '<option value="' + id_kelurahan + '">' + nama_kelurahan + '</option>';
                var no = 1;
                for (var i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i].id_kelurahan + '">' + data[i].nama_kelurahan + '</option>';
                }
                $('#kelurahan').html(html);
            }
        });
    }

    function getKelurahan(idKey) {
        $.ajax({
            url: "<?= base_url(); ?>master_data/kelurahan/get_kelurahan",
            method: "POST",
            data: {
                id_kecamatan: idKey
            },
            async: false,
            dataType: "json",
            success: function(data) {
                var html = '<option value="" selected hidden disabled>' + " Pilih Kelurahan/Desa " + '</option>';
                var no = 1;
                for (var i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i].id_kelurahan + '">' + data[i].nama_kelurahan + '</option>';
                }
                $('#kelurahan').html(html);
            }
        });
    }

    var timeout = 3000;
    $('#alert').delay(timeout).fadeOut(300);
</script>

</html>