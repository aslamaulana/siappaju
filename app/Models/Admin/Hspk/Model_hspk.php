<?php

namespace App\Models\Admin\Hspk;

use CodeIgniter\Model;

class Model_hspk extends Model
{
	protected $table = 'tb_hspk';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_hspk';
	protected $allowedFields = ['hspk_paket', 'hspk_satuan', 'tahun', 'opd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function hspk_all()
	{
		return $this
			->select('tb_hspk.*')
			->select('auth_groups.id,auth_groups.name,tb_jenis_rincian_objek_sub.kode_jenis_rincian_objek_sub, tb_jenis_rincian_objek_sub.jenis_rincian_objek_sub')
			->join('tb_jenis_rincian_objek_sub', 'tb_hspk.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')
			->join('auth_groups', 'tb_hspk.opd_id = auth_groups.id', 'LEFT')
			->join('tb_verifikasi', 'tb_hspk.id_hspk = tb_verifikasi.hspk_id', 'LEFT')
			->where("tb_hspk.keterangan = '1' OR tb_verifikasi.verifikasi = 'lolos'")->get()->getResultArray();
	}
	// public function hspk($id)
	// {
	// 	return $this
	// 		->select('tb_hspk.*')
	// 		->select('auth_groups.name,tb_jenis_rincian_objek_sub.kode_jenis_rincian_objek_sub, tb_jenis_rincian_objek_sub.jenis_rincian_objek_sub')
	// 		->join('auth_groups', 'tb_hspk.opd_id = auth_groups.id', 'LEFT')
	// 		->join('tb_jenis_rincian_objek_sub', 'tb_hspk.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')
	// 		->getWhere(['tb_hspk.opd_id' => $id])->getResultArray();
	// 	// ->getWhere(['tb_hspk.tahun' => $_SESSION['tahun'], 'tb_hspk.opd_id' => $id])->getResultArray();
	// }

	public function hspk($opd_id)
	{
		$builder = $this->db->table('tb_hspk h');
		$builder->select('h.*, ag.name, jros.id_jenis_rincian_objek_sub, jros.jenis_rincian_objek_sub, v.verifikasi, v.verifikasi_keterangan, v.nm_verifikator');
		$builder->select('COALESCE(SUM(CASE WHEN k.group = "A" THEN ssh.harga * k.index END),0) as totalA');
		$builder->select('COALESCE(SUM(CASE WHEN k.group = "B" THEN ssh.harga * k.index END),0) as totalB');
		$builder->select('COALESCE(SUM(CASE WHEN k.group = "C" THEN ssh.harga * k.index END),0) as totalC');
		$builder->join('auth_groups ag', 'h.opd_id = ag.id', 'LEFT');
		$builder->join('tb_jenis_rincian_objek_sub jros', 'h.jenis_rincian_objek_sub_id = jros.id_jenis_rincian_objek_sub', 'LEFT');
		$builder->join('tb_hspk_komponen k', 'h.id_hspk = k.hspk_id', 'LEFT');
		$builder->join('tb_verifikasi v', 'h.id_hspk = v.hspk_id', 'LEFT');
		$builder->join('tb_ssh ssh', 'k.ssh_id = ssh.id_ssh', 'LEFT');
		$builder->where('h.opd_id', $opd_id);
		$builder->groupBy('h.id_hspk');

		return $builder->get()->getResultArray();
	}

	public function hspk_cetak()
	{
		return $this
			->DISTINCT('auth_groups.description')
			->DISTINCT('tb_hspk.opd_id')
			->select('tb_hspk.opd_id')
			->select('auth_groups.description')
			->join('auth_groups', 'tb_hspk.opd_id = auth_groups.id', 'LEFT')
			->join('tb_verifikasi', 'tb_hspk.id_hspk = tb_verifikasi.hspk_id', 'LEFT')
			->getWhere(['tb_verifikasi.verifikasi' => 'lolos'])->getResultArray();
		//->getWhere(['tb_hspk.tahun' => $_SESSION['tahun'], 'tb_verifikasi.verifikasi' => 'lolos'])->getResultArray();
	}
	public function hspk_cetak_filter($id)
	{
		return $this
			->DISTINCT('auth_groups.description')
			->DISTINCT('tb_hspk.opd_id')
			->select('tb_hspk.opd_id')
			->select('auth_groups.description')
			->join('auth_groups', 'tb_hspk.opd_id = auth_groups.id', 'LEFT')
			->join('tb_verifikasi', 'tb_hspk.id_hspk = tb_verifikasi.hspk_id', 'LEFT')
			->getWhere(['tb_hspk.opd_id' => $id, 'tb_verifikasi.verifikasi' => 'lolos'])->getResultArray();
		//->getWhere(['tb_hspk.tahun' => $_SESSION['tahun'], 'tb_hspk.opd_id' => $id, 'tb_verifikasi.verifikasi' => 'lolos'])->getResultArray();
	}
}
