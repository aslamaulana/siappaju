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

	.c3 {
		width: 100px;
		text-align: center;
	}

	.c4 {
		width: 130px;
		text-align: center;
	}

	.c5 {
		width: 60px;
		text-align: center;
	}
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<td style="width: 140px;;"><b>ASB &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b></td>
			<td><?= $asb['asb_paket']; ?></td>
		</tr>
		<tr>
			<td><b>Spesifikasi :</b></td>
			<td><?= $asb['asb_spesifikasi'] . ' (' . $asb['asb_satuan'] . ')'; ?></td>
		</tr>
		<tr>
			<!-- ------------------------------------------------------------------------------------ -->
			<?php $hspk = $db->table('tb_asb_hspk')->select('tb_asb_hspk.*')->getWhere(['tb_asb_hspk.tahun' => $_SESSION['tahun'], 'tb_asb_hspk.asb_id' => $asb['id_asb']])->getResultArray();
			foreach ($hspk as $rot) :
				$As = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $rot['hspk_id'], 'tb_hspk_komponen.group' => 'A'])->getResultArray();
				$Bs = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $rot['hspk_id'], 'tb_hspk_komponen.group' => 'B'])->getResultArray();
				$Cs = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $rot['hspk_id'], 'tb_hspk_komponen.group' => 'C'])->getResultArray();

				foreach ($As as $roAs) :
					$numS[$rot['hspk_id'] . 'A'][] = ($roAs['harga'] * $roAs['index']);
				endforeach;
				foreach ($Bs as $roBs) :
					$numS[$rot['hspk_id'] . 'B'][] = ($roBs['harga'] * $roBs['index']);
				endforeach;
				foreach ($Cs as $roCs) :
					$numS[$rot['hspk_id'] . 'C'][] = ($roCs['harga'] * $roCs['index']);
				endforeach;
				isset($numS[$rot['hspk_id'] . 'A']) ? $AA = ($numS[$rot['hspk_id'] . 'A']) : $AA = ['0'];
				isset($numS[$rot['hspk_id'] . 'B']) ? $BB = ($numS[$rot['hspk_id'] . 'B']) : $BB = ['0'];
				isset($numS[$rot['hspk_id'] . 'C']) ? $CC = ($numS[$rot['hspk_id'] . 'C']) : $CC = ['0'];
				$numS[$asb['id_asb']][] = (array_sum($AA) + array_sum($BB) + array_sum($CC)) * $rot['jumlah'];
			endforeach; ?>
			<!-- ------------------------------------------------------------------------------------ -->
			<td><b>Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b></td>
			<td><?= isset($numS[$asb['id_asb']]) ? number_format(array_sum($numS[$asb['id_asb']]), 2, ',', '.') : '-'; ?></td>
		</tr>
	</table><br>
	<table id="example1" class="table table-bordered">
		<thead>
			<tr class="">
				<th class="c1">No</th>
				<th class="">Paket</th>
				<th class="">Spesifikasi</th>
				<th class="c4">Satuan</th>
				<th class="c5">Jumlah</th>
				<th class="c4">Harga</th>
				<th class="c4">Total</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="c1">No</th>
				<th>Paket</th>
				<th class="">Spesifikasi</th>
				<th class="c4">Satuan</th>
				<th class="c5">Jumlah</th>
				<th class="c4">Harga</th>
				<th class="c4">Total</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($asb_hspk as $row) : ?>
				<tr class="">
					<td class="c1"><?= $nomor++; ?></td>
					<td><?= $row['hspk_paket']; ?></td>
					<td><?= $row['hspk_spesifikasi']; ?></td>
					<td class="c4"><?= $row['hspk_satuan']; ?></td>
					<td class="c5"><?= $row['jumlah']; ?></td>
					<!-- ------------------------------------------------------------------------------------ -->
					<?php
					$A = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $row['hspk_id'], 'tb_hspk_komponen.group' => 'A'])->getResultArray();
					$B = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $row['hspk_id'], 'tb_hspk_komponen.group' => 'B'])->getResultArray();
					$C = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $row['hspk_id'], 'tb_hspk_komponen.group' => 'C'])->getResultArray();

					foreach ($A as $roA) :
						$num[$row['hspk_id'] . 'A'][] = ($roA['harga'] * $roA['index']);
					endforeach;
					foreach ($B as $roB) :
						$num[$row['hspk_id'] . 'B'][] = ($roB['harga'] * $roB['index']);
					endforeach;
					foreach ($C as $roC) :
						$num[$row['hspk_id'] . 'C'][] = ($roC['harga'] * $roC['index']);
					endforeach; ?>
					<!-- ------------------------------------------------------------------------------------ -->
					<td class="text-right">
						<?php
						isset($num[$row['hspk_id'] . 'A']) ? $AA = ($num[$row['hspk_id'] . 'A']) : $AA = ['0'];
						isset($num[$row['hspk_id'] . 'B']) ? $BB = ($num[$row['hspk_id'] . 'B']) : $BB = ['0'];
						isset($num[$row['hspk_id'] . 'C']) ? $CC = ($num[$row['hspk_id'] . 'C']) : $CC = ['0'];
						echo number_format((array_sum($AA) + array_sum($BB) + array_sum($CC)), 2, ',', '.');
						?>
					</td>
					<td class="text-right">
						<?php
						echo number_format((array_sum($AA) + array_sum($BB) + array_sum($CC)) * $row['jumlah'], 2, ',', '.');
						?>
					</td>
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