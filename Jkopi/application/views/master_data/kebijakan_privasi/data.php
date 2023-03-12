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
										Data Kebijakan dan Privasi
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
							<div class="card-header">Data Kebijakan dan Privasi</div>
							<div class="card-body">
								<div class="col-xl-12">
									<div class="form-group">
										<div class="form-group">
											<textarea class="form-control" id="deskripsi" name="deskripsi" type="text" rows="10"><?= $ketentuan->deskripsi ?></textarea>
											<?= form_error('deskripsi', '<small class="text-danger pl-2">', '</small>'); ?>
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
	CKEDITOR.replace('deskripsi');
	CKEDITOR.config.autoParagraph = false;
	CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
	CKEDITOR.config.shiftEnterMode = CKEDITOR.ENTER_P;

	var timeout = 3000;
	$('#alert').delay(timeout).fadeOut(300);
</script>

</html>