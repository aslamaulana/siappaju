<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<form action="<?= base_url('/user/asb/asb/asb_update') ?>" method="POST">
	<div class="card-body">
		<?= csrf_field() ?>
		<input type="hidden" name="id_asb" value="<?= $asb['id_asb']; ?>">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Sub Rincian Objek</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="sub_rincian_objek" id="akun_id" class="form-control select2bs4" required>
						<option value="<?= $sub['id_jenis_rincian_objek_sub']; ?>"><?= '[' . $sub['kode_jenis_rincian_objek_sub'] . '] ' . $sub['jenis_rincian_objek_sub'] . ' [' . $sub['kelompok_id'] . ']'; ?></option>
						<?php foreach ($sub_rincian_objek as $row) : ?>
							<option value="<?= $row['id_jenis_rincian_objek_sub']; ?>"><?= '[' . $row['kode_jenis_rincian_objek_sub'] . '] ' . $row['jenis_rincian_objek_sub'] . ' [' . $row['kelompok_id'] . ']'; ?></option>
						<?php endforeach; ?>
					</select>

				</div>
			</div>
		</div>
		<br> <!--  ------------------------------------ -->
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Nama Paket</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" name="nm_paket" value="<?= $asb['asb_paket']; ?>" class="form-control" maxlength="300" required>
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
					<textarea name="spesifikasi" class="form-control" maxlength="300" rows="3" required><?= $asb['asb_spesifikasi']; ?></textarea>
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
					<input type="text" name="satuan" value="<?= $asb['asb_satuan']; ?>" class="form-control" maxlength="20" required>
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
			placeholder: 'Tidak Dipilih...'
		})
	});
</script>
<?= $this->endSection(); ?>