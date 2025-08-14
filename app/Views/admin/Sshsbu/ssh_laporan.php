<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<form action="<?= base_url('/admin/sshsbu/ssh_laporan/cetak') ?>" method="POST">
	<div class="card-body">
		<?= csrf_field() ?>
		<div class="row">
			<!-- <div class="col-md-1">
				<div class="form-group">
					<label>OPD</label>
				</div>
			</div>
			<div class="col-md-7">
				<div class="input-group">
					<select name="opd" class="form-control select2bs4" required>
						<option value=""></option>
						<option value="all">All - Cetak Semua OPD</option>
						<?php // foreach ($opd as $row) : 
						?>
							<option value="<? //= $row['id']; 
											?>"><? //= $row['name'] . ' - ' . $row['description']; 
												?></option>
						<?php // endforeach; 
						?>
					</select>
				</div>
			</div> -->
			<div class="col-md-6">
				<div class="input-group">
					<select name="jenis" class="form-control type" required>
						<option value="" disabled selected>pilih... SSH/SBU</option>
						<option value="sshsbu">SSH & SBU</option>
						<option value="ssh">SSH</option>
						<option value="sbu">SBU</option>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="input-group">
					<select name="type" class="form-control type" required>
						<option value="" disabled selected>pilih...</option>
						<option value="pdf" disabled>PDF</option>
						<option value="excel">Excel</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<button type="submit" class="btn btn-primary">Cetak</button>
	</div>
</form>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<script src="<?= base_url('/toping/plugins/select2/js/select2.full.min.js'); ?>"></script>
<script>
	$(function() {

		$('.select2bs4').select2({
			width: 'resolve',
			theme: 'bootstrap4',
			placeholder: 'Pilih...'
		})

	});
</script>
<?= $this->endSection(); ?>