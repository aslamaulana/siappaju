<?php

namespace App\Models\User\Asb;

use CodeIgniter\Model;

class Model_asb extends Model
{
	protected $table = 'tb_asb';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_asb';
	protected $allowedFields = ['jenis_rincian_objek_sub_id', 'asb_spesifikasi', 'asb_paket', 'asb_satuan', 'tahun', 'opd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function asb($id)
	{
		return $this->db->table('tb_asb')
			// ->select('tb_jenis_rincian_objek_sub.*, tb_asb.id_asb')
			->join('tb_jenis_rincian_objek_sub', 'tb_asb.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')
			->getWhere(['tb_asb.id_asb' => $id])->getRowArray();
	}
	public function hspk()
	{
		return $this->db->table('tb_hspk')
			->select('tb_hspk.*')
			->join('tb_verifikasi', 'tb_hspk.id_hspk = tb_verifikasi.hspk_id', 'LEFT')
			// ->getWhere(['tb_hspk.tahun' => $_SESSION['tahun'], 'tb_verifikasi.verifikasi' => 'lolos'])->getResultArray();
			->getWhere(['tb_verifikasi.verifikasi' => 'lolos'])->getResultArray();
	}
}
