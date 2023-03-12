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
                    Ubah Data E-Commerce
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
              <div class="card-header">Data E-Commerce</div>
              <div class="card-body">
                <div class="form-group">
                  <div class="text-center">
                    <img class="img-account-profile mb-2" id="preview" src="<?= base_url() . $Ecommerce->gambar ?>" alt="" />
                    <div class="small font-italic text-muted mb-4">Format JPG atau PNG, tidak lebih dari 1 MB</div>
                    <label class="btn btn-secondary" type="button" for="gambar">Pilih Foto Produk E-Commerce</label>
                    <input id="gambar" name="gambar" type="file" accept=".png, .jpg" onchange="tampilkanPreview(this, 'preview')" hidden>
                    <?= form_error('gambar', '<small class="text-danger pl-2">', '</small>'); ?>
                  </div>
                </div>
                <div class="form-row px-2">
                  <div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12">
                    <label class="small mb-1" for="nama_produk">Nama Produk</label>
                    <input class="form-control" id="nama_produk" name="nama_produk" type="text" placeholder="Masukkan nama produk" value="<?= $Ecommerce->nama_produk ?>" />
                    <input class="form-control" id="id_ecommerce" name="id_ecommerce" type="text" placeholder="Masukkan nama produk" value="<?= $this->uri->segment(4) ?>" hidden />
                    <?= form_error('nama_produk', '<small class="text-danger pl-2">', '</small>'); ?>
                  </div>
                  <div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12">
                    <label class="small mb-1" for="harga">Harga</label>
                    <input class="form-control" id="harga" name="harga" type="text" placeholder="Masukkan harga produk" value="<?= $Ecommerce->harga ?>" />
                    <?= form_error('harga', '<small class="text-danger pl-2">', '</small>'); ?>
                  </div>
                  <div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12">
                    <label class="small mb-1" for="satuan">Satuan</label>
                    <input class="form-control" id="satuan" name="satuan" type="text" placeholder="Masukkan satuan produk" value="<?= $Ecommerce->satuan ?>" />
                    <?= form_error('satuan', '<small class="text-danger pl-2">', '</small>'); ?>
                  </div>
                </div>
                <div class="form-row px-2">
                  <div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12">
                    <label class="small mb-1" for="nama_toko">Nama Toko</label>
                    <input class="form-control" id="nama_toko" name="nama_toko" type="text" placeholder="Masukkan nama toko" value="<?= $Ecommerce->nama_toko ?>" />
                    <?= form_error('nama_toko', '<small class="text-danger pl-2">', '</small>'); ?>
                  </div>
                  <div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12">
                    <label class="small mb-1" for="no_telp">Nomor Telepon</label>
                    <input class="form-control" id="no_telp" name="no_telp" type="text" placeholder="Masukkan Nomor Telepon" value="<?= $Ecommerce->no_telp ?>" />
                    <?= form_error('no_telp', '<small class="text-danger pl-2">', '</small>'); ?>
                  </div>
                  <div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12">
                    <label class="small mb-1" for="id_kategori">Kategori</label>
                    <select class="form-control" id="id_kategori" name="id_kategori" required>
                      <?php foreach ($Kategori as $row) { ?>
                        <option value="<?php echo $row['id_kategori']; ?>" <?= ($Ecommerce->id_kategori == $row['id_kategori'] ? 'selected' : '') ?>>
                          <?php echo $row['nama_kategori']; ?></option>
                      <?php } ?>
                      <?= form_error('id_kategori', '<small class="text-danger pl-2">', '</small>'); ?>
                    </select>
                  </div>
                </div>
                <div class="form-row px-2">
                  <div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12">
                    <label class="small mb-1" for="alamat">Alamat</label>
                    <input class="form-control" id="alamat" name="alamat" type="text" placeholder="Masukkan Alamat" value="<?= $Ecommerce->alamat ?>" />
                    <?= form_error('alamat', '<small class="text-danger pl-2">', '</small>'); ?>
                  </div>
                  <div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12">
                    <label class="small mb-1" for="kecamatan">Kecamatan</label>
                    <select class="form-control" id="kecamatan" name="kecamatan" required>
                      <option class="mr-3" value="" selected hidden>Pilih Kecamatan</option>
                      <?= form_error('kecamatan', '<small class="text-danger pl-2">', '</small>'); ?>
                    </select>
                  </div>
                  <div class="form-group col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12">
                    <label class="small mb-1" for="kelurahan">Kelurahan</label>
                    <select class="form-control" id="kelurahan" name="kelurahan" required>
                      <option class="mr-3" value="" selected hidden>Pilih Kelurahan</option>
                      <?= form_error('kelurahan', '<small class="text-danger pl-2">', '</small>'); ?>
                    </select>
                    <?= form_error('kelurahan', '<small class="text-danger pl-2">', '</small>'); ?>
                  </div>
                </div>
                <div class="form-row px-2">
                  <div class="form-group col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 px-2">
                    <label class="small mb-1" for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" type="text" rows="10" placeholder="Masukkan deskripsi fasilitas umum"><?= $Ecommerce->deskripsi ?></textarea>
                    <?= form_error('deskripsi', '<small class="text-danger pl-2">', '</small>'); ?>
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
  $(document).ready(function() {
    var idKey, idKecamatan, nm_kecamatan, nm_kelurahan, idKategori, nm_kategori, id_ecommerce;
    var id_ecommerce = document.getElementById("id_ecommerce").value;
    getDataKecamatanKelurahan();

    $("#kecamatan").select2({
      data: getDataKecamatanKelurahan()
    }).on('change', function(e) {
      idKey = $("#kecamatan").val();
      $("#kelurahan").select2({
        data: getKelurahan(idKey)
      });
    });
    $("#id_kategori").select2();
  });

  function getDataKecamatanKelurahan() {
    $.ajax({
      url: "<?= base_url() . "master_data/Ecommerce/data_kecamatan_kelurahan" ?>",
      method: "POST",
      async: false,
      data: {
        id_ecommerce: $("#id_ecommerce").val()
      },
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

  function getDataKategori() {
    $.ajax({
      url: "<?php echo base_url("master_data/Ecommerce/getAllDataKategori") ?>",
      dataType: "json",
      success: function(data) {
        var html = '<option selected hidden value="">' + " Pilih Kategori E-Commerce" + '</option>';
        var no = 1;
        for (var i = 0; i < data.length; i++) {
          html += '<option value="' + data[i].id_kategori + '">' + data[i].nama_kategori + '</option>';
        }
        $('#id_kategori').html(html);
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

  var timeout = 3000;
  $('#alert').delay(timeout).fadeOut(300);
</script>

</html>