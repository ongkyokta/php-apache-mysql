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
										Edit Data Admin
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
											<div class="form-group col-md-4">
												<label class="small mb-1" for="email">Email</label>
												<input class="form-control" id="email" name="email" type="text" placeholder="Email" value="<?= $Admin->email ?>" maxlength="128" disabled />
												<?= form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>
											</div>
											<div class="form-group col-md-4">
												<label class="small mb-1" for="opd">OPD</label>
												<select class="form-control" id="opd" name="opd">
													<?php foreach ($OPD as $data_opd) { ?>
														<option value="<?= $data_opd['id_opd']; ?>" <?= ($Admin->id_opd == $data_opd['id_opd'] ? 'selected' : '') ?>>
															<?php echo $data_opd['nama_opd']; ?></option>
													<?php } ?>
												</select>
											</div>
											<div class="form-group col-md-4">
												<label class="small mb-1" for="is_active">Status</label>
												<select class="form-control" id="is_active" name="is_active">
													<?php if ($Admin->is_active == 1) { ?>
														<option class="mr-3" value="1">Aktif</option>
														<option class="mr-3" value="0">Tidak Aktif</option>
													<?php } else { ?>
														<option class="mr-3" value="0">Tidak Aktif</option>
														<option class="mr-3" value="1">Aktif</option>
													<?php } ?>
												</select>
												<?= form_error('is_active', '<small class="text-danger pl-2">', '</small>'); ?>
											</div>
										</div>
										<h5>Buat Password Baru</h5>
										<hr>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label class="small mb-1" for="new_password">Password Baru</label>
												<div class="row d-flex align-items-center mx-0">
													<input class="form-control" id="new_password" name="new_password" type="password" placeholder="Masukkan password baru" maxlength="16" />
													<i id="toggle-new_password" class="form-icon fas fa-eye"></i>
												</div>
												<?= form_error('new_password', '<small class="text-danger pl-2">', '</small>'); ?>
											</div>
											<div class="form-group col-md-6">
												<label class="small mb-1" for="confirm_password">Konfirmasi Password</label>
												<div class="row d-flex align-items-center mx-0">
													<input class="form-control" id="confirm_password" name="confirm_password" type="password" placeholder="Masukkan ulang password baru" maxlength="16" />
													<i id="toggle-confirm_password" class="form-icon fas fa-eye"></i>
												</div>
												<?= form_error('confirm_password', '<small class="text-danger pl-2">', '</small>'); ?>
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
		var list_opd = [];

		$("#opd").select2({
			data: list_opd
		});
	});

	$(document).on('click', '#toggle-current_password', function() {
		$(this).toggleClass("fa-eye fa-eye-slash");
		var input = $("#current_password");
		input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
	});

	$(document).on('click', '#toggle-new_password', function() {
		$(this).toggleClass("fa-eye fa-eye-slash");
		var input = $("#new_password");
		input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
	});

	$(document).on('click', '#toggle-confirm_password', function() {
		$(this).toggleClass("fa-eye fa-eye-slash");
		var input = $("#confirm_password");
		input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
	});

	var timeout = 3000;
	$('#alert').delay(timeout).fadeOut(300);
</script>

</html>