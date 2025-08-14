<?php

namespace App\Models\Admin\Verifikasi;

use CodeIgniter\Model;

class Model_verifikasi extends Model
{
	protected $table = 'tb_verifikasi';
	protected $useTimestamps = true;
	protected $useAutoIncrement = false;
	protected $primaryKey = 'hspk_id';
	protected $allowedFields = ['hspk_id', 'verifikasi', 'verifikasi_keterangan', 'nm_verifikator', 'tahun', 'opd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	// public function hspk($id)
	// {
	// 	return $this
	// 		->select('tb_hspk.*')
	// 		->select('auth_groups.name')
	// 		->join('auth_groups', 'tb_hspk.opd_id = auth_groups.id', 'LEFT')
	// 		->getWhere(['tb_hspk.tahun' => $_SESSION['tahun'], 'tb_hspk.opd_id' => $id])->getResultArray();
	// }
	// public function hspk_cetak_filter($id)
	// {
	// 	return $this
	// 		->select('tb_hspk.*')
	// 		->select('auth_groups.name')
	// 		->join('auth_groups', 'tb_hspk.opd_id = auth_groups.id', 'LEFT')
	// 		->getWhere(['tb_hspk.tahun' => $_SESSION['tahun'], 'tb_hspk.opd_id' => $id])->getResultArray();
	// }
	// public function hspk_cetak()
	// {
	// 	return $this
	// 		->select('tb_hspk.*')
	// 		->select('auth_groups.name')
	// 		->join('auth_groups', 'tb_hspk.opd_id = auth_groups.id', 'LEFT')
	// 		->getWhere(['tb_hspk.tahun' => $_SESSION['tahun']])->getResultArray();
	// }
}
