<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/admin/ssh/ssh/ssh_create') ?>" method="POST">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Komponen</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" name="komponen" class="form-control" maxlength="500" require>
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
					<input type="text" name="spesifikasi" class="form-control" maxlength="500" require>
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
					<input type="text" name="satuan" class="form-control" maxlength="500" require>
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
					<input type="text" name="harga" class="form-control" maxlength="500" require>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Type</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="type" class="form-control select2bs4" required>
						<option value="1">SSH</option>
						<option value="2">HSPK</option>
						<option value="3">ASB</option>
						<option value="4">SBU</option>
					</select>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>