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
		width: 70px;
		text-align: center;
	}
</style>
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/admin/asb/asb/asb_add'); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">

	<table id="example1" class="table table-bordered">
		<thead>
			<tr class="">
				<th class="c1">No</th>
				<th class="">Paket</th>
				<th class="c2">HSPK</th>
				<th class="c4">Total</th>
				<th class="c5">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>No</th>
				<th>Paket</th>
				<th class="c2">HSPK</th>
				<th class="c4">Total</th>
				<th class="c5">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($asb as $row) : ?>
				<tr class="">
					<td><?= $nomor++; ?></td>
					<td><?= $row['asb_paket']; ?></td>
					<td class="c2">
						<?php $komponen = $db->table('tb_asb_hspk')->getWhere(['asb_id' => $row['id_asb']])->getNumRows(); ?>
						<a class="btn btn-success btn-circle btn-xs" href="<?= base_url('/admin/asb/asb_hspk/asb/' . $row['id_asb']); ?>">
							<?= $komponen . '   '; ?><i class="nav-icon fas fa-list"></i>
						</a>
					</td>
					<td class="text-right"> </td>
					<td class="text-center align-baseline">
						<!-- ------------------------------------------------------------------------------------------- -->
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/asb/asb/asb_edit/' . $row['id_asb']; ?>">
							<i class="nav-icon fas fa-pen-alt"></i>
						</a>
						<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/admin/asb/asb/asb_hapus/' . $row['id_asb']; ?>'}" href="#">
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