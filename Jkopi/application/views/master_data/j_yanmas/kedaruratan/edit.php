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
                                        <div class="page-header-icon"><i data-feather="file-text"></i></div>
                                        Edit Data J-News
                                    </h1>
                                    <div class="page-header-subtitle">Jember Kota Pintar</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="container mt-n10">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="card shadow-none mb-4">
                            <div id="alert"><?php echo $this->session->flashdata('message') ?></div>
                            <div class="card-body">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <div class="text-center">
                                            <img class="img-account-profile mb-2" id="preview" src="<?= base_url() . $Kedaruratan->logo ?>" alt="" />
                                            <div class="small font-italic text-muted mb-4">Format JPG atau PNG, tidak lebih dari 1 MB</div>
                                            <label class="btn btn-secondary" type="button" for="logo">Pilih Logo Dinas</label>
                                            <input id="logo" name="logo" type="file" accept=".png, .jpg" onchange="tampilkanPreview(this, 'preview')" style="display: none;">
                                            <?= form_error('logo', '<small class="text-danger pl-2">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label class="small mb-1" for="nama">Nama Dinas</label>
                                                <input class="form-control" id="nama" name="nama" type="text" placeholder="Masukkan nama dinas" maxlength="255" value="<?= $Kedaruratan->nama ?>" />
                                                <?= form_error('nama', '<small class="text-danger pl-2">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row px-2">
                                        <div class="form-group col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label class="small mb-1" for="no_telp">Nomor Telepon Dinas</label>
                                            <input class="form-control" id="no_telp" name="no_telp" type="text" placeholder="Masukkan nomor telepon dinas" value="<?= $Kedaruratan->no_telp ?>" onkeypress="return onlyNumber(event)">
                                            <?= form_error('no_telp', '<small class="text-danger pl-2">', '</small>'); ?>
                                        </div>
                                        <div class="form-group col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label class="small mb-1" for="status">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <?php if ($Kedaruratan->status == 'aktif') { ?>
                                                    <option class="mr-3" value="aktif">Aktif</option>
                                                    <option class="mr-3" value="tidak aktif">Tidak Aktif</option>
                                                <?php } else { ?>
                                                    <option class="mr-3" value="tidak aktif">Tidak Aktif</option>
                                                    <option class="mr-3" value="aktif">Aktif</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <hr class="my-4" />
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a class="btn btn-danger" href="javascript:history.go(-1)">Batal</a>
                                </div>
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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
    $("#logo").change(function() {
        readURL(this);
    });

    var timeout = 3000;
    $('#alert').delay(timeout).fadeOut(300);
</script>

</html>