<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<div class="row">
		<div class="col-lg-4 col-6">
			<!-- small box -->
			<div class="small-box bg-info">
				<div style="display: flex;padding: 20px;">
					<div class="inner col-6 text-center">
						<h3>
							<?= $diajukan = $db->table('tb_ssh_verifikasi')->getWhere(['verifikasi' => 'diajukan', 'tb_ssh_verifikasi.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</h3>
						<p>Menunggu Verifikasi</p>
					</div>
					<div class="inner col-6 text-center">
						<h3>
							<?= $diajukan_kembali = $db->table('tb_ssh_verifikasi')->getWhere(['verifikasi' => 'edit', 'tb_ssh_verifikasi.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</h3>
						<p>Menunggu Verifikasi Ulang</p>
					</div>
				</div>
				<div style="display: flex;padding: 20px;">
					<div class="inner col-6 text-center">
						<h3>
							<?= $db->table('tb_ssh_verifikasi')->getWhere(['verifikasi' => 'dikembalikan', 'tb_ssh_verifikasi.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</h3>
						<p>Dikembalikan</p>
					</div>
					<div class="inner col-6 text-center">
						<h3>
							<?= $db->table('tb_ssh_verifikasi')->getWhere(['verifikasi' => 'lolos', 'tb_ssh_verifikasi.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</h3>
						<p>Lolos Verifikasi</p>
					</div>
				</div>
				<div class="icon">
					<i class="ion ion-bag"></i>
				</div>
				<a href="<?= base_url('/admin/ssh/opd_data_ssh'); ?>" class="small-box-footer">SSH / SBU <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-4 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div style="display: flex;padding: 20px;">
					<div class="inner col-6 text-center">
						<h3>
							<?= $diajukan = $db->table('tb_verifikasi')->getWhere(['verifikasi' => 'diajukan', 'tb_verifikasi.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</h3>
						<p>Menunggu Verifikasi</p>
					</div>
					<div class="inner col-6 text-center">
						<h3>
							<?= $diajukan_kembali = $db->table('tb_verifikasi')->getWhere(['verifikasi' => 'edit', 'tb_verifikasi.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</h3>
						<p>Menunggu Verifikasi Ulang</p>
					</div>
				</div>
				<div style="display: flex;padding: 20px;">
					<div class="inner col-6 text-center">
						<h3>
							<?= $db->table('tb_verifikasi')->getWhere(['verifikasi' => 'dikembalikan', 'tb_verifikasi.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</h3>
						<p>Dikembalikan</p>
					</div>
					<div class="inner col-6 text-center">
						<h3>
							<?= $db->table('tb_verifikasi')->getWhere(['verifikasi' => 'lolos', 'tb_verifikasi.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</h3>
						<p>Lolos Verifikasi</p>
					</div>
				</div>
				<div class="icon">
					<i class="ion ion-bag"></i>
				</div>
				<a href="<?= base_url('/admin/hspk/opd_data'); ?>" class="small-box-footer">HSPK <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-4 col-6">
			<!-- small box -->
			<div class="small-box bg-warning">
				<div style="display: flex;padding: 20px;">
					<div class="inner col-6 text-center">
						<h3>
							<?= $diajukan = $db->table('tb_asb_verifikasi')->getWhere(['verifikasi' => 'diajukan', 'tb_asb_verifikasi.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</h3>
						<p>Menunggu Verifikasi</p>
					</div>
					<div class="inner col-6 text-center">
						<h3>
							<?= $diajukan_kembali = $db->table('tb_asb_verifikasi')->getWhere(['verifikasi' => 'edit', 'tb_asb_verifikasi.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</h3>
						<p>Menunggu Verifikasi Ulang</p>
					</div>
				</div>
				<div style="display: flex;padding: 20px;">
					<div class="inner col-6 text-center">
						<h3>
							<?= $db->table('tb_asb_verifikasi')->getWhere(['verifikasi' => 'dikembalikan', 'tb_asb_verifikasi.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</h3>
						<p>Dikembalikan</p>
					</div>
					<div class="inner col-6 text-center">
						<h3>
							<?= $db->table('tb_asb_verifikasi')->getWhere(['verifikasi' => 'lolos', 'tb_asb_verifikasi.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</h3>
						<p>Lolos Verifikasi</p>
					</div>
				</div>
				<div class="icon">
					<i class="ion ion-person-add"></i>
				</div>
				<a href="<?= base_url('/admin/asb/opd_data_asb'); ?>" class="small-box-footer">ASB <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
	</div>
</div>
<?= $this->endSection(); ?>