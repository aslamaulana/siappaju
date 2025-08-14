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

	<table id="example2" class="table table-bordered display nowrap table-sm" cellspacing="0">
		<thead>
			<tr style="background: antiquewhite;">
				<th class="c0"><input type="checkbox" id="check-all"></th>
				<th class="c1">No</th>
				<th class="c4">Komponen</th>
				<th class="c5">Spesifikasi</th>
				<th class="c6">Satuan</th>
				<th class="c7">Harga</th>
				<th class="c8">TKDN %</th>
				<th class="c8">Kelompok</th>
				<th class="c1">Detail</th>
				<th class="c9">Aksi</th>
			</tr>
		</thead>

		<tbody>
			<?php $nomor = 1;
			foreach ($ssh as $index => $row) : ?>
				<?php $jawab = $db->table('tb_ssh_verifikasi')
					->join('auth_groups', 'tb_ssh_verifikasi.opd_id = auth_groups.id', 'left')
					->getWhere(['ssh_id' => $row['id_ssh']])->getRow();
				?>

				<tr class="">
					<input type="hidden" name="komponen[<?= $index ?>]" value="<?= $row['komponen'] ?>" class="komponen">
					<input type="hidden" name="spesifikasi[<?= $index ?>]" value="<?= $row['spesifikasi'] ?>" class="spesifikasi">
					<input type="hidden" name="satuan[<?= $index ?>]" value="<?= $row['satuan'] ?>" class="satuan">
					<input type="hidden" name="harga[<?= $index ?>]" value="<?= $row['harga'] ?>" class="harga">
					<input type="hidden" name="tkdn[<?= $index ?>]" value="<?= $row['tkdn'] ?>" class="tkdn">
					<input type="hidden" name="kelompok[<?= $index ?>]" value="<?= $row['kelompok'] ?>" class="kelompok">
					<input type="hidden" name="sub_rincian[<?= $index ?>]" value="<?= $row['jenis_rincian_objek_sub_id'] ?>" class="sub_rincian">
					<input type="hidden" name="created_by[<?= $index ?>]" value="<?= $row['created_by'] ?>" class="created_by">
					<input type="hidden" name="created_at[<?= $index ?>]" value="<?= $row['created_at'] ?>" class="created_at">
					<input type="hidden" name="updated_at[<?= $index ?>]" value="<?= $row['updated_at'] ?>" class="updated_at">
					<input type="hidden" name="updated_by[<?= $index ?>]" value="<?= $row['updated_by'] ?>" class="updated_by">
					<td class="align-top text-center">
						<?php if (!empty($jawab) && in_array($jawab->verifikasi, ['diajukan', 'edit'])): ?>
							<input type="checkbox" class="row-check" value="<?= $row['id_ssh'] ?>">
						<?php else: ?>
							<input type="checkbox" class="row-check" disabled>
						<?php endif ?>
					</td>
					<td class="align-top text-center"><?= $nomor++; ?></td>
					<td class="align-top">
						<?= $row['keterangan'] == '1' ? "<b>[Data Acuan]</b> " : ""; ?>
						<?= $row['komponen']; ?></td>
					<td class="align-top"><?= $row['spesifikasi']; ?></td>
					<td class="align-top text-center"><?= $row['satuan']; ?></td>
					<td class="align-top text-right"><?= 'Rp' . number_format($row['harga'], 2, ',', '.'); ?></td>
					<td class="c8 align-top"><?= $row['tkdn']; ?></td>
					<td class="c8 align-top"><?= $row['kelompok']; ?></td>
					<!-- ------------------------------------------------------------------------------------ -->
					<td class="align-top text-center">
						<div class="d-flex justify-content-center">
							<button type="button"
								class="btn btn-info btn-circle btn-xs detailBtn"
								data-id="<?= $row['id_ssh']; ?>"
								data-toggle="modal"
								data-target="#formModalDetail">
								<i class="nav-icon fas fa-search"></i>
							</button>
						</div>
					</td>
					<td class="align-top text-center">
						<!-- ------------------------------------------------------------------------------------------- -->
						<div class="d-flex justify-content-center">
							<?php if (isset($jawab)) : ?>
								<!-- Tombol Status -->
								<button type="button"
									id="btn-status-<?= $row['id_ssh'] ?>"
									class="btn btn-xs verifikasi-btn 
       									 <?= $jawab->verifikasi == 'lolos' ? 'btn-success' : ($jawab->verifikasi == 'ditolak' ? 'btn-danger' : ($jawab->verifikasi == 'dikembalikan' ? 'btn-primary' : ($jawab->verifikasi == 'edit' ? 'btn-info' : 'btn-warning'))) ?>"
									data-toggle="modal"
									data-target="#verifikasiModal"
									data-id="<?= $row['id_ssh']; ?>"
									data-status="<?= $jawab->verifikasi; ?>"
									data-keterangan="<?= htmlspecialchars($jawab->verifikasi_keterangan ?? '', ENT_QUOTES); ?>"
									data-verifikator="<?= htmlspecialchars($jawab->nm_verifikator ?? '', ENT_QUOTES); ?>">
									<?= ucfirst($jawab->verifikasi); ?>
								</button>
							<?php endif ?>
						</div>
						<!-- ------------------------------------------------------------------------------------------- -->
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<!-- Modal -->
	<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document"> <!-- modal-xl agar lebar -->
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="formModalLabel">Tambah Data SSH</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url('/user/ssh/ssh_pengajuan/ssh_create') ?>" method="POST" id="myForm">
					<div class="modal-body">
						<?= csrf_field() ?>
						<table class="table table-bordered table-sm no-border-table" cellspacing="0">
							<thead>
								<tr>
									<th style="width: 30%;">Jenis</th>
									<th style="width: 70%;">Sub Rincian</th>
								</tr>
							</thead>
							<tbody class="form-program">
								<tr>
									<td>
										<div class="form-group">
											<select name="jenis" class="form-control select2bs4" required>
												<option value="">Pilih...</option>
												<option value="SSH">SSH</option>
												<option value="SBU">SBU</option>
											</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select name="sub_rincian_objek" id="sub_rincian_objek_id" class="form-control select2bs4" required></select>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
						<table class="table table-bordered table-sm no-border-table" cellspacing="0">
							<thead>
								<tr>
									<th style="width: 40%;">Satuan</th>
									<th style="width: 30%;">Harga</th>
									<th style="width: 30%;">Tkdn %</th>
								</tr>
							</thead>
							<tbody class="form-program">
								<tr>
									<td>
										<div class="form-group">
											<input type="text" name="satuan" class="form-control" maxlength="50" required>
										</div>
									</td>
									<td>
										<div class="form-group">
											<input type="number" step="any" name="harga" class="form-control" maxlength="20" required>
										</div>
									</td>
									<td>
										<div class="form-group">
											<input type="number" name="tkdn" class="form-control" required>
											<!-- <input type="hidden" name="type" id="type"> -->
										</div>
									</td>
								</tr>
							</tbody>
						</table>
						<table class="table table-bordered table-sm no-border-table" cellspacing="0">
							<thead>
								<tr>
									<th style="width: 50%;">Komponen</th>
									<th style="width: 50%;">Spesifikasi</th>
								</tr>
							</thead>
							<tbody class="form-program">
								<tr>
									<td>
										<div class="form-group">
											<input type="text" name="komponen" class="form-control" maxlength="300" required>
										</div>
									</td>
									<td>
										<div class="form-group">
											<input type="text" name="spesifikasi" class="form-control" maxlength="500" required>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
						<!-- ------------- -->
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
					<!-- Footer -->
					<div class="modal-footer">
						<!-- contoh lain: elemen kecil -->
						<i class="fas fa-info-circle ml-3 icon-info"
							style="font-size:1.5rem; cursor:pointer"
							data-toggle="custom-tooltip"
							data-placement="left"
							title="">
						</i>
						<button type="submit" class="btn btn-success">Simpan</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="formModalDetail" tabindex="-1" role="dialog" aria-labelledby="formModalLabelDetail" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document"> <!-- modal-xl agar lebar -->
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="formModalLabelDetail">Tambah Data SSH</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?= csrf_field() ?>
					<table class="table table-bordered table-sm no-border-table" cellspacing="0">
						<thead>
							<tr>
								<th style="width: 30%;">Jenis</th>
								<th style="width: 70%;">Sub Rincian</th>
							</tr>
						</thead>
						<tbody class="form-program">
							<tr>
								<td>
									<div class="form-group">
										<select name="jenisDetail" id="jenisDetail" class="form-control select2bs4detail" required>
											<option value="">Pilih...</option>
											<option value="SSH">SSH</option>
											<option value="SBU">SBU</option>
										</select>
									</div>
								</td>
								<td>
									<div class="form-group">
										<select name="sub_rincian_objek_idDetail" id="sub_rincian_objek_idDetail" class="form-control select2bs4" required></select>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<table class="table table-bordered table-sm no-border-table" cellspacing="0">
						<thead>
							<tr>
								<th style="width: 40%;">Satuan</th>
								<th style="width: 30%;">Harga</th>
								<th style="width: 30%;">Tkdn %</th>
							</tr>
						</thead>
						<tbody class="form-program">
							<tr>
								<td>
									<div class="form-group">
										<input type="text" name="satuan" class="form-control" maxlength="50" required>
									</div>
								</td>
								<td>
									<div class="form-group">
										<input type="number" step="any" name="harga" class="form-control" maxlength="20" required>
									</div>
								</td>
								<td>
									<div class="form-group">
										<input type="number" name="tkdn" class="form-control" required>
										<!-- <input type="hidden" name="type" id="type"> -->
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<table class="table table-bordered table-sm no-border-table" cellspacing="0">
						<thead>
							<tr>
								<th style="width: 50%;">Komponen</th>
								<th style="width: 50%;">Spesifikasi</th>
							</tr>
						</thead>
						<tbody class="form-program">
							<tr>
								<td style="vertical-align: text-top;">
									<div class="form-group" id="komponen" style="border: solid #ced4da;border-radius: 4px;padding: 10px 10px;">
									</div>
								</td>
								<td style="vertical-align: text-top;">
									<div class="form-group" id="spesifikasi" style="border: solid #ced4da;border-radius: 4px;padding: 10px 10px;">
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<!-- ------------- -->
					<div class="row">
						<div class="col">
							<table class="table table-bordered display nowrap table-sm" cellspacing="0" id="itemsTable">
								<thead>
									<tr style="background: aliceblue;">
										<th class="text-center" style="width: 50px;">Nomer</th>
										<th>Nama Rekening</th>
									</tr>
								</thead>
								<tbody>
									<!-- Rows will be added here dynamically -->
								</tbody>
							</table>
						</div>
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
						<input type="hidden" name="id_ssh" id="modal_id_ssh">
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

</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('/toping/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-rowgroup/js/dataTables.rowGroup.min.js') ?>"></script>
<script>
	$('.select2bs4').select2({
		theme: 'bootstrap4',
		placeholder: 'Tidak Dipilih...',
		width: '100%',
		dropdownParent: $('#formModal')
	});
	$('.select2bs4detail').select2({
		theme: 'bootstrap4',
		placeholder: 'Tidak Dipilih...',
		width: '100%',
		dropdownParent: $('#formModalDetail')
	});
</script>
<script>
	$(function() {
		// Inisialisasi semua tooltip kustom sekali saja
		$('[data-toggle="custom-tooltip"]').tooltip({
			html: true,
			trigger: 'hover focus',
			placement: function() {
				return $(this).data('placement') || 'top';
			},
			template: '<div class="tooltip custom-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
		});
	});
</script>
<script>
	$('#jenis').change(function() {
		var id = $(this).val();
		var $subSelect = $('#sub_rincian_objek_id');

		// Saat mulai request → kasih indikator loading
		$subSelect.html('<option value="">Loading...</option>').prop('disabled', true);

		$.ajax({
			url: "<?= base_url('user/ssh/ssh_pengajuan/AmbilSubRincianObjekFilter'); ?>",
			method: "POST",
			data: {
				id: id
			},
			async: true,
			dataType: 'json',
			success: function(data) {
				var html = '<option value="">Pilih..</option>';
				for (var i = 0; i < data.length; i++) {
					html += '<option value="' + data[i].id_jenis_rincian_objek_sub + '">' +
						'[' + data[i].kode_jenis_rincian_objek_sub + '] ' +
						data[i].jenis_rincian_objek_sub + ' [' + data[i].kelompok_id + ']' +
						'</option>';
				}

				$subSelect.html(html).prop('disabled', false);

				// Kalau ada data lama dari mode edit, pilih otomatis
				var oldValue = $subSelect.data('selected');
				if (oldValue) {
					$subSelect.val(oldValue).trigger('change');
					$subSelect.removeAttr('data-selected');
				}
			},
			error: function() {
				$subSelect.html('<option value="">Gagal memuat data</option>').prop('disabled', false);
			}
		});
	});
	$('#jenisDetail').change(function() {
		var id = $(this).val();
		var $subSelect = $('#sub_rincian_objek_idDetail');

		// Saat mulai request → kasih indikator loading
		$subSelect.html('<option value="">Loading...</option>').prop('disabled', true);

		$.ajax({
			url: "<?= base_url('user/ssh/ssh_pengajuan/AmbilSubRincianObjekFilter'); ?>",
			method: "POST",
			data: {
				id: id
			},
			async: true,
			dataType: 'json',
			success: function(data) {
				var html = '<option value="">Pilih..</option>';
				for (var i = 0; i < data.length; i++) {
					html += '<option value="' + data[i].id_jenis_rincian_objek_sub + '">' +
						'[' + data[i].kode_jenis_rincian_objek_sub + '] ' +
						data[i].jenis_rincian_objek_sub + ' [' + data[i].kelompok_id + ']' +
						'</option>';
				}

				$subSelect.html(html).prop('disabled', false);

				// Kalau ada data lama dari mode edit, pilih otomatis
				var oldValue = $subSelect.data('selected');
				if (oldValue) {
					$subSelect.val(oldValue).trigger('change');
					$subSelect.removeAttr('data-selected');
				}
			},
			error: function() {
				$subSelect.html('<option value="">Gagal memuat data</option>').prop('disabled', false);
			}
		});
	});
</script>
<script>
	$(document).ready(function() {

		// Saat tombol Tambah diklik
		$(document).on('click', '.addBtn', function() {
			$('#formModalLabel').text('Tambah Data SSH');
			$('#myForm').trigger('reset');
			$('#myForm').attr('action', '<?= base_url("/user/ssh/ssh_pengajuan/ssh_create") ?>');
		});

		// Saat tombol Edit diklik
		$(document).on('click', '.editBtn', function() {
			$('#formModalLabel').text('Edit Data SSH');

			var tr = $(this).closest('tr');
			var id = $(this).data('id');
			var jenis = tr.find('.kelompok').val();
			var subRincian = tr.find('.sub_rincian').val();
			var satuan = tr.find('.satuan').val();
			var harga = tr.find('.harga').val();
			var tkdn = tr.find('.tkdn').val();
			var komponen = tr.find('.komponen').val();
			var spesifikasi = tr.find('.spesifikasi').val();
			var created_by = tr.find('.created_by').val();
			var created_at = tr.find('.created_at').val();
			var updated_by = tr.find('.updated_by').val();
			var updated_at = tr.find('.updated_at').val();

			// Isi form di modal
			$('#jenis').val(jenis).trigger('change');
			$('#sub_rincian_objek_id').data('selected', subRincian);
			$('input[name="satuan"]').val(satuan);
			$('input[name="harga"]').val(harga);
			$('input[name="tkdn"]').val(tkdn);
			$('input[name="komponen"]').val(komponen);
			$('input[name="spesifikasi"]').val(spesifikasi);

			// Ganti action form ke edit
			$('#myForm').attr('action', '<?= base_url("/user/ssh/ssh_pengajuan/ssh_update") ?>/' + id);

			// Update konten tooltip dinamis
			var tooltipContent = `
				<span class='ttl-title'>Detail</span>
				<span class='ttl-sub'>
					Created by: ${created_by}<br/>
					Created at: ${created_at}<br/>
					<br/>
					Updated by: ${updated_by}<br/>
					Updated at: ${updated_at}<br/>
				</span>
			`;

			$('.icon-info').attr('data-original-title', tooltipContent).tooltip('update');

			// Kosongkan tabel rekening
			$('#itemsTable tbody').empty();

			// Ambil data rekening via AJAX
			$.ajax({
				url: '<?= base_url("/user/ssh/ssh_pengajuan/getRekeningBySsh") ?>/' + id,
				method: 'GET',
				dataType: 'json',
				success: function(data) {
					if (data.length > 0) {
						var no = 1;
						data.forEach(function(item) {
							var row = `<tr>
                        <td class="text-center">${no++}</td>
                        <td>
                            <input type="hidden" name="id[]" value="${item.id_ssh_rekening}">
							<input type='hidden' name='rekening[]' value="${item.rekening_rincian_objek_sub_id}">
                            [${item.kode_rekening_rincian_objek_sub}] ${item.rekening_rincian_objek_sub}
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm removeItem">Hapus</button>
                        </td>
                    </tr>`;
							$('#itemsTable tbody').append(row);
						});
					}
				}
			});
		});

		// Saat tombol Detail diklik
		$(document).on('click', '.detailBtn', function() {
			$('#formModalLabelDetail').text('Detail Data SSH');

			var tr = $(this).closest('tr');
			var id = $(this).data('id');
			var jenis = tr.find('.kelompok').val();
			var subRincian = tr.find('.sub_rincian').val();
			var satuan = tr.find('.satuan').val();
			var harga = tr.find('.harga').val();
			var tkdn = tr.find('.tkdn').val();
			var komponen = tr.find('.komponen').val();
			var spesifikasi = tr.find('.spesifikasi').val();
			var created_by = tr.find('.created_by').val();
			var created_at = tr.find('.created_at').val();
			var updated_by = tr.find('.updated_by').val();
			var updated_at = tr.find('.updated_at').val();

			// Isi form di modal
			$('#jenisDetail').val(jenis).trigger('change').prop('disabled', true);
			$('#sub_rincian_objek_idDetail').data('selected', subRincian).prop('readonly', true);
			$('input[name="satuan"]').val(satuan);
			$('input[name="harga"]').val(harga);
			$('input[name="tkdn"]').val(tkdn);
			$('#komponen').text(komponen);
			$('#spesifikasi').text(spesifikasi);

			// Ganti action form ke edit
			$('#myForm').attr('action', '');

			// Update konten tooltip dinamis
			var tooltipContent = `
				<span class='ttl-title'>Detail</span>
				<span class='ttl-sub'>
					Created by: ${created_by}<br/>
					Created at: ${created_at}<br/>
					<br/>
					Updated by: ${updated_by}<br/>
					Updated at: ${updated_at}<br/>
				</span>
			`;

			$('.icon-info').attr('data-original-title', tooltipContent).tooltip('update');

			// Kosongkan tabel rekening
			$('#itemsTable tbody').empty();

			// Ambil data rekening via AJAX
			$.ajax({
				url: '<?= base_url("/user/ssh/ssh_pengajuan/getRekeningBySsh") ?>/' + id,
				method: 'GET',
				dataType: 'json',
				success: function(data) {
					if (data.length > 0) {
						var no = 1;
						data.forEach(function(item) {
							var row = `<tr>
                        <td class="text-center">${no++}</td>
                        <td>
                            <input type="hidden" name="id[]" value="${item.id_ssh_rekening}">
							<input type='hidden' name='rekening[]' value="${item.rekening_rincian_objek_sub_id}">
                            [${item.kode_rekening_rincian_objek_sub}] ${item.rekening_rincian_objek_sub}
                        </td>
                    </tr>`;
							$('#itemsTable tbody').append(row);
						});
					}
				}
			});
		});

	});

	// Event hapus rekening
	$(document).on('click', '.removeItem', function() {
		var btn = $(this); // simpan tombol
		var idRekening = btn.closest('tr').find('input[name="id_ssh_rekening[]"]').val();

		if (!idRekening) {
			// Kalau data baru yang belum tersimpan di DB, cukup hapus baris
			btn.closest('tr').remove();
			return;
		}

		if (confirm('Yakin ingin menghapus rekening ini?')) {
			$.ajax({
				url: '<?= base_url("/user/ssh/ssh_pengajuan/deleteRekening") ?>/' + idRekening,
				type: 'POST',
				dataType: 'json',
				success: function(res) {
					if (res.status === 'success') {
						btn.closest('tr').remove(); // Hapus baris dari DOM
					} else {
						alert('Gagal menghapus data rekening.');
					}
				},
				error: function() {
					alert('Terjadi kesalahan saat menghapus rekening.');
				}
			});
		}
	});
</script>
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
			"stateSave": true // WAJIB
		});
		$('#example2').DataTable({
			"scrollX": true,
			"scrollY": '65vh',
			"scrollCollapse": true,
			"paging": true,
			"responsive": false,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			],
			"stateSave": true // WAJIB
		});
	})
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

		modal.find('#modal_id_ssh').val(id);
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
		let id = modal.find('#modal_id_ssh').val();
		let statusBaru = $(this).data('status');
		let keterangan = modal.find('#modal_keterangan_input').val();

		$.ajax({
			url: '<?= base_url("/admin/verifikasi/data/verifikasi_ssh") ?>',
			type: 'POST',
			data: {
				id_ssh: id,
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
<!-- aksi masal -->
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
			url: '<?= base_url("/admin/verifikasi/data/verifikasi_massal_ssh") ?>',
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