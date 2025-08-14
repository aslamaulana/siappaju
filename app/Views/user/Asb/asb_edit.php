<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<form action="<?= base_url('/user/asb/asb/asb_update') ?>" method="POST" id="myForm">
	<div class="card-body">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col-6">
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Sub Rincian Objek</label>
							<div class="input-group">
								<select name="sub_rincian_objek" id="akun_id" class="form-control select2bs4 <?= ($validation->hasError('akun')) ? 'is-invalid' : ''; ?>" required>
									<option value="">Tidak Dipilih...</option>
									<?php foreach ($sub_rincian_objek as $row) : ?>
										<option value="<?= $row['id_jenis_rincian_objek_sub']; ?>" <?= $asb['jenis_rincian_objek_sub_id'] == $row['id_jenis_rincian_objek_sub'] ? 'Selected' : ''; ?>><?= '[' . $row['kode_jenis_rincian_objek_sub'] . '] ' . $row['jenis_rincian_objek_sub'] . ' [' . $row['kelompok_id'] . ']'; ?></option>
									<?php endforeach; ?>
								</select>
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
							<label>Satuan</label>
							<div class="input-group">
								<input type="text" name="satuan" value="<?= $asb['asb_satuan']; ?>" class="form-control" maxlength="20" required>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Nama Paket</label>
							<div class="input-group">
								<input type="text" name="nm_paket" value="<?= $asb['asb_paket']; ?>" class="form-control" maxlength="300" required>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Spesifikasi</label>
							<div class="input-group">
								<textarea name="spesifikasi" class="form-control" maxlength="300" required><?= $asb['asb_spesifikasi']; ?></textarea>
								<input type="hidden" name="id_asb" value="<?= $asb['id_asb']; ?>">
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
						<label for="itemSelect" class="form-label">HSPK</label>
					</div>
				</div>
				<div class="row">
					<div class="col-10">
						<label>ASB Paket</label>
					</div>
					<div class="col-1">
						<label>Jumlah</label>
					</div>
					<div class="col-1">
						<label>Aksi</label>
					</div>
				</div>
				<div class="row">
					<div class="col-10">
						<select id="itemSelect" class="form-control select2bs4">
							<?php foreach ($hspk as $row) : ?>
								<!-- ---------------------- -->
								<?php
								$A = $db->table('tb_hspk_komponen')
									->select('SUM(tb_hspk_komponen.index * tb_ssh.harga) AS total')
									->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')
									->getWhere(['tb_hspk_komponen.hspk_id' => $row['id_hspk']])->getRowArray();
								?>
								<!-- ---------------------- -->
								<option value="<?= $row['id_hspk'] . '|' . $A['total'] . '|' . $row['hspk_paket'] . '|' . $row['hspk_spesifikasi'] . '|' . $row['hspk_satuan']; ?>"><?= $row['hspk_paket'] . '] - [' . $row['hspk_spesifikasi'] . '] - [' . $row['hspk_satuan'] . '] - [' . $A['total'] . ']'; ?></option>
							<?php endforeach; ?>
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
		</div><br>
		<div class="row">
			<div class="col">
				<table class="table table-bordered display nowrap table-sm hspkTable" cellspacing="0" id="itemsTable">
					<thead>
						<tr style="background: aliceblue;">
							<th class="text-center" style="width: 50px;">Nomer</th>
							<th>Komponen</th>
							<th>Spesifikasi</th>
							<th>Satuan</th>
							<th>Jumlah</th>
							<th>Harga Satuan (Rp)</th>
							<th>Jumlah Harga (Rp)</th>
							<th class="text-center" style="width: 50px;">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $nomer = 1; ?>
						<?php foreach ($asb_hspk as $row) : ?>
							<tr id="DeleteDb_<?= $row['id_asb_hspk']; ?>">
								<td class="text-center"><?= $nomer++; ?></td>
								<td><?= $row['hspk_paket']; ?></td>
								<td><?= $row['hspk_spesifikasi']; ?></td>
								<td><?= $row['hspk_satuan']; ?></td>
								<td class="index"><?= $row['jumlah']; ?></td>
								<!-- ---------------------------->
								<?php
								$A = $db->table('tb_hspk_komponen')
									->select('SUM(tb_hspk_komponen.index * tb_ssh.harga) AS total')
									->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')
									->getWhere(['tb_hspk_komponen.hspk_id' => $row['id_hspk']])->getRowArray()['total'];
								?>
								<!-- ---------------------------->
								<td class="harga"><?= $A; ?> </td>
								<td class="jumlah"></td>
								<td><button type="button" class="btn btn-danger deleteItemButton" onclick="DeleteDb('<?= $row['id_asb_hspk']; ?>')">Hapus</button></td>
								<input type="hidden" name="id_asb_hspk[]" value="<? $row['id_asb_hspk']; ?>">
								<input type="hidden" name="hspk[]" value="<?= $row['hspk_id']; ?>">
								<input type="hidden" name="jumlah[]" value="<?= $row['jumlah']; ?>">
							</tr>
						<?php endforeach ?>
					</tbody>
					<tfoot>
						<tr class="font-weight-bold">
							<td colspan="6">Total</td>
							<td id="totalAmount">0</td>
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
	// -----------------------
	// Ambil semua baris dari tbody
	// Ambil semua tabel dengan kelas 'barangTable'
	const tables = document.querySelectorAll('.hspkTable');

	// Fungsi untuk menghitung jumlah di setiap tabel
	function calculateTable(table) {
		// Ambil semua baris dari tbody dalam tabel tersebut
		const rows = table.querySelectorAll('tbody tr');

		// Loop melalui setiap baris
		rows.forEach(row => {
			// Ambil nilai dari kolom harga dan index
			const harga = parseFloat(row.querySelector('.harga').textContent);
			const index = parseFloat(row.querySelector('.index').textContent);

			// Hitung jumlah (harga * index)
			const jumlah = harga * index;

			// Masukkan hasil ke dalam kolom jumlah
			row.querySelector('.jumlah').textContent = jumlah;
		});
	}
	// Loop melalui setiap tabel dan panggil fungsi calculateTable
	tables.forEach(table => {
		calculateTable(table);
	});

	// -----------------------
	function DeleteDb(id) {
		if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
			fetch("<?= base_url('/user/asb/asb/hapus_asb_hspk'); ?>", {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
					},
					body: JSON.stringify({
						id: id
					}),
				})
				.then(response => response.json())
				.then(data => {
					if (data.status === 'success') {

						alert(data.message);
						// Lakukan tindakan lain yang diinginkan, misalnya menghapus elemen dari tampilan
						var element = document.getElementById('DeleteDb_' + id);
						if (element && element.parentNode) {
							element.parentNode.removeChild(element);
						}
					} else {

						alert(data.message);
					}
				})
				.catch(error => {
					console.error('Error:', error);
				});
			updateTotalAmount();

		}
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
				total += parseFloat($(this).find('td:nth-child(7)').text());
			});
			$('#totalAmount').text(formatCurrency(total));
		}

		$(document).on('click', '.deleteItemButton', function() {
			$(this).closest('tr').remove();
			updateTotalAmount();
		});

		$('#addItemButton').click(function() {
			var itemName = $('#itemSelect').val().split('|');
			var itemName2 = $('#itemSelect2').val();
			var jumlah = itemName2 * itemName[1].trim();
			var newRow = '<tr><td class="text-center"></td><td>' + itemName[2].trim() + '</td> <td>' + itemName[3].trim() + '</td><td>' + itemName[4].trim() + '</td><td>' + itemName2 + '</td><td>' + formatCurrency(itemName[1].trim()) + '</td><td>' + jumlah + '</td><td><button type="button" class="btn btn-danger deleteItemButton">Hapus</button></td></tr><input type="hidden" name="id_asb_hspk[]" value=""><input type="hidden" name="hspk[]" value="' + itemName[0].trim() + '"><input type="hidden" name="jumlah[]" value="' + itemName2 + '">';
			$('#itemsTable tbody').append(newRow);
			updateRowNumbers();
			updateTotalAmount();
		});

		window.addEventListener('load', function() {
			updateTotalAmount();
		});
	});

	// ---------------------
	document.getElementById('myForm').addEventListener('submit', function(event) {
		// Menghentikan submit form
		event.preventDefault();

		// Mengambil nilai input name[]
		const sshs = document.getElementsByName('hspk[]');

		// Menghapus pesan error sebelumnya
		document.querySelectorAll('.error').forEach(function(error) {
			error.textContent = '';
		});

		let isValid = true;

		// Validasi untuk memastikan setidaknya satu kolom name telah ditambahkan
		if (sshs.length === 0) {
			alert('Tambahkan Hspk paket.');
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
</script>
<?= $this->endSection(); ?>