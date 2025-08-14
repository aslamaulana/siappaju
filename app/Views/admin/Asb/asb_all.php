<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<style>
	.c1 {
		width: 30px;
		text-align: center;
	}

	.c2 {
		width: 100px;
		text-align: center;
	}

	.c2a {
		width: 300px;
	}

	.c3 {
		width: 100px;
		text-align: center;
	}

	.c4 {
		width: 130px;
		text-align: center;
	}

	.c5 {
		width: 160px;
		text-align: center;
	}
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered table-sm">
		<thead>
			<tr class="">
				<th class="c1">No</th>
				<th class="c2a">Jenis Sub rincian Objek</th>
				<th class="">Paket</th>
				<th class="">Spesifikasi</th>
				<th class="c2">Satuan</th>
				<th class="c2">HSPK</th>
				<th class="c4">Total</th>
				<th class="c5"></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="c1">No</th>
				<th class="c2a">Jenis Sub rincian Objek</th>
				<th>Paket</th>
				<th class="">Spesifikasi</th>
				<th class="c2">Satuan</th>
				<th class="c2">HSPK</th>
				<th class="c4">Total</th>
				<th class="c5"></th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($asb as $row) : ?>
				<tr class="">
					<td class="c1"><?= $nomor++; ?></td>
					<td class="align-top text-wrap" title="<?= $row['kode_jenis_rincian_objek_sub']; ?>"><?= $row['jenis_rincian_objek_sub']; ?></td>
					<td class="align-top"><?= $row['asb_paket']; ?></td>
					<td class="align-top"><?= $row['asb_spesifikasi']; ?></td>
					<td class="c2 align-top"><?= $row['asb_satuan']; ?></td>
					<td class="c2 align-top">
						<?php $komponen = $db->table('tb_asb_hspk')->getWhere(['asb_id' => $row['id_asb']])->getNumRows(); ?>
						<a class="btn btn-success btn-circle btn-xs" href="<?= base_url('/admin/asb/asb_hspk/asb_all/' . $row['id_asb'] . '/' . $row['id']); ?>">
							<?= $komponen . '   '; ?><i class="nav-icon fas fa-list"></i>
						</a>
					</td>
					<?php $hspk = $db->table('tb_asb_hspk')->select('tb_asb_hspk.*')->getWhere(['tb_asb_hspk.asb_id' => $row['id_asb']])->getResultArray();
					foreach ($hspk as $rot) :
						$A = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.hspk_id' => $rot['hspk_id'], 'tb_hspk_komponen.group' => 'A'])->getResultArray();
						$B = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.hspk_id' => $rot['hspk_id'], 'tb_hspk_komponen.group' => 'B'])->getResultArray();
						$C = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.hspk_id' => $rot['hspk_id'], 'tb_hspk_komponen.group' => 'C'])->getResultArray();

						foreach ($A as $roA) :
							$num[$rot['hspk_id'] . $row['id_asb'] . 'A'][] = ($roA['harga'] * $roA['index']);
						endforeach;
						foreach ($B as $roB) :
							$num[$rot['hspk_id'] . $row['id_asb'] . 'B'][] = ($roB['harga'] * $roB['index']);
						endforeach;
						foreach ($C as $roC) :
							$num[$rot['hspk_id'] . $row['id_asb'] . 'C'][] = ($roC['harga'] * $roC['index']);
						endforeach;
						isset($num[$rot['hspk_id'] . $row['id_asb'] . 'A']) ? $AA = ($num[$rot['hspk_id'] . $row['id_asb'] . 'A']) : $AA = ['0'];
						isset($num[$rot['hspk_id'] . $row['id_asb'] . 'B']) ? $BB = ($num[$rot['hspk_id'] . $row['id_asb'] . 'B']) : $BB = ['0'];
						isset($num[$rot['hspk_id'] . $row['id_asb'] . 'C']) ? $CC = ($num[$rot['hspk_id'] . $row['id_asb'] . 'C']) : $CC = ['0'];
						$nud[$row['id_asb']][] = (array_sum($AA) + array_sum($BB) + array_sum($CC)) * $rot['jumlah'];
					endforeach; ?>
					<!-- ------------------------------------------------------------------------------------ -->
					<td class="text-right align-top">
						<?= isset($nud[$row['id_asb']]) ? number_format(array_sum($nud[$row['id_asb']]), 2, ',', '.') : '-'; ?>
					</td>
					<!-- ---------------------------------------verifikasi----------------------------------- -->
					<td class="align-baseline text-center"><?= $row['name']; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('/toping/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>

<script>
	$(function() {
		bsCustomFileInput.init();
	});
	$(function() {
		$("#example1").DataTable({
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
		});
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});
	});
</script>
<?= $this->endSection(); ?>