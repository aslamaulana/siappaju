<?php

namespace App\Models\Admin\Asb;

use CodeIgniter\Model;

class Model_asb extends Model
{
	protected $table = 'tb_asb';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_asb';
	protected $allowedFields = ['jenis_rincian_objek_sub_id', 'asb_spesifikasi', 'asb_paket', 'asb_satuan', 'tahun', 'opd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function asb_cetak()
	{
		return $this
			->DISTINCT('auth_groups.description')
			->DISTINCT('tb_asb.opd_id')
			->select('tb_asb.opd_id')
			->select('auth_groups.description')
			->join('auth_groups', 'tb_asb.opd_id = auth_groups.id', 'LEFT')
			->join('tb_asb_verifikasi', 'tb_asb.id_asb = tb_asb_verifikasi.asb_id', 'LEFT')
			->getWhere(['tb_asb_verifikasi.verifikasi' => 'lolos'])->getResultArray();
			//->getWhere(['tb_asb.tahun' => $_SESSION['tahun'], 'tb_asb_verifikasi.verifikasi' => 'lolos'])->getResultArray();
	}
	public function asb_cetak_filter($id)
	{
		return $this
			->DISTINCT('auth_groups.description')
			->DISTINCT('tb_asb.opd_id')
			->select('tb_asb.opd_id')
			->select('auth_groups.description')
			->join('auth_groups', 'tb_asb.opd_id = auth_groups.id', 'LEFT')
			->join('tb_asb_verifikasi', 'tb_asb.id_asb = tb_asb_verifikasi.asb_id', 'LEFT')
			->getWhere(['tb_asb.opd_id' => $id, 'tb_asb_verifikasi.verifikasi' => 'lolos'])->getResultArray();
			//->getWhere(['tb_asb.tahun' => $_SESSION['tahun'], 'tb_asb.opd_id' => $id, 'tb_asb_verifikasi.verifikasi' => 'lolos'])->getResultArray();
	}
}
