<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<form action="<?= base_url('/user/hspk/hspk_komponen/data_create') ?>" method="POST">
	<div class="card-body">
		<?= csrf_field() ?>
		<input type="hidden" name="id_hspk" value="<?= $id_hspk; ?>">
		<input type="hidden" name="group" value="<?= $_GET['g']; ?>">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>JENIS</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="jenis" id="jenis" class="form-control" required>
						<option value="" selected disabled>Tidak Dipilih...</option>
						<option value="SSH">SSH</option>
						<option value="SBU">SBU</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Nama Paket</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="ssh" id="ssh" class="form-control select2bs4" required> </select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Koefisien</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="number" step="any" name="index" class="form-control" maxlength="20" required>
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
			placeholder: 'Tidak Dipilih... [Komponen] - [Spesifikasi] - [Satuan] - [Harga] - [Jenis]'
		})
	});

	$(document).ready(function() {
		Number.prototype.format = function(n, x, s, c) {
			var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
				num = this.toFixed(Math.max(0, ~~n));

			return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
		};


		$('#jenis').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('/user/hspk/hspk_komponen/ambil_ssh'); ?>",
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
						var aa = new Intl.NumberFormat("id-ID", {
							style: "currency",
							currency: "IDR"
						}).format(data[i].harga);
						html += '<option value=' + data[i].id_ssh + '>' + '[' + data[i].komponen + '] - [' + data[i].spesifikasi + '] - [' + data[i].satuan + '] - [' + aa + '] - [' + data[i].kelompok + ']' + '</option>';
					}
					$('#ssh').html(html);

				}
			});
			return false;
		});
	});
</script>
<?= $this->endSection(); ?>