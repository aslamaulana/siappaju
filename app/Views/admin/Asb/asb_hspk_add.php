<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<form action="<?= base_url('/admin/asb/asb_hspk/asb_create') ?>" method="POST">
	<div class="card-body">
		<?= csrf_field() ?>
		<input type="hidden" name="id_asb" value="<?= $id_asb; ?>">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>HSPK Paket</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="id_hspk" class="form-control select2bs4" required>
						<option value=""></option>
						<?php foreach ($hspk as $row) : ?>
							<option value="<?= $row['id_hspk']; ?>"><?= $row['hspk_paket']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Jumlah</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" name="index" class="form-control" maxlength="20" required>
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<button type="submit" class="btn btn-primary">Simpan</button>
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
			placeholder: 'Tidak Dipilih... [HSPK Paket]'
		})
	});
</script>
<?= $this->endSection(); ?>