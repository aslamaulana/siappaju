<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
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
		width: 150px;
	}

	.c3 {
		width: 300px;
	}

	.c4 {
		width: 430px;
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

<?= $this->section('tombol'); ?>
<?php if (menu('ssh')->kunci != 'ya') { ?>
	<div style="width:90px;position: absolute;right: 95px;">
		<button type="button" class="btn btn-block btn-info btn-sm addBtn"
			data-toggle="modal"
			data-target="#formModal">
			<i class="nav-icon fa fa-plus"></i> Add
		</button>
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
				<th>
					Komponen
				</th>
				<th>
					Spesifikasi
				</th>
				<th class="c6">Satuan</th>
				<th class="c7">Harga</th>
				<th class="c8">TKDN %</th>
				<th class="c8">Kelompok</th>
				<th class="c1">Status</th>
				<th class="c1">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr style="background: antiquewhite;">
				<th class="c0"></th>
				<th class="c1">No</th>
				<th>
					Komponen
				</th>
				<th>
					Spesifikasi
				</th>
				<th class="c6">Satuan</th>
				<th class="c7">Harga</th>
				<th class="c8">TKDN %</th>
				<th class="c8">Kelompok</th>
				<th class="c1">Status</th>
				<th class="c1">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($ssh as $index => $row) : ?>
				<?php $jawab = $db->table('tb_ssh_verifikasi')->join('auth_groups', 'tb_ssh_verifikasi.opd_id = auth_groups.id', 'left')->getWhere(['ssh_id' => $row['id_ssh']])->getRow(); ?>
				<tr data-index="<?= $index ?>">
					<td class="text-center">
						<?php if (!isset($jawab) || $jawab->verifikasi == 'dikembalikan') : ?>
							<input type="checkbox" class="row-check" value="<?= $row['id_ssh'] ?>">
						<?php else: ?>
							<input type="checkbox" disabled>
						<?php endif ?>
					</td>
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
					<td class="c1 align-top"><?= $nomor++; ?></td>
					<td id="komponen" class="align-top text-wrap"><?= $row['komponen']; ?></td>
					<td id="spesifikasi" class="align-top text-wrap"><?= $row['spesifikasi']; ?></td>
					<td id="satuan" class="c6 align-top"><?= $row['satuan']; ?></td>
					<td id="harga" class="text-right align-top"><?= 'Rp. ' . number_format((float)$row['harga'], 2, ',', '.'); ?></td>
					<td id="tkdn" class="c6 align-top"><?= $row['tkdn']; ?></td>
					<td id="kelompok" class="text-center align-top"><?= $row['kelompok']; ?></td>

					<!-- ------------------------------------------------------------------------------------ -->
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
									data-id="<?= $row['id_ssh']; ?>"
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
										data-id="<?= $row['id_ssh']; ?>"
										data-toggle="modal"
										data-target="#formModalDetail">
										<i class="fas fa-search text-info"></i> Detail
									</button>
									<?php if (!isset($jawab) || $jawab->verifikasi == 'dikembalikan') : ?>
										<button type="button"
											class="dropdown-item btn-ajukan"
											data-id="<?= $row['id_ssh']; ?>"
											title="Ajukan Verifikasi">
											<i class="fas fa-hand-paper text-info"></i>Ajukan
										</button>
										<!-- Tombol Edit -->
										<button type="button"
											class="dropdown-item editBtn"
											data-id="<?= $row['id_ssh']; ?>"
											data-toggle="modal"
											data-target="#formModal">
											<i class="fas fa-pen-alt text-info"></i> Edit Data
										</button>
										<!-- Tombol Hapus -->
										<button type="button"
											class="dropdown-item btn-hapus"
											data-id="<?= $row['id_ssh']; ?>">
											<i class="fas fa-trash-alt text-danger"></i> Hapus Data
										</button>

									<?php endif ?>
								</div>
							</div>
						</div>
					</td>
					<!-- ------------------------------------------------------------------------------------------- -->
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<!-- --------------- -->
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
										<select name="jenis" id="jenis" class="form-control select2bs4" required>
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
							<div class="row text-center" style="background: antiquewhite;">
								<div class="col">
									<label for="itemSelectBahan" class="form-label">Rekening</label>
								</div>
							</div>
							<label for="itemSelect" class="form-label">Pilih Rekening</label>
							<div class="row">
								<div class="col-11">
									<select id="itemSelect" class="form-control select2bs4">
										<option value="">Pilih...</option>
										<?php foreach ($rek as $row) : ?>
											<option value="<?= "<input type='hidden' name='id[]' value=''><input type='hidden' name='rekening[]' value='" . $row['id_rekening_rincian_objek_sub'] . "'>" . "[" . $row['kode_rekening_rincian_objek_sub'] . "] " . $row['rekening_rincian_objek_sub']; ?>"><?= "[" . $row['kode_rekening_rincian_objek_sub'] . "] " . $row['rekening_rincian_objek_sub']; ?></option>
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
								<div class="form-group" id="komponenDetail" style="border: solid #ced4da;border-radius: 4px;padding: 10px 10px;">
								</div>
							</td>
							<td style="vertical-align: text-top;">
								<div class="form-group" id="spesifikasiDetail" style="border: solid #ced4da;border-radius: 4px;padding: 10px 10px;">
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
<script src="<?= base_url('/toping/plugins/select2/js/select2.full.min.js'); ?>"></script>
<script>
	$('.select2bs4').select2({
		theme: 'bootstrap4',
		placeholder: 'Tidak Dipilih...',
		width: '100%',
		dropdownParent: $('#formModal')
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
	$(document).ready(function() {

		// Saat tombol Tambah diklik
		$(document).on('click', '.addBtn', function() {
			$('#formModalLabel').text('Tambah Data SSH');
			$('#myForm').trigger('reset');
			$('#jenis').data('selected', '');
			// Kosongkan tabel rekening
			$('#itemsTable tbody').empty();
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
			$('#komponenDetail').text(komponen);
			$('#spesifikasiDetail').text(spesifikasi);

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
					url: '<?= base_url("/user/ssh/ssh_pengajuan/ssh_hapus/") ?>/' + id,
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
					url: '<?= base_url("/user/verifikasi/data/ajukan_ssh/") ?>/' + id,
					type: 'POST',
					success: function(res) {
						// Ganti tombol menjadi "Menunggu Verifikasi"
						// $btn.removeClass('btn-primary')
						// 	.addClass('btn-warning')
						// 	.html('Menunggu');
						$btn.removeClass('btn-primary')
							.addClass('btn-warning')
							.html('<i class="nav-icon fas fa-cog fa-spin"></i>');

					},
					error: function() {
						alert('Gagal mengajukan verifikasi!');
					}
				});
			}
		});

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
					url: '<?= base_url("/user/verifikasi/data/ajukan_ssh_multiple") ?>',
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