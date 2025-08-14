<?php

namespace App\Models\Admin\Asb;

use CodeIgniter\Model;

class Model_asb_hspk extends Model
{
	protected $table = 'tb_asb_hspk';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_asb_hspk';
	protected $allowedFields = ['asb_id', 'hspk_id', 'jumlah', 'tahun', 'opd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function asb_hspk($id)
	{
		return $this
			->select('tb_asb_hspk.id_asb_hspk')
			->select('tb_hspk.hspk_paket')
			->join('tb_hspk', 'tb_asb_hspk.hspk_id = tb_hspk.id_hspk', 'LEFT')
			->getWhere(['tb_asb_hspk.tahun' => $_SESSION['tahun'], 'tb_asb_hspk.hspk_id' => $id])->getResultArray();
	}

	public function hspk()
	{
		return $this->db->table('tb_hspk')
			->select('tb_hspk.*')
			->select('tb_verifikasi.verifikasi')
			->join('tb_verifikasi', 'tb_hspk.id_hspk = tb_verifikasi.hspk_id', 'LEFT')
			->getWhere(['tb_hspk.tahun' => $_SESSION['tahun'], 'tb_verifikasi.verifikasi' => 'lolos'])->getResultArray();
	}
	// public function hspk_cetak()
	// {
	// 	return $this
	// 		->select('tb_hspk.*')
	// 		->select('auth_groups.name')
	// 		->join('auth_groups', 'tb_hspk.opd_id = auth_groups.id', 'LEFT')
	// 		->getWhere(['tb_hspk.tahun' => $_SESSION['tahun']])->getResultArray();
	// }
}
