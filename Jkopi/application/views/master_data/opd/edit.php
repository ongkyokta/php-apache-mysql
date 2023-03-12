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
										<input class="form-control" id="nama_opd" name="nama_opd" type="text" placeholder="Masukkkan nama OPD/Dinas" value="<?= $OPD->nama_opd ?>" />
										<input class="form-control" id="id_opd" name="id_opd" type="text" value="<?= $OPD->id_opd ?>" hidden />
										<?= form_error('nama_opd', '<small class="text-danger pl-2">', '</small>'); ?>
									</div>
									<div class="form-group col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
										<label class="small mb-1" for="no_telp">Nomor Telepon</label>
										<input class="form-control" id="no_telp" name="no_telp" type="text" placeholder="Masukkkan Nomor Telepon" value="<?= $OPD->no_telp ?>" onkeypress="return onlyNumber(event)" />
										<?= form_error('no_telp', '<small class="text-danger pl-2">', '</small>'); ?>
									</div>
								</div>
								<div class="form-row px-2">
									<div class="form-group col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
										<label class="small mb-1" for="alamat">Alamat</label>
										<input class="form-control" id="alamat" name="alamat" type="text" placeholder="Masukkkan alamat" value="<?= $OPD->alamat ?>" />
										<?= form_error('alamat', '<small class="text-danger pl-2">', '</small>'); ?>
									</div>
									<div class="form-group col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
										<label class="small mb-1" for="status">Status</label>
										<select class="form-control" id="status" name="status">
											<?php if ($OPD->status == 'aktif') { ?>
												<option class="mr-3" value="aktif">Aktif</option>
												<option class="mr-3" value="tidak aktif">Tidak Aktif</option>
											<?php } else { ?>
												<option class="mr-3" value="tidak aktif">Tidak Aktif</option>
												<option class="mr-3" value="aktif">Aktif</option>
											<?php } ?>
										</select>
										<?= form_error('status', '<small class="text-danger pl-2">', '</small>'); ?>
									</div>
								</div>
								<div class="form-row px-2">
									<div class="form-group col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
										<label class="small mb-1" for="kecamatan">Kecamatan</label>
										<select class="form-control" id="kecamatan" name="kecamatan" required>
											<?= form_error('kecamatan', '<small class="text-danger pl-2">', '</small>'); ?>
										</select>
									</div>
									<div class="form-group col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
										<label class="small mb-1" for="kelurahan">Kelurahan/Desa</label>
										<select class="form-control" id="kelurahan" name="kelurahan" required>
											<?= form_error('kelurahan', '<small class="text-danger pl-2">', '</small>'); ?>
										</select>
									</div>
								</div>
								<div class="form-group col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
									<label class="small mb-1" for="latlong">Masukkan Longitude Latitude</label>
									<input class="form-control" id="latlong" name="latlong" type="text" value="<?= $OPD->latitude ?>, <?= $OPD->longitude ?>" />
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
		var idKey, idKecamatan, nm_kecamatan, nm_kelurahan, idKategori, nm_kategori, id_opd;
		var id_opd = document.getElementById("id_opd").value;
		getDataKecamatanKelurahan();
		$("#kecamatan").select2({
			data: getDataKecamatanKelurahan()
		}).on('change', function(e) {
			idKey = $("#kecamatan").val();
			$("#kelurahan").select2({
				data: getKelurahan(idKey)
			});
		});
	});

	function getDataKecamatanKelurahan() {
		$.ajax({
			url: "<?= base_url() . "master_data/OPD/data_kecamatan_kelurahan" ?>",
			method: "POST",
			async: false,
			data: {
				id_opd: $("#id_opd").val()
			},
			dataType: "json",
			success: function(data) {
				var no = 1;
				for (var i = 0; i < data.length; i++) {
					var html = '<option value="' + data[i].id_kecamatan + '">' + data[i].nama_kecamatan + '</option>';
					idKey = data[i].id_kecamatan;
					id_kelurahan = data[i].id_kelurahan;
					nm_kecamatan = data[i].nama_kecamatan;
					nama_kelurahan = data[i].nama_kelurahan;
				}
				// console.log(data)
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

	var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFoZW5kcmF5dWRoYSIsImEiOiJja29pNnAzajcwcmV3MndsbHlzNWMxM2RmIn0.Q53cv5O2-ozIAIZLhgcKcQ', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
		accessToken: 'pk.eyJ1IjoibWFoZW5kcmF5dWRoYSIsImEiOiJja29pNnAzajcwcmV3MndsbHlzNWMxM2RmIn0.Q53cv5O2-ozIAIZLhgcKcQ'
	});

	var vector_opd = L.layerGroup();
	var latLongAwal = document.getElementById('latlong').value;
	const myArray = latLongAwal.split(", ");
	const latawal = myArray[0];
	const longawal = myArray[1];

	var mymap = L.map('mapid', {
		center: [latawal, longawal],
		zoom: 12,
		layers: [peta1, vector_opd],
	});

	mymap.attributionControl.setPrefix(false);
	var curLocation = [latawal, longawal];

	var marker = new L.marker(curLocation);
	mymap.addLayer(marker);
	var latLongInput = document.querySelector("[name=latlong]");


	$('#latlong').on('change', function() {
		latLongAwal = document.getElementById('latlong').value;
		const myArray = latLongAwal.split(", ");
		const latset = myArray[0];
		const longset = myArray[1];
		console.log(latset);
		console.log(longset);
		marker.setLatLng([latset, longset]).update();
	});
	mymap.on("click", function(e) {
		var lat = e.latlng.lat;
		var lng = e.latlng.lng;
		if (!marker) {
			marker = L.marker(e.latlng).addTo(mymap);
		} else {
			marker.setLatLng(e.latlng);
		}
		latLongInput.value = [lat + ", " + lng];
	});

	var timeout = 3000;
	$('#alert').delay(timeout).fadeOut(300);
</script>

</html>