<?php

namespace App\Models\Admin\Rekening;

use CodeIgniter\Model;

class Model_rekening_rincian_objek extends Model
{
	protected $table = 'tb_rekening_rincian_objek';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_rekening_rincian_objek';
	protected $allowedFields = ['id_rekening_rincian_objek', 'rekening_objek_id', 'kode_rekening_rincian_objek', 'rekening_rincian_objek', 'kelompok_id', 'tahun', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	// public function indikator()
	// {
	// 	return $this->db->table('tb_kla_indikator')
	// 		->orderBy('tb_kla_indikator.kla_indik', 'ASC')
	// 		->select('tb_kla_indikator.*')
	// 		->getWhere(['tb_kla_indikator.tahun' => $_SESSION['tahun']])->getResultArray();
	// }
}
