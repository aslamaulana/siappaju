<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<form action="<?= base_url('/user/asb/asb_hspk/asb_update') ?>" method="POST">
	<div class="card-body">
		<?= csrf_field() ?>
		<input type="hidden" name="id_asb_hspk" value="<?= $hspk['id_asb_hspk']; ?>">
		<input type="hidden" name="id_asb" value="<?= $id_asb; ?>">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Jumlah</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="number" step="any" value="<?= $hspk['jumlah']; ?>" name="index" class="form-control" maxlength="20" required>
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<button type="submit" class="btn btn-primary">Simpan</button>
	</div>
</form>
<?= $this->endSection(); ?>