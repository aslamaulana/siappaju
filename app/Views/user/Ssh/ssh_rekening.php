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
			<tr style="background: antiquewhite;">
				<th class="c1">No</th>
				<th class="c2">Kode Rekening</th>
				<th class="c3">Rekening</th>
			</tr>
		</thead>
		<tbody>
			<?php $nomor = 1;
			foreach ($rekening as $row) : ?>
				<tr>
					<td class="c1"><?= $nomor++; ?></td>
					<td class="c2"><?= $row['kode_rekening_rincian_objek_sub']; ?></td>
					<td><?= $row['rekening_rincian_objek_sub']; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>

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