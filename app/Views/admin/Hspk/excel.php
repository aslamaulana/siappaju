<table>
	<thead>
		<tr>
			<th align="center" width="0.5cm">No</th>
			<th align="center" width="0.5cm">Nama Barang / Uraian Pekerjaan</th>
			<th align="center" width="40px">Satuan</th>
			<th align="center" width="40px">Index</th>
			<th align="center" width="60px">Harga</th>
			<th align="center" width="60px">Kelompok</th>
			<th align="center" width="60px">skpd</th>
			<th align="center" width="60px">Rekening 1</th>
			<th align="center" width="60px">Rekening 2</th>
			<th align="center" width="60px">Rekening 3</th>
			<th align="center" width="60px">Rekening 4</th>
			<th align="center" width="60px">Rekening 5</th>
			<th align="center" width="60px">Rekening 6</th>
			<th align="center" width="60px">Rekening 7</th>
			<th align="center" width="60px">Rekening 8</th>
			<th align="center" width="60px">Rekening 9</th>
			<th align="center" width="60px">Rekening 10</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($rowk as $row) : ?>
			<tr>
				<td><?= $row['kode_jenis_rincian_objek_sub']; ?></td>
				<td><?= $row['komponen']; ?></td>
				<td><?= $row['spesifikasi']; ?></td>
				<td><?= $row['satuan']; ?></td>
				<td><?= $row['harga']; ?></td>
				<td><?= $row['kelompok_id']; ?></td>
				<td><?= $row['created_by']; ?></td>
				<?php $query = $db->table('tb_maping_jenis_ssh_jenis_rekening')
					->select('tb_rekening_rincian_objek_sub.kode_rekening_rincian_objek_sub')
					->select('tb_maping_jenis_ssh_jenis_rekening.maping_jenis_ssh_jenis_id')
					->join('tb_rekening_rincian_objek_sub', 'tb_rekening_rincian_objek_sub.id_rekening_rincian_objek_sub = tb_maping_jenis_ssh_jenis_rekening.rekening_rincian_objek_sub_id', 'left')
					->getWhere(['tb_maping_jenis_ssh_jenis_rekening.maping_jenis_ssh_jenis_id' => $row['id_maping_jenis_ssh_jenis']])->getResultArray();
				foreach ($query as $ros) : ?>
					<td><?= $ros['kode_rekening_rincian_objek_sub']; ?></td>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>