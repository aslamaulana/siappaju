<?php

namespace App\Models\User\Ssh;

use CodeIgniter\Model;

class Model_ssh_rekening extends Model
{
	protected $table = 'tb_ssh_rekening';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_ssh_rekening';
	protected $allowedFields = ['ssh_id', 'rekening_rincian_objek_sub_id', 'opd_id', 'tahun', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function ssh_rekening($id)
	{
		return $this
			->select('tb_rekening_rincian_objek_sub.kode_rekening_rincian_objek_sub, tb_rekening_rincian_objek_sub.rekening_rincian_objek_sub')
			->select('tb_ssh_rekening.*')
			->join('tb_rekening_rincian_objek_sub', 'tb_ssh_rekening.rekening_rincian_objek_sub_id = tb_rekening_rincian_objek_sub.id_rekening_rincian_objek_sub', 'LEFT')
			->getWhere(['tb_ssh_rekening.tahun' => $_SESSION['tahun'], 'tb_ssh_rekening.ssh_id' => $id])->getResultArray();
	}
	public function ssh_rekening_findAll($id)
	{
		return $this
			->join('tb_rekening_rincian_objek_sub', 'tb_ssh_rekening.rekening_rincian_objek_sub_id = tb_rekening_rincian_objek_sub.id_rekening_rincian_objek_sub', 'LEFT')
			->getWhere(['tb_ssh_rekening.ssh_id' => $id])->getResultArray();
	}
	function getkelompok($akun_id)
	{
		$query = $this->db->table('tb_rekening_kelompok')->getWhere(['rekening_akun_id' => $akun_id])->getResult();
		return $query;
	}
	function getjenis($kelompok_id)
	{
		$query = $this->db->table('tb_rekening_jenis')->getWhere(['rekening_kelopok_id' => $kelompok_id])->getResult();
		return $query;
	}
	function getobjek($jenis_id)
	{
		$query = $this->db->table('tb_rekening_objek')->getWhere(['rekening_jenis_id' => $jenis_id])->getResult();
		return $query;
	}
	function getrincianobjek($objek_id)
	{
		$query = $this->db->table('tb_rekening_rincian_objek')->getWhere(['rekening_objek_id' => $objek_id])->getResult();
		return $query;
	}
	function getsubrincianobjek($rincianobjek_id)
	{
		$query = $this->db->table('tb_rekening_rincian_objek_sub')->getWhere(['rekening_rincian_objek_id' => $rincianobjek_id])->getResult();
		return $query;
	}
	function gettype($subrincianobjek_id)
	{
		$query = $this->db->table('tb_rekening_rincian_objek_sub')->getWhere(['id_jenis_rincian_objek_sub' => $subrincianobjek_id])->getResult();
		return $query;
	}
}
