<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<form action="<?= base_url('/user/hspk/hspk_komponen/data_update') ?>" method="POST">
	<div class="card-body">
		<?= csrf_field() ?>
		<input type="hidden" name="id_hspk" value="<?= $id_hspk; ?>">
		<input type="hidden" name="id" value="<?= $data['id_hspk_komponen']; ?>">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Koefisien</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="number" step="any" name="index" value="<?= $data['index']; ?>" class="form-control" maxlength="20" required>
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<button type="submit" class="btn btn-primary">Simpan</button>
	</div>
</form>
<?= $this->endSection(); ?>