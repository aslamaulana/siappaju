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

	.c2a {
		width: 300px;
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
		width: 160px;
		text-align: center;
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
	<table id="example1" class="table table-bordered table-sm">
		<thead>
			<tr class="">
				<th class="c1">No</th>
				<th class="c2a">Jenis Sub rincian Objek</th>
				<th class="">Paket</th>
				<th class="">Spesifikasi</th>
				<th class="c2">Satuan</th>
				<th class="c2">HSPK</th>
				<th class="c4">Total</th>
				<th class="c5">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="c1">No</th>
				<th class="c2a">Jenis Sub rincian Objek</th>
				<th>Paket</th>
				<th class="">Spesifikasi</th>
				<th class="c2">Satuan</th>
				<th class="c2">HSPK</th>
				<th class="c4">Total</th>
				<th class="c5">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($asb as $row) : ?>
				<tr class="">
					<td class="c1"><?= $nomor++; ?></td>
					<td class="align-top text-wrap" title="<?= $row['kode_jenis_rincian_objek_sub']; ?>"><?= $row['jenis_rincian_objek_sub']; ?></td>
					<td class="align-top"><?= $row['asb_paket']; ?></td>
					<td class="align-top"><?= $row['asb_spesifikasi']; ?></td>
					<td class="c2 align-top"><?= $row['asb_satuan']; ?></td>
					<td class="c2 align-top">
						<?php $komponen = $db->table('tb_asb_hspk')->getWhere(['asb_id' => $row['id_asb']])->getNumRows(); ?>
						<a class="btn btn-success btn-circle btn-xs" href="<?= base_url('/admin/asb/asb_hspk/asb/' . $row['id_asb'] . '/' . $opd_id); ?>">
							<?= $komponen . '   '; ?><i class="nav-icon fas fa-list"></i>
						</a>
					</td>
					<?php $hspk = $db->table('tb_asb_hspk')->select('tb_asb_hspk.*')->getWhere(['tb_asb_hspk.tahun' => $_SESSION['tahun'], 'tb_asb_hspk.asb_id' => $row['id_asb']])->getResultArray();
					foreach ($hspk as $rot) :
						$A = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $rot['hspk_id'], 'tb_hspk_komponen.group' => 'A'])->getResultArray();
						$B = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $rot['hspk_id'], 'tb_hspk_komponen.group' => 'B'])->getResultArray();
						$C = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $rot['hspk_id'], 'tb_hspk_komponen.group' => 'C'])->getResultArray();

						foreach ($A as $roA) :
							$num[$rot['hspk_id'] . $row['id_asb'] . 'A'][] = ($roA['harga'] * $roA['index']);
						endforeach;
						foreach ($B as $roB) :
							$num[$rot['hspk_id'] . $row['id_asb'] . 'B'][] = ($roB['harga'] * $roB['index']);
						endforeach;
						foreach ($C as $roC) :
							$num[$rot['hspk_id'] . $row['id_asb'] . 'C'][] = ($roC['harga'] * $roC['index']);
						endforeach;
						isset($num[$rot['hspk_id'] . $row['id_asb'] . 'A']) ? $AA = ($num[$rot['hspk_id'] . $row['id_asb'] . 'A']) : $AA = ['0'];
						isset($num[$rot['hspk_id'] . $row['id_asb'] . 'B']) ? $BB = ($num[$rot['hspk_id'] . $row['id_asb'] . 'B']) : $BB = ['0'];
						isset($num[$rot['hspk_id'] . $row['id_asb'] . 'C']) ? $CC = ($num[$rot['hspk_id'] . $row['id_asb'] . 'C']) : $CC = ['0'];
						$nud[$row['id_asb']][] = (array_sum($AA) + array_sum($BB) + array_sum($CC)) * $rot['jumlah'];
					endforeach; ?>
					<!-- ------------------------------------------------------------------------------------ -->
					<td class="text-right align-top">
						<?= isset($nud[$row['id_asb']]) ? number_format(array_sum($nud[$row['id_asb']]), 2, ',', '.') : '-'; ?>
					</td>
					<!-- ---------------------------------------verifikasi----------------------------------- -->
					<td class="align-baseline text-center">
						<!-- ------------------------------------------------------------------------------------------- -->
						<?php $jawab = $db->table('tb_asb_verifikasi')->join('auth_groups', 'tb_asb_verifikasi.opd_id = auth_groups.id', 'left')->getWhere(['asb_id' => $row['id_asb']])->getRow();
						if (isset($jawab)) : ?>
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
										<form action="<?= base_url('/admin/verifikasi/data/verifikasi_asb') ?>" method="POST">
											<textarea name="verifikasi_keterangan" class="dropdown-item form-control" placeholder="Keterangan Dikembalikan" required></textarea>
											<input type="hidden" name="id_asb" value="<?= $row['id_asb']; ?>">
											<button type="submit" name="dikembalikan_lolos" class="dropdown-item" style="color: white;background: #007bff;font-weight: bold;">Kembalikan</button>
										</form>
										<div class="dropdown-divider"></div>
										<form action="<?= base_url('/admin/verifikasi/data/verifikasi_asb') ?>" method="POST">
											<textarea name="verifikasi_keterangan" class="dropdown-item form-control" placeholder="Keterangan Ditolak"></textarea>
											<input type="hidden" name="id_asb" value="<?= $row['id_asb']; ?>">
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
										<form action="<?= base_url('/admin/verifikasi/data/verifikasi_asb') ?>" method="POST">
											<input type="hidden" name="id_asb" value="<?= $row['id_asb']; ?>">
											<button type="submit" name="lolos_ubah" class="dropdown-item" style="color: white;background: #28a745;font-weight: bold;">Terima</button>
										</form>
										<div class="dropdown-divider"></div>
										<form action="<?= base_url('/admin/verifikasi/data/verifikasi_asb') ?>" method="POST">
											<textarea name="verifikasi_keterangan" class="dropdown-item form-control" placeholder="Keterangan Dikembalikan" required></textarea>
											<input type="hidden" name="id_asb" value="<?= $row['id_asb']; ?>">
											<button type="submit" name="dikembalikan_ubah" class="dropdown-item" style="color: white;background: #007bff;font-weight: bold;">Kembalikan</button>
										</form>
										<div class="dropdown-divider"></div>
										<form action="<?= base_url('/admin/verifikasi/data/verifikasi_asb') ?>" method="POST">
											<textarea name="verifikasi_keterangan" class="dropdown-item form-control" placeholder="Keterangan Ditolak" required></textarea>
											<input type="hidden" name="id_asb" value="<?= $row['id_asb']; ?>">
											<button type="submit" name="ditolak_ubah" class="dropdown-item" style="color: white;background: #dc3545;font-weight: bold;">Tolak</button>
										</form>
									</div>
								<?php elseif ($jawab->verifikasi == 'diajukan') : ?>
									<a class="dropdown-toggle btn btn-warning btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Belum Verifikasi
									</a>
									<div class="dropdown-menu dropdown-menu-right" style="width: 600px;" aria-labelledby="navbarDropdown">
										<form action="<?= base_url('/admin/verifikasi/data/verifikasi_asb') ?>" method="POST">
											<input type="hidden" name="id_asb" value="<?= $row['id_asb']; ?>">
											<button type="submit" name="lolos" class="dropdown-item" style="color: white;background: #28a745;font-weight: bold;">Terima</button>
										</form>
										<div class="dropdown-divider"></div>
										<form action="<?= base_url('/admin/verifikasi/data/verifikasi_asb') ?>" method="POST">
											<textarea name="verifikasi_keterangan" class="dropdown-item form-control" placeholder="Keterangan Dikembalikan" required></textarea>
											<input type="hidden" name="id_asb" value="<?= $row['id_asb']; ?>">
											<button type="submit" name="dikembalikan" class="dropdown-item" style="color: white;background: #007bff;font-weight: bold;">Kembalikan</button>
										</form>
										<div class="dropdown-divider"></div>
										<form action="<?= base_url('/admin/verifikasi/data/verifikasi_asb') ?>" method="POST">
											<textarea name="verifikasi_keterangan" class="dropdown-item form-control" placeholder="Keterangan Ditolak" required></textarea>
											<input type="hidden" name="id_asb" value="<?= $row['id_asb']; ?>">
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
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});
	});
</script>
<?= $this->endSection(); ?>