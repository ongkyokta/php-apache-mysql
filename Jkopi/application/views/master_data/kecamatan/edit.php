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
										Edit Data Kecamatan
									</h1>
									<div class="page-header-subtitle">Jember Kota Pintar</div>
								</div>
							</div>
						</div>
						<div id="alert"><?php echo $this->session->flashdata('message') ?></div>
					</div>
				</header>
				<div class="container mt-n10">
					<form method="POST" enctype="multipart/form-data">
						<div class="card shadow-none mb-4">
							<div id="alert"><?php echo $this->session->flashdata('message') ?></div>
							<div class="card-header">Data Kecamatan</div>
							<div class="card-body">
								<div class="form-group col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
									<label class="small mb-1" for="nama_kecamatan">Nama Kecamatan</label>
									<input class="form-control" id="nama_kecamatan" name="nama_kecamatan" type="text" placeholder="Masukkkan nama kecamatan" value="<?= $kecamatan->nama_kecamatan ?>" onkeyup="this.value = this.value.toUpperCase();" />
									<?= form_error('nama_kecamatan', '<small class="text-danger pl-2">', '</small>'); ?>
								</div>
								<div class="form-group col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
									<label class="small mb-1" for="geojson">Geo JSON</label>
									<textarea class="form-control" id="geojson" name="geojson" type="text" rows="10" placeholder="Masukkan Geo JSON"><?= $kecamatan->geojson ?></textarea>
									<?= form_error('geojson', '<small class="text-danger pl-2">', '</small>'); ?>
									</small>
								</div>
								<div class="form-group col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
									<label class="small mb-1" for="latitude">Masukkan Longitude Latitude</label>
									<input class="form-control" id="latitude" name="latitude" type="text" placeholder="-1.234, 123.456" value="<?= $kecamatan->latitude ?>, <?= $kecamatan->longitude ?>" />
									<small class="text-danger pl-2">*contoh format: -1.234, 123.456</small><br>
									<small class="text-danger pl-2">*atau pilih lokasi dengan klik pada peta di bawah</small>
								</div>
								<div class="form-group col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
									<div id="mapid" style="height: 500px;"></div>
								</div>
								<hr class="my-4" />
								<button type="submit" class="btn btn-primary">Simpan</button>
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
	var latitudeawal = "-8.168841697743533";
	var longitudeawal = "113.70217713665069";
	var koordinat = document.getElementById('latitude').value;
	// var longitudeawal = document.getElementById('longitude').value;
	const myArray = koordinat.split(", ");
	const latawal = myArray[0];
	const longawal = myArray[1];
	var mymap = L.map('mapid').setView([latawal, longawal], 14);

	L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFoZW5kcmF5dWRoYSIsImEiOiJja29pNnAzajcwcmV3MndsbHlzNWMxM2RmIn0.Q53cv5O2-ozIAIZLhgcKcQ', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
	}).addTo(mymap);

	mymap.attributionControl.setPrefix(false);
	var curLocation = [latawal, longawal];
	var latInput = document.querySelector("[name=latitude]");

	$('#latitude').on('change', function() {
		latitudeawal = document.getElementById('latitude').value;
		const myArray = latitudeawal.split(", ");
		const latset = myArray[0];
		const longset = myArray[1];
		console.log(latset);
		console.log(longset);
		marker.setLatLng([latset, longset]).update();
	});

	var marker = new L.marker(curLocation, {
		draggable: 'true'
	});

	marker.on('dragend', function(event) {
		var position = marker.getLatLng();
		marker.setLatLng(position, {
			draggable: 'true'
		}).bindPopup(position).update();
		$("#latitude").val(position.lat + ", " + position.lng);
	});

	mymap.addLayer(marker);

	mymap.on("click", function(e) {
		var lat = e.latlng.lat;
		var lng = e.latlng.lng;
		if (!marker) {
			marker = L.marker(e.latlng).addTo(mymap);
		} else {
			marker.setLatLng(e.latlng);
		}
		latInput.value = [lat + ", " + lng];
	});



	var timeout = 3000;
	$('#alert').delay(timeout).fadeOut(300);
</script>

</html>