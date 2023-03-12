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
										<div class="page-header-icon"><i data-feather="user"></i></div>
										Pengaturan Akun
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

										<h5>Data Akun</h5>
										<hr>
										<div class="form-row">
											<div class="form-group col-md-12">
												<label class="small mb-1" for="email">Email</label>
												<input class="form-control" id="email" name="email" type="text" placeholder="Email" maxlength="128" disabled value="<?= $Pengguna['email'] ?>" />
											</div>
										</div>
										<h5>Buat Password Baru</h5>
										<hr>
										<div class="form-row">
											<div class="form-group col-md-4">
												<label class="small mb-1" for="passwordlama">Password Lama</label>
												<div class="row d-flex align-items-center mx-0">
													<input class="form-control" id="passwordlama" name="passwordlama" type="password" placeholder="Masukkan password lama" maxlength="16" />
													<i id="toggle-passwordlama" class="form-icon fas fa-eye"></i>
												</div>
												<?= form_error('passwordlama', '<small class="text-danger pl-2">', '</small>'); ?>
											</div>
											<div class="form-group col-md-4">
												<label class="small mb-1" for="password">Password Baru</label>
												<div class="row d-flex align-items-center mx-0">
													<input class="form-control" id="password" name="password" type="password" placeholder="Masukkan password baru" maxlength="16" />
													<i id="toggle-password" class="form-icon fas fa-eye"></i>
												</div>
												<?= form_error('password', '<small class="text-danger pl-2">', '</small>'); ?>
											</div>
											<div class="form-group col-md-4">
												<label class="small mb-1" for="konfirmasiPassword">Konfirmasi Password</label>
												<div class="row d-flex align-items-center mx-0">
													<input class="form-control" id="konfirmasiPassword" name="konfirmasiPassword" type="password" placeholder="Masukkan ulang password baru" maxlength="16" />
													<i id="toggle-konfirmasiPassword" class="form-icon fas fa-eye"></i>
												</div>
												<?= form_error('konfirmasiPassword', '<small class="text-danger pl-2">', '</small>'); ?>
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
	var timeout = 3000;
	$('#alert').delay(timeout).fadeOut(300);

	$(document).on('click', '#toggle-passwordlama', function() {

		$(this).toggleClass("fa-eye fa-eye-slash");

		var input = $("#passwordlama");
		input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
	});

	$(document).on('click', '#toggle-password', function() {

		$(this).toggleClass("fa-eye fa-eye-slash");

		var input = $("#password");
		input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
	});

	$(document).on('click', '#toggle-konfirmasiPassword', function() {

		$(this).toggleClass("fa-eye fa-eye-slash");

		var input = $("#konfirmasiPassword");
		input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
	});
</script>

</html>