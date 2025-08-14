<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<form action="<?= base_url('/user/ssh/ssh_pengajuan/ssh_create') ?>" method="POST" id="myForm">
	<div class="card-body">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col-md-6" style="padding: 0px 15px 0px 0px;"><!--  ---------------- -->
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Akun</label>
							<div class="input-group">
								<select name="akun" id="akun_id" class="form-control select2bs4 <?= ($validation->hasError('akun')) ? 'is-invalid' : ''; ?>" required>
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
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Kelompok</label>
							<div class="input-group">
								<select name="kelompok" id="kelompok_id" class="form-control select2bs4 <?= ($validation->hasError('kelompok')) ? 'is-invalid' : ''; ?>" required> </select>
								<div class="invalid-feedback">
									<?= $validation->getError('kelompok'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Jenis</label>
							<div class="input-group">
								<select name="jenis" id="jenis_id" class="form-control select2bs4 <?= ($validation->hasError('jenis')) ? 'is-invalid' : ''; ?>" required> </select>
								<div class="invalid-feedback">
									<?= $validation->getError('jenis'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Objek</label>
							<div class="input-group">
								<select name="objek" id="objek_id" class="form-control select2bs4 <?= ($validation->hasError('objek')) ? 'is-invalid' : ''; ?>" required> </select>
								<div class="invalid-feedback">
									<?= $validation->getError('objek'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Rincian Objek</label>
							<div class="input-group">
								<select name="rincian_objek" id="rincian_objek_id" class="form-control select2bs4 <?= ($validation->hasError('rincian_objek')) ? 'is-invalid' : ''; ?>" required> </select>
								<div class="invalid-feedback">
									<?= $validation->getError('rincian_objek'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Sub Rincian Objek</label>
							<div class="input-group">
								<select name="sub_rincian_objek" id="sub_rincian_objek_id" class="form-control select2bs4 <?= ($validation->hasError('sub_rincian_objek')) ? 'is-invalid' : ''; ?>" required> </select>
								<div class="invalid-feedback">
									<?= $validation->getError('sub_rincian_objek'); ?>
								</div>
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
							<select name="type" id="type" hidden> </select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6" style="padding: 0px 0px 0px 15px;"><!--  ---------------- -->
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Komponen</label>
							<div class="input-group">
								<input type="text" name="komponen" class="form-control" maxlength="300" required>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Spesifikasi</label>
							<div class="input-group">
								<textarea name="spesifikasi" class="form-control" maxlength="500" style="height: 125px;" required></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Satuan</label>
							<div class="input-group">
								<input type="text" name="satuan" class="form-control" maxlength="50" required>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Harga</label>
							<div class="input-group">
								<input type="number" step="any" name="harga" class="form-control" maxlength="20" required>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>TKDN &</label>
							<div class="input-group">
								<input type="number" name="tkdn" class="form-control" required>
							</div>
						</div>
					</div>
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
						<option value="SSH">SSH</option>
						<option value="SBU">SBU</option>
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
		<div class="row">
			<div class="col">
				<div class="row text-center" style="background: antiquewhite;">
					<div class="col">
						<label for="itemSelectBahan" class="form-label">Rekening</label>
					</div>
				</div>
				<label for="itemSelect" class="form-label">Pilih Rekening</label>
				<div class="row">
					<div class="col-11">
						<select id="itemSelect" class="form-control select2bs4">
							<?php foreach ($rekening as $row) : ?>
								<option value="<?= "<input type='hidden' name='rekening[]' value='" . $row['id_rekening_rincian_objek_sub'] . "'>" . "[" . $row['kode_rekening_rincian_objek_sub'] . "] " . $row['rekening_rincian_objek_sub']; ?>"><?= "[" . $row['kode_rekening_rincian_objek_sub'] . "] " . $row['rekening_rincian_objek_sub']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-1">
						<button type="button" id="addItemButton" class="btn btn-primary" style="width: 100%;">Tambah</button>
					</div>
				</div>
			</div>
		</div><br>
		<div class="row">
			<div class="col">
				<table class="table table-bordered display nowrap table-sm" cellspacing="0" id="itemsTable">
					<thead>
						<tr style="background: aliceblue;">
							<th class="text-center" style="width: 50px;">Nomer</th>
							<th>Nama Rekening</th>
							<th class="text-center" style="width: 50px;">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<!-- Rows will be added here dynamically -->
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<button type="submit" class="btn btn-success" style="width: 200px;">Simpan</button>
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
		function updateRowNumbers() {
			$('#itemsTable tbody tr').each(function(index) {
				$(this).find('td:first').text(index + 1);
			});
		}

		$('#addItemButton').click(function() {
			var itemName = $('#itemSelect').val();
			var newRow = '<tr><td class="text-center"></td><td>' + itemName + '</td><td><button type="button" class="btn btn-danger deleteItemButton">Hapus</button></td></tr>';
			$('#itemsTable tbody').append(newRow);
			updateRowNumbers();
		});

		$(document).on('click', '.deleteItemButton', function() {
			$(this).closest('tr').remove();
		});

		// ---------------------
		document.getElementById('myForm').addEventListener('submit', function(event) {
			// Menghentikan submit form
			event.preventDefault();

			// Mengambil nilai input name[]
			const rekenings = document.getElementsByName('rekening[]');

			// Menghapus pesan error sebelumnya
			document.querySelectorAll('.error').forEach(function(error) {
				error.textContent = '';
			});

			let isValid = true;

			// Validasi untuk memastikan setidaknya satu kolom name telah ditambahkan
			if (rekenings.length === 0) {
				alert('Tambahkan Rekening.');
				isValid = false;
			} else {
				// Validasi setiap kolom name
				rekenings.forEach((rekening, index) => {
					if (!rekening.value.trim()) {
						document.getElementById('nameError' + (index + 1)).textContent = 'Name ' + (index + 1) + ' is required.';
						isValid = false;
					}
				});
			}

			// Jika semua validasi lolos, submit form
			if (isValid) {
				this.submit();
			}
		});

		// ------------------------------

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