<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<style>
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
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('ssh')->kunci != 'ya') { ?>
	<div style="width:90px;position: absolute;right: 0px;">
		<a href="<?= base_url('/user/ssh/ssh_pengajuan/pengajuan_add'); ?>">
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
		</a>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModal">
			Add
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
				<th class="c1">No</th>
				<th class="c4">
					<div style="width: 500px;">Komponen</div>
				</th>
				<th class="c5">
					<div style="width: 500px;">Spesifikasi</div>
				</th>
				<th class="c6">Satuan</th>
				<th class="c7">Harga</th>
				<th class="c8">Rekening</th>
				<th class="c8">TKDN %</th>
				<th class="c8">Kelompok</th>
				<th class="c9">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr style="background: antiquewhite;">
				<th class="c1">No</th>
				<th class="c4">
					<div style="width: 500px;">Komponen</div>
				</th>
				<th class="c5">
					<div style="width: 500px;">Spesifikasi</div>
				</th>
				<th class="c6">Satuan</th>
				<th class="c7">Harga</th>
				<th class="c8">Rekening</th>
				<th class="c8">TKDN %</th>
				<th class="c8">Kelompok</th>
				<th class="c9">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($ssh as $row) : ?>
				<tr class="">
					<td class="c1 align-top"><?= $nomor++; ?></td>
					<td class="align-top text-wrap">
						<?= $row['keterangan'] == '1' ? "<b>[Data Awal]</b> " : ""; ?>
						<?= $row['komponen']; ?>
					</td>
					<td class="align-top text-wrap"><?= $row['spesifikasi']; ?></td>
					<td class="c6 align-top"><?= $row['satuan']; ?></td>
					<td class="text-right align-top"><?= 'Rp. ' . number_format((float)$row['harga'], 2, ',', '.'); ?></td>
					<td class="c8 align-top">
						<?php $rekening = $db->table('tb_ssh_rekening')->getWhere(['ssh_id' => $row['id_ssh']])->getNumRows(); ?>
						<a class="btn btn-success btn-circle btn-xs" href="<?= base_url('/user/ssh/ssh_rekening/rekening/' . $row['id_ssh']); ?>">
							<?= $rekening . '   '; ?><i class="nav-icon fas fa-list"></i>
						</a>
					</td>
					<td class="c6 align-top"><?= $row['tkdn']; ?></td>
					<td class="text-center align-top"><?= $row['kelompok']; ?></td>

					<!-- ------------------------------------------------------------------------------------ -->
					<td class="text-center align-baseline">
						<div class="justify-content-center">
							<?php $jawab = $db->table('tb_ssh_verifikasi')->join('auth_groups', 'tb_ssh_verifikasi.opd_id = auth_groups.id', 'left')->getWhere(['ssh_id' => $row['id_ssh']])->getRow();
							if (isset($jawab)) :
							?>
								<?php if ($jawab->verifikasi == 'lolos') : ?>
									<a class="dropdown-toggle btn btn-success btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Lolos Verifikasi
									</a>
									<div class="dropdown-menu dropdown-menu-right" style="width: 600px;" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="#">
											<div class="media">
												<div class="media-body">
													<h3 class="dropdown-item-title">
														Verifikator:
													</h3>
													<p class="text-sm"><?= $jawab->nm_verifikator; ?></p>
												</div>
											</div>
										</a>
									</div>
								<?php elseif ($jawab->verifikasi == 'ditolak') : ?>
									<a class="dropdown-toggle btn btn-danger btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Ditolak
									</a>
									<div class="dropdown-menu dropdown-menu-right" style="width: 600px;" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="#">
											<div class="media">
												<div class="media-body">
													<h3 class="dropdown-item-title">
														Keterangan:
													</h3>
													<p class="text-sm" style="white-space: pre-wrap;"><?= $jawab->verifikasi_keterangan; ?></p>
													<h3 class="dropdown-item-title">
														Verifikator:
													</h3>
													<p class="text-sm"><?= $jawab->nm_verifikator; ?></p>
												</div>
											</div>
										</a>
									</div>
								<?php elseif ($jawab->verifikasi == 'dikembalikan') : ?>
									<!-- --------------------------------------------------------------------- -->
									<?php if (menu('ssh')->kunci != 'ya') { ?>
										<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/ssh/ssh_pengajuan/pengajuan_edit/' . $row['id_ssh']; ?>">
											<i class="nav-icon fas fa-pen-alt"></i>
										</a>
									<?php } ?>
									<!-- --------------------------------------------------------------------- -->
									<a class="dropdown-toggle btn btn-danger btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Dikembalikan
									</a>
									<div class="dropdown-menu dropdown-menu-right" style="width: 600px;" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="#">
											<div class="media">
												<div class="media-body">
													<h3 class="dropdown-item-title">
														Keterangan:
													</h3>
													<p class="text-sm" style="white-space: pre-wrap;"><?= $jawab->verifikasi_keterangan; ?></p>
													<h3 class="dropdown-item-title">
														Verifikator:
													</h3>
													<p class="text-sm"><?= $jawab->nm_verifikator; ?></p>
												</div>
											</div>
										</a>
										<?php if (menu('ssh')->kunci != 'ya') { ?>
											<div class="dropdown-divider"></div>
											<form action="<?= base_url('/user/verifikasi/data/ajukan_ssh_ulang/') ?>" method="POST">
												<input type="hidden" name="id_ssh" value="<?= $row['id_ssh']; ?>">
												<button type="submit" name="ajukan_kembali" class="dropdown-item" style="color: white;background: green;font-weight: bold;"> Ajukan Kembali</button>
											</form>
										<?php } ?>
									</div>
								<?php elseif ($jawab->verifikasi == 'edit') : ?>
									<a class="dropdown-toggle btn btn-primary btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Diperbaharui
									</a>
									<div class="dropdown-menu dropdown-menu-right" style="width: 600px;" aria-labelledby="navbarDropdown">
										<h6 class="dropdown-item"> Diajukan Kembali : Menunggu verifikasi ulang </h6>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">
											<div class="media">
												<div class="media-body">
													<h3 class="dropdown-item-title">
														Keterangan:
													</h3>
													<p class="text-sm" style="white-space: pre-wrap;"><?= $jawab->verifikasi_keterangan; ?></p>
													<h3 class="dropdown-item-title">
														Verifikator:
													</h3>
													<p class="text-sm"><?= $jawab->nm_verifikator; ?></p>
												</div>
											</div>
										</a>
									</div>
								<?php elseif ($jawab->verifikasi == 'perbup_edit') : ?>
									<!-- ------------------------------------------------------------------------------------------- -->
									<?php if (menu('ssh')->kunci != 'ya') { ?>
										<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/ssh/ssh_pengajuan/pengajuan_edit/' . $row['id_ssh']; ?>">
											<i class="nav-icon fas fa-pen-alt"></i>
										</a>
										<!-- ------------------------------------------------------------------------------------------- -->
										<a class="btn btn-success btn-circle btn-xs" onclick="if(confirm('Ajukan Verifikasi ??')){location.href='<?= base_url() . '/user/verifikasi/data/ajukan_ssh/' . $row['id_ssh']; ?>'}">
											Ajukan Verifikasi
										</a>
									<?php } else { ?>
										<a class="btn btn-success btn-circle btn-xs">
											<i class="nav-icon fa fa-lock"></i> Ajukan Verifikasi
										</a>
									<?php } ?>
								<?php elseif ($jawab->verifikasi == 'diajukan') : ?>
									<a class="dropdown-toggle btn btn-warning btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Menunggu Verifikasi
									</a>
								<?php endif; ?>
							<?php else : ?>
								<!-- ------------------------------------------------------------------------------------------- -->
								<?php if (menu('ssh')->kunci != 'ya') { ?>
									<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/ssh/ssh_pengajuan/pengajuan_edit/' . $row['id_ssh']; ?>">
										<i class="nav-icon fas fa-pen-alt"></i>
									</a>
									<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/ssh/ssh_pengajuan/ssh_hapus/' . $row['id_ssh']; ?>'}" href="#">
										<i class="nav-icon fas fa-trash-alt"></i>
									</a>
									<!-- ------------------------------------------------------------------------------------------- -->
									<a class="btn btn-success btn-circle btn-xs" onclick="if(confirm('Ajukan Verifikasi ??')){location.href='<?= base_url() . '/user/verifikasi/data/ajukan_ssh/' . $row['id_ssh']; ?>'}">
										Ajukan Verifikasi
									</a>
								<?php } else { ?>
									<a class="btn btn-success btn-circle btn-xs">
										<i class="nav-icon fa fa-lock"></i> Ajukan Verifikasi
									</a>
								<?php } ?>
							<?php endif; ?>
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
										<input type="hidden" name="type" id="type">
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
				<!-- Footer -->
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
<script src="<?= base_url('/toping/plugins/select2/js/select2.full.min.js'); ?>"></script>
<script>
	$(function() {

		$('.select2bs4').select2({
			width: 'resolve',
			theme: 'bootstrap4',
			placeholder: 'Tidak Dipilih...'
		})
	});
</script>
<script>
	$('#jenis').change(function() {
		var id = $(this).val();
		$.ajax({
			url: "<?php echo base_url('user/ssh/ssh_pengajuan/AmbilSubRincianObjekFilter'); ?>",
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
</script>
<script>
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
	$(function() {
		bsCustomFileInput.init();
	});
	$(function() {
		$("#example1").DataTable({
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
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
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			],
		});
	});
</script>
<?= $this->endSection(); ?>