<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<style>
	/* Pastikan select2 sejajar dengan form-control bootstrap */
	.select2-container--bootstrap4 .select2-selection--single {
		height: calc(2.25rem + 2px) !important;
		/* sama seperti form-control default bootstrap */
		line-height: 2.25rem !important;
		padding: 0rem 0.75rem !important;
	}

	.select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered {
		line-height: 2.25rem !important;
		padding-left: 0 !important;
	}
</style>
<style>
	.no-border-table,
	.no-border-table th,
	.no-border-table td {
		border: none !important;
		border-collapse: collapse;
	}

	.no-border-table thead tr,
	.no-border-table thead tr td {
		text-align: center;
		background: #00000024;
	}
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<form action="<?= base_url('/user/hspk/hspk/hspk_update') ?>" method="POST" id="myForm">
	<div class="card-body">
		<?= csrf_field() ?>
		<input type="hidden" name="id_hspk" value="<?= $hspk['id_hspk']; ?>">
		<table class="table table-bordered table-sm no-border-table" cellspacing="0">
			<thead>
				<tr>
					<th style="width: 80%;">Sub Rincian Objek</th>
					<th style="width: 20%;">Satuan</th>
				</tr>
			</thead>
			<tbody class="form-program">
				<tr>
					<td>
						<div class="form-group">
							<select name="sub_rincian_objek" id="sub_rincian_objek_id" class="form-control select2bs4" required></select>
						</div>
					</td>
					<td>
						<div class="form-group">
							<select name="satuan" id="satuan" class="form-control select2bs4" required>
								<option value="">Pilih...</option>
								<?php foreach ($satuan as $row) : ?>
									<option value="<?= $row['satuan']; ?>" <?= $hspk['hspk_satuan'] == $row['satuan'] ? 'selected' : '' ?>><?= $row['satuan'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<table class="table table-bordered table-sm no-border-table" cellspacing="0">
			<thead>
				<tr>
					<th style="width: 50%;">Nama Paket</th>
					<th style="width: 50%;">Spesifikasi</th>
				</tr>
			</thead>
			<tbody class="form-program">
				<tr>
					<td>
						<div class="form-group">
							<input type="text" name="nm_paket" value="<?= $hspk['hspk_paket'] ?>" class="form-control" maxlength="300" require>
						</div>
					</td>
					<td>
						<div class="form-group">
							<input type="text" name="hspk_spesifikasi" value="<?= $hspk['hspk_spesifikasi'] ?>" class="form-control" maxlength="300" rows="3" require>
						</div>
					</td>
				</tr>
			</tbody>
		</table>

		<br>

		<div class="row text-center" style="background: antiquewhite; margin-bottom:5px;">
			<div class="col" style="height: 35px;align-content: center;">
				<b>A. Tenaga Kerja</b>
			</div>
		</div>
		<div class="row">
			<div class="col-9">
				<div class="form-group">
					<label>Paket SSH/SBU</label>
					<select id="itemSelect" class="form-control select2bs4">
						<option value="">Pilih...</option>
						<?php foreach ($ssh as $row) : ?>
							<option value="<?= $row['id_ssh'] . '|' . $row['harga'] . '|' . $row['komponen'] . '|' . $row['spesifikasi']; ?>"><?= $row['komponen'] . '] - [' . $row['spesifikasi'] . '] - [' . $row['satuan'] . '] - [' . $row['harga'] . '] - [' . $row['kelompok'] . ']'; ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="col-2 text-center">
				<div class="form-group">
					<label>Koefisien</label>
					<input type="number" step="any" id="itemSelect2" class="form-control">
				</div>
			</div>
			<div class="col-1 text-center">
				<div class="form-group">
					<label>Aksi</label>
					<div class="form-input">
						<button
							type="button"
							class="btn btn-circle btn-xs"
							style="font-size: 1.5rem; color: #027bff;"
							id="addItemButton"
							title="Tambahkan">
							<i class="nav-icon fas fa-plus-circle"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<table class="table table-bordered display nowrap table-sm" cellspacing="0" id="itemsTable">
					<thead>
						<tr style="background: aliceblue;">
							<td class="text-center" style="width: 50px;">Nomer</td>
							<td>Komponen</td>
							<td>Spesifikasi</td>
							<td style="width: 80px;">Koefisien</td>
							<td class="text-center" style="width: 140px;">Harga Satuan (Rp)</td>
							<td class="text-center" style="width: 140px;">Jumlah Harga (Rp)</td>
							<td class="text-center" style="width: 50px;">Aksi</td>
						</tr>
					</thead>
					<tbody>
						<?php $nomer = 1; ?>
						<?php foreach ($A as $row) : ?>
							<tr id="DeleteDb_<?= $row['id_hspk_komponen']; ?>">
								<td class="text-center"><?= $nomer++; ?></td>
								<td><?= $row['komponen']; ?></td>
								<td><?= $row['spesifikasi']; ?></td>
								<td class="index text-center"><?= $row['index']; ?></td>
								<td class="harga text-right"><?= $row['harga']; ?></td>
								<td class="jumlah text-right"></td>
								<td><button type="button" class="btn btn-danger btn-xs deleteItemButton" onclick="DeleteDb(<?= $row['id_hspk_komponen']; ?>)">Hapus</button></td>
								<input type="hidden" name="id_hspk_komponen[]" value="<? $row['id_hspk_komponen']; ?>">
								<input type="hidden" name="ssh[]" value="<?= $row['ssh_id']; ?>">
								<input type="hidden" name="index[]" value="<?= $row['index']; ?>">
								<input type="hidden" name="group[]" value="A">
							</tr>
						<?php endforeach ?>
					</tbody>
					<tfoot>
						<tr class="font-weight-bold" style="background: #e9e9e9;">
							<td colspan="5" class="text-right">Total</td>
							<td colspan="2" class="text-right" id="totalAmount">Rp 0,00</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<br>
		<div class="row text-center" style="background: antiquewhite; margin-bottom:5px;">
			<div class="col" style="height: 35px;align-content: center;">
				<b>B. Bahan</b>
			</div>
		</div>
		<div class="row">
			<div class="col-9">
				<div class="form-group">
					<label>Paket SSH/SBU</label>
					<select id="itemSelectBahan" class="form-control select2bs4">
						<option value="">Pilih...</option>
						<?php foreach ($ssh as $row) : ?>
							<option value="<?= $row['id_ssh'] . '|' . $row['harga'] . '|' . $row['komponen'] . '|' . $row['spesifikasi']; ?>"><?= $row['komponen'] . '] - [' . $row['spesifikasi'] . '] - [' . $row['satuan'] . '] - [' . $row['harga'] . '] - [' . $row['kelompok'] . ']'; ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="col-2 text-center">
				<div class="form-group">
					<label>Koefisien</label>
					<input type="number" step="any" id="itemSelectBahan2" class="form-control">
				</div>
			</div>
			<div class="col-1 text-center">
				<div class="form-group">
					<label>Aksi</label>
					<div class="form-input">
						<button
							type="button"
							class="btn btn-circle btn-xs"
							style="font-size: 1.5rem; color: #027bff;"
							id="addItemButtonBahan"
							title="Tambahkan">
							<i class="nav-icon fas fa-plus-circle"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<table class="table table-bordered display nowrap table-sm" cellspacing="0" id="itemsTableBahan">
					<thead>
						<tr style="background: aliceblue;">
							<td class="text-center" style="width: 50px;">Nomer</td>
							<td>Komponen</td>
							<td>Spesifikasi</td>
							<td style="width: 80px;">Koefisien</td>
							<td class="text-center" style="width: 140px;">Harga Satuan (Rp)</td>
							<td class="text-center" style="width: 140px;">Jumlah Harga (Rp)</td>
							<td class="text-center" style="width: 50px;">Aksi</td>
						</tr>
					</thead>
					<tbody>
						<?php $nomerBahan = 1; ?>
						<?php foreach ($B as $row) : ?>
							<tr id="DeleteDb_<?= $row['id_hspk_komponen']; ?>">
								<td class="text-center"><?= $nomerBahan++; ?></td>
								<td><?= $row['komponen']; ?></td>
								<td><?= $row['spesifikasi']; ?></td>
								<td class="index text-center"><?= $row['index']; ?></td>
								<td class="harga text-right"><?= $row['harga']; ?></td>
								<td class="jumlah text-right"></td>
								<td><button type="button" class="btn btn-danger btn-xs deleteItemButton" onclick="DeleteDb(<?= $row['id_hspk_komponen']; ?>)">Hapus</button></td>
								<input type="hidden" name="id_hspk_komponen[]" value="<? $row['id_hspk_komponen']; ?>">
								<input type="hidden" name="ssh[]" value="<?= $row['ssh_id']; ?>">
								<input type="hidden" name="index[]" value="<?= $row['index']; ?>">
								<input type="hidden" name="group[]" value="B">
							</tr>
						<?php endforeach ?>
					</tbody>
					<tfoot>
						<tr class="font-weight-bold" style="background: #e9e9e9;">
							<td colspan="5" class="text-right">Total</td>
							<td colspan="2" class="text-right" id="totalAmountBahan">Rp 0,00</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<br>

		<div class="row text-center" style="background: antiquewhite; margin-bottom:5px;">
			<div class="col" style="height: 35px;align-content: center;">
				<b>C. Peralatan</b>
			</div>
		</div>
		<div class="row">
			<div class="col-9">
				<div class="form-group">
					<label>Paket SSH/SBU</label>
					<select id="itemSelectPeralatan" class="form-control select2bs4">
						<option value="">Pilih...</option>
						<?php foreach ($ssh as $row) : ?>
							<option value="<?= $row['id_ssh'] . '|' . $row['harga'] . '|' . $row['komponen'] . '|' . $row['spesifikasi']; ?>"><?= $row['komponen'] . '] - [' . $row['spesifikasi'] . '] - [' . $row['satuan'] . '] - [' . $row['harga'] . '] - [' . $row['kelompok'] . ']'; ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="col-2 text-center">
				<div class="form-group">
					<label>Koefisien</label>
					<input type="number" step="any" id="itemSelectPeralatan2" class="form-control">
				</div>
			</div>
			<div class="col-1 text-center">
				<div class="form-group">
					<label>Aksi</label>
					<div class="form-input">
						<button
							type="button"
							class="btn btn-circle btn-xs"
							style="font-size: 1.5rem; color: #027bff;"
							id="addItemButtonPeralatan"
							title="Tambahkan">
							<i class="nav-icon fas fa-plus-circle"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<table class="table table-bordered display nowrap table-sm" cellspacing="0" id="itemsTablePeralatan">
					<thead>
						<tr style="background: aliceblue;">
							<td class="text-center" style="width: 50px;">Nomer</td>
							<td>Komponen</td>
							<td>Spesifikasi</td>
							<td style="width: 80px;">Koefisien</td>
							<td class="text-center" style="width: 140px;">Harga Satuan (Rp)</td>
							<td class="text-center" style="width: 140px;">Jumlah Harga (Rp)</td>
							<td class="text-center" style="width: 50px;">Aksi</td>
						</tr>
					</thead>
					<tbody>
						<?php $nomerPeralatan = 1; ?>
						<?php foreach ($C as $row) : ?>
							<tr id="DeleteDb_<?= $row['id_hspk_komponen']; ?>">
								<td class="text-center"><?= $nomerPeralatan++; ?></td>
								<td><?= $row['komponen']; ?></td>
								<td><?= $row['spesifikasi']; ?></td>
								<td class="index text-center"><?= $row['index']; ?></td>
								<td class="harga text-right"><?= $row['harga']; ?></td>
								<td class="jumlah text-right"></td>
								<td><button type="button" class="btn btn-danger btn-xs deleteItemButton" onclick="DeleteDb(<?= $row['id_hspk_komponen']; ?>)">Hapus</button></td>
								<input type="hidden" name="id_hspk_komponen[]" value="<? $row['id_hspk_komponen']; ?>">
								<input type="hidden" name="ssh[]" value="<?= $row['ssh_id']; ?>">
								<input type="hidden" name="index[]" value="<?= $row['index']; ?>">
								<input type="hidden" name="group[]" value="C">
							</tr>
						<?php endforeach ?>
					</tbody>
					<tfoot>
						<tr class="font-weight-bold" style="background: #e9e9e9;">
							<td colspan="5" class="text-right">Total</td>
							<td colspan="2" class="text-right" id="totalAmountPeralatan">Rp 0,00</td>
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

		hitungSemuaJumlah(); //hitung saat pertama kali load
		// --------------

		function updateRowNumbers() {
			$('#itemsTable tbody tr').each(function(index) {
				$(this).find('td:first').text(index + 1);
			});
		}

		function updateTotalAmount() {
			let total = 0;
			$('#itemsTable tbody tr').each(function() {
				// Ambil teks jumlah dari kolom ke-6
				let jumlahText = $(this).find('td:nth-child(6)').text().trim();

				// Hilangkan semua selain angka, koma, dan titik
				jumlahText = jumlahText.replace(/[^0-9.,-]/g, "");

				// Kalau format pakai koma untuk desimal, ganti jadi titik
				if (jumlahText.indexOf(',') > -1 && jumlahText.indexOf('.') > -1) {
					// Jika ada titik dan koma → hapus titik (separator ribuan) lalu ganti koma ke titik
					jumlahText = jumlahText.replace(/\./g, "").replace(',', '.');
				} else if (jumlahText.indexOf(',') > -1) {
					// Jika hanya ada koma → ganti koma ke titik
					jumlahText = jumlahText.replace(',', '.');
				}

				let jumlah = parseFloat(jumlahText) || 0;
				total += jumlah;
			});

			$('#totalAmount').text(formatCurrency(total));
		}

		$(document).on('click', '.deleteItemButton', function() {
			$(this).closest('tr').remove();
			updateTotalAmount(); // panggil ulang setelah delete
		});

		$('#addItemButton').click(function() {
			let itemSelect = $('#itemSelect');
			let itemQty = $('#itemSelect2');

			let isValid = true;

			// Reset error state
			itemSelect.removeClass('is-invalid');
			itemQty.removeClass('is-invalid');

			// Cek jika dropdown kosong
			if (!itemSelect.val()) {
				itemSelect.addClass('is-invalid');
				isValid = false;
			}

			// Cek jika qty kosong atau <= 0
			if (!itemQty.val() || parseFloat(itemQty.val()) <= 0) {
				itemQty.addClass('is-invalid');
				isValid = false;
			}

			if (!isValid) {
				return; // hentikan proses
			}

			let itemData = itemSelect.val().split('|');
			let qty = parseFloat(itemQty.val());
			let harga = parseFloat(itemData[1].trim());
			let jumlah = qty * harga;

			let newRow = `
				<tr>
					<td class="text-center"></td>
					<td>${itemData[2].trim()}</td>
					<td>${itemData[3].trim()}</td>
					<td class="text-center">${qty}</td>
					<td class="text-right">${formatCurrency(harga)}</td>
					<td class="text-right">${formatCurrency(jumlah)}</td>
					<td><button type="button" class="btn btn-danger btn-xs deleteItemButton">Hapus</button></td>
				</tr>
				<input type="hidden" name="id_hspk_komponen[]" value="">
				<input type="hidden" name="ssh[]" value="${itemData[0].trim()}">
				<input type="hidden" name="index[]" value="${qty}">
				<input type="hidden" name="group[]" value="A">
			`;

			$('#itemsTable tbody').append(newRow);
			updateRowNumbers();
			updateTotalAmount();

			// Reset form
			itemSelect.val('').trigger('change');
			itemQty.val('');
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
				// Ambil teks jumlah dari kolom ke-6
				let jumlahText = $(this).find('td:nth-child(6)').text().trim();

				// Hilangkan semua selain angka, koma, dan titik
				jumlahText = jumlahText.replace(/[^0-9.,-]/g, "");

				// Kalau format pakai koma untuk desimal, ganti jadi titik
				if (jumlahText.indexOf(',') > -1 && jumlahText.indexOf('.') > -1) {
					// Jika ada titik dan koma → hapus titik (separator ribuan) lalu ganti koma ke titik
					jumlahText = jumlahText.replace(/\./g, "").replace(',', '.');
				} else if (jumlahText.indexOf(',') > -1) {
					// Jika hanya ada koma → ganti koma ke titik
					jumlahText = jumlahText.replace(',', '.');
				}

				let jumlah = parseFloat(jumlahText) || 0;
				total += jumlah;
			});

			$('#totalAmountBahan').text(formatCurrency(total));
		}

		$(document).on('click', '.deleteItemButtonBahan', function() {
			$(this).closest('tr').remove();
			updateTotalAmountBahan(); // panggil ulang setelah delete
		});

		$('#addItemButtonBahan').click(function() {
			let itemSelect = $('#itemSelectBahan');
			let itemQty = $('#itemSelectBahan2');

			let isValid = true;

			// Reset error state
			itemSelect.removeClass('is-invalid');
			itemQty.removeClass('is-invalid');

			// Cek jika dropdown kosong
			if (!itemSelect.val()) {
				itemSelect.addClass('is-invalid');
				isValid = false;
			}

			// Cek jika qty kosong atau <= 0
			if (!itemQty.val() || parseFloat(itemQty.val()) <= 0) {
				itemQty.addClass('is-invalid');
				isValid = false;
			}

			if (!isValid) {
				return; // hentikan proses
			}

			let itemData = itemSelect.val().split('|');
			let qty = parseFloat(itemQty.val());
			let harga = parseFloat(itemData[1].trim());
			let jumlah = qty * harga;

			let newRow = `
				<tr>
					<td class="text-center"></td>
					<td>${itemData[2].trim()}</td>
					<td>${itemData[3].trim()}</td>
					<td class="text-center">${qty}</td>
					<td class="text-right">${formatCurrency(harga)}</td>
					<td class="text-right">${formatCurrency(jumlah)}</td>
					<td><button type="button" class="btn btn-danger btn-xs deleteItemButtonBahan">Hapus</button></td>
				</tr>
				<input type="hidden" name="id_hspk_komponen[]" value="">
				<input type="hidden" name="ssh[]" value="${itemData[0].trim()}">
				<input type="hidden" name="index[]" value="${qty}">
				<input type="hidden" name="group[]" value="B">
			`;

			$('#itemsTableBahan tbody').append(newRow);
			updateRowNumbersBahan();
			updateTotalAmountBahan();

			// Reset form
			itemSelect.val('').trigger('change');
			itemQty.val('');
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
				// Ambil teks jumlah dari kolom ke-6
				let jumlahText = $(this).find('td:nth-child(6)').text().trim();

				// Hilangkan semua selain angka, koma, dan titik
				jumlahText = jumlahText.replace(/[^0-9.,-]/g, "");

				// Kalau format pakai koma untuk desimal, ganti jadi titik
				if (jumlahText.indexOf(',') > -1 && jumlahText.indexOf('.') > -1) {
					// Jika ada titik dan koma → hapus titik (separator ribuan) lalu ganti koma ke titik
					jumlahText = jumlahText.replace(/\./g, "").replace(',', '.');
				} else if (jumlahText.indexOf(',') > -1) {
					// Jika hanya ada koma → ganti koma ke titik
					jumlahText = jumlahText.replace(',', '.');
				}

				let jumlah = parseFloat(jumlahText) || 0;
				total += jumlah;
			});

			$('#totalAmountPeralatan').text(formatCurrency(total));
		}

		$(document).on('click', '.deleteItemButtonPeralatan', function() {
			$(this).closest('tr').remove();
			updateTotalAmountPeralatan(); // panggil ulang setelah delete
		});

		$('#addItemButtonPeralatan').click(function() {
			let itemSelect = $('#itemSelectPeralatan');
			let itemQty = $('#itemSelectPeralatan2');

			let isValid = true;

			// Reset error state
			itemSelect.removeClass('is-invalid');
			itemQty.removeClass('is-invalid');

			// Cek jika dropdown kosong
			if (!itemSelect.val()) {
				itemSelect.addClass('is-invalid');
				isValid = false;
			}

			// Cek jika qty kosong atau <= 0
			if (!itemQty.val() || parseFloat(itemQty.val()) <= 0) {
				itemQty.addClass('is-invalid');
				isValid = false;
			}

			if (!isValid) {
				return; // hentikan proses
			}

			let itemData = itemSelect.val().split('|');
			let qty = parseFloat(itemQty.val());
			let harga = parseFloat(itemData[1].trim());
			let jumlah = qty * harga;

			let newRow = `
				<tr>
					<td class="text-center"></td>
					<td>${itemData[2].trim()}</td>
					<td>${itemData[3].trim()}</td>
					<td class="text-center">${qty}</td>
					<td class="text-right">${formatCurrency(harga)}</td>
					<td class="text-right">${formatCurrency(jumlah)}</td>
					<td><button type="button" class="btn btn-danger btn-xs deleteItemButtonPeralatan">Hapus</button></td>
				</tr>
				<input type="hidden" name="id_hspk_komponen[]" value="">
				<input type="hidden" name="ssh[]" value="${itemData[0].trim()}">
				<input type="hidden" name="index[]" value="${qty}">
				<input type="hidden" name="group[]" value="C">
			`;

			$('#itemsTablePeralatan tbody').append(newRow);
			updateRowNumbersPeralatan();
			updateTotalAmountPeralatan();

			// Reset form
			itemSelect.val('').trigger('change');
			itemQty.val('');
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

		// -----------------------------
		// automatik hitung saat load halaman pertama
		function hitungSemuaJumlah() {
			// Hitung kolom jumlah untuk semua tabel
			$('#itemsTable tbody tr, #itemsTableBahan tbody tr, #itemsTablePeralatan tbody tr').each(function() {
				let qty = parseFloat($(this).find('.index').text()) || 0;
				let harga = parseFloat($(this).find('.harga').text().replace(/[^0-9.-]+/g, "")) || 0;
				let jumlah = qty * harga;

				$(this).find('.jumlah').text(formatCurrency(jumlah));
			});

			// Update total masing-masing tabel
			updateTotalAmount();
			updateTotalAmountBahan();
			updateTotalAmountPeralatan();
		}
		// Masking harga di semua tabel pada saat pertama load
		$('.harga').each(function() {
			let hargaValue = parseFloat($(this).text().replace(/[^0-9.-]+/g, "")) || 0;
			$(this).text(formatCurrency(hargaValue));
		});

	});
</script>
<script>
	$(document).ready(function() {
		$('#sub_rincian_objek_id').select2({
			theme: 'bootstrap4',
			placeholder: 'Pilih...',
			ajax: {
				url: "<?= base_url('user/hspk/hspk/AmbilSubRincianObjekFilter'); ?>",
				type: "POST",
				dataType: 'json',
				delay: 250, // jeda 250ms untuk mengurangi request berulang
				data: function(params) {
					return {
						search: params.term || '' // kirim keyword pencarian
					};
				},
				processResults: function(data) {
					return {
						results: $.map(data, function(item) {
							return {
								id: item.id_jenis_rincian_objek_sub,
								text: '[' + item.kode_jenis_rincian_objek_sub + '] ' +
									item.jenis_rincian_objek_sub + ' [' + item.kelompok_id + ']'
							};
						})
					};
				},
				cache: true
			},
			language: {
				searching: function() {
					return "Memuat data...";
				},
				noResults: function() {
					return "Tidak ada data ditemukan";
				}
			},
			minimumInputLength: 0 // langsung bisa tampilkan data saat dibuka
		});

		// ==== Trigger nilai default saat edit ====
		<?php if (!empty($hspk)) : ?>
			let option = new Option(
				"<?= '[' . $hspk['id_jenis_rincian_objek_sub'] . '] ' . $hspk['jenis_rincian_objek_sub']; ?>",
				"<?= $hspk['id_jenis_rincian_objek_sub']; ?>",
				true,
				true
			);
			$('#sub_rincian_objek_id').append(option).trigger('change');
		<?php endif; ?>
	});
</script>
<script>
	function DeleteDb(id) {
		if (!confirm('Yakin ingin menghapus data ini?')) return;

		$.ajax({
			url: "<?= base_url('/user/hspk/hspk/hapus_hspk_komponen') ?>", // URL endpoint controller
			type: "POST",
			data: {
				id: id
			},
			dataType: "json",
			success: function(response) {
				if (response.status === 'success') {
					// Hapus row dari tabel
					$('#DeleteDb_' + id).remove();

					// Update ulang total setelah hapus
					updateTotalAmount();
					updateTotalAmountBahan();
					updateTotalAmountPeralatan();

					alert('Data berhasil dihapus');
				} else {
					alert('Gagal menghapus data: ' + response.message);
				}
			},
			error: function(xhr, status, error) {
				alert('Terjadi kesalahan: ' + error);
			}
		});
	}
</script>

<?= $this->endSection(); ?>