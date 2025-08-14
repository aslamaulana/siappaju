<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<style>
	.c1 {
		width: 30px;
		text-align: center;
	}

	.c2 {
		width: 150px;
		text-align: center;
	}

	.c3 {
		text-align: center;
	}

	.c4 {
		width: 70px;
		text-align: center;
	}
</style>
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/user/ssh/ssh_acuan/rekening_acuan_add/' . $ssh['id_ssh']); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<td style="width: 140px;;"><b>Komponen :</b></td>
			<td><?= $ssh['komponen']; ?></td>
		</tr>
		<tr>
			<td><b>Spesifikasi :</b></td>
			<td><?= $ssh['spesifikasi']; ?></td>
		</tr>
	</table><br>
	<table id="example1" class="table table-bordered">
		<thead>
			<tr>
				<th class="c1">No</th>
				<th class="c2">Kode Rekening</th>
				<th class="c3">Rekening</th>
				<th class="c4">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="c1">No</th>
				<th class="c2">Kode Rekening</th>
				<th class="c3">Rekening</th>
				<th class="c4">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($rekening as $row) : ?>
				<tr>
					<td class="c1"><?= $nomor++; ?></td>
					<td class="c2"><?= $row['kode_rekening_rincian_objek_sub']; ?></td>
					<td><?= $row['rekening_rincian_objek_sub']; ?></td>
					<td class="text-center align-baseline">
						<?php if ($row['opd_id'] == user()->opd_id) : ?>
							<!-- ------------------------------------------------------------------------------------------- -->
							<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/ssh/ssh_acuan/rekening_acuan_hapus/' . $row['id_ssh_rekening']; ?>'}" href="#">
								<i class="nav-icon fas fa-trash-alt"></i>
							</a>
							<!-- ------------------------------------------------------------------------------------------- -->
						<?php else : ?>
							<a class="dropdown-toggle btn btn-primary btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Add by
							</a>
							<div class="dropdown-menu dropdown-menu-right" style="width: 600px;" aria-labelledby="navbarDropdown">
								<!-- 	<h6 class="dropdown-item">  </h6> -->
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">
									<div class="media">
										<div class="media-body">
											<h3 class="dropdown-item-title">
												Keterangan:
											</h3>
											<p class="text-sm" style="white-space: pre-wrap;"><?= $row['created_by']; ?></p>
										</div>
									</div>
								</a>
							</div>
						<?php endif ?>
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