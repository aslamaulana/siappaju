<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<div class="table-responsive">
		<table id="example1" class="table table-bordered" style="max-width: 1920px;min-width: 100%;">
			<thead>
				<tr>
					<th style="text-align: center;" width="30px">No</th>
					<th>Nama SKPD</th>
					<th class="text-center">Belum Diverifikasi</th>
					<th class="text-center">Lolos</th>
					<th class="text-center">Ditolak</th>
					<th class="text-center">Dikembalikan</th>
					<th class="text-center">Diajukan Kembali</th>
					<th class="text-center">Paket</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th style="text-align: center;" width="30px">No</th>
					<th>Nama SKPD</th>
					<th class="text-center">Belum Diverifikasi</th>
					<th class="text-center">Lolos</th>
					<th class="text-center">Ditolak</th>
					<th class="text-center">Dikembalikan</th>
					<th class="text-center">Diajukan Kembali</th>
					<th class="text-center">Paket</th>
				</tr>
			</tfoot>
			<tbody>
				<?php $nomor = 1;
				foreach ($opd as $row) : ?>
					<tr>
						<td style="text-align: center;"><?= $nomor++; ?></td>
						<td>
							<a href="<?= base_url('/admin/asb/asb/asb/' . $row['id'] . '/' . $row['description']); ?>">
								<?= $row['description']; ?>
							</a>
						</td>
						<td class="text-center">
							<?= $diajukan = $db->table('tb_asb_verifikasi')->getWhere(['verifikasi' => 'diajukan', 'opd_id' => $row['id'], 'tb_asb_verifikasi.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</td>
						<td class="text-center">
							<?= $lolos = $db->table('tb_asb_verifikasi')->getWhere(['verifikasi' => 'lolos', 'opd_id' => $row['id'], 'tb_asb_verifikasi.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</td>
						<td class="text-center">
							<?= $ditolak = $db->table('tb_asb_verifikasi')->getWhere(['verifikasi' => 'ditolak', 'opd_id' => $row['id'], 'tb_asb_verifikasi.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</td>
						<td class="text-center">
							<?= $dikembalikan = $db->table('tb_asb_verifikasi')->getWhere(['verifikasi' => 'dikembalikan', 'opd_id' => $row['id'], 'tb_asb_verifikasi.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</td>
						<td class="text-center">
							<?= $diajukan_kembali = $db->table('tb_asb_verifikasi')->getWhere(['verifikasi' => 'edit', 'opd_id' => $row['id'], 'tb_asb_verifikasi.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</td>
						<td class="text-center">
							<?= $paket = $db->table('tb_asb')->getWhere(['opd_id' => $row['id'], 'tb_asb.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<?= $this->endSection(); ?>