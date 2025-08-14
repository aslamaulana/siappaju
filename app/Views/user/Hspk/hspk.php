<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<style>
	.c0 {
		width: 5px;
		text-align: center;
	}

	.c1 {
		width: 30px;
		text-align: center;
	}

	.c2 {
		width: 100px;
		text-align: center;
	}

	.c3 {
		width: 100px;
		text-align: center;
	}

	.c4 {
		width: 130px;
		text-align: center;
	}

	.c5 {
		width: 190px;
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

<?= $this->section('tombol'); ?>
<?php if (menu('hspk')->kunci != 'ya') { ?>
	<div style="width:90px;position: absolute;right: 95px;">
		<a href="<?= base_url('/user/hspk/hspk/hspk_add'); ?>">
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
		</a>
	</div>
	<!-- Tombol di atas tabel -->
	<div style="width:90px;position: absolute;right: 0px;">
		<button id="btnAjukanSelected" class="btn btn-primary btn-sm mb-2">
			<i class="fas fa-paper-plane"></i> Ajukan
		</button>
	</div>
<?php } else { ?>
	<div style="width:90px;position: absolute;right: 0px;">
		<a>
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-lock"></i> Add</li>
		</a>
	</div>
<?php } ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">

	<table id="example2" class="table table-bordered display nowrap table-sm" cellspacing="0">
		<thead>
			<tr style="background: antiquewhite;">
				<th class="c0"><input type="checkbox" id="checkAll"></th>
				<th class="c1">No</th>
				<th class="">Paket</th>
				<th class="">Spesifikasi</th>
				<th class="c2">Satuan</th>
				<th class="c4">Total</th>
				<th class="c1">Status</th>
				<th class="c1">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr style="background: antiquewhite;">
				<th class="c0"></th>
				<th class="c1">No</th>
				<th class="">Paket</th>
				<th class="">Spesifikasi</th>
				<th class="c2">Satuan</th>
				<th class="c4">Total</th>
				<th class="c1">Status</th>
				<th class="c1">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($hspk as $index => $row) : ?>
				<?php $jawab = $db->table('tb_verifikasi')->join('auth_groups', 'tb_verifikasi.opd_id = auth_groups.id', 'left')->getWhere(['hspk_id' => $row['id_hspk']])->getRow(); ?>
				<tr data-index="<?= $index ?>">
					<td class="text-center">
						<?php if (!isset($jawab) || $jawab->verifikasi == 'dikembalikan') : ?>
							<input type="checkbox" class="row-check" value="<?= $row['id_hspk'] ?>">
						<?php else: ?>
							<input type="checkbox" disabled>
						<?php endif ?>
					</td>
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
					<td class="c1 align-top"><?= $nomor++; ?></td>
					<td><?= $row['hspk_paket']; ?></td>
					<td><?= $row['hspk_spesifikasi']; ?></td>
					<td class="c2"><?= $row['hspk_satuan']; ?></td>
					<td class="text-right">
						<?= number_format((float)$row['total'], 2, ',', '.'); ?>
					</td>
					<td class="text-center align-baseline">
						<div class="justify-content-center">
							<?php if (isset($jawab)) : ?>
								<?php if ($jawab->verifikasi == 'lolos') : ?>
									<button
										class="btn btn-success btn-circle btn-xs btn-popup-verifikasi"
										data-status="Lolos Verifikasi"
										data-keterangan=""
										data-verifikator="<?= $jawab->nm_verifikator; ?>"
										data-toggle="modal"
										data-target="#modalVerifikasi"
										title="Lolos verifikasi">
										<i class="nav-icon fas fa-check-circle"></i>
									</button>

								<?php elseif ($jawab->verifikasi == 'ditolak') : ?>
									<button
										class="btn btn-danger btn-circle btn-xs btn-popup-verifikasi"
										data-status="Ditolak"
										data-keterangan="<?= $jawab->verifikasi_keterangan; ?>"
										data-verifikator="<?= $jawab->nm_verifikator; ?>"
										data-toggle="modal"
										data-target="#modalVerifikasi"
										title="Ditolak">
										<i class="nav-icon fas fa-times-circle"></i>
									</button>

								<?php elseif ($jawab->verifikasi == 'dikembalikan') : ?>
									<button
										class="btn btn-danger btn-circle btn-xs btn-popup-verifikasi"
										data-status="Dikembalikan"
										data-keterangan="<?= $jawab->verifikasi_keterangan; ?>"
										data-verifikator="<?= $jawab->nm_verifikator; ?>"
										data-toggle="modal"
										data-target="#modalVerifikasi"
										title="Dikembalikan">
										<i class="nav-icon fas fa-undo"></i>
									</button>
								<?php elseif ($jawab->verifikasi == 'diajukan') : ?>
									<button type="button"
										class="btn btn-warning btn-circle btn-xs btn-popup-verifikasi"
										data-status="Sedang di proses"
										data-toggle="modal"
										data-target="#modalVerifikasi"
										title="Diproses">
										<i class="nav-icon fas fa-cog"></i>
									</button>
								<?php endif; ?>
							<?php else: ?>
								<!-- Tombol Ajukan Verifikasi -->
								<button type="button"
									class="btn btn-primary btn-circle btn-xs btn-ajukan"
									data-id="<?= $row['id_hspk']; ?>"
									title="Ajukan Verifikasi">
									Ajukan
								</button>
							<?php endif ?>
						</div>
					</td>
					<td class="text-center align-baseline">
						<div class="justify-content-center">
							<!-- Tombol Aksi (Icon Settings) -->
							<div class="btn-group">
								<button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Pengaturan">
									<i class="fas fa-cog"></i>
								</button>
								<div class="dropdown-menu dropdown-menu-right">
									<button type="button"
										class="dropdown-item detailBtn"
										data-id="<?= $row['id_hspk']; ?>"
										data-toggle="modal"
										data-target="#formModalDetail">
										<i class="fas fa-search text-info"></i> Detail
									</button>
									<?php if (!isset($jawab) || $jawab->verifikasi == 'dikembalikan') : ?>
										<button type="button"
											class="dropdown-item btn-ajukan"
											data-id="<?= $row['id_hspk']; ?>"
											title="Ajukan Verifikasi">
											<i class="fas fa-hand-paper text-info"></i>Ajukan
										</button>
										<!-- Tombol Edit -->
										<a class="dropdown-item"
											href="<?= base_url() . '/user/hspk/hspk/hspk_edit/' . $row['id_hspk']; ?>">
											<i class="fas fa-pen-alt text-info"></i> Edit Data
										</a>
										<!-- Tombol Hapus -->
										<button type="button"
											class="dropdown-item btn-hapus"
											data-id="<?= $row['id_hspk']; ?>">
											<i class="fas fa-trash-alt text-danger"></i> Hapus Data
										</button>

									<?php endif ?>
								</div>
							</div>
						</div>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
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
<!-- Modal Keterangan -->
<div class="modal fade" id="modalVerifikasi" tabindex="-1" role="dialog" aria-labelledby="modalVerifikasiLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalVerifikasiLabel">Detail Verifikasi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<p><strong>Status:</strong> <span id="statusVerifikasi"></span></p>
				<p><strong>Keterangan:</strong></p>
				<p id="keteranganVerifikasi" style="white-space: pre-wrap;"></p>
				<p><strong>Verifikator:</strong> <span id="verifikatorVerifikasi"></span></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
	// Override penyimpanan state DataTables → sessionStorage
	$.fn.dataTable.ext.state.save = function(settings, data) {
		try {
			sessionStorage.setItem(
				'DataTables_' + settings.sInstance,
				JSON.stringify(data)
			);
		} catch (e) {
			console.warn('Gagal menyimpan state DataTables:', e);
		}
	};

	$.fn.dataTable.ext.state.load = function(settings) {
		let data = sessionStorage.getItem('DataTables_' + settings.sInstance);
		return data ? JSON.parse(data) : null;
	};
</script>
<script>
	$(function() {
		bsCustomFileInput.init();
	});
	$(function() {
		$("#example1").DataTable({
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
			stateSave: true // WAJIB
		});
		$('#example2').DataTable({
			"scrollX": true,
			"scrollY": '65vh',
			"scrollCollapse": false,
			"paging": true,
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[40, 60, 100, -1],
				[40, 60, 100, 'All']
			],
			stateSave: true // WAJIB
		});
	});
</script>
<script>
	$(document).on('click', '.btn-popup-verifikasi', function() {
		let status = $(this).data('status');
		let keterangan = $(this).data('keterangan') || '-';
		let verifikator = $(this).data('verifikator') || '-';

		$('#statusVerifikasi').text(status);
		$('#keteranganVerifikasi').text(keterangan);
		$('#verifikatorVerifikasi').text(verifikator);
	});
</script>

<script>
	$(document).ready(function() {

		// Tombol Hapus Data
		$(document).on('click', '.btn-hapus', function() {
			let id = $(this).data('id');
			let $btn = $(this);
			if (confirm('Apakah anda yakin ingin menghapus data ini ??')) {
				$.ajax({
					url: '<?= base_url("/user/hspk/hspk/hspk_hapus/") ?>/' + id,
					type: 'POST',
					success: function(res) {
						// Hapus row tabel tanpa reload
						$btn.closest('tr').fadeOut(500, function() {
							$(this).remove();
						});
					},
					error: function() {
						alert('Gagal menghapus data!');
					}
				});
			}
		});

		// Tombol Ajukan Verifikasi
		$(document).on('click', '.btn-ajukan', function() {
			let id = $(this).data('id');
			let $btn = $(this);
			if (confirm('Ajukan Verifikasi ??')) {
				$.ajax({
					url: '<?= base_url("/user/verifikasi/data/ajukan/") ?>/' + id,
					type: 'POST',
					success: function(res) {
						$btn.replaceWith(`
						<button type="button"
							class="btn btn-warning btn-circle btn-xs btn-popup-verifikasi"
							data-status="Sedang di proses"
							data-toggle="modal"
							data-target="#modalVerifikasi"
							title="Diproses">
							<i class="nav-icon fas fa-cog"></i>
						</button>
					`);
					}
				});
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
	$(document).ready(function() {

		// Ceklis Semua
		$('#checkAll').on('change', function() {
			$('.row-check').prop('checked', this.checked);
		});

		// Klik tombol ajukan
		$('#btnAjukanSelected').on('click', function() {
			let selectedIds = [];
			$('.row-check:checked').each(function() {
				selectedIds.push($(this).val());
			});

			if (selectedIds.length === 0) {
				alert('Pilih minimal 1 data untuk diajukan!');
				return;
			}

			if (confirm('Ajukan verifikasi untuk data terpilih?')) {
				$(this).prop('disabled', true)
					.html('<i class="fas fa-cog fa-spin"></i> proses...');

				$.ajax({
					url: '<?= base_url("/user/verifikasi/data/ajukan_hspk_multiple") ?>',
					type: 'POST',
					data: {
						ids: selectedIds
					},
					success: function(res) {
						alert('Berhasil diajukan!');
						location.reload(); // reload tabel
					},
					error: function() {
						alert('Gagal mengajukan verifikasi!');
						$('#btnAjukanSelected').prop('disabled', false)
							.html('<i class="fas fa-paper-plane"></i> Ajukan');
					}
				});
			}
		});

	});
</script>

<?= $this->endSection(); ?>