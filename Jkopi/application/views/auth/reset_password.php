<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("_partials/head.php") ?>

<body class="bg-light">
	<div id="layoutAuthentication">
		<main class="login-container">
			<div class="container">
				<div class="row align-items-center justify-content-center">
					<div class="col-lg-12">
						<div class="shadow-xs border-0 rounded-lg">
							<div class="justify-content-center mb-5">
								<img class="img-fluid login-logo mx-auto" src="<?= base_url("assets/img/logo_j_kopi_l.png") ?>" alt="Logo J-KOPI">
							</div>
							<h3 class="">Buat Password Baru</h3>
							<div class="">
								<div id="alert"><?php echo $this->session->flashdata('message') ?></div>
								<form method="post" action="">
									<div class="form-group">
										<label class="small mb-1" for="inputPassword">Password</label>
										<div class="row d-flex align-items-center mx-0">
											<input class="form-control py-4" id="password" name="password" type="password" placeholder="Masukkan password baru" maxlength="16" />
											<i id="toggle-password" class="form-icon fas fa-eye"></i>
										</div>
										<?= form_error('password', '<small class="text-danger pl-2">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label class="small mb-1" for="inputPassword">Konfirmasi Password</label>
										<div class="row d-flex align-items-center mx-0">
											<input class="form-control py-4" id="konfirmasiPassword" name="konfirmasiPassword" type="password" placeholder="Masukkan ulang password baru" maxlength="16" />
											<i id="toggle-konfirmasiPassword" class="form-icon fas fa-eye"></i>
										</div>
										<?= form_error('password', '<small class="text-danger pl-2">', '</small>'); ?>
									</div>
									<div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
										<button type="submit" class="btn btn-primary col-6 mx-auto">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<div id="layoutAuthentication_footer">
			<footer class="footer mt-auto footer-light">
				<div class="container-fluid">
					<div class="col-md-12 align-items-center justify-content-center small" style="display: flex;">
						Copyright &copy; Dinas Komunikasi dan Informatika Kabupaten Jember | <?= date("Y"); ?>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<?php $this->load->view("_partials/js") ?>
</body>
<script>
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