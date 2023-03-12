<nav class="topnav navbar navbar-expand shadow-none border-bottom navbar-light bg-white" id="sidenavAccordion">
	<button class="btn btn-icon-navbar btn-transparent-dark order-1 order-lg-0 ml-4" id="sidebarToggle" href="#">
		<i data-feather="menu"></i>
	</button>
	<div class="logo d-none d-sm-block">
		<img class="img-logo" src="<?= base_url("assets/img/logo_j_kopi_s.svg") ?>" alt="Logo J-KOPII">
	</div>
	<ul class="navbar-nav align-items-center ml-auto">
		<div id="myNav" class="overlay">
			<div class="overlay-content align-items-center justify-content-center">
				<p class="text-center">Please Wait....</p>
				<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
				<lottie-player src="https://assets7.lottiefiles.com/packages/lf20_2b5ugopu.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
			</div>
		</div>
		<li class="nav-item dropdown no-caret mr-3 dropdown-notifications">
			<a class="btn btn-icon-navbar btn-transparent-dark dropdown-toggle notification" id="navbarDropdownAlerts" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i data-feather="bell"></i>
				<div class="badge badge-notification">
					<?php $query = $this->db->query("SELECT * FROM notif_web WHERE notif_web.terbaca = 0");
					if ($query->num_rows() > 0) {
						echo $query->num_rows();
					} else {
						echo 0;
					} ?>
				</div>
			</a>
			<div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownAlerts">
				<h6 class="dropdown-header dropdown-notifications-header ">
					<i class="mr-2" data-feather="bell"></i>
					Notifikasi
				</h6>
				<?php $query = $this->db->query("SELECT * FROM notif_web WHERE notif_web.terbaca = 0 ORDER BY id_notif DESC LIMIT 5")->result_array();
				foreach ($query as $q) { ?>
					<?php if ($q['status'] == 'Verifikasi KTP') { ?>
						<a class="dropdown-item dropdown-notifications-item" href="<?= base_url('master_data/Verifikasi_KTP/statusread/' . $q['id_notif']) ?>">
						<?php } else {  ?>
							<a class="dropdown-item dropdown-notifications-item" href="#">
							<?php } ?>
							<div class="dropdown-notifications-item-icon bg-primary">
								<i data-feather="bell"></i>
							</div>
							<div class="dropdown-notifications-item-content">
								<div class="dropdown-notifications-item-content-details"><?= $q['created_at'] ?> WIB</div>
								<div class="dropdown-notifications-item-content-text"><?= $q['title'] ?></div>
							</div>
							</a>
						<?php } ?>
						<a class="dropdown-item dropdown-notifications-footer" href="<?= base_url('Notifikasi') ?>">Lihat Semua Notifikasi</a>
			</div>
		</li>
		<li class="nav-item dropdown no-caret mr-2 dropdown-user">
			<a class="btn btn-icon-navbar btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="user"></i></a>
			<div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
				<h6 class="dropdown-header d-flex align-items-center">
					<img class="dropdown-user-img" src="<?= base_url("assets/img/logo_j_kopi.svg") ?>" />
					<div class="dropdown-user-details">
						<div class="dropdown-user-details-name">Admin J-KOPI</div>
						<div class="dropdown-user-details-email"><?= $Pengguna['email'] ?></div>
					</div>
				</h6>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="<?= base_url("Akun") ?>">
					<div class="dropdown-item-icon"><i data-feather="user"></i></div>
					Akun
				</a>
				<a class="dropdown-item" href="onclick=" confirm_modal() data-toggle="modal" data-target="#modalLogout">
					<div class="dropdown-item-icon"><i data-feather="power"></i></div>
					Logout
				</a>
			</div>
		</li>
	</ul>
</nav>

<div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="logoutModalLabel">Logout</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Apakah Anda yakin untuk logout?</div>
			<div class="modal-footer">
				<a class="btn btn-danger" type="button" href="<?= base_url('Login/Logout') ?>">Ya</a>
				<button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>