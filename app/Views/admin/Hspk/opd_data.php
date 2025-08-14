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
							<a href="<?= base_url('/admin/hspk/hspk/paket/' . $row['id'] . '/' . $row['description']); ?>">
								<?= $row['description']; ?>
							</a>
						</td>
						<td class="text-center">
							<?= $diajukan = $db->table('tb_verifikasi')->getWhere(['opd_id' => $row['id'], 'verifikasi' => 'diajukan'])->getNumRows(); ?>
						</td>
						<td class="text-center">
							<?= $lolos = $db->table('tb_verifikasi')->getWhere(['opd_id' => $row['id'], 'verifikasi' => 'lolos'])->getNumRows(); ?>
						</td>
						<td class="text-center">
							<?= $ditolak = $db->table('tb_verifikasi')->getWhere(['opd_id' => $row['id'], 'verifikasi' => 'ditolak'])->getNumRows(); ?>
						</td>
						<td class="text-center">
							<?= $dikembalikan = $db->table('tb_verifikasi')->getWhere(['opd_id' => $row['id'], 'verifikasi' => 'dikembalikan'])->getNumRows(); ?>
						</td>
						<td class="text-center">
							<?= $diajukan_kembali = $db->table('tb_verifikasi')->getWhere(['opd_id' => $row['id'], 'verifikasi' => 'edit'])->getNumRows(); ?>
						</td>
						<td class="text-center">
							<?= $paket = $db->table('tb_hspk')->getWhere(['opd_id' => $row['id']])->getNumRows(); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<?= $this->endSection(); ?>