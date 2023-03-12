<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("_partials/head") ?>

<body class="bg-white">
	<div id="layoutError">
		<main>
			<div class="container">
				<div class="row align-items-center justify-content-center">
					<div>
						<div class="text-center mt-4">
							<img class="img-fluid p-2" src="<?= base_url("assets/img/reset_pass_success.gif") ?>" alt="Reset Password Success" />
							<h3>Berhasil Membuat Password Baru</h3>
							<p class="lead">Silahkan login di aplikasi Android J-KOPI dengan menggunakan password baru Anda.</p>
						</div>
					</div>
				</div>
			</div>
		</main>
		<div id="layoutError_footer">
			<footer class="footer mt-auto footer-light center">
				<div class="container-fluid">
					<div class="col-md-12 align-items-center justify-content-center small">
						Copyright &copy; Dinas Komunikasi dan Informatika Kabupaten Jember | <?= date("Y"); ?></a>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<?php $this->load->view("_partials/js") ?>
</body>

</html>