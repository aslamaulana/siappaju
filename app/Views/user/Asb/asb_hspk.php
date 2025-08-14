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

<?= $this->section('tombol'); ?>
<?php $jawab = $db->table('tb_asb_verifikasi')->join('auth_groups', 'tb_asb_verifikasi.opd_id = auth_groups.id', 'left')->getWhere(['asb_id' => $asb['id_asb']])->getRow(); ?>
<?php if (menu('asb')->kunci != 'ya') { ?>
	<?php if (isset($jawab)) : ?>
		<?php if ($jawab->verifikasi == 'dikembalikan') : ?>
			<div style="width:90px;position: absolute;right: 0px;">
				<a href="<?= base_url('/user/asb/asb_hspk/asb_add/' . $id_asb); ?>">
					<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
				</a>
			</div>
		<?php else : ?>

		<?php endif; ?>
	<?php else : ?>
		<div style="width:90px;position: absolute;right: 0px;">
			<a href="<?= base_url('/user/asb/asb_hspk/asb_add/' . $id_asb); ?>">
				<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
			</a>
		</div>
	<?php endif; ?>
<?php } else { ?>
	<div style="width:90px;position: absolute;right: 0px;">
		<a>
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-lock"></i> Add</li>
		</a>
	</div>
<?php } ?>
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
			<?php foreach ($asb_hspk2->Where(['tb_asb_hspk.asb_id' => $asb['id_asb']])->findAll() as $rot) : ?>
				<?php
				$A[$rot['id_asb_hspk']][] = $db->table('tb_hspk_komponen')
					->select('SUM(tb_hspk_komponen.index * tb_ssh.harga) AS total')
					->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')
					->getWhere(['tb_hspk_komponen.hspk_id' => $rot['hspk_id']])->getRowArray()['total'];
				?>
				<?php $total[$asb['id_asb']][] = array_sum($A[$rot['id_asb_hspk']]) * $rot['jumlah']; ?>
			<?php endforeach ?>
			<!-- ------------------------------------------------------------------------------------ -->
			<!-- ------------------------------------------------------------------------------------ -->

			<!-- ------------------------------------------------------------------------------------ -->
			<td><b>Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b></td>
			<td class="text-right">
				<?= isset($total[$asb['id_asb']]) ? number_format((float)array_sum($total[$asb['id_asb']]), 2, ',', '.') : '-'; ?>
			</td>
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
				<th class="c5">Aksi</th>
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
				<th class="c5">Aksi</th>
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
					<?php foreach ($asb_hspk2->Where(['tb_asb_hspk.asb_id' => $asb['id_asb']])->findAll() as $rot) : ?>
						<?php
						$A = $db->table('tb_hspk_komponen')
							->select('SUM(tb_hspk_komponen.index * tb_ssh.harga) AS total')
							->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')
							->getWhere(['tb_hspk_komponen.hspk_id' => $rot['hspk_id']])->getRowArray()['total'];
						?>
					<?php endforeach ?>
					<!-- ------------------------------------------------------------------------------------ -->
					<td class="text-right">
						<?= $A; ?>
					</td>
					<td class="text-right">
						<?= number_format((float)$A * $row['jumlah'], 2, ',', '.'); ?>
					</td>
					<td class="text-center align-baseline c5">
						<!-- ------------------------------------------------------------------------------------------- -->
						<?php if (menu('asb')->kunci != 'ya') { ?>
							<?php if (isset($jawab)) : ?>
								<?php if ($jawab->verifikasi == 'dikembalikan') : ?>
									<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/asb/asb_hspk/asb_edit/' . $row['id_asb_hspk'] . '/' . $id_asb; ?>">
										<i class="nav-icon fas fa-pen-alt"></i>
									</a>
									<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/asb/asb_hspk/asb_hapus/' . $row['id_asb_hspk']; ?>'}" href="#">
										<i class="nav-icon fas fa-trash-alt"></i>
									</a>
								<?php endif; ?>
							<?php else : ?>
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/asb/asb_hspk/asb_edit/' . $row['id_asb_hspk'] . '/' . $id_asb; ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
								<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/asb/asb_hspk/asb_hapus/' . $row['id_asb_hspk']; ?>'}" href="#">
									<i class="nav-icon fas fa-trash-alt"></i>
								</a>
							<?php endif; ?>
						<?php } else { ?>
							<a class="btn btn-danger btn-circle btn-xs">
								<i class="nav-icon fas fa-lock"></i>
							</a>
						<?php } ?>
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