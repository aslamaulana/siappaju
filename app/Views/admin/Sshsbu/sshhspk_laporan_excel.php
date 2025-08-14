<!DOCTYPE html>
<html lang="">
<table>
	<tbody>
		<tr>
			<td><b>Dibuat</b></td>
			<td><b>Diubah</b></td>
			<td><b>Virifikasi</b></td>
			<td><b>Virifikasi Ubah</b></td>
			<td><b>Kode Rincian Objek</b></td>
			<td><b>Sub Rincian Objek</b></td>
			<td><b>Komponen</b></td>
			<td><b>Spesifikasi</b></td>
			<td><b>Satuan</b></td>
			<td><b>Harga</b></td>
			<td><b>Kelompok</b></td>
			<td><b>Kelompok_id</b></td>
			<td><b>OPD</b></td>
			<td><b>Kelompok Berdasarkan Kode Sub Rincian Objek</b></td>
			<td><b>Kelompok_id</b></td>
			<td><b>Rekening 1</b></td>
			<td><b>Rekening 2</b></td>
			<td><b>Rekening 3</b></td>
			<td><b>Rekening 4</b></td>
			<td><b>Rekening 5</b></td>
			<td><b>Rekening 6</b></td>
			<td><b>Rekening 7</b></td>
			<td><b>Rekening 8</b></td>
			<td><b>Rekening 9</b></td>
			<td><b>Rekening 10</b></td>
			<td><b>Rekening 11</b></td>
			<td><b>Rekening 12</b></td>
			<td><b>Rekening 13</b></td>
			<td><b>Rekening 14</b></td>
			<td><b>Rekening 15</b></td>
			<td><b>Rekening 16</b></td>
			<td><b>Rekening 17</b></td>
			<td><b>Rekening 18</b></td>
			<td><b>Rekening 19</b></td>
			<td><b>Rekening 20</b></td>
		</tr>
		<?php $ssh = $db->table('tb_ssh')
			->select('tb_ssh.*')
			->select('tb_jenis_rincian_objek_sub.jenis_rincian_objek_sub')
			->select('tb_jenis_rincian_objek_sub.kode_jenis_rincian_objek_sub')
			->select('tb_jenis_rincian_objek_sub.kelompok_id as kelompok_asli')
			->select('auth_groups.name')
			->select('tb_ssh_verifikasi.created_at as created_at_v')
			->select('tb_ssh_verifikasi.updated_at as updated_at_v')
			->join('tb_jenis_rincian_objek_sub', 'tb_ssh.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')
			->join('auth_groups', 'tb_ssh.opd_id = auth_groups.id', 'LEFT')
			->join('tb_ssh_verifikasi', 'tb_ssh.id_ssh = tb_ssh_verifikasi.ssh_id', 'LEFT')
			->getWhere(['tb_ssh.opd_id' => $opd, 'tb_ssh.tahun' => $_SESSION['tahun'], 'verifikasi' => 'lolos'])->getResultArray(); ?>
		<?php foreach ($ssh as $rox) : ?>
			<tr>
				<td><?= $rox['created_at']; ?></td>
				<td><?= $rox['updated_at']; ?></td>
				<td><?= $rox['created_at_v']; ?></td>
				<td><?= $rox['updated_at_v']; ?></td>
				<td><?= $rox['kode_jenis_rincian_objek_sub']; ?></td>
				<td><?= $rox['jenis_rincian_objek_sub']; ?></td>
				<td><?= $rox['komponen']; ?></td>
				<td><?= $rox['spesifikasi']; ?></td>
				<td><?= $rox['satuan']; ?></td>
				<td><?= number_format(($rox['harga']), 2, ',', '.'); ?></td>
				<td><?= $rox['kelompok']; ?></td>
				<td><?= $rox['kelompok'] == 'SSH' ? '1' : ($rox['kelompok'] == 'HSPK' ? '2' : ($rox['kelompok'] == 'ASB' ? '3' : ($rox['kelompok'] == 'SBU' ? '4' : ''))); ?></td>
				<td><?= $rox['name']; ?></td>
				<td><?= $rox['kelompok_asli']; ?></td>
				<td><?= $rox['kelompok_asli'] == 'SSH' ? '1' : ($rox['kelompok_asli'] == 'HSPK' ? '2' : ($rox['kelompok_asli'] == 'ASB' ? '3' : ($rox['kelompok_asli'] == 'SBU' ? '4' : ''))); ?></td>
				<?php $komponen = $db->table('tb_ssh_rekening')
					->select('tb_ssh_rekening.*')
					->select('tb_rekening_rincian_objek_sub.kode_rekening_rincian_objek_sub')
					->join('tb_rekening_rincian_objek_sub', 'tb_ssh_rekening.rekening_rincian_objek_sub_id = tb_rekening_rincian_objek_sub.id_rekening_rincian_objek_sub', 'LEFT')
					->getWhere(['ssh_id' => $rox['id_ssh']])->getResultArray();
				foreach ($komponen as $rol) : ?>
					<td><?= $rol['kode_rekening_rincian_objek_sub']; ?></td>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
		<!-- -------------------------------------------------------- -->
		<?php $ssh = $db->table('tb_hspk')
			->select('tb_hspk.*')
			->select('tb_jenis_rincian_objek_sub.jenis_rincian_objek_sub')
			->select('tb_jenis_rincian_objek_sub.kode_jenis_rincian_objek_sub')
			->select('tb_jenis_rincian_objek_sub.kelompok_id as kelompok_asli')
			->select('auth_groups.name')
			->select('tb_verifikasi.created_at as created_at_v')
			->select('tb_verifikasi.updated_at as updated_at_v')
			->join('tb_jenis_rincian_objek_sub', 'tb_hspk.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')
			->join('auth_groups', 'tb_hspk.opd_id = auth_groups.id', 'LEFT')
			->join('tb_verifikasi', 'tb_hspk.id_hspk = tb_verifikasi.hspk_id', 'LEFT')
			->getWhere(['tb_hspk.opd_id' => $opd, 'tb_hspk.tahun' => $_SESSION['tahun'], 'verifikasi' => 'lolos'])->getResultArray(); ?>
		<?php foreach ($ssh as $rox) : ?>
			<tr>
				<td><?= $rox['created_at']; ?></td>
				<td><?= $rox['updated_at']; ?></td>
				<td><?= $rox['created_at_v']; ?></td>
				<td><?= $rox['updated_at_v']; ?></td>
				<td><?= $rox['kode_jenis_rincian_objek_sub']; ?></td>
				<td><?= $rox['jenis_rincian_objek_sub']; ?></td>
				<td><?= $rox['hspk_paket']; ?></td>
				<td></td>
				<td><?= $rox['hspk_satuan']; ?></td>
				<?php
				$A = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $rox['id_hspk'], 'tb_hspk_komponen.group' => 'A'])->getResultArray();
				$B = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $rox['id_hspk'], 'tb_hspk_komponen.group' => 'B'])->getResultArray();
				$C = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $rox['id_hspk'], 'tb_hspk_komponen.group' => 'C'])->getResultArray();

				foreach ($A as $roA) :
					$num[$rox['id_hspk'] . 'A'][] = ($roA['harga'] * $roA['index']);
				endforeach;
				foreach ($B as $roB) :
					$num[$rox['id_hspk'] . 'B'][] = ($roB['harga'] * $roB['index']);
				endforeach;
				foreach ($C as $roC) :
					$num[$rox['id_hspk'] . 'C'][] = ($roC['harga'] * $roC['index']);
				endforeach; ?>
				<!-- ------------------------------------------------------------------------------------ -->
				<td class="text-right">
					<?php
					isset($num[$rox['id_hspk'] . 'A']) ? $AA = ($num[$rox['id_hspk'] . 'A']) : $AA = ['0'];
					isset($num[$rox['id_hspk'] . 'B']) ? $BB = ($num[$rox['id_hspk'] . 'B']) : $BB = ['0'];
					isset($num[$rox['id_hspk'] . 'C']) ? $CC = ($num[$rox['id_hspk'] . 'C']) : $CC = ['0'];
					echo number_format((array_sum($AA) + array_sum($BB) + array_sum($CC)), 2, ',', '.');
					// echo round(array_sum($AA) + array_sum($BB) + array_sum($CC));
					// echo array_sum($AA) + array_sum($BB) + array_sum($CC);
					?>
				</td>
				<td>HSPK</td>
				<td>2</td>
				<td><?= $rox['name']; ?></td>
				<td><?= $rox['kelompok_asli']; ?></td>
				<td><?= $rox['kelompok_asli'] == 'SSH' ? '1' : ($rox['kelompok_asli'] == 'HSPK' ? '2' : ($rox['kelompok_asli'] == 'ASB' ? '3' : ($rox['kelompok_asli'] == 'SBU' ? '4' : ''))); ?></td>
				<?php $komponen = $db->table('tb_hspk')
					->distinct('tb_rekening_rincian_objek_sub.kode_rekening_rincian_objek_sub')
					->select('tb_rekening_rincian_objek_sub.kode_rekening_rincian_objek_sub')
					->join('tb_hspk_komponen', 'tb_hspk.id_hspk = tb_hspk_komponen.hspk_id', 'LEFT')
					->join('tb_ssh_rekening', 'tb_hspk_komponen.ssh_id = tb_ssh_rekening.ssh_id', 'LEFT')
					->join('tb_rekening_rincian_objek_sub', 'tb_ssh_rekening.rekening_rincian_objek_sub_id = tb_rekening_rincian_objek_sub.id_rekening_rincian_objek_sub', 'LEFT')
					->getWhere(['tb_hspk.id_hspk' => $rox['id_hspk']])->getResultArray();
				foreach ($komponen as $rol) : ?>
					<td><?= $rol['kode_rekening_rincian_objek_sub']; ?></td>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
		<!-- -------------------------------------------------- -->
		<?php $asb = $db->table('tb_asb')
			->select('tb_jenis_rincian_objek_sub.jenis_rincian_objek_sub')
			->select('tb_jenis_rincian_objek_sub.kelompok_id as kelompok_asli')
			->select('auth_groups.name')
			->select('tb_asb_verifikasi.created_at as created_at_v')
			->select('tb_asb_verifikasi.updated_at as updated_at_v')
			->select('tb_asb.*')
			->join('tb_asb_verifikasi', 'tb_asb.id_asb = tb_asb_verifikasi.asb_id', 'LEFT')
			->join('tb_jenis_rincian_objek_sub', 'tb_asb.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')
			->join('auth_groups', 'tb_asb.opd_id = auth_groups.id', 'LEFT')
			->getWhere(['tb_asb.tahun' => $_SESSION['tahun'], 'tb_asb_verifikasi.verifikasi' => 'lolos', 'tb_asb.opd_id' => $opd])->getResultArray(); ?>
		<?php foreach ($asb as $rol) : ?>
			<tr>
				<td><?= $rol['created_at']; ?></td>
				<td><?= $rol['updated_at']; ?></td>
				<td><?= $rol['created_at_v']; ?></td>
				<td><?= $rol['updated_at_v']; ?></td>
				<td><?= $rol['jenis_rincian_objek_sub_id']; ?></td>
				<td><?= $rol['jenis_rincian_objek_sub']; ?></td>
				<td><?= $rol['asb_paket']; ?></td>
				<td><?= $rol['asb_spesifikasi']; ?></td>
				<td><?= $rol['asb_satuan']; ?></td>
				<?php $asb_hspk = $db->table('tb_asb_hspk')->select('tb_hspk.id_hspk, tb_asb_hspk.jumlah, tb_hspk.jenis_rincian_objek_sub_id, tb_hspk.hspk_paket, tb_hspk.hspk_spesifikasi, 	tb_hspk.hspk_satuan')
					->join('tb_hspk', 'tb_asb_hspk.hspk_id = tb_hspk.id_hspk', 'left')
					->getWhere(['tb_asb_hspk.asb_id' => $rol['id_asb'], 'tb_asb_hspk.tahun' => $_SESSION['tahun']])->getResultArray(); ?>
				<?php foreach ($asb_hspk as $rom) : ?>
					<!-- ------------------------------------------------------------------------------------ -->
					<?php
					$A = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $rom['id_hspk'], 'tb_hspk_komponen.group' => 'A'])->getResultArray();
					$B = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $rom['id_hspk'], 'tb_hspk_komponen.group' => 'B'])->getResultArray();
					$C = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $rom['id_hspk'], 'tb_hspk_komponen.group' => 'C'])->getResultArray();

					foreach ($A as $roA) :
						$num[$rom['id_hspk'] . $rol['id_asb'] . 'A'][] = ($roA['harga'] * $roA['index']);
					endforeach;
					foreach ($B as $roB) :
						$num[$rom['id_hspk'] . $rol['id_asb'] . 'B'][] = ($roB['harga'] * $roB['index']);
					endforeach;
					foreach ($C as $roC) :
						$num[$rom['id_hspk'] . $rol['id_asb'] . 'C'][] = ($roC['harga'] * $roC['index']);
					endforeach; ?>
					<!-- ------------------------------------------------------------------------------------ -->
					<?php
					isset($num[$rom['id_hspk'] . $rol['id_asb'] . 'A']) ? $AA = ($num[$rom['id_hspk'] . $rol['id_asb'] . 'A']) : $AA = ['0'];
					isset($num[$rom['id_hspk'] . $rol['id_asb'] . 'B']) ? $BB = ($num[$rom['id_hspk'] . $rol['id_asb'] . 'B']) : $BB = ['0'];
					isset($num[$rom['id_hspk'] . $rol['id_asb'] . 'C']) ? $CC = ($num[$rom['id_hspk'] . $rol['id_asb'] . 'C']) : $CC = ['0'];
					// echo number_format((array_sum($AA) + array_sum($BB) + array_sum($CC)), 2, ',', '.');
					$numS[$rol['id_asb']][] = (array_sum($AA) + array_sum($BB) + array_sum($CC)) * $rom['jumlah'];
					?>
				<?php endforeach; ?>
				<td class="text-right">
					<?= isset($numS[$rol['id_asb']]) ? number_format(array_sum($numS[$rol['id_asb']]), 2, ',', '.') : '-'; ?>
				</td>
				<td>ASB</td>
				<td>3</td>
				<td><?= $rol['name']; ?></td>
				<td><?= $rol['kelompok_asli']; ?></td>
				<td><?= $rol['kelompok_asli'] == 'SSH' ? '1' : ($rol['kelompok_asli'] == 'HSPK' ? '2' : ($rol['kelompok_asli'] == 'ASB' ? '3' : ($rol['kelompok_asli'] == 'SBU' ? '4' : ''))); ?></td>
				<?php $komponen = $db->table('tb_asb')
					->distinct('tb_asb.id_asb, tb_rekening_rincian_objek_sub.kode_rekening_rincian_objek_sub')
					->select('tb_asb.id_asb, tb_rekening_rincian_objek_sub.kode_rekening_rincian_objek_sub')
					->join('tb_asb_hspk', 'tb_asb.id_asb = tb_asb_hspk.asb_id', 'LEFT')
					->join('tb_hspk_komponen', 'tb_asb_hspk.hspk_id = tb_hspk_komponen.hspk_id', 'LEFT')
					->join('tb_ssh_rekening', 'tb_hspk_komponen.ssh_id = tb_ssh_rekening.ssh_id', 'LEFT')
					->join('tb_rekening_rincian_objek_sub', 'tb_ssh_rekening.rekening_rincian_objek_sub_id = tb_rekening_rincian_objek_sub.id_rekening_rincian_objek_sub', 'LEFT')
					->getWhere(['tb_asb.id_asb' => $rol['id_asb']])->getResultArray();
				foreach ($komponen as $rol) : ?>
					<td><?= $rol['kode_rekening_rincian_objek_sub']; ?></td>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>

	</tbody>
</table>

</html>