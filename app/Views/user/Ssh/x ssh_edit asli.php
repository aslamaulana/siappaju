<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<form action="<?= base_url('/user/ssh/ssh_pengajuan/ssh_update') ?>" method="POST">
	<div class="card-body">
		<?= csrf_field() ?>
		<input type="hidden" name="id_ssh" value="<?= $ssh['id_ssh']; ?>">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Akun</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="akun" id="akun_id" class="form-control select2bs4 <?= ($validation->hasError('akun')) ? 'is-invalid' : ''; ?>">
						<option value="">Tidak Dipilih...</option>
						<?php foreach ($akun as $row) : ?>
							<option value="<?= $row['id_jenis_akun']; ?>"><?= '[' . $row['kode_jenis_akun'] . '] ' . $row['jenis_akun']; ?></option>
						<?php endforeach; ?>
					</select>
					<div class="invalid-feedback">
						<?= $validation->getError('akun'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Kelompok</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="kelompok" id="kelompok_id" class="form-control select2bs4 <?= ($validation->hasError('kelompok')) ? 'is-invalid' : ''; ?>"> </select>
					<div class="invalid-feedback">
						<?= $validation->getError('kelompok'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Jenis</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="jenis" id="jenis_id" class="form-control select2bs4 <?= ($validation->hasError('jenis')) ? 'is-invalid' : ''; ?>"> </select>
					<div class="invalid-feedback">
						<?= $validation->getError('jenis'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Objek</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="objek" id="objek_id" class="form-control select2bs4 <?= ($validation->hasError('objek')) ? 'is-invalid' : ''; ?>"> </select>
					<div class="invalid-feedback">
						<?= $validation->getError('objek'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Rincian Objek</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="rincian_objek" id="rincian_objek_id" class="form-control select2bs4 <?= ($validation->hasError('rincian_objek')) ? 'is-invalid' : ''; ?>"> </select>
					<div class="invalid-feedback">
						<?= $validation->getError('rincian_objek'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Sub Rincian Objek</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="sub_rincian_objek" id="sub_rincian_objek_id" class="form-control select2bs4 <?= ($validation->hasError('sub_rincian_objek')) ? 'is-invalid' : ''; ?>" required>
						<option value="<?= $ssh['id_jenis_rincian_objek_sub']; ?>"><?= '[' . $ssh['kode_jenis_rincian_objek_sub'] . '] ' . $ssh['jenis_rincian_objek_sub'] . ' [' . $ssh['kelompok_id'] . ' ]'; ?></option>
					</select>
					<div class="invalid-feedback">
						<?= $validation->getError('sub_rincian_objek'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label></label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="type" id="type" hidden>
						<option value="<?= $ssh['kelompok_id']; ?>"><?= $ssh['kelompok_id']; ?></option>
					</select>
				</div>
			</div>
		</div>
		<br> <!--  ------------------------------------ -->
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Komponen</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" name="komponen" value="<?= $ssh['komponen']; ?>" class="form-control" maxlength="300" required>
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
					<textarea name="spesifikasi" class="form-control" maxlength="500" rows="3" required><?= $ssh['spesifikasi']; ?></textarea>
				</div>
			</div>
		</div><br>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Satuan</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" name="satuan" value="<?= $ssh['satuan']; ?>" class="form-control" maxlength="50" required>
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
					<input type="number" step="any" name="harga" value="<?= $ssh['harga']; ?>" class="form-control" maxlength="20" required>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>TKDN &</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="number" name="tkdn" value="<?= $ssh['tkdn']; ?>" class="form-control" required>
				</div>
			</div>
		</div>
		<!-- <div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Type</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="type" class="form-control" required>
						<option value="SSH" <?= $ssh['kelompok'] == 'SSH' ? 'selected' : ''; ?>>SSH</option>
						<option value="SBU" <?= $ssh['kelompok'] == 'SBU' ? 'selected' : ''; ?>>SBU</option>
					</select>
				</div>
			</div>
		</div> -->
		<!-- <div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Satuan</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" name="satuan" class="form-control" maxlength="20" require>
				</div>
			</div>
		</div> -->
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

	$(document).ready(function() {
		$('#akun_id').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('user/ssh/ssh_pengajuan/ambilkelompok'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html = '<option value="">Pilih..</option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].id_jenis_kelompok + '>' + '[' + data[i].kode_jenis_kelompok + '] ' + data[i].jenis_kelompok + '</option>';
					}
					$('#kelompok_id').html(html);

				}
			});
			return false;
		});
		$('#kelompok_id').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('user/ssh/ssh_pengajuan/ambiljenis'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html = '<option value="">Pilih..</option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].id_jenis_jenis + '>' + '[' + data[i].kode_jenis_jenis + '] ' + data[i].jenis_jenis + '</option>';
					}
					$('#jenis_id').html(html);

				}
			});
			return false;
		});
		$('#jenis_id').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('user/ssh/ssh_pengajuan/ambilobjek'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html = '<option value="">Pilih..</option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].id_jenis_objek + '>' + '[' + data[i].kode_jenis_objek + '] ' + data[i].jenis_objek + '</option>';
					}
					$('#objek_id').html(html);

				}
			});
			return false;
		});
		$('#objek_id').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('user/ssh/ssh_pengajuan/ambilrincianobjek'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html = '<option value="">Pilih..</option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].id_jenis_rincian_objek + '>' + '[' + data[i].kode_jenis_rincian_objek + '] ' + data[i].jenis_rincian_objek + '</option>';
					}
					$('#rincian_objek_id').html(html);

				}
			});
			return false;
		});
		$('#rincian_objek_id').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('user/ssh/ssh_pengajuan/ambilsubrincianobjek'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html = '<option value="">Pilih..</option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].id_jenis_rincian_objek_sub + '>' + '[' + data[i].kode_jenis_rincian_objek_sub + '] ' + data[i].jenis_rincian_objek_sub + ' [' + data[i].kelompok_id + ']' + '</option>';
					}
					$('#sub_rincian_objek_id').html(html);

				}
			});
			return false;
		});
		$('#sub_rincian_objek_id').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('user/ssh/ssh_pengajuan/Ambiltype'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].kelompok_id + '>' + ' [' + data[i].kelompok_id + ']' + '</option>';
					}
					$('#type').html(html);

				}
			});
			return false;
		});

	});
</script>
<?= $this->endSection(); ?>