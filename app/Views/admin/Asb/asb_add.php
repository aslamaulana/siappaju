<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<form action="<?= base_url('/admin/asb/asb/asb_create') ?>" method="POST">
	<div class="card-body">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Nama Paket</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" name="nm_paket" class="form-control" maxlength="300" require>
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<button type="submit" class="btn btn-primary">Simpan</button>
	</div>
</form>
<?= $this->endSection(); ?>