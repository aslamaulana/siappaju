<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<form action="<?= base_url('/user/hspk/hspk/hspk_create') ?>" method="POST" id="myForm">
	<div class="card-body">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col-md-6" style="padding: 0px 15px 0px 0px;">
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
					<div class="col">
						<div class="form-group">
							<label></label>
							<div class="input-group">
								<select name="type" id="type" hidden> </select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6" style="padding: 0px 0px 0px 15px;">
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Nama Paket</label>
							<div class="input-group">
								<input type="text" name="nm_paket" class="form-control" maxlength="300" require>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Spesifikasi</label>
							<div class="input-group">
								<textarea name="hspk_spesifikasi" class="form-control" maxlength="300" rows="3" require></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Satuan</label>
							<div class="input-group">
								<input type="text" name="satuan" class="form-control" maxlength="20" require>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<br>
		<div class="row">
			<div class="col">
				<div class="row text-center" style="background: antiquewhite;">
					<div class="col">
						<label for="itemSelect" class="form-label">A. Tenaga Kerja</label>
					</div>
				</div>
				<div class="row">
					<div class="col-10">
						<label>Paket SSH/SBU</label>
					</div>
					<div class="col-1">
						<label>Koefisien</label>
					</div>
					<div class="col-1">
						<label>Aksi</label>
					</div>
				</div>
				<div class="row">
					<div class="col-10">
						<select id="itemSelect" class="form-control select2bs4">
							<?php foreach ($ssh as $row) : ?>
								<option value="<?= $row['id_ssh'] . '|' . $row['harga'] . '|' . $row['komponen'] . '|' . $row['spesifikasi']; ?>"><?= $row['komponen'] . '] - [' . $row['spesifikasi'] . '] - [' . $row['satuan'] . '] - [' . $row['harga'] . '] - [' . $row['kelompok'] . ']'; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-1">
						<input type="text" id="itemSelect2" class="form-control">
					</div>
					<div class="col-1">
						<button type="button" id="addItemButton" class="btn btn-primary" style="width: 100%;">Tambah</button>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<table class="table table-bordered display nowrap table-sm" cellspacing="0" id="itemsTable">
					<thead>
						<tr style="background: aliceblue;">
							<th class="text-center" style="width: 50px;">Nomer</th>
							<th>Komponen</th>
							<th>Spesifikasi</th>
							<th>Koefisien</th>
							<th>Harga Satuan (Rp)</th>
							<th>Jumlah Harga (Rp)</th>
							<th class="text-center" style="width: 50px;">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<!-- Rows will be added here dynamically -->
					</tbody>
					<tfoot>
						<tr class="font-weight-bold">
							<td colspan="5">Total</td>
							<td id="totalAmount">0</td>
							<td></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<div class="row text-center" style="background: antiquewhite;">
					<div class="col">
						<label for="itemSelectBahan" class="form-label">B. Bahan</label>
					</div>
				</div>
				<div class="row">
					<div class="col-10">
						<label>Paket SSH/SBU</label>
					</div>
					<div class="col-1">
						<label>Koefisien</label>
					</div>
					<div class="col-1">
						<label>Aksi</label>
					</div>
				</div>
				<div class="row">
					<div class="col-10">
						<select id="itemSelectBahan" class="form-control select2bs4">
							<?php foreach ($ssh as $row) : ?>
								<option value="<?= $row['id_ssh'] . '|' . $row['harga'] . '|' . $row['komponen'] . '|' . $row['spesifikasi']; ?>"><?= $row['komponen'] . '] - [' . $row['spesifikasi'] . '] - [' . $row['satuan'] . '] - [' . $row['harga'] . '] - [' . $row['kelompok'] . ']'; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-1">
						<input type="text" id="itemSelectBahan2" class="form-control">
					</div>
					<div class="col-1">
						<button type="button" id="addItemButtonBahan" class="btn btn-primary" style="width: 100%;">Tambah</button>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<table class="table table-bordered display nowrap table-sm" cellspacing="0" id="itemsTableBahan">
					<thead>
						<tr style="background: aliceblue;">
							<th class="text-center" style="width: 50px;">Nomer</th>
							<th>Komponen</th>
							<th>Spesifikasi</th>
							<th>Koefisien</th>
							<th>Harga Satuan (Rp)</th>
							<th>Jumlah Harga (Rp)</th>
							<th class="text-center" style="width: 50px;">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<!-- Rows will be added here dynamically -->
					</tbody>
					<tfoot>
						<tr class="font-weight-bold">
							<td colspan="5">Total</td>
							<td id="totalAmountBahan">0</td>
							<td></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<div class="row text-center" style="background: antiquewhite;">
					<div class="col">
						<label for="itemSelectPeralatan" class="form-label">B. Peralatan</label>
					</div>
				</div>
				<div class="row">
					<div class="col-10">
						<label>Paket SSH/SBU</label>
					</div>
					<div class="col-1">
						<label>Koefisien</label>
					</div>
					<div class="col-1">
						<label>Aksi</label>
					</div>
				</div>
				<div class="row">
					<div class="col-10">
						<select id="itemSelectPeralatan" class="form-control select2bs4">
							<?php foreach ($ssh as $row) : ?>
								<option value="<?= $row['id_ssh'] . '|' . $row['harga'] . '|' . $row['komponen'] . '|' . $row['spesifikasi']; ?>"><?= $row['komponen'] . '] - [' . $row['spesifikasi'] . '] - [' . $row['satuan'] . '] - [' . $row['harga'] . '] - [' . $row['kelompok'] . ']'; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-1">
						<input type="text" id="itemSelectPeralatan2" class="form-control">
					</div>
					<div class="col-1">
						<button type="button" id="addItemButtonPeralatan" class="btn btn-primary" style="width: 100%;">Tambah</button>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<table class="table table-bordered display nowrap table-sm" cellspacing="0" id="itemsTablePeralatan">
					<thead>
						<tr style="background: aliceblue;">
							<th class="text-center" style="width: 50px;">Nomer</th>
							<th>Komponen</th>
							<th>Spesifikasi</th>
							<th>Koefisien</th>
							<th>Harga Satuan (Rp)</th>
							<th>Jumlah Harga (Rp)</th>
							<th class="text-center" style="width: 50px;">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<!-- Rows will be added here dynamically -->
					</tbody>
					<tfoot>
						<tr class="font-weight-bold">
							<td colspan="5">Total</td>
							<td id="totalAmountPeralatan">0</td>
							<td></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<button type="submit" class="btn btn-success">Simpan</button>
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

	function formatCurrency(amount) {
		return new Intl.NumberFormat('id-ID', {
			style: 'currency',
			currency: 'IDR'
		}).format(amount);
	}


	$(document).ready(function() {

		function updateRowNumbers() {
			$('#itemsTable tbody tr').each(function(index) {
				$(this).find('td:first').text(index + 1);
			});
		}

		function updateTotalAmount() {
			let total = 0;
			$('#itemsTable tbody tr').each(function() {
				total += parseFloat($(this).find('td:nth-child(6)').text());
			});
			$('#totalAmount').text(formatCurrency(total));
		}

		$(document).on('click', '.deleteItemButton', function() {
			$(this).closest('tr').remove();
		});

		$('#addItemButton').click(function() {
			var itemName = $('#itemSelect').val().split('|');
			var itemName2 = $('#itemSelect2').val();
			var jumlah = itemName2 * itemName[1].trim();
			var newRow = '<tr><td class="text-center"></td><td>' + itemName[2].trim() + '</td> <td>' + itemName[3].trim() + '</td><td>' + itemName2 + '</td><td>' + formatCurrency(itemName[1].trim()) + '</td><td>' + jumlah + '</td><td><button type="button" class="btn btn-danger deleteItemButton">Hapus</button></td></tr><input type="hidden" name="ssh[]" value="' + itemName[0].trim() + '"><input type="hidden" name="index[]" value="' + itemName2 + '"><input type="hidden" name="group[]" value="A">';
			$('#itemsTable tbody').append(newRow);
			updateRowNumbers();
			updateTotalAmount();
		});

		// -------------------------------------------------

		function updateRowNumbersBahan() {
			$('#itemsTableBahan tbody tr').each(function(index) {
				$(this).find('td:first').text(index + 1);
			});
		}

		function updateTotalAmountBahan() {
			let total = 0;
			$('#itemsTableBahan tbody tr').each(function() {
				total += parseFloat($(this).find('td:nth-child(6)').text());
			});
			$('#totalAmountBahan').text(formatCurrency(total));
		}

		$(document).on('click', '.deleteItemButtonBahan', function() {
			$(this).closest('tr').remove();
		});

		$('#addItemButtonBahan').click(function() {
			var itemName = $('#itemSelectBahan').val().split('|');
			var itemName2 = $('#itemSelectBahan2').val();
			var jumlah = itemName2 * itemName[1].trim();
			var newRow = '<tr><td class="text-center"></td><td>' + itemName[2].trim() + '</td> <td>' + itemName[3].trim() + '</td><td>' + itemName2 + '</td><td>' + formatCurrency(itemName[1].trim()) + '</td><td>' + jumlah + '</td><td><button type="button" class="btn btn-danger deleteItemButton">Hapus</button></td></tr><input type="hidden" name="ssh[]" value="' + itemName[0].trim() + '"><input type="hidden" name="index[]" value="' + itemName2 + '"><input type="hidden" name="group[]" value="B">';
			$('#itemsTableBahan tbody').append(newRow);
			updateRowNumbersBahan();
			updateTotalAmountBahan();
		});

		// -------------------------------------------------

		function updateRowNumbersPeralatan() {
			$('#itemsTablePeralatan tbody tr').each(function(index) {
				$(this).find('td:first').text(index + 1);
			});
		}

		function updateTotalAmountPeralatan() {
			let total = 0;
			$('#itemsTablePeralatan tbody tr').each(function() {
				total += parseFloat($(this).find('td:nth-child(6)').text());
			});
			$('#totalAmountPeralatan').text(formatCurrency(total));
		}

		$(document).on('click', '.deleteItemButtonPeralatan', function() {
			$(this).closest('tr').remove();
		});

		$('#addItemButtonPeralatan').click(function() {
			var itemName = $('#itemSelectPeralatan').val().split('|');
			var itemName2 = $('#itemSelectPeralatan2').val();
			var jumlah = itemName2 * itemName[1].trim();
			var newRow = '<tr><td class="text-center"></td><td>' + itemName[2].trim() + '</td> <td>' + itemName[3].trim() + '</td><td>' + itemName2 + '</td><td>' + formatCurrency(itemName[1].trim()) + '</td><td>' + jumlah + '</td><td><button type="button" class="btn btn-danger deleteItemButton">Hapus</button></td></tr><input type="hidden" name="ssh[]" value="' + itemName[0].trim() + '"><input type="hidden" name="index[]" value="' + itemName2 + '"><input type="hidden" name="group[]" value="C">';
			$('#itemsTablePeralatan tbody').append(newRow);
			updateRowNumbersPeralatan();
			updateTotalAmountPeralatan();
		});

		// ---------------------
		document.getElementById('myForm').addEventListener('submit', function(event) {
			// Menghentikan submit form
			event.preventDefault();

			// Mengambil nilai input name[]
			const sshs = document.getElementsByName('ssh[]');

			// Menghapus pesan error sebelumnya
			document.querySelectorAll('.error').forEach(function(error) {
				error.textContent = '';
			});

			let isValid = true;

			// Validasi untuk memastikan setidaknya satu kolom name telah ditambahkan
			if (sshs.length === 0) {
				alert('Tambahkan ssh/sbu paket.');
				isValid = false;
			} else {
				// Validasi setiap kolom name
				sshs.forEach((ssh, index) => {
					if (!ssh.value.trim()) {
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
				url: "<?php echo base_url('user/hspk/hspk/ambilkelompok'); ?>",
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
				url: "<?php echo base_url('user/hspk/hspk/ambiljenis'); ?>",
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
				url: "<?php echo base_url('user/hspk/hspk/ambilobjek'); ?>",
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
				url: "<?php echo base_url('user/hspk/hspk/ambilrincianobjek'); ?>",
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
				url: "<?php echo base_url('user/hspk/hspk/ambilsubrincianobjek'); ?>",
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


	});
</script>
<?= $this->endSection(); ?>