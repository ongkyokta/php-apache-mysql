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
                                        Tambah Data Fasilitas Umum
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
                            <div class="card-header">Data Fasilitas Umum</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="text-center">
                                        <img class="img-account-profile mb-2" id="preview" src="<?= base_url("assets/img/placeholder.jpg") ?>" alt="" />
                                        <div class="small font-italic text-muted mb-4">Format JPG atau PNG, tidak lebih dari 1 MB</div>
                                        <label class="btn btn-secondary" type="button" for="gambar">Pilih Foto Fasilitas Umum</label>
                                        <input id="gambar" name="gambar" type="file" accept=".png, .jpg" onchange="tampilkanPreview(this, 'preview')" hidden>
                                        <?= form_error('gambar', '<small class="text-danger pl-2">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-row px-2">
                                    <div class="form-group col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label class="small mb-1" for="nama_fasilitas">Nama Fasilitas Umum</label>
                                        <input class="form-control" id="nama_fasilitas" name="nama_fasilitas" type="text" placeholder="Masukkan nama fasilitas umum" value="<?= isset($_POST["nama_fasilitas"]) ? $_POST["nama_fasilitas"] : ''; ?>" />
                                        <?= form_error('nama_fasilitas', '<small class="text-danger pl-2">', '</small>'); ?>
                                    </div>
                                    <div class="form-group col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label class="small mb-1" for="kategori">Kategori</label>
                                        <select class="form-control" id="kategori" name="kategori">
                                            <option class="mr-3" value="" selected hidden>Pilih Kategori Fasilitas Umum</option>
                                            <?= form_error('kategori', '<small class="text-danger pl-2">', '</small>'); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row px-2">
                                    <div class="form-group col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label class="small mb-1" for="alamat">Alamat</label>
                                        <input class="form-control" id="alamat" name="alamat" type="text" placeholder="Masukkan alamat" value="<?= isset($_POST["alamat"]) ? $_POST["alamat"] : ''; ?>" />
                                        <?= form_error('alamat', '<small class="text-danger pl-2">', '</small>'); ?>
                                    </div>
                                    <div class="form-group col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label class="small mb-1" for="no_telp">Nomor Telepon</label>
                                        <input class="form-control" id="no_telp" name="no_telp" type="text" placeholder="Masukkan nomor telepon" value="<?= isset($_POST["no_telp"]) ? $_POST["no_telp"] : ''; ?>" onkeypress="return onlyNumber(event)" />
                                        <?= form_error('no_telp', '<small class="text-danger pl-2">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-row px-2">
                                    <div class="form-group col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label class="small mb-1" for="kecamatan">Kecamatan</label>
                                        <select class="form-control" id="kecamatan" name="kecamatan">
                                            <option class="mr-3" value="" selected hidden>Pilih Kecamatan</option>
                                            <?= form_error('kecamatan', '<small class="text-danger pl-2">', '</small>'); ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label class="small mb-1" for="kelurahan">Kelurahan/Desa</label>
                                        <select class="form-control" id="kelurahan" name="kelurahan">
                                            <option class="mr-3" value="" selected hidden>Pilih Kelurahan</option>
                                            <?= form_error('kelurahan', '<small class="text-danger pl-2">', '</small>'); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 px-2">
                                    <label class="small mb-1" for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" type="text" rows="10" placeholder="Masukkan deskripsi fasilitas umum"><?= isset($_POST["deskripsi"]) ? $_POST["deskripsi"] : ''; ?></textarea>
                                    <?= form_error('deskripsi', '<small class="text-danger pl-2">', '</small>'); ?>
                                </div>
                                <div class="form-group col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <label class="small mb-1" for="latlong">Masukkan Longitude Latitude</label>
                                    <input class="form-control" id="latlong" name="latlong" type="text" placeholder="-1.234, 123.456" />
                                    <small class="text-danger pl-2">Contoh format: -1.234, 123.456</small>
                                </div>
                                <div class="form-group col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div id="mapid" style="height: 500px;"></div>
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
    $(document).ready(function() {
        var idKey;
        $("#kecamatan").select2({
            data: getDataKecamatan()
        }).on('change', function(e) {
            idKey = $("#kecamatan").val();
            $("#kelurahan").select2({
                data: getKelurahan(idKey)
            });
        });
        $("#kategori").select2({
            data: getDataKategori()
        });
    });

    function getDataKecamatan() {
        $.ajax({
            url: "<?= base_url() . "master_data/Kecamatan/get_kecamatan" ?>",
            dataType: "json",
            success: function(data) {
                var html = '<option selected hidden disabled value="">' + " Pilih Kecamatan " + '</option>';
                var no = 1;
                for (var i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i].id_kecamatan + '">' + data[i].nama_kecamatan + '</option>';
                }
                $('#kecamatan').html(html);
            },
        });
    }

    function getKelurahan(idKey) {
        $.ajax({
            url: "<?= base_url(); ?>master_data/Kelurahan/get_kelurahan",
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

    function getDataKategori() {
        $.ajax({
            url: "<?php echo base_url("menu_informasi/FasilitasUmum/get_kategori") ?>",
            dataType: "json",
            success: function(data) {
                var html = '<option selected hidden value="">' + " Pilih Kategori Fasilitas Umum " + '</option>';
                var no = 1;
                for (var i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i].id_kategori + '">' + data[i].nama_kategori + '</option>';
                }
                $('#kategori').html(html);
            },
        });
    }

    CKEDITOR.replace('deskripsi');
    CKEDITOR.config.autoParagraph = false;
    CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
    CKEDITOR.config.shiftEnterMode = CKEDITOR.ENTER_P;

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

    var latitudeawal = "-8.168815147798872";
    var longitudeawal = "113.7021775175966";
    var mymap = L.map('mapid').setView([latitudeawal, longitudeawal], 14);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFoZW5kcmF5dWRoYSIsImEiOiJja29pNnAzajcwcmV3MndsbHlzNWMxM2RmIn0.Q53cv5O2-ozIAIZLhgcKcQ', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
    }).addTo(mymap);

    mymap.attributionControl.setPrefix(false);
    var curLocation = [latitudeawal, longitudeawal];

    var marker = new L.marker(curLocation);
    mymap.addLayer(marker);
    var latInput = document.querySelector("[name=latlong]");


    $('#latlong').on('change', function() {
        latlongawal = document.getElementById('latlong').value;
        const myArray = latlongawal.split(", ");
        const latset = myArray[0];
        const longset = myArray[1];
        console.log(latset);
        console.log(longset);
        marker.setLatLng([latset, longset]).update();
    });

    // marker.on('dragend', function(event) {
    // 	var position = marker.getLatLng();
    // 	console.log(position);
    // 	marker.setLatLng(position, {
    // 		draggable: 'true'
    // 	}).bindPopup(position).update();
    // 	$("#latitude").val(position.lat, position.lng);
    // 	// $("#longitude").val(position.lng);
    // });

    mymap.on("click", function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        if (!marker) {
            marker = L.marker(e.latlng).addTo(mymap);
        } else {
            marker.setLatLng(e.latlng);
        }
        latInput.value = [lat + ", " + lng];
        // longInput.value = lng;
    });

    var timeout = 3000;
    $('#alert').delay(timeout).fadeOut(300);
</script>

</html>