<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<form action="<?= base_url('/user/ssh/ssh_acuan/rekening_acuan_create') ?>" method="POST">
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
		<?= csrf_field() ?>
		<input type="hidden" name="id_ssh" value="<?= $id_ssh; ?>" ?>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Akun</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="akun" id="akun_id" class="form-control select2bs4 <?= ($validation->hasError('akun')) ? 'is-invalid' : ''; ?>" required>
						<option value="">Tidak Dipilih...</option>
						<?php foreach ($akun as $row) : ?>
							<option value="<?= $row['id_rekening_akun']; ?>"><?= '[' . $row['kode_rekening_akun'] . '] ' . $row['rekening_akun']; ?></option>
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
					<select name="kelompok" id="kelompok_id" class="form-control select2bs4 <?= ($validation->hasError('kelompok')) ? 'is-invalid' : ''; ?>" required> </select>
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
					<select name="jenis" id="jenis_id" class="form-control select2bs4 <?= ($validation->hasError('jenis')) ? 'is-invalid' : ''; ?>" required> </select>
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
					<select name="objek" id="objek_id" class="form-control select2bs4 <?= ($validation->hasError('objek')) ? 'is-invalid' : ''; ?>" required> </select>
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
					<select name="rincian_objek" id="rincian_objek_id" class="form-control select2bs4 <?= ($validation->hasError('rincian_objek')) ? 'is-invalid' : ''; ?>" required> </select>
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
					<select name="sub_rincian_objek" id="sub_rincian_objek_id" class="form-control select2bs4 <?= ($validation->hasError('sub_rincian_objek')) ? 'is-invalid' : ''; ?>" required> </select>
					<div class="invalid-feedback">
						<?= $validation->getError('sub_rincian_objek'); ?>
					</div>
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

	$(document).ready(function() {
		$('#akun_id').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('user/ssh/ssh_rekening/ambilkelompok'); ?>",
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
						html += '<option value=' + data[i].id_rekening_kelompok + '>' + '[' + data[i].kode_rekening_kelompok + '] ' + data[i].rekening_kelompok + '</option>';
					}
					$('#kelompok_id').html(html);

				}
			});
			return false;
		});
		$('#kelompok_id').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('user/ssh/ssh_rekening/ambiljenis'); ?>",
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
						html += '<option value=' + data[i].id_rekening_jenis + '>' + '[' + data[i].kode_rekening_jenis + '] ' + data[i].rekening_jenis + '</option>';
					}
					$('#jenis_id').html(html);

				}
			});
			return false;
		});
		$('#jenis_id').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('user/ssh/ssh_rekening/ambilobjek'); ?>",
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
						html += '<option value=' + data[i].id_rekening_objek + '>' + '[' + data[i].kode_rekening_objek + '] ' + data[i].rekening_objek + '</option>';
					}
					$('#objek_id').html(html);

				}
			});
			return false;
		});
		$('#objek_id').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('user/ssh/ssh_rekening/ambilrincianobjek'); ?>",
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
						html += '<option value=' + data[i].id_rekening_rincian_objek + '>' + '[' + data[i].kode_rekening_rincian_objek + '] ' + data[i].rekening_rincian_objek + '</option>';
					}
					$('#rincian_objek_id').html(html);

				}
			});
			return false;
		});
		$('#rincian_objek_id').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('user/ssh/ssh_rekening/ambilsubrincianobjek'); ?>",
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
						html += '<option value=' + data[i].id_rekening_rincian_objek_sub + '>' + '[' + data[i].kode_rekening_rincian_objek_sub + '] ' + data[i].rekening_rincian_objek_sub + '</option>';
					}
					$('#sub_rincian_objek_id').html(html);

				}
			});
			return false;
		});


	});
</script>
<?= $this->endSection(); ?>