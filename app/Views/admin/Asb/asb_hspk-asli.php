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
		width: 190px;
	}
</style>
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/admin/asb/asb_hspk/asb_add/' . $id_asb); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<b>
		<div>ASB :&nbsp;<?= $asb['asb_paket']; ?></div><br>
	</b>
	<table id="example1" class="table table-bordered">
		<thead>
			<tr class="">
				<th class="c1">No</th>
				<th class="">Paket</th>
				<th class="c4">Total</th>
				<th class="c5">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>No</th>
				<th>Paket</th>
				<th class="c4">Total</th>
				<th>Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($asb_hspk as $row) : ?>
				<tr class="">
					<td><?= $nomor++; ?></td>
					<td><?= $row['hspk_paket']; ?></td>
					<!-- ------------------------------------------------------------------------------------ -->
					<?php
					$A = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $row['id_hspk'], 'tb_hspk_komponen.group' => 'A'])->getResultArray();
					$B = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $row['id_hspk'], 'tb_hspk_komponen.group' => 'B'])->getResultArray();
					$C = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $row['id_hspk'], 'tb_hspk_komponen.group' => 'C'])->getResultArray();

					foreach ($A as $roA) :
						$num[$row['id_hspk'] . 'A'][] = ($roA['harga'] * $roA['index']);
					endforeach;
					foreach ($B as $roB) :
						$num[$row['id_hspk'] . 'B'][] = ($roB['harga'] * $roB['index']);
					endforeach;
					foreach ($C as $roC) :
						$num[$row['id_hspk'] . 'C'][] = ($roC['harga'] * $roC['index']);
					endforeach; ?>
					<!-- ------------------------------------------------------------------------------------ -->
					<td class="text-right">
						<?php
						isset($num[$row['id_hspk'] . 'A']) ? $AA = ($num[$row['id_hspk'] . 'A']) : $AA = ['0'];
						isset($num[$row['id_hspk'] . 'B']) ? $BB = ($num[$row['id_hspk'] . 'B']) : $BB = ['0'];
						isset($num[$row['id_hspk'] . 'C']) ? $CC = ($num[$row['id_hspk'] . 'C']) : $CC = ['0'];
						echo number_format((array_sum($AA) + array_sum($BB) + array_sum($CC)), 2, ',', '.');
						?>
					</td>
					<td class="text-center align-baseline">
						<!-- ------------------------------------------------------------------------------------------- -->
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/ssh/hspk/hspk_edit/' . $row['id_hspk']; ?>">
							<i class="nav-icon fas fa-pen-alt"></i>
						</a>
						<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/ssh/hspk/hspk_hapus/' . $row['id_hspk']; ?>'}" href="#">
							<i class="nav-icon fas fa-trash-alt"></i>
						</a>
						<!-- ------------------------------------------------------------------------------------------- -->
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