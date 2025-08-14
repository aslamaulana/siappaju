<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/admin/ssh/ssh/ssh_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" value="<?= $ssh['id_ssh']; ?>" name="id">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Komponen</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" value="<?= $ssh['komponen']; ?>" name="komponen" class="form-control" maxlength="500" require>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Spesifikasi</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" value="<?= $ssh['spesifikasi']; ?>" name="spesifikasi" class="form-control" maxlength="500" require>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Satuan</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" value="<?= $ssh['satuan']; ?>" name="satuan" class="form-control" maxlength="500" require>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Harga</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" value="<?= $ssh['harga']; ?>" name="harga" class="form-control" maxlength="500" require>
				</div>
			</div>
		</div>

		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>