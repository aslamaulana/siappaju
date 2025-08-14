<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="index3.html" class="brand-link" style="text-align: center;">
		<div class="image">
			<img src="<?= base_url('/toping/material/logo.png'); ?>" alt="AdminLTE Logo" style="width: -webkit-fill-available;max-width: 40px;margin-left: .8rem;">
			<span class="brand-text font-weight-light" style="font-family: monospace;" title="Sistem Informasi Pengendalian dan Evaluasi Kinerja Pembangunan Daerah"> SIAPPaJu</span>
		</div>
		<!-- <img src="<?= base_url('/toping/material/logo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item ">
					<a href="<?= base_url('/home'); ?>" class="nav-link <?= $mn == 'home' ? 'active' : ''; ?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
							<!-- <i class="right fas fa-angle-left"></i> -->
						</p>
					</a>
				</li>
				<?php if (has_permission('Admin')) : ?>
					<!-- =============================================================== -->
					<li class="nav-header">=======================</li>
					<!-- =============================================================== -->
					<li class="nav-item <?= $gr == 'skpd' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'skpd' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-university"></i>
							<p>
								SKPD
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/user/bidang'); ?>" class="nav-link <?= $mn == 'skpd' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Skpd</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item <?= $gr == 'menu' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'menu' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-th"></i>
							<p>
								Menu
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/menu/menu'); ?>" class="nav-link <?= $mn == 'menu' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Setting</p>
								</a>
							</li>
						</ul>
					</li>
				<?php endif; ?>
				<!-- <li class="nav-header">PD</li> -->
				<?php if (has_permission('Admin')) : ?>
					<!-- =============================================================== -->
					<li class="nav-header">=======================</li>
					<!-- =============================================================== -->
					<li class="nav-item <?= $gr == 'jenis' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'jenis' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-book"></i>
							<p>
								Kepmen
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/permen/jenis_akun'); ?>" class="nav-link <?= $mn == 'jenis_akun' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Akun</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/permen/jenis_kelompok'); ?>" class="nav-link <?= $mn == 'jenis_kelompok' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>2. </small> Kelompok</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/permen/jenis_jenis'); ?>" class="nav-link <?= $mn == 'jenis_jenis' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>3. </small> Jenis</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/permen/jenis_objek'); ?>" class="nav-link <?= $mn == 'jenis_objek' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>4. </small> Objek</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/permen/jenis_rincian_objek'); ?>" class="nav-link <?= $mn == 'jenis_rincian_objek' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>5. </small> Rincian Objek</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/permen/jenis_rincian_objek_sub'); ?>" class="nav-link <?= $mn == 'jenis_rincian_objek_sub' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>6. </small> Sub Rincian Objek</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item <?= $gr == 'rekening' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'rekening' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-comment"></i>
							<p>
								REKENING
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/rekening/rekening_akun'); ?>" class="nav-link <?= $mn == 'rekening_akun' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Akun</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/rekening/rekening_kelompok'); ?>" class="nav-link <?= $mn == 'rekening_kelompok' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>2. </small> Kelompok</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/rekening/rekening_jenis'); ?>" class="nav-link <?= $mn == 'rekening_jenis' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>3. </small> Jenis</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/rekening/rekening_objek'); ?>" class="nav-link <?= $mn == 'rekening_objek' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>3. </small> Objek</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/rekening/rekening_rincian_objek'); ?>" class="nav-link <?= $mn == 'rekening_rincian_objek' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>3. </small> Rincian Objek</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/rekening/rekening_rincian_objek_sub'); ?>" class="nav-link <?= $mn == 'rekening_rincian_objek_sub' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>3. </small> Sub Rincian Objek</p>
								</a>
							</li>
						</ul>
					</li>
					<!-- =============================================================== -->
					<li class="nav-header">=======================</li>
					<!-- =============================================================== -->
					<li class="nav-item <?= $gr == 'ssh' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'ssh' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-clipboard-list"></i>
							<p>
								SSH/ SBU
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/ssh/opd_data_ssh'); ?>" class="nav-link <?= $mn == 'ssh_pengajuan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Pengajuan</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/ssh/ssh'); ?>" class="nav-link <?= $mn == 'ssh' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>2. </small> SSH/SBU</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item <?= $gr == 'a-hspk' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'a-hspk' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-stream"></i>
							<p>
								HSPK
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/hspk/opd_data'); ?>" class="nav-link <?= $mn == 'a-hspk' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Pengajuan</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/hspk/hspk'); ?>" class="nav-link <?= $mn == 'a-hspk-all' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>2. </small> HSPK</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item <?= $gr == 'a-asb' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'a-asb' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-chart-bar"></i>
							<p>
								ASB
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/asb/opd_data_asb'); ?>" class="nav-link <?= $mn == 'a-asb' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Pengajuan</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/asb/asb'); ?>" class="nav-link <?= $mn == 'a-asb-all' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>2. </small> ASB</p>
								</a>
							</li>
						</ul>
					</li>
					<!-- =============================================================== -->
					<li class="nav-header">=======================</li>
					<!-- =============================================================== -->
					<li class="nav-item <?= $gr == 'laporan' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'laporan' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-comment"></i>
							<p>
								Laporan
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/sshsbu/ssh_laporan'); ?>" class="nav-link <?= $mn == 'ssh_laporan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> SSH/SBU Cetak</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/hspk/hspk_laporan'); ?>" class="nav-link <?= $mn == 'a-hspk-laporan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>2. </small> Laporan hspk</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/asb/asb_laporan'); ?>" class="nav-link <?= $mn == 'a-asb-laporan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>3. </small> Laporan Asb</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/sshsbu/sshhspk_laporan'); ?>" class="nav-link <?= $mn == 'sshhspk_laporan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>4. </small> Ssh/Sbu/Hspk/Asb</p>
								</a>
							</li>
						</ul>
					</li>
				<?php endif; ?>
				<?php if (has_permission('User')) : ?>
					<li class="nav-item <?= $gr == 'opd' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'opd' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-house-user"></i>
							<p>
								OPD
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/user/users/user'); ?>" class="nav-link <?= $mn == 'bidang' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Bidang & Sub Bidang</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item <?= $gr == 'ssh' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'ssh' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-clipboard-list"></i>
							<p>
								SSH/ SBU
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<!-- <li class="nav-item">
								<a href="<?= base_url('/user/ssh/ssh_perbup'); ?>" class="nav-link <?= $mn == 'ssh_perbup' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Perbup y-1</p>
								</a>
							</li> -->
							<!-- <li class="nav-item">
								<a href="<?= base_url('/user/ssh/ssh_acuan'); ?>" class="nav-link <?= $mn == 'ssh_acuan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>2. </small> Data Awal SSH/SBU</p>
								</a>
							</li> -->
							<li class="nav-item">
								<a href="<?= base_url('/user/ssh/ssh_pengajuan'); ?>" class="nav-link <?= $mn == 'ssh_pengajuan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Pengajuan Baru</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item <?= $gr == 'hspk' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'hspk' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-stream"></i>
							<p>
								HSPK
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/hspk/hspk'); ?>" class="nav-link <?= $mn == 'hspk' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Pengajuan</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/hspk/hspk_laporan'); ?>" class="nav-link <?= $mn == 'hspk-laporan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>2. </small> Laporan hspk</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item <?= $gr == 'asb' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'asb' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-comment"></i>
							<p>
								ASB
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/asb/asb'); ?>" class="nav-link <?= $mn == 'asb' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Pengajuan</p>
								</a>
							</li>
						</ul>
					</li>
				<?php endif; ?>
				<br>
				<br>
				<br>
				<br>
			</ul>
		</nav>
	</div>
</aside>