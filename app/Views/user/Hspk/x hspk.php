<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<style>
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
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('hspk')->kunci != 'ya') { ?>
	<div style="width:90px;position: absolute;right: 0px;">
		<a href="<?= base_url('/user/hspk/hspk/hspk_add'); ?>">
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
		</a>
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
				<th class="">Paket</th>
				<th class="">Spesifikasi</th>
				<th class="c2">Satuan</th>
				<th class="c4">Total</th>
				<th class="c1">Status</th>
				<th class="c5">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr style="background: antiquewhite;">
				<th class="c1">No</th>
				<th class="">Paket</th>
				<th class="">Spesifikasi</th>
				<th class="c2">Satuan</th>
				<th class="c4">Total</th>
				<th class="c1">Status</th>
				<th class="c5">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($hspk as $row) : ?>
				<?php $jawab = $db->table('tb_verifikasi')->join('auth_groups', 'tb_verifikasi.opd_id = auth_groups.id', 'left')->getWhere(['hspk_id' => $row['id_hspk']])->getRow(); ?>
				<tr>
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
							<?php if (isset($jawab)) : ?>
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
									<?php if (menu('hspk')->kunci != 'ya') { ?>
										<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/hspk/hspk/hspk_edit/' . $row['id_hspk']; ?>">
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
										<?php if (menu('hspk')->kunci != 'ya') { ?>
											<div class="dropdown-divider"></div>
											<form action="<?= base_url('/user/verifikasi/data/ajukan_ulang/') ?>" method="POST">
												<input type="hidden" name="id_hspk" value="<?= $row['id_hspk']; ?>">
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
								<?php elseif ($jawab->verifikasi == 'diajukan') : ?>
									<a class="dropdown-toggle btn btn-warning btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Menunggu Verifikasi
									</a>
								<?php endif; ?>
							<?php else : ?>
								<?php if (menu('hspk')->kunci != 'ya') { ?>
									<!-- ------------------------------------------------------------------------------------ -->
									<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/hspk/hspk/hspk_edit/' . $row['id_hspk']; ?>">
										<i class="nav-icon fas fa-pen-alt"></i>
									</a>
									<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/hspk/hspk/hspk_hapus/' . $row['id_hspk']; ?>'}" href="#">
										<i class="nav-icon fas fa-trash-alt"></i>
									</a>
									<!-- ------------------------------------------------------------------------------------------- -->
									<a class="btn btn-success btn-circle btn-xs" onclick="if(confirm('Ajukan Verifikasi ??')){location.href='<?= base_url() . '/user/verifikasi/data/ajukan/' . $row['id_hspk']; ?>'}">
										Ajukan Verifikasi
									</a>
								<?php } else { ?>
									<a class="btn btn-success btn-circle btn-xs">
										<i class="nav-icon fa fa-lock"></i> Ajukan Verifikasi
									</a>
								<?php } ?>
							<?php endif; ?>
							<!-- ------------------------------------------------------------------------------------------- -->
						</div>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
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

<?= $this->endSection(); ?>