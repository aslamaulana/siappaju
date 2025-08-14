<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<style>
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
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table cclass="table table-sm" cellspacing="0">
		<tr>
			<td style="width: 140px;;"><b>OPD :</b></td>
			<td><?= $opd['description']; ?></td>
		</tr>
	</table><br>
	<form action="<?= base_url('/admin/verifikasi/data/verifikasi_ssh') ?>" method="POST">
		<table class="table table-bordered table-sm" cellspacing="0">
			<tr>
				<td>
					<div style="width:120px;">
						<button type="submit" name="lolos-ceklis" class="btn btn-block btn-success btn-sm">
							<i class="nav-icon fa fa-check"></i> Terima
						</button>
					</div>
				</td>
			</tr>
		</table><br>
		<table id="example2" class="table table-bordered display nowrap table-sm" cellspacing="0">
			<thead>
				<tr style="background: antiquewhite;">
					<th class="c1"><i class="nav-icon fa fa-check"></i></th>
					<th class="c1">No</th>
					<th class="c2a">Jenis Sub rincian Objek</th>
					<th class="c4">Komponen</th>
					<th class="c5">Spesifikasi</th>
					<th class="c6">satuan</th>
					<th class="c7">harga</th>
					<th class="c8">Rekening</th>
					<th class="c8">TKDN %</th>
					<th class="c8">Kelompok</th>
					<th class="c9">Aksi</th>
				</tr>
			</thead>
			
			<tbody>
				<?php $nomor = 1;
				foreach ($ssh as $row) : ?>
					<?php $jawab = $db->table('tb_ssh_verifikasi')
						->join('auth_groups', 'tb_ssh_verifikasi.opd_id = auth_groups.id', 'left')
						->getWhere(['ssh_id' => $row['id_ssh']])->getRow();
					?>

					<tr class="">
						<td class="align-top text-center">
							<?php if (isset($jawab)) { ?>
								<?php if ($jawab->verifikasi == 'diajukan' || $jawab->verifikasi == 'edit') { ?>
									<input type='checkbox' class='check-item' name='id_ssh_ceklis[]' value='<?= $row['id_ssh']; ?>'>
								<?php } ?>
							<?php } ?>
						</td>
						<td class="align-top text-center"><?= $nomor++; ?></td>
						<td class="align-top text-wrap" title="<?= $row['kode_jenis_rincian_objek_sub']; ?>"><?= $row['jenis_rincian_objek_sub']; ?></td>
						<td class="align-top">
							<?= $row['keterangan'] == '1' ? "<b>[Data Acuan]</b> " : ""; ?>
							<?= $row['komponen']; ?></td>
						<td class="align-top"><?= $row['spesifikasi']; ?></td>
						<td class="align-top text-center"><?= $row['satuan']; ?></td>
						<td class="align-top text-right"><?= 'Rp' . number_format($row['harga'], 2, ',', '.'); ?></td>
						<td class="c8 align-top">
							<?php $rekening = $db->table('tb_ssh_rekening')->getWhere(['ssh_id' => $row['id_ssh']])->getNumRows(); ?>
							<a class="btn btn-success btn-circle btn-xs" href="<?= base_url('/admin/ssh/ssh_rekening/rekening/' . $row['id_ssh'] . '/' . $opd['id']); ?>">
								<?= $rekening . '   '; ?><i class="nav-icon fas fa-list"></i>
							</a>
						</td>
						<td class="c8 align-top"><?= $row['tkdn']; ?></td>
						<td class="c8 align-top"><?= $row['kelompok']; ?></td>
						<!-- ------------------------------------------------------------------------------------ -->

						<td class="align-top text-center">
							<!-- ------------------------------------------------------------------------------------------- -->
							<?php if (isset($jawab)) : ?>
								<div class="d-flex justify-content-center">
									<?php if ($jawab->verifikasi == 'lolos') : ?>
										<a class="dropdown-toggle btn btn-success btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Verifikasi
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
											<div class="dropdown-divider"></div>
											<form action="<?= base_url('/admin/verifikasi/data/verifikasi_ssh') ?>" method="POST">
												<textarea name="verifikasi_keterangan" class="dropdown-item form-control" placeholder="Keterangan Dikembalikan" required></textarea>
												<input type="hidden" name="id_ssh" value="<?= $row['id_ssh']; ?>">
												<button type="submit" name="dikembalikan_lolos" class="dropdown-item" style="color: white;background: #007bff;font-weight: bold;">Kembalikan</button>
											</form>
											<div class="dropdown-divider"></div>
											<form action="<?= base_url('/admin/verifikasi/data/verifikasi_ssh') ?>" method="POST">
												<textarea name="verifikasi_keterangan" class="dropdown-item form-control" placeholder="Keterangan Ditolak"></textarea>
												<input type="hidden" name="id_ssh" value="<?= $row['id_ssh']; ?>">
												<button type="submit" name="ditolak_lolos" class="dropdown-item" style="color: white;background: #dc3545;font-weight: bold;">Tolak</button>
											</form>
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
										</div>
									<?php elseif ($jawab->verifikasi == 'edit') : ?>
										<a class="dropdown-toggle btn btn-primary btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Diperbaharui
										</a>
										<div class="dropdown-menu dropdown-menu-right" style="width: 600px;" aria-labelledby="navbarDropdown">
											<h5 class="dropdown-item"> Diajukan Kembali </h5>
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
											<div class="dropdown-divider"></div>
											<form action="<?= base_url('/admin/verifikasi/data/verifikasi_ssh') ?>" method="POST">
												<input type="hidden" name="id_ssh" value="<?= $row['id_ssh']; ?>">
												<button type="submit" name="lolos_ubah" class="dropdown-item" style="color: white;background: #28a745;font-weight: bold;">Terima</button>
											</form>
											<div class="dropdown-divider"></div>
											<form action="<?= base_url('/admin/verifikasi/data/verifikasi_ssh') ?>" method="POST">
												<textarea name="verifikasi_keterangan" class="dropdown-item form-control" placeholder="Keterangan Dikembalikan" required></textarea>
												<input type="hidden" name="id_ssh" value="<?= $row['id_ssh']; ?>">
												<button type="submit" name="dikembalikan_ubah" class="dropdown-item" style="color: white;background: #007bff;font-weight: bold;">Kembalikan</button>
											</form>
											<div class="dropdown-divider"></div>
											<form action="<?= base_url('/admin/verifikasi/data/verifikasi_ssh') ?>" method="POST">
												<textarea name="verifikasi_keterangan" class="dropdown-item form-control" placeholder="Keterangan Ditolak" required></textarea>
												<input type="hidden" name="id_ssh" value="<?= $row['id_ssh']; ?>">
												<button type="submit" name="ditolak_ubah" class="dropdown-item" style="color: white;background: #dc3545;font-weight: bold;">Tolak</button>
											</form>
										</div>
									<?php elseif ($jawab->verifikasi == 'diajukan') : ?>
										<a class="dropdown-toggle btn btn-warning btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Belum Verifikasi
										</a>
										<div class="dropdown-menu dropdown-menu-right" style="width: 600px;" aria-labelledby="navbarDropdown">
											<form action="<?= base_url('/admin/verifikasi/data/verifikasi_ssh') ?>" method="POST">
												<input type="hidden" name="id_ssh" value="<?= $row['id_ssh']; ?>">
												<button type="submit" name="lolos" class="dropdown-item" style="color: white;background: #28a745;font-weight: bold;">Terima</button>
											</form>
											<div class="dropdown-divider"></div>
											<form action="<?= base_url('/admin/verifikasi/data/verifikasi_ssh') ?>" method="POST">
												<textarea name="verifikasi_keterangan" class="dropdown-item form-control" placeholder="Keterangan Dikembalikan" required></textarea>
												<input type="hidden" name="id_ssh" value="<?= $row['id_ssh']; ?>">
												<button type="submit" name="dikembalikan" class="dropdown-item" style="color: white;background: #007bff;font-weight: bold;">Kembalikan</button>
											</form>
											<div class="dropdown-divider"></div>
											<form action="<?= base_url('/admin/verifikasi/data/verifikasi_ssh') ?>" method="POST">
												<textarea name="verifikasi_keterangan" class="dropdown-item form-control" placeholder="Keterangan Ditolak" required></textarea>
												<input type="hidden" name="id_ssh" value="<?= $row['id_ssh']; ?>">
												<button type="submit" name="ditolak" class="dropdown-item" style="color: white;background: #dc3545;font-weight: bold;">Tolak</button>
											</form>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<!-- ------------------------------------------------------------------------------------------- -->
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</form>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('/toping/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-rowgroup/js/dataTables.rowGroup.min.js') ?>"></script>

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
			"scrollCollapse": true,
			"paging": false,
			"responsive": false,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			],
	});
</script>
<?= $this->endSection(); ?>