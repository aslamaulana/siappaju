<!DOCTYPE html>
<html lang="">
<table>
	<tbody>
		<tr>
			<td><b>ID_ssh_siappaju</b></td>
			<td><b>Kode Sub Rincian Objek</b></td>
			<td><b>Sub Rincian Objek</b></td>
			<td><b>Komponen</b></td>
			<td><b>Spesifikasi</b></td>
			<td><b>Satuan</b></td>
			<td><b>Harga</b></td>
			<td><b>Kelompok</b></td>
			<td><b>Kelompok_id</b></td>
			<td><b>% TKDN</b></td>
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
		<?php foreach ($ssh as $rox) : ?>
			<tr>
				<td><?= $rox['id_ssh']; ?></td>
				<td><?= $rox['kode_jenis_rincian_objek_sub']; ?></td>
				<td><?= $rox['jenis_rincian_objek_sub']; ?></td>
				<td><?= $rox['komponen']; ?></td>
				<td><?= $rox['spesifikasi']; ?></td>
				<td><?= $rox['satuan']; ?></td>
				<td><?= $rox['harga']; ?></td>
				<td><?= $rox['kelompok']; ?></td>
				<td><?= $rox['kelompok'] == 'SSH' ? '1' : ($rox['kelompok'] == 'HSPK' ? '2' : ($rox['kelompok'] == 'ASB' ? '3' : ($rox['kelompok'] == 'SBU' ? '4' : ''))); ?></td>
				<td><?= $rox['tkdn']; ?></td>
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

	</tbody>
</table>

</html>