<?php

namespace App\Models\Admin\Ssh;

use CodeIgniter\Model;

class Model_ssh extends Model
{
	protected $table = 'tb_ssh';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_ssh';
	protected $allowedFields = ['komponen', 'spesifikasi', 'satuan', 'opd_id', 'harga', 'keterangan', 'kelompok', 'tahun', 'created_by', 'updated_by', 'created_at', 'updated_at'];

public function ssh()
	{
		return $this
			->select('tb_ssh.*, tb_ssh_verifikasi.verifikasi, tb_ssh_verifikasi.nm_verifikator')
			->join('tb_ssh_verifikasi', 'tb_ssh.id_ssh = tb_ssh_verifikasi.ssh_id', 'LEFT')
			->where("tb_ssh.keterangan = '1' OR tb_ssh_verifikasi.verifikasi = 'lolos'")->get()->getResultArray();
	}

	public function ssh_pengajuan($id)
	{
		return $this
			->select('tb_ssh.*,tb_jenis_rincian_objek_sub.kode_jenis_rincian_objek_sub, tb_jenis_rincian_objek_sub.jenis_rincian_objek_sub')
			->select('auth_groups.name')
			->join('auth_groups', 'tb_ssh.opd_id = auth_groups.id', 'LEFT')
			->join('tb_jenis_rincian_objek_sub', 'tb_ssh.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')
			->getWhere(['tb_ssh.tahun' => $_SESSION['tahun'], 'tb_ssh.opd_id' => $id])->getResultArray();
	}
}
