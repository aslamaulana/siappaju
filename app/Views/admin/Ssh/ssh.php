<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<style>
	/* .c1 {
		width: 30px;
		text-align: center;
	}

	.c2 {
		width: 150px;
	}

	.c3 {
		width: 300px;
	}

	.c4 {
		width: 450px;
	}

	.c5 {
		width: 550px;
	}

	.c6 {
		width: 90px;
	}

	.c7 {
		width: 150px;
	}

	.c8 {
		width: 80px;
	}

	.c9 {
		width: 60px;
	} */
</style>
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/admin/ssh/ssh/ssh_add'); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example2" class="table table-bordered display nowrap table-sm" cellspacing="0">
		<thead>
			<tr>
				<th class="c1">No</th>
				<th class="c4">
					<div style="width: 500px;">Komponen</div>
				</th>
				<th class="c5">
					<div style="width: 500px;">Spesifikasi</div>
				</th>
				<th class="c6">satuan</th>
				<th class="c7">harga</th>
				<th class="c8">Kelompok</th>
				<th class="c9">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="c1">No</th>
				<th class="c4">
					<div style="width: 500px;">Komponen</div>
				</th>
				<th class="c5">
					<div style="width: 500px;">Spesifikasi</div>
				</th>
				<th class="c6">satuan</th>
				<th class="c7">harga</th>
				<th class="c8">Kelompok</th>
				<th class="c9">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($ssh as $row) : ?>
				<tr>
					<td class="c1 align-top"><?= $nomor++; ?></td>
					<td class="c4 align-top text-wrap"><?= $row['komponen']; ?></td>
					<td class="c5 align-top text-wrap"><?= $row['spesifikasi']; ?></td>
					<td class="c6 align-top text-center"><?= $row['satuan']; ?></td>
					<td class="c7 align-top text-right"><?= 'Rp' . number_format((float)$row['harga'], 2, ',', '.'); ?></td>
					<td class="c8 align-top"><?= $row['kelompok']; ?></td>
					<td class="c9 align-top">
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/ssh/ssh/ssh_edit/' . $row['id_ssh']; ?>">
							<i class="nav-icon fas fa-pen-alt"></i>
						</a>
						<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/admin/ssh/ssh/ssh_hapus/' . $row['id_ssh']; ?>'}" href="#">
							<i class="nav-icon fas fa-trash-alt"></i>
						</a>
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