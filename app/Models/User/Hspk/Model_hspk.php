<?php

namespace App\Models\User\Hspk;

use CodeIgniter\Model;

class Model_hspk extends Model
{
	protected $table = 'tb_hspk';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_hspk';
	protected $allowedFields = ['hspk_paket', 'hspk_spesifikasi', 'hspk_satuan', 'jenis_rincian_objek_sub_id', 'tahun', 'opd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];


	public function hspk_edit($id)
	{

		return $this
			->join('tb_jenis_rincian_objek_sub', 'tb_hspk.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')
			->getWhere(['tb_hspk.id_hspk' => $id])->getRowArray();
	}

	public function hspk()
	{
		// return $this->getWhere(['tb_hspk.opd_id' => user()->opd_id])->getResultArray();

		$query = $this->db->table('tb_hspk')
			->select('tb_jenis_rincian_objek_sub.*,tb_hspk.*, SUM(tb_hspk_komponen.index * tb_ssh.harga) AS total')
			->join('tb_hspk_komponen', 'tb_hspk.id_hspk = tb_hspk_komponen.hspk_id', 'LEFT')
			->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')
			->join('tb_jenis_rincian_objek_sub', 'tb_hspk.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')
			->groupBy('tb_hspk.id_hspk')
			->get()
			->getResultArray();
		return $query;
	}
	function getkelompok($akun_id)
	{
		$query = $this->db->table('tb_jenis_kelompok')->getWhere(['jenis_akun_id' => $akun_id])->getResult();
		return $query;
	}
	function getsatuan()
	{
		$query = $this->db->table('tb_satuan')->get();
		return $query;
	}
	function getjenis($kelompok_id)
	{
		$query = $this->db->table('tb_jenis_jenis')->getWhere(['jenis_kelopok_id' => $kelompok_id])->getResult();
		return $query;
	}
	function getobjek($jenis_id)
	{
		$query = $this->db->table('tb_jenis_objek')->getWhere(['jenis_jenis_id' => $jenis_id])->getResult();
		return $query;
	}
	function getrincianobjek($objek_id)
	{
		$query = $this->db->table('tb_jenis_rincian_objek')->getWhere(['jenis_objek_id' => $objek_id])->getResult();
		return $query;
	}
	// function getsubrincianobjek($rincianobjek_id)
	// {
	// 	$query = $this->db->table('tb_jenis_rincian_objek_sub')->getWhere(['jenis_rincian_objek_id' => $rincianobjek_id, 'kelompok_id' => 'HSPK'])->getResult();
	// 	return $query;
	// }
	function getsubrincianobjek($rincianobjek_id)
	{
		$query = $this->db->table('tb_jenis_rincian_objek_sub')->getWhere(['jenis_rincian_objek_id' => $rincianobjek_id])->getResult();
		return $query;
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
	}
}
