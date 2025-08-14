<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<style>
	.c0 {
		width: 5px;
		text-align: center;
	}

	.c1 {
		width: 50px;
		text-align: center;
	}

	.c2 {
		width: 150px;
	}

	.c2a {
		width: 300px;
	}

	.c3 {
		width: 300px;
	}

	.c4 {
		width: 450px;
	}

	.c5 {
		width: 550px;
	}

	.c6 {
		width: 90px;
		text-align: center;
	}

	.c7 {
		width: 150px;
		text-align: center;
	}

	.c8 {
		width: 80px;
		text-align: center;
	}

	.c9 {
		width: 150px;
		text-align: center;
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
<style>
	/* Styling custom untuk tooltip */
	.tooltip.custom-tooltip {
		pointer-events: none;
		/* biar tooltip tidak ganggu hover */
		max-width: 520px !important;
		font-size: 14px;
	}

	.tooltip.custom-tooltip .tooltip-inner {
		background: linear-gradient(135deg, #343a40, #1f2933);
		/* gradasi gelap */
		color: #fff;
		padding: .6rem .8rem;
		border-radius: .5rem;
		box-shadow: 0 6px 18px rgba(0, 0, 0, .35);
		line-height: 1.25;
		text-align: left;
	}

	.tooltip.custom-tooltip .tooltip-inner .ttl-title {
		font-weight: 700;
		display: block;
		margin-bottom: .35rem;
		font-size: 0.8rem;
	}

	.tooltip.custom-tooltip .tooltip-inner .ttl-sub {
		font-size: 0.8rem;
		opacity: .85;
	}

	.tooltip.custom-tooltip .arrow::before {
		border-top-color: rgba(0, 0, 0, 0.2);
		/* optional subtle border */
	}

	/* Versi terang (pilihan) */
	.tooltip.custom-tooltip.theme-light .tooltip-inner {
		background: #fff;
		color: #212529;
		border: 1px solid rgba(0, 0, 0, .08);
	}

	/* contoh animasi fade (Bootstrap already handles fade if class 'fade' diberikan) */

	.btn-tool {
		color: #6c757d;
	}

	.btn-tool:hover {
		color: #495057;
	}

	.dropdown-menu .dropdown-item i {
		margin-right: 5px;
	}
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<td style="width: 140px;;"><b>OPD :</b></td>
			<td><?= $opd['description']; ?></td>
		</tr>
	</table><br>
	<!-- Tombol Aksi Massal -->
	<div class="mb-2">
		<button id="btn-terima" class="btn btn-success btn-sm">Terima</button>
		<button id="btn-kembalikan" class="btn btn-primary btn-sm">Kembalikan</button>
		<button id="btn-tolak" class="btn btn-danger btn-sm">Tolak</button>
	</div>

	<table id="example1" class="table table-bordered display nowrap table-sm" cellspacing="0">
		<thead>
			<tr style="background: antiquewhite;">
				<th class="c0"><input type="checkbox" id="check-all"></th>
				<th class="c1">No</th>
				<th class="c4">Paket</th>
				<th class="c5">Spesifikasi</th>
				<th class="c7">Satuan</th>
				<th class="c7">Total</th>
				<th class="c1">Detail</th>
				<th class="c9">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $nomor = 1;
			foreach ($hspk as $index => $row) : ?>
				<tr class="">
					<input type="hidden" name="id_sub_rincian_objek[<?= $index ?>]" value="<?= $row['id_jenis_rincian_objek_sub'] ?>" class="id_sub_rincian_objek">
					<input type="hidden" name="sub_rincian_objek[<?= $index ?>]" value="<?= '[' . $row['id_jenis_rincian_objek_sub'] . '] ' . $row['jenis_rincian_objek_sub'] ?>" class="sub_rincian_objek">
					<input type="hidden" name="hspk_paket[<?= $index ?>]" value="<?= $row['hspk_paket'] ?>" class="hspk_paket">
					<input type="hidden" name="hspk_spesifikasi[<?= $index ?>]" value="<?= $row['hspk_spesifikasi'] ?>" class="hspk_spesifikasi">
					<input type="hidden" name="hspk_satuan[<?= $index ?>]" value="<?= $row['hspk_satuan'] ?>" class="hspk_satuan">
					<input type="hidden" name="id[<?= $index ?>]" value="<?= $row['id_hspk'] ?>" class="id">
					<input type="hidden" name="created_by[<?= $index ?>]" value="<?= $row['created_by'] ?>" class="created_by">
					<input type="hidden" name="created_at[<?= $index ?>]" value="<?= $row['created_at'] ?>" class="created_at">
					<input type="hidden" name="updated_at[<?= $index ?>]" value="<?= $row['updated_at'] ?>" class="updated_at">
					<input type="hidden" name="updated_by[<?= $index ?>]" value="<?= $row['updated_by'] ?>" class="updated_by">
					<td class="align-top text-center">
						<?php if (!empty($row['verifikasi']) && in_array($row['verifikasi'], ['diajukan', 'edit'])): ?>
							<input type="checkbox" class="row-check" value="<?= $row['id_hspk'] ?>">
						<?php else: ?>
							<input type="checkbox" class="row-check" disabled>
						<?php endif ?>
					</td>
					<td class="c1 align-top"><?= $nomor++; ?></td>
					<td class="align-top"><?= $row['hspk_paket']; ?></td>
					<td class="align-top"><?= $row['hspk_spesifikasi']; ?></td>
					<td class="c2 align-top"><?= $row['hspk_satuan']; ?></td>
					<td class="align-top text-right">
						<?= number_format($row['totalA'] + $row['totalB'] + $row['totalC'], 2, ',', '.'); ?>
					</td>
					<td class="align-top text-center">
						<div class="d-flex justify-content-center">
							<button type="button"
								class="btn btn-info btn-circle btn-xs detailBtn"
								data-id="<?= $row['id_hspk']; ?>"
								data-toggle="modal"
								data-target="#formModalDetail">
								<i class="nav-icon fas fa-search"></i>
							</button>
						</div>
					</td>
					<td class="align-top text-center">
						<!-- ------------------------------------------------------------------------------------------- -->
						<div class="d-flex justify-content-center">
							<?php if (!empty($row['verifikasi'])) : ?>
								<!-- Tombol Status -->
								<button type="button"
									id="btn-status-<?= $row['id_hspk'] ?>"
									class="btn btn-xs verifikasi-btn 
       									 <?= $row['verifikasi'] == 'lolos' ? 'btn-success' : ($row['verifikasi'] == 'ditolak' ? 'btn-danger' : ($row['verifikasi'] == 'dikembalikan' ? 'btn-primary' : ($row['verifikasi'] == 'edit' ? 'btn-info' : 'btn-warning'))) ?>"
									data-toggle="modal"
									data-target="#verifikasiModal"
									data-id="<?= $row['id_hspk']; ?>"
									data-status="<?= $row['verifikasi']; ?>"
									data-keterangan="<?= htmlspecialchars($row['verifikasi_keterangan'] ?? '', ENT_QUOTES); ?>"
									data-verifikator="<?= htmlspecialchars($row['nm_verifikator'] ?? '', ENT_QUOTES); ?>">
									<?= ucfirst($row['verifikasi']); ?>
								</button>
							<?php endif ?>
						</div>
						<!-- ------------------------------------------------------------------------------------------- -->
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<!-- Modal -->
<div class="modal fade" id="verifikasiModal" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<form id="verifikasiForm">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Verifikasi Data</h5>
					<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id_hspk" id="modal_id_hspk">
					<input type="hidden" name="status" id="modal_status">

					<div id="info_verifikator" class="mb-3" style="display: none;">
						<strong>Verifikator:</strong> <span id="modal_verifikator"></span><br>
						<strong>Keterangan:</strong>
						<pre id="modal_keterangan" style="white-space: pre-wrap;"></pre>
					</div>

					<div id="form_aksi">
						<textarea class="form-control mb-3" name="verifikasi_keterangan" placeholder="Keterangan..." id="modal_keterangan_input"></textarea>
						<div class="d-flex justify-content-between">
							<button type="button" class="btn btn-success btn-submit" data-status="lolos">Terima</button>
							<button type="button" class="btn btn-primary btn-submit" data-status="dikembalikan">Kembalikan</button>
							<button type="button" class="btn btn-danger btn-submit" data-status="ditolak">Tolak</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="formModalDetail" tabindex="-1" role="dialog" aria-labelledby="formModalLabelDetail" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document"> <!-- modal-xl agar lebar -->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formModalLabelDetail">Detail Data HSPK</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
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
								<div class="form-group" id="sub_rincian_objek" style="border: solid 2px #ced4da;border-radius: 4px;padding: 4px;min-height: 32px;">
								</div>
							</td>
							<td>
								<div class="form-group" id="satuan" style="border: solid 2px #ced4da;border-radius: 4px;padding: 4px;min-height: 32px;">
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
								<div class="form-group" id="nm_paket" style="border: solid 2px #ced4da;border-radius: 4px;padding: 4px;min-height: 32px;">
								</div>
							</td>
							<td>
								<div class="form-group" id="hspk_spesifikasi" style="border: solid 2px #ced4da;border-radius: 4px;padding: 4px;min-height: 32px;">
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
					<div class="col">
						<table class="table table-bordered display nowrap table-sm" cellspacing="0" id="itemsTableA">
							<thead>
								<tr style="background: aliceblue;">
									<td class="text-center" style="width: 50px;">Nomer</td>
									<td>Komponen</td>
									<td>Spesifikasi</td>
									<td style="width: 80px;">Koefisien</td>
									<td class="text-center" style="width: 140px;">Harga Satuan (Rp)</td>
									<td class="text-center" style="width: 140px;">Jumlah Harga (Rp)</td>
								</tr>
							</thead>
							<tbody>

							</tbody>
							<tfoot>
								<tr class="font-weight-bold" style="background: #e9e9e9;">
									<td colspan="5" class="text-right">Total</td>
									<td class="text-right" id="totalAmountA">Rp 0,00</td>
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
					<div class="col">
						<table class="table table-bordered display nowrap table-sm" cellspacing="0" id="itemsTableB">
							<thead>
								<tr style="background: aliceblue;">
									<td class="text-center" style="width: 50px;">Nomer</td>
									<td>Komponen</td>
									<td>Spesifikasi</td>
									<td style="width: 80px;">Koefisien</td>
									<td class="text-center" style="width: 140px;">Harga Satuan (Rp)</td>
									<td class="text-center" style="width: 140px;">Jumlah Harga (Rp)</td>

								</tr>
							</thead>
							<tbody>

							</tbody>
							<tfoot>
								<tr class="font-weight-bold" style="background: #e9e9e9;">
									<td colspan="5" class="text-right">Total</td>
									<td class="text-right" id="totalAmountB">Rp 0,00</td>
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
					<div class="col">
						<table class="table table-bordered display nowrap table-sm" cellspacing="0" id="itemsTableC">
							<thead>
								<tr style="background: aliceblue;">
									<td class="text-center" style="width: 50px;">Nomer</td>
									<td>Komponen</td>
									<td>Spesifikasi</td>
									<td style="width: 80px;">Koefisien</td>
									<td class="text-center" style="width: 140px;">Harga Satuan (Rp)</td>
									<td class="text-center" style="width: 140px;">Jumlah Harga (Rp)</td>

								</tr>
							</thead>
							<tbody>

							</tbody>
							<tfoot>
								<tr class="font-weight-bold" style="background: #e9e9e9;">
									<td colspan="5" class="text-right">Total</td>
									<td class="text-right" id="totalAmountC">Rp 0,00</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<table class="table table-bordered display nowrap table-sm" cellspacing="0" id="itemsTableABC">
							<thead>
								<tr class="font-weight-bold" style="background: #e9e9e9;">
									<td colspan="5" class="text-right">Total A + B + C</td>
									<td class="text-right" style="width: 140px;" id="totalAmountABC">Rp 0,00</td>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				<!-- Footer -->
				<div class="modal-footer">
					<!-- contoh lain: elemen kecil -->
					<i class="fas fa-info-circle ml-3 icon-info"
						style="font-size:1.5rem; cursor:pointer"
						data-toggle="custom-tooltip"
						data-placement="left"
						title="">
					</i>
					<!-- <button type="submit" class="btn btn-success">Simpan</button> -->
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('/toping/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>

<script>
	$(function() {
		bsCustomFileInput.init();
	});
	$(function() {
		$("#example1").DataTable({
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
			"stateSave": true // WAJIB
		});
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
			"stateSave": true // WAJIB
		});
	});
</script>
<script>
	let activeButton = null;

	$('#verifikasiModal').on('show.bs.modal', function(event) {
		let button = $(event.relatedTarget);
		activeButton = button; // simpan tombol yg diklik

		let id = button.data('id');
		let status = button.data('status');
		let keterangan = button.data('keterangan') || '';
		let verifikator = button.data('verifikator') || '';

		let modal = $(this);

		modal.find('#modal_id_hspk').val(id);
		modal.find('#modal_status').val(status);
		modal.find('#modal_verifikator').text(verifikator);
		modal.find('#modal_keterangan').text(keterangan);
		modal.find('#modal_keterangan_input').val('');

		if (status === 'lolos' || status === 'diajukan' || status === 'edit') {
			modal.find('#info_verifikator').toggle(status !== 'diajukan');
			modal.find('#form_aksi').show();
		} else {
			modal.find('#info_verifikator').show();
			modal.find('#form_aksi').hide();
		}
	});

	// klik tombol submit di modal
	$(document).on('click', '.btn-submit', function() {
		let modal = $('#verifikasiModal');
		let id = modal.find('#modal_id_hspk').val();
		let statusBaru = $(this).data('status');
		let keterangan = modal.find('#modal_keterangan_input').val();

		$.ajax({
			url: '<?= base_url("/admin/verifikasi/data/verifikasi") ?>',
			type: 'POST',
			data: {
				id_hspk: id,
				status: statusBaru,
				verifikasi_keterangan: keterangan
			},
			success: function(res) {
				if (res.success) {
					// update tombol di tabel
					let warna = {
						'lolos': 'btn-success',
						'ditolak': 'btn-danger',
						'dikembalikan': 'btn-primary',
						'edit': 'btn-info',
						'diajukan': 'btn-warning'
					};

					activeButton
						.removeClass('btn-success btn-danger btn-primary btn-info btn-warning')
						.addClass(warna[statusBaru])
						.text(statusBaru.charAt(0).toUpperCase() + statusBaru.slice(1))
						.data('status', statusBaru)
						.data('keterangan', keterangan)
						.data('verifikator', '<?= user()->full_name ?>');

					// Disable checkbox di baris yang sama
					activeButton.closest('tr').find('.row-check')
						.prop('checked', false)
						.prop('disabled', true);

					$('#verifikasiModal').modal('hide');
				} else {
					alert('Gagal memproses verifikasi.');
				}
			},
			error: function() {
				alert('Terjadi kesalahan server.');
			}
		});
	});
</script>
<script>
	$(document).ready(function() {
		// Tooltip Bootstrap HTML support
		$('[data-toggle="custom-tooltip"]').tooltip({
			html: true
		});

		// Saat tombol Detail diklik
		$(document).on('click', '.detailBtn', function() {
			$('#formModalLabelDetail').text('Detail Data HSPK');

			let tr = $(this).closest('tr');
			let id = $(this).data('id');

			// Set detail modal
			$('#sub_rincian_objek').text(tr.find('.sub_rincian_objek').val());
			$('#satuan').text(tr.find('.hspk_satuan').val());
			$('#nm_paket').text(tr.find('.hspk_paket').val());
			$('#hspk_spesifikasi').text(tr.find('.hspk_spesifikasi').val());

			// Update tooltip
			let tooltipContent = `
			<span class='ttl-title'>Detail</span>
			<span class='ttl-sub'>
				Created by: ${tr.find('.created_by').val()}<br/>
				Created at: ${tr.find('.created_at').val()}<br/><br/>
				Updated by: ${tr.find('.updated_by').val()}<br/>
				Updated at: ${tr.find('.updated_at').val()}<br/>
			</span>
		`;
			$('.icon-info').attr('data-original-title', tooltipContent).tooltip('update');

			// Kosongkan semua tabel dan reset total
			['A', 'B', 'C'].forEach(g => {
				$(`#itemsTable${g} tbody`).empty();
				$(`#totalAmount${g}`).text(formatCurrency(0));
			});
			$('#totalAmountABC').text(formatCurrency(0));

			// Ambil data semua group
			loadGroupData('A', id);
			loadGroupData('B', id);
			loadGroupData('C', id);
		});

		// Fungsi load data group
		function loadGroupData(group, id) {
			$.ajax({
				url: `<?= base_url("user/hspk/hspk/hspk_group") ?>${group}/${id}`,
				method: 'GET',
				dataType: 'json',
				success: function(data) {
					if (!data || !data.length) return;

					let total = 0;
					let rows = data.map((item, i) => {
						let harga = parseFloat(item.harga) || 0;
						let idx = parseFloat(item.index) || 0;
						let jumlah = harga * idx;
						total += jumlah;

						return `
						<tr>
							<td class="text-center">${i + 1}</td>
							<td>${item.komponen}</td>
							<td>${item.spesifikasi}</td>
							<td class="text-center">${idx}</td>
							<td class="text-right">${formatCurrency(harga)}</td>
							<td class="text-right">${formatCurrency(jumlah)}</td>
						</tr>
					`;
					}).join('');

					$(`#itemsTable${group} tbody`).html(rows);
					$(`#totalAmount${group}`).text(formatCurrency(total));

					// Hitung ulang total semua group
					updateTotalABC();
				}
			});
		}

		// Fungsi hitung total A+B+C
		function updateTotalABC() {
			let totalA = parseCurrency($('#totalAmountA').text());
			let totalB = parseCurrency($('#totalAmountB').text());
			let totalC = parseCurrency($('#totalAmountC').text());
			let totalAll = totalA + totalB + totalC;
			$('#totalAmountABC').text(formatCurrency(totalAll));
		}

		// Fungsi format mata uang
		function formatCurrency(num) {
			return num.toLocaleString('id-ID', {
				style: 'currency',
				currency: 'IDR'
			});
		}

		// Fungsi parse mata uang ke angka
		function parseCurrency(str) {
			return parseFloat(str.replace(/[Rp\s.]/g, '').replace(',', '.')) || 0;
		}
	});
</script>
<script>
	// Cek semua
	$('#check-all').on('change', function() {
		$('.row-check').prop('checked', $(this).is(':checked'));
	});

	// Fungsi eksekusi
	function prosesVerifikasiMassal(statusBaru) {
		let ids = $('.row-check:checked').map(function() {
			return $(this).val();
		}).get();

		if (ids.length === 0) {
			alert('Pilih minimal satu data!');
			return;
		}

		if (!confirm('Yakin ingin memproses data terpilih?')) return;

		$.ajax({
			url: '<?= base_url("/admin/verifikasi/data/verifikasi_massal_hspk") ?>',
			type: 'POST',
			data: {
				ids: ids,
				status: statusBaru
			},
			success: function(res) {
				if (res.success) {
					let warna = {
						'lolos': 'btn-success',
						'ditolak': 'btn-danger',
						'dikembalikan': 'btn-primary',
						'edit': 'btn-info',
						'diajukan': 'btn-warning'
					};

					ids.forEach(function(id) {
						// Checkbox -> disable + uncheck
						let $rowCheck = $('.row-check[value="' + id + '"]');
						$rowCheck.prop('disabled', true).prop('checked', false);

						// Ubah tombol status langsung via ID
						let $btnStatus = $('#btn-status-' + id);

						$btnStatus
							.removeClass('btn-success btn-danger btn-primary btn-info btn-warning')
							.addClass(warna[statusBaru])
							.text(statusBaru.charAt(0).toUpperCase() + statusBaru.slice(1))
							.data('status', statusBaru)
							.data('keterangan', '') // atau isi sesuai kebutuhan
							.data('verifikator', '<?= user()->full_name ?>');
					});


					// Uncheck checkbox "select all"
					$('#check-all').prop('checked', false);

					alert('Berhasil memproses data!');
				} else {
					alert('Gagal memproses data.');
				}
			},
			error: function() {
				alert('Terjadi kesalahan server.');
			}
		});
	}

	// Tombol aksi
	$('#btn-terima').on('click', function() {
		prosesVerifikasiMassal('lolos');
	});
	$('#btn-kembalikan').on('click', function() {
		prosesVerifikasiMassal('dikembalikan');
	});
	$('#btn-tolak').on('click', function() {
		prosesVerifikasiMassal('ditolak');
	});
</script>
<?= $this->endSection(); ?>