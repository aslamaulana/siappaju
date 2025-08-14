<?php

namespace App\Models\User\Hspk;

use CodeIgniter\Model;

class Model_hspk_komponen extends Model
{
	protected $table = 'tb_hspk_komponen';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_hspk_komponen';
	protected $allowedFields = ['ssh_id', 'hspk_id', 'index', 'group', 'tahun', 'opd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	// public function ssh()
	// {
	// 	return $this->db->table('tb_ssh')->getWhere(['tb_ssh.tahun' => $_SESSION['tahun']])->getResultArray();
	// }
	public function ssh()
	{
		return $this->db->table('tb_ssh')
			->select('tb_ssh.*')
			->join('tb_ssh_verifikasi', 'tb_ssh.id_ssh = tb_ssh_verifikasi.ssh_id', 'LEFT')
			->getWhere(['tb_ssh.tahun' => $_SESSION['tahun'], 'verifikasi' => 'lolos'])->getResultArray();
	}
	public function hspk_komponen_grouped($id)
	{
		$result = $this->select('tb_hspk_komponen.*, tb_ssh.*')
			->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')
			->where('tb_hspk_komponen.hspk_id', $id)
			->whereIn('tb_hspk_komponen.group', ['A', 'B', 'C'])
			->orderBy('tb_hspk_komponen.group', 'ASC')
			->get()
			->getResultArray();

		// Inisialisasi array kosong untuk tiap group
		$grouped = [
			'A' => [],
			'B' => [],
			'C' => []
		];

		foreach ($result as $row) {
			$grouped[$row['group']][] = $row;
		}

		return $grouped;
	}

	// public function hspk_komponen_A($id)
	// {
	// 	return $this->select('tb_hspk_komponen.*, tb_ssh.*')
	// 		->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')
	// 		->getWhere(['tb_hspk_komponen.hspk_id' => $id, 'tb_hspk_komponen.group' => 'A'])->getResultArray();
	// }
	// public function hspk_komponen_B($id)
	// {
	// 	return $this->select('tb_hspk_komponen.*, tb_ssh.*')
	// 		->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')
	// 		->getWhere(['tb_hspk_komponen.hspk_id' => $id, 'tb_hspk_komponen.group' => 'B'])->getResultArray();
	// }
	// public function hspk_komponen_C($id)
	// {
	// 	return $this->select('tb_hspk_komponen.*, tb_ssh.*')
	// 		->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')
	// 		->getWhere(['tb_hspk_komponen.hspk_id' => $id, 'tb_hspk_komponen.group' => 'C'])->getResultArray();
	// }

	function getssh($ssh)
	{
		$query = $this->db->table('tb_ssh')
			->select('tb_ssh.*')
			->join('tb_ssh_verifikasi', 'tb_ssh.id_ssh = tb_ssh_verifikasi.ssh_id', 'LEFT')
			->Where(['tb_ssh.tahun' => $_SESSION['tahun'], 'kelompok' => $ssh])

			->Where(['verifikasi' =>  'lolos'])
			->orWhere(['verifikasi' => 'perbup'])
			->get()->getResult();
		return $query;
	}
}
