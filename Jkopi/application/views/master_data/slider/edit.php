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
                                        Edit Data Slider
                                    </h1>
                                    <div class="page-header-subtitle">Jember Kota Pintar</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="container mt-n10">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="card shadow-none mb-4">
                            <div id="alert"><?php echo $this->session->flashdata('message') ?></div>
                            <div class="card-body">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <div class="text-center">
                                            <img class="img-account-profile mb-2" id="preview" src="<?= base_url() . $Slider->gambar ?>" alt="" />
                                            <div class="small font-italic text-muted mb-4">Format JPG atau PNG, tidak lebih dari 1 MB</div>
                                            <label class="btn btn-secondary" type="button" for="gambar">Pilih Foto Slider</label>
                                            <input id="gambar" name="gambar" type="file" accept=".png, .jpg" onchange="tampilkanPreview(this, 'preview')" hidden>
                                            <?= form_error('gambar', '<small class="text-danger pl-2">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group col-md-12">
                                            <label class="small mb-1" for="status">Status Slider</label>
                                            <select class="form-control" id="status" name="status">
                                                <?php if ($Slider->aktif == 'aktif') { ?>
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
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                    <a class="btn btn-danger" type="button" href="javascript:history.go(-1)">Batal</a>
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
    $("#gambar").change(function() {
        readURL(this);
    });

    var timeout = 3000;
    $('#alert').delay(timeout).fadeOut(300);
</script>

</html>