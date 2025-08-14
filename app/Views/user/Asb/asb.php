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
		width: 160px;
		text-align: center;
	}
</style>
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('asb')->kunci != 'ya') { ?>
	<div style="width:90px;position: absolute;right: 0px;">
		<a href="<?= base_url('/user/asb/asb/asb_add'); ?>">
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
				<th class="c2">HSPK</th>
				<th class="c4">Total</th>
				<th class="c5">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr style="background: antiquewhite;">
				<th class="c1">No</th>
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
					<td><?= $row['asb_paket']; ?></td>
					<td><?= $row['asb_spesifikasi']; ?></td>
					<td class="c2"><?= $row['asb_satuan']; ?></td>
					<td class="c2">
						<?php $komponen = $db->table('tb_asb_hspk')->getWhere(['asb_id' => $row['id_asb']])->getNumRows(); ?>
						<a class="btn btn-success btn-circle btn-xs" href="<?= base_url('/user/asb/asb_hspk/asb/' . $row['id_asb']); ?>">
							<?= $komponen . '   '; ?><i class="nav-icon fas fa-list"></i>
						</a>
					</td>

					<?php foreach ($asb_hspk->Where(['tb_asb_hspk.asb_id' => $row['id_asb']])->findAll() as $rot) : ?>
						<?php
						$A[$rot['id_asb_hspk']][] = $db->table('tb_hspk_komponen')
							->select('SUM(tb_hspk_komponen.index * tb_ssh.harga) AS total')
							->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')
							->getWhere(['tb_hspk_komponen.hspk_id' => $rot['hspk_id']])->getRowArray()['total'];
						?>
						<?php $total[$row['id_asb']][] = array_sum($A[$rot['id_asb_hspk']]) * $rot['jumlah']; ?>
					<?php endforeach ?>
					<!-- ------------------------------------------------------------------------------------ -->
					<td class="text-right">
						<?= isset($total[$row['id_asb']]) ? number_format((float)array_sum($total[$row['id_asb']]), 2, ',', '.') : '-'; ?>
					</td>

					<!-- ---------------------------------------verifikasi----------------------------------- -->
					<td class="text-center align-baseline">
						<div class="justify-content-center">
							<?php $jawab = $db->table('tb_asb_verifikasi')->join('auth_groups', 'tb_asb_verifikasi.opd_id = auth_groups.id', 'left')->getWhere(['asb_id' => $row['id_asb']])->getRow();
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
										<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/asb/asb/asb_edit/' . $row['id_asb']; ?>">
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
											<form action="<?= base_url('/user/verifikasi/data/ajukan_asb_ulang/') ?>" method="POST">
												<input type="hidden" name="id_asb" value="<?= $row['id_asb']; ?>">
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
								<!-- ------------------------------------------------------------------------------------------- -->
								<?php if (menu('asb')->kunci != 'ya') { ?>
									<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/asb/asb/asb_edit/' . $row['id_asb']; ?>">
										<i class="nav-icon fas fa-pen-alt"></i>
									</a>
									<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/asb/asb/asb_hapus/' . $row['id_asb']; ?>'}" href="#">
										<i class="nav-icon fas fa-trash-alt"></i>
									</a>
									<!-- ------------------------------------------------------------------------------------------- -->
									<a class="btn btn-success btn-circle btn-xs" onclick="if(confirm('Ajukan Verifikasi ??')){location.href='<?= base_url() . '/user/verifikasi/data/ajukan_asb/' . $row['id_asb']; ?>'}">
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
					<!-- <td class="text-center align-baseline"> -->
					<!-- ------------------------------------------------------------------------------------------- -->
					<!-- <a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/asb/asb/asb_edit/' . $row['id_asb']; ?>">
							<i class="nav-icon fas fa-pen-alt"></i>
						</a>
						<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/asb/asb/asb_hapus/' . $row['id_asb']; ?>'}" href="#">
							<i class="nav-icon fas fa-trash-alt"></i>
						</a> -->
					<!-- ------------------------------------------------------------------------------------------- -->
					<!-- </td> -->
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