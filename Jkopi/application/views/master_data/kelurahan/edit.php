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
										Edit Data Kelurahan
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
							<div id="alert"><?php echo $this->session->flashdata('message') ?></div>
							<div class="card-header">Data Kelurahan</div>
							<div class="card-body">
								<div class="form-row">
									<div class="form-group col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-0">
										<label class="small mb-1" for="nama_kelurahan">Nama Kelurahan</label>
										<input class="form-control" id="nama_kelurahan" name="nama_kelurahan" type="text" placeholder="Masukkkan nama kelurahan" value="<?= $Kelurahan->nama_kelurahan ?>" onkeyup="this.value = this.value.toUpperCase();" />
										<?= form_error('nama_kelurahan', '<small class="text-danger pl-2">', '</small>'); ?>
									</div>
									<div class="form-group col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-0">
										<label class="small mb-1" for="id_kecamatan">Kecamatan</label>
										<select class="form-control" id="id_kecamatan" name="id_kecamatan" required>
											<?php foreach ($Kecamatan as $data_kc) { ?>
												<option value="<?= $data_kc['id_kecamatan']; ?>" <?= ($Kelurahan->id_kecamatan == $data_kc['id_kecamatan'] ? 'selected' : '') ?>>
													<?php echo $data_kc['nama_kecamatan']; ?></option>
											<?php } ?>
										</select>
									</div>
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
	$(document).ready(function() {
		var list_kecamatan = [];

		$("#id_kecamatan").select2({
			data: list_kecamatan
		});
	});

	var timeout = 3000;
	$('#alert').delay(timeout).fadeOut(300);
</script>

</html>