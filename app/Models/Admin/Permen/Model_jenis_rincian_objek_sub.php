<?php

namespace App\Models\Admin\Permen;

use CodeIgniter\Model;

class Model_jenis_rincian_objek_sub extends Model
{
	protected $table = 'tb_jenis_rincian_objek_sub';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_jenis_rincian_objek_sub';
	protected $allowedFields = ['id_jenis_rincian_objek_sub', 'rincian_objek_id', 'kode_jenis_rincian_objek_sub', 'jenis_rincian_objek_sub', 'tahun', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	// public function indikator()
	// {
	// 	return $this->db->table('tb_kla_indikator')
	// 		->orderBy('tb_kla_indikator.kla_indik', 'ASC')
	// 		->select('tb_kla_indikator.*')
	// 		->getWhere(['tb_kla_indikator.tahun' => $_SESSION['tahun']])->getResultArray();
	// }
}
