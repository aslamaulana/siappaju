<?php

namespace App\Models\Admin\Sshsbu;

use CodeIgniter\Model;

class Model_ssh extends Model
{
	protected $table = 'tb_ssh';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_ssh';
	protected $allowedFields = ['komponen', 'spesifikasi', 'satuan', 'opd_id', 'harga', 'keterangan', 'kelompok_id', 'tahun', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function ssh()
	{
		return $this
			->select('tb_ssh.*')
			->join('tb_ssh_verifikasi', 'tb_ssh.id_ssh = tb_ssh_verifikasi.ssh_id', 'LEFT')
			->getWhere(['tb_ssh.tahun' => $_SESSION['tahun'], 'verifikasi' => 'lolos'])->getResultArray();
	}

	public function ssh_pengajuan($id)
	{
		return $this
			->select('tb_ssh.*')
			->select('auth_groups.name')
			->join('auth_groups', 'tb_ssh.opd_id = auth_groups.id', 'LEFT')
			->getWhere(['tb_ssh.tahun' => $_SESSION['tahun'], 'tb_ssh.opd_id' => $id])->getResultArray();
	}

	public function ssh_cetak_all()
	{
		return $this
			->select('tb_ssh.*')
			->select('tb_jenis_rincian_objek_sub.jenis_rincian_objek_sub')
			->select('tb_jenis_rincian_objek_sub.kode_jenis_rincian_objek_sub')
			->select('tb_jenis_rincian_objek_sub.kelompok_id as kelompok_asli')
			->select('auth_groups.name')
			->join('tb_jenis_rincian_objek_sub', 'tb_ssh.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')
			->join('tb_ssh_verifikasi', 'tb_ssh.id_ssh = tb_ssh_verifikasi.ssh_id', 'LEFT')
			->join('auth_groups', 'tb_ssh.opd_id = auth_groups.id', 'LEFT')
			->Where(['tb_ssh.tahun' => $_SESSION['tahun'], 'tb_ssh_verifikasi.verifikasi' => 'lolos'])
			->orWhere(['tb_ssh_verifikasi.verifikasi' => 'lolos'])
			->orWhere(['tb_ssh_verifikasi.verifikasi' => 'perbup'])
			->get()
			->getResultArray();
			//->getWhere(['tb_ssh.tahun' => $_SESSION['tahun'], 'tb_ssh_verifikasi.verifikasi' => 'lolos'])->getResultArray();
	}
	public function ssh_cetak_ssh($id)
	{
		return $this
			->select('tb_ssh.*')
			->select('tb_jenis_rincian_objek_sub.jenis_rincian_objek_sub')
			->select('tb_jenis_rincian_objek_sub.kode_jenis_rincian_objek_sub')
			->select('tb_jenis_rincian_objek_sub.kelompok_id as kelompok_asli')
			->select('auth_groups.name')
			->join('tb_jenis_rincian_objek_sub', 'tb_ssh.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')
			->join('tb_ssh_verifikasi', 'tb_ssh.id_ssh = tb_ssh_verifikasi.ssh_id', 'LEFT')
			->join('auth_groups', 'tb_ssh.opd_id = auth_groups.id', 'LEFT')
			->getWhere(['tb_ssh.tahun' => $_SESSION['tahun'], 'tb_ssh.kelompok' => 'SSH', 'tb_ssh_verifikasi.verifikasi' => 'lolos'])->getResultArray();
	}
	public function ssh_cetak_sbu($id)
	{
		return $this
			->select('tb_ssh.*')
			->select('tb_jenis_rincian_objek_sub.jenis_rincian_objek_sub')
			->select('tb_jenis_rincian_objek_sub.kode_jenis_rincian_objek_sub')
			->select('tb_jenis_rincian_objek_sub.kelompok_id as kelompok_asli')
			->select('auth_groups.name')
			->join('tb_jenis_rincian_objek_sub', 'tb_ssh.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')
			->join('tb_ssh_verifikasi', 'tb_ssh.id_ssh = tb_ssh_verifikasi.ssh_id', 'LEFT')
			->join('auth_groups', 'tb_ssh.opd_id = auth_groups.id', 'LEFT')
			->getWhere(['tb_ssh.tahun' => $_SESSION['tahun'], 'tb_ssh.kelompok' => 'SBU', 'tb_ssh_verifikasi.verifikasi' => 'lolos'])->getResultArray();
	}
}
