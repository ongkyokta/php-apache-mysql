<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("_partials/head.php") ?>

<body class="bg-auth">
	<div id="layoutAuthentication">
		<main class="login-container">
			<div class="container">
				<div class="row align-items-center justify-content-center">
					<div class="col-lg-12">
						<div class="card shadow-lg border-0 rounded-lg">
							<div class="card-header justify-content-center">
								<img class="img-fluid login-logo mx-auto" src="<?= base_url("assets/img/logo_j_kopi_l.svg") ?>" alt="Logo J-KOPI">
							</div>
							<div class="card-body">
								<div id="alert"><?php echo $this->session->flashdata('message') ?></div>
								<form method="post" action="<?php base_url('Login') ?>">
									<div class="form-group">
										<label class="small mb-1" for="email">Email</label>
										<input class="form-control py-4" id="email" name="email" type="text" placeholder="Masukkan email Anda" autofocus maxlength="128" value="<?= isset($_POST["email"]) ? $_POST["email"] : ''; ?>" />
										<?= form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label class="small mb-1" for="inputPassword">Password</label>
										<div class="row d-flex align-items-center mx-0">
											<input class="form-control py-4" id="password" name="password" type="password" placeholder="Masukkan password Anda" maxlength="16" />
											<i id="toggle-password" class="form-icon fas fa-eye"></i>
										</div>
										<?= form_error('password', '<small class="text-danger pl-2">', '</small>'); ?>
									</div>
									<div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
										<button type="submit" class="btn btn-primary col-6 mx-auto">Masuk</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<div id="layoutAuthentication_footer">
			<footer class="footer mt-auto footer-dark">
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
	var timeout = 3000;
	$('#alert').delay(timeout).fadeOut(300);

	$(document).on('click', '#toggle-password', function() {

		$(this).toggleClass("fa-eye fa-eye-slash");

		var input = $("#password");
		input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
	});
</script>

</html>