<!DOCTYPE html>
<html lang="">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css">
		.c25 {
			border-spacing: 0;
			border-collapse: collapse;
			margin-right: auto;
			width: 100%;
			font-size: 11px;
		}

		.c28 {
			border-right-style: solid;
			padding: 5pt 5pt 5pt 5pt;
			border-bottom-color: #000000;
			border-top-width: 1.2pt;
			border-right-width: 1.2pt;
			border-left-color: #000000;
			vertical-align: middle;
			border-right-color: #000000;
			border-left-width: 1.2pt;
			border-top-style: solid;
			border-left-style: solid;
			border-bottom-width: 1.2pt;
			text-align: center;
			border-top-color: #000000;
			border-bottom-style: solid
		}

		.c29 {
			padding: 5pt 5pt 5pt 5pt;
			border-color: #000000;
			vertical-align: top;
			border-width: 0.7pt;
			border-style: solid;
		}

		.c30 {
			text-align: center;
		}

		.c31 {
			text-align: right;
		}
	</style>
</head>
<table>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Filter</td>
		<td>Filter</td>
		<td>Filter</td>
	</tr>
</table>
<?php foreach ($hspk as $row) : ?>
	<table>
		<tbody>
			<tr>
				<td colspan="9"><?= $row['description']; ?></td>
				<td></td>
				<td>OPD</td>
				<td></td>
			</tr>
			<?php $rincian_objek = $db->table('tb_hspk')->DISTINCT('tb_hspk.id_hspk')->select('tb_jenis_rincian_objek_sub.jenis_rincian_objek_sub')->select('tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub')->join('tb_jenis_rincian_objek_sub', 'tb_hspk.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')->join('tb_verifikasi', 'tb_hspk.id_hspk = tb_verifikasi.hspk_id', 'LEFT')->getWhere(['tb_hspk.opd_id' => $row['opd_id'], 'tb_hspk.tahun' => $_SESSION['tahun'], 'tb_verifikasi.verifikasi' => 'lolos'])->getResultArray(); ?>
			<?php foreach ($rincian_objek as $ros) : ?>
				<tr>
					<td></td>
					<td colspan="8"><?= $ros['jenis_rincian_objek_sub']; ?></td>
					<td></td>
					<td>Rincian_sub_objek</td>
				</tr>
				<?php $hspk = $db->table('tb_hspk')->select('tb_hspk.*')->join('tb_verifikasi', 'tb_hspk.id_hspk = tb_verifikasi.hspk_id', 'LEFT')->getWhere(['tb_hspk.jenis_rincian_objek_sub_id' => $ros['id_jenis_rincian_objek_sub'], 'tb_hspk.tahun' => $_SESSION['tahun'], 'tb_verifikasi.verifikasi' => 'lolos', 'tb_hspk.opd_id' => $row['opd_id']])->getResultArray(); ?>
				<?php foreach ($hspk as $rol) : ?>
					<tr>
						<td></td>
						<td></td>
						<td colspan="7"><?= $rol['hspk_paket']; ?><?= isset($rol['hspk_satuan']) ?  ' - (' . $rol['hspk_satuan'] . ')' : ''; ?></td>
						<td></td>
						<td>hspk</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td class="c28" width="0.5cm"><b>No</b></td>
						<td class="c28" width="0.5cm"><b>Komponen</b></td>
						<td class="c28" width="40px"><b>Spesifikasi</b></td>
						<td class="c28" width="40px"><b>Satuan</b></td>
						<td class="c28" width="60px"><b>Koefisien</b></td>
						<td class="c28" width="60px"><b>Harga Satuan (Rp)</b></td>
						<td class="c28" width="60px"><b>Jumlah Harga (Rp)</b></td>
						<td></td>
						<td>Judul</td>
					</tr>
					<tr class="font-weight-bold">
						<td></td>
						<td></td>
						<td>A</td>
						<td colspan="6">Tenaga Kerja</td>
						<td></td>
						<td>Tenaga_kerja</td>
					</tr>
					<?php $no = 1;
					$hspk_komponen = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.*')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.hspk_id' => $rol['id_hspk'], 'tb_hspk_komponen.group' => 'A'])->getResultArray(); ?>
					<?php foreach ($hspk_komponen as $rox) : ?>
						<tr>
							<td></td>
							<td></td>
							<td><?= $nn = $no++ ?></td>
							<td><?= $rox['komponen']; ?></td>
							<td><?= $rox['spesifikasi']; ?></td>
							<td><?= $rox['satuan']; ?></td>
							<td><?= $rox['index']; ?></td>
							<td><?= number_format($rox['harga'], 2, ',', '.'); ?></td>
							<td>
								<?= number_format(($rox['harga'] * $rox['index']), 2, ',', '.'); ?>
								<?php $num[$rol['id_hspk'] . 'A'][] = ($rox['harga'] * $rox['index']); ?>
							</td>
							<td></td>
							<td></td>
							<td>Tenaga_kerja<?= $nn; ?></td>
						</tr>
					<?php endforeach; ?>
					<tr>
						<td></td>
						<td></td>
						<td colspan="6" class="text-right">Jumlah Harga Tenaga Kerja</td>
						<td class="text-right"><?= isset($num[$rol['id_hspk'] . 'A']) ? number_format(array_sum($num[$rol['id_hspk'] . 'A']), 2, ',', '.') : '-'; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Total_Tenaga_kerja</td>
					</tr>
					<tr class="font-weight-bold">
						<td></td>
						<td></td>
						<td>B</td>
						<td colspan="6">Bahan</td>
						<td></td>
						<td>Bahan</td>
					</tr>
					<?php $no = 1;
					$hspk_komponen = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.*')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.hspk_id' => $rol['id_hspk'], 'tb_hspk_komponen.group' => 'B'])->getResultArray(); ?>
					<?php foreach ($hspk_komponen as $rox) : ?>
						<tr>
							<td></td>
							<td></td>
							<td><?= $nn = $no++ ?></td>
							<td><?= $rox['komponen']; ?></td>
							<td><?= $rox['spesifikasi']; ?></td>
							<td><?= $rox['satuan']; ?></td>
							<td><?= $rox['index']; ?></td>
							<td><?= number_format($rox['harga'], 2, ',', '.'); ?></td>
							<td>
								<?= number_format(($rox['harga'] * $rox['index']), 2, ',', '.'); ?>
								<?php $num[$rol['id_hspk'] . 'B'][] = ($rox['harga'] * $rox['index']); ?>
							</td>
							<td></td>
							<td></td>
							<td>Bahan<?= $nn; ?></td>
						</tr>
					<?php endforeach; ?>
					<tr>
						<td></td>
						<td></td>
						<td colspan="6" class="text-right">Jumlah Harga Bahan</td>
						<td class="text-right"><?= isset($num[$rol['id_hspk'] . 'B']) ? number_format(array_sum($num[$rol['id_hspk'] . 'B']), 2, ',', '.') : '-'; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Total_Bahan</td>
					</tr>
					<tr class="font-weight-bold">
						<td></td>
						<td></td>
						<td>C</td>
						<td colspan="6">Peralatan</td>
						<td></td>
						<td>Peralatan</td>
					</tr>
					<?php $no = 1;
					$hspk_komponen = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.*')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.hspk_id' => $rol['id_hspk'], 'tb_hspk_komponen.group' => 'C'])->getResultArray(); ?>
					<?php foreach ($hspk_komponen as $rox) : ?>
						<tr>
							<td></td>
							<td></td>
							<td><?= $nn = $no++ ?></td>
							<td><?= $rox['komponen']; ?></td>
							<td><?= $rox['spesifikasi']; ?></td>
							<td><?= $rox['satuan']; ?></td>
							<td><?= $rox['index']; ?></td>
							<td><?= number_format($rox['harga'], 2, ',', '.'); ?></td>
							<td>
								<?= number_format(($rox['harga'] * $rox['index']), 2, ',', '.'); ?>
								<?php $num[$rol['id_hspk'] . 'C'][] = ($rox['harga'] * $rox['index']); ?>
							</td>
							<td></td>
							<td></td>
							<td>Peralatan<?= $nn; ?></td>
						</tr>
					<?php endforeach; ?>
					<tr>
						<td></td>
						<td></td>
						<td colspan="6" class="text-right">Jumlah Peralatan</td>
						<td class="text-right"><?= isset($num[$rol['id_hspk'] . 'C']) ? number_format(array_sum($num[$rol['id_hspk'] . 'C']), 2, ',', '.') : '-'; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Total_Peralatan</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td class="text-center">D</td>
						<td colspan="5">Jumlah Harga Tenaga Kerja, Bahan dan Peralatan (A+B+C)</td>
						<td class="text-right">
							<?php
							isset($num[$rol['id_hspk'] . 'A']) ? $AA = ($num[$rol['id_hspk'] . 'A']) : $AA = ['0'];
							isset($num[$rol['id_hspk'] . 'B']) ? $BB = ($num[$rol['id_hspk'] . 'B']) : $BB = ['0'];
							isset($num[$rol['id_hspk'] . 'C']) ? $CC = ($num[$rol['id_hspk'] . 'C']) : $CC = ['0'];
							echo number_format((array_sum($AA) + array_sum($BB) + array_sum($CC)), 2, ',', '.');
							?>
						</td>
						<td></td>
						<td></td>
						<td></td>
						<td>(A+B+C)</td>
					</tr>
					<tr>
						<td colspan="9">&nbsp;</td>
					</tr>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endforeach; ?>

</html>