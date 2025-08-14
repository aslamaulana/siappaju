<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/admin/user/users/users_add/' . $opd_id); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!-- <div class="card-body">
	<h4><?php // $_GET['nm']; 
		?></h4>
</div> -->
<div class="card-body">
	<table class="table table-bordered" id="example1" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>SKPD</th>
				<th>Nama Pengguna</th>
				<th>Username</th>
				<th>Aktif</th>
				<th style="width: 80px; text-align:center;">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>SKPD</th>
				<th>Nama Pengguna</th>
				<th>Username</th>
				<th>Aktif</th>
				<th style="text-align:center;">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php foreach ($users as $row) : ?>
				<tr>
					<td><?= $row['group_name']; ?></td>
					<td><?= $row['full_name']; ?></td>
					<td><?= $row['username']; ?></td>
					<td><?= $row['active'] == '1' ? '<font color="gren">Aktif</font>' : '<font color="red">Tidak</font>'; ?></td>
					<td style="text-align:center;">
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url('/admin/user/users/users_edit/' . $opd_id . '/' . kunci($row['id'])); ?>">
							<i class="nav-icon fas fa-pen-alt"></i>
						</a>
						<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url('/admin/user/users/hapus/' . $row['id']); ?>'}" href="#">
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