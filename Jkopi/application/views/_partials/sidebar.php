<div id="layoutSidenav_nav">
	<nav class="sidenav card shadow-none sidenav-light">
		<div class="sidenav-menu">
			<div class="nav accordion" id="accordionSidenav">
				<div class="sidenav-menu-heading">Dashboard</div>
				<a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseDashboard" aria-expanded="false" aria-controls="collapseDashboard">
					<div class="nav-link-icon"><i data-feather="activity"></i></div>
					Dashboard
					<div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
				</a>
				<div class="collapse" id="collapseDashboard" data-parent="#accordionSidenav">
					<nav class="sidenav-menu-nested nav" id="accordionSidenavPages">
						<a class="nav-link" href="<?= base_url('master_data/Verifikasi_KTP') ?>">
							Verifikasi KTP
						</a>
					</nav>
				</div>
				<div class="sidenav-menu-heading">Statistik</div>
				<a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseStatistik" aria-expanded="false" aria-controls="collapseStatistik">
					<div class="nav-link-icon"><i data-feather="activity"></i></div>
					Statistik
					<div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
				</a>
				<div class="collapse" id="collapseStatistik" data-parent="#accordionSidenav">
					<nav class="sidenav-menu-nested nav" id="accordionSidenavPages">
						<a class="nav-link" href="<?= base_url('Dashboard/sijelas') ?>">
							Dashboard SI-JELAS
						</a>
						<a class="nav-link" href="<?= base_url('ComingSoon') ?>">
							Grafik J-KOPI
						</a>
						<a class="nav-link" href="<?= base_url('Dashboard/umkm') ?>">
							Grafik UMKM
						</a>
					</nav>
				</div>
				<div class="sidenav-menu-heading">Fitur Utama</div>
				<a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseYanmas" aria-expanded="false" aria-controls="collapseYanmas">
					<div class="nav-link-icon"><i data-feather="smartphone"></i></div>
					Aplikasi - Jember Pelayanan Masyarakat
					<div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
				</a>
				<div class="collapse" id="collapseYanmas" data-parent="#accordionSidenav">
					<nav class="sidenav-menu-nested nav" id="accordionSidenavPages">
						<a class="nav-link" href="<?= base_url('master_data/j_yanmas/JYanmas') ?>">
							Aplikasi - Jember Pelayanan Masyarakat
						</a>
						<a class="nav-link" href="<?= base_url('master_data/j_yanmas/Kedaruratan') ?>">
							Kedaruratan
						</a>
						<a class="nav-link" href="<?= base_url('master_data/j_yanmas/Hotline') ?>">
							Hotline
						</a>
					</nav>
				</div>
				<a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseJDER" aria-expanded="false" aria-controls="collapseJDER">
					<div class="nav-link-icon"><i data-feather="smartphone"></i></div>
					Aplikasi Jember Digital Entrepreneur
					<div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
				</a>
				<div class="collapse" id="collapseJDER" data-parent="#accordionSidenav">
					<nav class="sidenav-menu-nested nav" id="accordionSidenavPages">
						<a class="nav-link" href="<?= base_url('master_data/JDer') ?>">
							Data Aplikasi Jember Digital Entrepreneur
						</a>
					</nav>
				</div>
				<a class="nav-link" href="<?= base_url('master_data/JemberKeren') ?>">
					<div class="nav-link-icon"><i data-feather="smartphone"></i></div>
					Jember Keren
				</a>
				<a class="nav-link" href="<?= base_url('master_data/JEvent') ?>">
					<div class="nav-link-icon"><i data-feather="smartphone"></i></div>
					J-EVENT
				</a>
				<div class="sidenav-menu-heading">Menu Informasi</div>
				<a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseInformasi" aria-expanded="false" aria-controls="collapseInformasi">
					<div class="nav-link-icon"><i data-feather="file-text"></i></div>
					Menu Informasi
					<div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
				</a>
				<div class="collapse" id="collapseInformasi" data-parent="#accordionSidenav">
					<nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesInformasi">
						<a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseFasilitasUmum" aria-expanded="false" aria-controls="collapsePerlengkapanFasilitasJalan">
							Fasilitas Umum
							<div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
						</a>
						<div class="collapse" id="collapseFasilitasUmum" data-parent="#accordionSidenavPagesInformasi">
							<nav class="sidenav-menu-nested nav">
								<a class="nav-link" href="<?= base_url('menu_informasi/FasilitasUmum') ?>">
									Data Fasilitas Umum
								</a>
								<a class="nav-link" href="<?= base_url('menu_informasi/KategoriFasilitasUmum') ?>">
									Kategori Fasilitas Umum
								</a>
							</nav>
						</div>
					</nav>
				</div>
				<a class="nav-link" href="<?= base_url('menu_informasi/VersiAplikasi') ?>">
					<div class="nav-link-icon"><i data-feather="smartphone"></i></div>
					Versi Aplikasi
				</a>
				<div class="sidenav-menu-heading">Master Data</div>
				<a class="nav-link" href="<?= base_url('master_data/APIKey') ?>">
					<div class="nav-link-icon"><i data-feather="smartphone"></i></div>
					API Key Dinamis
				</a>
				<a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseMasterData" aria-expanded="false" aria-controls="collapseMasterData">
					<div class="nav-link-icon"><i data-feather="hard-drive"></i></div>
					Master Data
					<div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
				</a>
				<div class="collapse" id="collapseMasterData" data-parent="#accordionSidenav">
					<nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
						<a class="nav-link" href="<?= base_url('master_data/Admin') ?>">
							Data Admin
						</a>
						<a class="nav-link" href="<?= base_url('master_data/Pengguna') ?>">
							Data Pengguna
						</a>
						<a class="nav-link" href="<?= base_url('master_data/KebijakanPrivasi') ?>">
							Kebijakan Privasi
						</a>
						<a class="nav-link" href="<?= base_url('master_data/Kecamatan') ?>">
							Kecamatan
						</a>
						<a class="nav-link" href="<?= base_url('master_data/Kelurahan') ?>">
							Kelurahan
						</a>
						<a class="nav-link" href="<?= base_url('master_data/KontakKami') ?>">
							Kontak Kami
						</a>
						<a class="nav-link" href="<?= base_url('master_data/OPD') ?>">
							OPD
						</a>
						<a class="nav-link" href="<?= base_url('master_data/Slider') ?>">
							Slider
						</a>
						<a class="nav-link" href="<?= base_url('master_data/SyaratKetentuan') ?>">
							Syarat Ketentuan
						</a>
					</nav>
				</div>
				<div class="sidenav-menu-heading">Pengaturan Akun</div>
				<a class="nav-link" href="<?= base_url('Akun') ?>">
					<div class="nav-link-icon"><i data-feather="user"></i></div>
					Akun
				</a>
				<div class="sidenav-menu-heading">Logout</div>
				<a class="nav-link" href="onclick=" confirm_modal() data-toggle="modal" data-target="#modalLogout">
					<div class="nav-link-icon"><i data-feather="power"></i></div>
					Logout
				</a>
				<input type="text" id="status" name="status" value="<?= $Pengguna['status'] ?>" hidden>
			</div>
		</div>
		<div class="sidenav-footer">
			<div class="sidenav-footer-content">
				<div class="sidenav-footer-subtitle">Log in sebagai:</div>
				<div class="sidenav-footer-title"><?= $Pengguna['email'] ?></div>
			</div>
		</div>
	</nav>
</div>

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
				<a class="btn btn-danger" type="button" href="<?= base_url('Login/logout') ?>">Ya</a>
				<button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>