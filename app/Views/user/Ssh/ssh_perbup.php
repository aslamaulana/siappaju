<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('ssh')->kunci != 'ya') { ?>
	<div style="width:90px;position: absolute;right: 0px;">
		<a href="<?= base_url('/user/ssh/ssh_pengajuan/pengajuan_add'); ?>">
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
		</a>
	</div>
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
	<table id="example2" class="table table-bordered display nowrap table-sm" cellspacing="0">
		<thead>
			<tr>
				<th class="text-center" style="width: 30px;">No</th>
				<th>
					<div style="width: 700px;">Komponen</div>
				</th>
				<th>
					<div style="width: 700px;">Spesifikasi</div>
				</th>
				<th class="text-center" style="width: 90px;">Satuan</th>
				<th class="text-center" style="width: 150px;">Harga</th>
				<th class="text-center" style="width: 80px;">TKDN %</th>
				<th class="text-center" style="width: 80px;">Kelompok</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="text-center" style="width: 30px;">No</th>
				<th>
					<div style="width: 700px;">Komponen</div>
				</th>
				<th>
					<div style="width: 700px;">Spesifikasi</div>
				</th>
				<th class="text-center" style="width: 90px;">Satuan</th>
				<th class="text-center" style="width: 150px;">Harga</th>
				<th class="text-center" style="width: 80px;">TKDN %</th>
				<th class="text-center" style="width: 80px;">Kelompok</th>
			</tr>
		</tfoot>
		<tbody>
			<?php
			foreach ($ssh as $row) : ?>
				<tr class="">
					<td class="text-center align-top"><?= $row['jenis_rincian_objek_sub_id']; ?></td>
					<td class="text-wrap align-top"><?= $row['komponen']; ?></td>
					<td class="text-wrap align-top"><?= $row['spesifikasi']; ?></td>
					<td class="text-center align-top"><?= $row['satuan']; ?></td>
					<td class="text-right align-top"><?= 'Rp. ' . number_format((float)$row['harga'], 2, ',', '.'); ?></td>
					<td class="text-center align-top"><?= $row['tkdn']; ?></td>
					<td class="text-center align-top"><?= $row['kelompok']; ?></td>

					<!-- ------------------------------------------------------------------------------------ -->

					<!-- ------------------------------------------------------------------------------------------- -->
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
<script src="<?= base_url('/toping/plugins/datatables-rowgroup/js/dataTables.rowGroup.min.js') ?>"></script>

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
			"scrollX": true,
			"scrollY": '65vh',
			"scrollCollapse": true,
			"paging": true,
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			],
		});
	});
</script>
<?= $this->endSection(); ?>