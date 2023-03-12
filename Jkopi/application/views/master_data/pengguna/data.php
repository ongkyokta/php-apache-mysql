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
										Data Pengguna
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
						<div class="card shadow-none card-header-actions mx-auto mb-4">
							<div class="card-header">
								Data Pengguna
							</div>
							<div class="card-body">
								<div class="datatable table-responsive">
									<table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th width="30px">No</th>
												<th>NIK</th>
												<th>Email</th>
												<th>Nama Lengkap</th>
												<th>Status Akun</th>
												<th>Tgl/Waktu Pendaftaran</th>
												<th width="100px">Aksi</th>
											</tr>
										</thead>
										<tbody class="text-dark" id="target">
										</tbody>
									</table>
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
	<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Apakah Anda yakin untuk menghapus data?</div>
				<div class="modal-footer">
					<a class="btn btn-danger" id="delete_link" type="button" href="">Hapus</a>
					<button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
</body>
<script>
	var timeout = 3000;
	$('#alert').delay(timeout).fadeOut(300);
	getData();

	function getData() {
		$.ajax({
			url: "<?php echo base_url() . "master_data/Pengguna/getAllData" ?>",
			dataType: "json",
			beforeSend: function() {
				console.log("Please Wait....");
				document.getElementById("myNav").style.height = "100%";
			},
			success: function(data) {
				document.getElementById("myNav").style.height = "0%";
				console.log(data);
				var baris = '';
				var no = 1;
				for (var i = 0; i < data.length; i++) {
					baris += '<tr>' +
						'<td>' + (no + i) + '</td>' +
						'<td>' + data[i].nik + '</td>' +
						'<td>' + data[i].email + '</td>' +
						'<td>' + data[i].nama_lengkap + '</td>' +
						'<td>' + (data[i].is_active == 'aktif' ? '<div class="badge badge-primary badge-pill px-3">Aktif</div>' :
							data[i].is_active == 'tidak aktif' ? '<div class="badge badge-danger badge-pill px-3">Tidak Aktif</div>' :
							'<div class="badge badge-light badge-pill px-3">Undefined</div>') +
						'<td>' + data[i].created_at + '</td>' +
						'<td> <a href="Pengguna/detail/' + data[i].id_pengguna + '" class="btn btn-datatable btn-icon btn-transparent-dark"><i class="fa fa-search-plus "></i></a></td>'
					'</tr>'
				}
				$('#dataTable').dataTable().fnDestroy();
				$('#target').html(baris);
				$("#dataTable").dataTable({
					"paging": true,
					"searching": true
				});
			},
		});
	}
</script>

</html>